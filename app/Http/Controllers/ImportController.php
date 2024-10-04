<?php

namespace App\Http\Controllers;

use App\DataTables\TempBrandDataTable;
use App\Imports\BrandsImport;
use App\Jobs\importBrandsJob;
use App\Models\Brand;
use App\Models\TempBrand;
use Exception;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Redirect;

class ImportController extends Controller
{
    public function sampleDownload()
    {
        $path = storage_path('app/public/import/brand.xlsx');
        return response()->download($path);
    }


    public function previewFile(Request $request)
    {
        try {
            $model = new TempBrand();
            if ($request->hasFile('attachment')) {
                $request->validate([
                    'attachment' => 'required|mimes:xlsx',
                ]);
                TempBrand::query()->truncate();
                $import = new BrandsImport($model->getFillable());
                $import->import($request->file('attachment'));
                return redirect()->route('import.storeBrandPreview');
            } else {
                return redirect()->route('admin.catelogue.brand.index')->with('error', 'plaese select file');
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $error) {
            if (count($error->failures()) > 0) {
                $data = [
                    'errorData' => $error->failures(),
                ];
                return Redirect::back()->with(['data' => $error->failures()]);
            };
        }
    }



    public function storeBrandPreview()
    {

        $model = new TempBrand();
        if($model->count() ==0){
            return redirect()->route('admin.catelogue.brand.index')->with('error', 'NO record found');

        }else{
            $dataTable =new TempBrandDataTable();
            $data = [

            ];
            return $dataTable->with($data)->render('admin.catalogue.brand.import-preview');

        }
    }


    public function saveImport(){
        try {
            importBrandsJob::dispatch();
            return redirect()->route('admin.catelogue.brand.index')->withSuccess(_('Import successfully'));
        } catch (Exception $ex) {
            FacadesLog::error($ex->getLine() . ' Message => ' . $ex->getMessage());
            return redirect()->route('admin.catelogue.brand.index')->withDanger($ex->getMessage());
        }
    }
}
