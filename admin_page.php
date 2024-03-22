<?php
require_once("entities/nhanvienQL.php");

// Define the number of employees per page
$employeesPerPage = 10;

// Get the current page from the URL query string
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Call the static method to display employees for the current page
$employees = NhanVien::displayEmployees($page, $employeesPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - List of Employees</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ccc;
            text-decoration: none;
        }
        .pagination a.active {
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
        }
        /* Add style for login button */
        .login-button {
            margin-top: 20px;
            text-align: center;
        }
        .login-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .login-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>List of Employees</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Birth Place</th>
                <th>Department ID</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($employees) && is_array($employees)) {
                foreach ($employees as $employee) {
                    echo "<tr>";
                    echo "<td>" . $employee['Ma_NV'] . "</td>";
                    echo "<td>" . $employee['Ten_NV'] . "</td>";
                    echo "<td>" . ($employee['Phai'] === 'NU' ? 'Female' : 'Male') . "</td>";
                    echo "<td>" . $employee['Noi_Sinh'] . "</td>";
                    echo "<td>" . $employee['Ma_Phong'] . "</td>";
                    echo "<td>" . $employee['Luong'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_employee.php?id=" . $employee['Ma_NV'] . "'>Edit</a>";
                    echo " | ";
                    echo "<a href='delete_employee.php?id=" . $employee['Ma_NV'] . "'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No employees found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php
        // Calculate total number of pages
        $totalEmployees = NhanVien::getTotalEmployees();
        $totalPages = ceil($totalEmployees / $employeesPerPage);

        // Display pagination links
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='admin_page.php?page=$i'>$i</a>";
        }
        ?>
    </div>
</body>
</html>
