<?php

require_once '../layout.inc';

$base = new Layout;

$base->link = '../style.css';
$base->content = "
<form action='./writeo.php' method='post' id='write'>
	<table style='margin:0 auto; margin-top:5%;'>
		<tr>
			<th colspan='2'>Notice</th>
		</tr>
		<tr>
			<td>제목</td>
			<td><input type='text' name='title' style='width:315px;' placeholder='제목'/></td>
		</tr>
		<tr style='word-wrap:break-word'>
			<td colspan='2' valign='top' style='text-align:left;'><textarea form='write' name='sub' form placeholder='내용' style='width:350px; height:150px;overflow-y:scroll;'/></textarea></td>
		</tr>
		<tr>
			<td colspan='2' style='text-align:center;'><input type='submit' value='등록'/></td>
		</tr>
	</table>
</form>
";
$base->LayoutMain();
?>