<!--<style>-->
<!--    .sticky-navbar {-->
<!--        position: -webkit-sticky;-->
<!--        position: sticky;-->
<!--        width: 500px;-->
<!--        top: 0;-->
<!--        background-color: white;-->
<!--        border-radius: 10px;-->
<!--        z-index: 1000;-->
<!--        padding: 15px;-->
<!--        border-bottom: 1px solid #ccc;-->
<!--    }-->
<!---->
<!--    .sport-admin {-->
<!--        /* Add styling for the Sport Admin content if needed */-->
<!--    }-->
<!--</style>-->
<?php
include "include/top_header1.php";
?>
<!--content-->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="sticky-navbar">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Sub Reporter /&nbsp;
        </span>

            <?php
            $role = $_SESSION["subreporter"];
            echo ucfirst($role) . "&nbsp;Admin";
            ?>
        </h4>

        <?php
        if (isset($_SESSION['postsuccess'])) {
            ?>
            <div class="alert alert-success mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['postsuccess'];
                unset($_SESSION['postsuccess']);
                ?>
            </div>
            <?php
        }
        ?>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#small">Post &nbsp; <i
                        class='bx bxs-alarm-add'></i></button>
        </div>
    </div>
    <br>
    <!-- Modal -->
    <div class="modal fade" id="small" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add">Add Post</h5>
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
                                <label for="exampleInputEmail1">Category</label>
                                <input class="form-control" type="text" name="category" value="<?= $role ?>" readonly>
                            </div>
                            <br>
                            <div class="form-group col-md-6">
                                <br>
                                <label for="exampleInputEmail1">Sub Category</label>
                                <select class="form-control" name="subcategory" id="subcategory" required>
                                    <?php
                                    include "OOP.php";

                                    $obj = new database();
                                    $res = $obj->selectsubcategories($role);
                                    if ($res->num_rows > 0) {
                                        while ($r = $res->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $r['sub_name'] ?>"><?= $r['sub_name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <br>
                                        <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                        <textarea class="textarea" cols="50" rows="6" id="mingalar"
                                                  name="postdescription" required>
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
                            <input type="hidden" name="statusValue" value="E">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" name="subreporterpost" class="btn btn-primary">Save changes
                                </button>

                            </div>
                            <!--                            <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>-->
                            <!---->
                            <!--                            <button type="submit" name="subreporterpost"-->
                            <!--                                    class="btn btn-custom waves-effect waves-light btn-md">-->
                            <!--                                Save and Post-->
                            <!--                            </button>-->


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal   -->


    <div class="card">
        <h5 class="card-header">User News</h5>

        <div class="table-responsive tbl-fixed">
            <table class="table ">
                <thead class="table-primary">
                <tr>

                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col" style="width: 65%;">Detail</th>
                    <th scope="col">Image</th>

                </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                <?php

                $obj = new database();
                $result = $obj->getnewsFromUsers($role);
                $count = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ++$count;

                        ?>
                        <tr>

                            <td scope="row"><?= $count ?></td>
                            <td><?= $row['date'] ?></td>
                            <td>
                                <p style="overflow: hidden; height: 20px; width: auto;">
                                    <?= $row['detail'] ?>
                                </p>
                                <a class="text-end" data-bs-toggle="modal"
                                   data-bs-target="#e<?= $row['id'] ?>">
                                    Detail</a>

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
                            </td>
                            <td>  <?php

                                $image = unserialize($row['image']);
                                for ($i = 0; $i < count($image); $i++) {
                                    echo '<img class="w-px-50 h-40 circle" src="./images/' . $image[$i] . '">';
                                }
                                ?></td>

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


    <!-- Bootstrap Table with Header - Dark -->
    <div class="card mt-5">
        <h5 class="card-header">Post News</h5>

        <div class="table-responsive tbl-fixed" style="max-height: 50vh;">
            <table class="table ">
                <thead class="table-primary ">
                <tr>

                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col" style="width: 25%;">Description</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Image</th>
                    <th scope="col">Sub Category</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                <?php

                $obj = new database();
                $result = $obj->getnewsbySubReporter($role);
                $count = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ++$count;

                        ?>
                        <tr>

                            <td scope="row"><?= $count ?></td>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td style="max-height: 10px; ">

                                <p style="overflow: hidden; height: 20px; width: auto;">
                                    <?= $row['detail'] ?></p>

                                <a class="text-end" data-bs-toggle="modal"
                                   data-bs-target="#e<?= $row['id'] ?>">
                                    Detail</a>

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
                            </td>
                            <td>
                                <?php

                                $image = unserialize($row['image']);
                                for ($i = 0; $i < count($image); $i++) {
                                    echo '<img class="w-px-50 h-40 circle" src="./images/' . $image[$i] . '">';
                                }
                                ?></td>

                            <td>
                                <?= $row['sub_category'] ?>
                            </td>
                            <td>
                                <span class="btn btn-primary">
                                    <?php
                                    if ($row['status'] == 'E')
                                        echo "Pending";
                                    else
                                        echo "Approved";
                                    ?>
                                </span>
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


<!--advance text editor-->
<!--<script src="tinymce/js/tinymce/tinymce.min.js"></script>-->
<!--advance text editor -->
<script src="tinymce/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#mingalar',
        width: 750,
        height: 300,
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
            'table', 'emoticons', 'template', 'codesample'
        ],
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist outdent indent |  print preview  fullscreen | ' +
            'forecolor backcolor emoticons',
        menu: {
            favs: {title: 'menu', items: 'code visualaid | searchreplace | emoticons'}
        },
        menubar: ' file edit view format tools',
        content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
    });
</script>
<!--/advance text editor-->

<?php include "include/footer.php" ?>

