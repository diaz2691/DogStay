<?php

function getConnection(){
        $host   = "127.0.0.1";
        $dbName = "dogstay";
        $userName = "root";
        $password = "dogstay";
        $dbConn = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
		return $dbConn;
}

?>