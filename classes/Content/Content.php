<?php

class Content {
	public $id;
	public $urlId;
	public $fbId;
	public $postedTime;
	public $tag;
	public $title;
	public $content;
	public $status;
	public $preview;
	public $targetType;
	public $targetId;
	public $thumbnail;
	public $like;
	public $dislike; 
	
	public function Content($contentInfo){
		$this->id = $contentInfo['id'];
		$this->urlId = $contentInfo['url-id'];
		$this->fbId = $contentInfo['fbid'];
		$this->postedTime = $contentInfo['thoi-gian'];
		$this->tag = $contentInfo['the'];
		$this->title = $contentInfo['tieu-de'];
		$this->content = $contentInfo['noi-dung'];
		$this->status = $contentInfo['tinh-trang'];
		$this->preview = $contentInfo['preview'];
		$this->targetType = $contentInfo['loai-doi-tuong'];
		$this->targetId = $contentInfo['id-doi-tuong'];
		$this->thumbnail = $contentInfo['thumbnail'];
		$this->like = $contentInfo['thich'];
		$this->dislike = $contentInfo['khong-thich'];
        
	}
	
}

?>