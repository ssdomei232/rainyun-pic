<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录 - 图片管理页面</title>
    <link href="https://cdn.jsdmirror.com/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo $favicon; ?>">
    <style>
        body { 
            background-image: url('https://api.mmeiblog.cn/?api=pic&et=pc&time=true'); 
            background-repeat: no-repeat; 
            background-position: center center; 
            background-size: cover; 
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-form {
            width: 100%;
            max-width: 360px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .login-form h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-form input {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-form">
    <h2>登录</h2>
    <form action="<?php echo $siteURL; ?>/?pages=admin" method="post">
        <div class="mb-3">
            <label for="pwd" class="form-label">密码</label>
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="请输入密码" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">登录</button>
    </form>
</div>

<script src="https://cdn.jsdmirror.com/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>