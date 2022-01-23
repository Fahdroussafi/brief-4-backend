<?php
require_once 'inc/auth.php';
auth();

require_once 'inc/db.php';

$products = getProducts($conn);

if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['select'])) {
    $by = $_POST['select'];
    $value = $_POST['value'];

    if ($by == "id" || $by == "name")
        $by = 'product.' . $by;
    elseif ($by == "cat") $by = "category.catName";
    elseif ($by == "brand") $by = "brand.brandName";

    $products = getProducts($conn, $by, "%$value%");
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete'])) {
    if (deleteProduct($conn, $_POST['id'])) {
        header('refresh:0;url=products.php');
        echo "<script>alert('Item deleted successfully.')</script>";
    } else echo "<script>alert('Oops somthing went wrong!')</script>";
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['sell'])) {
    $ref = $_POST['ref'];
    if(!$ref){
        header('refresh:0;url=products.php');
        echo "<script>alert('Oops this products is unavailbale!')</script>";
        exit;
    }
    if (sellProduct($conn, $_POST['ref'])) {
        echo "<script>alert('Item sold successfully.')</script>";
        header('refresh:0;url=products.php');
    } else echo "<script>alert('Oops somthing went wrong!')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
                    <li class="nav-link current"><a href="#"><img src="./assets/img/product.svg" aria-hidden="true"><span>Products</span></a></li>
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
                    <h2 class="title">Products</h2>
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
                <h2 class="title--mobile">Products</h2>
                <!-- row -->
                <div class="section--header">
                    <h3>All products</h3>
                    <form action="products.php" method="POST">
                        <select name="select" id="select">
                            <option value="">Select</option>
                            <option value="id">ID</option>
                            <option value="name">Name</option>
                            <option value="cat">Category</option>
                            <option value="brand">Brand</option>
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
                                <th>Name</th>
                                <th>Brand</th>
                                <th class="category">Category</th>
                                <th class="product-img">Image</th>
                                <th class="quantity">Quantity</th>
                                <th>Volume</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['brandName'] ?></td>
                                <td class="category"><?= $product['catName'] ?></td>
                                <td class="product-img"><img src="./assets/products/1.jpg" alt="1"></td>
                                <td class="quantity"><?= $product['quantity'] ?></td>
                                <td><?= $product['volume'] ?></td>
                                <td><?= $product['price'] ?>$</td>
                                <td>
                                    <ul class="action--list">
                                        <li>
                                            <form method="POST" action="products.php">
                                                <input type="hidden" name="ref" value="<?= $product['ref'] ?>">
                                                <button style="background:transparent;border:none;" name="sell" type="submit"><img class="sell-img" src="./assets/img/sell.png" alt=""></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="POST" action="updateproduct.php">
                                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                                <button style="background:transparent;border:none;" name="update" type="submit"><img class="update-img" src="./assets/img/edit.png" alt=""></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="POST" action="products.php">
                                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                                <button style="background:transparent;border:none;" name="delete" type="submit"><img class="delete-img" src="./assets/img/trash-alt.png" alt=""></button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>