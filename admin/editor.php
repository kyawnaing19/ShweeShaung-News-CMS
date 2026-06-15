<?php
include "include/top_header1.php";
include "OOP.php";
?>
<!--content-->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"> Editor
        </span>
    </h4>

     <?php
    if(isset($_SESSION['postsuccess'])){
        ?>
    <div class="alert alert-success mt-3" role="alert" id="success-alert">
                <?php  echo $_SESSION['postsuccess'];
                unset( $_SESSION['postsuccess'] );
                ?>
    </div>
        <?php
    }
     if(isset($_SESSION['deletesuccess'])){
         ?>
         <div class="alert alert-danger mt-3" role="alert" id="success-alert">
             <?php  echo $_SESSION['deletesuccess'];
             unset( $_SESSION['deletesuccess'] );
             ?>
         </div>
         <?php
     }
    ?>

    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#small">Post &nbsp; <i
                    class='bx bxs-alarm-add'></i></button>

        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Category
        </button>

        <div style="max-width: 200px" class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
             aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title fw-semibold" id="offcanvasWithBothOptionsLabel">Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <hr>
            <div class="offcanvas-body">

<!--                <ul>-->

                    <?php
                    /*$result = new database();


                    $res = $result->getcategories();
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            */?><!--
                            <?php
/*                            $result1 = new database();
                            $count = $result1->categorycount($row["C_Name"]);
                          //  echo $count;
                            */?>
                            <a href="editor.php?cname=<?php /*= urlencode($row['C_Name']) */?> ">
                                <li><?php /*= $row["C_Name"] */?><p><?php /*= $count*/?></p></li>
                            </a>


                            --><?php
/*                        }
                    }*/

                    $result = new Database();
                    $res = $result->getcategories();
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            $result1 = new Database();
                            $count = $result1->categorycount($row["C_Name"]);
                            ?>
<!--                            <a href="editor.php?cname=--><?php //= urlencode($row['C_Name']) ?><!--">-->
<!--                                <li>--><?php //= $row["C_Name"] ?><!--<p>--><?php //= $count?><!--</p></li>-->
<!--                            </a>-->
                            <a href="editor.php?cname=<?= urlencode($row['C_Name']) ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 style="color: #000000" class="mb-4"><?= $row["C_Name"] ?></h5>
                                    <span style="color: #900C3F" class="badge text"><?= $count ?></span>
                                </div>
                            </a>
                            <?php
                        }
                    }
                    ?>
<!--                </ul>-->

            </div>
        </div>

    </div>
    <br>
    <!-- Modal -->
    <div class="modal fade" id="small" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add">Add Opinion</h5>
                    <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <form name="addpost" method="post" class="row" enctype="multipart/form-data"
                              action="function.php">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Post Title</label>
                                <input type="text" class="form-control" id="posttitle" name="posttitle"
                                       placeholder="Enter title" required>
                            </div>
                            <div class="form-group col-md-6">

                                <?php
                                $editor="";
                                if(isset($_SESSION["editor"])) {
                                    $editor = $_SESSION["editor"];
                                    echo $editor;
                                }?>
                                <label for="exampleInputEmail1">Category</label>
                                <input class="form-control" type="text" name="category" value="<?=$editor?>" readonly>
                            </div>
<!--                            <div class="form-group col-md-6">-->
<!--                                <label for="exampleInputEmail1">Sub Category</label>-->
<!--                                <select class="form-control" name="subcategory" id="subcategory" required>-->
<!---->
<!--                                </select>-->
<!--                            </div>-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <br>
                                        <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                        <textarea class="summernote" id="default" name="postdescription" required>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <br>
                                        <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                        <input type="file" class="form-control" id="postimage" name="files[]" multiple
                                               required>
                                    </div>
                                </div>
                            </div>

                            <br><br>
                            <div class="modal-footer">
                                <input type="hidden" name="statusValue" value="U">
                                <input type="hidden" name="subcategory" value="editorPick">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" name="editorPost" class="btn btn-primary">Save changes</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal   -->

