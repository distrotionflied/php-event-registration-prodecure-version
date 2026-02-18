<?php

declare(strict_types=1);

if (!isset($_GET['id'])) {
    header('Location: /students');
    exit;
} else {
    $id = (int)$_GET['id'];    
    $res = deleteStudentsById($id);
    if ($res > 0) {
        header('Location: /students');
    } else {
        renderView('400', ['message' => 'Something went wrong! on delete student']);
    }
    
}