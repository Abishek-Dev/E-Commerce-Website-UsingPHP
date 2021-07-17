<?php
if(!(isset($_SESSION['name']))){
    header('location:index.php?page=signin&msg=Sign-in');
}
else{
$sql="SELECT * FROM user";
$query=$pdo->prepare($sql);
$query->execute();
$p1=$query->fetchAll(PDO::FETCH_ASSOC);
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
                    <td>Password</td>
                </tr>
            </thead>
            <tbody>
            <?php if(empty($p1)):?>
            <tr>
            <td colspan="5" style="text-align:center;">No User have registered yet</td>
            </tr>
            <?php else: ?>
            <?php foreach($p1 as $usr): ?>
            <tr>
            <td>
            <?=$usr['customerid']?>
            </td>
            <td>
            <?=$usr['name']?>
            </td>
            <td>
            <?=$usr['mobile']?>
            </td>
            <td>
            <?=$usr['address']?>
            </td>
            <td>
            <?=$usr['email']?>
            </td>
            <td>
            <?=$usr['pwd']?>
            </td>
            </tr>
            <?php endforeach;?>
                <?php endif; ?>
            </tbody>
    </table>
</form>
</div>
<?=template_footer()?>