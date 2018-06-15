<?php
namespace App;

use App\Model\UserModel as User;
/**
 * the class view extend User which contains operation related to databases queries
 * User is used as App\Model\UserModel
 */
class View extends User
{
	
	public function getAll(){
		
		return $this->selectAll();
	}

	public function insertData($name,$email,$password){
		
		return $this->insertAll($name,$email,$password);

	}
}