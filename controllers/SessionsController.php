<?php
class SessionsController {
    public function new() {
        session_start();
        // SESSION[user_id]に値入っていればログインしたとみなす
        if(isset($_SESSION['user_id'])) {
          header('Location: http://192.168.64.9/titles');
          exit();
        } else {
            require('../views/sessions/new.php');
        }
    }

    public function create() {
        session_start();
        //MySQLに接続
        $mysqli = new mysqli('localhost', 'hiroshima', 'brightech', 'test');
        if($mysqli->connect_error){
          echo $mysqli->connect_error;
          exit();
        } else {
          $mysqli->set_charset('utf8');
        }
        if(isset($_SESSION['user_id'])) {
          // SESSION[user_id]に値入っていればログインしたとみなす
          header('Location: http://192.168.64.9/titles');
          // exit();
        } else {
          if (!empty($_POST["email"]) && !empty($_POST["password"])) {
               // $_POST["email"]も$_POST["passwprd"]も入力されている
              // 値を受け取る
              $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
              $password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
              // パスワードをハッシュ化
              $password_hash = hash("sha256", $password);
      
              $stmt = $mysqli->prepare("SELECT * FROM adm_admin_users WHERE `email`=?;");
              $stmt->bind_param('s', $email);
              $stmt->execute();
              
              $stmt->bind_result($id, $email, $db_password);
              while ($stmt->fetch()) {
                  if ($db_password == $password_hash) {
                      $_SESSION['user_email'] = $email;
                      $_SESSION['user_id'] = $id;
                      $stmt->close();
                      $mysqli->close();
                      header('Location: http://192.168.64.9/titles');
                  } else {
                      $stmt->close();
                      $mysqli->close();
                      header('Location: http://192.168.64.9/sign_in');
                  }
              };
          }
        }
        $mysqli->close();
        echo "<a href='/login'>ログイン失敗</a>";
    }

    public function show() {
        session_start();
        if(!isset($_SESSION['user_id'])) {
          echo "<p><a href='/sign_in'>ログインしていません</a></p>";
        } else {
            require('../views/sessions/show.php');
        }
    }

    public function destroy() {
        session_start();
        if (isset($_POST["sign_out"])) {
            if(isset($_SESSION['user_id'])) {
                $_SESSION = array();
                session_destroy();
            header('Location: http://192.168.64.9/sign_in');
            } else {
                echo "<a href='/sign_in'>ログインしていません</a>";
            }
        }
    }
}