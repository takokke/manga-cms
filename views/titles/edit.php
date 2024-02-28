<h2>マンガ編集画面</h2>
<form action='/titles/update?id=<?= $id ?>' method='post'>
    <input type='hidden' name='csrf_token' value='<?=$_SESSION['csrf_token']?>'>
    <div>
        <input type='text' name='title' value=<?= $name ?> placeholder='タイトル名'/>
    </div>
    <div>
        <input type='text' name='author' value=<?= $author ?> placeholder='作家名'/>
    </div>
    <div>
        <textarea name='description' rows='5' cols='33' placeholder='作品説明'><?= $description ?></textarea>
    </div>
    <div>
        <input type="submit" value="編集" />
    </div>
</form>