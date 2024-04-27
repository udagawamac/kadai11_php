<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
// sschk();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザーデータ登録</title>
  <link href="css/style.css" rel="stylesheet">
  <link rel="icon" href="./img/pencil.png">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>


<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <div class="navbar">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="name" required></label><br>
     <label>Login ID：<input type="text" name="lid" required></label><br>
     <label>Login PW<input type="text" name="lpw" required></label><br>
     <label>管理FLG：
      <select name="kanri_flg" required>
        <option value="1">管理者</option>
        <option value="0">一般</option>
      </select>
    </label>
    <br>
     <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>
