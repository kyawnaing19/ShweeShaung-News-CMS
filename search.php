<?php
$conn=new mysqli("localhost","root","","shweeshaung");

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    // Fetch suggestions from the database
//    $sql = "SELECT * FROM news WHERE description LIKE '%$keyword%'";
    $sql = "SELECT * FROM news WHERE (description LIKE '%$keyword%')
And category IN (SELECT C_Name FROM cate WHERE status='') And status='U'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ima=unserialize($row['image']);
//            echo '<div class="suggestion">' . $row['description'] . '</div>';
            ?><a href="Detail.php?id=<?= $row['id'] ?>">
    <div class="row border-2 border-bottom border-secondary searchboxhover" style=" height:auto;right: 1.5%;  " >
        <div class="col-9 pt-3">
            <?= $row['description'] ?>
        </div>
        <div class="col-3 pb-2">
            <?php
            echo '<img class="img-fluid rounded" src="./admin/images/' . $ima[0] .'">';
            ?>
        </div>
    </div>
    </a>
       <?php }
    } else {
        echo '<div class="suggestion">No suggestions found</div>';
    }
}

$conn->close();
?>
