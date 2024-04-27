<?php
session_start();
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//1. POSTデータ取得
$num    = $_POST["num"];
$name   = $_POST["name"];
$score  = $_POST["score"];
$id     = $_POST["id"];

//2. DB接続
include("funcs.php"); //外部ファイル読み込み
sschk();
$pdo = db_conn();

//３．データ更新SQL作成
$sql = "UPDATE gs_ex_table2 SET num=:num, name=:name, scorem=:scorem WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':num',   $num,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name',  $name,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':score', $score, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',    $id,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ更新処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select2.php");
}

?>
