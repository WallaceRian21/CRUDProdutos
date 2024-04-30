<?php
session_start();
ob_start();
$username = "caminhao";
$password = "wY@55LPFrsPrfD";

try {
    $conn = new PDO('mysql:host=caminhao.mysql.dbaas.com.br;dbname=caminhao;', $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
  }
?>