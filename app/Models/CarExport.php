<?php

namespace App\Models;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $cars;

    public function __construct($cars)
    {
        $this->cars = $cars;
    }

    public function collection()
    {
        return $this->cars;
    }
    public function headings(): array
    {
        return [
            'ID',
            'UserName',
            'License_plate',
            'Color',
            'Vin_Code',
            'Make',
            'Model',
            'Year',
        ];
    }
}
