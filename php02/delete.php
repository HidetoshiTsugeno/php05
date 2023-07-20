<?php
//済
session_start();
require_once('funcs.php');

$helper = new Helper();
$helper->loginCheck();

//1. POSTデータ取得
$id = $_GET['id'];

//2. DB接続します
$pdo = $helper->db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM gs_osteo WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    $helper->sql_error($stmt);
} else {
    $helper->redirect('select.php');
}
