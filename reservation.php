
<?php  
session_start();
include('connection.php'); ?>
<?php

    $dh = $_POST['dh'];
    $motif = $_POST['motif'];
    $idp = $_SESSION['idp'];
    $ajt=mysqli_query($conn,"insert into rdv(dh,motif,idp) 
    values('$dh','$motif','$idp')");    
    if($ajt){
        echo "<script>window.location.href='index.php'</script>";     
    }else{
        echo "<script>alert('echec de reservation');</script>";
        echo "<script>window.location.href='index.php'</script>"; 
    }
    

    


        
?>