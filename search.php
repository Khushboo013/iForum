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
    <?php
    include './partials/_nav.php';
    include './partials/_dbconnect.php';
    ?>

    <div class="container my-4 py-4">
        <h1>Search results for "<em><?php echo $_GET["search"]; ?>"</em> </h1>


        <?php
        $noresult = true;
        $search = $_GET["search"];
        $sql = "SELECT * FROM threads WHERE MATCH(thread_que, thread_desc) AGAINST ('$search')";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_que'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $tread_time = $row['time'];
            $thread_by = $row['thread_user_id'];
            $url = "thread.php?threadid=" . $thread_id;

            $noresult = false;

            // Display the search result
            echo '<div class="media my-4 mt-4 col">
                <img src="/iforum/img/user.png" width="50px" class="mr-3" alt="...">
                            <div class="media-body">
                            <p class="mb-0"><i>@' . $thread_by . '</i></p>
                            <p class="mb-1"><b>' . date("l jS \of F Y h:i:s A", strtotime(str_replace('-', '/', $tread_time))) . '</b></p>
                            <a href="/iforum/thread.php?threadid=' . $thread_id . '">
                            <h5 class="mt-0 mb-0">' . $title . '</h5></a>
                                <p>' . $desc . '</p>
                            </div> </div>
                            <hr>';
        }
        if ($noresult) {
            echo '<div class="jumbotron jumbotron-fluid my-4 p-4">
            <div class="container">
                <p class="display-4">No Results Found</p>
                <p class="lead"> Suggestions: <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords. </li></ul>
                </p>
            </div>
         </div>';
        }

        ?>
    </div>
   



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