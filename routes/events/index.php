<?php
declare(strict_types=1);

$events = getAllEvents();
renderView('events', ['title' => 'Events', 'events' => $events]);