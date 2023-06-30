<?php

namespace App\Http\Controllers\Cars;

use App\Http\Controllers\Controller;
use App\Http\Service\CarsInterface;
use App\Http\Service\CarsService;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;

    public function __construct(CarsInterface $service)
    {
        $this->service=$service;
    }
}
