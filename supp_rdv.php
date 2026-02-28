<?php 
include 'connection.php';
$idr=$_GET['idr'];
$annuler=mysqli_query($conn," delete from rdv  WHERE idr=$idr");
if($annuler){
    
    echo "<script>window.location.href='index.php#rdv'</script>";

}
?>