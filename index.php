<?php
include('config.php');
include('number.php');

// 是否使用第三方图片存储
if ($turl === true) {
    $picurl = $imgurl; 
    $listurl = $tlisturl;
} else {
    $picurl = $siteURL.DIRECTORY_SEPARATOR.$dir;
};

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

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title><?php echo $siteName; ?></title>
  <meta name="description" content="<?php echo $siteDescription; ?>">
  <meta name="keyword" content="<?php echo $siteKeywords; ?>">
  <link rel="stylesheet" href="https://cdn.staticfile.org/mdui/1.0.2/css/mdui.min.css" />
  <link rel="stylesheet" href="assets/min.css" />
  <link rel="shortcut icon" href="<?php echo $favicon; ?>">
</head>


<body class="mdui-appbar-with-toolbar  mdui-theme-primary-<?php echo $themeColor ?> mdui-theme-accent-<?php echo $accentColor; ?>">
  <div class="mdui-appbar mdui-appbar-fixed mdui-appbar-scroll-hide">
    <div class="mdui-toolbar mdui-color-<?php echo $themeColor ?>">
      <a href="<?php echo $siteURL; ?>" class="mdui-typo-headline"><?php echo $headline; ?></a>
      <div class="mdui-toolbar-spacer"></div>
      <a href="https://api.mmeiblog.cn/?api=upload&g=rainyun_pic" target="_blank" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content: '提交梗图'}"><i class="mdui-icon material-icons">edit</i></a>
    </div>
  </div>
  <div class="mdui-container">
    <button style="z-index: 1" id="back-to-top" onclick="back_to_top()" class="mdui-fab-hide mdui-fab mdui-color-theme-accent mdui-fab-fixed">
        <i class="mdui-icon material-icons">keyboard_arrow_up</i>
    </button>
    <div id="pic" class="mdui-col-md-6 mdui-col-offset-md-3 mdui-col-sm-10 mdui-col-offset-sm-1"></div>
	
  </div>



  <script src="https://cdn.staticfile.org/mdui/1.0.2/js/mdui.min.js"></script>
  <script src="https://cdn.staticfile.org/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>

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
    
    function loadPic(){
		var out;
		$.ajax({
			type: 'get',
			url: "<?php echo $listurl; ?>",
			dataType: 'text',
			async: false,
			success: function(data){
				arr = JSON.parse(data);
				var out = "";
				var i;
				for(i=0;i<arr.length;i++){
					out += '<div class="mdui-card mdui-center card"><div class="mdui-card-media"><img class="lazy" src="assets/loading.png" data-original="<?php echo $picurl; ?>'+arr[i]+'"/></div></div>';
				}
				document.getElementById("pic").innerHTML = out;
			}
		});
    }
	
	loadPic();
	$(function() {
      $("img.lazy").lazyload();
    });

</script>
<p><center>目前共有 <?php echo $count; ?>张梗图</center></p>

</body>
</html>