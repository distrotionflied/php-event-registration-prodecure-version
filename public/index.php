<?php

declare(strict_types=1);
session_start();

// กำหนดค่าคงที่สำหรับไดเรกทอรีต่างๆ ในโปรเจค
const INCLUDES_DIR = __DIR__ . '/../includes';
const ROUTE_DIR = __DIR__ . '/../routes';
const TEMPLATES_DIR = __DIR__ . '/../templates';
const DATABASES_DIR = __DIR__ . '/../databases';
const DTO_DIR = __DIR__ . '/../DTOs';

// รวมไฟล์ที่จำเป็น เข้ามาใช้งานใน index.php
require_once INCLUDES_DIR . '/router.php';
require_once INCLUDES_DIR . '/view.php';
require_once INCLUDES_DIR . '/env.php';
require_once INCLUDES_DIR . '/helper.php';
require_once INCLUDES_DIR . '/bootstrap.php';

// เรียก database ฟังก์ชันเพื่อเชื่อมต่อฐานข้อมูล (ถ้าจำเป็น)
$connection = db_connect();

$uerRepo = new UserRepository($connection);
$eventRepo = new EventRepository($connection);

//ส่งไปหา controller เพื่อจัดการกับเส้นทางและแสดงผล
require_once ROUTE_DIR . '/EventController.php';
require_once ROUTE_DIR . '/UserController.php';
const ALLOW_METHODS = ['GET', 'POST'];
$userController = new UserController($uerRepo);
$eventController = new EventController($eventRepo);

// ทุกครั้งที่มีการร้องขอเข้ามา ให้เรียกใช้ฟังก์ชัน dispatch
//dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

// ควบคุมการเข้าถึงหน้าเว็บด้วย session (ตัวอย่างการใช้งาน)
const PUBLIC_ROUTES = ['/', '/login', '/events'];


$uri = normalizeUri($_SERVER['REQUEST_URI']);

if (
    $uri === '' ||
    str_starts_with($uri, 'events') ||
    $uri === 'login'
) {
    dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    exit;
}
