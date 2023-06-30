<?php

namespace App\Http\Controllers\Cars;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarCollection;
use App\Models\Car;
use App\Models\CarExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends BaseController
{
    public function __invoke()
    {
        $brandFilter = Session::get('brand');
        $modelFilter = Session::get('model');
        $yearFilter = Session::get('year');
        $searchQuery = Session::get('search');
        $sortField = Session::get('sort_field');
        $sortOrder = Session::get('sort_order');
        $cars = $this->service->FilterCarsExport($brandFilter,$modelFilter,$yearFilter ,$searchQuery,$sortField ,$sortOrder );

        return Excel::download(new CarExport($cars), 'cars.xlsx');
    }
}
