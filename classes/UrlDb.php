<?php
class UrlDb {
	public function UrlDb(){
	}
	
	public function getUrl($targetTypeParam, $targetIdParam){
		global $mmhclass;
		$url= $mmhclass->db->fetch_array(
                $mmhclass->db->query("SELECT * FROM `m_url` WHERE   `loai`= '".$targetTypeParam."' 
                                                                    AND `id-loai`= '".$targetIdParam."' 
                                                                    AND `tinh-trang`= 'published'  "));	
		return $url['url'];
	}
}

$urlDb = new UrlDb();
?>