<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFilter extends Model
{
    use HasFactory;


    public function filter_values(){
        return $this->hasMany(ProductsFilterValue::class,'filter_id');
    }

    public static function productsFilter(){
        $productFilters = ProductsFilter::with('filter_values')->get();
        return $productFilters;
    }

    public static function filtersAvailable($filter_id,$catg_id){
        $filters = ProductsFilter::select('catg_ids')->where('id',$filter_id)->first();

        $cat_ids = json_decode($filters->catg_ids);

       if(in_array($catg_id,$cat_ids)){
        $available="yes";
       }else{
        $available='no';
       }

       return $available;
    }
}
