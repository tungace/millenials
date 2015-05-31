<?php
//require "ContentDb.php";

class Post extends Content {
	public function Post($postInfo){
        parent::Content($postInfo);
	}
	
	public function toStringWithComments(){
		global $contentDb;
        
        $commentList = $contentDb->getCommentListByTargetId($this->id);
		$commentContent = "";
		for($i = 0; $i < count($commentList); $i++){
			$commentContent .= $commentList[$i]->toStringBigVersion();
		}
        
        return $this->toStringWithoutComments().$commentContent;  
        
	}
    
    public function toStringWithoutComments(){
        global $userDb;
        global $likeDb;
		global $urlDb;
        global $gadgetHelper;
        
        $content = stripslashes($this->content);
		$preview = stripslashes($this->preview);			
		$tieude = stripslashes($this->title);	
		$the = stripslashes($this->tag);								
		$user = $userDb->getUserByFbId($this->fbId);
        $url = $urlDb->getUrl('bai-viet', $this->id);							
        
        return '<div class="row postlayout">
				    <div class="col-sm-11">
                        <div class="unimportant"> 
                            <div class="row">
                                <div class="col-xs-8 col-sm-11">
                                   <a href="./tags/'.$the.'" class="btn btn-default btn-xs active" role="button">'.$the.'</a>       
                                </div>
                                
                                <div class="col-xs-8 col-xs-1">
                                    <div class="btn-group">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" data-toggle="modal" data-target="#myModal" loai="bai-viet" loaiid="'.$this->id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
                                            <li><a href="#">Ngừng theo dõi bài</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" data-toggle="modal" data-target="#myModal" loai="bai-viet" loaiid="'.$this->id.'" request="report" class="jqueryoption">Báo cáo</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#myModal" loai="bai-viet" loaiid="'.$this->id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
                                        </ul>
                                    </div><!-- /btn-group -->
                                </div>
                            </div>
                        </div>
                        <a href="./'.$url.'"><htitle>'.$tieude.'</htitle></a>				
                        <div class="row">
                            '.$user->toStringForAnswer($likeDb->getLikeNumberByTargetId($this->id)).'
                        </div>
                        <div class="noi-dung">
                            <b><i>'.$preview.'</b></i>
                            <br>
                            <img src="'.$this->thumbnail.'" style="max-height:400px;max-width:400px;">
                            <br>
                            '.$content.'	
                        </div>
                    </div>   
                    <div class="activity col-sm-12">'
                        .$gadgetHelper->getLikeButtonByTargetId($this->id).
                        '<a href="#" style="margin-left:20px;">Không thích</a>' 
                        .$gadgetHelper->getCommentButtonByTargetId($this->id).
                        '<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
                    </div> 
                    '.$gadgetHelper->getCommentFieldBigVersionByTargetId($this->id).'				
                    <div class="col-md-1 sidebar"></div>
                    <div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div>
                    <div class="col-md-1"></div>		  
                </div>';
	}
}

?>