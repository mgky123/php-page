<?php
require_once '../layout.inc';
require_once '../db.php';

$db = new DBC;
$db->DBI();

$base = new Layout;
$base->link = '../style.css';

$number = $_POST['number'];
$title = $_POST['title'];
$day = date("Y-m-d H:i:s");
$nextday = date("Y-m-d H:i:s", strtotime($day."+4 hours"));

if($_SESSION['id']==""){
	echo "<script>alert('로그인 이후 사용 가능합니다.');history.back();</script>";
	$db->DBO();
	exit;
}

if($number == ""){
	echo "<script>alert('예약할 도서를 선택하여주세요.');history.back();</script>";
	$db->DBO();
	exit;
}

$db->query ="select count(number) from rent where number='".$number."' and end >= '".$day."' and turnin= '0'";
$db->DBQ();
$res = $db->result->fetch_array();
if($res[0] != 0){
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('이미 대출중인 도서입니다.');location.replace('./reserve.php');</script>";
	$db->DBO();
	exit;
}

$db->query ="select count(number) from reserve where borrower='".$_SESSION['id']."' and end >= '".$day."' and borrow = '0'";
$db->DBQ();
$res = $db->result->fetch_array();
if($res[0] > 2){
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('3권까지만 예약 가능합니다.');location.replace('./reserve.php');</script>";
	$db->DBO();
	exit;
}

$db->query ="select count(number) from reserve where number='".$number."' and end >= '".$day."' and borrow = '0'";
$db->DBQ();
$res = $db->result->fetch_array();
if($res[0]!=0){
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('이미 예약된 도서입니다.');location.replace('./reserve.php');</script>";
	$db->DBO();
	exit;
}

$db->query = "insert into reserve values ('".$number."', '".$_SESSION['id']."', '".$day."', '".$nextday."', '0')";
$db->DBQ();
header("Content-Type: text/html; charset=UTF-8");
echo "<script>alert('예약되었습니다.');location.replace('./reserve.php');</script>";
$db->DBO();
exit;

$base->content = "";

$base->LayoutMain();

?>
