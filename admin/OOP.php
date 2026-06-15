<?php

//session_start();
class database
{


    public $con;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shweeshaung";

        $this->con = new mysqli($servername, $username, $password, $dbname);
        if ($this->con->connect_error) {
            die("Connection fail : " . $this->con->connect_error);
        }

    }

    //admin login validation
    public function adminlogin($role, $password)
    {
        $stmt = $this->con->prepare("SELECT * FROM adminrole WHERE role=? AND Binary password=?");
        $stmt->bind_param("ss", $role, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $rol = $result->fetch_assoc()['role'];

        if ($result->num_rows > 0) {
            if ($rol == "admin") {
                header("Location: dashboard.php");
            } else if ($role == "reporter") {
                header("Location: Mian_Reporter.php");
            } else if ($rol == "editor") {
                $_SESSION["editor"] = $rol;
                header("Location: editor.php");
            } else {
                $_SESSION["subreporter"] = $rol;
                header("Location: Sub_Reporter.php");
            }

        } else {
            $_SESSION["adminfail"] = "Login Fail!";
            header("Location: admin_login.php");
        }

        $stmt->close();
        $this->con->close();

    }


    //get categories
    public function getcategories()
    {
        $stmt = $this->con->prepare("SELECT * FROM cate WHERE Status=''");
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set

        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        return $result; // Return the result set
    }


    public function selectcategories()
    {
        $stmt = $this->con->prepare("SELECT * FROM cate WHERE Status=''");
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set
        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        return $result; // Return the result setf
    }

//Select sub categories
    public function selectsubcategories($cname)
    {
        $stmt = $this->con->prepare("SELECT * FROM sub_category WHERE C_Name=? AND status='A'");
        $stmt->bind_param("s", $cname);
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set
        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        return $result; // Return the result set
    }

    //get Recycle categories
    public function getRecycleCategories()
    {
        $stmt1 = $this->con->prepare("SELECT * FROM cate WHERE Status='R'");

        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $stmt1->close(); // Close the statement
        $this->con->close();
        return $result1; // Return the result set
    }


//insert cate
    public function insertCate($cateName)
    {

        $stmt = $this->con->prepare("SELECT * FROM cate WHERE C_Name=?");
        $stmt->bind_param("s", $cateName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION["cateErr"] = "Categories already exist!";
            header("Location:add_categories.php");

        } else {
            $status = "";
            $stmt = $this->con->prepare("INSERT INTO cate (C_Name,Status) VALUES (?,?)");
            $stmt->bind_param("ss", $cateName, $status);
            $stmt->execute();
            $_SESSION["cateCorr"] = "New Category add successfully";
            header("Location:add_categories.php");
            $stmt->close();
            $this->con->close();

        }
    }

// delete category to recycle category
    public function recycleCate($name)
    {
        // session_start();
        $stmt1 = $this->con->prepare("UPDATE cate SET Status='R' WHERE C_Name=? AND Status=''");
        $stmt1->bind_param("s", $name);
        $stmt1->execute();
        header("Location:add_categories.php");
        $stmt1->close();
        $this->con->close();

    }

    //restore cate
    public function restoreCate($name, $status)
    {

        // session_start();
        $stmt1 = $this->con->prepare("UPDATE cate SET Status='' WHERE C_Name=? AND Status=?");
        $stmt1->bind_param("ss", $name, $status);
        $stmt1->execute();
        header("Location:add_categories.php");
        $stmt1->close();
        $this->con->close();

    }

//    delete function
    public function deleteCate($name)
    {
        // session_start();
        $stmt1 = $this->con->prepare("DELETE FROM cate WHERE C_Name=?");
        $stmt1->bind_param("s", $name);
        $stmt1->execute();
        header("Location:add_categories.php");
        $stmt1->close();
        $this->con->close();

    }


//    update categories
    public function updatecategories($cid, $name)
    {
        $stmt = $this->con->prepare("SELECT * FROM cate WHERE BINARY C_Name=?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION["catenameError"] = "Category name is already exist!";
            header("Location:add_categories.php");
        } else {
            $stmt = $this->con->prepare("UPDATE cate set C_Name=? WHERE CID=?");
            $stmt->bind_param("ss", $name, $cid);
            $stmt->execute();
            $_SESSION["catenameSuccess"] = "Category name change successfully.";
            header("Location:add_categories.php");
            $stmt->close();
            $this->con->close();
        }
    }

    //add sub category

    public function addsubcategory($cate, $subcate)
    {
        //   session_start();
        $stmt = $this->con->prepare("SELECT * FROM sub_category WHERE BINARY sub_name=?");
        $stmt->bind_param("s", $subcate);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION["cateError"] = "Sub Categories already exist!";
            header("Location:add_Subcategories.php");
        } else {
            $stmt = $this->con->prepare("INSERT INTO sub_category (C_Name,sub_name,Status) VALUES (?,?,?)");
            $status = "A";
            $stmt->bind_param("sss", $cate, $subcate, $status);
            $stmt->execute();
            $_SESSION["cateSuccess"] = "Sub Category add successfully.";
            $stmt->close();
            $this->con->close();
            header("Location:add_Subcategories.php");
        }
    }

