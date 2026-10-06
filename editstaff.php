
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>ZenithBank | Edit Staff</title>

    <link rel="icon"
          href="pic.jpg"
          type="image/icon type">

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
            min-height: 100vh;
        }

        /* ==============================
           HEADER
        ============================== */

        .navbar {
            background: #071f4b;
            color: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
        }

        .logo span {
            color: #4da3ff;
        }

        .navbar nav a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-size: 14px;
            font-weight: 600;
        }

        .navbar nav a:hover {
            color: #4da3ff;
        }

        /* ==============================
           PAGE
        ============================== */

        .page-container {
            width: 90%;
            max-width: 850px;
            margin: 50px auto;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            color: #071f4b;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 15px;
        }

        /* ==============================
           FORM CARD
        ============================== */

        .edit-card {
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .form-title {
            font-size: 20px;
            font-weight: bold;
            color: #071f4b;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.10);
        }

        /* ==============================
           BUTTONS
        ============================== */

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #e5e7eb;
        }

        .update-btn,
        .cancel-btn {
            display: inline-block;
            padding: 12px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }

        .update-btn {
            background: #0b5ed7;
            color: white;
        }

        .update-btn:hover {
            background: #084298;
        }

        .cancel-btn {
            background: #eef2f7;
            color: #374151;
        }

        .cancel-btn:hover {
            background: #e2e8f0;
        }

        /* ==============================
           ERROR MESSAGE
        ============================== */

        .error-message {
            background: #fff4f4;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        /* ==============================
           FOOTER
        ============================== */

        footer {
            text-align: center;
            padding: 25px;
            margin-top: 40px;
            color: #6b7280;
            font-size: 13px;
        }

        /* ==============================
           MOBILE
        ============================== */

        @media (max-width: 650px) {

            .navbar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .navbar nav a {
                margin: 0 7px;
                font-size: 13px;
            }

            .page-container {
                width: 94%;
                margin: 30px auto;
            }

            .edit-card {
                padding: 22px;
            }

            .page-header h1 {
                font-size: 25px;
            }

            .form-actions {
                flex-direction: column;
            }

            .update-btn,
            .cancel-btn {
                width: 100%;
                text-align: center;
            }

        }

    </style>

</head>


<body>


<!-- ==============================
     HEADER
============================== -->

<header class="navbar">

    <div class="logo">
        <span>Zenith</span>Bank
    </div>

    <nav>

        <a href="dashboard.php">
            Dashboard
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

    </nav>

</header>


<!-- ==============================
     MAIN CONTENT
============================== -->

<main class="page-container">


<?php

if (isset($_GET['id'])) {

    include("connect.php");

    $id = mysqli_real_escape_string(
        $db_con,
        $_GET['id']
    );

    $sql = "SELECT * FROM staff WHERE id='$id'";

    $result = mysqli_query(
        $db_con,
        $sql
    );

    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

?>


    <div class="page-header">

        <h1>Edit Staff Member</h1>

        <p>
            Update the staff member's information below.
        </p>

    </div>


    <div class="edit-card">

        <div class="form-title">
            Staff Information
        </div>


        <form
            action="editstaffprocess.php"
            method="post"
        >


            <!-- NAME -->

            <div class="form-group">

                <label for="name">
                    Staff Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?php echo htmlentities($row['name']); ?>"
                    required
                >

            </div>


            <!-- AGE -->

            <div class="form-group">

                <label for="age">
                    Age
                </label>

                <input
                    type="number"
                    id="age"
                    name="age"
                    value="<?php echo htmlentities($row['age']); ?>"
                    required
                >

            </div>


            <!-- EMAIL -->

            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?php echo htmlentities($row['email']); ?>"
                    required
                >

            </div>


            <!-- QUALIFICATION -->

            <div class="form-group">

                <label for="qlf">
                    Qualification
                </label>

                <input
                    type="text"
                    id="qlf"
                    name="qlf"
                    value="<?php echo htmlentities($row['qlf']); ?>"
                    required
                >

            </div>


            <!-- STAFF ID -->

            <input
                type="hidden"
                name="id"
                value="<?php echo htmlentities($id); ?>"
            >


            <!-- ACTIONS -->

            <div class="form-actions">

                <button
                    type="submit"
                    name="edit"
                    class="update-btn"
                >
                    Update Staff
                </button>


                <a
                    href="viewstaff.php"
                    class="cancel-btn"
                >
                    Cancel
                </a>

            </div>


        </form>

    </div>


<?php

    } else {

        echo '
            <div class="error-message">
                Staff record could not be found.
            </div>
        ';

    }

} else {

    echo '
        <div class="error-message">
            No staff ID was provided.
        </div>
    ';

}

?>


</main>


<!-- ==============================
     FOOTER
============================== -->

<footer>

    &copy; 2026 ZenithBank Banking Management System

</footer>


</body>

</html>
