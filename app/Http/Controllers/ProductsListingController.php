<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductsListingController extends Controller
{
    public function productListing($category_url){


        $sections = Section::where('status', 1)->with('category')->get();
        $recent_products = Product::where('status', 1)->orderBy('id', 'Desc')->limit(4)->get();
        $featured_products = Product::where('status', 1)->where('is_featured',true)->inRandomOrder()->orderBy('id', 'Desc')->get();

       $categoryCount = Category::where('url',$category_url)->count();
      if($categoryCount > 0 ){
        $categoryIds = Category::categoryDetails($category_url);
        $products = Product::whereIn('category_id',$categoryIds)->paginate(1);
        $data = [
            'products'=>$products,
            'sections' => $sections,
            'recent_products' => $recent_products,
            'featured_products' => $featured_products,
        ];
        return view('live.pages.product-listings',$data);
      }else{
        abort(404);
      }

    }
}