//show sub category
    public function showsubcategory($cate)
    {


        // if($cate=="")
//{
//       $stmt = $this->con->prepare("SELECT sub_category.sub_name,sub_category.sid FROM sub_category,cate WHERE cate.Status='' AND sub_category.C_Name=cate.C_Name AND sub_category.Status='A'"); 
//}


        $stmt = $this->con->prepare("SELECT cate.C_Name, sub_category.sub_name, sub_category.sid 
FROM sub_category 
INNER JOIN cate ON sub_category.C_Name = cate.C_Name 
WHERE sub_category.C_Name = ? 
AND cate.Status = '' 
AND sub_category.Status = 'A';
");
        $stmt->bind_param("s", $cate);


        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        return $result;

    }


    public function showoversubcategory()
    {
        // if($cate=="")
//{
        $stmt = $this->con->prepare("SELECT sub_category.sub_name,sub_category.sid FROM sub_category,cate WHERE cate.Status='' AND sub_category.C_Name=cate.C_Name AND sub_category.Status='A'");
//}
//else
//{
        //  $stmt = $this->con->prepare("SELECT sub_category.sub_name,sub_category.sid FROM sub_category,cate WHERE sub_category.C_Name=? AND cate.Status='' AND sub_category.C_Name=cate.C_Name AND sub_category.Status='A'");
        //  $stmt->bind_param("s", $cate);
//}

        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        return $result;

    }

//recycle scbcategory     
    public function recycleSubCate($id)
    {
        // session_start();
        $stmt1 = $this->con->prepare("UPDATE sub_category SET Status='R' WHERE sid=?");
        $stmt1->bind_param("d", $id);
        $stmt1->execute();

        $stmt1->close();
        $this->con->close();


        header("Location: add_Subcategories.php");
        exit();

    }

    //restore subcategory
    public function restoreSubCate($id)
    {

        // session_start();
        $stmt1 = $this->con->prepare("UPDATE sub_category SET Status='A' WHERE sid=?");
        $stmt1->bind_param("d", $id);
        $stmt1->execute();
        header("Location:add_Subcategories.php");
        $stmt1->close();
        $this->con->close();

    }

    public function recycle_Show_SubCategory()
    {
        $stmt = $this->con->prepare("SELECT * FROM sub_category WHERE Status='R'");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->con->close();
        return $result;
        header("Location:add_Subcategories.php");
        exit();
    }


    //delete subcategory
    public function deleteSubCate($id)
    {
        $stmt = $this->con->prepare("DELETE FROM sub_category WHERE sid=?");
        $stmt->bind_param("d", $id);
        $stmt->execute();
        header("Location:add_Subcategories.php");
        $stmt->close();
        $this->con->close();
    }

    //edit Sub_category
    public function edit_Sub_Category($sid, $sub_name)
    {
        $stmt = $this->con->prepare("SELECT * FROM sub_category WHERE BINARY sub_name=?");
        $stmt->bind_param("s", $sub_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION["subcateErr"] = "Sub Category name is already exist!";
            header("Location:add_categories.php");
        } else {
            $stmt = $this->con->prepare("UPDATE  sub_category SET sub_name=? WHERE sid=?");
            $stmt->bind_param("sd", $sub_name, $sid);
            $stmt->execute();
            $_SESSION["subcateCorr"] = "Sub Category name change successfully.";
            $stmt->close();
            $this->con->close();
            header("Location:add_Subcategories.php");
        }


    }

//show pending news
    public function getpendingnews()
    {
        $stmt = $this->con->prepare("SELECT * FROM news WHERE status='N' "); //Pending News from Users
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set
        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        return $result; // Return the result set
    }

    //show confirm news
    public function getConfirmnews()
    {
        $stmt = $this->con->prepare("SELECT * FROM news WHERE status='C' "); //Confirm for News Type
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set
        $stmt->close(); // Close the statement
        //$this->con->close(); // Close the connection
        return $result; // Return the result set
    }

//reporter role
    public function reporterRole($id, $catename)
    {

        $stmt = $this->con->prepare("UPDATE news SET category = ?, status='C' WHERE id =? AND status='N' ");
        $stmt->bind_param("sd", $catename, $id);
        $stmt->execute();
        $_SESSION['reporterrole'] = "News Send Successfully to " . ucfirst($catename) . " Admin";
        $stmt->close();
        $this->con->close();
        header("Location: Mian_Reporter.php");
    }

//delete user post by main reporter
    public function deleteuserpost($id, $dStatus)
    {
        session_start();
        $stmt = $this->con->prepare("DELETE FROM news WHERE id=?");
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $stmt->close();
        $this->con->close();

        if ($dStatus == "E" || $dStatus == 'U') {
            $_SESSION['deletesuccess'] = "Delete post successfully.";
            header("Location: editor.php ");
        } else {
            $_SESSION['deletesuccess'] = "Delete post successfully.";
            header("Location: Mian_Reporter.php");

        }

    }

// delete admin
    public function admindelete($adminID)
    {
        $stm = $this->con->prepare('delete from adminrole where id=?');
        $stm->bind_param('d', $adminID);
        $stm->execute();
        $stm->close();
        $this->con->close();
        header('location: staff.php');
    }


//insert image function
    public function insertnews($newstitle, $cate, $subcate, $des, $date, $serialized_images, $statusValue, $count)
    {
        // session_start();
        $stmt = $this->con->prepare("INSERT into news (date,description,detail,image,category,sub_category,status,count) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssd", $date, $newstitle, $des, $serialized_images, $cate, $subcate, $statusValue, $count);
        $stmt->execute();
        $stmt->close();
        $this->con->close();
        if ($statusValue == "E") {
            $_SESSION['postsuccess'] = "Post Success";
            header("Location: Sub_Reporter.php");
        } else {
            $_SESSION['postsuccess'] = "Post Success";
            header("Location: editor.php");
        }

    }

//getting news by sub reporter
    public function getnewsbySubReporter($role)
    {
        $stmt = $this->con->prepare("SELECT * FROM news WHERE status<>'C' AND category='$role'"); //Pending News from Users
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set
        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        return $result;
    }

//
    public function getnewsbyEditor($role)
    {
        $stmt = $this->con->prepare("SELECT * FROM news WHERE status='U' AND category='$role'"); //Pending News from Users
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set
        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        return $result;
    }

//get news from users to sub reporter
    public function getnewsFromUsers($role)
    {

        $stmt = $this->con->prepare("SELECT * FROM news WHERE status='C' AND category='$role'"); //Pending News from Users
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set
        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        return $result;

    }

//get news for eidtors by category
    public function getnewsbyEidtors($cname)
    {
        $stmt = $this->con->prepare("SELECT * FROM news WHERE (status='E' OR status='U') AND category=?"); //Pending News from Users
        $stmt->bind_param("s", $cname);
        $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set
        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        return $result;
    }

//upload news by eidtors
    public function uploadNews($nid, $cname)
    {
        $stmt = $this->con->prepare("UPDATE news SET status='U' WHERE id='$nid'"); //Pending News from Users
        $stmt->execute();

        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        header("Location: editor.php?cname=$cname");
    }

    /*public function categorycount($catename)
    {
        $stmt = $this->con->prepare("SELECT COUNT(id) FROM news WHERE category='$catename' AND status='E'"); //Pending News from Users
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close(); // Close the statement
        $this->con->close(); // Close the connection
        return $result;
    }*/


    public function categorycount($catename)
    {
        $stmt = $this->con->prepare("SELECT COUNT(id) as count FROM news WHERE category=? AND status='E'");
        $stmt->bind_param("s", $catename);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];
        $stmt->close();
        return $count;
    }

    public function addingSubReporter($cate, $password)
    {
        $stmt = $this->con->prepare("SELECT * FROM adminrole  WHERE Binary password=?");
        $stmt->bind_param("s", $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION["adminExit"] = "Sub_Reporter already exist!";

            header("Location:staff.php");

        } else {
            $stmt = $this->con->prepare("insert into adminrole (role,password)values (?,?)");
            $stmt->bind_param("ss", $cate, $password);
            $stmt->execute();
            $stmt->close();
            $this->con->close();
            header("location:staff.php");

        }

    }

    //getting info by admin
    public function getAdminInfo()
    {
        $stmt = $this->con->prepare('select * from adminrole ');
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
        $stmt->close();

        header("Location: staff.php");
    }

    // get admin role
    public function getAdminRole()
    {
        $stm = $this->con->prepare('select * from adminrole where role <> "admin" and  role <> "reporter" and  role <> "editor" ');
        $stm->execute();
        $result = $stm->get_result();
        return $result;
        $stm->close();

        header("Location: staff.php");


    }

    public function changePassword($role, $cpw, $npw)
    {
        $stm = $this->con->prepare("update adminrole set password=? where id=? and password=?");
        $stm->bind_param("sds", $npw, $role, $cpw);
        $stm->execute();
        $stm->close();
        $this->con->close();
        header("location: staff.php");
    }

