<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: ps_main.php,v 1.38 2005/09/06 19:28:35 soeren_nb Exp $
* @package mambo-phpShop
*
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*
*/


/**************************************************************************
** This is no class! This file only provides core phpshop functions.
**
** name: validate_image
** created by: jep
** description: Validates an uploaded image. Creates UNIX commands to be used
**              by the process_images function, which has to be called after
**              the validation.
**
** parameters: 
**   - $d             The array containing a the image upload information.
**       - $d[$field_name] : PHP passes the local temp filename for the image
**                           upload here.
**       - $d[$field_name . "_name"] : PHP passes the original filename of the
**                                     uploaded  file here.
**       - $d[$field_name . "_curr"] : This must be passed by the form that
**                                     uploads the images.  It must contain
**                                     the filename of the current image for
**                                     the field_name.
**
**   - $field_name    The name of the field in the data base that is used to
**                    store the image filename.  This name has to be the one
**                    used in the Upload Form Object so that all image upload
**                    vars can be accessed from the $d array.
**
**   - $table_name    The name of the table where the image belongs.  This 
**                    variable indicates the subdirectory where the image 
**                    files will be placed. This directory is based on the
**                    vendor_image_path value found on the vendor table in
**                    the database.
**
** returns:
**   - If an image upload was not requested for field_name, the function
**     returns TRUE.
**
**   - If an image upload was requested for field_name:
**       - TRUE if image was uploaded to the local drive, the file is readable,
**         the image type is valid, and the destination directory is writeable.
**       - FALSE otherwise.
**
**   - If an image delete was requested:
**       - TRUE if the directory is writeable.
**       - FALSE otherwise.
**
**   - $d["$field_name"] : The filename (without path) to where
**                         the image was saved is returned here.
**
**   - $d["image_commands"] : The commands to be executed by the process_images
**                           function are returned as a string here.  The
**                           commands are EVAL commands separated by ";"
**
**   - $d["error"] : Error messages returned here.
**                         
***************************************************************************/  
function validate_image(&$d,$field_name,$table_name) {
  $ps_vendor_id = $_SESSION["ps_vendor_id"];
  require_once(CLASSPATH.'ps_vendor.php');
  $ps_vendor = new ps_vendor;
  
  $tmp_field_name = str_replace( "thumb", "full", $field_name );
  
  if( @$d[$tmp_field_name.'_action'] == 'auto_resize' 
        && empty($d['resizing_prepared']) 
    ) {
        // Resize the Full Image
        if( !empty ( $_FILES[$tmp_field_name]["tmp_name"] )) {
            $full_file = $_FILES[$tmp_field_name]["tmp_name"];
            $image_info = getimagesize($full_file);
        }
        elseif( !empty($d[$tmp_field_name."_url"] )) {
            
            @ini_set( "allow_url_fopen");
            $remote_fetching = ini_get( "allow_url_fopen");
            if( $remote_fetching ) {
                $handle = fopen( $d[$tmp_field_name."_url"] , "rb" );
                $data = "";
                while( !feof( $handle )) {
                    $data .= fread( $handle, 4096 );
                }
                fclose( $handle );
                $tmp_file_from_url = $full_file = tempnam(IMAGEPATH."/product/", "FOO");
                $handle = fopen($full_file, "wb");
                fwrite($handle, $data);
                fclose($handle);
                $image_info = getimagesize($full_file); 
            }
        }
        if( !empty( $image_info )) {
            //	Class for resizing Thumbnails
            require_once( CLASSPATH . "class.img2thumb.php");
            if( $image_info[2] == 1) {
                if( function_exists("imagegif") ) {
                  $ext = ".gif";
                  $noimgif="";
                }
                else {
                  $ext = ".jpg";
                  $noimgif = ".gif";
                }
            }
            elseif( $image_info[2] == 2) {
                $ext = ".jpg";
                $noimgif="";
            }
            elseif( $image_info[2] == 3) {
                $ext = ".png";
                $noimgif="";
            }
            
            /* Generate Image Destination File Name */
            $to_file_thumb = md5(uniqid("mambo-phpShop"));
            $fileout = IMAGEPATH."/product/resized/".$to_file_thumb."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.$noimgif.$ext;
            $neu = new Img2Thumb( $full_file, PSHOP_IMG_WIDTH, PSHOP_IMG_HEIGHT, $fileout, 0, 255, 255, 255 );
            if( isset($tmp_file_from_url) ) unlink( realpath($tmp_file_from_url) );
            $tmp_field_name = str_replace( "full", "thumb", $tmp_field_name );
            $tmp_field_name = str_replace( "_url", "", $tmp_field_name );
            $_FILES[$tmp_field_name]['tmp_name'] = $fileout;
            $_FILES[$tmp_field_name]['name'] = basename($fileout);
            $d[$tmp_field_name] = basename($fileout);
            
            $d['resizing_prepared'] = "1";
        }
  }

  $temp_file = isset($_FILES[$field_name]['tmp_name']) ? $_FILES[$field_name]['tmp_name'] : "";
  $file_type = isset($_FILES[$field_name]['type']) ? $_FILES[$field_name]['type'] : "";

  $orig_file = isset($_FILES[$field_name]["name"]) ? $_FILES[$field_name]['name'] : "";
  $curr_file = isset($_REQUEST[$field_name."_curr"]) ? $_REQUEST[$field_name."_curr"] : "";
  
  if (!isset($d['image_commands'])) 
    $d['image_commands'] = "";

  /* Generate text to display in error messages */
  if (eregi("thumb",$field_name)) {
    $image_type = "thumbnail image";
  } elseif (eregi("full",$field_name))  {
    $image_type = "full image";
  } else {
    $image_type = ereg_replace("_"," ",$field_name);
  }

  /* Generate the path to images */
  $path  = IMAGEPATH;
  
  $path .= $table_name . "/";

  /* If User types "none" in Image Upload Field */
  if ($d[$field_name."_action"] == "delete") {
    /* If there is a current image file */
    if (!empty($curr_file)) {
        /* Check permissions to delete from $path */
        if (!is_writeable($path)) {
            $d["error"] .= "ERROR: Cannot delete from $image_type directory $path";
            return false;
        } 
        else {
            $delete = str_replace("\\", "/", realpath($path."/".$curr_file));
            if( file_exists( $delete ) )
                $d["image_commands"] .= "\$ret = unlink(\"$delete\");";
        }
        /* Remove the resized image if exists */
        if( PSHOP_IMG_RESIZE_ENABLE=="1" && $image_type == "thumbnail image") {
            $pathinfo = pathinfo( $delete );
            isset($pathinfo["dirname"]) or $pathinfo["dirname"] = "";
            isset($pathinfo["extension"]) or $pathinfo["extension"] = "";
            $filehash = basename( $delete, ".".$pathinfo["extension"] );
            $resizedfilename = $pathinfo["dirname"]."/resized/".$filehash."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.".".$pathinfo["extension"];
            if( file_exists($resizedfilename))
                $d["image_commands"] .= "\$ret = unlink(\"$resizedfilename\");";
        }

    }
    $d[$field_name] = "";
    return true;
  }
  /* If upload fails */
  elseif($orig_file and $temp_file == "none") {
    $d["error"] .= "ERROR: $image_type upload failed.";
    return false;
  }

  else {
		// If nothing was entered in the Upload box, there is no image to process
		if (!$orig_file) {
			$d[$field_name] = $curr_file;
			return true;
		}
  }
  if( empty( $temp_file )) {
	$d["error"] .= "Error: The File Upload was not successful: there's no uploaded temporary file!";
	return false;
  }
  // Check permissions to read temp file
  if (!is_readable($temp_file)) {
    $d["error"] .= "Error: Cannot read uploaded $image_type temp file: $temp_file. \\n 
    One common reason for this that the upload path cannot be accessed because of the open_basedir settings in the php.ini .";
    return false;
  }

  // Generate Image Destination File Name
  $to_file = md5(uniqid("mambo-phpShop"));

    /* Check image file format */
    if( $orig_file != "none" ) {
      switch($file_type) {
        case "image/gif":
             $to_file .= ".gif"; 
             $ext = ".gif";
             break;
        case "image/jpeg":
             $to_file .= ".jpg";
             $ext = ".jpg";
              break;
        case "image/png":
            $to_file .= ".png"; 
             $ext = ".png";
             break;
        default:
            $image_info = getimagesize($temp_file);
            switch($image_info[2]) {
              case 1:
                 $to_file .= ".gif"; 
                 $ext = ".gif";
                 break;
              case 2:
                 $to_file .= ".jpg"; 
                 $ext = ".jpg";
                 break;
              case 3:
                 $to_file .= ".png"; 
                 $ext = ".png";
                 break;
              default:
                $d["error"] .= "ERROR: $image_type file is invalid: $file_type.";
                return false;
            }
      }
    }
  /*
  ** If it gets to this point then there is an uploaded file in the system
  ** and it is a valid image file.
  */

  /* Check permissions to write to destination directory */
    // Workaround for Window$
    if(strstr($path , ":" )) {
      $path_begin = substr( $path, strpos( $path , ":" )+1, strlen($path));
      $path = str_replace( "//", "/", $path_begin );
    }
  if (!is_dir( $path ))
    mkdir( $path, 0777 );
  if( !is_writable($path)) {
    @$d["error"] .= "ERROR: Cannot write to $image_type destination directory: $path";
    return false;
  }

  /* If Updating */

  if (!empty($curr_file)) {
    /* Command to remove old image file */
    $delete = str_replace( "\\", "/", realpath($path)."/".$curr_file);
    if( file_exists( $delete ) )
        $d["image_commands"] .= "\$ret = unlink(\"$delete\");";
    /* Remove the resized image if exists */
    if( PSHOP_IMG_RESIZE_ENABLE=="1" && $image_type == "thumbnail image") {
        $pathinfo = pathinfo( $delete );
        $filehash = basename( $delete, ".".$pathinfo["extension"] );
        $resizedfilename = $pathinfo["dirname"]."/resized/".$filehash."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.".".$pathinfo["extension"];
        if( file_exists($resizedfilename))
            $d["image_commands"] .= "\$ret = unlink(\"$resizedfilename\");";
    }
  }

  /* Command to move uploaded file into destination directory */
  $d["image_commands"] .= "\$ret = copy(\"".addslashes($temp_file)."\", \"".$path.$to_file."\");";
  if( file_exists( realpath($temp_file) ))
    $d["image_commands"] .= "\$ret = @unlink(\"".addslashes(realpath($temp_file))."\" );";

  /* Return new image file name */
  $d[$field_name] = $to_file;
  return true;
}

