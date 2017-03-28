<?php

require 'session.php';
require 'database.php';
failed_to_login();
//SE ANVÄNDARINFO
show_user_order_information($sql = "SELECT business, firstName, lastName, email, phone  FROM members WHERE id = :id");