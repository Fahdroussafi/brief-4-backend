<?php
require_once 'inc/auth.php';
auth();

require_once 'inc/db.php';

$product = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $categories = getCategories($conn);
    $brands = getBrands($conn);
    $product = getProducts($conn, 'product.id', $id)[0];
} else {
    header('location:products.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
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
                    <?php if ($_SESSION['role'] == 'admin') : ?>
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
                    <h2 class="title">Update Product</h2>
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
            <section class="section section--form">
                <h2 class="title--mobile">Update Product</h2>
                <div class="form--wrapper">
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label for="parfume-name">Name</label>
                                <input value="<?= $product['name'] ?>" required type="text" name="name" id="parfume-name" placeholder="Enter parfume name...">
                            </div>
                            <div class="input-group">
                                <label for="brand">Brand</label>
                                <select required name="brand" id="brand">
                                    <option value="">Select</option>
                                    <?php foreach ($brands as $brand) : ?>
                                        <option value="<?= $brand['brandID'] ?>"><?= $brand['brandName'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-group">
                                <label for="category">Category</label>
                                <select required name="category" id="category">
                                    <option value="">Select</option>
                                    <?php foreach ($categories as $cat) : ?>
                                        <option value="<?= $cat['categoryID'] ?>"><?= $cat['catName'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label for="volume">Volume</label>
                                <input required value="<?= $product['volume'] ?>" min="1" type="number" name="volume" id="volume">
                            </div>
                            <div class="input-group">
                                <label for="price">Price</label>
                                <input required value="<?= $product['price'] ?>" min="1" type="number" name="price" id="price">
                            </div>
                            <div class="input-group">
                                <label for="quantity">Quantity</label>
                                <input required value="<?= $product['quantity'] ?>" min="<?= $product['quantity'] ?>" type="number" name="quantity" id="quantity">
                                <input type="hidden" name="prevQuantity" value="<?= $product['quantity'] ?>">
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label>Gender</label>
                                <div class="gender">
                                    <div class="radio-group">
                                        <label for="male">Male</label>
                                        <input required type="radio" name="gender" value="male" id="male">
                                    </div>
                                    <div class="radio-group">
                                        <label for="female">Female</label>
                                        <input required type="radio" name="gender" value="female" id="female">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label for="desc">Description</label>
                                <input value="<?= $product['description'] ?>" class="desc" type="text" name="desc" placeholder="Enter description...">
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label for="image">Image</label>
                                <input required type="file" value="<?= $product['image'] ?>" name="image" id="image">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <div class="btn-group">
                            <button type="submit" name="updateProduct">Update</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>

</html>