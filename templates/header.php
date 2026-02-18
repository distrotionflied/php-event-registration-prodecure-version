<!-- Header และ Footer อาจแยกออกเป็นไฟล์แยกต่างหากได้ -->
<header>
    <h1>Registration System</h1>
</header>
<nav>
    <?php
    $uri = strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (!isset($_SESSION['timestamp'])): ?>
        <div><a href="/">Home</a></div>
        <div><a href="/login">Login</a></div>
    <?php else: ?>
        <div><a href="/">Home</a></div>
        <div><a href="/contact">Contact us</a></div>
        <div><a href="/students">ข้อมูลนักเรียน</a></div>
        <div><a href="/courses">ข้อมูลวิชา</a></div>
        <div><a href="/logout">ออกจากระบบ</a></div>
    <?php endif; ?>


</nav>
<!-- Header และ Footer อาจแยกออกเป็นไฟล์แยกต่างหากได้ -->