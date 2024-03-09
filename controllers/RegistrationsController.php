<?php
class RegistrationsController {

	// ユーザー新規登録画面を表示するアクション
	public function new() {
		require("../views/registrations/new.php");
	}

	// ユーザー作成を行うアクション
	public function create() {
		if (isset($_POST["email"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
			$mysqli= new mysqli('localhost', 'hiroshima', 'brightech', 'test');
		
			if ($mysqli->connect_error) {
				echo $mysqli->connect_error;
				exit();
			} else {
				$mysqli->set_charset('utf8');
			}
		
			$email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
			$password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
		
			// パスワードをハッシュ化
			$password_hash = hash("sha256", $password);
		
			// プリペードステイトメント
			$stmt = $mysqli->prepare("INSERT INTO adm_admin_users (`email`, `password`) VALUES(?, ?)");
			$stmt->bind_param('ss', $email, $password_hash);
		
			//実行
			$stmt->execute();
		
			// 切断
			$stmt->close();
			$mysqli->close();
			header('Location: http://192.168.64.9/sign_up');
		
		}

	}

}