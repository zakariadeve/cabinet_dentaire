<?php
session_start();
include("connection.php");
if (isset($_GET['etat'])) {
    $etat = $_GET ['etat'];
    
        if ($etat == 1) {
            $req = mysqli_query($conn, "select * from rdv,patient 
            where rdv.idp=patient.idp");
           
        }       
        if ($etat == 2) {
            $dh = date("Y-m-d ");

            $req = mysqli_query($conn, "select * from rdv,patient 
            where rdv.idp=patient.idp and dh like'%$dh%'");
           
        }  

}
 if(isset($_POST['d1']) && isset($_POST['d2'])){
    $d1 = $_POST['d1'];
    $d2 = $_POST['d2'];
    $req = mysqli_query($conn, "select * from rdv,patient 
    where rdv.idp=patient.idp and DATE(dh) between  '$d1' and '$d2' ");
 }



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de Rendez-vous</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f4f4;
        }
        .recu{
            width:600px;
            margin:50px auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }
        .header{
            text-align:center;
            border-bottom:2px solid #2c3e50;
            padding-bottom:10px;
            margin-bottom:20px;
        }
        .header h2{
            margin:0;
            color:#2c3e50;
        }
        .info{
            margin:10px 0;
        }
        .info span{
            font-weight:bold;
        }
        .footer{
            margin-top:30px;
            text-align:center;
            font-size:14px;
            color:gray;
        }
        .btn-print{
            margin-top:20px;
            text-align:center;
        }
        button{
            padding:10px 20px;
            border:none;
            background:#2c3e50;
            color:white;
            border-radius:5px;
            cursor:pointer;
        }
        button:hover{
            background:#34495e;
        }
    </style>
</head>
<body>

<table>
        <tr>
            <th>num</th>
            <th>date</th>
            <th>motif</th>
            <th>patient</th>
            <th>telephone</th>
            <th>etat</th>
           
        </tr>
        <?php
         while($data = mysqli_fetch_assoc($req)){
         
        
        ?>
        <tr>
            <td><?php echo $data['idr']; ?></td>
            <td><?php echo $data['dh']; ?></td>
            <td><?php echo $data['motif']; ?></td>
            <td><?php echo $data['np']; ?></td>
            <td><?php echo $data['tel']; ?></td>
            <td><?php echo $data['confirmation']; ?></td>
         
        </tr>
        <?php } ?>

    </table>
    <script>
       
            window.print();
        
    </script>
    

</body>
</html>