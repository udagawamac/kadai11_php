<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

//0. SESSION開始！！
session_start();

//1. DB接続
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_ex_user_table";
$stmt = $pdo->prepare("$sql");
$status = $stmt->execute(); //true or false

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す
$json = json_encode($values,JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <style>div{padding: 10px;font-size:16px;}</style>
    <link rel="icon" href="./img/parette.png">
    <title>登録者一覧</title>
</head>

<!-- Main[Start] -->
<body class="haikei">
    <main>
    作業しているのは<?=$_SESSION["name"]?>先生です<br>
    <a href="logout.php">ログアウト</a>
        <h3>ユーザー登録者一覧</h3>
        <div>
            <table border='1'>
                <tr>
                    <th>id</th>
                    <th>名前</th>
                    <th>種別</th>
                </tr>
                <?php foreach($values as $value){ ?>
                <tr>
                    <td><?=h($value["id"])?></td>
                    <td><?=h($value["name"])?></td>
                    <td><?=h($value["kanri_flg"])?></td>
                    <?php if($_SESSION["kanri_flg"]=="1"){ ?>
                    <td><a href="user_detail.php?id=<?=h($value["id"])?>">更新</a></td>
                    <td><a href="user_delete.php?id=<?=h($value["id"])?>">削除</a></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </table>
        </div>
        <p><a href="user_menu.php">メニューに戻る</a></p>
    </main>