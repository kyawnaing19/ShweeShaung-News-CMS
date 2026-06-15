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
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Sub-Categories /</span>&nbsp;Manage Sub-Categories </h4>

        <?php
        if (isset($_SESSION['cateError'])) {
            ?>
            <div class="alert alert-danger mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['cateError'];
                unset($_SESSION['cateError']);
                ?>
            </div>
            <?php
        }
        if (isset($_SESSION['cateSuccess'])) {
            ?>
            <div class="alert alert-success mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['cateSuccess'];
                unset($_SESSION['cateSuccess']);
                ?>
            </div>
            <?php
        }
        if (isset($_SESSION['subcateErr'])) {
            ?>
            <div class="alert alert-danger mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['subcateErr'];
                unset($_SESSION['subcateErr']);
                ?>
            </div>
            <?php
        }
        if (isset($_SESSION['subcateCorr'])) {
            ?>
            <div class="alert alert-success mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['subcateCorr'];
                unset($_SESSION['subcateCorr']);
                ?>
            </div>
            <?php
        }
        ?>

        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <div class="layout-page">

                    <div class="row">

                        <div class="col">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                            <div class="m-b-25 row">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <form id="myForm"
                                                              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                                              method="post" class="d-flex">
                                                            <select class="form-select w-70"
                                                                    aria-label="Default select example" name="cate"
                                                                    onchange="this.form.submit()">
                                                                <option> Select Categories</option>
                                                                <?php
                                                                include("OOP.php");
                                                                $obj = new database();
                                                                $res = $obj->selectcategories();
                                                                if ($res->num_rows > 0) {
                                                                    while ($r = $res->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?= htmlspecialchars($r['C_Name']) ?>">
                                                                            <?= htmlspecialchars($r['C_Name']) ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <a href="#" class="d-block">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary"
                                                                    data-bs-toggle="modal" data-bs-target="#small">
                                                                Add &nbsp; <i class='bx bxs-alarm-add'></i>
                                                            </button>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <br>
                                        <h2>
                                            <?php
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {


                                                $selectedOption = $_POST["cate"];
                                                echo htmlspecialchars($selectedOption);


                                            } else {
                                                echo "Over All";
                                            }


                                            ?>
                                        </h2>
                                        <div class="card mb-4">
                                            <div class="table-responsive tbl-fixed" style="max-height: 35vh;">
                                                <table class="table m-0" id="example">

                                                    <?php

                                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cate"]))
                                                    {
                                                    ?>
                                                    <thead class="table-primary">
                                                    <tr>
                                                        <th><b>#</b></th>
                                                        <th><b>Sub-Category</b></th>
                                                        <th><b>Action</b></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $selectedOption = $_POST["cate"];
                                                    $var = new database();
                                                    $result1 = $var->showsubcategory($selectedOption);
                                                    $count = 0;
                                                    if ($result1->num_rows > 0) {
                                                        while ($row = $result1->fetch_assoc()) {
                                                            ++$count;
                                                            ?>

                                                            <tr>
                                                                <td scope="row"><?= $count ?></td>

                                                                <td><?= htmlspecialchars($row["sub_name"]) ?></td>

                                                                <td>
                                                                    <a class="btn btn-primary btn-sm"
                                                                       href="#"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#e<?= $row['sid'] ?>">
                                                                        <i class="bx bxs-edit-alt"></i>
                                                                    </a>


                                                                    <a class="btn btn-danger btn-sm"
                                                                       href="function.php?id=<?php echo urlencode($row['sid']) ?>">
                                                                        <i class="bx bxs-trash-alt"></i></a>
                                                                </td>
                                                            </tr>

                                                            <!--     edit model           -->

                                                            <div class="modal fade" id="e<?= $row['sid'] ?>"
                                                                 tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog " role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="add">
                                                                                Sub Category</h5>
                                                                            <button
                                                                                    type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form action="function.php"
                                                                                      method="post">
                                                                                    <div class="col mb-3">
                                                                                        <label for="nameSmall"
                                                                                               class="form-label">Sub_Category
                                                                                            Name</label>
                                                                                        <input type="hidden"
                                                                                               name="editsub_sid"
                                                                                               value="<?= $row['sid'] ?>">
                                                                                        <input type="text" id="cid"
                                                                                               class="form-control"
                                                                                               name="editSub_Cate"
                                                                                               placeholder="Enter Category"
                                                                                               value="<?= $row['sub_name'] ?>" autocomplete="off">
                                                                                    </div>

                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                    class="btn btn-outline-secondary"
                                                                                    data-bs-dismiss="modal">
                                                                                Close
                                                                            </button>
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">Save
                                                                            </button>

                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--     end edit model    -->

                                                        <?php }
                                                    }
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <thead class="table-primary">
                                                    <tr>
                                                        <th><b>#</b></th>
                                                        <th><b>Sub-Category</b></th>
                                                        <th><b>Action</b></th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $var = new database();
                                                    $result1 = $var->showoversubcategory();
                                                    $count = 0;
                                                    if ($result1->num_rows > 0) {
                                                        while ($row = $result1->fetch_assoc()) {
                                                            ++$count;
                                                            ?>
                                                            <tr>
                                                                <td scope="row"><?= $count ?></td>

                                                                <td><?= $row["sub_name"] ?></td>

                                                                <td><a href="#" class="btn btn-primary btn-sm"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#e<?= $row['sid'] ?>">
                                                                        <i class="bx bxs-edit-alt"></i></a>


                                                                    <a class="btn btn-danger btn-sm"
                                                                       href="function.php?id=<?php echo urlencode($row['sid']) ?>">
                                                                        <i class="bx bxs-trash-alt"></i></a>
                                                                </td>


                                                                <!--     overall edit Model        -->
                                                                <div class="modal fade" id="e<?= $row['sid'] ?>"
                                                                     tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog " role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="add">
                                                                                    Sub Category</h5>
                                                                                <button
                                                                                        type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <form action="function.php"
                                                                                          method="post">
                                                                                        <div class="col mb-3">
                                                                                            <label for="nameSmall"
                                                                                                   class="form-label">Sub_Category
                                                                                                Name</label>
                                                                                            <input type="hidden"
                                                                                                   name="editsub_sid"
                                                                                                   value="<?= $row['sid'] ?>">
                                                                                            <input type="text" id="cid"
                                                                                                   class="form-control"
                                                                                                   name="editSub_Cate"
                                                                                                   placeholder="Enter Category"
                                                                                                   value="<?= $row['sub_name'] ?>">
                                                                                        </div>

                                                                                </div>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-outline-secondary"
                                                                                        data-bs-dismiss="modal">
                                                                                    Close
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-primary">Save
                                                                                    changes
                                                                                </button>

                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </tr>
                                                            <?php
                                                        }
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
                    <!--Modal-->
                    <div class="modal fade" id="small" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary-emphasis fw-semibold" id="add">Add Sub Category</h5>
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
                                                <select class="form-select w-25" aria-label="Default select example"
                                                        name="cate">
                                                    <?php


                                                    $obj = new database();
                                                    $res = $obj->selectcategories();
                                                    if ($res->num_rows > 0) {
                                                        while ($r = $res->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?= $r['C_Name'] ?>"><?= $r['C_Name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col mb-3">
                                                <label for="nameSmall" class="form-label">Sub_Category Name</label>
                                                <input type="text" id="editorUserName" class="form-control"
                                                       name="subcate" placeholder="Enter Category" autocomplete="off"/>
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
                    <!--- end row -->
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                            <br><h4 class=""> &nbsp; Deleted Categories</h4>
                                        </div>
                                        <div class="table-responsive tbl-fixed" style="max-height: 35vh;">
                                            <table class="table m-0  " id="example1">
                                                <thead class="table-primary">
                                                <tr>
                                                    <th><b>#</b></th>
                                                    <th><b>Category</b></th>
                                                    <th><b>Sub-Category</b></th>
                                                    <th><b>Action</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php


                                                $var = new database();
                                                $result1 = $var->recycle_Show_SubCategory();
                                                $count = 0;
                                                if ($result1->num_rows > 0) {
                                                    while ($row = $result1->fetch_assoc()) {
                                                        ++$count;
                                                        ?>

                                                        <tr>
                                                            <td scope="row"><?= $count ?></td>

                                                            <td><?= $row["C_Name"] ?></td>
                                                            <td><?= $row["sub_name"] ?></td>

                                                            <td><a class="btn btn-primary btn-sm"
                                                                   href="function.php?restoreid=<?php echo urlencode($row['sid']) ?>">
                                                                    <i class='bx bx-revision'
                                                                       title="Restore this category"></i></a>
                                                                &nbsp;&nbsp;<a class="btn btn-danger btn-sm"
                                                                               href="function.php?deleteid=<?php echo urlencode($row['sid']) ?>">
                                                                    <i class="bx bxs-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php }
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
    </div>
</div>
<script>
    function submitForm() {
        document.getElementById("myForm").submit();
    }
</script>
<?php include "include/footer.php" ?>


