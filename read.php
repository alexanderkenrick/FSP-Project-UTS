<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once('class/userclass.php'); 
    require_once('class/ceritaclass.php'); 
    
    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }elseif(!isset($_GET['cerita'])){
        header('location: home.php');
    }
    else{
        $idUser = $_SESSION['id'];
        $idCerita = $_GET['cerita'];
    }
    $cerita = new Cerita();
    $judul = $cerita->TampilkanJudul($idCerita);
    $paragrafArr = $cerita->LihatCerita($idCerita);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><?= $judul?></h1>

    <div class="paragraf">
        <?php
            $totalPar = count($paragrafArr);
            for($i=0;$i<$totalPar;$i++){
                echo "<p class='isi-paragraf'>". $paragrafArr[$i] ."</p>";
            }
        ?>
     </div>
    <br><br>
    Tambah Pragraf:
    <form action="prosesparagraf.php" method="POST">
        <textarea name="tambah-paragraf" id="txtParagraf" placeholder="" maxlength="100" cols="50" required></textarea> <br>
        <input type="hidden" name="idcerita" value="<?= $idCerita ?>">
        <input type="submit" value="Simpan" name="simpan">

    </form>

    <?php
    
        if(isset($_SESSION['flash_message'])){
            $msg =  $_SESSION['flash_message'];
            echo "<br><span class='error'>$msg</span><br>";
            unset($_SESSION['flash_message']);
        }

    ?>
    <a href="home.php"><< Kembali ke Halaman Awal</a>
</body>
</html>