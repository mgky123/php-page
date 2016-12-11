<?php
require '../layout.inc';
require_once '../db.php';

$base = new Layout;
$base->link = '../style.css';

$db = new DBC;
$db->DBI();
$day = date("Y-m-d H:i:s");
$del_num=0;
$ct=0;

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
	$db->query = "select reserve.number, book.title, reserve.end from reserve 
			inner join book on reserve.number = book.number 
			where reserve.borrower='".$_SESSION['id']."' and reserve.end >= '".$day."' 
					and reserve.borrow='0' order by reserve.end desc, reserve.number desc";
	$db->DBQ();
}

$base->content = '
		<div id="subnav">
			<nav id="subnav">
				<li><a href="./index.php" style="color:#8c8a8a;">List</a></li>
				<li><a href="./reserve.php" style="color:#8c8a8a;">Reserve</a></li>
				<li><a href="./mypage.php">Mypage</a></li>
			</nav>
		</div>
		<form action="./reserve_del.php" method="post">
			<table id="list">
				<tr>
					<td colspan="4"><b>내 예약도서</b></td>
				</tr>
				<tr>
					<th>도서번호</th>
					<th>도서명</th>
					<th>예약만료일</th>
					<th>선택</th>		
				</tr>';
			if(isset($emptyData)) {
				$base->content .= $emptyData;
			} else {
				while($row = $db->result->fetch_assoc()){
$base->content .= '
				<tr>
					<td style="width:90px;">'.$row['number'].'</td>
					<td style="width:330px;">'.$row['title'].'</td>
					<td style="width:150px;">'.$row['end'].'</td>
					<td style="width:90px;"><input type="checkbox" name="chk_del'.$ct++.'" value="'.$del_num++.'"></td>
				</tr>';
				}
$base->content .='
				<tr>
					<td colspan="4"><input type="submit" name="btn" value="선택 예약 취소" style="float:right; height:25px; width:90px; font-size:12px;"></td>
				</tr>
		';
			}
$base->content .= '
			</table>
		</form>';


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
	$db->query = "select rent.number, book.title, rent.end from rent 
				  inner join book on rent.number = book.number 
			      where rent.id='".$_SESSION['id']."' and rent.turnin='0' order by rent.end desc, 
			      	    rent.number desc";
	$db->DBQ();
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
$base->LayoutMain();
?>