<?php

class Like {
	public $id;
	public $type;
	public $fbId;
	public $targetType;
	public $targetId;
	public $likedTime;
	
	public function Like($likeInfo){
		$this->id 			= $likeInfo['id'];
		$this->type 		= $likeInfo['loai'];
		$this->fbId 		= $likeInfo['fbid'];
		$this->targetType 	= $likeInfo['loai-doi-tuong'];
		$this->targetId 	= $likeInfo['doi-tuong-id'];
		$this->likedTime 	= $likeInfo['thoi-gian'];
	}
}

?>