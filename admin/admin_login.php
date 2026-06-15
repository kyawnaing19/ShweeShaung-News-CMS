<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta>
    <title>Shwee Shaung Admin</title>
    <meta name="description" content="" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <!-- build:js assets/vendor/js/core.js -->

    <style>
        .logo{
            width: 300px;
            margin-left: 40px;
            /*border: 1px solid #1e2c3c;*/
            height: 100px;
            background-image: url("Lg.png");
            background-position: center;
            background-size:cover;
            background-repeat: no-repeat;
        }
        .alert {
            position: absolute;
            top: 0;
            width: 26%;
            margin-left: 31.5%;
            text-align: center;
        }
    </style>
</head>
<body>
<!-- Content -->

<div class="container-xxl">

    <?php
    if(isset($_SESSION["adminfail"] )){
        ?>
        <div class="alert alert-danger mt-3" role="alert" id="success-alert">
            <?php echo $_SESSION["adminfail"];
            unset($_SESSION["adminfail"] );
            ?>
        </div>
        <?php
    }
    ?>

    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <div class=" justify-content-center logo">  </div>
                    <h4 class="mb-4">Welcome to Shwee Shaung! 👋</h4>
                    <p class="mb-4">Please sign-in to your account and start the adventure</p>

                    <form action="function.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email or Username</label>
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="role"
                                placeholder="Enter Role"
                                autofocus />
                            <span style='color: red;'>

                    </span>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                <a href="auth-forgot-password-basic.html">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />

                                <span style='color: red;'></span>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">LOGIN</button>
                        </div>
                    </form>


                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<!-- / Content -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/popper/popper.js"></script>
<script src="assets/vendor/js/bootstrap.js"></script>
<script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="assets/vendor/js/menu.js"></script>

<!-- Main JS -->
<script src="assets/js/main.js"></script>



<!-- endbuild -->

<!-- Vendors JS -->



<!-- Page JS -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>

