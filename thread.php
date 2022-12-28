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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>iForum</title>
</head>

<body>
    <?php include './partials/_nav.php' ?>

    <div class="jumbotron container my-4">
        <?php
        include './partials/_dbconnect.php';
        $id = $_GET['threadid'];
       
        $sql = "SELECT * FROM `threads` where thread_id = $id";
        $result = mysqli_query($conn, $sql);
        while ($threads = mysqli_fetch_assoc($result)) {
            $thread_id = $threads['thread_id'];
            $thread_que = $threads['thread_que'];
            $thread_description = $threads['thread_desc'];
            $thread_user = $threads['thread_user_id'];
        }

        ?>
        <h1 class="display-6"><?php echo "$thread_que"; ?></h1>
        <p class="lead"><?php echo "$thread_description"; ?></p>
        <hr class="my-4">
        <p>posted by - <b><?php echo "$thread_user";?></b></p>
    </div>


    <!-- comment form -->



    <!--Adding COMMENTS to Db-->
    <div class="container my-4">
        <div class="container">
            <h1>ANSWERS</h1>
            <hr>
            <?php
            
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                echo '<a href ="/iforum/login.php"><p class = "text-primary"><b>Logged In to Answer the Question</b></p></a>';
            }
            else{
                echo '<form action="'.$_SERVER["REQUEST_URI"] .'" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Add your Answer</label>
                    <textarea class="form-control" id="description" rows="3" name="comment_content" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>';
            }
            ?>
            <hr>
        </div>
        <!-- Adding comment -->
        <?php

        if (isset($_POST['submit'])) {
            include './partials/_dbconnect.php';

            $commentAdded = false;

            $id = $_GET['threadid'];
            $comment_content = $_POST['comment_content'];
            $user =  $_SESSION['username'];

            $sql = "INSERT INTO `comments` (`comment_content`, `comment_by`, `comment_thread_id`, `comment_time`) VALUES ('$comment_content', '$user', $id,current_timestamp())";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $commentAdded = true;
            }
        }
        ?>
        <?php
        $noComments = true;
        // $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` where comment_thread_id = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $noComments = false;

            // $comment_id = $row['comment_id'];
            $comment = $row['comment_content'];
            $commentTime =  $row['comment_time'];
            $comment_by = $row['comment_by'];

            echo '<div class="media my-2 mt-4 col">
                <img src="/iforum/img/user.png" width="50px" class="mr-3" alt="...">
                            <div class="media-body">
                            <p class="mb-0"><i>@' . $comment_by . '</i></p>
                            <p> <b>' . date("l jS \of F Y h:i:s A", strtotime(str_replace('-', '/', $commentTime))) . '</b></p>
                            <p>' . $comment . '</p>
                            </div> </div>
                            <hr>';
        }
        if ($noComments) {
            echo '<div class="jumbotron jumbotron-fluid container">
                <div class="container">
                  <p class="display-4">No Answer</p>
                  <p class="lead">Be the first to comment.</p>
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