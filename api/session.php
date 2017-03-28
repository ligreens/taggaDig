<?php

session_start();
// require 'session.php';
require 'database.php';
// om fel inlogg, skriv ut errormedd.
function error_message()
{
    if (isset($_SESSION['message'])) {
        $output = $_SESSION['message'];
        $_SESSION['message'] = null;
        return $output;
    }
}
// OM man inte är inloggad skicka tillbaka till start_page.php
function failed_to_login()
{
    if (!isset($_SESSION['logged_in'])) {
        header("Location: start_page.php");
        exit;
    }
}
//kollar om admin är inloggad
function admin_inlog()
{
    if (!isset($_SESSION['usertype'])) {
        header("Location: start_page.php");
        exit;
    }
}
//hämta order och användare
function show_user_order_information()
{
    global $pdo;
    global $sql;
    $row = $pdo->prepare($sql);
    $row->execute(['id' => $_SESSION['userid']]);
    $result = $row->fetchAll(\PDO::FETCH_ASSOC);
    $main_order = array('data' => $result);
    echo json_encode($main_order, JSON_UNESCAPED_UNICODE);
}
function mt_rand_str($l, $c = 'abcdefghiJKkLmnopQRStuVwxyz1234567890')
{
    for ($s = '', $cl = strlen($c) - 1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i) {
    }
    return $s;
}