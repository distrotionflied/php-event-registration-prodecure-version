<<<<<<< HEAD
<?php

declare(strict_types=1);

// ฟังก์ชันสำหรับแสดงมุมมอง (view) โดยรับชื่อเทมเพลตและข้อมูลที่ต้องการส่งไปยังเทมเพลต
function renderView(string $template, array $data = []): void
{
    extract($data);
    include TEMPLATES_DIR . '/' . $template . '.php';
}
=======
<?php

declare(strict_types=1);

// ฟังก์ชันสำหรับแสดงมุมมอง (view) โดยรับชื่อเทมเพลตและข้อมูลที่ต้องการส่งไปยังเทมเพลต
function renderView(string $template, array $data = []): void
{
    extract($data);
    include TEMPLATES_DIR . '/' . $template . '.php';
}
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
