<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Facades\Validator;
use App\Models\Plant;
use DB;

class PlantImport implements ToCollection, WithHeadingRow,SkipsEmptyRows
{
    /**
    * @param Collection $collection
    */
    // public function model(array $row){
    //     return Plant::updateOrCreate([
    //         'name'=>$row['name']
    //     ]);
    // }
    public function collection(Collection $rows)
    {
         Validator::make($rows->toArray(), [
             '*.name' => 'required|unique:plants',
         ])->validate();

        foreach ($rows as $row) {
            Plant::create([
                'name' => $row['name'],
            ]);
        }
    }
}
