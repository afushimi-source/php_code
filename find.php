<h1>名前検索</h1>
<form action="./find.php" method="POST">
  <label><input type="radio" name="category" value="name"  checked/>名前</label>
  <label><input type="radio" name="category" value="grade" />学年</label>
  <label><input type="radio" name="category" value="class" />クラス</label>
  <label><input type="radio" name="category" value="sex" />性別</label>
  <label><input type="radio" name="category" value="score"/>点数</label><br>
  <label><input type="text" name="str" placeholder="検索文字"></label><br>
  <input type="submit" value="検索する">
</form>
<?php
require_once("functions.php");
if(isset($_POST['category'])){
  $dbh = db_connect();
  $sql = 'select * from student where '.$_POST['category'].' like(:what)';
  $stmt = $dbh->prepare($sql);
  $str=$_POST['str'];
  $stmt->bindValue(':what',"%{$str}%",PDO::PARAM_STR);
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