/**************************************************************************
** name: process_images
** created by: jep
** description: 
** parameters:
** returns:
***************************************************************************/  
function process_images(&$d) {

  if (!empty($d["image_commands"])) {
  
    $commands = explode(";",ereg_replace(";$","",$d["image_commands"]));
    $commands = str_replace('\\"', '"', $commands);
    $d["image_commands"] = "";
    $cnt = count($commands);
    for ($i=0;$i<$cnt;$i++) {
      eval($commands[$i] . ";"); 
      if ($ret == False) {
        $d["error"] .= "ERROR: Image Update command failed.\n ";
        $d["error"] .= $commands[$i];
        return false;
      }

    }
  }
  return true;
}

/**************************************************************************
** name: process_date_time
** created by: jep
** description: 
** parameters:
** returns:
***************************************************************************/  
function process_date_time(&$d,$field,$type="") {
  $month = $d["$field" . "_month"];
  $day = $d["$field" . "_day"];
  $year = $d["$field" . "_year"];
  $hour = $d["$field" . "_hour"];
  $minute = $d["$field" . "_minute"];
  $use = $d["$field" . "_use"];
  $valid = true;

  /* If user unchecked "Use date and time" then time = 0 */
  if (!$use) {
    $d[$field] = 0;
    return true;
  }
  if (!checkdate($month,$day,$year)) {
    $d["error"] .= "ERROR: $type date is invalid.";
    $valid = false;
  }
  if (!$hour and !$minute) {
    $hour = 0;
    $minute = 0;
  } elseif ($hour < 0 or $hour > 23 or $minute < 0 or $minute > 59) {
    $d["error"] .= "ERROR: $type time is invalid.";
    $valid = false;
  }

  if ($valid) {
    $d[$field] = mktime($hour,$minute,0,$month,$day,$year);
  }

  return $valid;   
}

