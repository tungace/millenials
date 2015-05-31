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
require_once "./classes/Content/Content.php";
require_once "./classes/Content/ContentDb.php";
require_once "./classes/Content/Comment.php";
require_once "./classes/Content/Post.php";
require_once "./classes/Content/Question.php";


/**
 * Use Tungace's fb account as default if this is localhost
 */
if (strpos($web_root, "localhost") !== FALSE){
	$_SESSION['FBID'] = "879505798754632"; // Tungace's account as default
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