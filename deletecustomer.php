```php
<?php

include("connect.php");


/* =========================================
   CHECK CUSTOMER ID
========================================= */

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = mysqli_real_escape_string(
        $db_con,
        $_GET['id']
    );


    /* =========================================
       DELETE CUSTOMER
    ========================================= */

    $sql = "DELETE FROM customer WHERE id='$id'";


    if (mysqli_query($db_con, $sql)) {

        session_start();

        $_SESSION["delete"] =
            "Customer Record Deleted Successfully!";

        header("Location: viewcustomer.php");

        exit();

    } else {

        die(
            "Unable to delete customer record. Please try again."
        );

    }

} else {

    echo "Invalid customer record.";

}

?>
```
