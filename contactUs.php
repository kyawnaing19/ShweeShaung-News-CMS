<?php include "Nav.php";?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Shwee Shaung News</title>

    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Example font-family */
            color: #333; /* Adjust text color */
        }

        h2 {
            color: #007bff; /* Adjust heading color */
        }
        .form-group {
            margin-bottom: 20px; /* Add spacing between form groups */
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <h2>Contact Us</h2>
            <p>Have a question or feedback? Reach out to us using the form below.</p>
            <form action="userfunction.php" method="post">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" name="uname" required>
                </div>

                    <?php if (isset($_SESSION["userEmail"]))
                    {?><div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" readonly id="email" placeholder="Enter your email" value="<?=$_SESSION['userEmail']?>" name="uemail">
                    </div>
                   <?php }
                    else{?>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control"  id="email" placeholder="Enter your email" name="uemail" required>
                        </div>
                   <?php }
                    ?>

                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Enter your message" name="umessage" required></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit" name="feedback">
            </form>
        </div>
        <div class="col-lg-4">
            <h2>Contact Information</h2>
            <p><strong>Email:</strong> shweeshaung@gmail.com</p>
            <p><strong>Phone:</strong> +95766187084</p>
            <p><strong>Address:</strong> University of Computer Studies Thaton</p>
        </div>
    </div>
</div>

<?php  include "Footer.php" ?>