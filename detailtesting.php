<html>
<head>

    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.2-dist\css\bootstrap.css">
    <script src="bootstrap-5.3.2-dist\js\bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<div class="container">

    <div class="row ">

        <div class="col-9">

            <?php
            include "userOOP.php";
            $news=new UserFunction();
            $result= $news->getNews();

            $row=$result->fetch_assoc();

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


                for ($a = 0; $a < count($paragraphs); $a++) {
                    // Output the paragraphs

            echo '<div class='row'><img class="w-px-50 h-40 circle img-fluid rounded" src="./admin/images/' . $image[$a] . '"></div>';


                     echo "<div class='row'>".$paragraphs[$a]."</div>";

                    echo "<br><br>";
                }

            ?>

        </div>

            <div class="col-3">
                <div class="row"> <h3 class="tab-content">Recent news</h3></div>
                <div class="row">
                    <div class="col-6">
                        <img src="girl.jpg" class="img-fluid rounded" alt="...">
                    </div>
                    <div class="col-6"> jkdlfjksdhgnsdo;gnhsjkkjfj sdkgjsokg;m</div>
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <img src="girl.jpg" class="img-fluid rounded" alt="...">
                    </div>
                    <div class="col-6"> jkdlfjksdhgnsdo;gnhsjkkjfj sdkgjsokg;m</div>
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <img src="girl.jpg" class="img-fluid rounded" alt="...">
                    </div>
                    <div class="col-6"> jkdlfjksdhgnsdo;gnhsjkkjfj sdkgjsokg;m</div>
                </div>
                <div class="row mt-3"> <img src="ads.jpg" class="img-fluid rounded" alt="..."> </div>

            </div>

        </div>

</div>

</body>
</html>