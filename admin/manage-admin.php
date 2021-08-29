<?php include ('partials/menu.php') ?>


<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ADMIN</h1>
        <br> <br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // Displaying Session Message
                unset($_SESSION['add']); //Removing Session Message after being displayed
            }

            if (isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if (isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);

            }

            if (isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

        if (isset($_SESSION['change-pwd']))
        {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }

        ?>
        <br> <br> <br>

        <!-- Button to Add Admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br> <br> <br>

        <table class="tbl-full">
            <tr>
                <th>S/N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                //Query to Get all Admin from database
                $sql = "SELECT * FROM tbl_admin";

                //Execute the Query
                $res = mysqli_query($conn,$sql);

                //Check whether the Query is Executed or Not
                if ($res==true){
                    //Count rows to check whether we have data in the database
                    $rows = mysqli_num_rows($res); // Function to get all the row in the database

                    $sn = 1; // Create a variable and assign the value : so as to follow order in the id numbering


                    //Check the number of rows
                    if ($rows > 0){
                        // We have data in the database
                        while ($rows =mysqli_fetch_assoc($res)){
                            //while loop to get all data from database
                            // while loop will run as long as we have data in the database

                            //Get individual data
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            //Display the values in our table
                            ?>


                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>




                            <?php

                        }

                    }
                    else
                        {
                        //No data in the database
                    }
                }
            ?>





        </table>

    </div>
</div>
<!-- Main Content Section Ends-->

<?php include ('partials/footer.php')?>