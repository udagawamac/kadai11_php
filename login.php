<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/style.css">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>

<body>
<div class="navbar">
  <a href="logout.php">ログアウト</a>　
  <a href="user.php">ユーザ登録</a>　
</div>
<nav>LOGIN</nav>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post">
ID:<input type="text" name="lid"><br>
PW:<input type="password" name="lpw"><br><br>
<input type="submit" value="ログイン">
</form>

</body>
</html>