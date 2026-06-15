<?php
include "Functions.php";
$obj = new Functions();
$result = $obj->getcategories();
$count = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ++$count;
        ?>
        <tr>
            <th scope="row"><?= $count; ?></th>
            <td><?= $row['c_name']; ?></td>

            <td>
                <!-- Button trigger modal -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#e<?= $row['cid']; ?>"><i class="bi bi-pencil-square"></i></a>


                <!-- Modal -->
                <div class="modal fade" id="e<?= $row['cid']; ?>" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="post" action="updatecategories.php">
                            <input type="hidden" name="cid" value="<?= $row['cid'] ?>">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" value="<?= $row['c_name'] ?>" id="category"
                                               name="category" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <i class="bi bi-trash-fill"></i>
            </td>

        </tr>
        <?php
    }
}
?>