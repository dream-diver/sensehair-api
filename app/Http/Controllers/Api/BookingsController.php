<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Http\Resources\BookingResource;
use App\Mail\BookingSuccessful;
use App\Models\Booking;
use App\Notifications\BookingCreatedNotification;
use App\Repositories\BookingsRepository;
use App\Util\HandleResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Dotunj\LaraTwilio\Facades\LaraTwilio;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;

class BookingsController extends Controller
{
    use HandleResponse;

    protected $repository;

    public function __construct(BookingsRepository $bookingsRepository)
    {
        $this->repository = $bookingsRepository;
    }


    public function index(Request $request)
    {
        $this->authorize('viewAny', App\Models\Booking::class);

        if ($request->limit == 'all') {
            $bookings = $this->repository->get($request);
        } else {
            $bookings = $this->repository->getSearchData($request);
        }

        return BookingResource::collection($bookings);
    }

    public function store(BookingStoreRequest $request)
    {
        $this->authorize('create', App\Models\Booking::class);
        try {
            $booking = $this->repository->store($request);
            $email = auth()->user()->email;
            $title = "Booking Successful!";
            $body = "You have an appointment with Sense Hair on " . $booking->booking_time->toDateString() . " at " . $booking->booking_time->format('H:i') . " at Central Plaza 12. See you there!";
            
            if ($request->sendEmailAndSms == true) {
                try {
                    Mail::to($email)->send(new BookingSuccessful($body, $title));
                    LaraTwilio::notify(auth()->user()->phone, $body);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
        return $this->respondCreated(['booking' => new BookingResource($booking)]);
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->services;

        return $this->respondOk(['booking' => new BookingResource($booking)]);
    }

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

    public function cancel(Request $request)
    {
        $booking = Booking::where('id',$request->booking_id)->with('customer')->first();
        try {
            $booking->payment_status = "cancelled";
            $booking->save();
            $title = "Booking Cancelled!";
            $body = "Your appointment with Sense Hair on " . $booking->booking_time->toDateString() . " at " . $booking->booking_time->format('H:i') . " at Central Plaza 12. has been cancelled!";
            Mail::to($booking->customer->email)->send(new BookingSuccessful($body, $title));
            LaraTwilio::notify($booking->customer->phone, $body);
            return $this->respondOk(['message' => "Booking cancelled successfully!"]);
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    public function testMail(Request $request)
    {
        $booking = Booking::first();
        $email = $request->email;
        $title = "Booking Successful!";
        $body = "You have an appointment with Sense Hair on " . $booking->booking_time->toDateString() . " at " . $booking->booking_time->format('H:i') . " at Central Plaza 12. See you there!";
        Mail::to($email)->send(new BookingSuccessful($body, $title));
        return $body;

        // LaraTwilio::notify($request->phone, $body);
    }
}
