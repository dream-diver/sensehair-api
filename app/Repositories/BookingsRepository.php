<?php
namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingsRepository extends BaseRepository
{
    protected $model;

    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

    /**
     * create new Booking in database.
     *
     * @param Request $request Illuminate\Http\Request
     * @return saved Booking object with data.
     */
    public function store(Request $request)
    {
        $data = $this->setDataPayload($request);

        $booking = $this->model;
        $booking->fill([
            'booking_time' => $data['booking_time'],
            'charge' => $data['charge'],
            'duration' => $data['duration'],
            'customer_id' => $data['customer_id'],
            'server_id' => $data['server_id'],
            'stripe_client_secret' => isset($data['stripe_client_secret']) ? $data['stripe_client_secret'] : null,
            'stripe_id' => isset($data['stripe_id']) ? $data['stripe_id'] : null,
        ]);
        $booking->save();

        $booking->services()->sync($data['services']);

        return $booking;
    }

    public function update(Model $item, Request $request)
    {
        $data = $this->setDataPayload($request);

        $item->services()->sync($data['services']);
        unset($data['services']);

        $item->update($data);
        $item->save();

        return $item;
    }

    /**
     * set data for saving
     *
     * @param  Request $request Illuminate\Http\Request
     * @return array of data.
     */
    protected function setDataPayload(Request $request)
    {
        if (get_class($request) == Request::class) {
            $attributes = $request->all();
        } else {
            $attributes = $request->validated();
        }
        return $attributes;
    }
}
