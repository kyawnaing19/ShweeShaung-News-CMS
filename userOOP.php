<?php


class UserFunction
{

    public $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shweeshaung";

        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection fail : " . $this->conn->connect_error);
        }

    }

    //signup
    public function signup($email, $password)
    {
        session_start();
        $stmt1 = $this->conn->prepare("SELECT * FROM user WHERE email=?");
        $stmt1->bind_param("s", $email);
        $stmt1->execute();
        $result = $stmt1->get_result();
        if ($result->num_rows > 0) {
            $_SESSION["validateerror"] = "Email already exist!";
            header("Location: Signup.php");

        } else {
            $stmt = $this->conn->prepare("INSERT INTO user (email,password) VALUES (?,?)");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $stmt->close();
            $this->conn->close();

            $_SESSION["validatecorrect"] = "Your account was successfully created!";
            header("Location: Signup.php");

        }
    }



    //login
    public function login($email, $password)
    {
        session_start();
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            $name = $user['name'];
            $em = $user['email'];
            $pw = $user['password'];
            $id = $user['iduser'];

            if ($password == $pw) {

                $_SESSION['username'] = $name;
                $_SESSION["user"] = $id;
                $_SESSION['userEmail'] = $em;
                $_SESSION['userPassword'] = $pw;
                header("Location: Home.php");
                exit();
            } else {
                $_SESSION["passworderror"] = "Invalid Password";
            }
        } else {
            $_SESSION["emailinvalid"] = "Email doesn't exist";
            $_SESSION["passworderror"] = "Invalid Password";
        }

        $stmt->close();
        $this->conn->close();
        header("Location: Login.php");

    }


