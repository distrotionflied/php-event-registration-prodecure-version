<?php
    function queryData(string $str , array $row): string{
        $data = $row[$str] ?? 'Unknown';
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    function logout(){
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }