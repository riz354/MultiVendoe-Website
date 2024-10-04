<?php

namespace App\Imports;

use App\Models\TempBrand;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Validators\ValidationException as ExcelValidationException;

class BrandsImport implements ToCollection,SkipsEmptyRows,WithChunkReading,WithHeadingRow,WithValidation
{
    /**
     * @param Collection $collection
     */
    use Importable, RemembersRowNumber;
    public  $currentRowNUmber = 1;


    public function collection(Collection $rows)
    {
        $allfailures = [];
        $failures = [];
        foreach ($rows as $row) {
            ++$this->currentRowNUmber;
            $failures = [];
            $name = $row['name'];
            $status = $row['status'];
            if(!empty($failures)){
                $allfailures = array_merge($allfailures,$failures);
            }else{
                TempBrand::create([
                    'name'=>$row['name'],
                    'status'=>$row['status']
                ]);
            }
        }
        if (!empty($allFailures)) {
            throw new ExcelValidationException(
                ValidationException::withMessages(['errors' => $allFailures]),
                $allFailures
            );
        }

    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'status' => ['required']

        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