//user post
    public function userpost($date, $detail, $serialized_images)
    {
        session_start();
        $stmt = $this->conn->prepare("INSERT INTO news (date,detail,image,status,count) VALUES (?,?,?,'N',0)");
        $stmt->bind_param("sss", $date, $detail, $serialized_images);
        $stmt->execute();
        $_SESSION['postsuccess']="Post Success";
        $stmt->close();
        $this->conn->close();
        header("Location: Home.php");
    }

    //user's category view
    public function showcategory()
    {
        $stmt = $this->conn->prepare("SELECT * FROM cate where status='' ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
        header("Location: Footer.php");
    }

    //show category at nav
    public function showcategoryNav()
    {
        $stmt = $this->conn->prepare("SELECT * FROM cate where status='' ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
        header("Location: Nav.php");
    }

    public function showsubcategory($cname)
    {

        $stmt = $this->conn->prepare("SELECT * FROM sub_category WHERE C_Name=? and status='A' ");
        $stmt->bind_param("s", $cname);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;

    }

//get news by id
    public function getNews($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE status='U' AND id = $id And category IN (SELECT C_Name FROM cate WHERE status='')");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

//get breaking news by last id
    public function getlastindexnews()
    {
        $stmt = $this->conn->prepare("SELECT MAX(id) AS max_id FROM news WHERE status='U' AND category IN (SELECT C_Name FROM cate WHERE status='')");
        $stmt->execute();
        $ID = $stmt->get_result();
        $nid = $ID->fetch_assoc();
        $max = $nid['max_id'];
        $stmt1 = $this->conn->prepare("select * from news where status='U' and id=$max");
        $stmt1->execute();
        $result = $stmt1->get_result();
        $stmt->close();
        $stmt1->close();
        $this->conn->close();
        return $result;


    }

    //getting recent news
    public function getRecentNews($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE status='U'AND id<>$id AND category IN (SELECT C_Name FROM cate WHERE status='') ORDER BY id DESC LIMIT 4 ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

    public function RecentNews()
    {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE status='U' AND category IN (SELECT C_Name FROM cate WHERE status='') ORDER BY id DESC LIMIT 5 ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

//get related news by news ID
    public function getrelatednews($category, $id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE category='$category' AND id<>$id AND status='U' AND category IN (SELECT C_Name FROM cate WHERE status='') LIMIT 4 ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

//get category latest news
    public function getcatelatestnews()
    {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE (category, id) IN (SELECT category, MAX(id) FROM news WHERE status='U' AND category<>'editor' GROUP BY category) AND category IN (SELECT C_Name FROM cate WHERE status='') ORDER BY category DESC LIMIT 8");

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }


//update count for must read
    public function updateCount($id)
    {
        $stmt = $this->conn->prepare("UPDATE news SET count = count + 1 WHERE id = ?");

        $stmt->bind_param("d", $id);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }

//most read news
    public function mostReadNews()
    {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE status='U' AND category IN (SELECT C_Name FROM cate WHERE status='') ORDER BY count DESC LIMIT 4 ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

    public function editorNews()
    {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE status='U' AND category='editor' ORDER BY id DESC LIMIT 1 ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

    public function editorRecentNews($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE status='U' AND id<>$id AND category='editor' ORDER BY id DESC LIMIT 5 ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

//for category page get detail each category
    public function getDetailCategory($cname)
    {

        $stmt = $this->conn->prepare("SELECT * FROM news WHERE status='U' AND category=? AND id<>(SELECT MAX(id) FROM news  where category=?) ORDER BY id DESC LIMIT 4 ");
        $stmt->bind_param('ss', $cname, $cname);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;

    }

    public function getDetailCate($cname)
    {

        $stmt = $this->conn->prepare("SELECT * FROM news WHERE status='U' AND category=? AND id<>(SELECT MAX(id) FROM news  where category=?) ORDER BY id DESC LIMIT 5 ");
        $stmt->bind_param('ss', $cname, $cname);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;

    }

//CATEGORY LAST IMAGES
    public function getCategoryLastImage($cname)
    {

        $stmt = $this->conn->prepare("SELECT * FROM news WHERE status='U' AND category=? AND id=(SELECT MAX(id) FROM news  where category=?)");
        $stmt->bind_param('ss', $cname, $cname);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;

    }

//middle news
    public function getMidNews()
    {
        $stmt = $this->conn->prepare("SELECT * 
FROM (
    SELECT *, NTILE(3) OVER (ORDER BY id) AS part_num
    FROM news
    WHERE status='U'
) AS partitioned_rows
WHERE part_num = 2 AND category IN (SELECT C_Name FROM cate WHERE status='')");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;

    }

    //showsubnew
    public function showSubNew($subcate, $cname)
    {
        $stmt = $this->conn->prepare("select * from news where category=? AND sub_category=? AND category IN (SELECT C_Name FROM cate WHERE status='') ORDER BY id DESC LIMIT 4 ");
        $stmt->bind_param("ss", $cname, $subcate);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

//adding subscribe
    public function addSub($id, $cate)
    {
        $stmt1 = $this->conn->prepare("select * from subscribe where iduser=? and C_Name=? ");
        $stmt1->bind_param("ds", $id, $cate);
        $stmt1->execute();
        $result = $stmt1->get_result();
        if ($result->num_rows > 0) {
            $stmt2 = $this->conn->prepare("delete from subscribe where iduser=? and C_Name=? ");
            $stmt2->bind_param("ds", $id, $cate);
            $stmt2->execute();
            $stmt2->close();
            $this->conn->close();

            header("Location: Categories.php?cname=$cate");
        } else {
            $stmt = $this->conn->prepare("insert into subscribe (iduser,C_Name)values(?,?) ");
            $stmt->bind_param("ds", $id, $cate);
            $stmt->execute();
            $stmt->close();
            $this->conn->close();
            header("Location: Categories.php?cname=$cate");
        }

        $stmt1->close();
        $this->conn->close();

    }


//checking subscribe
    public function checkSubscribe($cname, $user)
    {
        $stmt1 = $this->conn->prepare("select * from subscribe where iduser=? and C_Name=? ");
        $stmt1->bind_param("ds", $user, $cname);
        $stmt1->execute();
        $result = $stmt1->get_result();
        return $result;
    }

//show catey by subscribe
    public function showcatebySubscribe($userid)
    {
        $stmt1 = $this->conn->prepare("select * from subscribe where iduser=?");
        $stmt1->bind_param("d", $userid);
        $stmt1->execute();
        $result = $stmt1->get_result();
        return $result;
    }

//getting Category
    public function gettingADs($category)
    {
        $stmt1 = $this->conn->prepare("select * from ads where C_Name=?");
        $stmt1->bind_param("s", $category);
        $stmt1->execute();
        $result = $stmt1->get_result();
        return $result;
    }

    public function gettingOverADs()
    {
        $stmt1 = $this->conn->prepare("select * from ads ORDER BY aid LIMIT 2");
        $stmt1->execute();
        $result = $stmt1->get_result();
        return $result;
    }

//show recent sub category news for one row
    public function showrecentnewsbysubcatename($subname)
    {
        $stmt = $this->conn->prepare("SELECT MAX(id) AS max_id FROM news WHERE status='U' AND sub_category='$subname' AND category IN (SELECT C_Name FROM cate WHERE status='')");
        $stmt->execute();
        $ID = $stmt->get_result();
        $nid = $ID->fetch_assoc();
        $max = $nid['max_id'];
        $stmt1 = $this->conn->prepare("select * from news where status='U' and id=$max");
        $stmt1->execute();
        $result = $stmt1->get_result();
        $stmt->close();
        $stmt1->close();
        $this->conn->close();
        return $result;
    }


//show sub category news by subcate name
    public function shownewsbysubcatename($subname, $subid)
    {
        $stmt1 = $this->conn->prepare("select * from news where sub_category=? and status='U' and id<>'$subid' AND category IN (SELECT C_Name FROM cate WHERE status='') LIMIT 6");
        $stmt1->bind_param("s", $subname);
        $stmt1->execute();
        $result = $stmt1->get_result();
        return $result;
    }

//user subscribed news
    public function subscribeCategoryNews($cname)
    {
        $stmt1 = $this->conn->prepare("select * from news where category=? and status='U' AND category IN (SELECT C_Name FROM cate WHERE status='') ORDER BY id DESC LIMIT 4  ");
        $stmt1->bind_param("s", $cname);
        $stmt1->execute();
        $result = $stmt1->get_result();
        return $result;
    }

//unsubscribe from subscribe page
    public function unsub($id, $cname, $userid)
    {
        $stmt2 = $this->conn->prepare("delete from subscribe where iduser=? and C_Name=? ");
        $stmt2->bind_param("ds", $id, $cname);
        $stmt2->execute();
        $stmt2->close();
        $this->conn->close();
        header("Location: Subscribe.php?userid=$userid");
    }


// set Feedback
    public function feedback($name, $email, $message)
    {

        $stm = $this->conn->prepare("Insert into feedback (name,email,message) value (?,?,?) ");
        $stm->bind_param("sss", $name, $email, $message);
        $stm->execute();
        $_SESSION['feedbacksuccess']="Your Feedback Successfully Send";
        $stm->close();
        $this->conn->close();
        header("Location: contactUs.php");

    }

//popular category
    public function popularCategory()
    {
        $stmt1 = $this->conn->prepare("SELECT C_Name, COUNT(*) AS total_subscribers
FROM subscribe where C_Name IN (SELECT C_Name FROM cate WHERE status='')
GROUP BY C_Name
ORDER BY total_subscribers DESC
LIMIT 5; ");

        $stmt1->execute();
        $result = $stmt1->get_result();
        return $result;
    }

    //get user info
    public function getUsersInfo($userid)
    {
        $stmt = $this->conn->prepare("select * from user where iduser='$userid'");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

//edit user profile info
    public function userEdit($name, $upass, $cpass, $pass)
    {


        if ($cpass == $pass) {
            session_start();
            if($upass=="")
            {
                $stmt = $this->conn->prepare("UPDATE user SET name='$name' WHERE password='$cpass'");
            }
            else
            {
                if(strlen($upass)>=8) {
                    $stmt = $this->conn->prepare("UPDATE user SET password='$upass',name='$name' WHERE password='$cpass'");
                }
                else
                {
                    $_SESSION["updatepwError"]="New password is too weak..";
                    $_SESSION['modal']="modal exit";
                    header("Location: Home.php");
                }
                }
            $stmt->execute();
            $_SESSION['profilecorrect'] = "Update Success";
            $_SESSION['modal']="modal exit";
            $stmt->close();
            $this->conn->close();
            header("Location: Home.php");
            exit();
        } else {
            session_start();
            $_SESSION['profileerror'] = "Current Password Invalid";
            $_SESSION['modal']="modal exit";
            header("Location: Home.php");
        }
    }

//delete account by user
public function deleteaccbyuser($userid)
{
    session_start();
    $stmt=$this->conn->prepare("delete from user where iduser='$userid'");
    $stmt->execute();
    $_SESSION['deleteacc']="Delete Successfully";
    unset($_SESSION['user']);
    $stmt->close();
    $this->conn->close();
        header("Location: Home.php");
}


}

?>