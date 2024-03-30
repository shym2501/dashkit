<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'image',
        'price',
        'discount',
        'category_id',
        'link',
        'total',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function flashSale()
    {
        return $this->belongsTo(FlashSale::class);
    }
}
