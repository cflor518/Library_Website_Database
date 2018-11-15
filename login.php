<?php
session_start();
?>

<!DOCTYPE html >
<html>
<head>
<title>SABC Library Login</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="body_bg">
<div <div align="center">
<br><br><br><br><br>
<h1>SABC Library Login</h1><br><br>
    <form id="login-form" method="post" action="authen_login.php" >
        <table border="0.5" >
                <a href="libwelcome.php">Home</a>
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
<br><br><br><br><br><br><br><br>
<hr SIZE=20 NOSHADE WIDTH="100%">
<br>
<i>Copyright 2008-2018</i></font><br> 
<i>ALL RIGHTS RESERVED</i></font><br> 
<i>URL: http://www.sdsu.edu</i></font><br> 		
</body>
</html>