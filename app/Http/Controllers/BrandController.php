<?php

namespace App\Http\Controllers;

use App\DataTables\BrandDataTable;
use App\Events\BrandCreated;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(BrandDataTable $dataTable)
    {
        $data = [];

        return $dataTable->with($data)->render('admin.catalogue.brand.index', $data);
    }


    public function create()
    {
        $data = [
            'sections' => Brand::all(),
        ];

        return view('admin.catalogue.brand.create', $data);
    }


    public function edit($id)
    {
        $brand =  Brand::where('id', $id)->first();


        $data = [
            'brand' => Brand::where('id', $id)->first(),


        ];



        return view('admin.catalogue.brand.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $brand =  Brand::where('id', $id)->first();
        $rules = [
            'name' => 'required',
            'status' => 'required',

        ];
        $request->validate($rules);
        $section = Brand::where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status,



        ]);


        return redirect()->route('admin.catelogue.brand.index')->with('success', 'Brand Updated Successfully');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $rules = [
            'name' => 'required',
            'status' => 'required',

        ];

        $request->validate($rules);
        $category = Brand::create([
            'name' => $request->name,
            'status' => $request->status,

        ]);


        $data = [
            'name'=>$request->name,
            'status'=>$request->status,
        ];


        event(new BrandCreated($data));




        return redirect()->route('admin.catelogue.brand.index')->with('success', 'Brand Created Successfully');
    }

    public function delete($id)
    {

        $brand =  Brand::where('id', $id)->first();
        $brand->delete();


        return redirect()->route('admin.catelogue.brand.index')->with('success', 'Brand deleted Successfully');
    }



}
