<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shweeshaung";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Error fetching data: " . $conn->error);
}
$notificationCount = 0; // Initialize notification count

// Check if the user has seen the table before (e.g., using session variable)
if (!isset($_SESSION['seenTable'])) {
    // Get the latest record timestamp
    $sql = "SELECT MAX(order_at) AS last_updated FROM orders";
    $lastUpdatedResult = $conn->query($sql);

    // Check for errors
    if (!$lastUpdatedResult) {
        die("Error fetching last updated timestamp: " . $conn->error);
    }

    $lastUpdatedRow = $lastUpdatedResult->fetch_assoc();
    $lastUpdatedTimestamp = $lastUpdatedRow['order_at'];

    // Check if the user's last visit timestamp (stored in session) is earlier than the last update
    if (isset($_SESSION['lastVisit']) && $_SESSION['lastVisit'] < $lastUpdatedTimestamp) {
        $notificationCount++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Table</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        /* Add CSS styles for table display and notification element */
    </style>
</head>
<body>

<?php if ($notificationCount > 0) : ?>
    <div class="notification">New records added! (<?php echo $notificationCount; ?>)</div>
<?php endif; ?>

<button id="showTableButton">Show Table</button>

<div id="tableData"></div>

<script>
    $(document).ready(function() {
        $("#showTableButton").click(function () {
            $.ajax({
                url: "showtable.php", // Replace with actual file path
                method: "POST",
                success: function (data) {
                    $("#tableData").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching data:", textStatus, errorThrown);
                    $("#tableData").html("Error fetching data.");
                }
            });
        });

        // Update session variable on page load (optional)
        $.ajax({
            url: "update_session.php", // Replace with actual file path
        });
    }