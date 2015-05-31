<?php
class LikeDb {
	public function LikeDb(){
	}
	
	public function getLikeListByTargetId($targetIdParam){
		global $mmhclass;
		
		$result = array();
		$total_likers = $mmhclass->db->query("SELECT * FROM `m_like`  WHERE `doi-tuong-id`= '".$targetIdParam."' ORDER BY `id` DESC ");
		while ($liker = $mmhclass->db->fetch_array($total_likers)){
            $result[] = $liker;
        }
        return $result;
	}
	
	public function getLikeNumberByTargetId($targetIdParam){
        $likeList = $this->getLikeListByTargetId($targetIdParam);
        return count($likeList);
	}

	public function checkLiked($targetIdParam){
		return ($this->getLikeNumberByTargetId($targetIdParam) > 0);
	}
	
}

$likeDb = new LikeDb();
?>