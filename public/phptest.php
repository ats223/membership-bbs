<?php

 echo 'Hello ';

 $now = new \DateTime("now", new \DateTimeZone('Asia/Tokyo'));
 ?>

 <!DOCTYPE html>
 <head>
 </head>
 <body>
 現在の日時は<br>
 <?php
   $svg_area_size = 1000;
   $circle_r = 495;

   $seconds = intval($now->format('s'));
   $max_seconds = 60;
   $seconds_rad = ($seconds / $max_seconds) * 2 * pi();
   $seconds_x = ($svg_area_size / 2) + floor(sin($seconds_rad) * ($circle_r * 0.95));
   $seconds_y = ($svg_area_size / 2) - floor(cos($seconds_rad) * ($circle_r * 0.95));

   $minutes = intval($now->format('i'));
   $max_minutes = 60;
   $minutes_rad = ($minutes / $max_minutes) * 2 * pi();
   $minutes_x = ($svg_area_size / 2) + floor(sin($minutes_rad) * ($circle_r * 0.8));
   $minutes_y = ($svg_area_size / 2) - floor(cos($minutes_rad) * ($circle_r * 0.8));

   $hours = intval($now->format('h'));
   $max_hours = 12;
   // 時針は分も考慮する
   $hours_rad = (($hours + ($minutes / $max_minutes)) / $max_hours) * 2 * pi();
   $hours_x = ($svg_area_size / 2) + floor(sin($hours_rad) * ($circle_r * 0.5));
   $hours_y = ($svg_area_size / 2) - floor(cos($hours_rad) * ($circle_r * 0.5));


 ($now->format('Y-m-d H:i:s')); ?>

 <div style="margin-top: 5em;">

 <svg width="200" height="200" viewBox="0 0 1000 1000"
      xmlns="http://www.w3.org/2000/svg" version="1.1">
   <!-- 枠の円 -->
   <circle cx="500" cy="500"
      r="495" stroke="black" fill="white" stroke-width="5"/>