//count user

    public function user()
    {
        $smt = $this->con->prepare("SELECT * FROM user");
        $smt->execute();
        $result = $smt->get_result();
        return $result;
        $smt->close();
        $this->con->close();
        header("location: dashboard.php");
    }

// insert ads
    public function insertAds($catename, $adsname, $image)

    {
        $stmt = $this->con->prepare("SELECT * FROM ads  WHERE C_Name=?");
        $stmt->bind_param("s", $catename);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION["adminExit"] = "Sub_Reporter already exist!";
            header("Location: ManageAds.php");

        } else {
            $smt = $this->con->prepare("insert into ads (C_Name,ads_name,image) values (?,?,?)");
            $smt->bind_param("sss", $catename, $adsname, $image);
            $smt->execute();
            $_SESSION["adsSuccess"] = "Advertisement add successfully.";
            header("location: ManageAds.php");
            $smt->close();
            $this->con->close();
        }
    }

// get ads
    public function getAds()
    {
        $smt = $this->con->prepare("SELECT * FROM ads");
        $smt->execute();
        $result = $smt->get_result();
        return $result;
        $smt->close();
        $this->con->close();
    }

//get recent news by admin
    public function getrecentnewsbyadmin()
    {
        $stmt = $this->con->prepare("SELECT * FROM news WHERE status='U' ORDER BY id DESC LIMIT 5");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
        $stmt->close();
        $this->con->close();
    }

