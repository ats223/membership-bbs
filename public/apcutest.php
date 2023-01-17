<?php

$apcu_key = 'access_counter';

$count = apcu_fetch($apcu_key);

$count = is_numeric($count) ? $count : 0;

$count++;

apcu_store($apcu_key, $count);
?>

あなたは <?= strval($count) ?>人目の訪問者です
