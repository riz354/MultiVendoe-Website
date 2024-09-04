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

}
