<?php
namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;


class Ratings extends CrudManager
{
    public function __construct()
    {
        parent::__construct('users', ProductsModels::class);
    }
}