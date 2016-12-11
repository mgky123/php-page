<?php
require '../layout.inc';
require_once '../db.php';

$base = new Layout;
$base->link = '../style.css';

$db = new DBC;
$db->DBI();

if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

/* 검색 시작 */
if(isset($_GET['searchColumn'])) {
	$searchColumn = $_GET['searchColumn'];
	$subString .= '&amp;searchColumn=' . $searchColumn;
}

if(isset($_GET['searchText'])) {
	$searchText = $_GET['searchText'];
	$subString .= '&amp;searchText=' . $searchText;
}

if(isset($searchColumn) && isset($searchText)) {
	$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	echo $searchSql;
} else {
	$searchSql = '';
}
/* 검색 끝 */

$db->query = 'select count(*) as cnt from book' . $searchSql;
$db->DBQ();
$row = $db->result->fetch_assoc();

$allPost = $row['cnt']; //전체 게시글의 수

if(empty($allPost)) {
	$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
} else {
	$onePage = 10; // 한 페이지에 보여줄 게시글의 수.
	$allPage = ceil($allPost / $onePage); //전체 페이지의 수

	if($page < 1 && $page > $allPage) {
		?>
		<script>
			alert("존재하지 않는 페이지입니다.");
			history.back();
		</script>
<?php
		exit;
	}

	$oneSection = 8; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
	$currentSection = ceil($page / $oneSection); //현재 섹션
	$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1);
	//현재 섹션의 처음 페이지
	if($currentSection == $allSection) {
		$lastPage = $allPage;
		//현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
	} else {
		$lastPage = $currentSection * $oneSection;
		//현재 섹션의 마지막 페이지
	}
	
	$prevPage = (($currentSection - 1) * $oneSection);
	//이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1);
	//다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
	$paging = '<ul id="page">'; // 페이징을 저장할 변수
	if($page != 1) {
		$paging .= '<li class="page page_start"><a href="./index.php?page=1'.$subString.'">처음</a></li>';
	}
	//첫 섹션이 아니라면 이전 버튼을 생성
	if($currentSection != 1) {
		$paging .= '<li class="page page_prev"><a href="./index.php?page=' . $prevPage . $subString .'">이전</a></li>';
	}
	for($i = $firstPage; $i <= $lastPage; $i++) {
		if($i == $page) {
			$paging .= '<li class="page current">' . $i . '</li>';
		} else {
			$paging .= '<li class="page"><a href="./index.php?page=' . $i . $subString .'">' . $i . '</a></li>';
		}
	}
	
	//마지막 섹션이 아니라면 다음 버튼을 생성
	if($currentSection != $allSection) {
		$paging .= '<li class="page page_next"><a href="./index.php?page=' . $nextPage . $subString.'">다음</a></li>';
	}
	
	//마지막 페이지가 아니라면 끝 버튼을 생성
	if($page != $allPage) {
		$paging .= '<li class="page page_end"><a href="./index.php?page=' . $allPage . $subString .'">끝</a></li>';
	}
	$paging .= '</ul>';
	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	$db->query = 'select * from book'.$searchSql.' order by number desc' . $sqlLimit;
	//원하는 개수만큼 가져온다. (0번째부터 20번째까지
	$db->DBQ();
}
$base->content = '
		<div id="subnav">
			<nav id="subnav">
				<li><a href="./index.php">List</a></li>
				<li><a href="./new.php" style="color:#8c8a8a;">New</a></li>
				<li><a href="./del.php" style="color:#8c8a8a;">Delete</a></li>
				<li><a href="./modify.php" style="color:#8c8a8a;">Modify</a></li>
			</nav>
		</div>
		<table id="list">
			<tr>
				<th>도서번호</th>
				<th>도서명</th>
				<th>저자</th>
				<th>출판사</th>
				<th>분야</th>		
			</tr>';
			if(isset($emptyData)) {
				echo $emptyData;
			} else {
				while($row = $db->result->fetch_assoc()){
				$row['publisher'] = explode('출판사', $row['publisher']);
$base->content .= '
			<tr>
				<td style="width:74px;">'.$row['number'].'</td>
				<td style="width:254px;">'.$row['title'].'</td>
				<td style="width:134px;">'.$row['author'].'</td>
				<td style="width:94px;">'.$row['publisher'][0].'</td>
				<td style="width:104px;">'.$row['area'].'</td>
			</tr>';
				}
			}
$base->content .= '
			</table>'.
			"$paging".'';
$base->content .='
			<div id="searchBox">
				<form action="./index.php" method="get">
					<select name="searchColumn">
						<option';$searchColumn=="number"?
$base->content.=' selected="selected"':null;
$base->content.=' value="number">도서번호</option>
						<option';$searchColumn=="title"?
$base->content.=' selected="selected"':null;
$base->content.=' value="title">도서명</option>
						<option';$searchColumn=="author"?
$base->content.=' selected="selected"':null;
$base->content.=' value="author">저자</option>
						<option';$searchColumn=="publisher"?
$base->content.=' selected="selected"':null;
$base->content.=' value="publisher">출판사</option>
						<option';$searchColumn=="area"?
$base->content.=' selected="selected"':null;
$base->content.=' value="area">분야</option>
					</select>
					<input type="text" name="searchText" value="';
						isset($searchText)?$searchText:null;
$base->content.='">
					<button type="submit">검색</button>
				</form>
			</div>
			';

$base->LayoutMain();
?>