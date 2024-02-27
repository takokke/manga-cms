<?php 
  echo "ID $_SESSION[user_id]  $_SESSION[user_email]<br>";
  echo '<h2>ログアウト</h2>';
  echo '<form action="/sign_out" method="post">';
  echo '  <button type="submit" name="sign_out" value="send">ログアウト</button>';
  echo '</form>';