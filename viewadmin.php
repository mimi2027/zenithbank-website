<?php

include("connect.php");

/* =========================================
   SEARCH
========================================= */

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

/* =========================================
   FETCH ADMIN RECORDS
========================================= */

if ($search !== "") {

    $search_safe = mysqli_real_escape_string($db_con, $search);

    $sql = mysqli_query(
        $db_con,
        "SELECT * FROM admin
         WHERE name LIKE '%$search_safe%'
         OR email LIKE '%$search_safe%'
         OR dept LIKE '%$search_safe%'
         OR qlf LIKE '%$search_safe%'
         OR age LIKE '%$search_safe%'
         ORDER BY id DESC"
    );

} else {

    $sql = mysqli_query(
        $db_con,
        "SELECT * FROM admin
         ORDER BY id DESC"
    );
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>ZenithBank | Admin Management</title>

    <link
        rel="icon"
        href="pic.jpg"
        type="image/jpeg"
    >

    <style>

        /* =========================================
           RESET
        ========================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =========================================
           BODY
        ========================================= */

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1e293b;
            min-height: 100vh;
        }


        /* =========================================
           NAVBAR
        ========================================= */

        .navbar {
            background: #071a3d;
            min-height: 70px;
            padding: 0 40px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.15);
        }


        /* LOGO */

        .logo {
            color: white;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .logo span {
            color: #ffffff;
        }


        /* NAVIGATION */

        nav {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        nav a {
            color: #dbe4f0;
            text-decoration: none;
            padding: 11px 15px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
        }

        nav a:hover {
            background: rgba(255, 255, 255, 0.10);
            color: white;
        }

        nav a.active {
            background: #e31837;
            color: white;
        }

        nav a.logout {
            margin-left: 8px;
            border: 1px solid rgba(255, 255, 255, 0.30);
        }


        /* =========================================
           MAIN PAGE
        ========================================= */

        .admin-page {
            width: 100%;
            max-width: 1250px;
            margin: 45px auto;
            padding: 0 20px;
        }


        /* =========================================
           PAGE HEADER
        ========================================= */

        .admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .admin-header h1 {
            color: #071a3d;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .admin-header p {
            color: #64748b;
            font-size: 14px;
        }


        /* ADD ADMIN */

        .add-admin-btn {
            background: #e31837;
            color: white;
            text-decoration: none;

            padding: 13px 20px;
            border-radius: 8px;

            font-size: 14px;
            font-weight: 600;

            white-space: nowrap;
            transition: 0.2s;
        }

        .add-admin-btn:hover {
            background: #c41230;
            transform: translateY(-1px);
        }


        /* =========================================
           SEARCH CARD
        ========================================= */

        .admin-search {
            background: white;
            padding: 20px;

            border: 1px solid #e2e8f0;
            border-radius: 12px;

            box-shadow: 0 5px 18px rgba(15, 23, 42, 0.05);

            margin-bottom: 25px;
        }

        .admin-search form {
            display: flex;
            gap: 10px;
        }

        .admin-search input {
            flex: 1;

            height: 45px;

            padding: 0 15px;

            border: 1px solid #cbd5e1;
            border-radius: 8px;

            font-size: 14px;
            outline: none;
        }

        .admin-search input:focus {
            border-color: #e31837;
            box-shadow: 0 0 0 3px rgba(227, 24, 55, 0.08);
        }

        .search-btn {
            border: none;
            background: #071a3d;
            color: white;

            padding: 0 22px;
            border-radius: 8px;

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;
        }

        .search-btn:hover {
            background: #0c2a5c;
        }

        .clear-search {
            display: flex;
            align-items: center;

            padding: 0 17px;

            background: #e2e8f0;
            color: #334155;

            border-radius: 8px;

            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .clear-search:hover {
            background: #cbd5e1;
        }


        /* =========================================
           TABLE CARD
        ========================================= */

        .admin-table-card {
            background: white;

            border: 1px solid #e2e8f0;
            border-radius: 14px;

            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.07);

            overflow: hidden;
        }


        /* =========================================
           TABLE TITLE
        ========================================= */

        .table-title {
            padding: 25px 28px;

            border-bottom: 1px solid #e5e7eb;
        }

        .table-title h2 {
            color: #071a3d;
            font-size: 19px;
            margin-bottom: 6px;
        }

        .table-title p {
            color: #64748b;
            font-size: 13px;
        }

        .table-title strong {
            color: #071a3d;
        }


        /* =========================================
           TABLE RESPONSIVE
        ========================================= */

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }


        /* =========================================
           TABLE
        ========================================= */

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        .admin-table thead {
            background: #f8fafc;
        }

        .admin-table th {
            padding: 15px 18px;

            text-align: left;

            color: #475569;

            font-size: 12px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 0.4px;

            border-bottom: 1px solid #e2e8f0;
        }

        .admin-table td {
            padding: 17px 18px;

            font-size: 14px;

            border-bottom: 1px solid #edf1f5;

            color: #475569;
        }

        .admin-table tbody tr {
            transition: 0.15s;
        }

        .admin-table tbody tr:hover {
            background: #f8fafc;
        }

        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }


        /* ADMIN NAME */

        .admin-name {
            color: #071a3d !important;
            font-weight: 600;
        }


        /* =========================================
           ACTION BUTTONS
        ========================================= */

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            text-decoration: none;

            padding: 8px 13px;

            border-radius: 6px;

            font-size: 12px;
            font-weight: 600;

            transition: 0.2s;
        }

        .edit-btn {
            background: #e8eef7;
            color: #071a3d;
        }

        .edit-btn:hover {
            background: #d8e2f0;
        }

        .delete-btn {
            background: #fee2e2;
            color: #b91c1c;
        }

        .delete-btn:hover {
            background: #fecaca;
        }


        /* =========================================
           EMPTY RESULT
        ========================================= */

        .no-admin {
            text-align: center !important;
            padding: 45px 20px !important;

            color: #64748b !important;
            font-size: 14px !important;
        }


        /* =========================================
           FOOTER
        ========================================= */

        footer {
            text-align: center;

            padding: 25px 20px;

            color: #94a3b8;

            font-size: 12px;
        }


        /* =========================================
           MOBILE
        ========================================= */

        @media (max-width: 800px) {

            .navbar {
                padding: 15px 20px;

                flex-direction: column;
                align-items: flex-start;

                gap: 15px;
            }

            nav {
                width: 100%;

                overflow-x: auto;

                padding-bottom: 3px;
            }

            nav a {
                white-space: nowrap;
            }

            .admin-page {
                margin: 30px auto;
            }

            .admin-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .add-admin-btn {
                width: 100%;
                text-align: center;
            }

        }


        @media (max-width: 600px) {

            .admin-header h1 {
                font-size: 25px;
            }

            .admin-search form {
                flex-direction: column;
            }

            .admin-search input {
                height: 45px;
            }

            .search-btn,
            .clear-search {
                height: 44px;
                justify-content: center;
            }

            .table-title {
                padding: 20px;
            }

        }
		/* =========================================
   ADMIN TABLE TITLE
========================================= */

