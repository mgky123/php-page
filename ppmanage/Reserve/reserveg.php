<?php
require_once '../layout.inc';
require_once '../db.php';

$db = new DBC;
$db->DBI();

$base = new Layout;
$base->link = '../style.css';

$searchNum = $_POST['searchNum'];
$searchTitle = $_POST['searchTitle'];

if($searchTitle == ""){
	$db->query = "select count(number) from book where number='".$searchNum."'";
	$db->DBQ();
}else{
	$db->query = "select count(title) from book where title='".$searchTitle."'";
	$db->DBQ();
}
$res = $db->result->fetch_array();
if($res[0]==0){
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('해당 도서가 존재하지 않습니다.');location.replace('./reserve.php');</script>";
	$db->DBO();
	exit;
}

if($searchTitle == ""){
	$db->query = "select * from book where number='".$searchNum."'";
	$db->DBQ();
}else{
	$db->query = "select * from book where title='".$searchTitle."'";
	$db->DBQ();
}
$res = $db->result->fetch_array();
echo "<script>location.replace('./reserve.php?number=".$res['number']."&title=".$res['title']."&author=".$res['author']."&publisher=".$res['publisher']."&area=".$res['area']."');</script>";
$db->DBO();
$base->content = "";

$base->LayoutMain();

?>
