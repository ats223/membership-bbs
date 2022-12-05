# 構築手順

http://サーバーのIPアドレス/signup.php でユーザー情報を登録後、login.php でログインしてbbs.phpにアクセス

## 準備
インスタンスを起動し秘密鍵を作成、<br>
あらかじめPHP,Docker,Git,MYSQLをインストールする
```
docker インストール方法
sudo yum install -y docker
sudo systemctl start docker
sudo systemctl enable docker
sudo usermod -a -G docker ec2-user

PHP インストール
sudo yum install php php-fpm php-mysql php-curl php-gd php-mbstring php-mcrypt php-xml php-xmlrpc

MySQL インストール
sudo rpm -ivh http://dev.mysql.com/get/mysql57-community-release-el7-8.noarch.rpm
sudo yum install mysql-community-server
```



1.GitHub リポジトリをクローンする

```
git clone git@github.com:ats223/membership-bbs.git
cd membership-bbs
```

2.Docker コンテナをビルドし、Docker Composeで起動する

```
sudo mkdir -p /usr/local/lib/docker/cli-plugins/
sudo curl -SL https://github.com/docker/compose/releases/download/v2.2.2/docker-compose-linux-x86_64 -o /usr/local/lib/docker/cli-plugins/docker-compose
sudo chmod +x /usr/local/lib/docker/cli-plugins/docker-compose

docker compose build

docker compose up
```

3.Docker コンテナ内で MYSQL のクライアントを用いてサーバーに接続する(DB名はtechc)

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

ユーザー情報を登録後、メールアドレスとパスワードを入力し、ログインする

以上
