<?php

$route = [
    [
        'method' => 'GET',
        'url'=> '/sign_up',
        'controller_action'=> 'RegistrationsController#new',
    ],
    [
        'method' => 'POST',
        'url'=> '/sign_up',
        'controller_action'=> 'RegistrationsController#create',
    ],
    [
        'method' => 'GET',
        'url'=> '/sign_in',
        'controller_action'=> 'SessionsController#new',
    ],
    [
        'method' => 'POST',
        'url'=> '/sign_in',
        'controller_action'=> 'SessionsController#create',
    ],
    [
        'method' => 'GET',
        'url'=> '/user',
        'controller_action'=> 'SessionsController#show',
    ],
    [
        'method' => 'POST',
        'url'=> '/sign_out',
        'controller_action'=> 'SessionsController#destroy',
    ],
    [
        'method' => 'GET',
        'url'=> '/titles',
        'controller_action'=> 'TitlesController#index',
    ],
    [
        'method' => 'GET',
        'url'=> '/titles/new',
        'controller_action'=> 'TitlesController#new',
    ],
    [
        'method' => 'POST',
        'url'=> '/titles/create',
        'controller_action'=> 'TitlesController#create',
    ],
    [
        'method' => 'GET',
        'url'=> '/titles/edit',
        'controller_action'=> 'TitlesController#edit',
    ],
    [
        'method' => 'POST',
        'url'=> '/titles/update',
        'controller_action'=> 'TitlesController#update',
    ],
    [
        'method'=> 'GET',
        'url'=> '/titles/chapters',
        'controller_action'=> 'ChaptersController#index',
    ],
    [
        'method'=> 'GET',
        'url'=> '/titles/chapters/new',
        'controller_action'=> 'ChaptersController#new',
    ],
    [
        'method'=> 'POST',
        'url'=> '/titles/chapters/create',
        'controller_action'=> 'ChaptersController#create',
    ], 
    [
        'method'=> 'GET',
        'url'=> '/titles/chapters/edit',
        'controller_action'=> 'ChaptersController#edit',
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
}

// ヘッダー
require('../views/layouts/header.php');

// マッチしたルートがあるかどうかを確認し、対応するファイルを含めるか404エラーを返す
if ($matched_route !== null) {

    $controllerAction = $matched_route['controller_action'];
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