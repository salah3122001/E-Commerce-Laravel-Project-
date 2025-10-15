<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable=[
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'imagePath',
    ];
    public function product()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
