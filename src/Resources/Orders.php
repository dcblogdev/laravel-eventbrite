<?php
declare(strict_types=1);

namespace Dcblogdev\Eventbrite\Resources;

use Dcblogdev\Eventbrite\Facades\Eventbrite;

class Orders extends Eventbrite
{
    public function find(int $order_id): array
    {
        return Eventbrite::request('get', "/orders/$order_id");
    }
}