/****************************************************************************
 *    function: mShop_validateEmail
 *  created by: Gregory Day
 * description: Validates an e-mail address.  Only checks that the format
 *              is valid.  It does not validate that the address will
 *              work.
 *  parameters: $email: Email address to validate
 *     returns: true: Email address is valid
 *             false: Email address is not valid
 ****************************************************************************/
function mShop_validateEmail( $email ) {

   if(ereg('^[_a-z0-9A-Z+-]+(\.[_a-z0-9A-Z+-]+)*@[a-z0-9A-Z-]+(\.[a-z0-9A-Z-]+)*$', $email)) {      return(true);
   }
   else {
      return(false);
   }
} // validate_email()


/****************************************************************************
 *    function: post
 *  created by: Steve Endredy
 * description: http post (used by mShop_validateEUVat)
 *     returns: html result (string)
 ****************************************************************************/
function mShop_post( $host,$query,$others='' ){
   $path=explode('/',$host);
   $host=$path[0];
   unset($path[0]);
   $path='/'.(implode('/',$path));
   $post="POST $path HTTP/1.1\r\nHost: $host\r\nContent-type: application/x-www-form-urlencoded\r\n${others}User-Agent: Mozilla 4.0\r\nContent-length: ".strlen($query)."\r\nConnection: close\r\n\r\n$query";
   $h=fsockopen($host,80);
   fwrite($h,$post);
   for($a=0,$r='';!$a;){
       $b=fread($h,8192);
       $r.=$b;
       $a=(($b=='')?1:0);
   }
   fclose($h);
   return $r;
}


