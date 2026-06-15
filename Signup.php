<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signup Page</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9e0d9;

        }

        .login-container {
            max-width: 400px;
            margin: 68px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 90px;
        }

        .footer__page {
            background-color: #090a0b;
            color: #f1e0e0;
            padding: 10px;
            width: 100%;
            height: 200px;
            margin-top: 185px;
        }

        .login-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


        .form-group {
            margin-bottom: 20px;
        }

        .btn-login {
            background-color: #e10600;
            color: #ffffff;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 100;
            overflow: hidden;

        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 18px;
            text-decoration: none;
        }

        .text-cen {
            width: 280px;
            margin-left: 13%;
            height: 100px;
            background-image: url("Lg.png");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;


        }

        .alert {
            position: absolute;
            top: 0;
            width: 26%;
            margin-left: -19px;
            text-align: center;
        }
       ::-webkit-scrollbar{
           display: none;
       }
    </style>
</head>

<body>


<!-- <div class="pagecontainer__root">
  <main class="container__main-page main__content"> -->
<div class="container login-container">

    <?php
    if(isset($_SESSION["validatecorrect"] )){
    ?>
    <div class="alert alert-success mt-3" role="alert" id="success-alert">
       <?php echo $_SESSION["validatecorrect"];
       unset($_SESSION["validatecorrect"] );
       ?>
    </div>
<?php
    }
    ?>


    <?php
    session_start();
    if (isset($_SESSION["validateerror"])) {
        echo "<div class='alert alert-danger' role='alert'>
            {$_SESSION['validateerror']}
            </div>";
        unset($_SESSION["validateerror"]);
    }
    if (isset($_SESSION["validatecorrect"])) {
        echo "<div class='alert alert-success' role='alert'>
            {$_SESSION['validatecorrect']}
            </div>";
        unset($_SESSION["validatecorrect"]);
    }
    if (isset($_SESSION["passwordInvalid"])) {
        echo "<div class='alert alert-danger' role='alert'>
            {$_SESSION['passwordInvalid']}
            </div>";
        unset($_SESSION["passwordInvalid"]);
    }
    ?>
    <div class="text-cen">

    </div>
    <div class="login-form">
        <h4 class="text-center">Sign Up your Account!</h4>
        <h6 class="text-center"> Have an account!<a href="Login.php">Login</a></h6><br>

        <form action="signupfunction.php" method="post">
            <div class="form-group">

                <input type="email" class="form-control" id="email" name="email" required placeholder="Email Address">
                <span style='color: red;'>
                <?php
                if (isset($_SESSION["em"])) {
                    echo $_SESSION["em"];
                    unset($_SESSION["em"]);
                }
                ?>
                    </span>
            </div>
            <div class="form-group">

                <input type="password" class="form-control" id="password" name="password" required
                       placeholder="Password">
                <span style='color: red;'>
                <?php
                if (isset($_SESSION["pw"])) {
                    echo $_SESSION["pw"];
                    unset($_SESSION["pw"]);
                }
                ?>
                    </span>
            </div>
            <button type="submit" class="btn btn-login btn-block">Sign In</button>

        </form>
    </div>
</div>

<footer class="footer__page">
    <ul>
        <li><a href="#"><i class="fab fa-envira">© Shwee Saung News 2024</i></a></li>
        <li><a href="Home.php">Home</a></li>
        <li><a href="contactUs.php">Contact</a></li>
        <li><a href="about_us.php">About</a></li>
        <li><a href="#">Follow ShweeShaung</a></li>
    </ul>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <p style="padding-left: 60px;">Welcome to our Shwee Shaung News Website.This is Awesome for you!Thank you.</p>
    <p style="padding-left: 60px;">This is Awesome for you!Thank you.</p>
</footer>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="bootstrap-5.3.2-dist/js/jquery.js"></script>
<script>
    $(function(){
        setTimeout(function(){
            $(".alert").fadeOut();
        }, 2000)
    })
</script>
</body>

</html>
