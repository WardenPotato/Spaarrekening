<?php
//Start Session if not already started
if(session_status() === PHP_SESSION_NONE)session_start();

//Get userID from session for initialization of User class and checks if user is logged in
isset($_SESSION['userID']) ? $userID = $_SESSION['userID'] : header("Location: index.php");

//Initialize User class
require_once "User.php";
$User = new \User\User($userID);
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
    <script src="js/edit_post.js"></script>
    <title>Account</title>
</head>
<body>
<div id="wrapper">
    <div id="content" class="border border-secondary rounded">
        <h1>Hello: <?php echo $User->getFirstName() . " " . $User->getLastName()?></h1>
        <a href="logout.php" role="button" class="btn btn-danger">Logout</a>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAccountModal">
            Create a account
        </button>

        <!-- Create new account modal -->
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
                    <!-- Create account form -->
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
                    <!-- End create account form -->
                </div>
            </div>
        </div>
        <!-- End create new account modal -->

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">
            Delete user account
        </button>

        <!-- Delete user account modal -->
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
        <!-- End delete user account modal -->

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editAccountModal">
            Edit account
        </button>

        <!-- Edit account modal -->
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
                    <!-- Edit account form -->
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" name="EditForm" id="FormEdit">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Account</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="editAccountSelection1">
                                    <?php
                                        //Get all accounts and echo them as options
                                        $accounts = $User->getAccounts();
                                        /* @var $account \User\BankAccount */
                                        foreach ($accounts as $index => $account) {
                                            echo "<option value='" . $account->getID() . "'>" . $account->getName() . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Action</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="editAccountSelection2">
                                    <option value="Withdraw">Withdraw</option>
                                    <option value="Deposit">Deposit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputEditAccount">Amount</label>
                                <input type="text" class="form-control" id="inputEditAccount"
                                       placeholder="Enter a amount" name="editAccount">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="SubmitEdit" name="editAccountSubmit" form="FormEdit">Do</button>
                    </div>
                    <!-- End edit account form -->
                </div>
            </div>
        </div>
        <!-- End edit account modal -->

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
//Prints all accounts of logged in user
echo"<div id='accountdiv'>";
    $User->printAccounts();
echo"</div>";

//Runs if account creation button is pressed
if(isset($_POST["AccountSubmit"]) and isset($_POST["AccountName"])){
    $accountName = $_POST["AccountName"];
    $User->addAccount($accountName);
    ?> <script>window.location.replace("rekening.php");</script> <?php
}

//Runs if useraccount delete button is pressed
if(isset($_POST["accountDeleteSubmit"])){
    $User->deleteUser();
    ?> <script>window.location.replace("logout.php");</script> <?php
}