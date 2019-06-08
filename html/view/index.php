<?php 
//classの呼び出し
include_once "./../class/indexClass.php";
//pager関数の記述
require_once "./../include/helper.php";	
//外部関数呼び出し*****************************************************
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <style>	
*{
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}
body{
	background: #fff;
	font-family:"ãƒ’ãƒ©ã‚®ãƒŽè§’ã‚´ Pro W3", "Hiragino Kaku Gothic Pro", "ãƒ¡ã‚¤ãƒªã‚ª", Meiryo, Osaka, "ï¼­ï¼³ ï¼°ã‚´ã‚·ãƒƒã‚¯", "MS PGothic", "sans-serif";
	font-size: 20px;
}

.site-header{
	background: #fff;
	display: flex;
	padding: 80px 100px;
	position: fixed;
	justify-content: space-between;
	width: 100%;
	height: 100px;
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
	margin: 100 auto;
	overflow: hidden;
}

.hero img{
	height: auto;
	width: 100%;
}


.content{
	line-height: 1.6;
	margin: 100px auto; /*contentsの余白を空けている*/
	padding-top: 150px;
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
	<script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="ajax_check.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<div class="Header">
<?php //header insert
require_once "./../include/head.php";	
?>
</div>

<?php
    //ページング処理に必要な計算
	// #総件数取得
	$count =new index();
	(int)$cnt = $count->total();
	// #文字列から型変換(int)でcastする
	//var_dump((int)$cnt);
	// #オフセット処理
	$page = 1;
	if (preg_match("/^[0-9]+$/", htmlspecialchars($_GET["page"]))){
    $_GET["page"] !== "0"?($page = (int)$_GET["page"]):$page = 1;
	}
	$limit = 3;
    $offset = ($page[0] - 1) * $limit;
?>

<?php //echo pager($page,$cnt);?>

<!---ここからスクレイピング-->
<hr>
        <?php 
        $keyword = $_POST['keyword'];
        $strUrl = "https://coco.to/movies?q=".$keyword;
        $html = file_get_contents ($strUrl);
        $pattern ='/<a href="\/movie\/(.*?)" class="ro"><img src="(.*?)" data-original="(.*?)" alt=""\/><\/a>/';
        preg_match($pattern, $html, $result);
        foreach($result as $key =>$value){
           // echo $value."\n";    
        }
        ?>
        <?php
        //$namber=$_POST['number'];
        $number_coco=$result[1];        
        $strUrl="https://coco.to/movie/".$number_coco;
        $html = file_get_contents ($strUrl);
        //$pattern ='/<a href="\/movie\/(.*?)" class="ro"><img src="(.*?)" data-original="(.*?)" alt=""\/><\/a>/';
        $pattern ='/ href="https:\/\/www.cinemacafe.net\/movies\/(.+?)\/"/';
        preg_match($pattern, $html, $result);
        foreach($result as $key =>$value){
           // echo $value."\n";    
        }
        ?>
        
        <?php
        date_default_timezone_set('Asia/Tokyo');
        $date = date('Y-m-d H:i:s');
        $obj="";
        
        $number=$result[1];  
        $strUrl="https://www.cinemacafe.net/movies/".$number."/";
        $html = file_get_contents ($strUrl);
        
        $pattern ='/<span class="item">(.*?)<\/span>/';
        preg_match($pattern, $html, $result);
        $title = $result[1];
        
        //var_dump($html);
        $pattern ='/<meta property="og:description" content="(.*?)">/';
        preg_match($pattern, $html, $result);
        $content =$result[1];

        $pattern ="";
        $pattern ='/<p class="story">(.*?)<\/p>/';
        preg_match($pattern, $html, $result);
        $summary = $result[1];

        $pattern ="";
        $pattern='/<img class="image main_image" src="(.*?)" alt="(.*?)">/';
        preg_match($pattern, $html, $result);
        $image = $result[0];
		
        $pattern ="";
        $pattern='/href="\/movies\/tag\/genre\/(.+?)\/(.*?)">(.*?)<\/a>/';
		preg_match_all($pattern, $html, $result);
		$genre_array = $result[3];
		//var_dump($genre_array);
        ?>
        
        
    <!--//image 順次実行的にこうかかないといけないっぽい-->
    <?php   
        $strUrl="https://coco.to/movie/".$number_coco;
        $html = file_get_contents ($strUrl);
        $pattern='/<img src="(.*?)" border="0" alt="(.*?)" width="142"\/>/';
        preg_match_all($pattern, $html, $result);
        $image = $result[1];
		//var_dump($image);
		$url =$image[0];		
		$binary_data = file_get_contents($url);
		//var_dump($binary_data);
		//header('Content-type: image/jpeg');
		
    ?>
<!---ここまでスクレイピング-->

     
<!---insert文-->
    <?php
       $obj=new index();
       //insert文
	   //var_dump($title);
	   $filter_title = filter_input(INPUT_POST,$title,FILTER_SANITIZE_SPECIAL_CHARS);
       //var_dump($filter_title."test");
	   
	   if(!empty($title)){
		  //if(!empty($filter_title)){		
			$insert =$obj->insert($title,$content,$summary,$date,$binary_data);
			//二重更新、空更新を防ぐ
			$url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://").$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
			header('Location:'.$url.'');			
			exit();
			
			//exit処理を入れるとselect like文上でリダイレクト処理後に処理が行われなくなる模様
			//本来は、header('Location:'.$url.'');　exit();はの流れを書いてやらないと、二重更新防止に繋がらない模様
			//http://www-creators.com/archives/1012
			//リダイレクト(redirect)とは転送という意味であり、Web上でリダイレクトというと、あるページにアクセスがあった際に別のページに転送させる処理のことを指します。
		  //}
        }else{	
        }
     ?>

<!---select文-->
<!--<div class="Contents">-->
<div class="content">
<?php echo pager($page,$cnt);?>
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
</div>
	<div class="Ccontents_box">
		<body id="table">
			<table border=0 cellpadding=0 cellspacing=0 width=100% height=100%>
			<tr>
				<td align=center valign=middle>
					<?php
						//var_dump($target);
					   //インスタンス呼び
					   $select_querry = $obj->select($page,$target);
					   $i=1;
						echo "<div class="."box22".">";
						echo "<table width="."80%".">";
						echo "<p>";
					   foreach($select_querry as $key => $value){
						if($i===1 && $i===2 && $i===3 && $i===4){
							$smt.="<tr>";
							}else{}
							$smt.="<td  class="."style_td"." align="."center"." width="."100"."height="."200".">";           
							$smt.= "<br><a href="."./links_file.php/?id=".htmlspecialchars($value["id"],ENT_QUOTES,'UTF-8').">".$value["title"]."</a><br>";
							$smt.="image:".'<img src="data:images/jpeg;base64,'.base64_encode($value["image"]).'" width="100px" height="100px">';
							$smt.= "id:".$value["id"]."<br>";
							$smt.= "time:".$value["date_time"]."<br>";
							if($value["css"]==="0"){
							$smt.="<div class='btn'>";
							$smt.="<button 
							type="."submit".
							"class="."square_btn"."
							style="."color:"."rgb(0,0,255);
							id="."ajax_".$value["id"]."  
							onclick=func(".$value["id"].")>
							✘</button>";
							$smt.="</div>";
							}else if($value["css"]==="1"){
							$smt.="<div class='btn'>";
							$smt.="<button
							type="."submit".
							"class="."square_btn"."
							style="."color:"."rgb(255,0,0);
							id="."ajax_".$value["id"]."  
							onclick=func(".$value["id"].")>
							✔</button>";
							$smt.="</div>";
							}					
							//$smt.="<button type="."submit"." class="."square_btn"." id="."ajax_".$value["id"]."  onclick=func(".$value["id"].")>☆</button>";
							$smt.="<div id="."ajax_".$value["id"]."></div>";
							$smt.= "</td>";
						if($i%4===0){
							$smt.="</tr>";
							}else{}
						$i++;
						}
						echo "</p>";
							//array 文字　出力されている模様
							 echo $smt;
							 echo "</table>";
						echo "</div>";            
					// header('Location:'.$url.'');
					// exit();
					?>
				</td>
			</tr>
		</table>
		</body>
		<?php echo pager($page,$cnt);?>
		<div id="span"></div>
	</div>
</div>
</div>
<?php //header insert
require_once "./../include/footer.php";	
?>