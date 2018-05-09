<?php
//Include script which checks if the user is logged in
include_once "loginCheck.php";

//This triggers if the submit button is pressed
//Purpose: Register user
if(isset($_POST["submitButton"])){
    $email = $_POST["InputEmail1"];
    $password = $_POST["InputPassword"];
    $password2 = $_POST["InputPassword2"];
    $firstName = $_POST["InputFirstName"];
    $lastName = $_POST["InputLastName"];
    if($password === $password2){
        $database->RegisterUser($email, $password, $firstName, $lastName);
        ?> <script>window.location.replace("index.php");</script> <?php
    }else{
        echo"Passwords dont match";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <title>Register</title>
</head>
<body>
<div id="wrapper">
    <div id="content" class="border border-secondary rounded">
        <form method="post">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom01">First name</label>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="InputFirstName" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="InputLastName" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail">Email address</label>
                <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="InputEmail1" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="InputPassword1">Password</label>
                <input type="password" class="form-control" id="InputPassword1" placeholder="Password" name="InputPassword" required>
            </div>
            <div class="form-group">
                <label for="InputPassword2">Confirm Password</label>
                <input type="password" class="form-control" id="InputPassword2" placeholder="Password" name="InputPassword2" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitButton">Register</button>
            <a class="btn btn-secondary" href="index.php" role="button">Back</a>
        </form>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>