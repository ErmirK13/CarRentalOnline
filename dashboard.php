<?php
session_start();
include "database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users Table</title>
</head>

<body>
    <div style="display:flex; justify-content:space-between;">
        <h1>Lista e Users</h1>
        <a href="logout.php" style="background:#dc3545;">Logout</a>
    </div>

    <h2><a href="create.php">+ Shto User</a></h2>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>email</th>
                    <th>role</th>
                    <th>created_at</th>
                    <th>action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                include "database.php";

                $sql = "SELECT * FROM users";
                $result = $connection->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "
            <tr>
                <td>{$row['ID']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['role']}</td>
                <td>{$row['created_at']}</td>
                <td class='action'>
                    <a href='edit.php?id={$row['ID']}'>Edit</a>
                    <a href='delete.php?id={$row['ID']}'>Delete</a>
                </td>
            </tr>
            ";
                }
                ?>
            </tbody>
        </table>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        a {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 6px 12px;
            border-radius: 5px;
        }

        a:hover {
            background: #0056b3;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        tr:hover {
            background: #dce9ff;
        }

        .action a {
            background: #28a745;
            margin: 2px;
        }

        .action a:last-child {
            background: #dc3545;
        }

        .action a:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
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
    </style>



</body>

</html>