<?php
//済
$name = $_POST['name'];
$birthday = $_POST['birthday'];
$sex = $_POST['sex'];
$pmh = $_POST['pmh'];
$pfx = $_POST['pfx'];
$posteo = $_POST['posteo'];
$id = $_POST['id'];

//2. DB接続します
require_once('funcs.php');
$helper = new Helper();
$pdo = $helper->db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE gs_osteo
                        SET name = :name,
                            birthday = :birthday,
                            sex = :sex, 
                            pmh = :pmh, 
                            pfx = :pfx, 
                            posteo = :posteo
                            WHERE id = :id;');

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':pmh', $pmh, PDO::PARAM_STR);
$stmt->bindValue(':pfx', $pfx, PDO::PARAM_STR);
$stmt->bindValue(':posteo', $posteo, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    $helper->sql_error($stmt);
} else {
    $helper->redirect('select.php');
}


