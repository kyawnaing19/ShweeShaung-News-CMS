<html>
<head>
    <?php include "userOOP.php";
    session_start();
    ?>

    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.2-dist\css\bootstrap.css">
    <script src="bootstrap-5.3.2-dist\js\bootstrap.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>
        body {
            background-color: #EFEDEDFF;
            font-family: Arial, sans-serif;
        }


        #logo {

            position: absolute;
            left: 5%;
            width: 230px;
            height: 80%;
        }

        .imglogo {
            top: -110%;
            max-width: 100%;
            height: auto;
            position: absolute;
        }

        .aa {
            padding-bottom: 20px;
            border-bottom: 2px solid silver;
        }

        .of {
            overflow: hidden;
            height: 290px;
        }

        .fourthpagecolum1text {
            overflow: hidden;
            height: 63px;
            font-size: small;
        }

        /*for all hyperlink text*/
        a {
            text-decoration: none;
            color: black;
        }
        a:hover{
            color: #900C3F;
            text-decoration: underline;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .searchboxhover:hover {
            background-color: #a19f9f;
        }

        #searchContainer {
            display: none;
        }

        .alerthome {
            position: absolute;
            top: 20%;
            width: 26%;
            margin-left: 36%;
            text-align: center;
        }

        .alertmodal {
            position: absolute;
            top: -13px;
            width: 48%;
            margin-left: 34%;
            text-align: center;
        }
    </style>

</head>

