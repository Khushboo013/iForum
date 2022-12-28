<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $loggedin = true;
} else {
  $loggedin = false;
}




echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iForum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/iforum/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link ">About</a>
        </li>
      </ul>
      <form class="d-flex mx-2" role="search" action = "/iforum/search.php" method = "get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name ="search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>';
if ($loggedin) {
  echo  '<p class="text-light bg-dark mx-2 mb-0"><i><b>Ola @' . $_SESSION['username'] . '</b></i></p>
          <a href="/iforum/logout.php"> <button type="button" class="btn btn-primary">Logout</button></a>';
}
if (!$loggedin) {
  echo  '<a href="/iforum/login.php"> <button type="button" class="btn btn-primary">Login</button></a> 
        <a href="/iforum/signup.php"> <button type="button" class="btn btn-primary mx-2">SignUp</button></a>';
}
echo ' </div>
    </div>
  </nav>';

?>