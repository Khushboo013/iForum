<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iForum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php include './partials/_nav.php' ?>
    <?php
    include "./partials/_dbconnect.php";

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $user = "SELECT * FROM `users` where user_name = '$username' OR user_email = '$email'";
        $user_match = mysqli_query($conn, $user);
        $user_row = mysqli_num_rows($user_match);

        if ($user_row > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Username OR Email already exits!</strong> Choose other username OR email ...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } else {
            if ($password == $cpassword) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` ( `user_name`, `user_email`, `user_password`, `time`) VALUES ('$username', '$email', '$hash', current_timestamp())";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header('location: /iforum/login.php');

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>signUp Complete!</strong> Now you can login to continue...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error !</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Password Doesn\'t Match !</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }
    }
    ?>
    <div class="container w-50 my-4">
        <h2 class="text-center">SignUp</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="username" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">password</label>
                <input type="password" class="form-control" id="exampleFormControlInput1" name="password" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="exampleFormControlInput1" name="cpassword" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">SignUp</button>
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