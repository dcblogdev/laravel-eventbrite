<?php
declare(strict_types=1);

namespace Dcblogdev\Eventbrite\Resources;

use Dcblogdev\Eventbrite\Facades\Eventbrite;

class EventTicketClasses extends Eventbrite
{
    public function store(int $event_id, array $event): array
    {
        return Eventbrite::request('post', "/events/$event_id/ticket_classes", $event);
    }
}