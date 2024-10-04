<?php

namespace App\Jobs;

use App\Models\Brand;
use App\Models\TempBrand;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class importBrandsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            // Process data in chunks to avoid memory issues
            TempBrand::chunk(100, function ($tempData) {
                foreach ($tempData as $data) {

                    $name = $data->name;
                    $status = $data->status;


                    // Log::info($late);

                    Brand::updateOrCreate(
                        [
                            'name' => $name,
                            'status' => $status,

                        ],

                    );
                }
            });

            TempBrand::truncate();
        });
    }
}
