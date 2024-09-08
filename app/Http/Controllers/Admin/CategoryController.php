<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        $data = [];

        return $dataTable->with($data)->render('admin.catalogue.categories.index', $data);
    }


    public function create()
    {
        $data = [
            'sections' => Section::all(),
        ];

        return view('admin.catalogue.categories.create', $data);
    }


    public function edit($id)
    {
        $category =  Category::where('id', $id)->first();
        $categories =  Category::all();

        $attachments = $category->getMedia('file');
        // dd($attachments);
        $data = [
            'category' => Category::where('id', $id)->first(),
            'attachments' => $category->getMedia('file'),
            'sections' => Section::all(),
            'categories'=>$categories

        ];



        return view('admin.catalogue.categories.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $category =  Category::where('id', $id)->first();
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
        $section = Category::where('id', $id)->update([
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
            $category->clearMediaCollection('categories');
            for ($i = 0; $i < count($request->file); $i++) {
                $attachmentPath = getFilePath($request->file[$i]);
                if (file_exists($attachmentPath)) {
                    $category->addMedia($attachmentPath)->toMediaCollection('categories');
                }
                // changeImageDirectoryPermission();
            }
        }

        return redirect()->route('admin.catelogue.categories.index')->with('success', 'Categories Updated Successfully');
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
        $category = Category::create([
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
                    $category->addMedia($attachmentPath)->toMediaCollection('categories');
                }
                // changeImageDirectoryPermission();
            }
        }



        return redirect()->route('admin.catelogue.categories.index')->with('success', 'Categories Created Successfully');
    }

    public function delete($id)
    {

        $category =  Category::where('id', $id)->first();
        $category->delete();
        $category->clearMediaCollection('categories');

        return redirect()->route('admin.catelogue.categories.index')->with('success', 'Categories deleted Successfully');
    }


    public function appendCategories(Request $request)
    {

        // try {
        $categories = Category::where('section_id', $request->section_id)->where('parent_id', 0)->get();
        // dd($categories);
        $data = [
            'categories' => $categories
        ];
        $view = view('admin.catalogue.categories.append-categories', $data)->render();
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
