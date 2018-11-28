<?php
//Making a comment
session_start();
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="loggedin.css">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<body id="body_bg">
<div align="center">
<br><br><br><br><br>
<h1>Edit Account Information</h1>
<h3>Please edit account information to change</h3>

<?php
//Connect to the database and place all attribute
//of user in to php variables.
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$DB = "Library";
	$conn = new mysqli($servername, $username, $password,$DB);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//Sessions variable assigned during authen_login.php
	$currentUserID = $_SESSION["libID"];
	$sql = "SELECT * FROM people where libid = " . $currentUserID ;
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$fname = $row["fname"];
		$lname = $row["lname"];
		$phone = $row["phone"];
		$address = $row["address"];
	}
	//If they are in this page but I couldnt get a libID for them
	//Then kick them out!
	echo $currentUserID;
	if(!isset($currentUserID) || is_null($currentUserID)){
		echo "Youre not supposed to be here... redirecting...";
		echo '<meta http-equiv="refresh" content="3;url=login.php"/>';
	}
?>	
	<form id="login-form" method="post" >	
		First name:<br> 
		<input type="text" name="firstname" value = "<?php echo htmlspecialchars($fname);?>"> <br> 
		Last name:<br> 
		<input type="text" name="lastname" value = "<?php echo htmlspecialchars($lname);?>"> <br> 
		Phone:<br> 
		<input type="text" name="phonenumber"value = "<?php echo htmlspecialchars($phone);?>"> <br> 
		City,Sate:<br> 
		<input type="text" name="address"value = "<?php echo htmlspecialchars($address);?>"> <br> 
		<br> 
		<input type="button" value="Home" onclick="window.location.href='loggedin.php'" > 
		<input type="Submit" name="PersonSubmit">
		<br> 
	</form>
<?php
	if($_POST["PersonSubmit"]){ 
		$fname = $_POST["firstname"];
		$lname = $_POST["lastname"];
		$phone = $_POST["phonenumber"];
		$address = $_POST["address"];
		$sql = "UPDATE people SET fname = '" . $fname . "', lname = '" 
		. $lname . "', phone = " . $phone . ", address = '" . $address . "' WHERE libid = " . $currentUserID; 
		$result = $conn->query($sql);
		if($conn->query($sql) === TRUE){
			echo "Changes commencing ...  inserting <br> ".$fname."<br>". $lname."<br>".$phone."<br>".$address;
			echo '<meta http-equiv="refresh" content="3"/>';
		}else{
			echo "Error: " . $sql."<br>" .$conn->error;
		}
	}
?>
	<br>
	<h3>Click "Deregister" to delete account</h3>
	<form id="login-form" method="post" >	
		<input type="Submit" value="Deregister"  name="DeregisterSubmit" OnClick="return confirm('Are you sure you want to delete your account?');">
	</form>
<?php
	if($_POST["DeregisterSubmit"]){
		/***********************************************/
		//Set up the sql query to delete and also take 
		//the name of the person to be deleted from the
		//database so we can echo it to the user for 
		//viual confirmation.
		$delete_sql = "DELETE FROM people WHERE libid = " . $currentUserID;
		$fetchname_sql = "SELECT fname FROM people where libid = ".$currentUserID; 
		$arraynameofdeleted = $conn->query($fetchname_sql);
		$nameofdeleted = $arraynameofdeleted->fetch_assoc();
		if($conn->query($delete_sql) === TRUE){
			echo "Deregistration Complete. Goodbye, ".$nameofdeleted["fname"]. ", we are sad to see you go.<br>";
			echo "Redirecting Now...";
			echo '<meta http-equiv="refresh" content="3;url=login.php"/>';
		}else{
			echo "Error: " . $delete_sql."<br>" .$conn->error;
		}
	} 
?>
</div>
</body>
<br><br><br><br><br><br><br><br>
<hr SIZE=20 NOSHADE WIDTH="100%">
<i>Copyright 2008-2018</i></font><br> 
<i>ALL RIGHTS RESERVED</i></font><br> 
<i>URL: http://www.sdsu.edu</i></font><br> 		
</html>
