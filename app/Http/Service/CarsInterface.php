<?php

namespace App\Http\Service;

use App\Http\Resources\CarCollection;
use App\Models\Car;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

interface CarsInterface
{
    public  function  UpdatedCar($car,$data);

    public function getCarInfoFromVIN($vin);

    public function CreateCar($data);
    public function DeleteCar($id);

    public function filterAndSortCars($request);

    public function FilterCarsExport($brandFilter,$modelFilter,$yearFilter ,$searchQuery,$sortField ,$sortOrder );
}
