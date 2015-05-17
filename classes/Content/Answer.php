<?php
require_once "UserDb.php";
require_once "Content.php";

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
			
		$likeList = $likeDb->getLikeListByTargetId($this->id); //load_likers($loai,$loai_id,'tra-loi');
		$likeNum = count($likeList);
		$liker = "";
		for ($i = 0; $i < $likeNum; $i++) {
			$liker = $userDb->getUserByFbId($likeList[$i]->fbId);
			$likers.='<a href="./user/'.$liker->fbId.'">'.$liker->displayName.'</a>, '; 
		}
		$return = '<b>'.$likeNum.' lượt thích</b>';
		if ($i>0){
			$return = $return.'bởi'.$likers;
		}
		
		
		$commentList = $contentDb->getCommentLitByTargetId($this->id);
		$comment_num = count(commentList);
		if ($comment_num > 0){
			$comment_num = "(".$comment_num.")";
		} else {
			$comment_num = "";
		}
		$url=geturl($loai,$loai_id);$check_likers=checklikers($loai,$loai_id);
		

		
		$return='
			<div class="row postlayout">
				<div class="col-sm-11">
					<div class="row">
							'.$user->toStringForAnswer().'
							<div class="unimportant-lines">
							'.$likeinfo.'
							</div>      
						</div>
						<div class="col-xs-8 col-xs-1">
				
							<div class="btn-group">
							<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> 
								<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$loai_id.'" request="editpost" class="jqueryoption">Ch?nh s?a</a></li>
								<li><a href="#">Ngừng theo dõi bài</a></li>
								<li class="divider"></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$loai_id.'" request="report" class="jqueryoption">Bao cao</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$loai_id.'" request="delete" class="jqueryoption">Xoa</a></li>				  
							</ul>
							</div><!-- /btn-group -->
						</div>   
							
					</div>
					<div class="noi-dung col-sm-11">
						'.$content.'	
						<a href="./'.$url.'">(đọc tiếp)</a>
					</div>
							
				</div>
					 
				<div class="activity col-sm-12"> 
					<button type="button" class="btn btn-default btn-sm actlike" request="like" likeid="'.$loai_id.'">'.$check_likers['1'].'</button>
					<a href="#" style="margin-left:20px;">Khong thich</a> 
					<a style="margin-left:20px;" data-toggle="collapse" href="#comment-collapse-'.$noidung['id'].'" aria-expanded="false" aria-controls="comment-collapse-'.$noidung['id'].'">Trả lời '.$comment_num.'</a>  
					<a href="#" style="margin-left:20px;">L?u tr?, chia s?</a>  
				</div> 	'.loadcomment('tra-loi',$noidung['id']).'	
<div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div><div class="col-md-1"></div>		  
					  
				</div>
     			';
	}
}
?>