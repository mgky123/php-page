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
$condi = 'where ';
$chk = 0;
if(!empty($number)){
	$condi .= 'number="'.$number.'"';
	$chk++;
}
if(!empty($title)!=''){
	if($condi == 'where '){
		$condi .= 'title="'.$title.'"';
	}else{
		$condi .= ' and title="'.$title.'"';
	}
	$chk++;
}
if(!empty($author)){
	if($condi == 'where '){
		$condi .= 'author="'.$author.'"';
	}else{
		$condi .= ' and author="'.$author.'"';
	}
	$chk++;
}
if(!empty($publisher)){
	if($condi == 'where '){
		$condi .= 'publisher="'.$publisher.'"';
	}else{
		$condi .= ' and publisher="'.$publisher.'"';
	}
	$chk++;
}
if(!empty($area)){
	if($condi == 'where '){
		$condi .= 'area="'.$area.'"';
	}else{
		$condi .= ' and area="'.$area.'"';
	}
	$chk++;
}
if($chk==0){
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('어떤 조건이라도 입력하여 주세요');history.back();</script>";
	$db->DBO();
	exit;
}
$db->query = "select count(number) from book ".$condi;
$db->DBQ();
$res = $db->result->fetch_array();
$db->query = "delete from book ".$condi;
$db->DBQ();

if(!$db->result || $res[0]==0)
{
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('도서 삭제에 실패하였습니다. 조건을 다시 확인해 주세요');history.back();</script>";
	$db->DBO();
	exit;
} else
{
	echo "<script>alert('도서가 삭제되었습니다.');location.replace('./index.php');</script>";
	$db->DBO();
	exit;
}


$base->content = "";

$base->LayoutMain();

?>
