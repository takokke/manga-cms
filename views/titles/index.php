<div class="row">
    <div class="col-md-6">
        <h2>マンガ一覧画面</h2>
        <div>
            <a href="http://192.168.64.10/titles/new"><button>マンガ新規追加</button></a>
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
                    <td><buttun  type="button" class="btn btn-secondary"><a href='http://192.168.64.10/titles/edit?id=<?= $row['id']?>' class="text-white" >編集</a></buttun></td>
                    <td><buttun  type="button" class="btn btn-success" ><a href='http://192.168.64.10/titles/chapters?title_id=<?= $row['id'] ?>'  class="text-white" >チャプター一覧</a></buttun></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>    
    </div>

</div>

