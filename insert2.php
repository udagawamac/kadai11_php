<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

//1. POSTデータ取得
$num   = $_POST["num"];
$name  = $_POST["name"];
$scorem = $_POST["scorem"];

//2. DB接続
include("funcs.php"); //外部ファイル読み込み
$pdo = db_conn();

//３．テーブル２にデータ登録SQL作成
$sql = "INSERT INTO gs_ex_table2(num,name,scorem)VALUES(:num, :name, :scorem)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':num',   $num,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name',  $name,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':score', $score, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //true or false

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  
//５．select2.phpへリダイレクト
redirect("select2.php");
}
?>
