<?php

// 1. ฟังก์ชันสำหรับโหลดไฟล์ .env
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $_ENV[trim($name)] = trim($value);
        }
    }
}

// 2. เรียกใช้งานโหลดไฟล์ .env
// ถ้า .env อยู่ข้างนอกโฟลเดอร์ includes ให้ถอยหลังกลับไป 1 Step
$envPath = __DIR__ . '/../.env'; // ปรับ Path ตามที่ไฟล์อยู่จริง
if (!file_exists($envPath)) {
    die("<h1>หาไฟล์ .env ไม่เจอที่: $envPath</h1>");
}

loadEnv($envPath);

// เช็คว่าโหลดค่ามาได้จริงไหม
if (!isset($_ENV['DB_HOST'])) {
    die("<h1>โหลดค่าจาก .env ไม่ได้ เช็คชื่อตัวแปรในไฟล์ .env ด้วยครับ</h1>");
}

// 3. ดึงค่าจาก $_ENV มาใส่ตัวแปร
$host   = $_ENV['DB_HOST'];
$port   = $_ENV['DB_PORT'];
$user   = $_ENV['DB_USERNAME'];
$pass   = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_DATABASE'];

// 4. เริ่มการเชื่อมต่อด้วย mysqli
$conn = mysqli_init();

// บังคับใช้ SSL (ถ้าไม่ใส่บรรทัดนี้ TiDB Cloud จะดีด Error 1105 ทันที)
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);

// 5. ทำการ Connect
// หมายเหตุ: ใช้ @ นำหน้าเพื่อจัดการ error เอง
$success = @mysqli_real_connect(
    $conn, 
    $host, 
    $user, 
    $pass, 
    $dbname, 
    $port, 
    NULL, 
    MYSQLI_CLIENT_SSL
);

if (!$success) {
    error_log("Connect Error: " . mysqli_connect_error());
    die("<h1>ตายสงบ ศพสีชมพู!</h1><p>เชื่อมต่อ Database ไม่ได้ เช็ค .env หรือยังเฮีย?</p>");
}

// 6. ตั้งค่า Encoding ให้รองรับภาษาไทย
mysqli_set_charset($conn, "utf8mb4");

// --- ส่วนแสดงผลทดสอบ ---
echo "<h1>เฮงๆ รวยๆ เชื่อมต่อสำเร็จด้วย mysqli!</h1>";
echo "คุณกำลังใช้งานในฐานะ: <b>" . htmlspecialchars($user) . "</b>";

// ลองเช็ค Table ใน Database
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>รายชื่อ Table ในฐานข้อมูล:</h3><ul>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
    mysqli_free_result($result);
}

// ปิดการเชื่อมต่อเมื่อเสร็จงาน (หรือจะปล่อยไว้ให้ PHP ปิดเองก็ได้)
// mysqli_close($conn);