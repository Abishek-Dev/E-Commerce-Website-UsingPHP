<?php

if(isset($_GET['id'])){
    $query="SELECT * FROM products where id ='".$_GET['id']."'";
    $query1=$pdo->prepare($query);
    $query1->execute();
    $product=$query1->fetch(PDO::FETCH_ASSOC);
    if (!$product) {

        die ('Product does not exist!');
    }

    else{

        if(isset($_POST['add2'])){

            $q3="SELECT * from products where id='".$_GET['id']."'";
            $q4=$pdo->prepare($q3);
            $q4->execute();
        
            $p1=$q4->fetchAll(PDO::FETCH_ASSOC);
        
            foreach($p1 as $p):
                $productname=$p['name'];
                $price=$p['price'];
                $bname=$p['bname'];
                $pid=$p['id'];
                $img=$p['img'];
            endforeach;	
        
        
             if(isset($_SESSION['email'])){
                 $_SESSION['product_id']=$_POST['product_id'];
                 $_SESSION['quantity']=$_POST['quantity'];
                 $q="SELECT * FROM cart WHERE productid='".$pid."' and email='".$_SESSION['email']."'";
                 $q1=$pdo->prepare($q);
                 $q1->execute();
                 $r = $q1->fetchAll(PDO::FETCH_ASSOC);
                 
                 if(!$r){
                     $cusid=$_SESSION['customerid'];
                     $name=$_SESSION['name'];
                     $email=$_SESSION['email'];
                     $phone=$_SESSION['mobile'];
                     $qty=$_POST['quantity'];
                     $q2="INSERT INTO cart (usrid,usrname,email,phone,productid,bname,productname,qty,price,img) VALUES('".$_SESSION['customerid']."','".$name."','".$email."','".$phone."','".$pid."','".$bname."','".$productname."','".$qty."','".$price."','".$img."') ";
                     $stmt = $pdo->prepare($q2);
                    $stmt->execute();
                    header('location:index.php?page=cart');
                    echo 'Inserted';
                 }
                 else{
                     echo 'This product is already added to your cart';
                 }
                 }

                 else{
                     echo "Please login/register to add the product to your cart";
                 }
        
        }
        if(isset($_POST['buy'])){
            $q3="SELECT * from products where id='".$_GET['id']."'";
            $q4=$pdo->prepare($q3);
            $q4->execute();
        
            $p1=$q4->fetchAll(PDO::FETCH_ASSOC);
        
            foreach($p1 as $p):
                $productname=$p['name'];
                $price=$p['price'];
                $bname=$p['bname'];
                $pid=$p['id'];
                $img=$p['img'];
            endforeach;	
            if(isset($_SESSION['email'])){
                $_SESSION['product_id']=$_POST['product_id'];
                $_SESSION['quantity']=$_POST['quantity'];
                $q="SELECT * FROM user WHERE email='".$_SESSION['email']."'";
                $q1=$pdo->prepare($q);
                $q1->execute();
                $r = $q1->fetchAll(PDO::FETCH_ASSOC);
                
                if($r){
                    $cusid=$_SESSION['customerid'];
                    $name=$_SESSION['name'];
                    $email=$_SESSION['email'];
                    $phone=$_SESSION['mobile'];
                    $address=$_SESSION['address'];
                    $qty=$_POST['quantity'];
                    $q2="INSERT INTO customers (usrid,usrname,email,phone,res,productid,bname,productname,qty,price,img) VALUES('".$cusid."','".$name."','".$email."','".$phone."','".$address."','".$pid."','".$bname."','".$productname."','".$qty."','".$price."','".$img."') ";
                    $stmt = $pdo->prepare($q2);
                   $stmt->execute();
                   header('location:index.php?page=placeorder');
                }
                }

                else{
                    echo "Please login/register to Buy It!!!";
                }
        }


    }

} else {

    die ('Product does not exist!');
}

?>

<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$product['img']?>" width="500" height="400" alt="<?=$product['name']?>">
    <div>
        <h1 class="name"><?=$product['name']?></h1>
        <span class="price">
            &#8377;<?=$product['price']?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&#8377;<?=$product['rrp']?></span>
            <?php endif; ?>
        </span>
        <form  method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="submit" value="Buy Now" name="buy">
            <br>
            <input type="submit" value="Add To Cart" name="add2">
        </form>
        <div class="description">
            <?=$product['des']?>
        </div>
    </div>
</div>

<?=template_footer()?>