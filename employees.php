<?php
require_once 'inc/auth.php';
auth('admin');

require_once 'inc/db.admin.php';

$employees = getEmployees($conn);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['select'])) {
    if (!empty($_POST['select'])) {
        $searchBY = $_POST['select'];
        $value = $_POST['value'];
        $employees = searchEmloyee($conn,$searchBY,"%$value%");
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete'])) {
    if (!empty($_POST['id'])) {
        $employeeID = $_POST['id'];
        if (deleteEmployee($conn,$employeeID)) {
            header('location: employees.php');
        }   
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/products.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="hr"></div>
        <aside class="aside">
            <div class="logo">
                <h1><span class="p">P</span><span class="middle">arfume</span><span class="art">.art</span></h1>
            </div>
            <nav class="nav">
                <ul>
                    <li class="nav-link"><a href="dashboard.php"><img src="./assets/img/dashboard.svg" aria-hidden="true"><span>Dashboard</span></a></li>
                    <li class="nav-link"><a href="products.php"><img src="./assets/img/product.svg" aria-hidden="true"><span>Products</span></a></li>
                    <li class="nav-link"><a href="addproduct.php"><img src="./assets/img/add-product.svg" aria-hidden="true"><span>Add Product</span></a></li>
                    <li class="nav-link current"><a href="employees.php"><img src="./assets/img/users.svg" aria-hidden="true"><span>Employees</span></a></li>
                    <li class="nav-link"><a href="addemployee.php"><img src="./assets/img/add-user.svg" aria-hidden="true"><span>Add
                                Employee</span></a></li>
                    <li class="nav-link logout"><a href="#"><img src="./assets/img/logout.svg" aria-hidden="true"><span>Logout</span></a></li>
                </ul>
            </nav>
        </aside>
        <main class="main">
            <!-- main top  -->
            <div class="main--top">
                <div class="main--top_inner">
                    <h2 class="title">Employees</h2>
                    <div class="employee_info">
                        <div class="avatar">
                            <img src="./assets/img/avatar.svg" alt="avatar">
                        </div>
                        <div>
                            <div class="username"><?= $_SESSION['user']['username'] ?></div>
                            <div class="email"><?= $_SESSION['user']['email'] ?></div>
                        </div>
                    </div>
                    <div class="logout">
                        <a href="logout.php"><img src="./assets/img/logout-accent.svg"></a>
                    </div>
                </div>
            </div>
            <!-- section: products -->
            <section class="section">
                <h2 class="title--mobile">Employees</h2>
                <!-- row -->
                <div class="section--header">
                    <h3>All Employees</h3>
                    <form action="employees.php" method="POST">
                        <select name="select" id="select">
                            <option value="">Select</option>
                            <option value="employeeID">By ID</option>
                            <option value="username">Username</option>
                            <option value="email">Email</option>
                            <option value="phone">Phone</option>
                        </select>
                        <input type="search" name="value" id="search" placeholder="Type something...">
                    </form>
                </div>
                <!-- table -->
                <div class="section--body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th class="email">Email</th>
                                <th class="action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee) : ?>
                                <tr>
                                    <td><?= $employee['employeeID'] ?></td>
                                    <td><?= $employee['username'] ?></td>
                                    <td><?= $employee['phone'] ?></td>
                                    <td><?= $employee['email'] ?></td>
                                    <td>
                                        <ul class="action--list">
                                            <li><a href="#"><img src="./assets/img/call.png" alt=""></a></li>
                                            <li>
                                            <form method="POST" action="employees.php">
                                                <input type="hidden" name="id" value="<?= $employee['employeeID'] ?>">
                                                <button style="background:transparent;border:none;" name="delete" type="submit"><img src="./assets/img/trash-alt.png" alt=""></button>
                                            </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>