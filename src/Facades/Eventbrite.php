<?php

namespace Dcblogdev\Eventbrite\Facades;

use Illuminate\Support\Facades\Facade;

class Eventbrite extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'eventbrite';
    }
}
