<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <style>	
	</style>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php 
//classの呼び出し
include_once "./../class/indexClass.php";
//pager関数の記述
require_once "./../include/helper.php";	
//外部関数呼び出し*****************************************************
?>
<?php 
$obj=new index();
$select_querry = $obj->fav();
foreach($select_querry as $key => $value){
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
$smt.="<hr>";
}
echo $smt;
?>
<script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
function func(movie_id) {
	//movie_idに固有のIDが送信される
	console.log(movie_id);
	console.log("#ajax_"+movie_id);
    //二回クリックで送信の原因は
	//下記のonclickイベントとタグ内関数のonclickの二回記述により二重クリックが必要になっていた
	//$("#ajax_"+movie_id).on("click", function() {		
        $.get(//送信先URL
		"js.php",
		//"./../class/indexClass.php",
		{css : movie_id	},	
		//送信先URLで処理されたデータが返ってくる。そのデータをspanタグに反映される
		function(data) {
			//console.log(data.match("red"));
				if(data.match("red")){				
					$("#ajax_"+movie_id).css('color','rgb(255,0,0)');
					$("#ajax_"+movie_id).text("✔");
				}else if(data.match("blue")){					
					//$("#ajax_"+movie_id).css('background','rgb(0,255,0)');					
					$("#ajax_"+movie_id).css('color','rgb(0,0,255)');
					$("#ajax_"+movie_id).text("✘");
				}
			$("#span").text(data);
			//$("#span").text("167y981b");
			
			console.log(data);
			}				
		);    
	//});
};
</script>
