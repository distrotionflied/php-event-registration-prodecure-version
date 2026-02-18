<html>
<head>
    <title><?= htmlspecialchars($data['title']) ?></title>
</head>
<body>
    <?php include 'header.php' ?>

    <form action="" method="get">
    <input type="text" name="keyword" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" />
    <button type="submit">Search</button>
</form>

    <main>
        <h1><?= htmlspecialchars($data['title']) ?></h1>
        <h2>ข้อมูลนักเรียน</h2>
        <?php  
            $user = null;
            if(isset($_SESSION['user_id'])){
                $result = getStudentById($_SESSION['user_id']);

                if ($result && $result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                }
            }
        ?>
        <table border="2">
            <tr>
                <th>ชื่อ</th>
                <td><?= $user ? queryData('first_name', $user) : '' ?></td>
            </tr>
            <tr>
                <th>นามสกุล</th>
                <td><?= $user ? queryData('last_name', $user) : '' ?></td>
            </tr>
            <tr>
                <th>วันเกิด</th>
                <td><?= $user ? queryData('date_of_birth', $user) : '' ?></td>
            </tr>
            <tr>
                <th>เบอร์โทรศัพท์</th>
                <td><?= $user ? queryData('phone_number', $user) : '' ?></td>
            </tr>
        </table>
    </main>

    <h2>วิชาที่ลงทะเบียน</h2>

    <?php include 'footer.php' ?>
    <script>
        function confirmSubmission() {
            return confirm("ยืนยันการลบข้อมูล ?");
        }
    </script>
</body>
</html>