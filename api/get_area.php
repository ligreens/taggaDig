<?php

require 'database.php';
// hämta area
$sql_area = "SELECT `area`, `id` FROM `products` WHERE `status` = 1";
$row = $pdo->prepare($sql_area);
$row->execute();
$result = $row->fetchAll(\PDO::FETCH_ASSOC);
$main_area = array('data' => $result);
echo json_encode($main_area);