<?php
/**
 *
 * @package    VirtueMart
 * @subpackage vmpayment
 * @version $Id$
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - ${PHING.VM.RELDATE} VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */
?>
<?php

// url sent in get
$url = $_POST['gateway_url'];
unset($_POST['gateway_url']);
?>

<html>
<head>
  <title>Transferring...</title>
  <meta http-equiv="Content-Type"
    content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">

<form
  name="form1"
  action="<?php echo $url; ?>"
  method="POST">

<?php
  // get the posted vars
  $field_array = array_keys($_POST);

  //loop posted fields
  for($i = 0;$i < count($field_array);$i++) {
    $actual_var = $field_array[$i];
    $actual_val = stripslashes($_POST[$actual_var]);

    //hidden form field
    echo ("<input type=\"hidden\" name=\"");
    echo ($actual_var . "\" value=\"");
    echo (trim($actual_val) . "\" />\n");
  }

?>
</form>

<script language="javascript">
  var f=document.forms;
  f = f[0];
  f.submit();
</script>

</body>
</html>
