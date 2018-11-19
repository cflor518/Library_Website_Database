<?php
//session_start() needs to be used to pass on session variables.
session_start();   
$connection = mysqli_connect('localhost', 'root', 'root');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'Library');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

if (isset($_POST['fname']) and isset($_POST['lname']) and isset($_POST['libID'])) {
	
	// Assigning POST values to variables.
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$libID = $_POST['libID'];
  	$_SESSION['fname'] = $fname;
  	$_SESSION['lname'] = $lname;
  	$_SESSION['libID'] = $libID;
	// CHECK FOR THE RECORD FROM TABLE
	$query = "SELECT * FROM `people` WHERE fname='$fname' and lname= '$lname' and libID='$libID'";
 
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$count = mysqli_num_rows($result);
	if ($count == 1){
		header('Location: loggedin.php');
	}
	else {
		//invalid login so sent to screen that prompts them to try again or go back to home
		header('Location: login_inco.php');
		exit;
	}
}
?>