/****************************************************************************
 *    function: mShop_validateEUVat
 *  created by: Steve Endredy
 * description: Validates an EU-vat number
 *  parameters: $euvat: EU-vat number to validate
 *     returns: true: EU-vat number is valid
 *             false: EU-vat number is not valid
 ****************************************************************************/

function mShop_validateEUVat( $euvat ){
  $eurl = "www.europa.eu.int/comm/taxation_customs/vies/cgi-bin/viesquer";
  if(!ereg("([a-zA-Z][a-zA-Z])[- ]*([0-9]*)", $euvat, $r)){
	return false;
	}
  $CountryCode = $r[1];
  $VAT = $r[2];
  $query = "Lang=EN&MS=$CountryCode&ISO=$CountryCode&VAT=$VAT";
  $ret = mShop_post($eurl, $query);
  if (ereg("Yes, valid VAT number", $ret))
    return true;
  return false;

}

/****************************************************************************
 *    function: utime
 *  created by: pablo, modified by Soeren
 * description: 
 *  parameters: 
 *     returns: 
 ****************************************************************************/
function utime()
{
   list($usec, $sec) = explode(" ", microtime()); 
   return ((float)$usec + (float)$sec); 
}

/****************************************************************************
 *    function: in_list
 *  created by: pablo
 * description: 
 *  parameters: 
 *     returns: 
 ****************************************************************************/
function in_list($list, $item) {
  for ($i=0;$i<$list["cnt"];$i++) {
    if (!strcmp($list[$i]["name"],$item)) {
       return $i;
    }
  }
  return False;
}


/****************************************************************************
 *    function: search_header
 *  created by: pablo
 * description: New Stuff to make the page selection and search easier
 *  parameters: 
 *     returns: 
 ****************************************************************************/
 
// New Stuff to make the page selection and search easier
function search_header($title, $modulename, $pagename) {

  global $sess,$PHP_SELF, $PHPSHOP_LANG;
  
    $_REQUEST['limitstart'] = $limitstart = empty( $_REQUEST['limitstart'] ) ? 0 : $_REQUEST['limitstart'];
    $_REQUEST['offset'] = mosGetParam( $_REQUEST, 'limitstart', 0);
    $category_id = mosGetParam( $_REQUEST, 'category_id', null);
    $show = mosGetParam( $_REQUEST, "show", "" );
    
    $header = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">\n";
    $header .= "<tr>\n";
    $header .= "<td nowrap=\"nowrap\" align=\"left\"><span class=\"sectionname\">$title</span></td>\n";
    $header .= "<td colspan=\"3\" align=\"right\">\n";
    $header .= "<form action=\"" . $PHP_SELF . "\" method=\"get\">". $PHPSHOP_LANG->_PHPSHOP_SEARCH_LBL .":\n";
    $header .= "<input type=hidden name=\"option\" value=\"com_phpshop\" />\n";
    $header .= "<input class=\"inputbox\" type=\"text\" size=\"15\" name=\"keyword\" />\n";
    $header .= "<input type=\"hidden\" name=\"page\" value=\"". $modulename . "." . $pagename . "\" />\n";
    $header .= "<input class=\"button\" type=\"submit\" name=\"search\" value=\"".$PHPSHOP_LANG->_PHPSHOP_SEARCH_TITLE."\" />\n";
    $header .= "</form>\n";
    $header .= "</td></tr>\n";
    $header .= "</table>\n";
    $header .= "<form name=\"adminForm\" action=\"$PHP_SELF\">\n";
    $header .= "<input type=hidden name=\"option\" value=\"com_phpshop\" />\n";
    $header .= "<input type=\"hidden\" name=\"keyword\" value=\"".urlencode( @$_REQUEST['keyword'] )."\" />\n";
	if ( @$_REQUEST['search_date'] ) // Changed search by date
	    $header .= "<input type=\"hidden\" name=\"search_date\" value=\"". @$_REQUEST['search_date'] ."\" />\n"; // Changed search by date
    $header .= "<input type=\"hidden\" name=\"page\" value=\"$modulename."."$pagename\" />\n";
    $header .= "<input type=\"hidden\" name=\"limitstart\" value=\"$limitstart\" />\n";
    if( $category_id ) {
        $header .= "<input type=\"hidden\" name=\"category_id\" value=\"$category_id\" />\n";
    }
    if( $show ) {
        $header .= "<input type=\"hidden\" name=\"show\" value=\"$show\" />\n";
    }
    $header .= "</form>\n";
  echo $header;
}


