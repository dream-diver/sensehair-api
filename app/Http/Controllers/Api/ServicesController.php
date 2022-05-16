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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        } catch (\Exception $e) {
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
        $this->authorize('view', $service);

        return $this->respondOk(['service' => new ServiceResource($service)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
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

    public function addManyService()
    {
        $types = [
            "Wassen, knippen, stylen",
            "Wassen, knippen, drogen",
            "Wassen, föhnen, stylen",
            "Föhnen",
            "Kleuren/ verfen",
            "Uitgroei",
            "Highlights/lowlights",
            "Highlights/lowlights, half hoofd",
            "Balayage",
            "Moneypieces",
            "Bleken",
            "Keratine",
            "Olaplex en föhnen",
            "Olaplex",
            "Olaplex masker",
        ];

        $typesEn = [
            "Wash, cut, style",
            "Wash, cut, dry",
            "Wash, blow dry, style",
            "blow dry",
            "Coloring/painting",
            "Outgrowth",
            "highlights/lowlights",
            "Highlights/lowlights, half head",
            "Balayage",
            "Money Pieces",
            "Bleaching",
            "Keratin",
            "Olaplex and blow dry",
            "Olaplex",
            "Olaplex mask",
        ];
        $hairSizes = [
            "Women Short Hair",
            "Women Medium Hair",
            "Women Long Hair",
        ];
        $hairTypes = [
            "Straight",
            "Wavy",
            "Curly",
            "Coily",
        ];

        $durations = [

            $passes1 = [
                $pass1 = [
                    70,
                    50,
                    45,
                    30,

                    60,
                    45,
                    120,
                    90,
                    120,
                    45,
                    60,


                    150,
                    45,
                    30,
                    20,

                ],
                $pass2 = [
                    70,
                    50,
                    45,
                    30,


                    60,
                    45,
                    120,
                    90,
                    45,
                    120,
                    60,


                    150,
                    50,
                    30,
                    15,

                ],
                $pass3 = [
                    70,
                    50,
                    50,
                    30,


                    60,
                    45,
                    120,
                    90,
                    45,
                    120,
                    60,

                    150,
                    50,
                    30,
                    20,
                ],
                $pass4 = [
                    75,
                    50,
                    50,
                    30,

                    60,
                    50,
                    130,
                    90,
                    120,
                    45,
                    60,


                    150,
                    50,
                    30,
                    20,

                ],
            ],
            $passes2 = [
                $pass1 = [
                    75,
                    50,
                    45,
                    30,


                    60,
                    45,
                    135,
                    90,
                    120,
                    45,
                    60,


                    150,
                    50,
                    30,
                    20,


                ],
                $pass2 = [
                    75,
                    60,
                    50,
                    35,


                    60,
                    45,
                    135,
                    105,
                    45,
                    120,
                    90,


                    150,
                    50,
                    30,
                    20,


                ],
                $pass3 = [
                    80,
                    60,
                    60,
                    40,


                    60,
                    45,
                    135,
                    105,
                    45,
                    120,
                    90,


                    150,
                    55,
                    30,
                    15,

                ],
                $pass4 = [
                    85,
                    60,
                    60,
                    40,


                    60,
                    45,
                    140,
                    110,
                    130,
                    45,
                    105,


                    155,
                    60,
                    40,
                    20,
                ],
            ],
            $passes3 = [
                $pass1 = [
                    85,
                    60,
                    55,
                    40,


                    70,
                    50,
                    150,
                    105,
                    135,
                    45,
                    75,


                    160,
                    55,
                    40,
                    25,


                ],
                $pass2 = [
                    85,
                    60,
                    55,
                    4,


                    70,
                    50,
                    150,
                    105,
                    45,
                    135,
                    75,


                    160,
                    55,
                    40,
                    25,


                ],
                $pass3 = [
                    90,
                    70,
                    70,
                    45,


                    70,
                    55,
                    150,
                    120,
                    45,
                    135,
                    75,


                    160,
                    55,
                    45,
                    25,

                ],
                $pass4 = [
                    95,
                    70,
                    70,
                    45,


                    70,
                    55,
                    150,
                    120,
                    135,
                    45,
                    75,


                    160,
                    55,
                    45,
                    25,


                ],
            ],

        ];

        $stylistPrices = [
            $passes1 = [
                $pass1 = [
                    69.5,
                    54.5,
                    49.5,
                    29.5,
                    65,
                    49.5,
                    95,
                    85,
                    120,
                    59.5,
                    99,
                    180,
                    52.5,
                    37.5,
                    14.5,
                ],
                $pass2 = [
                    69.5,
                    59.5,
                    54.5,
                    34.5,


                    65,
                    49.5,
                    95,
                    85,
                    59.5,
                    120,
                    99,


                    180,
                    52.5,
                    37.5,
                    14.5,

                ],
                $pass3 = [
                    69.5,
                    54.5,
                    59.5,
                    34.5,


                    65,
                    49.5,
                    95,
                    85,
                    59.5,
                    120,
                    100,


                    185,
                    52.5,
                    37.5,
                    14.5,

                ],
                $pass4 = [
                    74.5,
                    54.5,
                    64.5,
                    34.5,


                    65,
                    49.5,
                    100,
                    90,
                    125,
                    59.5,
                    105,


                    190,
                    52.5,
                    42.5,
                    14.5,

                ]
            ],
            $passes2 = [
                $pass1 = [
                    74.5,
                    59.5,
                    54.5,
                    34.5,


                    70,
                    49.5,
                    100,
                    90,
                    125,
                    59.5,
                    105,


                    185,
                    52.5,
                    42.5,
                    15.5,

                ],
                $pass2 = [
                    74.5,
                    59.5,
                    54.5,
                    39.5,


                    70,
                    49.5,
                    100,
                    90,
                    59.5,
                    125,
                    105,


                    185,
                    57.5,
                    42.5,
                    15.5,


                ],
                $pass3 = [
                    79.5,
                    59.5,
                    64.5,
                    39.5,


                    70,
                    54.5,
                    100,
                    90,
                    59.5,
                    130,
                    110,


                    190,
                    57.5,
                    47.5,
                    19.5,


                ],
                $pass4 = [
                    84.5,
                    64.5,
                    69.5,
                    39.5,


                    70,
                    59.5,
                    110,
                    100,
                    135,
                    59.5,
                    115,


                    195,
                    62.5,
                    47.5,
                    19.5,
                ]
            ],
            $passes3 = [
                $pass1 = [
                    84.5,
                    64.5,
                    54.5,
                    39.5,


                    75,
                    49.5,
                    105,
                    95,
                    130,
                    64.5,
                    110,


                    190,
                    57.5,
                    47.5,
                    16.5,


                ],
                $pass2 = [
                    84.5,
                    64.5,
                    59.5,
                    44.5,


                    75,
                    49.5,
                    105,
                    95,
                    59.5,
                    130,
                    110,


                    190,
                    62.5,
                    47.5,
                    16.5,


                ],
                $pass3 = [
                    89.5,
                    64.5,
                    69.5,
                    44.5,


                    75,
                    54.5,
                    105,
                    95,
                    59.5,
                    135,
                    115,


                    195,
                    62.5,
                    47.5,
                    19.5,


                ],
                $pass4 = [
                    94.5,
                    69.5,
                    74.5,
                    44.5,


                    75,
                    54.5,
                    115,
                    105,
                    140,
                    59.5,
                    120,


                    200,
                    67.5,
                    54.5,
                    24.5,

                ]
            ]
        ];

        $dirPrices = [
            $passes1 = [
                $pass1 = [
                    84.5,
                    69.5,
                    64.5,
                    44.5,


                    80,
                    64.5,
                    135,
                    125,
                    135,
                    74.5,
                    120,


                    195,
                    67.5,
                    52.5,
                    29.5,
                ],
                $pass2 = [
                    84.5,
                    74.5,
                    69.5,
                    49.5,


                    80,
                    64.5,
                    135,
                    125,
                    74.5,
                    160,
                    120,


                    195,
                    67.5,
                    52.5,
                    29.5,

                ],
                $pass3 = [
                    84.5,
                    69.5,
                    74.5,
                    49.5,


                    80,
                    64.5,
                    135,
                    125,
                    64.5,
                    160,
                    120,


                    200,
                    67.5,
                    52.5,
                    29.5,

                ],
                $pass4 = [
                    89.5,
                    69.5,
                    79.5,
                    49.5,


                    80,
                    64.5,
                    140,
                    130,
                    165,
                    74.5,
                    120,


                    205,
                    67.5,
                    57.5,
                    29.5,

                ]
            ],
            $passes2 = [
                $pass1 = [
                    89.5,
                    74.5,
                    69.5,
                    49.5,


                    85,
                    64.5,
                    140,
                    130,
                    165,
                    74.5,
                    145,


                    215,
                    67.5,
                    57.5,
                    30.5,

                ],
                $pass2 = [
                    89.5,
                    74.5,
                    69.5,
                    54.5,


                    85,
                    64.5,
                    140,
                    130,
                    74.5,
                    165,
                    145,


                    215,
                    72.5,
                    57.5,
                    30.5,


                ],
                $pass3 = [
                    94.5,
                    74.5,
                    79.5,
                    54.5,


                    85,
                    69.5,
                    140,
                    130,
                    74.5,
                    170,
                    150,


                    220,
                    72.5,
                    62.5,
                    34.5,


                ],
                $pass4 = [
                    99.5,
                    79.5,
                    84.5,
                    54.5,


                    85,
                    74.5,
                    150,
                    140,
                    175,
                    74.5,
                    155,


                    225,
                    72.5,
                    62.5,
                    34.5,
                ]
            ],
            $passes3 = [
                $pass1 = [
                    99.5,
                    79.5,
                    69.5,
                    54.5,
                    
                    90,
                    64.5,
                    145,
                    135,
                    145,
                    79.5,
                    150,
                    
                    
                    220,
                    72.5,
                    62.5,
                    31.5,
                    

                ],
                $pass2 = [
                    99.5,
                    79.5,
                    74.5,
                    59.5,
                    
                    
                    90,
                    64.5,
                    145,
                    135,
                    74.5,
                    170,
                    150,
                    
                    
                    205,
                    77.5,
                    62.5,
                    31.5,
                    

                ],
                $pass3 = [
                    104.5,
                    79.5,
                    84.5,
                    58.5,
                    
                    
                    90,
                    69.5,
                    145,
                    135,
                    74.5,
                    175,
                    155,
                    
                    
                    225,
                    77.5,
                    62.5,
                    34.5,
                    


                ],
                $pass4 = [
                    109.5,
                    84.5,
                    89.5,
                    59.5,
                    
                    
                    90,
                    69.5,
                    155,
                    145,
                    180,
                    74.5,
                    160,
                    
                    
                    225,
                    82.5,
                    69.5,
                    39.5,
                    
                ]
            ],
        ];

        for ($i = 0; $i < count($hairSizes); $i++) {
            $hairSize = $hairSizes[$i];
            for ($typeIndex = 0; $typeIndex < 4; $typeIndex++) {
                $hairType = $hairTypes[$typeIndex];
                for ($index = 0; $index < 15; $index++) {
                    $service = new Service();
                    $service->name = $types[$index];
                    $service->name_en = $typesEn[$index];
                    $service->duration = $durations[$i][$typeIndex][$index];
                    $service->stylist_price = $stylistPrices[$i][$typeIndex][$index];
                    $service->art_director_price = $dirPrices[$i][$typeIndex][$index];
                    $service->hair_size = $hairSize;
                    $service->hair_type = $hairType;
                    $service->save();
                }
            }
        }
    }
}
