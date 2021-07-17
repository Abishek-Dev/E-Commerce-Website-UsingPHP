<?php
if(!(isset($_SESSION['name']))){
    header('location:index.php?page=signin&msg=Sign-in');
}
else{
$sql="SELECT * FROM products";
$query=$pdo->prepare($sql);
$query->execute();
$p1=$query->fetchAll(PDO::FETCH_ASSOC);
foreach($p1 as $pro):
    $productname=$pro['name'];
    $price=$pro['price'];
    $pid=$pro['id'];
endforeach;
if(isset($_POST['update'])){
    $price=$_POST['price'];
    unset($_SESSION['remove'][$_GET['price']]);
    $s="UPDATE products SET price='".$price."' where id='".$pid."'";
    $q=$pdo->prepare($s);
    $q->execute();
    header('location:index.php?page=remove');
}
if(isset($_GET['remove'])){
    unset($_SESSION['remove'][$_GET['remove']]);
    $remove = $_GET['remove'];
    $query1="DELETE FROM products where id='".$remove."' ";
    $q1=$pdo->prepare($query1);
    $q1->execute();
    header('location:index.php?page=remove');
    echo 'Removed';
}
}
?>
<?=template_header()?>
<div class="product content-wrapper">
<form  method="post">
     <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
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
                    <a href="index.php?page=edit&id=<?=$product['id']?>">
                            <img src="imgs/<?=$product['img']?>" width="40" height="200" alt="<?=$product['name']?>">
                        </a>
                    </td>
                    <td>
                    <a href="index.php?page=edit&id=<?=$product['id']?>"><?=$product['name']?></a>
                        <br>
                        <a href="index.php?page=remove&remove=<?=$product['id']?>" name="remove" class="remove">Remove</a>
                    </td>
                    <td class="price">&#8377;<a href="index.php?page=edit&id=<?=$product['id']?>"><?=$product['price']?></a></td>
                   
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        </form>
</div>
<?=template_footer()?>