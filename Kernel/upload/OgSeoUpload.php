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

require('./Class.Thumbnail.php');

if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $limite = 1024 * 1024;
    $carpeta = "../../images/image/seo_og/";
    
    $varExt = explode(".", $file['name']);
    $extension = end($varExt);
    $nombre='OgImg_' .date('Y-m-d'). '_' .date('H.i.s');
    
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg')
    {
      echo "Error, el archivo no es una imagen.;No se pudo cambiar la imagen.;invalid"; 
    }
    else
    {
        if( file_exists( "../../images/image/seo_og/".$nombre. '.' .$extension) ){
            echo "La imagen ya existe.;No se pudo cambiar la imagen.;invalid";
        }else{
            if($size <= $limite){
                
                $temp = $ruta_provisional;
                $meta_data = exif_read_data($temp);
                
                $widthOr=$meta_data['COMPUTED']['Width'];
                $heightOr=$meta_data['COMPUTED']['Height'];
                
                $WH=getNewSize($widthOr, $heightOr, 1200, 630);
                
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
                    
                    if($site['ogImg']!='ImgSeo.jpg'){
                        unlink("../../images/image/seo_og/".$site['ogImg']);
                    }
                    
                    query("UPDATE site_settings SET result= '" . $nombre. '.' .$extension . "' WHERE var= 'ogImg' ");
                    echo 'La imagen <b>'.$nombre. '.' .$extension.'</b> fue actualizada.;'.$nombre. '.' .$extension.';valid';
                }
                   
            }else{
                echo'La imagen es muy grande.;No se pudo cambiar la imagen.;invalid';
            }
        }
            
    }
}