//delete ads
    public function deleteAds($aid)
    {
        $stmt = $this->con->prepare("DELETE FROM ads WHERE aid='$aid'");
        $stmt->execute();
        $stmt->close();
        $this->con->close();
        $_SESSION['deleteads'] = "Delete Successfully.";
        header("Location: ManageAds.php");
    }

    public function getFeedback()
    {
        $stm = $this->con->prepare("select * from feedback");
        $stm->execute();
        return $stm->get_result();


    }

    //delete user feedback
    public function deleteFeedback($fid)
    {

        $stm = $this->con->prepare("DELETE FROM feedback WHERE id='$fid'");
        $stm->execute();
        $_SESSION['deletefeedback'] = "Delete Feedback Successfully";
        $stm->close();
        $this->con->close();
        header("Location: feedback.php");
    }

    public function newsCount()
    {
        $stm = $this->con->prepare("SELECT category, COUNT(*) as news_count FROM news WHERE status='U' AND category IN (SELECT C_Name FROM cate WHERE status='') GROUP BY category");
        $stm->execute();
        $result = $stm->get_result();
        $stm->close(); // Close the prepared statement
        // Do not close the database connection here
        return $result;
    }
    public function deleteNewsByCate($name)
    {
        // session_start();
        $stmt1 = $this->con->prepare("DELETE FROM news WHERE category=?");
        $stmt1->bind_param("s", $name);
        $stmt1->execute();
        header("Location:add_categories.php");
        $stmt1->close();
        $this->con->close();

    }
}

?>
