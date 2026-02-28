<?php
session_start();
include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
   <div class="login">
    <form  method="post">
        <input type="text" name="user" placeholder="user">
        <input type="password" name="mdp" placeholder="mot de passe">
        <input type="submit" name="btn" value="se connecter">
    </form>
   </div>
   <?php
   if(isset($_POST['btn'])){
    $user=$_POST['user'];
    $mdp=$_POST['mdp'];
    $req=mysqli_query($conn,"select * from administrateur where user='$user' and mdp='$mdp'");
       if( mysqli_num_rows($req)==1){
        $data=mysqli_fetch_assoc($req);
        $_SESSION['ida']=$data['ida'];    
        echo "<script>window.location.href='cpanel.php'</script>";  
    }
   
   }
   ?>
</body>
</html>