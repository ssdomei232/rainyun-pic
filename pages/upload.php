<?php
header('Content-Type: application/json');

// 上传目录
$uploadDir = 'assets/upload/';


if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
    die('Upload directory does not exist or is not writable.');
}

// 检查是否有文件上传
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    // 检查文件是否为图片
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileType, $allowedTypes)) {
        die('Only JPG, JPEG, PNG & GIF files are allowed.');
    }

    // 移动文件
    $newFileName = uniqid('', true) . '.' . $fileType; // 生成唯一文件名
    $filePath = $uploadDir . $newFileName;
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // 记录文件名
        $logFilePath = 'pages/upload.txt';
        file_put_contents($logFilePath, $newFileName . PHP_EOL, FILE_APPEND);

        // 响应
        echo json_encode(['success' => true, 'message' => 'File uploaded successfully.', 'filename' => $newFileName]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to move the uploaded file.']);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No image file was uploaded.']);
}
?>