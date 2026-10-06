<?php

session_start();

include('connect.php');


/* =========================================
   CHECK FORM SUBMISSION
========================================= */

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["create"])) {

    header("Location: createstaff.php");
    exit;
}


/* =========================================
   GET FORM DATA
========================================= */

$name  = trim($_POST["name"] ?? "");
$age   = trim($_POST["age"] ?? "");
$email = trim($_POST["email"] ?? "");
$qlf   = trim($_POST["qlf"] ?? "");


/* =========================================
   VALIDATE STAFF INFORMATION
========================================= */

if ($name === "" || $age === "" || $email === "" || $qlf === "") {

    $_SESSION["create_error"] = "Please fill in all staff information.";
    header("Location: createstaff.php");
    exit;
}


/* =========================================
   VALIDATE AGE
========================================= */

if (!is_numeric($age) || $age < 1) {

    $_SESSION["create_error"] = "Please enter a valid age.";
    header("Location: createstaff.php");
    exit;
}


/* =========================================
   VALIDATE EMAIL
========================================= */

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $_SESSION["create_error"] = "Please enter a valid email address.";
    header("Location: createstaff.php");
    exit;
}


/* =========================================
   INSERT STAFF RECORD
========================================= */

$sql = "INSERT INTO staff (name, age, email, qlf)
        VALUES (?, ?, ?, ?)";


$stmt = mysqli_prepare($db_con, $sql);


if (!$stmt) {

    $_SESSION["create_error"] = "Unable to prepare the staff record.";

    header("Location: createstaff.php");
    exit;
}


/* =========================================
   BIND VALUES
========================================= */

$age = (int)$age;

mysqli_stmt_bind_param(
    $stmt,
    "siss",
    $name,
    $age,
    $email,
    $qlf
);


/* =========================================
   EXECUTE
========================================= */

if (mysqli_stmt_execute($stmt)) {

    $_SESSION["create"] = "Staff Added Successfully!";

    mysqli_stmt_close($stmt);

    header("Location: viewstaff.php");
    exit;

} else {

    $_SESSION["create_error"] = "Unable to add staff record.";

    mysqli_stmt_close($stmt);

    header("Location: createstaff.php");
    exit;
}

?>