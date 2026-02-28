<?php
include 'connection.php';


$idr=$_GET['idr'];
$conf=mysqli_query($conn," update rdv set confirmation='confirmee' WHERE idr=$idr");
if($conf){
    echo "<script>window.location.href='cpanel.php'</script>";
}
?>