<?php
include ('config.php');
include ('number.php');
include ('pages/clean.php');

// 获取参数
$pic_search = isset($_GET['s']) ? sanitizeInput($_GET['s']) : '';
$pages = isset($_GET['pages']) ? sanitizeInput($_GET['pages']) : '';

if (empty($pages)) {
  include ('pages/home.php');
} else {
  include ('pages/' . $pages . '.php');
}

?>