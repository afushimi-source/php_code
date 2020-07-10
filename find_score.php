<h1>点数検索</h1>
<form action="./find_score.php" method="POST">
  <p><input type="text" name="min" size="3">から<input type="text" name="max" size="3">まで</p>
  <input type="submit" value="検索する">
</form>
<?php
require_once("functions.php");
if(isset($_POST['min'])){
  if(is_numeric($_POST['min'])==FALSE or is_numeric($_POST['max'])==FALSE){
    echo "数字を入力してください\n";
    exit;
  }
  $dbh = db_connect();
  $sql = 'select * from student where score >= :min and score <= :max';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':min',$_POST['min'],PDO::PARAM_INT);
  $stmt->bindValue(':max',$_POST['max'],PDO::PARAM_INT);
  $stmt->execute();
  $res=$stmt->fetchALL(PDO::FETCH_ASSOC);
  echo <<<EOD
  <table>
  <thead>
  <th>ID</th>
  <th>名前</th>
  <th>学年</th>
  <th>クラス</th>
  <th>性別</th>
  <th>点数</th>
  <th>作成日時</th>
  <th>編集</th>
  </thead>
 EOD;

echo "<tbody>";
$i=0;
foreach($res as $Value){
  print("<tr>");
  echo "<td>".$Value['id']."</td>";
  echo "<td>".$Value['name']."</td>";
  echo "<td>".$Value['grade']."</td>";
  echo "<td>".$Value['class']."</td>";
  echo "<td>".$Value['sex']."</td>";
  echo "<td>".$Value['score']."</td>";
  echo "<td>".$Value['created_date']."</td>";
  echo '<td><form action="./one.php" method="POST"><input type="hidden" name="id" value="'.$Value['id'].'"><input type="submit" value="編集する"></form></td>';
  print("</tr>");

}
print("</tbody></table>");
}