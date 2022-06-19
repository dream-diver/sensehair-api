<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\App;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // if(App::environment('local')){
        //     Service::factory()->count(25)->create();
        // }
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
            "Ladies Short",
            "Ladies Midlong",
            "Ladies Long",
        ];

        $hairSizesNL = [
            "Dames Kort",
            "Dames Halflang",
            "Dames Lang",
        ];
        $hairTypes = [
            "Straight",
            "Wavy",
            "Curly",
            "Coily",
        ];

        $hairTypesNL = [
            "Steil",
            "Golvend",
            "Krullend",
            "Kroes",
        ];

        $cats = [
            "Knippen en stylen",
            "Kleuren",
            "Intensieve verzorging",
        ];

        $catsEn = [
            "Cut and style",
            "Colors",
            "Intensive care",
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
                    $cat = $cats[2];
                    $catEn = $catsEn[2];

                    if ($index < 4) {
                        $cat = $cats[0];
                        $catEn = $catsEn[0];
                    }

                    if (3 < $index && $index < 11) {
                        $cat = $cats[1];
                        $catEn = $catsEn[1];
                    }

                    $service = new Service();
                    $service->name = $types[$index];
                    $service->name_en = $typesEn[$index];
                    $service->duration = $durations[$i][$typeIndex][$index];
                    $service->stylist_price = $stylistPrices[$i][$typeIndex][$index];
                    $service->art_director_price = $dirPrices[$i][$typeIndex][$index];
                    $service->hair_size = $hairSize;
                    $service->hair_size_nl = $hairSizesNL[$i];
                    $service->hair_type = $hairType;
                    $service->hair_type_nl = $hairTypesNL[$typeIndex];

                    $service->category = $cat;
                    $service->category_en = $catEn;
                    $service->save();
                }
            }
        }

        $menTypes = [
            "Wassen, knippen, drogen",
            "Baard modeleren",
            "Kleuren",
            "Uitgroei",
            "Baard kleuren",
            "Relaxen",
        ];

        $menTypesEn = [
            "Wash, cut, dry",
            "Beard modeling",
            "Colors",
            "Outgrowth",
            "Beard colors",
            "Relax",
        ];

        $catsMen = [
            "Knippen en stylen",
            "Kleuren",
            "Ontspan",
        ];
        $catsMenEn = [
            "Cut and style",
            "Colors",
            "Relax",
        ];

        $durationsMen = [
            30,
            15,
            35,
            30,
            10,
            30,
        ];
        $stylist = [
            34.5,
            15,
            36.5,
            31.5,
            19.5,
            34.5,
        ];
        $directors = [
            49.5,
            30,
            51.5,
            46.5,
            34.5,
            49.5,
        ];

        for ($index=0; $index <  count($menTypes); $index++) {
            $cat = $catsMen[2]; 
            $catEn = $catsMenEn[2];
            
            if ($index < 2) {
                $cat = $catsMen[0]; 
                $catEn = $catsMenEn[0];
            }
            
            if (1 < $index && $index < 5) {
                $cat = $catsMen[1]; 
                $catEn = $catsMenEn[1];
            }
            
            $service = new Service();
            $service->name = $menTypes[$index];
            $service->name_en = $menTypesEn[$index];
            $service->duration = $durationsMen[$index];
            $service->stylist_price = $stylist[$index];
            $service->art_director_price = $directors[$index];
            $service->hair_size = "Men";
            $service->hair_size_nl = "Heren";

            $service->category = $cat;
            $service->category_en = $catEn;
            $service->save();
        }

        $service = new Service();
        $service->name = "Service to test Payment";
        $service->name_en = "Service to test Payment";
        $service->duration = 10;
        $service->stylist_price = 1;
        $service->art_director_price = 1;
        $service->hair_size = "Men";
        $service->hair_size_nl = "Heren";

        $service->category = "Knippen en stylen";
        $service->category_en = "Cut and style";
        $service->save();
    }
}
