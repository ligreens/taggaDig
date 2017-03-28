<?php

require 'database.php';
require 'session.php';
failed_to_login();
// kom inte åt försen inlogg
$_SESSION['logged_in'] = $_POST['email'];