<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>マンガCMS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary px-5">
                <div class="container-fluid ">
                    <a class="navbar-brand" href="#">マンガCMS</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if (isset($_SESSION['user_id'])) {?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/sign_in">ログイン</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/user">ユーザー情報</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/titles">マンガ一覧</a>
                        </li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
            </nav>
        
        </header>
        <main>
            <div class="container">