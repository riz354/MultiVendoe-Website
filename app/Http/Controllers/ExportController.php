<?php

namespace App\Http\Controllers;

use App\Exports\BrandsXlExport;
use App\Exports\UsersExport;
use App\Jobs\GeneralExport;
use App\Jobs\GeneralExportXl;
use App\Models\Brand;
use Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportCSV(Request $request)
    {

        $file_name = $request->file_name;
        $file_type = $request->file_type;


        switch ($file_name) {
            case 'brands':
                $file_text = "Brands";
                $model = Brand::query()->select('id', 'name', 'status', 'created_at', 'updated_at');
                $headings = array_intersect_key(config('user-export.brands'), array_flip($request->headings));
                $headings = array_values($headings);
                break;
        };

        $title = $file_text . ' ' . 'File csv ready for donload';
        $description = $file_text . ' ' . 'File csv ready for donload';
        $detail = $file_text . ' ' . 'File csv ready for donload';

        $chunkSize = 2;
        $totalRecords = $model->count('id');
        $numberOfChunks = ceil($totalRecords / $chunkSize);

        $path = storage_path('app/public/export/' . $file_name . '.' . $file_type);
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $fp = fopen($path, 'w');
        fputcsv($fp, $headings);


        for ($i = 0; $i < $numberOfChunks; $i++) {
            $isLast = (int)$numberOfChunks - $i === 1 ? true : false;
            $batches[] =  GeneralExport::dispatch($model->skip($i * $chunkSize)->take($chunkSize)->orderByDesc('id')->get(), $path, $request->headings, $isLast, $file_name);
        }

        return [
            'status' => true,
            'message' => 'Please wait your file is exporting '
        ];

        // foreach ($batches as $batch) {
        //     dispatch_sync($batch);
        // }

        // // Return file download after jobs are complete
        // return response()->download($path);
    }



    // public function exportXl(Request $request)
    // {

    //     $file_name = $request->file_name;
    //     $file_type = $request->file_type;


    //     switch ($file_name) {
    //         case 'brands':
    //             $file_text = "Brands";
    //             $model = Brand::query()->select('id', 'name', 'status', 'created_at', 'updated_at');
    //             $headings = array_intersect_key(config('user-export.brands'), array_flip($request->headings));
    //             $headings = array_values($headings);
    //             break;
    //     };

    //     $title = $file_text . ' ' . 'File xlsx ready for donload';
    //     $description = $file_text . ' ' . 'File xlsx ready for donload';
    //     $detail = $file_text . ' ' . 'File xlsx ready for donload';

    //     $chunkSize = 2;
    //     $totalRecords = $model->count('id');
    //     $numberOfChunks = ceil($totalRecords / $chunkSize);

    //     $path = storage_path('app/public/export/xl/' . $file_name . '.' . $file_type);
    //     $directory = dirname($path);
    //     if (!is_dir($directory)) {
    //         mkdir($directory, 0755, true);
    //     }



    //     for ($i = 0; $i < $numberOfChunks; $i++) {
    //         $isLast = (int)$numberOfChunks-$i ===1 ?true :false;
    //         $batches[] =  GeneralExportXl::dispatch($model->skip($i*$chunkSize)->take($chunkSize)->orderByDesc('id')->get(),$path,$request->headings,$isLast,$file_name,$file_type);

    //     }

    //     return [
    //         'status'=>true,
    //         'message'=>'Please wait your file is exporting '
    //     ];


    // }



    public function exportXlBrands()
    {

        return  Excel::download(new BrandsXlExport, 'brands.xlsx');
    }

    public function exportXl(Request $request)
    {

        Excel::download(new BrandsXlExport, 'brands.xlsx');
        // $file_name = $request->file_name;
        // $file_type = $request->file_type;

        // switch ($file_name) {
        //     case 'brands':
        //         $file_text = "Brands";
        //         $model = Brand::query()->select('id', 'name', 'status', 'created_at', 'updated_at');
        //         $headings = array_intersect_key(config('user-export.brands'), array_flip($request->headings));
        //         $headings = array_values($headings);
        //         break;
        // }

        // $title = $file_text . ' File xlsx ready for download';
        // $description = $file_text . ' File xlsx ready for download';
        // $detail = $file_text . ' File xlsx ready for download';

        // $chunkSize = 1000;  // Adjusted chunk size for efficiency
        // $totalRecords = $model->count('id');
        // $numberOfChunks = ceil($totalRecords / $chunkSize);

        // $path = storage_path('app/public/export/xl/' . $file_name . '.' . $file_type);
        // $directory = dirname($path);
        // if (!is_dir($directory)) {
        //     mkdir($directory, 0755, true);
        // }

        // for ($i = 0; $i < $numberOfChunks; $i++) {
        //     $isLast = ($i + 1) === $numberOfChunks;  // Simplified last chunk check
        //     $batches[] = GeneralExportXl::dispatch(
        //         $model->skip($i * $chunkSize)
        //             ->take($chunkSize)
        //             ->orderByDesc('id')
        //             ->get(),
        //         $path,
        //         $request->headings,
        //         $isLast,
        //         $file_name,
        //         $file_type
        //     );
        // }

        // return [
        //     'status' => true,
        //     'message' => 'Please wait, your file is exporting.'
        // ];
    }
}
