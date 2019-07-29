<?php echo "子クラス表示<br>"; ?>

<?php
//db接続用のファイル
include dirname(__FILE__) ."./../conf/db_connect.php";

//他ファイルの親クラス（sample_ParentClass）の継承
include dirname(__FILE__) ."/sample_ParentClass.php";

//親クラスの関数の呼び出し
ParentClass::db2();
?>


<?php
class childClass extends ParentClass{
	
    public function GetParentName(){
        echo $this->keisho;  //this で継承したプロパティを参照　$this->(参照変数プロパティ名)  参照する変数にはprotected　を付ける
   }	
	//sum文記述 sample 
	public function sum($A,$B){
		//親クラスのprotectedプロパティが来てる
		echo $this->keisho;
		//親クラスの関数も共通で使用できる
		ParentClass::db2();
		return $A+$B;
	} 
	
	public function total(){
	//データの総件数取得、ページングで使用する
	global $db; //includeの＄ｄｂ変数取得
	$sql="select count(id) from movie_info;";
	$info = $db->query($sql);
	$results = $info->fetchColumn();
	return $results;		
	}
	
	public function insert($title,$date){
	global $db; //includeの＄ｄｂ変数取得
	$sql="INSERT INTO `movie_info`.`movie_info` (title,date_time) VALUES ('".$title."','".$date."');";
	$info = $db->query($sql);
		//insert文 sample記述
	}
	
	//lobファイル（バイナリイメージ）のような大きなデータは、prepare,bindvalue,excuteの順でする必要ある
	public function insert2($title,$content,$summary,$date,$image){
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

	public function select(){
	global $db; //includeの＄ｄｂ変数取得
	$sql="select id,title,tag,image from movie_info";
	#クエリの実行
	$info = $db->query($sql);	
	#データベースのデータを全て取得fetchAll(PDO::FETCH_ASSOC);
	#データベースのデータを1行取得fetchColumn();
	$results = $info->fetchAll(PDO::FETCH_ASSOC);	
	return $results;
	} 

	public function select_detail($id){
	global $db; //includeの＄ｄｂ変数取得
	$sql="select * from movie_info where id=".$id;
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
	
}
?>