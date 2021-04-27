<?php


if (!isset($_SESSION["logedIn"])) {
    session_start();
    
}




include("../Controllers/UserController.php");

$_SESSION["logedIn"] = 0;
$_SESSION["count"] = 0;


$email = "";

$errors = ["email" => "", "password" => ""];

if (isset($_POST["submit"])) {

    //email validation
    if (empty($_POST["email"])) {
        $errors["email"] = "Email is required";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Email must be a valid email address";
        }
    }

    //password validation
    if (empty($_POST["password"])) {
        $errors["password"] = "Password is required";
    }

    if (array_filter($errors)) {
    } else {
        if (login($_POST) === 1) {    // possword validation in user controller
            $_SESSION["logedIn"] = 1;
        }
    }
    if ($_SESSION["logedIn"] == 1) {
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["name"] = getUserName($_POST);
        $_SESSION["surname"] = getUserSurname($_POST);
        $_SESSION["id"] = getUserId($_POST);
        header("location: myPokemons.php");
    }
    if ($_SESSION["logedIn"] == 0) {
        $errors["password"] = "Email or Password does not match our records";
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>


<section class="container grey-text">
    <h5 class="center">Log in to your account</h5>
    <form action="login.php" class="white" method="POST">

        <label for="">Your email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors["email"] ?></div>

        <label for="">Your password:</label>
        <input type="password" name="password">
        <div class="red-text"><?php echo $errors["password"] ?></div>


        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>

    </form>
</section>