<!-- Top Bar Start -->
<?php include('include/left_slidebar.php'); ?>
<!-- Top Bar End -->

<!-- Top Bar Start -->
<?php include('include/top_header.php'); ?>
<!-- Top Bar End -->
<?php include "OOP.php";?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Advertisement /</span>&nbsp;Manage Advertisement </h4>

        <?php
        if (isset($_SESSION['adminExit'])) {
            ?>
            <div class="alert alert-danger mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['adminExit'];
                unset($_SESSION['adminExit']);
                ?>
            </div>
            <?php
        }
        if (isset($_SESSION['adsSuccess'])) {
            ?>
            <div class="alert alert-success mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['adsSuccess'];
                unset($_SESSION['adsSuccess']);
                ?>
            </div>
            <?php
        }
        if (isset($_SESSION['deleteads'])) {
            ?>
            <div class="alert alert-success mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['deleteads'];
                unset($_SESSION['deleteads']);
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
                                            data-bs-target="#small">Add<i class='bx bxs-alarm-add'></i></button>

                                </div>

                            </div>
                            <br>
                            <div class="card mb-4">

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
                        <h5 class="modal-title text-secondary-emphasis fw-semibold" id="add">Add Advertisement</h5>
                        <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="function.php" method="post" enctype="multipart/form-data">
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
                                    <label for="nameSmall" class="form-label">Ads Name</label>
                                    <input type="text" id="editorUserName" class="form-control" name="adsname"
                                           placeholder="Enter Ads Name"/>
                                </div>
                                <div class="col mb-3">
                                    <label for="nameSmall" class="form-label">Ads Photo</label>
                                    <input type="file" id="editorUserName" class="form-control" name="files[]" multiple
                                           required>
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
        <!--//model-->

        <div class="row">

            <div class="col">

                <div class="row">
                    <div class="col-md-12">
                        <div class="demo-box m-t-20">
                            <div class="m-b-30">

                                <div class="m-b-30">
                                    <br><h4 class="">Advertisement Infomation</h4>
                                </div>

                            </div>
                            <br>
                            <div class="card mb-4">
                                <div class="table-responsive tbl-fixedforads">
                                    <table class="table m-0 tablesizeforads" id="example">
                                        <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Ads Name</th>
                                            <th>Category Name</th>
                                            <th>Ads Image</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        $obj1=new database();
                                        $res=$obj1->getAds();
                                        $count=0;
                                        while ($row=$res->fetch_assoc())
                                        { ++$count;

                                            ?>
                                            <tr>
                                                <td><?=$count?></td>
                                                <td><?=$row['ads_name']?></td>
                                                <td><?=$row['C_Name']?></td>
                                                <td> <?php

                                                    $image=unserialize($row['image']);
                                                    for($i=0;$i<count($image);$i++){
                                                        echo '<img class="w-px-50 h-40 circle" src="./adsimages/'. $image[$i].'">';
                                                    }
                                                    ?></td>
                                                <td><a class="text-secondary" href="function.php?adsid=<?= urlencode($row['aid']) ?>"> Delete</a></td>


                                      <?php  }

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

<!--footer-->
<?php include "include/footer.php" ?>
