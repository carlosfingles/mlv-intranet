<?php
/**
 * MLV intranet v2.0 - Web oficial del intranet del MLV
 * 
 * @link https://github.com/carlosfingles/mlv-intranet
 * @license GNU GPL V3
 * @author Carlos Zambrano (carlosfingles)
 *         Facebook : http://facebook.com/carlosfingles
 *         Twitter : @carlosfingles
 *         Instagram : @carlosfingles
 */

require('../../Init.php');

if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $limite = 1024 * 1024;
    $carpeta = "../../images/image/";
    
    $varExt = explode(".", $file['name']);
    $extension = end($varExt);
    $nombre='Logo_' .date('Y-m-d'). '_' .date('H.i.s'). '.' .$extension;
    
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif' && $tipo != 'image/svg+xml')
    {
      echo "Error, el archivo no es una imagen.;No se pudo cambiar la imagen.;invalid"; 
    }
    else
    {
        if( file_exists( "../../images/image/".$nombre) ){
            echo "La imagen ya existe.;No se pudo cambiar la imagen.;invalid";
        }else{
            if($size <= $limite){
                $src = $carpeta.$nombre;
                move_uploaded_file($ruta_provisional, $src);

                if($site['logo']!='logo.png'){
                    unlink("../../images/image/".$site['logo']);
                }
                
                query("UPDATE site_settings SET result= '" . $nombre . "' WHERE var= 'logo' ");
                echo 'La imagen <b>'.$nombre.'</b> fue actualizada.;'.$nombre.';valid';   
            }else{
                echo'La imagen es muy grande.;No se pudo cambiar la imagen.;invalid';
            }
        }
            
    }
}