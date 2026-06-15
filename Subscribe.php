<?php include "Nav.php" ?>


<div class="container">


    <?php
    $userid = $_GET['userid'];

    $obj = new UserFunction();
    $result = $obj->showcatebySubscribe($userid);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            ?>
            <div class="row mt-2">
                    <div class="col">
                <h2><a class="fw-semibold" href="Categories.php?cname=<?= urlencode($row['C_Name']) ?>"> <?= ucfirst($row['C_Name']) ?></a></h2>
                    </div>
            <?php

            if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];

                    $btn = new UserFunction();
                    $check = $btn->checkSubscribe($row['C_Name'], $user);

                    if ($check->num_rows > 0) {

                        ?>
                        <a class="btn subscribe fw-semibold" style="background-color: #d9d8d8;"
                           href="userfunction.php?idunsubscribe=<?= urlencode($user) ?>&cateunsubscribe=<?= urlencode($row['C_Name']) ?>&userid=<?= urlencode( $userid) ?>">Unsubscribe </a>
                        <?php
                            }

                        ?>


                <?php
                $cname = $row['C_Name'];
                $obj1 = new UserFunction();
                $result1 = $obj1->subscribeCategoryNews($cname);

                while ($row1 = $result1->fetch_assoc()) {
                    $im = unserialize($row1['image']);
                    ?>
                    <div class="col-lg-3 mt-2">
                        <img src="./admin/images/<?= $im[0] ?>" class="img-fluid rounded" alt="...">
                        <h5><a href="Detail.php?id=<?= urlencode($row1['id']) ?>"><?= $row1['description'] ?></a></h5>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
    }
    ?>

</div>


<?php include "Footer.php" ?>
