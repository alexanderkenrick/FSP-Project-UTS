<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['id'])){
        header('location: home.php');
    }
    require_once('userclass.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap');
        *{
            font-family: 'Inter', sans-serif;
        }
        .content{
            width: 100%;
            height: calc(100vh - 70px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card{
            width: 300px;
            height: 350px;
            background-color: yellow;
        }
        .card-header{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70px;
        }
        .card-header h1{
            font-weight: bolder;
        }

        .card-body{
            height: calc(100% - 70px);
            width: 100%;
        }
        .card-body form{
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .error{
            background-color: rgba(255, 0, 0, 0.8);
            color: #fff;
            width: 80%;
            text-align: center;
            padding: 2px;
            margin-bottom: 8px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h1>LOGIN</h1>
            </div>
            <div class="card-body">
            
                <form action="" method="post">
                     <?php
                        if(isset($_SESSION['flash_message'])){
                            $msg =  $_SESSION['flash_message'];
                            echo "<span class='error'>$msg</span>";
                            unset($_SESSION['flash_message']);
                        }
                    ?>
                    <label for="nrp">NRP: </label>
                    <input type="text" name="nrp"> <br>
                    <label for="password">Password: </label>
                    <input type="password" name="password" id=""> <br>
                    <input type="submit" value="Login" name="submit"> <br>
                    <a href="daftar.php">Daftar akun</a>
                </form>
                
            </div>
        </div>

    </section>
    
<?php
    if(isset($_POST['submit'])){
        $nrp = htmlentities(strip_tags(addslashes($_POST['nrp']))); 
        $password = $_POST['password'];
        
        $user = new User();
        $status = $user->Login($nrp, $password);
        if($status == false){
            header("location: index.php");
        }else{
            header("location: home.php");
        }
    }

?>
</body>
</html>