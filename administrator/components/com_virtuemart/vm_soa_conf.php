<?php

defined('_JEXEC') or die('Restricted access');
/**
 * @package    	com_vm_soa (WebServices for virtuemart)
 * @author		Mickael Cabanas (cabanas.mickael|at|gmail.com)
 * @link 		http://sourceforge.net/projects/soa-virtuemart/
 * @license    	GNU/GPL
*/

if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
$vmConfig = VmConfig::loadConfig();

$conf['version']='2.0.0';
$conf['author']='Mickael Cabanas';
$conf['URL']='';
$conf['BASESITE']='';

$conf['wsdl_custom']='VM_Customized.wsdl';
$conf['EP_custom']='VM_CustomizedService.php';
$conf['custom_actif']= $vmConfig->get('soap_ws_prod_on')== 1 ? 'on' :'off';
$conf['custom_cache']= $vmConfig->get('soap_ws_prod_cache_on')== 1 ? 'on' :'off';

$conf['wsdl_product']='VM_Product.wsdl';
$conf['EP_product']='VM_ProductService.php';
$conf['product_actif']= $vmConfig->get('soap_ws_prod_on')== 1 ? 'on' :'off';
$conf['product_cache']= $vmConfig->get('soap_ws_prod_cache_on')== 1 ? 'on' :'off';
$conf['wsdl_cat']='VM_Categories.wsdl';
$conf['EP_cat']='VM_CategoriesService.php';
$conf['cat_actif']= $vmConfig->get('soap_ws_cat_on')== 1 ? 'on' :'off';
$conf['cat_cache']= $vmConfig->get('soap_ws_cat_cache_on')== 1 ? 'on' :'off';
$conf['wsdl_order']='VM_Orders.wsdl';
$conf['EP_order']='VM_OrdersService.php';
$conf['order_actif']= $vmConfig->get('soap_ws_order_on')== 1 ? 'on' :'off';
$conf['order_cache']= $vmConfig->get('soap_ws_order_cache_on')== 1 ? 'on' :'off';
$conf['wsdl_sql']='VM_SQLQueries.wsdl';
$conf['EP_sql']='VM_SQLQueriesService.php';
$conf['querie_actif']= $vmConfig->get('soap_ws_sql_on')== 1 ? 'on' :'off';
$conf['querie_cache']= $vmConfig->get('soap_ws_sql_cache_on')== 1 ? 'on' :'off';
$conf['wsdl_users']='VM_Users.wsdl';
$conf['EP_users']='VM_UsersService.php';
$conf['users_actif']= $vmConfig->get('soap_ws_user_on')== 1 ? 'on' :'off';
$conf['users_cache']= $vmConfig->get('soap_ws_user_cache_on')== 1 ? 'on' :'off';
$conf['trace']='1';
$conf['remove']='';
$conf['soap_version']='SOAP_1_2';
$conf['auth_all_upload']= $vmConfig->get('soap_auth_getcat')== 1 ? 'on' :'off';
$conf['auth_cat_getall']= $vmConfig->get('soap_auth_getcat')== 1 ? 'on' :'off';
$conf['auth_cat_getchild']= $vmConfig->get('soap_auth_getcat')== 1 ? 'on' :'off';
$conf['auth_cat_addcat']= $vmConfig->get('soap_auth_addcat')== 1 ? 'on' :'off';
$conf['auth_cat_delcat']= $vmConfig->get('soap_auth_delcat')== 1 ? 'on' :'off';
$conf['auth_cat_getimg']= $vmConfig->get('soap_auth_cat_otherget')== 1 ? 'on' :'off';
$conf['auth_cat_updatecat']= $vmConfig->get('soap_auth_upcat')== 1 ? 'on' :'off';
$conf['auth_users_getall']= $vmConfig->get('soap_auth_getuser')== 1 ? 'on' :'off';
$conf['auth_users_adduser']= $vmConfig->get('soap_auth_adduser')== 1 ? 'on' :'off';
$conf['auth_users_deluser']= $vmConfig->get('soap_auth_deluser')== 1 ? 'on' :'off';
$conf['auth_users_sendmail']= $vmConfig->get('soap_auth_user_otheradd')== 1 ? 'on' :'off';
$conf['auth_users_search']= $vmConfig->get('soap_auth_getuser')== 1 ? 'on' :'off';
$conf['auth_users_getcountry']= $vmConfig->get('soap_auth_user_otherget')== 1 ? 'on' :'off';
$conf['auth_users_getauthgrp']= $vmConfig->get('soap_auth_user_otherget')== 1 ? 'on' :'off';
$conf['auth_users_addautgrp']= $vmConfig->get('soap_auth_getcat')== 1 ? 'on' :'off';
$conf['auth_users_delauthgrp']= $vmConfig->get('soap_auth_user_otherdelete')== 1 ? 'on' :'off';
$conf['auth_users_getstate']= $vmConfig->get('soap_auth_user_otherget')== 1 ? 'on' :'off';
$conf['auth_users_addstate']= $vmConfig->get('soap_auth_user_otheradd')== 1 ? 'on' :'off';
$conf['auth_users_delstate']= $vmConfig->get('soap_auth_user_otherdelete')== 1 ? 'on' :'off';
$conf['auth_users_getshopgrp']= $vmConfig->get('soap_auth_user_otherget')== 1 ? 'on' :'off';
$conf['auth_users_addshopgrp']= $vmConfig->get('soap_auth_user_otheradd')== 1 ? 'on' :'off';
$conf['auth_users_upshopgrp']= $vmConfig->get('soap_auth_user_otherupdate')== 1 ? 'on' :'off';
$conf['auth_users_delshopgroup']= $vmConfig->get('soap_auth_user_otherdelete')== 1 ? 'on' :'off';
$conf['auth_users_upuser']= $vmConfig->get('soap_auth_user_otherupdate')== 1 ? 'on' :'off';
$conf['auth_users_getvendor']= $vmConfig->get('soap_auth_user_otherget')== 1 ? 'on' :'off';
$conf['auth_users_addvendor']= $vmConfig->get('soap_auth_user_otheradd')== 1 ? 'on' :'off';
$conf['auth_users_upvendor']= $vmConfig->get('soap_auth_user_otherupdate')== 1 ? 'on' :'off';
$conf['auth_users_delvendor']= $vmConfig->get('soap_auth_user_otherdelete')== 1 ? 'on' :'off';
$conf['auth_users_getvendorcat']= $vmConfig->get('soap_auth_user_otherget')== 1 ? 'on' :'off';
$conf['auth_users_addvendorcat']= $vmConfig->get('soap_auth_user_otheradd')== 1 ? 'on' :'off';
$conf['auth_users_upvendorcat']= $vmConfig->get('soap_auth_user_otherupdate')== 1 ? 'on' :'off';
$conf['auth_users_delvendorcat']= $vmConfig->get('soap_auth_user_otherdelete')== 1 ? 'on' :'off';
$conf['auth_users_getmanufacturer']= $vmConfig->get('soap_auth_user_otherget')== 1 ? 'on' :'off';
$conf['auth_users_addmanufacturer']= $vmConfig->get('soap_auth_user_otheradd')== 1 ? 'on' :'off';
$conf['auth_users_upmanufacturer']= $vmConfig->get('soap_auth_user_otherupdate')== 1 ? 'on' :'off';
$conf['auth_users_delmanufacturer']= $vmConfig->get('soap_auth_user_otherdelete')== 1 ? 'on' :'off';
$conf['auth_users_getmanufacturercat']= $vmConfig->get('soap_auth_user_otherget')== 1 ? 'on' :'off';
$conf['auth_users_addmanufacturercat']= $vmConfig->get('soap_auth_user_otheradd')== 1 ? 'on' :'off';
$conf['auth_users_upmanufacturercat']= $vmConfig->get('soap_auth_user_otherupdate')== 1 ? 'on' :'off';
$conf['auth_users_delmanufacturercat']= $vmConfig->get('soap_auth_user_otherdelete')== 1 ? 'on' :'off';
$conf['auth_users_getvendorimg']= $vmConfig->get('soap_auth_user_otherget')== 1 ? 'on' :'off';
$conf['auth_users_getversion']='off';
$conf['auth_prod_getfromcat']= $vmConfig->get('soap_auth_getprod')== 1 ? 'on' :'off';
$conf['auth_prod_getchild']= $vmConfig->get('soap_auth_getprod')== 1 ? 'on' :'off';
$conf['auth_prod_getfromid']= $vmConfig->get('soap_auth_getprod')== 1 ? 'on' :'off';
$conf['auth_prod_updateprod']= $vmConfig->get('soap_auth_upprod')== 1 ? 'on' :'off';
$conf['auth_prod_getfromoderid']= $vmConfig->get('soap_auth_getprod')== 1 ? 'on' :'off';
$conf['auth_prod_addprod']= $vmConfig->get('soap_auth_addprod')== 1 ? 'on' :'off';
$conf['auth_prod_delprod']= $vmConfig->get('soap_auth_getcat')== 1 ? 'on' :'off';
$conf['auth_prod_getcurrency']= $vmConfig->get('soap_auth_delprod')== 1 ? 'on' :'off';
$conf['auth_prod_gettax']= $vmConfig->get('soap_auth_prod_otherget')== 1 ? 'on' :'off';
$conf['auth_prod_addtax']= $vmConfig->get('soap_auth_prod_otheradd')== 1 ? 'on' :'off';
$conf['auth_prod_updatetax']= $vmConfig->get('soap_auth_prod_otherupdate')== 1 ? 'on' :'off';
$conf['auth_prod_deltax']= $vmConfig->get('soap_auth_prod_otherdelete')== 1 ? 'on' :'off';
$conf['auth_prod_getallprod']= $vmConfig->get('soap_auth_getprod')== 1 ? 'on' :'off';
$conf['auth_prod_getimg']= $vmConfig->get('soap_auth_prod_otherget')== 1 ? 'on' :'off';
$conf['auth_order_getfromstatus']= $vmConfig->get('soap_auth_getorder')== 1 ? 'on' :'off';
$conf['auth_order_getorder']= $vmConfig->get('soap_auth_getorder')== 1 ? 'on' :'off';
$conf['auth_order_getstatus']= $vmConfig->get('soap_auth_getorder')== 1 ? 'on' :'off';
$conf['auth_order_getall']= $vmConfig->get('soap_auth_getorder')== 1 ? 'on' :'off';
$conf['auth_order_updatestatus']= $vmConfig->get('soap_auth_uporder')== 1 ? 'on' :'off';
$conf['auth_order_deleteorder']= $vmConfig->get('soap_auth_delorder')== 1 ? 'on' :'off';
$conf['auth_order_createorder']= $vmConfig->get('soap_auth_addorder')== 1 ? 'on' :'off';
$conf['auth_order_getcoupon']= $vmConfig->get('soap_auth_order_otherget')== 1 ? 'on' :'off';
$conf['auth_order_addcoupon']= $vmConfig->get('soap_auth_order_otheradd')== 1 ? 'on' :'off';
$conf['auth_order_delcoupon']= $vmConfig->get('soap_auth_order_otherdelete')== 1 ? 'on' :'off';
$conf['auth_order_getshiprate']= $vmConfig->get('soap_auth_order_otherget')== 1 ? 'on' :'off';
$conf['auth_order_addshiprate']= $vmConfig->get('soap_auth_order_otheradd')== 1 ? 'on' :'off';
$conf['auth_order_upshiprate']= $vmConfig->get('soap_auth_order_otherupdate')== 1 ? 'on' :'off';
$conf['auth_order_delshiprate']= $vmConfig->get('soap_auth_order_otherdelete')== 1 ? 'on' :'off';
$conf['auth_order_getshipcarrier']= $vmConfig->get('soap_auth_order_otherget')== 1 ? 'on' :'off';
$conf['auth_order_addshipcarrier']= $vmConfig->get('soap_auth_order_otheradd')== 1 ? 'on' :'off';
$conf['auth_order_upshipcarrier']= $vmConfig->get('soap_auth_order_otherupdate')== 1 ? 'on' :'off';
$conf['auth_order_delshipcarrier']= $vmConfig->get('soap_auth_order_otherdelete')== 1 ? 'on' :'off';
$conf['auth_order_getpayment']= $vmConfig->get('soap_auth_order_otherget')== 1 ? 'on' :'off';
$conf['auth_order_addpayment']= $vmConfig->get('soap_auth_order_otheradd')== 1 ? 'on' :'off';
$conf['auth_order_updatepayment']= $vmConfig->get('soap_auth_order_otherupdate')== 1 ? 'on' :'off';
$conf['auth_order_delapyment']= $vmConfig->get('soap_auth_order_otherdelete')== 1 ? 'on' :'off';
$conf['auth_order_getorderfromdate']= $vmConfig->get('soap_auth_getorder')== 1 ? 'on' :'off';
$conf['auth_order_getcreditcard']= $vmConfig->get('soap_auth_order_otherget')== 1 ? 'on' :'off';
$conf['auth_order_addcreditcard']= $vmConfig->get('soap_auth_order_otheradd')== 1 ? 'on' :'off';
$conf['auth_order_upcreditcard']= $vmConfig->get('soap_auth_order_otherupdate')== 1 ? 'on' :'off';
$conf['auth_order_delcreditcard']= $vmConfig->get('soap_auth_order_otherdelete')== 1 ? 'on' :'off';
$conf['auth_order_addstatus']= $vmConfig->get('soap_auth_order_otheradd')== 1 ? 'on' :'off';
$conf['auth_order_upstatus']= $vmConfig->get('soap_auth_order_otherupdate')== 1 ? 'on' :'off';
$conf['auth_order_delstatus']= $vmConfig->get('soap_auth_order_otherdelete')== 1 ? 'on' :'off';

$conf['auth_sql_sqlrqst']= $vmConfig->get('soap_auth_execsql')== 1 ? 'on' :'off';
$conf['auth_sql_select']= $vmConfig->get('soap_auth_execsql_select')== 1 ? 'on' :'off';
$conf['auth_sql_insert']= $vmConfig->get('soap_auth_execsql_insert')== 1 ? 'on' :'off';
$conf['auth_sql_update']= $vmConfig->get('soap_auth_execsql_update')== 1 ? 'on' :'off';
?>
