<?php
include 'connection.php';
if(isset($_GET['idp'])){
    $idp=$_GET['idp'];
    $rq=mysqli_query($conn," update patient set activation='non'  WHERE idp=$idp");       
        echo "<script>window.location.href='index.php#rdv'</script>";
    
    }
    
?>