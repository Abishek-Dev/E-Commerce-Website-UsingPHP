<?=template_header()?>

<?php
if(isset($_GET['msg'])){
    ?><h1 align="center">   <?php echo 'Please Sigin to Make Changes to the Page';?></h1> <?php
}
if(isset($_GET['msg1'])){
    ?><h1 align="center">   <?php echo 'Please Sigin as Admin/Root to add an admin';?></h1> <?php
}
if(isset($_POST['login']))
{
 if($_POST['email']!='' && $_POST['pwd']!='')
 {
    $email=$_POST['email'];
    $pwd=$_POST['pwd'];
   $query="select * from admin where email='".$email."' and pwd='".$pwd."'";
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
    <i class="far fa-eye" id="togglePassword"></i>
</div>
</div>
<div class="links">
    <?php if(isset($_SESSION['name'])){?>
    <a href="index.php?page=account">Create a new account</a>
    <?php 
    }
    else{?>
    <a href="index.php?page=signin&msg1=admin">Create a new account</a>
    <?php }?>
</div>
<div class="signb">
    <input type="submit" name="login" class="register"  id="register" value="Login"/>
</div>
</form>

<?=template_footer()?>
<script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#pwd');
togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>