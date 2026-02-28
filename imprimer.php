<?php
session_start();
include("connection.php");
if (isset($_GET['idr'])) {
    $idr = $_GET ['idr'];
    $req = mysqli_query($conn, "select * from rdv,patient 
    where rdv.idp=patient.idp and idr='$idr'");
    $data = mysqli_fetch_assoc($req);


}else{
    echo "<script>alert('de rendez-vous non valide');</script>";
    echo "<script>window.location.href='index.php#rdv';</script>";
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

<div class="recu">

    <div class="header">
        <h2>Reçu de Rendez-vous</h2>
        <p>Cabinet_Dentaire DR nom</p>
    </div>

    <div class="info">
        <p><span>date d'impression  :</span> <?php echo date("Y-m-d H:i:s"); ?></p>
        <p><span>Nom du patient :</span> <?php echo $data['np']; ?></p>
        <p><span>Date du RDV :</span> <?php echo $data['dh']; ?></p>
        <p><span>Service :</span> Consultation Générale</p>
        <p><span>Numéro de reçu :</span> <?php echo "RDV".date('Y')." #".$data['idr']; ?></p>
    </div>

    <div class="footer">
        Merci pour votre confiance.<br>
        Veuillez vous présenter 15 minutes avant l'heure du rendez-vous.
    </div>

    <div class="btn-print">
        <button onclick="window.print()"> Imprimer</button>
    </div>

</div>
<script>window.print()</script>
</body>
</html>