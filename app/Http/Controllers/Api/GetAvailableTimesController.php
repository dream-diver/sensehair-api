<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Services\StoreService;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\OpeningHours\OpeningHours;
use Spatie\OpeningHours\Time;

class GetAvailableTimesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        $storeService = new StoreService();

        return $storeService->getAvailableTimesOfAServer($user, $request->date, $request->duration);
    }
}
