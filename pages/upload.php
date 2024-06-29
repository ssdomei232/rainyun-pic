<?php
header('Content-Type: application/json');

// 上传目录
$uploadDir = 'assets/upload/';

if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
    die('Upload directory does not exist or is not writable.');
}

// 检查是否有文件上传
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) { 

    // 确保files数组不为空且是多文件上传
    if (!isset($_FILES['images']['name'][0])) {
        die('No image files were uploaded.');
    }

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $uploadedFiles = [];
    $failedFiles = [];
    $logFilePath = 'pages/upload.txt';

    // 遍历所有上传的文件
    foreach ($_FILES['images']['name'] as $index => $fileName) {
        $tempName = $_FILES['images']['tmp_name'][$index];
        $fileSize = $_FILES['images']['size'][$index];
        $fileError = $_FILES['images']['error'][$index];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // 检查文件
        if (in_array($fileType, $allowedTypes) && $fileError === UPLOAD_ERR_OK) {
            // 生成唯一文件名并移动文件
            $newFileName = uniqid('', true) . '.' . $fileType;
            $filePath = $uploadDir . $newFileName;

            if (move_uploaded_file($tempName, $filePath)) {
                $uploadedFiles[] = $newFileName;
                // 记录文件名
                file_put_contents($logFilePath, $newFileName . PHP_EOL, FILE_APPEND);
            } else {
                $failedFiles[] = $fileName;
            }
        } else {
            $failedFiles[] = $fileName;
        }
    }

    // 响应
    if (!empty($uploadedFiles)) {
        $message = count($uploadedFiles) . " 文件上传成功";
        if (!empty($failedFiles)) {
            $message .= " However, " . count($failedFiles) . " 文件上传失败";
        }
        $response = [
            'success' => true,
            'message' => $message,
            'uploaded' => $uploadedFiles,
            'failed' => $failedFiles,
        ];
    } elseif (!empty($failedFiles)) {
        $response = [
            'success' => false,
            'message' => "所有文件上传失败",
            'failed' => $failedFiles,
        ];
    } else {
        $response = [
            'success' => false,
            'message' => "未上传有效文件",
        ];
    }

    echo json_encode($response);
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '请求无效或未上传图像文件']);
}
?>