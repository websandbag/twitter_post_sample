<?php
    use Abraham\TwitterOAuth\TwitterOAuth;

    // セッションを作る
    session_start();

    // 読み込み
    require "vendor/autoload.php";

    // 共通変数取得
    $config = include("config.php");

    // アクセストークンを元にユーザー情報を取得
    $userConnect = new TwitterOAuth(
        $config['consumerKey'],
        $config['consumerSecrect'],
        $_SESSION['access_token_oauth_token'],
        $_SESSION['access_token_oauth_token_secret']
    );

    // Twitterに画像をアップロードする
    $media = $userConnect->upload(
        'media/upload', [
            'media' => './images/sample.png'
        ]
    );

    // ツイート内容を作成
    $params = [
      'status' => '自動投稿テスト #test',
      'media_ids' => implode(',', [$media->media_id_string])
    ];

    // ツイートする
    $result = $userConnect->post(
        'statuses/update',
        $params
    );
    header('Location: index.php');
    exit();


 ?>
