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
    <link rel="stylesheet" href="css/cpanel.css?v=1">
</head>
<body>
    <?php
if (!isset($_SESSION['ida'])) {
    echo "<script>window.location.href='admin.php'</script>";
}
?>
   <div class="nav">
    <ul>
        <li><a href="index.php">home</a></li>
        <li><a href="#zone_rdv">RDV</a></li>
        <li><a href="compte.php">mon compte</a></li>
        <li><a href="deconnecter.php">deconnecter</a></li>
       
    </ul>
   </div>
  <div class="statistique">
   <?php

$patient = mysqli_query($conn, "select * from patient");
$numbre_patient = mysqli_num_rows($patient);

$rdv = mysqli_query($conn, "select * from rdv");
$numbre_rdv= mysqli_num_rows($rdv);

$new_rdv = mysqli_query($conn, "select * from rdv where confirmation='en attente'");
$numbre_new_rdv= mysqli_num_rows($new_rdv);


?>
   <h1><i class="fa fa-users"></i> patients : <?php echo $numbre_patient; ?></h1>   
   <h1><i class="fa fa-calendar-check-o"></i> TOtale RDV : <?php echo $numbre_rdv; ?></h1>
   <h1><i class="fa fa-plus-circle"></i> new RDV : <?php echo $numbre_new_rdv; ?></h1>
   
  </div>
  <div class="rdv" id ="zone_rdv">
    <a href="cpanel.php?tri=0"> initial</a>
    <a href="cpanel.php?tri=1"> tri etat asc</a>
    <a href="cpanel.php?tri=2"> tri etat desc</a>

    <form action="cpanel.php" method="post">
        <input type="text" name="motif" placeholder=" rechercher ">
        <input type="submit" value="rechercher">
    </form>

    
    <table>
        <tr>
            <th>num</th>
            <th>date</th>
            <th>motif</th>
            <th>patient</th>
            <th>telephone</th>
            <th>etat</th>
            <th>action</th>
        </tr>
        <?php
        if (isset($_GET['tri'])){
            $tri = $_GET['tri'];
            if ($tri == 0) {; 
            
                $req = mysqli_query($conn, "select * from  rdv,patient where rdv.idp=patient.idp ");
            }
            if ($tri == 1) {; 
            
                $req = mysqli_query($conn, "select * from  rdv,patient where rdv.idp=patient.idp order by confirmation asc");
            }
            if($tri==2){
                $req = mysqli_query($conn, "select * from  rdv,patient where rdv.idp=patient.idp order by confirmation desc");
         }
        }   else {  
        $req = mysqli_query($conn, "select * from  rdv,patient where rdv.idp=patient.idp ");
        }
        if (isset($_POST['motif'])){
            $motif = $_POST['motif'];
            $req = mysqli_query($conn, "select * from  rdv,patient where rdv.idp=patient.idp and motif like '%$motif%'");
        }

        while($data = mysqli_fetch_assoc($req)){
         
        
        ?>
        <tr>
            <td><?php echo $data['idr']; ?></td>
            <td><?php echo $data['dh']; ?></td>
            <td><?php echo $data['motif']; ?></td>
            <td><?php echo $data['np']; ?></td>
            <td><?php echo $data['tel']; ?></td>
            <td><?php echo $data['confirmation']; ?></td>
            <td>
                <a href="confirmer.php?idr=<?php echo $data['idr']; ?>">confirmer</a>
                <a href="annuler.php?idr=<?php echo $data['idr']; ?>">annuler</a>
        </td>
        </tr>
        <?php } ?>

    </table>
</div>

</body>

</html>
