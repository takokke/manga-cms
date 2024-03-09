<?php

class ChaptersController {
    public function index() {
        $this->authenticate_admin_user();
        $title_id = htmlspecialchars($_GET['title_id'], ENT_QUOTES, "UTF-8");

        // 接続
        $mysqli = new mysqli('localhost', 'hiroshima', 'brightech', 'test');
        if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset('utf8');
        }
        
        $stmt = $mysqli->prepare("SELECT `id`, `name`, `publication_start_date` FROM mst_chapters WHERE `title_id` = ? ORDER BY id;");
        $stmt->bind_param("i", $title_id);
        $stmt->execute();
        $stmt->bind_result($id, $chapter_name, $start_date);

        require("../views/chapters/index.php");

        // 切断
        $stmt->close();
        $mysqli->close();
    }
    public function new() {
        $this->authenticate_admin_user();
        $title_id = $_GET["title_id"];
        // トークン作成
        $csrf_token = bin2hex(random_bytes(32));

        // 生成したトークンをセッションに保存
        $_SESSION['csrf_token'] = $csrf_token;
        require("../views/chapters/new.php");
    }

    public function create() {
        $this->authenticate_admin_user();
        $this->csrf_token_check();
        $title_id = htmlspecialchars($_GET["title_id"], ENT_QUOTES, "UTF-8");
        $chapter_name = htmlspecialchars($_POST['chapter_name'], ENT_QUOTES, "UTF-8");
        $start_date = htmlspecialchars($_POST['publication_start_date'], ENT_QUOTES, "UTF-8");

        // 接続
        $mysqli = new mysqli('localhost', 'hiroshima', 'brightech', 'test');
        if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset('utf8');
        }

        if (empty($_POST['chapter_name'])) {
            echo "チャプター名は必須項目です";
            require("../views/chapters/new.php");
        } elseif(new DateTime(date("Y-m-d")) > new DateTime($start_date)){
            echo "公開開始部が過去に設定されています";
            require("../views/chapters/new.php");
        } else {
            $stmt = $mysqli->prepare('INSERT INTO mst_chapters (`title_id`, `name`, `publication_start_date`) VALUES(?, ?, ?);');
            $stmt->bind_param("iss", $title_id, $chapter_name, $start_date);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            header("Location: http://192.168.64.9/titles/chapters?title_id=$title_id");
        }
    }

    public function edit() {
        $this->authenticate_admin_user();
        $id = htmlspecialchars($_GET["id"], ENT_QUOTES, "UTF-8");
        $title_id = htmlspecialchars($_GET["title_id"], ENT_QUOTES, "UTF-8");

        $mysqli = new mysqli('localhost', 'hiroshima','brightech', 'test');
        if ($mysqli->connect_error) {
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset('utf8');
        }

        $stmt = $mysqli->prepare('SELECT `name`, `publication_start_date` FROM mst_chapters WHERE `id` = ?;');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($chapter_name, $start_date);
        $stmt->fetch();
        require("../views/chapters/edit.php");
        $stmt->close();
        $mysqli->close();
    }

    public function update() {
        $this->authenticate_admin_user();
        $this->csrf_token_check();
        $id = htmlspecialchars($_GET["id"], ENT_QUOTES, "UTF-8");
        $title_id = htmlspecialchars($_GET["title_id"], ENT_QUOTES, "UTF-8");
        $tempfile = $_FILES['thumbnail']["tmp_name"];
        $extension = preg_replace('/^.*\.([^.]+)$/', '$1', $_FILES["thumbnail"]["name"]);
        $newfilename = "{$id}.{$extension}";
        
        $uploadfilename = "../public/assets/chapters/".$newfilename;

        if (is_uploaded_file($tempfile)) {
            if ( move_uploaded_file($tempfile , $uploadfilename )) {
                echo $uploadfilename . "をアップロードしました。";
            } else {
                echo "ファイルをアップロードできません。";
                exit();
            }
        } else {
            echo "ファイルが選択されていません。";
            exit();
        } 

        // todo webpに変換
        $cmd_cwebp = "cwebp -q 50 $uploadfilename -o ../public/assets/chapters/$id.webp";
        exec($cmd_cwebp);


        // 入力情報受け取り
        $input_chapter_name = htmlspecialchars($_POST["chapter_name"], ENT_QUOTES, "UTF-8");
        $input_start_date = htmlspecialchars($_POST["publication_start_date"], ENT_QUOTES, "UTF-8");

        // 接続
        $mysqli = new mysqli('localhost', 'hiroshima', 'brightech', 'test');
        if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset('utf8');
        }

        if (empty($_POST['chapter_name'])) {
            echo "チャプター名は必須項目です";
            $stmt = $mysqli->prepare('SELECT `name`, `publication_start_date` FROM mst_chapters WHERE `id` = ?;');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($chapter_name, $start_date);
            $stmt->fetch();
            require("../views/chapters/edit.php");
        } elseif (new DateTime(date("Y-m-d")) > new DateTime($input_start_date)) {
            echo "公開開始部が過去に設定されています";
            $stmt = $mysqli->prepare('SELECT `name`, `publication_start_date` FROM mst_chapters WHERE `id` = ?;');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($chapter_name, $start_date);
            $stmt->fetch();
            require("../views/chapters/edit.php");
        } else {
            $stmt = $mysqli->prepare('UPDATE mst_chapters SET `name` = ?, `publication_start_date` = ? WHERE `id` = ?;');
            $stmt->bind_param('ssi', $input_chapter_name, $input_start_date, $id);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            header("Location: http://192.168.64.9/titles/chapters?title_id=$title_id");
        }
    }

    // プライベートメソッド
    private function authenticate_admin_user() {
        session_start();
        if(!isset($_SESSION['user_id'])) {
            header('Location: http://192.168.64.9/sign_in');
        }
    }

    private function csrf_token_check()  {
        // トークンを確認
        if (!isset($_POST["csrf_token"]) && $_POST["csrf_token"] != $_SESSION['csrf_token']) {
            echo "入力画面が不正です";
            exit();
        }
    }

}