<!-- Top Bar Start -->
<?php include('include/left_slidebar.php'); ?>
<!-- Top Bar End -->

<!-- Top Bar Start -->
<?php include('include/top_header.php'); ?>
<!-- Top Bar End -->

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Categories /</span>&nbsp;Manage Categories </h4>

        <?php
        if (isset($_SESSION['cateErr'])) {
            ?>
            <div class="alert alert-danger mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['cateErr'];
                unset($_SESSION['cateErr']);
                ?>
            </div>
            <?php
        }
        if (isset($_SESSION['cateCorr'])) {
            ?>
            <div class="alert alert-success mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['cateCorr'];
                unset($_SESSION['cateCorr']);
                ?>
            </div>
            <?php
        }
        if (isset($_SESSION['catenameError'])) {
            ?>
            <div class="alert alert-danger mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['catenameError'];
                unset($_SESSION['catenameError']);
                ?>
            </div>
            <?php
        }
        if (isset($_SESSION['catenameSuccess'])) {
            ?>
            <div class="alert alert-success mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['catenameSuccess'];
                unset($_SESSION['catenameSuccess']);
                ?>
            </div>
            <?php
        }
        ?>


        <div class="row">

            <div class="col">

                <div class="row">
                    <div class="col-md-12">
                        <div class="demo-box m-t-20">
                            <div class="m-b-30">

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#small">Add &nbsp; <i class='bx bxs-alarm-add'></i></button>

                                </div>

                            </div>
                            <br>
                            <div class="card mb-4">
                                <div class="table-responsive tbl-fixed" style="max-height: 35vh;">
                                    <table class="table m-0 " id="example">
                                        <thead class="table-primary">
                                        <tr>
                                            <th><b>#</b></th>
                                            <th><b>Category</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        include "OOP.php";
                                        $obj = new database();
                                        $result = $obj->getcategories();
                                        $count = 0;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ++$count;
                                                ?>

                                                <tr>

                                                    <td scope="row"><?php echo $count ?></td>
                                                    <td><?php echo $row["C_Name"]; ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm"
                                                           data-bs-toggle="modal" data-bs-target="#e<?= $row['CID'] ?>"><i
                                                                    class="bx bx-edit-alt"></i></a>
                                                        &nbsp;<a class="btn btn-danger btn-sm"
                                                                 href="function.php?C_Name=<?php echo urlencode($row['C_Name']) ?>">
                                                            <i class="bx bxs-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <!--edit modal-->
                                                <div class="modal fade" id="e<?= $row['CID'] ?>" tabindex="-1"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog " role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="add">Category</h5>
                                                                <button
                                                                        type="button"
                                                                        class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <form action="function.php" method="post">
                                                                        <div class="col mb-3">
                                                                            <label for="nameSmall" class="form-label">Category
                                                                                Name</label>
                                                                            <input type="hidden" name="cid"
                                                                                   value="<?= $row['CID'] ?>">
                                                                            <input type="text" id="cid"
                                                                                   class="form-control" name="editCate"
                                                                                   placeholder="Enter Category"
                                                                                   value="<?= $row['C_Name'] ?>" autocomplete="off">
                                                                        </div>

                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes
                                                                </button>

                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
                </div>
            </div>
        </div>
        <!--edit modal-->

        <!--model-->
        <div class="modal fade" id="small" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-secondary-emphasis fw-semibold"  id="add">Add Category</h5>
                        <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="function.php" method="post">
                                <div class="col mb-3">
                                    <label for="nameSmall" class="form-label">Category Name</label>
                                    <input type="text" id="editorUserName" class="form-control" name="addCate"
                                           placeholder="Enter Category" autocomplete="off"/>
                                </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col">

                <div class="row">
                    <div class="col-md-12">
                        <div class="demo-box m-t-20">
                            <div class="m-b-30">

                                <div class="m-b-30">
                                    <br><h4 class="">Recycle Categories</h4>
                                </div>

                            </div>
                            <br>
                            <div class="card mb-4">
                                <div class="table-responsive tbl-fixed" style="max-height: 35vh;">
                                    <table class="table m-0 " id="example">
                                        <thead class="table-primary">
                                        <tr>
                                            <th><b>#</b></th>
                                            <th><b>Category</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php

                                        $obj1 = new database();
                                        $result = $obj1->getRecycleCategories();
                                        $cateCount = 0;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ++$cateCount;
                                                ?>
                                                <tr>

                                                    <td scope="row"><?php echo $cateCount ?></td>
                                                    <td><?php echo $row["C_Name"] ?></td>


                                                    <td><a class="btn btn-primary btn-sm"
                                                           href="function.php?C_Name=<?php echo urlencode($row['C_Name']) ?>&status=<?php echo urlencode($row['Status']) ?>"><i
                                                                    class="bx bx-revision"></i></a>
                                                        &nbsp;<a class="btn btn-danger btn-sm"
                                                                 href="function.php?deleteCate=<?php echo urlencode($row['C_Name']) ?>">
                                                            <i class="bx bxs-trash-alt"></i></a>
                                                    </td>
                                                </tr>

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
                </div>
            </div>
        </div>
    </div>
</div>
<!--- end row -->

<!--small modal-->


<!-- content -->
<!--footer-->
<?php include "include/footer.php" ?>
<!--/footer-->

<!--<script>-->
<!--    // JavaScript to handle the modal opening event-->
<!--    $(document).ready(function() {-->
<!--        // Your JavaScript code here-->
<!--        $('#edit').on('show.bs.modal', function (event) {-->
<!--            var button = $(event.relatedTarget);-->
<!--            var cateName = button.attr('id');-->
<!--            $('#editorUserName').val(cateName);-->
<!--        });-->
<!--    });-->
<!---->
<!--    // JavaScript to handle the modal opening event-->
<!--    $(document).ready(function() {-->
<!--        // Your JavaScript code here-->
<!--        $('#edit').on('show.bs.modal', function (event) {-->
<!--            var button = $(event.relatedTarget);-->
<!--            var cateName = button.attr('id');-->
<!--            $('#editorUser').val(cateName);-->
<!--        });-->
<!--    });-->
<!--</script>-->