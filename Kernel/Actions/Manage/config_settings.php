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

require('./Clases/Class.ConfigSite.php');

new ConfigSite($_POST['config_title'], $_POST['config_url'], $_POST['config_slogan'], $_POST['config_keys'], null);
ConfigSite::Title();
ConfigSite::Url();
ConfigSite::Slogan();
ConfigSite::Keys();
?>