<h2>マンガ一覧画面</h2>
<div>
    <a href="http://192.168.64.10/titles/new">マンガ新規追加はこちら</a>
</div>
<form action="/sign_out" method="post">
    <button type="submit" name="sign_out" value="send">ログアウト</button>
</form>
<table>
    <thead>
        <tr>
            <th>タイトル名</th>
            <th>作家名</th>
            <th>作品説明</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc() ){ ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['author'] ?></td>
            <td><?= $row['description']?></td>
            <td><buttun><a href='http://192.168.64.10/titles/edit?id=<?= $row['id'] ?>' >編集</a></buttun></td>
            <td><buttun><a href='http://192.168.64.10/titles/chapters?title_id=<?= $row['id'] ?>' >チャプター一覧</a></buttun></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
