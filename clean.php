<?php
// 引入错误报告
error_reporting(E_ALL);

// 清理参数
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>