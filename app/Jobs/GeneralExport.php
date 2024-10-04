<?php

namespace App\Jobs;

use App\Helpers\Exports\brandsExport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class GeneralExport implements ShouldQueue
{
    use Queueable,Dispatchable;
    public $tries = 1;
    /**
     * Create a new job instance.
     */
    public function __construct(public Collection $data, public string $path , public array $columns , public bool $isLast=false, public string $fileName)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        switch ($this->fileName){
            case 'brands':
                new brandsExport($this->data,$this->path,$this->columns,$this->isLast);
                break;
        }

    }
}
