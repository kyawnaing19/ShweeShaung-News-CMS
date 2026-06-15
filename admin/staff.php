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
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Staff /</span>&nbsp;Manage Staff</h4>

        <!--Editor-->
        <div class="row mb-5">
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 w-75">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Editor</h5>
                        <img class="img-fluid d-flex mx-auto my-4 rounded " src="assets/img/avatars/editor.jpg" alt="Card image cap"/>
<!--                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editor">-->
<!--                            Add Editor-->
<!--                        </button>-->
                        <br><br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#smallModal">
                            Change Password
                        </button>
                    </div>
                </div>
            </div>

            <!--small modal-->
            <div class="modal fade" id="editor" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add">Add Editor</h5>
                            <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameSmall" class="form-label">Username</label>
                                    <input type="text" id="editorUserName" class="form-control"
                                           placeholder="Enter Username" x/>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameSmall" class="form-label">Password</label>
                                    <input type="text" id="editorpassword" class="form-control"
                                           placeholder="Enter Password"/>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--   Main-Reporter-->

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 w-75">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Special-Reporter</h5>
                        <img class="img-fluid d-flex mx-auto my-4 rounded" src="assets\img\avatars\special.jpg" alt="Card image cap"/>

<!--                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reporter">-->
<!--                            Add Main-Reporter-->
<!--                        </button>-->
                        <br><br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#smallModal">
                            Change Password
                        </button>
                    </div>
                </div>
            </div>

            <!--small modal-->
            <div class="modal fade" id="reporter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add">Add Main-Reporter</h5>
                            <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameSmall" class="form-label">Username</label>
                                    <input type="text" id="repUserName" class="form-control"
                                           placeholder="Enter Username"/>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameSmall" class="form-label">Password</label>
                                    <input type="text" id="reppassword" class="form-control"
                                           placeholder="Enter Password"/>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--small modal-->
            <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Change Password</h5>
                            <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameSmall" class="form-label">Username</label>
                                    <input type="text" id="nameSmall" class="form-control"
                                           placeholder="Enter Username"/>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label class="form-label" for="cpw">Current Password</label>
                                    <input type="password" class="form-control" id="cpw" placeholder="Enter Password"/>
                                </div>
                                <div class="col mb-0">
                                    <label class="form-label" for="npw">New Password</label>
                                    <input type="password" class="form-control" id="npw" placeholder="Enter Password"/>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


            <!--   Sub-Reporter-->

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 w-75">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Sub-Reporter</h5>
                        <img class="img-fluid d-flex mx-auto my-4 rounded" src="assets\img\avatars\subreporter.jpg" alt="Card image cap"/>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#backDropModal">
                            Add reporter
                        </button>
                        <br><br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#ChangePWModal">
                            Change Password
                        </button>
                    </div>

                </div>
            </div>
        </div>


        <!--        sub_reporter modal change password-->


<!--        //for admin information -->
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="table-responsive tbl-fixed" style="max-height: 50vh;">
                <table class="table m-0  "   id="example">
                    <thead class="table-primary">
                    <tr>
                        <th><b>#</b></th>
                        <th><b>Role</b></th>
                        <th><b>User Name</b></th>
                        <th><b>Password</b></th>
                        <th><b>Action</b></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include "OOP.php";
                    $obj = new database();
                    $result = $obj->getAdminInfo();
                    $count = 0;
                    while ($row = $result->fetch_assoc()) {
                        ++$count;
                        ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= ucfirst($row['role']) ?></td>
                            <td><?= $row['role'] ?></td>
                            <td><?= $row['password'] ?></td>
                            <td><a class="text-active btn btn-primary" href="function.php?adminID=<?= urlencode($row["id"]) ?>"><i class="bx bxs-trash-alt"></i></ic></a>
                            </td>
                        </tr>
                    <?php }

                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- change password-->
<div class="modal fade" id="ChangePWModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form action="function.php" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Add Sub-Reporter</h5>
                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailBackdrop" class="form-label">Password</label>

                        <select id="dobBackdrop" class="form-select form-select" name="rolechange" required>
                            <option value="">select role to change password</option>
                            <?php
                            $obj = new database();
                            $result = $obj->getAdminRole();
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value=<?= $row['id'] ?>><?= $row['role'] ?></option>
                                <?php

                            }
                            ?>


                        </select>
                    </div>
                    <div class="col mb-0">
                        <label for="dobBackdrop" class="form-label">Current Password</label>

                        <input name="cpw" type="password" id="emailBackdrop" class="form-control"
                               placeholder="Set Password"/>

                        <label for="dobBackdrop" class="form-label">New Password</label>

                        <input name="npw" type="password" id="emailBackdrop" class="form-control"
                               placeholder="Set Password"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button name="setAdmin" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- end change password modal-->
<!-- BackDropModal -->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form action="function.php" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Add Sub-Reporter</h5>
                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailBackdrop" class="form-label">Password</label>
                        <input name="password" type="password" id="emailBackdrop" class="form-control"
                               placeholder="Set Password"/>
                    </div>
                    <div class="col mb-0">
                        <!--                                            <label for="dobBackdrop" class="form-label">DOB</label>-->
                        <!--                                            <input type="date" id="dobBackdrop" class="form-control" />-->
                        <label for="dobBackdrop" class="form-label">Role</label>
                        <select id="dobBackdrop" class="form-select form-select" name="cate" required>
                            <option value="">Select Role</option>

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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button name="setAdmin" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>


</div>

</div>


<!--footer-->
<?php include "include/footer.php" ?>
<!--/footer-->