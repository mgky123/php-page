<?php
require '../layout.inc';
$base = new Layout;
$base->link = '../style.css';


$base->content = '
		<div id="subnav">
			<nav id="subnav">
				<li><a href="./index.php" style="color:#8c8a8a;">List</a></li>
				<li><a href="./new.php" style="color:#8c8a8a;">New</a></li>
				<li><a href="./del.php">Delete</a></li>
				<li><a href="./modify.php" style="color:#8c8a8a;">Modify</a></li>
		</nav>
		</div>
		<form action="./delb.php" method="post">
			<table id="new">
				<tr>
					<td colspan="2"  style="font-size:14px; padding:0 0 8px 0;">해당하는 조건을 모두 만족하는 모든도서를 삭제합니다.</td>
				</tr>
				<tr>
					<th>도서번호</th>
					<td><input type="text" name="number" size="10" placeholder=" 도서번호"/></td>
				</tr>
				<tr>
					<th>도서명</th>
					<td><input type="text" name="title" size="50" placeholder=" 도서명"/></td>
				</tr>
				<tr>
					<th>저자</th>
					<td><input type="text" name="author" size="30" placeholder=" 저자"/></td>
				</tr>
				<tr>
					<th>출판사</th>
					<td><input type="text" name="publisher" size="30" placeholder=" 출판사"/></td>
				</tr>
				<tr>
					<th>분야</th>
					<td><input type="text" name="area" size="20" placeholder=" 분야"/></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="해당도서 삭제" style="width:150px; height:30px; margin:10px 0 0 90px;"></td>
				</tr>
			</table>
		</form>
		';
$base->LayoutMain();
?>