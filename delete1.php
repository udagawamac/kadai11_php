<?php
ini_set("display_errors",1);
session_start();

//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続
include("funcs.php");
sschk();
$pdo = db_conn();

//３．データ削除SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_ex_table1 WHERE id=:id");
$stmt->bindValue('id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ削除処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("select1.php");
}
?>
