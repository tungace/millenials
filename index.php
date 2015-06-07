<?php
require_once "./source/includes/data.php";
require_once "./autoload.php";
require_once "./function.php";	
require_once "./classes/Page/Page.php";
require_once "./classes/Page/HomePage.php";
require_once "./classes/Page/PostPage.php";
require_once "./classes/Page/QuestionPage.php";

require_once "./classes/Course.php";
require_once "./classes/GadgetHelper.php";
require_once "./classes/Like.php";
require_once "./classes/LikeDb.php";
require_once "./classes/UrlDb.php";
require_once "./classes/User.php";
require_once "./classes/UserDb.php";
require_once "./classes/Notification.php";
require_once "./classes/NotificationDb.php";
require_once "./classes/Content/Content.php";
require_once "./classes/Content/ContentDb.php";
require_once "./classes/Content/Comment.php";
require_once "./classes/Content/Post.php";
require_once "./classes/Content/Question.php";

require_once "./classes/Navbar.php";

/**
 * Use Tungace's fb account as default if this is localhost
 */
/*if (strpos($web_root, "localhost") !== FALSE){
	$_SESSION['FBID'] = "879505798754632"; // Tungace's account as default
}*/

if (($_SESSION['FBID'] != null) && ($_POST['request'] != '')) {
    switch ($_POST['request']) {
    case 'addcomment':
        $loai = 'comment';
        $id_doi_tuong = $_POST['id-doi-tuong'];
        $noi_dung = addslashes($_POST['noi-dung']);
        if ($noi_dung != '') {
            $time = date('Y-m-d H:i:s');
            $mmhclass->db->query("INSERT INTO `m_content` (`loai`, `fbid`, `id-doi-tuong`,`noi-dung`,`tinh-trang`,`thoi-gian`) 
                                    VALUES ('{$loai}', '{$_SESSION['FBID']}', '{$id_doi_tuong}', '{$noi_dung}', 'published', '{$time}');");
                
            $getback = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `id`= '".$id_doi_tuong."' AND `tinh-trang`= 'published' "));
            if ($getback['loai'] == 'comment') {
                $getback = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `id`= '".$getback['id-doi-tuong']."' AND `tinh-trang`= 'published' "));
            }
            $link = $urlDb->getUrl($getback['id']);
            $redirect = './'.$link;
            
            $author = $userDb->getUserByfbId($getback['fbid']);
            $sender = $userDb->getUserByfbId($_SESSION['FBID']);
            
            $type = $getback['loai'];
            if ($type == 'bai-viet') {
                $type = 'bài viết';
            } else if ($type == 'cau-hoi') {
                $type = 'câu hỏi';
            } else if ($type == 'comment') {
                $type = 'bình luận';
            }
            
            if ($author->fbId != $sender->fbId) {
                $content = $sender->displayName.' đã bình luận vào '.$type.' của '.$author->displayName.'.';
                $url = $urlDb->getUrl($getback['id']);
                $notificationDb->sendNotificationTo($author->fbId, $url, $content);
            }
            
            // gui notification den những người quan tâm đến câu hỏi
            if ($getback['loai'] == 'cau-hoi') {
                $likeList = $likeDb->getLikeListByTargetId($getback['id']);
                for ($i = 0; $i < count($likeList); $i++) { 
                    $liker = $userDb->getUserByFbId($likeList[$i]['fbid']);
                    
                    if ($liker->fbId != $sender->fbId) {
                        $content = $sender->displayName.' đã bình luận vào '.$type.' bạn quan tâm.';
                        $url = $urlDb->getUrl($getback['id']);
                        $notificationDb->sendNotificationTo($liker->fbId, $url, $content);
                    }
                }
            }
            
        }
        header("Location: ".$redirect);			    		
        break;    			
	
    default :
        break;     		        		    		        		   
	}
    return;
}

if (isset($_GET['action'])){
    if ($_SESSION['FBID'] > 0) {
        $_GET['action'] = addslashes($_GET['action']);
        switch ($_GET['action']) {
        case 'getNumPendingNotification' : 
            $pendingNotificationList = $notificationDb->getPendingNotificationListByFbId($_SESSION['FBID']);
            $notificationDb->receiveAllPendingNotificationsByFbId($_SESSION['FBID']);
            
            echo count($pendingNotificationList);
            break;
        
        case 'getNumReceivedNotification' : 
            $pendingNotificationList = $notificationDb->getReceivedNotificationListByFbId($_SESSION['FBID']);
            echo count($pendingNotificationList);
            break;
            
        case 'getReceivedNotification' : 
            $receivedNotificationList = $notificationDb->getReceivedNotificationListByFbId($_SESSION['FBID']);
            for ($i = 0; $i < count($receivedNotificationList); $i++) {
                echo $receivedNotificationList[$i]->toString();
            }
            break;
        
        case 'readAllReceivedNotification' :
            $notificationDb->readAllReceivedNotificationsByFbId($_SESSION['FBID']);
            break;
        default :
            break;
        }
    }
    return;
}

if (isset($_GET['params'])) {
    
	$_GET['params']=addslashes($_GET['params']);
    $params = explode( "/", $_GET['params'] );
	
    switch ($_GET['params']){
		case 'login':			//neu la login	
			login();
			break;
		 
		case 'cac-khoa-hoc':	//hien thi list cac khoa hoc
			echo show('cac-khoa-hoc');
			break;
			
		case 'cac-bai-viet':
			//hien thi cac bai viet
			echo showcacbaiviet();
			break;
			
		case 'about':
			//ve millenials
			echo showabout();
			break;
			
		case 'lien-he':
			//trang lien he
			echo showlienhe();
			break;

		case '404':
			//hien thi trang 404
			echo show404();
			break;
			
			
		default:
			
			$exist = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `url`= '".$_GET['params']."' AND `tinh-trang`!= 'deleted'"));
			if ($exist['loai']!='') {
				echo show($exist['loai'],$exist['id-loai']);
			} else {
				//header("Location: ./404");
			}

	}

} else {
    echo show('homepage');
}
?>