<?php
declare(strict_types=1);

$id = $context['id'];

$event = getEventById($id);
$JoinStatus = getJoinEventStatusByUserAndEvent($_SESSION['user_id'] ?? null, $id);
$joined = $JoinStatus !== null;
if (!$event) {
    notFound();
}
renderView('event-detail', ['title' => 'Event Detail', 'event' => $event, 'JoinStatus' => $JoinStatus, 'joined' => $joined]);