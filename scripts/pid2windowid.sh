#!/bin/sh
# 2020年 03月 29日 星期日 13:53:50 CST
# 将pid转为window——id
# 参考：https://blog.csdn.net/superkeep/article/details/88948634
findpid=$1
known_windows=$(xwininfo -root -children|sed -e 's/^ *//' | grep -E "^0x" | awk '{ print $1 }')
for id in ${known_windows}
do
	test_pid=$(xprop -id $id _NET_WM_PID)
	if [ $? -eq 0 ];then
		test_pid=$(xprop -id $id _NET_WM_PID|cut -d'=' -f2|tr -d ' ')
		if [[ ${test_pid} == ${findpid} ]];then
			echo "${id}"
			exit 0
		fi
	fi
done
echo "0"
exit 1

