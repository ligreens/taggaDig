<?php

require 'session.php';
require 'database.php';
user_login_failed();

if (isset($_POST['update'])) {
    if (isset($_SESSION['userid'])) {

       $fields = ['business','firstName','lastName','email','phone','password'];
        foreach ($fields as $field) {
            if (isset($_POST[$field])&& strlen($_POST[$field]) > 0) {
                $updateStm = $pdo->prepare("UPDATE `members` SET `{$field}` = :{$field} WHERE `id`= :id");
                $updateStm->execute(["{$field}" => $_POST[$field], 'id' => $_SESSION['userid']]);
                echo json_encode(true);
            }
        }
    }
}
// //SE ANVÄNDARINFO
show_user_order_information($sql = "SELECT business, firstName, lastName, email, phone  FROM `members` WHERE id = :id");
