<?php
//session_start();
class Functions
{
    public $conn;


    public function __construct()
    {
        $servername="localhost";
        $username="root";
        $password="root";
        $dbname="shweeshaung";

        if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
            echo 'We don\'t have mysqli!!!';
        } else {
            echo 'Phew we have it!';
        }
        $this->conn=new mysqli($servername,$username,$password,$dbname);
        if($this->conn->connect_error)
        {
            die("Connection fail : ".$this->conn->connect_error);
        }
    }

//sign up
    public  function  signup($email,$password)
    {
        $stmt1 = $this->conn->prepare("SELECT * FROM user WHERE email=?");
        $stmt1->bind_param("s", $email);
        $stmt1->execute();
        $result = $stmt1->get_result();
        if ($result->num_rows > 0) {
            $_SESSION["err"] = "Email already exist!";
            header("Location: Sign_up.php");

        } else {
            $stmt = $this->conn->prepare("INSERT INTO user (email,password) VALUES (?,?)");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $stmt->close();
            $this->conn->close();

            header("Location: login.php");

        }

    }

    }
//validation
    class validation
{
    public $email;
    public $password;

        public function __construct($email,$password)
        {
            $this->email=$email;
            $this->password=$password;
        }



    public function email($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))

            return true;

        else
            return false;
    }

    public function password($password)
    {
        if (!preg_match("/^[a-zA-Z-0-9]*$/", $password))

            return true;

        else
            return false;
    }


}
?>