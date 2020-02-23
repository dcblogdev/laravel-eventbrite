<?php
declare(strict_types=1);

namespace Dcblogdev\Eventbrite;

use Dcblogdev\Eventbrite\Curl;
use Exception;

class Eventbrite
{
    public function __call(string $function, array $args)
    {
        $options = ['get', 'post', 'patch', 'put', 'delete'];
        $path = (isset($args[0])) ? $args[0] : null;
        $data = (isset($args[1])) ? $args[1] : null;
        $header = (isset($args[2])) ? $args[2] : null;

        if (in_array($function, $options)) {
            return self::request($function, $path, $data, $header);
        } else {
            //request verb is not in the $options array
            throw new Exception($function.' is not a valid HTTP Verb');
        }
    }
    
    public function request(string $type, string $endpoint, array $data = [])
    {
        $url = 'https://www.eventbriteapi.com/v3';
        $key = config('eventbrite.key');

        $c = new Curl($url);
        return $c->$type($endpoint.'?token='.$key, $data);
    }

    public function organizations()
    {
        return $this->request('get', "/users/me/organizations");
    }

    public function events()
    {
        $organisationId = config('eventbrite.org');
        return $this->request('get', "/organizations/$organisationId/events");
    }

    public function findEvent(int $event_id)
    {
        return $this->request('get', "/events/$event_id");
    }

    public function createEvent(array $event)
    {
        $organisationId = config('services.eventbrite.orgid');
        return $this->request('post', "/organizations/$organisationId/events", $event);
    }

    public function updateEvent(int $event_id, array $event)
    {
        return $this->request('post', "/events/$event_id", $event);
    }

    public function cancelEvent(array $event_id)
    {
        return $this->request('post', "/events/$event_id/cancel");
    }

    public function deleteEvent(int $event_id)
    {
        return $this->request('delete', "/events/$event_id");
    }

    public function createEventTicketClass(int $event_id, array $event)
    {
        return $this->request('post', "/events/$event_id/ticket_classes", $event);
    }

    public function publishEvent(int $event_id)
    {
        return $this->request('post', "/events/$event_id/publish");
    }

    public function findOrder(int $order_id)
    {
        return $this->request('get', "/orders/$order_id");
    }

    public function attendees(int $event_id)
    {
        return $this->request('get', "/events/$event_id/attendees");
    }

    public function attendee(int $event_id, int $attendee_id)
    {
        return $this->request('get', "/events/$event_id/attendees/$attendee_id");
    }
}
