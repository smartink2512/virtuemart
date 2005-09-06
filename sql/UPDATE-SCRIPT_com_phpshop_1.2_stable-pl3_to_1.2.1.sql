#############################################
# SQL update script for upgrading 
# from phpshop package 1.2 stable-pl3 to 1.2.1
#
#############################################

# 12.08.2005
/** Packaging - Begin */
ALTER TABLE `mos_pshop_product` ADD `product_unit` varchar(32);
ALTER TABLE `mos_pshop_product` ADD `product_packaging` int(11);
/** Packaging - End */

# 23.08.2005
/** Extra fields */
ALTER TABLE mos_pshop_order_user_info ADD  `extra_field_1` varchar(255) default NULL;
ALTER TABLE mos_pshop_order_user_info ADD  `extra_field_2` varchar(255) default NULL;
ALTER TABLE mos_pshop_order_user_info ADD  `extra_field_3` varchar(255) default NULL;
ALTER TABLE mos_pshop_order_user_info ADD  `extra_field_4` char(1) default NULL;
ALTER TABLE mos_pshop_order_user_info ADD  `extra_field_5` char(1) default NULL;
