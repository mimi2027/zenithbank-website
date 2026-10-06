<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZenithBank | Staff Management</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>


<!-- ==================================================
     HEADER / NAVBAR
================================================== -->

<header class="navbar">

    <div class="logo">

        <span>Zenith</span>Bank

    </div>


    <nav>

        <a href="index.php">
            Home
        </a>

        <a href="viewcustomer.php">
            Customers
        </a>

        <a href="viewstaff.php"
           class="active">

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



<!-- ==================================================
     STAFF MANAGEMENT
================================================== -->

<main class="staff-page">


    <!-- =========================================
         STAFF HEADER
    ========================================= -->

    <div class="staff-header">

        <div>

            <h1>
                Staff Management
            </h1>

            <p>
                View and manage ZenithBank staff records.
            </p>

        </div>


        <a
            href="createstaff.php"
            class="add-staff-btn"
        >
            + Add Staff
        </a>

    </div>



    <!-- =========================================
         SEARCH
    ========================================= -->

    <div class="staff-search">

        <form
            method="GET"
            action="viewstaff.php"
        >

            <input
                type="text"
                name="search"
                placeholder="Search staff by name, age, email or qualification..."
                value="<?php
                    echo isset($_GET['search'])
                        ? htmlentities($_GET['search'])
                        : '';
                ?>"
            >

            <button type="submit">
                Search
            </button>


            <?php if (!empty($_GET['search'])) { ?>

                <a
                    href="viewstaff.php"
                    class="clear-search"
                >
                    Clear
                </a>

            <?php } ?>

        </form>

    </div>



    <!-- =========================================
         STAFF TABLE
    ========================================= -->

    <div class="staff-table-card">


        <!-- =========================================
             TABLE TITLE + EXPORT
        ========================================= -->

        <div class="table-title">

            <div class="table-title-left">

                <h2>
                    Staff List
                </h2>


                <?php if (!empty($_GET['search'])) { ?>

                    <p>

                        Search results for:

                        <strong>
                            <?php
                                echo htmlentities(
                                    $_GET['search']
                                );
                            ?>
                        </strong>

                    </p>

                <?php } else { ?>

                    <p>
                        All registered ZenithBank staff members.
                    </p>

                <?php } ?>

            </div>


            <!-- =========================================
                 EXPORT EXCEL
            ========================================= -->

            <a
                href="exportstaff.php<?php

                    echo (!empty($_GET['search']))

                        ? '?search=' .
                          urlencode($_GET['search'])

                        : '';

                ?>"
                class="export-excel-btn"
            >

                📊 Export Excel

            </a>

        </div>



        <!-- =========================================
             RESPONSIVE TABLE
        ========================================= -->

        <div class="table-responsive">


            <table class="staff-table">


                <!-- =========================================
                     TABLE HEADER
                ========================================= -->

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Age
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Qualification
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>



                <!-- =========================================
                     TABLE BODY
                ========================================= -->

                <tbody>

                <?php

                include 'connect.php';


                /* =========================================
                   SEARCH
                ========================================= */

                $search = "";


                if (isset($_GET['search'])) {

                    $search = mysqli_real_escape_string(
                        $db_con,
                        $_GET['search']
                    );

                }


                /* =========================================
                   STAFF QUERY
                ========================================= */

                if (!empty($search)) {

                    $sql = mysqli_query(

                        $db_con,

                        "SELECT * FROM staff
                         WHERE name LIKE '%$search%'
                         OR age LIKE '%$search%'
                         OR email LIKE '%$search%'
                         OR qlf LIKE '%$search%'
                         ORDER BY id ASC"

                    );

                } else {

                    $sql = mysqli_query(

                        $db_con,

                        "SELECT * FROM staff
                         ORDER BY id ASC"

                    );

                }


                /* =========================================
                   COUNTER
                ========================================= */

                $cnt = 1;


                /* =========================================
                   DISPLAY STAFF
                ========================================= */

                if (
                    $sql &&
                    mysqli_num_rows($sql) > 0
                ) {

                    while (
                        $row = mysqli_fetch_array($sql)
                    ) {

                ?>


                    <tr>


                        <!-- S/N -->

                        <td>

                            <?php
                                echo $cnt;
                            ?>

                        </td>



                        <!-- NAME -->

                        <td class="staff-name">

                            <?php

                                echo htmlentities(
                                    $row['name']
                                );

                            ?>

                        </td>



                        <!-- AGE -->

                        <td>

                            <?php

                                echo htmlentities(
                                    $row['age']
                                );

                            ?>

                        </td>



                        <!-- EMAIL -->

                        <td>

                            <?php

                                echo htmlentities(
                                    $row['email']
                                );

                            ?>

                        </td>



                        <!-- QUALIFICATION -->

                        <td>

                            <?php

                                echo htmlentities(
                                    $row['qlf']
                                );

                            ?>

                        </td>



                        <!-- ACTION -->

                        <td>


                            <div class="action-buttons">


                                <!-- EDIT -->

                                <a
                                    href="editstaff.php?id=<?php
                                        echo $row['id'];
                                    ?>"
                                    class="edit-btn"
                                >

                                    Edit

                                </a>



                                <!-- DELETE -->

                                <a
                                    href="deletestaff.php?id=<?php
                                        echo $row['id'];
                                    ?>"
                                    class="delete-btn"

                                    onclick="return confirm(
                                        'Are you sure you want to delete this staff record?'
                                    );"
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


                    <!-- =========================================
                         NO STAFF RECORDS
                    ========================================= -->

                    <tr>

                        <td
                            colspan="6"
                            class="no-staff"
                        >

                            No staff records found.

                        </td>

                    </tr>


                <?php } ?>


                </tbody>

            </table>


        </div>


    </div>


</main>



<!-- ==================================================
     FOOTER
================================================== -->

<footer>

    <p>

        &copy;

        <?php
            echo date("Y");
        ?>

        ZenithBank. All Rights Reserved.

    </p>

</footer>


</body>

</html>