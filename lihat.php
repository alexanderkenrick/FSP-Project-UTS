<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once('userclass.php'); 
    require_once('ceritaclass.php'); 
    
    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }elseif(!isset($_GET['cerita'])){
        header('location: home.php');
    }
    else{
        $idUser = $_SESSION['id'];
        $idCerita = $_GET['cerita'];
    }

    $con = new mysqli('localhost', 'root', '', 'fsp-cerita');
        
    $sql = "SELECT judul from cerita where idcerita = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $idCerita);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $judul = $row['judul'];

    $sql2 = "SELECT isi_paragraf from paragraf where idcerita = ?";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param('i', $idCerita);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $paragrafArr = [];

    while($row2 = $result2->fetch_assoc()){
        $paragrafArr[] = $row2['isi_paragraf'];
    }
    $con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?= $judul?></h1>

    <?php
        $totalPar = count($paragrafArr);
        for($i=0;$i<$totalPar;$i++){
            echo "<p class='isi-paragraf'>". $paragrafArr[$i] ."</p>";
        }

    ?>
    <br><br>
    Tambah Pragraf:
    <form action="" method="post">
        <textarea name="tambah-paragraf" id="txtParagraf" placeholder="" ></textarea> <br>
        <input type="submit" value="Simpan" name="simpan">

    </form>

    <?php
    
        if(isset($_SESSION['flash_message'])){
            $msg =  $_SESSION['flash_message'];
            echo "<span class='error'>$msg</span>";
            unset($_SESSION['flash_message']);
        }
        
        if(isset($_POST['simpan'])){
            $paragraf = $_POST['tambah-paragraf'];

            $cerita = new Cerita();
            $msg = $cerita->TambahParagraf($idUser, $idCerita, $paragraf);

            $_SESSION['flash_message'] = $msg;
            header("location: lihat.php?cerita=".$idCerita);
        }
    ?>
    <a href="home.php"><< Kembali ke Halaman Awal</a>
</body>
</html>