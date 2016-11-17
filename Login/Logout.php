<?php

include('Config.php');
include('session.php');

session_start();

$_SESSION = array();
unset($_COOKIE); //destroy cookies and sessions
unset($_SESSION);

//update userlog table with logout times
$sql_users = "UPDATE 
                test_db.UserLog 
                SET 
                test_db.UserLog.TimeLoggedOut = now() 
                WHERE 
                test_db.UserLog.Operator = '$login_session' and
                test_db.UserLog.TimeLoggedIn < now() order by test_db.UserLog.TimeLoggedIn desc limit 1"; //a log of users that have logged out this app
mysqli_query($db, $sql_users); //execute the statement

session_destroy(); //completely destroy the session



header("Location: ../Login/Login.php"); //redirect to login page
?>
