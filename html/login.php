<?php

    use Abraham\TwitterOAuth\TwitterOAuth;

    // セッションを作る
    session_start();

    // 読み込み
    require "vendor/autoload.php";

    // 共通変数取得
    $config = include("config.php");

    $twitterConnect = new TwitterOAuth(
        $config['consumerKey'],
        $config['consumerSecrect']
    );

    $requestToken = $twitterConnect->oauth(
        'oauth/request_token',
        [
            'oauth_callback' => $config['callback']
        ]
    );

    // 取得した情報をセッションに保存
    $_SESSION['oauth_token'] = $requestToken['oauth_token'];
    $_SESSION['oauth_token_secret'] = $requestToken['oauth_token_secret'];

    // twitterの認証画面へリダイレクトURLを取得
    $url = $twitterConnect->url(
        'oauth/authorize',
        [
            'oauth_token' => $requestToken['oauth_token']
        ]
    );

    // twitter認証画面へリダイレクト
    header('Location:' . $url);
    exit;

?>
