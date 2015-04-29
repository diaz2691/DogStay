<?php

function getConnection() {
	$host = "localhost";
	$dbName = "dogstay";
	$userName = "root";
	$password = "dogstay";
	
	try {
		$dbConn = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
		$dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e -> getMessage();
	}

	return $dbConn;
}

$pdo = getConnection();

$sth = $pdo -> prepare("SELECT address, city, state, zipcode FROM locations");
$sth -> execute();
$locations = $sth -> fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($locations);
?>