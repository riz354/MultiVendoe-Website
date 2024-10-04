<?php

namespace App\Helpers\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class brandsExport implements ShouldQueue
{
    public function __construct(public Collection $data, public string $file, public array $columns, public bool $isLast)
    {
        $this->exportCsv();
    }

    public function exportCsv(): bool
    {
        $fp = fopen($this->file, "a+");
        if ($fp == false) {
            throw new \RuntimeException("Failed to open file for writing: {$this->file}");
        }


        foreach ($this->data as $row) {
            fputcsv($fp, $this->getColumnsData($row));
        }

        if ($this->isLast)
            fclose($fp);
        return true;
    }


    public function getColumnsData($row):array
    {

        $columnMap = [
            'name'=>fn($row)=>$row->name,
            'status'=>fn($row)=>$row->status,
            'created_at'=>fn($row)=>$row->created_at,
            'updated_at'=>fn($row)=>$row->updated_at,
        ];

        $data = [];
        foreach($this->columns as $column){
            if(isset($columnMap[$column])){
                $data[] =$columnMap[$column]($row);
            }
        }

        return $data;

    }
}
