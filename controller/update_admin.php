<?php  

include_once '../model/Conexao.class.php';
include_once '../model/Manager.class.php';

$manager = new Manager();

session_start();
ob_start();

$update_admin = $_POST;
$id = $_POST['id'];

$manager->updateClient('admin', $update_admin, $id);
header("Location: ../admin.php?sucesso=2");

?>
