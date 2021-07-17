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

        if(isset($_POST['edit'])){
            $sql="UPDATE products SET price='".$_POST['price']."' WHERE id='".$_GET['id']."'";
            $q=$pdo->prepare($sql);
            $q->execute();
            header('location:index.php?page=edit&id='.urlencode($_GET['id']).'&msg=success');
        }
        if(isset($_GET['msg'])){
         ?><h1 align="center">   <?php echo 'Updated Successfully';?></h1> <?php
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
            <input type="number" name="price" value="<?=$product['price']?>" placeholder="Edit the Price">
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <br>
            <input type="submit" value="Update Price" name="edit">
        </form>
        <div class="description">
            <?=$product['des']?>
        </div>
    </div>
</div>

<?=template_footer()?>