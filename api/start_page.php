<?php

require 'session.php';
require 'database.php';
echo error_message();
// kalla på sessionfunktion
session_destroy();
