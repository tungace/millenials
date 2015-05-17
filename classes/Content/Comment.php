<?php
require_once "Content.php";
require_once "UserDb.php";
require_once "ContentDb.php";

class Comment extends Content {
	public function Comment($commentInfo){
		Content($commentInfo);
	}
	
	public function toStringBigVersion(){
		global $userDb;
		global $likeDb;
		global $contentDb;
		
		$content = stripslashes($this->content);
		$user = $userDb->getUserByFbId($this->fbId);
		
		
		$commentNum = $contentDb->getCommentNumByTargetId($this->id);
		if ($commentNum > 0){
			$commentNum = "(".$commentNum.")";
		} else {
			$commentNum = "";
		}
		
		$check_likers=checklikers($loai,$loai_id);							
		
		$return = '
		<div class="row postlayout">
			<div class="col-sm-11">
				<div class="row">
					<div class="col-xs-8 col-sm-1">
						<img alt="'.$user->displayName.'" src="'.$user->avatar.'" height="32" width="32">      
					</div>
					<div class="col-xs-4 col-sm-10">
						<author><a href="./user/'.$user->fbId.'">'.$user->displayName.', '.$user->role.'</a></author><br>
						<div class="unimportant-lines">
						<b>'.$likeDb->getLikeNumByTargetId($this->id).' lượt thích</b>
						</div>      
					</div>
					<div class="col-xs-8 col-xs-1">
			
						<div class="btn-group">
						<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> 
							<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#" data-toggle="modal" data-target="#myModal" loai="comment" loaiid="'.$this->id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
							<li><a href="#">Ngừng theo dõi bài</a></li>
							<li class="divider"></li>
							<li><a href="#" data-toggle="modal" data-target="#myModal" loai="comment" loaiid="'.$this->id.'" request="report" class="jqueryoption">Báo cáo</a></li>
							<li><a href="#" data-toggle="modal" data-target="#myModal" loai="comment" loaiid="'.$this->id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
						</ul>
						</div><!-- /btn-group -->
					</div>   
						
				</div>
				<div class="noi-dung">
					'.$content.'	
					<a href="./#">(Đọc tiếp)</a>
				</div>
						
			</div>
				 
			<div class="activity col-sm-12"> 
				<button type="button" class="btn btn-default btn-sm actlike" request="like" likeid="'.$this->id.'">'.$check_likers['1'].'</button>
				<a href="#" style="margin-left:20px;">Không thích</a> 
				<a style="margin-left:20px;" data-toggle="collapse" href="#comment-collapse-'.$this->id.'" aria-expanded="false" aria-controls="comment-collapse-'.$this->id.'">Trả lời '.$commentNum.'</a>  
				<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
			</div> 	
			'.loadcomment('comment',$noidung['id']).'	
<div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div><div class="col-md-1"></div>		  
				  
			</div>
			';     		
		
	}
	
	public function toStringSmallVersion(){
		global $userDb;
		$user = $userDb->getUserByFbId($this->fbId);
		
		return '<div class="col-xs-12 col-sm-1">
					<img alt="'.$user->displayName.'" src="'.$user->avatar.'" class="profile_photo_img comment_image" height="25" width="25">
				</div>
				<div class="col-xs-12 col-sm-11">
					<strong class="pull-left primary-font">'.$user->displayName.'</strong>
					<small class="pull-right text-muted">
						<span class="glyphicon glyphicon-time"></span>time?
					</small>
					<br/>
					<li class="ui-state-default">'.$this->content.'</li>
					<br/>
				</div>';
	}
	
}

?>