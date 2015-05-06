<?php
 
require 'dbConnection.php';
$dbConn = getConnection();
 
$sql = "DELETE FROM reservations WHERE reservationId = :reservationId";    
$namedParameters = array();
$namedParameters[':reservationId'] = $_POST['reservationId'];
$stmt = $dbConn -> prepare($sql);
$stmt->execute($namedParameters);

header("Location: table.php");

?>