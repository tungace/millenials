<?php
class UrlDb {
	public function UrlDb(){
	}
	
	public function getUrl($idParam){
		global $mmhclass;
		$url = $mmhclass->db->fetch_array(
                $mmhclass->db->query("SELECT * FROM `m_url` WHERE `id-loai`= '".$idParam."' 
                                                                    AND `tinh-trang`= 'published'  "));	
		return $url['url'];
	}
}

$urlDb = new UrlDb();
?>