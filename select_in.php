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
$sql = "SELECT * FROM gs_ex_table1 INNER JOIN gs_ex_table2 ON gs_ex_table1.id = gs_ex_table2.id";
$stmt = $pdo->prepare("$sql");
$status = $stmt->execute(); //true or false

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
// var_dump($values);
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>
    <link rel="icon" href="./img/pencil.png">
    <title>クラスの集計結果</title>
</head>

<!-- Main[Start] -->
<body class="haikei">
    <main>
    <?=$_SESSION["name"]?>先生、こんにちは！
    <a href="logout.php">ログアウト</a>
        <h3>テスト結果一覧</h3>
        <div>
            <table border='1'>
                <tr>
                    <th>出席番号</th>
                    <th>名前</th>
                    <th>国語</th>
                    <th>算数</th>
                    <th>合計</th>
                </tr>
                <?php foreach($values as $value){ ?>
                <tr>
                    <td><?=h($value["num"])?></td>
                    <td><?=h($value["name"])?></td>
                    <td><a href="detail1.php?id=<?=h($value["id"])?>"><?=h($value["score"])?></td>
                    <td><a href="detail2.php?id=<?=h($value["id"])?>"><?=h($value["scorem"])?></td>
                    <td id="ts"><?=$total_score = $value["score"] + $value["scorem"]?></td>
                    <!-- <?php if($_SESSION["kanri_flg"]=="1"){ ?> -->
                    <!-- <td><a href="delete1.php?id=<?=h($value["id"])?>">削除</a></td> -->
                    <!-- <?php } ?> -->
                </tr>
                <?php } ?>
            </table>
        </div>
        <p><a href="index1.php">入力画面に戻る</a></p>
    </main>
    <!-- Main[End] -->
    <!-- グラフを表示するキャンバス -->
    <div style="width:300px;height:250px;margin-left:auto;margin-right:auto;margin-top:40px;margin-bottom:20px;">
        <canvas id="scoreChart"></canvas>
    </div>
    <!-- 合計人数を表示する領域 -->
    <h3 id="totalCount"></h3>    
 
    <!-- JSON受け取り -->
    <script>
        const a = '<?php echo $json; ?>';
        const data = JSON.parse(a);
        console.log(data);
        console.log(total_score);
        //score の値を取り出し、新しい配列 scores に格納
        const scores = data.map(obj => obj.score);
        console.log(scores);

        var tss = document.getElementById("ts").value;
        console.log(tss);
        // // 得点の頻度を格納する配列を初期化
        var tssFrequency = Array(11).fill(0);
        // // 得点の頻度を計算
        tss.forEach(function(ts) {
            tsFrequency[Math.floor(ts / 10)]++;
        });

        //  テストを受けた生徒の総数（＝データ数）をカウント
        // const totalCount = data.length;

        // キャンバス要素を取得
        const ctx = document.getElementById('scoreChart').getContext('2d');

        // 棒グラフを描画
        const scoreChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['0-19', '20-39', '40-59', '60-79', '80-99', '100-119', '120-139', '140-159', '160-179', '180-199', '200'],
                datasets: [{
                    label: '得点分布',
                    data: tsFrequency,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });
        // 合計値を表示する要素に合計値を挿入
        document.getElementById('totalCount').innerText = '生徒総数: ' + totalCount + '人';
    </script>
</body>
</html>
