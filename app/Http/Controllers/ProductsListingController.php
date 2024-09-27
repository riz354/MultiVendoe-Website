<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsFilter;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductsListingController extends Controller
{
    public function productListing(Request $request, $category_url)
    {

        if ($request->ajax()) {
            // dd($request->all());


            $categoryCount = Category::where('url', $category_url)->count();
            if ($categoryCount > 0) {
                $categoryIds = Category::categoryDetails($category_url);
                $products = Product::whereIn('category_id', $categoryIds)->where('status', 1);

                if (isset($request->sort) && $request->sort == 'latest_product') {
                    $products = $products->orderby('id', 'Desc');
                }
                if (isset($request->sort) && $request->sort == 'lowest_product') {
                    $products = $products->orderby('product_price', 'asc');
                }
                if (isset($request->sort) && $request->sort == 'highest_product') {
                    $products = $products->orderby('product_price', 'Desc');
                }

                $products = $products->paginate(4);
                $data = [
                    'products' => $products,
                    'url' => $category_url
                ];
                return view('live.pages.listing-products', $data);
            } else {
                abort(404);
            }
        } else {

            $sections = Section::where('status', 1)->with('category')->get();
            $recent_products = Product::where('status', 1)->orderBy('id', 'Desc')->limit(4)->get();
            $featured_products = Product::where('status', 1)->where('is_featured', true)->inRandomOrder()->orderBy('id', 'Desc')->get();

            $categoryCount = Category::where('url', $category_url)->count();
            $category = Category::where('url', $category_url)->first();

            if ($categoryCount > 0) {
                $categoryIds = Category::categoryDetails($category_url);
                $products = Product::whereIn('category_id', $categoryIds)->where('status', 1);

                if (isset($request->sort) && $request->sort == 'latest_product') {
                    $products = $products->orderby('id', 'Desc');
                }
                if (isset($request->sort) && $request->sort == 'lowest_product') {
                    $products = $products->orderby('product_price', 'asc');
                }
                if (isset($request->sort) && $request->sort == 'highest_product') {
                    $products = $products->orderby('product_price', 'Desc');
                }

                $products = $products->paginate(4);
                $data = [
                    'products' => $products,
                    'sections' => $sections,
                    'recent_products' => $recent_products,
                    'featured_products' => $featured_products,
                    'url' => $category_url,
                    'products_filters'=>ProductsFilter::productsFilter(),
                    'category'=>$category
                ];
                // dd(ProductsFilter::productsFilter());
                return view('live.pages.product-listings', $data);
            } else {
                abort(404);
            }
        }
    }



    public function productDetail($id){
        $product = Product::with('attributes')->find($id);

        // dd($product);
        $data = [
            'product'=>$product
        ];
        return view('live.pages.product-detail',$data);
    }
}