/****************************************************************************
 *    function: search_footer
 *  created by: pablo
 * description: 
 *  parameters: 
 *     returns: 
 ****************************************************************************/
function search_footer($modulename, $pagename, $offset, $num_rows, $keyword, $extra="") {
    global $sess;
    $footer = "";
    if( $num_rows > SEARCH_ROWS || $offset >= $num_rows) {
        include_once( "includes/pageNavigation.php" );
        
        $pagenav = new mosPageNav( $num_rows, $offset, SEARCH_ROWS );
        
        if($extra) {
            $footer .= "<script type=\"text/javascript\">\n";
            $extrafields = explode("&", $extra);
            array_shift($extrafields);
            foreach( $extrafields as $key => $value) {
                $field = explode("=", $value);
                $footer .= "document.adminForm.innerHTML += '<input type=\"hidden\" name=\"".$field[0]."\" value=\"".$field[1]."\" />';\n";
            }
            $footer .= "</script>\n";
        }
        $keyword = urlencode( $keyword );
        $link = $_SERVER['PHP_SELF']."?option=com_phpshop&page=$modulename.$pagename&keyword=$keyword".$extra;
        
        
        $footer .= "<table class=\"adminlist\" width=\"100%\"><tr><th width=\"100%\"><div align=\"center\">";
        if( defined('_PSHOP_ADMIN') && !defined("_RELEASE"))
            $footer .= $pagenav->getPagesLinks();
        /* Uuh. Mambo development is weird! 4.5 Patch */
        elseif(defined("_RELEASE"))
            $pagenav->writePagesLinks();
        else
            $footer .= sefRelToAbs( $pagenav->writePagesLinks( $link ) );
        $footer .= "</div></th></tr></table>";
        $footer .= "<br /><div align=\"center\">";
        if( defined('_PSHOP_ADMIN') && !defined("_RELEASE"))
            $footer .= $pagenav->getPagesCounter();
        else
            $footer .= $pagenav->writePagesCounter();
        $footer .= "</div>";
        
    }
    echo $footer;
}



/****************************************************************************
 *    function: hide_vars
 *  created by: pablo
 * description: Puts the HTTP_POST_VARS or HTTP_GET_VARS in a form as hidden 
 *              fields.  Checks for "login" variable and does not set it.  If
 *              it did we would get stuck in a perpetual loop. Also check for
 *              "error" variable since this would look ugly... 
 *  parameters: none
 *     returns: echoes INPUT form fields
 ****************************************************************************/
function hide_vars() {
   global $vars;

   while (list($key, $value) = each($vars)) {
      if ($key != "login" && $key != "error")
         echo "<input type=\"hidden\" name=\"$key\" value=\"$value\">\n";
   }
   reset($vars);
}
/****************************************************************************
 *    function: read_file
 *  created by: soeren
 * description: reads a file and returns its content as a string
 *  parameters: full qualified filename
 *     returns: string
 ****************************************************************************/
function read_file( $file, $defaultfile='' ) {          
        
    // open the HTML file and read it into $html
    if (file_exists( $file )) {
        $html_file = fopen( $file, "r" );
    }
    elseif( !empty( $defaultfile ) && file_exists( $defaultfile ) ) {
        $html_file = fopen( $defaultfile, "r" );
    }
    else {
        return;
    }
    $html = "";
    
    while (!feof($html_file)) {
        $buffer = fgets($html_file, 1024);
        $html .= $buffer;
    }
    fclose ($html_file);
    
    return( $html );
}
/****************************************************************************
 *    function: include_class
 *  created by: soeren
 * description: require_once( the class ) and create an class object
 *  parameters: $class
 *     returns: true if successful
 ****************************************************************************/

