<?php
if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM products 
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		WHERE  price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["brand"]))
	{
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= "
		WHERE bname IN('".$brand_filter."')
		";
	}
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    ?>
    <p><?php echo $total_row;
    ?> Products</p>
    <?php
	$output = '';?>
    <div class="products content-wrapper">
  
    <div class="products-wrapper">
    <?php
	if($total_row > 0)
	{
		foreach($result as $row):
            $output .= '
            
			<a href="index.php?page=product&id='.$row['id'].'" class="product">
            <img src="imgs/'.$row['img'].'" width="200" height="200" alt="'.$row['name'].'">
            <span class="name">'.$row['name'].'</span>
            <span class="price">
                &#8377;'.$row['price'].'
                
            </span>
        </a>
        
			';
                endforeach;
	}
	echo $output;

}
?>