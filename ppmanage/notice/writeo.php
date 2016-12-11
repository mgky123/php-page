<?php
require_once '../layout.inc';
require_once '../db.php';

$db = new DBC;
$db->DBI();

$base = new Layout;
$base->link = '../style.css';

$title = $_POST['title'];
$sub = $_POST['sub'];
$writer = "주인장";
$date = date('Y-m-d H:i:s');

$db->query = "insert into notice(writer, date, title, sub) values ('".$writer."', '".$date."' , '".$title."','".$sub."')";
$db->DBQ();

if(!$db->result)
{
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('공지 등록에 실패하였습니다.');history.back();</script>";
	$db->DBO();
	exit;

} else
{
	echo "<script>alert('등록되었습니다.');location.replace('./index.php');</script>";
	$db->DBO();
	exit;
}


$base->content = "";

$base->LayoutMain();

?>
