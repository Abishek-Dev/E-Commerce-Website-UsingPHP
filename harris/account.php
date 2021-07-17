<?=template_header('account')?>

<?php
if(isset($_POST['register'])){
$name=$_POST['name'];
$mobile=$_POST['phone'];
$email=$_POST['email'];
$pwd=$_POST['pwd'];
$rpwd=$_POST['rpwd'];
$address=$_POST['address'];
$stmt = $pdo->prepare('SELECT * FROM user');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);		   
foreach($res as $r):
    $phn=$r['mobile'];
    $mail=$r['email'];
endforeach;

    if (empty($name) ||
    empty($mobile) ||
    empty($email) || empty($address)||
    empty($pwd)|| empty($rpwd)) {
    
    echo'Please fill all required fields!';
    }
    else{
        if(strlen($mobile)!=10){
            die('Your mobile number must contain 10 numbers');
        }
        elseif(strlen($pwd)<6){
            die('Your Password must contsin atleast 6 digits');
        }
        elseif($pwd != $rpwd){
            die('Passwords did not match tru again');
        }
        elseif($mobile==$phn){
            echo 'An Account with this mobile number already exists';
        }
        elseif($email==$mail){
            echo 'An Account with this E-Mail ID already exists';
        }
        else{
            $sql="Insert into user (name,mobile,address,email,pwd) values('".$name."','".$mobile."','".$address."','".$email."','".$pwd."')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            echo 'Successful';
            echo $email;
        }
    }

}

?>
<form  method='post'>
<div class="account_details">
<h2>Register</h2>
<div class="name">
<input type="text" name="name" id="name" size="25" placeholder="Enter your name"/>
</div>
</br>
<div class="mobile">
<input type="tel" id="phoneField" name="phone" size="25" pattern="[0-9]{10}" placeholder="Enter Your Mobile Number"/>
</div>
<br>
<div class="email">
<input type="email" name="email" id="email" size="25" placeholder="Enter Your Mail Id" />
</div>
<br>
<div>
<textarea name="address" size="25" placeholder="Enter your address here..."></textarea>
</div>
<br>
<div class="pwd">
    <input type="password" id="pwd" size="25" name="pwd" placeholder="Enter Your Password"/>
</div>
<br>
<div class="rpwd">
    <input type="password" id="rpwd" size="25" name="rpwd" placeholder="Re-Enter Your Password"/>
</div>
<div class="links">
    <a href="index.php?page=signin">Already have an account?Sign-In</a>
</div>
<div class="signb">
    <input type="submit" name="register" class="register"  id="register" value="Register"/>
</div>
</form>
<?=template_footer()?>