<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $model)
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
        if ($request->has('role')) {
            $model = $model->role($request->role);
        }
        return $model
            ->orderBy($request->input('orderBy', 'created_at'), $request->input('sort', 'desc'))
            ->get();
    }

    public function getOneList(Request $request, $id)
    {
        $model = $this->model;
        $model = $model->where('id', $id);
        return $model
            ->orderBy($request->input('orderBy', 'created_at'), $request->input('sort', 'desc'))
            ->get();
    }

    /**
     * get collection of users in paginate format.
     *
     * @return Collection of users
     */
    public function paginate(Request $request)
    {
        $model = $this->model;

        if ($request->has('role')) {
            $model = $model->role($request->role);
        }

        return $model
            ->orderBy($request->input('orderBy', 'created_at'), $request->input('sort', 'desc'))
            ->paginate($request->input('limit', 10));
    }

    /**
     * create new user record in database.
     *
     * @param Request $request Illuminate\Http\Request
     * @return saved user object with data.
     */
    public function store(Request $request)
    {
        $attributes = $this->setDataPayload($request);

        $user = $this->model;
        $user->fill($attributes);
        $user->save();

        if ($request->role == 'stylist') {
            $user->assignRole('stylist');
        } elseif ($request->role == 'art_director') {
            $user->assignRole('art_director');
        } else {
            $user->assignRole('customer');
        }

        return $user;
    }

    /**
     * set payload data for posts table.
     *
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        if (get_class($request) == Request::class) {
            $attributes = $request->all();
        } else {
            $attributes = $request->validated();
        }

        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($request->password);
        } else {
            $attributes['password'] = bcrypt("123456");
        }

        if (isset($attributes['avatar'])) {
            // $path = $attributes['avatar']->store('images');
            // Storage::setVisibility($path, 'public');
            $file = $request->file('avatar');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('images'), $imageName);
            $attributes['avatar_path'] = env('APP_URL')."/images/".$imageName;
            unset($attributes['avatar']);
        }

        return $attributes;
    }
}
