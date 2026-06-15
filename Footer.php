<div class="container-fluid bg-black text-white mt-3">
    <div class="container text-start">
        <div class="row">

<!--            <div style="overflow-y: auto; height: 300px;"> <!-- Adjust height as needed -->

                <?php
                $obj = new UserFunction();
                $result = $obj->showcategory();

                if ($result->num_rows > 0) {
                    while ($r = $result->fetch_assoc()) {
                        $a = $r["C_Name"];
                        ?>

                        <div class=" col-lg-2 mt-4">
                            <h5><a style="color: white;"
                                   href="Categories.php?cname=<?= urlencode($a) ?> "><?= $r["C_Name"] ?></a></h5>
                            <ul style="list-style-type: none; margin-left: -29px; font-size: small;">

                                <?php
                                $cname = $r["C_Name"];
                                $obj = new UserFunction();
                                $result1 = $obj->showsubcategory($cname);
                                if ($result1->num_rows > 0) {
                                    while ($r = $result1->fetch_assoc()) {
                                        ?>
                                        <li><a style="color:white;"
                                               href="Sub_Categories.php?subcate=<?= $r["sub_name"] ?>&cname=<?= $cname ?>"><?= $r["sub_name"] ?></a>
                                        </li>

                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                }
                ?>
<!--            </div>-->


            <div class="row mt-3 border-bottom border-2 border-white pb-2">

                <div class="col-2">
                    <a href="Home.php">
                        <button type="button" class="btn btn-danger">Shwee Shaung News</button>
                    </a>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-4">
                            <a href="contactUs.php">
                                <button type="button" class="btn btn-danger btn-sm mt-1">Contact Us</button>
                            </a>
                        </div>
                        <div class="col-8">
                            <a href="about_us.php">
                                <button type="button" class="btn btn-danger btn-sm mt-1">About Us</button>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="col-6 text-end">


                    <i class="bi bi-instagram fs-3 me-3"></i>
                    <i class="bi bi-facebook fs-3 me-3"></i>
                    <i class="bi bi-youtube fs-3 me-3"></i>
                </div>

            </div>

            <div class="row mt-2">
                <small> &copy; 2024 shwee shaung news.</small>
            </div>

        </div>
    </div>
</div>

<script src="bootstrap-5.3.2-dist/js/jquery.js"></script>
<script>
    $(function () {
        setTimeout(function () {
            $(".alert").fadeOut();
        }, 2000)
    })
</script>
</body>
</html>