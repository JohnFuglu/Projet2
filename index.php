<?php 
   require __DIR__.'/scripts/functions.php';
   session_start();
   define('UPLOAD',__DIR__.'/upload');
   $succes=false;
   
   if(isset($_FILES['image'])){
      $fichier= basename($_FILES['image']['name']);
      //Vérification sur le type de fichier
      $type=exif_imagetype($fichier);
      if($type !== 2){//2=IMAGETYPE_JPEG
        die("Ce n'est pas une image jpeg!");
      }
      if($type==2){
            $tab= getData($fichier);
            if(!empty($tab))
                toDecimal($tab);
       }
          
      $f= nameCheck($fichier);
      $_SESSION['nomFichier']=$f;      
      pathinfo($f);
      //verification sur la taille du fichier
      $tailleMax=5000000;
      $size=filesize($fichier);
      if($size>$tailleMax){
           session_destroy();
           die("Taille max: 5mo");
        }
      
      $destination=UPLOAD.'/'.$fichier;
      if(move_uploaded_file($_FILES['image']['tmp_name'], $destination)){
           echo 'upload avec succès';
           $succes=true;
      }
      else {
            session_destroy();
          die("Erreur dans l'upload.");
        }
      if($succes){
          creeMiniature(UPLOAD.'/'.$fichier);  
          header('Location:scripts/pageDonnees.php');
      }
   }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8";>        
        <title>Upload</title>
        <link rel="stylesheet" href="scripts/styleS.css">
    </head>
    <body>
        
        <fieldset class='cadre'>
            <h1>Uploadez une image pour voir ses coordonnées GPS:</h1>  
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <label for="picker">Séléctionnez une image</label>
            <input type="file" name="image" id="picker"> 
            <input type="submit" name="submit" value="upload" id="upload"> 
        </form>
            </fieldset>
    </body>
</html>