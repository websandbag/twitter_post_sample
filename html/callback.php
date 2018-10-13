<?php
    use Abraham\TwitterOAuth\TwitterOAuth;

    // セッションを作る
    session_start();

    // 読み込み
    require "vendor/autoload.php";

    // 共通変数取得
    $config = include("config.php");

    // セッション退避
    $oauthToken = $_SESSION['oauth_token'];
    $oauthTokenSecret = $_SESSION['oauth_token_secret'];

    // ログインしたユーザで自動投稿を行う
    $twitterConnect = new TwitterOAuth(
        $config['consumerKey'],
        $config['consumerSecrect'],
        $oauthToken,
        $oauthTokenSecret
    );

    // アクセストークンを取得
    $accessToken = $twitterConnect->oauth(
        'oauth/access_token',
        array(
            'oauth_verifier' => $_GET['oauth_verifier'],
            'oauth_token'=> $_GET['oauth_token']
        )
    );
    $_SESSION['access_token_oauth_token'] = $accessToken['oauth_token'];
    $_SESSION['access_token_oauth_token_secret'] = $accessToken['oauth_token_secret'];

    // アクセストークンからユーザー情報を取得
    $userConnect = new TwitterOAuth(
        $config['consumerKey'],
        $config['consumerSecrect'],
        $accessToken['oauth_token'],
        $accessToken['oauth_token_secret']
    );

    //アカウントの有効性を確認するためのエンドポイントを取得
    $userInfo = $userConnect->get('account/verify_credentials');

    if(isset($userInfo->id_str)){
        $_SESSION['user_info'] = $userInfo;
        header("Location:index.php");
        exit;
    }
    else
    {
        header("Location:error.html");
        exit;
    }
?>
