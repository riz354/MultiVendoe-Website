<?php

use Carbon\Carbon;
use App\Models\Bank;
use App\Models\Team;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use App\Models\Floor;
use App\Models\Receipt;
use Twilio\Rest\Client;
use App\Jobs\SendSmsJob;
use App\Models\SalesPlan;
use App\Models\UserBatch;
use App\Models\FileAction;
use App\Models\LeadSource;
use App\Models\AccountHead;
use App\Models\ImportImage;
use App\Models\Procurement;
use App\Models\SmsTracking;
use App\Models\Stakeholder;
use Illuminate\Support\Str;
use App\Models\LeaveRequest;
use App\Models\AccountAction;
use App\Models\AccountLedger;
use App\Models\FileSignature;
use App\Models\AdditionalCost;
use App\Models\CompanyHoliday;
use App\Models\FileManagement;
use App\Models\MaterialReturn;
use App\Models\UserAttendance;
use App\Models\ItemProcurement;
use App\Models\HrmConfiguration;
use App\Models\SiteConfigration;
use Spatie\Permission\Models\Role;
use App\Models\MaterialConsumption;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use App\Models\CommunicationChannel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\{Collection};
use App\Models\SalesPlanInstallments;
use Illuminate\Support\Facades\Crypt;
use App\Models\AccountingStartingCode;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProcurementConfiguration;
use App\Mail\AllCommunicationChannelMail;
use App\Models\CommunicationChannelAction;
use App\Models\EmailCommunicationTemplate;
use App\Models\SmsCommunicationsTemplates;
use App\Lifetimesms\Facades\LifetimesmsFacade;
use App\Models\CommunicationChannelNotification;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Response;

if (!function_exists('getFileUploadId')) {
    function getFileUploadId()
    {
        $uniqid = uniqid();
        $import = ImportImage::create([
            'uniqid' => $uniqid,
        ]);

        return $import->id;
    }
}

if (!function_exists('uploadFilePatch')) {
    function uploadFilePatch($request)
    {
        $id = $request->get('patch');
        $id = Str::before($id, '<link');
        $dir = public_path('app-assets/images/temporaryfiles/');

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        // get chunk data
        $offset = $request->header('Upload-Offset');
        $length = $request->header('Upload-Length');
        // should be numeric values, else exit
        if (!is_numeric($offset) || !is_numeric($length)) {
            return apiErrorResponse();
        }
        // exec('chmod -R 0775 ' . $dir);
        // write chunk file for this request
        file_put_contents($dir . $id . '.' . '.chunk.' . $offset, fopen('php://input', 'rb'));
        // calculate total size of chunks
        $size = 0;
        $chunk = glob($dir . $id . '.' . '.chunk.*');
        foreach ($chunk as $filename) {
            $size += filesize($filename);
        }
        // if total size equals length of file we have gathered all chunk files
        if ($size == $length) {

            $file = $request->header('upload-name');
            $ext = File::extension($file);
            $name = str_replace($ext, '', Str::replace(' ', '_', File::basename($file)));
            $ext = Str::endsWith($name, '.') ? $ext : '.' . $ext;
            $name = $name . $ext;
            $imageimport = ImportImage::find($id);
            $imageimport->name = $name;
            $imageimport->save();
            // create output file
            $file_handle = fopen($dir . $name, 'wb');

            // write chunkes to file
            foreach ($chunk as $filename) {
                // get offset from filename
                [$dir, $offset] = explode('.chunk.', $filename, 2);
                // read chunk and close
                $chunk_handle = fopen($filename, 'rb');
                $chunk_contents = fread($chunk_handle, filesize($filename));
                fclose($chunk_handle);

                // apply chunk
                fseek($file_handle, $offset);
                fwrite($file_handle, $chunk_contents);
            }
            // remove chunkes
            foreach ($chunk as $filename) {
                unlink($filename);
            }
            // done with file
            fclose($file_handle);


            return apiSuccessResponse($imageimport);

            return Response::make($imageimport, 204);
        }

        // return $size;
        return apiSuccessResponse($size);

        return Response::make('chunk uploaded' . $size, 204);
    }
}

// revert File Upload
if (!function_exists('revertFileUpload')) {
    function revertFileUpload($request)
    {
        $id = $request->getContent();
        $id = Str::before($id, '<link');

        $imageimport = ImportImage::find($id);
        $dir = public_path('app-assets/images/temporaryfiles/');
        $file = $dir . $imageimport->name;
        $test = File::delete($file);
        $imageimport->delete();

        return $test;
    }
}

// get server uploaded file path
if (!function_exists('getFilePath')) {
    function getFilePath($attachment)
    {
        $id = Str::before($attachment, '<link');
        $imageimport = ImportImage::find($id);
        if (!$imageimport) {
            return false;
        }
        if (File::exists(public_path('app-assets/images/temporaryfiles/') . $imageimport->name)) {
            return public_path('app-assets/images/temporaryfiles/') . $imageimport->name;
        } else {
            return false;
        }
    }
}



if (!function_exists('apiErrorResponse')) {
    function apiErrorResponse($message = 'data not found', $key = 'error')
    {
        return response()->json(
            [
                'status' => false,
                'message' => [
                    $key => $message,
                ],
                'data' => null,
                'stauts_code' => '200',
            ],
            200
        );
    }
}


if (!function_exists('apiSuccessResponse')) {
    function apiSuccessResponse($data = null, $message = 'data found', $key = 'success')
    {
        return response()->json(
            [
                'status' => true,
                'message' => [
                    $key => $message,
                ],
                'data' => $data,
                'stauts_code' => '200',
            ],
            200
        );
    }
}
