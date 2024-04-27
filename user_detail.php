<?php
ini_set("display_errors",1);
session_start();
$id = $_GET["id"];
//１．PHP
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_ex_user_table WHERE id =:id";
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
  <title>ユーザー管理</title>
  <link href="css/style.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>

<body>
<form method="post" action="user_update.php">
  <div class="navbar">
   <fieldset>
    <legend>ユーザー情報更新</legend>
     <label>名前：<input type="text" name="name" value="<?=$values["name"]?>" required></label><br>
     <label>Login ID：<input type="text" name="lid" value="<?=$values["lid"]?>" required></label><br>
     <!-- <label>Login PW<input type="text" name="lpw" value=""></label><br> -->
     <label>管理FLG：
      <select name="kanri_flg" required>
        <!-- <option value="<?=$values["kanri_flg"]?>"></option> -->
        <option value="1">管理者</option>
        <option value="0">一般</option>
      </select>
    </label>
    <br>
     <input type="hidden" name="id" value="<?=$values["id"]?>"><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
</html>