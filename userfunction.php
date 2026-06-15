<?php

include "userOOP.php";
session_start();

//Login function
if(isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];



    $var = new UserFunction();
    $var->login($email, $password);
}

//user post

if(isset($_POST["date"]) && isset($_POST["detail"])) {
    $date = $_POST["date"];
    $detail = $_POST["detail"];


    $targetDir = "C:/wamp64/www/Php Project(ShweeShaung)/admin/images/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

// Maximum number of files allowed to upload
    $maxFiles = 3; // You can adjust this number according to your requirement

// Check if number of files uploaded exceeds the maximum limit
    if (count($_FILES['files']['name']) > $maxFiles) {
        echo "You can only upload a maximum of $maxFiles images.";
    } else {
        $images_arr = array();
        foreach ($_FILES['files']['name'] as $key => $val) {
            $image_name = $_FILES['files']['name'][$key];
            $tmp_name = $_FILES['files']['tmp_name'][$key];
            $size = $_FILES['files']['size'][$key];
            $type = $_FILES['files']['type'][$key];
            $error = $_FILES['files']['error'][$key];

            // File upload path
            $targetFilePath = $targetDir . $image_name;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Store images on the server
                if (move_uploaded_file($tmp_name, $targetFilePath)) {
                    // Add image filename to the array
                    $images_arr[] = $image_name;
                }
            }
        }

        // Serialize the array of image filenames
        $serialized_images = serialize($images_arr);


        $var = new UserFunction();
        $var->userpost($date, $detail,$serialized_images);
    }
}

//user logout
if(isset($_GET['logout'])){
    unset($_SESSION['user']);
    header("Location: Home.php");
}

//add subscribe
if(isset($_GET['catesubscribe']) && isset($_GET['idsubscribe']))
{
    $id=$_GET['idsubscribe'];
    $cate=$_GET['catesubscribe'];

  $sub=new UserFunction();

   $sub->addSub($id,$cate);

}


//unsubscribe from subscribe page
if(isset($_GET['idunsubscribe']) && isset($_GET['cateunsubscribe']) && isset($_GET['userid']))
{
   $id=$_GET['idunsubscribe'];
   $cname=$_GET['cateunsubscribe'];
   $userid=$_GET['userid'];

   $unsub=new UserFunction();
   $unsub->unsub($id,$cname,$userid);
}

//user profile edit
if(isset($_POST['username']) && isset($_POST['updatepassword']) && isset($_POST['currentpassword']) && isset($_POST['password']))
{
    $obj=new UserFunction();
    $obj->userEdit($_POST['username'],$_POST['updatepassword'],$_POST['currentpassword'],$_POST['password']);

}

//delete account by users
if(isset($_GET['deleteaccbyid'])){

    $userid=$_GET['deleteaccbyid'];
    $obj=new UserFunction();
    $obj->deleteaccbyuser($userid);

}
if( isset($_POST['feedback'])) {
    if (isset($_POST['uname']) && isset($_POST['uemail']) && isset($_POST['umessage'])) {
        $name = $_POST['uname'];
        $email = $_POST['uemail'];
        $message = $_POST['umessage'];
        $obj = new UserFunction();
        $obj->feedback($name, $email, $message);
    }
}


?>