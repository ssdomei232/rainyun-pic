<?php
$pwd = isset($_GET['pwd']) ? sanitizeInput($_GET['pwd']) : '';
if ($pwd != $admin_password){
    exit;
}
function readImages() {
    $images = [];
    if (file_exists('pages/upload.txt')) {
        $images = file('pages/upload.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    return $images;
}

function saveImageWithTags($imageName, $tags) {
    $content = $imageName . ',' . $tags . "\n";
    file_put_contents('pages/search.txt', $content, FILE_APPEND);
    deleteImageFromUploadList($imageName);
}

function deleteImage($imageName) {
    unlink("assets/upload/" . $imageName);
    deleteImageFromUploadList($imageName);
}

function deleteImageFromUploadList($imageName) {
    $images = readImages();
    $newImages = array_diff($images, [$imageName]);
    file_put_contents('pages/upload.txt', implode("\n", $newImages));
}

// 处理表单提交
if (isset($_POST['submit'])) {
    $imageName = $_POST['image_name'];
    $tags = $_POST['tags'];
    
    // 新的图片路径
    $newImagePath = 'img/' . $imageName;
    
    // 将图片从原始位置移动到新目录
    if (rename('assets/upload/' . $imageName, $newImagePath)) {
        saveImageWithTags($imageName, $tags);
    } else {
        echo "Failed to move the image.";
    }
} elseif (isset($_POST['delete'])) {
    $imageName = $_POST['image_name'];
    deleteImage($imageName);
}

$images = readImages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理图片</title>
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">管理图片</h1>
        <a href="<?php echo $siteURL?>" class="btn btn-primary mb-3">首页</a>
        <hr>

        <?php foreach ($images as $image): ?>
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="assets/upload/<?= $image ?>" class="card-img img-fluid" alt="Uploaded Image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <form method="post" class="form-inline">
                                <input type="hidden" name="image_name" value="<?= $image ?>">
                                <label for="tags_<?= $image ?>" class="mr-2">Tags:</label>
                                <input type="text" name="tags" id="tags_<?= $image ?>" class="form-control mr-2">
                                <button type="submit" name="submit" class="btn btn-primary mr-1">提交</button>
                                <button type="submit" name="delete" class="btn btn-danger">删除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>