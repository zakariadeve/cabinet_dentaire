<?php
session_start();
include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cabinet Dentaire</title>
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/cpanel.css?v=2">
</head>
<body>
    <?php
if (!isset($_SESSION['ida'])) {
    echo "<script>window.location.href='admin.php'</script>";
}
?>
   <div class="nav">
    <ul>
        <li><a href="cpanel.php">home</a></li>
        <li><a href="cpanel.php#zone_rdv">RDV</a></li>
        <li><a href="cpanel.php#zone_patients">patients</a></li>
        <li><a href="compte.php">mon compte</a></li>
        <li><a href="deconnecter.php">deconnecter</a></li>
       
    </ul>
   </div>
   
    <form  method="post">
        <input type="text" name="user" placeholder="new user">
        <input type="password" name="new_mdp" placeholder=" new mot de passe">
        <input type="password" name="mdp" placeholder=" Anicien mot de passe">

        <input type="submit" name="btn" value="changer">
    </form>

   <?php
   if(isset($_POST['btn'])){
    $user=$_POST['user'];
    $new_mdp=$_POST['new_mdp'];
    $mdp=$_POST['mdp'];

    $req=mysqli_query($conn,"select * from administrateur  ");
    $data=mysqli_fetch_assoc($req);

    if($data['mdp']==$mdp){
        $update=mysqli_query($conn,"update administrateur 
        set user='$user',mdp='$new_mdp' ");
           echo"<script>alert('bien modifié');</script>";
            session_destroy(); 
            echo "<script>window.location.href='admin.php'</script>";
        }else{
            echo"<script>alert('mot de passe incorrect');</script>";
   
    }
  
   
   }


?>
   </body>
</html>
  