<?php
header('Content-Type: application/json');
$searchTerm = $_GET['s']; 
$searchTerm = mb_strtolower($searchTerm, 'UTF-8'); 
$metadataFile = 'search.txt'; // 数据文件路径
$results = []; 

// 读取文件
$content = file_get_contents($metadataFile);
if ($content === false) {
    die("Failed to open metadata file.");
}

// 分割内容
$lines = explode("\n", $content);
foreach ($lines as $line) {
    $parts = explode(',', $line);
    if (count($parts) < 2) continue; 
    $imageUrl = trim($parts[0]);
    $keywords = array_map(function($word) { return mb_strtolower(trim($word), 'UTF-8'); }, array_slice($parts, 1));
    
    // 检索
    if (array_intersect(explode(' ', $searchTerm), $keywords)) {
        $results[] = $imageUrl;
    }
}
echo json_encode($results);
?>