function include_class($module) {

    // globalize the vars so that they can be used outside of this function
    global $ps_vendor, $ps_affiliate, $ps_manufacturer, $ps_manufacturer_category,
        $ps_user,
        $ps_vendor_category,
        $ps_checkout,
        $ps_intershipper,
        $psShip,
        $ps_shipping,
        $ps_order,
        $ps_order_status,
        $ps_product,
        $ps_product_category ,
        $ps_product_attribute,
        $ps_product_type, // Changed Product Type 
        $ps_product_type_parameter, // Changed Product Type 
        $ps_product_product_type, // Changed Product Type 
        $ps_product_price,
        $nh_report,
        $ps_payment_method,
        $ps_shopper,
        $ps_shopper_group,
        $ps_cart,
        $ps_zone,
        $ps_tax,
        $zw_waiting_list;
        
    switch ( $module ) {
    
        case "account": 
            break; 
        
        case "admin" : 
            // Load class files
            require_once(CLASSPATH. 'ps_html.php' );
            require_once(CLASSPATH. 'ps_function.php' );
            require_once(CLASSPATH. 'ps_module.php' );
            require_once(CLASSPATH. 'ps_perm.php' );
            require_once(CLASSPATH. 'ps_user.php' );
            require_once(CLASSPATH. 'ps_user_address.php' );
            require_once(CLASSPATH. 'ps_session.php' );
            
            //Instantiate Classes
            $ps_html = new ps_html;
            $ps_function = new ps_function;
            $ps_module= new ps_module;
            $ps_perm= new ps_perm;
            $ps_user= new ps_user;
            $ps_user_address = new ps_user_address;
            $ps_session = new ps_session;
            
            break;
        
        case "affiliate" : 
            // Load class file
            require_once(CLASSPATH. 'ps_affiliate.php' );
            
            //Instantiate Class
            $ps_affiliate = new ps_affiliate;
                        
            break;
        
        case "checkout" : 
            // Load class file
            require_once(CLASSPATH. 'ps_checkout.php' );
            
            //Instantiate Class
            $ps_checkout = new ps_checkout;
                        
            break;
        
        case "order" :
            // Load classes
            require_once(CLASSPATH.'ps_order.php' );
            require_once(CLASSPATH.'ps_order_status.php' );
            
            // Instantiate Classes
            $ps_order = new ps_order;
            $ps_order_status = new ps_order_status;
            break;
        
        case "product" :
            // Load Classes
            require_once(CLASSPATH.'ps_product.php' );
            require_once(CLASSPATH.'ps_product_category.php' );
            require_once(CLASSPATH.'ps_product_attribute.php' );
            require_once(CLASSPATH.'ps_product_type.php' ); // Changed Product Type 
            require_once(CLASSPATH.'ps_product_type_parameter.php' ); // Changed Product Type 
            require_once(CLASSPATH.'ps_product_product_type.php' ); // Changed Product Type             
            require_once(CLASSPATH.'ps_product_price.php' );
            
            // Instantiate Classes
            $ps_product = new ps_product;
            $ps_product_category = new ps_product_category;
            $ps_product_attribute = new ps_product_attribute;
		    $ps_product_type = new ps_product_type; // Changed Product Type 
		    $ps_product_type_parameter = new ps_product_type_parameter; // Changed Product Type 
	    	$ps_product_product_type = new ps_product_product_type; // Changed Product Type
            $ps_product_price = new ps_product_price;
            break;
        
        case "reportbasic" :
            // Load Classes
            require_once( CLASSPATH . 'ps_reportbasic.php');
            $nh_report = new nh_report;
            break;
            
        case "shipping" :
            // Load Class
            require_once( CLASSPATH . 'ps_shipping.php');
            // Instantiate Class
            $ps_shipping = new ps_shipping;
            break;
            
        case "shop" :
            // Load Classes
            require_once( CLASSPATH. 'ps_cart.php' );
            require_once( CLASSPATH. 'zw_waiting_list.php');
            
            // Instantiate Classes
            $ps_cart = new ps_cart;
            $zw_waiting_list = new zw_waiting_list;
            break;
            
        case "shopper" :
        
            // Load Classes
            require_once( CLASSPATH . 'ps_shopper.php' );
            require_once( CLASSPATH . 'ps_shopper_group.php' );
            
            
            // Instantiate Classes
            $ps_shopper = new ps_shopper;
            $ps_shopper_group = new ps_shopper_group;
            break;
            
        case "store" :
        
            // Load Classes
            require_once( CLASSPATH . 'ps_payment_method.php' );
            
            // Instantiate Classes
            $ps_payment_method = new ps_payment_method;
            break;
            
        case "tax" :
            
            // Load Classes
            require_once ( CLASSPATH . 'ps_tax.php' );
    
            // Instantiate Classes
            $ps_tax = new ps_tax;
            break;
            
        case "vendor" :
            
            // Load Classes
            require_once (CLASSPATH . 'ps_vendor.php' );
            require_once (CLASSPATH . 'ps_vendor_category.php' );
            
            // Instantiate Classes
            $ps_vendor = new ps_vendor;
            $ps_vendor_category = new ps_vendor_category;
            break;
            
        case "zone" :
        
            // Load Class
            require_once (CLASSPATH . 'ps_zone.php');
            
            // Instantiate Class
            $ps_zone = new ps_zone;
            break;
            
        case "manufacturer" :
        
            require_once (CLASSPATH . 'ps_manufacturer.php');
            require_once (CLASSPATH . 'ps_manufacturer_category.php');
            $ps_manufacturer = new ps_manufacturer;
            $ps_manufacturer_category = new ps_manufacturer_category;
            break;
    }
}

