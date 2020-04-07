#!/bin/sh
# 2020年 03月 29日 星期日 14:47:03 CST
# 2020年 04月 05日 星期日 19:30:02 CST
# 2020年 04月 07日 星期二 13:26:48 CST
# 参数： 用户名
# 输出： ../temp/username_pid.txt ../temp/username_window.pid
user=$1
display=":9"

# 判断Xvfb程序是否已经打开
PIDS=$(ps -ef|grep Xvfb|grep -v grep|awk '{print $2}')
if [ -z ${PIDS} ];then
	Xvfb -ac -screen scrn 1024x768x8 ${display} &
fi

# 运行Fuck程序,同时输出Fuck程序pid
# sleep是防止程序没有完全打开时，去读取windowid，造成windowid读取失败
export DISPLAY=${display}
location=$(dirname $0)
program="${location}/Fuck/Fuck学习强国"
${program} --user=${user} &
subpid=$!
echo -n ${subpid} > ${location}/../temp/${user}_pid.txt
sleep 5s

# 得到Fuck进程窗口id,同时输出windowid
window_id=$(${location}/pid2windowid.sh ${subpid} | grep -v '^$' | tr -d ' ')
echo -n ${window_id} > ${location}/../temp/${user}_window.txt

# 模拟鼠标滑轮向下移动
# xdotool click -window ${window_id}  --repeat=2 5

# 得到Fuck进程窗口图片
get_pic_program="${location}/get_picture.sh"
${get_pic_program} ${window_id}

# 运行时间超过60m 后，自动退出后台进程，同时复制超时图片
# 每5min判断一次，Fuck程序是否存活
runtime=0
program_live=$(ps -p ${subpid} | wc -l)
while [[ ${runtime} -le 60 && ${program_live} -gt 1 ]]
do
	sleep 5m
	runtime=$(( ${runtime} + 5 ))
done

# 超时后，fuck程序依旧存活，此时自动调用退出程序，避免用户不退出登录而fuck程序的运行
if [ ${program_live} -gt 1 ]
then
	${location}/xuexi_stop.sh ${user} ${window_id} ${subpid}
	# 需要等待上一条命令执行完成
	cp ${location}/../temp/timeout.png ${location}/../temp/${window_id}.png
fi

exit 0
