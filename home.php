<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('userclass.php'); 
require_once('ceritaclass.php');

if(!isset($_SESSION['id'])){
    header('location: index.php');
}else{
    $id = $_SESSION['id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        li{
            list-style-type: none;

            display: inline-block;
            margin-right: 12px;
        
        }
    </style>
</head>
<body>
    <form action="home.php" method="get">
        <label for="">Cari Judul: </label>
        <input type="text" name="keyword">
        <input type="submit" value="Cari">
    </form>
    
    <button onclick="window.location.href='tambah.php'">Buat Cerita Baru</button> <br> <br>

    <table border="1" width="100%">
        <tr>
            <th>Judul</th>
            <th>Pembuat Awal</th>
            <th>Aksi</th>
        </tr>
    <?php
        // SELECT c.judul, u.nama, c.idcerita from cerita as c INNER JOIN users as u on c.idusers_pembuat_awal = u.idusers;

        // Mendapatkan keyword untuk dimasukkan ke query
        if(isset($_GET['keyword'])){
            $keyword = "%". strtoupper($_GET['keyword'])."%";
        }else{
            $keyword="%";
        }

        $cerita =  new Cerita();

        // Mendapatkan posisi halaman sekarang
        if(isset($_GET['page'])){
            $currentPage = $_GET['page'];
        }else{
            $currentPage = 1;
        }
        $perpage = 3;
        // Mendapatkan total data
        $totalData = $cerita->TotalData($keyword);
        $totalPage = ceil($totalData/$perpage);
        
        // Mendapatkan hasil query data buku-buku
        $ceritaArr = $cerita->DaftarCerita($keyword, $currentPage, $perpage);

        $total = count($ceritaArr);

        for($i = 0; $i<$total;$i++){
            $ceritaTemp = $ceritaArr[$i];
            echo "<tr>";
            echo "<td>".$ceritaTemp->getJudul()."</td>";
            echo "<td>".$ceritaTemp->getPembuat()."</td>";
            echo "<td><a href='lihat.php?cerita=". $ceritaTemp->getIdCerita()."'>Lihat Cerita</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        // Mendapatkan keyword untuk dimasukkan ke query string
        if(isset($_GET['keyword'])){
            $key = $_GET['keyword'];
        }else{
            $key='';
        }
        echo "<ul>";
        for($page=1;$page<=$totalPage;$page++){
            echo "<li> <a href='home.php?page=$page&keyword=$key'> $page </a></li>";
        }
        echo "</ul>";
    ?> 

</body>
</html>