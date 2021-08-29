<?php include ('../config/constants.php')?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">

    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
            if (isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION[';login']);

            }

            if (isset($_SESSION['no-login-message']))
            {

                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }


            ?>
            <br><br>

            <!--Login form starts here -->
            <form action="" method="post" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter username"><br><br>

                Password:<br>
                <input type="password" name="password" placeholder="Enter password"> <br><br>

                <input type="submit" name="submit" value="login" class="btn-primary">
            </form>
            <br><br>


            <!--Login form ends here -->

            <p class="text-center">Created By -<a href="www.hamidtanko.com">Hamid Tanko</a> </p>

        </div>

    </body>
</html>

<?php

        //Check whether the submit button is Clicked or Not
if (isset($_POST['submit'])){

    //Process for login
    //1. Get the Data from Login form
    $username = $_POST['username'];
    $password =md5( $_POST['password']);

    //2. Sql to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";

    //3. Execute the query
    $res = mysqli_query($conn,$sql);

    //4.Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count==1)
    {
        //user Available and login success
        $_SESSION['login']="<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it


        //Redirecting to homepage/ dashboard
        header('location:'.SITEURL.'admin/index.php');

    }
    else
    {
        //User not Available and login fail
        $_SESSION['login']="<div class='error text-center'>Username or password did not match</div>";
        //Redirecting to homepage/ dashboard
        header('location:'.SITEURL.'admin/login.php');
    }


}




?>
