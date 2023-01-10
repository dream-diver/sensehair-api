<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Repositories\ServicesRepository;
use App\Util\HandleResponse;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    use HandleResponse;

    protected $repository;

    public function __construct(ServicesRepository $servicesRepository)
    {
        $this->repository = $servicesRepository;
        $this->middleware('auth:sanctum')->except('index', 'addManyService');
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', App\Models\Service::class);

        if ($request->limit == 'all') {
            $services = $this->repository->get($request);
        } else {
            $services = $this->repository->paginate($request);
        }

        return ServiceResource::collection($services);
    }

    public function store(Request $request)
    {
        $this->authorize('create', App\Models\Service::class);

        try {
            $service = new Service();
            $service->name = $request->name;
            $service->name_en = $request->name_en;
            $service->duration = $request->duration; // in minutes

            $service->stylist_price = $request->stylist_price;
            $service->art_director_price = $request->art_director_price;

            $service->hair_size = $request->hair_size;
            $service->hair_size_nl = $request->hair_size_nl;
            $service->hair_type = $request->hair_type;
            $service->hair_type_nl = $request->hair_type_nl;

            $service->category = $request->category;
            $service->category_en = $request->category_en;
            $service->save();
            // $service = $this->repository->store($request);
            return $this->respondCreated(['service' => new ServiceResource($service)]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    public function show(Service $service)
    {
        $this->authorize('view', $service);
        return $this->respondOk(['service' => new ServiceResource($service)]);
    }

    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $this->authorize('update', $service);

        try {
            $service = $this->repository->update($service, $request);
            return $this->respondOk(['service' => new ServiceResource($service)]);
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        try {
            $this->repository->delete($service);
            return $this->respondNoContent();
        } catch (\Exception $e) {
            return $this->respondServerError(['message' => $e->getMessage()]);
        }
    }
}
