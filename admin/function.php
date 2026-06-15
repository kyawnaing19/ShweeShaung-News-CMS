<?php

include "OOP.php";
session_start();
//adminlogin validation
if(isset($_POST['role']) && isset($_POST['password']))
{
    $role=$_POST['role'];
    $password=$_POST['password'];
    $var=new database();
    $var->adminlogin($role,$password);
}

//insert Categories
if(isset($_POST['addCate'])) {
    $cateName = $_POST['addCate'];
    $insertCate=new database();
    $insertCate->insertCate($cateName);
}

//categories recycle and restore
if(isset($_GET["C_Name"]) || isset($_GET["status"])) {

    $name=$_GET["C_Name"];
    $status=$_GET["status"];
    $deleteCate=new database();
    if($status=="") {
        $deleteCate->recycleCate($name);
    }
    else{
        $deleteCate->restoreCate($name,$status);
    }

}
//delete categories
if(isset($_GET["deleteCate"])) {
    $name=$_GET["deleteCate"];
    $deleteCate=new database();
    $deleteCate->deleteCate($name);
    $deleteCate->deleteNewsByCate($name);

}
//edit categories

if(isset($_POST["editCate"])) {

    $cid = $_POST["cid"];
    $name = $_POST["editCate"];
    $var = new database();
    $var->updatecategories($cid, $name);


}
//add_subcategory

if(isset($_POST["cate"]) && isset($_POST["subcate"])){
    $cate=$_POST["cate"];
    $subcate=$_POST["subcate"];
    $var=new database();
    $var->addsubcategory($cate,$subcate);

}


//subcategory recycle and restore
if(isset($_GET["id"]))
{
    $id = $_GET["id"];

    // Ensure both parameters are not empty
         if (!empty($id))
         {
            // echo $name;

        $subRecycle = new database();
        $subRecycle->recycleSubCate($id);    
         }
    
}

//subcategory restore 
if(isset($_GET["restoreid"])) 
{
    $id = $_GET["restoreid"];
    // Ensure both parameters are not empty
         if (!empty($id))
         {
            // echo $name;
        $subRecycle = new database();
        $subRecycle->restoreSubCate($id);    
         }
    
}


//delete subcategory
if(isset($_GET["deleteid"])) 
{
    $id = $_GET["deleteid"];
    // Ensure both parameters are not empty
         if (!empty($id))
         {
            // echo $name;
        $subRecycle = new database();
        $subRecycle->deleteSubCate($id);    
         }
    
}

//edit Sub_categories
if(isset($_POST['editsub_sid']) && isset($_POST['editSub_Cate']))
{
    $sid=$_POST['editsub_sid'];
    $sub_name=$_POST['editSub_Cate'];
    $edit_subcate=new database();
    $edit_subcate->edit_Sub_Category($sid,$sub_name);
}

//report role
if(isset($_POST['Categoryname']) && isset($_POST['id'])){

    $id=$_POST['id'];
    $catename=$_POST['Categoryname'];
    $var=new database();
    $var->reporterRole($id,$catename);

}
//delete user post by main reporter
if(isset($_GET["newsid"])|| isset($_GET["dStatus"]))
{
    $id = $_GET["newsid"];
    $dStatus = $_GET["dStatus"];

    // Ensure both parameters are not empty
    if (!empty($id)|| !empty($dStatus))
    {

        $deletenews = new database();
        $deletenews->deleteuserpost($id,$dStatus);
    }


}

// Admin role delete
if(isset($_GET['adminID'])){

    $adminID=$_GET['adminID'];
    $adDelete=new database();
    $adDelete->admindelete($adminID);
}

//sub reporter post function and editor post function
if(isset($_POST["subreporterpost"]) || isset($_POST["editorPost"])) {
    if(isset($_POST["posttitle"]) && isset($_POST["category"]) && isset($_POST["subcategory"]) && isset($_POST["postdescription"]) && isset($_POST["statusValue"])) {
       $statusValue=$_POST["statusValue"];
        $newstitle = $_POST["posttitle"];
        $cate = $_POST["category"];
        $subcate = $_POST["subcategory"];
        $des = $_POST["postdescription"];
        $date = date('Y-M-d');



        //for image
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

            // Insert serialized image filenames into database
            $count=0;
$var=new database();
$var->insertnews($newstitle,$cate,$subcate,$des,$date,$serialized_images,$statusValue,$count);

        }
    }
}

//approved news by eidtor
if(isset($_POST['nid'])&& isset($_POST["catename"])){
    $cname=$_POST["catename"];
    $nid=$_POST['nid'];
    $var =new database();
    $obj=$var->uploadNews($nid,$cname);
}
//adding subReporter by admin
if(isset($_POST["setAdmin"])){
    if(isset($_POST['cate'])&& isset($_POST["password"])){
        $cate=$_POST['cate'];
        $password=$_POST['password'];
        $add=new database();
        $add->addingSubReporter($cate,$password);
    }
    //change password for sub_reporter

    if(isset($_POST["rolechange"]) && isset($_POST["npw"]) && isset($_POST["cpw"])){

        $role=$_POST["rolechange"];
        $npw=$_POST["npw"];
        $cpw=$_POST["cpw"];

     $res=new database();
       $res->changePassword($role,$cpw,$npw);
    }


}

// insert ads

if(isset($_POST['cate']) && isset($_POST['adsname'])){

    $catename=$_POST['cate'];
    $adsname=$_POST['adsname'];


    //for image
    $targetDir = "C:/wamp64/www/Php Project(ShweeShaung)/admin/adsimages/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

// Maximum number of files allowed to upload
    $maxFiles = 4; // You can adjust this number according to your requirement

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

        // Insert serialized image filenames into database
        $count = 0;
        $var = new database();
        $var->insertAds($catename, $adsname, $serialized_images);
    }

    }

if(isset($_GET['adsid'])){
    $aid=$_GET['adsid'];

    $res=new database();
    $res->deleteAds($aid);
}

//delete user feedback
if(isset($_GET['fid'])){

    $fid=$_GET['fid'];
    $obj=new database();
    $obj->deleteFeedback($fid);

}

?>