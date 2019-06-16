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

require('./Class.Thumbnail.php');

require('../../Init.php');

if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $limite = 1024 * 1024;
    $carpeta = "../../images/image/seo_twitter/";
    
    $varExt = explode(".", $file['name']);
    $extension = end($varExt);
    $nombre='TwitterCard_' .date('Y-m-d'). '_' .date('H.i.s');
    
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg')
    {
      echo "Error, el archivo no es una imagen.;No se pudo cambiar la imagen.;invalid"; 
    }
    else
    {
        if( file_exists( "../../images/image/seo_twitter/".$nombre. '.' .$extension) ){
            echo "La imagen ya existe.;No se pudo cambiar la imagen.;invalid";
        }else{
            if($size <= $limite){
                 
                $temp = $ruta_provisional;
                $meta_data = exif_read_data($temp);
                
                $widthOr=$meta_data['COMPUTED']['Width'];
                $heightOr=$meta_data['COMPUTED']['Height'];
                
                $WH=getNewSize($widthOr, $heightOr, 280, 150);
                
                $thumb = new Thumbnail($temp);
                if($thumb->error) {
                    echo $thumb->error;
                } else {
                    $thumb->resize($WH['w'], $WH['h']);
                    if($tipo == 'image/jpg' || $tipo == 'image/jpeg'){
                        $thumb->save_jpg($carpeta, $nombre);
                        $extension="jpeg";
                    }
                    if($tipo == 'image/gif'){
                        $thumb->save_gif($carpeta, $nombre);
                    }
                    if($tipo == 'image/png'){
                        $thumb->save_png($carpeta, $nombre);
                    }
                    
                    if($site['twitterImg']!='Twitter.jpg'){
                        unlink("../../images/image/seo_twitter/".$site['twitterImg']);
                    }
                    
                    query("UPDATE site_settings SET result= '" . $nombre. '.' .$extension . "' WHERE var= 'twitterImg' ");
                    echo 'La imagen <b>'.$nombre. '.' .$extension.'</b> fue actualizada.;'.$nombre. '.' .$extension.';valid'; 
                }
                  
            }else{
                echo'La imagen es muy grande.;No se pudo cambiar la imagen.;invalid';
            }
        }
            
    }
}