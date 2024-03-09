<?php
class TitlesController {

    public function index() {
        $this->authenticate_admin_user();

        // 接続
        $mysqli = new mysqli('localhost', 'hiroshima', 'brightech', 'test');
        if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset('utf8');
        }
   
        $sql = "SELECT * FROM mst_titles ORDER BY id;";
        $result = $mysqli->query($sql);
        
        // 切断
        $mysqli->close();
        require("../views/titles/index.php");
    }
    public function new() {
        $this->authenticate_admin_user();
        // トークン作成
        $csrf_token = bin2hex(random_bytes(32));

        // 生成したトークンをセッションに保存
        $_SESSION['csrf_token'] = $csrf_token;

        require("../views/titles/new.php");
    }

    public function create() {
        $this->authenticate_admin_user();
        $this->csrf_token_check();

        // 接続
        $mysqli = new mysqli('localhost', 'hiroshima', 'brightech', 'test');
        if($mysqli->connect_error){
          echo $mysqli->connect_error;
          exit();
        } else {
          $mysqli->set_charset('utf8');
        }

        // タイトル名は入力必須
        if (empty($_POST["title"])) {
            echo "タイトル名は必須項目です。";
            require("../views/titles/new.php");
        } else {
            // 値を受け取る
            $input_title = htmlspecialchars($_POST["title"], ENT_QUOTES, "UTF-8");
            $input_author = htmlspecialchars($_POST["author"], ENT_QUOTES, "UTF-8");
            $input_description = htmlspecialchars($_POST["description"], ENT_QUOTES, "UTF-8");

            $stmt = $mysqli->prepare("INSERT INTO mst_titles (`name`, `author`, `description`) VALUES(?, ?, ?);");
            $stmt->bind_param('sss', $input_title, $input_author, $input_description);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            header('Location: http://192.168.64.9/titles');
        }

    }

    public function edit() {
        $this->authenticate_admin_user();
        $request_param = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $parts = explode('=', $request_param);
        $search_id = $parts[1];

        // 接続
        $mysqli = new mysqli('localhost', 'hiroshima', 'brightech', 'test');
        if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset('utf8');
        }

        $stmt = $mysqli->prepare("SELECT * FROM mst_titles WHERE `id` = ?;");
        $stmt->bind_param('i', $search_id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $author, $description);
        $stmt->fetch();
        $stmt->close();
        $mysqli->close();

        // トークン作成
        $csrf_token = bin2hex(random_bytes(32));

        // 生成したトークンをセッションに保存
        $_SESSION['csrf_token'] = $csrf_token;
        require("../views/titles/edit.php");
    }

    public function update() {
        $this->authenticate_admin_user();
        $this->csrf_token_check();
        $search_id = $_GET['id'];

        // 入力情報受け取り
        $input_title = htmlspecialchars($_POST["title"], ENT_QUOTES, "UTF-8");
        $input_author = htmlspecialchars($_POST["author"], ENT_QUOTES, "UTF-8");
        $input_description = htmlspecialchars($_POST["description"], ENT_QUOTES, "UTF-8");

        // 接続
        $mysqli = new mysqli('localhost', 'hiroshima', 'brightech', 'test');
        if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset('utf8');
        }

        if (empty($_POST["title"])) {
            echo "タイトル名は必須項目です。";
            $stmt = $mysqli->prepare("SELECT * FROM mst_titles WHERE `id` = ?;");
            $stmt->bind_param('i', $search_id);
            $stmt->execute();
            $stmt->bind_result($id, $name, $author, $description);
            $stmt->fetch();
            $stmt->close();
            $mysqli->close();
            require("../views/titles/edit.php");
        } else {
            $stmt = $mysqli->prepare("UPDATE mst_titles SET `name` = ?, `author` = ?, `description` = ? WHERE `id`=?");
            $stmt->bind_param("sssi", $input_title, $input_author, $input_description, $search_id);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            header('Location: http://192.168.64.9/titles');
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