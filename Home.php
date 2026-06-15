<?php include 'Nav.php'; ?>
<head>
    <style>
        p{
            text-align: justify;
            overflow: hidden;
            height: 265px;
        }
    </style>
</head>

<div class=" p-5 ">
    <h1 class="text-center display-1 fw-bold" style="color: darkred;">Breaking News</h1>

</div>


<div class="container text-center mt-2 aa">
    <div class="row align-items-center">
        <!--        --><?php
        $cate = new UserFunction();
        $val = $cate->popularCategory();
        while ($row = $val->fetch_assoc()) {
            ?>

            <div class="col border-end border-start border-1 border-black">
                <b><a class="fs-4" href="Categories.php?cname=<?= urlencode($row["C_Name"]) ?> "><?= $row["C_Name"] ?></a></b>
            </div>
            <?php
        }
        ?>

    </div>
</div>

<!-- breaking news -->

<div class="container text-start mt-4 ">
    <div class="row aa ">
        <div class="col overflow-hidden" ">

            <?php

            $obj = new UserFunction();
            $stmt = $obj->getlastindexnews();
            if ($stmt->num_rows > 0){
            $row = $stmt->fetch_assoc();

            $image = unserialize($row['image']);
            $paragraphs = [];

            $paragraphFromDB = $row['detail'];
            // Split the paragraph into an array of sentences
            // Replace "။" with "."
            $paragraphFromDB = str_replace("။", ".", $paragraphFromDB);

            // Explode sentences with "." as delimiter
            $sentences = explode(".", $paragraphFromDB);


            // Calculate the number of sentences in each paragraph
            $numSentences = count($sentences);
            $sentencesPerParagraph = ceil($numSentences / 4); // Round up to ensure even distribution

            // Initialize an array to hold the paragraphs
            $paragraphs = array();

            // Split the array of sentences into three separate paragraphs
            for ($j = 0; $j < 4; $j++) {
                // Calculate the start and end indexes for this paragraph
                $start = $j * $sentencesPerParagraph;
                $end = min(($j + 1) * $sentencesPerParagraph, $numSentences);

                // Extract the sentences for this paragraph
                $paragraph = implode(".", array_slice($sentences, $start, $end - $start));

                // Add the paragraph to the array
                $paragraphs[] = $paragraph;
            }

            echo '<img class="img-fluid rounded" src="./admin/images/' . $image[0] . '">';

            ?>

            <figcaption class='figure-caption text-start mt-1'><?= $row['description'] ?>&nbsp;Image 1</figcaption>


            <!--            <img src="girl.jpg" class="img-fluid rounded" alt="...">-->

            <a style="color: #900C3F" href="Detail.php?id=<?= urldecode($row['id']) ?> "><h3
                        class="border-bottom pb-2 mb-4 border-secondary-subtle border-2 mt-2"><?= $row['description'] ?>
                    &nbsp;</h3>(<?= $row['date'] ?>)</a>

                <?php
                echo $paragraphs[0];
                ?>

            <a style="color: #900C3F;" href="Detail.php?id=<?= urldecode($row['id']) ?> ">Read More</a>


        </div>
        <div class="col-6">
            <!--            <img src="girl.jpg" class="img-fluid rounded" alt="...">-->

            <?php
            echo '<img class="img-fluid rounded" src="./admin/images/' . $image[1] . '">';
            ?>
            <figcaption class='figure-caption text-start mt-3'><?= $row['description'] ?>&nbsp;Image 2</figcaption>

            <!--            <h4 class="border-bottom pb-2 mb-4 border-secondary-subtle border-2 mt-2">Breaking News</h4>-->

                        <div class="mt-3" style="overflow: hidden; height: 165px;">
                <?php
                echo $paragraphs[1];
                ?>
                            </div>
            <a style="color: #900C3F;" href="Detail.php?id=<?= urldecode($row['id']) ?> ">Read More</a>

        </div>

        <?php

        }
        ?>
        <div class="col">
            <?php
            $obj = new UserFunction();
            $stmt = $obj->RecentNews();
            if ($stmt->num_rows > 0) {
                $lastRow = $stmt->fetch_assoc();
                $img = unserialize($lastRow['image']);


                echo '<img class="img-fluid rounded" src="./admin/images/' . $img[2] . '">';

                ?>
                <!--            <img src="girl.jpg" class="img-fluid rounded" alt="...">-->
                <h4 class="border-bottom pb-2 mb-2 border-secondary-subtle border-2 mt-2">Recent News</h4>

                <?php
                while ($row = $stmt->fetch_assoc()) {
                    ?>

                    <div class="row border-bottom border-secondary-subtle my-2 py-3">
                        <small><a href="Detail.php?id=<?= urldecode($row['id']) ?>">  <?= $row["description"] ?> </a></small>
                    </div>

                    <?php
                }
            }
            ?>


        </div>
    </div>

    <!-- /breaking news -->

    <!--  Most Read  -->

    <div class="row mt-4 aa">

        <h2 class="text-danger">Most Read</h2>

        <div class="col">
            <div class="row mt-2">
                <?php
                $count = 0;
                $obj = new UserFunction();
                $stmt = $obj->mostReadNews();
                if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                        $count++;
                        ?>
                        <div class="col-1">
                            <h2><?= $count ?></h2></div>
                        <div class="col-11">

                                <a href="Detail.php?id=<?= urldecode($row['id']) ?>"> <?= $row['description'] ?></a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

    </div>

    <!--  //Most Read  -->
    <!--  Editor's Opinion  -->

    <div class="container text-start mt-4">
        <div class="row border-2 border-black">
            <div class="col" style="padding-left: 0;">
                <h2 class="text-danger ">Editor's Opnion</h2>
            </div>
            <div class="col-6">
                <h2 class=""></h2>
            </div>
            <div class="col">
                <h2 class=""></h2>
            </div>

        </div>
    </div>

