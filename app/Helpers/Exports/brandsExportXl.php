<?php

namespace App\Helpers\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class brandsExportXl implements ShouldQueue
{
    protected $data;
    protected $columns;

    public function __construct(Collection $data, array $columns)
    {
        $this->data = $data;
        $this->columns = $columns;
    }

    public function collection()
    {
        return $this->data; // Directly return the data passed to this class
    }

    public function headings(): array
    {
        return $this->columns; // Assuming the columns are the same as headings
    }

    public function map($row): array
    {
        // Assuming you want to export brand information along with related products
        $columnMap = [
            'name' => fn($row) => $row->name,
            'status' => fn($row) => $row->status,
            'created_at' => fn($row) => $row->created_at,
            'updated_at' => fn($row) => $row->updated_at,
        ];

        $data = [];
        foreach ($this->columns as $column) {
            if (isset($columnMap[$column])) {
                $data[] = $columnMap[$column]($row);
            }
        }

        return $data;
    }
}
