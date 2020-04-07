<html>
<head>
<meta charset="utf-8">
<title>user_home</title>
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['name'])) {
        echo "<h1>欢迎" . $_SESSION['name'] . "</h1>";
        echo "<p>刷新页面可得到新图像，同时页面会向下移动</p>";
        echo "<p><a href='logout.php'>退出登录</a></p>";

        $pwd = dirname(__FILE__);
        if (isset($_SESSION['pid'])) {
            $windowid=$_SESSION['window'];
            $shell = "${pwd}/scripts/get_picture.sh ${windowid} >> temp/log.txt &";
            exec($shell , $result);
        } else {
            $shell = $pwd . "/scripts/xuexi_start.sh " . $_SESSION['name'] . " > /dev/null &";
            exec($shell, $result);
			sleep(7);
			$file_path = $pwd . "/temp/" . $_SESSION['name'] . "_pid.txt";
			if(file_exists($file_path)){
				$myfile = fopen($file_path, "r");
				$result = fgets($myfile);
			}
            $_SESSION['pid'] = $result;
			$file_path = $pwd . "/temp/" . $_SESSION['name'] . "_window.txt";
			if(file_exists($file_path)){
				$myfile = fopen($file_path, "r");
				$result = fgets($myfile);
			}
            $_SESSION['window'] = $result;
        }
   echo "<img src='/temp/" . $_SESSION['window'] . ".png' alt='NULL'/><br>";

    } else {
        echo "<p><font size='7' color='red'>请先登录</font></p>";
        header("Refresh:3;url=login.php");
    }
?>

</body>
</html>
