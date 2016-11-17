<?php
   include('Config.php');
   session_start();
   header("refresh: 361;");
   
   $user_check=$_SESSION['login_user'];
   
   $ses_sql=mysqli_query($db,"select username from users where username='$user_check' ");
   
   $row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session=$row['username'];
   //echo $login_session;
   
   if (isset($_SESSION["login_user"])) {// ensures user times out after a certain time
    if ((time() - $_SESSION['last_time']) > 1800) { //time in secconds
        header("location:../Login/Logout.php");
    } else {
        $_SESSION['last_time'] = time();
    }
} else {
    header("location:../Login/Logout.php");
}
?>
