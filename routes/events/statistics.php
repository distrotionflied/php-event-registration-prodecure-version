<?php
declare(strict_types=1);

creatorcheck($event['creator_id'], '/events');

$eventId = (int)$context['id'];
$stats = getEventStatistics($eventId);
$event = getEventById($eventId);

renderView('event-stats', [
    'title' => 'Event Statistics',
    'stats' => $stats,
    'event' => $event
]);