<?php
session_start();
include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAJ Compte</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>


  
   <?php
   if(!isset($_SESSION['idp'])){
    echo "<script>window.location.href='index.php'</script>";
   }

 
   ?>
    <div class="maj">
     <h1>MAJ Compte</h1>
     <form method="post">
        <label>Nom et Prénom:</label>
          <input type="text" name="np" value = <?php echo $_SESSION['np'] ?> >
          <label>Email:</label>
          <input type="email" name="email" value = <?php echo$_SESSION['email'] ?> >
          <label>Téléphone:</label>
          <input type="text" name="tel" value = <?php echo $_SESSION['tel'] ?> >
          <label > Nouveau Mot de passe:</label>    
          <input type="password" name="n_mdp" >
            <label >Ancien Mot de passe:</label>    
          <input type="password" name="mdp" required> 
          
          <input type="submit" name="btn" value="modifier">
     </form>
    </div>
    <?php
    if(isset($_POST['btn'])){
        $np = $_POST['np'];
        
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $mdp = $_POST['mdp'];
        $n_mdp = $_POST['n_mdp'];



        $idp=$_SESSION['idp'];
            $req=mysqli_query($conn,"select * from patient
             where idp=$idp");
             $data=mysqli_fetch_assoc($req);  
            if($mdp==$data['mdp']){

                   $maj=mysqli_query($conn,"update patient 
                   set np='$np',email='$email',tel='$tel',mdp='$n_mdp' where idp=$idp");
                  
                    echo "<script>alert('Compte modifié avec succès');</script>";
                    session_destroy();
                    echo "<script>window.location.href='index.php'</script>";
                }else{
                    echo "<script>alert('Mot de passe incorrect');</script>";

                }
    }

    ?>
</body>
</html>