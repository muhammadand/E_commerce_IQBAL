<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
{
    $users = User::all(); // Atau gunakan paginate jika datanya banyak

    return view('admin.users.index', compact('users'));
}

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register_customer()
    {
        return view('auth.customer.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:admin,seller,customer',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('home.index')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $role = Auth::user()->role;
    
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
                case 'seller':
                    return redirect()->route('seller.dashboard')->with('success', 'Selamat datang, Seller!');
                case 'customer':
                    return redirect()->route('home.index')->with('success', 'Selamat datang!');
                default:
                    Auth::logout(); // Logout jika role tidak valid
                    return redirect()->route('login.form')->withErrors([
                        'email' => 'Akun kamu tidak memiliki peran yang valid.',
                    ]);
            }
        }
    
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index');
    }



    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

   
   

    public function destroy(User $user)
    {
        // Hapus data user
        $user->delete();

        // Redirect kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
