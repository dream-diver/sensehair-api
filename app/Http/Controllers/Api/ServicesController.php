<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Repositories\ServicesRepository;
use App\Util\HandleResponse;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class ServicesController extends Controller
{
    use HandleResponse;

    protected $repository;

    public function __construct(ServicesRepository $servicesRepository)
    {
        $this->repository = $servicesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', App\Models\Service::class);

        $services = $this->repository->paginate($request);

        return ServiceResource::collection($services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request)
    {
        $this->authorize('create', App\Models\Service::class);

        try {
            $service = $this->repository->store($request);
            return $this->respondCreated(['service' => new ServiceResource($service)]);
        } catch (Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
