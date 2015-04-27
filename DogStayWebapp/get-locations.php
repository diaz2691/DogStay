<?php

function getConnection(){
        $host   = "127.0.0.1";
        $dbName = "dogstay";
        $userName = "root";
        $password = "Thisisdogstay1";
        $dbConn = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
    return $dbConn;
}

//Using PDO in this example.
//require 'pdo-connection.php';
$pdo = getConnection(); 

//Get our locations from the database.
$sth = $pdo->prepare("SELECT `lat`, `lng` FROM `markers`");
$sth->execute();
$locations = $sth->fetchAll(PDO::FETCH_ASSOC);
 
//Encode the $locations array in JSON format and print it out.
header('Content-Type: application/json');
echo json_encode($locations);
?>