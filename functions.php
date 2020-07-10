<?php
function db_connect() {

  $dsn = 'mysql:dbname=db_test;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';

    $dbh = new PDO($dsn, $user, $password);

    $dbh->query('SET NAMES utf8');
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


    return $dbh;

}

function header1() {
  echo '<a href="./file_upload.php">ファイルでデータをアップロード</a><br>';
  echo '<a href="./one_upload.php">個別にデータを入力してアップロード</a><br>';
  echo '<a href="./db_list.php">名前リスト一覧へ</a><br>';
  echo '<a href="./find.php">名前検索へ</a><br>';
  echo '<a href="./find_score.php">点数検索へ</a><br>';
}
header1();