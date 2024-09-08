<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class LiveHomePageController extends Controller
{
    public function index()
    {

        $sections = Section::where('status', 1)->with('category')->get();
        $featured_products = Product::where('status', 1)->orderBy('id', 'Desc')->limit(4)->get();

        // foreach ($featured_products as $p) {
        //     dd($p->getFirstMediaUrl('product_images'));
        // }
        // dd($featured_products);

        $data = [
            'sections' => $sections,
            'featured_products' => $featured_products

        ];
        return view('live.pages.index', $data);
    }
}
