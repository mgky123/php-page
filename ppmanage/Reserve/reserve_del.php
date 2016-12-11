<?php
require_once '../layout.inc';
require_once '../db.php';

$db = new DBC;
$db->DBI();

$base = new Layout;
$base->link = '../style.css';

$chk_del0 = $_POST['chk_del0'];
$chk_del1 = $_POST['chk_del1'];
$chk_del2 = $_POST['chk_del2'];
$chk_del ='';

if($chk_del0=='' && $chk_del1=='' && $chk_del2==''){
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('예약취소할 도서를 선택하여 주세요.');history.back();</script>";
	$db->DBO();
	exit;
}
$db->query = "select * from reserve where borrower='".$_SESSION['id']."' and end >= '".date("Y-m-d")."' and borrow='0' order by end desc, number desc";
$db->DBQ();
while($res = $db->result->fetch_assoc()){
	$chk_del .= $res['number']." ";
}
$chk_del = explode(' ', $chk_del);

if($chk_del0 == '0'){
	$db->query = "delete from reserve where borrower='".$_SESSION['id']."' and end >= '".date("Y-m-d")."' and borrow='0'  and number='".$chk_del[0]."'";
	$db->DBQ();	
}
if($chk_del1 == '1'){
	$db->query = "delete from reserve where borrower='".$_SESSION['id']."' and end >= '".date("Y-m-d")."' and borrow='0'  and number='".$chk_del[1]."'";
	$db->DBQ();
}
if($chk_del2 == '2'){
	$db->query = "delete from reserve where borrower='".$_SESSION['id']."' and end >= '".date("Y-m-d")."' and borrow='0'  and number='".$chk_del[2]."'";
	$db->DBQ();
}

header("Content-Type: text/html; charset=UTF-8");
echo "<script>alert('예약이 취소되었습니다..');location.replace('./mypage.php');</script>";
$db->DBO();
exit;



$base->content = "";

$base->LayoutMain();

?>
