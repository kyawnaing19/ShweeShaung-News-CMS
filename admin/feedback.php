<!-- Top Bar Start -->
<?php include('include/left_slidebar.php');

?>
<!-- Top Bar End -->

<!-- Top Bar Start -->
<?php include('include/top_header.php'); ?>
<!-- Top Bar End -->
<?php include "OOP.php";?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Feedback /</span>&nbsp;Users Feedback </h4>

        <?php

        if (isset($_SESSION['deletefeedback'])) {
            ?>
            <div class="alert alert-danger mt-3" role="alert" id="success-alert">
                <?php echo $_SESSION['deletefeedback'];
                unset($_SESSION['deletefeedback']);

                ?>
            </div>

            <?php
        }
        ?>
        <!--edit modal-->

        <!--model-->

        <!--//model-->

        <div class="row">

            <div class="col">

                <div class="row">
                    <div class="col-md-12">
                        <div class="demo-box m-t-20">
                            <div class="m-b-30">

                                <div class="m-b-30">
                                    <br><h4 class="">Users Feedback Infomation</h4>
                                </div>

                            </div>
                            <br>
                            <div class="card mb-4">
                                <div class="table-responsive tbl-fixedforads">
                                    <table class="table m-0 tablesizeforads" id="example">
                                        <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        $obj1=new database();
                                        $res=$obj1->getFeedback();
                                        $count=0;
                                        while ($row=$res->fetch_assoc())
                                        { ++$count;

                                        ?>
                                        <tr>
                                            <td><?=$count?></td>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['email']?></td>
                                            <td><?=$row['message']?></td>

                                            <td><a class="text-secondary" href="function.php?fid=<?= urlencode($row['id']) ?>"> Delete</a></td>

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

