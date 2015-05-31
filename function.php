<?php
//
//
//
//		the millenials
//
//
//
session_start();
require_once "./source/includes/data.php";
require_once 'autoload.php';

function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}

function timeto($date) {
    $time[1]=date("j F y", $date);
    $time[2]=date("j", $date);
    $time[3]=date("F", $date);
    $time[4]=substr($time[3],'0','3');
    return $time;
}

///////////FUNCTION_3///////////////////

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


///////////FUNCTION_4///////////////////

function is_valid_email($email) {
    $result = TRUE;
    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
        $result = FALSE;
    }
    return $result;
}

/////////FUNCTION_5 //////////////////

function unicode_str_filter ($str){
    $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
    );
    foreach($unicode as $nonUnicode=>$uni){
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str=str_replace(" ","-",$str);
    $str=clean($str);
    return $str;
}

//////////////////////////////

function clean($string) {
   $string = str_replace('', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

//////////////////////////////

function login()
{
	global $mmhclass;
	$loginUrl = './fbconfig.php';
	header("Location: ".$loginUrl);
	return $_SESSION['FBID'];
}
//////////////////////////////

function showcackhoahoc()
{
	global $mmhclass;

return 'showcackhoahoc';
}
//////////////////////////////

function showcacbaiviet()
{
	global $mmhclass;

return 'showcacbaiviet';
}
//////////////////////////////

function showabout()
{
	global $mmhclass;

	return 'showabout';
}
//////////////////////////////

function showlienhe()
{
	global $mmhclass;

	return 'showlienhe';
}
//////////////////////////////

function show404()
{
	global $mmhclass;

	return '404';
}

//////////////////////////////

function show($loai, $loai_id) {
	global $mmhclass;
    $page = null;
	
	switch ($loai){
		case 'homepage' :		//neu la homepage
            $page = new HomePage();
     		break;
			
    	case 'dang-ky-khoa-hoc':
			$page = new CourseRegisterPage($loai_id);
			break;     
     		
    	case 'edit-user':
			$page = new EditUserPage($loai_id);
			break;   
       		
    	case 'user':
			$page = new UserPage($loai_id);
			break;    
			
    	case 'intro-khoa-hoc':
			$page = new CourseIntroPage($loai_id);
			break;	
			
    	case 'cac-khoa-hoc':
			break;   
			
    	case 'trang-chu-khoa-hoc':
    		break;
			   
		case 'danh-sach-bai-giang':
			break;
     		
    	case 'thong-tin-khoa-hoc':
		case 'tai-lieu':
		case 'thong-tin-huu-ich':
		case 'faq':
		case 'lien-lac':
			break;	
    	case 'bai-hoc':
			break;     			     			     		        		    		        		
    	case 'bai-viet':
            $page = new PostPage($loai_id);
			break;
    	case 'cau-hoi':
    		$page = new QuestionPage($loai_id);
			break;
    	case 'tra-loi':
			break;     		     		     		
    	default:
			break;

	}
	
    $left	= $page->getLeftPanel();
	$main	= $page->getMainPanel();
	$right	= $page->getRightPanel();
	
    return showtemplate($left, $main, $right, $loai, $loai_id); //sau khi đã có đầy đủ thông tin các phần quan trọng thì chèn vào template
}

function showtemplate($left, $main, $right, $loai, $loai_id)
{
	global $mmhclass;
	global $web_root;
	
	$header = showheader($loai,$loai_id);
	$raw= file_get_contents('./main.tpl');
		$re_header='<#HEADER#>';
		$re_left='<#LEFT_SIDEBAR#>';
		$re_main='<#MAIN#>';
		$re_right='<#RIGHT_SIDEBAR#>';
		$re_root='<#ROOT#>';
	$replace = array($header, $left, $main, $right, $web_root);
	$with = array($re_header, $re_left, $re_main, $re_right, $re_root);
	
	return str_replace($with, $replace, $raw);
}

function showheader($loai,$loai_id)
{
	global $mmhclass;
	
	switch ($loai){
    	case 'intro-khoa-hoc':
			$course_info = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `id`= '".$loai_id."' AND  `loai`= 'khoa-hoc'"));		
		
			$gioi_thieu = stripslashes($course_info['gioi-thieu']);
			$title = stripslashes($course_info['tieu-de']);	
			$video = $course_info['video'];
			if ($video==''){
				$video='<img src="'.$course_info['image'].'" style="max-height:300px;max-width:400px;">';
			}
			$return = '	<header class="jumbotron subhead" id="overview" style="background-color:#bbd8e9;">
							<div class="container">
								<div class="col-md-7 sidebar">
									<a href="#"><h2>'.$title.'</h2></a>
									<p class="lead">'.$gioi_thieu.'.</p>
								</div>
								<div class="col-md-5 sidebar">
									'.$video.'<a href="./'.get_course_register_link('khoa-hoc',$loai_id).'" class="btn btn-success btn-lg" role="button">Tham gia khóa học</a>  <a href="#about-the-course" class="btn btn-warning btn-lg" role="button">Thông tin thêm </a>
								</div>	
							</div>
						</header>';
     		break;
    	case 'cac-khoa-hoc':
			$return='
			<header class="jumbotron subhead" id="overview" style="background-color:#bbd8e9;">
			  <div class="container">
			    <h2>Các khóa học</h2>
			  </div>
			</header>';
     		break;     
		case 'user':
			$return='';
			break;     		        		   		   
		case 'trang-chu-khoa-hoc':
		case 'thong-tin-khoa-hoc':
		case 'danh-sach-bai-giang':
		case 'tai-lieu':
		case 'thong-tin-huu-ich':
		case 'faq':
		case 'lien-lac':
		case 'bai-hoc':
		case 'thao-luan':        		   
		case 'trang-chu-khoa-hoc':

			if ($loai=='bai-hoc'){
				$url_baihoc_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `id`= '".$loai_id."' AND `loai`= 'bai-hoc'"));	$loai_id=$url_baihoc_info['doi-tuong-id'];
			}	
			$course_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `id`= '".$loai_id."' AND  `loai`= 'khoa-hoc'"));			
			$tieu_de=stripslashes($course_info['tieu-de']);    		
				$return= '		
					<header class="jumbotron subhead" id="overview" style="background-color:#bbd8e9;">
					  <div class="container">
						<h2>'.$tieu_de.'</h2>
					  </div>
					</header>';
			break;	
     		        		    		        		   
    	default:
    	
			$return = '		
				<header class="jumbotron subhead" id="overview" style="background-color:#bbd8e9;">
				  <div class="container">
					<h1>Scaffolding</h1>
					<p class="lead">Bootstrap is built on responsive 12-column grids, layouts, and components.</p>
				
				  </div>
				</header>';
			$return='';
			break;
	} 	
	
	return $return;
}

function showleft($loai,$loai_id)
{
	global $mmhclass;
	
	switch ($loai){
    	case 'cac-khoa-hoc':
			$return='
					<div class="col-md-2 sidebar" style="font-weight:bold;">
						<ul class="nav nav-list bs-docs-sidenav">
							<li><a href="#global" class="list-group-item active"><i class="icon-chevron-right"></i> Trang chủ các khóa học</a></li>
							<li><a href="#gridSystem" class="list-group-item"><i class="icon-chevron-right"></i> Khóa học đã đăng ký</a></li>
							<li><a href="#responsive" class="list-group-item"><i class="icon-chevron-right"></i>Về các chương trình học</a></li>
							<br/><p>Liên kết</p>			
							<li><a href="#layouts" class="list-group-item"><i class="icon-chevron-right"></i> Trường đại học X</a></li>
							<li><a href="#layouts" class="list-group-item"><i class="icon-chevron-right"></i> Trung học Y</a></li>			
							<li><a href="#responsive" class="list-group-item"><i class="icon-chevron-right"></i>Trung tâm Z</a></li>
							<li><a href="#responsive" class="list-group-item"><i class="icon-chevron-right"></i>Giáo sư lọ</a></li>						
						</ul>
					</div>';
     		break;    
    	case 'trang-chu-khoa-hoc':
    	case 'thong-tin-khoa-hoc':
		case 'danh-sach-bai-giang':
		case 'tai-lieu':
		case 'thong-tin-huu-ich':
		case 'faq':
		case 'lien-lac':
		case 'bai-hoc':
		case 'thao-luan':   
			$courselink = get_course_link($loai,$loai_id);$courselink='./'.$courselink; 		
			$return= '		
				<div class="col-md-2 sidebar" style="font-weight:bold;">
					<ul class="nav nav-list bs-docs-sidenav">
						<li><a href="'.$courselink.'" class="list-group-item active"><i class="icon-chevron-right"></i> Bảng tin</a></li>
						<li><a href="'.$courselink.'/thong-tin-khoa-hoc" class="list-group-item"><i class="icon-chevron-right"></i> Về khóa học</a></li>
						<li><a href="'.$courselink.'/danh-sach-bai-giang" class="list-group-item"><i class="icon-chevron-right"></i> Danh sách bài giảng</a></li>
						<li><a href="'.$courselink.'/tai-lieu" class="list-group-item"><i class="icon-chevron-right"></i> Tài liệu liên quan</a></li>
						<li><a href="'.$courselink.'/thong-tin-huu-ich" class="list-group-item"><i class="icon-chevron-right"></i> Thông tin hữu ích</a></li>			
						<li><a href="'.$courselink.'#" class="list-group-item"><i class="icon-chevron-right"></i>Bài kiểm tra</a></li>
						<li><a href="'.$courselink.'#" class="list-group-item"><i class="icon-chevron-right"></i>Thảo luận</a></li>
						<li><a href="'.$courselink.'/faq" class="list-group-item"><i class="icon-chevron-right"></i>Quy chế và cách đánh giá</a></li>
						<li><a href="'.$courselink.'/lien-lac" class="list-group-item"><i class="icon-chevron-right"></i>Liên lạc với giảng viên</a></li>
					</ul>
				</div>';
			break;	     		    		   
    	default:
			$return= '		
				<div class=\'col-md-2 sidebar\'>
				<h3>Left Sidebar</h3>
				<ul class="nav nav-list bs-docs-sidenav">
					<li><a href="#global"><i class="icon-chevron-right"></i> Global styles</a></li>
					<li><a href="#gridSystem"><i class="icon-chevron-right"></i> Grid system</a></li>
					<li><a href="#fluidGridSystem"><i class="icon-chevron-right"></i> Fluid grid system</a></li>
					<li><a href="#layouts"><i class="icon-chevron-right"></i> Layouts</a></li>
					<li><a href="#responsive"><i class="icon-chevron-right"></i> Responsive design</a></li>
				</ul>
				<ul class="nav nav-tabs nav-stacked">
					<li><a href=\'#\'>Another Link 1</a></li>
					<li><a href=\'#\'>Another Link 2</a></li>
					<li><a href=\'#\'>Another Link 3</a></li>
				</ul>
			</div>';
	} 
	
	return $return;
}


function showmain($loai,$loai_id)
{
	global $mmhclass;
	global $contentDb;
    
	switch ($loai){
		
    	case 'intro-khoa-hoc':
			$main = load_course_intro('khoa-hoc',$loai_id);
			$return = '
				<div class="col-md-8 main panstyle" id="about-the-course">
				'.$main.'
				</div>';
     		break;	
			
    	case 'cac-khoa-hoc':
			$return= '<div class="col-md-10 main panstyle" id="about-the-course">'.load_cac_khoa_hoc().'</div>';
     		break;   
			
    	case 'trang-chu-khoa-hoc':
    		if (check_registered_course('khoa-hoc',$loai_id)=='1'){
				$return= '		
				<div class="col-md-8 main panstyle" id="about-the-course">
				'.load_course_dashboard('khoa-hoc',$loai_id).'
				</div>';
			} else {	
				$url_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `id-loai`= '".$loai_id."' AND `loai`= 'intro-khoa-hoc'"));			
				header("Location: ./".$url_info['url']);	
			}
     		break;
			   
		case 'danh-sach-bai-giang':
			redirect_ve_intro($loai,$loai_id);
		
			$return= '		
				<div class="col-md-8 main panstyle" id="about-the-course">
				<h2>Danh sách bài giảng</h2>
				<br/>			
				'.load_course_list($loai_id).'
				</div>';
     		break;
     		
    	case 'thong-tin-khoa-hoc':
		case 'tai-lieu':
		case 'thong-tin-huu-ich':
		case 'faq':
		case 'lien-lac':
			redirect_ve_intro($loai,$loai_id);		
			$course_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `loai`= 'khoa-hoc' AND  `id`= '".$loai_id."' "));		
			$main= stripslashes($course_info[$loai]);
			$return= '		
				<div class="col-md-8 main panstyle" id="about-the-course">
				<br/>			
				'.$main.'
				</div>';		
     		break;	
    	case 'bai-hoc':
			//neu la bai-hoczz
			$main=load_bai_hoc($loai_id);
			$return= '		
				<div class="col-md-10 main panstyle" id="about-the-course">
				'.$main.'
				</div>';
     		break;     			     			     		        		    		        		
    	case 'bai-viet' :
			//neu la bai-viet
            $post = $contentDb->getPostById($loai_id);
			$main = $post->toStringWithComments();
			$return= '		
				<div class="col-md-7 main">
				'.$main.'
				</div>';
     		break;
            
    	case 'cau-hoi' :
			//neu la cau-hoi
			$question = $contentDb->getQuestionById($loai_id);
			$main = $question->toStringWithComments();
			$return= '		
				<div class="col-md-7 main">
				'.$main.'
				</div>';
     		break;
            
    	case 'tra-loi' :
			//tra-loi
			$answer_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$loai."' AND  `id`= '".$loai_id."' "));		
			$main=load_single_post($answer_info['loai-doi-tuong'],$answer_info['id-doi-tuong']).load_single_post($loai,$loai_id).loadcomment($loai,$loai_id);
			$return= '		
				<div class="col-md-7 main">
				'.$main.'
				</div>';
     		break;     		     		     		
    	default:
			break;

	} 
	
	return $return;
}

