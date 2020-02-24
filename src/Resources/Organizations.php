<?php
declare(strict_types=1);

namespace Dcblogdev\Eventbrite\Resources;

use Dcblogdev\Eventbrite\Facades\Eventbrite;

class Organizations extends Eventbrite
{
    public function get(): array
    {
        return Eventbrite::request('get', "/users/me/organizations");
    }
}