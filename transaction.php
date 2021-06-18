<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Transactions</title>
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
                    <a class="nav-link" href="customers.php">Customers</a>
                    <a class="nav-link active" href="transaction.php">Transactions</a>
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
                        <th>Transaction Number</th>
                        <th>Transaction From</th>
                        <th>Transaction To</th>
                        <th>Transaction Amount</th>
                        <th>Transaction Date-Time</th>
                        <th>Transaction Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('database/connection.php');
                        $TransactionsData = $connection -> query("SELECT * FROM Transactions ORDER BY TransactionDate DESC") or die("Transaction Table not Accessable.");
                        $count = 0;
                        while($row = $TransactionsData -> fetch_assoc())
                        {
                            $count++;
                            echo "<tr>";
                            echo "<td>" . $count . "</td>";
                            echo "<td>" . $row['TransactionNumber'] . "</td>";
                            echo "<td>" . $row['TransactionFrom'] . "</td>";
                            echo "<td>" . $row['TransactionTo'] . "</td>";
                            echo "<td>" . $row['TransactionAmount'] . "</td>";
                            echo "<td>" . $row['TransactionDate'] . "</td>";
                            echo "<td>" . $row['TransactionNote'] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <?php
                            echo '<th colspan="7"><h5>Total <strong class="bg-danger text-white py-1 px-2 rounded">' . $count . '</strong> Transactions are Done</th>';
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