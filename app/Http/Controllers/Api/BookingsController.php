<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Notifications\BookingCreatedNotification;
use App\Repositories\BookingsRepository;
use App\Util\HandleResponse;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    use HandleResponse;

    protected $repository;

    public function __construct(BookingsRepository $bookingsRepository)
    {
        $this->repository = $bookingsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', App\Models\Booking::class);

        if($request->limit == 'all') {
            $bookings = $this->repository->get($request);
        } else {
            $bookings = $this->repository->paginate($request);
        }

        return BookingResource::collection($bookings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingStoreRequest $request)
    {
        $this->authorize('create', App\Models\Booking::class);

        try {
            $booking = $this->repository->store($request);
            auth()->user()->notify(new BookingCreatedNotification($booking));
            return $this->respondCreated(['booking' => new BookingResource($booking)]);
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->services;

        return $this->respondOk(['booking' => new BookingResource($booking)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        try {
            $booking = $this->repository->update($booking, $request);
            return $this->respondOk(['booking' => new BookingResource($booking)]);
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);

        try {
            $this->repository->delete($booking);
            return $this->respondNoContent();
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }
}
