<?php
class ContentDb {
	public function ContentDb(){
	}
	
	public function getPostById($idParam){
        global $mmhclass;
        
		$postInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'bai-viet' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		if ($postInfo) {
            return new Post($postInfo);
        } else {
            return null;
        }
	}
	
	public function getQuestionById($idParam){
        global $mmhclass;
        
		$QuestionInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'cau-hoi' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		if ($QuestionInfo) {
            return new Question($QuestionInfo);
        } else {
            return null;
        }
	}
	
	public function getCommentById($idParam){
        global $mmhclass;
        
		$commentInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'comment' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		if ($commentInfo) {
            return new Comment($commentInfo);
        } else {
            return null;
        }
	}
	
	public function getCommentListByTargetId($targetIdParam){
		global $mmhclass;
        
        $result = array();
		$comments = $mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'comment' AND `id-doi-tuong`= '".$targetIdParam."' AND `tinh-trang`= 'published' ORDER BY `thoi-gian` DESC");
		while ($commentInfo = $mmhclass->db->fetch_array($comments)){
			$result[] = new Comment($commentInfo);
		}
		return $result;
	}
	
	public function getCommentNumByTargetId($targetIdParam){
		global $mmhclass;
        
        $commentNum = count($this->getCommentListByTargetId($targetIdParam));
		return $commentNum;
	}
}

$contentDb = new ContentDb();

?>