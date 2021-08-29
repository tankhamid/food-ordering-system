<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br> <br>

        <?php

        if (isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <br> <br>
        <!-- Add category form starts -->
        <!--enctype : to upload file image -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>

                </tr>


                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <!-- Add category form ends -->

        <?php

        //Checking whether the submit button is clicked
        if (isset($_POST['submit']))
        {
             echo "Clicked";

            //1. Get the value from category form
           $title = $_POST['title'];
         //   $featured = $_POST['featured'];
        //    $active = $_POST['active'];


           if (isset($_POST['featured']))
           {
               $featured = $_POST['featured'];
           }
           else{
               $featured ="No";
               }

           if (isset($_POST['active']))
           {
               $active = $_POST['active'];
           }
           else{
               $active = "No";
           }

           //Check whether the image is selected or not and set the value for image name accordingly
            //print_r($_FILES['image']);

           //die(); //Break the code Here

            if (isset($_FILES['image']['name']))
            {
                //upload the image
                //To upload image we need image name, source path and destination
                $image_name = $_FILES['image']['name'];
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;

                //Finally Upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //Check whether the image is uploaded or not
                //And if the image is not uploaded then we will stop the process and redirect with error message
                if ($upload==false)
                {
                    //SET message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";
                    //Redirect to Add category page
                    header('location:'.SITEURL.'admin/add-category.php');
                    //Stop the process
                    die();

                }

            }
            else
            {
                //Don't upload image and set the image_name value as blank
                $image_name = "";

            }




           //2. Create SQL Query to Insert into database
            $sql = "INSERT INTO tbl_category SET 
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
             
             ";

           //3. Execute the Query and save in DB
            $res = mysqli_query($conn,$sql);

            //4. check whether the query executed or not and data added or not
            if ($res==true)
            {
                //Query executed and category added
                $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
                //Redirecting to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');


            }
            else
            {
                //Failed to Add category
                $_SESSION['add']="<div class='error'>Failed to Add Category</div>";
                //Redirecting to manage category page
                header('location:'.SITEURL.'admin/add-category.php');


            }

        }

        ?>

    </div>

</div>















<?php include('partials/footer.php');?>