<body>  <!-- As a link -->
<nav class="navbar sticky-top" style="background-color: #DEDCDCFF;">
    <div class="container-fluid justify-content-end">
        <a href="Home.php" class="navbar-brand">
            <i class="bi bi-house-fill" ></i>&nbsp; Home
        </a>
        <div id="logo" >
            <img src="Lg.png" class="imglogo">
        </div>

        <a class="navbar-brand" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop"
           aria-controls="offcanvasTop">Categories</a>

        <!--        // bottom-up modal-->
        <div class="offcanvas offcanvas-bottom bg-black text-white" tabindex="-1" id="offcanvasTop"
             aria-labelledby="offcanvasTopLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title border-bottom border-2 border-secondary-subtle fs-4" id="offcanvasTopLabel">
                    Categories</h5>


                <!--                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>-->
            </div>
            <div class="offcanvas-body custom-offcanvas-body">

                <div class="container text-start pb-5">
                    <div class="row">
                        <?php


                        $obj = new UserFunction();
                        $result = $obj->showcategory();

                        if ($result->num_rows > 0) {
                            while ($r = $result->fetch_assoc()) {
                                $a = $r["C_Name"];
                                ?>

                                <div class=" col-lg-2 mt-4">
                                    <h5><a style="color: white;"
                                           href="Categories.php?cname=<?= urlencode($a) ?> "> <?= $r["C_Name"] ?></a>
                                    </h5>
                                    <?php
                                    $cname = $r["C_Name"];
                                    $obj = new UserFunction();
                                    $result1 = $obj->showsubcategory($cname);
                                    if ($result1->num_rows > 0) {
                                        while ($r = $result1->fetch_assoc()) {
                                            ?>
                                            <ul style="list-style-type: none; margin-left: -29px; font-size: small;">
<!--                                                <li>--><?php //= $r["sub_name"] ?><!--</li>-->
                                                <li><a style="color:white;" href="Sub_Categories.php?subcate=<?= $r["sub_name"] ?>&cname=<?= $cname ?>"><?= $r["sub_name"] ?></a></li>

                                            </ul>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>


            </div>
        </div>

        <!--        For Post Modal Box-->
        <?php

        if (isset($_SESSION["user"])) {
            ?>
            <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#e"  href="#">Post</a>

            <a class="navbar-brand" href="Subscribe.php?userid=<?= $_SESSION['user'] ?>">Subscribe</a>

            <?php
        }
        ?>


        <form class="d-flex mt-3" role="search">
            <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </form>

        <?php

        if (isset($_SESSION['user'])) {

            ?>
            <div class="dropdown dropstart ">
                <a class="btn btn-secondary " href="#" role="button" id="dropdownMenuLink"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-lines-fill fs-4"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li class="">
                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profilemodal"><i
                                    class="bi bi-person-fill-gear"></i> &nbsp;profile setting</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="userfunction.php?logout='<?= urlencode("logout") ?>'"><i
                                    class="bi bi-box-arrow-left"></i>&nbsp;Logout</a>
                    </li>
                </ul>
            </div>

            <?php
        } else {
            ?>
            <a class="mx-3" href="Login.php"> <input class="btn btn-outline-secondary" type="submit" value="Login"></a>
            <?php
        }
        ?>



    </div>

    <?php
    if (isset($_SESSION['postsuccess'])) {
        ?>
        <div class="alert alerthome alert-success mt-3" role="alert" id="success-alert">
            <?php echo $_SESSION['postsuccess'];
            unset($_SESSION['postsuccess']);
            ?>
        </div>
        <?php
    }
    if (isset($_SESSION['feedbacksuccess'])) {
        ?>
        <div class="alert alerthome alert-success mt-3" role="alert" id="success-alert">
            <?php echo $_SESSION['feedbacksuccess'];
            unset($_SESSION['feedbacksuccess']);
            ?>
        </div>
        <?php
    }
    if (isset($_SESSION['deleteacc'])) {
        ?>
        <div class="alert alerthome alert-success mt-3" role="alert" id="success-alert">
            <?php echo $_SESSION['deleteacc'];
            unset($_SESSION['deleteacc']);
            ?>
        </div>
        <?php
    }
    ?>

</nav>

<!--                 user profile modal   -->
<div class="modal fade" id="profilemodal" tabindex="-1" aria-labelledby="exampleModal"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <?php
            if (isset($_SESSION['profilecorrect'])) {
                ?>
                <div class="alert alertmodal alert-success mt-3" role="alert" id="success-alert">
                    <?php echo $_SESSION['profilecorrect'];
                    unset($_SESSION['profilecorrect']);
                    ?>
                </div>
                <?php
            }
            if (isset($_SESSION['profileerror'])) {
                ?>
                <div class="alert alertmodal alert-danger mt-3" role="alert" id="success-alert">
                    <?php echo $_SESSION['profileerror'];
                    unset($_SESSION['profileerror']);
                    ?>
                </div>
                <?php
            }
            if (isset($_SESSION['updatepwError'])) {
            ?>
            <div class="alert alertmodal alert-danger mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['updatepwError'];
                unset($_SESSION['updatepwError']);
                ?>
            </div>
            <?php
            }
            ?>

            <div class="modal-header bg-secondary-subtle">
                <h1 class="modal-title fs-5 fw-semibold text-danger" id="exampleModalLabel">Profile</h1>

            </div>
            <div class="modal-body">

                <form action="userfunction.php" method="post" enctype="multipart/form-data">
                    <?php

                    $obj = new UserFunction();
                    $result = $obj->getUsersInfo($_SESSION['user']);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <div class="mb-3">

                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control" name="username" value="<?= $row['name'] ?>">

                            </div>
                            <div class="mb-3">

                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="text" class="form-control" name="useremail" value="<?= $row['email'] ?>"
                                       readonly>

                            </div>
                            <div class="mb-3">

                                <label for="exampleFormControlInput1" class="form-label">New Password</label>
                                <input type="text" class="form-control" name="updatepassword">

                            </div>
                            <div class="mb-3">

                                <label for="exampleFormControlInput1" class="form-label">Current Password</label>
                                <input type="text" class="form-control" name="currentpassword">

                            </div>
                            <input type="hidden" class="form-control" name="password" value="<?= $row['password'] ?>">

                            <a class="btn btn-danger"
                               href="userfunction.php?deleteaccbyid=<?= urlencode($row['iduser']) ?>">Delete Account</a>&nbsp;
                            <button type="submit" class="btn btn-primary">Save Change</button>

                            <?php
                        }
                    }
                    ?>

                </form>

            </div>

        </div>
    </div>
</div>


<div id="searchContainer" class="mt-3 p-3"
     style=" background-color: #DEDCDCFF;
     position: fixed; width: 35%; border-radius: 10px; right: 1%;
       overflow-y: auto; max-height: 40%;  ">

</div>


<!-- Modal -->
<div class="modal fade" id="e" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 180%; left: -220px;">
            <div class="modal-header bg-secondary-subtle">
                <h1 class="modal-title fs-5 text-danger fw-semibold" id="exampleModalLabel">Upload News Post</h1>
            </div>
            <div class="modal-body">

                <form action="userfunction.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Image</label>
                        <input type="file" class="form-control" id="postimage" name="files[]" multiple
                               required>

                        <input type="hidden" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">News Detail</label>
                        <textarea class="form-control" name="detail" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
<script>

    <?php
    if (isset($_SESSION['modal'])) {

        echo "$(document) . ready(function () {
                $('#profilemodal') . modal('show');
            });";
        unset($_SESSION['modal']);
    } ?>

    $(document).ready(function () {
        var inputField = $('#searchInput');
        var suggestionsContainer = $('#searchContainer');

        inputField.on('input', function () {
            var keyword = $(this).val().trim();

            if (keyword.length >= 3) {
                // Fetch suggestions from the server
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {keyword: keyword},
                    success: function (response) {
                        suggestionsContainer.html(response).show();
                    }
                });
            } else {
                suggestionsContainer.hide();
            }
        });

        // Handle suggestion click


        // Hide suggestions on document click
        $(document).on('click', function (event) {
            if (!$(event.target).closest('.search-container').length) {
                suggestionsContainer.hide();
            }
        });
    });

</script>