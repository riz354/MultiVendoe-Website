<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'status'
    ];

    public function category(){
        return $this->hasMany(Category::class,'section_id')->where(['parent_id'=>0,'status'=>1])->with('subcategories');
    }
}
