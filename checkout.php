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
        echo "TITLE: " . $row["title"]. " <br> LAST NAME: " . $row["lauthor"]. "<br><br>";
    }
} 
else {
    echo "0 results";
}
$conn->close();
?>

<h3>What book would you like to check out?</h3>

<!-- this file is going to show people what books have not been checked out, 
and allow them to check out one of the books, it will do this by addign the 
ISBN of the book and the libID of the user into the reserves table. -->
