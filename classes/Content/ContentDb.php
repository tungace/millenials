<?php
require_once "Content.php";
require_once "Post.php";
require_once "Question.php";
require_once "Answer.php";
require_once "Comment.php";


class ContentDb {
	public function ContentDb(){
	}
	
	public function getPostById($idParam){
		$postInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'bai-viet' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		return new Post($postInfo);
	}
	
	public function getQuestionById($idParam){
		$QuestionInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'cau-hoi' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		return new Question($QuestionInfo);
	}
	
	public function getAnswerById($idParam){
		$AnswerInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'tra-loi' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		return new Answer($AnswerInfo);
	}
	
	public function getCommentById($idParam){
		$CommentInfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'comment' AND `id`= '".$idParam."' AND `tinh-trang`= 'published'"));
		return new Comment($CommentInfo);
	}
	
	public function getCommentListByTargetId($targetIdParam){
		$result = array();
		$comments = $mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'comment' AND `id-doi-tuong`= '".$targetIdParam."' AND `tinh-trang`= 'published'");
		while ($comment = $mmhclass->db->fetch_array($comments)){
			$result[] = new Comment(comment);
		}
		return $result;
	}
	
	public function getCommentNumByTargetId($targetIdParam){
		$commentNum = $mmhclass->db->query("SELECT COUNT(*) FROM `m_content` WHERE `loai`= 'comment' AND `id-doi-tuong`= '".$targetIdParam."' AND `tinh-trang`= 'published'");
		return $commentNum;
	}
}

$contentDb = new ContentDb();

?>