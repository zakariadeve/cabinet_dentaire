            <div class="tm-section tm-bg-img" id="tm-section-1">
                <div class="tm-bg-white ie-container-width-fix-2">
                    <div class="container ie-h-align-center-fix">
                        <div class="row">
                            <div class="col-xs-12 ml-auto mr-auto ie-container-width-fix">
<?php if (!isset($_SESSION['idp'])) { ?>
                                <form action="signup.php" method="post" class="tm-search-form tm-section-pad-2" id= "signup">
                                    <div class="form-row tm-search-form-row">
                                        
                                       
                                         
                                        <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-user fa-2x tm-form-element-icon"></i>
                                            <input name="np" type="text" class="form-control" id="inputCity" placeholder="nom et prenom">
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-phone fa-2x tm-form-element-icon"></i>
                                            <input name="tel" type="text" class="form-control" id="inputCity" placeholder="telephone">
                                        </div>
                                         <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-envelope fa-2x tm-form-element-icon"></i>
                                            <input name="email" type="text" class="form-control" id="inputCity" placeholder="email">
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-lock fa-2x tm-form-element-icon"></i>
                                            <input name="mdp" type="password" class="form-control" id="inputCity" placeholder="mot de passe">
                                        </div>
                                        

                                        <div class="form-group tm-form-element tm-form-element-2">
                                            <h1  class="btn btn-success tm-btn-search" id ="login_btn">Se connecter</h1>
                                        </div>
                                         <div class="form-group tm-form-element tm-form-element-2">
                                            <button type="submit" class="btn btn-primary tm-btn-search">cree compte</button>
                                        </div>
                                    </div>
                                                                        
                                </form>

                                 <form action="login.php" method="post" class="tm-search-form tm-section-pad-2" id= "login">
                                    <div class="form-row tm-search-form-row">
                                        
                                       
                                         
                                       
                                         <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-envelope fa-2x tm-form-element-icon"></i>
                                            <input name="email" type="text" class="form-control" id="inputCity" placeholder="email">
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-lock fa-2x tm-form-element-icon"></i>
                                            <input name="mdp" type="password" class="form-control" id="inputCity" placeholder="mot de passe">
                                        </div>
                                        

                                        <div class="form-group tm-form-element tm-form-element-2">
                                            <H1  class="btn btn-warning tm-btn-search" id="signup_btn">cree compte</H1>
                                        </div>
                                         <div class="form-group tm-form-element tm-form-element-2">
                                            <button type="submit" class="btn btn-primary tm-btn-search">se conneter</button>
                                        </div>
                                    </div>
                                                                        
                                </form>


    <?php
}
else { ?>   
                                <form action="reservation.php" method="post" class="tm-search-form tm-section-pad-2" >
                                    <div class="form-row tm-search-form-row">
                                        
                                        <div class="form-group tm-form-element tm-form-element-50">
                                            <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                            <input name="dh" type="datetime-local" class="form-control" id="inputDate" placeholder="Date RDV">
                                        </div>
                                         
                                        <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-book fa-2x tm-form-element-icon"></i>
                                            <input name="motif" type="text" class="form-control" id="inputMotif" placeholder="Motif...">
                                        </div>  
                                        <div class="form-group tm-form-element tm-form-element-2">
                                            <button type="submit" class="btn btn-primary tm-btn-search">Reserver un RDV</button>
                                        </div>
                                    </div>
                                                                        
                                </form>
    <?php
}?>
                            </div>                        
                        </div>      
                    </div>
                </div>                  
            </div>
            
             
            
           
            
            <div class="tm-section tm-section-pad tm-bg-gray" id="tm-section-4">
                <div class="container">
                    <div class="row">
                       
                        
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-recommended-container">
                            <div class="tm-bg-white">
                                <div class="tm-bg-primary tm-sidebar-pad">
                                    <h3 class="tm-color-white tm-sidebar-title">Mes RDV</h3>
                                 </div>
                                 <?php if (isset($_SESSION['idp'])) { ?>
                                 <div class="tri">
                                    <a href="index.php#rdv">Initial</a>
                                    <a href="index.php?tri=1#rdv">DAta Ascendante</a>
                                    <a href="index.php?tri=2#rdv">DAta Descendante</a>

                                    </div>
                                 <table class="table table-striped tm-table-rdv" id="rdv">    
                                    <thead>
                                        <tr>
                                            <th>motif</th>
                                            <th>date RDV</th>
                                            <th>Etat</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
    $idp = $_SESSION['idp'];
    if(isset($_GET['tri'])){

    $tri = $_GET['tri'];
    if($tri==1  ){
        $sel = mysqli_query($conn, "select * from rdv WHERE idp = $idp order by dh asc");
    }
    if($tri==2){
        $sel = mysqli_query($conn, "select * from rdv WHERE idp = $idp order by dh desc");
    }
    }
    else{
        $sel = mysqli_query($conn, "select * from rdv WHERE idp = $idp");
    }
    while ($data = mysqli_fetch_assoc($sel)) {


?>
                                    <tr>
                                       <td><?php echo $data['motif']; ?></td>

                                        <td><?php echo $data['dh']; ?></td>
                                        <td><?php echo $data['confirmation']; ?></td>
                                       

                                        <td> <?php if($data['confirmation']=="confirmee"){ ?>
                                        <a href="imprimer.php?idr=<?php echo $data['idr']; ?>" class="btn btn-sm btn-danger" style="color: white; padding: 5px 10px;">imprimer</a>
                                        <?php }else{?>
                                            <a href="supp_rdv.php?idr=<?php echo $data['idr']; ?>" class="btn btn-sm btn-danger" style="color: white; padding: 5px 10px;">annuler</a></td>
                                        <?php } ?>
                                    </tr>
                                    <?php
    }?>  
                                    </tbody>
                            
                                     
                                    
                                 </table>
                                 <?php
}
else { ?>
                                <a href="index.php">connecter vous pour afficher les RDV</a> 
                                 <?php
}?>
                                
                                

                        </div>
                    </div>
                </div>
            </div>

                <script src="jq.js"></script>
            <script > 

                $("#signup").hide();

                $("#signup_btn").click(function(){
                    $("#signup").show(2000);
                    $("#login").hide(2000);
                });

              

                 $("#login_btn").click(function(){
                    $("#signup").hide(2000);
                    $("#login").show(2000);
                });
                   
                   
              
            </script>