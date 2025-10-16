<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'midtrans_order_id',
        'address',
        'payment_method',
        'shipping_cost',
        'image',
        'total',
        'resi',
        'note',
        'status',
        'payment_status', // tambahkan jika kamu ingin tracking pembayaran
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
