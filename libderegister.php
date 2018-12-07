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
//This area is for the display and hide entries buttons.
?>

<br>
<form actions="lib.php" method="post"> <center>
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
    <br><br>
<h2><center>Deregister here<center></h2> 
<!--Form wrapper just cushions the margin of the entry forms.-->
<div id="FormWrapper">
<form method="post">
Library ID:<br> 
<input type="text" name="libID"> <br> 
First name:<br> 
<input type="text" name="firstname"><br> 
Last name:<br> 
<input type="text" name="lastname"> <br> 
<br>
<input type="Submit" name="PersonSubmit"OnClick="return confirm('Are you sure you want to delete your account?');"> 
<br>
</center>
</form>
 
<div <div align="center">
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
<br><br><br><br><br>
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

</body> 
</html> 
