
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
    $carpeta = "../../images/favicon/";
    
    $varExt = explode(".", $file['name']);
    $extension = end($varExt);
    $nombre='Fav_' .date('Y-m-d'). '_' .date('H.i.s'). '.' .$extension;
    
    $array_nombre = explode('.',$nombre);
    $cuenta_arr_nombre = count($array_nombre);
    $extension = strtolower($array_nombre[--$cuenta_arr_nombre]);
    
    if ($extension != 'ico')
    {
      echo "Error, el archivo no es .ico.;No se pudo cambiar el Favicon.;invalid"; 
    }
    else
    {
        if( file_exists( "../../images/favicon/".$nombre) ){
            echo "El icono ya existe.;No se pudo cambiar el Favicon.;invalid";
        }else{
            if($size <= $limite){
                $src = $carpeta.$nombre;
                move_uploaded_file($ruta_provisional, $src);
                
                if($site['favicon']!='favicon.ico'){
                    unlink("../../images/favicon/".$site['favicon']);
                }
                
                query("UPDATE site_settings SET result= '" . $nombre . "' WHERE var= 'favicon' ");
                echo 'El icono <b>'.$nombre.'</b> fue actualizada.;'.$nombre.';valid';   
            }else{
                echo'El icono es muy grande.;No se pudo cambiar el Favicon.;invalid';
            }
        }
            
    }
}