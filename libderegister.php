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
<form action="http://localhost:8000/libwelcome.php">
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
			echo $row["libid"] . "<br>";
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
    libid, the first name and last name forms are ignored.-->
<h2>Deregister here</h2> 
<!--Form wrapper just cushions the margin of the entry forms.-->
<div id="FormWrapper">
<form method="post"> 
Library ID:<br> 
<input type="text" name="libid"> <br> 
First name:<br> 
<input type="text" name="firstname"><br> 
Last name:<br> 
<input type="text" name="lastname"> <br> 
<input type="Submit" name="PersonSubmit"> 
</form> 
 
<?php  
        if($_POST["PersonSubmit"]){ 
		$libid = $_POST["libid"];
		$fname = $_POST["firstname"];
		$lname = $_POST["lastname"];
		/***********************************************/
		//Set up the sql query to delete and also take 
		//the name of the person to be deleted from the
		//database so we can echo it to the user for 
		//viual confirmation.
		$delete_sql = "DELETE FROM people WHERE libid = " . $libid;
		$fetchname_sql = "SELECT fname FROM people where libid = ".$libid; 
		$arraynameofdeleted = $conn->query($fetchname_sql);
		$nameofdeleted = $arraynameofdeleted->fetch_assoc();
		if($conn->query($delete_sql) === TRUE){
			echo "Deregistration Complete. Goodbye, ".$nameofdeleted["fname"]. ", we are sad to see you go.<br>";
		}else{
			echo "Error: " . $delete_sql."<br>" .$conn->error;
		}

	}
	//echo $newlibid . $fname . $lname . $phone . $address;

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
