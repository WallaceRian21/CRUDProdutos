<?php  

include_once '../model/Conexao.class.php';
include_once '../model/Manager.class.php';

$manager = new Manager();

session_start();
ob_start();

$update_client = $_POST;
$id = $_POST['id'];

$manager->updateClient('viagens', $update_client, $id);
header("Location: ../viagens.php?sucesso=2");

?>
