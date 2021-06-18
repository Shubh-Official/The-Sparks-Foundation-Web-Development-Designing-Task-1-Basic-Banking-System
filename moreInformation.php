<?php
    include('./database/connection.php');

    if(isset($_POST['TransferNow'])) {
        $flag = true;
        $TransactionsData = $connection -> query("SELECT * FROM Transactions") or die("Transaction Table Not Accessed.");
        while($row = $TransactionsData -> fetch_assoc())
        {
            if(strlen($row['TransactionNumber'])==20)
                $TransactionNumber = $row['TransactionNumber'];
            // echo $TransactionNumber . "<br>";
        }
        $TransactionNumber = explode("TSF",$TransactionNumber);
        $TransactionNumber = sprintf("TSF%017d", $TransactionNumber[1] + 1);
        $TransactionFrom = $_POST['AccountNumber'];
        $TransactionTo = $_POST['TransferAccount'];
        $CurrentBalance = $_POST['CurrentBalance'];
        $TransactionAmount = $_POST['TransferAmount'];
        if($CurrentBalance - $TransactionAmount >= 1000) {
            date_default_timezone_set('Asia/Kolkata');
            $TransactionDate = date("Y-m-d H:i:s");
            $TransactionNote = null;
            // echo $TransactionNumber . "<br>";
            // echo $TransactionFrom . "<br>";
            // echo $TransactionTo . "<br>";
            // echo $TransactionAmount . "<br>";
            // echo $TransactionDate . "<br>";
            // echo $TransactionNote . "<br>";

            $NewUpdatedBalance1 = $CurrentBalance - $TransactionAmount;
            date_default_timezone_set('Asia/Kolkata');
            $CurrentDate = date("Y-m-d H:i:s");
            $CustomersData = " UPDATE Customers SET CurrentBalance='$NewUpdatedBalance1', LastActivity='$CurrentDate' WHERE AccountNumber='$TransactionFrom' ";
            $connection -> query($CustomersData) or die('Customer Transfer From Data is not Updated');

            $CustomerData = $connection -> query("SELECT * FROM Customers") or die("Customer Table not Accessable.");
            while($row = $CustomerData -> fetch_assoc())
            {
                if($TransactionTo == $row['AccountNumber']) {
                    $CurrentBalance = $row['CurrentBalance'];
                }
            }

            $NewUpdatedBalance2 = $CurrentBalance + $TransactionAmount;
            $CustomersData = " UPDATE Customers SET CurrentBalance='$NewUpdatedBalance2' WHERE AccountNumber='$TransactionTo' ";
            $connection -> query($CustomersData) or die('Customer Transfer To Data is not Updated');

            $TransactionsData = " INSERT INTO Transactions VALUES ( '$TransactionNumber', '$TransactionFrom', '$TransactionTo', '$TransactionAmount', '$TransactionDate', '$TransactionNote' ) ";
            $connection -> query($TransactionsData) or die('Transaction Entry is Failed');
        }
        else {
            $flag = false;
        }

        $AccountNumber = $_POST['AccountNumber'];
        $CustomerData = $connection -> query("SELECT * FROM Customers") or die("Customer Table not Accessable.");
        while($row = $CustomerData -> fetch_assoc())
        {
            if($AccountNumber == $row['AccountNumber']) {
                $AccountType = $row['AccountType'];
                $FirstName = $row['FirstName'];
                $MiddleName = $row['MiddleName'];
                $LastName = $row['LastName'];
                $MobileNumber = $row['MobileNumber'];
                $CurrentBalance = $row['CurrentBalance'];
                $EmailID = $row['EmailID'];
                $Address = $row['Address'];
                $Notes = $row['Notes'];
                $CreatedOn = $row['CreatedOn'];
                $LastActivity = $row['LastActivity'];
            }
        }
    }
    elseif(isset($_POST['AccountNumber'])) {
        $AccountNumber = $_POST['AccountNumber'];
        $CustomerData = $connection -> query("SELECT * FROM Customers") or die("Customer Table not Accessable.");
        while($row = $CustomerData -> fetch_assoc())
        {
            if($AccountNumber == $row['AccountNumber']) {
                    $AccountType = $row['AccountType'];
                    $FirstName = $row['FirstName'];
                    $MiddleName = $row['MiddleName'];
                    $LastName = $row['LastName'];
                    $MobileNumber = $row['MobileNumber'];
                    $CurrentBalance = $row['CurrentBalance'];
                    $EmailID = $row['EmailID'];
                    $Address = $row['Address'];
                    $Notes = $row['Notes'];
                    $CreatedOn = $row['CreatedOn'];
                    $LastActivity = $row['LastActivity'];
                }
        }
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
    }
    else {
        header("Location: ./customers.php");
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
    <script>
        function verify(){
            var TransactionTo = document.getElementById("validationCustom03").value;
            var TransactionAmount = document.getElementById("validationTooltip10").value;
            return confirm('Are you want to transfer ₹ ' + TransactionAmount + ' to an Account ' + TransactionTo );
        }
    </script>
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
                    <a href="createNewAccount.php" class="mt-1 active">
                        <button class="btn btn-success btn-sm">Create New Account</button>
                    </a>
                </div>
            </div>
        </div>   
    </nav>

    <div class="container my-5">
        <div class="row p-4 justify-content-center">
            <div class="col-md-8">
                <div class="row my-3">
                    <div class="col-12 text-center">
                        <h1 class="fw-bolder"><?php echo $AccountNumber . " - " . $FirstName . " " . $MiddleName . " " . $LastName; ?></h1>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12">
                        <?php
                            if(isset($flag)) {
                                if($flag) {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                                    echo '<h6><strong class="text-danger">₹ ' . $TransactionAmount . '</strong> is Successfully Transfered to an Account <strong class="text-danger">' . $TransactionTo . '</strong> from <strong class="text-success">' . $TransactionFrom . '</strong></h6>';
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                    echo '</div>';
                                }
                                else {
                                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                                    echo '<h6><strong class="text-danger">Transaction Falied ... </strong>Insufficient Balance. Your Maximum transfer Amount is <strong class="text-danger">₹ ' . $CurrentBalance - 1000 . '</strong></h6>';
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                    echo '</div>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <form class="row g-3 needs-validation" method="POST" action="./moreInformation.php" onsubmit="return verify()" validation>
                    <div class="col-md-8 position-relative">
                        <label class="form-label fw-bold">Account Number</label>
                        <input type="text" name="AccountNumber" class="form-control" value="<?php echo $AccountNumber; ?>" readonly>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationCustom02" class="form-label fw-bold">Account Type</label>
                        <select class="form-select" name="AccountType" id="validationCustom02" required>
                            <option selected disabled><?php echo $AccountType; ?></option>
                        </select>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip02" class="form-label fw-bold">First name</label>
                        <input type="text" name="FirstName" class="form-control" id="validationTooltip02" value="<?php echo $FirstName; ?>" readonly>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip03" class="form-label fw-bold">Middle name</label>
                        <input type="text" name="MiddleName" class="form-control" id="validationTooltip03" value="<?php echo $MiddleName; ?>" readonly>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip04" class="form-label fw-bold">Last name</label>
                        <input type="text" name="LastName" class="form-control" id="validationTooltip04" value="<?php echo $LastName; ?>" readonly>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip05" class="form-label fw-bold">Mobile Number ( Ignore +91 )</label>
                        <input type="text" name="MobileNumber" class="form-control text-end" id="validationTooltip05" value="<?php echo $MobileNumber; ?>" readonly>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip06" class="form-label fw-bold">Opening Balance ( min 1,000 )</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">₹</span>
                            <input type="text" name="CurrentBalance" class="form-control text-end" id="validationTooltip06" aria-describedby="inputGroupPrepend" value="<?php echo $CurrentBalance; ?>" readonly>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip07" class="form-label fw-bold">Email ID</label>
                        <input type="email" name="EmailID" class="form-control" id="validationTooltip07" value="<?php echo $EmailID; ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fw-bold">Address</label>
                        <textarea class="form-control" name="Address" id="exampleFormControlTextarea1" rows="3" readonly><?php echo $Address; ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlTextarea2" class="form-label fw-bold">Notes</label>
                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea2" rows="3" readonly><?php echo $Notes; ?></textarea>
                    </div>
                    <div class="col-md-4 offset-md-2 position-relative">
                        <label for="validationTooltip08" class="form-label fw-bold">Created On</label>
                        <input type="text" name="EmailID" class="form-control" id="validationTooltip08" value="<?php echo $CreatedOn; ?>" readonly>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip09" class="form-label fw-bold">Last Activity</label>
                        <input type="text" name="EmailID" class="form-control" id="validationTooltip09" value="<?php echo $LastActivity; ?>" readonly>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationCustom03" class="form-label fw-bold">Transer Account</label>
                        <select class="form-select" name="TransferAccount" id="validationCustom03" required>
                            <option selected disabled value="">Select Account Number</option>
                            <?php
                                $CustomerData = $connection -> query("SELECT * FROM Customers") or die("Customer Table not Accessable.");
                                while($row = $CustomerData -> fetch_assoc())
                                {
                                    if($AccountNumber != $row['AccountNumber'])
                                        echo "<option value='" . $row['AccountNumber'] . "'>" . $row['AccountNumber'] . " - " . $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label for="validationTooltip10" class="form-label fw-bold">Transer Amount ( min ₹ 1 )</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">₹</span>
                            <input type="text" name="TransferAmount" class="form-control text-end" id="validationTooltip10" aria-describedby="inputGroupPrepend" pattern="^[1-9][0-9]*[.]{0,1}[0-9]{1,2}$" required>
                            <div class="invalid-feedback">
                                Please Enter a Valid Transfer Amount.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mt-md-5">
                        <input class="btn btn-outline-success" name="TransferNow" type="submit" value="Transfer Now">
                        <a href="customers.php">
                            <button class="btn btn-warning mt-md-0 mt-2" type="button">Back</button>
                        </a>
                    </div>
                </form>
            </div>
            <div class="col-md-12 mt-5">
                <div class="row my-3">
                    <div class="col-12 text-center">
                        <h1 class="fw-bolder">Transaction History</h1>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Transaction Number</th>
                                <th>Transaction From</th>
                                <th>Transaction To</th>
                                <th>Transaction Amount</th>
                                <th>Transaction Date-Time</th>
                                <th>Transaction Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include('database/connection.php');
                                $TransactionsData = $connection -> query("SELECT * FROM Transactions ORDER BY TransactionDate DESC") or die("Transactions Table not Accessable.");
                                $count = 0;
                                while($row = $TransactionsData-> fetch_assoc())
                                {
                                    if($AccountNumber == $row['TransactionFrom'] && $AccountNumber == $row['TransactionTo']) {
                                        $count++;
                                        echo "<tr class='table-warning'>";
                                        echo "<td>" . $count . "</td>";
                                        echo "<td>" . $row['TransactionNumber'] . "</td>";
                                        echo "<td>" . $row['TransactionFrom'] . "</td>";
                                        echo "<td>" . $row['TransactionTo'] . "</td>";
                                        echo "<td>" . $row['TransactionAmount'] . "</td>";
                                        echo "<td>" . $row['TransactionDate'] . "</td>";
                                        echo "<td>" . $row['TransactionNote'] . "</td>";
                                        echo "</tr>";
                                    }
                                    elseif($AccountNumber == $row['TransactionFrom']) {
                                        $count++;
                                        echo "<tr class='table-danger'>";
                                        echo "<td>" . $count . "</td>";
                                        echo "<td>" . $row['TransactionNumber'] . "</td>";
                                        echo "<td>-</td>";
                                        echo "<td>" . $row['TransactionTo'] . "</td>";
                                        echo "<td>" . $row['TransactionAmount'] . "</td>";
                                        echo "<td>" . $row['TransactionDate'] . "</td>";
                                        echo "<td>" . $row['TransactionNote'] . "</td>";
                                        echo "</tr>";
                                    }
                                    elseif(($AccountNumber == $row['TransactionTo'])) {
                                        $count++;
                                        echo "<tr class='table-success'>";
                                        echo "<td>" . $count . "</td>";
                                        echo "<td>" . $row['TransactionNumber'] . "</td>";
                                        echo "<td>" . $row['TransactionFrom'] . "</td>";
                                        echo "<td>-</td>";
                                        echo "<td>" . $row['TransactionAmount'] . "</td>";
                                        echo "<td>" . $row['TransactionDate'] . "</td>";
                                        echo "<td>" . $row['TransactionNote'] . "</td>";
                                        echo "</tr>";
                                    }
                                    else {
                                    }
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <?php
                                    echo '<th colspan="7"><h5>Total Transactions <strong class="bg-danger text-white py-1 px-2 rounded">' . $count . '</strong></h5></th>';
                                ?>
                            </tr>
                        </tfoot>
                    </div>
                </div>
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