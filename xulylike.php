<?php
require_once "./source/includes/data.php";
require_once "./autoload.php";
require_once "./function.php";	
	
require_once "./classes/GadgetHelper.php";
require_once "./classes/LikeDb.php";


if (($_SESSION['FBID'] > 0) && ($_GET['request']!='')) {
	global $likeDb;
	global $gadgetHelper;
	
	switch ($_GET['request']) {
	case "like" :
		$content = $mmhclass->db->fetch_array(
						$mmhclass->db->query("SELECT * FROM `m_content` WHERE `id`= '".$_GET['likeid']."' 
																					AND `tinh-trang`= 'published' "));
		$loai = $content['loai'];
		if ($likeDb->checkliked($_GET['likeid'])) {
			$mmhclass->db->query("DELETE FROM `m_like` WHERE `fbid`= '".$_SESSION['FBID']."' 
															AND `loai`= 'bai-viet' 
															AND `loai-doi-tuong`= '".$loai."' 
															AND `doi-tuong-id`= '".$_GET['likeid']."'");
		} else {
			$time = date('Y-m-d H:i:s');
			$mmhclass->db->query("INSERT INTO `m_like` (`loai`, `fbid`,`loai-doi-tuong`,`doi-tuong-id`,`thoi-gian`) 
									VALUES ('bai-viet', '{$_SESSION['FBID']}', '{$loai}','{$_GET['likeid']}','{$time}');");
			
		}
		
		echo $gadgetHelper->getLikeButtonContentByTargetId($_GET['likeid']);
		
		break;

	case "follow" :
		$content = $mmhclass->db->fetch_array(
		$mmhclass->db->query("SELECT * FROM `m_content` WHERE `id`= '".$_GET['likeid']."'
																				AND `tinh-trang`= 'published' "));
		$loai = $content['loai'];
		if ($likeDb->checkliked($_GET['likeid'])) {
			$mmhclass->db->query("DELETE FROM `m_like` WHERE `fbid`= '".$_SESSION['FBID']."' 
															AND `loai`= 'bai-viet' 
															AND `loai-doi-tuong`= '".$loai."' 
															AND `doi-tuong-id`= '".$_GET['likeid']."'");
		} else {
			$time=date('Y-m-d H:i:s');
			$mmhclass->db->query("INSERT INTO `m_like` (`loai`, `fbid`,`loai-doi-tuong`,`doi-tuong-id`,`thoi-gian`)
					VALUES ('bai-viet', '{$_SESSION['FBID']}', '{$loai}','{$_GET['likeid']}','{$time}');");
						
		}
		
		echo $gadgetHelper->getFollowButtonContentByTargetId($_GET['likeid']);
	
		break;
		
   	default:
   		echo "nothing";
    	break;		
	}
} else {
	echo "Login first!";
}
?>