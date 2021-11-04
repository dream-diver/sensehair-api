<?php
namespace App\Repositories;

use App\Models\Promocode;
use App\Repositories\BaseRepository;

class PromocodesRepository extends BaseRepository
{
    protected $model;

    public function __construct(Promocode $model)
    {
        $this->model = $model;
    }
}
