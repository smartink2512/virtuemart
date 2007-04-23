<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) {
	die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
}
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
?>
<pre>
This is a non-exhaustive (but still near complete) changelog for
VirtueMart, including beta and release candidate versions.
Our thanks to all those people who've contributed bug reports and code fixes.

Legend:

# -> Bug Fix
+ -> Addition
^ -> Change
- -> Removed
! -> Note

--------------------------------------------------------------------------------------------------------------

VirtueMart 1.1.x
*************************************
23.04.2007 macallf
# Added multiple prices to price table
+ Recently viewed products
+ Featured products on shop.index
^ shop.index.php changed to template system
+ added new functions 
!!! Database Table - New Entries
    Database table jos_vm_functions
    (187, 7, 'replaceSavedCart', 'ps_cart', 'replaceCart', 'Replace cart with saved cart', 'none'),
    (188, 7, 'mergeSavedCart', 'ps_cart', 'mergeSaved', 'Merge saved cart with cart', 'none'),
    (189, 7, 'deleteSavedCart', 'ps_cart', 'deleteSaved', 'Delete saved cart', 'none'),
    (190, 7, 'savedCartDelete', 'ps_cart', 'deleteSaved', 'Delete items from saved cart', 'none'),
    (191, 7, 'savedCartUpdate', 'ps_cart', 'updateSaved', 'Update saved cart items', 'none');" );
^ saved cart, now more comprehensive

16.04.2007 macallf
# Fixed task 1265: uninstall doesn't drop all tables.

14.04.2007 macallf
# Fixed task 1261: navigation pathway only showing last category.

12.04.2007 soeren

