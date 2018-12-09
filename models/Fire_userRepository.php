<?php

class Fire_userRepository extends DbRepository
{
	public function insert($user_name,$password)
	{
		$password=$this->hashPassword($password);
		$now=new DateTime();
		
		$sql="
			INSERT INTO fire_user(user_name,password)
			VALUES(:user_name,:password)
		";
		
		$stmt=$this->execute($sql,array(
			':user_name' => $user_name,
			':password' => $password,
		
		));
	}
	
	public function hashPassword($password)
	{
		return sha1($password.'SecretKey');
	}
	
	public function fetchByUserName($user_name)
	{
		$sql="SELECT * FROM fire_user WHERE user_name= :user_name";
		
		return $this->fetch($sql,array(':user_name'=>$user_name));
	}
	
	public function isUniqueUserName($user_name)
	{
		$sql="SELECT COUNT(id) as count FROM Fire_user WHERE user_name = :user_name";
		
		$row=$this->fetch($sql,array(':user_name'=>$user_name));
		
		if($row['count']==='0'){
			return true;
		}
		
		return false;
	}

}
?>