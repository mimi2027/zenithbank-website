
<?php

include("connect.php");


/* =========================================
   CHECK FORM SUBMISSION
========================================= */

if (isset($_POST["edit"])) {

    $name = mysqli_real_escape_string(
        $db_con,
        $_POST["name"]
    );

    $age = mysqli_real_escape_string(
        $db_con,
        $_POST["age"]
    );

    $email = mysqli_real_escape_string(
        $db_con,
        $_POST["email"]
    );

    $qlf = mysqli_real_escape_string(
        $db_con,
        $_POST["qlf"]
    );

    $id = mysqli_real_escape_string(
        $db_con,
        $_POST["id"]
    );


    /* =========================================
       UPDATE STAFF RECORD
    ========================================= */

    $sqlUpdate = "
        UPDATE staff
        SET
            name = '$name',
            age = '$age',
            email = '$email',
            qlf = '$qlf'
        WHERE id = '$id'
    ";


    if (mysqli_query($db_con, $sqlUpdate)) {

        session_start();

        $_SESSION["update"] =
            "Staff Record Updated Successfully!";

        header("Location: viewstaff.php");

        exit();

    } else {

        die(
            "Unable to update staff record. Please try again."
        );

    }

} else {

    echo "Invalid request.";

}

?>

