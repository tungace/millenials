<?php
class GadgetHelper {
    public function GadgetHelper(){
    }
    
    public function getLikeButtonContentByTargetId($targetIdParam){
    	global $likeDb;
    
    	$likeNum = $likeDb->getLikeNumberByTargetId($targetIdParam);
    	$buttonContent = "";
    	if ($likeDb->checkLiked($targetIdParam)){
    		$buttonContent = "Đã thích";
    	} else {
    		$buttonContent = "Thích";
    	}
    	$buttonContent .= " | ".$likeNum;
    	return $buttonContent;
    }
    
    public function getLikeButtonByTargetId($targetIdParam){
        if ($_SESSION['FBID'] != null) {
            return 	'<button type="button" class="btn btn-default btn-sm actlike" request="like" likeid="'.$targetIdParam.'">'
                        .$this->getLikeButtonContentByTargetId($targetIdParam).
                    '</button>';
        } else {
            return 	'<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">'
                        .$this->getLikeButtonContentByTargetId($targetIdParam).
                    '</button>';
        }
	}
    
	public function getFollowButtonContentByTargetId($targetIdParam){
		global $likeDb;
	
		$likeNum = $likeDb->getLikeNumberByTargetId($targetIdParam);
		$buttonContent = "";
		if ($likeDb->checkLiked($targetIdParam)){
			$buttonContent = "Đã Quan tâm";
		} else {
			$buttonContent = "Quan tâm";
		}
		$buttonContent .= " | ".$likeNum;
		return $buttonContent;
	}
	
    public function getFollowButtonByTargetId($targetIdParam){
        if ($_SESSION['FBID'] != null) {
            return 	'<button type="button" class="btn btn-danger actlike" request="follow" likeid="'.$targetIdParam.'">'
                        .$this->getFollowButtonContentByTargetId($targetIdParam).
                    '</button>';
        } else {
            return 	'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">'
                        .$this->getFollowButtonContentByTargetId($targetIdParam).
                    '</button>';
        }
	}
    
    public function getCommentButtonByTargetId($targetIdParam){
        global $contentDb;
        
        $commentNum = $contentDb->getCommentNumByTargetId($targetIdParam);
		if ($commentNum > 0) {
			$commentNum = "(".$commentNum.")";
		} else {
			$commentNum = "";
		}
		
		return '<a style="margin-left:20px;" data-toggle="collapse" href="#comment-collapse-'.$targetIdParam.'" 
                        aria-expanded="false" aria-controls="comment-collapse-'.$targetIdParam.'">
                    Trả lời '.$commentNum.'
                </a>';
	}
    
    public function getCommentFieldSmallVersionByTargetId($targetIdParam) {
        if ($_SESSION['FBID']!='') {
            global $userDb;
            //global $contentDb;
            $user = $userDb->getUserByFbId($_SESSION['FBID']);
            //$comment = $contentDb->getCommentById($targetIdParam);
            
			$writeCommentField = '
				<div class="row">
					<div class="col-xs-12 col-sm-1">
						<img alt="'.$_SESSION['FULLNAME'].'" src="https://graph.facebook.com/'.$_SESSION['FBID'].'/picture" class="profile_photo_img comment_image_add_root" height="25" width="25">		  
					</div>
					<div class="col-xs-12 col-sm-11">
						<div class="input-group">
                            <form class="form-horizontal" role="form" method="POST" action="/index.php">	
                                <input id="userComment" class="form-control input-sm chat-input" name="noi-dung" placeholder="Write your comment here..." type="text">             
                                <input value="'.$targetIdParam.'" type="hidden" name="id-doi-tuong">
                                <!--input value="comment" type="hidden" name="loai-doi-tuong"-->
                                <input value="addcomment" type="hidden" name="request">          
                                <span class="input-group-btn">     
                                    <button type="submit" class="btn btn-primary btn-sm addCommentAction" 
                                            fbId="'.$user->fbId.'" targetId="'.$targetIdParam.'">
                                        <span class="glyphicon glyphicon-comment"></span> Add Comment
                                    </button>
                                </span>
                            </form>	
						</div>
					</div>
				</div>';
		}
        return $writeCommentField;
    }
    
    public function getCommentFieldBigVersionByTargetId($targetIdParam) {
        global $userDb;
        
        $fbId = $_SESSION['FBID'];
        
        if ($fbId != ''){
            $onlineuser = $userDb->getUserByFbId($fbId);
            
            $return =  '<div class="col-lg-11 col-sm-11 text-center collapse" style="padding-top:10px;" id="comment-collapse-'.$targetIdParam.'">
                            <div class="well">
                                <div class="row">
                                    <form class="form-horizontal" role="form" method="POST" action="/index.php">
                                        <div class="col-xs-12 col-sm-1">
                                            <img alt="'.$onlineuser->displayName.'" src="'.$onlineuser->avatar.'" class="profile_photo_img comment_image_add_root" height="25" width="25">		  
                                        </div>
                                        <div class="col-xs-12 col-sm-11" style="text-align:left;">
                                            <author><a href="./user/'.$_SESSION['FBID'].'"><b>'.$onlineuser->displayName.'</b></a></author>
                                            <br>
                                            
                                            <textarea class="form-control" rows="3" name="noi-dung"></textarea>									
                                            <br>  	              
                                            
                                            <input value="'.$targetIdParam.'" type="hidden" name="id-doi-tuong">
                                            <input value="addcomment" type="hidden" name="request">          
                                            <button type="submit" class="btn btn-primary addCommentAction">Submit</button>
                                            <br>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';
        }
        return $return;
    }
}

$gadgetHelper = new GadgetHelper();
?>