<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesRepository extends BaseRepository
{
    protected $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    /**
     * get all the items collection from database table using model.
     *
     * @return Collection of items.
     */
    public function get(Request $request)
    {
        $model = $this->model;

        if ($request->has('hair_size')) {
            $model = $model->where('hair_size', '=', $request->hair_size);
        }

        if ($request->has('hair_type')) {
            $model = $model->where('hair_type', '=', $request->hair_type);
        }

        if ($request->has('group_by')) {
            // dd("error");
            return $model
                ->get();
        }

        return $model
            ->orderBy($request->input('orderBy', 'created_at'), $request->input('sort', 'desc'))
            ->get();
    }

    /**
     * get collection of items in paginate format.
     *
     * @return Collection of items.
     */
    public function paginate(Request $request)
    {
        $model = $this->model;

        if ($request->has('hair_size')) {
            $model = $model->where('hair_size', $request->hair_size);
        }

        if ($request->has('hair_type')) {
            $model = $model->where('hair_type', $request->hair_type);
        }

        return $model
            ->orderBy($request->input('orderBy', 'created_at'), $request->input('sort', 'desc'))
            ->paginate($request->input('limit', 10));
    }
}
