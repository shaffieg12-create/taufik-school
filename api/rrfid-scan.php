<?php
require '../inc/auth.php'; // validates JWT from Node-RED
$db = new PDO('sqlite:../db/taufik.db');
$card = $_POST['card'];
$reader = $_POST['reader_id'];
$ts  = $_POST['ts'] ?? date('Y-m-d H:i:s');

$stu = $db->prepare("SELECT id, first_name, parent_phone, boarding FROM students WHERE rfid_card = ? AND status = 1");
$stu->execute([$card]);
if (!$row = $stu->fetch()) {
    http_response_code(404);
    exit('Unknown card');
}

$dir = $db->prepare("SELECT direction FROM attendance WHERE student_id = ? ORDER BY id DESC LIMIT 1");
$dir->execute([$row['id']]);
$last = $dir->fetchColumn();
$direction = ($last === 'IN') ? 'OUT' : 'IN';

$ins = $db->prepare("INSERT INTO attendance (student_id, date, time, direction, reader_id) VALUES (?, ?, ?, ?, ?)");
$ins->execute([$row['id'], date('Y-m-d', strtotime($ts)), date('H:i', strtotime($ts)), $direction, $reader]);

// SMS parent on gate-IN
if ($reader === 'gate' && $direction === 'IN') {
    $text = "Dear parent, " . $row['first_name'] . " has ARRIVED at school at " . date('H:i', strtotime($ts)) . ".";
    sendSMS($row['parent_phone'], $text);
}
echo 'OK';
