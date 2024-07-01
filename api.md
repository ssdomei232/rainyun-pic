### 随机梗图:
#### 直出模式:      
地址: `/?pages=api`        
#### json模式:      
地址: `/?pages=api&mode=json`      
响应示例:
```json
{
    "code": 200,
    "image_url": "https://pic.mmeiblog.cn/img/36.jpg",
    "mode": "json"
}
```
#### 重定向模式:       
地址: `/?pages=api&mode=redirect`      


### 搜索梗图        
(直出模式和重定向模式会随机选择一个结果输出)        
#### 直出模式:     
地址:  `/?pages=api-search&s=<搜索内容>`        
#### json模式:
地址:  `/?pages=api-search&mode=json&s=<搜索内容>`      
请求示例:`https://pic.mmeiblog.cn/?pages=api-search&mode=json&s=骚话`       
响应示例:       
```json
{
    "code": 200,
    "image_urls": [
        "https://pic.mmeiblog.cn/img/fcafb3c4c9008d7df9b36bc8ba02a481.jpg",
        "https://pic.mmeiblog.cn/img/e9e51b700a440b76c70d668e6c9fc058.jpg",
        "https://pic.mmeiblog.cn/img/e6b6c673637bdcd9ba560668bb7bff30.jpg",
        "https://pic.mmeiblog.cn/img/DE30D9A9AEBADFC36045098231EB9570.jpg",
        "https://pic.mmeiblog.cn/img/dde11561301d218efd91dcc47ad48d14.png",
        "https://pic.mmeiblog.cn/img/db03d8bd428345f04b00a9d01ff6c55b.jpg",
        "https://pic.mmeiblog.cn/img/d799e0b82c6571ee6b113dd778fd152c.jpg",
        "https://pic.mmeiblog.cn/img/CFAFDC8640262B2B8A564BA88F42B520.jpg",
        "https://pic.mmeiblog.cn/img/c57a11cde2c30729a3ddb2a567ab5090.jpg",
        "https://pic.mmeiblog.cn/img/c0492ecf7f435847641b9aace27e3f9e.png",
        "https://pic.mmeiblog.cn/img/bdbda100407a6ec3a48570cda13397ac.jpg",
        "https://pic.mmeiblog.cn/img/ae5ae99ef21fce76832e083883498a22.jpg",
        "https://pic.mmeiblog.cn/img/a9ee98c4c7a6f5e1747650a2d2556789.png",
        "https://pic.mmeiblog.cn/img/a51a611e237c81dc6700299bbd2a5769.jpg",
        "https://pic.mmeiblog.cn/img/A3319380745D97E94A8516A56379CC3D.jpg",
        "https://pic.mmeiblog.cn/img/9c858b95cd962e9469353c0fc68fde4d.jpg",
        "https://pic.mmeiblog.cn/img/9723090ebbb7346525ee80a16610d117.jpg",
        "https://pic.mmeiblog.cn/img/944600d4e381b109061e8e8f92e961a8.jpg",
        "https://pic.mmeiblog.cn/img/6e40d73073d6e00af0098dc41b411929.png",
        "https://pic.mmeiblog.cn/img/48d0a0e7f963eba5cf928ad9728c79cb.jpg",
        "https://pic.mmeiblog.cn/img/44FED2F514CC4CE11B536AA1862A185B.jpg",
        "https://pic.mmeiblog.cn/img/3ba8d96cde21222be9c1ba44fbe1a2b5.jpg",
        "https://pic.mmeiblog.cn/img/3632b55ece33a5c4f9d0dd6e29c7dc35.jpg",
        "https://pic.mmeiblog.cn/img/1e9cbdce74a2e2dea5e5db7638dc295b.png",
        "https://pic.mmeiblog.cn/img/0ffda39aaacd8b13485dfad1d60883ad.jpg",
        "https://pic.mmeiblog.cn/img/0c91a0b1343d0425eee60a69a45d6056.jpg",
        "https://pic.mmeiblog.cn/img/041e83d846873d9bbdfafe8c55876f13.jpg",
        "https://pic.mmeiblog.cn/img/00e246a588e6d06af34caa8a67f6cca5.jpg",
        "https://pic.mmeiblog.cn/img/9F82883F31CBFB468B519FF4E6DDA9B1.jpg",
        "https://pic.mmeiblog.cn/img/237BE49E8954BD01A8B45F58C022212A.jpg",
        "https://pic.mmeiblog.cn/img/475517D3BD5851E66675786934864E51.jpg",
        "https://pic.mmeiblog.cn/img/Image_1716038489737_edit_125021465108526.png",
        "https://pic.mmeiblog.cn/img/Image_1718748777228_edit_634829546082298.png"
    ],
    "mode": "json"
}
```
#### 重定向模式:     
地址: `/?pages=api-search&mode=redirect&s=<搜索内容>`      