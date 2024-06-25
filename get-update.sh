#!/bin/bash
# 配置部分
dir="xxx" #这里填写网站 img 目录在你服务器中的绝对路径，后面不加 “/” example: /www/wwwroot/sites/example.org/img
update_url="https://static.mmeiblog.cn/files/rainyun_pic.zip" #更新源，不要乱动
tmp_zip_file="$dir/img.zip" #缓存文件路径




echo -e "\e[32m正在安装必要的工具\033[0m"
if command -v apt-get &> /dev/null; then
    apt-get update && apt-get install -y wget unzip curl 
elif command -v yum &> /dev/null; then
    yum install -y wget jq zstd
else
    echo -e "\e[31m无法自动安装必要的工具 unzip curl  ，请自行安装后重新运行此脚本。\033[0m"
    exit 1
fi

rm -rf "$dir"/*
curl -sSL "$update_url" -o "$tmp_zip_file"
unzip -q "$tmp_zip_file" -d "$dir"
rm -f "$tmp_zip_file"

echo "更新成功"