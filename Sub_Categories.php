<?php include "Nav.php" ?>

    <div class="container">

        <h1 class="p-3 mb-2">
            <?php
            echo ucfirst($_GET['subcate']);
            $cname = $_GET["cname"];
            $subname = $_GET['subcate'];
            ?>
        </h1>

        <div class="row">

            <div class="col-9">

                <?php
                $suid = 0;
                $obj = new UserFunction();
                $res = $obj->showrecentnewsbysubcatename($subname);
                $ro = $res->fetch_assoc();
                $subid = $ro['id'];
                $im = unserialize($ro['image']);
                ?>

                <img src="./admin/images/<?= $im[0] ?>" class="img-fluid rounded" alt="...">
                <h4 class="border-bottom pb-4 mb-2 mt-2">
                    <a href="Detail.php?id=<?= $ro['id'] ?>">
                        <?= $ro['description'] ?>
                    </a>
                </h4>

                <div class="row">
                    <?php
                    $obj = new UserFunction();
                    $result = $obj->shownewsbysubcatename($subname, $subid);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            $imae = unserialize($row["image"]);
                            ?>

                            <div class="col-6">
                                <div class="row py-3">
                                    <div class="col-5">
                                        <img src="./admin/images/<?= $imae[0] ?>" class="img-fluid rounded" alt="...">
                                    </div>
                                    <div class="col-7">
                                        <p>
                                            <a href="Detail.php?id=<?= $row['id'] ?>">
                                                <?= $row['description'] ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

            </div>

            <div class="col-3">
                <?php

                $sub = new UserFunction();
                $subim = $sub->gettingADs($cname);
                if ($subim->num_rows > 0) {
                    $sss = $subim->fetch_assoc();

                    $imm = unserialize($sss["image"]);
                    for ($i = 0; $i < count($imm); $i++) {
                        echo '<img class="img-fluid rounded" style="width:100%;height:25%;" src="./admin/adsimages/' . $imm[$i] . '"><br><br><br>';
                    }
                }

                ?>
                <!--                <img src="girl.jpg" class="img-fluid rounded" alt="...">-->
                <!--                <h4 class="pb-2 mb-3 mt-2">Ads Image</h4>-->

            </div>


        </div>


    </div>

<?php include "Footer.php" ?>