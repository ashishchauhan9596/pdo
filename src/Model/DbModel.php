<?php
namespace App\Model;

use PDO;
/**
 * 
 */
class DbModel
{
	const DB_SERVER = 'localhost';
	const DB_USERNAME = 'root';
	const DB_PASSWORD = 'root';
	const DB_NAME = 'rightway';
	var $db = null;

	public function __construct(){
		$this->db = $this->connect();
	}
	
	public function connect()
	{		

		try {
			$db = new PDO("mysql:host=".self::DB_SERVER.";dbname=".self::DB_NAME,self::DB_USERNAME,self::DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $db;
		} 
		catch (PDOOException $e) {
			die("ERROR: Could not Connect to database. " .$e->getMessage());
		}
		// die("bye d");
	}

}	