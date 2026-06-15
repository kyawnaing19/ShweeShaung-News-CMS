<?php include "include/top_header1.php" ?>
<!--content-->
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Special Reporter/</span>User News</h4>

    <?php
    if (isset($_SESSION['reporterrole'])) {
        ?>
        <div class="alert alert-success mt-3" role="alert" id="success-alert">
            <?php echo $_SESSION['reporterrole'];
            unset($_SESSION['reporterrole']);
            ?>
        </div>
        <?php
    }
    if (isset($_SESSION['deletesuccess'])) {
        ?>
        <div class="alert alert-danger mt-3" role="alert" id="success-alert">
            <?php echo $_SESSION['deletesuccess'];
            unset($_SESSION['deletesuccess']);
            ?>
        </div>
        <?php
    }
    ?>

    <!-- Bootstrap Table with Header - Dark -->
    <div class="card">
        <h5 class="card-header">User News</h5>

        <div class="table-responsive tbl-fixed">
            <table class="table">
                <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Detail</th>
                    <th style="width: 180px;" scope="col">Image</th>
                    <th style="width: 180px;" scope="col">Type</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                <?php
                include "OOP.php";
                $obj = new database();
                $result = $obj->getpendingnews();
                $count = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ++$count;

                        ?>
                        <tr>

                            <td scope="row"><?= $count ?></td>
                            <td>
                                <p style="overflow: hidden; height: 20px; width: 300px;">
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
                            <td> <?php

                                $image = unserialize($row['image']);
                                for ($i = 0; $i < count($image); $i++) {
                                    echo '<img class="w-px-50 h-40 circle" src="./images/' . $image[$i] . '">';
                                }
                                ?></td>

                            <td>
                                <form action="function.php" method="post">
                                    <select class="form-select w-65" aria-label="Default select example"
                                            name="Categoryname" required>
                                        <option value="">Select Role</option>
                                        <?php

                                        $obj = new database();
                                        $res = $obj->getcategories();
                                        if ($res->num_rows > 0) {
                                            while ($r = $res->fetch_assoc()) {

                                                ?>
                                                <option value="<?= $r['C_Name'] ?>"><?= $r['C_Name'] ?></option>
                                                <?php

                                            }
                                        }
                                        ?>
                                    </select>
                            </td>
                            <td><?= $row['date'] ?></td>
                            <td>
                                <input type="hidden" value="<?= $row['id'] ?>" name="id">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </td>
                            <td>

                                <a class="btn btn-secondary" href="function.php?newsid=<?php echo urlencode($row['id']) ?>"> Delete</a>
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

    <div class="card mt-5">
        <h5 class="card-header">User News History</h5>
        <form action="function.php" method="post">
            <div class="table-responsive tbl-fixed">
                <table class="table ">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width: 200px;">Detail</th>
                        <th scope="col" style="width: 80px;">Image</th>
                        <th scope="col">Type</th>
                        <th scope="col">Date</th>


                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                    <?php

                    $obj = new database();
                    $result = $obj->getConfirmnews();
                    $count = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ++$count;
                            ?>
                            <tr>
                                <td scope="row"><?= $count ?></td>
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

                                <td>


                                    <?php

                                    $image = unserialize($row['image']);
                                    for ($i = 0; $i < count($image); $i++) {
                                        echo '<img class="w-px-50 h-40 circle" src="./images/' . $image[$i] . '">';
                                    }
                                    ?>


                                </td>
                                <td><?= $row["category"] ?></td>
                                <td><?= $row['date'] ?></td>


                            </tr>


<!--                            <tr>-->
<!--                                <td>-->
<!---->
<!--                                </td>-->
<!--                            </tr>-->
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

</div>
</div>
<!--/ Bootstrap Table with Header Dark -->


</div>
</div>
<!--/content-->
<!--    layout-page-->
</div>


<?php include "include/footer.php" ?>

</body>
</html>