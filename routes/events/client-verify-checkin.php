<<<<<<< HEAD
<?php
declare(strict_types=1);

$method = $context['method'] ?? 'GET';

if ($method !== 'GET' || !isset($_GET['join_event_id'])) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(["status" => "ERROR"]);
    exit;
}

$response = getCheckInStatusByJoinEventId($_GET['join_event_id']);

header('Content-Type: application/json');

if (!$response || !$response['success']) {
    echo json_encode(["status" => "ERROR"]);
    exit;
}

if ($response['checkin_status']) {
    echo json_encode([
        "status" => "FOUND"
    ]);
    exit;
}

echo json_encode([
    "status" => "WAITING"
=======
<?php
declare(strict_types=1);

$method = $context['method'] ?? 'GET';

if ($method !== 'GET' || !isset($_GET['join_event_id'])) {
    header('Location: /events');
    exit;
}

$response = getCheckInStatusByJoinEventId($_GET['join_event_id']);

header('Content-Type: application/json');
if ($response['checkin_status']) {
    echo json_encode([
        "status" => "FOUND",
        "message" => "Check-in สำเร็จแล้ว"
    ]);
    return;
}

echo json_encode([
    "status" => "WAITING"
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
]);