<div class="container">
    <div class="row aa" style="margin-top: 10px;">

        <div class="col-3 overflow-hidden">

            <?php
            $id = 0;
            $obj = new UserFunction();
            $stmt = $obj->editorNews();
            if ($stmt->num_rows > 0)
            {

            $row = $stmt->fetch_assoc();

            $image = unserialize($row['image']);
            $paragraphs = [];
            $id = $row['id'];

            $paragraphFromDB = $row['detail'];
            // Split the paragraph into an array of sentences
            // Replace "။" with "."
            $paragraphFromDB = str_replace("။", ".", $paragraphFromDB);

            // Explode sentences with "." as delimiter
            $sentences = explode(".", $paragraphFromDB);


            // Calculate the number of sentences in each paragraph
            $numSentences = count($sentences);
            $sentencesPerParagraph = ceil($numSentences / 4); // Round up to ensure even distribution

            // Initialize an array to hold the paragraphs
            $paragraphs = array();

            // Split the array of sentences into three separate paragraphs
            for ($j = 0; $j < 4; $j++) {
                // Calculate the start and end indexes for this paragraph
                $start = $j * $sentencesPerParagraph;
                $end = min(($j + 1) * $sentencesPerParagraph, $numSentences);

                // Extract the sentences for this paragraph
                $paragraph = implode(".", array_slice($sentences, $start, $end - $start));

                // Add the paragraph to the array
                $paragraphs[] = $paragraph;
            }

            echo '<img class="img-fluid rounded" src="./admin/images/' . $image[0] . '">';

            ?>

            <figcaption class='figure-caption text-start mt-1'><?= $row['description'] ?>&nbsp;Image 1</figcaption>

            <!--            <img src="girl.jpg" class="img-fluid rounded" alt="...">-->
            <h4 class="border-bottom pb-2 mb-2 border-secondary-subtle border-2 mt-2"><a
                        href="Detail.php?id=<?= urldecode($row['id']) ?>"> <?= $row['description'] ?></a></h4>
                <?php
                echo $paragraphs[0];
                ?>
            <a style="color: #900C3F;" href="Detail.php?id=<?= urldecode($row['id']) ?> ">Read More</a>

        </div>

        <div class="col">

            <?php
            echo '<img class="img-fluid rounded" src="./admin/images/' . $image[1] . '">';
            ?>
            <figcaption class='figure-caption text-start mt-1'><?= $row['description'] ?>&nbsp;Image 2</figcaption>

            <div style="overflow: hidden; height: 165px;">
                <?php
                echo $paragraphs[1];
                ?>
            </div>
            <a style="color: #900C3F;" href="Detail.php?id=<?= urldecode($row['id']) ?> ">Read More</a>


        </div>
        <?php
        }
        ?>

        <div class="col-3">
            <?php
            $obj = new UserFunction();
            $stmt = $obj->editorRecentNews($id);
            if ($stmt->num_rows > 0) {
                while ($row = $stmt->fetch_assoc()) {
                    $image = unserialize($row['image']);
                    ?>

                    <div class="row border-bottom border-secondary p-3" style="margin-top: 8px;">

                        <div class="col-5">
                            <?php
                            echo '<img class="img-fluid rounded" src="./admin/images/' . $image[0] . '">';
                            ?>
                        </div>
                        <div class="col-7" style="overflow: hidden; height: 60px;">
                            <small><a class=""
                                      href="Detail.php?id=<?= urldecode($row['id']) ?>"> <?= $row['description'] ?></a></small>
                        </div>

                    </div>

                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
    <!--  //Editor's Opinion  -->

    <!--  Show Category  -->

    <div class="row mt-4 aa">

        <div class="col-9">
            <div class="row">
                <?php
                $aaa = new UserFunction();
                $bbb = $aaa->getcatelatestnews();
                if ($bbb->num_rows > 0) {

                    while ($row = $bbb->fetch_assoc()) {
                        $img = unserialize($row['image']);
                        ?>

                        <div class="col-3">
                            <h5 class="text-danger">
                                <a class="text-danger fw-semibold"
                                   href="Categories.php?cname=<?= urlencode($row['category']) ?>"><?= $row['category'] ?></a>
                            </h5>
                            <?php
                            echo '<img class="img-fluid rounded" src="./admin/images/' . $img[0] . '">';
                            ?>
                            <p class="fw-semibold pb-2 mb-4 mt-2" style="overflow: hidden; height: 74px;">
                                <a href="Detail.php?id=<?= urlencode($row['id']) ?>"><?= $row['description'] ?> </a>
                            </p>
                        </div>

                        <?php
                    }
                }
                ?>

            </div>

        </div>

        <div class="col-3">
            <h5 class="text-danger fw-semibold">Advertisement</h5>
            <?php
            $ads = new UserFunction();
            $image = $ads->gettingOverADs();
            if ($image->num_rows > 0) {
                while ($row = $image->fetch_assoc()) {
                    $imm = unserialize($row["image"]);
                    echo '<img class="img-fluid rounded" src="./admin/adsimages/' . $imm[0] . '">';


                }
            }
            ?>

            <!--            <ul class="list-group list-group-flush">-->
            <!--                <li class="list-group-item">Yumeko is a tall, beautiful girl with a curvy figure, long thick black-->
            <!--                </li>-->
            <!--                <li class="list-group-item">Yumeko is a tall, beautiful girl with a curvy figure, long thick black-->
            <!--                </li>-->
            <!--                <li class="list-group-item">Yumeko is a tall, beautiful girl with a curvy figure, long thick black-->
            <!--                </li>-->
            <!--                <li class="list-group-item">Yumeko is a tall, beautiful girl with a curvy figure, long thick black-->
            <!--                </li>-->
            <!---->
            <!--            </ul>-->


        </div>


    </div>

    <!-- //Show Category -->

    <!--  Random News  -->

    <div class="row mt-5">
        <?php

        $obj = new UserFunction();
        $result = $obj->getMidNews();
        $count = $result->num_rows;
        $news = $result->fetch_all();

        // Your count variable
        $randomNumbers = [];

        // Generate 9 unique random numbers
        while (count($randomNumbers) < 9) {
            $randomNumber = rand(0, $count - 1);
            $randomNumbers[$randomNumber] = $randomNumber;
        }

        // Get only the values (not keys)
        $randomNumbers = array_values($randomNumbers);

        ?>

        <div class="col">

            <?php
            $image1 = $news[$randomNumbers[0]][4];
            $ima1 = unserialize($image1);

            echo '<img class="img-fluid rounded" src="./admin/images/' . $ima1[0] . '">';
            ?>

            <p class="fw-semibold border-bottom pb-2 mb-3 border-secondary-subtle border-2 mt-2"
               style="overflow: hidden; height: 77px;">

                <a href="Detail.php?id=<?= urlencode($news[$randomNumbers[0]][0]) ?>"> <?= $news[$randomNumbers[0]][2] ?> </a>

            </p>

            <div class="row">
                <!--         insert news information       -->
                <div class="col-5">
                    <?php
                    $image1 = $news[$randomNumbers[1]][4];
                    $ima1 = unserialize($image1);

                    echo '<img class="img-fluid rounded" src="./admin/images/' . $ima1[0] . '">';
                    ?>
                </div>
                <div class="col-7 fourthpagecolum1text">
                    <a class="" href="Detail.php?id=<?= urlencode($news[$randomNumbers[1]][0]) ?>">
                        <?= $news[$randomNumbers[1]][2] ?>
                    </a>
                </div>

            </div>
            <div class="row mt-2 pt-3 border-top border-2 border-secondary-subtle ">

                <div class="col-5">
                    <?php
                    $image1 = $news[$randomNumbers[2]][4];
                    $ima1 = unserialize($image1);

                    echo '<img class="img-fluid rounded" src="./admin/images/' . $ima1[0] . '">';
                    ?>
                </div>
                <div class="col-7 fourthpagecolum1text">
                    <a class="" href="Detail.php?id=<?= urlencode($news[$randomNumbers[2]][0]) ?>">
                        <?= $news[$randomNumbers[2]][2] ?>
                    </a>
                </div>

            </div>
            <div class="row mt-2 pt-3 border-top border-2 border-secondary-subtle ">

                <div class="col-5">
                    <?php
                    $image1 = $news[$randomNumbers[3]][4];
                    $ima1 = unserialize($image1);

                    echo '<img class="img-fluid rounded" src="./admin/images/' . $ima1[0] . '">';
                    ?>
                </div>
                <div class="col-7 fourthpagecolum1text">
                    <a class="" href="Detail.php?id=<?= urlencode($news[$randomNumbers[3]][0]) ?>">
                        <?= $news[$randomNumbers[3]][2] ?>
                    </a>
                </div>

            </div>

        </div>

        <div class="col-6">

            <?php
            $image1 = $news[$randomNumbers[4]][4];
            $ima1 = unserialize($image1);

            echo '<img class="img-fluid rounded" src="./admin/images/' . $ima1[0] . '">';
            ?>


            <div class="fw-semibold border-bottom pb-2 mb-2 border-secondary-subtle border-2 mt-2">
                <a class="" href="Detail.php?id=<?= urlencode($news[$randomNumbers[4]][0]) ?>">
                    <?= $news[$randomNumbers[4]][2] ?>
                </a>
            </div>

            <div class="mt-3" style="overflow: hidden; height: 165px;">
                <?= $news[$randomNumbers[4]][3] ?>
            </div>
            <a class="text-danger" href="Detail.php?id=<?= urlencode($news[$randomNumbers[4]][0]) ?>">
                Read More
            </a>

        </div>

        <div class="col mb-4">

            <?php
            $image1 = $news[$randomNumbers[5]][4];
            $ima1 = unserialize($image1);

            echo '<img class="img-fluid rounded" src="./admin/images/' . $ima1[0] . '">';
            ?>
            <p class="fw-semibold border-bottom pb-3 mb-3 border-secondary-subtle border-2 mt-2"
               style="overflow: hidden; height: 77px;">
                <a class="" href="Detail.php?id=<?= urlencode($news[$randomNumbers[5]][0]) ?>">

                    <?= $news[$randomNumbers[5]][2] ?>
                </a>
            </p>
            <div class="row">
                <div class="col-5">
                    <?php
                    $image1 = $news[$randomNumbers[6]][4];
                    $ima1 = unserialize($image1);

                    echo '<img class="img-fluid rounded" src="./admin/images/' . $ima1[0] . '">';
                    ?>
                </div>
                <div class="col-7 fourthpagecolum1text">
                    <a class="" href="Detail.php?id=<?= urlencode($news[$randomNumbers[6]][0]) ?>">

                        <?= $news[$randomNumbers[6]][2] ?>
                    </a>
                </div>
            </div>
            <div class="row mt-2 pt-3 border-top border-2 border-secondary-subtle ">
                <div class="col-5">
                    <?php
                    $image1 = $news[$randomNumbers[7]][4];
                    $ima1 = unserialize($image1);

                    echo '<img class="img-fluid rounded" src="./admin/images/' . $ima1[0] . '">';
                    ?>
                </div>
                <div class="col-7 fourthpagecolum1text">
                    <a class="" href="Detail.php?id=<?= urlencode($news[$randomNumbers[7]][0]) ?>">

                        <?= $news[$randomNumbers[7]][2] ?>
                    </a>
                </div>
            </div>
            <div class="row mt-2 pt-3 border-top border-2 border-secondary-subtle ">
                <div class="col-5">
                    <?php
                    $image1 = $news[$randomNumbers[8]][4];
                    $ima1 = unserialize($image1);

                    echo '<img class="img-fluid rounded" src="./admin/images/' . $ima1[0] . '">';
                    ?>
                </div>
                <div class="col-7 fourthpagecolum1text">
                    <a class="" href="Detail.php?id=<?= urlencode($news[$randomNumbers[8]][0]) ?>">

                        <?= $news[$randomNumbers[8]][2] ?>
                    </a>
                </div>
            </div>

        </div>

    </div>
    <!--//Random News-->

</div>

<?php include "Footer.php"; ?>
