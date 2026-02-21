<?php
declare(strict_types=1);

$method = $context['method'];
$id     = $context['id'];

if ($method === 'GET') {
    $event = getEventById($id);  // เรียกตรงๆ เลย
    if (!$event) {
        notFound();
    }
    renderView('edit-event', ['title' => 'Edit Event', 'event' => $event]);

} elseif ($method === 'POST') {
    $name        = $_POST['name']        ?? '';
    $description = $_POST['description'] ?? '';
    $event_start = $_POST['event_start'] ?? '';
    $event_end   = $_POST['event_end']   ?? '';

    updateEvent($id, $name, $description, $event_start, $event_end); // เรียกตรงๆ เลย

    header('Location: /events/' . $id);
    exit;
} else {
    notFound();
}