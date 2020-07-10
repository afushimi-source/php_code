<h1>個別修正</h1>
<?php
require_once("functions.php");

if(isset($_POST['id'])){
  try{
    $dbh = db_connect();
    $sql = 'SELECT * FROM student WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $id=$_POST['id'];
    $stmt->execute([':id'=>$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    #print_r($student);
    echo '<form action="./modify.php" method="POST"><input type="hidden" value="'.$student['id'].'" name=id>';
    echo '<p><input type="text" name="name" value="'.$student['name'].'"></p>';
    echo '<p><input type="text" name="grade" value="'.$student['grade'].'"></p>';
    echo '<p><input type="text" name="class" value="'.$student['class'].'"></p>';
    echo '<p><input type="text" name="sex" value="'.$student['sex'].'"></p>';
    echo '<p><input type="text" name="score" value="'.$student['score'].'"></p>';
    echo '<p><input type="submit" value="修正する"></p>';
    echo '</form>';
    echo '<form action="./delete.php" method="POST"><input type="hidden" value="'.$student['id'].'" name=id>';
    echo '<input type="submit" value="削除する">';
    echo '</form>';
    exit;
  }catch(Exception $e){
    echo $e->getMessage();
  }
}
