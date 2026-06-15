<?php
include "userOOP.php";
include "validation.php";

session_start();

$email = isset($_POST["email"]) ? $_POST["email"] : ''; // Check if email is set, set to empty string if not
$password = isset($_POST["password"]) ? $_POST["password"] : ''; // Check if password is set, set to empty string if not

//$val = new valdation($email, $password); // Pass email and password arguments to the constructor
//if($val->email($email)||$val->password($password))
//{
//    if ($val->email($email)) {
//        $_SESSION["em"] = "Invalid Email";
//
//    }
//
//    if ($val->password($password)) {
//        $_SESSION["pw"] = "Invalid Password";
//
//    }
//    header("Location: Signup.php");
//    exit(); // Terminate script after redirection
//}

// Function to validate email
function validate_email($email)
{
    // PHP filter_var function with FILTER_VALIDATE_EMAIL filter
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password
function validate_password($password)
{
    // Password length should be at least 8 characters
    // You can add more complex validation rules as per your requirement
    return strlen($password) >= 8;
}


if (!validate_password($password))
{
    $_SESSION["passwordInvalid"]="Password too weak";
    header("Location: Signup.php");
}
else{
    $var = new UserFunction();
    $var->signup($email, $password);
}

?>