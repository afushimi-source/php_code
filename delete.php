<?php
require_once("functions.php");
if(isset($_POST['id'])){
  try{
    $dbh = db_connect();
    $sql = 'delete from student where id = :id';
    $stmt = $dbh->prepare($sql);
    $id=$_POST['id'];
    $stmt->execute([':id'=>$id]);
    echo "sucessful delete!<br>";
  }catch(Exception $e){
    echo $e->getMessage();
  }
}