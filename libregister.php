<!DOCTYPE html >
<html>
<head>
<title>SABC Library Login</title>
<meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <title>Sprout</title>
  <style>
     .row div{padding:20px 10px}
  </style>
   <nav class="navbar navbar-expand-lg navbar-light" style="background:rgb(107,142,165)">
         <a class="navbar-brand" href="#"><p class="ab"><img src="SABC.png" width ="50px">SABC Library</p></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav mr-auto">

           </ul>
           <ul class="navbar-nav">
            
             <li class="nav-item">
               <a href="http://localhost:8888/Library_Website_Database-master/login.php" class="nav-link" href=""><p class="a">Home</p></a>
             </li>
             <li class="nav-item">
               <a href="http://localhost:8888/Library_Website_Database-master/libregister.php" class="nav-link" href=""><p class="a">Sign Up</p></a>
             </li>
             <li class="nav-item">
               <a href="http://localhost:8888/Library_Website_Database-master/libderegister.php" class="nav-link" href=""><p class="a">Unsubscribe</p></a>
             </li>
             <li class="nav-item">
               <a href="http://localhost:8888/Library_Website_Database-master/checkout.php" class="nav-link" href=""><p class="a">Checkout</p></a>
             </li>
              <li class="nav-item">
               <a href="http://localhost:8888/Library_Website_Database-master/editaccount.php" class="nav-link" href=""><p class="a">Edit Account</p></a>
             </li>
             <li class="nav-item">
               <a href="http://localhost:8888/Library_Website_Database-master/logout.php" class="nav-link" href=""><p class="a">Sign Out</p></a>
             </li>
           </ul>
         </div>
       </nav>

  </header>
  <br><br><br>
                <h1><center>SABC Library</center?></h1>
 </head>
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
<form actions="lib.php" method="post"> <center>
<br>
       <!-- <input type="Submit" name="AmountButton" value="Display Amount">-->
        <input type="Submit" name="EntriesButton" value="Display Entries">
        <input type="Submit" name="HideEntriesButton" value="Hide Entries">
</center>
</form>
<br>
<div <div align="center">
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
</div>s
<h2><center>Register here</center></h2> 
<!--Form Wrapper just pushes the margins for the form boxes a
little to the right-->
<div id="FormWrapper">
<form method="post"><center> 
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
</center>
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
</div> <br><br><br>
</div> 
</div> 
<section id="footer" style="background:rgb(107,142,165)">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                    <p> &copy; SABC 2018</p>
                    <p>ALL RIGHTS RESERVED</p>
                </div>

            </div>
        </div>

    </section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</div><!--End Wrapper Class--> 
</body> 
</html> 
