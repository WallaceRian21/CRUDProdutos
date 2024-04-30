<?php
include_once '../model/Conexao.class.php';
include_once '../model/Manager.class.php';
$manager = new Manager();
session_start();
ob_start();

$data = $_POST;
     
$manager->insertClient('viagens', $data);

echo 'Salvo com Sucesso';
header("Location: ../viagens.php?sucesso=1");