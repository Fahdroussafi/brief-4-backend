<?php
session_start();

include("connection.php");
include("functions.php");


$user_data = check_login($con);

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
                    <li class="nav-link"><a href="dashbord.php"><img src="./assets/img/dashboard.svg" aria-hidden="true"><span>Dashboard</span></a></li>
                    <li class="nav-link current"><a href="#"><img src="./assets/img/product.svg" aria-hidden="true"><span>Products</span></a></li>
                    <li class="nav-link"><a href="addproduct.php"><img src="./assets/img/add-product.svg" aria-hidden="true"><span>Add Product</span></a></li>
                    <li class="nav-link"><a href="employees.php"><img src="./assets/img/users.svg" aria-hidden="true"><span>Employees</span></a></li>
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
                    <h2 class="title">Products</h2>
                    <div class="employee_info">
                        <div class="avatar">
                            <img src="./assets/img/avatar.svg" alt="avatar">
                        </div>
                        <div>
                            <div class="username"><?= $user_data['username']; ?></div>
                            <div class="email"><?= $user_data['email']; ?></div>
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
                    <form>
                        <select name="search" id="select">
                            <option value="all">Select</option>
                        </select>
                        <input type="search" name="search" id="search" placeholder="Type something...">
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
                            <tr>
                                <td>001</td>
                                <td>sauvage</td>
                                <td>sauvage</td>
                                <td class="category">parfum</td>
                                <td class="product-img"><img src="./assets/products/1.jpg" alt="1"></td>
                                <td class="quantity">3</td>
                                <td>100 ML</td>
                                <td>56$</td>
                                <td>
                                    <ul class="action--list">
                                        <li><a href="#"><img src="./assets/img/sell.png" alt=""></a></li>
                                        <li><a href="updateproduct.php"><img src="./assets/img/edit.png" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="./assets/img/trash-alt.png" alt=""></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>sauvage</td>
                                <td>sauvage</td>
                                <td class="category">parfum</td>
                                <td class="product-img"><img src="./assets/products/1_1.jpg" alt="11"></td>
                                <td class="quantity">12</td>
                                <td>100 ML</td>
                                <td>56$</td>
                                <td>
                                    <ul class="action--list">
                                        <li><a href="#"><img src="./assets/img/sell.png" alt=""></a></li>
                                        <li><a href="updateproduct.php"><img src="./assets/img/edit.png" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="./assets/img/trash-alt.png" alt=""></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>100</td>
                                <td>tom ford black orchid</td>
                                <td>paco rabanne</td>
                                <td class="category">parfum</td>
                                <td class="product-img"><img src="./assets/products/1_2.jpg" alt="11"></td>
                                <td class="quantity">24</td>
                                <td>100 ML</td>
                                <td>56$</td>
                                <td>
                                    <ul class="action--list">
                                        <li><a href="#"><img src="./assets/img/sell.png" alt=""></a></li>
                                        <li><a href="updateproduct.php"><img src="./assets/img/edit.png" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="./assets/img/trash-alt.png" alt=""></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>100</td>
                                <td>scandal</td>
                                <td>jean paul gaultier</td>
                                <td class="category">parfum</td>
                                <td class="product-img"><img src="./assets/products/1_3.jpg" alt="11"></td>
                                <td class="quantity">88</td>
                                <td>100 ML</td>
                                <td>56$</td>
                                <td>
                                    <ul class="action--list">
                                        <li><a href="#"><img src="./assets/img/sell.png" alt=""></a></li>
                                        <li><a href="updateproduct.php"><img src="./assets/img/edit.png" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="./assets/img/trash-alt.png" alt=""></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>100</td>
                                <td>libre</td>
                                <td>yves saint laurent</td>
                                <td class="category">eau de parum</td>
                                <td class="product-img"><img src="./assets/products/1_4.jpg" alt="11"></td>
                                <td class="quantity">30</td>
                                <td>100 ML</td>
                                <td>56$</td>
                                <td>
                                    <ul class="action--list">
                                        <li><a href="#"><img src="./assets/img/sell.png" alt=""></a></li>
                                        <li><a href="updateproduct.php"><img src="./assets/img/edit.png" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="./assets/img/trash-alt.png" alt=""></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>100</td>
                                <td>dolce & gabanna</td>
                                <td>paco rabanne</td>
                                <td class="category">eau de cologne</td>
                                <td class="product-img"><img src="./assets/products/1_5.jpg" alt="11"></td>
                                <td class="quantity">43</td>
                                <td>100 ML</td>
                                <td>56$</td>
                                <td>
                                    <ul class="action--list">
                                        <li><a href="#"><img src="./assets/img/sell.png" alt=""></a></li>
                                        <li><a href="updateproduct.php"><img src="./assets/img/edit.png" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="./assets/img/trash-alt.png" alt=""></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>170</td>
                                <td>GOCCI</td>
                                <td>gocci</td>
                                <td class="category">eau de cologne</td>
                                <td class="product-img"><img src="./assets/products/1_6.jpg" alt="11"></td>
                                <td class="quantity">3</td>
                                <td>100 ML</td>
                                <td>56$</td>
                                <td>
                                    <ul class="action--list">
                                        <li><a href="#"><img src="./assets/img/sell.png" alt=""></a></li>
                                        <li><a href="updateproduct.php"><img src="./assets/img/edit.png" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="./assets/img/trash-alt.png" alt=""></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>