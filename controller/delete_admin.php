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
		
$manager->deleteClient('admin', $id);

header("Location: ../admin.php?sucesso=3");


?>