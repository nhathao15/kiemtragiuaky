<!DOCTYPE html>
<html>
<head>
    <title>Trang Thông tin Nhân viên</title>
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
    <h1 style='text-align: center; color: red;'>THÔNG TIN DANH SÁCH NHÂN VIÊN</h1>
    <?php
        require "connect.php";
        if($result->num_rows > 0){
            echo "<table style='display: flex;justify-content: center;'>
                <tr style='color: red;'>
                    <th>Mã nhân viên</th>
                    <th>Tên nhân viên</th>
                    <th>Giới tính</th>
                    <th>Nơi sinh</th>
                    <th>Tên phòng</th>
                    <th>Lương</th>
                </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr'>
                        <td>".$row["Manv"]."</td>
                        <td>".$row["Tennv"]."</td>
                        <td >";

                if ($row["Phai"] == "NAM") {
                    echo "<img src='image/nam.jpg' alt='nam' style='height: 28px;width: 56px;'>";
                } elseif ($row["Phai"] == "NU") {
                    echo "<img src='image/nu.jpg' alt='nu' style='height: 28px;width: 56px;'>";
                }
                echo "  
                        </td>
                        <td>".$row["Noisinh"]."</td>
                        <td>".$row["Maphong"]."</td>
                        <td>".$row["Luong"]."</td>
                    </tr>";
            }

            echo "</table>";
            
            // Hiển thị phân trang
            echo "<div style='text-align: center;'>";
            if ($total_pages > 1) {
                echo "<ul class='pagination'>";
                if ($current_page > 1) {
                    echo "<li><a href='?page=".($current_page - 1)."'>Trước</a></li>";
                }
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<li".($page == $current_page ? " class='active'" : "")."><a href='?page=".$page."'>".$page."</a></li>";
                }
                if ($current_page < $total_pages) {
                    echo "<li><a href='?page=".($current_page + 1)."'>Sau</a></li>";
                }
                echo "</ul>";
            }
            echo "</div>";
        }else{
            echo "Không có nhân viên.";
        }
    ?>
</body>
</html>