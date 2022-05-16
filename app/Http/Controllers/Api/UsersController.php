<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UsersRepository;
use App\Util\HandleResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    use HandleResponse;

    protected $repository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->repository = $usersRepository;
        $this->middleware('auth:sanctum')->except('index');
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', App\Models\User::class);
        if ($request->limit == 'all') {
            $users = $this->repository->get($request);
        } else {
            $users = $this->repository->paginate($request);
        }
        return UserResource::collection($users);
    }

    /**
     * Store a newly created user
     *
     * @param  App\Http\Requests\UserStoreRequest  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', App\Models\User::class);
        // try {
        //     $file = $request->file('avatar');

        //     $imageName = $file->getClientOriginalName();
        //     $file->move(public_path('images'), $imageName);
        // } catch (\Throwable $th) {

        // }
        try {

            $user = $this->repository->store($request);
            return $this->respondCreated(['user' => new UserResource($user)]);
            // return response()->json( ['user' => new UserResource($user)], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return $this->respondOk(['user' => new UserResource($user)]);
    }

    /**
     * Update the specified user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        try {
            $user = $this->repository->update($user, $request);
            return $this->respondOk(['user' => new UserResource($user)]);
        } catch (Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        try {
            $this->repository->delete($user);
            return $this->respondNoContent();
        } catch (Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }
}
