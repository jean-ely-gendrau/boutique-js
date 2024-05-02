<?php

namespace App\Boutique\Controllers\Modal;

class ModalController
{
    public function __construct()
    {
    }

    public function Index(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render */
        $render = $arguments['render'];

        $render->addParams('modal/index', $arguments);
    }
}
