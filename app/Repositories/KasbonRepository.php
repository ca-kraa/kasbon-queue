<?php

namespace App\Repositories;

use App\Models\Kasbon;
use Illuminate\Database\Eloquent\Builder;


class KasbonRepository
{
    protected $model;

    public function __construct(Kasbon $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function query(): Builder
    {
        return $this->model->query();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
