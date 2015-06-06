<?php
class Navbar {
    private $user;
    private $isLoggedin;
    
    public function Navbar(){
        global $userDb;
        $this->isLoggedin = false;
        
        if (isset($_SESSION['FBID'])){
            $this->user = $userDb->getUserByFbId($_SESSION['FBID']);
            $this->isLoggedin = true;
        }
    }
    
    private function getUserPanel() {
        if ($this->isLoggedin) {
            return '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="'.$this->user->avatar.'" height="20px" width="20px">
                            &nbsp;'.$this->user->displayName.'<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Tài khoản của tôi</a></li>
                            <li><a href="#">Bài đang theo dõi</a></li>
                            <li><a href="#">Chưa nghĩ ra gì hay</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Thiết lập</li>
                            <li><a href="#">Quản lý tài khoản</a></li>
                            <li><a href="<#ROOT#>/logout.php">Đăng xuất (tinh)</a></li>
                        </ul>
                    </li>';
        } else {
            return '<li class="dropdown">
                        <a href="#" role="button" aria-expanded="false" data-toggle="modal" data-target="#myModal">
                            Login</span>
                        </a>
                    </li>';
        }
    }
    
    public function toString() {
        return '<nav class="navbar navbar-default navbar-fixed-top">
                    <div class="container">
                        <div class="navbar-header">
                            <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
                            <a class="navbar-brand" href="#">Millennials</a>
                        </div>
                        <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
                        <div id="navbar">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Trang chủ</a></li>
                                <li><a href="#about">Về chúng tôi</a></li>
                                <li><a href="#contact">Liên hệ</a></li>
                            </ul>
                            
                            <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm">
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                            
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Thông báo <span class="badge">3</span><span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Thằng này làm cái kia</a></li>
                                        <li><a href="#">Thằng kia làm cái này</a></li>
                                        <li><a href="#">Con này đụ thằng kia</a></li>
                                        <li><a href="#">Thằng kia đụ con này</a></li>
                                        
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Tin nhắn <span class="badge">3</span></li>
                                        <li><a href="#">Một con chó vừa nhắn tin</a></li>
                                        <li><a href="#">Thằng điên vừa nhắn</a></li>
                                    </ul>
                                </li>			
                                '.$this->getUserPanel().'
                                <li><a href="#" style="background-color:#2b6dad;color:white;" data-toggle="modal" data-target=".bs-example-modal-lg">Đăng bài</a></li>
                                <li><a href="#" style="background-color:#991f00;color:white;">Học bài</a></li>                            
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </nav>';
    }

}

?>