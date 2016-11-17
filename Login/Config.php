<?php
   define('DB_SERVER', 'localhost');
   //define('DB_PORT', 3306);
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'toor');
   define('DB_DATABASE', 'secure_login');
   $db = mysqli_connect/*("localhost","tip","tip","secure_login",3306);*/(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if (mysqli_connect_error())
	{
	echo "Failed to Connect to Mysql: " . mysqli_connect_error();
	}
?>
