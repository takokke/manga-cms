<h2>チャプター編集画面</h2>
<form action="/titles/chapters/update?title_id=<?= $title_id?>&id=<?= $id ?>" method="post" enctype="multipart/form-data">
    <input type='hidden' name='csrf_token' value=<?= $_SESSION['csrf_token'] ?>>
    <div>
        <label>チャプター名</label>
        <input type="text" name="chapter_name" placeholder="チャプター名" required value=<?= $chapter_name ?> >
    </div>
    <div>
        <label for="start">公開日</label>
        <input type="date" id="start" name="publication_start_date" required value=<?= $start_date?> >
    </div>
    <div>
        <label >サムネイル</label>
        <input type="file" name="thumbnail" required >
    </div>
    <div>
        <input type="submit" value="編集">
    </div>
</form>