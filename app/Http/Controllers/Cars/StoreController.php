<?php

namespace App\Http\Controllers\Cars;


use App\Http\Controllers\Controller;
use App\Http\Requests\Request\StoreRequest;


use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


/**
 * @OA\POST(
 *     path="/api/v1/cars",
 *     summary="Create",
 *     tags={"CARS"},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="userName", type="string", example="Petro"),
 *                     @OA\Property(property="license_plate", type="string", example="AT4637BC"),
 *                     @OA\Property(property="color", type="string", example="red"),
 *                     @OA\Property(property="vin_code", type="string", example="3FA6P0VP1HR282209")
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="OK",
 *         @OA\JsonContent(
 *               @OA\Property (property="data",type="object",
 *                   @OA\Property(property="id", type="integer", example="1"),
 *                   @OA\Property(property="userName", type="string", example="Petro"),
 *                   @OA\Property(property="license_plate", type="string", example="AT4637BC"),
 *                   @OA\Property(property="color", type="string", example="red"),
 *                   @OA\Property(property="vin_code", type="string", example="3FA6P0VP1HR282209"),
 *                   @OA\Property(property="make", type="string", example="FORD"),
 *                   @OA\Property(property="model", type="string", example="Fusion"),
 *                   @OA\Property(property="year", type="integer", example=2017),
 *              ),
 *         ),
 *     ),
 * ),
 */
class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data=$request->validated();
        return $this->service->CreateCar($data);
    }
}
