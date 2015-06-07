<?php
class Notification {
    public $id;
    public $postedTime;
    public $content;
    public $url;
    public $fbId;
    public $status;
    
    public function Notification($notiInfo){
        $this->id = $notiInfo['id'];
        $this->postedTime = $notiInfo['thoi-gian'];
        $this->content = $notiInfo['noi-dung'];
        $this->url = $notiInfo['url'];
        $this->fbId = $notiInfo['fbid'];
        $this->status = $notiInfo['status'];
    }
    
    public function toString(){
        if ($this->status == 'Seen') {
            return '<li class="notification-cell">
                        <a href="'.$this->url.'" class="btn btn-default">
                        '.$this->content.'
                        </a>
                    </li>';
        } else {
            return '<li class="notification-cell">
                        <a href="'.$this->url.'" class="btn btn-info">
                        '.$this->content.'
                        </a>
                    </li>';
        }
    }
}

?>