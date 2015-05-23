<?php
class ContentDb {
	public function ContentDb(){
	}
	
	public function getPostById($idParam){
        global $mmhclass;
        
		$postInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'bai-viet' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		return new Post($postInfo);
	}
	
	public function getQuestionById($idParam){
        global $mmhclass;
        
		$QuestionInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'cau-hoi' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		return new Question($QuestionInfo);
	}
	
	/*public function getAnswerById($idParam){
		$AnswerInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'tra-loi' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		return new Answer($AnswerInfo);
	}*/
	
	public function getCommentById($idParam){
        global $mmhclass;
        
		$commentInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'comment' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		return new Comment($commentInfo);
	}
	
	public function getCommentListByTargetId($targetIdParam){
		global $mmhclass;
        
        $result = array();
		$comments = $mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'comment' AND `id-doi-tuong`= '".$targetIdParam."' AND `tinh-trang`= 'published'");
		while ($commentInfo = $mmhclass->db->fetch_array($comments)){
			$result[] = new Comment($commentInfo);
		}
		return $result;
	}
	
	public function getCommentNumByTargetId($targetIdParam){
		global $mmhclass;
        
        $commentNum = $mmhclass->db->query("SELECT COUNT(*) FROM `m_content` WHERE `loai`= 'comment' AND `id-doi-tuong`= '".$targetIdParam."' AND `tinh-trang`= 'published'");
		return $commentNum;
	}
}

$contentDb = new ContentDb();

?>