<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

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

        if($request->has('role')){
            $model = $model->role($request->role);
        }

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

        if($request->has('role')){
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
        $attributes['password'] = bcrypt($request->password);
        return $attributes;
    }
}
