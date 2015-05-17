<?php

class DiscussionPage extends Page {
	public function getLeftPanel(){
		$courselink = get_course_link($loai,$loai_id);$courselink='./'.$courselink; 		
		$return= '		
			<div class="col-md-2 sidebar" style="font-weight:bold;">
				<ul class="nav nav-list bs-docs-sidenav">
					<li><a href="'.$courselink.'" class="list-group-item active"><i class="icon-chevron-right"></i> Bảng tin</a></li>
					<li><a href="'.$courselink.'/thong-tin-khoa-hoc" class="list-group-item"><i class="icon-chevron-right"></i> Về khóa học</a></li>
					<li><a href="'.$courselink.'/danh-sach-bai-giang" class="list-group-item"><i class="icon-chevron-right"></i> Danh sách bài giảng</a></li>
					<li><a href="'.$courselink.'/tai-lieu" class="list-group-item"><i class="icon-chevron-right"></i> Tài liệu liên quan</a></li>
					<li><a href="'.$courselink.'/thong-tin-huu-ich" class="list-group-item"><i class="icon-chevron-right"></i> Thông tin hữu ích</a></li>			
					<li><a href="'.$courselink.'#" class="list-group-item"><i class="icon-chevron-right"></i>Bài kiểm tra</a></li>
					<li><a href="'.$courselink.'#" class="list-group-item"><i class="icon-chevron-right"></i>Thảo luận</a></li>
					<li><a href="'.$courselink.'/faq" class="list-group-item"><i class="icon-chevron-right"></i>Quy chế và cách đánh giá</a></li>
					<li><a href="'.$courselink.'/lien-lac" class="list-group-item"><i class="icon-chevron-right"></i>Liên lạc với giảng viên</a></li>
				</ul>
			</div>';
	}
	
	public function getMainPanel(){
	}
	
	public function getRightPanel(){
	}
	
}

?>