<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Promocode;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BookingsRepository extends BaseRepository
{
    protected $model;

    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

    public function get(Request $request)
    {
        $model = $this->model;

        if ($request->has('server_id')) {
            $model = $model->where('server_id', $request->server_id);
        }

        if ($request->has('year')) {
            $model = $model->whereYear('booking_time', '=', $request->year);
        }

        if ($request->has('customer_id')) {
            $model = $model->with('services')->where('customer_id', '=', $request->customer_id)->where('payment_status', '!=', 'cancelled');
        }

        if ($request->has('month')) {
            // return Booking::where('id', '=', 1)->get();
            $model = $model->whereMonth('booking_time', '=', $request->month);
        }

        $model = $model->with('services');

        return $model
            ->orderBy($request->input('orderBy', 'created_at'), $request->input('sort', 'desc'))
            ->get();
    }

    public function getSearchData(Request $request)
    {
        $model = $this->model;
        if ($request->has('server_id')) {
            $model = $model->where('server_id', $request->server_id);
        }
        if ($request->has('search')) {
            $search = request('search');
            $model = $model->with('customer')->with('server')
                ->whereHas('customer', function (Builder $query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('server', function (Builder $query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            return $model
                ->orderBy($request->input('orderBy', 'created_at'), $request->input('sort', 'desc'))
                ->get();
        } else {
            return $model
                ->orderBy($request->input('orderBy', 'created_at'), $request->input('sort', 'desc'))
                ->paginate($request->input('limit', 10));
        }
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
            'promocode_id' => isset($data['promocode_id']) ? $data['promocode_id'] : null,
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

        if (isset($attributes['promocode'])) {
            $promocode = Promocode::where('code', $attributes['promocode'])->first();
            if ($promocode) {
                $attributes['charge'] = $attributes['charge'] * ((100 - $promocode->discount) / 100);
                $attributes['promocode_id'] = $promocode->id;
            }
        }
        if (array_key_exists('promocode', $attributes)) {
            unset($attributes['promocode']);
        }
        return $attributes;
    }
}
