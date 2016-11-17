<?php
include("Config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT id FROM users WHERE username='$myusername' and password='$mypassword'";
    $sql_users = "insert into test_db.UserLog 
            (Operator,TimeLoggedIn)
            select 
            username, now() 
            from 
            secure_login.users 
            where 
            username = '$myusername'"; //a log of users that have logged into this app

    mysqli_query($db, $sql_users); //execute the statement

    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //$active=$row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
    if ($count == 1) {
        //session_register("myusername");
        $_SESSION['login_user'] = $myusername;
        $_SESSION['login_pass'] = $mypassword;
        $_SESSION['last_time'] = time();

        header("location: ../Welcome/welcome.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
<html>

    <head>
        <title>TIP DTS</title>
        <link href="../CSS/bootstrap.min.css" rel="stylesheet">
        <script>
            function RegisterUser() {
                //pop up window for uploading SchoolListinngs csv files
                window.open("../Register/register_user.php", "Register User", "location=1,status=1,scrollbars=1,width=400,height=400");
            }
        </script>

    </head>

    <body bgcolor="#FFFFFF">

        <div align="center" class = "form-group">
            <h1>TIP DTS</h1>
            <div style="width:300px; border: solid 1px #333333; " class = "form-group" align="left">
                <div style="background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

                <div style="margin:30px">

                    <form action="" method="post" class = "form-horizontal">
                        <label>UserName  :</label><input type="text" name="username" class="box"/><br /><br />
                        <label>Password  :</label><input type="password" name="password" class="box" /><br/><br />
                        <input class="btn btn-primary" type="submit" value=" Submit "/>

                    </form>

                    <div style="font-size:11px; color:#cc0000; margin-top:10px"></div>

                </div>

            </div>

        </div>

    </body>
</html>
