<html>
<head>
	<meta charset="UTF-8">
	<title>サンプル1</title>
	<style>
	*{
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}
body{
	background: #81bcd8;
	font-family:"ãƒ’ãƒ©ã‚®ãƒŽè§’ã‚´ Pro W3", "Hiragino Kaku Gothic Pro", "ãƒ¡ã‚¤ãƒªã‚ª", Meiryo, Osaka, "ï¼­ï¼³ ï¼°ã‚´ã‚·ãƒƒã‚¯", "MS PGothic", "sans-serif";
	font-size: 20px;
}
.site-header{
	background: #fff;
	display: flex;
	padding: 60px 20px;
	position: fixed;
	justify-content: space-between;
	width: 100%;
}
.site-logo img{
	height: 20px;
	width: auto;
}
.gnav__menu{
	display: flex;
}
.gnav__menu__item{
	margin-left: 20px;
}
.gnav__menu__item a{
	color: #333;
	text-decoration: none;
}
.hero{
	max-height: 500px;
	overflow: hidden;
}
.hero img{
	height: auto;
	width: 100%;
}
.content{
	line-height: 1.6;
	margin: 0 auto;
	padding-top: 100px;
	width: 800px;
}
.content p{
	margin-bottom: 40px;
}
.site-footer{
	background: #333;
	padding: 80px 0;
}
.copyright{
	color: #fff;
	font-size: 12px;
	text-align: center;
}
	
	</style>
	<link href="reset.css" rel="stylesheet" type="text/css">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>


<body>
    <header class="site-header">
		<h1 class="site-logo"><img src="images/logo.png" alt="WEBDESIGNDAY"></h1>
		<div class="cp_tab">
	<input type="radio" name="cp_tab" id="tab1_1" aria-controls="first_tab01" checked>
	<label for="tab1_1">
	<a href="http://192.168.24.128/view/favaorite.php">
	checkMark（red）
	<img src="" alt="">
	</a>	
	</label>
	
	<input type="radio" name="cp_tab" id="tab1_2" aria-controls="second_tab01">
	<label for="tab1_2">
	Tag
	</label>
	
	<div class="cp_tabpanels">
		<div id="first_tab01" class="cp_tabpanel">
			<h2>チェックマーク</h2>
			<p>レッドのチェックマークを付けたものを表示する領域</p>		
		</div>
		
		<div id="second_tab01" class="cp_tabpanel">
			<h2>Tag</h2>
			<p>
			<?php 
			$obj = new index();
			$querry = $obj->tag();          
			foreach($querry as $key => $value){
			  $tag.= "<br><a href="."./tag_group.php/?tag=".htmlspecialchars($value["tag"],ENT_QUOTES,'UTF-8').">".$value["tag"]."</a>";
			}
			  echo $tag;
			?>
			</p>
		</div>
		
		<div id="third_tab01" class="cp_tabpanel">
			<h2>Third Tab</h2>
			<p>Third Tab text</p>
		</div>
		
		<div id="force_tab01" class="cp_tabpanel">
			<h2>Force Tab</h2>
			<p>Force Tab text</p>
		</div>
	</div>
</div>
<hr>
		<nav class="gnav">
			<ul class="gnav__menu">			
				<li class="gnav__menu__item">
				<?php echo $_POST['keyword']; ?>
				<form  action ="<?=$_SERVER['PHP_SELF']?>" method ="post">
					<input type = "text" name ="keyword">
					<input type = "submit" name="send1" value ="insert送信">
				</form>
				</li>
				
				<li class="gnav__menu__item">
				<form  action ="<?=$_SERVER['PHP_SELF']?>" method ="post">
					<input type = "text" name ="target">
					<input type = "submit" name="send1" value ="検索">	
				</form>
				</li>
			</ul>
		</nav>
	</header>
				<?php 
				$total = new index();
				$total = $total->total();
				echo "総データ件数：".$total;
				?>
				<?php echo $_POST['target'],$_POST['asc'],$_POST['desc']; ?>
				<?php
				$obj = new Index();
				(string)$target = $_POST['target'];
				?>
	target_site:https://coco.to/movies　→　https://www.cinemacafe.net

	
	<div class="hero"><img src="images/hero.jpg" alt="hero"></div>
	<div class="content">
		<p>Lorem ipsum Enim do velit exercitation fugiat cillum labore et dolore ad minim dolor amet tempor nisi sunt Excepteur voluptate laborum et Duis labore cupidatat officia laboris minim cupidatat sit ad incididunt dolor in nulla elit sint do sit aliqua eu ut irure commodo exercitation dolore consequat est laborum Duis in dolore esse est dolore voluptate amet fugiat cupidatat Duis proident consequat nostrud Excepteur ea minim nisi eiusmod sed amet irure id ut officia occaecat nisi elit velit qui aliquip adipisicing consequat adipisicing aute laboris do consectetur sit officia elit in tempor aute eiusmod nulla dolore non sint in fugiat adipisicing amet quis in velit sit sunt Duis culpa deserunt Duis sed elit veniam exercitation Ut pariatur magna et id esse dolor dolore aliquip et in cillum commodo commodo et quis veniam magna irure laborum commodo enim tempor dolore velit ut adipisicing consequat dolore enim sunt eiusmod irure aliquip Duis magna laboris non in aliquip magna dolor dolore nulla nisi proident cupidatat laboris eu commodo adipisicing adipisicing ut aliquip eu aute veniam sint magna mollit nostrud ut sed consectetur et tempor consequat nisi nostrud dolore et officia adipisicing labore id enim nisi reprehenderit sunt fugiat ea Ut dolore sed eu in id velit esse et est labore eiusmod culpa adipisicing quis ea consectetur ea fugiat in culpa magna do laboris.</p>
		<p>Lorem ipsum Enim do velit exercitation fugiat cillum labore et dolore ad minim dolor amet tempor nisi sunt Excepteur voluptate laborum et Duis labore cupidatat officia laboris minim cupidatat sit ad incididunt dolor in nulla elit sint do sit aliqua eu ut irure commodo exercitation dolore consequat est laborum Duis in dolore esse est dolore voluptate amet fugiat cupidatat Duis proident consequat nostrud Excepteur ea minim nisi eiusmod sed amet irure id ut officia occaecat nisi elit velit qui aliquip adipisicing consequat adipisicing aute laboris do consectetur sit officia elit in tempor aute eiusmod nulla dolore non sint in fugiat adipisicing amet quis in velit sit sunt Duis culpa deserunt Duis sed elit veniam exercitation Ut pariatur magna et id esse dolor dolore aliquip et in cillum commodo commodo et quis veniam magna irure laborum commodo enim tempor dolore velit ut adipisicing consequat dolore enim sunt eiusmod irure aliquip Duis magna laboris non in aliquip magna dolor dolore nulla nisi proident cupidatat laboris eu commodo adipisicing adipisicing ut aliquip eu aute veniam sint magna mollit nostrud ut sed consectetur et tempor consequat nisi nostrud dolore et officia adipisicing labore id enim nisi reprehenderit sunt fugiat ea Ut dolore sed eu in id velit esse et est labore eiusmod culpa adipisicing quis ea consectetur ea fugiat in culpa magna do laboris.</p>
	</div>
	
	
	<footer class="site-footer">
		<p class="copyright">@2017 WEBDESIGNDAY</p>
	</footer>
</body>
</html>
