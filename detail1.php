<?php
ini_set("display_errors",1);
session_start();
$id = $_GET["id"];
//１．PHP
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_ex_table1 WHERE id =:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//指定データ取得
$values =  $stmt->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
  <link rel="icon" href="./img/parette.png">
  <title>データ詳細</title>
</head>

<body>
  <div class="haikei">
  <h3>国語のテストの点数を修正</h3>
    <form action="update1.php" method="POST">
      <label>出席番号：<input type="text" name="num" value="<?=$values["num"]?>" required></label><br>
      <label>名前：<input type="text" name="name" value="<?=$values["name"]?>" required></label><br>
      <label>点数 : <input type="text" name="score" value="<?=$values["score"]?>" required></label><br>
      <input type="hidden" name="id" value="<?=$values["id"]?>"><br>
      <button type="submit" value="送信">送信</button>
    </form>
  </div>
</body>

</html>