<?php
require_once '../layout.inc';
require_once '../db.php';

$db = new DBC;
$db->DBI();

$base = new Layout;
$base->link = '../style.css';

$number = $_POST['number'];
$title = $_POST['title'];
$id = $_POST['id'];
$day = date("Y-m-d H:i:s");
$nextday = date("Y-m-d H:i:s", strtotime($day."+3 days"));

if($_SESSION['id']==""){
	echo "<script>alert('로그인 이후 사용 가능합니다.');history.back();</script>";
	$db->DBO();
	exit;
}

//대출 중복확인
$db->query ="select count(number) from rent where number='".$number."' and turnin='0'";
$db->DBQ();
$res = $db->result->fetch_array();
if($res[0] != 0){
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('이미 대출된 도서입니다');location.replace('./index.php');</script>";
	$db->DBO();
	exit;
}

if($id == ""){
	echo "<script>alert('대출자 ID를 입력해 주세요.');history.back();</script>";
	$db->DBO();
	exit;
}else{
	$db->query ="select count(id) from member where id='".$id."'";
	$db->DBQ();
	$res = $db->result->fetch_array();
	if($res[0] == 0){
		header("Content-Type: text/html; charset=UTF-8");
		echo "<script>alert('존재하지 않는 아이디입니다.');location.replace('./index.php');</script>";
		$db->DBO();
		exit;
	}
}

if($number == ""){
	echo "<script>alert('대출할 도서를 선택하여주세요.');history.back();</script>";
	$db->DBO();
	exit;
}

$db->query = "insert into rent values ('".$number."', '".$_SESSION['id']."', '".$day."', '".$nextday."', '0')";
$db->DBQ();

//예약걸려있을시 대출확인 업데이트
$db->query ="select count(number) from reserve where number='".$number."' and end >= '".$day."' and borrow='0'";
$db->DBQ();
$res = $db->result->fetch_array();
if($res[0] != 0){
	$db->query ="update reserve set borrow='1' where number='".$number."' and end >= '".$day."' and borrow='0'";
	$db->DBQ();
}

header("Content-Type: text/html; charset=UTF-8");
echo "<script>alert('대출되었습니다.');location.replace('./index.php');</script>";
$db->DBO();
exit;

$base->content = "";

$base->LayoutMain();

?>
