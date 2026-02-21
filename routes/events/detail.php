<?php
declare(strict_types=1);

$id = $context['id'];

$event = getEventById($id);
if (!$event) {
    notFound();
}
renderView('event-detail', ['title' => 'Event Detail', 'event' => $event]);