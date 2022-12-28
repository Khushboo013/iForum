<?php
session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header("location: /myProjects/login.php");
//     exit;
// }

?>
<!-- Adding question -->
<?php
include './partials/_dbconnect.php';

if (isset($_POST['submit'])) {
    $queAdded = false;

    $id = $_GET['catid'];

    $que = $_POST['question'];
    $desc = $_POST['description'];
    $user =  $_SESSION['username'];

    $sql = "INSERT INTO `threads` (`thread_que`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `time`) VALUES ('$que', '$desc', $id, '$user', CURRENT_TIMESTAMP())";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $queAdded = true;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>iForum</title>
</head>

<body>

    <?php include './partials/_nav.php' ?>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">iForum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/iforum">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link ">About</a>
                </li>
            </ul>
            <a href="/iforum/login.php"> <button type="button" class="btn btn-primary">Login</button></a>
            <a href="/iforum/signup.php"> <button type="button" class="btn btn-primary mx-2">SignUp</button></a>
        </div>
    </nav> -->

    <div class="jumbotron container my-4">
        <?php
        include './partials/_dbconnect.php';
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` where sno = $id";
        $result = mysqli_query($conn, $sql);
        while ($categories = mysqli_fetch_assoc($result)) {
            $categories_id = $categories['sno'];
            $category_title = $categories['title'];
            $category_description = $categories['description'];
        }

        ?>
        <h1 class="display-4">Welcome to <?php echo "$category_title"; ?> Forum</h1>
        <p class="lead"><?php echo "$category_description"; ?></p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>

    <!--Ask questions here  -->

    <div class="container">
        <h1>Ask and Discuss Problem</h1>
        <hr>

        <?php

        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
            echo '<a href ="/iforum/login.php"><p class = "text-primary"><b>Logged In to Start Discussion</b></p></a>';
        } else {
            echo ' <form action="' . $_SERVER["REQUEST_URI"] . ' method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Your Question</label>
                            <input type="text" class="form-control" id="question" name="question" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>';
        }
        ?>
        <hr>
    </div>

    <!-- Questions -->
    <div class="container my-4">
        <h1>Browse Questions</h1>


        <?php
        $noQuestion = true;
        // $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` where thread_cat_id = $id";
        $result = mysqli_query($conn, $sql);
        while ($categories = mysqli_fetch_assoc($result)) {
            $noQuestion = false;

            $thread_id = $categories['thread_id'];
            $thread_que = $categories['thread_que'];
            $thread_desc = $categories['thread_desc'];
            $tread_time = $categories['time'];
            $thread_by = $categories['thread_user_id'];

            echo '<div class="media my-2 mt-4 col">
                <img src="/iforum/img/user.png" width="50px" class="mr-3" alt="...">
                            <div class="media-body">
                            <p class="mb-0"><i>@' . $thread_by . '</i></p>
                            <p class="mb-1"><b>' . date("l jS \of F Y h:i:s A", strtotime(str_replace('-', '/', $tread_time))) . '</b></p>
                            <a href="/iforum/thread.php?threadid=' . $thread_id . '">
                            <h5 class="mt-0 mb-0">' . $thread_que . '</h5></a>
                                <p>' . $thread_desc . '</p>
                            </div> </div>
                            <hr>';
        }
        if ($noQuestion) {
            echo '<div class="jumbotron jumbotron-fluid container">
                <div class="container">
                  <p class="display-4">No Questions</p>
                  <p class="lead">Be the first to ask.</p>
                </div>
              </div>';
        }
        ?>


        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
        </script>

        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>