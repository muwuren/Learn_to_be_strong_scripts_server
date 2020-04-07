#!/bin/sh
# 2020年 03月 29日 星期日 15:15:14 CST
# 2020年 04月 05日 星期日 19:26:24 CST
# 2020年 04月 07日 星期二 13:24:36 CST
# 输入: 窗口id
# 输出: 窗口id.png

windowid=$1
export DISPLAY=":9"
location=$(dirname $0)
png_file="${location}/../temp/${windowid}.png"
xdotool click -window ${windowid}  --repeat=2 5
import -window ${windowid} ${png_file}
