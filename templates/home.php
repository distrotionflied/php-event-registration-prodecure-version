<html>

<head></head>

<body>
    <?php include 'header.php';?>
    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <h1><?= $data['title'] ?></h1>
        
        
        <?php 
            if(isset($_SESSION['user_id'])){
                $result = getStudentById($_SESSION['user_id']);

                if ($result && $result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    echo '<h3>Hello '.queryData('first_name',$user). '  ' .queryData('last_name',$user) .'</h3>';
                }
            }
        ?>
        
    </main>
    <!-- ส่วนแสดงผลหลักของหน้า -->
    <?php include 'footer.php' ?>
</body>

</html>