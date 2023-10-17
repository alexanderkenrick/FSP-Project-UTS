<?php
 require_once('userclass.php');
    if(isset($_POST['submit'])){
        $nrp = strip_tags(addslashes($_POST['nrp'])); 
        $password =  strip_tags(addslashes($_POST['password']));
        
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