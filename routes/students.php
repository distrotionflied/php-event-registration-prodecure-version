<?php
// 1. ตรวจสอบการส่งค่าจาก Form
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// 2. เลือกฟังก์ชันที่จะใช้ดึงข้อมูล
if ($keyword !== '') {
    // ถ้ามีการพิมพ์คำค้นหามา
    $result = getStudentsByKeyword($keyword);
} else {
    // ถ้าไม่มีคำค้นหา หรือเปิดหน้าเว็บมาครั้งแรก
    $result = getStudents();
}

// 3. ส่งข้อมูลไปที่ View
renderView('students', [
    'title'  => 'Student Information', 
    'result' => $result
]);