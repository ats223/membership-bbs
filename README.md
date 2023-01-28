## 概要
<img src="https://user-images.githubusercontent.com/83529682/215229590-168d5fe2-d810-4e28-b8b7-7121b5ea11f0.png" width="320px"> <img src="https://user-images.githubusercontent.com/83529682/215229599-67b28c45-72f3-4864-ac22-893c32a05b69.png" width="320px"> 

<img src="https://user-images.githubusercontent.com/83529682/215229614-e3d3729d-59c8-459f-83c8-650149ff1544.png" width="320px"> <img src="https://user-images.githubusercontent.com/83529682/215229620-ffb9c993-404d-4b5a-857e-36103955ee8d.png" width="320px"> 


# 構築手順

http://サーバーのIPアドレス/signup.php でユーザー情報を登録後、login.php でログインしてbbs.phpにアクセス

## 準備
インスタンスを起動し秘密鍵を作成、<br>
Dockerをインストールする
```
docker インストール方法
sudo yum install -y docker
sudo systemctl start docker
sudo systemctl enable docker
sudo usermod -a -G docker ec2-user

```



## 1.GitHub リポジトリをクローンする

```
git clone git@github.com:ats223/membership-bbs.git
cd membership-bbs
```

## 2.Docker コンテナをビルドし、Docker Composeで起動する

```
sudo mkdir -p /usr/local/lib/docker/cli-plugins/
sudo curl -SL https://github.com/docker/compose/releases/download/v2.2.2/docker-compose-linux-x86_64 -o /usr/local/lib/docker/cli-plugins/docker-compose
sudo chmod +x /usr/local/lib/docker/cli-plugins/docker-compose

docker compose build

docker compose up
```

## 3.Docker コンテナ内で MYSQL のクライアントを用いてサーバーに接続する(DB名はtechc)

```
docker compose exec mysql mysql techc
```

## 4.会員情報テーブル、掲示板投稿テーブル、フォロー機能を管理する中間テーブルを作成する
```
CREATE TABLE `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `password` TEXT NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `icon_filename` TEXT DEFAULT NULL,
    `introduction` TEXT DEFAULT NULL,
    `cover_filename` TEXT DEFAULT NULL,
    `birthday` DATE DEFAULT NULL
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
```

登録されるメールアドレスに対する所有確認作業は今回は省きます。

ユーザー情報を登録後、メールアドレスとパスワードを入力し、ログインする。

以上で構築手順は終了です。
