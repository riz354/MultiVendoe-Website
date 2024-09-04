<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SectionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(SectionDataTable $dataTable)
    {
        $data = [];

        return $dataTable->with($data)->render('admin.catalogue.section.index', $data);
    }


    public function create()
    {
        $data = [

        ];

        return view('admin.catalogue.section.create', $data);
    }


    public function edit($id )
    {
        $data = [
            'section'=>Section::where('id',$id)->first(),
        ];

        return view('admin.catalogue.section.edit', $data);
    }

    public function update(Request $request, $id )
    {

        $rules = [
            'name' => 'required',
            'status' => 'required',

        ];
        $request->validate($rules);
        $section = Section::where('id',$id)->update([
            'name'=>$request->name,
            'status'=>$request->status,
        ]);

        return redirect()->route('admin.catelogue.section.index')->with('success','Section Updated Successfully');
    }

    public function store(Request $request)
    {

        $rules = [
            'name' => 'required',
            'status' => 'required',

        ];
        $request->validate($rules);
        $section = Section::create([
            'name'=>$request->name,
            'status'=>$request->status,
        ]);

        return redirect()->route('admin.catelogue.section.index')->with('success','Section Created Successfully');
    }

    public function delete($id)
    {

       Section::where('id',$id)->delete();

        return redirect()->route('admin.catelogue.section.index')->with('success','Section deleted Successfully');
    }
}
