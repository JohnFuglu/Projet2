<?php 
   require __DIR__.'/scripts/functions.php';
   session_start();
   define('UPLOAD',__DIR__.'/upload');
   if(isset($_FILES['image'])){
       $fichier= basename($_FILES['image']['name']);
      //Vérification sur le type de fichier
      $type=exif_imagetype($fichier);
      if($type !== 2){//2=IMAGETYPE_JPEG
        die("Ce n'est pas une image jpeg!");
      }
          
      $f= nameCheck($fichier);
      
      //verification sur la taille du fichier
      $tailleMax=5000000;
      $size=filesize($fichier);
      if($size>$tailleMax){
          die("Taille max: 5mo");
      }
      
      $destination=UPLOAD.'/'.$fichier;
      if(move_uploaded_file($_FILES['image']['tmp_name'], $destination)){
           echo 'upload avec succès';
      }
      else 
      echo 'erreur';
   }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8";>        
        <title>Upload</title>
    </head>
    <body>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <label for="picker">Séléctionnez une image</label>
            <input type="file" name="image" id="picker"> 
            <input type="submit" name="submit" value="upload"> 
        </form>
    </body>
</html>