/**
* @param string The vendor_currency_display_code
*   FORMAT: 
    1: id, 
    2: CurrencySymbol, 
    3: NumberOfDecimalsAfterDecimalSymbol,
    4: DecimalSymbol,
    5: Thousands separator
    6: Currency symbol position with Positive values :
									// 0 = '00Symb'
									// 1 = '00 Symb'
									// 2 = 'Symb00'
									// 3 = 'Symb 00'
    7: Currency symbol position with Negative values :
									// 0 = '(Symb00)'
									// 1 = '-Symb00'
									// 2 = 'Symb-00'
									// 3 = 'Symb00-'
									// 4 = '(00Symb)'
									// 5 = '-00Symb'
									// 6 = '00-Symb'
									// 7 = '00Symb-'
									// 8 = '-00 Symb'
									// 9 = '-Symb 00'
									// 10 = '00 Symb-'
									// 11 = 'Symb 00-'
									// 12 = 'Symb -00'
									// 13 = '00- Symb'
									// 14 = '(Symb 00)'
									// 15 = '(00 Symb)'
    EXAMPLE: ||&euro;|2|,||1|8
* @return string
*/
    function vendor_currency_display_style( $style ) {
    
        $array = explode( "|", $style );
        $display = Array();
        $display["id"] = @$array[0];
        $display["symbol"] = @$array[1];
        $display["nbdecimal"] = @$array[2];
        $display["sdecimal"] = @$array[3];
        $display["thousands"] = @$array[4];
        $display["positive"] = @$array[5];
        $display["negative"] = @$array[6];
        return $display;
    }
/**
* @param int The row index
* @param string The task to fire
* @param string The alt text for the icon
* @return string
*/
	function mShop_orderUpIcon( $i, $num_rows, $id, $itemType="category", $condition=true, $task='orderup', $alt='Move Up' ) {
        global $mosConfig_live_site;
		if (($i > 0) && $condition) {
		    return '<a href="#reorder" onClick="return listItemTask(\'cb'.$id.'\',\''.$task.'\')" title="'.$alt.'">
				<img align=\"top\" src="'.$mosConfig_live_site.'/administrator/images/uparrow.png" width="12" height="12" border="0" alt="'.$alt.'">
			</a>';
  		} else {
  		    return '&nbsp;';
		}
	}
/**
* @param int The row index
* @param int The number of items in the list
* @param string The task to fire
* @param string The alt text for the icon
* @return string
*/
	function mShop_orderDownIcon( $i, $num_rows, $id, $itemType="category", $task='orderdown', $alt='Move Down' ) {
        global $mosConfig_live_site;
		if( $i + intval(@$_REQUEST['limitstart']) < $num_rows - 1 ) {
			return '<a href="#reorder" onClick="return listItemTask(\'cb'.$id.'\',\''.$task.'\')" title="'.$alt.'">
				<img align=\"bottom\" src="'.$mosConfig_live_site.'/administrator/images/downarrow.png" width="12" height="12" border="0" alt="'.$alt.'">
			</a>';
  		} else {
  		    return '&nbsp;';
		}
	}
if ( !function_exists( "mosToolTip" ) ) {
    /**
    * Utility function to provide ToolTips
    * @param string ToolTip text
    * @param string Box title
    * @returns HTML code for ToolTip
    */
    function mosToolTip($tooltip, $title='Mambo ToolTip') {
        global $mosConfig_live_site;
        $tip = "<a href=\"#\" onMouseOver=\"return overlib('" . $tooltip . "', CAPTION, '$title', BELOW, RIGHT);\" onmouseout=\"return nd();\"><img src=\"" . $mosConfig_live_site . "/images/M_images/con_info.png\" width=\"16\" height=\"16\" border=\"0\" /></a>";
        return $tip;
    }
}
function mm_ToolTip($tooltip, $title='Tip!', $icon = "{mosConfig_live_site}/images/M_images/con_info.png" ) {
    global $mosConfig_live_site;
    if( !defined( "_OVERLIB_LOADED" )) {
        mosCommonHTML::loadOverlib();
        define ( "_OVERLIB_LOADED", "1" );
    }
    $varname = "html_".uniqid("l");
    $tip = "<script type=\"text/javascript\">//<![CDATA[
    var $varname = '$tooltip';
    //]]></script>\n";
    $tip .= "<a href=\"#\" onmouseover=\"return overlib($varname, CAPTION, '$title' );\" onmouseout=\"return nd();\">";
    if( stristr( $icon, "{mosConfig_live_site}" ))
        $tip .= "<img alt=\"ToolTip\" src=\"".str_replace( "{mosConfig_live_site}", $mosConfig_live_site, $icon)."\" border=\"0\" width=\"16\" height=\"16\" />";
    else {
        // assume it's Text
        $tip .= $icon;
    }
    $tip .= "</a>";
    return $tip;
}
    
