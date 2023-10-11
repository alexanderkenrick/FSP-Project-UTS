<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('userclass.php'); 
require_once('ceritaclass.php'); 

if(!isset($_SESSION['id'])){
    header('location: index.php');
}else if(isset($_GET['cerita'])){
    $idCerita = $_GET['cerita'];
}else{
    $idUser = $_SESSION['id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Cerita</title>
</head>
<style>
    .content{
        display: grid;
        grid-template-columns: auto auto;
        width: 400px;
        gap: 12px;
    }

    .content textarea{
        min-height: 60px;
    }
</style>
<body>
    
    <form action="tambah.php" method="post">

        <div class="content">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" required>
            <label for="paragraf">Paragraf 1:</label>
            <textarea name="paragraf" id="txtParagraf" placeholder="" maxlength="100" required></textarea> 
            <input type="submit" value="Simpan" name="simpan">
        </div>
        
    </form>
    <a href="home.php"><< Kembali ke Halaman Awal</a>
    <?php
        if(isset($_POST['simpan'])){
            $judul = strtoupper(addslashes($_POST['judul']));
            $paragraf = $_POST['paragraf'];

            if($judul== '' || $judul==' ' || $paragraf == '' || $paragraf== " "){
                echo "<br> Judul dan paragraf tidak boleh kosong";
                
            }else{
                $cerita = new Cerita();
                $msg = $cerita->TambahCerita($idUser, $judul, $paragraf);
                echo "<br>" . $msg;
            }
        }
    ?>
</body>
</html>