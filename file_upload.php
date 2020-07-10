<form action="file_upload.php" method="post" enctype="multipart/form-data">
  <p>CSVファイル：名前,学年,クラス,性別,点数の順番で１行ずつ記述</p>
  <input type="file" name="csvfile" size="3000" /><br />
  <p>区切り文字の指定（デフォルトで,(カンマ））
  <input type="text" name="deli" value=","></p>
  <input type="submit" value="アップロード" />
</form>

<?php
require_once("functions.php");
if(isset($_FILES['csvfile'])){
  if(isset($_POST['deli'])){
    $deli=$_POST['deli'];
  }else{
    $deli=",";
  }
if (is_uploaded_file($_FILES["csvfile"]["tmp_name"])) {
  $file_tmp_name = $_FILES["csvfile"]["tmp_name"];
  $file_name = $_FILES["csvfile"]["name"];
  if (move_uploaded_file($file_tmp_name, "./uploaded/" . $file_name)) {
      //後で削除できるように権限を644に
      chmod("./uploaded/" . $file_name, 0644);
      $msg = $file_name . "をアップロードしました。";
      $file = './uploaded/'.$file_name;
      $fp   = fopen($file, "r");

      //配列に変換する
      while (!feof($fp)){
        $str = fgets($fp);
        $lines[]=$str;
      }
      $line_n=count($lines);
      #print_r($lines);
      //ファイルの削除
      unlink('./uploaded/'.$file_name);
      if(isset($lines)){
        try{
          $dbh=db_connect();
          foreach($lines as $line){
            #print "$line:$deli\n";
            $items=explode($deli,$line);
            $n=count($items);
            if($n==5){
              $sql="insert into student (name, grade, class, sex, score) values (:name, :grade, :class, :sex, :score)";
              $stmt=$dbh->prepare($sql);
              $stmt->bindValue(':name', $items[0],PDO::PARAM_STR);
              $stmt->bindValue(':grade', $items[1],PDO::PARAM_INT);
              $stmt->bindValue(':class', $items[2],PDO::PARAM_STR);
              $stmt->bindValue(':sex', $items[3],PDO::PARAM_STR);
              $stmt->bindValue(':score', $items[4],PDO::PARAM_INT);
              $stmt->execute();
            }else{
              print "the number of culums is not enough...\n";
              $err=1;
            }
          }
          if($err!=1){
            print "sucessful upload!!\n";
            echo $line_n."件、データをアップロードしました。\n";
          }
          exit;
        }catch(Exception $e){
          echo $e->getMessage();
        }
      }
  } else {
      $err_msg = "ファイルをアップロードできません。";
  }
} else {
  $err_msg = "ファイルが選択されていません。";
}
}
if(isset($err_msg)){
  print "$err_msg\n";
}

