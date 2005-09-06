# $Id: Manual_Uninstallation_com_phpshop_1.2.sql,v 1.5 2005/06/11 10:17:05 soeren_nb Exp $
# SQL Uninstall script for mambo-phpshop v. 1.2
# (component AND module) for Mambo 4.5.1
#
#
############################################################
# DELETE TABLES FOR MOS PhPSHOP Component
############################################################

DROP TABLE IF EXISTS `mos_pshop_affiliate_sale`;
DROP TABLE IF EXISTS `mos_pshop_affiliate`;

DROP TABLE IF EXISTS  `mos_pshop_auth_user_vendor`;

DROP TABLE IF EXISTS  `mos_pshop_category`;

DROP TABLE IF EXISTS  `mos_pshop_category_xref`;

DROP TABLE IF EXISTS  `mos_pshop_country`;

DROP TABLE IF EXISTS  `mos_pshop_creditcard`;

DROP TABLE IF EXISTS  `mos_pshop_csv`;

DROP TABLE IF EXISTS  `mos_pshop_currency`;

DROP TABLE IF EXISTS  `mos_pshop_function`;

DROP TABLE IF EXISTS `mos_pshop_manufacturer`;

DROP TABLE IF EXISTS `mos_pshop_manufacturer_category`;

DROP TABLE IF EXISTS  `mos_pshop_module`;

DROP TABLE IF EXISTS  `mos_pshop_order_history`;

DROP TABLE IF EXISTS  `mos_pshop_order_item`;

DROP TABLE IF EXISTS  `mos_pshop_order_payment`;

DROP TABLE IF EXISTS  `mos_pshop_order_status`;

DROP TABLE IF EXISTS  `mos_pshop_order_user_info`;

DROP TABLE IF EXISTS  `mos_pshop_orders`;

DROP TABLE IF EXISTS  `mos_pshop_payment_method`;

DROP TABLE IF EXISTS  `mos_pshop_product`;

DROP TABLE IF EXISTS  `mos_pshop_product_attribute`;

DROP TABLE IF EXISTS  `mos_pshop_product_attribute_sku`;

DROP TABLE IF EXISTS  `mos_pshop_product_category_xref`;

DROP TABLE IF EXISTS `mos_pshop_product_mf_xref`;

DROP TABLE IF EXISTS  `mos_pshop_product_price`;
DROP TABLE IF EXISTS  `mos_pshop_product_relations`;
DROP TABLE IF EXISTS  `mos_pshop_product_reviews`;

DROP TABLE IF EXISTS  `mos_pshop_product_type`;
DROP TABLE IF EXISTS  `mos_pshop_product_type_parameter`;
DROP TABLE IF EXISTS  `mos_pshop_product_product_type_xref`;

DROP TABLE IF EXISTS  `mos_pshop_product_votes`;

DROP TABLE IF EXISTS  `mos_pshop_shipping_carrier`;

DROP TABLE IF EXISTS  `mos_pshop_shipping_rate`;

DROP TABLE IF EXISTS  `mos_pshop_state`;

DROP TABLE IF EXISTS  `mos_pshop_product_download`;

DROP TABLE IF EXISTS  `mos_pshop_shopper_group`;

DROP TABLE IF EXISTS  `mos_pshop_shopper_vendor_xref`;

DROP TABLE IF EXISTS  `mos_pshop_tax_rate`;

DROP TABLE IF EXISTS  `mos_pshop_user_info`;

DROP TABLE IF EXISTS  `mos_pshop_vendor`;

DROP TABLE IF EXISTS  `mos_pshop_vendor_category`;

DROP TABLE IF EXISTS  `mos_pshop_visit`;
DROP TABLE IF EXISTS  `mos_pshop_waiting_list`;

DROP TABLE IF EXISTS  `mos_pshop_zone_shipping`;



############################################################
# DELETE mambo-phpShop record from mos_components
############################################################

DELETE FROM `mos_components` WHERE `option`='com_phpshop';

############################################################
# RESTORE TABLE mos_users
############################################################

ALTER TABLE mos_users DROP  `user_info_id`;
ALTER TABLE mos_users DROP  `address_type`;
ALTER TABLE mos_users DROP  `address_type_name`;
ALTER TABLE mos_users DROP  `company`;
ALTER TABLE mos_users DROP  `title`;
ALTER TABLE mos_users DROP  `last_name`;
ALTER TABLE mos_users DROP  `first_name`;
ALTER TABLE mos_users DROP  `middle_name`;
ALTER TABLE mos_users DROP  `phone_1`;
ALTER TABLE mos_users DROP  `phone_2`;
ALTER TABLE mos_users DROP  `fax`;
ALTER TABLE mos_users DROP  `address_1`;
ALTER TABLE mos_users DROP  `address_2`;
ALTER TABLE mos_users DROP  `city`;
ALTER TABLE mos_users DROP  `state`;
ALTER TABLE mos_users DROP  `country`;
ALTER TABLE mos_users DROP  `zip`;
ALTER TABLE mos_users DROP  `extra_field_1`;
ALTER TABLE mos_users DROP  `extra_field_2`;
ALTER TABLE mos_users DROP  `extra_field_3`;
ALTER TABLE mos_users DROP  `extra_field_4`;
ALTER TABLE mos_users DROP  `extra_field_5`;
ALTER TABLE mos_users DROP  `perms`;
ALTER TABLE `mos_users` DROP  `bank_account_nr`;
ALTER TABLE `mos_users` DROP  `bank_name`;
ALTER TABLE `mos_users` DROP  `bank_sort_code`;
ALTER TABLE `mos_users` DROP  `bank_iban`;
ALTER TABLE `mos_users` DROP  `bank_account_holder`;
