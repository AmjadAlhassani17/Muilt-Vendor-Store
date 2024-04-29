<?php

namespace App\Fasades;

use App\Repositories\cart\CartRepository;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CartRepository::class;
    }
}