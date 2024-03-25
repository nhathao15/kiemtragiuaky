<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <?php
        require "connect.php";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }
        
        // Xử lý đăng nhập
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $UserName1 = $_POST["UserName"];
            $PassWord1 = $_POST["PassWord"];
        
            // Truy vấn kiểm tra tài khoản và mật khẩu trong cơ sở dữ liệu
            $sql = "SELECT ID, UserName, PassWord, Role FROM user WHERE UserName = '$UserName1'";
            $result = $conn->query($sql);
        
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if ($PassWord1 == $row["PassWord"]) {
                    // Đăng nhập thành công
                    session_start();
                    $_SESSION["ID"] = $row["ID"];
                    $_SESSION["UserName"] = $row["UserName"];
                    $_SESSION["Role"] = $row["Role"];
        
                    // Chuyển hướng đến trang sau khi đăng nhập thành công
                    header("Location: index.php");
                    exit();
                } else {
                    $error_message = "Sai tài khoản hoặc mật khẩu.";
                }
            } else {
                $error_message = "Sai tài khoản hoặc mật khẩu.";
            }
        }

        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        }
        $conn->close();
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="UserName">Tài khoản:</label>
            <input type="text" name="UserName" required>
        </div>
        <div>
            <label for="PassWord">Mật khẩu:</label>
            <input type="PassWord" name="PassWord" required>
        </div>
        <div>
            <input type="submit" value="Đăng nhập">
        </div>
    </form>
</body>
</html>

