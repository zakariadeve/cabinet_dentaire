<?php
include 'connection.php';


$idr=$_GET['idr'];
$annuler=mysqli_query($conn," update rdv set confirmation='annuler' WHERE idr=$idr");
if($annuler){
    echo "<script>window.location.href='cpanel.php'</script>";
}
?>