<?php
declare(strict_types=1);

namespace Dcblogdev\Eventbrite\Resources;

use Dcblogdev\Eventbrite\Facades\Eventbrite;

class Attendees extends Eventbrite
{
    public function get(int $event_id)
    {
        return Eventbrite::request('get', "/events/$event_id/attendees");
    }

    public function find(int $event_id, int $attendee_id)
    {
        return Eventbrite::request('get', "/events/$event_id/attendees/$attendee_id");
    }
}