<?
if (!defined('ABSPATH')) exit;
template_header('signin')
?>

<?php
if(isset($_POST['login']))
{
 if($_POST['email']!='' && $_POST['pwd']!='')
 {
    $email=$_POST['email'];
    $pwd=$_POST['pwd'];
   $query="select * from user where email='".$email."' and pwd='".$pwd."'";
   $stmt = $pdo->prepare($query);
   $stmt->execute();   
   $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
   foreach($res as $r):
    $name=$r['name'];
    $mobile=$r['mobile'];
    $email=$r['email'];
    $cusid=$r['customerid'];
    $address=$r['address'];
endforeach;	   
   if($res) {
       $_SESSION['customerid']=$cusid;
       $_SESSION['name']=$name;
       $_SESSION['mobile']=$mobile;
       $_SESSION['email']=$email;
       $_SESSION['address']=$address;
      header('location:index.php?page=products');
   }
   else
   {
    echo'You entered username or password is incorrect';
   }
 }
 else
 {
  echo'Enter both username and password';
 }
}

?>

<form method='post'>
<div class="account_details">
<h2>Login</h2>
<div class="email">
<input type="email" name="email" id="email" size="25" placeholder="Enter Your Mail Id" />
</div>
<br>
<div class="pwd">
    <input type="password" id="pwd" size="25" name="pwd" placeholder="Enter Your Password"/>
</div>
</div>
<div class="links">
    <a href="index.php?page=account">Create a new account</a>
</div>
<div class="signb">
    <input type="submit" name="login" class="register"  id="register" value="Login"/>
</div>
</form>

<?
if (!defined('ABSPATH')) exit;
template_footer()
?>