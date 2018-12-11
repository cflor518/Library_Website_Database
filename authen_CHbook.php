<?php
    session_start();
?>

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
<div <div align="center">
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
                echo "Book is yours!";
                //header('Location: checkout.php');
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    ?>
</div>


<br><br><br><br><br><br><br><br><br>
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


