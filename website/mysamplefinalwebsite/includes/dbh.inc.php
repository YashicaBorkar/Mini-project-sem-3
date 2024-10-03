<?php
$host = 'localhost';
$dbname = 'logsign-page';
$dbusername = 'root';
$dbpassword = '';

try{
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4;", $dbusername, $dbpassword);
  $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed:" . $e->getMessage());
}
