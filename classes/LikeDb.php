<?php
class LikeDb {
	public function LikeDb(){
	}

	public function checkLiked($targetIdParam){
        global $mmhclass;
        
		$likeNum = $mmhclass->db->query("SELECT COUNT(*) FROM `m_like`  WHERE `doi-tuong-id`= '".$targetIdParam."' AND `fbid`= '".$_SESSION['FBID']."'");
		return ($likeNum > 0);
	}
	
	public function getLikeListByTargetId($targetIdParam){
		global $mmhclass;
		
		$result = array();
		$total_likers = $mmhclass->db->query("SELECT * FROM `m_like`  WHERE `doi-tuong-id`= '".$targetIdParam."' ORDER BY `id` DESC ");
		return $result;
	}
	
	public function getLikeNumberByTargetId($targetIdParam){
        $likeList = $this->getLikeListByTargetId($targetIdParam);
        return count($likeList);
	}
	
}

$likeDb = new LikeDb();
?>