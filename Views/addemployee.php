<?php
require_once 'inc/auth.php';
auth('admin');

require_once 'inc/db.admin.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $employeeID = $_POST['id'];
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if (idExist($conn,$employeeID)) {
        header("location:addemployee.php?idexisterr=$employeeID");
    }

    if (insertEmployee($conn, $employeeID, $username, $passwd, $phone, $email) > 0)
        echo '<script>alert("Employee added successfully")</script>';
    else echo '<script>alert("Employee added successfully")</script>';
}

if (isset($_GET['idexisterr']) && $_GET['idexisterr']){
    echo "<script>alert('ID: ". htmlentities($_GET['idexisterr']) ."   already exist!');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/addproduct.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="hr"></div>
        <aside class="aside">
            <div class="logo">
                <h1><span class="p">P</span><span class="middle">erfume</span><span class="art">.art</span></h1>
            </div>
            <nav class="nav">
                <ul>
                    <li class="nav-link"><a href="dashboard.php"><img src="./assets/img/dashboard.svg" aria-hidden="true"><span>Dashboard</span></a></li>
                    <li class="nav-link"><a href="products.php"><img src="./assets/img/product.svg" aria-hidden="true"><span>Products</span></a></li>
                    <li class="nav-link"><a href="addproduct.php"><img src="./assets/img/add-product.svg" aria-hidden="true"><span>Add Product</span></a></li>
                    <li class="nav-link"><a href="employees.php"><img src="./assets/img/users.svg" aria-hidden="true"><span>Employees</span></a></li>
                    <li class="nav-link current"><a href="addemployee.php"><img src="./assets/img/add-user.svg" aria-hidden="true"><span>Add
                                Employee</span></a></li>
                    <li class="nav-link logout"><a href="#"><img src="./assets/img/logout.svg" aria-hidden="true"><span>Logout</span></a></li>
                </ul>
            </nav>
        </aside>
        <main class="main">
            <!-- main top  -->
            <div class="main--top">
                <div class="main--top_inner">
                    <h2 class="title">Add Employee</h2>
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
            <!-- section: employee -->
            <section class="section section--form employee--form">
                <h2 class="title--mobile">Add Employee</h2>
                <div class="form--wrapper">
                    <form action="addemployee.php" method="POST">
                        <div class="input-group">
                            <label for="id">ID (i.e: national identity card number)</label>
                            <input required type="text" name="id" id="id" placeholder="EX63763">
                        </div>
                        <div class="input-group">
                            <label for="username">Username</label>
                            <input required type="text" name="username" id="username" placeholder="Enter employee's username">
                        </div>
                        <div class="input-group">
                            <label for="phone">Phone number</label>
                            <input required type="tel" name="phone" id="phone" placeholder="+212 xxx xxx xxx">
                        </div>
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input required type="email" name="email" id="email" placeholder="employee@email.com">
                        </div>
                        <div class="input-group">
                            <label for="passwd">Password</label>
                            <input required type="passwd" name="passwd" id="passwd" placeholder="Enter the employee's password">
                        </div>
                        <div class="btn-group">
                            <button type="submit" name="add">Submit</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>

</html>