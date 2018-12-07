<?php
session_start();
?>
<!DOCTYPE html>
<html><head>
<title>SABC Library</title>
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
<h1><center>Welcome back to the SABC Library!</center></h1>
 <br>
<h3><center>What would you like to do?</center></h3>
 <br><br><br>
<table style="width:70%" align="Center">
  
<?php
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
$sql = "SELECT * FROM reserves where libID = " . $currentUserID ;
$result = $conn->query($sql);
	$count = 0;
	echo "<form action=\"\" method=\"post\" action=\"loggedin.php\">";
        //For every entry in the reserves table for this user, we dynamically write a table
        //entry for the row on the page in HTML by echoing HTML syntax in php.
	while($row = $result->fetch_assoc()){
	  $returnUsersBooksSQL = "SELECT * FROM books where ISBN = " . $row["ISBN"];
	  $returnUsersResult = $conn->query($returnUsersBooksSQL);
	  $booksrow = $returnUsersResult->fetch_assoc();
	  echo "<tr><td>". $booksrow["title"] . "</td>";
	  echo "<td>". $booksrow["fauthor"] . " " . $booksrow["lauthor"] . "</td>";
	  echo "<td>". $booksrow["ISBN"] . "</td>";
	  echo "<td><input type=\"submit\" value=\"Return\" name=\"Button[". $count . "]\"</td></tr>";
	  $count++;
	}
	echo "</form>";
        //Did some sort of button array to know which button was clicked and marked for 
        //deletion. This if knows what "return" button was pushed.
	if($_POST['Button']){
	  $rowIndexToDelete = key($_POST['Button']);
	  $ISBNToDelete; 
	  $titleToDelete;
          //I know which row in the associative array I want but I dont know how to
          //index that row directly so what happens here is that we iterate through
          //the whole table again but this time we have an index for the row we want
          //to delete and we catch with an if to collect the ISBN. 
	  $sql = "SELECT * FROM reserves where libID = " . $currentUserID ;
	  $result = $conn->query($sql); 
	  $SecondIterationCount = 0;
	  while($row = $result->fetch_assoc()){
	    $returnUsersBooksSQL = "SELECT * FROM books where ISBN = " . $row["ISBN"];
	    $returnUsersResult = $conn->query($returnUsersBooksSQL);
	    $booksrow = $returnUsersResult->fetch_assoc();
	    if($SecondIterationCount == $rowIndexToDelete){
		$titleToDelete = $booksrow["title"];
		$ISBNToDelete = $booksrow["ISBN"];
	    }
	    $SecondIterationCount++;
	  }
          //Finaly we delete that stinky row. 
	  $delete_sql = "DELETE FROM reserves WHERE ISBN = " . $ISBNToDelete;
	  if($conn->query($delete_sql) === TRUE){
	    echo "<center><b>Give me a sec while I return " . $titleToDelete . "...</b></center>" ;	
	    echo '<meta http-equiv="refresh" content="3"/>';
	  }else{
	    echo "Error: " . $delete_sql."<br>" .$conn->error;
	  }
	}//End Button Push
	?>
	</table>

    <form id="login-form" ><center>

		<input type="button" value="Check out a book" onclick="window.location.href='checkout.php'" />
		<input type="button" value="Edit Account Info" onclick="window.location.href='editaccount.php'" />
		<br><br>
		<input type="button" value="Log out" onclick="window.location.href='logout.php'" />
		<input type="button" value="Delete Account" onclick="window.location.href='libderegister.php'" />
		</center>
	</form>
</div>
 <br><br><br><br><br><br>
  <br><br><br><br>
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
