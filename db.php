<?php
//Connection variables
$server = "127.0.0.1";
$db_user_name = "root";
$db_password = "";
$db_name = "zozuk";

//MAKING Connection
$connection = mysqli_connect($server,$db_user_name,$db_password,$db_name);

if(!$connection)
{
    echo "error in connection";
}

else
{
    echo  "Connected to Database <br> <br>";
}

?>
