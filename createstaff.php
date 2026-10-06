<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZenithBank | Add Staff</title>

    <link rel="icon" href="pick.jpg" type="image/icon type">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #1f2937;
        }

        /* =========================
           HEADER
        ========================== */

        .navbar {
            background: #071a3d;
            color: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .logo span {
            color: #e31b23;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 9px 14px;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .nav-links a:hover {
            background: #e31b23;
        }

        /* =========================
           PAGE CONTAINER
        ========================== */

        .page-container {
            width: 90%;
            max-width: 850px;
            margin: 45px auto;
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            color: #071a3d;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 15px;
        }

        /* =========================
           FORM CARD
        ========================== */

        .form-card {
            background: white;
            border-radius: 14px;
            padding: 35px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .form-title {
            color: #071a3d;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f2f5;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #071a3d;
            box-shadow: 0 0 0 3px rgba(7, 26, 61, 0.08);
        }

        /* =========================
           BUTTONS
        ========================== */

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            border: none;
            padding: 13px 24px;
            border-radius: 7px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: 0.3s;
        }

        .btn-primary {
            background: #e31b23;
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            background: #c9141b;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #071a3d;
            color: white;
        }

        .btn-secondary:hover {
            background: #102b5c;
        }

        /* =========================
           FOOTER
        ========================== */

        footer {
            text-align: center;
            margin-top: 45px;
            padding: 20px;
            color: #6b7280;
            font-size: 13px;
        }

        /* =========================
           MOBILE
        ========================== */

        @media (max-width: 600px) {

            .navbar {
                padding: 16px 5%;
            }

            .logo {
                width: 100%;
                text-align: center;
            }

            .nav-links {
                width: 100%;
                justify-content: center;
            }

            .nav-links a {
                font-size: 13px;
                padding: 8px 10px;
            }

            .page-container {
                width: 94%;
                margin: 30px auto;
            }

            .page-header h1 {
                font-size: 26px;
            }

            .form-card {
                padding: 25px 20px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         HEADER
    ========================== -->

    <header class="navbar">

        <div class="logo">
            Zenith<span>Bank</span>
        </div>

        <nav class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="viewcustomer.php">Customers</a>
            <a href="viewstaff.php">Staff</a>
            <a href="viewadmin.php">Admin</a>
        </nav>

    </header>


    <!-- =========================
         MAIN CONTENT
    ========================== -->

    <main class="page-container">

        <div class="page-header">
            <h1>Add Staff Record</h1>
            <p>Enter the staff member's information carefully to create a new record.</p>
        </div>


        <div class="form-card">

            <div class="form-title">
                Staff Information
            </div>


            <form action="createstaffprocess.php" method="post">

                <div class="form-group">
                    <label for="name">Staff Name</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter staff full name"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="age">Age</label>

                    <input
                        type="number"
                        id="age"
                        name="age"
                        placeholder="Enter staff age"
                        min="1"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter staff email address"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="qlf">Qualification</label>

                    <input
                        type="text"
                        id="qlf"
                        name="qlf"
                        placeholder="Enter staff qualification"
                        required
                    >
                </div>


                <div class="form-actions">

                    <a href="viewstaff.php" class="btn btn-secondary">
                        View Staff
                    </a>

                    <button type="submit" name="create" class="btn btn-primary">
                        Add Staff
                    </button>

                </div>

            </form>

        </div>

    </main>


    <!-- =========================
         FOOTER
    ========================== -->

    <footer>
        &copy; <?php echo date("Y"); ?> ZenithBank Banking Management System.
        All Rights Reserved.
    </footer>

</body>
</html>