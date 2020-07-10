<h1>個別追加</h1>
<form method="POST" action="./one_upload.php">
  <p>名前：<input name="name" type="text"></p>
  <p>学年：<input name="grade" type="text"></p>
  <p>クラス：<input name="class" type="text"></p>
  <p>性別：<label><input name="sex" type="radio" value="男">男</label><label><input name="sex" type="radio" value="女">女</label></p>
  <p>点数：<input name="score" type="text"></p>
  <input type="submit" value="送信する">
</form>

<?php
require_once("functions.php");
if(isset($_POST['name'])){
  try{
    $dbh=db_connect();
    $sql="insert into student (name, grade, class, sex, score) values (:name, :grade, :class, :sex, :score)";
    $stmt=$dbh->prepare($sql);
    $stmt->bindValue(':name', $_POST['name'],PDO::PARAM_STR);
    $stmt->bindValue(':grade', $_POST['grade'],PDO::PARAM_INT);
    $stmt->bindValue(':class', $_POST['class'],PDO::PARAM_STR);
    $stmt->bindValue(':sex', $_POST['sex'],PDO::PARAM_STR);
    $stmt->bindValue(':score', $_POST['score'],PDO::PARAM_INT);
    $stmt->execute();
    print "successful upload!\n";
    exit;
  }catch(Exception $e){
    echo $e->getMessage();
  }
}