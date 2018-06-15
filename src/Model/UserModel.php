<?php

namespace App\Model;
 use PDO;
/**
 * the class view extend User which contains databases connection
 * User is used as App\Model\DbModel
 */
class UserModel extends DbModel
{
	
	public function selectAll(){

		$sql = "SELECT * FROM pdo";
		return $this->db->query($sql)->fetchAll();
		// return print_r($result);
	}

	public function insertAll($name,$email,$password){
		
		try{
		    $sql = "INSERT INTO pdo (name, email,password,hashpass) VALUES (:name,:email,:password,:hashpass)";

		    $stmt = $this->db->prepare($sql);

		    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
		    $stmt->bindParam(':email',$email,PDO::PARAM_STR);
		    $stmt->bindParam(':password',$password,PDO::PARAM_STR);
		    $stmt->bindParam(':hashpass',$passhash,PDO::PARAM_STR);
		    $passhash = password_hash($password, PASSWORD_DEFAULT);
		    $stmt->execute();

		    return  "Records inserted successfully.";

		}
		catch(PDOException $e){
			    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
		}

	}
}