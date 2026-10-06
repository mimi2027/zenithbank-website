<?php

session_start();

include('connect.php');


/* =========================================
   CHECK FORM SUBMISSION
========================================= */

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["create"])) {

    header("Location: createcustomer.php");
    exit;
}


/* =========================================
   GET FORM DATA
========================================= */

$name = trim($_POST["name"] ?? "");
$address = trim($_POST["address"] ?? "");
$age = trim($_POST["age"] ?? "");
$balance = trim($_POST["balance"] ?? "");


/* =========================================
   VALIDATE CUSTOMER INFORMATION
========================================= */

if ($name === "" || $address === "" || $age === "" || $balance === "") {

    $_SESSION["create_error"] = "Please fill in all customer information.";
    header("Location: createcustomer.php");
    exit;
}


if (!is_numeric($age) || $age < 1) {

    $_SESSION["create_error"] = "Please enter a valid age.";
    header("Location: createcustomer.php");
    exit;
}


if (!is_numeric($balance) || $balance < 0) {

    $_SESSION["create_error"] = "Please enter a valid account balance.";
    header("Location: createcustomer.php");
    exit;
}


/* =========================================
   INSERT CUSTOMER RECORD
========================================= */

$sql = "INSERT INTO customer (name, address, age, balance)
        VALUES (?, ?, ?, ?)";


$stmt = mysqli_prepare($db_con, $sql);


if (!$stmt) {

    $_SESSION["create_error"] = "Unable to prepare the customer record.";

    header("Location: createcustomer.php");
    exit;
}


/* =========================================
   BIND VALUES
========================================= */

$age = (int)$age;
$balance = (float)$balance;

mysqli_stmt_bind_param(
    $stmt,
    "ssid",
    $name,
    $address,
    $age,
    $balance
);


/* =========================================
   EXECUTE
========================================= */

if (mysqli_stmt_execute($stmt)) {

    $_SESSION["create"] = "Customer Added Successfully!";

    mysqli_stmt_close($stmt);

    header("Location: viewcustomer.php");
    exit;

} else {

    $_SESSION["create_error"] = "Unable to add customer record.";

    mysqli_stmt_close($stmt);

    header("Location: createcustomer.php");
    exit;
}

?>