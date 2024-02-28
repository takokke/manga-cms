<h2>チャプター一覧画面</h2>
<div>
    <a href="http://192.168.64.10/titles/chapters/new?title_id=<?= $title_id ?>"><button>チャプター新規追加</button></a>
</div>
<div>
    <a href="http://192.168.64.10/titles"><button>マンガ一覧に戻る</button></a>
</div>
<table>
    <thead>
        <tr>
            <th>チャプター名</th>
            <th>公開開始日</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php while( $stmt->fetch() ){ ?>
        <tr>
            <td><?= $chapter_name ?></td>
            <td><?= $start_date ?></td>
            <td><buttun><a href='http://192.168.64.10/titles/chapters/edit?title_id=<?= $title_id ?>&id=<?= $id ?>' >編集</a></buttun></td>
        </tr>
        <?php } ?>
    </tbody>
</table>