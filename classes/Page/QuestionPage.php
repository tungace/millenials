<?php

class QuestionPage extends Page{
    private $postId;
    
	public function QuestionPage($postIdParam){
        $this->postId = $postIdParam;
    }

	public function getLeftPanel(){
        return '<div class=\'col-md-2 sidebar\'>
					<h3>Left Sidebar</h3>
					<ul class="nav nav-list bs-docs-sidenav">
						<li><a href="#global"><i class="icon-chevron-right"></i> Global styles</a></li>
						<li><a href="#gridSystem"><i class="icon-chevron-right"></i> Grid system</a></li>
						<li><a href="#fluidGridSystem"><i class="icon-chevron-right"></i> Fluid grid system</a></li>
						<li><a href="#layouts"><i class="icon-chevron-right"></i> Layouts</a></li>
						<li><a href="#responsive"><i class="icon-chevron-right"></i> Responsive design</a></li>
					</ul>
					<ul class="nav nav-tabs nav-stacked">
						<li><a href=\'#\'>Another Link 1</a></li>
						<li><a href=\'#\'>Another Link 2</a></li>
						<li><a href=\'#\'>Another Link 3</a></li>
					</ul>
				</div>';
	}
	
	public function getMainPanel(){
        global $mmhclass;
	
		$postlist = $mmhclass->db->query("SELECT * FROM `m_content`  WHERE `loai` = 'cau-hoi' AND `id` = '".$this->postId."' AND `tinh-trang` = 'published' ");
		
        if ($article = $mmhclass->db->fetch_array($postlist)) {
			$question = new Question($article);
            $main = $question->toStringWithComments();
		} else {
            $main = "Không tìm thấy bài viết \"".$this->postId."\".";
        }
        
        return '<div class="col-md-7 main">'.$main.'</div>';
	}
	
	public function getRightPanel(){
        return '<div class="col-md-3 sidebar">
					<h3>Right Sidebar</h3>
					<ul class="nav nav-tabs nav-stacked">
						<li><a href="#">Another Link 1</a></li>
						<li><a href="#">Another Link 2</a></li>
						<li><a href="#">Another Link 3</a></li>
					</ul>
				</div>';
	}

}


?>