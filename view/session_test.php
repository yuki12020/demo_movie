<?php
// セッション開始！
session_start();
?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<body>
 
<?php
// セッションデータを追加
$_SESSION['sdata1'] = 123;
$_SESSION['sdata2'] = "hello world";
$_SESSION['sdata3'] = array(123, "hello world", "PHP入門");
 
echo "セッションデータを追加しました。<br />"
?>
 
<p>こちらにアクセスし、セッションデータを出力してみましょう。<br />
→ 「<a href="variable-session2.php">セッションデータの出力</a>」</p>
 
</body>
</html>
セッションデータの取得（出力）
ソースを表示印刷SyntaxHighlighterについて
<?php
// セッション開始！
session_start();
?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<body>
 
<?php
// $_SESSIONのデータを出力
echo $_SESSION['sdata1'] ."<br />";
echo $_SESSION['sdata2'] ."<br />";
print_r( $_SESSION['sdata3'] );
 
// $_SESSIONのデータ削除
$_SESSION = array();
 
// セッションを破棄
session_destroy();
?>
 
</body>
</html>
