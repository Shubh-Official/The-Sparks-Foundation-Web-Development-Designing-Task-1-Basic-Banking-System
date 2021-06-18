<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Customers</title>
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/Style.css">
    <link rel="stylesheet" href="assets/css/Carousal.css">
    <link rel="stylesheet" href="assets/css/Introduction.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-5.0.1-dist/css/bootstrap.min.css">
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
                    <a class="nav-link active" href="#">Customers</a>
                    <a class="nav-link" href="transaction.php">Transactions</a>
                    <a href="createNewAccount.php" class="mt-1">
                        <button class="btn btn-success btn-sm">Create New Account</button>
                    </a>
                </div>
            </div>
        </div>   
    </nav>

    <div class="container-fluid my-5">
        <div class="row p-4 text-info text-center">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Account Number</th>
                        <th>Account Type</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Mobile Number</th>
                        <th>Current Balance</th>
                        <th>Email ID</th>
                        <!-- <th>Address</th>
                        <th>Notes</th>
                        <th>Created On</th>
                        <th>Last Activity</th> -->
                        <th>More Info</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('database/connection.php');
                        $CustomerData = $connection -> query("SELECT * FROM Customers") or die("Customer Table not Accessable.");
                        $count = 0;
                        while($row = $CustomerData -> fetch_assoc())
                        {
                            $count++;
                            echo "<tr>";
                            echo "<td>" . $count . "</td>";
                            echo "<td>" . $row['AccountNumber'] . "</td>";
                            echo "<td>" . $row['AccountType'] . "</td>";
                            echo "<td>" . $row['FirstName'] . "</td>";
                            echo "<td>" . $row['MiddleName'] . "</td>";
                            echo "<td>" . $row['LastName'] . "</td>";
                            echo "<td>" . $row['MobileNumber'] . "</td>";
                            echo "<td>" . $row['CurrentBalance'] . "</td>";
                            echo "<td>" . $row['EmailID'] . "</td>";
                            // echo "<td>" . $row['Address'] . "</td>";
                            // echo "<td>" . $row['Notes'] . "</td>";
                            // echo "<td>" . $row['CreatedOn'] . "</td>";
                            // echo "<td>" . $row['LastActivity'] . "</td>";
                            echo "<td>";
                            echo "<form method='POST' action='./moreInformation.php'>";
                            echo '<button type="submit" name="AccountNumber" value="' . $row['AccountNumber'] . '" class="btn btn-outline-danger btn-sm">';
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">';
                            echo '<path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>';
                            echo "</svg>";
                            echo "</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <?php
                            echo '<th colspan="10"><h5><strong class="bg-danger text-white py-1 px-2 rounded">' . $count . '</strong> Account Holders</h5> ( SA - Saving Account, CA - Current Account)</th>';
                        ?>
                    </tr>
                </tfoot>
            </table>
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