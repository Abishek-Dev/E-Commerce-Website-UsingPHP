<?=template_header()?>
<?php
if(isset($_SESSION['name'])){
if(isset($_POST['add'])){
    header('location:index.php?page=add');
}
if(isset($_POST['remove'])){
    header('location:index.php?page=remove');
}
}
else{
    header('location:index.php?page=signin&msg=Sign-in');
}
?>
<form method="post">
<input type="submit" name="add" value="Add a Product">
<input type="submit" name="remove" value="Remove/Edit">
</form>
<?template_footer()?>