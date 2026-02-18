<?php

declare(strict_types=1);

if (!isset($_GET['id'])) {
    header('Location: /courses');
    exit;
} else {
    $id = (int)$_GET['id'];    
    $res = deleteCouresById($id);
    if ($res > 0) {
        header('Location: /courses');
    } else {
        renderView('400', ['message' => 'Something went wrong! on delete courses']);
    }
    
}