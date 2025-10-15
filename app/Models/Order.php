<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'note',
        'payment_method',
        'payment_status',
        // 'total'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->withPivot('quantity', 'price');
    }


    public function order_details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
