<?php
if(isset($_SESSION['email'])||isset($_SESSION['cart'])){
    $email=$_SESSION['email'];
    $query="SELECT * FROM cart WHERE email='".$email."'";
    $q=$pdo->prepare($query);
    $q->execute();
    $p1=$q->fetchAll(PDO::FETCH_ASSOC);

    foreach($p1 as $pro):
        $productname=$pro['productname'];
        $price=$pro['price'];
        $qty=$pro['qty'];
        $pid=$pro['productid'];
    endforeach;	

    /*if(isset($_POST['update']) || isset($_SESSION['cart'] )){
        $quantity = $_POST['quantity'];
        $sql="UPDATE cart SET qty ='".$quantity."' WHERE email='".$email."' and productid='".$pid."'";
        $s=$pdo->prepare($sql);
        $s->execute();
        header('location: index.php?page=cart');
        echo 'updated'; 
    }*/
    if(isset($_POST['placeorder']) && isset($_SESSION['email'])){
        $q3="SELECT * from products where id='".$pid."'";
            $q4=$pdo->prepare($q3);
            $q4->execute();
            $p2=$q4->fetchAll(PDO::FETCH_ASSOC);
        
            foreach($p1 as $pro):
                $productname=$pro['productname'];
                $price=$pro['price'];
                $qty=$pro['qty'];
                $pid1=$pro['productid'];
                $cusid=$_SESSION['customerid'];
                    $name=$_SESSION['name'];
                    $email=$_SESSION['email'];
                    $phone=$_SESSION['mobile'];
                    $address=$_SESSION['address'];
                    $q2="INSERT INTO customers (usrid,usrname,email,phone,res,productid,bname,productname,qty,price,img) VALUES('".$cusid."','".$name."','".$email."','".$phone."','".$address."','".$pid1."','".$bname."','".$productname."','".$qty."','".$price."','".$img."') ";
                    $stmt = $pdo->prepare($q2);
                   $stmt->execute();
        header('location:index.php?page=placeorder');
            endforeach;	
    }
    if(isset($_GET['remove'])){
        unset($_SESSION['cart'][$_GET['remove']]);
        $remove = $_GET['remove'];
        $query1="DELETE FROM cart where email='".$email."' and productid='".$remove."' ";
        $q1=$pdo->prepare($query1);
        $q1->execute();
        header('location:index.php?page=cart');
        echo 'Removed';
    }
    

$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;

    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stm="SELECT * FROM cart WHERE email='".$email."'";
    $stmt = $pdo->prepare($stm);

    $stmt->execute(array_keys($products_in_cart));

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        (float)$subtotal += (float)$product['price'] * (float)$product['qty'];
}

}

?>
<?=template_header('Cart')?>
<div class="cart content-wrapper">
    <h1>Shopping  Cart</h1>
    <form  method="post">
     <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($p1)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($p1 as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['productid']?>">
                            <img src="imgs/<?=$product['img']?>" width="120" height="120" alt="<?=$product['productname']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['productid']?>"><?=$product['productname']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['productid']?>" name="remove" class="remove">Remove</a>
                    </td>
                    <td class="price">&#8377;<?=$product['price']?></td>
                    <td class="quantity">
                     <?=$product['qty']?>
                        <!--<input type="submit" class="buttons1" value="Update" name="update">-->
                    </td>
                    <td class="price">&#8377;<?=(float)$product['price'] * (float)$product['qty']?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <?php if(empty($product['email']) || empty($product['productid'])):?>
            <span class="price">&#8377;<?=0?></span>
            <?php else:?>
            <span class="price">&#8377;<?=$subtotal?></span>
            <?php endif;?>
        </div>
        <div class="buttons">
        <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
        </form>
</div>