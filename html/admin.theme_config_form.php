<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

$theme = mosGetParam( $_REQUEST, 'theme', 'default' );
$themepath = $mosConfig_absolute_path.'/components/com_virtuemart/themes/'.basename( $theme );

if( !file_exists( $themepath )) {
	echo '<script type="text/javascript">alert(\'The theme "'.basename( shopMakeHtmlSafe($theme) ).'" does not exist.\');history.back();</script>';
	exit;
}

if( !file_exists( $themepath . '/theme.config.php' )) {
	if( !fopen($themepath . '/theme.config.php', 'w')) {
		echo vmCommonHTML::getErrorField( 'The configuration file for this template does not exist and can\'t be created. Configuration is not possible' );
		return;
	}
}

$current_config = file_get_contents( $themepath . '/theme.config.php' );
$parameter_xml_file = $themepath.'/theme.xml';

// get params definitions
$params = new mosParameters( $current_config, $parameter_xml_file, 'theme' );
mosCommonHTML::loadOverlib();
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			Theme Settings
			</th>
		</tr>
		</table>

		<?php ps_html::writableIndicator( $themepath . '/theme.config.php', 'text-align:left;width:78%;' ); ?>

		<table style="width:80%;" class="adminform">
		<tr>
			<th>
			Parameters
			</th>
		</tr>
		<tr>
			<td>
			<?php
			echo $params->render();
			?>
			</td>
		</tr>
		</table>
	
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="func" value="writeThemeConfig" />
		<input type="hidden" name="page" value="store.index" />
		<input type="hidden" name="task" value="" />
</form>