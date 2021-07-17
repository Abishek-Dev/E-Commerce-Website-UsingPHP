<?=template_header()?>
<?php

if(!(isset($_SESSION['name']))){
    header('location:index.php?page=signin&msg=Sign-in');
}
else{
if(isset($_POST['add'])){
    $img = $_FILES["img"]["name"];
    $tempname = $_FILES["img"]["tmp_name"];   
        $folder = "Uploads/".$img;
$bname=$_POST['bname'];
$name=$_POST['name'];
$des=$_POST['desc'];
$price=$_POST['price'];
$rrp=$_POST['rrp'];
$sql="INSERT INTO products (bname,name,price,des,rrp,img) values('".$bname."','".$name."','".$price."','".$des."','".$rrp."','".$img."')";
$q=$pdo->prepare($sql);
$q->execute();
if($q){
echo 'added';
if (move_uploaded_file($img, $folder))  {
    echo 'Image uploaded successfully';
}else{
    echo 'Failed to upload image';
}
}
else{
    echo 'failed';
}
}
}
?>
<form method='post' enctype="multipart/form-data">
<div>
<input type="text" name="bname" placeholder="Enter the Brand Name">
</div>
<div>
<input type="text" name="name" placeholder="Enter the Product Name">
</div>
<div>
<input type="text" name="desc" placeholder="Enter the Description of the product (If needed)">
</div>
<div>
<input type="text" name="price" placeholder="Enter the price of the product">
</div>
<div>
<input type="text" name="rrp" placeholder="Enter the Old price (If needed)">
</div>
<div>
<input type="file" name="img" placeholder="Select product image" value=""/>
</div>
<div>
<input type="submit" name="add" placeholder="Add">
</div>
</form>
<?=template_footer()?>