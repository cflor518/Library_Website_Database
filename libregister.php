<html>
<body>	
<div id="wrapper">
<link rel="stylesheet": href="color.css">
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
?>
<form action="http://localhost:8888/libwelcome.php">
    <input type="submit" value="Home Page" />
</form>
<form actions="lib.php" method="post">
       <!-- <input type="Submit" name="AmountButton" value="Display Amount">-->
        <input type="Submit" name="EntriesButton" value="Display Entries">
        <input type="Submit" name="HideEntriesButton" value="Hide Entries">
</form>

<?php
/**************************************************************** 
/*        if ($_POST["AmountButton"]){ 
		//If you click this button it will show the amount of entries (number);
                $sql = "SELECT Count(*) FROM people"; 
                $result = $conn->query($sql); 
                    //$row is an array, will echo the word "Array 
                    $row = $result->fetch_assoc();  
                    //There is only one "Count(*)" in this array 
                    //So that what it will print 
                    echo $row["Count(*)"] . "<br>"; 
        }else*/ 
/****************************************************************/



	//Displays the entries in the database 	
	if ($_POST["EntriesButton"]){ 
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
	/****************************************************************/
	//Hides the entries in the database 	
        }else if($_POST["HideEntriesButton"]){



	} 
/****************************************************************/ 
?>
<h2>Register here</h2> 
<!--Form Wrapper just pushes the margins for the form boxes a
little to the right-->
<div id="FormWrapper">
<form method="post"> 
First name:<br> 
<input type="text" name="firstname"><br> 
Last name:<br> 
<input type="text" name="lastname"> <br> 
Phone:<br> 
<input type="text" name="phonenumber"> <br> 
City,Sate:<br> 
<input type="text" name="address"> <br> 
<br> 
<input type="Submit" name="PersonSubmit"> 
</form> 
 
<?php  
        if($_POST["PersonSubmit"]){ 
		$fname = $_POST["firstname"];
		$lname = $_POST["lastname"];
		$phone = $_POST["phonenumber"];
		$address = $_POST["address"];
		$duplicatefound = 0;
		$emptyform = 0;
		/***********************************************
		*****OBSOLETE: PROGRAM NO LONGER ASSIGN LibID in
		this manner****
		//Returns the number of entries then adds one
		//The outcome is the new libID for the person
		//being entered;
                $sql = "SELECT Count(*) FROM people"; 
                $result = $conn->query($sql); 
	    	$row = $result->fetch_assoc();  
	    	$newlibID =  $row["Count(*)"] . "<br>"; 
		$newlibID = $newlibID + 1;
		***********************************************/
		//Starts at Library ID one and increments by one
		//until there is Library ID that does not exists
		//In this manner, we can fill holes in Library ID
		//when we register people, though this algorithm
		//does have O(n) complexity.
		$LibraryIDisUnqiue = FALSE;
		$newlibID = 0; 
		$foundMatch = 0;
		while($LibraryIDUnqiue == FALSE){
			$LibraryIDUnqiue = TRUE;
			$newlibID = $newlibID + 1; 
			$sql = "SELECT * FROM people";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
				$checklibID =  $row["libID"] . "<br>";
				if(intval($checklibID) == $newlibID){
				    echo "This libID already exists in database: " . $newlibID."<br>";
				    $LibraryIDUnqiue = FALSE;
				}
			    }
			}
		}
		/***********************************************/
		//Checks if the forms for first name, last name
		//and phone number are empty and flags for 
		//rejections. ALSO, checks if there already a
		//similar phone number in the database, flags
		//for rejection if there is.
		//TODO: The phone number check is kind of dumb, 
		//want to replace it with another check for 
		//duplicate entries.
		$sql = "SELECT * FROM people";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
			$checkfname =  $row["fname"] . "<br>";
			$checklname =  $row["lname"] . "<br>";
			$checkphone =  $row["phone"] . "<br>";
			//Converts the phone numbers from string to int
			//which helps problems I was having trying to
			//compare strings.
			$checkphone = intval($checkphone);
			$phone =  intval($phone);
			//echo var_dump($phone);
			//echo "<br>";
			if(empty($fname)){
				$emptyform = 1;

			}else if(empty($lname)){
				$emptyform = 1;

			}else if(empty($phone)){
				$emptyform = 1;

			}else if ($checkphone == $phone){
				$duplicatefound = 1;
			}
		    }
		}
		/*****************************************************/
		//If there is a duplicate or an empty form, do nothing
		if($duplicatefound == 1 || $emptyform == 1){
			echo "Not inserting this entry, found a duplicate entry in the database/trying to insert empty form";
		}else{
		/*****************************************************/
		//If you found nothing wrong with the user's entries
		//try and insert it into the database.
			$insert_sql = "INSERT INTO people(libID, fname, lname, phone, address) VALUES(" . $newlibID . ",'" . $fname."','".$lname."',".$phone.",'".$address."');";
			if($conn->query($insert_sql) === TRUE){
			/*****************************************************/
			//Attempt to insert the query in the database
				echo "Registration Complete. Welcome ".$fname.", your Library ID # is: ".$newlibID;
			}else{
			/*****************************************************/
			//Something went wrong with the attemp to insert
				echo "Error: " . $insert_sql."<br>" .$conn->error;

			}
		}

	}
	//echo $newlibID . $fname . $lname . $phone . $address;

/****************************************************************/ 
?> 
</div> 
<hr SIZE=11 NOSHADE WIDTH="100%"> 
<i>Copyright 2008-2018</i></font><br> 
<i>ALL RIGHTS RESERVED</i></font><br> 
<i>URL: http://www.sdsu.edu</i></font><br> 
</div><!--End Wrapper Class--> 
</body> 
</html> 