function showright($loai,$loai_id)
{
	global $mmhclass;
	
	switch ($loai){
    	case 'bai-hoc':
		case 'cac-khoa-hoc':
			$return= '';
			break;     		   
		case 'trang-chu-khoa-hoc':
		case 'thong-tin-khoa-hoc':
		case 'danh-sach-bai-giang':
		case 'tai-lieu':
		case 'thong-tin-huu-ich':
		case 'faq':
		case 'lien-lac':
			$course_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT ghichu FROM `m_course` WHERE `id`= '".$loai_id."' AND  `loai`= 'khoa-hoc'"));		
			$ghichu=stripslashes($course_info['ghichu']);
		
			$return= '		
				<div class="col-md-2 sidebar">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Ghi chú</h3>
						</div>
						<div class="panel-body" style="font-size:10px;">
							'.$ghichu.'
						</div> 
					</div>
				</div>';
     		break;	

    	default:
			$return= '		
				<div class="col-md-3 sidebar">
				<h3>Right Sidebar</h3>
				<ul class="nav nav-tabs nav-stacked">
				<li><a href="#">Another Link 1</a></li>
				<li><a href="#">Another Link 2</a></li>
				<li><a href="#">Another Link 3</a></li>
				</ul>
				</div>';
			break;
	}
	return $return;
}

