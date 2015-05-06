<?php
require 'dbConnection.php';

$pdo = getConnection();

$sth = $pdo -> prepare("SELECT u.fname, u.lname, l.address, l.ownerId, l.city, l.state, l.zipcode, l.dateIn, l.dateOut, l.price FROM `locations` l JOIN `users` u ON u.userId = l.ownerId");
//$sth = $pdo -> prepare("SELECT u.fname, u.lname, l.address, l.ownerId, l.city, l.state, l.zipcode, l.dateIn, l.dateOut, l.price FROM `locations` l JOIN `users` u ON u.userId = l.ownerId WHERE dateIn >= :checkIn AND dateOut <= :checkOut");
//$namedParams[":checkIn"] = $_GET['checkIn'];
//$namedParams[":checkOut"] = $_GET['checkOut'];
//$sth -> execute($namedParams);
$sth -> execute();
$locations = $sth -> fetchAll(PDO::FETCH_ASSOC);


        
header('Content-Type: application/json');
echo json_encode($locations);




?>