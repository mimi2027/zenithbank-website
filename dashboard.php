<?php

include("connect.php");

/* =========================================
   DASHBOARD STATISTICS
========================================= */

/* CUSTOMER COUNT */
$customer_result = mysqli_query(
    $db_con,
    "SELECT COUNT(*) AS total FROM customer"
);

$customer_data = mysqli_fetch_assoc($customer_result);
$total_customers = $customer_data['total'];


/* STAFF COUNT */
$staff_result = mysqli_query(
    $db_con,
    "SELECT COUNT(*) AS total FROM staff"
);

$staff_data = mysqli_fetch_assoc($staff_result);
$total_staff = $staff_data['total'];


/* ADMIN COUNT */
$admin_result = mysqli_query(
    $db_con,
    "SELECT COUNT(*) AS total FROM admin"
);

$admin_data = mysqli_fetch_assoc($admin_result);
$total_admins = $admin_data['total'];

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>ZenithBank | Dashboard</title>

    <link
        rel="stylesheet"
        href="css/style.css"
    >

</head>


<body>


<!-- =========================================
     NAVIGATION
========================================= -->

<header class="navbar">

    <div class="logo">

        <span>Zenith</span>Bank

    </div>


    <nav>

        <a
            href="index.php"
            class="active"
        >
            Home
        </a>

        <a href="viewcustomer.php">
            Customers
        </a>

        <a href="viewstaff.php">
            Staff
        </a>

        <a href="viewadmin.php">
            Admin
        </a>
		

        <a
            href="#"
            class="logout"
        >
            Logout
        </a>

    </nav>

</header>



<!-- =========================================
     MAIN DASHBOARD
========================================= -->

<main class="dashboard">


    <!-- =====================================
         DASHBOARD HEADER
    ====================================== -->

    <section class="dashboard-header">

        <div>

            <h1>
                Banking Management System
            </h1>

            <p>
                Welcome to the ZenithBank administration dashboard.
            </p>

        </div>

    </section>



    <!-- =====================================
         STATISTICS CARDS
    ====================================== -->

    <section class="stats">


        <!-- CUSTOMERS -->

        <div class="stat-card">

            <div class="stat-icon">
                &#128100;
            </div>


            <div>

                <h3>
                    Customers
                </h3>

                <p>
                    <?php echo $total_customers; ?>
                </p>

            </div>

        </div>



        <!-- STAFF -->

        <div class="stat-card">

            <div class="stat-icon">
                &#128188;
            </div>


            <div>

                <h3>
                    Staff
                </h3>

                <p>
                    <?php echo $total_staff; ?>
                </p>

            </div>

        </div>



        <!-- ADMINISTRATORS -->

        <div class="stat-card">

            <div class="stat-icon">
                &#128272;
            </div>


            <div>

                <h3>
                    Administrators
                </h3>

                <p>
                    <?php echo $total_admins; ?>
                </p>

            </div>

        </div>


    </section>



    <!-- =====================================
         QUICK ACTIONS
    ====================================== -->

    <section class="quick-section">

        <h2>
            Quick Actions
        </h2>


        <div class="quick-actions">


            <!-- CUSTOMER -->

            <a
                href="viewcustomer.php"
                class="action-card"
            >

                <span>
                    &#128100;
                </span>

                <h3>
                    Manage Customers
                </h3>

                <p>
                    Add, edit, view and delete customers.
                </p>

            </a>



            <!-- STAFF -->

            <a
                href="viewstaff.php"
                class="action-card"
            >

                <span>
                    &#128188;
                </span>

                <h3>
                    Manage Staff
                </h3>

                <p>
                    Manage ZenithBank staff records.
                </p>

            </a>



            <!-- ADMIN -->

            <a
                href="viewadmin.php"
                class="action-card"
            >

                <span>
                    &#128272;
                </span>

                <h3>
                    Manage Admin
                </h3>

                <p>
                    Manage system administrator records.
                </p>

            </a>


        </div>

    </section>


</main>



<!-- =========================================
     FOOTER
========================================= -->

<footer>

    <p>

        &copy;
        <?php echo date("Y"); ?>
        ZenithBank Banking Management System

    </p>

</footer>


</body>

</html>