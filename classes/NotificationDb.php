<?php
class NotificationDb {
	public function NotificationDb(){
	}
    
    public function sendNotificationTo($fbIdParam, $urlParam, $contentParam) {
        global $mmhclass;
        $time = date('Y-m-d H:i:s');
        $mmhclass->db->query("INSERT INTO `m_notification` (`thoi-gian`, `noi-dung`, `url`, `fbid`, `status`) 
                                                    VALUES ('{$time}', '{$contentParam}', '{$urlParam}', '{$fbIdParam}', 'Pending');");
                                                    
    }
	
	public function getNotificationListByFbId($fbIdParam) {
        global $mmhclass;
        
        $result = Array();
		$notifications = $mmhclass->db->query("SELECT * FROM `m_notification` WHERE `fbid`= '{$fbIdParam}' ORDER BY `thoi-gian` DESC");
		while ($notification = $mmhclass->db->fetch_array($notifications)){
			$result[] = new Notification($notification);
		}
		return $result;
    }
    
    public function getPendingNotificationListByFbId($fbIdParam) {
        global $mmhclass;
        
        $result = Array();
		$notifications = $mmhclass->db->query("SELECT * FROM `m_notification` WHERE `fbid`= '{$fbIdParam}' AND `status` = 'Pending' ORDER BY `thoi-gian` DESC");
		while ($notification = $mmhclass->db->fetch_array($notifications)){
			$result[] = new Notification($notification);
		}
		return $result;
    }
    
    public function receiveAllPendingNotificationsByFbId($fbIdParam) {
        global $mmhclass;
        $mmhclass->db->query("UPDATE `m_notification` SET `status` = 'Received' WHERE `fbid`= '{$fbIdParam}' AND `status` = 'Pending'");
    }
    
    public function getReceivedNotificationListByFbId($fbIdParam) {
        global $mmhclass;
        
        $result = Array();
		$notifications = $mmhclass->db->query("SELECT * FROM `m_notification` WHERE `fbid`= '{$fbIdParam}' AND `status` = 'Received' ORDER BY `thoi-gian` DESC");
		while ($notification = $mmhclass->db->fetch_array($notifications)){
			$result[] = new Notification($notification);
		}
		return $result;
    }
    
    public function readAllReceivedNotificationsByFbId($fbIdParam) {
        global $mmhclass;
        $mmhclass->db->query("UPDATE `m_notification` SET `status` = 'Seen' WHERE `fbid`= '{$fbIdParam}' AND `status` = 'Received'");
    }
    
}

$notificationDb = new NotificationDb();
?>