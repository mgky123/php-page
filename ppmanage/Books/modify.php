<?php
require '../layout.inc';
$base = new Layout;
$base->link = '../style.css';


$base->content = '
		<div id="subnav">
			<nav id="subnav">
				<li><a href="./index.php" style="color:#8c8a8a;">List</a></li>
				<li><a href="./new.php"  style="color:#8c8a8a;">New</a></li>
				<li><a href="./del.php" style="color:#8c8a8a;">Delete</a></li>
				<li><a href="./modify.php">Modify</a></li>
			</nav>
		</div>
		<form action="./modifyg.php" method="post">
			<table id="new">
				<tr>
					<td colspan="2"  style="font-size:14px; padding:0 0 8px 0;">변경할 도서를 불러온 후 변경값을 입력하고 저장합니다.</td>
				</tr>
				<tr>
					<td><input type="text" name="searchNum" size="10" placeholder="바꿀 도서번호" style="width:150px; border:1px solid black;"></td>
					<td><input type="submit" name="btn" value="불러오기" style="width:120px; height:30px;"></td>
				</tr>
			</table>
		</form>
		<form action="./updateb.php" method="post">
			<table id="new">
				<tr>
					<th>도서번호</th>
					<td><input type="text" name="number" size="10" placeholder=" 도서번호" value="'.$_GET['number'].'"/></td>
				</tr>
				<tr>
					<th>도서명</th>
					<td><input type="text" name="title" size="50" placeholder=" 도서명" value="'.$_GET['title'].'"/></td>
				</tr>
				<tr>
					<th>저자</th>
					<td><input type="text" name="author" size="30" placeholder=" 저자" value="'.$_GET['author'].'"/></td>
				</tr>
				<tr>
					<th>출판사</th>
					<td><input type="text" name="publisher" size="30" placeholder=" 출판사" value="'.$_GET['publisher'].'"/></td>
				</tr>
				<tr>
					<th>분야</th>
					<td><input type="text" name="area" size="20" placeholder=" 분야" value="'.$_GET['area'].'"/></td>
				</tr>
				<tr>
					<input type="hidden" name="number_o" value="'.$_GET['number'].'">
					<td colspan="2"><input type="submit" value="도서정보 수정" style="width:150px; height:30px; margin:10px 0 0 90px;"></td>
				</tr>
			</table>
		</form>
		';
$base->LayoutMain();
?>