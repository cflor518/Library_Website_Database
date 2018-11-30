<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (isset($_POST['title']) and isset($_POST['lauthor'])) {
	
// Assigning POST values to variables.
$title = $_POST['title'];
$lauthor = $_POST['lauthor'];
$libID = $_SESSION['libID'];

$checkUsersBooksSQL = "SELECT ISBN FROM books WHERE title = '$title'";
$checkUsersResult = $conn->query($checkUsersBooksSQL);
$booksrow = $checkUsersResult->fetch_assoc();
$ISBN = $booksrow["ISBN"];

// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM `reserves` WHERE ISBN = '$ISBN'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$count = mysqli_num_rows($result);

if ($count >= 1){
	echo "Book is checked out";	
	header('Location: checkout.php');
}
else if($count == 0) {	
	//insert the values into the table 
	$sql = "INSERT INTO reserves (libID, ISBN) VALUES ('$libID', '$ISBN')";
	
	if ($conn->query($sql) === TRUE) {
		echo "Book is yours! Would you like to checkout a new one?";
		//header('Location: checkout.php');
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
}
?>

<form id="login-form" >
	<br><br>
	<input type="button" value="Return book" onclick="window.location.href='loggedin.php'" />
	<input type="button" value="Check Out a New book" onclick="window.location.href='checkout.php'" />
	<input type="button" value="Edit Account Info" onclick="window.location.href='editaccount.php'" />
	<br><br>
	<input type="button" value="Log out" onclick="window.location.href='logout.php'" />
	<input type="button" value="Delete Account" onclick="window.location.href='deregister.php'" />
	</form>
	
