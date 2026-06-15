<?php
include "Nav.php";

$news = new UserFunction();
$id = 0;
$category = '';
$reid = 0;

if (isset($_GET["id"]))
{
$id = $_GET["id"];


$result = $news->getNews($id);

$row = $result->fetch_assoc();

//   $count=$row["count"]+1;
//
//}
$mustRead = new UserFunction();
$mustRead->updateCount($id);


?>

<!--    <button class="border-0" onclick="fun()" ><i class="bi bi-arrow-left-square-fill fs-1 position-absolute m-3"></i></button>-->
<!---->
<!--    <script type="text/javascript">-->
<!--        function fun(){-->
<!--            window.location="Home.php";-->
<!--        }-->
<!--    </script>-->

<div class="container text-start mt-3">

    <div class="row aa">
        <div class="col-9">
            <h2 class="mb-4 bi-text-paragraph fw-bold"><?= $row['description'] ?>&nbsp;(<?= $row['date'] ?>)</h2>

            <?php

            $image = unserialize($row['image']);
            $paragraphs = [];
            $category = $row['category'];
            $reid = $row['id'];

            $paragraphFromDB = $row['detail'];
            // Split the paragraph into an array of sentences
            // Replace "။" with "."
            $paragraphFromDB = str_replace("။", ".", $paragraphFromDB);

            // Explode sentences with "." as delimiter
            $sentences = explode(".", $paragraphFromDB);


            // Calculate the number of sentences in each paragraph
            $numSentences = count($sentences);
            $sentencesPerParagraph = ceil($numSentences / 3); // Round up to ensure even distribution

            // Initialize an array to hold the paragraphs
            $paragraphs = array();

            // Split the array of sentences into three separate paragraphs
            for ($j = 0; $j < 3; $j++) {
                // Calculate the start and end indexes for this paragraph
                $start = $j * $sentencesPerParagraph;
                $end = min(($j + 1) * $sentencesPerParagraph, $numSentences);

                // Extract the sentences for this paragraph
                $paragraph = implode(".", array_slice($sentences, $start, $end - $start));

                // Add the paragraph to the array
                $paragraphs[] = $paragraph;
            }


            for ($a = 0;
            $a < count($paragraphs);
            $a++) {
            // Output the paragraphs

            echo '<img class="img-fluid rounded" src="./admin/images/' . $image[$a] . '">';
            ?>
            <figcaption class='figure-caption text-start mt-1'><?= $row['description'] ?>
                &nbsp;Image <?= $a + 1; ?></figcaption>
            <br><br>
            <p class="justify-content-end">
                <?php
                echo $paragraphs[$a];

                echo "<br><br><br>";


                }
                ?>
            </p>
        </div>
        <div class="col-3">
            <div class="row"><h3 class="tab-content text-danger">Recent news</h3></div>
            <?php
            $obj = new UserFunction();
            $stmt = $obj->getRecentNews($reid);
            if ($stmt->num_rows > 0) {

                $img = [];

                while ($row = $stmt->fetch_assoc()) {
                    $img = unserialize($row['image']);
                    ?>
                    <div class="row py-3 aa">
                        <div class="col-6">
                            <?php
                            echo '<img class="img-fluid rounded" src="./admin/images/' . $img[0] . '">';
                            ?>
                        </div>
                        <div class="col-6 bx-align-justify" style="overflow: hidden; height: 85.5px;">
                            <small>
                                <a href="Detail.php?id=<?= urlencode($row['id']) ?>">  <?= $row["description"] ?> </a></small>
                        </div>
                    </div>

                    <?php

                }
            }

           //for ads
            $ob=new UserFunction();
            $stm=$ob->gettingADs($category);
            $row=$stm->fetch_assoc();
            if(isset($row['image'])){

                $img=unserialize($row['image']);

                for($i=0;$i<count($img);$i++)
                {

            ?>
            <div class="row mt-xxl-5" style="height: 400px;">
           <?php   echo '<img class="img-fluid rounded" style="width:100%;height:100%;" src="./admin/adsimages/' .$img[$i] . '">';?>
            </div>
<?php }}?>
        </div>
    </div>

    <div class="row">
        <div class="col-9 ">
            <p class="text-body ">

        </div>
    </div>


    <div class="row">
        <div class="col-3 mt-1">
            <h3 class="text-start fw-bolder">Related News</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-5">

            <?php
            $obj = new UserFunction();
            $var = $obj->getrelatednews($category, $reid);
            if ($var->num_rows > 0) {
                while ($row = $var->fetch_assoc()) {
                    $relatedimage = unserialize($row['image']);
                    ?>

                    <div class="row border-bottom border-secondary pb-1 " style="margin-top: 8px;">
                        <div class="col-3 my-2">
                            <?php
                            echo '<img class="img-fluid rounded" src="./admin/images/' . $relatedimage[0] . '">';
                            ?>
                        </div>


                        <div class="col-9">
                            <a href="Detail.php?id=<?= urlencode($row['id']) ?>">
                                <?= $row['description'] ?></a>
                        </div>

                    </div>

                    <?php
                }
            }
            }
            ?>

        </div>

    </div>
</div>

<?php include "Footer.php"; ?>

