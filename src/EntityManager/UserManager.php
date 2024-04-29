<?php

namespace App\Boutique\EntityManager;

use Motor\Mvc\Components\Debug;
use App\Boutique\Models\CodesPose as CP;
use App\Boutique\Models\Users as U;
use Motor\Mvc\Manager\CrudManager as CrudM; // Crud et un alias de CrudManager

class UserManager extends CrudM
{
    protected $data;

    public function __construct(?string $model = null, array|object $data = null, $config = null)
    {
        $this($model, $data, $config);
        // var_dump('model', $this->model);
        return $this;
    }

    public function run()
    {
        return $this;
    }
}
