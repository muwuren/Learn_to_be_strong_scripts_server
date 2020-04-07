# Learn_to_be_strong_scripts_server

[TOC]

## 简介

学习强国服务器脚本部署，支持多人多开。

实际本身属于套壳软件，使用脚本拼凑起来,简单使用

使用需要先注册，再使用App扫码登录

使用[学习强国](https://github.com/fuck-xuexiqiangguo/Fuck-XueXiQiangGuo)脚本

## 安装

### centos

- `sudo yum install -y  xorg-x11-utils xorg-x11-server-Xvfb ImageMagick  mariadb php-mysql httpd`

- `sudo systemctl start httpd.service`

- 将[学习强国](https://github.com/fuck-xuexiqiangguo/Fuck-XueXiQiangGuo)克隆至本项目`scripts`/下，并重命名为`Fcuk`，同时下载脚本所需依赖

- 将`login.php`$servername, $username,$password, $dbname,$table_name修改为自己的数据库

- 数据库表中，需要`username`,与`passwd`两项 

- 在网页根目录处，需要新建`temp/`文件夹，并且保证`apache`对该目录有写权限，

  ```bash
  # mkdir temp
  # setfacl -m u:apache:rwz temp/
  ```

  

## 截图

![image-20200330115915709](http://47.94.151.63/cloud_note/pictures_bed/image-20200330115915709.png)

![image-20200401153043781](http://47.94.151.63/cloud_note/pictures_bed/image-20200401153043781.png)

## Demo
[这里](http://47.94.151.63/)是我的一个Demo

## Issues
  解决多次登录，导致后台程序多次运行
  	方案：
		1. 使用cookie
		2. 对Fuck学习强国运行使用文件锁
