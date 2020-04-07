<?php
    session_start();
    $pwd = dirname(__FILE__);
    if (isset($_SESSION['pid'])) {
//        $shell = $pwd . "/scripts/xuexi_stop.sh " . $_SESSION['name'] . " " . $_SESSION['window'] . " " . $_SESSION['pid'] . " >> temp/log.txt &";
        $name = $_SESSION['name'];
        $pid = $_SESSION['pid'];
        $windowid = $_SESSION['window'];
        $shell = "${pwd}/scripts/xuexi_stop.sh ${name} ${windowid} ${pid} test >> temp/log.txt";
        exec($shell, $result);
        echo "关闭脚本中";
    }
    session_destroy();
	header('Refresh:3; url="login.php"');
    echo "退出成功，三秒后返回登入页面";
?>
