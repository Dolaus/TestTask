<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "userName"=> $this->userName,
            "license_plate"=> $this->license_plate,
            "color"=> $this->color,
            "vin_code"=> $this->vin_code,
            "make"=> $this->make,
            "model"=> $this->model,
            "year"=> $this->year,
        ];

    }
}

