<?php
session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header("location: /myProjects/login.php");
//     exit;
// }

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iForum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php include './partials/_nav.php' ?>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1200x400/?coading" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1200x400/?programming" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1200x400/?computer" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--  use loop  -->
    <div class="container my-4 d-flex flex-row mb-3">

        <?php
        include './partials/_dbconnect.php';

        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql);
        while ($categories = mysqli_fetch_assoc($result)) {
            $categories_id = $categories['sno'];
            $category_title = $categories['title'];
            $category_description = $categories['description'];

            echo '<div class="card mx-4 my-4" style="width: 18rem;">
                <img src="https://source.unsplash.com/400x300/?programming" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">' . $category_title . '</h5>
                    <p class="card-text">' . substr($category_description, 0, 100) . '...</p>
                    <a href="/iforum/threadlist.php?catid='.$categories_id.'" class="btn btn-primary">View Thread</a>
                </div>
           </div>';
        }

        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>


</body>

</html>