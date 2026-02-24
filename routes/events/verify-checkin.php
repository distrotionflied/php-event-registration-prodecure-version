<?php
declare(strict_types=1);

$method = $context['method'] ?? 'POST';
$joinEventId = (int)($context['id'] ?? 0);

if (empty($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

if ($method !== 'POST') {
    notFound();
}

// รับค่า OTP จากฟอร์ม
$inputOtp = $_POST['otp'] ?? '';
$participant = getJoinEventById($joinEventId);

if (!$participant) {
    die("ไม่พบข้อมูลผู้เข้าร่วม");
}

$eventId = $participant['event_id'];
$secret = $participant['totp_secret'] ?? '';
$createdAt = isset($participant['otp_created_at']) ? (int)$participant['otp_created_at'] : 0;

// 1. ตรวจสอบเงื่อนไขว่าผู้ใช้เคยกด Generate OTP แล้วหรือยัง
if (empty($secret) || $createdAt === 0) {
    echo "<script>
        alert('ผู้เข้าร่วมรายนี้ยังไม่ได้สร้างรหัส OTP');
        window.location.href = '/events/{$joinEventId}/checkin';
    </script>";
    exit;
}

// 2. คำนวณหาช่วงเวลาหมดอายุ (60 วินาที)
$ttl = 60;
$now = time();

if ($now > ($createdAt + $ttl)) {
    // ถ้าเวลาปัจจุบัน เกินกว่า (เวลาที่สร้าง + 60 วินาที) = หมดอายุ
    echo "<script>
        alert('❌ รหัส OTP หมดอายุแล้ว (เกิน 60 วินาที) กรุณาให้ผู้เข้าร่วมสร้างรหัสใหม่');
        window.location.href = '/events/{$joinEventId}/checkin';
    </script>";
    exit;
}

// 3. คำนวณว่า OTP ที่กรอกมา ถูกต้องหรือไม่
$expectedOtp = getTOTP($secret);

if ($inputOtp !== $expectedOtp) {
    echo "<script>
        alert('❌ รหัส OTP ไม่ถูกต้อง!');
        window.location.href = '/events/{$joinEventId}/checkin';
    </script>";
    exit;
}

// 4. ถ้าทุกอย่างถูกต้อง ให้ Update Check-in
try {
    // เรียกใช้ฟังก์ชัน updateCheckInEvent (ตามที่คุณต้องการ)
    // หากฟังก์ชันของคุณรับ พารามิเตอร์ (join_event_id, สถานะ)
    updateCheckInEvent($joinEventId, true); 

    /* หรือถ้าไม่มีฟังก์ชัน คุณสามารถใช้ Query ตรงๆ ได้แบบนี้:
    global $connection;
    $sql = "UPDATE join_event SET checkin_status = 'checked' WHERE join_event_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $joinEventId);
    $stmt->execute();
    */
    
    // สำเร็จแล้วเด้งกลับไปหน้า Participants แจ้งว่าเรียบร้อย
    echo "<script>
        alert('✅ Check-in สำเร็จ!');
        window.location.href = '/events/{$eventId}/participants';
    </script>";
    exit;
} catch (Exception $e) {
    die("เกิดข้อผิดพลาดในการอัปเดตสถานะ: " . $e->getMessage());
}