<?php
//require "ContentDb.php";

class Comment extends Content {
	public function Comment($commentInfo){
		parent::Content($commentInfo);
	}
	
	public function toStringBigVersion() {
		global $userDb;
		global $likeDb;
		global $contentDb;
		global $gadgetHelper;
        
		$content = stripslashes($this->content);
		$user = $userDb->getUserByFbId($this->fbId);
		
		$commentList = $contentDb->getCommentListByTargetId($this->id);
		$commentContent = "";
		for ($i = 0; $i < count($commentList); $i++) {
			$commentContent .= $commentList[$i]->toStringSmallVersion();
		}
		
		return '<div class="row postlayout">
                    <div class="col-sm-11">
                        <div class="row">
                            <div class="col-xs-8 col-sm-1">
                                <img alt="'.$user->displayName.'" src="'.$user->avatar.'" height="32" width="32">      
                            </div>
                            <div class="col-xs-4 col-sm-10">
                                <author><a href="./user/'.$user->fbId.'">'.$user->displayName.', '.$user->role.' @ '.$user->workingAddress.'</a></author>
                                <br>
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
                    <div class="activity col-sm-12">'
                        .$gadgetHelper->getLikeButtonByTargetId($this->id).
                        '<a href="#" style="margin-left:20px;">Không thích</a>'
                        .$gadgetHelper->getCommentButtonByTargetId($this->id).
                        '<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
                    </div> 	
                    <div class="col-lg-11 col-sm-11 text-center collapse" id="comment-collapse-'.$this->id.'" style="padding-top:10px;">
                        <div class="well">
                            '.$gadgetHelper->getCommentFieldSmallVersionByTargetId($this->id).'
                            <hr data-brackets-id="12673">
                            <ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
                                <div class="row">
                                '.$commentContent.'
                                </div>
                            </ul>
                        </div>
                    </div>	
                    <div class="col-md-1 sidebar"></div>
                    <div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div>
                    <div class="col-md-1"></div>		  
                </div>';     		
	}
	
	public function toStringSmallVersion() {
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
					<br>
					<li class="ui-state-default">'.$this->content.'</li>
					<br>
				</div>';
	}
}

?>