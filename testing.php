<html>
<head>

    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.2-dist\css\bootstrap.css">
    <script src="bootstrap-5.3.2-dist\js\bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>

<div class="container">
   <table border="1" width="30%">

       <?php
       include "userOOP.php";
       $news=new UserFunction();
       $id=0;
       if (isset($_GET["id"]))
       {
           $id= $_GET["id"];
       }
       $result= $news->getNews($id);

       $row=$result->fetch_assoc();


       ?>

    </table>
</div>

</body>
</html>