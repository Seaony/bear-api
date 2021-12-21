<?php

namespace App\Admin\Repositories;

use App\Models\Egg as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Egg extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
