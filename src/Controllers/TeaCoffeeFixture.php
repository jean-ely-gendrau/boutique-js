<?php

namespace App\Boutique\Controllers;

use App\Boutique\EntityManager\FixtureManager;
use App\Boutique\Models\Users;
use Motor\Mvc\Components\Debug;
use Motor\Mvc\Builder\FormBuilder;
use App\Boutique\EntityManager\UserManager;
use App\Boutique\Models\CodesPose as CP;
use App\Boutique\Models\Users as U;

class TeaCoffeeFixture
{
    public function IndexFixture(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render $render */
        $render = $arguments['render'];

        $builderFormFixture = new FormBuilder();
        $userManager = new FixtureManager(U::class);
        $userManager->createProductTea();
    }
}
