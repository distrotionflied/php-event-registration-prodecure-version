<?php
declare(strict_types=1);

$method = $context['method'];

if ($method === 'GET') {
    renderView('create-event', ['title' => 'Create Event']);

} elseif ($method === 'POST') {
    $name        = $_POST['name']        ?? '';
    $description = $_POST['description'] ?? '';
    $event_start = $_POST['event_start'] ?? '';
    $event_end   = $_POST['event_end']   ?? '';
    $creator_id  = $_SESSION['user_id'];  // ดึงจาก session แทน hardcode

    createEvent($name, $description, $event_start, $event_end, $creator_id);

    header('Location: /events');
    exit;
} else {
    notFound();
}