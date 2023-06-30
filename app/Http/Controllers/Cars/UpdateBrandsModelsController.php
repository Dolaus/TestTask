<?php

namespace App\Http\Controllers\Cars;

use App\Http\Controllers\Controller;
use App\Models\Makes;
use App\Models\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpdateBrandsModelsController extends Controller
{
    public function __invoke()
    {

       $url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json';
       $response = Http::get($url);
       if ($response->successful()) {
           $response_data = $response->json();
           $results = $response_data['Results'];
           foreach ($results as $item){
               Makes::firstOrCreate(['Make_ID'=>$item['Make_ID']],$item);
           }
            $ALLMAKES= Makes::all();
            foreach ($ALLMAKES as $item){
                $urlmakes = 'https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeId/'.$item['Make_ID'].'?format=json';
                $responsemakes = Http::get($urlmakes);
                if ($responsemakes->successful()){
                    usleep(100000);
                    $response_makes_data = $responsemakes->json();
                    $array= $response_makes_data['Results'];
                    foreach ($array as $itemmodel){
                        Models::create([
                            'Model_Name'=>$itemmodel['Model_Name'],
                            'Model_ID'=>$itemmodel['Model_ID'],
                            'Make_ID'=>$item['Make_ID']
                        ]);
                    }
                    return response()->json(['success' => 'Database Updated'], 201);
                }
            }

        }
        return response()->json(['Error' => 'Database NOtUpdated'], 500);

    }
}
