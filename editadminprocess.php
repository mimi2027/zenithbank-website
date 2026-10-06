<?php

session_start();

include("connect.php");


/* -----------------------------------------
   CHECK REQUEST
----------------------------------------- */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: viewadmin.php");
    exit;
}


/* -----------------------------------------
   CHECK REQUIRED FIELDS
----------------------------------------- */

if (
    !isset($_POST["edit"]) ||
    !isset($_POST["id"]) ||
    !isset($_POST["name"]) ||
    !isset($_POST["email"]) ||
    !isset($_POST["dept"]) ||
    !isset($_POST["qlf"]) ||
    !isset($_POST["age"])
) {
    $_SESSION["error"] = "Invalid administrator update request.";
    header("Location: viewadmin.php");
    exit;
}


/* -----------------------------------------
   GET FORM DATA
----------------------------------------- */

$id = (int) $_POST["id"];

$name  = trim($_POST["name"]);
$email = trim($_POST["email"]);
$dept  = trim($_POST["dept"]);
$qlf   = trim($_POST["qlf"]);
$age   = (int) $_POST["age"];


/* -----------------------------------------
   BASIC VALIDATION
----------------------------------------- */

if ($id <= 0) {
    $_SESSION["error"] = "Invalid administrator ID.";
    header("Location: viewadmin.php");
    exit;
}

if ($name === "" || $email === "" || $dept === "" || $qlf === "" || $age <= 0) {
    $_SESSION["error"] = "Please complete all administrator information.";
    header("Location: editadmin.php?id=" . $id);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["error"] = "Please enter a valid email address.";
    header("Location: editadmin.php?id=" . $id);
    exit;
}


/* -----------------------------------------
   UPDATE RECORD
----------------------------------------- */

$sql = "
    UPDATE admin
    SET
        name = ?,
        email = ?,
        dept = ?,
        qlf = ?,
        age = ?
    WHERE id = ?
";


$stmt = mysqli_prepare($db_con, $sql);


if (!$stmt) {
    $_SESSION["error"] = "Unable to process the update.";
    header("Location: editadmin.php?id=" . $id);
    exit;
}


mysqli_stmt_bind_param(
    $stmt,
    "ssssii",
    $name,
    $email,
    $dept,
    $qlf,
    $age,
    $id
);


if (mysqli_stmt_execute($stmt)) {

    $_SESSION["update"] = "Administrator record updated successfully.";

    header("Location: viewadmin.php");
    exit;

} else {

    $_SESSION["error"] = "Unable to update administrator record.";

    header("Location: editadmin.php?id=" . $id);
    exit;
}


mysqli_stmt_close($stmt);
mysqli_close($db_con);

?>