<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        $data = [];

        return $dataTable->with($data)->render('admin.catalogue.product.index', $data);
    }


    public function create()
    {
        $data = [
            'sections' => Section::with('category')->get(),
            'brands' => Brand::all(),
        ];

        // dd(Section::with('category')->get());

        return view('admin.catalogue.product.create', $data);
    }


    public function edit($id)
    {
        $product =  Product::where('id', $id)->first();
        $products =  Product::all();


        $data = [
            'product' => Product::where('id', $id)->first(),
            'product_images' => $product->getMedia('product_images'),
            'product_video' => $product->getMedia('product_video'),
            'sections' => Section::all(),
            'products' => $products,
            'brands' => Brand::all(),


        ];

        // dd($product->getMedia('product_video'));



        return view('admin.catalogue.product.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $product =  Product::where('id', $id)->first();
        $rules = [
            'product_name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_code' => 'required',
            'product_color' => 'required',
            'product_price' => 'required',
            'product_discount' => 'required',
            'product_weight' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'upload_image' => 'required',
            'upload_video' => 'required',
        ];
        $request->validate($rules);
        $categoryDetails = Category::where('id', $request->category_id)->first();
        $auth = Auth::guard('admin')->user();
        $section = Product::where('id', $id)->update([
            'section_id' => $categoryDetails->section_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'vendor_id' => $auth->vendor_id,
            'admin_id' => $auth->id,
            'admin_type' => $auth->type,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_color' => $request->product_color,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_weight' => $request->product_weight,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => json_encode(explode(',', $request->meta_keywords)),
            'status' => $request->status,
            'is_featured' => $request->is_featured,

        ]);



        if ($request->has('upload_image')) {
            $product->clearMediaCollection('product_images');
            for ($i = 0; $i < count($request->upload_image); $i++) {
                $attachmentPath = getFilePath($request->upload_image[$i]);
                if (file_exists($attachmentPath)) {

                    $product->addMedia($attachmentPath)->toMediaCollection('product_images');
                } else {
                    dd('path not found');
                }
                changeImageDirectoryPermission();
            }
        }


        if (isset($request->upload_video)) {
            $product->clearMediaCollection('product_video');

            $attachment = getFilePath($request->upload_video);
            if ($attachment) {

                $product->addMedia($attachment)->toMediaCollection('product_video');
            }
            changeImageDirectoryPermission();
        }

        return redirect()->route('admin.catelogue.product.index')->with('success', 'Product Updated Successfully');
    }

    public function store(Request $request)
    {




        // dd($request->all());
        $rules = [
            'product_name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_code' => 'required',
            'product_color' => 'required',
            'product_price' => 'required',
            'product_discount' => 'required',
            'product_weight' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'upload_image' => 'required',
            'upload_video' => 'required',
        ];

        $request->validate($rules);

        $categoryDetails = Category::where('id', $request->category_id)->first();
        $auth = Auth::guard('admin')->user();


        $product = Product::create([
            'section_id' => $categoryDetails->section_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'vendor_id' => $auth->vendor_id,
            'admin_id' => $auth->id,
            'admin_type' => $auth->type,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_color' => $request->product_color,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_weight' => $request->product_weight,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => json_encode(explode(',', $request->meta_keywords)),
            'status' => $request->status,
            'is_featured' => $request->is_featured,

        ]);



        if ($request->has('upload_image')) {

            for ($i = 0; $i < count($request->upload_image); $i++) {
                $attachmentPath = getFilePath($request->upload_image[$i]);
                if (file_exists($attachmentPath)) {

                    $product->addMedia($attachmentPath)->toMediaCollection('product_images');
                } else {
                    dd('path not found');
                }
                changeImageDirectoryPermission();
            }
        }


        if (isset($request->upload_video)) {
            $attachment = getFilePath($request->upload_video);
            if ($attachment) {
                $product->addMedia($attachment)->toMediaCollection('product_video');
            }
            changeImageDirectoryPermission();
        }



        // if (isset($inputs['attachment']) && count($inputs['attachment']) > 0) {
        //     for ($i = 0; $i < count($inputs['attachment']); $i++) {
        //         $attachmentPath = getFilePath($inputs['attachment'][$i]);

        //         if (file_exists($attachmentPath)) {
        //             $dealer_incentive->addMedia($attachmentPath)->toMediaCollection('dealer_attachments');
        //         }
        //         changeImageDirectoryPermission();
        //     }
        // }



        return redirect()->route('admin.catelogue.product.index')->with('success', 'Product Created Successfully');
    }

    public function delete($id)
    {

        $product =  Product::where('id', $id)->first();
        $product->delete();
        $product->clearMediaCollection('product_images');
        $product->clearMediaCollection('product_video');


        return redirect()->route('admin.catelogue.product.index')->with('success', 'Product deleted Successfully');
    }


    public function appendCategories(Request $request)
    {

        // try {
        $categories = Category::where('section_id', $request->section_id)->where('parent_id', 0)->get();
        // dd($categories);
        $data = [
            'categories' => $categories
        ];
        $view = view('admin.catalogue.product.append-categories', $data)->render();
        return response()->json([
            'success' => true,
            'view' => $view

        ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'success' => false,


        //     ]);
        // }
    }




    public function addToCart(Request $request)
    {
        $cart = Cart::updateOrCreate(
            [
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
            ],
            [
                'size' => $request->size,
                'quantity' => $request->quantity
            ]
        );

        return redirect()->route('cart')->with('success', 'product add successfully');
    }

    public function Cart()
    {

        $data = [
            'products' => Cart::with('product')->where('user_id', Auth::id())->get(),
        ];


        return view('live.pages.cart', $data);
    }

    public function checkout()
    {

        $data = [
            'products' => Cart::with('product')->where('user_id', Auth::id())->get(),
        ];


        return view('live.pages.checkout', $data);
    }


    public function placeOrder(Request $request)
    {

        if ($request->payment == "cod") {
            $product = Product::where('id', $request->product_id)->first();
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'grand_total' => $request->total_price,
                'payment_gateway' => $request->payment,
            ]);
            $order_product = OrdersProduct::create([
                'order_id' => $order->id,
                'user_id' => Auth::user()->id,
                'vendor_id' => $product->vendor_id,
            ]);

            dd($request->all());

            return redirect()->route('cart')->with('success', 'Ordered successfully');
        }else if($request->payment == "paypal"){
            return redirect()->route('paypal',['total'=>$request->total_price]);
        }
    }
}
