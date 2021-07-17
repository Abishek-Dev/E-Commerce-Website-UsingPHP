<?=template_header('account')?>

<?php
if(isset($_POST['register'])){
$name=$_POST['name'];
$mobile=$_POST['phone'];
$email=$_POST['email'];
$pwd=$_POST['pwd'];
$rpwd=$_POST['rpwd'];
$stmt = $pdo->prepare('SELECT * FROM user');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);		   
foreach($res as $r):
    $phn=$r['mobile'];
    $mail=$r['email'];
endforeach;

    if (empty($name) ||
    empty($mobile) ||
    empty($email) ||
    empty($pwd)|| empty($rpwd)) {
    
    ?><h1 align="center"><?php echo'Please fill all fields!'; ?> </h1><?php
    }
    else{
        if(strlen($mobile)!=10){
            ?> <h1 align="center"><?php die('Your mobile number must contain 10 numbers');?></h1><?php
        }
        elseif(strlen($pwd)<6){
           ?><h1 align="center"><?php echo 'Your Password must contsin atleast 6 digits'; ?></h1> <?php
        }
        elseif($pwd != $rpwd){
            ?><h1 align="center"><?php echo 'Passwords didn\'t match try again' ;?></h1><?php
        }
        elseif($mobile==$phn){
            ?><h1 align="center"><?php echo 'An Account with this mobile number already exists';?></h1><?php
        }
        elseif($email==$mail){
            ?><h1 align="center"><?php echo 'An Account with this E-Mail ID already exists';?></h1><?php
        }
        else{
            $sql="Insert into user (name,mobile,email,pwd) values('".$name."','".$mobile."','".$email."','".$pwd."')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            ?><h1 align="center"><?php echo 'Successful';?></h1><?php
        }
    }

}

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
    $cusid=$r['cutomerid'];
endforeach;	   
   if($res) {
       $_SESSION['cusid']=$cusid;
       $_SESSION['name']=$name;
       $_SESSION['mobile']=$mobile;
       $_SESSION['email']=$email;
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
    <div class="container" id="container">
        <div class="form-container signUp-container">
            <form method="post">
               <h1>Create Account</h1>
               <div class="social-media-container">
                   <a href="#" class="social"><i class="fab fab-facebook-f"></i></a>
                   <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                   <a href="#" class="socail"><i class="fab fa-linkedin-in"></i></a>
               </div>
               <span>or use your email to register</span>
               <input type="text" name="name" id="name" placeholder="Enter Your Name"/>
               <input type="email" name="email" id="email" placeholder="Enter Your Mail Id" />
               <input type="tel" id="phoneField" name="phone" pattern="[0-9]{10}" placeholder="Enter Your Mobile Number"/>
               <input type="password" id="pwd" name="pwd" placeholder="Enter Your Password"/>
               <input type="password" id="rpwd" name="rpwd" placeholder="Re-Enter Your Password"/>

               <button name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container signIn-container">
            <form method="post">
                <h1>Sign In</h1>
                <div class="social-media-container">
                    <a href="#" class="social"><i class="fab fab-facebook-f"></i></a>
                     <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="socail"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" name="email" id="email" placeholder="Enter Your Mail Id" />
                <input type="password" id="pwd" name="pwd" placeholder="Enter Your Password"/>
                <!--<a href="#">Forgot your password</a>-->
                <button name="login">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>
                        To keep connected with us please login with your personal info
                    </p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friends!</h1>
                    <p>Enter your details and strat journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div> 
    </div>
    <script>
        const signUpButton=document.getElementById('signUp');
        const signInButton=document.getElementById('signIn');
        const container=document.getElementById('container');

        signUpButton.addEventListener('click', ()=> container.classList.add('right-panel-active'));

        signInButton.addEventListener('click', ()=> container.classList.remove('right-panel-active'));
    </script>
<?=template_footer()?>