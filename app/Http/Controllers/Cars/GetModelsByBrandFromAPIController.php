<?php

namespace App\Http\Controllers\Cars;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModelsCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Http;

class GetModelsByBrandFromAPIController extends BaseController
{
    public function __invoke($id)
    {

        $url = 'https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeId/'.$id.'?format=json';
        $response = Http::get($url);
        if ($response->successful()) {
            $response_data = $response->json();
            $data = $response_data["Results"];

            return $data;
        }
        return response()->json(['Error' => 'Database NOtUpdated'], 500);
    }
}
