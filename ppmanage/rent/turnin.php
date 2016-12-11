<?php
require '../layout.inc';
$base = new Layout;
$base->link = '../style.css';


$base->content = '
		<div id="subnav">
			<nav id="subnav">
				<li><a href="./index.php" style="color:#8c8a8a;">Rent</a></li>
				<li><a href="./turnin.php">Return</a></li>
			</nav>
		</div>
		<form action="./turning.php" method="post">
			<table id="new">
				<tr>
					<td colspan="2"  style="font-size:14px; padding:0 0 8px 0;">반납할 도서를 불러와 확인후 반납합니다.</td>
				</tr>
				<tr>
					<td><input type="text" name="searchNum" size="10" placeholder="반납할 도서번호" style="width:150px; border:1px solid black;"></td>
					<td><input type="submit" name="btn" value="불러오기" style="width:120px; height:30px;"></td>
				</tr>
				<tr>
					<td><input type="text" name="searchTitle" size="10" placeholder="반납할 도서명" style="width:150px; border:1px solid black;"></td>
					<td><input type="submit" name="btn" value="불러오기" style="width:120px; height:30px;"></td>
				</tr>
			</table>
		</form>
		<form action="./turninb.php" method="post">
			<table id="new">
				<tr>
					<th>도서번호</th>
					<td><input type="text" name="number" size="10" placeholder=" 도서번호" value="'.$_GET['number'].'" readonly/></td>
				</tr>
				<tr>
					<th>도서명</th>
					<td><input type="text" name="title" size="50" placeholder=" 도서명" value="'.$_GET['title'].'" readonly/></td>
				</tr>
				<tr>
					<th>저자</th>
					<td><input type="text" name="author" size="30" placeholder=" 저자" value="'.$_GET['author'].'" readonly/></td>
				</tr>
				<tr>
					<th>출판사</th>
					<td><input type="text" name="publisher" size="30" placeholder=" 출판사" value="'.$_GET['publisher'].'" readonly/></td>
				</tr>
				<tr>
					<th>분야</th>
					<td><input type="text" name="area" size="20" placeholder=" 분야" value="'.$_GET['area'].'" readonly/></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="해당도서 반납" style="width:150px; height:30px; margin:10px 0 0 90px;"></td>
				</tr>
			</table>
		</form>
		';
$base->LayoutMain();
?>