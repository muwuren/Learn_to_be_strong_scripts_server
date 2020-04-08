#!/bin/sh
# 2020年 04月 08日 星期三 12:04:33 CST
# 输入：无
# 输出： ../temp/current_users.log
location=$(dirname $0)
users=$(ls ${location}/../temp/ | grep '.txt' | grep -v log.txt| cut -d '_' -f 1 | uniq)
echo "$users";

if [[ $(echo  "$users" | wc -w) == 0 ]]
then
	users="无人在线";
fi
echo "$users";

echo ${users} > ${location}/../temp/current_users.log

