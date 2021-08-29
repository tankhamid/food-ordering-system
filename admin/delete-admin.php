<?php

    //include constants.php file here
    include ('../config/constants.php');


    //1.Get the id of Admin to be deleted
    $id = $_GET['id'];

    //2.Create SQL query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn,$sql);

     //Check whether query executed successfully
    if ($res == true)
    {
        //Query Executed Successfully and Admin Deleted
       // echo "Admin Deleted";
        //Create SESSION Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
        //Redirecting to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
        {
            //Failed to delete Admin
            //echo "Failed to delete Admin"
            echo "<div class='error'>Failed to delete Admin. Please try again later.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');

        }

    //3.Redirect to Manage Admin page with message (success/error)



?>
