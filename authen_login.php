<?php  
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
		echo "Login Credentials verified";
		header('Location: bookcheckout.php');
		//^^wherever it should go when it authenticates
	}
	else {
		//invalid login so sent back to welcome screen
		//echo "Invalid Login Credentials";
		header('Location: libwelcome.php');
		exit;
	}
}
?>
