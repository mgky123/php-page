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

$db->query = "insert into book values ('".$number."', '".$title."' , '".$author."','".$publisher."' ,
		'".$area."')";
$db->DBQ();

if(!$db->result)
{
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('새 도서 추가에 실패하였습니다. 관리자에게 문의해주세요');history.back();</script>";
	$db->DBO();
	exit;

} else
{
	echo "<script>alert('새 도서가 추가되었습니다.');location.replace('./index.php');</script>";
	$db->DBO();
	exit;
}


$base->content = "";

$base->LayoutMain();

?>
