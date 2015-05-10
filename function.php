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

function timeto($date)
{
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

function is_valid_email($email) 
{
  $result = TRUE;
  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) 
  	{
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
'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
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
	$loginUrl='http://tungace.com/fbconfig.php';
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

function show($loai,$loai_id)
{
	global $mmhclass;

	$left=showleft($loai,$loai_id);
	$main=showmain($loai,$loai_id);
	$right=showright($loai,$loai_id);	

$return = showtemplate($left,$main,$right,$loai,$loai_id); //sau khi đã có đầy đủ thông tin các phần quan trọng thì chèn vào template
return $return;
}

function showtemplate($left,$main,$right,$loai,$loai_id)
{
	global $mmhclass;
	$header=showheader($loai,$loai_id);
	$raw= file_get_contents('./main.tpl');
		$re_header='<#HEADER#>';
		$re_left='<#LEFT_SIDEBAR#>';
		$re_main='<#MAIN#>';
		$re_right='<#RIGHT_SIDEBAR#>';
	$replace= array($header,$left,$main,$right);
	$with= array($re_header,$re_left,$re_main,$re_right);
	$return.= str_replace($with, $replace, $raw);		
	return $return;
}

function showheader($loai,$loai_id)
{
	global $mmhclass;
	
	
	switch ($loai):
    		case 'intro-khoa-hoc':
		$course_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `id`= '".$loai_id."' AND  `loai`= 'khoa-hoc'"));		
	
		$gioi_thieu=stripslashes($course_info['gioi-thieu']);
		$title=stripslashes($course_info['tieu-de']);	
		$video=$course_info['video'];
		if ($video==''){$video='<img src="'.$course_info['image'].'" style="max-height:300px;max-width:400px;">';}
		$return= '		
		<header class="jumbotron subhead" id="overview" style="background-color:#bbd8e9;">
		  <div class="container">
		  	<div class="col-md-7 sidebar">
		
		    <a href="#"><h2>'.$title.'</h2></a>
		    <p class="lead">'.$gioi_thieu.'.</p>
			</div>
		  	<div class="col-md-5 sidebar">
		'.$video.'  	<a href="http://tungace.com/'.get_course_register_link('khoa-hoc',$loai_id).'" class="btn btn-success btn-lg" role="button">Tham gia khóa học</a>  <a href="#about-the-course" class="btn btn-warning btn-lg" role="button">Thông tin thêm </a>
		</div>	
		
		  </div>
		</header>
		';
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
				</header>
			';
     		   break;	
     		        		    		        		   
    	default:
    	
		$return= '		
			<header class="jumbotron subhead" id="overview" style="background-color:#bbd8e9;">
			  <div class="container">
			    <h1>Scaffolding</h1>
			    <p class="lead">Bootstrap is built on responsive 12-column grids, layouts, and components.</p>
			
			  </div>
			</header>
		';
		$return='';
	endswitch; 	
	


	return $return;
}

function showleft($loai,$loai_id)
{
	global $mmhclass;
	
	switch ($loai):
    		case 'homepage':
		//neu la homepage
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
     		   break;
    		case 'intro-khoa-hoc':
		$return= '';
     		   break; 
    		case 'edit-user':
		$return='';

     		break;          		     		   
    		case 'user':
    		$user_info=load_user_single_info('1','1','1','1','1','1',$loai_id);
		$return= '
		<div class="col-md-2 sidebar">
		
<div class="row">
          <img width="200" height="200" alt="'.$user_info['ten-hien-thi'].'" src="'.$user_info['avatar'].'" class="profile_photo_img img-thumbnail">
        </div>		
			<h3>Đóng góp</h3>
			<ul class="nav nav-list bs-docs-sidenav">
			<li><a href="#global"><i class="icon-chevron-right"></i> Khóa học</a></li>
			<li><a href="#gridSystem"><i class="icon-chevron-right"></i> Bài viết</a></li>
			<li><a href="#fluidGridSystem"><i class="icon-chevron-right"></i> Câu trả lời</a></li>
			<li><a href="#layouts"><i class="icon-chevron-right"></i> Câu hỏi</a></li>
			<li><a href="#responsive"><i class="icon-chevron-right"></i> Bình luận</a></li>
			</ul>
		
		</div>
		';
     		   break;      		   

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
		$courselink = get_course_link($loai,$loai_id);$courselink='http://tungace.com/'.$courselink; 		
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

	endswitch; 
	
	return $return;
}

function showmain($loai,$loai_id)
{
	global $mmhclass;
	
	switch ($loai):
    		case 'homepage':
		//neu la homepage
		$postlist=$mmhclass->db->query("SELECT * FROM `m_content`  WHERE `loai` IN ('bai-viet', 'cau-hoi') AND `tinh-trang` = 'published' LIMIT 0 , 30");
		$i=0;
		//if (mysql_num_rows ($menulist)>0){$menu='<ul>';}
		while ($article= $mmhclass->db->fetch_array($postlist))
		{
		$loai=$article['loai'].'-homepage';
		$main.=load_single_post($loai,$article['id']);
		}

		$return= '		
			<div class="col-md-7 main">
			'.$main.'
			</div>';
     		break;
    		case 'dang-ky-khoa-hoc':
		register_course('khoa-hoc',$loai_id);

     		break;     
     		
    		case 'edit-user':
		$return=edit_user_bio($loai_id);

     		break;          		
    		case 'user':
		$return='<div class="col-md-7 main">'.user_bio_page($loai_id).'</div>';
     		break;     		        				   
    		case 'intro-khoa-hoc':
		$main=load_course_intro('khoa-hoc',$loai_id);
		$return = '
			<div class="col-md-8 main panstyle" id="about-the-course">
			'.$main.'
			</div>';
     		break;	
    		case 'cac-khoa-hoc':
		$return= '
				<div class="col-md-10 main panstyle" id="about-the-course">
				'.load_cac_khoa_hoc().'</div>
		';
     		   break;     		   				     		       		   				     		
    		case 'trang-chu-khoa-hoc':
    		if (check_registered_course('khoa-hoc',$loai_id)=='1')
			{$return= '		
			<div class="col-md-8 main panstyle" id="about-the-course">
			'.load_course_dashboard('khoa-hoc',$loai_id).'
			</div>';
			}else{	
			$url_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `id-loai`= '".$loai_id."' AND `loai`= 'intro-khoa-hoc'"));			
			header("Location: http://tungace.com/".$url_info['url']);	
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
    		case 'bai-viet':
		//neu la bai-viet
		$main=load_single_post($loai,$loai_id).loadcomment($loai,$loai_id);
		$return= '		
			<div class="col-md-7 main">
			'.$main.'
			</div>';
     		break;
    		case 'cau-hoi':
		//neu la cau-hoi
		$main=load_single_post($loai,$loai_id).loadcomment($loai,$loai_id);
		$return= '		
			<div class="col-md-7 main">
			'.$main.'
			</div>';
     		break;
    		case 'tra-loi':
		//tra-loi
		$answer_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$loai."' AND  `id`= '".$loai_id."' "));		
		$main=load_single_post($answer_info['loai-doi-tuong'],$answer_info['id-doi-tuong']).load_single_post($loai,$loai_id).loadcomment($loai,$loai_id);
		$return= '		
			<div class="col-md-7 main">
			'.$main.'
			</div>';
     		break;     		     		     		
    	default:


	endswitch; 
	
	return $return;
}

function showright($loai,$loai_id)
{
	global $mmhclass;
	
	switch ($loai):
    		case 'homepage':
		//neu la homepage
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
    		case 'bai-hoc':
    		case 'cac-khoa-hoc':
    		case 'edit-user':
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

	endswitch; 
	
	
	return $return;
}

function load_user_basic_info($avatar,$ten,$title,$purpose,$fbid)
{
	global $mmhclass;
	$user_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_user` WHERE `fbid`= '".$fbid."'"));
	
	if ($avatar=='1'){$avatar=$user_info['avatar'];}
	if ($ten=='1'){$ten=$user_info['ten-hien-thi'];}
	if ($title=='1'){$title=$user_info['chuc-vu'].$user_info['noi-lam-viec'];}
	
	switch ($purpose):
	
    		case 'tra-loi':
		$return= '		
			<div class="col-xs-8 col-sm-1">
			<img alt="'.$ten.'" src="'.$avatar.'" height="32" width="32">      </div>
			<div class="col-xs-4 col-sm-10">
			<author><a href="http://tungace.com/user/'.$fbid.'">'.$ten.', '.$title.'</a></author><br>';
     		break;
     		
    		case 'tuong-tac':
		$return= '		
 			<a href="http://tungace.com/user/'.$fbid.'"> <img alt="'.$ten.'" src="'.$avatar.'" class="profile_photo_img" height="18" width="18"> '.$ten.'</a> ';
     		break;     		   
    	default:
	$return['avatar']=$avatar;
	$return['ten-hien-thi']=$ten;
	$return['chuc-vu']=$title;
	$return['fbid']=$fbid;
	endswitch; 
	return $return;
}

function load_likers($loai,$loai_id,$purpose)
{
	global $mmhclass;
	$number_likes= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT thich FROM `m_content` WHERE `loai`= '".$loai."' AND `id`= '".$loai_id."' "));


	switch ($purpose):
    		case 'tra-loi':
    		$total_likers=$mmhclass->db->query("SELECT * FROM `m_like`  WHERE `loai` = 'thich' AND `loai-doi-tuong`= '".$loai."' AND `doi-tuong-id`= '".$loai_id."'  ORDER BY `id` DESC LIMIT 4");$i=0;		
    		while ($single_like= $mmhclass->db->fetch_array($total_likers))
		{
		$i++;
		$likerinfo=load_user_basic_info('0','1','0','0',$single_like['fbid']);
		$likers.='<a href="http://tungace.com/user/'.$fbid.'">'.$likerinfo['ten-hien-thi'].'</a>, '; 
		}
		$return = '<b>'.$i.' lượt thích</b>';
		if ($i>0){$return=$return.'bởi'.$likers;}
     		break;
     		
    	default:
		$return=$number_likes['thich'];
	endswitch; 
	return $return;
}

function geturl($loai,$loai_id)
{
	global $mmhclass;
	if ($loai=='comment'){	
	$noidung= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$loai."' AND `id`= '".$loai_id."' AND `tinh-trang`= 'published'  "));
	$loai=$noidung['loai-doi-tuong'];
	$loai_id=$noidung['id-doi-tuong'];
	}
	
	$url= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `loai`= '".$loai."' AND `id-loai`= '".$loai_id."' AND `tinh-trang`= 'published'  "));	
	return $url['url'];
}

function load_single_post($loai,$loai_id)
{
	global $mmhclass;
	switch ($loai): 
    		case 'tra-loi':
			$noidung= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$loai."' AND `id`= '".$loai_id."' AND `tinh-trang`= 'published'  "));
			$content=stripslashes($noidung['noi-dung']);
			$userinfo= load_user_basic_info('1','1','1','tra-loi',$noidung['fbid']);
			$likeinfo=load_likers($loai,$loai_id,'tra-loi');
			$so_like=load_likers($loai,$loai_id,'0');	$comment_num=checkreply($loai,$loai_id);
			$url=geturl($loai,$loai_id);$check_likers=checklikers($loai,$loai_id);
     			$return='
			<div class="row postlayout">
					  
				<div class="col-sm-11">
					<div class="row">
							'.$userinfo.'
							<div class="unimportant-lines">
							'.$likeinfo.'
							</div>      
						</div>
						<div class="col-xs-8 col-xs-1">
				
							<div class="btn-group">
							<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> 
								<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$loai_id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
								<li><a href="#">Ngừng theo dõi bài</a></li>
								<li class="divider"></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$loai_id.'" request="report" class="jqueryoption">Báo cáo</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$loai_id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
							</ul>
							</div><!-- /btn-group -->
						</div>   
							
					</div>
					<div class="noi-dung col-sm-11">
						'.$content.'	
						<a href="http://tungace.com/'.$url.'">(Đọc tiếp)</a>
					</div>
							
				</div>
					 
				<div class="activity col-sm-12"> 
					<button type="button" class="btn btn-default btn-sm actlike" request="like" likeid="'.$loai_id.'">'.$check_likers['1'].'</button>
					<a href="#" style="margin-left:20px;">Không thích</a> 
					<a style="margin-left:20px;" data-toggle="collapse" href="#comment-collapse-'.$noidung['id'].'" aria-expanded="false" aria-controls="comment-collapse-'.$noidung['id'].'">Trả lời '.$comment_num['1'].'</a>  
					<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
				</div> 	'.loadcomment('tra-loi',$noidung['id']).'	
<div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div><div class="col-md-1"></div>		  
					  
				</div>
     			';
     		
     		break;

    		case 'tra-loi-homepage':
			$noidung= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'tra-loi' AND `id`= '".$loai_id."' AND `tinh-trang`= 'published'  "));
			$content=stripslashes($noidung['noi-dung']);
			$tieude=stripslashes($noidung['tieu-de']);	
			$the=stripslashes($noidung['the']);								
			$userinfo= load_user_basic_info('1','1','1','tra-loi',$noidung['fbid']);
			$likeinfo=load_likers($loai,$loai_id,'tra-loi');
			$url=geturl('tra-loi',$loai_id);			
			$so_like=load_likers($loai,$loai_id,'0');	$comment_num=checkreply($loai,$loai_id);$check_likers=checklikers('tra-loi',$loai_id);
     			$return='
			<div class="row postlayout">
					  
				<div class="col-sm-11">
					<div class="unimportant"> 
						<div class="row">
					
							<div class="col-xs-8 col-sm-11">
								<a href="http://tungace.com/tags/'.$the.'" class="btn btn-default btn-xs active" role="button">'.$the.'</a>       
							</div>
							<div class="col-xs-8 col-xs-1">
								<div class="btn-group">
									<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> <span class="caret"></span></button>
									<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$loai_id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
								<li><a href="#">Ngừng theo dõi bài</a></li>
								<li class="divider"></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$loai_id.'" request="report" class="jqueryoption">Báo cáo</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="tra-loi" loaiid="'.$loai_id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
									</ul>
								</div><!-- /btn-group -->
							</div>
						</div>
					</div>
					<a href="http://tungace.com/'.$url.'"><htitle>'.$tieude.'</htitle></a>				
					<div class="row">
							'.$userinfo.'
							<div class="unimportant-lines">
							'.$likeinfo.'
							</div>      
						</div>
					</div>
					<div class="noi-dung">
						'.$content.'	
						<a href="http://tungace.com/'.$url.'">(Đọc tiếp)</a>
					</div>
							
				</div>
					 
				<div class="activity col-sm-12"> 
					<button type="button" class="btn btn-default btn-sm actlike" request="like" likeid="'.$loai_id.'">'.$check_likers['1'].'</button>
					<a href="#" style="margin-left:20px;">Không thích</a> 
					<a style="margin-left:20px;" data-toggle="collapse" href="#comment-collapse-'.$noidung['id'].'" aria-expanded="false" aria-controls="comment-collapse-'.$noidung['id'].'">Trả lời '.$comment_num['1'].'</a>  
					<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
				</div> 	'.loadcomment('tra-loi',$noidung['id']).'			
<div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div><div class="col-md-1"></div>		  
					  
				</div>
     			';
     		
     		break;
     		
    		case 'cau-hoi':
			$noidung= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$loai."' AND `id`= '".$loai_id."' AND `tinh-trang`= 'published' "));
			$content=stripslashes($noidung['noi-dung']);
			$tieude=stripslashes($noidung['tieu-de']);			
			$the=stripslashes($noidung['the']);											
			$url=geturl($loai,$loai_id);						
			$userinfo= load_user_basic_info('1','1','1','0',$noidung['fbid']);$comment_num=checkreply($loai,$loai_id);
			$so_like=load_likers($loai,$loai_id,'0');	$tra_loi_cau_hoi=tra_loi_cau_hoi($loai,$loai_id);$check_likers=checklikers($loai,$loai_id);
			$return='
			<div class="row postlayout">
				<div class="col-sm-11">
					<div class="unimportant"> 
						<div class="row">
					
							<div class="col-xs-8 col-sm-11">
					
								<a href="http://tungace.com/tags/'.$the.'" class="btn btn-default btn-xs active" role="button">'.$the.'</a>       
							</div>
							<div class="col-xs-8 col-xs-1">
								<div class="btn-group">
									<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> <span class="caret"></span></button>
									<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="cau-hoi" loaiid="'.$loai_id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
								<li><a href="#">Ngừng theo dõi bài</a></li>
								<li class="divider"></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="cau-hoi" loaiid="'.$loai_id.'" request="report" class="jqueryoption">Báo cáo</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="cau-hoi" loaiid="'.$loai_id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
									</ul>
								</div><!-- /btn-group -->
							</div>
						</div>
					</div>
									


						<a href="http://tungace.com/'.$url.'"><hquestion>'.$tieude.'</hquestion></a>


					<div class="noi-dung">
					'.$content.'<br/>
					</div>
				</div>								
					<div class="activity col-sm-12"> 
						<div class="btn-group" data-toggle="buttons-checkbox">
							<button type="button" class="btn btn-danger actlike" request="like" likeid="'.$loai_id.'">'.$check_likers['1'].'</button>
						</div>	  
						<a style="margin-left:20px;" data-toggle="collapse" href="#tra-loi-collapse-'.$noidung['id'].'" aria-expanded="false" aria-controls="tra-loi-collapse-'.$noidung['id'].'">Trả lời '.$comment_num['1'].'</a>  
						<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
						<a href="#" style="margin-left:20px;">Không thích</a>  
					</div> 
				'.$tra_loi_cau_hoi.'
						
			<div class=\'col-md-1 sidebar\'></div><div class=\'col-md-10\' style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;" ></div><div class=\'col-md-1\'></div>
			</div>			
			';
     		break;
     		
    		case 'cau-hoi-homepage':
		$noidung= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'cau-hoi' AND `id`= '".$loai_id."' AND `tinh-trang`= 'published' "));
			$content=stripslashes($noidung['noi-dung']);
			$tieude=stripslashes($noidung['tieu-de']);	
			$the=stripslashes($noidung['the']);
			$url=geturl('cau-hoi',$loai_id);													
			$userinfo= load_user_basic_info('1','1','1','0',$noidung['fbid']);$comment_num=checkreply($loai,$loai_id);
			$so_like=load_likers($loai,$loai_id,'0');		$tra_loi_cau_hoi=tra_loi_cau_hoi('cau-hoi',$loai_id);	$check_likers=checklikers('cau-hoi',$loai_id);
			$return='
			<div class="row postlayout">
				<div class="col-sm-11">
					<div class="unimportant"> 
						<div class="row">
					
							<div class="col-xs-8 col-sm-11">
					
								<a href="http://tungace.com/tags/'.$the.'" class="btn btn-default btn-xs active" role="button">'.$the.'</a>       
							</div>
							<div class="col-xs-8 col-xs-1">
								<div class="btn-group">
									<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> <span class="caret"></span></button>
									<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="cau-hoi" loaiid="'.$loai_id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
								<li><a href="#">Ngừng theo dõi bài</a></li>
								<li class="divider"></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="cau-hoi" loaiid="'.$loai_id.'" request="report" class="jqueryoption">Báo cáo</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="cau-hoi" loaiid="'.$loai_id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
									</ul>
								</div><!-- /btn-group -->
							</div>
						</div>
					</div>
									


						<a href="http://tungace.com/'.$url.'"><hquestion>'.$tieude.'</hquestion></a>
					<div class="noi-dung">
					'.$content.'<br/>
					</div>
				</div>			
	
					<div class="activity col-sm-12"> 
						<div class="btn-group" data-toggle="buttons-checkbox">
							<button type="button" class="btn btn-danger actlike" request="like" likeid="'.$loai_id.'">'.$check_likers['1'].'</button>
						</div>	  
						<a style="margin-left:20px;" data-toggle="collapse" href="#tra-loi-collapse-'.$noidung['id'].'" aria-expanded="false" aria-controls="tra-loi-collapse-'.$noidung['id'].'">Trả lời '.$comment_num['1'].'</a>  
						<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
						<a href="#" style="margin-left:20px;">Không thích</a>  
					</div> '.$tra_loi_cau_hoi.'
			<div class=\'col-md-1 sidebar\'></div><div class=\'col-md-10\' style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;" ></div><div class=\'col-md-1\'></div>

			</div>			
			';     		
     		
     		break;     	
     			
    		case 'bai-viet':
		$noidung= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$loai."' AND `id`= '".$loai_id."' AND `tinh-trang`= 'published'"));
			$content=stripslashes($noidung['noi-dung']);
			$preview=stripslashes($noidung['preview']);			
			$thumbnail=$noidung['thumbnail'];						
			$tieude=stripslashes($noidung['tieu-de']);	
			$the=stripslashes($noidung['the']);								
			$userinfo= load_user_basic_info('1','1','1','tra-loi',$noidung['fbid']);
			$likeinfo=load_likers($loai,$loai_id,'tra-loi');$comment_num=checkreply($loai,$loai_id);
			$so_like=load_likers($loai,$loai_id,'0');$check_likers=checklikers($loai,$loai_id);
			$url=geturl($loai,$loai_id);							$tra_loi_cau_hoi=tra_loi_cau_hoi($loai,$loai_id);
     			$return='
			<div class="row postlayout">
					  
				<div class="col-sm-11">
					<div class="unimportant"> 
						<div class="row">
					
							<div class="col-xs-8 col-sm-11">
					
								<a href="http://tungace.com/tags/'.$the.'" class="btn btn-default btn-xs active" role="button">'.$the.'</a>       
							</div>
							<div class="col-xs-8 col-xs-1">
								<div class="btn-group">
									<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> <span class="caret"></span></button>
									<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="bai-viet" loaiid="'.$loai_id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
								<li><a href="#">Ngừng theo dõi bài</a></li>
								<li class="divider"></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="bai-viet" loaiid="'.$loai_id.'" request="report" class="jqueryoption">Báo cáo</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="bai-viet" loaiid="'.$loai_id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
									</ul>
								</div><!-- /btn-group -->
							</div>
						</div>
					</div>
					<a href="http://tungace.com/'.$url.'"><htitle>'.$tieude.'</htitle></a>				
					<div class="row">
							'.$userinfo.'
							<div class="unimportant-lines">
							'.$likeinfo.'
							</div>      
						</div>
					</div>
					<div class="noi-dung">
						<b><i>'.$preview.'</b></i><br/><img src="'.$thumbnail.'" style="max-height:400px;max-width:400px;"><br/>'.$content.'	

					</div>
							
				</div>
					 
				<div class="activity col-sm-12"> 
					<button type="button" class="btn btn-default btn-sm actlike" request="like" likeid="'.$loai_id.'">'.$check_likers['1'].'</button>
					<a href="#" style="margin-left:20px;">Không thích</a> 
					<a style="margin-left:20px;" data-toggle="collapse" href="#tra-loi-collapse-'.$noidung['id'].'" aria-expanded="false" aria-controls="tra-loi-collapse-'.$noidung['id'].'">Trả lời '.$comment_num['1'].'</a>  
					<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
				</div> 
				'.$tra_loi_cau_hoi.'				
<div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div><div class="col-md-1"></div>		  
					  
				</div>
     			';     		
     		break;  

     			
    		case 'bai-viet-homepage':
		$noidung= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= 'bai-viet' AND `id`= '".$loai_id."' AND `tinh-trang`= 'published'"));
			$content=stripslashes($noidung['noi-dung']);
			$preview=stripslashes($noidung['preview']);			
			$thumbnail=$noidung['thumbnail'];						
			$tieude=stripslashes($noidung['tieu-de']);	
			$the=stripslashes($noidung['the']);								
			$userinfo= load_user_basic_info('1','1','1','tra-loi',$noidung['fbid']);
			$likeinfo=load_likers($loai,$loai_id,'tra-loi');$check_likers=checklikers('bai-viet',$loai_id);
			$so_like=load_likers($loai,$loai_id,'0');	$comment_num=checkreply($loai,$loai_id);
			$url=geturl('bai-viet',$loai_id);					$tra_loi_cau_hoi=tra_loi_cau_hoi("bai-viet",$loai_id);	
     			$return='
			<div class="row postlayout">
					  
				<div class="col-sm-11">
					<div class="unimportant"> 
						<div class="row">
					
							<div class="col-xs-8 col-sm-11">
					
								<a href="http://tungace.com/tags/'.$the.'" class="btn btn-default btn-xs active" role="button">'.$the.'</a>       
							</div>
							<div class="col-xs-8 col-xs-1">
								<div class="btn-group">
									<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> <span class="caret"></span></button>
									<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="bai-viet" loaiid="'.$loai_id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
								<li><a href="#">Ngừng theo dõi bài</a></li>
								<li class="divider"></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="bai-viet" loaiid="'.$loai_id.'" request="report" class="jqueryoption">Báo cáo</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="bai-viet" loaiid="'.$loai_id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
									</ul>
								</div><!-- /btn-group -->
							</div>
						</div>
					</div>
					<a href="http://tungace.com/'.$url.'"><htitle>'.$tieude.'</htitle></a>				
					<div class="row">
							'.$userinfo.'
							<div class="unimportant-lines">
							'.$likeinfo.'
							</div>      
						</div>
					</div>
					<div class="noi-dung">
						<b><i>'.$preview.'</b></i><br/><img src="'.$thumbnail.'" style="max-height:400px;max-width:400px;"><br/>
						<a href="http://tungace.com/'.$url.'">(Đọc tiếp)</a>
					</div>
							
				</div>
					 
				<div class="activity col-sm-12"> 
					<button type="button" class="btn btn-default btn-sm actlike"  request="like" likeid="'.$loai_id.'">'.$check_likers['1'].'</button>
					<a href="#" style="margin-left:20px;">Không thích</a> 
					<a style="margin-left:20px;" data-toggle="collapse" href="#tra-loi-collapse-'.$noidung['id'].'" aria-expanded="false" aria-controls="tra-loi-collapse-'.$noidung['id'].'">Trả lời '.$comment_num['1'].'</a>  
					<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
				</div> 
				'.$tra_loi_cau_hoi.'				
<div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div><div class="col-md-1"></div>		  
					  
				</div>
     			';     		
     		break;  
     		     		  
    		case 'comment':
		$noidung= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$loai."' AND `id`= '".$loai_id."' AND `tinh-trang`= 'published' "));
		$content=stripslashes($noidung['noi-dung']);
		$userinfo= load_user_basic_info( '1','1','1','0',$noidung['fbid']);
		$likeinfo=load_likers($loai,$loai_id,'tra-loi');
		$so_like=load_likers($loai,$loai_id,'0');	
		$url=geturl($loai,$loai_id);$comment_num=checkreply($loai,$loai_id);$check_likers=checklikers($loai,$loai_id);							
     		if ($noidung['loai-doi-tuong']=='bai-viet')
     		{
     			$return='
			<div class="row postlayout">
					  
				<div class="col-sm-11">
					<div class="row">
						<div class="col-xs-8 col-sm-1">
							<img alt="'.$userinfo['ten-hien-thi'].'" src="'.$userinfo['avatar'].'" height="32" width="32">      </div>
						<div class="col-xs-4 col-sm-10">
							<author><a href="http://tungace.com/user/'.$userinfo['fbid'].'">'.$userinfo['ten-hien-thi'].', '.$userinfo['title'].'</a></author><br>
							<div class="unimportant-lines">
							'.$likeinfo.'
							</div>      
						</div>
						<div class="col-xs-8 col-xs-1">
				
							<div class="btn-group">
							<button class="btn dropdown-toggle" data-toggle="dropdown" style="float:right;"> 
								<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="comment" loaiid="'.$loai_id.'" request="editpost" class="jqueryoption">Chỉnh sửa</a></li>
								<li><a href="#">Ngừng theo dõi bài</a></li>
								<li class="divider"></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="comment" loaiid="'.$loai_id.'" request="report" class="jqueryoption">Báo cáo</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" loai="comment" loaiid="'.$loai_id.'" request="delete" class="jqueryoption">Xóa</a></li>				  
							</ul>
							</div><!-- /btn-group -->
						</div>   
							
					</div>
					<div class="noi-dung">
						'.$content.'	
						<a href="http://tungace.com/'.$url.'">(Đọc tiếp)</a>
					</div>
							
				</div>
					 
				<div class="activity col-sm-12"> 
					<button type="button" class="btn btn-default btn-sm actlike" request="like" likeid="'.$loai_id.'">'.$check_likers['1'].'</button>
					<a href="#" style="margin-left:20px;">Không thích</a> 
					<a style="margin-left:20px;" data-toggle="collapse" href="#comment-collapse-'.$noidung['id'].'" aria-expanded="false" aria-controls="comment-collapse-'.$noidung['id'].'">Trả lời '.$comment_num['1'].'</a>  
					<a href="#" style="margin-left:20px;">Lưu trữ, chia sẻ</a>  
				</div> 	'.loadcomment('comment',$noidung['id']).'	
<div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;"></div><div class="col-md-1"></div>		  
					  
				</div>
     			';     		
     		}
     		else
     		{
		$userinfo= load_user_basic_info('1','1','1','0',$noidung['fbid']);     		

     			$return='
			<div class="col-xs-12 col-sm-1">
				<img alt="'.$userinfo['ten-hien-thi'].'" src="'.$userinfo['avatar'].'" class="profile_photo_img comment_image" height="25" width="25">
			</div>
			<div class="col-xs-12 col-sm-11">
				<strong class="pull-left primary-font">'.$userinfo['ten-hien-thi'].'</strong>
				<small class="pull-right text-muted">
				<span class="glyphicon glyphicon-time"></span>time?</small>
				<br/>
				<li class="ui-state-default">'.$content.'. </li>
				<br/>
			</div>
     			';
     		
     		}
     		break;     		     		     		 		     		
    	default:

	endswitch; 
	
	return $return;
}
function loadcomment($loai,$loai_id)
{
	global $mmhclass;
	$commentlist=$mmhclass->db->query("SELECT * FROM `m_content`  WHERE `tinh-trang` = 'published' AND `id-doi-tuong`= '".$loai_id."' ORDER BY `id` DESC LIMIT 10");

	while ($singlecomment= $mmhclass->db->fetch_array($commentlist))
		{
		$return=$return.load_single_post($singlecomment['loai'],$singlecomment['id']);
		}
	if (($loai=='tra-loi')||($loai=='comment')){
		if ($_SESSION['FBID']!='') {
		$comment='
			<div class="row">
				<div class="col-xs-12 col-sm-1">
					<img alt="'.$_SESSION['FULLNAME'].'" src="https://graph.facebook.com/'.$_SESSION['FBID'].'/picture" class="profile_photo_img comment_image_add_root" height="25" width="25">		  
				</div>
				<div class="col-xs-12 col-sm-11">
	
					<div class="input-group">
				      <form class="form-horizontal" role="form" method="POST" action="/xuly.php">	
						<input id="userComment" class="form-control input-sm chat-input" name="noi-dung" placeholder="Write your comment here..." type="text">             
						<input value="'.$loai_id.'" type="hidden" name="id-doi-tuong">
						<input value="'.$loai.'" type="hidden" name="loai-doi-tuong">                       
						<input value="addcomment" type="hidden" name="request">          
						<span class="input-group-btn">     
						<button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-comment"></span> Add Comment</button>
						</span>
					</form>	
					</div>
				</div>
			</div>
		';
		}
		$return='
			<div class="col-lg-11 col-sm-11 text-center collapse" id="comment-collapse-'.$loai_id.'" style="padding-top:10px;">
				<div class="well">
				'.$comment.'
				<hr data-brackets-id="12673">
				<ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
					<div class="row">
					'.$return.'
					</div>
				</ul>
				</div>
			</div>';
		
	}
	return $return;	
}

function load_course_intro($loai,$loai_id)
{
	global $mmhclass;
	$course_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_course` WHERE `id`= '".$loai_id."' AND  `loai`= 'khoa-hoc'"));		

	$thong_tin=stripslashes($course_info['thong-tin-khoa-hoc']);
	$faq=stripslashes($course_info['faq']);
	$return=$thong_tin.'<br/>'.$faq;
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

function register_course($loai,$loai_id)
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
	header("Location: http://tungace.com/".$url_info['url']);
	}else
	{
	//echo "CHua DANG NHAP".$_GET['params'];
	//Chưa đăng nhập: Tạo 1 $_SESSION['link']=$_GET['params']; vào login();
	$_SESSION['link']=$_GET['params'];	
	login();
	}

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
			header("Location: http://tungace.com/".$url_info['url']);	
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
		          <td> <a href="http://tungace.com/'.$url.'">'.$tieu_de.'</a></td>
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
	$danh_sach_bai_giang='<a class="btn btn-success btn-lg" href="http://tungace.com/'.get_course_link('bai-hoc',$loai_id).'/danh-sach-bai-giang" role="button">Quay lại danh sách bài giảng</a> <br/><br/><br/>';
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
			         <a href="http://tungace.com/'.$url.'"><h2>'.$tieu_de.'</h2></a>
			    <div class="row">
			      <div class="col-xs-8 col-sm-2">
			<img src="'.$single_course['image'].'" style="height: 68px;
			width: 120px;">      
			      </div>
				  <div class="col-xs-4 col-sm-10">
			        <p>'.$tac_gia.'</p>
			        <p>
			          <a class="btn btn-lg btn-primary" href="http://tungace.com/'.$url.'" role="button">Xem thông tin khóa học</a>
			        </p>
			      </div>
			    </div>
			  </div>
			</div>
		';
		}	

	return $return;
}
function load_user_single_info($avatar,$ten,$chucvu,$mota,$noilamviec,$social,$loai_id)
{
	global $mmhclass;
	$user_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_user` WHERE `id`= '".$loai_id."'"));
	$return=$user_info;
	$return['fbid']=$user_info['fbid'];
	if ($avatar=='1'){$avatar=$user_info['avatar'];}
	if ($ten=='1'){$ten=$user_info['ten-hien-thi'];}
	if ($chucvu=='1'){$chucvu=stripslashes($user_info['chuc-vu']);}
	if ($mota=='1'){$mota=stripslashes($user_info['mo-ta']);}
	if ($noilamviec=='1'){$noilamviec=stripslashes($user_info['noi-lam-viec']);}
	if ($social=='1'){$fb=$user_info['fb'];$twitter=$user_info['twitter'];$website=$user_info['website'];}
	$return['avatar']=$avatar;
	$return['ten-hien-thi']=$ten;
	$return['chuc-vu']=$chucvu;
	$return['mo-ta']=$mota;
	$return['noi-lam-viec']=$noilamviec;
	$return['fb']=$fb;$return['twitter']=$twitter;$return['website']=$website;
	return $return;
}
function user_bio_page($loai_id)
{
	global $mmhclass;
    	$user_info=load_user_single_info('1','1','1','1','1','1',$loai_id);
	$main = '
	<div class="row" style="padding-left: 30px;">
			
	<hquestion>'.$user_info['ten-hien-thi'].'</hquestion> <br/><htitle>'.$user_info['chuc-vu'].'-'.$user_info['noi-lam-viec'].'.</htitle>
	<br/>
	<br/>        <button type="button" class="btn btn-default">Theo dõi</button>
	        <button type="button" class="btn btn-default">Nhắn tin</button>
			
	        <button type="button" class="btn btn-info">Twitter</button>
	        <button type="button" class="btn btn-primary">Facebook</button>
	
	<br/>
	<br/>  '.$user_info['mo-ta'].'
	<br/>
	
	  <div class="col-md-1 sidebar"></div><div class="col-md-10" style="border-bottom: solid;border-color:#e1e1e1;border-width: 2px;padding: 5px;margin-top:5px;" ></div><div class="col-md-1"></div>
	<br/>
	  <h3> Hoạt động gần đây </h3>
	
	  </div>
	';
	return $main;
}
function edit_user_bio($loai_id)
{
	global $mmhclass;
    	$user_info=load_user_single_info('1','1','1','1','1','1',$loai_id);

$main='
<h1 class="page-header">Thay đổi thông tin cá nhân</h1>
  <div class="row">
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="'.$user_info['avatar'].'" class="avatar img-circle img-thumbnail" alt="avatar">
        <h2>'.$user_info['ten-hien-thi'].'</h2>
      </div>
      <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">Ã—</a> 
        <i class="fa fa-coffee"></i>
       <strong>Lưu ý:</strong> Để trải nghiệm của bạn và của mọi người trên trang web được trọn vẹn, hãy điền vào đầy đủ những thông tin sau đây!
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">

      <h3>Thông tin cá nhân</h3>
      <form class="form-horizontal" role="form" method="POST" action="/xuly.php">

        <div class="form-group">
          <label class="col-lg-3 control-label">Facebook id:</label>
          <div class="col-lg-8">
      <p class="form-control-static">'.$user_info['fbid'].'</p>          </div>
        </div> 		
        <div class="form-group">
          <label class="col-lg-3 control-label">Tên hiển thị:</label>
          <div class="col-lg-8">
      <p class="form-control-static">'.$user_info['ten-hien-thi'].'</p>          
		  </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input class="form-control" value="'.$user_info['email'].'" type="text" name="email">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Giới tính:</label>
          <div class="col-lg-8">
			<select class="form-control" value="'.$user_info['gioi-tinh'].'" name="gioi-tinh">
			  <option>Nam</option>
			  <option>Nữ</option>
			</select>        
			</div>
		</div>	 		
        <div class="form-group">
          <label class="col-lg-3 control-label">Ngày tháng năm sinh:</label>
          <div class="col-lg-8">
      <p class="form-control-static">'.$user_info['ngay-sinh'].'</p>          
          </div>
	</div>	
        <div class="form-group">
          <label class="col-lg-3 control-label"></label>
          <div class="col-lg-2">
			<select class="form-control" name="ngay"><option></option>
			  <option>1</option>	option>2</option>  <option>3</option>	  <option>4</option>	  <option>5</option>	  <option>6</option>
			  <option>7</option>	option>8</option>  <option>9</option>	  <option>10</option>	  <option>11</option>	  <option>12</option>
			  <option>13</option>	option>14</option>  <option>15</option>	  <option>16</option>	  <option>17</option>	  <option>18</option>
			  <option>19</option>	option>20</option>  <option>21</option>	  <option>22</option>	  <option>23</option>	  <option>24</option>
			  <option>25</option>	option>26</option>  <option>27</option>	  <option>28</option>	  <option>29</option>	  <option>30</option>	<option>30</option>	<option>31</option>			  
			</select>        
			</div>
          <div class="col-lg-3">
			<select class="form-control" name="thang"><option></option>
			  <option>1</option>	option>2</option>  <option>3</option>	  <option>4</option>	  <option>5</option>	  <option>6</option>
			  <option>7</option>	option>8</option>  <option>9</option>	  <option>10</option>	  <option>11</option>	  <option>12</option>
			</select>        
	</div>
	<div class="col-lg-3">
			<select class="form-control" name="nam"><option></option>
			  <option>1977</option><option>1978</option><option>1979</option><option>1980</option><option>1981</option><option>1982</option><option>1983</option><option>1984</option><option>1985</option><option>1986</option><option>1987</option><option>1988</option><option>1989</option><option>1990</option><option>1991</option><option>1992</option><option>1993</option><option>1994</option><option>1995</option><option>1996</option><option>1997</option><option>1998</option><option>1999</option><option>2000</option><option>2001</option><option>2002</option><option>2003</option>
			</select>        
	</div>
	</div>	  				  		
        <div class="form-group">
          <label class="col-lg-3 control-label">Chức vụ:</label>
          <div class="col-lg-8">
            <input class="form-control" value="'.$user_info['chuc-vu'].'" type="text" name="chuc-vu">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Nơi làm việc:</label>
          <div class="col-lg-8">
            <input class="form-control" value="'.$user_info['noi-lam-viec'].'" type="text" name="noi-lam-viec">
          </div>
        </div>
		
        <div class="form-group">
          <label class="col-lg-3 control-label">Mô tả:</label>
          <div class="col-lg-8">
<textarea class="form-control" rows="3" value="'.$user_info['mo-ta'].'" name="mo-ta"></textarea>          </div>
        </div>
		 
		 <h3>Social links
	  </h3>
        <div class="form-group">
          <label class="col-lg-3 control-label">Website:</label>
          <div class="col-lg-8">
            <input class="form-control" value="'.$user_info['website'].'" type="text" name="website">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Facebook:</label>
          <div class="col-lg-8">
            <input class="form-control" value="'.$user_info['fb'].'" type="text" name="facebook">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Twitter:</label>
          <div class="col-lg-8">
            <input class="form-control" value="'.$user_info['twitter'].'" type="text" name="twitter">
          </div>
        </div>
		
		
		
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <input value="edit-user" type="hidden" name="request">          
  	     <button type="submit" class="btn btn-primary">Submit</button>
            <span></span>
            <input class="btn btn-default" value="Cancel" type="reset">
          </div>
        </div>		
      </form>
    </div>
  </div>
';

return $main;
}
function tra_loi_cau_hoi($loai,$loai_id)
{
	global $mmhclass;
	if ($_SESSION['FBID']!=''){
	$noidung= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$loai."' AND `id`= '".$loai_id."' AND `tinh-trang`= 'published' "));
	$onlineuser=	load_user_basic_info('1','1','1','0',$_SESSION['FBID']);
	$return ='
	<div class="col-lg-111 col-sm-11 text-center collapse" style="padding-top:10px;" id="tra-loi-collapse-'.$noidung['id'].'">
							<div class="well">
								<div class="row">
								      <form class="form-horizontal" role="form" method="POST" action="/xuly.php">
	
									<div class="col-xs-12 col-sm-1">
										<img alt="'.$onlineuser['ten-hien-thi'].'" src="'.$onlineuser['avatar'].'" class="profile_photo_img comment_image_add_root" height="25" width="25">		  
									</div>
									<div class="col-xs-12 col-sm-11" style="text-align:left;">
										<author><a href="#"><b>'.$onlineuser['ten-hien-thi'].'</b></a></author><br/>
										<div class="unimportant-lines">
										<a href="http://tungace.com/user/'.$_SESSION['FBID'].'">'.$onlineuser['title'].'</a> 
										</div>      
										<br/>
										<textarea class="form-control" rows="3" name="noi-dung"></textarea>									<br/>  	              
										<input value="'.$loai_id.'" type="hidden" name="id-doi-tuong">
										<input value="'.$loai.'" type="hidden" name="loai-doi-tuong">                       
										<input value="addcomment" type="hidden" name="request">          
										<button type="submit" class="btn btn-primary">Submit</button><br/>
	
									</div>
									</form>
								</div>
							</div>
	
						</div>	
	';}
	return $return;
}
function checkreply($loai,$loai_id)
{
	global $mmhclass;
	$content_list=$mmhclass->db->query("SELECT * FROM `m_content`  WHERE `tinh-trang` = 'published' AND `id-doi-tuong`= '".$loai_id."' ORDER BY `id` DESC");
	$i=0;
	while ($single_content= $mmhclass->db->fetch_array($content_list))	
	{
	$i++;
	}
	$return['0']=0;	$return['1']='';
	if ($i>0){$return['1']='('.$i.')';}
	return $return;
	}

function checkliked($loai,$loai_id)
{
	global $mmhclass;
$return = 'no';
	if ($_SESSION['FBID']!='')
	{
	$check_like= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_like` WHERE `loai-doi-tuong`= '".$loai."' AND `doi-tuong-id`= '".$loai_id."' AND `loai` != 'dang-ky'"));
	if ($check_like['id']!=''){$return = 'yes';}
	
	}
return $return;
}
function checklikers($loai,$loai_id)
{
	global $mmhclass;
	$content_list=$mmhclass->db->query("SELECT * FROM `m_like`  WHERE `loai` != 'dang-ky' AND `doi-tuong-id`= '".$loai_id."' ORDER BY `id` DESC");
	$i=0;
	while ($single_content= $mmhclass->db->fetch_array($content_list))	
	{
	$i++;
	}
	$return['0']=0;	$return['1']='';	$default = 'Thích';
	if (checkliked($loai,$loai_id)=='yes'){$default='Đã thích';} 
	if ($loai=='cau-hoi'){$default='Quan tâm'; if (checkliked($loai,$loai_id)=='yes'){$default='Đã quan tâm';} }
	if ($i>0){$return['1']=$default.' | '.$i;}else{$return['1']=$default;}
	$return['0']=$default;
	return $return;
}


?>