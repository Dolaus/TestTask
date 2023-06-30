<?php

namespace App\Http\Controllers\Cars;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarCollection;
use App\Http\Resources\ModelsCollection;
use App\Models\Makes;
use App\Models\Models;
use Illuminate\Http\Request;

class GetModelsByBrandFromDatabaseController extends BaseController
{
    public function __invoke($id)
    {
        $data = Makes::where('makes.Make_ID', '=', $id)
            ->join('models', 'makes.Make_ID', '=', 'models.Make_ID')
            ->get();

        return new ModelsCollection($data);
    }
}
