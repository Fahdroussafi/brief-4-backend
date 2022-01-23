<?php
require_once 'inc/auth.php';
auth();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/products.css">
    <link rel="stylesheet" href="./css/dashbord.css">
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
                    <li class="nav-link current"><a href="#"><img src="./assets/img/dashboard.svg" aria-hidden="true"><span>Dashboard</span></a></li>
                    <li class="nav-link"><a href="products.php"><img src="./assets/img/product.svg" aria-hidden="true"><span>Products</span></a></li>
                    <li class="nav-link"><a href="addproduct.php"><img src="./assets/img/add-product.svg" aria-hidden="true"><span>Add Product</span></a></li>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                    <li class="nav-link"><a href="employees.php"><img src="./assets/img/users.svg" aria-hidden="true"><span>Employees</span></a></li>
                    <li class="nav-link"><a href="addemployee.php"><img src="./assets/img/add-user.svg" aria-hidden="true"><span>Add Employee</span></a></li>
                    <?php endif; ?>    
                    <li class="nav-link logout"><a href="#"><img src="./assets/img/logout.svg" aria-hidden="true"><span>Logout</span></a></li>
                </ul>
            </nav>
        </aside>
        <main class="main">
            <!-- main top  -->
            <div class="main--top">
                <div class="main--top_inner">
                    <h2 class="title">Dashboard</h2>
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
            <!-- section : statistics -->
            <section class="stats">
                <div class="cards">
                    <div class="card total">
                        <div class="card-body">
                            <span class="number">230</span>
                            <img src="./assets/img/shopping-bag.svg">
                        </div>
                        <div class="card-footer">
                            Total Products
                        </div>
                    </div>
                    <div class="card sold">
                        <div class="card-body">
                            <span class="number">230</span>
                            <img src="./assets/img/done-all.svg">
                        </div>
                        <div class="card-footer">
                            Products Sold
                        </div>
                    </div>
                    <div class="card categories">
                        <div class="card-body">
                            <span class="number">230</span>
                            <img src="./assets/img/point-duplicate.svg">
                        </div>
                        <div class="card-footer">
                            Categories
                        </div>
                    </div>
                    <div class="card brands">
                        <div class="card-body">
                            <span class="number">230</span>
                            <img src="./assets/img/spray-can.svg">
                        </div>
                        <div class="card-footer">
                            Brands
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>