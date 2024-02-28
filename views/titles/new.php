<h2>マンガ新規追加画面</h2>
<form action="/titles/create" method="post">
    <input type='hidden' name='csrf_token' value=<?= $_SESSION['csrf_token'] ?>>
    <div>
        <input type="text" name="title" placeholder="タイトル名"/>
    </div>
    <div>
        <input type="text" name="author" placeholder="作家名"/>
    </div>
    <div>
        <textarea name="description" rows="5" cols="33" placeholder="作品説明"></textarea>
    </div>
    <div>
        <input type="submit" value="保存" />
    </div>
</form>