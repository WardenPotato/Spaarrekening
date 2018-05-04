<?php
session_start();
require "Users.php";
$User = new Users();
?>
    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
              integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css" type="text/css">
        <title>Account</title>
    </head>
    <body>
    <div id="wrapper">
        <div id="content" class="border border-secondary rounded">
            <h1>Hello, world!</h1>
            <a href="logout.php" role="button" class="btn btn-danger">Logout</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAccountModal">
                Create a account
            </button>

            <!-- Modal -->
            <div class="modal fade" id="createAccountModal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create a account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputAccountName">Account Name</label>
                                    <input type="text" class="form-control" id="inputAccountName"
                                           aria-describedby="accountNameHelp"
                                           placeholder="Enter a name" name="AccountName">
                                    <small id="accountNameHelp" class="form-text text-muted">Use a descriptive name.
                                    </small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="AccountSubmit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">
                Delete user account
            </button>

            <!-- Modal -->
            <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountModal">Delete User Account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete your account?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form method="post">
                                <button type="submit" class="btn btn-danger" name="accountDeleteSubmit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editAccountModal">
                Edit account
            </button>

            <!-- Modal -->
            <div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit a account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Account</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="editAccountSelection1">
                                    <?php
                                    //require_once "Users.php";
                                    //$Userzz = new Users();
                                    $userid = $User->GetUserID($_SESSION['email'], $_SESSION['pwd']);
                                    foreach ($User->GetAccounts($userid) as $key => $value) {
                                        echo "<option value='" . $value['account_id'] . "'>" . $value['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Action</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="editAccountSelection2">
                                    <option value="Withdraw">Withdraw</option>
                                    <option value="Deposit">Deposit</option>
                                    <option value="Set">Set</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputEditAccount">Amount</label>
                                <input type="text" class="form-control" id="inputEditAccount"
                                       placeholder="Enter a amount" name="editAccount">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="editAccountSubmit">Do</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                    crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
                    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
                    crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
                    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
                    crossorigin="anonymous"></script>
        </div>
    </div>
    </body>
    </html>
<?php

//Prints all accounts of logged in user and checks if they are logged in
if(isset($_SESSION['email']) and isset($_SESSION['pwd'])){
    if ($User->LoginUser($_SESSION['email'], $_SESSION['pwd']) == true) {
        $userid = $User->GetUserID($_SESSION['email'], $_SESSION['pwd']);
        echo"Accounts: <br>";
        foreach ($User->GetAccounts($userid) as $key => $value) {
            foreach($value as $key => $var){
                echo"$var" . " ";
            }
            echo"<br>";
        }
    }else{
        ?> <script>window.location.replace("index.php");</script> <?php
    }
}else{
    ?> <script>window.location.replace("index.php");</script> <?php
}
//Runs if account creation button is pressed
if(isset($_POST["AccountSubmit"]) and isset($_POST["AccountName"])){
    $userid = $User->GetUserID($_SESSION['email'], $_SESSION['pwd']);
    $accountName = $_POST["AccountName"];
    $User->CreateAccount($userid, $accountName);
    ?> <script>window.location.replace("rekening.php");</script> <?php
}
//Runs if edit account button is pressed
if(isset($_POST["editAccountSubmit"]) and isset($_POST["editAccountSelection1"]) and isset($_POST["editAccountSelection2"]) and isset($_POST["editAccount"])){
    $method = $_POST["editAccountSelection2"];
    $account = $_POST["editAccountSelection1"];
    $amount = $_POST["editAccount"];
    $userid = $User->GetUserID($_SESSION['email'], $_SESSION['pwd']);
    echo $method . "<br>";
    echo $amount . "<br>";
    echo $account . "<br>";
    switch ($method) {
        case "Withdraw":
            $User->RemoveBalance($amount, $account);
            break;
        case "Deposit":
            $User->AddBalance($amount, $account);
            break;
        case "Set":
            $User->SetBalance($amount, $account);
            break;
    }
}
//Runs if useraccount delete button is pressed
if(isset($_POST["accountDeleteSubmit"])){
    $userid = $User->GetUserID($_SESSION['email'], $_SESSION['pwd']);
    $User->DeleteUser($userid);
    ?> <script>window.location.replace("logout.php");</script> <?php
}