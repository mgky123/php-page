<?php
require_once './layout.inc';
require_once './db.php';

$base = new Layout;

$base->link = './style.css';

$db = new DBC;
$db->DBI();

$id = $_POST['logid'];
$pass = $_POST['logpass'];

$db->query = "select id, pass, permit from member where id='".$id."' and pass='".$pass."'";
$db->DBQ();

$num = $db->result->num_rows;
$data = $db->result->fetch_row();

$db->DBO();


if($num==1)
{
	$_SESSION['id'] = $id;
	$_SESSION['permit'] = $data[2];
	echo "<script>location.replace('./index.php');</script>";
} else if(($id!="" || $pass!="") && $data[0]!=1)
{
	echo "<script>alert('아이디와 비밀번호가 맞지 않습니다.');</script>";
}

$base->content = "
		
	
<form action='".$_SERVER['PHP_SELF']."' method='post'>
	<table style='margin:0 auto; margin-top:5%;'>
		<tr>
			<th colspan='2'>로그인</th>
		</tr>
		<tr>
			<td><input type='text' Tabindex=1 name='logid'size='16' placeholder='아이디'/></td>
			<td rowspan='2'><input type='submit' Tabindex=3 value='로그인' style='height:50px;'/></td>
		</tr>
		<tr>
			<td><input type='password' Tabindex=2 name='logpass' size='16' placeholder='비밀번호'/></td>
		</tr>
		<tr>
			<td><a href='./registi.php'>등록</a></td>
			<td style='text-align:right;'><a href='./find.php'>찾기</a></td>
		</tr>
	</table>
</form>
";

$base->LayoutMain();

?>