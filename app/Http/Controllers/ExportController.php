<?php

namespace App\Http\Controllers;

use App\Jobs\GeneralExport;
use App\Models\Brand;
use Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function exportCSV(Request $request)
    {

        $file_name = $request->file_name;
        $file_type = $request->file_type;


        switch ($file_name) {
            case 'brands':
                $file_text = "Brands";
                $model = Brand::select('id', 'name', 'status', 'created_at', 'updated_at')->get();
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
            $isLast = (int)$numberOfChunks-$i ===1 ?true :false;
            new GeneralExport($model->skip($i*$chunkSize)->take($chunkSize)->orderBy('id','desc')->get(),$path,$request->headings,$isLast,$file_name);
        }

        return [
            'status'=>true,
            'message'=>'Please wait your file is exporting '
        ];
        dd($headings);
    }
}
