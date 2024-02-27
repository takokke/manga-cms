<?php

echo '<h2>管理者ユーザー追加</h2>';
echo '<form action="/sign_up" method="post">';
echo '  メールアドレス: <input type="email" name="email" /><br/>';
echo '  パスワード: <input type="password" name="password" /><br/>';
echo '  <input type="submit" />';
echo '</form>';