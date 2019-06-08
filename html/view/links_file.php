attack :https://movie.walkerplus.com/
<br>
<?php
//classの呼び出し
include_once "./../class/indexClass.php";
//クエリストリングで取得設定されたID情報を取得する
//echo $_GET[id];
$id=$_GET[id];
$obj =new index();
//echo "<a href=".$_SERVER['HTTP_REFERER'].">".戻る."</a>";
//echo "<a href="."./index.php".">"."top"."</a>";  URLが代わる
?>
<br>
<a href="../index.php">top</a>

<!DOCTYPE html>
<html>
<head>
    <title><?=$title?> パーマリンク遷移先</title>
    <?php //readfile(dirname(__FILE__) . "./../include/head.html");?>
	<style>
	</style>
</head>

<body>
<table border=0 cellpadding=0 cellspacing=0 width=100% height=100%>
    <tr>
        <td align=center valign=middle>

	<table border="0px" width="80%" height="70%" cellspacing="60px" cellpadding="90px">
		<tr align="center">
			<td width="60%">
			<?php
			$select_querry=$obj->select_detail($id);
			foreach($select_querry as $value){
				$result.="ID:".$value[id]."<hr><br>";
				$result.="date:".$value[date_time]."<hr><br>";
				$result.="title:".$value[title]."<hr><br>";
				$result.="tag:".$value[tag]."<hr><br>";
				$result.="summary:".$value[summary]."<hr><br>";
				$result.="content:".$value[content]."<hr><br>";
				//$result.="image:".'<img src="data:images/jpeg;base64,'.base64_encode($value[image]).'" >';
				$result.="image:".'<img src="data:images/jpeg;base64,'.base64_encode($value["image"]).'" width="300px" height="500px">';	
				$result.="<br><br>";
			}
			echo $result;
			?>
					
			//以下movie_wakkerから取得するプログラム実行 
			<br>
			<?php
			$title=$select_querry[0][title]; 
			//echo $title; 
			$keyword = $title;
			$strUrl ="https://movie.walkerplus.com/search/free_search.cgi?comkind=movie&keyword=".$title;
			$html = file_get_contents ($strUrl);
			//$pattern_URL="'/<h5 style="."width".":280"."px;"."><a href="."(.*?)".">".$title."/'";
			//$pattern_URL= htmlentities($pattern_URL,ENT_QUOTES,'UTF-8');
			echo $pattern_URL;
			$pattern ='/<h5 style="width:280px;"><a href="\/(.*?)\/">(.*?)/';
			preg_match($pattern, $html, $result);
			$movie_number = $result[1];
			echo "<br>";

			$strUrl="https://movie.walkerplus.com/".$movie_number."/";
			$html = file_get_contents ($strUrl);

			$pattern ='/<p id="strotyText">(.*?)<\/p>/';
			preg_match($pattern, $html, $result);
			echo $result[1];
			echo "<br>";

			$pattern ='/<meta name="description" content="(.*)">/';
			preg_match($pattern, $html, $result);
			echo $result[1];
			echo "<br>";
			//preg_match_allでパターン一致する要素を全て取得してくる
			//perlのwhile($res~/パターン/gi){print "$1"; last;}
			//改行や空白を含む場合は\s|\n|\tでエスケープしてやる

			//	$pattern='/<tr>\s|\n|\t<th>(.*?)<\/th>\s|\n|\t<td>\s|\n|\t<a href="\/person\/(.*?)\/"  title="(.*?)">(.*?)<\/a>\s|\n|\t<\/td>\s|\n|\t<\/tr>/';
				//preg_match_all($pattern, $html, $result);
				//var_dump($result[1]);
				//var_dump($result[3]); 
				
				//配列の特定文字列＿削除実行
				// $result[1] = 
				// array_diff($result[1], array('星５つ', '星４つ','星３つ','星２つ','星１つ','製作年','製作国','配給','上映時間'));

				// //indexを詰める
				// $result[1] = array_values($result[1]);
				// //配列の個数をカウント
				// $count_array=count($result[1]);
				// $i=0;
				// while($i<=$count_array){
					// if($result[1][$i]<>"" ){echo "<br>".$result[1][$i];}	
					// if($result[4][$i]<>"" ){echo $result[4][$i];	}
					// if($result[3][$i]<>"" ){echo $result[3][$i]; 	echo"<br>";}
				// $i++;
				// }
			//****************************************************************	
			//castテーブルをHTMLで抽出、それらをひとつづつ　行ごとに正規表現で抽出 
			//修飾子sで複数行マッチ
			$pattern='/<div id="castArea" class="(.*?)">(.*)<p class="copyright">/s';			
			//ページ全体のhtmlの記述が変わらないようしてやらないといけない　大元のhtmlは変数$htmlに記述されてる
			preg_match($pattern, $html, $result);
			// //cast_tableを抽出している
			$cast_html=$result[2];

			//cast_tableの役名を抽出					
			$pattern='/<th><span title="">(.*?)<\/span><\/th>/';
			preg_match_all($pattern, $cast_html, $roll);
			//一次配列にいれてやる
			$roll=$roll[1];

			// //cast_tableの役者を抽出
			$pattern='/<td><a href="\/person\/(.*?)\/" title="(.*?)">(.*?)<\/a>/';
			preg_match_all($pattern, $cast_html, $cast);
			//var_dump($cast[3]);
			$cast=$cast[3];

			$count_array=count($roll);
			$i=0;
			while($i<=$count_array){
					if($cast[$i]<>""){
						echo "cast:";
						echo $cast[$i]; 							
						
						//役名のあるものとそうでないものを識別
						if($roll[$i]<>""){
						echo "--";
						echo "役：";
						echo $roll[$i];		
						}
						echo"<br>";
					}else{
						
					}
				$i++;
			}
			//*************************************************
			//staf＿テーブル
			$pattern='/<div id="staffArea" class="(.*?)">(.*)<div id="castArea" class="(.*?)">/s';
			preg_match($pattern, $html, $result);
			//staf_tableを抽出している
			$staff_html=$result[2];

			$pattern='/<th>(.*?)<\/th>/';
			preg_match_all($pattern, $staff_html, $staff);
			$staff=$staff[1];

			$pattern='/<a href="\/person\/(.*?)\/"  title="(.*?)">(.*?)<\/a>/';
			preg_match_all($pattern, $staff_html, $staff_name);
			//var_dump($cast[3]);
			$staff_name=$staff_name[3];

			$count_array=count($staff_name);
			$i=0;
			while($i<=$count_array){
					echo $staff[$i];
					echo "----";
					echo $staff_name[$i]; 	
					echo"<br>";
				$i++;
			}			
			?>
		</td>

