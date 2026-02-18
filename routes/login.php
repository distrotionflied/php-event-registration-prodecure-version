<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $user = checkLogin($username, $password);
    if ($user) {
         session_regenerate_id(true); // 🔐 ป้องกัน session hijacking
        $unix_timestamp = time();
        $_SESSION['timestamp'] = $unix_timestamp;
        $_SESSION['user_id'] = $user['student_id'];
        header('Location: /');
        exit;
    } else {
        renderView('login', ['error' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง']);
    }
} else {
    renderView('login');
}
