<?php
session_start();
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="loggedin.css">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<body id="body_bg">
<div <div align="center">
<br><br><br><br><br>
<h1>Welcome back to the SABC Library!</h1>
<h3>What would you like to do?</h3>
<table style="width:70%">
  <tr>
    <th>Title</th>  
    <th>Author</th>  
    <th>ISBN</th>  
    <th>Return</th>  
  </tr>
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
$sql = "SELECT * FROM reserves where libid = " . $currentUserID ;
$result = $conn->query($sql);
	$count = 0;
	echo "<form action=\"\" method=\"post\" action=\"loggedin.php\">";
        //For every entry in the reserves table for this user, we dynamically write a table
        //entry for the row on the page in HTML by echoing HTML syntax in php.
	while($row = $result->fetch_assoc()){
	  $returnUsersBooksSQL = "SELECT * FROM books where isbn = " . $row["isbn"];
	  $returnUsersResult = $conn->query($returnUsersBooksSQL);
	  $booksrow = $returnUsersResult->fetch_assoc();
	  echo "<tr><td>". $booksrow["title"] . "</td>";
	  echo "<td>". $booksrow["fauthor"] . " " . $booksrow["lauthor"] . "</td>";
	  echo "<td>". $booksrow["isbn"] . "</td>";
	  echo "<td><input type=\"submit\" value=\"Return\" name=\"Button[". $count . "]\"</td></tr>";
	  $count++;
	}
	echo "</form>";
        //Did some sort of button array to know which button was clicked and marked for 
        //deletion. This if knows what "return" button was pushed.
	if($_POST['Button']){
	  $rowIndexToDelete = key($_POST['Button']);
	  $isbnToDelete; 
	  $titleToDelete;
          //I know which row in the associative array I want but I dont know how to
          //index that row directly so what happens here is that we iterate through
          //the whole table again but this time we have an index for the row we want
          //to delete and we catch with an if the isbn. 
	  $sql = "SELECT * FROM reserves where libid = " . $currentUserID ;
	  $result = $conn->query($sql); 
	  $SecondIterationCount = 0;
	  while($row = $result->fetch_assoc()){
	    $returnUsersBooksSQL = "SELECT * FROM books where isbn = " . $row["isbn"];
	    $returnUsersResult = $conn->query($returnUsersBooksSQL);
	    $booksrow = $returnUsersResult->fetch_assoc();
	    if($SecondIterationCount == $rowIndexToDelete){
		$titleToDelete = $booksrow["title"];
		$isbnToDelete = $booksrow["isbn"];
	    }
	    $SecondIterationCount++;
	  }
          //Finaly we delete that stinky row. 
	  $delete_sql = "DELETE FROM reserves WHERE isbn = " . $isbnToDelete;
	  if($conn->query($delete_sql) === TRUE){
	    echo "Give me a sec while I return " . $titleToDelete;	
	    echo '<meta http-equiv="refresh" content="3" />';
	  }else{
	    echo "Error: " . $delete_sql."<br>" .$conn->error;
	  }
	}//End Button Push
	?>
	</table>

    <form id="login-form" >

		<input type="button" value="Check out a book" onclick="window.location.href='checkout.php'" />
		<input type="button" value="Return a book" onclick="window.location.href='return.php'" />
		<br><br>
		<input type="button" value="Log out" onclick="window.location.href='logout.php'" />
		<input type="button" value="Delete Account" onclick="window.location.href='deregister.php'" />
	</form>
</div>
</body>
<br><br><br><br><br><br><br><br>
<hr SIZE=20 NOSHADE WIDTH="100%">
<i>Copyright 2008-2018</i></font><br> 
<i>ALL RIGHTS RESERVED</i></font><br> 
<i>URL: http://www.sdsu.edu</i></font><br> 		
</html>
