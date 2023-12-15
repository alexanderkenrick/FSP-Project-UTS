<?php

class ConnectionDb{
    public static function Connect(){
        // return new mysqli('localhost', 'id21385019_kenrick_wensel', 'Kenrick_Wensel_123', 'id21385019_fspcerbung');
        return new mysqli('localhost', 'root', '', 'fsp-cerita');
    }
}

?>