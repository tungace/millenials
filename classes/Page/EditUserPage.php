<?php
require_once "Page.php";
require_once "../User.php";

class EditUserPage extends Page {
	var userId;
	var user;
	
	public function EditUserPage($idParam){
		$this->userId 	= $idParam;
		$this->user 	= new User($this->userId);
	}

	public function getLeftPanel(){
	}
	
	public function getMainPanel(){
		return '
			<h1 class="page-header">Thay đổi thông tin cá nhân</h1>
			  <div class="row">
				<!-- left column -->
				<div class="col-md-4 col-sm-6 col-xs-12">
				  <div class="text-center">
					<img src="'.$this->user->avatar.'" class="avatar img-circle img-thumbnail" alt="avatar">
					<h2>'.$this->user->displayName.'</h2>
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
				  <p class="form-control-static">'.$this->user->fbId.'</p>          </div>
					</div> 		
					<div class="form-group">
					  <label class="col-lg-3 control-label">Tên hiển thị:</label>
					  <div class="col-lg-8">
				  <p class="form-control-static">'.$this->user->displayName.'</p>          
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-lg-3 control-label">Email:</label>
					  <div class="col-lg-8">
						<input class="form-control" value="'.$this->user->email.'" type="text" name="email">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-lg-3 control-label">Giới tính:</label>
					  <div class="col-lg-8">
						<select class="form-control" value="'.$this->user->gender.'" name="gioi-tinh">
						  <option>Nam</option>
						  <option>Nữ</option>
						</select>        
						</div>
					</div>	 		
					<div class="form-group">
					  <label class="col-lg-3 control-label">Ngày tháng năm sinh:</label>
					  <div class="col-lg-8">
				  <p class="form-control-static">'.$this->user->birthday.'</p>          
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
						<input class="form-control" value="'.$this->user->role.'" type="text" name="chuc-vu">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-lg-3 control-label">Nơi làm việc:</label>
					  <div class="col-lg-8">
						<input class="form-control" value="'.$this->user->workingAddress.'" type="text" name="noi-lam-viec">
					  </div>
					</div>
					
					<div class="form-group">
					  <label class="col-lg-3 control-label">Mô tả:</label>
					  <div class="col-lg-8">
			<textarea class="form-control" rows="3" value="'.$this->user->description.'" name="mo-ta"></textarea>          </div>
					</div>
					 
					 <h3>Social links
				  </h3>
					<div class="form-group">
					  <label class="col-lg-3 control-label">Website:</label>
					  <div class="col-lg-8">
						<input class="form-control" value="'.$this->user->website.'" type="text" name="website">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-lg-3 control-label">Facebook:</label>
					  <div class="col-lg-8">
						<input class="form-control" value="'.$this->user->fb.'" type="text" name="facebook">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-lg-3 control-label">Twitter:</label>
					  <div class="col-lg-8">
						<input class="form-control" value="'.$this->user->twitter.'" type="text" name="twitter">
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
			  </div>';
	}
	
	public function getRightPanel(){
	}
	
}

?>