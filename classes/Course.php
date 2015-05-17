<?php
class Course {
	public var courseId;
	public var urlId;
	public var alias;
	public var title;
	public var type;
	public var targetId;
	public var fbid;
	public var author;
	public var video;
	public var intro;
	public var courseInfo;
	public var extraInfo;
	public var remark;
	public var faq;
	public var document;
	public var usefulInfo;
	public var content;
	public var brief;
	public var contact;
	public var order;
	public var image;
	
	public function Course($idParam){
		global $mmhclass;
		$course_info = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `id`= '".$idParam."' AND  `loai`= 'khoa-hoc'"));		
		
		$this->courseId = $course_info['id'];
		$this->urlId 	= $course_info['url-id'];
		$this->alias 	= $course_info['alias'];
		$this->title 	= $course_info['tieu-de'];
		$this->type 	= $course_info['loai'];
		$this->targetId = $course_info['doi-tuong-id'];
		$this->fbid 	= $course_info['fbid'];
		$this->author 	= $course_info['tac-gia'];
		$this->video 	= $course_info['video'];
		$this->intro 	= $course_info['gioi-thieu'];
		$this->courseInfo = $course_info['thong-tin-khoa-hoc'];
		$this->extraInfo = $course_info['thong-tin-them'];
		$this->remark = $course_info['ghichu'];
		$this->faq = $course_info['faq'];
		$this->document = $course_info['tai-lieu'];
		$this->usefulInfo = $course_info['thong-tin-huu-ich'];
		$this->content = $course_info['noi-dung'];
		$this->brief = $course_info['tom-tat'];
		$this->contact = $course_info['lien-lac'];
		$this->order = $course_info['thu-tu'];
		$this->image = $course_info['image'];
		
	}
	
	
	
}


?>