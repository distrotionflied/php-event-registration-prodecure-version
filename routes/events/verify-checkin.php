<<<<<<< HEAD
<?php
declare(strict_types=1);

$method = $context['method'] ?? 'POST';
$eventId = (int)($context['id'] ?? 0);

if ($method !== 'POST') {
    notFound();
}

// รับค่า OTP จากฟอร์ม
$inputOtp = $_POST['otp'] ?? '';
$getAllparticipant = getApprovedButNotCheckedInJoinEventByEventId($eventId);

if (!$getAllparticipant) {
    die("ไม่พบข้อมูลผู้เข้าร่วม");
}

// 2. คำนวณหาช่วงเวลาหมดอายุ (60 วินาที)
$ttl = 60;
$now = time();

$otpvertify = false;
$foundJoinId = null; // เพิ่มตัวแปรเพื่อเก็บ ID ที่หาเจอ

foreach ($getAllparticipant as $participant){
    $secret = $participant['totp_secret'] ?? '';

    $expectedOtp = getTOTP($secret);

    if ($inputOtp === $expectedOtp) {
        $otpvertify = true;
        $foundJoinId = $participant['join_event_id']; // เก็บค่า ID นี้ไว้ใช้ตอนอัปเดต
        break; // ถ้าเจอแล้วให้หยุดลูปทันที
    }
}

if (!$otpvertify && $foundJoinId === null) {
    echo "<script>
        alert('❌ OTP ไม่ถูกต้องหรือหมดอายุ!');
        window.location.href = '/events/{$eventId}/checkin';
    </script>";
    exit;
}

try {
    // แก้ตรงนี้: ใช้ $foundJoinId ที่เราหาเจอจากในลูป
    updateCheckInEvent($foundJoinId, true); 
    
    echo "<script>
        alert('✅ Check-in สำเร็จ!');
        window.location.href = '/events/{$eventId}/participants';
    </script>";
    exit;
} catch (Exception $e) {
    die("เกิดข้อผิดพลาดในการอัปเดตสถานะ: " . $e->getMessage());
=======
<?php
declare(strict_types=1);

$method = $context['method'] ?? 'POST';
$joinEventId = (int)($context['id'] ?? 0);

if ($method !== 'POST') {
    notFound();
}

// รับค่า OTP จากฟอร์ม
$inputOtp = $_POST['otp'] ?? '';
$participant = getJoinEventById($joinEventId);

creatorcheck($participant['creator_id'], '/events');

if (!$participant) {
    die("ไม่พบข้อมูลผู้เข้าร่วม");
}

$eventId = $participant['event_id'];
$secret = $participant['totp_secret'] ?? '';

// 1. ตรวจสอบเงื่อนไขว่าผู้ใช้เคยกด Generate OTP แล้วหรือยัง
if (empty($secret)) {
    echo "<script>
        alert('ผู้เข้าร่วมรายนี้ยังไม่ได้สร้างรหัส OTP');
        window.location.href = '/events/{$joinEventId}/checkin';
    </script>";
    exit;
}

// 2. คำนวณหาช่วงเวลาหมดอายุ (60 วินาที)
$ttl = 60;
$now = time();

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
    
    // สำเร็จแล้วเด้งกลับไปหน้า Participants แจ้งว่าเรียบร้อย
    echo "<script>
        alert('✅ Check-in สำเร็จ!');
        window.location.href = '/events/{$eventId}/participants';
    </script>";
    exit;
} catch (Exception $e) {
    die("เกิดข้อผิดพลาดในการอัปเดตสถานะ: " . $e->getMessage());
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
}