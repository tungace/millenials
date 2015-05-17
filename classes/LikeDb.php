<?php
require_once "Like.php";
require_once "UserDb.php";

class LikeDb {
	public function LikeDb(){
	}

	public function getLikeListByTargetId($idParam){
		global $mmhclass;
		
		$result = array();
		$total_likers = $mmhclass->db->query("SELECT * FROM `m_like`  WHERE `doi-tuong-id`= '".$idParam."' ORDER BY `id` DESC ");
		while ($single_like= $mmhclass->db->fetch_array($total_likers)){
			$result[] = $single_like;
		}
		return $result;
	}
	
	public function getLikeNumberByTargetId($idParam){
		global $mmhclass;
		
		$likeNume = $mmhclass->db->query("SELECT COUNT(*) FROM `m_like`  WHERE `doi-tuong-id`= '".$idParam."'");
		return $likeNume;
	}
}

$likeDb = new LikeDb();
?>