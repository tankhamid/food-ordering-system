<?php include ('partials/menu.php')?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php

            if (isset($_SESSION['add']))
            {
                echo $_SESSION['add'];  // Display Session Message
                unset($_SESSION['add']); // Remove Session message
            }
        ?>

        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name="full_name" placeholder="Enter full name">
                </td>
            </tr>

            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" placeholder="Username">
                </td>
            </tr>

            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" placeholder="Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>


<?php include ('partials/footer.php')?>


<?php
//Process the Value from form and save it in databaase

//Check whether the submit button is clicked or not

if (isset($_POST['submit'])){
    //Button Clicked
    //echo "Button Clicked";

    //1.Get the data from form
   $full_name= $_POST['full_name'];
   $username = $_POST['username'];
   $password = md5($_POST['password']);  // Password Encryption with md5

   //2.sql query to save data to database
    $sql = "INSERT INTO tbl_admin SET 
            full_name = '$full_name',
            username = '$username',
            password = '$password'
";


    //3.Executing query and sending data into DB
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4.Checking if query is executed or not and display appropriate message
    if ($res==true){

        //Data inserted
        //echo "Data Inserted";
        //Create Session variable to display Message
        $_SESSION['add'] = "Admin Added Successfully";
        //Redirect Page TO Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');



    }
    else{
        //Failed to insert Data
        //echo "Failed to Insert Data";
        //Create Session variable to display Message
        $_SESSION['add'] = "Failed to Add Admin";
        //Redirect Page TO Add Admin
        header("location:".SITEURL.'admin/add-admin.php');


    }

}

?>
