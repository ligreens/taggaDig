<?php

require 'session.php';
require 'database.php';
failed_to_login();
//SE ORDER
show_user_order_information($sql = "SELECT *  FROM orders WHERE member_id = :id");