<?php
require_once "../Course.php";
require_once "Page.php";

class CourseIntroPage extends Page {
	private var course;

	public function CourseIntroPage($idParam){
		$this->course = new Course($idParam);
	}

	public function getLeftPanel(){
	}
	
	public function getMainPanel(){
		$thong_tin = stripslashes($this->course->courseInfo);
		$faq = stripslashes($this->course->faq);
		$main = $t hong_tin.'<br/>'.$faq;
		
		return '<div class="col-md-8 main panstyle" id="about-the-course">'.$main.'</div>';
	}
	
	public function getRightPanel(){
	}
	
}

?>