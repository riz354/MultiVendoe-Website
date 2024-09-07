<?php

namespace App\Http\Controllers;

use App\DataTables\productAttributeDataTable;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    public function index(productAttributeDataTable $dataTable)
    {
        $data = [];
        return $dataTable->with($data)->render('admin.catalogue.product.attribute.create', $data);
    }


    public function create($id)
    {
        $product = Product::where('id',$id)->with('attributes')->first();
        $data = [
            'product' => $product,
        ];

        // dd(($product->getFirstMediaUrl('product_images')));

        return view('admin.catalogue.product.attribute.create', $data);
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
            }
        }


        if (isset($request->upload_video)) {
            $product->clearMediaCollection('product_video');

            $attachment = getFilePath($request->upload_video);
            if ($attachment) {

                $product->addMedia($attachment)->toMediaCollection('product_video');
            }
        }

        return redirect()->route('admin.catelogue.product.index')->with('success', 'Product Updated Successfully');
    }

    public function store(Request $request)
    {

        $rules = [
            'product_id' => 'required',
            'product_attribute.*.price' => 'required',
            'product_attribute.*.stock' => 'required',
            'product_attribute.*.size' => 'required|string',
            'product_attribute.*.sku' => 'required|unique:attributes,sku',
        ];

        $request->validate($rules);
        // dd($request->all());


       if(isset($request->product_attribute) && count($request->product_attribute) > 0){
        foreach($request->product_attribute as $attribute){
            $product = Attribute::updateOrCreate(
                [
                    'size' => $attribute['size'],
                ],
            [
                'product_id' => $request['product_id'],
                'price' => $attribute['price'],
                'stock' => $attribute['stock'],

                'sku' => $attribute['sku'],
                'status'=>1
            ]);

        }
       }


        return redirect()->route('admin.catelogue.product.attribute.add',['id'=>$request->product_id])->with('success', 'Product attrubute added Successfully');
    }

    public function delete($id)
    {

        $product =  Product::where('id', $id)->first();
        $product->delete();
        $product->clearMediaCollection('product_images');
        $product->clearMediaCollection('product_video');


        return redirect()->route('admin.catelogue.product.index')->with('success', 'Product deleted Successfully');
    }


}