+ added a new table "jos_vm_cart" to store the contents of the cart of logged-in users
!!! DATABASE STRUCTURE CHANGED !!!
	### Permanently store the cart contents for registered users
	CREATE TABLE `jos_vm_cart` (
	`user_id` INT( 11 ) NOT NULL ,
	`cart_content` TEXT NOT NULL ,
	`last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY ( `user_id` )
	) TYPE = MYISAM COMMENT = 'Stores the cart contents of a user';
	###

	
11.04.2007 soeren
^ updated ExtJS from 1.0 alpha3 to 1.0 beta2

10.04.2007 soeren

+ added a filtering option to the related product select list, so searching for products is easier now

05.04.2007 soeren

^ changed "related products" form in product form to use Option Tansfer from one select list to another
	for better overview what was selected as related (using OptionTransfer.js by Matt Kruse - mattkruse.com/javascript/optiontransfer )
	You can even use double click to move products from one list to the other
	
03.04.2007 soeren

+ added page navigation on product level, so customers can go directly from one product to the next in that category/manufacturer/search result
^ product details page automatically grabs the Flypage of the category of the product if the flypage parameter was omitted from the URL


30.03.2007 gregdev
^ Changed shop_browse_queries.php to use a LEFT JOIN for #__{vm}_shopper_vendor_xref (fixes empty categories when table entry is missing).

28.03.2007 gregdev
# Fixed task #1212: ship_to_info_id and shipping_rate_id were not being passed to the template.

16.03.2007 gregdev
^ Improved the FedEx shipping module.

15.03.2007 soeren

# JoomFish language setting is overwritten in virtuemart.cfg.php
# CSV Upload not recognising correct Mime Type due to case-sensitive equality check
+ added a Feed Icon to the category name in the browse page (can be toggled on/off in theme configuration)
+ added Product Syndication system that allows to provide "Product Feeds" to customers
	The URL for the feed is "index.php?option=com_virtuemart&page=shop.feed". A category_id
	can be specified in the URL to filter the syndicated products by a certain category

13.03.2007 soeren

# Task #1187 - Virtuemart does not redirect correctly if only 1 payment option is available. (ps_checkout.php)
# Task #1200 - checkout.thankyou shows empty page when order_total is 0 (checkout.thankyou.php)

11.03.2007 soeren
^ changed the product list price form to use nice MessageBoxes from ExtJS
^ changed from YUI-EXT 0.33 to new ExtJS (1.0 alpha3 Rev 1, by same author)

08.03.2007 soeren

# Prevention for negative cart values upon using a constant value coupon (ps_coupon.php, http://virtuemart.net/index.php?option=com_smf&Itemid=71&topic=20840.msg51002#msg51002)

03.03.2007 gregdev
+ Added Tigra Tree category menu

01.03.2007 gregdev
^ optimized category tree creation
 
26.02.2007 gregdev

^ moved account.billing, account.orders, and account.shipping into templates
# changed ps_shopper->update to return to $page on error, rather than just checkout.index 

23.02.2007 soeren

^ updated YUI to version 2.2.0
^ updated Scriptaculous to version 1.7.0
^ updated Prototype to version 1.5.0
# changing the ENCODE_KEY would re-encode the encrpyted data even if writing the configuration file fails and the old ENCODE_KEY is NOT changed due to missing file permissions
^ moved Login/Registration Form during Checkout into a template
# submit_form() is not defined on last step in checkout
^ moved Shipping Address form into template

--- VirtueMart 1.1.0 beta1 released (21.02.2007, Rev. 692) ---

21.02.2007 soeren
# mosproductsnap - Fatal Error (only variables should be passed by reference)
+ added "featured=y" and "discounted=y" parameters for the browse page to allow to filter by featured or discounted products

19.02.2007 soeren
# Task #1147 - shop.parameter_search_form.php error with template...
# Task #1161 - Updated PS_Linkpoint should be included in future releases
# Task #1160 - Registration - Empty state list + Fix (ps_html.php)
# Task #1150 - vmcchk=1 breaks SEO URL
# fixed the Product Enquiry Form and split it up into code and template (+added missing language tokens)

16.02.2007 soeren
+ added an algorithm to re-encode encrypted cc numbers and passkeys when the ENCODE_KEY is changed
# fixed the currency converter module to reset the selected alternative currency and return the correct amount
	when failing to retrieve the currency conversion table
+ created a new "vmMainFrame" class to handle stylesheets and scripts and bundle them for "fetchscript.php"
	This way we can remarkably reduce the number of GET Requests for linked scripts and stylesheets
	An instance of the vmMainFrame class is available globally: $vm_mainframe.
	
^ changed the simple attributes' price modifier handling from user-submitted prices to price modifiers retrieved from
	the product's attribute field in the DB. So the [+3.99] price modifiers are not longer part of the
	drop down list, but just the attribute values like "red" or "big".

13.02.2007 soeren

# several fixes for making VirtueMart work with the latest Joomla! 1.5 SVN version
+ implemented new User Registration Types: "Normal Account Creation", "Silent Account Creation", "Optional Account Creation" and "No Account Creation"
	This allows a customer to check out without the need to create an account
	
# fixed the vmcheck redirection not being SEF issue (ps_session.php)
# fixed the user field form and made it compliant to MooTools v1.00


11.02.2007 soeren

^ added input filter ("process" and "safeSQL") to all REQUEST variables when user is no admin or storeadmin
+ added an INT Cast to all variables that can't have other value types than INT or ARRAY(INT)


07.02.2007 soeren

+ added a configuration variable to enable and disable the cookie check (it seems not to be very search-engine friendly)

05.02.2007 soeren
^! completely revised the Checkout Process (WIP!)
	* created templates for all checkout stages
	* allowed to bundle steps to a stage (e.g. ShipTo and Shipping Method or all steps on the same page)
	* removed "CHECKOUT_STYLE" configuration constant, added a new configuration array "VM_CHECKOUT_MODULES"
	* moved customer_info, listing shipping methods, listing payment methods to function inside ps_checkout
		that use templates from the "/templates/checkout" folder
	* fixed the cartUpdate forms in the basket (works now and is standards compliant)
	* jumping between "checkout stages" is possible by using the parameter "checkout_stage".
	
^ added FXX, ROM and BUL to the list of European Countries (function country_in_eu_common_vat_zone, ps_checkout.php)
# fixed some issues with the new mootools and the cart highlighting function
^ Updated Mootools to release v1.00
^ Updated SlimBox to version 1.3

31.01.2007 soeren
# various XHTML standards compliance fixes 
	* added ampReplace function to URL functions in ps_session.php, plus new parameter: encodeAmpersands (default:true) )
	* fixed various wrong tags, missing closing tags and unencoded ampersands
	
30.01.2007 soeren
+ added a new PayFlow Pro class that doesn't need the Payflow Pro SDK installed on the server
# fixed an error that prevented correct storage of the CC number

28.01.2007 soeren
+ added new functions to resend the Download ID and re-enable expired or max-downloaded downloads
! two new function have been added to the function list: insertDownloadsForProduct and mailDownloadId
	####		
	INSERT INTO `jos_vm_function` (`function_id`, `module_id`, `function_name`, `function_class`, `function_method`, `function_description`, `function_perms`) VALUES (185, 2, 'insertDownloadsForProduct', 'ps_order', 'insert_downloads_for_product', '', 'admin'),
	(186, 5, 'mailDownloadId', 'ps_order', 'mail_download_id', '', 'storeadmin,admin');
	####
	
26.01.2007 soeren
# UPS: renamed "UPS Express Saver" to "UPS Saver"
# UPS: merged Deneb's improvements for the UPS module to the trunk
# product changed type parameters subtab at product.froduct_form (thanks Steelrat)

26.01.2007 eaxs
# YUI-EXT stylesheet not displaying Tab Text in IE7
^ some improvements to the "advanced attributes" javascript and system


19.01.2007 soeren
! two new function have been added to the function list: setModulePermissions and setFunctionPermissions
	####
	INSERT INTO `jos_vm_function` (`function_id`, `module_id`, `function_name`, `function_class`, `function_method`, `function_description`, `function_perms`) 
	VALUES (null, 1, 'setModulePermissions', 'ps_module', 'update_permissions', '', 'admin'),
	(null, 1, 'setFunctionPermissions', 'ps_function', 'update_permissions', '', 'admin');	
	####
	
+ added a function <=> user group matrix to the function list, so access restrictions can quickly be changed
+ added a module <=> user group matrix to the module list, so access restrictions can quickly be changed
^ changed the input field "Force HTTPS on which modules?" in the configuration to a multi-select list with all module listed

16.01.2007 soeren
# Task #1100 - Make Manufacturers module work on "Select -> xx" rather than having to click [Search] button (mod_virtuemart_manufacturers.php)
# fixed an XSS vulnerability (ps_cart.php)
# Task #1084 - Memory eating loop when non-available fetching remote files (ps_product_files.php)

12.01.2007 soeren
# updated the YUI library to version 0.12.2
# Fixed the thumbnail creation and naming according to Fedor's post: http://virtuemart.net/index.php?option=com_smf&Itemid=71&topic=24388.msg66188#msg66188


04.01.2007 gregdev
# Fixed check for authorize.net test mode (ps_authorize.php).

19.12.2006 soeren
^ updated the GreyBox script from version 3.45 to 5.16 (check it out: http://orangoo.com/labs/GreyBox/)

12.12.2006 gregdev

^ Added line to virtuemart.xml for the new favicon.ico file.

11.12.2006 soeren

+ added the order edit extension by nfischer, nico and rolf: http://virtuemart.net/index.php?option=com_flyspray&Itemid=91&do=details&task_id=27
	It allows to modify orders and order items after the order has been placed.
	
09.12.2006 soeren
# Task #1045 - ps_product_category::get_navigation_list cannot be called twice! (ps_product_category.php)
# Task #1040 - Redirect after registration (ps_shopper.php)
- removed the PayFlow Pro payment class, it can be downloaded including the necessary SDK from virtuemart.net

07.12.2006 gregdev

^ Added values (all NULL) to sample data install queries for new child-products fields.


02.12.2006 gregdev

# Task #988 - fixed path to noimage file; also changed to use VM_THEMEURL for availability images (product.product_form.php)

01.12.2006 gregdev

# Change css class formField to match formLabel (theme.css)
# Use proper pathway_separator function (account.order_details)

01.12.2006 soeren

# Task #1035 - Sorry, but the Product you\'ve requested wasn\'t found! (shop.product_details.php)
# Task #1012 - Manufacturers in Manufacturer Module List not Alpha sorted

29.11.2006 gregdev

# Adjusted so that updating an existing shipping address does not require a new address name (ps_user_address.php)
# Task #842 - fixed preselected country when editing an existing shipping address  (account.shipto.php)
# Adjusted add and update functions to save billing info for new users and Joomla only (not yet VM) users (ps_user.php)
# Adjustments to account.billing, account.shipping, acount.shipto files to use proper pathway_separator function.

27.11.2006 soeren

# Task #1011 - Cancelled Products get added to Top Ten Module (ps_order.php)

24.11.2006 soeren
# Task #1027 - Error in stock handling (ps_checkout.php)
# Task #1015 - Pathway duplicated in account.billing, account.shipping, account.shipto

23.11.2006 soeren
# Task #1014 - Authorize.net test mode error
+ added pathways and pagetitles to various pages
^ moved the function ps_product_category::pathway_separator() to the vmCommonHTML class, call it by using vmCommonHTML::pathway_separator() now!

17.11.2006 soeren

# cleaned up some old deprecated constants and language tokens
+ added extended javascript-based "simple attribute" handler by Tobias (alias eaxs, http://virtuemart.net/index.php?option=com_smf&Itemid=71&topic=22445.0)


16.11.2006 markcallf

!! DATABASE STRUCTURE CHANGED !!!
	# Marks Child list options
	ALTER TABLE `jos_vm_product` ADD `child_options` varchar(45) default NULL;
	ALTER TABLE `jos_vm_product` ADD `quantity_options` varchar(45) default NULL;
	ALTER TABLE `jos_vm_product` ADD  `child_option_ids` varchar(45) default NULL;
	ALTER TABLE `jos_vm_product` ADD  `product_order_levels` varchar(45) default NULL;
+ added child product list options


10.11.2006 gregdev

#  Fixed duplicate error message when no shipping address is chosen during checkout (Task #972).

08.11.2006 soeren

!! Database Structure changed !!
	###########################
	# Making User Groups dynamic
	###########################
	CREATE TABLE `jos_vm_auth_group` (
	  `group_id` int(11) NOT NULL auto_increment,
	  `group_name` varchar(128) default NULL,
	  `group_level` int(11) default NULL,
	  PRIMARY KEY  (`group_id`)
	) TYPE=MyISAM AUTO_INCREMENT=5 COMMENT='Holds all the user groups' ;
	# these are the default user groups
	INSERT INTO `jos_vm_auth_group` (`group_id`, `group_name`, `group_level`) VALUES (1, 'admin', 0),(2, 'storeadmin', 250),(3, 'shopper', 500),(4, 'demo', 750);
		
	CREATE TABLE `jos_vm_auth_user_group` (
	  `user_id` int(11) NOT NULL default '0',
	  `group_id` int(11) default NULL,
	  PRIMARY KEY  (`user_id`)
	) TYPE=MyISAM COMMENT='Maps the user to user groups';
	INSERT INTO `jos_vm_function` VALUES 
		(NULL, 1, 'usergroupAdd', 'usergroup.class', 'add', 'Add a new user group', 'admin'),
		(NULL, 1, 'usergroupUpdate', 'usergroup.class', 'update', 'Update an user group', 'admin'),
		(NULL, 1, 'usergroupDelete', 'usergroup.class', 'delete', 'Delete an user group', 'admin');
		
+ new user group management (admin.usergroup_form.php, admin.usergroup_list.php)
	
06.11.2006 soeren

# fixed the function form to work with the prototype ajax object
+ coupon code used for the order is stored now and displayed in the admin order details listing
!! DATABASE STRUCTURE CHANGED !!
	# adding coupon code tracking for orders
	ALTER TABLE `jos_vm_orders` ADD `coupon_code` VARCHAR( 32 ) NULL AFTER `coupon_discount` ;
	
# fixed a bug which prevented ordering in product list
^ coloured the editable price fields in the product list: added a CSS class "editable" to the admin.styles.css
^ merged the CSV improvements by RolandH into the CSV files

30.10.2006 soeren

# no title tag displayed for empty categories (shop.browse.php)


27.10.2006 soeren

+ re-integrated the "mini cart" ajax updater on any cart event
^ moved /js/vmAjax.js to /themes/default/theme.js

24-10-2006 soeren

^ moved the deprecated Mambo 4.5.x/Joomla 1.0.x language constants to the language files
+ cart action notices are put into the language files now
# added a header "Content-type: " to the connectiontools class to allow correct character encoding 
	when sending ajaxed content
^ changed the "lightbox" message-windows to these new prototype Windows
^ changed most Ajax-based functions to use Prototype
+ added WindowJS javascript functions: http://prototype-window.xilinus.com/index.html
	these windows look great and work better than the LightBox Windows,
	they can even use effects/animation from scriptaculous
+ added MooTools javascripts
- removed Moo.Fx javascripts
# bug in vmCommonHTML::parseContentByMambots, returns an empty text when this feature is turned off

18-10-2006 gregdev

#  Task #959 — Virtuemart search bot not working properly

17-10-2006 gregdev

#  Task #969 — order_id error in Dutch language file VM vs. 1.0.7
#  Task #973 — Error in mod_product_categories
!# fixed various non-critical XSS vulnerabilities

13-10-2006 gregdev

!# fixed various non-critical XSS vulnerabilities

04-10-2006 gregdev

#  Task #962 — skip_fields not initialized in checkout_register_form.php
#  Task #978 — PHP Short-Tag used in ps_paypal.php
!# fixed various non-critical XSS vulnerabilities QUERY_STRING and shopItemid

02-10-2006 soeren

^ various changes for Joomla! 1.5 compatibility
!# fixed various non-critical XSS vulnerabilities though Itemid parameter

13-09-2006 soeren

+ added the user field type "euvatid", you can now publish such a field and assign users
	who provide a valid EU VAT ID into a different shopper group (than default)
^ the order status codes 'P' (Pending), 'C' (Confirmed) and 'X' (Cancelled) have been declared as "protected order status codes". The code can't be changed or deleted (but the order status name can still be changed, of course!)

+ added an order status description field to the order status form
!!! Database Structure Changed !!!
	######
	# 13.09.2006 Allow Order Status Descriptions
	ALTER TABLE `jos_vm_order_status` ADD `order_status_description` TEXT NOT NULL AFTER `order_status_name`;
	######
	
	
12-09-2006 soeren

!! Small Database Change: Changed an "INDEX" Key to a "PRIMARY" Key in the table jos_vm_category_xref
	# http://virtuemart.net/index.php?option=com_smf&Itemid=71&topic=21452.msg53368#msg53368
	# 12.09.2006 improve category listing performance
	ALTER TABLE `jos_vm_category_xref` DROP INDEX `category_xref_category_child_id` ;
	ALTER TABLE `jos_vm_category_xref` ADD PRIMARY KEY ( `category_child_id` ) ;
		


05-09-2006 soeren

# state list not updating when country selection changed
^ user permission groups are listed in a multi-select box now (function_form and module_form)
^ core function form enhancements: 
	* all available class are listed in a drop-down list
	* function method list is fetched dynamically using ajax, so all available methods of the selected class are listed


03-09-2006 soeren

# Problem downloading larger files, e.g. >16MB (ps_main.php) (http://virtuemart.net/index.php?option=com_smf&Itemid=71&topic=20481.msg53015#msg53015)

02-09-2006 gregdev
# Task #938 - Product list select statement causes MySql out of memory error
# Task #734 - transmenu.php wrong itemid in a first menu level
# Task #933 - Reports fail with RG_EMULATION=0
# Task #870 - Wrong template used for Order Status Change link (ps_order.php)
# Task #868 - missing pathway's style class in Account Maintenance (account.billing.php, account.order_details.php, account.shipto.php, account.shipping.php)
# Task #867 - errors in german language-file
# Task #861 - Control panel when press any button on frontend administration are not displayed. (reportbasic.index.php)

31-08-2006 soeren

^ switched from Behaviour JS to moo.dom to attach events to various elements (http://www.mad4milk.net/entry/moo.dom-easily-target-html-elements)
		(it is much much much smaller by filesize!!)
+ made the usage of the Lightbox for product images optional (see theme configuration!)
+ made the Greybox checkout optional (see theme configuration!)
+ added the LiteBox script to the available Javascripts. 
	Litebox is a lightweight Lightbox derivate using just moo.fx and prototype.lite (see http://www.doknowevil.net/litebox/)

# Task #887 - Minimum Amount for Free Shipping (ps_main.php)
^ EU tax mode implementation by Sam Morris <sam@robots.org.uk>
	(http://virtuemart.net/index.php?option=com_smf&Itemid=71&topic=21124.msg52587#msg52587)
	affected files: ps_checkout.php, ps_product.php, basket.php, admin.show_cfg.php, all language files
# possible errors in tax total calculation when coupons are used in vendor-based tax mode

29-08-2006 soeren

# Task #901 - FileManager's pics > Commas in Tittle bug.
# Task #735 - attributes errors (ps_product.php) - (double currency symbols and price modifiers not adding up when one "price setter" is selected in the attributes)
# Task #839 - "Add to Cart" twice for same product removes product (ps_cart.php)
+ added cache-control / expire / last-modified headers in fetchscript.php and show_image_in_imgtag.php to 
	increase performance by using client caching capabilities
	
^ updated the vmnValidateEmail function to check for correct email addresses (ps_main.php)
+ added name & subject checks for email sending (J! 1.0.11) (ps_main.php)
^ changed the vmSpoofValue function to work with J! 1.0.11 (ps_main.php)

25-08-2006 soeren
# fixed hidden select boxes on "display lightbox"  staying hidden

^ moved a lot of global declarations from virtuemart_parser.php to global.php (what do we have this file for if not for globals ;-) ?)
+ added global variable $vmDir for being able to track different installations of VM in the same Joomla installation
	(this is to be implemented laaaaater on)
+ added function writeThemeConfig to SQL installation/update scripts

22-08-2006 soeren

^ moved /html/coupon.coupon_field.php to /templates/common/couponField.tpl.php
^ products that are already in the cart are increased in quantity now

+ added a PHP script called "fetchscript" that allows us to send gzip-compressed javascripts and stylesheets (when gzip = 1)
	All new Javascripts and Stylesheets are called using fetchscript.php now.
+ added Lighbox2 image links to Flypage + "more images"
+ added waiting list to product form, the storeadmin can decide to notify users about the stock level change or not.

14-08-2006 soeren

+ finished feature to allow customers order in a different currency
# Task #804 - On status change text showing 'rn' instead of CR (ps_order.php)

02-08-2006 soeren

+ template files for the product rating and review part
+ added theme configuration, based on the mosParameters specification
	Themes have a configuration file now: theme.config.php.

27-07-2006 soeren

# Task #850 - Order list not showing all orders

^ moved the functions "validate_image" and "process_images" from the ps_main.php to the new
	class file "imageTools.class.php", class "vmImageTools"
	
25-07-2006 soeren

^ started working on Theming support for VirtueMart. the first steps were
	* created a new directory "components/com_virtuemart/themes" with a "default" theme
	  for the start. Each theme has its own subdirectory with separate directories css, templates and images
	* themes hold a central CSS file called "theme.css", images for "checkout", "availability" and "stars" (more to follow)
	* the file admin.css controls the look of admin styles, mainly used for frontend administration
	* themes can be switched in the shop configuration -
	* the URL and path of the selected theme is stored in two new configuration constants called
		VM_THEMEURL and VM_THEMEPATH
	* all the "template files" have been moved from "administrator/components/com_virtuemart/html/templates" to "components/com_virtuemart/themes/default/templates" where they have the same dir structure as before
	* references from the old image URLs to the new theme-based image URLs have be updated

+ Content Mambots can be used now to parse product and category descriptions 
	=> new configuration constant "VM_CONTENT_PLUGINS_ENABLE"; default: disabled
	
^ Bank account information is only requested now at the "payment method selection" step
	Removed the global configuration switch
^ changed all text input fields for template names (like "shop.flypage") to dropdown lists
	where you can select the right template file.
^ changed the "payment class" input field to a dropdown list where you can select one of the 
	available payment method classes
	
+ added a new directory "currency" for holding different currency converter modules
	the globally used converter is controlled by the constant "VM_CURRENCY_CONVERTER_MODULE"
	the default setting is "convertECB"

22-07-2006 soeren

+ added a workaround for installations where the "Session Save Path" is not writable. 
	VM will try using the global cache path for storing session files instead.

18-07-2006 soeren

# various stability fixes to the "Shared SSL"-Redirect functions.
	It's now possible to jump from https to http and back without loosing
	session information (=cart and login)

28-06-2006 soeren
# Task #780 - VM don't send the confirmation order to user or admin, update status order don't run (ps_affiliate.php)
# Task #817 - relative url is missing server base (ps_product_attribute.php)
# 2Checkout order_total number format corrected
# Task #814 - mysql_escape_string issues (class.inputfilter.php, htmltools.class.php)
# Task #816 - missing "alt" attribute in category images on shop.index.php
^ adjusted login procedure to comply with Joomla 1.0.10 (ps_main.php, checkout.login_form, mod_virtuemart.php)
	+ added new functions called "vmSpoofValue" and "vmSpoofCheck" as used in Joomla 1.0.10
	
22-06-2006 soeren

^ Product Scroller now scrolls left and right with all the products in 1 row


07-06-2006 soeren

# "only variables should be assigned by reference..." errors in the file menuBar.class.php

04-05-2006 soeren

^ featured products module now accepts more than one category ID (comma-separated list possible), thanks to Ben (deneb!)
^ featured products module now randomly sorting featured products

02-05-2006 soeren

! DATABASE STRUCTURE CHANGED: table 'jos_vm_vendor' gets a new field !
	# 02.05.2006 Multi-Currency Feature
	ALTER TABLE `jos_vm_vendor` ADD `vendor_accepted_currencies` TEXT NOT NULL ;
	
	
29-04-2006 soeren

^ changed the tree script to TigraTree for the "Product Folders" list. 
	It builds the tree much faster than the JSCookTree and dTree script and even works with 10.000+ items.
+ Tigra Tree Menu Javacript
# Task #73 - Order Confirm E-Mail - Plain text & html text of Message differ (ps_checkout.php)

26-04-2006 soeren

# Task #729 - additional address links in admin (admin.user_form.php)
# Task #733 - Discount causes error message in Order Details page
+ added the possibility to add a product by product type
# product type form&list missing an object
- pay-download form removed from product form
+ allowing multiple pay-download files per product now (useful when the file size is so large that you need to split up the file)
+ allowing the file manager to manage product (main) images
- FileManager product list

23-04-2006 soeren

+ Now it is possible to easily inform your customers about their order cancellation right
	and your returns policy (as required by law in most european countries!)
	=> added 3 new configuration parameters
	! Update your configuration when updating from an earlier version
# hiding attribute price modifiers when the user has no permission to view prices

20-04-2006 soeren
# Task #722 - Undefined index: coupon_discount in ps_checkout.php
# Task #721 - Trying to get property of non-object in shop.debug.php
# Task #560 - Clone Product with Child Products (added "SHOW" as result-returning-case ps_database.php)
# Task #675 - No permissions to view products after search (virtuemart.searchbot.php)
# Task #698 - Lost password link uses relative link instead of absolute (mod_virtuemart.php)
# Task #707 - Payment method at the end of the checkout is not shown (ps_checkout.php)
# Lightbox fixes for IE
+ dynamic price form in the product list (Click on a price and it loads!)
^ admin product list now showing the prices of the default shopper group

18-04-2006 soeren
+ new vmConnector class (vmConnector.class.php). It can be used to retrieve remote URLs and documents. It tries to 
	use cURL to do the communication when available. When a proxy has been set, the proxy is
	used for all outgoing calls.
	The new function vmconnector::handleCommunication( $url, $postData='' ) is to be used by
	payment and shipping modules. No need anymore to handle that transaction part in the module itself.
+ Possibility to enter Proxy information. This is espcically useful when trying to use
	UPS/USPS on godaddy servers.
	New configuration parameters: VM_PROXY_URL, VM_PROXY_PORT, VM_PROXY_USER, VM_PROXY_PASS
+ Currency Converter implemented. From now on the store converts currencies when necessary.
	If the product price currency is "USD" and the store currency is "EUR", all prices are
	converted using an XML file with the latest rates from the European Central Bank (ECB, function convertECB).
	The XML file is cached and refreshed regularly. See /classes/currency_convert.php.
	You can change the displayed currency in the frontend by adding the parameter "product_currency" to the URL:
	
	index.php?option=com_virtuemart&page=shop.browse&category_id=3&product_currency=EUR
	
	A module to allow changing the displayed currency by selecting one from a list will follow.
	
# Task #705 - Product Type Pagelinks are not working due to wrong $num_rows (product.product_type_list.php)

12-04-2006 soeren

+ "recommend this product to a friend" mod by Benjamin (codename-matrix)
+ new configuration parameters for the review system (minium/maximum comment length...) 
! DATABASE STRUCTURE CHANGED
	^ JoomFish compatibility requires the field "attribute_id" for the table jos_vm_product_attribute, so here it is:
		Thanks, Steven and spookstaz http://virtuemart.net/index.php?option=com_smf&Itemid=71&topic=16124.msg38407#msg38407
	########
	ALTER TABLE `jos_vm_product_attribute` ADD `attribute_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;	
	# Ask a question!
	INSERT INTO `jos_vm_function` VALUES ('', 7, 'productAsk', 'ps_communication', 'mail_question', 'Lets the customer send a question about a specific product.', 'admin,storeadmin,shopper,demo');	
	# Prevent auto-publishing of product reviews
	ALTER TABLE `jos_vm_product_reviews` ADD `review_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;
	ALTER TABLE `jos_vm_product_reviews` ADD `published` CHAR( 1 ) NOT NULL DEFAULT 'Y';
	#########
	
+ "ask a question" - enquiry mod by macallf (http://virtuemart.net/index.php?option=com_smf&Itemid=71&topic=17143.0)
+ new Lightbox javascript added to have a cool modal window during an Ajax request! => http://blog.feedmarker.com/2006/02/12/how-to-make-better-modal-windows-with-lightbox/
+ added Moo.Ajax javascript to provide XMLHttpRequest services (aka Ajax)

10-04-2006 soeren
^ product list now opens a new window to display the product form. Forms are to be "ajaxified" soon.
+ added the famous "Apply" button to all Save/Cancel forms, now it shows: Save / Apply / Cancel
# user fields not allowing userUpdate
# user form not working on Mambo 4.6.0
! DATABASE STRUCTURE CHANGED !
	- some non-critical INDEX corrections
	
04-04-2006 soeren

+ added "Newsletter subscription" to field type list. You can now allow users to subscribe to your newsletter 
	at the time of registration. Currently possible: Letterman subscription (YaNC, ANJEL - who knows how to hook in there?)
^ uploaded images get "real" file names now using product_name,category_name or vendor_name (before it was a random md5 hash)

02-04-2006 soeren

# Task #632 - get_flypage doesn't take into consideration parent products (ps_product.php)
# Task #631 - Customer Unable to Remove Data from Bill To / Ship To Fields
# Task #629 - PayFlow Pro does not handle 4 digit expiration dates gracefully
# Task #511 - Discount % percentage is ignored by cart (ps_product.php)
# Page redirection on error from Ship-To address from fixed, thanks TJ! (account.shipto.php)

29-03-2006 soeren

^ integrated the changes to the authorize.net class by Daniel Wagner (http://virtuemart.net/index.php?option=com_flyspray&do=details&id=634&Itemid=83)
# wrong object names in PayPal notify.php script lead to a fatal error
# Task #656 - "Remember Me" must be enabled to checkout, checkout_registration_form.php
# tooltip function: added charset parameter to encode UTF-8 strings too, htmlTools.class.php
+ introduced a new function called "vmGetCharset" to return the current charset from the _ISO setting (UTF-8 by default), ps_main.php

+ new DHL shipping method integration, thanks to Durian!

!!! DATABASE STRUCTURE CHANGED !!!
	NEW TABLE "jos_vm_shipping_label"
	
+ customer name on oder list

28-03-2006 soeren
# query error in ps_affiliate.php
# fixed reviews listing ("More..." - link when more than 5 reviews exist for a product) in the frontend (ps_reviews.php)
# fixed page navigation on product review list in adminsitration (product.review_list.php)
+ customer name on order list (thanks to deneb!), (order.order_list.php)
# Fixed PayPal notify.php script:
	- wrong field name (` order_currency` instead of `order_currency`)
	- checking received currency and amount against database
# parameter search query missing a `

27-03-2006 soeren

# version.php causing fatal error regarding "class vmVersion previously declared..."
# Prices visible to all users, although restricted
# Admin Menu not visible with chinese language file (htmlentities missing third (=Charset) parameter)
# CSV Export doesn't export parent product SKU (parent-child relationship gets lost)
# fixed a small typo in the product scroller module

---- VirtueMart 1.0.4 released ----

23-03-2006 soeren

# Order "Print View" link lead to a 404 error
+ ProductScroller module: added the category_id parameter to the XML file, so you can now specify a category_id (or a comma-separated list of more than one category_id) 
	to filter the products by (multiple) category/ies
# Product Reviews are not added to the database, although the vote is added
	
20-03-2006 soeren
^ Payment method preselecection: the first displayed payment method is always pre-selected now
# "delete from cart" fails when the custom attribute value contains quotes
# can't assign more than one product type to a product
# Task #622 - Order Update Time is Wrong
# Task #601 - Show the Number of Products in a Category
+ for debugging: added '@ini_set( 'display_errors', 1 );' to virtuemart_parser.php
	for making PHP errors visible
^ changed behaviour for HTTPS links when in HTTPS mode.
	When the user is NOT on "checkout" or "account" pages, all links are generated using the http://... URL
	This will allow leaving the HTTPS mode 2 after the order has been placed.
# Task #490 - adding attributes error on sub-items
# Task #518 - Reports miss same-day orders
# Task #558 - Bug in report basic module
^ showing "no image" image when a product thumbnail image is not available
# Task #470 - Close tablerow after Categorylisting
+ products can be viewed using the SKU now. Works for the product details page:
	Instead of "&product_id=XX" just use "&sku=YY" where YY stands for the SKU of the product
# credit card number not checked on form submit, another bug, same reason: payment method can be left unchecked
+ added: autocomplete="off" to the credit card form to prevent sensible information being prefilled
+ Order item status update by manelzaera
# Task #617 - Wrong image path in account.billing.php
# Task #615 - Cannot add multiple Product Types to a Product

15-03-2006 soeren

+ direct link to global configuration from shop configuration (where the Joomla registration settings are shown) 
+ new configuration variable: VM_SHOW_REMEMBER_ME_BOX (you can now choose whether the "Remember me" box is shown
	on login or the usercookie is forced with a hidden field.)
+ new configuration variables for better being able to switch between http and https:
	VM_GENERALLY_PREVENT_HTTPS - allows to get back from https to http in areas, where https is not necessary (as it only slows down the connection)
	VM_MODULES_FORCE_HTTPS - allows you to specify a list of shop areas (= shop core modules, e.g. account,checkout,...) where https connections are forced
# Session class fixes ( session_id( ... ) is no longer used, from now on we just don't care about the Joomla/Mambo session ID)
	
12-03-2006 soeren

# users, who are logged in, but not yet registered as customer/shopper 
        can't directly continue their "checkout" after registration as shopper
# users who are logged in, but have an empty "usertype" field don't see prices
# added $manufacturer_id support for caching pages
28-03-2006 soeren
# query error in ps_affiliate.php
# fixed reviews listing ("More..." - link when more than 5 reviews exist for a product) in the frontend (ps_reviews.php)
# fixed page navigation on product review list in adminsitration (product.review_list.php)
+ customer name on order list (thanks to deneb!), (order.order_list.php)
# Fixed PayPal notify.php script:
	- wrong field name (` order_currency` instead of `order_currency`)
	- checking received currency and amount against database
# parameter search query missing a `
11-03-2006 soeren
# syntax error in shipping.rate_form.php

10-03-2006 soeren
# Task #325 Log out does not work
# missing $mosConfig_absolute_path in currency_convert.php

07-03-2006 soeren
# many short tag fixes (< ? => < ?php )
# Task #566 - DescOrderBy doesn't work with SEF
# more ps_session class fixes to work on Joomla 1.0.8 & Mambo 4.6
        seems to me as if some Joomla 1.0.8 users are suffering serious Session problems now
^ setting memory_limit to 16M when it is lower
+ multiple tax rate details in order email

04-03-2006 soeren
# short php tags in shop.manufacturer_page.php
# Task #551 - Cart showing extra products after adding first item
# Task #562 - Discount deletion problem

02-03-2006 soeren
# Task #432 - missing ST address in order_user_info when using default address
# Task #482 - error with multiple mod_virtuemart
# Task #541 - IE gets error in admin orders
# View by Manufacturer: Products without prices not shown
+ new global variable $VM_BROWSE_ORDERBY_FIELDS, contains all sort-by fields for the browse page
^ moved $orderby code to shop.browse.php and shop_browse_queries.php
+ new configuration constant: VM_BROWSE_ORDERBY_FIELD can be [product_name|product_price|product_cdate|product_sku]
+ added "ob_start" to the session class to prevent HTML output BEFORE the template is loaded ( Task #553 - Product Display)
^ tax rates in drop-down list in product form are ordered by rate, descending now

28-02-2006 soeren

# tax total calculated based on product tax rate when TAX_MODE = 1 (store-address based tax mode)
# Task #536 - vendor info page error
# page navigation on browse pages contained the live site URL.

22-02-2006 soeren

# standard shipping module doing wrong number_format when amount is greater than 999.99
# fixed: multiple tax rates / subtotal re-calculation when discounts are applied
# ps_product_category::get_cid => category ID query not executed
# attribute prices being displayed without tax, although "show prices including tax" is active
# totals getting stored without decimals: changed "setlocale( LC_NUMERIC, 'en' )" to "setlocale( LC_NUMERIC, 'en_US' )"
+ page title on order details page in account maintenance
# checkout login form using sefRelToAbs for $return
^ using the same "Add-to-cart" image as in product_details in browse page now
# tax rates were stored with 0.0000 value

! DATABASE STRUCTURE CHANGED 
---
        # http://virtuemart.net/index.php?option=com_flyspray&Itemid=83&do=details&id=521
        ALTER TABLE `jos_vm_product_mf_xref` CHANGE `product_id` `product_id` INT( 11 ) NULL DEFAULT NULL 
        
        # Store multiple-tax-rates details for each order when applicable
        ALTER TABLE `jos_vm_orders` ADD `order_tax_details` TEXT NOT NULL AFTER `order_tax` ;
---


21-02-2006 soeren

# Task #525 - USPS shipping module: User details SQL query
# order email: text part had ugly HTML entities in it (e.g. &euro; )
^ file downloads (paid downloads): reading and sending the file is now handled by a new function 
        (previously: readfile, now: vmReadFileChunked )
# fixes for compatibility with Joomla 1.1.x, still maintaining backwards compatibility with Mambo
        - added $vmInputFilter to global declaration list in virtuemart.php
        - virtuemart module dealing with wrong module paths
        - ps_perm needed its own ACL manipulation methods
        - ps_session doesn't need to append "&Itemid=" in the backend
        
17-02-2006 soeren

# When price field left empty and product had no price, a price record (0) was added.
# Task #456 - Foreign adress give error on checkout
	If you leave the ZIP start or end fields empty, automatically "00000" or "99999"
	is inserted. This was a trap for many users.
# Task #515 - Problem with Authorize.net after upgrade
# Task #519 - Fatal error when adding a manufacturer
# linkpoint class using wrong user information query (ps_linkpoint.php)
# order list query error
+ order and user list can be filtered by full name now 
        (before it was possible to search for the first name OR the last name, not both at the same time)
        
14-02-2006 soeren
# Task #480 - Various Errors (one fatal) in vm_dtree.php
# Task #514 - add to cart URL does not always work
# Task #509 - Deleting manufacturer bug
# Task #495 - Related products list doesn't update with new products: 
        now displaying 2000 related products instead of 1000.
# Task #455 - Silent user registration not working ($mosConfig_useractivation issue)
# Task #474 - Changing default flypage is broken
# Task #473 - Free Shipping broken: SQL statement in global.php
# Task #471 - The script sleight.js isn't loaded when SEF URLs is on
# Task #468 - wrong variable in standard_shipping.php

08-02-2006 soeren
# Task #486 - HTTPS Error In Virtuemart.cfg.php (not every server uses port 443 for secure connections)
        changed ** $_SERVER['SERVER_PORT] == 443 ** to ** @$_SERVER['HTTPS'] == 'on' **
# authorize.net: Strip off quotes from the first response field to be sure the correct response is received

03-02-2006 mdennerlein
# fixed bug in vmCommonHTML::getYesNoIcon which always returned published icon

28-01-2006 soeren
# Shoppers / Users couldn't be deleted.

27-01-2006 soeren

+ order list at user form! (Thanks to Qazazz! http://virtuemart.net/index.php?option=com_smf&Itemid=71&topic=14001.msg26715#msg26715)
^ FedEx: basic implementation of FedEx' service "Rate available Services" finished
        You can now use FedEx to fetch and list available shipping rates
        
[---- VirtueMart 1.0.2 released ----]

19-01-2006 soeren
# Deleting a product didn't delete the product <-> product type relationship,
        so you couldn't delete the product type

16-01-2006 soeren
# Task #443 - Registration not possible with .info domain
# Task #418 - Can't assign multiple product types to a product
# Task #417 - Changing status to 'C' for auth net settle del. trans ID!
# product list not showing all search options
# Task 412 - no tax on attributes
# Task 413 -  wrong price on details page when using quantity-based prices
# Using recent Itemid instead of 1, when the Shop has no own Itemid
+ added Australia Post shipping module by Ben Wilson (ben@diversionware.com.au)
# mosproductsnapshot Mambot wouldn't correctly display linked images
+ Download ID "hack" by Eugene, scott, joomlasolutions!
        Customers can get their download IDs for downloading files
        directly from the order details page (products are linked)
+ showing filesize for files which are listed on the product details page (by djlongy)
        directly from the order details page (products are linked)
+ showing filesize for files which are listed on the product details page (by djlongy)


11-01-2006 soeren
+ when Caching is on, cached pages are watermarked with a timestamp ("Last updated: Wednesday, 11 January 2006 16:31") like we know from eBay
+ FedEx shipping module integration begun
# fixed minor issues with the new userfield registration system
# Task #435 - Link to component class
# Task #433 - Blocked message (popup) on registration
# Task #432 - missing ST address in order_user_info when using default address
# Task #431 - Pricelist doesn't show prices

 
09-01-2006 soeren
^ Payment method discounts/fees: Implemented a percentage discount...
        You can now charge the customer a certain percentage of the order total

        ! DATABASE STRUCTURE CHANGED: table jos_vm_payment_method
          Added 3 new fields to that table to allow percentage discounts

05-01-2006 soeren
# Task #430 - ToolTip Error when use Chinese
^ Task #427 - Add To Cart button in Browse uses Joomla button CSS.

27-12-2005 soeren
^! changed the structure of the table jos_vm_userfield_values: added a column "fieldvalue"
        for being able to list fieldtitles in an option list, using fieldvalue in the value="" attribute
        For staying up-to-date in CVS: "ALTER TABLE `jos_vm_userfield_value ADD `fieldvalue` varchar(255) NOT NULL"
# mod_productscroller not using category ID for filtering products


22-12-2005 soeren
+ new HelpTip from WebFx (http://webfx.eae.net/dhtml/helptip/helptip.html)
        this javascript allows displaying details of products in a box that 
        can be shown and hidden and doesnt vanish on mouse scrolling (used on CSV Upload)
        Usage: echo vmHelpToolTip( "My tip in the box", "The link text" );
+ step-by-step import on CSV Upload
+ CSV Upload simulation: uploaded CSV files are not instantly imported, but the
        import first is simulated and the results are shown to the user
^ admin dropdown menu now is able to display special characters (e.g. dutch and german special chars)

20-12-2005 soeren
+ showing End-User price in the admin's product list now
^ thumbnail generation: improved JPG quality, allowing gif thumbnails now
^ removed the coupon form from "shop.cart"
# order list: searching by user names won't work
^ improved "Continue shopping" link in the cart, now redirects to "shop.browse" or isn't visible when just the cart was viewed
+ new "Move Products" feature lets you move products from one category to another
# manufacturer can't be deleted although it has no real products assigned to it
^ browse page now is ordering products by product list order when a category is selected
+ added product reordering feature (a category must be selected in the product list, then you'll see the reorder fields)
^ fixed problem saving a manufacturer (category) with ' in name or description
^ moved function list_perms from class ps_user to class ps_perm
- removed property "permissions" from class ps_user

+ first version of the new "user fields" management system
!! DATABASE STRUCTURE CHANGED:  two new tables  !!
!! see /sql/UPDATE-SCRIPT_VM_1.0.x_to_1.1.0.sql                 !!

^ silently registered users don't have to remember their old usernames now (Task #385 returning hidden/silent users can't use the same email address)


16-12-2005 schirmer
+ New feature to easily translate the flypage using {vm_lang:xxx} place holder. Usage instructions in html/shop.product_details.php

15-12-2005 soeren
# product prices can be zero or empty now. When the product price is left empty in the product form, an existing price will be deleted and no price will be added.
# Tax total is zero although user's country/state combinination has a matching tax rate record (when CHECKOUT_STYLE = 3 or 4)
# Task #364 "thank you for your patience...": wrong Waiting list link
# Task #386 "New user couldn't be added"

10-12-2005 soeren
# currency_convert including wrong DOMIT files.
# user list has no valid user id in the delete link (deleting didn't work)

07-12-2005 soeren
# Task #63: Prices are stored in the session and do not change on update
# wrong xhtml syntax in mod_virtuemart_search
# Task #374: Incorrect "Title" wording on [Featured & Discounted Products] Screen
# Task #372: Product Search doesn't work when Joomla Caching is ON
	(product search pages were cached, so the search function could only be used once)

04-12-2005 soeren
# "product_list" search not working, when a category is selected
^ Extra Fields are now visually integrated in the registration form, not appended at the end
^ more debug output in standard_shipping module (only when DEBUG is turned on)

01-12-2005 soeren
^ attributes are formatted now in the order print screen - just as in the frontend
+ attributes of child products (which were selected by the customer) are stored now which each order
# fixed a bug in the frontend order listing (account maintenance section), which showed no search box and page navigation
# fixed a bug in global.php, where an administrator, which has no record in the table
  jos_vm_auth_user_vendor wouldn't get the vendor information (and see prices in the backend with no decimals)


30-11-2005 soeren
# added a routine to unpublish mambo-phpShop mambots on upgrade
# added checks for the existance of files which are to be loaded
# added a check if $ps_shopper_group is an instantiated ps_shopper_group object to admin.user_form.php
# renamed all occurences of $PHP_SELF to $_SERVER['PHP_SELF']
# fixed a bug in the page navigation on the browse page (document.adminForm is null or not an object)

---- VirtueMart 1.0.1 released ----

28-11-2005 soeren
^ renamed the vmLog function 'flush' to 'printLog' to prevent early flushing (was it caused by the function name?? would be another curious php bug)
! wrong error handling when a user is not allowed to view the requested page (Security Issue).
# wrong featured products links on storeadmin homepage
# PDF output not working
# calling html_entity_decode with an empty string crashed Apache and VM (class.phpinputfilter.php)
 
24-11-2005 soeren
# setlocale( LC_NUMERIC, 'en' ) is used globally for ensuring that numbers are handled with decimal points
# fixed a parser error in the random products module

---- VirtueMart 1.0.0 final released ----

23-11-2005 soeren
# vmPopUpLink generating window with same value for width and height
# removed whitepace at the end of ps_main.php
# even when no discount was selected in the product form, a discounted end price was filled in
# when user is assigned to a Shoppergroup which doesn't exist, the default one is used now (thanks to esteve!)
# CSV-Export: removed export of "product_special" field, because it's not included in the default CSV configuration
# CSV-Export running incorrect query (empty file received)

21-11-2005 soeren
# filenames didn't include the full path
# problem with filemanager: "The request file wasn't found"
^ small DB structure change to allow negative quantities for "jos_vm_product.product_in_stock" (just removed the UNSIGNED attribute)
	ALTER TABLE `jos_vm_product` CHANGE `product_in_stock` `product_in_stock` INT( 11 ) NULL DEFAULT NULL;
# wrong height of full-image-popUp-window in product details
^ (or bug fix?): added ob_start according to this bug report: http://virtuemart.net/index.php?option=com_flyspray&Itemid=83&do=details&id=300
^ fixed the laoyut for IE in "Your store::control panel"
+ added login form to account maintenance pages to allow quick login

17-11-2005 soeren
^ removed the "VirtueMart already installed?" check to allow manual installation.
^ extended ps_html::writableIndicator to process arrays with more than one directory
+ integrated Verisign Payflow Pro payment module into VirtueMart

16-11-2005 soeren

^ splitted up and renamed "/sql/virtuemart.installation.mysql.sql"
	into "/sql/virtuemart.installation.joomla.sql"
	and "/sql/virtuemart.installation.mambo.sql"
	for those users WHO DON'T EVEN LOOK INTO THE FILE THEY ARE UPLOADING IN PHPMYADMIN.
	
^ updated the INSTALLATION.php to be able to distribute a "Manual Installation" package,
	where it is added to as "README.txt"
# authorize.net not getting the correct billto address
^ improved the debug and error message reporting in authorize.net payment module

16-11-2005 schirmer
# switched to vmLogger in payment and shipping modules
# switched to new user_info table in payment and shipping modules


15-11-2005 soeren
# fixed a small bug in the ps_shopper.php
+ new: bulgarian language file
# "Credit Card type not found" error would prevent checkout.

12-11-2005 soeren
# users couldn't rename their username in account maintenance (ps_shopper.php)
# small notices in ps_checkout.php

10-11-2005 schirmer
# renamed 'Log' to 'vmLog' in virtuemart_parser.php

09-11-2005 soeren
# fatal error: prices can't be deleted (ps_product_price.php, product.product_price_list.php)
# renamed class 'Log' to 'vmLog'
# standard shipping module not accepting valid rates onValidate

---- 1.0.0 RC3 released ----

08-11-2005 soeren
# installation displays a log now
# installation would copy files with wrong permissions on upgrade
# product list empty when browsing child products of a product from pages no. >= 2
# ps_checkout typos
# "Empty Cart" - fixed a bug where the session id would have been changed on each page load
	what made keeping items in the cart impossible
	
07-11-2005 soeren

# task #252 (Japanese Yen Currency symbol affects attribute list line break)
# unpublished products were counted in "products in category".
# task #249 (a bug with html_entity_decode ("Warning.....MBCS not implemented"))
# fixed a small notice in vm_dtree.php

---- 1.0.0 RC2 released ----

06-11-2005 soeren
# changed all occurences to 'com_phpshop' to 'com_virtuemart' in payment methods
# bug #164 (Admin doesn't accept any input and doesn't change pages)
# fixed a fatal error in the install.php

04-11-2005 soeren
# when updating the order status from the order list, always a customer notification would be sent
# the Altbody (alternative text part of an email) is utf8_encoded now,
	when the language charset is 'utf-8' (standard in all new language files in joomla!)
+ Manufacturer ID is shown in manufacturer_list now
+ added search by product_sku to searchbot
^ payment method and shipping method are validated again on orderAdd
# fixed the shipping_rate_id validation in the standard_shipping module
# moved the coupon field back into the cart
# wrong names for new customers in overview
- removed the table prefix replacing function from ps_database
^ changed the url formatting function ps_session::url to use $mm_action_url instead of URL
# more fixes to the Shared SSL support (it now logs the user in on the https domain, even when Joomla is used)


02-11-2005 soeren
# fatal error in payment method form in frontend
# passkey change code didn't work (e.g. authorize.net)
# admin top menu didn't show up when quotes in a module name
# usps module referenced wrong DOMIT! path
# coupon add didn't work
# wrong rounding of the subtotal field
! table structure changed!
	#####
	ALTER TABLE `jos_vm_orders` 
	CHANGE `order_subtotal` `order_subtotal` DECIMAL( 10, 5 ) NULL DEFAULT NULL;
	#####
^ refreshed paypal code (removed tax field, charging amount=subtotal+tax and shipping now).
	
01-11-2005 soeren
# category_flypage was 'flypage' regardless of the category setting (changed ps_DB::sf() )
^ changed coupon field to be displayed only on the payment method selection screen
# percentage coupon was miscalculated on quantity update in cart (thanks gwen)
^ currency symbol in store form is now stored as HTML entity (?  => &euro; )
^ payment methods are surrounded by fieldsets now

28-10-2005 soeren
# changed shopmakeHtmlSafe to use hmtlspecialchars instead of htmlentities
# fixed a lot of queries using a database object instead of ps_DB
# replaced all occurences of mosToolTip by mm_ToolTip
# tax rate is automatically divided by 100 when larger than 1.0
# "view more images" wasn't shown on product details, view_images page had SQL errors

27-10-2005 soeren
# fixed a bug in ps_order.php, where the mail would have been sent to '' (nobody)
# some fixes for the wz_tooltip (using htmlentities now)
^ page navigation links only show up when more results are there to display than $limit
+ added page navigation to order list in account maintenance section
+ added tax amount to paypal payment form code
# fixed a big bug in the SQL update of the user data to VirtueMart
+ added quick (un)publish feature to category and payment method list
- files admin.user.hmtl.php, store.user.html.php
^ restricted access to the user list & form to conform with joomla's user component access
+ added new class vmAbstractObject
+ added new handlePublishState function (class vmAbstractObject)
^ changed productPublish function to handlePublishState
! Database table entry changed: 
##############
UPDATE `jos_vm_function` SET `function_name` = 'changePublishState',
`function_class` = 'vmAbstractObject.class',
`function_method` = 'handlePublishState',
`function_description` = 'Changes the publish field of an item, so that it can be published or unpublished easily.' WHERE `function_id` =139 LIMIT 1 ;
##############

26-10-2005 soeren
+ added debugging to image upload function
# Bug #181 ? Can't add new prices to product

25-10-2005 soeren
# Bug #174 ? Checkout using USPS Module, fixed path to xml domit! library
^ renamed /html/VERSION.php to /html/footer.php
^ changed the colors of the order list to joomla css classes (account maintance section)
# FR #127 font size in tab headings too big in safari browser
+ added new language tokens for the Log integration
# Bug #166 ? virtuemart-beta4-shared SSL
# Bug #173 - Registration with e-mails over 25 characters
# bug #176 - beta4: message tax included displayed even if OFF
^ FR #125 vendor name in shopper group drop-down

24-10-2005 soeren
# fixed a bug where "my-email-address@domain.com" couldn't be used for username (converting - to _ now)
^ file uploading errors are handled better now
+ introduced new global Log object for better Error Message Handling
	See http://pear.php.net/package/Log for docs.
	The class and its child classes can be found in /classes/Log. VM uses a modified version
	of the display class. Support for buffering and formatting depending on priority was added.

	
22-20-2005 soeren
+ added ability to change username + password through shop's billing form
# waiting list extension printing errors...

20-10-2005 soeren
# fixed various bugs in modules (vm_dtree, vm_transmenu, vm_JSCook, vm_product_categories, vm_productscroller)
# category_id is lost when (un)publishing a product directly from the product list

19-10-2005 soeren
# fixed session debug messages, a session isn't started in the backend now
# fixed various installation / update bugs
^ changed Mail functions
	* renamed mShop_Mailer to vmMailer
	* added the functions vmMail (similar to mosMail) and vmCreateMail( similar to mosCreateMail)
	* line-ending fix for Mac & Win problems sending mail (Could not instatiate mail function)
	
# made labels for payment methods clickable
# fixed bug #137 'unpublished products can become related products'

=======
19-10-2005 schirmer
#  fixed Top10 module showing products multiple times if it has more than one category


18-10-2005 soeren
^ Changed the field jos_vm_order_item.product_item_price from DECIMAL(10,2) to DECIMAL(10,5) to prevent rounding errors
##########
ALTER TABLE `mos_vm_order_item` CHANGE `product_item_price` `product_item_price` DECIMAL( 10, 5 ) NULL DEFAULT NULL;
##########

+ re-added shop.registration.php (includes login form and registration form)
# changed cart initialitation function from "ps_cart" to "initCart"
# fixed bug #135 Cannot use a scalar value as an array
# bug in product folder view
^ introduced new blue icons
# bug in product file form + filemanager

17-10-2005 soeren
# user registration required email, although no email field was there
# credit card payment wasn't recognized correctly on order details screens
^ added Credit Card details to order confirmation email
^ last 4 digits of a Credit Card number are masked by asterisks now (security!) in administration
# fixed the PDF function (a file was missing php code), updated HTML2FPDF to version 3.02beta
# prices from advanced attribute field didn't include shopper group discount, 
  when the price was set to a fixed price ( Color,blue,green[=45.00]; )
# dtree module crashed - missing global $db declaration

14-10-2005 soeren
# On registration an error from the Joomla registration function would empty all fields
+ added new Version check link to admin section
# keyword length is restricted to 50 from now on (security), prevents 10000 characters long keyword via URL 

12-10-2005 soeren
# wz_tooltip.js is included now whenever mm_ToolTip was called
^ The registration & billto form have been completely rewritten
	The are built out of a loop now, that runs through an array with all fields and 
	marks required fields. This prepares the integration of	a form & field management 
	component! You can already now easily re-arrange the fields by changing their order.
+ Added complete JS validation to the registration / billto forms
	Uses ps_userfield::printJS_formvalidation() to print a JS form validation function
	
11-10-2005 soeren
# fixed a bug in the shopper-registration of a registered user
+ added SwitchCard support to CC numbers validation

10-10-2005 soeren
^ moved to class vmInputFiler to prevent SQL injection
	(we always had our own basic protection against that, but vmInputFilter was especially made for that)
	To secure a variable just use $variable = $vmInputFilter->safeSQL( $variable );
# fixed a dumb bug in the function ps_product_attributes::cartGetAttributes
	(allowed to add products without choosing attributes)
^ moved ACL code for 'show_prices' authentication into ps_perm::prepareACL()
^ moved cart initialization code into a new constructor for ps_cart
^ moved Session initialization code into ps_session::initSession(); a new constructor calls this on class instantiation

09-10-2005 soeren
+ new Configuration parameter VM_SILENT_REGISTRATION
	allows users to "silently" register into Mambo/Joomla
	means they don't have to fill in a username and password at the registration.
! you can use the configuration panel to set this value; default: 1 (=enabled)

08-10-2005 soeren
+ added new configuration parameter VM_PRICE_ACCESS_LEVEL
	The value is the name of a Joomla user group, default: "Public Frontend"
	It can be used to restrict the price display to certian membergroups (including their childs)
+ added new configuration parameter VM_PRICE_SHOW_INCLUDINGTAX
	A flag to turn on or off the message (including 8.5% tax) behind a price display
+ added new configuration parameter VM_PRICE_SHOW_PACKAGING_PRICELABEL
	A flag to switch between usual price labels or packaging price labels (which are used, when Packaging Units are set)
^ re-arranged fields in the configuration panel

07-10-2005 soeren
+ new function vmPopupLink to quickly generate a JS + XHTML compliant link
# TopTen module optimized (ran 11 queries before on 10 products, now ONE)

06-10-2005 soeren
^ updated the PayPal Form Code according to this post (http://mambo-phpshop.net/index.php?option=com_smf&Itemid=71&topic=11167.msg21226#msg21226)

06-10-2005 schirmer
# tax list optional with onChange field. product_form automatically edits the price fields if tax is changed.
# public frontend fixed. New menu buttons didn't send admin state pshop_mode variable.

06-10-2005 schirmer
# typos in install script
# missing / in dummy phpshop file

05-10-2005 soeren
+ added new product discount "overrides" to the product form which can be used to
	fill in a discounted end user price, from which a discount will be calculated and added to the product discount list
# fixed a bug in install.php
+ added a new CVS module 'build_scripts', so you can build your installers


04-10-2005 soeren
^ moved the Shipping Rates and Carriers of the standard shipping module into sample data file
^ the class ps_user registers users into VirtueMart (function for admins!)
^ the class ps_shopper registers Shoppers into VirtueMart (function add for Shoppers)
^ Changed the registration process to use the registration component of Mambo/Joomla
- file shop.registration.php
! User Management no longer uses modified Mambo files, but includes needed functions.
- file admin.users.html.php

04-10-2005 schirmer
^ Updated Montrada payment class for VirtueMart
# Minor fix in url generation in ps_session. If option is specified com_virtuemart will not be appended.
# Category count now displays correct count for vendors
# Error messages from ps_product now are space seperated for better readability

01-10-2005 soeren
- Removed many fields from the table jos_vm_modules which are not longer necessary (and were actually never needed)
! Updated all SQL files and the Installation script
! Beginning to change the code to not to use mos_users table for customer information
! ### Database Structure Changes ### ! 
	Details: /sql/UPDATE-SCRIPT_mambo-phpshop_1.2_stable-pl3_to_VirtueMart_1.0.sql

^ Changed all tooltips to use wz_tooltip, this gives always working tooltips - even on tabbed forms
+ added JS ToolTip by Walter Zorn to VirtueMart


30-09-2005 schirmer
# frontend administration can't load page
# missing pshop_mode=admin in inventory for links
# ps_affiliate undefined index afid on checkout in register_sale function
^ list_year in ps_html changed to dynamic year list
# store.index only shows apropriate options and information. no links to unusable modules or non-vendor specific stats
# fixed duplicate files listed on flypage

29-09-2005
- updated all files to use com_virtuemart as path
- updated all queries to use {vm} as shop table prefix
- Changed $PHPSHOP_LANG to $VM_LANG
- fixed product file listing
- renamed *phpshop*.php to *virtuemart*.php
- added "update to virtuemart" routines to install.php

27-09-2005
- Domit! libraries are not longer included in VirtueMart, Mambo provides them
# WYSIWYG Editor not loading in frontend admin
^ Frontend Administration uses the backend toolbar now (shared administration)
^ changed the file headers of all files to carry the new name (VirtueMart) and a copyright notice

26-09-2005 soeren
# fixed the "product inventory" and "special products" list

25-09-2005 soeren
! configuration constant SEARCH_ROWS (deprecated) is to be replaced by $mosConfig_list_limit
- removed Mail configuration from configuration form (dropping support for Mambo < 4.5.1 )
- removed configuration constant MAX_ROWS.
^ changed the configuration file (virtuemart.cfg.php) to build URLs and Paths from Mambo configuration variables
  This means that you don't have to adjust your configuration file when moving a site.
^ updated all forms to use the new formFactory class and it's methods
+ new class formFactory for managing common form tasks in all administration forms in virtuemart

18-09-2005 soeren
^ Language files are updated. Language Strings can be returned as HTML Entity-encoded Strings.
	* class vmAbstractLanguage is the base class for all language files.
	* function _() returns an html entity-encoded string
! language classes extend class vmAbstractLanguage from now on. mosAbstractClass is deprecated.
- file mos_4.6_code.php will be removed.
	* vmAbstractLanguage & mosAbstractLanguage class moved into language.class.php
	* mosMailer / mosCommonHTML compat code moved into ps_main.php

13-09-2005 soeren
+ changed the product files list to show images in a tooltip
# added code to prevent that manufacturers are deleted which still have products assigned to it
# changed virtuemart_parser.php not to be greedy on variables when $option is NOT "com_virtuemart"
	this should fix conflicts with variables of the same name used by other components
^ Updated the toolbar to allow batch delete / (un)publishing of items in lists
^ Changed complete page navigation to Mambo style (also remembers list positions!)
# Product Quantity wasn't updated in cart when adding the same product again
! functions search_header and search_footer will be removed. Don't use them. Use the class listFactory and its methods instead.
^ changed all shop administration lists to use the new class listFactory. No more HTML Code in those lists!
+ added new file "htmlTools.class.php" containing a listFactory for admin lists
+ added new file "pageNavigation.class.php" (copy of the administrator/includes/pageNavigation.php)
+ added new file "/js/functions.js" for JS functions in the administration area

06-09-2005 soeren
^ mod_virtuemart: changed the default value for "Pre-Text" to "" (empty!)
# product search not handling keywords as separate search words, but as one (normal search)

01-09-2005 soeren

+ added a CSS file called shop.css to /css: will control all shop specific layout in the future
^ moved some program logic from virtuemart_parser.php to their appropriate classes


31-08-2005 soeren
# products with a single quote (') didn't have a visible product image
^ upated the CSV documentation
^ product form: moved the discount drop-down list to product information tab
	added a check to test if the IMAGEPATH is writable (see Tab "product images")
# Custom Attribute Values would allow the customer to alter the product price (thanks to "Ary Group" <AryGroup@ua.fm> for reporting that)

=======
26-08-2005 Zdenek Dvorak
+ Now is possible use EXTRA FIELDS in user_info. Just set variable _PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_X (where X is from 1 to 5)
  in language file and new input field will be shown in user's billing and shipping address form and in order details. Size of 
  extra field 1, 2 and 3 is 255 chars. Size of extra field 4 and 5 is one char and they are shown as input select field.
  For reasonable using extra field 4 and 5 is needed change items of input select in functions list_extra_field_4 
  and list_extra_field_5 in file classes/ps_html.php.
  You can change position of this fields in form in files: account.shipto.php account.billing.php account.order_details.php 
  admin.users.html.php admin.user_address_form.php
+ User info in order includes EXTRA FIELDS. ## REQUIRES a DATABASE UPDATE! ##
^ ## Database structure changed ##
  ALTER TABLE mos_{vm}_order_user_info ADD  `extra_field_1` varchar(255) default NULL;
  ALTER TABLE mos_{vm}_order_user_info ADD  `extra_field_2` varchar(255) default NULL;
  ALTER TABLE mos_{vm}_order_user_info ADD  `extra_field_3` varchar(255) default NULL;
  ALTER TABLE mos_{vm}_order_user_info ADD  `extra_field_4` char(1) default NULL;
  ALTER TABLE mos_{vm}_order_user_info ADD  `extra_field_5` char(1) default NULL;
+ New input field in user's shipping and billing address: phone_2
# wrong address_type in file account.shipto.php
# wrong $missing comparision for address_type_name in files account.shipto.php and admin.user_address_form.php
# showing $missing_style in file admin.user_address_form.php
# URL for editing shipping address in file admin.users.html.php
+ New variables in language file

12-08-2005 Zdenek Dvorak
+ New feature in backend: You can search products by:
  - modified date of product (You can search products which are very old and need update or which are new and need be checked)
  - modified date of product's price (Very usefull if you use price synchronizing with other system - e.g. company accountancy)
  - products with no price
+ New features: unit & packaging ## REQUIRES a DATABASE UPDATE! ##
  You can set unit of product, number units in packaging and number units in box. For showing packaging in product_details is
  needed use in flypage {product_packaging} - see html/templates/product_details/flypage.php
^ ## Database structure changed ##
  ALTER TABLE `mos_{vm}_product` ADD `product_unit` varchar(32);
  ALTER TABLE `mos_{vm}_product` ADD `product_packaging` int(11);
^ Now is possible set default product weight unit (pounds) and default product length unit (inches) in language file:
  var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM and var $_PHPSHOP_PRODUCT_FORM_LENGTH_UOM
+ New language file for Czech translation (czechiso.php with ISO-8859-2 and czech1250.php with CP1250 codepage)
+ New parameter for modul virtuemart: moduleclass_sfx

09-08-2005 Zdenek Dvorak
# bad showing last_page in cart and show error message if no product_id (no redirecting) (ps_cart.php)
# error message befor login to show account.order_details (ps_main.php)
# error message in no tax_rate (before show Shipping Address) (ps_product_attribute.php)
# bad redirecting if URL == SECUREURL (ps_session.php)
# vertical aligning button "Add to Cart" (shop.product_details.php)

02-08-2005 soeren
# categories from the category list were not shown in the list under some circumstances
# Slashes were stripped out of text when saving a payment method (extrainfo)
^ moved the SQL Queries out of the file shop.browse.php into shop_browse_queries.php

01-08-2005 Zdenek Dvorak
# Product Type: File mod_virtuemart.php, variable _PHPSHOP_PARAMETER_SEARCH was changed to _PHPSHOP_ADVANCED_PARAMETER_SEARCH 

26-07-2005
# Tax Total wasn't calculated correctly when MULTIPLE_TAXRATES_ENABLE was set to 1 and a disount was applied
# Product Discounts weren't calculated correctly when PAYMENT_DISCOUNT_BEFORE was enabled (ps_product::get_advanced_attribute_price())
# basket.php didn't calculate the correct Tax Amount when a Coupont has been redeemed
# Coupon Discount wasn't calculated correctly (when Percentage) - ps_coupon::process_coupon_code()
# Quantity Discounts didn't show the correct price in the basket (ps_product::get_price())
# Related Products couldn't be changed in Product Form
^ more changes for Mambelfish compatiblity (added product_id / category_id to various SQL queries)

19-07-2005 soeren
# Tax Rate for other states didn't return 0 when no tax rate was specified
# Report Basic Module doing an endless loop when showing single products
# Product Form always displaying the name of the first Shopper Group, not saving the price to the correct shopper group
+ CSV: Added the "Skip the first line" feature by Christian Lehmann (thanks!)
  so you can just keep the column names in the first line of the CSV file

01-07-2005 Zdenek Dvorak
! changed ToolTip in files ps_product_type.php, shop.parameter_search_form.php, product.product_form.php and
  product.product_type_parameter_form.php
  Now is used function mm_ToolTip.
  
^ changed the PNG Fix to this solution: http://www.skyzyx.com/scripts/sleight.php
  (this doesn't let images disappear)

27-06-2005 soeren
# Checkout not working (Minimum Purchase Order Value not reached)

---- derived from mambo-phpShop 1.2 stable - patch level 3 ----

---- mambo-phpShop 1.2 stable patch level 3 released ----


</pre>