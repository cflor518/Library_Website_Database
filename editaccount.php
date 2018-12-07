<?php
//Making a comment
session_start();
?>
<!DOCTYPE html >
<html>
<head>
<title>SABC Library | Edit Account</title>
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
               <a href=<?php

if (isset($_SESSION['libID'])) {

	echo "\"http://localhost:8888/Library_Website_Database-master/loggedin.php\"";
}else{
	echo "\"http://localhost:8888/Library_Website_Database-master/login.php\"";
}
?> class="nav-link" href=""><p class="a">Home</p></a>

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
</head>
<br><br><br>
<h1><center>Edit Account Information</center></h1>
<p><center>Please edit account information to change<center></p>

<?php
if (!isset($_SESSION['libID'])) {
  echo "<script> alert(\"Please log in to edit account\"); </script>";
  echo '<meta http-equiv="refresh" content="0;url=login.php"/>';
}
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
?>	
	<form id="login-form" method="post" >	<center>
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
		</center>
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
	<h3><center>Click "Deregister" to delete account</center></h3>
	<form id="login-form" method="post" >	<center>
		<input type="Submit" value="Deregister"  name="DeregisterSubmit" OnClick="return confirm('Are you sure you want to delete your account?');">
	</center></form>
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
<br><br>
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
