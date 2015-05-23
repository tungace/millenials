<?php
require_once "UserDb.php";
require_once "ContentDb.php";
require_once "LikeDb.php";
require_once "UrlDb.php";

class Answer extends Content {
	public function Answer($answerInfo){
		Content($answerInfo);
	}

	public function toString(){
		global $userDb;
		global $likeDb;
		global $contentDb;
		
		$content = stripslashes($this->content);
		$user = $userDb->getUserByFbId($this->fbId); 
		
		$commentList = $contentDb->getCommentLitByTargetId($this->id);
		$comment_num = count(commentList);
		if ($comment_num > 0){
			$comment_num = "(".$comment_num.")";
		} else {
			$comment_num = "";
		}
		
		$commentContent = "";
		for($i = 0; $i < $comment_num; $i++){
			$commentContent .= $commentList[$i]->toStringSmallVersion();
		}
		
		$writeCommentField = "";
		if ($_SESSION['FBID']!='') {
			$writeCommentField = '
				<div class="row">
					<div class="col-xs-12 col-sm-1">
						<img alt="'.$_SESSION['FULLNAME'].'" src="https://graph.facebook.com/'.$_SESSION['FBID'].'/picture" class="profile_photo_img comment_image_add_root" height="25" width="25">		  
					</div>
					<div class="col-xs-12 col-sm-11">
		
						<div class="input-group">
						  <form class="form-horizontal" role="form" method="POST" action="/xuly.php">	
							<input id="userComment" class="form-control input-sm chat-input" name="noi-dung" placeholder="Write your comment here..." type="text">             
							<input value="'.$this->id.'" type="hidden" name="id-doi-tuong">
							<input value="comment" type="hidden" name="loai-doi-tuong">                       
							<input value="addcomment" type="hidden" name="request">          
							<span class="input-group-btn">     
								<button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-comment"></span> Add Comment</button>
							</span>
						</form>	
						</div>
					</div>
				</div>';
		}
		
		$commentContent = '
			<div class="col-lg-11 col-sm-11 text-center collapse" id="comment-collapse-'.$this->id.'" style="padding-top:10px;">
				<div class="well">
				'.$writeCommentField.'
				<hr data-brackets-id="12673">
				<ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
					<div class="row">
					'.$commentContent.'
					</div>
				</ul>
				</div>
			</div>';
		
		
		return '<div class="row postlayout">
					<div class="col-sm-11">
						<div class="row">
								'.$user->toStringForAnswer().'
								<div class="unimportant-lines">
								<b>'.$likeDb->getLikeNumByTargetId($this->id).' lượt thích</b>
								</div>      
							</div>
							<div class="col-xs-8 col-xs-1">
					
								<div class="btn-group">
								<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> 
									<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$this->id.'" request="editpost" class="jqueryoption">Ch?nh s?a</a></li>
									<li><a href="#">Ngừng theo dõi bài</a></li>
									<li class="divider"></li>
									<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$this->id.'" request="report" class="jqueryoption">Bao cao</a></li>
									<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$this->id.'" request="delete" class="jqueryoption">Xoa</a></li>				  
								</ul>
								</div><!-- /btn-group -->
							</div>   
								
						</div>
						<div class="noi-dung col-sm-11">
							'.$content.'	
							<a href="">(đọc tiếp)</a>
						</div>
								
					</div>
						 
					<div class="activity col-sm-12">'
						.$likeDb->getLikeButtonByTargetId($this->id).
						'<a href="#" style="margin-left:20px;">Khong thich</a> 
						<a style="margin-left:20px;" data-toggle="collapse" href="#comment-collapse-'.$this->id.'" aria-expanded="false" aria-controls="comment-collapse-'.$this->id.'">Trả lời '.$comment_num.'</a>  
						<a href="#" style="margin-left:20px;">L?u tr?, chia s?</a>  
					</div>'
					.$commentContent.
					'<div class="col-md-1 sidebar"></div>
					<div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div>
					<div class="col-md-1"></div>		  
						  
				</div>';
	}
	
