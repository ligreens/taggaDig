<?php

require 'session.php';
require 'database.php';
$_SESSION['message'] = json_encode(false);
$_SESSION['logged_in'] = $_POST['email'];
failed_to_login();
// kom inte åt försen inlogg
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT  id, business, password, salt, email, user_type FROM members WHERE email = :mail";
    $row = $pdo->prepare($sql);
    $row->execute(['mail' => $user]);
    $rows = $row->fetchAll(\PDO::FETCH_ASSOC);
    if ($row->rowCount() > 0) {
        $main = array('data' => $rows);
        $crypt_password = crypt($password, $rows[0]['salt']);
        if ($crypt_password == $rows[0]['password']) {
            $_SESSION['userid'] = $rows[0]['id'];
            $_SESSION['user_type'] = $rows[0]['user_type'];
            echo json_encode($main, JSON_UNESCAPED_UNICODE);
        }
    } else {
        // $_SESSION['message'];
        header('location: start_page.php');
        exit;
    }
}
