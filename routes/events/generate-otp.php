<?php
declare(strict_types=1);

// context มาจาก router
$eventId = $context['id'] ?? null;
$method  = $context['method'] ?? 'GET';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId || !$eventId) {
    http_response_code(400);
    renderView('404');
    exit;
}

// ดึงข้อมูล join_event ของ user กับ event นี้ (model function ที่มีอยู่)
$participant = getByUserAndEvent($userId, (int)$eventId);

if (!$participant) {
    http_response_code(403);
    renderView('404');
    exit;
}

if (($participant['join_status'] ?? '') !== JoinStatus::APPROVED->value) {
    http_response_code(403);
    renderView('404');
    exit;
}

$joinEventId = (int)$participant['join_event_id'];

// TTL ของสิทธิ์ (วินาที) — ปรับได้ ถ้าต้องการ
$ttl = 60; // 1 นาที

// ---------- สร้าง secret ถ้ายังไม่มี ----------
if (empty($participant['totp_secret'])) {
    $newSecret = generateSecret(16);

    // อัพเดต DB ตรงนี้ (ใช้ global $connection เหมือน model อื่นของระบบ)
    global $connection;
    $sql = "UPDATE join_event SET totp_secret = ? WHERE join_event_id = ?";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        throw new Exception("DB prepare failed: " . $connection->error);
    }
    $stmt->bind_param('si', $newSecret, $joinEventId);
    $stmt->execute();

    // รีโหลด participant ข้อมูลใหม่
    $participant = getJoinEventById($joinEventId);
    if (!$participant) {
        throw new Exception("Failed to reload join_event after saving secret");
    }
}

// ---------- จัดการ otp_created_at ----------
$createdAt = isset($participant['otp_created_at']) ? (int)$participant['otp_created_at'] : null;
$now = time();

if (!$createdAt || ($now > ($createdAt + $ttl))) {
    // ยังไม่เคยสร้าง หรือ หมดเวลาแล้ว -> สร้างใหม่ (อัพเดต otp_created_at)
    $createdAt = $now;

    global $connection;
    $sql2 = "UPDATE join_event SET otp_created_at = ? WHERE join_event_id = ?";
    $stmt2 = $connection->prepare($sql2);
    if (!$stmt2) {
        throw new Exception("DB prepare failed: " . $connection->error);
    }
    $stmt2->bind_param('ii', $createdAt, $joinEventId);
    $stmt2->execute();

    // รีโหลด participant อีกครั้ง (เพื่อให้แน่ใจว่าข้อมูล sync)
    $participant = getJoinEventById($joinEventId);
    if (!$participant) {
        throw new Exception("Failed to reload join_event after saving otp_created_at");
    }
}

// ---------- สร้าง OTP (คำนวณจาก secret + เวลา) ----------
$secret = getTotpSecret($joinEventId); 
if (empty($secret)) {
    // กรณีแปลก ๆ
    renderView('otp-viewer', [
        'error' => 'ไม่พบ secret สำหรับผู้ใช้นี้ โปรดลอง Generate อีกครั้ง',
    ]);
    exit;
}

// คำนวณ OTP จาก secret (TOTP)
$otp = getTOTP($secret);

// คำนวนเวลาที่เหลือจริงๆ จากฐานข้อมูล
$createdAt = (int)$participant['otp_created_at'];
$expire = $createdAt + $ttl;
$remaining = max(0, $expire - time());

// เตรียมข้อมูลสำหรับ View
$data = [
    'otp'        => $otp,
    'eventId'    => (int)$eventId,
    'expires_at' => $expire,
    'remaining'  => $remaining, // ส่งชื่อ remaining ไปเลยจะได้ไม่สับสน
    'is_owner'   => ($participant['user_id'] === $userId),
    'participant'=> $participant,
];

renderView('otp-viewer', $data);
exit;