<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'parent_id',
        'section_id',
        'category_name',
        'category_discount',
        'description',
        'url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];


    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function subcategories() {
        return $this->hasMany(Category::class, 'parent_id')->where('status',1);
    }


    public static function categoryDetails($category_url) {
        $category = Category::select('id','category_name','url')->where('url',$category_url)->with('subcategories')->first();
        $main_category_id = [$category->id];
        $sub_category_ids = $category->subcategories->pluck('id')->toArray();

        $ids = array_merge($main_category_id,$sub_category_ids);
        return $ids;

    }


}
