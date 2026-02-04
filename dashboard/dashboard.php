<?php
session_start();
include "../includes/database.php";

// Kontrollo nëse përdoruesi është admin
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
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        h1, h2 {
            color: #333;
        }

        a {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 6px 12px;
            border-radius: 5px;
            margin: 2px;
            display: inline-block;
        }

        a:hover {
            background: #0056b3;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #343a40;
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        tr:hover {
            background: #dce9ff;
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
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none;
            }

            td {
                padding: 10px;
                text-align: right;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
            }
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar a.logout {
            background: #dc3545;
        }

        .top-bar a.add-user {
            background: #007bff;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?> 👋</h2>
        <div>
            <a href="create.php" class="add-user">+ Add User</a>
            <a href="../auth/logout.php" class="logout">Logout</a>
        </div>
    </div>

    <div class="table-container">
        <h1>Users List</h1>
        <table>
            <thead>
                <tr>
                    <th>id</th>
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
                // Merr të gjithë përdoruesit nga DB
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td data-label='ID'>{$row['id']}</td>
                            <td data-label='First Name'>{$row['first_name']}</td>
                            <td data-label='Last Name'>{$row['last_name']}</td>
                            <td data-label='Email'>{$row['email']}</td>
                            <td data-label='Role'>{$row['role']}</td>
                            <td data-label='Created At'>{$row['created_at']}</td>
                            <td class='action'>
                                <a href='edit.php?id={$row['id']}' class='edit'>Edit</a>
                                <a href='delete.php?id={$row['id']}' class='delete'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
