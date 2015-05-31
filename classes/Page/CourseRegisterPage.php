<?php
require_once "Page.php";

class CourseRegisterPage extends Page {
	public $courseId;
	
	public function CourseRegisterPage($idParam){
		$this->courseId = $idParam;
		
	}

	public function getLeftPanel(){
	}
	
	private function register_course($loai,$loai_id)
	{
		global $mmhclass;
		if ($_SESSION['FBID']!=''){
			//Đã đăng nhập, bh phải ktra trong m_like xem đã đăng ký chưa. nếu chưa đăng ký thì thay đổi m_like rồi redirect về dashboard. Nếu đký r, redirect về dashboard		
			$check= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_like` WHERE `doi-tuong-id`= '".$loai_id."'  AND `fbid`= '".$_SESSION['FBID']."' AND  `loai-doi-tuong`= 'khoa-hoc'"));
				//echo 'CHECK'; print_r($check);
				if ($check['id']==''){
				$mmhclass->db->query("INSERT INTO `m_like` (`loai`, `fbid`, `loai-doi-tuong`,`doi-tuong-id`) VALUES ('dang-ky', '{$_SESSION['FBID']}', 'khoa-hoc','{$loai_id}');");
				}
			$url_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `id-loai`= '".$loai_id."' AND `loai`= 'trang-chu-khoa-hoc'"));			
			//echo "URLINFO";print_r($url_info);
			header("Location: ./".$url_info['url']);
		} else {
			//echo "CHua DANG NHAP".$_GET['params'];
			//Chưa đăng nhập: Tạo 1 $_SESSION['link']=$_GET['params']; vào login();
			$_SESSION['link']=$_GET['params'];	
			login();
		}

	}
	
	public function getMainPanel(){
		register_course('khoa-hoc',$loai_id);
	}
	
	public function getRightPanel(){
	}
	
}

?>