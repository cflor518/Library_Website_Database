<h3>Books Available for checkout:</h3>

<?php
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

$sql = "SELECT * FROM books WHERE ISBN NOT IN (SELECT ISBN FROM reserves);";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Title: " . $row["title"]. " LAST NAME: " . $row["lauthor"]. "<br><br>";
    }
} 
else {
    echo "0 results";
}
$conn->close();
?>

<h3>What book would you like to check out?</h3>
<!DOCTYPE html>
<html>
<head>
<title>BOOK CHECKOUT</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="body_bg">
<div <div align="left">

    <form id="login-form" method="post" action="authen_CHbook.php" >
        <table border="0.5" >
            <tr>
                <td><label for="title">Book Title</label></td>
                <td><input type="text" name="title" id="title"></td>
            </tr>
            <tr>
                <td><label for="lauthor">Author Last Name</label></td>
                <td><input type="text" name="lauthor" id="lauthor"></input></td>
            </tr>		
            <tr>		
                <td><input type="submit" value="Submit" />
                <td><input type="reset" value="Reset"/>
            </tr>
        </table>
    </form>
		</div>
<form id="login-form" >
	<input type="button" value="Return book" onclick="window.location.href='loggedin.php'" />
	<input type="button" value="Edit Account Info" onclick="window.location.href='editaccount.php'" />
	<br><br>
	<input type="button" value="Log out" onclick="window.location.href='logout.php'" />
	<input type="button" value="Delete Account" onclick="window.location.href='deregister.php'" />
	</form>
</body>
</html>
