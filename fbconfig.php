<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
require_once "./source/includes/data.php";
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '462253767264972','f2f4dfc300365bb99183bce4b94daa6d' );
// login helper with redirect_uri
global $web_root;
$helper = new FacebookRedirectLoginHelper($web_root.'/fbconfig.php' );

try {
    $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
} catch( Exception $ex ) {
    // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
    // graph api request for user data
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();    // get response
	$graphObject = $response->getGraphObject();
    $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
	
    $check = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_user` WHERE `fbid`= '".$fbid."'"));
    
    if ($check['fbid']!=$fbid) {
        $fbuname = $graphObject->getProperty('username');  // To Get Facebook Username
 	   	$fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
        $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
		$favatar = 'https://graph.facebook.com/'.$fbid.'/picture'; 
		$fother = print_r( $graphObject, 1 );
		$mmhclass->db->query("INSERT INTO `m_user` (`fbid`, `email`, `ten-hien-thi`,`username`,`avatar`,`other`) VALUES ('{$fbid}', '{$femail}', '{$fbfullname}','{$fbuname}', '{$favatar}', '{$fother}');");
		//echo 'da dang ky thanh cong'.$fbid;		
    } else {
		//echo 'xin chao ban'.$check['ten-hien-thi'].'<img src="'.$check['avatar'].'/picture">';
    }
		
    $_SESSION['FBID'] = $fbid;           
    $_SESSION['USERNAME'] = $fbuname;
    $_SESSION['FULLNAME'] = $fbfullname;
    $_SESSION['EMAIL'] =  $femail;
    if ($_SESSION['link'] != '') {
        $location = './'.$_SESSION['link'];
        $_SESSION['link'] = '';
        header("Location: ".$location);
    } else {
	    	{header("Location: .");}
    }
} else {
    /*
    $params = array(

      'scope' => 'email,user_birthday','user_about_me','user_website','user_hometown','user_work_history','user_education_history',

    );
    */
    $loginUrl = $helper->getLoginUrl($params);
    header("Location: ".$loginUrl);
}
?>