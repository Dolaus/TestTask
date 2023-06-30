<?php

namespace App\Http\Controllers\Cars;


use App\Http\Controllers\Controller;
use App\Http\Requests\Request\StoreRequest;


use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data=$request->validated();
        return $this->service->CreateCar($data);
    }
}
