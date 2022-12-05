# bbs 構築手順

http://サーバーのIPアドレス/bbs.php

## 準備
インスタンスを起動し秘密鍵を作成<br>
あらかじめPHP,Docker,Git,MYSQLをインストールする



1.GitHub リポジトリをクローンする

```
git clone git@github.com:ats223/bbs.git
cd bbs
```

2.Docker コンテナをビルドし、Docker Composeで起動する

```
sudo mkdir -p /usr/local/lib/docker/cli-plugins/
sudo curl -SL https://github.com/docker/compose/releases/download/v2.2.2/docker-compose-linux-x86_64 -o /usr/local/lib/docker/cli-plugins/docker-compose
sudo chmod +x /usr/local/lib/docker/cli-plugins/docker-compose

docker compose build

docker compose up
```

3.Docker コンテナ内で MYSQL に接続する

```
docker compose exec mysql mysql techc
```

4.会員情報テーブル、掲示板投稿テーブル、フォロー機能を管理する中間テーブルを作成する
```
CREATE TABLE `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `password` TEXT NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

```
```

CREATE TABLE `bbs_entries` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `body` TEXT NOT NULL,
    `image_filename` TEXT DEFAULT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);


```

```
CREATE TABLE `user_relationships` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `followee_user_id` INT UNSIGNED NOT NULL,
    `follower_user_id` INT UNSIGNED NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE `users` ADD COLUMN icon_filename TEXT DEFAULT NULL;

ALTER TABLE `users` ADD COLUMN introduction TEXT DEFAULT NULL;

ALTER TABLE `users` ADD COLUMN cover_filename TEXT DEFAULT NULL;

ALTER TABLE `users` ADD COLUMN birthday DATE DEFAULT NULL;
```


http://サーバーのIPアドレス/signup.php でユーザー情報を登録後、ログインしてbbs.phpにアクセス可能

以上
