<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iForum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php include './partials/_nav.php'; ?>

    <?php
    include "./partials/_dbconnect.php";

    if (isset($_POST['submit'])) {
        $log_email = $_POST['email'];
        $log_password = $_POST['password'];

        $user = "SELECT * FROM `users` where user_email = '$log_email'";
        $user_match = mysqli_query($conn, $user);
        $user_row = mysqli_num_rows($user_match);

        if ($user_row > 0) {
            while ($row = mysqli_fetch_assoc($user_match)) {
                $pass = $row['user_password'];
                $username = $row ['user_name'];
                $pass_verify = password_verify($log_password, $pass);
                if ($pass_verify) {
                    session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['username']=$username;
                    $_SESSION['userId']=$userId;
                    header('location: /iforum/');
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>wrong Password !</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Invalid Credentials !</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
    ?>

    <div class="container w-50 my-4">
        <h2 class="text-center">Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">password</label>
                <input type="password" class="form-control" id="exampleFormControlInput1" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>