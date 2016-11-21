<?php

require_once './layout.inc';

$base = new Layout;

$base->link = './style.css';
$base->content = "
<form action='./registo.php' method='post'>
	<table style='margin:0 auto; margin-top:5%;'>
		<tr>
			<th colspan='2'>회원가입</th>
		</tr>
		<tr>
			<td>아이디</td>
			<td><input type='text' size='16' name='id' placeholder='아이디'/></td>
		</tr>
		<tr>
			<td>비밀번호</td>
			<td><input type='password' size='30' name='pass1' placeholder='비밀번호'/></td>
		</tr>
		<tr>
			<td>비밀번호 확인</td>
			<td><input type='password' size='30' name='pass2' placeholder='비밀번호 확인'/></td>
		</tr>
		<tr>
			<td>이름</td>
			<td><input type='text' size='40' name='name' placeholder='이름'/></td>
		</tr>
		<tr>
			<td>주소</td>
			<td><input type='text' size='40' name='address' placeholder='주소'/></td>
		</tr>
		<tr>
			<td>이메일</td>
			<td><input type='text' size='35' name='mail' placeholder='이메일'/></td>
		</tr>
		<tr>
			<td>전화번호</td>
			<td><input type='text' size='20' name='phone' placeholder='전화번호'/></td>
		</tr>
		<tr>
			<td colspan='2' style='text-align:center;'><input type='submit' value='등록'/></td>
		</tr>
	</table>
</form>
";
$base->LayoutMain();
?>