function check_registered_course($loai,$loai_id)
{
	global $mmhclass;
	$return='0';
	if ($_SESSION['FBID']!=''){
	$check= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_like` WHERE `doi-tuong-id`= '".$loai_id."' AND `fbid`= '".$_SESSION['FBID']."' AND  `loai-doi-tuong`= 'khoa-hoc'"));	
	if ($check['id']>0){$return='1';}
	}
	return $return;
}

function get_course_register_link($loai,$loai_id)
{
	global $mmhclass;
	$url_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `id-loai`= '".$loai_id."' AND `loai`= 'dang-ky-khoa-hoc'"));			
	return $url_info['url'];	
}

function load_course_dashboard($loai,$loai_id)
{
	global $mmhclass;
	$course_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `id`= '".$loai_id."' AND  `loai`= 'khoa-hoc'"));		
	$thong_tin=stripslashes($course_info['thong-tin-khoa-hoc']);
	$faq=stripslashes($course_info['faq']);
	$thong_tin_them=stripslashes($course_info['thong-tin-them']);	
	$return=$thong_tin_them.'<br/>'.$thong_tin.'<br/>'.$faq;
	return $return;	
}

function redirect_ve_intro($loai,$loai_id)
{
	global $mmhclass;
    		if (check_registered_course('khoa-hoc',$loai_id)!='1')
			{	
			$url_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `id-loai`= '".$loai_id."' AND `loai`= 'intro-khoa-hoc'"));			
			header("Location: ./".$url_info['url']);	
			}
}
function get_course_link($loai,$loai_id)
{
	global $mmhclass;
	if ($loai=='bai-hoc'){
	$url_baihoc_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `id`= '".$loai_id."' AND `loai`= 'bai-hoc'"));	
	$url_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `id-loai`= '".$url_baihoc_info['doi-tuong-id']."' AND `loai`= 'trang-chu-khoa-hoc'"));	
	$return=$url_info['url'];			
	}else
	{
	$url_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `id-loai`= '".$loai_id."' AND `loai`= 'trang-chu-khoa-hoc'"));	
	$return=$url_info['url'];	
	}
	return $return;	
}


function load_course_list($loai_id)
{
	global $mmhclass;
	$lesson_list=$mmhclass->db->query("SELECT * FROM `m_course`  WHERE `loai` = 'bai-hoc' AND `doi-tuong-id`= '".$loai_id."' ORDER BY `thu-tu` DESC");
	$i=0;
	while ($single_lesson= $mmhclass->db->fetch_array($lesson_list))
		{$i++;
		$tieu_de=stripslashes($single_lesson['tieu-de']);$url=geturl('bai-hoc',$single_lesson['id']);	
		$return=$return.'
			<tr>
		          <th scope="row">'.$i.'</th>
		          <td> <a href="./'.$url.'">'.$tieu_de.'</a></td>
		        </tr>
		        <tr>
		';
		}	
	$return = '
   <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Tiêu đề</th>
        </tr>
      </thead>
      <tbody>
	'.$return.'
      </tbody>
    </table>
	';	
	return $return;
}

function load_bai_hoc($loai_id)
{
	global $mmhclass;
	$baihoc_content= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `id`= '".$loai_id."' AND `loai`= 'bai-hoc'"));		
		$tieu_de=stripslashes($baihoc_content['tieu-de']);
		$noi_dung=stripslashes($baihoc_content['noi-dung']);
		$tom_tat=stripslashes($baihoc_content['tom-tat']);
	$danh_sach_bai_giang='<a class="btn btn-success btn-lg" href="./'.get_course_link('bai-hoc',$loai_id).'/danh-sach-bai-giang" role="button">Quay lại danh sách bài giảng</a> <br/><br/><br/>';
	$return='<h2>'.$tieu_de.'</h2><br/>'.$noi_dung.'<br/>'.$tom_tat.'<br/>'.$danh_sach_bai_giang;
	return $return;
}	

function load_cac_khoa_hoc()
{
	global $mmhclass;
	$course_list=$mmhclass->db->query("SELECT * FROM `m_course`  WHERE `loai` = 'khoa-hoc' ORDER BY `id` DESC");
	$i=0;
	while ($single_course= $mmhclass->db->fetch_array($course_list))
		{$i++;
		$tieu_de=stripslashes($single_course['tieu-de']);$url=geturl('intro-khoa-hoc',$single_course['id']);	$tac_gia=stripslashes($single_course['tac-gia']);
		$return=$return.'
			<div class="row jumbotron box-shadow">
			  <div class="col-sm-12">
			         <a href="./'.$url.'"><h2>'.$tieu_de.'</h2></a>
			    <div class="row">
			      <div class="col-xs-8 col-sm-2">
			<img src="'.$single_course['image'].'" style="height: 68px;
			width: 120px;">      
			      </div>
				  <div class="col-xs-4 col-sm-10">
			        <p>'.$tac_gia.'</p>
			        <p>
			          <a class="btn btn-lg btn-primary" href="./'.$url.'" role="button">Xem thông tin khóa học</a>
			        </p>
			      </div>
			    </div>
			  </div>
			</div>
		';
		}	

	return $return;
}


?>