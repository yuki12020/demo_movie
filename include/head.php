
    <header class="site-header">
		<div id="switchArea">
		  <input type="checkbox" id="switch1" name="bgc">
		  <label for="switch1"><span></span></label>
		  <div id="swImg"></div>
		</div>
		<div class="cp_tab">
				<input type="radio" name="cp_tab" id="tab1_1" aria-controls="first_tab01" checked>
				<label for="tab1_1">
				<a href="http://192.168.179.6/view/favaorite.php">
				お気に入りcheckMark（red）
				<img src="" alt="">
				</a>	
				</label>
				
				<input type="radio" name="cp_tab" id="tab1_2" aria-controls="second_tab01">
				<label for="tab1_2">
				Tag入力したもの
				</label>			
				<div class="cp_tabpanels">
				<div id="first_tab01" class="cp_tabpanel"></div>			
					<div id="second_tab01" class="cp_tabpanel">
						<p>
						<?php 
						$obj = new index();
						$querry = $obj->tag();          
						foreach($querry as $key => $value){
						  $tag.= "<a href="."./tag_group.php/?tag=".htmlspecialchars($value["tag"],ENT_QUOTES,'UTF-8').">".$value["tag"]."</a><br>";
						}
						  echo $tag;
						?>
						</p>
					</div>
				</div>
		</div>
		
		<nav class="gnav">
			<ul class="gnav__menu">			
				<p class="gnav__menu__item">
				<?php echo $_POST['keyword']; ?>
				<form  action ="<?=$_SERVER['PHP_SELF']?>" method ="post">
					<input type = "text" name ="keyword">
					<input type = "submit" name="send1" value ="クローラーinsert">
				</form>
				</p>
				
				<p class="gnav__menu__item">
				<form  action ="<?=$_SERVER['PHP_SELF']?>" method ="post">
					<input type = "text" name ="target">
					<input type = "submit" name="send1" value ="検索">	
				</form>
				</p>
			</ul>
		</nav>
		
	</header>
				<?php 
				// $total = new index();
				// $total = $total->total();
				// echo "総データ件数：".$total;
				// ?>
				 <?php //echo $_POST['target'],$_POST['asc'],$_POST['desc']; ?>
				 <?php
				// $obj = new Index();
				// (string)$target = $_POST['target'];
				?>