<!--textarea-->
<td>			 
編集領域（タイトル代えるとmovie_waker以下のプログラムが変更される）
<?php
echo $_SERVER["REQUEST_URI"] ;
?>
<form  action="<?=$_SERVER["REQUEST_URI"]?>" method ="post">
	<p>title</p>
	<input type = "text" name ="title"
	value="<?php 
	foreach($select_querry as $value){
	$title=$value[title];
	}
	echo $title;
	?>">
	<p>tag</p>
	<input type = "text" name ="tag"
	value="<?php 
	foreach($select_querry as $value){
	$tag=$value[tag];
	}
	echo $tag;
	?>">
	<p>summary</p>				
	<textarea name="summary" rows="40" cols="60"　 style="vertical-align: middle" value="">
	<?php foreach($select_querry as $value){$summary=$value[summary];}echo $summary;?>
	</textarea >
					<br>	
	<p>content</p>
	<textarea name="content" rows="40" cols="60"  style="vertical-align: middle">
	<?php foreach($select_querry as $value){$content=$value[content];}echo $content;?>
	</textarea >				
					<br>
		<input type = "submit" name="send1" value ="更新">	
</form>			


	
			<?php
			$title   =$_POST["title"];
			$summary =$_POST["summary"];
			$content =$_POST["content"];
			$tag	 =$_POST["tag"];
			var_dump($tag);
			$obj =new index();
			?>
			<?php
			//更新ボタンが押された時に更新処理を行う。
			if($_POST["send1"]<>""){
				//var_dump($_POST["send1"]);
				$select_querry=$obj->update($id,$title,$summary,$content,$tag);
				?>
				<!--オートリロード これしてやらないとDB情報が反映されない-->
				<head>
				<meta http-equiv="Refresh" content="0">
				</head>
			<?php
			}else{}
			header("Location: " . $_SERVER["REQUEST_URI"]);
			?>			
</td>
			
		</tr>
	</table>

		</td>
    </tr>
</table>

</body>
</html>