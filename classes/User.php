<?php
class User {
	public $userId;
	public $fbId;
	public $status;
	public $email;
	public $displayName;
	public $userName;
	public $fb;
	public $twitter;
	public $avatar;
	public $role;
	public $workingAddress;
	public $homeAddress;
	public $description;
	public $website;
	public $credit;
	public $verify;
	public $birthday;
	public $gender;
	public $other;
	
	public function User($user_info){
		$this->userId 			= $user_info['id'];
		$this->fbId 			= $user_info['fbid'];
		$this->status			= $user_info['tinh-trang'];
		$this->email			= $user_info['email'];
		$this->displayName 		= $user_info['ten-hien-thi'];
		$this->userName			= $user_info['username'];
		$this->fb				= $user_info['fb'];
		$this->twitter			= $user_info['twitter'];
		$this->avatar			= $user_info['avatar'];
		$this->role				= stripslashes($user_info['chuc-vu']);
		$this->workingAddress 	= stripslashes($user_info['noi-lam-viec']);
		$this->homeAddress		= $user_info['noi-o'];
		$this->description		= stripslashes($user_info['mo-ta']);
		$this->website			= $user_info['website'];
		$this->credit			= $user_info['credit'];
		$this->verify			= $user_info['verify'];
		$this->birthday			= $user_info['ngay-sinh'];
		$this->gender			= $user_info['gioi-tinh'];
		$this->other			= $user_info['other'];
	}
	
	public function toStringForAnswer($likeNum){
		return '<div class="col-xs-8 col-sm-1">
					<img alt="'.$this->displayName.'" src="'.$this->avatar.'" height="32" width="32">
				</div>
				<div class="col-xs-4 col-sm-10">
					<author><a href="./user/'.$this->fbId.'">'.$this->displayName.', '.$this->role.' @ '.$this->workingAddress.'</a></author>
                    <br>
                    <div class="unimportant-lines">
                        <b>'.$likeNum.' lượt thích</b>
                    </div>
				</div>';
	}
	
}
?>