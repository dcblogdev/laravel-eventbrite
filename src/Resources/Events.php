<?php
declare(strict_types=1);

namespace Dcblogdev\Eventbrite\Resources;

use Dcblogdev\Eventbrite\Facades\Eventbrite;

class Events extends Eventbrite
{
    public function get(): array
    {
        $organisationId = config('eventbrite.org');
        return Eventbrite::request('get', "/organizations/$organisationId/events");
    }

    public function find(int $event_id): array
    {
        return Eventbrite::request('get', "/events/$event_id");
    }

    public function store(array $event): array
    {
        $organisationId = config('eventbrite.org');
        return Eventbrite::request('post', "/organizations/$organisationId/events", $event);
    }

    public function update(int $event_id, array $event): array
    {
        return Eventbrite::request('post', "/events/$event_id", $event);
    }

    public function cancel(array $event_id): array
    {
        return Eventbrite::request('post', "/events/$event_id/cancel");
    }

    public function publish(int $event_id): array
    {
        return Eventbrite::request('post', "/events/$event_id/publish");
    }

    public function delete(int $event_id): array
    {
        return Eventbrite::request('delete', "/events/$event_id");
    }
}
