			 
	編集領域（タイトル代えるとmovie_waker以下のプログラムが変更される）
	<form  action="<?=$_SERVER["REQUEST_URI"]?>" method ="post">
		<p>title</p>
		<input type = "text" name ="title"
		value="<?php 
		foreach($select_querry as $value){
		$title=$value[title];
		}
		echo $title;
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
	// $title   =$_POST["title"];
	// $summary =$_POST["summary"];
	// $content =$_POST["content"];
	// $obj =new index();
	// ?>
	<?php
	// //更新ボタンが押された時に更新処理を行う。
	// if($_POST["send1"]<>""){
	// var_dump($_POST["send1"]);
	// $select_querry=$obj->update($id,$title,$summary,$content);
	// ?>
	<!--オートリロード これしてやらないとDB情報が反映されない-->
	<!--
		<head>
	// <meta http-equiv="Refresh" content="0">
	// </head>
	-->
	<?php
	// }else{}
	// header("Location: " . $_SERVER["REQUEST_URI"]);
	// ?>			
