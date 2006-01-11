<?php
defined( '_VALID_MOS' ) or die( 'Restricted access' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage core
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

VirtueMart 1.0.x
*************************************
11-01-2006 soeren
+ when Caching is on, cached pages are watermarked with a timestamp ("Last updated: Wednesday, 11 January 2006 16:31") like we know from eBay
+ FedEx shipping module integration begun
# fixed minor issues with the new userfield registration system
# Task #435 — Link to component class
# Task #433 — Blocked message (popup) on registration
# Task #432 — missing ST address in order_user_info when using default address
# Task #431 — Pricelist doesn't show prices

 
09-01-2006 soeren
^ Payment method discounts/fees: Implemented a percentage discount...
	You can now charge the customer a certain percentage of the order total

	! DATABASE STRUCTURE CHANGED: table jos_vm_payment_method
	  Added 3 new fields to that table to allow percentage discounts

05-01-2006 soeren
# Task #430 — ToolTip Error when use Chinese
^ Task #427 — Add To Cart button in Browse uses Joomla button CSS.

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
!! DATABASE STRUCTURE CHANGED:  two new tables	!!
!! see /sql/UPDATE-SCRIPT_VM_1.0.x_to_1.1.0.sql			!!

^ silently registered users don't have to remember their old usernames now (Task #385 returning hidden/silent users can't use the same email address)


16-12-2005 schirmer
+ New feature to easily translate the flypage using {vm_lang:xxx} place holder. Usage instructions in html/shop.product_details.php

15-12-2005 soeren
# product prices can be zero or empty now. When the product price is left empty in the product form, an existing price will be deleted and no price will be added.
^ PayPal payment extra info now subtracts order and coupon discounts from the order subtotal
^ Now it's possible to checkout with $0 in the cart. Allows free purchases using gift coupons.
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
	Uses vmCommonHTML::printJS_formvalidation() to print a JS form validation function
	
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