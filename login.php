<?php
$servername = "localhost";
$username = "httpd";
$password = "172440136104";
$dbname = "shuake";
$table_name = "study_user_info";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("数据库连接失败");
} else {
//    echo "数据库连接成功" . "<br>";
}
session_start();
if (isset($_POST["login"])) {
	$sql = 'prepare stmt from "select username,passwd from ' . $table_name . ' where username=?";';
	mysqli_query($conn, $sql);
	$sql = 'set @a="' . $_POST["username"] . "\";";
	mysqli_query($conn, $sql);
	$sql = 'execute stmt using @a;';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo "用户不存在 <br>";
   		echo '<a href="JavaScript:history.back()">返回登入</a>';
    } else {
        $row = mysqli_fetch_array($result);
    	if (md5($_POST["passwd"]) == $row["passwd"]) {
            $_SESSION["name"] = $_POST["username"];
            echo '登入成功，<a href="user_home.php">进入个人中心(请等待10秒)</a>';
    	} else {
    		echo "password error";
    		echo '密码错误！ <a href="JavaScript:history.back()">返回登入</a>';
    	}
    }
 } else if (isset($_POST["register"])) {
 	if ($_POST["username"] == "" || $_POST["passwd"] == "") {
		echo "用户名和密码不能为空";
	}
	else {
		$sql = 'prepare stmt_rg from "insert into ' . $table_name . ' set username=?, passwd=?";';
		mysqli_query($conn, $sql);
		$sql = 'set @a="' . $_POST["username"] . "\";";
		mysqli_query($conn, $sql);
		$passwd = md5($_POST["passwd"]);
		$sql = 'set @b="' . $passwd . '";';
		mysqli_query($conn, $sql);
		$sql = 'execute stmt_rg using @a, @b;';
    	$result = mysqli_query($conn, $sql);
    	if ($result == false) {
			print_r($result);
    	    echo "<p>注册失败，用户名已存在,请联系邮箱：muwutong@qq.com</p><br>";
    	    echo '<br><a href="JavaScript:history.back()">返回</a>';
    	} else {
    	    echo "<p>注册成功</p><br>";
    	    echo "用户名：" . $_POST["username"];
    	    echo '<br><a href="JavaScript:history.back()">返回</a>';
    	}
	}
 } else {
//	echo '
//	    <form action="#" method="post">
//			<p>帐号：<input type="text" name="username"/></p>
//			<p>密码：<input type="password" name="passwd"/></p>
//			<p><input type="submit" name="login" value="登入"/>
//			<input type="submit" name="register" value="注册"/> </p>
//		</form> ';
     include("index.html");

 }
       mysqli_close($conn);
?>
