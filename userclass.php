<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class User{

    private $id;
    private $nama;

    public function __construct()
    {
        $this->id = null;
        $this->nama = null;
    }

    protected static function ConnectionDb(){
        return new mysqli('localhost', 'root', '', 'fsp-cerita');
    }

    public function Daftar($snrp, $nama, $password){
        $con = $this::ConnectionDb();

        $salt = str_shuffle("ABCDEfghij");
        $md5pass = md5($password);
        $combinedpass = $md5pass.$salt;
        $finalPassword = md5($combinedpass);

        $sql = "INSERT into users values (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $snrp, $nama, $finalPassword, $salt);
        $stmt->execute();
        $msg = "";
        if(!$stmt->error){
            $msg = "Pendaftaran BERHASIL, silahkan Login";
        }else{
            $msg =  "Pendaftaran GAGAL";
        }
        $con->close();
        return $msg;
    }

    //$snrp adalah id yang dipassing dari input user
    public function Login($snrp, $password){
        $con = $this::ConnectionDb();

        $sql = "SELECT * from users where idusers=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $snrp);
        $stmt->execute();

        $status = false; //Status keberhasilan login

        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()){
            $salt = $row['salt'];
            $md5pass = md5($password);
            $combinepass = $md5pass.$salt;      
            $finalpassword = md5($combinepass);

            if($finalpassword===$row['password']){
                
                $_SESSION['id'] = $snrp;
                $status = true;
                return $status;
            }else{
                $_SESSION['flash_message'] = "Password Salah";
                return $status;
            }
        }else{
            $_SESSION['flash_message'] = "User tidak ditemukan";
            return $status;
        }
        $con->close();
    }

    public function __destruct()
    {
        
    }
}

?>