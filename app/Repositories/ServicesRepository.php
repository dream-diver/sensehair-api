<?php
namespace App\Repositories;

use App\Models\Service;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ServicesRepository extends BaseRepository
{
    protected $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }
}
