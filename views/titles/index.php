<?php
echo "<h2>マンガ一覧画面</h2>";
echo '<div><a href="http://192.168.64.10/titles/new">マンガ新規追加はこちら</a></div>';
echo '<form action="/sign_out" method="post">';
echo '  <button type="submit" name="sign_out" value="send">ログアウト</button>';
echo '</form>';
echo "<table>\n";
echo "<tr><th>タイトル名</th><th>作家名</th><th>作品説明</th></tr>\n";
while($row = $result->fetch_assoc() ){
    echo "<tr>\n";
    echo "<td><a href='http://192.168.64.10/titles/edit?id=$row[id]'>{$row['name']}</a></td>\n";
    echo "<td>{$row['author']}</td>\n";
    echo "<td>{$row['description']}</td>\n";
    echo "</tr>\n";
}
echo "</table>";