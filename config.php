<?php
//Connection to the Database
$servername ="localhost";
$username="root";
$password="";
$database ="notes";
//Create a connection
$conn=mysqli_connect($servername, $username, $password, $database);
//Die if connection was not successful
if(!$conn)
{
    die("It is not working".mysqli_connect_error());
}
/*else
{
    echo "Successfully !";  
}*/
    ?>