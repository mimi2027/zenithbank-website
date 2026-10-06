
<?php

include("connect.php");


/* =========================================
   CHECK STAFF ID
========================================= */

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = mysqli_real_escape_string(
        $db_con,
        $_GET['id']
    );


    /* =========================================
       DELETE STAFF RECORD
    ========================================= */

    $sql = "DELETE FROM staff WHERE id='$id'";


    if (mysqli_query($db_con, $sql)) {

        session_start();

        $_SESSION["delete"] =
            "Staff Record Deleted Successfully!";

        header("Location: viewstaff.php");

        exit();

    } else {

        die(
            "Unable to delete staff record. Please try again."
        );

    }

} else {

    echo "Invalid staff record.";

}

?>

