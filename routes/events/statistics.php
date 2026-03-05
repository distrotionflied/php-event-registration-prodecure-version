<<<<<<< HEAD
<?php
declare(strict_types=1);

$eventId = (int)$context['id'];
$stats = getEventStatistics($eventId);
$event = getEventById($eventId);

creatorcheck($event['creator_id'], '/events');

renderView('event-stats', [
    'title' => 'Event Statistics',
    'stats' => $stats,
    'event' => $event
=======
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
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
]);