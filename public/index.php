<?php

$route = [
    [
        'method' => 'GET',
        'url'=> '/sign_up',
        'file'=> 'RegistrationsController#new',
    ],
    [
        'method' => 'POST',
        'url'=> '/sign_up',
        'file'=> 'RegistrationsController#create',
    ],
    [
        'method' => 'GET',
        'url'=> '/sign_in',
        'file'=> 'SessionsController#new',
    ],
    [
        'method' => 'POST',
        'url'=> '/sign_in',
        'file'=> 'SessionsController#create',
    ],
    [
        'method' => 'GET',
        'url'=> '/user',
        'file'=> 'SessionsController#show',
    ],
    [
        'method' => 'POST',
        'url'=> '/sign_out',
        'file'=> 'SessionsController#destroy',
    ],
    [
        'method' => 'GET',
        'url'=> '/titles',
        'file'=> 'TitlesController#index',
    ],
    [
        'method' => 'GET',
        'url'=> '/titles/new',
        'file'=> 'TitlesController#new',
    ],
    [
        'method' => 'POST',
        'url'=> '/titles/create',
        'file'=> 'TitlesController#create',
    ],
    [
        'method' => 'GET',
        'url'=> '/titles/edit',
        'file'=> 'TitlesController#edit',
    ],
    [
        'method' => 'POST',
        'url'=> '/titles/update',
        'file'=> 'TitlesController#update',
    ],

];

$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ルートの検索
$matched_route = null;
foreach ($route as $route_item) {
    if ($route_item['method'] === $request_method && $route_item['url'] === $request_uri) {
        $matched_route = $route_item;
        break;
    }

    //$request_uriが/titles/:id/editの時TitlesControllerのedit()を呼び出す
}

// ヘッダー
require('../views/layouts/header.php');

// マッチしたルートがあるかどうかを確認し、対応するファイルを含めるか404エラーを返す
if ($matched_route !== null) {

    $controllerAction = $matched_route['file'];
    list($controller, $action) = explode('#', $controllerAction);
    // ファイルを呼び出す
    include_once("../controllers/".$controller.".php");
    // コントローラのインスタンスを生成
    $controllerInstance = new $controller();
    // アクションを呼び出す
    $controllerInstance->$action();
} else {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
}

// フッター
require('../views/layouts/footer.php');