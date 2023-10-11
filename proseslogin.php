<?php
 require_once('userclass.php');
    if(isset($_POST['submit'])){
        $nrp = htmlentities(strip_tags(addslashes($_POST['nrp']))); 
        $password = $_POST['password'];
        
        $user = new User();
        $status = $user->Login($nrp, $password);
        if($status == false){
            header("location: index.php");
        }
        else{
            header("location: home.php");
        }
    }

?>