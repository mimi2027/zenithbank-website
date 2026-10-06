<?php

session_start();

include('connect.php');


/* =========================================
   CHECK FORM SUBMISSION
========================================= */

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["create"])) {

    header("Location: createadmin.php");
    exit;
}


/* =========================================
   GET FORM DATA
========================================= */

$name  = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$dept  = trim($_POST["dept"] ?? "");
$qlf   = trim($_POST["qlf"] ?? "");
$age   = trim($_POST["age"] ?? "");


/* =========================================
   VALIDATE ADMINISTRATOR INFORMATION
========================================= */

if ($name === "" || $email === "" || $dept === "" || $qlf === "" || $age === "") {

    $_SESSION["create_error"] = "Please fill in all administrator information.";
    header("Location: createadmin.php");
    exit;
}


/* =========================================
   VALIDATE AGE
========================================= */

if (!is_numeric($age) || $age < 1) {

    $_SESSION["create_error"] = "Please enter a valid age.";
    header("Location: createadmin.php");
    exit;
}


/* =========================================
   VALIDATE EMAIL
========================================= */

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $_SESSION["create_error"] = "Please enter a valid email address.";
    header("Location: createadmin.php");
    exit;
}


/* =========================================
   INSERT ADMINISTRATOR RECORD
========================================= */

$sql = "INSERT INTO admin (name, email, dept, qlf, age)
        VALUES (?, ?, ?, ?, ?)";


$stmt = mysqli_prepare($db_con, $sql);


if (!$stmt) {

    $_SESSION["create_error"] = "Unable to prepare the administrator record.";

    header("Location: createadmin.php");
    exit;
}


/* =========================================
   BIND VALUES
========================================= */

$age = (int)$age;

mysqli_stmt_bind_param(
    $stmt,
    "ssssi",
    $name,
    $email,
    $dept,
    $qlf,
    $age
);


/* =========================================
   EXECUTE
========================================= */

if (mysqli_stmt_execute($stmt)) {

    $_SESSION["create"] = "Administrator Added Successfully!";

    mysqli_stmt_close($stmt);

    header("Location: viewadmin.php");
    exit;

} else {

    $_SESSION["create_error"] = "Unable to add administrator record.";

    mysqli_stmt_close($stmt);

    header("Location: createadmin.php");
    exit;
}

?>