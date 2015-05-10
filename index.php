<?php

	require_once "./source/includes/data.php";
	require_once 'autoload.php';
	require_once "./function.php";	
	

if (isset($_GET['params']))
{
$_GET['params']=addslashes($_GET['params']);
    $params = explode( "/", $_GET['params'] );

switch ($_GET[params]):
    case 'login':
	//neu la login	
	login();
        break;
        
    case 'cac-khoa-hoc':
        //hien thi list cac khoa hoc
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
		$exist= $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `m_url` WHERE `url`= '".$_GET['params']."' AND `tinh-trang`!= 'deleted'"));
    		if ($exist['loai']!='')
   		{
    		echo show($exist['loai'],$exist['id-loai']);
    		}
    		else
    		{
    		//header("Location: ./404");
    		}

endswitch; 

} else { echo show('homepage');


}  
?>