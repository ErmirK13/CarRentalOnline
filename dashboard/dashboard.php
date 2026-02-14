<?php
session_start();
include "../includes/database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Users List</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        h1,
        h2 {
            color: #333;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .top-bar-left,
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        h2 {
            font-size: 1.2rem;
            margin: 0;
        }

        a.btn {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: 0.3s;
        }

        a.btn:hover {
            background: #0056b3;
            opacity: 0.9;
        }

        a.btn.logout {
            background: #dc3545;
        }

        a.btn.logout:hover {
            background: #c82333;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table-container h1 {
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #343a40;
            color: white;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        tr:hover {
            background: #e9ecef;
        }

        .action a {
            text-decoration: none;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 13px;
            margin-right: 5px;
            display: inline-block;
        }

        .action a.edit {
            background: #28a745;
        }

        .action a.delete {
            background: #dc3545;
        }

        .action a:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {

            .top-bar {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
                padding: 15px;
            }

            .top-bar-left,
            .top-bar-right {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            h2 {
                text-align: center;
                order: -1;
                margin-bottom: 10px;
            }

            a.btn {
                justify-content: center;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background: #fff !important;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border-bottom: 1px solid #eee;
            }

            td:last-child {
                border-bottom: 0;
                text-align: right;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                font-weight: 600;
                text-align: left;
                color: #555;
            }

            .action {
                display: flex;
                justify-content: flex-end;
                gap: 5px;
            }

            .action a {
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <div class="top-bar-left">
            <a href="../pages/index.php" class="btn">
                <i class="fa-solid fa-house"></i> Home
            </a>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?> 👋</h2>
        </div>

        <div class="top-bar-right">
            <a href="create.php" class="btn">
                <i class="fa-solid fa-plus"></i> Add User
            </a>
            <a href="../auth/logout.php" class="btn logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>

    <div class="table-container">
        <h1>Users List</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td data-label='ID'>{$row['id']}</td>
                            <td data-label='First Name'>{$row['first_name']}</td>
                            <td data-label='Last Name'>{$row['last_name']}</td>
                            <td data-label='Email'>{$row['email']}</td>
                            <td data-label='Role'>
                                <span style='background: " . ($row['role'] == 'admin' ? '#ffeeba' : '#e2e3e5') . "; padding: 3px 8px; border-radius: 10px; font-size: 12px; color: #333;'>
                                    {$row['role']}
                                </span>
                            </td>
                            <td data-label='Created At'>{$row['created_at']}</td>
                            <td class='action' data-label='Action'>
                                <a href='edit.php?id={$row['id']}' class='edit'><i class='fa-solid fa-pen'></i> Edit</a>
                                <a href='delete.php?id={$row['id']}' class='delete' onclick='return confirm(\"Are you sure?\");'><i class='fa-solid fa-trash'></i> Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center;'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>