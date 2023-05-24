<?php
/*Vérifie le nom du fichier et le débarasse des char spec
 */
function nameCheck($s):string{
    $s=str_split($s);
    $lettres = ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï',
        'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç',
        'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'];
    $remplacement = ['A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I'
        , 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 
        'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y'];
    
    $s=preg_replace('/([^.a-z0-9]+)/i','_', $s);
    $s= str_replace($lettres, $remplacement, $s);
    $toReturn=implode('', $s);
    
    
    
    
    return $toReturn;
}

/*Cree une miniature à partir de l'image d'origine
TODO faire des cas de figure différents suivant la taille d'origine */
function creeMiniature($path){
    list($width,$height)= getimagesize(realpath($path));
    $vals=[($width*5)/100,($height*5)/100];

    $original=  imagecreatefromjpeg($path);
    $destImage = imagecreatetruecolor($vals[0], $vals[1]);
    imagecopyresampled($destImage, $original,0,0,0,0,$vals[0], $vals[1],$width,$height);
    $newfile= UPLOAD.'/'.'mini_'.$_SESSION['nomFichier'];
    imagejpeg($destImage,$newfile);
    $_SESSION['resizedImage']= $newfile;
    imagedestroy($destImage);
    imagedestroy($original);
}





?>