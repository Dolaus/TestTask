<?php

namespace App\Http\Service;



use App\Http\Resources\CarCollection;
use App\Http\Resources\CarsResource;
use App\Models\Car;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class CarsService implements CarsInterface
{
    public  function  UpdatedCar($car,$data){
         $car->userName = $data['userName'];
         $car->license_plate = $data['license_plate'];
         $car->color = $data['color'];
         $car->vin_code = $data['vin_code'];
         $car->make = $data['make'];
         $car->model = $data['model'];
         $car->year = $data['year'];
        $car->save();
    }


    public function getCarInfoFromVIN($vin)
    {
        $url = 'https://vpic.nhtsa.dot.gov/api/vehicles/decodevinvalues/' . $vin . '?format=json';
        $response = Http::get($url);

        if ($response->successful()) {
            $response_data = $response->json();
            $model = data_get($response_data, 'Results.0.Model');
            $make = data_get($response_data, 'Results.0.Make');
            $year = data_get($response_data, 'Results.0.ModelYear');

            return [
                'model' => $model,
                'make' => $make,
                'year' => $year
            ];
        } else {
            return null;
        }
    }

    public function CreateCar($data)
    {
        $url = 'https://vpic.nhtsa.dot.gov/api/vehicles/decodevinvalues/' . $data['vin_code'] . '?format=json';
        $response = Http::get($url);

        if ($response->successful()) {
            $response_data = $response->json();
            $data['model'] = data_get($response_data, 'Results.0.Model');
            $data['make'] = data_get($response_data, 'Results.0.Make');
            $data['year'] = data_get($response_data, 'Results.0.ModelYear');

            if ($data['model']==null|| $data['make']==null||$data['year']==null){
                return response()->json(['error' => 'Cannot find information about this vin'], 500);}
            return new CarsResource(Car::firstOrCreate(['vin_code' => $data['vin_code']], $data));
        } else {
            return response()->json(['error' => 'HTTP Error: ' . $response->status()], 500);
        }
    }

    public function DeleteCar($id){
        $car = Car::findOrFail($id);
        $car->delete();
    }

    public function filterAndSortCars($request)
    {
        $brand = $request->get('brand');
        $model = $request->get('model');
        $year = $request->get('year');
        $search = $request->get('search');
        $sortField = $request->get('sort_field');
        $sortOrder = $request->get('sort_order');
        $perPage = $request->get('per_page', 10);
        Session::put('brand', $brand);

        Session::put('model', $model);

        Session::put('year', $year);


        Session::put('search', $search);

        Session::put('sort_field', $sortField);

        Session::put('sort_order', $sortOrder);

        Session::put('per_page', $perPage);
        $query = $this->buildBaseQuery($brand, $model, $year, $search);
        $query = $this->applySorting($query, $sortField, $sortOrder);

        return new CarCollection($query->paginate($perPage));
    }

    private function buildBaseQuery($brand, $model, $year, $search)
    {
        $query = Car::query();

        if ($brand != null) {
            $query->where('make', $brand);
        }

        if ($model != null) {
            $query->where('model', $model);
        }

        if ($year != null) {
            $query->where('year', $year);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('userName', 'LIKE', "%$search%")
                    ->orWhere('license_plate', 'LIKE', "%$search%")
                    ->orWhere('vin_code', 'LIKE', "%$search%");
            });
        }

        return $query;
    }

    private function applySorting($query, $sortField, $sortOrder)
    {
        if (!empty($sortField)) {
            switch ($sortField) {
                case 'userName':
                    $query->orderBy('userName', $sortOrder);
                    break;
                case 'license_plate':
                    $query->orderBy('license_plate', $sortOrder);
                    break;
                case 'color':
                    $query->orderBy('color', $sortOrder);
                    break;
                case 'vin_code':
                    $query->orderBy('vin_code', $sortOrder);
                    break;
                case 'make':
                    $query->orderBy('make', $sortOrder);
                    break;
                case 'model':
                    $query->orderBy('model', $sortOrder);
                    break;
                case 'year':
                    $query->orderBy('year', $sortOrder);
                    break;
                default:
                    break;
            }
        }

        return $query;
    }
    public function FilterCarsExport($brandFilter,$modelFilter,$yearFilter ,$searchQuery,$sortField ,$sortOrder ){
        $query = $this->buildBaseQuery($brandFilter, $modelFilter, $yearFilter, $searchQuery);
        $query = $this->applySorting($query, $sortField, $sortOrder);

        return $query->get();
    }
}