/**
* Tab Creation handler
* @package Mambo_4.5.1
* @author Phil Taylor
* @modifier Soeren Eberhardt
* Modified to use Panel-in-Panel functionality
*/
class mShopTabs {
	/** @var int Use cookies */
	var $useCookies = 0;
    
    /** @var string Panel ID */
    var $panel_id;
    
	/**
	* Constructor
	* Includes files needed for displaying tabs and sets cookie options
	* @param int useCookies, if set to 1 cookie will hold last used tab between page refreshes
	* @param int show_js, if set to 1 the Javascript Link and Stylesheet will not be printed
	*/
	function mShopTabs($useCookies, $show_js, $panel_id) {
		global $mosConfig_live_site;
        if( $show_js == 1 ) {
            echo "<link id=\"tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" href=\"" . $mosConfig_live_site. "/components/com_phpshop/js/tabs/mm_tabpane.css\" />";
            echo "<script type=\"text/javascript\" src=\"". $mosConfig_live_site. "/components/com_phpshop/js/tabs/mm_tabpane.js\"></script>";
        }
        $this->useCookies = $useCookies;
        $this->panel_id = $panel_id;
	}

	/**
	* creates a tab pane and creates JS obj
	* @param string The Tab Pane Name
	*/
	function startPane($id){
		echo "<div class=\"tab-page\" id=\"".$id."\">";
		echo "<script type=\"text/javascript\">\n";
		echo "   var tabPane1".$this->panel_id." = new WebFXTabPane( document.getElementById( \"".$id."\" ), ".$this->useCookies." )\n";
		echo "</script>\n";
	}

	/**
	* Ends Tab Pane
	*/
	function endPane() {
		echo "</div>";
	}

	/*
	* Creates a tab with title text and starts that tabs page
	* @param tabText - This is what is displayed on the tab
	* @param paneid - This is the parent pane to build this tab on
	*/
	function startTab( $tabText, $paneid ) {
		echo "<div class=\"tab-page\" id=\"".$paneid."\">";
		echo "<h2 class=\"tab\">".$tabText."</h2>";
		echo "<script type=\"text/javascript\">\n";
		echo "  tabPane1".$this->panel_id.".addTabPage( document.getElementById( \"".$paneid."\" ) );";
		echo "</script>";
	}

	/*
	* Ends a tab page
	*/
	function endTab() {
		echo "</div>";
	}
}

/**
* Login validation function
*
* Username and encoded password is compared to db entries in the mos_users
* table. A successful validation returns true, otherwise false
*/
function mShop_checkpass() {
  global $database, $perm, $my;
  
  // only allow access to admins or storeadmins
  if( $perm->check("admin,storeadmin")) {
  
	$username = $my->username;
	$passwd = trim( mosGetParam( $_POST, 'passwd', '' ) );
	$passwd = md5( $passwd );
	$bypost = 1;
	if (!$username || !$passwd || $_REQUEST['option'] != "com_phpshop") {
	  return false;
	} 
	else {
	  $database->setQuery( "SELECT id, gid, block, usertype"
	  . "\nFROM #__users"
	  . "\nWHERE username='$username' AND password='$passwd'"
	  );
	  $row = null;
	  if ($database->loadObject( $row )) {
		return true;
	  }
	  else {
		return false;
	  }
	}
  }
  else
	return false;
}
// borrowed from mambo.php
function shopMakeHtmlSafe( $string, $quote_style=ENT_QUOTES, $exclude_keys='' ) {
	
	$string = htmlentities( $string, $quote_style );
	return $string;
}

function mm_showMyFileName( $filename ) {
    
    if (DEBUG == '1' ) {
        if( !defined( "_OVERLIB_LOADED" )) {
		mosCommonHTML::loadOverlib();
            define ( "_OVERLIB_LOADED", "1" );
        }
        echo mm_ToolTip(addslashes("<div class='inputbox'>Begin of File: $filename</div>"));
    }
}
/**
* Wraps HTML Code or simple Text into Javascript
* and uses the noscript Tag to support browsers with JavaScript disabled
**/
function mm_writeWithJS( $textToWrap, $noscriptText ) {
    $text = "";
    if( !empty( $textToWrap )) {
        $text = "<script type=\"text/javascript\">//<![CDATA[
            document.write('".str_replace("\\\"", "\"", addslashes( $textToWrap ))."');
            //]]></script>\n";
    }
    if( !empty( $noscriptText )) {
        $text .= "<noscript>
            $noscriptText
            </noscript>\n";
    }
    return $text;
}
?>
