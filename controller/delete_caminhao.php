<?php  
if($_SESSION['nome'] == true) {
}else {
    session_start();
}
ob_start();

include_once '../model/Conexao.class.php';
include_once '../model/Manager.class.php';

$manager = new Manager();

$id = $_GET['id'];
$motorista_id = $_GET['motorista_id'];
		
$manager->deleteClient('frota', $id);


header("Location: ../caminhao.php?id=".$motorista_id."&sucesso=3");
?>