
<?php

include 'connect.php';

/* =========================================
   SEARCH CUSTOMER
========================================= */

$search = "";

if (isset($_GET['search'])) {

    $search = mysqli_real_escape_string(
        $db_con,
        $_GET['search']
    );

}


/* =========================================
   CUSTOMER QUERY
========================================= */

if ($search != "") {

    $sql = mysqli_query(
        $db_con,
        "SELECT * FROM customer
         WHERE name LIKE '%$search%'
         OR address LIKE '%$search%'
         OR age LIKE '%$search%'
         OR balance LIKE '%$search%'"
    );

} else {

    $sql = mysqli_query(
        $db_con,
        "SELECT * FROM customer"
    );

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>ZenithBank | Customers</title>

    <link rel="stylesheet"
          href="css/style.css">

</head>


<body>


<!-- =========================================
     HEADER
========================================= -->

<header class="navbar">

    <div class="logo">

        <span>Zenith</span>Bank

    </div>


    <nav>

        <a href="index.php">
            Home
        </a>


        <a href="viewcustomer.php"
           class="add-customer-btn">

            Customer

        </a>


        <a href="viewstaff.php">
            Staff
        </a>


        <a href="viewadmin.php">
            Admin
        </a>


        <a href="#"
           class="logout">

            Logout

        </a>

    </nav>

</header>



<!-- =========================================
     CUSTOMER SECTION
========================================= -->

<main class="customer-page">


    <div class="customer-header">

        <div>

            <h1>Customer Management</h1>

            <p>
                View and manage ZenithBank customer records.
            </p>

        </div>


        <a href="createcustomer.php"
           class="add-customer-btn">

            + Add Customer

        </a>

    </div>



    <!-- =====================================
         SEARCH
    ====================================== -->

    <div class="customer-search">

        <form method="GET"
              action="viewcustomer.php">

            <input
                type="text"
                name="search"
                placeholder="Search customer by name, address, age or balance..."
                value="<?php echo htmlentities($search); ?>"
            >


            <button type="submit">
                Search
            </button>


            <?php if ($search != "") { ?>

                <a href="viewcustomer.php"
                   class="clear-search">

                    Clear

                </a>

            <?php } ?>

        </form>

    </div>



    <!-- =====================================
         CUSTOMER TABLE
    ====================================== -->

    <div class="customer-table-card">


        <!-- CUSTOMER LIST HEADER -->

        <div class="table-title">

            <h2>
                Customer List
            </h2>


            <a href="exportcustomer.php<?php
                echo ($search != "")
                    ? '?search=' . urlencode($search)
                    : '';
            ?>"
               class="export-excel-btn">

                📊 Export Excel

            </a>

        </div>


        <?php if ($search != "") { ?>

            <p class="search-result-text">

                Search results for:

                <strong>
                    <?php echo htmlentities($search); ?>
                </strong>

            </p>

        <?php } ?>


        <div class="table-responsive">

            <table class="customer-table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Name</th>

                        <th>Age</th>

                        <th>Address</th>

                        <th>Balance</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>


                <?php

                $cnt = 1;

                if (mysqli_num_rows($sql) > 0) {

                    while ($row = mysqli_fetch_array($sql)) {

                ?>


                    <tr>

                        <td>

                            <?php echo $cnt; ?>

                        </td>


                        <td class="customer-name">

                            <?php

                            echo htmlentities(
                                $row['name']
                            );

                            ?>

                        </td>


                        <td>

                            <?php

                            echo htmlentities(
                                $row['age']
                            );

                            ?>

                        </td>


                        <td>

                            <?php

                            echo htmlentities(
                                $row['address']
                            );

                            ?>

                        </td>


                        <td class="balance">

                            ₦<?php

                            echo htmlentities(
                                $row['balance']
                            );

                            ?>

                        </td>


                        <td>

                            <div class="action-buttons">


                                <a
                                    href="editcustomer.php?id=<?php echo $row['id']; ?>"
                                    class="edit-btn"
                                >

                                    Edit

                                </a>


                                <a
                                    href="deletecustomer.php?id=<?php echo $row['id']; ?>"
                                    class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this customer?');"
                                >

                                    Delete

                                </a>


                            </div>

                        </td>

                    </tr>


                <?php

                        $cnt++;

                    }

                } else {

                ?>


                    <tr>

                        <td
                            colspan="6"
                            class="no-customer"
                        >

                            No customer records found.

                        </td>

                    </tr>


                <?php } ?>


                </tbody>

            </table>

        </div>

    </div>


</main>



<!-- =========================================
     FOOTER
========================================= -->

<footer>

    <p>

        &copy; 2026 ZenithBank Banking Management System

    </p>

</footer>


</body>

</html>
