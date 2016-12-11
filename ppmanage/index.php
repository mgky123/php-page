<?php
include_once "./layout.inc"; // 레이아웃을 include 함
require_once './db.php'; 

$base = new Layout; // Layout class 객체를 생성
$base->link='./style.css'; //css

$db = NEW DBC();
$db->DBI();

$db->query = "select count(idx) from notice";
$db->DBQ();
$res = $db->result->fetch_array();
$base->content = '<img src="./css/notice.png" style="margin:5px 0 0 10px;"><a href="./notice/index.php" style="margin:0 0 0 5px; color:black;">더보기</a><br/>';
if($res[0] == 0){
	$base->content.='공지가 없습니다.';
}else{
	$db->query = "select * from notice limit 3";
	$db->DBQ();
	while($res = $db->result->fetch_array()){
		$base->content.='
			<table style="float:left; border:1px solid black; margin:10px 0 15px 10px; border-collapse:collapse; width:280px; height:250px; table-layout:fixed; font-size:14px;">
				<tr>
					<th colspan="2" style="text-align:left; height:30px;">'.$res['title'].'</th>
				</tr>
				<tr style="border:1px solid black; height:30px;">
					<td style="border:1px solid black;">'.$res['writer'].'</td>
					<td>'.$res['date'].'</td>
				</tr>
				<tr style="word-wrap:break-word">
					<td colspan="2" valign="top" style="text-align:left;">
					<div style="overflow-y:scroll; height:230px; width:100%">
					'.$res['sub'].'
					</div></td>
				</tr>
			</table>
		
			'; //본문을 만듦
	}
}

if($_SESSION['id']==''){
	$emptyData = '
		<tr>
			<td colspan="4">로그인이 필요합니다</td>
		</tr>
		';
}else{
	$db->query = "select count(number) from reserve where borrower='".$_SESSION['id']."' and end >='".$day."' and borrow='0'";
	$db->DBQ();
	$res = $db->result->fetch_array();
	if($res[0]==0){
		$emptyData = '
			<tr>
				<td colspan="4">현재 예약된 도서가 없습니다</td>
			</tr>
			';
	}else{
		$db->query = "select reserve.number, book.title, reserve.end from reserve inner join book on reserve.number = book.number where reserve.borrower='".$_SESSION['id']."' and reserve.end >= '".$day."' and reserve.borrow='0' order by reserve.end desc, reserve.number desc";
		$db->DBQ();
	}
}
$base->content .= '
		<form action="./reserve_del.php" method="post">
			<table id="list">
				<tr>
					<td colspan="3"><b>내 예약도서</b></td>
				</tr>
				<tr>
					<th>도서번호</th>
					<th>도서명</th>
					<th>예약만료일</th>
				</tr>';
if(isset($emptyData)) {
	$base->content .= $emptyData;
} else {
	while($row = $db->result->fetch_assoc()){
		$base->content .= '
				<tr>
					<td style="width:90px;">'.$row['number'].'</td>
					<td style="width:375px;">'.$row['title'].'</td>
					<td style="width:195px;">'.$row['end'].'</td>
				</tr>';
	}
}
$base->content .= '
			</table>
		</form>';

if($_SESSION['id']==''){
	$emptyData2 = '
		<tr>
			<td colspan="4">로그인이 필요합니다</td>
		</tr>
		';
}else{
	$db->query = "select count(number) from rent where id='".$_SESSION['id']."' and turnin='0'";
	$db->DBQ();
	$res = $db->result->fetch_array();
	if($res[0]==0){
		$emptyData2 = '
			<tr>
				<td colspan="4">현재 대출한 도서가 없습니다</td>
			</tr>
			';
	}else{
		$db->query = "select rent.number, book.title, rent.end from rent inner join book on rent.number = book.number where rent.id='".$_SESSION['id']."' and rent.turnin='0' order by rent.end desc, rent.number desc";
		$db->DBQ();
	}
}
$base->content .= '
		<form action="./reserve_del.php" method="post">
			<table id="list" style="margin-top:50px;">
				<tr>
					<td colspan="4"><b>내 대출도서</b></td>
				</tr>
				<tr>
					<th>도서번호</th>
					<th>도서명</th>
					<th>대출만료일</th>
				</tr>';
if(isset($emptyData2)) {
	$base->content .= $emptyData2;
} else {
	while($row = $db->result->fetch_assoc()){
		$base->content .= '
				<tr>
					<td style="width:90px;">'.$row['number'].'</td>
					<td style="width:375px;">'.$row['title'].'</td>
					<td style="width:195px;">'.$row['end'].'</td>
				</tr>';
	}
}
$base->content .= '
			</table>
		</form>';
$db->DBQ();
$base->LayoutMain(); //위의 변수들이 입력된 객체를 출력
?>
