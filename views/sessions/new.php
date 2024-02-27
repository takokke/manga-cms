<?php
echo "<h2>ユーザーログイン画面</h2>";
echo '<form action="/sign_in" method="post">';
echo '  メールアドレス: <input type="email" name="email" /><br/>';
echo '  パスワード: <input type="password" name="password" /><br/>';
echo '  <input type="submit" />';
echo '</form>';