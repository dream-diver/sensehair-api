<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromocodeStoreRequest;
use App\Http\Requests\PromocodeUpdateRequest;
use App\Http\Resources\PromocodeResource;
use App\Models\Promocode;
use App\Repositories\PromocodesRepository;
use App\Util\HandleResponse;
use Illuminate\Http\Request;

class PromocodesController extends Controller
{
    use HandleResponse;

    protected $repository;

    public function __construct(PromocodesRepository $promocodesRepository)
    {
        $this->repository = $promocodesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', App\Models\Promocode::class);

        if($request->limit == 'all') {
            $promocodes = $this->repository->get($request);
        } else {
            $promocodes = $this->repository->paginate($request);
        }

        return PromocodeResource::collection($promocodes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromocodeStoreRequest $request)
    {
        $this->authorize('create', App\Models\Promocode::class);

        try {
            $promocode = $this->repository->store($request);
            return $this->respondCreated(['promocode' => new PromocodeResource($promocode)]);
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function show(Promocode $promocode)
    {
        $this->authorize('view', $promocode);

        return $this->respondOk(['promocode' => new PromocodeResource($promocode)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function update(PromocodeUpdateRequest $request, Promocode $promocode)
    {
        $this->authorize('update', $promocode);

        try {
            $promocode = $this->repository->update($promocode, $request);
            return $this->respondOk(['promocode' => new PromocodeResource($promocode)]);
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promocode $promocode)
    {
        $this->authorize('delete', $promocode);

        try {
            $this->repository->delete($promocode);
            return $this->respondNoContent();
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }
}
