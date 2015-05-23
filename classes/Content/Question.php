<?php
//require "ContentDb.php";

class Question extends Content {
    public function Question($questionInfo){
        parent::Content($questionInfo);
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
        global $gadgetHelper;
        global $userDb;
        global $urlDb;
    
        $content = stripslashes($this->content);
        $tieude = stripslashes($this->title);	
        $the = stripslashes($this->tag);
        $url = $urlDb->getUrl('cau-hoi', $this->id);													
        $user = $userDb->getUserByFbId($this->fbId);
        
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
                                            <li><a href="#" data-toggle="modal" data-target="#myModal" loai="cau-hoi" loaiid="'.$this->id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
                                            <li><a href="#">Ngừng theo dõi bài</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" data-toggle="modal" data-target="#myModal" loai="cau-hoi" loaiid="'.$this->id.'" request="report" class="jqueryoption">Báo cáo</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#myModal" loai="cau-hoi" loaiid="'.$this->id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
                                        </ul>
                                    </div><!-- /btn-group -->
                                </div>
                            </div>
                        </div>
                                        
                        <a href="./'.$url.'"><hquestion>'.$tieude.'</hquestion></a>
                        <div class="noi-dung">
                            '.$content.'
                            <br/>
                        </div>
                    </div>			
                    <div class="activity col-sm-12">'
                        .$gadgetHelper->getFollowButtonByTargetId($this->id)
                        .$gadgetHelper->getCommentButtonByTargetId($this->id).  
                        '<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
                        <a href="#" style="margin-left:20px;">Không thích</a>  
                    </div> 
                    '.$gadgetHelper->getCommentFieldBigVersionByTargetId($this->id).'
                    <div class="col-md-1 sidebar"></div>
                    <div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;" ></div>
                    <div class="col-md-1"></div>
                </div>';  
    }
}

?>