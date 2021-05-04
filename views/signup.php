<?php

include("../Controllers/UserController.php");

$name = "";
$surname = "";
$email = "";
$password1 = "";
$password2 = "";

$errors = ["name" => "", "surname" => "", "email" => "", "password1" => "", "password2" => ""];


if (isset($_POST["submit"])) {
    //name validation
    if (empty($_POST["name"])) {
        $errors["name"] = "Same is required";
    } else {
        $name = $_POST["name"];
        if (!preg_match("/^[a-zA-Z0-9]+$/", $name))
            $errors["name"] = "Name must be letters and numbers only";
    }


    //surname validation
    if (empty($_POST["surname"])) {
        $errors["surname"] = "Surname is required";
    } else {
        $surname = $_POST["surname"];
        if (!preg_match("/^[a-zA-Z0-9]+$/", $surname))
            $errors["surname"] = "Surname must be letters and numbers only";
    }

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
    if (empty($_POST["password1"])) {
        $errors["password1"] = "Password is required";
    } else {
        $password1 = $_POST["password1"];
        if (strlen($_POST["password1"]) < 6 || strlen($_POST["password1"]) > 10) {
            $errors["password1"] = "Password must be between 6 and 10 characters";
        }
    }

    if (empty($_POST["password2"])) {
        $errors["password2"] = "Password is required";
    } else {
        $password2 = $_POST["password2"];

        if (strlen($_POST["password2"]) < 6 || strlen($_POST["password2"]) > 10) {
            $errors["password2"] = "Password must be between 6 and 10 characters";
        }
    }

    if ($password1 !== $password2) {
        $errors["password1"] = $errors["password2"] = "Passwords must match";
    }



    if (array_filter($errors)) {
        // echo "errors in the form";
    } else {
        register($_POST);
        header("location: login.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>


<section class="container grey-text">
    <h5 class="center">Create new account</h5>
    <form action="signup.php" class="white" method="POST">

        <label for="">Type your name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
        <div class="red-text"><?php echo $errors["name"] ?></div>

        <label for="">Type your Surname:</label>
        <input type="text" name="surname" value="<?php echo htmlspecialchars($surname) ?>">
        <div class="red-text"><?php echo $errors["surname"] ?></div>

        <label for="">Your email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors["email"] ?></div>

        <label for="">New password:</label>
        <input type="password" name="password1" value="<?php echo htmlspecialchars($password1) ?>">
        <div class="red-text"><?php echo $errors["password1"] ?></div>

        <label for="">Repeat your password:</label>
        <input type="password" name="password2" value="<?php echo htmlspecialchars($password2) ?>">
        <div class="red-text"><?php echo $errors["password2"] ?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>

    </form>
</section>