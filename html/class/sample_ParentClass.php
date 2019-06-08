<?php
class ParentClass
{
	//継承元は、protected修飾子付けないと、子クラスで呼び出せない。エラーになる模様　
	protected $keisho = "<br>ParentClass<br>";

	public function db2(){
		 $dddd="test:親クラスから呼び出し：";
		 echo $dddd."<br>";
		 //include dirname(__FILE__) ."./../conf/db_connect.php";
	} 

}

?>