.table-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.table-title-left {
    flex: 1;
}

.table-title-left h2 {
    margin-bottom: 6px;
}
/* =========================================
   EXPORT EXCEL BUTTON
========================================= */

.export-excel-btn {
    background: #198754;
    color: white;
    text-decoration: none;

    padding: 10px 18px;
    border-radius: 6px;

    font-size: 14px;
    font-weight: 600;

    display: inline-block;

    white-space: nowrap;

    transition: 0.2s;
}

.export-excel-btn:hover {
    background: #157347;
    color: white;
    transform: translateY(-1px);
}
    </style>

</head>


<body>


<!-- =========================================
     NAVBAR
========================================= -->

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

        <a href="viewstaff.php">
            Staff
        </a>

        <a href="viewadmin.php" class="active">
            Admin
        </a>

        <a href="#" class="logout">
            Logout
        </a>

    </nav>

</header>


<!-- =========================================
     MAIN CONTENT
========================================= -->

<main class="admin-page">


    <!-- PAGE HEADER -->

    <div class="admin-header">

        <div>

            <h1>
                Admin Management
            </h1>

            <p>
                View and manage ZenithBank administrator records.
            </p>

        </div>


        <a
            href="createadmin.php"
            class="add-admin-btn"
        >
            + Add Admin
        </a>

    </div>


    <!-- =========================================
         SEARCH
    ========================================= -->

    <div class="admin-search">

        <form
            method="GET"
            action="viewadmin.php"
        >

            <input
                type="text"
                name="search"
                placeholder="Search by name, email, department or qualification..."
                value="<?php echo htmlspecialchars($search); ?>"
            >


            <button
                type="submit"
                class="search-btn"
            >
                Search
            </button>


            <?php if ($search !== "") { ?>

                <a
                    href="viewadmin.php"
                    class="clear-search"
                >
                    Clear
                </a>

            <?php } ?>

        </form>

    </div>


    <!-- =========================================
         ADMIN TABLE
    ========================================= -->

    <div class="admin-table-card">

<div class="table-title">

    <div class="table-title-left">

        <h2>
            Administrator List
        </h2>


        <?php if ($search !== "") { ?>

            <p>
                Search results for:
                <strong>
                    <?php echo htmlspecialchars($search); ?>
                </strong>
            </p>

        <?php } else { ?>

            <p>
                All registered ZenithBank administrators.
            </p>

        <?php } ?>

    </div>


   <a
    href="exportadmin.php<?php
        echo ($search !== "")
            ? '?search=' . urlencode($search)
            : '';
    ?>"
    class="export-excel-btn"
>
 📊 Export Excel
</a>

</div>

        <div class="table-responsive">

            <table class="admin-table">


                <thead>

                    <tr>

                        <th>#</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Department</th>

                        <th>Qualification</th>

                        <th>Age</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $cnt = 1;


                if (mysqli_num_rows($sql) > 0) {

                    while ($row = mysqli_fetch_assoc($sql)) {

                ?>

                    <tr>

                        <td>
                            <?php echo $cnt; ?>
                        </td>


                        <td class="admin-name">

                            <?php
                            echo htmlspecialchars($row['name']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['email']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['dept']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['qlf']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['age']);
                            ?>

                        </td>


                        <td>

                            <div class="action-buttons">

                                <a
                                    href="editadmin.php?id=<?php echo (int)$row['id']; ?>"
                                    class="edit-btn"
                                >
                                    Edit
                                </a>


                                <a
                                    href="deleteadmin.php?id=<?php echo (int)$row['id']; ?>"
                                    class="delete-btn"

                                    onclick="return confirm(
                                        'Are you sure you want to delete this administrator?'
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

                    <tr>

                        <td
                            colspan="7"
                            class="no-admin"
                        >
                            No administrator records found.
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
        &copy; <?php echo date("Y"); ?> ZenithBank.
        All Rights Reserved.
    </p>

</footer>


</body>

</html>