<?php
// トークン作成
$csrf_token = bin2hex(random_bytes(32));

// 生成したトークンをセッションに保存
$_SESSION['csrf_token'] = $csrf_token;

echo "<h2>マンガ編集画面</h2>";
echo "<form action='/titles/update' method='post'>";
echo "<input type='hidden' name='csrf_token' value='$_SESSION[csrf_token]'>";
echo "<input type='hidden' name='id' value='$id'>";
echo "<div><input type='text' name='title' value=$name  placeholder='タイトル名'/></div>";
echo "<div><input type='text' name='author' value=$author placeholder='作家名'/></div>";
echo "<div><textarea name='description' rows='5' cols='33' placeholder='作品説明'>$description</textarea></div>";
echo '<div><input type="submit" value="編集" /></div>';
echo '</form>';