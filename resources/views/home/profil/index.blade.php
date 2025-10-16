@extends('layouts.app')
@section('content')

<!-- BREADCRUMB -->
<div class="section" style="background: #f5f5f5; padding: 20px 0;">
    <div class="container">
        <ul style="list-style: none; padding: 0; margin: 0; display: flex; gap: 10px; font-size: 14px;">
            <li><a href="#" style="text-decoration: none; color: #dc1919;">Home</a></li>
            <li style="color: #7f8c8d;">/</li>
            <li style="color: #333;">Profil Pengguna</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<!-- PROFILE SECTION -->
<div class="section" style="padding: 40px 0;">
    <div class="container" style="max-width: 1000px; margin: auto;">
        <div style="display: flex; gap: 30px; flex-wrap: wrap; justify-content: center;">
            <!-- Profile Image -->
            <div style="flex: 1; min-width: 250px;">
                <div style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: center;">
                    <img src="{{ asset($user->image) }}" alt="User Image" style="width: 100%; max-width: 250px; height: auto; border-radius: 8px; object-fit: cover;">
                </div>
            </div>

          <!-- Profile Info -->
<div style="flex: 2; min-width: 300px;">
    <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 20px; color: #2c3e50;">Profil Pengguna</h2>

        <div style="margin-bottom: 15px;">
            <h5 style="margin: 0; font-size: 16px; color: #7f8c8d;">Nama</h5>
            <p style="margin: 5px 0;">{{ $user->name }}</p>
        </div>

        <div style="margin-bottom: 15px;">
            <h5 style="margin: 0; font-size: 16px; color: #7f8c8d;">Email</h5>
            <p style="margin: 5px 0;">{{ $user->email }}</p>
        </div>

        <div style="margin-bottom: 15px;">
            <h5 style="margin: 0; font-size: 16px; color: #7f8c8d;">Telepon</h5>
            <p style="margin: 5px 0;">{{ $user->nomor_telpon ?? '-' }}</p>
        </div>

        <div style="margin-bottom: 25px;">
            <h5 style="margin: 0; font-size: 16px; color: #7f8c8d;">Alamat</h5>
            <p style="margin: 5px 0;">{{ $user->alamat ?? '-' }}</p>
        </div>

        <!-- Tambahan Poin -->
        <div style="margin-bottom: 25px; padding: 15px; background-color: #f0f9ff; border-radius: 8px; border: 1px solid #d0eaff;">
            <h5 style="margin: 0; font-size: 16px; color: #2980b9;">Poin Kamu</h5>
            <p style="margin: 8px 0; font-size: 18px; font-weight: bold; color: #3498db;">
                <i class="fa fa-star" style="color: gold; margin-right: 6px;"></i>
                {{ number_format($user->points ?? 0, 0, ',', '.') }} Poin
            </p>
            <a href="{{route('home.index')}}"    style="padding: 8px 18px; background-color: gold; border: none; color: white; border-radius: 20px; font-weight: bold; cursor: pointer; display: inline-block; text-decoration: none; transition: all 0.3s ease;"
            onmouseover="this.style.backgroundColor='#d4af37'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2)'"
            onmouseout="this.style.backgroundColor='gold'; this.style.transform='scale(1)'; this.style.boxShadow='none'">
                <i class="fa fa-gift"></i> Gunakan Poin
            </a>
           
        </div>

        <a href=" {{route('profil.edit')}}"  style="padding: 10px 20px; background-color: #e70c0c; border: none; color: white; border-radius: 20px; font-weight: bold; cursor: pointer; transition: background-color 0.3s;"
        onmouseover="this.style.backgroundColor='#c0392b'"
        onmouseout="this.style.backgroundColor='#e70c0c'" >
        <i class="fa fa-pencil"></i> Lengkapi Data
    </a>
      
    </div>
</div>



        </div>
    </div>
</div>
<!-- /PROFILE SECTION -->





@endsection
