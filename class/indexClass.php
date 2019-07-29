<?php
class index{
	
	//global include dirname(__FILE__) ."./../conf/db_connect.php";
	public function sum($A,$B){
		echo $A+$B;
		//sum文記述 sample
	}

	public function total(){
	//データの総件数取得、ページングで使用する
	include dirname(__FILE__) ."./../conf/db_connect.php";
	$sql="select count(id) from movie_info;";
	$info = $db->query($sql);
	$results = $info->fetchColumn();
	return $results;		
	}
	
	public function insert_prto($title,$date){
	//public内で読み込むファイルを読み込んでやらないといけない
	//DB接続用の変数$dbを使用したいのでinclude dirnameをしている
	//絶対パスの入力と　dirname(__FILE__)
	include dirname(__FILE__) ."./../conf/db_connect.php";
	$sql="INSERT INTO `movie_info`.`movie_info` (title,date_time) VALUES ('".$title."','".$date."');";
	$info = $db->query($sql);
	}
	
	public function insert($title,$content,$summary,$date,$image){
	//public内で読み込むファイルを読み込んでやらないといけない
	//DB接続用の変数$dbを使用したいのでinclude dirnameをしている
	//絶対パスの入力と　dirname(__FILE__)
	include dirname(__FILE__) ."./../conf/db_connect.php";
    
    #データベースのカラム
    //title　   -> varchar
    //content  -> Longtext
    //summary  -> longtext
    //date_time-> timestamp
    //image    -> longtext
    $sql="INSERT INTO movie_info (title,content,summary,date_time,image) VALUES ('$title','$content','$summary','$date',:image);";
	$stmt=$db->prepare($sql);
	// //PDO::PARAM_LOBでimageのバイナリーデータの形式を取得している。
	$stmt->bindValue(':image', $image, PDO::PARAM_LOB);
	$info =$stmt->execute();
	//$info = $db->query($sql);
		//insert文 sample記述
	}

	public function select($page,$target){
	include dirname(__FILE__) ."./../conf/db_connect.php";
	//pagerの設定
	//1ページに表示するレコード
	$limit = 16;
	//offset処理
    $offset = ($page - 1) * $limit; 
	$sql .="select * from movie_info";
	$sql .=" where true ";	
	$sql .= empty($target) ? "": "and title like '%".$target."%'";	
	//$sql .="and title like '%".$target."%'";
	//$sql .=" order by id desc";
	$sql .=" limit ".strval($limit);
    $sql .=" offset ".strval($offset);
	#クエリの実行
	$info = $db->query($sql);	
	#データベースのデータを全て取得fetchAll(PDO::FETCH_ASSOC);
	#データベースのデータを1行取得fetchColumn();
	$results = $info->fetchAll(PDO::FETCH_ASSOC);	
	return $results;
	} 

	public function select_detail($id){
	include dirname(__FILE__) ."./../conf/db_connect.php";
	$sql="select * from movie_info where id=".$id;
	$info= $db->query($sql);
	$results= $info->fetchAll(PDO::FETCH_ASSOC);
	return $results;		
	}	
	
	//foreach関数使わない方がいいかも
	public function foreach_select($querry,$target_name,$target_db_colum){
		foreach($querry as $value){
		$result = $target_name."---".$value[$target_db_colum];
		}
		return $result;
	}
		
	public function search($target,$page){
	include dirname(__FILE__) ."./../conf/db_connect.php";
	//pagerの設定//1ページに表示するレコード
	$limit = 3;
	//offset処理
    $offset = ($page - 1) * $limit;	
	$target= htmlentities($target,ENT_QUOTES,'UTF-8');
	echo $target;	
	$sql .="select * from movie_info as A";	
	//ライク検索が上手くいかない
	//$sql .=" where A.title like　LIKE '%{$target}%'";
	$sql .= " limit " .strval($limit);
    $sql .= " offset ".strval($offset);
	$info= $db->query($sql);
	$results= $info->fetchAll(PDO::FETCH_ASSOC);
	return $results;		
	}
		
	//update
	public function update($id,$title,$summary,$content,$tag){
	include dirname(__FILE__) ."./../conf/db_connect.php";
	$sql .="update movie_info set";
	$sql .=" title ='".$title."',"." ";
	$sql .=" summary ='".$summary."',"." ";
	$sql .=" content ='".$content."',"." ";	
	$sql .=" tag ='".$tag."'"." ";	
	$sql .=" where id =".$id;
	var_dump($sql);
	$info = $db->query($sql);
	return $info;
	echo $info;
	}
		
	//favaorite展開文
	public function fav(){
	include dirname(__FILE__) ."./../conf/db_connect.php";
	$sql ="select * from movie_info where css=1";
	$info= $db->query($sql);
	$results= $info->fetchAll(PDO::FETCH_ASSOC);
	return $results;		
	}
	
	//tag category
	public function tag(){
	include dirname(__FILE__) ."./../conf/db_connect.php";
	$sql ="select distinct tag from movie_info";
	$info= $db->query($sql);
	$results= $info->fetchAll(PDO::FETCH_ASSOC);
	return $results;	
	}
	
	//tag select
	public function tag_select($tag){
	include dirname(__FILE__) ."./../conf/db_connect.php";
	$sql ="select * from movie_info
	where tag='".$tag."'";
	$info= $db->query($sql);
	$results= $info->fetchAll(PDO::FETCH_ASSOC);
	return $results;
	}
	
	//like search
	public function like($page,$target,$sort){
	include dirname(__FILE__) ."./../conf/db_connect.php";
	//pagerの設定
	//1ページに表示するレコード
	$limit = 16;
	//offset処理
    $offset = ($page - 1) * $limit; 
	$sql= "select title from movie_info 
	where true
	and title like '%".$target."%'";
	$sql .= "order by id".$sort;
	$sql .= " limit " .strval($limit);
    $sql .= " offset ".strval($offset);
	$info = $db->query($sql);
	$result = $info->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	
	
	
	
}
?>