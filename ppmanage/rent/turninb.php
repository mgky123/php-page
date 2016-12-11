<?php
require_once '../layout.inc';
require_once '../db.php';

$db = new DBC;
$db->DBI();

$base = new Layout;
$base->link = '../style.css';

$number = $_POST['number'];
$day = date("Y-m-d H:i:s");

if($_SESSION['id']==""){
	echo "<script>alert('로그인 이후 사용 가능합니다.');history.back();</script>";
	$db->DBO();
	exit;
}

if($number == ""){
	echo "<script>alert('반납할 도서를 선택하여주세요.');history.back();</script>";
	$db->DBO();
	exit;
}

$db->query = "update rent set  turnin='1' where number='".$number."'";
$db->DBQ();

header("Content-Type: text/html; charset=UTF-8");
echo "<script>alert('반납되었습니다.');location.replace('./turnin.php');</script>";
$db->DBO();
exit;

$base->content = "";

$base->LayoutMain();

?>