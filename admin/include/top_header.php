<?php
//include("left_slidebar.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Shwee Shaung Header </title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/js/config.js"></script>

    <style>
        body{
            font-family: Arial, sans-serif;
        }
        .tablesize tr th, td {
            width: auto;
        }

        .tablesize {
            height: 80px;
        }

        .tablesize tr th {
            color: white;
            background-color:#900C3F;
        }

        .tablesizeforads tr th, td {
            width: auto;
        }

        .tablesizeforads {
            height: 20px;
        }

        .tbl-fixedforads {
            overflow-y: scroll;
            height: fit-content;
            max-height: 50vh;
            margin-top: 0;
        }

        .tbl-fixed {
            overflow-y: scroll;
            height: fit-content;
            max-height: 27vh;
            margin-top: 0;
        }


        table th, td {
            height: 10px;
            width: 40px;
        }

        table th {
            position: sticky;
            top: 0;
            border-color: black;
        }

        table td {
            text-align: start;
        }

        .alert {
            position: absolute;
            top: 8%;
            width: 26%;
            margin-left: 29%;
            text-align: center;
        }
    </style>

</head>

<body>


<div class="layout-page">
    <!-- Navbar -->

    <nav style="position: sticky; top: 0; z-index: 1000;"
            class=" layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Marquee Sentence -->
            <marquee behavior="scroll" direction="left" class="navbar-brand ms-3" style="color: #900C3F ">
                Stay Informed with <b style="color: #000"> SHWEE SHAUNG NEWS</b> the Latest Breaking News and Updates - Your Trusted Source for Timely Information!
            </marquee>

            <ul class="navbar-nav flex-row align-items-center ms-auto">

                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="assets/img/avatars/personlogo.jpg" alt class="w-px-40 h-auto rounded-circle"/>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item" href="admin_login.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>
            </li>
            <!--/ User -->
            </ul>
        </div>
    </nav>

<!--</div>-->
    <!-- / Navbar -->

