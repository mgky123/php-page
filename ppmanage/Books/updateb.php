<?php
require_once '../layout.inc';
require_once '../db.php';

$db = new DBC;
$db->DBI();

$base = new Layout;
$base->link = '../style.css';

$number = $_POST['number'];
$title = $_POST['title'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$area = $_POST['area'];
$number_o = $_POST['number_o'];

if($number != $number_o){
	$db->query = "select count(number) from book where number='".$number."'";
	$db->DBQ();
	$res = $db->result->fetch_array();
	if($res[0] != 0){
		header("Content-Type: text/html; charset=UTF-8");
		echo "<script>alert('이미 존재하는 도서번호 입니다.');history.back();</script>";
		$db->DBO();
		exit;
	}
}

$db->query = "update book set number='".$number."',title='".$title."',author='".$author."',publisher='".$publisher."',area='".$area."' where number='".$number_o."'";
$db->DBQ();
header("Content-Type: text/html; charset=UTF-8");
echo "<script>alert('도서정보가 수정되었습니다.');location.replace('./modify.php');</script>";
$db->DBO();
exit;

$base->content = "";

$base->LayoutMain();

?>
