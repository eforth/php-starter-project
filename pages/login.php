<?php


$pageTitle = "Login";

include_once("../inc/header.php");

?>

<main class="page-login h-100">
    <section class="form-signin">
        <form action="#" method="post">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Sign in</button>
        </form>




<?php include_once("../inc/footer.php"); ?>