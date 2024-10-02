<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'section_id',
        'category_id',
        'brand_id',
        'vendor_id',
        'admin_type',
        'admin_id',
        'product_name',
        'product_code',
        'product_color',
        'product_price',
        'product_discount',
        'product_weight',
        'product_image',
        'product_video',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_featured',
        'status',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'vendor_id', 'vendor_id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public static function getDiscountedPrice($product_id)
    {
        $product = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->where('status', 1)->first();
        $category = Category::select('category_discount')->where('id', $product->category_id)->where('status', 1)->first();

        if (($product->product_discount) > 0) {
            $discounted_price = $product->product_price - $product->product_discount;
        } else if (($category->category_discount) > 0) {
            $discounted_price = $product->product_price - $category->category_discount;
        } else {
            $discounted_price = 0;
        }
        return $discounted_price;
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
