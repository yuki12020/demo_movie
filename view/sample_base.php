
<?php //使用するclassの呼び出し
include_once "./../class/sample_ChildClass.php";

//pager関数の記述
require_once "./../include/helper.php";	
?>

<?php
	//childClassのインスタンスを生成
	$count =new childClass();
	
	(int)$cnt = $count->total();
	var_dump((int)$cnt);
	
	//---------出力-------------
	$select = $count->select();
	//var_dump($select); 
	echo "<br><hr>";
	//$selectは連想配列。
	//連想配列の取り出し方はfor文もしくはイテレーター使用
	foreach($select as $key => $value){
	$smt .="<br><a href="."./details.php/?id=".htmlspecialchars($value["id"],ENT_QUOTES,'UTF-8').">".$value["title"]."</a><br>";
	$smt .="title:".$value["title"];
	$smt .="<br>";
	$smt .="tag:".$value["tag"];
	$smt .="image:".'<img src="data:images/jpeg;base64,'.base64_encode($value["image"]).'" width="300px" height="500px">';
	$smt .="<br>";
	$smt .="<br><hr>";
	}
	echo $smt;
	//----------------------
	
	//$gpn=$count->GetParentName();
	//var_dump($gpn);

	$sum  = $count->sum(1,2);
	var_dump($sum);

?>