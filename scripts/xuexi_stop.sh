#!/bin/sh
# 2020年 03月 29日 星期日 15:25:46 CST
# 输入：用户名， 窗口id， pid
# 作用：kill fuck程序，删除临时文件
user=$1
shift 1
windowid=$1
shift 1
pid=$1
itest=$2
kill ${pid}
location=$(dirname $0)
rm -f "${location}/../temp/${windowid}.png"
rm -f "${location}/../temp/${user}_pid.txt"
rm -f "${location}/../temp/${user}_window.txt"
# 调试使用，php好像不能给shell传多个参数？
# 已经解决， 原因：php读取windowid时，将换行符号读到，导致参数不正确
# 纠正：echo -n
# echo "username: ${user}" >> "${location}/../temp/log.txt"
# echo "pid: ${pid}" >> "${location}/../temp/log.txt"
# echo "windowid: ${windowid}" >> "${location}/../temp/log.txt"
# echo "itest: ${itest}" >> "${location}/../temp/log.txt"
# 
