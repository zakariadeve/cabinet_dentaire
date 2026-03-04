<?php  session_start(); ?>
<?php  include('connection.php'); ?>
<?php

   
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
      

// recherche si  deja un compte avec le meme email
$rech=mysqli_query($conn,"select * from patient
 where email='$email' and mdp='$mdp'  and activation='oui' ");
    if( mysqli_num_rows($rech)==1){
        $data=mysqli_fetch_assoc($rech);
          $_SESSION['idp']=$data['idp'];
          $_SESSION['np']=$data['np'];
          $_SESSION['tel']=$data['tel'];
          $_SESSION['email']=$data['email'];
        echo "<script>window.location.href='index.php'</script>";  
    }
    else{echo"<script>alert('Email ou mot de passe incorrect');</script>";
        echo "<script>window.location.href='index.php'</script>";
    }

        
?>