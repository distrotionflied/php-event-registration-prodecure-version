<?php
    include 'header.php';
?>
<h3>ข้อมูลผู้ใช้</h3>
<p><strong>ชื่อ:</strong> <?= htmlspecialchars($user->name) ?></p>
<p><strong>อีเมล:</strong> <?= htmlspecialchars($user->email) ?></p>
<p><strong>วันเกิด:</strong> <?= htmlspecialchars($user->birthday) ?></p>
<p><strong>เบอร์โทร:</strong> <?= htmlspecialchars($user->phone) ?></p>
<p><strong>เพศ:</strong> <?= htmlspecialchars ($user->gender->value) ?></p>