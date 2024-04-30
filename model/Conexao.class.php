<?php  

class Conexao {

	public static $instance;

	public static function get_instance() {
		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		
		if(!isset(self::$instance)) {
			self::$instance = new PDO("mysql:host=caminhao.mysql.dbaas.com.br;dbname=caminhao;", "caminhao", "wY@55LPFrsPrfD", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		return self::$instance;

	}

}

?>