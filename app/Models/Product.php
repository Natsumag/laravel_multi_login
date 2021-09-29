<?php

namespace App\Models;

use App\Models\Image;
use App\Models\SecondaryCategory;
use App\Models\Shop;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'shop_id',
      'name',
      'information',
      'price',
      'is_selling',
      'sort_order',
      'secondary_category_id',
      'image1'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function secondaryCategory()
    {
        return $this->belongsTo(SecondaryCategory::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    // public function imageSecond()
    // {
    //     return $this->belongsTo(Image::class, 'image2_id', 'id');
    // }
    // public function imageThird()
    // {
    //     return $this->belongsTo(Image::class, 'image3_id', 'id');
    // }
    // public function imageForth()
    // {
    //     return $this->belongsTo(Image::class, 'image4_id', 'id');
    // }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
