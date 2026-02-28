 
<?php  include('connection.php'); ?>
<?php

    $np = $_POST['np'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
     

// recherche si  deja un compte avec le meme email
$rech=mysqli_query($conn,"select * from patient where email='$email'");
    if( mysqli_num_rows($rech) > 0){
        echo"<script>alert('Cet email deja existe');</script>";
        echo "<script>window.location.href='index.php'</script>"; 
    }
    else{

$ajt=mysqli_query($conn,"insert into
 patient(np,tel,email,mdp)
 values('$np','$tel','$email','$mdp')");
if($ajt){ echo"<script>window.location.href='index.php'</script>"; }
else{
   echo"<script>alert('Cet email deja existe');</script>";
   echo"<script>window.location.href='index.php'</script>"; 
}

 }       
?>