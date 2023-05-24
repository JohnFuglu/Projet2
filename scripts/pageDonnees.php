<?php
session_start();
?>
<!doctype html>
<html lang="fr">
    <head>
        <title>Donnees de l'image</title>
        <meta charset="ut-8">
    </head>
    <body>
        <div class='principal'>
            <p> 
                <img src="<?= realpath($_SESSION['resizedImage'])?>" id='miniature'>
            </p>  
            <div class='tabDiv'>
                <table class='tableau'>
                    <thead>Géolocalisation</thead>
                        <tr></tr>
                        <tr></tr>
                </table>
            </div>
        </div>
    </body>   
</html>