<?php
$id=$_GET[id]; 
echo "id:".$id."<br>";
?>
<hr>
<a href="../sample_base.php">sample_base.phpへ戻る</a>
<hr>
<?php
include_once "./../class/sample_ChildClass.php";
$obj =new childClass();
$select_querry=$obj->select_detail($id);

foreach($select_querry as $value){
	$result.="<hr>";
	$result.="ID:".$value[id]."<br>";
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

