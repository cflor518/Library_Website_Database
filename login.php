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
  <nav class="navbar navbar-expand-lg navbar-light">
         <a class="navbar-brand" href="#"><p class="ab"><img src="SABC.png" width ="50px">SABC Library</p></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav mr-auto">

           </ul>
           <ul class="navbar-nav">
             <li class="nav-item active">
               <a href="http://localhost:8888/libwelcome.php" class="nav-link ac" href=""><p class="a">Home</p></a>
             </li>
             <li class="nav-item">
               <a href="http://localhost:8888/login.php" class="nav-link" href=""><p class="a">Login</p></a>
             </li>
             <li class="nav-item">
               <a href="http://localhost:8888/libregister.php" class="nav-link" href=""><p class="a">Sign Up</p></a>
             </li>
             <li class="nav-item">
               <a href="http://localhost:8888/libderegister.php" class="nav-link" href=""><p class="a">Unsubscribe</p></a>
             </li>
             <li class="nav-item">
               <a href="" class="nav-link" href=""><p class="a">Book Search</p></a>
             </li>
             <li class="nav-item">
               <a href="http://localhost:8888/checkout.php" class="nav-link" href=""><p class="a">Checkout</p></a>
             </li>
             <li class="nav-item">
               <a href="http://localhost:8888/libwelcome.php" class="nav-link" href=""><p class="a">Sign Out</p></a>
             </li>
           </ul>
         </div>
       </nav>

  </header>
</head>
<body id="body_bg">
<div <div align="center">

<!-- br><br><br><br><br><br> -->

<div class="container">

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="https://sipri.org/sites/default/files/styles/body_embedded/public/2018-01/dsc_0155_1.jpg?itok=S1ACqEI_" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
               <h3 class="h3-responsive">Slight mask</h3>
               <p>First text</p>
           </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://sipri.org/sites/default/files/styles/body_embedded/public/2018-01/dsc_0155_1.jpg?itok=S1ACqEI_" alt="Second slide">
        <div class="carousel-caption">
               <h3 class="h3-responsive">Slight mask</h3>
               <p>Second text</p>
           </div>

      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://sipri.org/sites/default/files/styles/body_embedded/public/2018-01/dsc_0155_1.jpg?itok=S1ACqEI_" alt="Third slide">
        <div class="carousel-caption">
               <h3 class="h3-responsive">Slight mask</h3>
               <p>Third text</p>
           </div>

      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</div>
<br><br>
<h1>SABC Library Login</h1><br>
    <form id="login-form" method="post" action="authen_login.php" >
        <table border="0.5" >

            <tr>
                <td><label for="fname">First Name</label></td>
                <td><input type="text" name="fname" id="fname"></td>
            </tr>
            <tr>
                <td><label for="lname">Last Name</label></td>
                <td><input type="text" name="lname" id="lname"></td>
            </tr>
            <tr>
                <td><label for="libID">Library ID</label></td>
                <td><input type="libID" name="libID" id="libID"></input></td>
            </tr>

            <tr>

                <td><input type="submit" value="Submit" />
                <td><input type="reset" value="Reset"/>

            </tr>
        </table>

    </form>
		</div>
        <br><br><br><br><br>
<section id="footer" style="background:rgb(107,142,165)">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                    <p> &copy; SABC 2018</p>
                    <p>ALL RIGHT RESERVED</p>
                </div>

            </div>
        </div>
    </section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</div>
</html>
