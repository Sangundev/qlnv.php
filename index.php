<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Employees</title>
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
    <?php
    require_once("config/db.class.php");
    require_once("entities/nhanvien.class.php");


    // Define the number of employees per page
    $employeesPerPage = 5;

    // Get the current page from the URL query string
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Call the static method to display employees for the current page
    NhanVien::displayEmployees($page, $employeesPerPage);

    // Calculate the total number of pages
    $totalEmployees = NhanVien::getTotalEmployees();
    $totalPages = ceil($totalEmployees / $employeesPerPage);

    // Display pagination links
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = $i == $page ? "active" : "";
        echo "<a href='index.php?page=$i' class='$activeClass'>$i</a>";
    }
    echo "</div>";

    // Add a button to navigate to the current page
    echo "<div class='current-page-button'>";
    echo "<form action='index.php' method='get'>";
    echo "<input type='hidden' name='page' value='$page'>";
    echo "<button type='submit'>Go to Page $page</button>";
    echo "</form>";
    echo "</div>";

    // Add login button
    echo "<div class='login-button'>";
    echo "<a href='login.php'>Login</a>";
    echo "</div>";
    ?>
</body>
</html>
