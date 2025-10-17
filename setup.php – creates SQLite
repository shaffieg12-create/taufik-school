<?php
if($_POST){
  $db = new PDO('sqlite:../db/taufik.db');
  $sql = file_get_contents('../db/schema.sql');
  $db->exec($sql);
  $stmt=$db->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,1)");
  $stmt->execute([$_POST['head'], $_POST['email'], password_hash($_POST['pw'],PASSWORD_DEFAULT)]);
  touch('../db/installed.lock');
  header('Location: ../index.php');
}
?>
<!doctype html>
<title>Taufik School – 2-step Setup</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
<form method="post" class="max-w-xl mx-auto p-8">
<img src="assets/img/logo-placeholder.png" class="h-16 mx-auto mb-4"/>
<h1 class="text-2xl font-bold text-green-700 mb-2">Taufik Junior School & Qur’an Centre</h1>
<p class="mb-4 text-sm text-gray-600">Fill once, start using in 60 seconds.</p>
<input required name="head" placeholder="Head-teacher full name" class="w-full mb-2 p-2 border rounded"/>
<input required name="email" type="email" placeholder="admin email" class="w-full mb-2 p-2 border rounded"/>
<input required name="pw" type="password" placeholder="create password" class="w-full mb-4 p-2 border rounded"/>
<button class="bg-green-600 text-white px-4 py-2 rounded">Install & Launch</button>
</form>
