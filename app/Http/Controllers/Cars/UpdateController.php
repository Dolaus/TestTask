<?php

namespace App\Http\Controllers\Cars;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\StoreRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpdateController extends BaseController
{
    public function __invoke(StoreRequest $request, $id)
    {

        $car = Car::findOrFail($id);

        $data= $request->validated();

        if ($data['vin_code']!=$car['vin_code']) {

            $carInfo = $this->service->getCarInfoFromVIN($data['vin_code']);

            if ($carInfo !== null) {
                $data['model'] = $carInfo['model'];
                $data['make'] = $carInfo['make'];
                $data['year'] = $carInfo['year'];

                if ($data['model']==null|| $data['make']==null||$data['year']==null){
                    return response()->json(['error' => 'Cannot find information about this vin'], 500);
                }
                $this->service->UpdatedCar($car,$data);
                return response()->json(['message' => 'Updated'], 200);
            } else {
                return response()->json(['error' => 'Not information about car with this vin'], 500);
            }
        }
        $data['model'] = $car['model'];
        $data['make'] = $car['make'];
        $data['year'] = $car['year'];
        $this->service->UpdatedCar($car,$data);
        return response()->json(['message' => 'Updated'], 200);



    }
}
