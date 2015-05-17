<?php
require_once "User.php";

class UserDb {
	public function UserDb(){
	}
	
	public function getUserById($idParam){
		global $mmhclass;
		$user_info = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_user` WHERE `id`= '".$idParam."'"));
		return new User($user_info);
	}
	
	public function getUserByFbId($idParam){
		global $mmhclass;
		$user_info = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_user` WHERE `fbid`= '".$idParam."'"));
		return new User($user_info);
	}
}

$userDb = new UserDb();

?>