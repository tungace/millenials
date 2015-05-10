<?php


	require_once "./source/includes/data.php";
	require_once 'autoload.php';
	require_once "./function.php";	
	

if (($_SESSION['FBID']>0)&&($_POST['request']!=''))
{

	switch ($_POST['request']):
    		case 'addcomment':
    		if ($_POST['loai-doi-tuong']=='cau-hoi'){$loai='tra-loi';}
    		if ($_POST['loai-doi-tuong']=='bai-viet'){$loai='comment';}
    		if ($_POST['loai-doi-tuong']=='tra-loi'){$loai='comment';}
    		if ($_POST['loai-doi-tuong']=='comment'){$loai='comment';}        		    
    		$id_doi_tuong=$_POST['id-doi-tuong'];
    		$noi_dung=addslashes($_POST['noi-dung']);
    		if ($noi_dung!=''){$time=date('Y-m-d H:i:s');
    		$mmhclass->db->query("INSERT INTO `m_content` (`loai`, `fbid`, `loai-doi-tuong`,`id-doi-tuong`,`noi-dung`,`tinh-trang`,`thoi-gian`) VALUES ('{$loai}', '{$_SESSION['FBID']}', '{$_POST['loai-doi-tuong']}','{$id_doi_tuong}','{$noi_dung}','published','{$time}');");
			if (($_POST['loai-doi-tuong']!='tra-loi')&&($_POST['loai-doi-tuong']!='bai-viet')&&($_POST['loai-doi-tuong']!='comment'))
			{
		    		$getback= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$loai."' AND `id-doi-tuong`= '".$id_doi_tuong."' AND `fbid`= '".$_SESSION['FBID']."' AND `noi-dung`= '".$noi_dung."' AND `thoi-gian`= '".$time."' AND `tinh-trang`= 'published' "));
		    		$link=geturl($_POST['loai-doi-tuong'],$_POST['id-doi-tuong']).'/'.$loai.'/'.$getback['id'];$redirect='http://tungace.com/'.$link;
		    		$mmhclass->db->query("INSERT INTO `m_url` (`loai`, `id-loai`, `url`,`tinh-trang`) VALUES ('{$loai}', '{$getback['id']}', '{$link}','published');"); 
		    	}else{ 
		    	  	if ($_POST['loai-doi-tuong']=='comment')
		    		{$getback= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$_POST['loai-doi-tuong']."' AND `id`= '".$_POST['id-doi-tuong']."'"));
		    		$redirect='http://tungace.com/'.geturl($getback['loai-doi-tuong'],$getback['id-doi-tuong']);
		    		}
		    		else
		    		{    	
		    		$redirect='http://tungace.com/'.geturl($_POST['loai-doi-tuong'],$_POST['id-doi-tuong']);}}
    		}

		 header("Location: ".$redirect);			    		
     		break;    			
	
    		case 'edit-user':
	$user_info= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_user` WHERE `fbid`= '".$_SESSION['FBID']."'"));    		
	if (($_POST['email']!='')&&(is_valid_email($_POST['email']))){$email=$_POST['email'];}else{$email=$user_info['email'];}
	if ($_POST['gioi-tinh']!=''){$gioi_tinh=$_POST['gioi-tinh'];}else{$gioi_tinh=$user_info['gioi-tinh'];}
	if (($_POST['ngay']!='')&&($_POST['thang']!='')&&($_POST['nam']!='')){$ngay_sinh=$_POST['nam'].'-'.$_POST['thang'].'-'.$_POST['ngay'];}else{$ngay_sinh=$user_info['ngay-sinh'];}
	if ($_POST['chuc-vu']!=''){$chuc_vu=addslashes($_POST['chuc-vu']);}else{$chuc_vu=$user_info['chuc-vu'];}
	if ($_POST['noi-lam-viec']!=''){$noi_lam_viec=addslashes($_POST['noi-lam-viec']);}else{$noi_lam_viec=$user_info['noi-lam-viec'];}
	if ($_POST['mo-ta']!=''){$mo_ta=addslashes($_POST['mo-ta']);}else{$mo_ta=$user_info['mo-ta'];}
	if ($_POST['website']==''){$website=$_POST['website'];}else{$website=$user_info['website'];}
	if ($_POST['fb']==''){$website=$_POST['fb'];}else{$fb=$user_info['fb'];}
	if ($_POST['twitter']==''){$website=$_POST['twitter'];}else{$twitter=$user_info['twitter'];}		
	//$mmhclass->db->query("UPDATE m_user SET email='$email' ,gioi-tinh='$gioi_tinh' ,ngay-sinh='$ngay_sinh' ,chuc-vu='$chuc_vu' ,noi-lam-viec='$noi_lam_viec' ,mo-ta='$mo_ta' ,website='$website' ,fb='$fb' ,twitter='$twitter' WHERE fbid=$_SESSION['FBID']");
	// 	$mmhclass->db->query("UPDATE m_user SET `email`='$email' ,`gioi-tinh`='$gioi_tinh' ,`ngay-sinh`='$ngay_sinh' ,`chuc-vu`='$chuc_vu' ,`noi-lam-viec`='$noi_lam_viec' ,`mo-ta`='$mo_ta' ,`website`='$website' ,`fb`='$fb' ,`twitter`='$twitter' WHERE fbid=$_SESSION['FBID']");
	$mmhclass->db->query("UPDATE m_user SET `email`='".$email."' ,`gioi-tinh`='".$gioi_tinh."' ,`ngay-sinh`='".$ngay_sinh."' ,`chuc-vu`='".$chuc_vu."' ,`noi-lam-viec`='".$noi_lam_viec."' ,`mo-ta`='".$mo_ta."' ,`website`='".$website."' ,`fb`='".$fb."' ,`twitter`='".$twitter."' WHERE fbid='".$_SESSION['FBID']."'");
	
	$redirect='http://tungace.com/user/'.$user_info['fbid'];
	 header("Location: ".$redirect);
	 
	 
     		break;
		case 'chinhsua':
		$content= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$_POST['loai']."' AND `id`= '".$_POST[loaiid]."' AND `tinh-trang`= 'published' "));		
		$noidung=addslashes($_POST['noi-dung']);
		if (($_POST['noi-dung']!='')&&($noidung!=$content['noi-dung'])){$noidung=addslashes($_POST['noi-dung']);}else{$noidung=$content['noi-dung'];}
		if (($_POST['preview']!='')&&($preview!=$content['preview'])){$preview=addslashes($_POST['preview']);}else{$preview=$content['preview'];}	
		if (($_POST['thumbnail']!='')&&($preview!=$content['thumbnail'])){$thumbnail=$_POST['thumbnail'];}else{$thumbnail=$content['thumbnail'];}					
		if (($_POST['loai']=='tra-loi')||($_POST['loai']=='comment')){
			$mmhclass->db->query("UPDATE m_content SET `noi-dung`='".$noidung."' WHERE id='".$content['id']."'");	}	
		if (($_POST['loai']=='cau-hoi')||($_POST['loai']=='bai-viet')){
			if ($_POST['tieu-de']!=''){$tieu_de=addslashes($_POST['tieu-de']);}else{$tieu_de=$user_info['tieu-de'];}
			if ($_POST['the']!=''){$the=addslashes($_POST['the']);}else{$mo_ta=$user_info['the'];}
			$mmhclass->db->query("UPDATE m_content SET `noi-dung`='".$noidung."',`tieu-de`='".$tieu_de."' ,`the`='".$the."',`preview`='".$preview."' ,`thumbnail`='".$thumbnail."' WHERE id='".$content['id']."'");	}	
		$redirect='http://tungace.com/'.geturl($_POST['loai'],$_POST['loaiid']);
		 header("Location: ".$redirect);	
		 
		break;
    		case 'create-question':
     		if (($_POST['loai']=='cau-hoi')&&(strlen($_POST['tieu-de'])>5)&&(strlen($_POST['noi-dung'])>10)&&(strlen($_POST['the'])>2))
     		{
     		$noidung=addslashes($_POST['noi-dung']);
     		$the=addslashes($_POST['the']);
     		$tieude=addslashes($_POST['tieu-de']);     		     		
$time=date('Y-m-d H:i:s');
    		$mmhclass->db->query("INSERT INTO `m_content` (`loai`, `fbid`,`noi-dung`,`tinh-trang`,`thoi-gian`,`tieu-de`,`the`) VALUES ('{$_POST['loai']}', '{$_SESSION['FBID']}', '{$noidung}','published','{$time}','{$tieude}','{$the}');");
    		
 		 $getback= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$_POST['loai']."' AND `fbid`= '".$_SESSION['FBID']."' AND `noi-dung`= '".$noidung."' AND `thoi-gian`= '".$time."' AND `tinh-trang`= 'published' AND `tieu-de`= '".$tieude."' AND `the`= '".$the."' "));
 		 
		$redirect=$_POST['loai'].'/'.$getback['id'].'-'.unicode_str_filter($tieude);
		 $mmhclass->db->query("INSERT INTO `m_url` (`loai`, `id-loai`, `url`,`tinh-trang`) VALUES ('{$_POST['loai']}', '{$getback['id']}', '{$redirect}','published');");$redirect='http://tungace.com/'.$redirect;
		header("Location: ".$redirect);		
     		}
     		break;     		        		    		        		   
    	default:
    	
	endswitch; 	
}
if (($_SESSION['FBID']>0)&&($_GET['request']!=''))
{
	$content= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_content` WHERE `loai`= '".$_GET['loai']."' AND `id`= '".$_GET['loaiid']."' AND `tinh-trang`= 'published' "));
	
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
    		case 'editpost':
			switch ($_GET['loai']):
				case 'tra-loi':
				$title='Chỉnh sửa câu trả lời';
				
				$return='
			<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
			<script>tinymce.init({selector:\'textarea\'});</script>        
			<textarea class="form-control" rows="3" name="noi-dung">'.$content['noi-dung'].'</textarea>
			<input value="chinhsua" type="hidden" name="request">      				
			<input value="'.$content['loai'].'" type="hidden" name="loai">      				
			<input value="'.$_GET['loaiid'].'" type="hidden" name="loaiid">      				                        
				';
				break;
				case 'cau-hoi':
				$return = '

	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>tinymce.init({selector:\'textarea\'});</script>        				
	<div class="form-group">
          <label class="col-lg-1 control-label">Tiêu đề:</label>
          <div class="col-lg-10">
            <input class="form-control" value="'.$content['tieu-de'].'" type="text" name="tieu-de">
          </div></div>

	<div class="form-group">
          <label class="col-lg-1 control-label">Nội dung:</label>
          <div class="col-lg-10">
<textarea class="form-control" rows="3" name="noi-dung">'.$content['noi-dung'].'</textarea> </div>
          </div>
	<div class="form-group">
          <label class="col-lg-1 control-label">Thẻ:</label>
          <div class="col-lg-10">
            <input class="form-control" value="'.$content['the'].'" type="text" name="the">
          </div></div>


			<input value="chinhsua" type="hidden" name="request">      				
			<input value="'.$content['loai'].'" type="hidden" name="loai">      				
			<input value="'.$_GET['loaiid'].'" type="hidden" name="loaiid">  

				';
				break;
				case 'bai-viet':
				$return = '

	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>tinymce.init({selector:\'textarea\'});</script>        				
	<div class="form-group">
          <label class="col-lg-1 control-label">Tiêu đề:</label>
          <div class="col-lg-10">
            <input class="form-control" value="'.$content['tieu-de'].'" type="text" name="tieu-de">
          </div></div>
	<div class="form-group">
          <label class="col-lg-1 control-label">Preview:</label>
          <div class="col-lg-10">
<textarea class="form-control" rows="3" name="preview">'.$content['preview'].'</textarea> </div>
          </div>
	<div class="form-group">
          <label class="col-lg-1 control-label">Nội dung:</label>
          <div class="col-lg-10">
<textarea class="form-control" rows="3" name="noi-dung">'.$content['noi-dung'].'</textarea> </div>
          </div>
	<div class="form-group">
          <label class="col-lg-1 control-label">Thẻ:</label>
          <div class="col-lg-10">
            <input class="form-control" value="'.$content['the'].'" type="text" name="the">
          </div>
          </div>
  	<div class="form-group">        
          <label class="col-lg-1 control-label">Ảnh:</label>
          <div class="col-lg-10">
            <input class="form-control" value="'.$content['thumbnail'].'" type="text" name="thumbnail">
            <br/><img src="'.$content['thumbnail'].'" style="max-width:400px;max-height:300px;">
          </div></div>

			<input value="chinhsua" type="hidden" name="request">      				
			<input value="'.$content['loai'].'" type="hidden" name="loai">      				
			<input value="'.$_GET['loaiid'].'" type="hidden" name="loaiid">  

				';
				break;
				case 'comment':
				$title='Chỉnh sửa câu trả lời';
				
				$return='
			<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
			<script>tinymce.init({selector:\'textarea\'});</script>        
			<textarea class="form-control" rows="3" name="noi-dung">'.$content['noi-dung'].'</textarea>
			<input value="chinhsua" type="hidden" name="request">      				
			<input value="'.$content['loai'].'" type="hidden" name="loai">      				
			<input value="'.$_GET['loaiid'].'" type="hidden" name="loaiid">      				                        
				';				
				break;
				default:
			endswitch; 	
     		break;

    	default:
    	
	endswitch; 	
	$return = '
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">'.$title.'</h4>
	      </div>
	            <form class="form-horizontal" role="form" method="POST" action="/xuly.php">
	      <div class="modal-body" id="jqueryboxcontent">
	
	        '.$return.'
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
	        <button type="submit" class="btn btn-primary">Lưu</button>
	      </div>
	      </form>              
	    </div>
	  </div>
	';	
	echo $return;
}
?>