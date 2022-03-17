<?php

declare(strict_types=1);

namespace Dcblogdev\Eventbrite;

use Exception;
use Dcblogdev\Eventbrite\Curl;
use Dcblogdev\Eventbrite\Resources\Attendees;
use Dcblogdev\Eventbrite\Resources\Events;
use Dcblogdev\Eventbrite\Resources\EventTicketClasses;
use Dcblogdev\Eventbrite\Resources\Orders;
use Dcblogdev\Eventbrite\Resources\Organizations;

class Eventbrite
{
    public function events(): object
    {
        return new Events;
    }

    public function eventTicketClasses(): object
    {
        return new EventTicketClasses();
    }

    public function attendees(): object
    {
        return new Attendees;
    }

    public function orders(): object
    {
        return new Orders;
    }

    public function organizations(): object
    {
        return new Organizations;
    }

    public function __call(string $function, array $args)
    {
        $options = ['get', 'post', 'patch', 'put', 'delete'];
        $path    = (isset($args[0])) ? $args[0] : null;
        $data    = (isset($args[1])) ? $args[1] : null;
        $header  = (isset($args[2])) ? $args[2] : null;

        if (in_array($function, $options)) {
            return self::request($function, $path, $data, $header);
        } else {
            //request verb is not in the $options array
            throw new Exception($function.' is not a valid HTTP Verb');
        }
    }

    public function request(string $type, string $endpoint, array $data = [])
    {
        $url      = 'https://www.eventbriteapi.com/v3';
        $key      = config('eventbrite.key');
        $endpoint = $endpoint.'?token='.$key;

        if (strpos($endpoint, '?') !== false) {
            $endpoint = $endpoint.'&token='.$key;
        }

        $c = new Curl($url);
        return $c->$type($endpoint, $data);
    }
}
