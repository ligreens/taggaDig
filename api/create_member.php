<?php

require 'session.php';
require 'database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formArr = array('business', 'firstName', 'lastName', 'email', 'phone', 'password');
    $error = false;
    foreach ($formArr as $row) {
        if (!isset($_POST[$row]) || empty($_POST[$row])) {
            $error = true;
        }
    }
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    } else {
        echo "{$email} is not a valid email address";
    }
    $formisvalid = true;
    $formisvaild = $formisvalid && (isset($_POST['password']) && $_POST['password'] == $_POST['passwordsecond']);
    $formisvalid = $formisvalid && isset($_POST['email']);
    $formisvalid = $formisvalid && filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($formisvalid) {
        $sql = "SELECT COUNT(*) AS 'db_rows' FROM `members`\r\n                WHERE email = :mail";
        $stm_count = $pdo->prepare($sql);
        $stm_count->execute(['mail' => $_POST['email']]);
        // foreach ($stm_count as $row) {
        //     $rows = $row['db_rows'];
        // }
        if ($sql > 0) {    //if ($rows > 0) {
            echo "Finns redan";
        } else {
            $sql = "INSERT INTO `members` (`business`, `firstName`, `lastName`, `email`, `phone`, `password`, `salt`, `user_type`)\r\n                VALUES( :businessName, :fName, :lName, :mail, :tel, :pass, :salt, '1')";
            $salt = mt_rand_str(31);
            $stm_insert = $pdo->prepare($sql);
            $stm_insert->execute(['businessName' => $_POST['business'], 'fName' => $_POST['firstName'], 'lName' => $_POST['lastName'], 'mail' => $_POST['email'], 'tel' => $_POST['phone'], 'pass' => crypt($_POST['password'], $salt), 'salt' => $salt]);
        }
    }
}
