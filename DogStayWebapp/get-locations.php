<?php
require 'dbConnection.php';

$pdo = getConnection();

$sth = $pdo -> prepare("SELECT address, city, state, zipcode FROM locations");
$sth -> execute();
$locations = $sth -> fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($locations);
?>