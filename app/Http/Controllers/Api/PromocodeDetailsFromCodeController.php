<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromocodeResource;
use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeDetailsFromCodeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(String $code, Request $request)
    {
        $promocode = Promocode::where('code', $code)->first();

        return new PromocodeResource($promocode);
    }
}
