<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ql_nhansu";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check connection
    if($conn->connect_error){
        die("Kết nối thất bại: " . $conn->connect_error);
    }


    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

    $records_per_page = 5;

    $total_records_query = "SELECT COUNT(*) AS total FROM nhanvien";
    $total_records_result = $conn->query($total_records_query);
    $total_records_row = $total_records_result->fetch_assoc();
    $total_records = $total_records_row['total'];

    $total_pages = ceil($total_records / $records_per_page);

    $start_index = ($current_page - 1) * $records_per_page;

    $sql = "SELECT nv.*, p.Tenphong FROM nhanvien nv INNER JOIN phongban p ON nv.Maphong = p.Maphong LIMIT $start_index, $records_per_page";
    $result = $conn->query($sql);

    

    $conn->close();
?>
