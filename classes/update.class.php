<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id: template.class.php 1095 2007-12-19 20:19:16Z soeren_nb $
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*
*/
require_once( CLASSPATH . 'connectionTools.class.php');

/**
 * Updater Class, handles Update Checks, Patch Package Downloads+Extraction and Update Installation 
 * @author soeren
 * @since 1.1.0
 */
class vmUpdate {
	/**
	 * Checks the VirtueMart Server for the latest available Version of VirtueMart
	 *
	 * @return string Example: 1.1.2
	 */
	function checkLatestVersion() {		
		$VMVERSION =& new vmVersion();
		$url = "http://virtuemart.net/index2.php?option=com_versions&catid=1&myVersion={$VMVERSION->RELEASE}&task=latestversionastext";
		$result = vmConnector::handleCommunication($url);
		return $result; 
	}
	/**
	 * Function to retrieve the latest version number from virtuemart.net
	 *
	 * @param array $d
	 * @return boolean
	 */
	function getPatchPackage( &$d) {
		global $vmLogger, $mosConfig_cachepath, $VM_LANG;
		
		require_once( ADMINPATH.'version.php');
		$VMVERSION =& new vmVersion();
		
		$url = "http://virtuemart.net/index2.php?option=com_versions&catid=1&myVersion={$VMVERSION->RELEASE}&task=listpatchpackages";
		$result = vmConnector::handleCommunication($url);
		if( !empty( $result )
		 	&& (strncmp('http://dev.virtuemart.net', $result, 25)===0 || strncmp('http://virtuemart.net', $result, 21)===0)
		 ) {
			$filename = basename( $result );
			$doc_id_pos = strpos($filename,'?');
			if( $doc_id_pos > 0 ) {
				$filename = substr($filename, 0, $doc_id_pos);
			}
			if( file_exists( $mosConfig_cachepath.'/'.$filename)) {
				$vmLogger->info( $VM_LANG->_('VM_UPDATE_PACKAGE_EXISTS').' '.$mosConfig_cachepath.'/'.$filename);

			} else {
				$patch_package = vmConnector::handleCommunication($result);
				if( !file_put_contents($mosConfig_cachepath.'/'.$filename, $patch_package )) {
					$vmLogger->err( $VM_LANG->_('VM_UPDATE_ERR_STORE_FAILED') );
					return false;
				}
			}
			$_SESSION['vm_updatepackage'] = $mosConfig_cachepath.'/'.$filename;
		} else {
			$vmLogger->err( $VM_LANG->_('VM_UPDATE_ERR_RETRIEVE_FAILED') );
			return false;
		}
		return true;
	}
	function &getPatchContents( $updatepackage ) {
		global $vmLogger, $mosConfig_absolute_path, $VM_LANG;
		
		$extractdir = dirname($updatepackage).'/'. str_replace('.tar.gz', '', basename($updatepackage) );
		$update_manifest = $extractdir.'/update.xml';
		
		$result = true;
		if( !is_dir($extractdir) && !file_exists($update_manifest)) {
			if(vmIsJoomla('1.5', '>=')) {
				jimport('joomla.filesystem.archive');
				if( !JArchive::extract($updatepackage, $extractdir )) {
					$vmLogger->err( $VM_LANG->_('VM_UPDATE_ERR_EXTRACT_FAILED')." ".$extractdir);
					$result= false;return $result;
				}
			} else {
				require_once( ADMINPATH.'Tar.php' );
				$package_archive = new Archive_Tar( $updatepackage, "gz" );
				$result = $package_archive->extract($extractdir.'/');
				if( !$result ) {
					$vmLogger->err( $VM_LANG->_('VM_UPDATE_ERR_EXTRACT_FAILED')." ".$extractdir);
					$result= false;return $result;
				}
			}
		}
		
		$fileArr = array();		
		$queryArr = array();
		$result = true;
		
		// Can we use the PHP5 SimpleXML Extension ?
		if( function_exists('simplexml_load_file')) {
			$xml = simplexml_load_file($update_manifest);
			if( $xml === false ) {
				$vmLogger->err( $VM_LANG->_('VM_UPDATE_ERR_PARSE_FAILED') );
				return false;
			}
			
 			$toversion = (string)$xml->toversion;
 			$forversion = (string)$xml->forversion;
 			$description = (string)$xml->description;
 			$releasedate = (string)$xml->releasedate;
 			
			foreach( $xml->files->file as $file ) {
				if( file_exists($extractdir.'/'.$file )) {
					$fileArr[] = (string)$file;
				} else {
					$vmLogger->err( sprintf($VM_LANG->_('VM_UPDATE_ERR_FILE_MISSING'),$file) );
					$result = false;
				}
			}
			if( $result === false ) {
				return $result;
			}
			foreach( $xml->queries->query as $query ) {
				$queryArr[] = (string)$query;
			}
		} else {
			// Use the SimpleXML Equivalent
			require_once( CLASSPATH. 'simplexml.php' );
			$xml = new vmSimpleXML();
 			$result = $xml->loadFile($update_manifest);
		
			if( $result === false ) {
				$vmLogger->err( $VM_LANG->_('VM_UPDATE_ERR_PARSE_FAILED') );
				return false;
			}
			$result = true;
 			$xml = $xml->document;
 			
 			$toversion = $xml->toversion[0]->data();
 			$forversion = $xml->forversion[0]->data();
 			$description = $xml->description[0]->data();
 			$releasedate = $xml->releasedate[0]->data();
 			
			foreach( $xml->files[0]->file as $file ) {
				if( file_exists($extractdir.'/'.$file->data() )) {
					$fileArr[] = $file->data();
				} else {
					$vmLogger->err( sprintf($VM_LANG->_('VM_UPDATE_ERR_FILE_MISSING'),$file) );
					$result = false;
				}
			}
			if( $result === false ) {
				return $result;
			}
			foreach( $xml->queries[0]->query as $query ) {
				$queryArr[] = $query->data();
			}
		}
		$returnArr['toversion'] = $toversion;
		$returnArr['forversion'] = $forversion;
		$returnArr['description'] = $description;
		$returnArr['releasedate'] = $releasedate;
		$returnArr['fileArr'] =& $fileArr;
		$returnArr['queryArr'] =& $queryArr;
		return $returnArr;
	}
	/**
	 * Applies the Patch Package
	 *
	 * @param array $d
	 * @return boolean
	 */
	function applyPatch( &$d ) {
		global $vmLogger, $mosConfig_absolute_path, $db, $sess, $VM_LANG;
		
		$updatepackage = vmget($_SESSION,'vm_updatepackage');
		if( empty( $updatepackage ) ) {
			$vmLogger->err( $VM_LANG->_('VM_UPDATE_ERR_DOWNLOAD') );
			return;
		}
		$patchdir = dirname($updatepackage).'/'. str_replace('.tar.gz', '', basename($updatepackage) );
		$packageContents = vmUpdate::getPatchContents($updatepackage);
		
		if( !vmUpdate::verifyPackage( $packageContents ) ) {
			return false;
		}
		$errors = 0;
		foreach( $packageContents['fileArr'] as $file ) {
		  	if( file_exists($mosConfig_absolute_path.'/'.$file)) {
		  		if( !is_writable($mosConfig_absolute_path.'/'.$file ) ) {
		  			$vmLogger->err( sprintf($VM_LANG->_('VM_UPDATE_ERR_FILE_UNWRITABLE'),$mosConfig_absolute_path.'/'.$file) );
		  			$errors++;
		  		}
		  	} else {
		  		if( !is_writable($mosConfig_absolute_path.'/'.dirname($file) )) {
		  			$vmLogger->err( sprintf($VM_LANG->_('VM_UPDATE_ERR_DIR_UNWRITABLE'),$mosConfig_absolute_path.'/'.$file) );
		  			$errors++;
		  		}
		  	}
		}
	  	if( $errors > 0 ) {
	  		return false;
  		}
  		foreach( $packageContents['fileArr'] as $file ) {
  			$patch_file = $patchdir.'/'.$file;
  			$orig_file = $mosConfig_absolute_path.'/'.$file;
  			//TODO: Make a backup file before overwriting the original ? rename( $orig_file, $orig_file.'~' );
  			if( !@copy( $patch_file, $orig_file ) ) {
  				$vmLogger->crit( sprintf($VM_LANG->_('VM_UPDATE_ERR_OVERWRITE_FAILED'),$file) );
  				return false;  				
  			} else {
  				$vmLogger->debug( sprintf($VM_LANG->_('VM_UPDATE_FILE_OVERWROTE'),$file) );
  			}
  		}
  		foreach( $packageContents['queryArr'] as $query ) {
  			if( $db->query($query) === false ) {
  				$vmLogger->crit( sprintf($VM_LANG->_('VM_UPDATE_ERR_QUERY_FAILED'),$query) );
  			} else {
  				$vmLogger->debug( sprintf($VM_LANG->_('VM_UPDATE_QUERY_EXECUTED'),$query) );
  			}
  		}
  		
  		$db->query('UPDATE `#__components` SET `params` = \'RELEASE='.$packageContents['toversion'].'\nDEV_STATUS=stable\' WHERE `name` = \'virtuemart_version\'');
  		
  		$_SESSION['vmupdatemessage'] = sprintf($VM_LANG->_('VM_UPDATE_SUCCESS'),$packageContents['forversion'],$packageContents['toversion']);
  		
		vmRedirect($sess->url($_SERVER['PHP_SELF'].'?page=admin.update_result', false, false) );
  		
	}
	/**
	 * Verifies the integrity of the Patch Package.
	 *
	 * @param array $packageContents
	 * @return boolean
	 */
	function verifyPackage( &$packageContents ) {
		global $VM_LANG;
		
		if( $packageContents === false ) {
			return false;
		}
		require_once( ADMINPATH.'version.php');
		$VMVERSION = new vmVersion();
		
		if( $VMVERSION->RELEASE != $packageContents['forversion'] ) {
			$vmLogger->err( $VM_LANG->_('VM_UPDATE_ERR_NOTMATCHING') );
			return false;
		}
		
		return true;
	}
	/**
	 * Shows the Step-1-2-3 Bar at the Top of the Updater
	 *
	 * @param int $step
	 */
	function stepBar( $step ) {
		global $VM_LANG;
		
		$steps = array( 1 => $VM_LANG->_('VM_UPDATE_STEP_1'),
									2 => $VM_LANG->_('VM_UPDATE_STEP_2'),
									3 => $VM_LANG->_('VM_UPDATE_STEP_3') );
		$num_of_steps = count( $steps );
		$cellwidth = intval(100 / $num_of_steps);
		
		echo '<table width="60%" align="center" border="0" cellspacing="10" cellpadding="7"><tr>';
		
		foreach( $steps as $num => $label ) {
			if( $step == $num ) {
				$style='background-color:#3333FF;color:white;font-weight:bold;';
			} elseif( $num > $step ) {
				$style='background-color:#E6E6FA;';
			} else {
				$style='background-color:#00CC33;';
			}
			echo '<td width="'.$cellwidth.'%" style="'.$style.'border:1px solid gray;">'.$num.'<br />'.$label.'</td>';			
		}
		echo '</tr></table>';
	}
}
?>
