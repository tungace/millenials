<?php

class CoursePage extends Page {
	public function getLeftPanel(){
		return '<div class="col-md-2 sidebar" style="font-weight:bold;">
					<ul class="nav nav-list bs-docs-sidenav">
						<li><a href="#global" class="list-group-item active"><i class="icon-chevron-right"></i> Trang chủ các khóa học</a></li>
						<li><a href="#gridSystem" class="list-group-item"><i class="icon-chevron-right"></i> Khóa học đã đăng ký</a></li>
						<li><a href="#responsive" class="list-group-item"><i class="icon-chevron-right"></i>Về các chương trình học</a></li>
						<br/><p>Liên kết</p>			
						<li><a href="#layouts" class="list-group-item"><i class="icon-chevron-right"></i> Trường đại học X</a></li>
						<li><a href="#layouts" class="list-group-item"><i class="icon-chevron-right"></i> Trung học Y</a></li>			
						<li><a href="#responsive" class="list-group-item"><i class="icon-chevron-right"></i>Trung tâm Z</a></li>
						<li><a href="#responsive" class="list-group-item"><i class="icon-chevron-right"></i>Giáo sư lọ</a></li>						
					</ul>
				</div>';
	}
	
	public function getMainPanel(){
		return '<div class="col-md-10 main panstyle" id="about-the-course">'.load_cac_khoa_hoc().'</div>';
	}
	
	public function getRightPanel(){
	}
	
}

?>