<?php include "Nav.php";

$cname = $_GET['cname'];
?>

<div class="container mt-2">
<h2 class="fw-bold"><?=  ucfirst($cname) ?></h2>
</div>
<div class="container pb-2 d-flex">
<?php

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $btn = new UserFunction();
    $check = $btn->checkSubscribe($cname, $user);

    if ($check->num_rows > 0) {

        ?>
        <a class="btn btn-secondary subscribe" href="userfunction.php?idsubscribe=<?= urlencode($user) ?>&catesubscribe=<?= urlencode($cname) ?>">
            Unsubscribe
        </a>
        <?php
    } else {
        ?>
      <a class="btn btn-secondary subscribe" href="userfunction.php?idsubscribe=<?= urlencode($user) ?>&catesubscribe=<?= urlencode($cname) ?>">
          Subscribe
      </a>
        <?php
    }

}

?>
</div>


<!--  //Category name and subscribe button  -->

<!-- show category's news -->

<div class="container">
    <div class="row">

        <div class="col-8">
            <?php
            $obj = new UserFunction();
            $result1 = $obj->getDetailCate($cname);
            if ($result1->num_rows > 0) {
                $rowww = $result1->fetch_all();
                $img = unserialize($rowww[4][4]);
                ?>


                <!--                <h5 class="my-3 border-secondary-subtle border-top border-2 pt-2">--><?php //= $cname ?><!--</h5>-->

                <?php echo '<img class="img-fluid rounded" src="./admin/images/' . $img[0] . '">'; ?>
                <h4 class="border-bottom pb-4 mb-3 border-secondary-subtle border-2 mt-3 fw-semibold ">
                    <a href="Detail.php?id=<?= $rowww[4][0] ?>">
                    <?= $rowww[4][2] ?>
                    </a>
                </h4>
                <p class="border-secondary-subtle"><?= $rowww[4][3] ?>
                </p>

                <?php
            }
            ?>
        </div>

        <div class="col-4">

            <?php

            $obj = new UserFunction();
            $ob = new UserFunction();
            $im = $ob->getCategoryLastImage($cname);
            $result2 = $obj->getDetailCategory($cname);
            if ($im->num_rows > 0)
            {
                $ima = $im->fetch_assoc();
                $img = unserialize($ima['image']);

                ?>

            <?php echo '<img class="img-fluid rounded" src="./admin/images/' . $img[0] . '">'; ?>
            <h4 class="border-bottom pb-2 mb-2 border-secondary-subtle border-2 mt-2"><a
                        href="Detail.php?id=<?= $ima['id'] ?>"><?= $ima['description'] ?></a></h4>
            <?php
            }
            if ($result2->num_rows > 0) {
                while ($roww = $result2->fetch_assoc()) {
                    $img = unserialize($roww['image']);
                    ?>
                    <div class="row border-bottom border-2 border-secondary-subtle py-3">
                        <div class="col-4">
                            <?php echo '<img class="img-fluid rounded" src="./admin/images/' . $img[0] . '">'; ?>
                        </div>
                        <div class="col-8" style="overflow:hidden; height: 74px;">
                            <p class="fs-6 fw-semibold"><a
                                        href="Detail.php?id=<?= $roww['id'] ?>"><?= $roww['description'] ?> </a></p>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>

    </div>

</div>

<!-- //show category's news -->

<!--  show sub category  -->

<div class="container">
    <?php
    $obj = new UserFunction();
    $sub = $obj->showsubcategory($cname);
    if ($sub->num_rows > 0) {
        while ($row = $sub->fetch_assoc()) {
            $subcate = $row['sub_name'];
            ?>

            <div class="row">
                <h2 class="my-4 border-bottom border-secondary-subtle border-2 pb-2">
                    <a href="Sub_Categories.php?subcate=<?= urlencode($subcate) ?>&cname=<?= urlencode($cname)?>"><?= $subcate ?></a>
                </h2>

                <?php
                $obj1 = new UserFunction();
                $subNew = $obj1->showSubNew($subcate, $cname);
                if ($subNew->num_rows > 0) {
                    while ($sb = $subNew->fetch_assoc()) {
                        $imae = unserialize($sb["image"]);
                        ?>

                        <div class=" col-lg-2 ">
                            <?php echo '<img class="img-fluid rounded" src="./admin/images/' . $imae[0] . '">'; ?>
                            <p class="pb-2 mb-3 mt-2 fw-semibold">
                            <a href="Detail.php?id=<?= $sb['id'] ?>"><?= $sb["description"] ?></a>
                            </p>
                        </div>

                        <?php
                    }
                } ?>
            </div>

            <?php
        }
    }
    ?>

</div>
<!-- //show sub category -->

<?php include 'Footer.php'?>