<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'price',
        'quantity',
        'category_id',
        'imagePath',
    ];


    public function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }
}
