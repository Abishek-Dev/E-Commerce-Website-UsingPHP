<?=template_header('Products')?>
<?php
if(isset($_GET['search'])){
    $search=$_GET['search'];
    $search=strtoupper($search);
    $query="select * from products where bname like '%{$search}%' || name like '%{$search}%'";
    $res=$pdo->prepare($query);
    $res->execute();
    $total_row=$pdo->query($query)->rowCount();
    $products=$res->fetchAll(PDO::FETCH_ASSOC);
}
?>
<div class="products content-wrapper">
    <h1>Products</h1>
    <p><?=$total_row?> Products</p>
    <div class="products-wrapper">
        <?php foreach ($products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                &#8377;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&#8377;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>

<?=template_footer()?>