	public function toStringHomePage(){
		global $userDb;
		global $likeDb;
		global $contentDb;
		global $urlDb;
		
		$content = stripslashes($this->content);
		$user = $userDb->getUserByFbId($this->fbId); 
		
		$the = stripslashes($this->tag);	
		$url = $urlDb->getUrl('tra-loi', $this->id);
		
		$commentList = $contentDb->getCommentLitByTargetId($this->id);
		$comment_num = count(commentList);
		if ($comment_num > 0){
			$comment_num = "(".$comment_num.")";
		} else {
			$comment_num = "";
		}
		
		$commentContent = "";
		for($i = 0; $i < $comment_num; $i++){
			$commentContent .= $commentList[$i]->toStringSmallVersion();
		}
		
		$writeCommentField = "";
		if ($_SESSION['FBID']!='') {
			$writeCommentField = '
				<div class="row">
					<div class="col-xs-12 col-sm-1">
						<img alt="'.$_SESSION['FULLNAME'].'" src="https://graph.facebook.com/'.$_SESSION['FBID'].'/picture" class="profile_photo_img comment_image_add_root" height="25" width="25">		  
					</div>
					<div class="col-xs-12 col-sm-11">
		
						<div class="input-group">
						  <form class="form-horizontal" role="form" method="POST" action="/xuly.php">	
							<input id="userComment" class="form-control input-sm chat-input" name="noi-dung" placeholder="Write your comment here..." type="text">             
							<input value="'.$this->id.'" type="hidden" name="id-doi-tuong">
							<input value="comment" type="hidden" name="loai-doi-tuong">                       
							<input value="addcomment" type="hidden" name="request">          
							<span class="input-group-btn">     
								<button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-comment"></span> Add Comment</button>
							</span>
						</form>	
						</div>
					</div>
				</div>';
		}
		
		$commentContent = '
			<div class="col-lg-11 col-sm-11 text-center collapse" id="comment-collapse-'.$this->id.'" style="padding-top:10px;">
				<div class="well">
				'.$writeCommentField.'
				<hr data-brackets-id="12673">
				<ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
					<div class="row">
					'.$commentContent.'
					</div>
				</ul>
				</div>
			</div>';
		
		
		return '<div class="row postlayout">
					<div class="col-sm-11">
						<div class="unimportant"> 
							<div class="row">
						
								<div class="col-xs-8 col-sm-11">
									<a href="./tags/'.$the.'" class="btn btn-default btn-xs active" role="button">'.$the.'</a>       
								</div>
								<div class="col-xs-8 col-xs-1">
									<div class="btn-group">
										<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> <span class="caret"></span></button>
										<ul class="dropdown-menu">
									<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$this->id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
									<li><a href="#">Ngừng theo dõi bài</a></li>
									<li class="divider"></li>
									<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$this->id.'" request="report" class="jqueryoption">Báo cáo</a></li>
									<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$this->id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
										</ul>
									</div><!-- /btn-group -->
								</div>
							</div>
						</div>
						<a href="./'.$url.'"><htitle>'.$this->title.'</htitle></a>				
						<div class="row">
								'.$user->toStringForAnswer().'
								<div class="unimportant-lines">
								<b>'.$likeDb->getLikeNumByTargetId($this->id).' lượt thích</b>
								</div>      
							</div>
						</div>
						<div class="noi-dung">
							'.$content.'	
							<a href="./'.$url.'">(Đọc tiếp)</a>
						</div>
								
					</div>
						 
					<div class="activity col-sm-12"> '
						.$likeDb->getLikeButtonByTargetId($this->id).
						'<a href="#" style="margin-left:20px;">Không thích</a> 
						<a style="margin-left:20px;" data-toggle="collapse" href="#comment-collapse-'.$noidung['id'].'" aria-expanded="false" aria-controls="comment-collapse-'.$noidung['id'].'">Trả lời '.$comment_num['1'].'</a>  
						<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
					</div> 	'.loadcomment('tra-loi',$noidung['id']).'			
	<div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div><div class="col-md-1"></div>		  
						  
					</div>';
	}
}
?>