<?php

namespace App\Admin\Repositories;

use App\Models\Ad as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Ad extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
