## 概要
Twiterに自動投稿する。

## 準備
### Twitterの管理画面調整
[Twitter Developer](https://developer.twitter.com/en.html)でアプリケーション追加。  
config.phpに取得したConsumer API keys情報を追加。それぞれ下記を指定。

Callback URLsに、config.phpに記載されているcallbackを追加する。  
デフォルトであれば下記。
> http://localhost:8000/callback.php

#### config設定
Keys and tokensから次の値を取得して、config.phpに設定

- consumerKey: API key
- consumerSecrect: API Secret Key

### 実行コマンド
[composer](https://getcomposer.org/)でライブラリを使うのでインストールする。

``` sh
$ cd <projectディレクトリ>
$ composer install
```

### 環境作成
Sessionを使うため、[ビルドインウェブサーバー](http://php.net/manual/ja/features.commandline.webserver.php)では実現できない。
そのため、ローカル環境で動かす場合はDockerイメージを作っておく。
インストールは、[Docker](https://www.docker.com/)より実施する。

``` sh
$ cd <projectディレクトリ>
$ docker build
```

## 起動
Dockerを起動して、[http://localhost:8000](http://localhost:8000)を開く。

``` sh
$ cd <projectディレクトリ>
$ docker build
```
