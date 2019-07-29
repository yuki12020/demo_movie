<?php
include dirname(__FILE__) ."./../conf/db_connect.php";		
//引数の値が送信される
$css=$_GET['css'];
if(!empty($css)){
//空白じゃない時
$sql .="select css from movie_info";	
$sql .=" where id =".$css;
#クエリの実行
$row = $db->query($sql);
$row = $row->fetchAll(PDO::FETCH_ASSOC);
var_dump($row[0]["css"]);
#sql文の初期化処理
$sql="";
if($row[0]["css"]==="0"){
	$sql.="update movie_info set css ='1' ";
	$sql.=" where id =".$css;
	//1に切り替えるのでredを送信
	echo "red";
	$info = $db->query($sql);
	var_dump($info);
			
}else if($row[0]["css"]==="1"){
	$sql.="update movie_info set css ='0' ";
	$sql.=" where id =".$css;
	//0に切り替えるのでblueを送信
	echo "blue";
	$info = $db->query($sql);
	var_dump($info);
		
}

}else{	
}
?>