<?php
require_once '../layout.inc';
require_once '../db.php';

$db = new DBC;
$db->DBI();

$base = new Layout;
$base->link = '../style.css';

$searchNum = $_POST['searchNum'];
$db->query = "select count(number) from book where number='".$searchNum."'";
$db->DBQ();
$res = $db->result->fetch_array();
if($res[0]==0){
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('없는 도서번호 입니다.');location.replace('./modify.php');</script>";
	$db->DBO();
	exit;
}

$db->query = "select * from book where number='".$searchNum."'";
echo $db->query;
$db->DBQ();
$res = $db->result->fetch_array();
echo "<script>location.replace('./modify.php?number=".$res['number']."&title=".$res['title']."&author=".$res['author']."&publisher=".$res['publisher']."&area=".$res['area']."');</script>";
$db->DBO();
$base->content = "";

$base->LayoutMain();

?>
