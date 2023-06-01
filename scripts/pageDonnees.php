<?php
require 'functions.php';
session_start();
$donnees=false;
if(isset($_SESSION['GpsData'])){
    $temp =$_SESSION['GpsData']; 
    $donnees=true;
}
?>

<!doctype html>
<html lang="fr">
    <head>
        <title>Donnees de l'image</title>
        <meta charset="ut-8">
        <link rel="stylesheet" href="styleS.css">
    </head>
    <body>
        <div class='principal'>
            <p> 
                <img src="<?= $_SESSION['resizedImage']?>" id='miniature'>
            </p>  
          
                       <?php if($donnees):?>
                             <table class='tableau'>
                                <caption id="entete">Géolocalisation</caption>
                            <?php foreach($temp as $key => $gps):?>
                                <?php if($key!='GPSTimeStamp'):?>
                                     <tr><td><?php  echo $key;?></td><td><?php echo $gps;?></td></tr>
                                <?php endif;?>

                                
                              <!-- affichage tu tableau dans le tableau de timeStamp -->
                                <?php if($key==='GPSTimeStamp'):?>
                                    <?php $entete=false; 
                                        if(!$entete):?>
                                            <tr><td>GPSTimeStamp:</td></tr>
                                            <?php $entete=true;?>
                                        <?php endif;?>
                                    <?php foreach($gps as $k=>$g):?>
                                        <tr><td> </td><td><?php echo $g;?></td></tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endif;?>
                </table>
                <?php if(!$donnees):?>
                    <p id="erreur"><strong><em>Les données de géolocalistion ne sont pas présentes !</em></strong></p>
                <?php endif;?>
                <?php echo '<a href="/Projet2/index.php"><input type="submit" id="bouton" value="retour"></a>';session_destroy();?>
        </div>
    </body>   
</html>