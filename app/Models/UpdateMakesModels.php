<?php

namespace App\Models;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;



class UpdateMakesModels extends Command
{
    protected $signature = 'brands:models:update';
    protected $description = 'Update brands and models from external API';

    public function handle()
    {
        $url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json';
        $response = Http::get($url);

        if ($response->successful()) {
            $response_data = $response->json();
            $results = $response_data['Results'];

            foreach ($results as $item) {
                Makes::updateOrCreate(['Make_ID' => $item['Make_ID']], $item);
            }

            $ALLMAKES = Makes::all();

            foreach ($ALLMAKES as $item) {
                $urlmakes = 'https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeId/' . $item['Make_ID'] . '?format=json';
                $responsemakes = Http::get($urlmakes);

                if ($responsemakes->successful()) {
                    usleep(100000);
                    $response_makes_data = $responsemakes->json();
                    $array = $response_makes_data['Results'];

                    foreach ($array as $itemmodel) {
                        Models::updateOrCreate([
                            'Model_Name' => $itemmodel['Model_Name'],
                            'Model_ID' => $itemmodel['Model_ID'],
                            'Make_ID' => $item['Make_ID']
                        ]);
                    }
                }
            }

            $this->info('Brands and models updated successfully.');
        } else {
            $this->error('Failed to fetch data from the external API.');
        }
    }
}
