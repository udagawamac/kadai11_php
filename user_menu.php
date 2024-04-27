<?php
ini_set("display_errors",1);
session_start();
include("funcs.php");
sschk();
$pdo = db_conn();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/style.css">
<link rel="icon" href="./img/pencil.png">
<style>div{padding: 10px;font-size:16px;}</style>
<title>メニュー</title>
</head>

<body>
<div class="navbar">
  <?=$_SESSION["name"]?>先生、こんにちは！　<a href="logout.php">ログアウト</a>　
  <!-- <a href="user.php">ユーザ登録</a>　 -->
</div>
<nav>ユーザーメニュー</nav>
<div class="menu">
  <a href="select1.php">国語の集計結果を見る</a>　　<a href="index1.php">国語のテスト結果を入力</a><br><br>
  <a href="select2.php">算数の集計結果を見る</a>　　<a href="index2.php">算数のテスト結果を入力</a><br><br>
  <?php if($_SESSION["kanri_flg"]=="1"){ ?>
  <a href="select_in.php">クラスの集計結果を見る</a><br><br>
  <a href="userlist.php">ユーザー一覧</a>
  <?php } ?>
</div>
</body>
</html>
