<html>

<head></head>

<body>
    <?php include 'header.php' ?>

    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <h1><?= $data['title'] ?></h1>
        <table border="2">
        <tr>
            <th>ลำดับที่</th>
            <th>ชื่อวิชา</th>
            <th>รหัสวิชา</th>
            <th>อาจารย์ผู้สอน</th>
            <th></th>
        </tr>
        <?php
        if ($data['result'] != []) {
	        while ($row = $data['result']->fetch_object()) {
	        ?>
                <tr>
	            <td><?= $row->course_id ?></td>
                <td><?= $row->course_name ?></td>
                <td><?= $row->course_code ?></td>
                <td><?= $row->instructor ?></td>
                <td><a href="/courses-delete?id=<?= $row->course_id ?>" onclick="return confirmSubmission()">ลงทะเบียน</a></td>
                </tr>
	     <?php
	        }
        }else{
            echo 'ไม่พบข้อมูล';
        }
        ?>
        </table>
    </main>
    <!-- ส่วนแสดงผลหลักของหน้า -->

    <?php include 'footer.php' ?>
    <script>
        function confirmSubmission() {
            return confirm("ยืนยันการลงทะเบียน ?");
        }
    </script>
</body>

</html>