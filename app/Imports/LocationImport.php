<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Facades\Validator;
use App\Models\LocationMaster;
use Illuminate\Http\Request;

class LocationImport implements ToCollection, WithHeadingRow,SkipsEmptyRows
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection(Collection $rows)
    {
        try {
            Validator::make($rows->toArray(), [
                '*.location' => 'required|unique:location_masters',
            ])->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed, store the errors
            $this->importErrors = $e->errors();
            return;
        }

        $location_type = $this->request->input('location_type');

        foreach ($rows as $row) {
            LocationMaster::create([
                'type' => $location_type,
                'location' => $row['location'],
            ]);
        }
    }
}
