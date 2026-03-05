<<<<<<< HEAD
<?php
declare(strict_types=1);

$method = $context['method'];
$eventId = (int)$context['id'];

if (empty($_SESSION['user_id'])) {
    header('Location: /users/login');
    exit;
}

if ($method === 'GET') {
    try {
        $event = getEventById($eventId); 
        if (!$event) { notFound(); }

        creatorcheck($event['creator_id'], '/events');

        $participants = getAlluserByEventID($eventId);

        renderView('participants-list', [
            'title' => 'Participants List',
            'event_name' => $event['name'],
            'participants' => $participants,
            'eventId' => $eventId
        ]);

    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    notFound();
=======
<?php
declare(strict_types=1);

$method = $context['method'];
$eventId = (int)$context['id'];

if (empty($_SESSION['user_id'])) {
    header('Location: /users/login');
    exit;
}

if ($method === 'GET') {
    try {
        $event = getEventById($eventId); 
        if (!$event) { notFound(); }

        creatorcheck($event['creator_id'], '/events');

        $participants = getAlluserByEventID($eventId);

        renderView('participants-list', [
            'title' => 'Participants List',
            'event_name' => $event['name'],
            'participants' => $participants,
            'eventId' => $eventId
        ]);

    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    notFound();
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
}