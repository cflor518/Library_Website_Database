<html>
<link rel="stylesheet": href="color.css">
<div id="wrapper">
<body>
<div class="header">
                <img src="SABC.png" alt="SABCLogo"/>
                <h1>SABC Library</h1>
</div>
<?php
/****************************************************************/
//Connect to the Database;
$servername = "localhost";
$username = "root";
$password = "root";
$DB = "Library";
// Create connection
$conn = new mysqli($servername, $username, $password,$DB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected to ". $servername ." successfully<br>";
/****************************************************************/
//This area is for the display and hide entries buttons.
?>
<form action="http://localhost:8888/libwelcome.php">
    <input type="submit" value="Home Page" />
</form>
<form actions="lib.php" method="post">
        <input type="Submit" name="EntriesButton" value="Display Entries">
        <input type="Submit" name="HideEntriesButton" value="Hide Entries">
	
</form>

<?php 
        if ($_POST["EntriesButton"]){ 
		/****************************************************************/
		//If you click this button it will show the fname of all entires;
		$sql = "SELECT * FROM people";
		$result = $conn->query($sql);
		#function num_rows() checks if there are more than zero rows.
		if ($result->num_rows > 0) {
		    // output data of each row
		    //If there are more tahn zero rows returned, the function
		    //the function fetch_assoc() puts all the results into an 
		    //associative array that we can loop through. THe while loop
		    //loops through the result set and outputs the data from the
		    //SName columns in Sailors;
		    while($row = $result->fetch_assoc()) {
			echo $row["libID"] . "<br>";
			echo $row["fname"] . "<br>";
			echo $row["lname"] . "<br>";
			echo $row["phone"] . "<br>";
			echo $row["address"] . "<br><br>";
		    }
		} else {
		    echo "0 results";
		}
        }else if($_POST["HideEntriesButton"]){

	} 
?>
<!---------------------------------------------------------------->
<!--To deregister,all you really need to enter in the form is the 
    libID, the first name and last name forms are ignored.-->
<h2>Deregister here</h2> 
<!--Form wrapper just cushions the margin of the entry forms.-->
<div id="FormWrapper">
<form method="post"> 
Library ID:<br> 
<input type="text" name="libID"> <br> 
First name:<br> 
<input type="text" name="firstname"><br> 
Last name:<br> 
<input type="text" name="lastname"> <br> 
<input type="Submit" name="PersonSubmit"OnClick="return confirm('Are you sure you want to delete your account?');"> 
</form>
 
 
<?php  
if($_POST["PersonSubmit"]){ 
	$libID = $_POST["libID"];
	$fname = $_POST["firstname"];
	$lname = $_POST["lastname"];
	$personfound = false;
	$databaseempty = false;
	//Check if all of the forms have been filled out	
	if (!empty($_POST['libID']) and !empty($_POST['firstname']) and !empty($_POST['lastname'])) {
		$check_user_sql = "SELECT * FROM people";
		$check_user_result = $conn->query($check_user_sql);
		//Checks if there is anything inside the database, any rows at all
		if ($check_user_result->num_rows > 0) {
			while($row = $check_user_result->fetch_assoc()) {
				if( $libID === $row["libID"] && $fname === $row["fname"] && $lname === $row["lname"]){
					$personfound = true;
				}
			}
		}else{ echo "<script> alert(\"Our database is empty...\"); </script>"; $databaseempty = true;}
		//If first name, last name, and libid match a row in my database
		//Then go ahead and delete this person.
		if($personfound){
			$delete_sql = "DELETE FROM people WHERE libID = " . $libID;
			$fetchname_sql = "SELECT fname FROM people where libID = ".$libID; 
			$arraynameofdeleted = $conn->query($fetchname_sql);
			$nameofdeleted = $arraynameofdeleted->fetch_assoc();
			if($conn->query($delete_sql) === TRUE){
				echo "Deregistration Complete. Goodbye, ".$nameofdeleted["fname"]. ", we are sad to see you go.<br>";
			}else{ echo "Error: " . $delete_sql."<br>" .$conn->error; }
		}else{ if(!$databaseempty){ echo "<script> alert(\"Im sorry, no matching records found for the information you have provided\"); </script>"; }
		}
	}else{ echo "<script> alert(\"Please fill out the form completely\"); </script>"; }
}
	//echo $newlibID . $fname . $lname . $phone . $address;
/****************************************************************/ 
?> 
</div> 
<hr SIZE=11 NOSHADE WIDTH="100%"> 
<i>Copyright 2008-2018</i></font><br> 
<i>ALL RIGHTS RESERVED</i></font><br> 
<i>URL: http://www.sdsu.edu</i></font><br> 
</div> 
</body> 
</html> 
