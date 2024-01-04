<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('class/userclass.php'); 
require_once('class/ceritaclass.php');

if(isset($_POST['logout'])){
    unset($_SESSION['id']);
}

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
    <title>Cerita Bersambung</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <!-- <form action="home.php" method="GET" style="margin-bottom: 20px;">
        <label for="">Cari Judul: </label>
        <input type="text" name="keyword">
        <input type="submit" value="Cari">
    </form>
     -->
    <div class="header">
        <h1>CERBUNG</h1>
        <sub>Cerita Bersambung</sub>
    </div>

    <div class="sm-kategori">
        <label for="kategori">Kategori:</label>
        <select name="kategori" id="kategori" onchange="updateDisplay()" current='0'>
            <option value="0" selected>Kumpulan Cerita</option>
            <option value="1">Ceritaku</option>
        </select>
    </div>
    <input type="hidden" name="idPembuat" id="idPembuat" value="<?= $_SESSION['id']?>">
        <input type="hidden" name="page" id="currentPage" value="1">
    <button onclick="window.location.href='new.php'">Buat Cerita Baru</button> <br> <br>

    <div class="container">
        <div class="ceritaku-wrapper">
            <div class="header">
                <h2>Ceritaku</h2>
            </div>

            <div class="ceritaku-card-wrapper">


            </div>
            <button currentPage="1" id="ceritakuButton" class="pageButton">Tampilkan Cerita Selanjutnya</button>
        </div>
        <div class="kumpulan-wrapper">
            <div class="header">
                <h2>Kumpulan Cerita</h2>
            </div>
            <div class="kumpulan-card-wrapper">
        
               
            </div>
            <button currentPage="1" id="kumpulanButton" class="pageButton">Tampilkan Cerita Selanjutnya</button>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {
            if ($(window).width() <= 575) {
                $(".ceritaku-wrapper").hide()
                $(".kumpulan-wrapper").show()
            } else {
                $(".ceritaku-wrapper").show()
                $(".kumpulan-wrapper").show()
            }
            getCeritaku()
            getKumpulan()
        });
        function getCeritaku(){
            var currentPage = $("#ceritakuButton").attr('currentPage');
            var idPembuat = $("#idPembuat").val();

            $.ajax({
                type: "post",
                url: "getCeritaku.php",
                data: {
                    'currentPage' : currentPage,
                    'idPembuat' : idPembuat
                },
                success: function (response) {
                    var result = JSON.parse(response)
                    $.each(result, function (index, cerita) { 
                        $(".ceritaku-card-wrapper").append(
                            `
                            <div class="cerita-card">
                            <div class="cerita-card-header">
                                <h3>${cerita.judul}</h3>
                            </div>
                            <div class="cerita-card-body">
                                <p>Jumlah Paragraf: ${cerita.jumlahPar}</p>
                                <a href="read.php?cerita=${cerita.id}">Baca lebih lanjut</a>
                            </div>
                        </div>
                            `
                        );
                    });    
                    currentPage++
                    $("#ceritakuButton").attr('currentPage', currentPage);
                }
            });
        }

        function getKumpulan(){
            var currentPage = $("#kumpulanButton").attr('currentPage');
            var idPembuat = $("#idPembuat").val();
            
            $.ajax({
                type: "post",
                url: "getKumpulan.php",
                data: {
                    'currentPage' : currentPage,
                    'idPembuat' : idPembuat
                },
                success: function (response) {
                    var result = JSON.parse(response)
                    $.each(result, function (index, cerita) { 
                        $(".kumpulan-card-wrapper").append(
                            `
                            <div class="cerita-card">
                                <div class="cerita-card-header">
                                    <h3>${cerita.judul}</h3>
                                </div>
                                <div class="cerita-card-body">
                                    <p>Pemilik Cerita: ${cerita.pembuat}</p>
                                    <p>Jumlah Paragraf: ${cerita.jumlahPar}</p>
                                    <a href="read.php?cerita=${cerita.id}">Baca lebih lanjut</a>
                                </div>
                            </div>
                            `
                        );
                    }); 
                    currentPage++
                    $("#kumpulanButton").attr('currentPage', currentPage);                  
                }
            });
        }

        $("#kumpulanButton").click(function (e) { 
            getKumpulan()
        });

        $("#ceritakuButton").click(function (e) { 
           getCeritaku()
        });

        function updateDisplay(){
            var category = $("#kategori").val();
            if(category==0){
                $(".ceritaku-wrapper").hide()
                $(".kumpulan-wrapper").show()
            }else{
                $(".ceritaku-wrapper").show()
                $(".kumpulan-wrapper").hide()
            }
        }

        $(window).on('resize', function() {

            if ($(window).width() <= 575) {
                updateDisplay()
            } else {
                $(".ceritaku-wrapper").show()
                $(".kumpulan-wrapper").show()
            }
            
        });
    </script>

    <form action="" method="POST">
        <input type="submit" value="Log Out" name="logout">
    </form>

</body>
</html>