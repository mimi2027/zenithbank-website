<?php
include("connect.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid administrator ID.");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($db_con, "SELECT * FROM admin WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Administrator record does not exist.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZenithBank | Update Administrator</title>

    <link rel="icon" href="pic.jpg" type="image/jpeg">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            min-height: 100vh;
            color: #1f2937;
        }

        /* TOP BAR */
        .topbar {
            background: #071a3d;
            color: white;
            padding: 18px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: #e31837;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
        }

        .brand h2 {
            font-size: 20px;
            letter-spacing: 0.5px;
        }

        .brand span {
            display: block;
            font-size: 12px;
            color: #cbd5e1;
            margin-top: 3px;
        }

        .page-label {
            font-size: 14px;
            color: #dbeafe;
        }

        /* MAIN */
        .container {
            width: 100%;
            max-width: 850px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            color: #071a3d;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: #64748b;
            font-size: 14px;
        }

        /* CARD */
        .form-card {
            background: white;
            border-radius: 14px;
            padding: 35px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
            border: 1px solid #e2e8f0;
        }

        .card-title {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 18px;
            margin-bottom: 25px;
        }

        .card-title h2 {
            color: #071a3d;
            font-size: 19px;
        }

        .card-title p {
            color: #64748b;
            font-size: 13px;
            margin-top: 5px;
        }

        /* FORM */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            color: #1e293b;
            background: #fff;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            border-color: #e31837;
            box-shadow: 0 0 0 3px rgba(227, 24, 55, 0.10);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 12px 22px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s;
        }

        .btn-cancel {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-cancel:hover {
            background: #cbd5e1;
        }

        .btn-update {
            background: #e31837;
            color: white;
        }

        .btn-update:hover {
            background: #c41230;
            transform: translateY(-1px);
        }

        /* FOOTER */
        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            padding: 20px;
        }

        /* MOBILE */
        @media (max-width: 650px) {

            .topbar {
                padding: 16px 20px;
            }

            .page-label {
                display: none;
            }

            .container {
                margin: 30px auto;
            }

            .page-heading h1 {
                font-size: 25px;
            }

            .form-card {
                padding: 24px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .form-group.full {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- TOP BAR -->
    <header class="topbar">

        <div class="brand">

            <div class="brand-icon">
                ZB
            </div>

            <div>
                <h2>ZenithBank</h2>
                <span>Administration Portal</span>
            </div>

        </div>

        <div class="page-label">
            Administrator Management
        </div>

    </header>


    <!-- MAIN CONTENT -->
    <main class="container">

        <div class="page-heading">

            <h1>Update Administrator</h1>

            <p>
                Update the information associated with this administrator account.
            </p>

        </div>


        <div class="form-card">

            <div class="card-title">

                <h2>Administrator Information</h2>

                <p>
                    Please review the information before saving your changes.
                </p>

            </div>


            <form action="editadminprocess.php" method="POST">

                <div class="form-grid">

                    <!-- NAME -->
                    <div class="form-group">

                        <label for="name">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="<?php echo htmlspecialchars($row['name']); ?>"
                            placeholder="Enter full name"
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
                            value="<?php echo htmlspecialchars($row['email']); ?>"
                            placeholder="Enter email address"
                            required
                        >

                    </div>


                    <!-- DEPARTMENT -->
                    <div class="form-group">

                        <label for="dept">
                            Department
                        </label>

                        <input
                            type="text"
                            id="dept"
                            name="dept"
                            value="<?php echo htmlspecialchars($row['dept']); ?>"
                            placeholder="Enter department"
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
                            value="<?php echo htmlspecialchars($row['qlf']); ?>"
                            placeholder="Enter qualification"
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
                            value="<?php echo htmlspecialchars($row['age']); ?>"
                            placeholder="Enter age"
                            min="1"
                            max="120"
                            required
                        >

                    </div>

                </div>


                <!-- HIDDEN ID -->
                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $id; ?>"
                >


                <!-- BUTTONS -->
                <div class="form-actions">

                    <a href="viewadmin.php" class="btn btn-cancel">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        name="edit"
                        class="btn btn-update"
                    >
                        Update Record
                    </button>

                </div>

            </form>

        </div>

    </main>


    <footer class="footer">
        ZenithBank Administration Portal &copy; <?php echo date("Y"); ?>
    </footer>

</body>

</html>