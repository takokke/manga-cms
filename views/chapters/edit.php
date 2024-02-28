<h2>チャプター編集画面</h2>
<form action="/titles/chapters/update?title_id=<?= $title_id?>&id=<?= $id ?>" method="post">
    <input type='hidden' name='csrf_token' value=<?= $_SESSION['csrf_token'] ?>>
    <div>
        <input type="text" name="chapter_name" placeholder="チャプター名" value=<?= $chapter_name ?> >
    </div>
    <div>
        <label for="start">公開日</label>
    </div>
    <div>
        <input type="date" id="start" name="publication_start_date" value=<?= $start_date?> >
    </div>
    <div>
        <input type="submit" value="編集">
    </div>
</form>