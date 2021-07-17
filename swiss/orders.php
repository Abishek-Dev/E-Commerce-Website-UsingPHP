<?php
if(!(isset($_SESSION['name']))){
    header('location:index.php?page=signin&msg=Sign-in');
}
else{
$sql="SELECT * FROM customers";
$query=$pdo->prepare($sql);
$query->execute();
$p1=$query->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['remove'])){
    unset($_SESSION['orders'][$_GET['remove']]);
    $remove = $_GET['remove'];
    $query1="DELETE FROM customers where sno='".$remove."' ";
    $q1=$pdo->prepare($query1);
    $q1->execute();
    header('location:index.php?page=orders');
    echo 'Removed';
}
if(isset($_GET['delivered'])){
    unset($_SESSION['orders'][$_GET['delivered']]);
    $deliver = $_GET['delivered'];
    $query1="DELETE FROM products where id='".$deliver."' ";
    $q1=$pdo->prepare($query1);
    $q1->execute();
    header('location:index.php?page=orders');
    echo 'Removed';
}
}
?>
<?=template_header()?>
<div class="cart content-wrapper">
<form  method="post">
     <table>
            <thead>
                <tr>
                    <td>Customer-ID</td>
                    <td>Name</td>
                    <td>Mobile</td>
                    <td>Address</td>
                    <td>E-Mail</td>
                    <td>Product ID</td>
                    <td>Brand</td>
                    <td>Product-Name</td>
                    <td>Quantity</td>
                    <td>Price</td>
                </tr>
            </thead>
            <tbody>
            <?php if(empty($p1)):?>
            <tr>
            <td colspan="25" style="text-align:center;"><b>No Orders yet :(</b></td>
            </tr>
            <?php else: ?>
            <?php foreach($p1 as $usr): ?>
            <tr>
            <td>
            <?=$usr['usrid']?><br>
            <a href="index.php?page=orders&remove=<?=$usr['sno']?>" name="remove" class="remove">Remove</a>
            </td>
            <td>
            <?=$usr['usrname']?><br>
            <a href="index.php?page=orders&delivered=<?=$usr['usrid']?>" name="deliver" class="deliver">Delivered</a>
            </td>
            <td>
            <?=$usr['phone']?>
            </td>
            <td>
            <?=$usr['res']?>
            </td>
            <td>
            <?=$usr['email']?>
            </td>
            <td>
            <?=$usr['productid']?>
            </td>
            <td>
            <?=$usr['bname']?>
            </td>
            <td>
            <?=$usr['productname']?>
            </td>
            <td>
            <?=$usr['qty']?>
            </td>
            <td>
            <?=(float)$usr['price'] * (float)$usr['qty']?>
            </td>
            </tr>
            <?php endforeach;?>
                <?php endif; ?>
            </tbody>
</table>
</form>
</div>
<?=template_footer()?>