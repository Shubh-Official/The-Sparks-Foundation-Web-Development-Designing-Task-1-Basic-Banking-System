<?php
    include('./database/connection.php');
    if(isset($_POST['Create'])) {
        $AccountNumber = $_POST['AccountNumber'];
        $flag = true;
        $CustomerData = $connection -> query("SELECT * FROM Customers") or die("Customer Table not Accessable.");
        while($row = $CustomerData -> fetch_assoc())
        {
            if($AccountNumber == $row['AccountNumber'])
                $flag = false;
        }
        if($flag) {
            $AccountType = $_POST['AccountType'];
            $FirstName = $_POST['FirstName'];
            $MiddleName = $_POST['MiddleName'];
            if ($MiddleName == '')
                $MiddleName = null;
            $LastName = $_POST['LastName'];
            $MobileNumber = $_POST['MobileNumber'];
            $CurrentBalance = $_POST['CurrentBalance'];
            $EmailID = $_POST['EmailID'];
            $Address = $_POST['Address'];
            if ($Address == '')
                $Address = null;
            $Notes = $_POST['Notes'];
            if ($Notes == '')
                $Notes = null;
            date_default_timezone_set('Asia/Kolkata');
            $CurrentDate = date("Y-m-d H:i:s");
            // echo $AccountNumber . "<br>";
            // echo $AccountType . "<br>";
            // echo $FirstName . "<br>";
            // echo $MiddleName . "<br>";
            // echo $LastName . "<br>";
            // echo $MobileNumber . "<br>";
            // echo $CurrentBalance . "<br>";
            // echo $EmailID . "<br>";
            // echo $Address . "<br>";
            // echo $Notes . "<br>";
            // echo $CreatedOn . "<br>";
            // echo $LastActivity . "<br>";
            $CustomerData = " INSERT INTO Customers VALUES ( '$AccountNumber', '$AccountType', '$FirstName', '$MiddleName', '$LastName', '$MobileNumber', '$CurrentBalance', '$EmailID', '$Address', '$Notes', '$CurrentDate', '$CurrentDate' ) ";
            $connection -> query($CustomerData) or die('Customer Registration is Failed');
            $transactionsData = " INSERT INTO Transactions VALUES ( '$AccountNumber', '$AccountNumber', '$AccountNumber', '$CurrentBalance', '$CurrentDate', 'Opening Account Balance' ) ";
            $connection -> query($transactionsData) or die('Transaction Entry is Failed');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Account</title>
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/Style.css">
    <link rel="stylesheet" href="assets/css/Carousal.css">
    <link rel="stylesheet" href="assets/css/Introduction.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-5.0.1-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/form.js"></script>
    <script type="text/javascript" src="assets/vendor/bootstrap-5.0.1-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-info" href="#">
                <i class="bi bi-bank2"></i>                
                The Spark Foundation
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link" href="customers.php">Customers</a>
                    <a class="nav-link" href="transaction.php">Transactions</a>
                    <a href="#" class="mt-1 active">
                        <button class="btn btn-success btn-sm">Create New Account</button>
                    </a>
                </div>
            </div>
        </div>   
    </nav>

    <div class="container my-5">
        <div class="row p-4 justify-content-center">
            <div class="col-8">
                <div class="row my-3">
                    <div class="col-12 text-center">
                        <h1 class="fw-bolder">Create New Account</h1>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12">
                        <?php
                            if(isset($flag)) {
                                if($flag) {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                                    echo '<h6>Account <strong class="text-danger">' . $AccountNumber . '</strong> is Successfully Created with an Opening Balance of <strong class="text-danger">' . $CurrentBalance . '</strong></h6>';
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                    echo '</div>';
                                }
                                else {
                                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                                    echo '<h6>Account <strong class="text-danger">' . $AccountNumber . '</strong> is already Exist. Please Do not Refresh the Page</h6>';
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                    echo '</div>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <form class="row g-3 needs-validation" method="POST" action="./createNewAccount.php" validate>
                    <div class="col-md-8 position-relative">
                        <label class="form-label fw-bold">Account Number</label>
                        <?php
                            $Customers_All = $connection -> query("SELECT * FROM Customers") or die("Customer Table Not Accessed.");
                            while($row = $Customers_All -> fetch_assoc())
                            {
                                $AccountNumber = $row['AccountNumber'];
                                // echo $AccountNumber . "<br>";
                            }
                            $AccountNumber = explode("TSF",$AccountNumber);
                            printf('<input type="text" name="AccountNumber" class="form-control" value="TSF%06d" readonly>', $AccountNumber[1] + 1);
                        ?>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationCustom01" class="form-label fw-bold">Account Type</label>
                        <select class="form-select" name="AccountType" id="validationCustom02" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="SA">Saving Account</option>
                            <option value="CA">Current Account</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid account type.
                        </div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip02" class="form-label fw-bold">First name</label>
                        <input type="text" name="FirstName" class="form-control" id="validationTooltip02" pattern="^[A-Za-z]{2,}$" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip03" class="form-label fw-bold">Middle name</label>
                        <input type="text" name="MiddleName" class="form-control" id="validationTooltip03" pattern="^[A-Za-z]{1,}$">
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip04" class="form-label fw-bold">Last name</label>
                        <input type="text" name="LastName" class="form-control" id="validationTooltip04" pattern="^[A-Za-z]{2,}$" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip05" class="form-label fw-bold">Mobile Number ( Ignore +91 )</label>
                        <input type="text" name="MobileNumber" class="form-control text-end" id="validationTooltip05" pattern="^[6789][0-9]{9}$" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip06" class="form-label fw-bold">Opening Balance ( min 1,000 )</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">₹</span>
                            <input type="text" name="CurrentBalance" class="form-control text-end" id="validationTooltip06" aria-describedby="inputGroupPrepend" pattern="^[1-9][0-9]{3,}$" required>
                            <div class="invalid-feedback">
                              Please choose a username.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip07" class="form-label fw-bold">Email ID</label>
                        <input type="email" name="EmailID" class="form-control" id="validationTooltip07" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fw-bold">Address</label>
                        <textarea class="form-control" name="Address" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlTextarea2" class="form-label fw-bold">Notes</label>
                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea2" rows="3"></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <input class="btn btn-outline-success" name="Create" type="submit" value="Create an Account">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="container-fluid fixed-bottom py-1 bg-dark">
            <div class="row">
                <div class="col-6 text-white">
                    &copy; All Rights are Reserved.
                </div>
                <div class="col-6 text-white text-end">
                    Created by <a href="https://github.com/Shubh-Official/" target="_BLANK" class="text-warning text-decoration-none">Shubh Patel</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>