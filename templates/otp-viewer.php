<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-md text-center">

        <h1 class="text-2xl font-bold text-gray-800 mb-4">
            🔐 OTP สำหรับ Check-in
        </h1>

        <div class="text-5xl font-extrabold tracking-widest text-blue-600 mb-6">
            <?= htmlspecialchars($otp) ?>
        </div>

        <p class="text-gray-500 mb-4">
            ใช้ได้ถึง:
            <span class="font-semibold"
            >
                <?= date('H:i:s', $expires_at) ?>
            </span>
        </p>

        <p class="text-sm text-gray-400 mb-6">
            เวลาที่เหลือ:
            <span id="countdown"></span>
        </p>

        <a href="/events/<?= $eventId ?>/detail"
           class="inline-block bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-lg transition">
            กลับหน้า Event
        </a>

    </div>
</div>

<script>
    // ดึงค่า $remaining ที่คำนวณเสร็จแล้วจาก PHP มาใช้เป็นจุดเริ่มต้น
    let remaining = <?= (int)$remaining ?>; 
    let countdownEl = document.getElementById('countdown');

    function updateCountdown() {
        if (remaining <= 0) {
            countdownEl.innerText = "หมดอายุแล้ว กำลังสร้างรหัสใหม่...";
            
            // 🔥 หัวใจสำคัญ: เมื่อเวลาเหลือ 0 ให้สั่ง Refresh หน้าจอใหม่
            // เพื่อให้ Controller (generate-otp.php) ทำงานใหม่และสร้าง OTP ชุดถัดไป
            setTimeout(() => {
                window.location.reload();
            }, 500);
            return;
        }

        let minutes = Math.floor(remaining / 60);
        let seconds = remaining % 60;
        
        // แสดงผลแบบเติมเลข 0 ข้างหน้าถ้ามีหลักเดียว (09, 08...)
        let displaySeconds = seconds < 10 ? "0" + seconds : seconds;
        countdownEl.innerText = minutes + " นาที " + displaySeconds + " วินาที";

        remaining--;
    }

    // เรียกทำงานทันที 1 ครั้งตอนโหลดหน้า
    updateCountdown();
    
    // ตั้งให้ทำงานทุกๆ 1 วินาที
    setInterval(updateCountdown, 1000);
</script>