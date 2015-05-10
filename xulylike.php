<?php


	require_once "./source/includes/data.php";
	require_once 'autoload.php';
	require_once "./function.php";	
	

if (($_SESSION['FBID']>0)&&($_GET['request']!=''))
{
	
	switch ($_GET['request']):
		case 'like':
		$content= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `id`= '".$_GET['likeid']."' AND `tinh-trang`= 'published' "));
		$loai=$content['loai'];
		if (checkliked($loai,$_GET['likeid'])=='no')
			{
			$time=date('Y-m-d H:i:s');
			$mmhclass->db->query("INSERT INTO `m_like` (`loai`, `fbid`,`loai-doi-tuong`,`doi-tuong-id`,`thoi-gian`) VALUES ('bai-viet', '{$_SESSION['FBID']}', '{$loai}','{$_GET['likeid']}','{$time}');");
			
			}else
			{
			$mmhclass->db->query("DELETE FROM `m_like` WHERE `fbid`= '".$_SESSION['FBID']."' AND `loai`= 'bai-viet' AND `loai-doi-tuong`= '".$loai."' AND `doi-tuong-id`= '".$_GET['likeid']."'");
			}
			$return = checklikers($content['loai'],$_GET['likeid']);
			echo $return['1'];
		
		break;


    	default:
    	
	endswitch; 	

}
?>