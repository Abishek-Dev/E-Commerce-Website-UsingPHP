<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'swisswatch';
    try {   
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {

    	die ('Failed to connect to database!');
    }
}

function template_header($title) {

$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
echo <<<EOT
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>$title</title>
<link href="style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<script src="jquery-1.10.2.min.js"></script>
<script src="jquery-ui.js"></script>
<script src="bootstrap.min.js"></script>
<link rel="stylesheet" href="bootstrap.min.css">
<link href="jquery-ui.css" rel = "stylesheet">		
</head>
<script>
function openSideMenu(){
document.getElementById("side-menu").style.width="250px"
}
function closeSideMenu(){
document.getElementById("side-menu").style.width="0";
}
</script>
<body>
<header>		
<div class="content-wrapper" id="title-bar">
<span id="open-menu">
<a href="#" onclick="openSideMenu()">
<svg width="30" height="30">
<path d="M0,5 30,5" stroke="#394352"
stroke-width="5"/>
<path d="M0,14 30,14" stroke="#394352" 
 stroke-width="5"/>
<path d="M0,23 30,23" stroke="#394352" 
stroke-width="5"/>
</svg>
</a>
</span>
<h1 class="brand">Swiss Watch</h1>
<nav>
<a href="index.php">Home</a>
<a href="index.php?page=products">Products</a>
<a href="index.php?page=Contact">Contact</a>
<a href="index.php?page=about">About Dev</a>
</nav>
EOT;
?>          
<div>
<form method="post" class="search-box">
<button class="search-btn" type="submit" name="searchbutton">
<i class="fa fa-search" aria-hidden="true"></i></button>
<input class="search-txt" type="text" placeholder="Search for product" autofocus name="search">
</form>
</div>
<?php
echo<<<EOT
<div class="dropdown">
<a href="index.php?page=account">
<i name="usr" class="fas fa-user-alt"></i>              
EOT;
?>
<?php
if(isset($_SESSION['name'])){
//it exists
echo $_SESSION['name'];?>
<div class="dropdown-content">
<a href="index.php?page=logout">Logout</a>
</div>
<?php
} else{
//it does not exist.
echo "Login/Register";
}
if(isset($_POST['search'])){
$search=$_POST['search'];
if($search==''){
header("location:index.php");
}
else{
header("location:index.php?page=search&search=".$search."");
}
}
echo<<<EOT
</a>
</a>
</div>
<div class="link-icons">
<a href="index.php?page=cart">
<i class="fas fa-shopping-cart"></i>
</a>
</div>
</div>
<div id="side-menu" class="side-nav">
<ul>
<li><a href="#" class="close" onclick="closeSideMenu()">&times;</a></li>
<li><a href="index.php">Home</a></li>
<li><a href="index.php?page=products">Products</a></li>
<li><a href="index.php?page=Contact">Contact</a></li>
<li><a href="index.php?page=about">About Dev</a></li>
</ul>
</div>		
</header>
<main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
</main>
<footer>
<div class="content-wrapper">
<p>&copy; $year, SWISS WATCH & Optical Co. Salem</p>
</div>
</footer>
<script src="script.js"></script>
</body>
</html>
EOT;
}
?>