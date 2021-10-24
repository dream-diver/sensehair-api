<?php
namespace App\Repositories;

use App\Models\Service;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ServicesRepository extends BaseRepository
{
    protected $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    /**
     * create new Service in database.
     *
     * @param Request $request Illuminate\Http\Request
     * @return saved Service object with data.
     */
    public function store(Request $request)
    {
        $data = $this->setDataPayload($request);

        $service = $this->model;
        $service->fill([
            'name' => $data['name'],
            'price' => $data['price'],
            'duration' => $data['duration'],
        ]);
        $service->save();

        foreach($request->stylists as $stylist) {
            $service->users()->attach($stylist['id'], ['stylist_charge' => $stylist['stylist_charge']]);
        }

        return $service;
    }

    public function update(Model $item, Request $request)
    {
        $data = $this->setDataPayload($request);

        $item->fill([
            'name' => $data['name'],
            'price' => $data['price'],
            'duration' => $data['duration'],
        ]);
        $item->save();

        $stylistArray = [];
        foreach($request->stylists as $stylist) {
            $stylistArray[$stylist['id']] = ['stylist_charge' => $stylist['stylist_charge']];
        }
        $item->users()->sync($stylistArray);

        return $item;
    }
}
