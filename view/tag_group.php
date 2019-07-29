<?php 
//classの呼び出し
include_once "./../class/indexClass.php";
//pager関数の記述
require_once "./../include/helper.php";	
//外部関数呼び出し*****************************************************
?>
<?php $tag=$_GET[tag]; ?>
tagグループ
<br>
<?php echo $tag;?>
<hr>　
<?php
$obj = new index();
$array = $obj->tag_select($tag);
foreach($array as $key => $value){
$smt.= "<br><a href="."../links_file.php/?id=".htmlspecialchars($value["id"],ENT_QUOTES,'UTF-8').">".$value["title"]."</a><br>";
$smt.="image:".'<img src="data:images/jpeg;base64,'.base64_encode($value["image"]).'" width="100px" height="100px">';
$smt.= "id:".$value["id"]."<br>";
$smt.= "time:".$value["date_time"]."<br>";
$smt.="<div id="."ajax_".$value["id"]."></div>";
$smt.="<hr>";
}
echo $smt; 
?>