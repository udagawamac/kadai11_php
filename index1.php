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
  <title>スコア登録</title>
</head>

<body>
  <div class="haikei">
    <h3>国語のテストの点数を入力</h3>
    <form action="insert1.php" method="POST">
      <label>出席番号：<input type="text" name="num" required></label><br>
      <label>名前：<input type="text" name="name" required></label><br>
      <label>点数 : <input type="text" name="score" required></label><br><br>
      <button type="submit">送信</button>
    </form>
    <p><a href="user_menu.php">教科の選択に戻る</a></p>
    <!-- <p><a class="navbar-brand" href="login.php">ログイン</a></p> -->
  </div>
  <?php
    ?>
</body>

</html>