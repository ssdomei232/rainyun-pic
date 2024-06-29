<?php

// 处理参数
if (empty($pic_search)) {
    $list_file = $siteURL . $listurl;
} else {
    $list_file = $siteURL . "/?pages=search&s=" . $pic_search;
}

// 统计梗图数量
$files = scandir($dir);
$count = 0;
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        if (is_file($dir . DIRECTORY_SEPARATOR . $file)) {
            $count++;
        }
    }
}
?>


<!DOCTYPE html>

<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $siteName; ?></title>
    <meta name="description" content="<?php echo $siteDescription; ?>">
    <meta name="keyword" content="<?php echo $siteKeywords; ?>">
    <link rel="stylesheet" href="https://cdn.staticfile.org/mdui/1.0.2/css/mdui.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="assets/min.css" />
    <link rel="shortcut icon" href="<?php echo $favicon; ?>">
</head>


<body
    class="mdui-appbar-with-toolbar  mdui-theme-primary-<?php echo $themeColor ?> mdui-theme-accent-<?php echo $accentColor; ?>">
    <div class="mdui-appbar mdui-appbar-fixed mdui-appbar-scroll-hide">
        <div class="mdui-toolbar mdui-color-<?php echo $themeColor ?>">
            <a href="<?php echo $siteURL; ?>" class="mdui-typo-headline"><?php echo $headline; ?></a>
            <div class="mdui-toolbar-spacer"></div>
            <a href="javascript:;" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white search-trigger"
                mdui-tooltip="{content: '搜索梗图'}"><i class="mdui-icon material-icons">search</i></a>
            <a href="https://pic.mmeiblog.cn/rainyun/" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white upload-trigger"
                mdui-tooltip="{content: '上传图片'}"><i class="mdui-icon material-icons">cloud_upload</i></a>
        </div>
        <!-- 搜索 -->
        <div class="mdui-textfield search-box mdui-hidden" id="search-box">
            <form onsubmit="submitSearch(event)">
                <input class="mdui-textfield-input" type="text" placeholder="搜索梗图" id="search-keyword" />
                <button class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" type="submit"
                    mdui-tooltip="{content: '搜索'}">
                    <i class="mdui-icon material-icons">search</i>
                </button>
            </form>
        </div>
    </div>
    <div class="mdui-container">
        <button style="z-index: 1" id="back-to-top" onclick="back_to_top()"
            class="mdui-fab-hide mdui-fab mdui-color-theme-accent mdui-fab-fixed">
            <i class="mdui-icon material-icons">keyboard_arrow_up</i>
        </button>
        <div id="pic" class="mdui-col-md-6 mdui-col-offset-md-3 mdui-col-sm-10 mdui-col-offset-sm-1"></div>

    </div>



    <script src="https://cdn.staticfile.org/mdui/1.0.2/js/mdui.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script>var messageOpts = { "progressBar": true, "showDuration": "1000", "hideDuration": "1000", "timeOut": "6000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", "allowHtml": true, }; toastr.options = messageOpts;</script>

    <script>
        function back_to_top() {
            $("html,body").animate({
                scrollTop: 0
            }, 250);
        }

        //检测到底
        $(window).on('scroll', function () {
            var scrolled = $(window).scrollTop();
            if (scrolled > 100) {
                $("#back-to-top").removeClass("mdui-fab-hide")
            } else {
                $("#back-to-top").addClass("mdui-fab-hide")
            }

            if (document.documentElement.scrollHeight - document.documentElement.scrollTop < 1200) {
                // loadPic();
            }
        });

        function loadPic() {
            var out;
            $.ajax({
                type: 'get',
                url: "<?php echo $list_file; ?>",
                dataType: 'text',
                async: false,
                success: function (data) {
                    arr = JSON.parse(data);
                    var out = "";
                    var i;
                    for (i = 0; i < arr.length; i++) {
                        out += '<div class="mdui-card mdui-center card"><div class="mdui-card-media"><img class="lazy" src="assets/loading.png" data-original="img/<?php echo $picurl; ?>' + arr[i] + '"/></div></div>';
                    }
                    document.getElementById("pic").innerHTML = out;
                }
            });
        }

        loadPic();
        $(function () {
            $("img.lazy").lazyload();
        });
    </script>
    <script>
        const searchTrigger = document.querySelector('.search-trigger');
        const searchBox = document.getElementById('search-box');
        const searchKeywordInput = document.getElementById('search-keyword');

        // 搜索框
        function toggleSearchBoxVisibility() {
            if (searchBox) {
                searchBox.classList.toggle('mdui-hidden');
            } else {
                console.error('Search box not found');
            }
        }
        function submitSearch(event) {
            event.preventDefault();
            if (!searchKeywordInput) {
                console.error('Search keyword input not found');
                return;
            }

            const keyword = searchKeywordInput.value;
            if (!keyword) {
                console.warn('No search keyword provided');
                return;
            }

            try {
                const newUrl = `${window.location.origin}${window.location.pathname}?s=${encodeURIComponent(keyword)}`;
                window.location.href = newUrl;
            } catch (error) {
                console.error('Error constructing new URL:', error);
            }
        }
        searchTrigger.addEventListener('click', toggleSearchBoxVisibility);
        searchBox.addEventListener('submit', submitSearch);
    </script>
    <p>
        <center>目前共有 <?php echo $count; ?>张梗图</center>
    </p>

</body>

</html>