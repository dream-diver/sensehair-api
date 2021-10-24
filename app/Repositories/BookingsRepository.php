<?php
namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
            'name' => $data['name'],
        ]);
        $booking->save();

        return $booking;
    }

    public function update(Model $item, Request $request)
    {
        $data = $this->setDataPayload($request);

        $item->fill([
            'name' => $data['name'],
        ]);
        $item->save();

        return $item;
    }
}
