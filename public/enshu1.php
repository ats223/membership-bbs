<?php

$dbh = new PDO('mysql:host=mysql;dbname=techc', 'root', '');

$insert_sth = $dbh->prepare("INSERT INTO hogehoge (text) VALUES (:text)");
$insert_sth->execute(array(
       ':text' => 'hello world!!!!!'
));

$select_sth = $dbh->prepare('SELECT COUNT(*) FROM hogehoge');
$select_sth ->execute();
$count = $select_sth->fetchColumn();
?>

現在のアクセスは <?= $count ?>です
