<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

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
            'sections' => Section::all(),
            'brands' =>Brand::all(),
        ];

        return view('admin.catalogue.product.create', $data);
    }


    public function edit($id)
    {
        $product =  Product::where('id', $id)->first();
        $products =  Product::all();

        $attachments = $product->getMedia('file');
        // dd($attachments);
        $data = [
            'product' => Product::where('id', $id)->first(),
            'attachments' => $product->getMedia('file'),
            'sections' => Section::all(),
            'products'=>$products

        ];



        return view('admin.catalogue.product.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $product =  Product::where('id', $id)->first();
        $rules = [
            'category_name' => 'required',
            'category_discount' => 'required',
            'description' => 'required',
            'url' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'status' => 'required',
            'section_id' => 'required',
            'parent_id' => 'required'
        ];
        $request->validate($rules);
        $section = Product::where('id', $id)->update([
            'category_name' => $request->category_name,
            'category_discount' => $request->category_discount,
            'description' => $request->description,
            'url' => $request->url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->status,
            'section_id' => $request->section_id,
            'parent_id' => $request->parent_id,

        ]);

        if ($request->has('file')) {
            $product->clearMediaCollection('file');
            for ($i = 0; $i < count($request->file); $i++) {
                $attachmentPath = getFilePath($request->file[$i]);
                if (file_exists($attachmentPath)) {
                    $product->addMedia($attachmentPath)->toMediaCollection('file');
                }
                // changeImageDirectoryPermission();
            }
        }

        return redirect()->route('admin.catelogue.product.index')->with('success', 'Product Updated Successfully');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $rules = [
            'category_name' => 'required',
            'category_discount' => 'required',
            'description' => 'required',
            'url' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'status' => 'required',
            'section_id' => 'required',
            'parent_id' => 'required'

        ];

        $request->validate($rules);
        $category = Product::create([
            'category_name' => $request->category_name,
            'category_discount' => $request->category_discount,
            'description' => $request->description,
            'url' => $request->url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->status,
            'section_id' => $request->section_id,
            'parent_id' => $request->parent_id,
        ]);



        // if (isset($request->file)) {
        //         $attachment = getFilePath($request->file);
        //         if ($attachment) {
        //             $category->addMedia($attachment)->toMediaCollection('applicant_cv');
        //         }
        //         // $returnValue = changeImageDirectoryPermission();

        // }

        if ($request->has('file')) {
            for ($i = 0; $i < count($request->file); $i++) {
                $attachmentPath = getFilePath($request->file[$i]);
                if (file_exists($attachmentPath)) {
                    $category->addMedia($attachmentPath)->toMediaCollection('file');
                }
                // changeImageDirectoryPermission();
            }
        }



        return redirect()->route('admin.catelogue.product.index')->with('success', 'Product Created Successfully');
    }

    public function delete($id)
    {

        $category =  Product::where('id', $id)->first();
        $category->delete();
        $category->clearMediaCollection('file');

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
}
