<?php
// 세션을 시작합니다.
// 이후에 사용 할 로그인 용.
session_start();

// class를 이용한 객체 지향 방식
class Layout
{
	public $title="Booking management"; // 웹 페이지 제목
	private $menu = array('Home'=>'ppmanage/index.php','Notice'=>'ppmanage/notice', 'Books'=>'ppmanage/books', 'Reserve'=>'ppmanage/reserve', 'Rent'=>'ppmanage/rent');
	public $link; // CSS 링크 태그
	public $style; // 스타일 적용 
	public $content; // 메인 컨텐츠
	public $board; //게시판 이름 지정
	public $login; //로그인 로그아웃
		
	// 레이아웃을 출력
	public function LayoutMain()
	{
		echo $this->ThisBoard(); // 현재 게시판의 이름을 확인
		echo "<!DOCTYPE html>\n<html lang='ko'>";
		echo "<head>\n<meta charset='utf-8'/>";
		echo "<title>".$this->title."</title>";
		echo $this->LayoutStyle(); // 스타일을 레이아웃에 추가.
		echo $this->LayoutLogin();
		echo "</head>\n<body>\n<div id='container'>";
		echo	$this->LayoutHeader(); // 헤더 부분을 레이아웃에 추가
		echo	$this->LayoutContent(); // 컨텐츠 부분을 레이아웃에 추가
		echo	$this->LayoutFooter(); // 푸터 부분을 레이아웃에 추가
		echo "</div></body>\n</html>";
	}
	
//******************************************
	// 현재 게시판의 이름을 확인
	public function ThisBoard()
	{
		$this->board = explode('/', $_SERVER['PHP_SELF']); 
	}
//********************************************

	// 스타일을 추가
	public function LayoutStyle()
	{
		echo "<link rel='stylesheet' type='text/css' href='".$this->link."'/> ";
		echo "<style>".$this->style."</style>";
	}
	
	// 헤더 부분 추가
	public function LayoutHeader()
	{
		echo "<header>
			  <div id='navset'>
			      <nav id='menu'>";
					  $this->LayoutMenu($this->menu, 0); // $menu 배열을 이용해서 메뉴 부분을 호출
		echo "	  </nav>
			  </div>
			  <div id='login1'>".$this->login."</div>
		      </header>";
	}
	
	public function LayoutMenu($menu, $side) // 배열과 <li> 을 이용해서 메뉴 부분을 호출
	{
		while (list($key, $value) = each($menu))
		{
			$this->ThisMenu($key, $value, $side);
		}
	}
	
	public function ThisMenu($key, $value ,$side) //받아온 값으로 메뉴를 출력함
	{
		if(strpos($_SERVER['PHP_SELF'], $value)==false)
		{
			$thismenu = $thismenu."<li><a href='/".$value."'>".$key."</a></li>";
		} else
		{
			$thismenu = $thismenu."<li><b style='border-bottom:4px solid #90bbff;'>".$key."</b></li>";
		}
		echo $thismenu;
	}
	
	//로그인 출력여부
	public  function LayoutLogin()
	{
		if($_SESSION['id']=="")
		{
			if(strpos($_SERVER['PHP_SELF'], "login.php"))
			{
				$this->login="Login";
			} else
			{
				$this->login="<a href='/ppmanage/login.php'>Login</a>";
			}
		} else
		{
			$this->login="<a href='/ppmanage/logout.php'>Logout</a>";
		}
	}
	
	// 내용을 추가
	public function LayoutContent()
	{
		echo "<section><article>".$this->content."</article>";
	}
	
	
	// 푸터 부분 추가
		public function LayoutFooter()
	{
		echo "<footer>Copyright © Kangkyounghun. All rights reserved. </footer>";
	}
}
?>