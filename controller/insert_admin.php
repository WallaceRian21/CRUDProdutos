<?php
include_once '../model/Conexao.class.php';
include_once '../model/Manager.class.php';
//include_once 'verificalogin.php';
$manager = new Manager();
session_start();
ob_start();

$data = $_POST;

$manager->insertClient('admin', $data);

echo 'Salvo com Sucesso';
header("Location: ../admin.php?sucesso=1");