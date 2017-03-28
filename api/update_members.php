<?php

require 'session.phpp';
require 'database.php';
failed_to_login();
// UPPDATERA ANVÄNDARE
$_SESSION['email'] = 'email';
if (isset($_POST['update'])) {
    if (isset($_SESSION['userid'])) {
        if (isset($_POST['business']) && strlen($_POST['business']) > 0) {
            $updateStm = $pdo->prepare("UPDATE `members` SET `business` = :business WHERE `id`= :id");
            $updateStm->execute(['business' => $_POST['business'], 'id' => $_SESSION['userid']]);
            // echo json_encode(true);
        }
        if (isset($_POST['firstName']) && strlen($_POST['firstName']) > 0) {
            $updateStm = $pdo->prepare("UPDATE `members` SET `firstName` = :firstName WHERE `id`= :id");
            $updateStm->execute(['firstName' => $_POST['firstName'], 'id' => $_SESSION['userid']]);
            // echo json_encode(true);
        }
        if (isset($_POST['lastName']) && strlen($_POST['lastName']) > 0) {
            $updateStm = $pdo->prepare("UPDATE `members` SET `lastName` = :lastName WHERE `id`= :id");
            $updateStm->execute(['lastName' => $_POST['lastName'], 'id' => $_SESSION['userid']]);
            // echo json_encode(true);
        }
        if (isset($_POST['email']) && strlen($_POST['email']) > 0) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                $updateStm = $pdo->prepare("UPDATE `members` SET `email` = :email WHERE `id`= :id");
                $updateStm->execute(['email' => $_POST['email'], 'id' => $_SESSION['userid']]);
                // echo json_encode(true);
            } else {
                // echo json_encode(false);
            }
        }
        if (isset($_POST['phone']) && strlen($_POST['phone']) > 0) {
            $updateStm = $pdo->prepare("UPDATE `members` SET `phone` = :phone WHERE `id`= :id");
            $updateStm->execute(['phone' => $_POST['phone'], 'id' => $_SESSION['userid']]);
            echo json_encode(true);
        }
        if (isset($_POST['password']) && strlen($_POST['password']) > 0) {
            $updateStm = $pdo->prepare("UPDATE `members` SET `password` = :password WHERE `id`= :id");
            $updateStm->execute(['password' => $_POST['password'], 'id' => $_POST['update']]);
            // echo json_encode(true);
        }
    }
}
// //SE ANVÄNDARINFO
show_user_order_information($sql = "SELECT business, firstName, lastName, email, phone  FROM `members` WHERE id = :id");