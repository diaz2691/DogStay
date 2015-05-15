<?php
//TESTING DB CONNECTION // returns true
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
		return false;
	}

	return true;
}

// TESTING USERNAMES
function checkUsernames($username,$password){
session_start();
if(isset($_POST['loginForm'])){
require 'dbConnection.php';
        
$dbConn = getConnection();
$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
$namedParams[":username"] = $_POST['username'];
$namedParams[":password"] = sha1($_POST['password']);
$stmt = $dbConn->prepare($sql);
$stmt->execute($namedParams);
$result = $stmt->fetch();
if(empty($result)){
    header("Location: login.html?error='wrong username");
    return false;
            
}else{
 $_SESSION["username"] = $result["username"];
 $_SESSION["username"] = $result["username"];
 header("Location: profile.php");
 return true;
} }

//test values : 
$username = brian;
$password = brian;
checkUsernames($username,$password); // returns true, existing username& password
$username = avfva;
$password = avav;
checkUsernames($username,$password); // returns false, non existing username& password
$username = "";
$password = "";
checkUsernames($username,$password); // returns false, empty values 

//TESTS FOR SIGNING UP 
function checkUsername() {  
 $("#usernameError").css("color", "red");
 if($("#username").val().length < 4){
	displayError("#username","Username must have at least 4 characters");
	    return false;
}

//TYPING :
/*
username : brian // error
username : afdsagg // no error
username : af // error, must be 4 characters long  
*/

//testing phone format
function checkPhone(){
}
/*
phone : 452452 // error
phone : 45246143514 // error
phone : (831) 272-8282 // no error

*/

//TESTING DRESERVATIONS
function getDogs($dbConn, $id) {
	$sql = "SELECT dogId, dogName FROM dogs WHERE ownerId = :ownerId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":ownerId" => $_SESSION['userId']));
	return $stmt -> fetchAll();
}

getDogs($dbConn, 1); // existing user and returns appropriate values
getDogs($dbConn, 6); // existing user and returns appropriate values

//Testing dog names
function getDogName($dbConn, $id) {
	$sql = "SELECT dogName FROM dogs WHERE dogId = :dogId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":dogId" => $id));
	return $stmt -> fetch();
}

getDogName($dbConn, 1);
// returns coco
//correct
getDogName($dbConn, 2);
//returns pinon
//correct

//testing owner name 
function getOwnerName($dbConn, $id) {
	$sql = "SELECT fname, lname FROM users WHERE userId = :userId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":userId" => $id));
	return $stmt -> fetch();
}

getOwnerName ($dbConn, 1);
//returns brian 
// correct
getOwnerName ($dbConn, 6);
//returns jose 
// correct

//testing reservations
function getReservationsOwner($dbConn) {
	$sql = "SELECT reservationId, ownerId, clientId, dogId, price, dateIn, dateOut FROM reservations WHERE ownerId = :ownerId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":ownerId" => $_SESSION['ownerId']));
	return $stmt -> fetchAll();
}

getReservationsOwner($dbConn); // with ownerId = 1
//returns 1,1,6,1, 12, 2015-05-04, 2015-05-05
//correct result

// testing locations 
function getLocations($dbConn) {
	$sql = "SELECT address, city, state, zipcode, price, dateIn, dateOut, locationId FROM locations WHERE ownerId = :ownerId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":ownerId" => $_SESSION['ownerId']));
	return $stmt -> fetchAll();
}

getLocations($dbConn); // with ownerId = 1
//returns 2877 Christopher Drive
//San Juan Bautista
//CA
//9045
//0000-00-00
//0000-00-00




	     
?>