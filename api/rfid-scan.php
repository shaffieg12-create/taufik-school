<?php
require '../inc/auth.php'; // validates JWT from Node-RED
$db = new PDO('sqlite:../db/taufik.db');
$card = $_POST['card'];
$reader = $_POST['reader_id'];
$ts  = $_POST['ts'] ?? date('Y-m-d H:i:s');

$stu = $db
