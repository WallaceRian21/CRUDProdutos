<?php  
include_once '../model/Conexao.class.php';
include_once '../model/Manager.class.php';

$manager = new Manager();

session_start();
ob_start();

$update_client = $_POST;
$motorista_id = $_POST['motorista_id'];
$id = $_POST['id'];

$manager->updateClient('frota', $update_client, $id);
header("Location: ../caminhao.php?id=".$motorista_id."&sucesso=2");

?>
