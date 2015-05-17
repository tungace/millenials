<?php
require_once "../User.php";
require_once "Page.php";

class UserPage extends Page {
	private $userId;
	private $user;

	public function UserPage($userIdParam){
		$this->userId 	= $userIdParam;
		$this->user 	= new User($userIdParam);
		
	}
	
	public function getLeftPanel(){
		
		return '<div class="col-md-2 sidebar">
					<div class="row">
					  <img width="200" height="200" alt="'.$this->user->displayName.'" src="'.$this->user->avatar . '" class="profile_photo_img img-thumbnail">
					</div>		
					<h3>Đóng góp</h3>
					<ul class="nav nav-list bs-docs-sidenav">
					<li><a href="#global"><i class="icon-chevron-right"></i> Khóa học</a></li>
					<li><a href="#gridSystem"><i class="icon-chevron-right"></i> Bài viết</a></li>
					<li><a href="#fluidGridSystem"><i class="icon-chevron-right"></i> Câu trả lời</a></li>
					<li><a href="#layouts"><i class="icon-chevron-right"></i> Câu hỏi</a></li>
					<li><a href="#responsive"><i class="icon-chevron-right"></i> Bình luận</a></li>
					</ul>
				</div>';
	}
	
	public function getMainPanel(){
		$main = '<div class="row" style="padding-left: 30px;">
						
				<hquestion>'.$this->user->displayName.'</hquestion> <br/><htitle>'.$this->user->role.'-'.$this->user->workingAddress.'.</htitle>
				<br/>
				<br/>        <button type="button" class="btn btn-default">Theo doi</button>
						<button type="button" class="btn btn-default">Nhắn tin</button>
						
						<button type="button" class="btn btn-info">Twitter</button>
						<button type="button" class="btn btn-primary">Facebook</button>
				
				<br/>
				<br/>  '.$this->user->description.'
				<br/>
				
				  <div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;" ></div><div class="col-md-1"></div>
				<br/>
				  <h3> Hoạt động gần đây </h3>
				
				  </div>';
	
		return '<div class="col-md-7 main">'.$main.'</div>';
	}
	
	public function getRightPanel(){
		
	}
}

?>