<?php

namespace App\Http\Controllers\Cars;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class DestroyController extends BaseController
{
    public function __invoke($id)
    {
        $this->service->DeleteCar($id);
        return response()->json(['message' => 'Car deleted'], 200);
    }
}
