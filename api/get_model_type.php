<?php

require 'database.php';
// hämta modelltyper från databas
$sql_model = "SELECT`model`  FROM `products` GROUP BY `model` ";
$row = $pdo->prepare($sql_model);
$row->execute();
$result = $row->fetchAll(\PDO::FETCH_ASSOC);
$main_model = array('data' => $result);
echo json_encode($main_model);