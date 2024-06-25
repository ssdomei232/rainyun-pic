<?php
include('config.php');
header('Content-Type: application/json');
function getFilesAndShuffle($dir) {
    $files = scandir($dir);
    $files = array_diff($files, ['.', '..']);
    shuffle($files);
    echo json_encode($files);
}
echo getFilesAndShuffle($dir);