<?php
$mode = isset($_GET['mode']) ? sanitizeInput($_GET['mode']) : ''; // 响应模式
$results = []; 

// 数据文件路径
$metadataFile = 'pages/search.txt';
// 读取文件内容
$content = file_get_contents($metadataFile);
if ($content === false) {
    http_response_code(500);
    echo "Failed to open metadata file.";
    exit;
}

// 分割内容并处理每一行
$lines = explode("\n", $content);
foreach ($lines as $line) {
    $parts = array_map('trim', explode(',', $line));
    if (count($parts) < 2)
        continue;

    $imageUrl = $parts[0];
    $keywords = array_map(function ($word) {
        return mb_strtolower(trim($word), 'UTF-8');
    }, array_slice($parts, 1));

    // 检索
    if (array_intersect(explode(' ', $pic_search), $keywords)) {
        $results[] = $imageUrl;
        $results_url[] = $siteURL . '/' . $dir . $imageUrl;
    }
}

// 响应
if (!empty($results)) {

    if ($mode == 'redirect') {
        $randomIndex = $results[array_rand($results)];
        $randomImageUrl = $siteURL . '/' . $dir . $results[$randomIndex];
        header('Location: ' . $randomImageUrl);
        exit;
    } elseif (empty($mode)) {
        header('Content-Type: image/jpeg');
        $randomIndex = $results[array_rand($results)];
        $push_path = $dir . $randomIndex;
        header('Content-Length: ' . filesize($push_path));
        readfile($push_path);
    } elseif ($mode == 'json') {
        header('Content-Type: application/json');
        echo json_encode(['code' => 200, 'image_urls' => $results_url, 'mode' => 'json']);
        exit;
    } else {
        header('Content-Type: application/json');
        http_response_code(400);
        echo "Unsupported mode.";
        exit;
    }
} else {
    header('Content-Type: application/json');
    http_response_code(404);
    echo "No results found for the search term.";
    exit;
}