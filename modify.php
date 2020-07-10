<?php
require_once("functions.php");
if(isset($_POST['name'])){
  try{
    $dbh = db_connect();
    $sql = 'update student set name = :name, grade = :grade, class = :class, sex = :sex, score = :score where id = :id';
    $stmt = $dbh->prepare($sql);
    $params=array(':name' => $_POST['name'], ':grade' => $_POST['grade'], ':class' => $_POST['class'], ':sex' => $_POST['sex'], ':score' => $_POST['score'], ':id' => $_POST['id']);
    $stmt->execute($params);
    echo "<br>sucessful update!<br>";
  }catch(Exception $e){
    echo $e->getMessage();
  }
}