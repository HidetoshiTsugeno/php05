<?php
//済
//logoutはこのまま使ってOK
//必ずsession_startは最初に記述
session_start();

//SESSIONを初期化（空っぽにする）
$_SESSION = [];

//Cookieに保存してある"SessionIDの保存期間を過去にして破棄（マイナスにすることで過去のものにするありえない関数）
if (isset($_COOKIE[session_name()])) { //session_name()は、セッションID名を返す関数
    setcookie(session_name(), '', time() - 42000, '/');
}

//サーバ側での、セッションIDの破棄(念のため)
session_destroy();

//処理後、index.phpへリダイレクト
require_once('funcs.php');
$helper = new Helper();
$helper->redirect('login.php');
