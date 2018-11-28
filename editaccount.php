<?php
session_start();
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="loggedin.css">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
function myFunction() {
    var txt;
    var r = confirm("Press a button!");
    if (r == true) {
        txt = "You pressed OK!";
    } else {
        txt = "You pressed Cancel!";
    }
    document.getElementById("demo").innerHTML = txt;
}
</script>
<body id="body_bg">
<div <div align="center">
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
//In the following form, place the information into the text boxes
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
		<input type="Submit" value="Deregister"  name="DeregisterSubmit">
	</form>
<?php
        if($_POST["PersonSubmit"]){ 
		$fname = $_POST["firstname"];
		$lname = $_POST["lastname"];
		$phone = $_POST["phonenumber"];
		$address = $_POST["address"];
		$sql = "UPDATE people SET fname = '" . $fname . "', lname = '" . $lname . "', phone = " . $phone . ", address = '" . $address . "' WHERE libid = " . $currentUserID; 
		$result = $conn->query($sql);
		if($conn->query($sql) === TRUE){
			echo "Changes commencing ...  inserting <br> ".$fname."<br>". $lname."<br>".$phone."<br>".$address;
			echo '<meta http-equiv="refresh" content="3"/>';
		}else{
			echo "Error: " . $sql."<br>" .$conn->error;
		}
	}
	if($_POST["DeregisterSubmit"]){
		echo "something";
		//Was thinking after button was pushed a pop up will show to confirm or deny the deregistration
		//but I found out we need Javascript to do it and I dont know how to relate back to php
		//once the user has clicked confirm :(
		echo  "<p id=\"demo\"></p>"; //This will echo the "txt" varaible in the javascript function
		echo "<script>myFunction();</script>";
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
