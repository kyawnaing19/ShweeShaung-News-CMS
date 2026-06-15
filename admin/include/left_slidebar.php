
<?php session_start();?>
<style>

    #layout-menu-wrapper {
        position: sticky;
        top: 0;
        height: 100vh;
        overflow-y: auto; /* Enable scrolling if the content is taller than the viewport */
        scrollbar-width: thin; /* Firefox */
        scrollbar-color: transparent transparent; /* Firefox */
        -ms-overflow-style: none; /* Internet Explorer and Edge */
    }
    ::-webkit-scrollbar {
        display: none;
    }
    /*#layout-menu-wrapper::-webkit-scrollbar {*/
    /*    width: 0; !* Width of the scrollbar *!*/
    /*    display: none; !* Hide scrollbar for Webkit browsers (Chrome, Safari, etc.) *!*/
    /*}*/

    /*#layout-menu-wrapper::-webkit-scrollbar-thumb {*/
    /*    background-color: transparent; !* Color of the thumb *!*/
    /*}*/

    /*#layout-menu-wrapper:hover::-webkit-scrollbar-thumb {*/
    /*    background-color: #ccc; !* Color of the thumb on hover *!*/
    /*}*/

</style>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside  id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div id="layout-menu-wrapper">
            <div class="app-brand demo">
                <a href="" class="app-brand-link">
              <span class="app-brand-logo demo">
              </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-2"> <img style="width: 200px" src="assets/img/avatars/logo.png" alt=""></span>
                </a>
                <a href="" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <div class="menu-inner py-3 pb-lg-5">
                <!-- Dashboards -->
                <li class="menu-item">
                    <a href="dashboard.php" target="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Email">Dashboards</div>
                    </a>
                </li>


                <li class="menu-item">
                    <a href="staff.php" class="menu-link ">
                        <i class="menu-icon tf-icons bx bx-edit"></i>
                        <div data-i18n="Layouts">Staff</div>
                    </a>
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text"><b>Categories</b></span>
                </li>


                <li class="menu-item">
                    <a href="add_categories.php" target="" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-category"></i>
                        <div data-i18n="Chat">Manage Categories</div>
                    </a>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text"><b>Sub-Categories</b></span>
                </li>


                <li class="menu-item">
                    <a href="add_Subcategories.php" target="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-category"></i>
                        <div data-i18n="Chat">Manage Sub-Categories</div>
                    </a>
                </li>


                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text"><b>Advertisement</b></span>
                </li>
                <li class="menu-item">
                    <a href="ManageAds.php" target="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-abacus"></i>
                        <div data-i18n="Email">Manage Advertisement</div>
                    </a>
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text"><b>Feedback</b></span>
                </li>
                <li class="menu-item">
                    <a href="feedback.php" target="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                        <div data-i18n="Email">Feedback</div>
                    </a>
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text"><b>About Webpage</b></span>
                </li>


                <li class="menu-item">
                    <a href="" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-contact"></i>
                        <div data-i18n="Layouts">CMS</div>
                    </a>


                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <i class="menu-icon tf-icons bx bxs-info-circle"></i>
                                <div data-i18n="Blank">About Us</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <i class="menu-icon tf-icons bx bxs-envelope"></i>
                                <div data-i18n="Blank">Contact Us</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <i class="menu-icon tf-icons bx bxs-log-in"></i>
                                <div data-i18n="Blank">Edit Logo</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </div>

        </aside>

