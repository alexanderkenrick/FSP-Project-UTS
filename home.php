<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('userclass.php'); 
require_once('ceritaclass.php');

if(!isset($_SESSION['id'])){
    header('location: home.php');
}else{
    $id = $_SESSION['id'];
    echo $id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Cari Judul: </label>
        <input type="text" name="cari-judul">
        <input type="submit" value="Cari" name="cari">
    </form>
    
    <button onclick="window.location.href='tambah.php'">Buat Cerita Baru</button>

    <table>
        <tr>
            <th>Judul</th>
            <th>Pembuat Awal</th>
            <th>Aksi</th>
        </tr>
    <?php
        // SELECT c.judul, u.nama, c.idcerita from cerita as c INNER JOIN users as u on c.idusers_pembuat_awal = u.idusers;

        if(isset($_GET['keyword'])){
            $key = "%".$_GET['keyword']."%";
        }else{
            $key='%';
        }

        $cerita =  new Cerita();

        $perpage = 3;
        $totalData = $cerita->TotalData($keyword);
        $totalPage = ceil($totalData/$perpage);
        $currentPage = 1;

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

        for($page=1;$page<=$totalPage;$page++){

        }
    ?> 
    



</body>
</html>