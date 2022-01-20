<?php
session_start();

include("connection.php");
include("functions.php");


$user_data = check_login($con);

?>
<?php
if (isset($_POST["add"])) 
{
$id=$_POST['id'];
$brandID=$_POST['brandID'];
$categoryID=$_POST['categoryID'];
$name=$_POST['name'];
$gender=$_POST['gender']; 
$volume=$_POST['volume']; 
$price=$_POST['price']; 
$image=$_POST['image']; 
$descripton=$_POST['description']; 
session_start();
// $product=$_SESSION['product'];
 $cx=mysqli_connect("localhost","root","","parfum.art");
$qy="insert into product values('$id','$brandID','$categoryID','$name','$gender','$volume','$price','$image',
'$description')";
		 mysqli_query($cx,$qy);
		 mysqli_close($cx);    
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
                <h1><span class="p">P</span><span class="middle">arfume</span><span class="art">.art</span></h1>
            </div>
            <nav class="nav">
                <ul>
                    <li class="nav-link"><a href="dashbord.php"><img src="./assets/img/dashboard.svg" aria-hidden="true"><span>Dashboard</span></a></li>
                    <li class="nav-link"><a href="products.php"><img src="./assets/img/product.svg" aria-hidden="true"><span>Products</span></a></li>
                    <li class="nav-link current"><a href="#"><img src="./assets/img/add-product.svg" aria-hidden="true"><span>Add Product</span></a></li>
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
                    <h2 class="title">Add Product</h2>
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
            <section class="section section--form">
                <h2 class="title--mobile">Add Product</h2>
                <div class="form--wrapper">
                    <form>
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label for="parfume-name">Name</label>
                                <input required type="text" name="name" id="parfume-name" placeholder="Enter parfume name...">
                            </div>
                            <div class="input-group">
                                <label for="brand">Brand</label>
                                <select required name="brand" id="brand">
                                    <option value="">Select</option>
                                    <option value="gocci">Gocci</option>
                                    <option value="handm">H&M</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label for="category">Category</label>
                                <select required name="category" id="category">
                                    <option value="">Select</option>
                                    <option value="gocci">Parfum</option>
                                    <option value="handm">Eau de parfum</option>
                                </select>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label for="volume">Volume</label>
                                <input required value="1" min="1" type="number" name="volume" id="volume">
                            </div>
                            <div class="input-group">
                                <label for="price">Price</label>
                                <input required value="1" min="1" type="number" name="price" id="price">
                            </div>
                            <div class="input-group">
                                <label for="quantity">Quantity</label>
                                <input required value="1" min="1" type="number" name="quantity" id="quantity">
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label>Gender</label>
                                <div class="gender">
                                    <div class="radio-group">
                                        <label for="male">Male</label>
                                        <input required type="radio" name="gender" id="male">
                                    </div>
                                    <div class="radio-group">
                                        <label for="female">Female</label>
                                        <input required type="radio" name="gender" id="female">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label for="desc">Description</label>
                                <input class="desc" type="text" name="desc" placeholder="Enter description...">
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="input-group">
                                <label for="image">Image</label>
                                <input required type="file" name="image" id="image">
                            </div>
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