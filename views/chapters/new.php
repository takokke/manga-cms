<h2>チャプター新規追加画面</h2>
<form action="/titles/chapters/create?title_id=<?= $title_id?>" method="post">
    <input type='hidden' name='csrf_token' value=<?= $_SESSION['csrf_token'] ?>>
    <div>
        <input type="text" name="chapter_name" placeholder="チャプター名" >
    </div>
    <div>
        <label for="start">公開日</label>
    </div>
    <div>
        <input type="date" id="start" name="publication_start_date">
    </div>
    
    <div>
        <input type="submit" value="保存">
    </div>
</form>