<?php

namespace App\Http\Controllers\Cars;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Termwind\Components\Dd;
use function Symfony\Component\Translation\t;

class IndexController extends BaseController
{
        public function __invoke(Request $request)
        {
            $result = $this->service->filterAndSortCars($request);
            return $result;
        }
}
