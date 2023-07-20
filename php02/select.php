<?php
//済
// 0. SESSION開始！！
session_start();

// 1. ログインチェック処理！
require_once('funcs.php');
$helper = new Helper();
$helper->loginCheck();

//２．データ登録SQL作成
$pdo = $helper->db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_osteo');
$status = $stmt->execute();

//３．データ表示
//３．データ表示
$view = "";
if ($status === false) {
    $helper->sql_error($stmt);
} else {
    $view .= '<table class="table table-striped">';
    $view .= '<thead><tr><th>Name</th><th>Birthday</th><th>Sex</th><th>PMH</th><th>PFX</th><th>Osteo</th><th>Operations</th></tr></thead>';
    $view .= '<tbody>';
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<tr>';
        $view .= '<td><a href="detail.php?id=' . $r['id'].'">'. $r['name'].'</a></td>';
        $view .= '<td>'. $r['birthday'].'</td>';
        $view .= '<td>'. $r['sex'].'</td>';
        $view .= '<td>'. $r['pmh'].'</td>';
        $view .= '<td>'. $r['pfx'].'</td>';
        $view .= '<td>'. $r['posteo'].'</td>';
        $view .= '<td>';
        //もし管理者なら表示する
        if ($_SESSION['kanri_flg'] === 1) {
            $view .= '<a class="btn btn-danger" href="delete.php?id=' . $r['id'] . '">';
            $view .= '[削除]';
            $view .= '</a>';
        }
        $view .= '</td>';
        $view .= '</tr>';
    }
    $view .= '</tbody>';
    $view .= '</table>';
}
?>
<!-- 以下HTMLは変更なし -->


<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー情報表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>

<div>
    <div class="container jumbotron">
    <a href="detail.php"></a>
    <?= $view ?></div>
</div>

</body>
</html>
