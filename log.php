<?php

include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';

 function logAcessso($user, $pagina, $data, $ip){
     $valor = array(
     "nome_usuario" => $user,
     "pagina" => $pagina,
     "data" => $data,
     "ip" => $ip
     );

     $manager = new Manager();

     $manager->insertLogs('logs', $valor);
 }