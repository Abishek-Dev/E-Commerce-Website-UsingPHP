<?php
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header()?>

<div class="featured" >
<img src="imgs/logo1.jpeg" alt="Brand image">
</div>
<div class="recentlyadded content-wrapper">
      <h2>Recently Added Products</h2>

    <div class="products">
            <?php foreach ($recently_added_products as $product): ?>
            <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
                <img src="imgs/<?=$product['img']?>" height="200px"  alt="<?=$product['name']?>">
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
</div>

<!--<script>
$(window).scroll(function(){
var scroll=$(window).scrollTop();
$(".featured").css({
width:(100+scroll/10)+ "%"
})
})
</script>-->

<?=template_footer()?>