<!--    <div class="card">-->
<!--        <h5 class="card-header">News Information</h5>-->
<!---->
<!--        <div class="table-responsive tbl-fixed">-->
<!--            <table class="table tablesize">-->
<!--                <thead class="table-primary">-->
    <div class="card mt-5">
        <h5 class="card-header">Get News Info/<span class="text-danger">
                <?php
                if(isset($_GET["cname"])) {
               echo ucfirst($_GET["cname"]);
                }?></span></h5>



        <div class="table-responsive tbl-fixed">
            <table class="table ">
                <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th style="width: 250px;" scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col" style="width: 15%;">Description</th>
                    <th scope="col">Image</th>
                    <th style="width: 250px;" scope="col">Sub Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                <?php

                if (isset($_GET["cname"])) {

                    $cname = $_GET["cname"];
                    $obj = new database();
                    $result = $obj->getnewsbyEidtors($cname);
                    $count = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ++$count;

                            ?>
                            <form action="function.php" method="post">
                                <tr>
                                    <input type="hidden" value="<?= $row['category'] ?>" name="catename">
                                    <td><?= $count ?></td>
                                    <td><?= $row["date"] ?></td>
                                    <td>
                                        <p style="overflow: hidden; height: 46.5px; width: 300px;">

                                        <?= $row["description"] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p style="overflow: hidden; height: 46.5px; width: 300px;">
                                            <?= $row['detail'] ?>
                                        </p>
                                        <a class="text-end text-danger cursor-pointer" data-bs-toggle="modal"
                                           data-bs-target="#e<?= $row['id'] ?>">
                                            Read More...</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="e<?= $row['id'] ?>" tabindex="-1"
                                             aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="width: 180%; left: -220px;">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Description</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= $row['detail'] ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
<!--                                        --><?php //= $row["detail"] ?>
                                    </td>
                                    <td style="width: 300px;"> <?php

                                        $image=unserialize($row['image']);
                                        for($i=0;$i<count($image);$i++){
                                            echo '<img class="w-px-50 h-40 circle" src="./images/'. $image[$i].'">';
                                        }
                                        ?></td>

                                    <td ><?= $row["sub_category"] ?></td>
                                    <td><?php
                                        if ($row['status'] == 'E') { ?>
                                            <input type="hidden" name="nid" value="<?= $row['id'] ?>">
                                            <button class="btn btn-gray text-black" type="submit">Approve</button>
                                        <?php } else {
                                            ?>

                                                <input class="text-white btn btn-primary" type="button" value="Approved">

<!--                                            <button class="btn btn-primary" type="submit" disabled>Approved</button>-->
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary text-white" href="function.php?newsid=<?php echo urlencode($row['id']) ?>&amp;dStatus=<?php echo urlencode($row['status']) ?>"> Delete</a
                                    </td>
                                </tr>
                            </form>
                            <?php

                        }
                    }
                }
                ?>

                </tbody>
            </table>
        </div>

    </div>


    <!-- Bootstrap Table with Header - Dark -->
    <div class="card mt-5">
        <h5 class="card-header">Editor Opinion</h5>

        <div class="table-responsive tbl-fixed">
            <table class="table">
                <thead class="table-primary">
                <tr>

                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>

                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                <tr>
                    <?php


                    $editor = "";
                    if (isset($_SESSION["editor"])) {
                        $editor = $_SESSION["editor"];

                    }

                    $obj = new database();
                    $result = $obj->getnewsbyEditor($editor);
                    $count = 0;
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    ++$count;

                    ?>

                    <td scope="row"><?=$count?></td>
                    <td><?=$row["date"]?></td>
                    <td><?=$row["description"]?></td>

<!--                    edit  moe win-->
<!--                    <td>--><?php //=$row["detail"]?><!--</td>-->
                    <td>
                        <p style="overflow: hidden; height: 23px; width: 300px;">
                            <?= $row['detail'] ?>
                        </p>
                        <a class="text-end text-danger cursor-pointer" data-bs-toggle="modal"
                           data-bs-target="#e<?= $row['id'] ?>">
                            Read More...</a>
                        <!-- Modal -->
                        <div class="modal fade" id="e<?= $row['id'] ?>" tabindex="-1"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width: 180%; left: -220px;">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Description</h1>
                                    </div>
                                    <div class="modal-body">
                                        <?= $row['detail'] ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--                                        --><?php //= $row["detail"] ?>
                    </td>
                    <td> <?php

                        $image=unserialize($row['image']);
                        for($i=0;$i<count($image);$i++){
                            echo '<img class="w-px-50 h-40 circle" src="./images/'. $image[$i].'">';
                        }
                        ?></td>

                    <!--                    <td><button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">-->
<!--                           Delete-->
<!--                        </button></td>-->
                    <td >
                        <a class="btn btn-secondary text-white" href="function.php?newsid=<?php echo urlencode($row['id']) ?>&amp;dStatus=<?php echo urlencode($row['status']) ?>"> Delete</a>
                    </td>
                </tr>
                </form>
                <?php
                }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
</div>
<!--/ Bootstrap Table with Header Dark -->


</div>
</div>
<!--/content-->
<!--    layout-page-->
</div>


<!--advance text editor -->
<script src="tinymce/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#default',
        width: 750,
        height: 300,
        plugins:[
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
            'table', 'emoticons', 'template', 'codesample'
        ],
        toolbar: 'undo redo| bold italic underline | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist outdent indent |  print preview  fullscreen | ' +
            'forecolor backcolor emoticons',
        menu: {
            favs: {title: 'menu', items: 'code visualaid | searchreplace | emoticons'}
        },
        menubar: 'favs file edit view format tools',
        content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
    });
</script>
<!--/advance text editor-->

<?php include "include/footer.php" ?>

</body>
</html>