<?php

session_start();

include("connect.php");


/* -----------------------------------------
   CHECK ID
----------------------------------------- */

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    $_SESSION["error"] = "Invalid administrator record.";

    header("Location: viewadmin.php");
    exit;
}


$id = (int) $_GET["id"];


/* -----------------------------------------
   DELETE RECORD
----------------------------------------- */

$stmt = mysqli_prepare(
    $db_con,
    "DELETE FROM admin WHERE id = ?"
);


if (!$stmt) {

    $_SESSION["error"] = "Unable to process the deletion.";

    header("Location: viewadmin.php");
    exit;
}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);


if (mysqli_stmt_execute($stmt)) {

    if (mysqli_stmt_affected_rows($stmt) > 0) {

        $_SESSION["delete"] =
            "Administrator record deleted successfully.";

    } else {

        $_SESSION["error"] =
            "Administrator record does not exist.";
    }

} else {

    $_SESSION["error"] =
        "Unable to delete administrator record.";
}


mysqli_stmt_close($stmt);

mysqli_close($db_con);


header("Location: viewadmin.php");
exit;

?>