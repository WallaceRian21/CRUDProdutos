<?php
include_once '../model/Conexao.class.php';
include_once '../model/Manager.class.php';
//include_once 'verificalogin.php';
$manager = new Manager();
session_start();
ob_start();
$id_motorista = $_POST['motorista_id'];
$data = $_POST;
     
$manager->insertClient('frota', $data);

echo 'Salvo com Sucesso';
header("Location: ../caminhao.php?id=".$id_motorista."&sucesso=1");