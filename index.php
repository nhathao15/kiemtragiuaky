<!DOCTYPE html>
<html>
<head>
    <title>NHÂN VIÊN</title>
    <style>
        ul.pagination {
            display: inline-block;
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }

        ul.pagination li {
            display: inline;
        }

        ul.pagination li a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin-left: -1px;
        }

        ul.pagination li a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        ul.pagination li a:hover:not(.active) {
            background-color: #ddd;
        }
        table {
        border-collapse: collapse;
        width: 100%;
        }

        th, td {
        border: 1px solid black;
        padding: 8px;
        }

        th {
        background-color: red;
        color: white;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Trang chủ</a>
        <a href="login.php">Đăng nhập</a>
    </div>
    <h1 style='text-align: center; color: red;'>THÔNG TIN DANH SÁCH NHÂN VIÊN</h1>
    
    <?php
        require "connect.php";
        session_start();
        if(!isset($_SESSION['username'])){
            header('location:login.php');
          }
        // // Trang hiện tại
        // $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        // // Số bản ghi trên mỗi trang
        // $records_per_page = 5;

        // // Truy vấn để lấy tổng số nhân viên
        // $total_records_query = "SELECT COUNT(*) AS total FROM nhanvien";
        // $total_records_result = $conn->query($total_records_query);
        // $total_records_row = $total_records_result->fetch_assoc();
        // $total_records = $total_records_row['total'];

        // // Tổng số trang
        // $total_pages = ceil($total_records / $records_per_page);

        // // Chỉ mục bắt đầu và kết thúc của bản ghi trên trang hiện tại
        // $start_index = ($current_page - 1) * $records_per_page;

        // $sql = "SELECT nv.*, p.Ten_Phong FROM nhanvien nv INNER JOIN phongban p ON nv.MaPhong = p.Ma_Phong LIMIT $start_index, $records_per_page";
        // $result = $conn->query($sql);

        if($_SESSION["role"] == "ADMIN"){
            echo "
            <button class='create'><a href='add.php'>THÊM NHÂN VIÊN</a></button>";
        }

        if($result->num_rows > 0){
            echo "<table style='display: flex;justify-content: center;'>
                <tr style='color: red;'>
                    <th>Mã nhân viên</th>
                    <th>Tên nhân viên</th>
                    <th>Giới tính</th>
                    <th>Nơi sinh</th>
                    <th>Tên phòng</th>
                    <th>Lương</th>";
                
            
            if($_SESSION["Role"] == "ADMIN"){
                echo "<th></th>";
            }
            echo "</tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr'>
                        <td>".$row["Manv"]."</td>
                        <td>".$row["Tennv"]."</td>
                        <td>";
                    if ($row["Phai"] == "NAM") {
                        echo "<img src='image/nam.jpg' alt='nam' style='height: 28px;width: 56px;'>";
                        } elseif ($row["Phai"] == "NU") {
                         echo "<img src='image/nu.jpg' alt='nu' style='height: 28px;width: 56px;'>";
                        }
                echo "  
                        </td>
                        <td>".$row["Noisinh"]."</td>
                        <td>".$row["Maphong"]."</td>
                        <td>".$row["Luong"]."</td>";
                if($_SESSION["Role"] == "ADMIN"){
                    echo "
                        <td><a href='edit.php?id=".$row['Manv']."'><img src='image/edit.jpg' style='width: 28px;width: 56px;'/></a></td>
                        <td><a href='delete.php?id=".$row['Manv']."'><img src='image/delete.jpg' style='width: 28px;width: 56px;'/></a></td>";
                }
                echo "</tr>";
            }

            echo "</table>";
            
            // Hiển thị phân trang
            echo "<div style='text-align: center;'>";
            if ($total_pages > 1) {
                echo "<ul class='pagination'>";
                if ($current_page > 1) {
                    echo "<li><a href='?page=".($current_page - 1)."'>Previous</a></li>";
                }
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<li".($page == $current_page ? " class='active'" : "")."><a href='?page=".$page."'>".$page."</a></li>";
                }
                if ($current_page < $total_pages) {
                    echo "<li><a href='?page=".($current_page + 1)."'>Next</a></li>";
                }
                echo "</ul>";
            }
            echo "</div>";
        }else{
            echo "Không có nhân viên.";
        }
        $conn->close();
    ?>
</body>
</html>
