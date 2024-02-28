<p>ID <?= $_SESSION['user_id']?>  <?= $_SESSION['user_email']?></p>
<h2>ログアウト</h2>
<form action="/sign_out" method="post">
  <button type="submit" name="sign_out" value="send">ログアウト</button>
</form>