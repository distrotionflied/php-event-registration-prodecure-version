<<<<<<< HEAD
<?php
declare(strict_types=1);

$joinEventId = (int)$context['id'];
$eventId = (int)($_GET['event_id'] ?? 0);

if (empty($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

try {
    $success = updateJoinStatus($joinEventId, JoinStatus::REJECTED->value);
    if ($success) {
        header("Location: /events/$eventId/participants");
        exit;
    } else {
        die("ไม่สามารถปฏิเสธการลงทะเบียนได้");
    }
} catch (Exception $e) {
    die("เกิดข้อผิดพลาด: " . $e->getMessage());
}
=======
<?php
declare(strict_types=1);

$joinEventId = (int)$context['id'];
$eventId = (int)($_GET['event_id'] ?? 0);

if (empty($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

try {
    $success = updateJoinStatus($joinEventId, JoinStatus::REJECTED->value);

    if ($success && $checkin['checkin_status']) {
        header("Location: /events/$eventId/participants");
        exit;
    } else {
        die("ไม่สามารถปฏิเสธการลงทะเบียนได้");
    }
} catch (Exception $e) {
    die("เกิดข้อผิดพลาด: " . $e->getMessage());
}
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
