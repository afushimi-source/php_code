<?php
require_once("functions.php");
$dbh = db_connect();

$sql = 'SELECT * FROM student';
$stmt = $dbh->prepare($sql);

$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
foreach($users as $Value){
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