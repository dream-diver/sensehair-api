<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromocodeResource;
use App\Models\Promocode;
use App\Util\HandleResponse;
use Illuminate\Http\Request;

class PromocodeDetailsFromCodeController extends Controller
{
    use HandleResponse;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(String $code, Request $request)
    {
        $promocode = Promocode::where('code', $code)->whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now())->first();

        if(!$promocode) {
            return $this->respondNotFound(['message' => 'Promocode Does not exist.']);
        }

        return new PromocodeResource($promocode);
    }
}
