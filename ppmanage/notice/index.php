<?php
include_once "../layout.inc"; // 레이아웃을 include 함
require_once '../db.php';

$base = new Layout; // Layout class 객체를 생성
$base->link='../style.css'; //css

$db = New DBC();
$db->DBI();

$db->query = "select count(idx) from notice";
$db->DBQ();
$res = $db->result->fetch_array();
if($res[0] == 0){
	$base->content='공지가 없습니다.';
	$base->content.='<br/><br/><a href="./write.php"><img src="../css/v_write.gif"></a>';
}else{
	$db->query = "select * from notice";
	$db->DBQ();
	$base->content='<a href="./write.php"><img src="../css/v_write.gif"></a><br/><br/>';
	while($res = $db->result->fetch_array()){
	$base->content.='
			<table style="float:left; border:1px solid black; margin:10px 10px 0 0; border-collapse:collapse; width:280px; height:250px; table-layout:fixed; font-size:14px;">
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
$base->LayoutMain(); //위의 변수들이 입력된 객체를 출력
?>