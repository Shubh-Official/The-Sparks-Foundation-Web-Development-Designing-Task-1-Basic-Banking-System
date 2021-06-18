<?php

$Host = 'localhost';                    // Specify Hosting Typr
$Database_Username = 'Shubh';          // Specify Your Username
$Database_Password = 'Shubh@123';     // Specify Your Password
$Database_Name = 'Bank';              // Specify Database Name which you want to Connect.

$connection = mysqli_connect( $Host , $Database_Username , $Database_Password , $Database_Name ) or die("Database Not Connected");       // Creation Connection

?>