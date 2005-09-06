﻿<?php
/*
* Beta Version Farsi Lang
* @version $Id: farsi.php,v 1.10 2005/06/22 19:50:43 soeren_nb Exp $
* @package Mambo_4.5.1
* @subpackage mambo-phpShop
*
* @copyright (C) 2005 Pooya IT Group
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
* farsi project by: www.pooya.info
*/
class phpShopLanguage extends mosAbstractLanguage {

    /*####################
    GENERAL DEFINITIONS
    ####################*/
    
    var $_PHPSHOP_MENU = "منو";
    var $_PHPSHOP_CATEGORY = "شاخه";
    var $_PHPSHOP_CATEGORIES = "دسته";
    var $_PHPSHOP_SELECT_CATEGORY = "انتخاب یک شاخه";
    var $_PHPSHOP_ADMIN = "مدیریت";
    var $_PHPSHOP_PRODUCT = "محصول";
    var $_PHPSHOP_LIST = "لیست";
    var $_PHPSHOP_ALL = "همه";
    var $_PHPSHOP_LIST_ALL_PRODUCTS = "لیست همه محصولات";
    var $_PHPSHOP_VIEW = "دیدن";
    var $_PHPSHOP_SHOW = "نمایش";
    var $_PHPSHOP_ADD = "اضافه کردن";
    var $_PHPSHOP_UPDATE = "بروز رسانی";
    var $_PHPSHOP_DELETE = "حذف کردن";
    var $_PHPSHOP_SELECT = "انتخاب";
    var $_PHPSHOP_SUBMIT = "Submit";
    var $_PHPSHOP_RANDOM = "محصولات اتفاقی";
    var $_PHPSHOP_LATEST = "آخرین محصولات";
    
    /*#####################
    MODULE ACCOUNT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_HOME_TITLE = "خانه";
    var $_PHPSHOP_CART_TITLE = "سبد خرید";
    var $_PHPSHOP_CHECKOUT_TITLE = "پرداخت نهائی";
    var $_PHPSHOP_LOGIN_TITLE = "ورود";
    var $_PHPSHOP_LOGOUT_TITLE = "خروج";
    var $_PHPSHOP_BROWSE_TITLE = "باز کردن";
    var $_PHPSHOP_SEARCH_TITLE = "جستجو";
    var $_PHPSHOP_ACCOUNT_TITLE = "Account Maintenance";
    var $_PHPSHOP_NAVIGATION_TITLE = "Navigation";
    var $_PHPSHOP_DEPARTMENT_TITLE = "Department";
    var $_PHPSHOP_INFO = "اطلاعات";
    
    var $_PHPSHOP_BROWSE_LBL = "باز کردن";
    var $_PHPSHOP_PRODUCTS_LBL = "محصولات";
    var $_PHPSHOP_PRODUCT_LBL = "محصول";
    var $_PHPSHOP_SEARCH_LBL = "جستجو";
    var $_PHPSHOP_FLYPAGE_LBL = "Product Details";
    var $_PHPSHOP_PRODUCT_SEARCH_LBL = "جستجوی محصول";
    
    var $_PHPSHOP_PRODUCT_NAME_TITLE = "نام محصول";
    var $_PHPSHOP_PRODUCT_CATEGORY_TITLE = "شاخه محصول";
    var $_PHPSHOP_PRODUCT_DESC_TITLE = "Description";
    
    var $_PHPSHOP_CART_SHOW = "نمایش سبد خرید";
    var $_PHPSHOP_CART_ADD_TO = "اضافه کردن به سبد خرید";
    var $_PHPSHOP_CART_NAME = "نام";
    var $_PHPSHOP_CART_SKU = "SKU";
    var $_PHPSHOP_CART_PRICE = "قیمت";
    var $_PHPSHOP_CART_QUANTITY = "Quantity";
    var $_PHPSHOP_CART_SUBTOTAL = "Subtotal";
    
    # Some messages
    var $_PHPSHOP_ADD_SHIPTO_1 = "اضافه کردن";
    var $_PHPSHOP_ADD_SHIPTO_2 = "آدرس خریدار";
    var $_PHPSHOP_NO_SEARCH_RESULT = "Your search returned 0 results.<br />";
    var $_PHPSHOP_PRICE_LABEL = "قیمت ";
    var $_PHPSHOP_ORDER_BUTTON_LABEL = "اضافه کردن به سبد";
    var $_PHPSHOP_NO_CUSTOMER = "مهمان گرامی! شما هنوز در این سایت ثبت نام نکرده اید. لطفا اطلاعات خود را وارد نمائید";
    var $_PHPSHOP_DELETE_MSG = "آیا شما از حذف این مطلب اطمینان دارید";
    var $_PHPSHOP_THANKYOU = "با تشکر از خرید شما";
    var $_PHPSHOP_NOT_SHIPPED = "Not Shipped Yet";
    var $_PHPSHOP_EMAIL_SENDTO = "A confirmation email has been sent to";
    var $_PHPSHOP_NO_USER_TO_SELECT = "Sorry, there's no MOS - user that you could add to the com_phpshop userlist";
    
    // Error messages
    
    var $_PHPSHOP_ERROR = "خطا";
    var $_PHPSHOP_MOD_NOT_REG = "Module Not Registered.";
    var $_PHPSHOP_MOD_ISNO_REG = "is not a valid phpShop module.";
    var $_PHPSHOP_MOD_NO_AUTH = "You do not have permission to access the requested module.";
    var $_PHPSHOP_PAGE_404_1 = "Page Does Not Exist";
    var $_PHPSHOP_PAGE_404_2 = "Given filename does not exist. Cannot find file:";
    var $_PHPSHOP_PAGE_403 = "Insufficient Access Rights";
    var $_PHPSHOP_FUNC_NO_EXEC = "You do not have permission to execute ";
    var $_PHPSHOP_FUNC_NOT_REG = "Function Not Registered";
    var $_PHPSHOP_FUNC_ISNO_REG = " is not a valid MOS_com_phpShop function.";
    
    /*#####################
    MODULE ADMIN
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADMIN_MOD = "مدیر";
    
    
    // User List
    var $_PHPSHOP_USER_LIST_MNU = "لیست کاربران";
    var $_PHPSHOP_USER_LIST_LBL = "لیست کاربری";
    var $_PHPSHOP_USER_LIST_USERNAME = "نام کاربر";
    var $_PHPSHOP_USER_LIST_FULL_NAME = "نام کامل";
    var $_PHPSHOP_USER_LIST_GROUP = "گروه";
    
    // User Form
    var $_PHPSHOP_USER_FORM_MNU = "اضافه کردن کاربر";
    var $_PHPSHOP_USER_FORM_LBL = "اضافه کردن یا بروز رسانی اطلاعات کاربری";
    var $_PHPSHOP_USER_FORM_BILLTO_LBL = "Bill To Information";
    var $_PHPSHOP_USER_FORM_SHIPTO_LBL = "Shipping Addresses";
    var $_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL = "اضافه کردن آدرس";
    var $_PHPSHOP_USER_FORM_ADDRESS_LABEL = "Address Nickname";
    var $_PHPSHOP_USER_FORM_FIRST_NAME = "نام کوچک";
    var $_PHPSHOP_USER_FORM_LAST_NAME = "نام خانوادگی";
    var $_PHPSHOP_USER_FORM_MIDDLE_NAME = "Middle Name";
    var $_PHPSHOP_USER_FORM_TITLE = "Title";
    var $_PHPSHOP_USER_FORM_USERNAME = "نام کاربری";
    var $_PHPSHOP_USER_FORM_PASSWORD_1 = "رمز";
    var $_PHPSHOP_USER_FORM_PASSWORD_2 = "تکرار رمز";
    var $_PHPSHOP_USER_FORM_PERMS = "Permissions";
    var $_PHPSHOP_USER_FORM_COMPANY_NAME = "نام شرکت";
    var $_PHPSHOP_USER_FORM_ADDRESS_1 = "آدرس 1";
    var $_PHPSHOP_USER_FORM_ADDRESS_2 = "آدرس 2";
    var $_PHPSHOP_USER_FORM_CITY = "شهر";
    var $_PHPSHOP_USER_FORM_STATE = "State/Province/Region";
    var $_PHPSHOP_USER_FORM_ZIP = "کد پستی";
    var $_PHPSHOP_USER_FORM_COUNTRY = "کشور";
    var $_PHPSHOP_USER_FORM_PHONE = "تلفن";
    var $_PHPSHOP_USER_FORM_FAX = "فاکس";
    var $_PHPSHOP_USER_FORM_EMAIL = "ایمیل";
    
    // Module List
    var $_PHPSHOP_MODULE_LIST_MNU = "لیست ماژولها";
    var $_PHPSHOP_MODULE_LIST_LBL = "Module List";
    var $_PHPSHOP_MODULE_LIST_NAME = "نام ماژول";
    var $_PHPSHOP_MODULE_LIST_PERMS = "Module Perms";
    var $_PHPSHOP_MODULE_LIST_FUNCTIONS = "Functions";
    var $_PHPSHOP_MODULE_LIST_ORDER = "لیست خرید";
    
    // Module Form
    var $_PHPSHOP_MODULE_FORM_MNU = "اضافه کردن ماژول";
    var $_PHPSHOP_MODULE_FORM_LBL = "اطلاعات ماژول";
    var $_PHPSHOP_MODULE_FORM_MODULE_LABEL = "(برچسب ماژول  (برای منوی بالا ";
    var $_PHPSHOP_MODULE_FORM_NAME = "Module Name";
    var $_PHPSHOP_MODULE_FORM_PERMS = "Module Perms";
    var $_PHPSHOP_MODULE_FORM_HEADER = "Module Header";
    var $_PHPSHOP_MODULE_FORM_FOOTER = "Module Footer";
    var $_PHPSHOP_MODULE_FORM_MENU = "Show Module in Admin menu?";
    var $_PHPSHOP_MODULE_FORM_ORDER = "Display Order";
    var $_PHPSHOP_MODULE_FORM_DESCRIPTION = "Module Description";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_CODE = "Language Code";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_file = "Language File";
    
    // Function List
    var $_PHPSHOP_FUNCTION_LIST_MNU = "List Functions";
    var $_PHPSHOP_FUNCTION_LIST_LBL = "Function List";
    var $_PHPSHOP_FUNCTION_LIST_NAME = "Function Name";
    var $_PHPSHOP_FUNCTION_LIST_CLASS = "Class Name";
    var $_PHPSHOP_FUNCTION_LIST_METHOD = "Class Method";
    var $_PHPSHOP_FUNCTION_LIST_PERMS = "Perms";
    
    // Module Form
    var $_PHPSHOP_FUNCTION_FORM_MNU = "Add Function";
    var $_PHPSHOP_FUNCTION_FORM_LBL = "Function Information";
    var $_PHPSHOP_FUNCTION_FORM_NAME = "Function Name";
    var $_PHPSHOP_FUNCTION_FORM_CLASS = "Class Name";
    var $_PHPSHOP_FUNCTION_FORM_METHOD = "Class Method";
    var $_PHPSHOP_FUNCTION_FORM_PERMS = "Function Perms";
    var $_PHPSHOP_FUNCTION_FORM_DESCRIPTION = "Function Description";
    
    // Currency form and list
    var $_PHPSHOP_CURRENCY_LIST_MNU = "List Currencies";
    var $_PHPSHOP_CURRENCY_LIST_LBL = "Currency List";
    var $_PHPSHOP_CURRENCY_LIST_ADD = "Add Currency";
    var $_PHPSHOP_CURRENCY_LIST_NAME = "Currency Name";
    var $_PHPSHOP_CURRENCY_LIST_CODE = "Currency Code";
    
    // Country form and list
    var $_PHPSHOP_COUNTRY_LIST_MNU = "لیست کشورها";
    var $_PHPSHOP_COUNTRY_LIST_LBL = "لیست کشور";
    var $_PHPSHOP_COUNTRY_LIST_ADD = "اضافه کردن کشور";
    var $_PHPSHOP_COUNTRY_LIST_NAME = "نام کشور";
    var $_PHPSHOP_COUNTRY_LIST_3_CODE = "کد کشور(3)";
    var $_PHPSHOP_COUNTRY_LIST_2_CODE = "کد کشور (2)";
    
    /*#####################
    MODULE CHECKOUT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADDRESS = "Address";
    var $_PHPSHOP_CONTINUE = "Continue";
    
    # Some messages
    var $_PHPSHOP_EMPTY_CART = "سبد خرید شما خالی می باشد";
    
    
    /*#####################
    MODULE ISShipping
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ISSHIPPING_MOD = "InterShipper";
    
    
    // Shipping Ping
    var $_PHPSHOP_ISSHIP_PING_MNU = "Ping InterShipper Server";
    var $_PHPSHOP_ISSHIP_PING_LBL = "InterShipper-Server Ping ";
    var $_PHPSHOP_ISSHIP_PING_ERROR_LBL = "InterShipper Ping Failed";
    var $_PHPSHOP_ISSHIP_PING_GOOD_LBL = "InterShipper Ping Successful";
    var $_PHPSHOP_ISSHIP_PING_CARRIER_LBL = "Carrier";
    var $_PHPSHOP_ISSHIP_PING_RESPONSE_LBL = "Response<br />Time";
    var $_PHPSHOP_ISSHIP_PING_TIME_LBL = "sec.";
    
    // Shipping List
    var $_PHPSHOP_ISSHIP_LIST_MNU = "List Ship Methods";
    var $_PHPSHOP_ISSHIP_LIST_LBL = "Active Ship Methods";
    var $_PHPSHOP_ISSHIP_LIST_CARRIER_LBL = "Ship Methods";
    var $_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL = "Active";
    var $_PHPSHOP_ISSHIP_LIST_RATE_LBL = "Handling Charge";
    var $_PHPSHOP_ISSHIP_LIST_LEAD_LBL = "Lead Time";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_F_LBL = "flat rate";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_P_LBL = "percent";
    var $_PHPSHOP_ISSHIP_LIST_DAYS_LBL = "days";
    var $_PHPSHOP_ISSHIP_LIST_HEAVY_LBL = "Heavy Loads";
    
    // Dynamic Shipping Form
    var $_PHPSHOP_ISSHIP_FORM_MNU = "Configure Ship Methods";
    var $_PHPSHOP_ISSHIP_FORM_ADD_LBL = "Add Ship Method";
    var $_PHPSHOP_ISSHIP_FORM_UPDATE_LBL = "Configure Ship Method";
    var $_PHPSHOP_ISSHIP_FORM_REFRESH_LBL = "Refresh";
    var $_PHPSHOP_ISSHIP_FORM_CARRIER_LBL = "Ship Method";
    var $_PHPSHOP_ISSHIP_FORM_PUBLISH_LBL = "Activate";
    var $_PHPSHOP_ISSHIP_FORM_HANDLING_LBL = "Handling Charge";
    var $_PHPSHOP_ISSHIP_FORM_LEAD_LBL = "Lead Time";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_F_LBL = "flat rate";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_P_LBL = "percent";
    var $_PHPSHOP_ISSHIP_FORM_DAYS_LBL = "days";
    var $_PHPSHOP_ISSHIP_FORM_HEAVY_LBL = "Heavy Loads";
    
    
    
    /*#####################
    MODULE ORDER
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_ORDER_MOD = "خریدها";
    
    // Some menu options 
    var $_PHPSHOP_ORDER_CONFIRM_MNU = "تأئید خرید";
    var $_PHPSHOP_ORDER_CANCEL_MNU = "لغو خرید";
    var $_PHPSHOP_ORDER_PRINT_MNU = "چاپ خرید";
    var $_PHPSHOP_ORDER_DELETE_MNU = "حذف خرید";
    
    // Order List
    var $_PHPSHOP_ORDER_LIST_MNU = "لیست خرید";
    var $_PHPSHOP_ORDER_LIST_LBL = "Order List";
    var $_PHPSHOP_ORDER_LIST_ID = "Order Number";
    var $_PHPSHOP_ORDER_LIST_CDATE = "Order Date";
    var $_PHPSHOP_ORDER_LIST_MDATE = "Last Modified";
    var $_PHPSHOP_ORDER_LIST_STATUS = "Status";
    var $_PHPSHOP_ORDER_LIST_TOTAL = "SubTotal";
    var $_PHPSHOP_ORDER_ITEM = "Order Items";
    
    // Order print
    var $_PHPSHOP_ORDER_PRINT_PO_LBL = "Purchase Order";
    var $_PHPSHOP_ORDER_PRINT_PO_NUMBER = "شماره خريد";
    var $_PHPSHOP_ORDER_PRINT_PO_DATE = "تاريخ خريد";
    var $_PHPSHOP_ORDER_PRINT_PO_STATUS = "Order Status";
    var $_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL = "Customer Information";
    var $_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL = "Billing Information";
    var $_PHPSHOP_ORDER_PRINT_CUST_SHIPPING_LBL = "Shipping Information";
    var $_PHPSHOP_ORDER_PRINT_BILL_TO_LBL = "Bill To";
    var $_PHPSHOP_ORDER_PRINT_SHIP_TO_LBL = "Ship To";
    var $_PHPSHOP_ORDER_PRINT_NAME = "نام";
    var $_PHPSHOP_ORDER_PRINT_COMPANY = "شرکت";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_1 = "آدرس 1";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_2 = "آدرس 2";
    var $_PHPSHOP_ORDER_PRINT_CITY = "شهر";
    var $_PHPSHOP_ORDER_PRINT_STATE = "State/Province/Region";
    var $_PHPSHOP_ORDER_PRINT_ZIP = "Zip/Postal Code";
    var $_PHPSHOP_ORDER_PRINT_COUNTRY = "کشور";
    var $_PHPSHOP_ORDER_PRINT_PHONE = "تلفن";
    var $_PHPSHOP_ORDER_PRINT_FAX = "فاکس";
    var $_PHPSHOP_ORDER_PRINT_EMAIL = "ایمیل";
    var $_PHPSHOP_ORDER_PRINT_ITEMS_LBL = "Order Items";
    var $_PHPSHOP_ORDER_PRINT_QUANTITY = "Quantity";
    var $_PHPSHOP_ORDER_PRINT_QTY = "Qty";
    var $_PHPSHOP_ORDER_PRINT_SKU = "SKU";
    var $_PHPSHOP_ORDER_PRINT_PRICE = "قيمت";
    var $_PHPSHOP_ORDER_PRINT_TOTAL = "Total";
    var $_PHPSHOP_ORDER_PRINT_SUBTOTAL = "SubTotal";
    var $_PHPSHOP_ORDER_PRINT_TOTAL_TAX = "Tax Total";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING = "Shipping and Handling Fee";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_TAX = "Shipping Tax";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LBL = "Payment Method";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NAME = "Account Name";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER = "Account Number";
    var $_PHPSHOP_ORDER_PRINT_EXPIRE_DATE = "Expire Date";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL = "Payment Log";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_LBL = "Shipping Information";
    var $_PHPSHOP_ORDER_PRINT_PAYINFO_LBL = "Payment Information";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL = "Carrier";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL = "Shipping Mode";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_DATE_LBL = "Ship Date";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL = "Shipping Price";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_MNU = "List Order Status Types";
    var $_PHPSHOP_ORDER_STATUS_FORM_MNU = "Add Order Status Type";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_CODE = "Order Status Code";
    var $_PHPSHOP_ORDER_STATUS_LIST_NAME = "Order Status Name";
    
    var $_PHPSHOP_ORDER_STATUS_FORM_LBL = "Order Status";
    var $_PHPSHOP_ORDER_STATUS_FORM_CODE = "Order Status Code";
    var $_PHPSHOP_ORDER_STATUS_FORM_NAME = "Order Status Name";
    var $_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER = "List Order";
    
    
    /*#####################
    MODULE PRODUCT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_PRODUCT_MOD = "Products";
    
    var $_PHPSHOP_CURRENT_PRODUCT = "Current Product";
    var $_PHPSHOP_CURRENT_ITEM = "Current Item";
    
    // Product Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_LBL = "Product Inventory";
    var $_PHPSHOP_PRODUCT_INVENTORY_MNU = "View Inventory";
    var $_PHPSHOP_PRODUCT_INVENTORY_PRICE = "قیمت";
    var $_PHPSHOP_PRODUCT_INVENTORY_STOCK = "Number";
    var $_PHPSHOP_PRODUCT_INVENTORY_WEIGHT = "Weight";
    // Product List
    var $_PHPSHOP_PRODUCT_LIST_MNU = "List Products";
    var $_PHPSHOP_PRODUCT_LIST_LBL = "Product List";
    var $_PHPSHOP_PRODUCT_LIST_NAME = "Product Name";
    var $_PHPSHOP_PRODUCT_LIST_SKU = "SKU";
    var $_PHPSHOP_PRODUCT_LIST_PUBLISH = "Publish";
    
    // Product Form
    var $_PHPSHOP_PRODUCT_FORM_MNU = "Add Product";
    var $_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT = "Edit this product";
    var $_PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE = "Preview product flypage in shop";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU = "Add Item";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU = "Add Another Item";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL = "New Product";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_PRODUCT_LBL = "Update Product";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL = "Product Information";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL = "Product Status";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL = "Product Dimensions and Weight";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL = "Product Images";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL = "New Item";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL = "Update Item";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL = "Item Information";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL = "Item Status";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL = "Item Dimensions and Weight";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL = "Item Images";
    var $_PHPSHOP_PRODUCT_FORM_RETURN_LBL = "Return to Parent Product";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL = "To update actual image, type in path to new image.";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL = "Type \"none\" to delete current image.";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL = "Product Items";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL = "Item Attributes";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG = "Are you sure you want to delete this Product\\nand the Items related to it?";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG = "Are you sure you want to delete this Item?";
    var $_PHPSHOP_PRODUCT_FORM_VENDOR = "Vendor";
    var $_PHPSHOP_PRODUCT_FORM_MANUFACTURER = "Manufacturer";
    var $_PHPSHOP_PRODUCT_FORM_SKU = "SKU";
    var $_PHPSHOP_PRODUCT_FORM_NAME = "Name";
    var $_PHPSHOP_PRODUCT_FORM_URL = "URL";
    var $_PHPSHOP_PRODUCT_FORM_CATEGORY = "Category";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_GROSS = "Product Price (Gross)";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_NET = "Product Price (Net)";
    var $_PHPSHOP_PRODUCT_FORM_DESCRIPTION = "Flypage Description";
    var $_PHPSHOP_PRODUCT_FORM_S_DESC = "Short Description";
    var $_PHPSHOP_PRODUCT_FORM_IN_STOCK = "In Stock";
    var $_PHPSHOP_PRODUCT_FORM_ON_ORDER = "On Order";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE = "Availability Date";
    var $_PHPSHOP_PRODUCT_FORM_SPECIAL = "On Special";
    var $_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE = "Discount Type";
    var $_PHPSHOP_PRODUCT_FORM_PUBLISH = "Publish?";
    var $_PHPSHOP_PRODUCT_FORM_LENGTH = "Length";
    var $_PHPSHOP_PRODUCT_FORM_WIDTH = "Width";
    var $_PHPSHOP_PRODUCT_FORM_HEIGHT = "Height";
    var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM = "Unit of Measure";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT = "Weight";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM = "Unit of Measure";
    var $_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE = "Thumb Nail";
    var $_PHPSHOP_PRODUCT_FORM_FULL_IMAGE = "Full Image";
    
    // Product Display
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL = "Product Add Results";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL = "Product Update Results";
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL = "Item Add Results";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL = "Item Update Results";
    var $_PHPSHOP_PRODUCT_CSV_UPLOAD = "Use CSV upload";
    var $_PHPSHOP_PRODUCT_FOLDERS = "Product Folders";
    
    // Product Category List
    var $_PHPSHOP_CATEGORY_LIST_MNU = "لیست مجموعه ها";
    var $_PHPSHOP_CATEGORY_LIST_LBL = "شاخه بندی مجموعه ها";
    
    // Product Category Form
    var $_PHPSHOP_CATEGORY_FORM_MNU = "Add Category";
    var $_PHPSHOP_CATEGORY_FORM_LBL = "Category Information";
    var $_PHPSHOP_CATEGORY_FORM_NAME = "Category Name";
    var $_PHPSHOP_CATEGORY_FORM_PARENT = "Parent";
    var $_PHPSHOP_CATEGORY_FORM_DESCRIPTION = "Category Description";
    var $_PHPSHOP_CATEGORY_FORM_PUBLISH = "Publish?";
    var $_PHPSHOP_CATEGORY_FORM_FLYPAGE = "Category Flypage";
    
    // Product Attribute List
    var $_PHPSHOP_ATTRIBUTE_LIST_MNU = "List Attributes";
    var $_PHPSHOP_ATTRIBUTE_LIST_LBL = "Attribute List for";
    var $_PHPSHOP_ATTRIBUTE_LIST_NAME = "Attribute Name";
    var $_PHPSHOP_ATTRIBUTE_LIST_ORDER = "List Order";
    
    // Product Attribute Form
    var $_PHPSHOP_ATTRIBUTE_FORM_MNU = "Add Attribute";
    var $_PHPSHOP_ATTRIBUTE_FORM_LBL = "Attribute Form";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT = "New Attribute for Product";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT = "Update Attribute for Product";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM = "New Attribute for Item";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM = "Update Attribute for Item";
    var $_PHPSHOP_ATTRIBUTE_FORM_NAME = "Attribute Name";
    var $_PHPSHOP_ATTRIBUTE_FORM_ORDER = "List Order";
    
    // Product Price List
    var $_PHPSHOP_PRICE_LIST_MNU = "لیست مجموعه ها";
    var $_PHPSHOP_PRICE_LIST_LBL = "Price Tree";
    var $_PHPSHOP_PRICE_LIST_FOR_LBL = "Price for";
    var $_PHPSHOP_PRICE_LIST_GROUP_NAME = "Group Name";
    var $_PHPSHOP_PRICE_LIST_PRICE = "قيمت";
    var $_PHPSHOP_PRODUCT_LIST_CURRENCY = "Currency";
    
    // Product Price Form
    var $_PHPSHOP_PRICE_FORM_MNU = "اضافه کردن قيمت";
    var $_PHPSHOP_PRICE_FORM_LBL = "اطلاعات قیمت";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT = "قيمت جديد برای محصول";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT = "بروز رسانی قيمت محصول";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_ITEM = "New Price for Item";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM = "Update Price for Item";
    var $_PHPSHOP_PRICE_FORM_PRICE = "قيمت";
    var $_PHPSHOP_PRICE_FORM_CURRENCY = "Currency";
    var $_PHPSHOP_PRICE_FORM_GROUP = "Shopper Group";
    
    
    /*#####################
    MODULE REPORT BASIC
    #####################*/
    # Some LABELs
    var $_PHPSHOP_REPORTBASIC_MOD = "Reports";
    var $_PHPSHOP_RB_INDIVIDUAL = "Individual Product Listings";
    var $_PHPSHOP_RB_SALE_TITLE = "Sales Reporting";
    
    /* labels for rpt_sales */
    var $_PHPSHOP_RB_SALES_PAGE_TITLE = "Sales Activity Overview";
    
    var $_PHPSHOP_RB_INTERVAL_TITLE = "Set Interval";
    var $_PHPSHOP_RB_INTERVAL_MONTHLY_TITLE = "Monthly";
    var $_PHPSHOP_RB_INTERVAL_WEEKLY_TITLE = "Weekly";
    var $_PHPSHOP_RB_INTERVAL_DAILY_TITLE = "Daily";
    
    var $_PHPSHOP_RB_THISMONTH_BUTTON = "This Month";
    var $_PHPSHOP_RB_LASTMONTH_BUTTON = "Last Month";
    var $_PHPSHOP_RB_LAST60_BUTTON = "Last 60 days";
    var $_PHPSHOP_RB_LAST90_BUTTON = "Last 90 days";
    
    var $_PHPSHOP_RB_START_DATE_TITLE = "Start on";
    var $_PHPSHOP_RB_END_DATE_TITLE = "End at";
    var $_PHPSHOP_RB_SHOW_SEL_RANGE = "Show this selected range";
    var $_PHPSHOP_RB_REPORT_FOR = "Report for ";
    var $_PHPSHOP_RB_DATE = "Date";
    var $_PHPSHOP_RB_ORDERS = "Orders";
    var $_PHPSHOP_RB_TOTAL_ITEMS = "Total Items sold";
    var $_PHPSHOP_RB_REVENUE = "Revenue";
    var $_PHPSHOP_RB_PRODLIST = "Product Listing";
    
    
    
    /*#####################
    MODULE SHOP
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOP_MOD = "Shop";
    var $_PHPSHOP_PRODUCT_THUMB_TITLE = "Image";
    var $_PHPSHOP_PRODUCT_PRICE_TITLE = "قيمت";
    var $_PHPSHOP_ORDER_STATUS_P = "در حال انتظار";
    var $_PHPSHOP_ORDER_STATUS_C = "انجام شده";
    var $_PHPSHOP_ORDER_STATUS_X = "لغو شده";
    
    
    # Some messages
    var $_PHPSHOP_ORDER_BUTTON = "Order";
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOPPER_MOD = "Shopper";
    
    
    
    // Shopper List
    var $_PHPSHOP_SHOPPER_LIST_MNU = "List Shoppers";
    var $_PHPSHOP_SHOPPER_LIST_LBL = "Shopper List";
    var $_PHPSHOP_SHOPPER_LIST_USERNAME = "User Name";
    var $_PHPSHOP_SHOPPER_LIST_NAME = "Full Name";
    var $_PHPSHOP_SHOPPER_LIST_GROUP = "Group";
    
    // Shopper Form
    var $_PHPSHOP_SHOPPER_FORM_MNU = "Add Shopper";
    var $_PHPSHOP_SHOPPER_FORM_LBL = "Shopper Information";
    var $_PHPSHOP_SHOPPER_FORM_BILLTO_LBL = "Bill To Information";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL = "Information";
    var $_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL = "Shipping Information";
    var $_PHPSHOP_SHOPPER_FORM_ADD_SHIPTO_LBL = "Add Address";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL = "Address Nickname";
    var $_PHPSHOP_SHOPPER_FORM_USERNAME = "User Name";
    var $_PHPSHOP_SHOPPER_FORM_FIRST_NAME = "First Name";
    var $_PHPSHOP_SHOPPER_FORM_LAST_NAME = "Last Name";
    var $_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME = "Middle Name";
    var $_PHPSHOP_SHOPPER_FORM_TITLE = "Title";
    var $_PHPSHOP_SHOPPER_FORM_SHOPPERNAME = "Shoppername";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_1 = "Password";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_2 = "Confirm Password";
    var $_PHPSHOP_SHOPPER_FORM_GROUP = "Shopper Group";
    var $_PHPSHOP_SHOPPER_FORM_COMPANY_NAME = "Company Name";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_1 = "Address 1";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_2 = "Address 2";
    var $_PHPSHOP_SHOPPER_FORM_CITY = "City";
    var $_PHPSHOP_SHOPPER_FORM_STATE = "State/Province/Region";
    var $_PHPSHOP_SHOPPER_FORM_ZIP = "Zip/Postal Code";
    var $_PHPSHOP_SHOPPER_FORM_COUNTRY = "Country";
    var $_PHPSHOP_SHOPPER_FORM_PHONE = "Phone";
    var $_PHPSHOP_SHOPPER_FORM_FAX = "Fax";
    var $_PHPSHOP_SHOPPER_FORM_EMAIL = "Email";
    
    // Shopper Group List
    var $_PHPSHOP_SHOPPER_GROUP_LIST_MNU = "List Shopper Groups";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_LBL = "Shopper Group List";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_NAME = "Group Name";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION = "Group Description";
    
    
    // Shopper Group Form
    var $_PHPSHOP_SHOPPER_GROUP_FORM_LBL = "Shopper Group Form";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_MNU = "Add Shopper Group";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_NAME = "Group Name";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DESC = "Group Description";
    
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_STORE_MOD = "Store";
    
    
    // Store Form
    var $_PHPSHOP_STORE_FORM_MNU = "Edit Store";
    var $_PHPSHOP_STORE_FORM_LBL = "Store Information";
    var $_PHPSHOP_STORE_FORM_CONTACT_LBL = "Contact Information";
    var $_PHPSHOP_STORE_FORM_FULL_IMAGE = "Full Image";
    var $_PHPSHOP_STORE_FORM_UPLOAD = "Upload Image";
    var $_PHPSHOP_STORE_FORM_STORE_NAME = "Store Name";
    var $_PHPSHOP_STORE_FORM_COMPANY_NAME = "Store Company Name";
    var $_PHPSHOP_STORE_FORM_ADDRESS_1 = "Address 1";
    var $_PHPSHOP_STORE_FORM_ADDRESS_2 = "Address 2";
    var $_PHPSHOP_STORE_FORM_CITY = "City";
    var $_PHPSHOP_STORE_FORM_STATE = "State/Province/Region";
    var $_PHPSHOP_STORE_FORM_COUNTRY = "Country";
    var $_PHPSHOP_STORE_FORM_ZIP = "Zip/Postal Code";
    var $_PHPSHOP_STORE_FORM_PHONE = "Phone";
    var $_PHPSHOP_STORE_FORM_CURRENCY = "Currency";
    var $_PHPSHOP_STORE_FORM_CATEGORY = "Store Category";
    var $_PHPSHOP_STORE_FORM_LAST_NAME = "Last Name";
    var $_PHPSHOP_STORE_FORM_FIRST_NAME = "First Name";
    var $_PHPSHOP_STORE_FORM_MIDDLE_NAME = "Middle Name";
    var $_PHPSHOP_STORE_FORM_TITLE = "Title";
    var $_PHPSHOP_STORE_FORM_PHONE_1 = "Phone 1";
    var $_PHPSHOP_STORE_FORM_PHONE_2 = "Phone 2";
    var $_PHPSHOP_STORE_FORM_FAX = "Fax";
    var $_PHPSHOP_STORE_FORM_EMAIL = "Email";
    var $_PHPSHOP_STORE_FORM_IMAGE_PATH = "Image Path";
    var $_PHPSHOP_STORE_FORM_DESCRIPTION = "Description";
    
    
    
    var $_PHPSHOP_PAYMENT = "Payment";
    // Payment Method List
    var $_PHPSHOP_PAYMENT_METHOD_LIST_MNU = "List Payment Methods";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_LBL = "Payment Method List";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_NAME = "Name";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_CODE = "Code";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT = "Discount";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP = "Shopper Group";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR = "Payment method type";
    
    // Payment Method Form
    var $_PHPSHOP_PAYMENT_METHOD_FORM_MNU = "Add Payment Method";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LBL = "Payment Method Form";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_NAME = "Payment Method Name";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP = "Shopper Group";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT = "Discount";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_CODE = "Code";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER = "List Order";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR = "Payment method type";
    
    
    
    /*#####################
    MODULE TAX
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_TAX_MOD = "Tax";
    
    // User List
    var $_PHPSHOP_TAX_RATE = "Tax Rates";
    var $_PHPSHOP_TAX_LIST_MNU = "List Tax Rates";
    var $_PHPSHOP_TAX_LIST_LBL = "Tax Rate List";
    var $_PHPSHOP_TAX_LIST_STATE = "Tax State or Region";
    var $_PHPSHOP_TAX_LIST_COUNTRY = "Tax Country";
    var $_PHPSHOP_TAX_LIST_RATE = "Tax Rate";
    
    // User Form
    var $_PHPSHOP_TAX_FORM_MNU = "Add Tax Rate";
    var $_PHPSHOP_TAX_FORM_LBL = "Add Tax Information";
    var $_PHPSHOP_TAX_FORM_STATE = "Tax State or Region";
    var $_PHPSHOP_TAX_FORM_COUNTRY = "Tax Country";
    var $_PHPSHOP_TAX_FORM_RATE = "Tax Rate (for 16% => fill in 0.16)";
    
    
    
    
    /*#####################
    MODULE VENDOR
    #####################*/
    
    
    
    # Some LABELs
    var $_PHPSHOP_VENDOR_MOD = "Vendor";
    var $_PHPSHOP_VENDOR_ADMIN = "Vendors";
    
    
    // Vendor List
    var $_PHPSHOP_VENDOR_LIST_MNU = "List Vendors";
    var $_PHPSHOP_VENDOR_LIST_LBL = "Vendor List";
    var $_PHPSHOP_VENDOR_LIST_VENDOR_NAME = "Vendor Name";
    var $_PHPSHOP_VENDOR_LIST_ADMIN = "Admin";
    
    // Vendor Form
    var $_PHPSHOP_VENDOR_FORM_MNU = "Add Vendor";
    var $_PHPSHOP_VENDOR_FORM_LBL = "Add Information";
    var $_PHPSHOP_VENDOR_FORM_INFO_LBL = "Vendor Information";
    var $_PHPSHOP_VENDOR_FORM_CONTACT_LBL = "Contact Information";
    var $_PHPSHOP_VENDOR_FORM_FULL_IMAGE = "Full Image";
    var $_PHPSHOP_VENDOR_FORM_UPLOAD = "Upload Image";
    var $_PHPSHOP_VENDOR_FORM_STORE_NAME = "Vendor Store Name";
    var $_PHPSHOP_VENDOR_FORM_COMPANY_NAME = "Vendor Company Name";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_1 = "Address 1";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_2 = "Address 2";
    var $_PHPSHOP_VENDOR_FORM_CITY = "City";
    var $_PHPSHOP_VENDOR_FORM_STATE = "State/Province/Region";
    var $_PHPSHOP_VENDOR_FORM_COUNTRY = "Country";
    var $_PHPSHOP_VENDOR_FORM_ZIP = "Zip/Postal Code";
    var $_PHPSHOP_VENDOR_FORM_PHONE = "Phone";
    var $_PHPSHOP_VENDOR_FORM_CURRENCY = "Currency";
    var $_PHPSHOP_VENDOR_FORM_CATEGORY = "Vendor Category";
    var $_PHPSHOP_VENDOR_FORM_LAST_NAME = "Last Name";
    var $_PHPSHOP_VENDOR_FORM_FIRST_NAME = "First Name";
    var $_PHPSHOP_VENDOR_FORM_MIDDLE_NAME = "Middle Name";
    var $_PHPSHOP_VENDOR_FORM_TITLE = "Title";
    var $_PHPSHOP_VENDOR_FORM_PHONE_1 = "Phone 1";
    var $_PHPSHOP_VENDOR_FORM_PHONE_2 = "Phone 2";
    var $_PHPSHOP_VENDOR_FORM_FAX = "Fax";
    var $_PHPSHOP_VENDOR_FORM_EMAIL = "Email";
    var $_PHPSHOP_VENDOR_FORM_IMAGE_PATH = "Image Path";
    var $_PHPSHOP_VENDOR_FORM_DESCRIPTION = "Description";
    
    
    // Vendor Category List
    var $_PHPSHOP_VENDOR_CAT_LIST_MNU = "List Vendor Categories";
    var $_PHPSHOP_VENDOR_CAT_LIST_LBL = "Vendor Category List";
    var $_PHPSHOP_VENDOR_CAT_NAME = "Category Name";
    var $_PHPSHOP_VENDOR_CAT_DESCRIPTION = "Category Description";
    var $_PHPSHOP_VENDOR_CAT_VENDORS = "Vendors";
    
    // Vendor Category Form
    var $_PHPSHOP_VENDOR_CAT_FORM_MNU = "Add Vendor Category";
    var $_PHPSHOP_VENDOR_CAT_FORM_LBL = "Vendor Category Form";
    var $_PHPSHOP_VENDOR_CAT_FORM_INFO_LBL = "Category Information";
    var $_PHPSHOP_VENDOR_CAT_FORM_NAME = "Category Name";
    var $_PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION = "Category Description";
    
    /*#####################
    MODULE MANUFACTURER
    #####################*/

    # Some LABELs
    var $_PHPSHOP_MANUFACTURER_MOD = "Manufacturer";
    var $_PHPSHOP_MANUFACTURER_ADMIN = "Manufacturers";
    
    
    // Manufacturer List
    var $_PHPSHOP_MANUFACTURER_LIST_MNU = "List Manufacturers";
    var $_PHPSHOP_MANUFACTURER_LIST_LBL = "Manufacturer List";
    var $_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME = "Manufacturer Name";
    var $_PHPSHOP_MANUFACTURER_LIST_ADMIN = "Admin";
    
    // Manufacturer Form
    var $_PHPSHOP_MANUFACTURER_FORM_MNU = "Add Manufacturer";
    var $_PHPSHOP_MANUFACTURER_FORM_LBL = "Add Information";
    var $_PHPSHOP_MANUFACTURER_FORM_INFO_LBL = "Manufacturer Information";
    var $_PHPSHOP_MANUFACTURER_FORM_NAME = "Manufacturer Name";
    var $_PHPSHOP_MANUFACTURER_FORM_CATEGORY = "Manufacturer Category";
    var $_PHPSHOP_MANUFACTURER_FORM_EMAIL = "Email";
    var $_PHPSHOP_MANUFACTURER_FORM_URL = "URL to Manufacturer Homepage";
    var $_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION = "Description";
    
    
    // Manufacturer Category List
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_MNU = "List Manufacturer Categories";
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_LBL = "Manufacturer Category List";
    var $_PHPSHOP_MANUFACTURER_CAT_NAME = "Category Name";
    var $_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION = "Category Description";
    var $_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS = "Manufacturers";
    
    // Manufacturer Category Form
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_MNU = "Add Manufacturer Category";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_LBL = "Manufacturer Category Form";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL = "Category Information";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_NAME = "Category Name";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION = "Category Description";
    
    
    /*#####################
    Modul HELP
    #####################*/
    var $_PHPSHOP_HELP_MOD = "Help";
    
    // 210104 start
    
    var $_PHPSHOP_CART_ACTION = "بروز رسانی";
    var $_PHPSHOP_CART_UPDATE = "Update Quantity In Cart";
    var $_PHPSHOP_CART_DELETE = "حذف محصول از سبد خرید";
    
    //shopbrowse form
    
    var $_PHPSHOP_PRODUCT_PRICETAG = "قیمت";
    var $_PHPSHOP_PRODUCT_CALL = "Call for Pricing";
    var $_PHPSHOP_PRODUCT_PREVIOUS = "قبلی";
    var $_PHPSHOP_PRODUCT_NEXT = "بعدی";
    
    //ro_basket
    
    var $_PHPSHOP_CART_TAX = "Tax";
    var $_PHPSHOP_CART_SHIPPING = "Shipping and Handling Fee";
    var $_PHPSHOP_CART_TOTAL = "Total";
    
    //CHECKOUT.INDEX
    
    var $_PHPSHOP_CHECKOUT_NEXT = "بعدی";
    var $_PHPSHOP_CHECKOUT_REGISTER = "ثبت نام";
    
    //CHECKOUT.CONFIRM
    
    var $_PHPSHOP_CHECKOUT_CONF_BILLINFO = "Billing Information";
    var $_PHPSHOP_CHECKOUT_CONF_COMPANY = "Company";
    var $_PHPSHOP_CHECKOUT_CONF_NAME = "Name";
    var $_PHPSHOP_CHECKOUT_CONF_ADDRESS = "Address";
    var $_PHPSHOP_CHECKOUT_CONF_PHONE = "Phone";
    var $_PHPSHOP_CHECKOUT_CONF_FAX = "Fax";
    var $_PHPSHOP_CHECKOUT_CONF_EMAIL = "Email";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO = "Shipping Information";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY = "Company";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME = "Name";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS = "Address";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE = "Phone";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX = "Fax";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO = "Payment Information";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD = "Name On Card";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD = "Payment Method";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM = "Credit Card Number";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE = "Expiration Date";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER = "Complete Order";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO = "required infomation when Payment via Credit Card is selected";
    
    
    var $_PHPSHOP_ZONE_MOD = "Zone Shipping";
    
    var $_PHPSHOP_ZONE_LIST_MNU = "List Zones";
    var $_PHPSHOP_ZONE_FORM_MNU = "Add Zone";
    var $_PHPSHOP_ZONE_ASSIGN_MNU = "Assign Zones";
    
    // assign zone List
    var $_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL = "Country";
    var $_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL = "Current Zone";
    var $_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL = "Assign To Zone";
    var $_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL = "Update";
    var $_PHPSHOP_ASSIGN_ZONE_PG_LBL = "Assign Zones";
    
    // zone Form
    var $_PHPSHOP_ZONE_FORM_NAME_LBL = "Zone Name";
    var $_PHPSHOP_ZONE_FORM_DESC_LBL = "Zone Description";
    var $_PHPSHOP_ZONE_FORM_COST_PER_LBL = "Zone Cost Per Item";
    var $_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL = "Zone Cost Limit";
    
    // List of zones
    var $_PHPSHOP_ZONE_LIST_LBL = "Zone List";
    var $_PHPSHOP_ZONE_LIST_NAME_LBL = "Zone Name";
    var $_PHPSHOP_ZONE_LIST_DESC_LBL = "Zone Description";
    var $_PHPSHOP_ZONE_LIST_COST_PER_LBL = "Zone Cost Per Item";
    var $_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL = "Zone Cost Limit";
    
    var $_PHPSHOP_LOGIN_FIRST = "Please log in or register to this site (use the Login module) first.<br>Thank you.";
    var $_PHPSHOP_STORE_FORM_TOS = "Terms of Service";
    var $_PHPSHOP_AGREE_TO_TOS = "Please agree to our terms of Service first.";
    var $_PHPSHOP_I_AGREE_TO_TOS = "I agree to the Terms of Service";
    
    var $_PHPSHOP_LEAVE_BLANK = "(leave BLANK if you have <br />no individual php-file for it!)";
    var $_PHPSHOP_RETURN_LOGIN = "Returning Customers: Please Log In";
    var $_PHPSHOP_NEW_CUSTOMER = "New? Please Provide Your Billing Information";
    var $_PHPSHOP_ACC_CUSTOMER_ACCOUNT = "Customer Account:";
    var $_PHPSHOP_ACC_ORDER_INFO = "Order Information";
    var $_PHPSHOP_ACC_UPD_BILL = "Here you can update your billing information.";
    var $_PHPSHOP_ACC_UPD_SHIP = "Here you can add and maintain shipping addresses.";
    var $_PHPSHOP_ACC_ACCOUNT_INFO = "Account Information";
    var $_PHPSHOP_ACC_SHIP_INFO = "Shipping Information";
    var $_PHPSHOP_ACC_NO_ORDERS = "No Orders to Display";
    var $_PHPSHOP_ACC_BILL_DEF = "- Default (Same as Billing)";
    var $_PHPSHOP_SHIPTO_TEXT = "You can add shipping locations to your account. Please think of a suitable nickname or code for the shipping location you select below.";
    var $_PHPSHOP_CONFIG = "Configuration";
    var $_PHPSHOP_USERS = "Users";
    var $_PHPSHOP_IS_CC_PAYMENT = "is Credit Card payment?";
    
    /*#####################################################
     MODULE SHIPPING
    #######################################################*/
    var $_PHPSHOP_SHIPPING_MOD = "Shipping";
    var $_PHPSHOP_SHIPPING_MENU_LABEL = "Shipping";
    
    var $_PHPSHOP_CARRIER_LIST_MNU = "Shipper";
    var $_PHPSHOP_CARRIER_LIST_LBL = "Shipper list";
    var $_PHPSHOP_RATE_LIST_MNU = "Shipping Rates";
    var $_PHPSHOP_RATE_LIST_LBL = "Shipping Rates list";
    var $_PHPSHOP_CARRIER_LIST_NAME_LBL = "Name";
    var $_PHPSHOP_CARRIER_LIST_ORDER_LBL = "Listorder";
    
    var $_PHPSHOP_CARRIER_FORM_MNU = "Create Shipper";
    var $_PHPSHOP_CARRIER_FORM_LBL = "Shipper edit / create";
    var $_PHPSHOP_RATE_FORM_MNU = "Create a Shipping Rate";
    var $_PHPSHOP_RATE_FORM_LBL = "Create/Edit a Shipping Rate";
    
    var $_PHPSHOP_RATE_FORM_NAME = "Shipping Rate description";
    var $_PHPSHOP_RATE_FORM_CARRIER = "Shipper";
    var $_PHPSHOP_RATE_FORM_COUNTRY = "Country:<br /><br /><i>Multiselect: use STRG-Key and Mouse</i>";
    var $_PHPSHOP_RATE_FORM_ZIP_START = "ZIP range start";
    var $_PHPSHOP_RATE_FORM_ZIP_END = "ZIP range end";
    var $_PHPSHOP_RATE_FORM_WEIGHT_START = "Lowest Weight";
    var $_PHPSHOP_RATE_FORM_WEIGHT_END = "Highest Weight";
    var $_PHPSHOP_RATE_FORM_VALUE = "Fee";
    var $_PHPSHOP_RATE_FORM_PACKAGE_FEE = "Your package fee";
    var $_PHPSHOP_RATE_FORM_CURRENCY = "Currency";
    var $_PHPSHOP_RATE_FORM_VAT_ID = "VAT Id";
    var $_PHPSHOP_RATE_FORM_LIST_ORDER = "List Order";
    
    var $_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL = "Shipper";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME = "Shipping Rate description";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART = "Weight from ...";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND = "... to";
    var $_PHPSHOP_CARRIER_FORM_NAME = "Shipper Company";
    var $_PHPSHOP_CARRIER_FORM_LIST_ORDER = "Listorder";
    
    var $_PHPSHOP_ERR_MSG_CARRIER_EXIST = "ERROR: Shipper ID exists.";
    var $_PHPSHOP_ERR_MSG_CARRIER_ID_REQ = "ERROR: Choose a shipper.";
    var $_PHPSHOP_ERR_MSG_CARRIER_INUSE = "ERROR: At least one Shipping Rate exists, delete rates prior to shipper";
    var $_PHPSHOP_ERR_MSG_CARRIER_NOTFOUND = "ERROR: Unable to find a shipper with this ID.";
    
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_REQ = "ERROR: Choose a shipper.";
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_INV = "ERROR: Unable to find a shipper with this ID.";
    var $_PHPSHOP_ERR_MSG_RATE_NAME_REQ = "ERROR: A rate descriptor is requested.";
    var $_PHPSHOP_ERR_MSG_RATE_COUNTRY_CODE_INV = "ERROR: The Destination country is invalid. More than one country could be separated with \";\".";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_START_REQ = "ERROR: A lowest weight is requested";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_END_REQ = "ERROR: A highes weight are requested";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_STARTEND_INV = "ERROR: The lowest weight must be smaller than the highes weight";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_VALUE_REQ = "ERROR: A shipping fee requested";
    var $_PHPSHOP_ERR_MSG_RATE_CURRENCY_ID_INV = "ERROR: Coose a currency";
    
    var $_PHPSHOP_ERR_MSG_RATE_ID_REQ = "ERROR: A Shipping Rate is requested";
    
    var $_PHPSHOP_INFO_MSG_PLEASE_SELECT = "Please select";
    var $_PHPSHOP_INFO_MSG_CARRIER = "Shipper";
    var $_PHPSHOP_INFO_MSG_SHIPPING_METHOD = "Shipping Rate";
    var $_PHPSHOP_INFO_MSG_SHIPPING_PRICE = "قيمت";
    var $_PHPSHOP_INFO_MSG_VAT_ZERO_LBL = "0 (-none-)";
    /*#####################################################
     END: MODULE SHIPPING
    #######################################################*/
    
    var $_PHPSHOP_PAYMENT_FORM_CC = "Credit Card";
    var $_PHPSHOP_PAYMENT_FORM_USE_PP = "Use Payment Processor";
    var $_PHPSHOP_PAYMENT_FORM_BANK_DEBIT = "Bank debit";
    var $_PHPSHOP_PAYMENT_FORM_AO = "Address only / Cash on Delivery";
    var $_PHPSHOP_CHECKOUT_MSG_2 = "Please select a Shipping Address!";
    var $_PHPSHOP_CHECKOUT_MSG_3 = "Please select a Shipping Method!";
    var $_PHPSHOP_CHECKOUT_MSG_4 = "Please select a Payment Method!";
    var $_PHPSHOP_CHECKOUT_MSG_99 = "Please review the provided data and confirm the order!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIP = "Please select a Shipping Method.";
    var $_PHPSHOP_CHECKOUT_ERR_OTHER_SHIP = "Please select another Shipping Method.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_PAYM = "Please select a Payment Method.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR = "Please enter your Credit Card Number.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNAME = "Please enter the Name on the Credit Card.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATE = "The Credit Card Number entered is not valid.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCMON = "Please enter the Credit Card expiration month.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCYEAR = "Please enter the Credit Card expiration year.";
    var $_PHPSHOP_CHECKOUT_ERR_CCDATE_INV = "The expiration date is invalid.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIPTO = "Please select a Ship To address.";
    var $_PHPSHOP_CHECKOUT_ERR_CCNUM_INV = "Invalid account number.";
    var $_PHPSHOP_CHECKOUT_ERR_EMPTY_CART = "There's nothing in your cart!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CARR = "ERROR: Please select a Shipping Carrier!";
    var $_PHPSHOP_CHECKOUT_ERR_RATE_NOT_FOUND = "ERROR: The selected Shipping Rate was not found!";
    var $_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND = "ERROR: Your Shipping Address was not found!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATA = "ERROR: There's no CreditCard data...";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR_FOUND = "ERROR: Credit Card Number not found!";
    var $_PHPSHOP_CHECKOUT_ERR_TEST = "Sorry, but the Credit Card Number you've used is a testing number!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_USER_DATA = "The user_id was not found in the database!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_HOLDER_NAME = "You have actually not provided your bank account holder name.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_IBAN = "You have actually not provided your IBAN.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_NUM = "You have actually not provided your bank account number.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_SORT = "You have actually not provided your bank sort code.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_NAME = "You have actually not provided your bank's name.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_VALID_STEP = "CheckOut needs a valid Step!";

    var $_PHPSHOP_CHECKOUT_MSG_LOG = "Payment information captured for later processing.<br />";
    
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV = "Minimum purchase order value has not been reached yet.";
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV2 = "Our minimum purchase order value is:";
    var $_PHPSHOP_CHECKOUT_PAYMENT_CC = "Credit Card Payment";
    var $_PHPSHOP_CHECKOUT_PAYMENT_OTHER = "other Payment Methods";
    var $_PHPSHOP_CHECKOUT_PAYMENT_SELECT = "Please select a Payment Method:";
    
    var $_PHPSHOP_STORE_FORM_MPOV = "Minimum purchase order value for your store";
    var $_PHPSHOP_ACCOUNT_BANK_TITLE = "Bank Account Info";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR = "Account Number";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE = "Bank sorting code number";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_NAME = "Bank Name";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_IBAN = "IBAN";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER = "Account Holder";
    
    var $_PHPSHOP_MODULES = "Modules";
    var $_PHPSHOP_FUNCTIONS = "Functions";
    var $_PHPSHOP_SPECIAL_PRODUCTS = "Special products";
    
    var $_PHPSHOP_CHECKOUT_CUSTOMER_NOTE = "Please leave a note to us with your order if you want to";
    var $_PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE = "Customer's note";
    var $_PHPSHOP_INCLUDING_TAX = "(including \$tax % tax)";
    var $_PHPSHOP_PLEASE_SEL_ITEM = "Please select an item";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_LBL = "Item";

    // DOWNLOADS
    
    var $_PHPSHOP_DOWNLOADS_TITLE = "Download Area";
    var $_PHPSHOP_DOWNLOADS_START = "Start Download";
    var $_PHPSHOP_DOWNLOADS_INFO = "Please enter the Download-ID you've got in the e-mail and click 'Start Download'.";
    var $_PHPSHOP_DOWNLOADS_ERR_EXP = "Sorry, but your Download has expired";
    var $_PHPSHOP_DOWNLOADS_ERR_MAX = "Sorry, but your maximum number of downloads has been reached";
    var $_PHPSHOP_DOWNLOADS_ERR_INV = "Invalid Download-ID!";
    var $_PHPSHOP_DOWNLOADS_ERR_SEND = "Could not send a message to ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG = "Message sent to ";
    var $_PHPSHOP_DOWNLOADS_SEND_SUBJ = "Download-Info";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_1 = "the file(s) you ordered are ready for your download";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_2 = "Please enter the following Download-ID(s) in our Downloads Area: ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_3 = "the maximum number of downloads for each file is: ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_4 = "Download until {expire} days after the first download";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_5 = "Questions? Problems?";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_6 = "Download-Info by "; // e.g. Download-Info by "Storename"
    var $_PHPSHOP_PRODUCT_FORM_DOWNLOADABLE = "downloadable product?"; 
    
    var $_PHPSHOP_PAYPAL_THANKYOU = "Thanks for your payment. 
        The transaction was successful. You will get a confirmation e-mail for the transaction by PayPal. 
        You can now continue or log in at <a href=http://www.paypal.com>www.paypal.com</a> to see the transaction details.";
    var $_PHPSHOP_PAYPAL_ERROR = "An error occured while processing your transaction. The status of your order could not be updated.";
    
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER1 = "Thank you for shopping with us.  Your order information follows.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER2 = "Thank you for your patronage.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER3 = "Questions? Problems?";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER4 = "The following order was received.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER5 = "View the order by following the link below.";
    
    var $_PHPSHOP_CART_ERROR_NO_NEGATIVE = "Negative quantities are not allowed.";
    var $_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY = "Please enter a valid quantity for this item.";
    
    var $_PHPSHOP_CART_STOCK_1 = "The selected quantity exceeds available stock. ";
    var $_PHPSHOP_CART_STOCK_2 = "We currently have \$product_in_stock items available. ";
    var $_PHPSHOP_CART_STOCK_3 = "Click Here to be placed on our waiting list.";
    var $_PHPSHOP_CART_SELECT_ITEM = "Please select a special item from the details page!";
    
    var $_PHPSHOP_REGISTRATION_FORM_NONE = "none";
    var $_PHPSHOP_REGISTRATION_FORM_MR = "Mr.";
    var $_PHPSHOP_REGISTRATION_FORM_MRS = "Mrs.";
    var $_PHPSHOP_REGISTRATION_FORM_DR = "Dr.";
    var $_PHPSHOP_REGISTRATION_FORM_PROF = "Prof.";
    var $_PHPSHOP_DEFAULT = "Default";
    
  /*#####################################################
    MODULE AFFILIATE
  #######################################################*/
    var $_PHPSHOP_AFFILIATE_MOD   = "Affiliate Administration";
    
    // Affiliate List
    var $_PHPSHOP_AFFILIATE_LIST_MNU		= "List Affiliates";
    var $_PHPSHOP_AFFILIATE_LIST_LBL		= "Affiliates List";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME	= "Affiliate Name";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE = "Active";
    var $_PHPSHOP_AFFILIATE_LIST_RATE		= "Rate";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL = "Month Total";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION ="Month Commission";
    var $_PHPSHOP_AFFILIATE_LIST_ORDERS = "List Orders";
    
    // Affiliate Email
    var $_PHPSHOP_AFFILIATE_EMAIL_MNU		= "Email Affiliates";
    var $_PHPSHOP_AFFILIATE_EMAIL_LBL		= "Email Affiliates";
    var $_PHPSHOP_AFFILIATE_EMAIL_WHO	= "Who to Email(* = ALL)";
    var $_PHPSHOP_AFFILIATE_EMAIL_CONTENT		= "Your Email";
    var $_PHPSHOP_AFFILIATE_EMAIL_SUBJECT = "The Subject";
    var $_PHPSHOP_AFFILIATE_EMAIL_STATS	 = "Include Current Statistics";
    
    // Affiliate Form
    var $_PHPSHOP_AFFILIATE_FORM_RATE		= "Commission Rate (percent)";
    var $_PHPSHOP_AFFILIATE_FORM_ACTIVE		= "Active?";
    
    var $_PHPSHOP_DELIVERY_TIME = "Usually ships in";
    var $_PHPSHOP_DELIVERY_INFORMATION = "Delivery Information";
    var $_PHPSHOP_MORE_CATEGORIES = "more categories";
    var $_PHPSHOP_AVAILABILITY = "Availability";
    var $_PHPSHOP_CURRENTLY_NOT_AVAILABLE = "This product is currently not available.";
    var $_PHPSHOP_PRODUCT_AVAILABLE_AGAIN = "It will be available again on: ";
    
    var $_PHPSHOP_STATISTIC_SUMMARY = "Summary";
    var $_PHPSHOP_STATISTIC_STATISTICS = "Statistics";
    var $_PHPSHOP_STATISTIC_CUSTOMERS = "Customers";
    var $_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS = "active Products";
    var $_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS = "inactive Products";
    var $_PHPSHOP_STATISTIC_SUM = "Sum";
    var $_PHPSHOP_STATISTIC_NEW_ORDERS = "New Orders";
    var $_PHPSHOP_STATISTIC_NEW_CUSTOMERS = "New Customers";
    
    
	//Waiting list : file /administrator/components/com_phpshop/html/shop.waiting_list.php
	var $_PHPSHOP_WAITING_LIST_MESSAGE = "Please enter your e-mail address below to be notified when this product comes back in stock. 
                                        We will not share, rent, sell or use this e-mail address for any other purpose other than to 
                                        tell you when the product is back in stock.<br /><br />Thank you!";
	var $_PHPSHOP_WAITING_LIST_THANKS = "Thanks for waiting! <br />We will let you know as soon as we get our inventory.";
	var $_PHPSHOP_WAITING_LIST_NOTIFY_ME = "Notify Me!";
	
	//Checkout : file /administrator/components/com_phpshop/html/checkout.thankyou.php
	var $_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW = "Print view";
  
  /**************************Admin.show_cfg.php in apparition order ;-)**************************************/
	
	/* PAGE 1 */
	var $_PHPSHOP_ADMIN_CFG_AUTORIZE_OR_CYBERCASH = "Please choose EITHER Authorize.net OR CyberCash";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS = " Configuration file status:";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE = "is writeable";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE = "is unwriteable";
	
	var $_PHPSHOP_ADMIN_CFG_GLOBAL = "Global";
	var $_PHPSHOP_ADMIN_CFG_PATHANDURL = "Path & URL";
	var $_PHPSHOP_ADMIN_CFG_SITE = "Site";
	var $_PHPSHOP_ADMIN_CFG_SHIPPING = "Shipping";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT = "Checkout";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS = "Downloads";
	var $_PHPSHOP_ADMIN_CFG_PAYEMENTOPTIONS = "Payments";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE = "Use only as catalogue";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN = "If you check this, you disable all cart functionalities.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES = "Show Prices";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX = "Show Prices including tax?";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN = "Sets the flag whether the shoppers sees prices including tax or excluding tax.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN = "Check to show prices. If using catalogue functionality, some don't want prices to appear on pages.";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX = "Virtual Tax";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN = "This determines whether items with zero weight are taxed or not. Modify ps_checkout.php->calc_order_taxable() to customize this.";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE = "Tax mode:";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP = "Based on shipping address";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR = "Based on vendor address";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN = "This determines which tax rate is taken for calculating taxes:<br />
                                                <ul><li>the one from the state / country the store owner comes from</li><br/>
                                                <li>or the one from where the shopper comes from.</li></ul>";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE = "Enable multiple tax rates?";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN = "Check this, if you have products with different tax rates (e.g. 7% for books and food, 16% for other stuff)";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE = "Subtract payment discount before tax/shipping?";
  var $_PHPSHOP_ADMIN_CFG_REVIEW = "Enable Customer Review/Rating System";
  var $_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN = "If enabled, you allow customers to <strong>rate products</strong> and <strong>write reviews</strong> about them. <br />
                                                                                So customers can write down their experiences with the product for other customers.<br />";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN = "Sets the flag whether to subtract the Discount for the selected payment BEFORE (checked) or AFTER tax and shipping.";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK = "Customers can leave bank account data?";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN = "Check if your customers shall have the ability to provide their bank account data when registering to the shop.";

	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE = "Customers can select a state/region?";
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN = "Check if your customers shall have the ability to select their state / region data when registering to the shop.";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS = "Must agree to Terms of Service?";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN = "Check if you want a shopper to agree to your terms of service before registering to the shop.";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK = "Check Stock?";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN = "Sets whether to check the stock level when a user adds an item to the shopping cart. 
                                                                                          If set, this will not allow user to add more items to the cart than are available in stock.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE = "Enable Affiliate Program?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN = "This enables the affiliate tracking in the shop-frontend. Enable if you have added affiliates in the backend..";
	
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT = "Order-mail format:";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT = "Text mail";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML = "HTML mail";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN = "This determines how your order confirmation emails are set up:<br />
                                                                                        <ul><li>as a simple text email</li>
                                                                                        <li>or as a html email with images.</li></ul>";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN = "Allow Frontend-Administration for non-Backend Users?";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN = "With this setting you can enable the Frontend Administration for users who 
                                                                                              are storeadmins, but can't access the Mambo Backend (e.g. Registered / Editor).";
	
	/* PAGE 2 */
	var $_PHPSHOP_ADMIN_CFG_URL = "URL";
	var $_PHPSHOP_ADMIN_CFG_URL_EXPLAIN = "The URL to your site. Usually identical to your Mambo URL (with trailing slash at the end!)";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE = "SECUREURL";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN = "The secure URL to your site. (https - with trailing slash at the end!)";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT = "COMPONENTURL";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN = "The URL to the mambo-phpShop component. (with trailing slash at the end!)";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE = "IMAGEURL";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN = "The URL to the mambo-phpShop component image directory.(with trailing slash at the end!)";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH = "ADMINPATH";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN = "The path to your mambo-phpShop component directory.";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH = "CLASSPATH";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN = "The path to your phpShop classes directory.";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH = "PAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN = "The path to your phpShop html directory.";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH = "IMAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN = "The path to your phpShop shop_image directory.";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE = "HOMEPAGE";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN = "This is the page which will be loaded by default.";	
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE = "ERRORPAGE";
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN = "This is the default page for displaying error messages.";	
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE = "DEBUGPAGE";
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN = "This is the default page for displaying debug messages.";
	var $_PHPSHOP_ADMIN_CFG_DEBUG = "DEBUG ?";
	var $_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN = "DEBUG?  	   	Turns on the debug output. This causes the DEBUGPAGE to be displayed at the bottom of each page. Very helpful during shop development since it shows the carts contents, form field values, etc.";


/* PAGE 3 */

	var $_PHPSHOP_ADMIN_CFG_FLYPAGE = "FLYPAGE";
	var $_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN = "This is the default page for displaying product details.";
  var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE = "Category Template";
	var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN = "This defines the default category template for displaying products in a category.<br />
                                                                                                      You can create new templates by customizing existing template files <br />
                                                                                                      (which reside in the directory <strong>COMPONENTPATH/html/templates/</strong> and begin with browse_)";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW = "Default number of products in a row";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN = "This defines the number of products in a row. <br />
                                                                                                      Example: If you set it to 4, the category template will display 4 products per row";
  
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE = "\"no image\" image";
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN = "This image will be shown when no product image is available.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS = "SEARCH ROWS";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN = "Determines the number of rows per page when search results are displayed in a list.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 = "SEARCH COLOR 1";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN = "Specifies the color of the odd numbered rows in a result list.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 = "SEARCH COLOR 2";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN = "Specifies the color of the even numbered rows in a result list.";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS = "MAXIMUM ROWS";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN = "Sets the number of rows to show in the order list select box.";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION = "Show footer \"powered by mambo-phpShop\" ?";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN = "Displays a powered-by-mambo-phpShop footer image.";
	
	
	/* PAGE 4 */
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD = "Choose your store's shipping method";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD = "Standard Shipping module with indiviual configured carriers and rates. <strong>RECOMMENDED !</strong>";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE = "  	Zone Shipping Module Country Version 1.0<br />
                                                                                                            For more information on this module please visit <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br />
                                                                                                            for details or contact <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a><br /> Check this to enable the zone shipping module";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS = "UPS Tools Shipping calculation";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE = "UPS access code";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN = "Your UPS access code";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID = "UPS user id";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN = "The user ID you got from UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD = "UPS password";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN = "The password for your UPS account";
	  
  var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER = "InterShipper Module. Check only if you have an Intershipper.com account";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE = "Disable Shipping method selection. Choose if your customers buy downloadable goods which don't have to be shipped.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD = "InterShipper Password";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD_EXPLAIN = "Your password for your intershipper account.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL = "InterShipper email";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL_EXPLAIN = "Your email address for your intershipper account.";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY = "ENCODE KEY";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN = "Used to encrypt data stored in database with this key. This means that this file should be protected from viewing at all times.";
	
	
	/* PAGE 5 */
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR = "Enable the Checkout Bar";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN = "Check this, if you want the 'checkout-bar' to be displayed to the customer during checkout process ( 1 - 2 - 3 - 4 with graphics).";
	
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS = "Choose your store's checkout process";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD = "<strong>Standard :</strong><br/>
               1. Shipping address request<br />
              2. Shipping method request<br />
              3. Payment method request<br />
              4. Complete Order";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 = "<strong>Process 2:</strong><br/>
               1. Shipping address request<br />
              2. Payment method request<br />
              3. Complete Order";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 = "<strong>Process 3:</strong><br/>
               1. Shipping method request<br />
              2. Payment method request<br />
              3. Complete Order";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 = "<strong>Process 4:</strong><br/>
               1. Payment method request<br />
              2. Complete Order";
	
	
	
	/* PAGE 6 */
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS = "Enable Downloads";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN = "Check to enable the download capability. Only If you want sell downloadable goods.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS = "Order Status which enables download";
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN = "Select the order status at which the customer is notified about the download via e-mail.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS = "Order Status which disables downloads";
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN = "Sets the order status at which the download is disabled for the customer.";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT = "DOWNLOADROOT";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN = "The physical path to the files for the custumer download. (trailing slash at the end!)<br>
        <span class=\"message\">For your own shop's security: If you can, please use a directory ANYWHERE OUTSIDE OF THE WEBROOT</span>";
	
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX = "Download Maximum";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN = "Sets the number of downloads which can be made with one Download-ID, (for one order)";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE = "Download Expire";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN = "Sets the time range <strong>in seconds</strong> in which the download is enabled for the customer. 
  This range begins with the first download! When the time range has expired, the download-ID is disabled.<br />Note : 86400s=24h.";
	
	
	
	
	/* PAGE 7 */
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL = "Enable IPN Payment via PayPal?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL_EXPLAIN = "Check to let your customers use the PayPal payment system.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL = "PayPal payment email:";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL_EXPLAIN = "Your business email address for PayPal payments. Also used as receiver_email.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS = "Order Status for successful transactions";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS_EXPLAIN = "Select the order status to which the actual order is set, if the PayPal IPN was successful. If using download selling options: 
  select the status which enables the download (then the customer is instantly notified about the download via e-mail).";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED = "Order Status for failed transactions";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED_EXPLAIN = "Select an order status for failed PayPal transactions.";
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE = "Enable Payments via PayMate?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE_EXPLAIN = "Check to let your customers use the Australian PayMate payment system.";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME = "PayMate username:";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME_EXPLAIN = "Your user account for PayMate.";
	
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET = "Enable Authorize.net payment?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_EXPLAIN = "Check to use Authorize.net with phpShop.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE = "Test mode ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE_EXPLAIN = "Select 'Yes' while testing. Select 'No' for enabling live transactions.";
	var $_PHPSHOP_ADMIN_CFG_YES = "Yes";
	var $_PHPSHOP_ADMIN_CFG_NO = "No";
	
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME = "Authorize.net Login ID";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME_EXPLAIN = "This is your Authorize.Net Login ID";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY = "Authorize.net Transaction Key";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY_EXPLAIN = "This is your Authorize.net Transaction Key";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE = "Authentication Type";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE_EXPLAIN = "This is the Authorize.Net authentication type.";
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH = "Enable CyberCash?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH_EXPLAIN = "Check to use CyberCash with phpShop.";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND = "CyberCash MERCHANT";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_EXPLAIN = "CC_MERCHANT is the CyberCash Merchant ID";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY = "CyberCash Merchant Key";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY_EXPLAIN = "CyberCash Merchant Key is the Merchant Provided by CyberCash";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL = "CyberCash PAYMENT URL";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL_EXPLAIN = "CyberCash PAYMENT URL is the URL provided by Cybercash for secure payment";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE = "CyberCash AUTH TYPE";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE_EXPLAIN = "CyberCash AUTH TYPE is the Cybercash authentication type provided by Cybercase";
	

    /** Advanced Search feature ***/
    var $_PHPSHOP_ADVANCED_SEARCH  ="جستجوی پیشرفته";
    var $_PHPSHOP_SEARCH_ALL_CATEGORIES = "جستجو در همه مجموعه ها";
    var $_PHPSHOP_SEARCH_ALL_PRODINFO = "جستجوی همه اطلاعات محصولات";
    var $_PHPSHOP_SEARCH_PRODNAME = "فقط نام محصولات";
    var $_PHPSHOP_SEARCH_MANU_VENDOR = "Manufacturer/Vendor only";
    var $_PHPSHOP_SEARCH_DESCRIPTION = "Product description only";
    var $_PHPSHOP_SEARCH_AND = "و";
    var $_PHPSHOP_SEARCH_NOT = "نه";
    var $_PHPSHOP_SEARCH_TEXT1 = " ";
    var $_PHPSHOP_SEARCH_TEXT2 = " ";
    var $_PHPSHOP_ORDERBY = "مرتب بر اساس";
    
    /*** Review feature ***/
    var $_PHPSHOP_CUSTOMER_RATING  = "میانگین امتیازات کاربران";
    var $_PHPSHOP_TOTAL_VOTES = "جمع امتیازات";
    var $_PHPSHOP_CAST_VOTE = "لطفا شما هم به این محصول امتیاز دهید";
    var $_PHPSHOP_RATE_BUTTON = "امتیاز";
    var $_PHPSHOP_RATE_NOM = "Rating";
    var $_PHPSHOP_REVIEWS = "Customer Reviews";
    var $_PHPSHOP_NO_REVIEWS = "There are yet no reviews for this product.";
    var $_PHPSHOP_WRITE_FIRST_REVIEW = "Be the first to write a review...";
    var $_PHPSHOP_REVIEW_LOGIN = "Please log in to write a review.";
    var $_PHPSHOP_REVIEW_ERR_RATE = "Please rate the product to complete your review!";
    var $_PHPSHOP_REVIEW_ERR_COMMENT1 = "Please write down some more words for your review. Mininum characters allowed: 100";
    var $_PHPSHOP_REVIEW_ERR_COMMENT2 = "Please shorten your review. Maximum characters allowed: 2000";
    var $_PHPSHOP_WRITE_REVIEW = "Write a review for this product!";
    var $_PHPSHOP_REVIEW_RATE = "First: Rate the product. Please select a rating between 0 (poorest) and 5 stars (best).";
    var $_PHPSHOP_REVIEW_COMMENT = "Now please write a (short) review....(min. 100, max. 2000 characters) ";
    var $_PHPSHOP_REVIEW_COUNT = "Characters written: ";
    var $_PHPSHOP_REVIEW_SUBMIT = "Submit Review";
    var $_PHPSHOP_REVIEW_ALREADYDONE = "You already have written a review for this product. Thank you.";
    var $_PHPSHOP_REVIEW_THANKYOU = "Thanks for your review.";
    var $_PHPSHOP_COMMENT= "Comment";
    
    var $_PHPSHOP_CREDITCARD_FORM_LBL = "Add/Edit Credit Card Types";
    var $_PHPSHOP_CREDITCARD_NAME = "Credit Card Name";
    var $_PHPSHOP_CREDITCARD_CODE = "Credit Card - Short Code";
    var $_PHPSHOP_CREDITCARD_TYPE = "Credit Card Type";
    
    var $_PHPSHOP_CREDITCARD_LIST_LBL = "Credit Card List";
    var $_PHPSHOP_UDATE_ADDRESS = "Update Address";
    var $_PHPSHOP_CONTINUE_SHOPPING = "Continue Shopping";
    
    var $_PHPSHOP_THANKYOU_SUCCESS = "Your order has been successfully placed!";
    var $_PHPSHOP_ORDER_LINK = "Follow this link to view the Order Details.";
    
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "the Status of your Order No. {order_id} has been changed.";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "New Status is:";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "To view the Order Details, please follow this link (or copy it into your browser):";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "Order Status Change: Your Order {order_id}";
    var $_PHPSHOP_ORDER_LIST_NOTIFY = "Notify Customer?";
    var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "Please change the Order Status first!";
    
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "Price Discount on default Shopper Group (in %)";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = "A positive amount X means: If the Product has no Price assigned to THIS Shopper Group, the default Price is decreased by X %. A negative amount has the opposite effect";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_LBL = "Product Discount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL = "Product Discount List";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT = "Add/Edit Product Discount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT = "Discount amount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP = "Enter the discount amount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE = "Discount Type";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT = "Percentage";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL = "Total";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP = "Shall the amount be a percentage or a total?";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE = "Startdate of discount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP = "Specifies the day when the discount begins";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE = "End date of discount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP = "Specifies the day when the discount ends";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP = "You can use the Product Discount Form to add discounts!";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_SAVE = "You Save";
    
    var $_PHPSHOP_FLYPAGE_ENLARGE_IMAGE = "View Full-Size Image";
    
/*********************
Currency Display Style 
***********************/
    var $_PHPSHOP_CURRENCY_DISPLAY = "Currency Display Style";
    var $_PHPSHOP_CURRENCY_SYMBOL = "Currency symbol";
    var $_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP = "You can also use HTML Entities here (e.g. &amp;euro;,&amp;pound;,&amp;yen;,...)";
    var $_PHPSHOP_CURRENCY_DECIMALS = "Decimals";
    var $_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP = "Number of displayed decimals (can be 0)<br><b>Performs rounding if value has different number of decimals</b>";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL = "Decimal symbol";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP = "Character used as decimal symbol";
    var $_PHPSHOP_CURRENCY_THOUSANDS = "Thousands separator";
    var $_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP = "Character used to separate thousands (can be empty)";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY = "Positive format";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP = "Display format used to display positive values.<br>(Symb stands for currency symbol)";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY = "Negative format";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP = "Display format used to display negative values.<br>(Symb stands for currency symbol)";
    
    var $_PHPSHOP_OTHER_LISTS = "Other Product Lists";
/**************
Multiple Images 
****************/
    var $_PHPSHOP_MORE_IMAGES = "View More Images";
    var $_PHPSHOP_AVAILABLE_IMAGES = "Available Images for";
    var $_PHPSHOP_BACK_TO_DETAILS = "Back to Product Details";
    
    /* FILEMANAGER */
    var $_PHPSHOP_FILEMANAGER = "FileManager";
    var $_PHPSHOP_FILEMANAGER_LIST = "FileManager::Product List";
    var $_PHPSHOP_FILEMANAGER_ADD = "Add Image/File";
    var $_PHPSHOP_FILEMANAGER_IMAGES = "Assigned Images";
    var $_PHPSHOP_FILEMANAGER_DOWNLOADABLE = "Is Downloadable?";
    var $_PHPSHOP_FILEMANAGER_FILES = "Assigned Files (Datasheets,...)";
    var $_PHPSHOP_FILEMANAGER_PUBLISHED = "Published?";
    
    /* FILE LIST */
    var $_PHPSHOP_FILES_LIST = "FileManager::Image/File List for";
    var $_PHPSHOP_FILES_LIST_FILENAME = "Filename";
    var $_PHPSHOP_FILES_LIST_FILETITLE = "File Title";
    var $_PHPSHOP_FILES_LIST_FILETYPE = "File Type";
    var $_PHPSHOP_FILES_LIST_EDITFILE = "Edit File Entry";
    var $_PHPSHOP_FILES_LIST_FULL_IMG = "Full Image";
    var $_PHPSHOP_FILES_LIST_THUMBNAIL_IMG = "Thumbnail Image";
    
    
    /* FILE FORM */
    var $_PHPSHOP_FILES_FORM = "Upload a File for";
    var $_PHPSHOP_FILES_FORM_CURRENT_FILE = "Current File";
    var $_PHPSHOP_FILES_FORM_FILE = "File";
    var $_PHPSHOP_FILES_FORM_IMAGE = "Image";
    var $_PHPSHOP_FILES_FORM_UPLOAD_TO = "Upload to";
    var $_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH = "default Product Image Path";
    var $_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH = "Specify the file location";
    var $_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH = "Download Path (e.g. for selling downloadables!)";
    var $_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL = "Auto-Create Thumbnail?";
    var $_PHPSHOP_FILES_FORM_FILE_PUBLISHED = "File is published?";
    var $_PHPSHOP_FILES_FORM_FILE_TITLE = "File Title (what the Customer sees)";
    var $_PHPSHOP_FILES_FORM_FILE_DESC = "File Description";
    var $_PHPSHOP_FILES_FORM_FILE_URL = "File URL (optional)";
    
    /* FILE & IMAGE PROCESSING */
    var $_PHPSHOP_FILES_PATH_ERROR = "Please provide a valid path!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS = "The Thumbnail Image has been successfully created!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE = "Could NOT create Thumbnail Image!";
    var $_PHPSHOP_FILES_UPLOAD_FAILURE = "File/Image Upload Error";
    
    var $_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE = "Could not delete the Full Image File.";
    var $_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS = "Full Image successfully deleted.";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE = "Could not delete the Thumbnail Image File (maybe didnt exist): ";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS = "Thumbnail Image successfully deleted.";
    var $_PHPSHOP_FILES_FILE_DELETE_FAILURE = "Could not delete the File.";
    var $_PHPSHOP_FILES_FILE_DELETE_SUCCESS = "File successfully deleted.";
    
    var $_PHPSHOP_FILES_NOT_FOUND = "Sorry, but the requested file wasn't found!";
    var $_PHPSHOP_IMAGE_NOT_FOUND = "Image not found!";
    
    /*#####################
    MODULE COUPON
    #####################*/
    
    var $_PHPSHOP_COUPON_MOD = "Coupon";
    var $_PHPSHOP_COUPONS = "Coupons";
    var $_PHPSHOP_COUPON_LIST = "Coupon List";
    var $_PHPSHOP_COUPON_ALREADY_REDEEMED = "Coupon has already been redeemed.";
    var $_PHPSHOP_COUPON_REDEEMED = "Coupon redeemed! Thank you.";
    var $_PHPSHOP_COUPON_ENTER_HERE = "If you have a coupon code, please enter it below:";
    var $_PHPSHOP_COUPON_SUBMIT_BUTTON = "Submit";
    var $_PHPSHOP_COUPON_CODE_EXISTS = "That coupon code already exists. Please try again.";
    var $_PHPSHOP_COUPON_EDIT_HEADER = "Update Coupon";
    var $_PHPSHOP_COUPON_EDIT_HELP_TEXT = "Click a coupon code to edit it, or to delete a coupon code, select it and click Delete:";
    var $_PHPSHOP_COUPON_CODE_HEADER = "Code";
    var $_PHPSHOP_COUPON_PERCENT_TOTAL = "Percent or Total";
    var $_PHPSHOP_COUPON_TYPE = "Coupon Type";
    var $_PHPSHOP_COUPON_TYPE_TOOLTIP = "A Gift Coupon is deleted after it was used for discounting an order. A permanent coupon can be used as often as the customer wants to.";
    var $_PHPSHOP_COUPON_TYPE_GIFT = "Gift Coupon";    
    var $_PHPSHOP_COUPON_TYPE_PERMANENT = "Permanent Coupon";    
    var $_PHPSHOP_COUPON_VALUE_HEADER = "Value";
    var $_PHPSHOP_COUPON_DELETE_BUTTON = "Delete Code";
    var $_PHPSHOP_COUPON_CONFIRM_DELETE = "Are you sure you want to delete this coupon code?";
    var $_PHPSHOP_COUPON_COMPLETE_ALL_FIELDS = "Please complete all fields.";
    var $_PHPSHOP_COUPON_VALUE_NOT_NUMBER = "Coupon value must be a number.";
    var $_PHPSHOP_COUPON_NEW_HEADER = "New Coupon";
    var $_PHPSHOP_COUPON_COUPON_HEADER = "Coupon Code";
    var $_PHPSHOP_COUPON_PERCENT = "Percent";
    var $_PHPSHOP_COUPON_TOTAL = "Total";
    var $_PHPSHOP_COUPON_VALUE = "Value";
    var $_PHPSHOP_COUPON_CODE_SAVED = "Coupon code saved.";
    var $_PHPSHOP_COUPON_SAVE_BUTTON = "Save Coupon";
    var $_PHPSHOP_COUPON_DISCOUNT = "Coupon Discount";
    var $_PHPSHOP_COUPON_CODE_INVALID = "Coupon code not found. Please try again.";
    var $_PHPSHOP_COUPONS_ENABLE = "Enable Coupon Usage";
    var $_PHPSHOP_COUPONS_ENABLE_EXPLAIN = "If you enable the Coupon Usage, you allow customers to fill in Coupon Numbers to gain discounts on their purchase.";
    
    /* Free Shipping */
    var $_PHPSHOP_FREE_SHIPPING = "Free Shipping";
    var $_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT = "Shipping is free on this Order!";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT = "Minimum Amount for Free Shipping";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP = "The amount (INCLUDING TAX!) which is the Minimum for Free Shipping 
                                                (example: <strong>50</strong> means Free Shipping when the customer checks out
                                                with \$50 (including tax) or more.";
    var $_PHPSHOP_YOUR_STORE = "Your Store";
    var $_PHPSHOP_CONTROL_PANEL = "Control Panel";
    
    /* Configuration Additions */
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON = "PDF - Button";
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN = "Show or Hide the PDF - Button in the Shop";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER = "Must agree to Terms of Service on EVERY ORDER?";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN = "Check if you want a shopper to agree to your terms of service on EVERY ORDER (before placing the order).";
    
    // We need this for eCheck.net Payments
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE = "Bank Account Type";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING = "Checking";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING = "Business Checking";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS = "Saving";
    
    var $_PHPSHOP_PAYMENT_AN_RECURRING = "Recurring Billings?";
    var $_PHPSHOP_PAYMENT_AN_RECURRING_TOOLTIP = "Define wether you want recurring billings.";
    
    var $_PHPSHOP_INTERNAL_ERROR = "Internal Error processing the Request to";
    var $_PHPSHOP_PAYMENT_ERROR = "Failure in Processing the Payment";
    var $_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS = "Payment successfully processed";
    
    /* UPS Shipping Module */
    var $_PHPSHOP_UPS_RESPONSE_ERROR = "UPS was not able to process the Shipping Rate Request.";
    var $_PHPSHOP_UPS_SHIPPING_GUARANTEED_DAYS = "Guaranteed Day(s) To Delivery";
    var $_PHPSHOP_UPS_PICKUP_METHOD = "UPS Pickup Method";
    var $_PHPSHOP_UPS_PICKUP_METHOD_TOOLTIP = "How do you give packages to UPS?";
    var $_PHPSHOP_UPS_PACKAGE_TYPE = "UPS Packaging?";
    var $_PHPSHOP_UPS_PACKAGE_TYPE_TOOLTIP = "Select the default Type of Packaging.";
    var $_PHPSHOP_UPS_TYPE_RESIDENTIAL = "Residential Delivery?";
    var $_PHPSHOP_UPS_RESIDENTIAL = "Residential (RES)";
    var $_PHPSHOP_UPS_COMMERCIAL    = "Commercial Delivery (COM)";
    var $_PHPSHOP_UPS_RESIDENTIAL_TOOLTIP = "Quote for Residential (RES) or Commercial Delivery (COM).";
    var $_PHPSHOP_UPS_HANDLING_FEE = "Handling Fee";
    var $_PHPSHOP_UPS_HANDLING_FEE_TOOLTIP = "Your Handling fee for this shipping method.";
    var $_PHPSHOP_UPS_TAX_CLASS = "Tax Class";
    var $_PHPSHOP_UPS_TAX_CLASS_TOOLTIP = "Use the following tax class on the shipping fee.";
    
    var $_PHPSHOP_ERROR_CODE = "Error Code";
    var $_PHPSHOP_ERROR_DESC = "Error Description";
    
    var $_PHPSHOP_CHANGE_TRANSACTION_KEY = "Show / Change the Transaction Key";
    var $_PHPSHOP_CHANGE_PASSKEY_FORM = "Show/Change the Password/Transaction Key";
    var $_PHPSHOP_TYPE_PASSWORD = "Please type in your User Password";
    var $_PHPSHOP_CURRENT_PASSWORD = "Current Password";
    var $_PHPSHOP_CURRENT_TRANSACTION_KEY = "Current Transaction Key";
    var $_PHPSHOP_CHANGE_PASSKEY_SUCCESS = "The Transaction key was successfully changed.";
    
    var $_PHPSHOP_PAYMENT_CVV2 = "Request/Capture Credit Card Code Value (CVV2/CVC2/CID)";
    var $_PHPSHOP_PAYMENT_CVV2_TOOLTIP = "Check for a valid CVV2/CVC2/CID value (three- or four-digit number on the back of a credit card, on the Front of American Express Cards)?";
    var $_PHPSHOP_CUSTOMER_CVV2_TOOLTIP = "Please type in the three- or four-digit number on the back of your credit card (On the Front of American Express Cards)";
    var $_PHPSHOP_CUSTOMER_CVV2_ERROR = "You need to enter your Credit Card Code to proceed.";
    
    var $_PHPSHOP_PRODUCT_FORM_FILENAME = "EITHER Fill in a Filename";
    var $_PHPSHOP_PRODUCT_FORM_FILENAME_TOOLTIP = "NOTE: Here you can fill in a FileName. <strong>If you fill in a Filename here, no Files will be uploaded!!! You will have to upload it via FTP manually!</strong>.";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD = "OR Upload new File";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD_TOOLTIP = "You can upload a local file. This file will be the Product you sell. An existing file will be replaced.";
    
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1 = "Fill in any text here that will be displayed to the customer on the product flypage.<br />e.g.: 24h, 48 hours, 3 - 5 days, On Order.....";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2 = "OR select an Image to be displayed on the Details Page (flypage).<br />The images reside in the directory <i>/components/com_phpshop/shop_image/availability</i><br />";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST = "Attribute List";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Examples for the Attribute List Format:</h4>
        <pre>Size,XL[+1.99],M,S[-2.99];Colour,Red,Green,Yellow,ExpensiveColor[=24.00];AndSoOn,..,..</pre>
        <h4>Inline price adjustments for using the Advanced Attributes modification:</h4>
        <pre>
        &#43; == Add this amount to the configured price.<br />
        &#45; == Subtract this amount from the configured price.<br />
        &#61; == Set the product's price to this amount.
      </pre>";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST = "Custom Attribute List";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Examples for the Custom attribute List Format:</h4>
        <pre>Name;Extras;</strong>...</pre>";
        
    var $_PHPSHOP_MULTISELECT = "Multiselect: use CTRL-Key and Mouse";
        
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN = "Enable eProcessingNetwork.com payment?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_EXPLAIN = "Check to use eProcessingNetwork.com with phpShop.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_TESTMODE = "Test mode ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_TESTMODE_EXPLAIN = "Select 'Yes' while testing. Select 'No' for enabling live transactions.";
	
	var $_PHPSHOP_ADMIN_CFG_EPN_USERNAME = "eProcessingNetwork.com Login ID";
	var $_PHPSHOP_ADMIN_CFG_EPN_USERNAME_EXPLAIN = "This is your eProcessingNetwork.com Login ID";
	var $_PHPSHOP_ADMIN_CFG_EPN_KEY = "eProcessingNetwork.com Transaction Key";
	var $_PHPSHOP_ADMIN_CFG_EPN_KEY_EXPLAIN = "This is your eProcessingNetwork.com Transaction Key";
	var $_PHPSHOP_ADMIN_CFG_EPN_AUTENTICATIONTYPE = "Authentication Type";
	var $_PHPSHOP_ADMIN_CFG_EPN_AUTENTICATIONTYPE_EXPLAIN = "This is the eProcessingNetwork.com authentication type.";

    var $_PHPSHOP_RELATED_PRODUCTS = "Related Products";
    var $_PHPSHOP_RELATED_PRODUCTS_TIP = "You can build up Product Relations using this List. Just select one or more products here and then they are <strong>Related Products</strong>.";
    
    var $_PHPSHOP_RELATED_PRODUCTS_HEADING = "You may also be interested in this/these product(s)";
        
    var $_PHPSHOP_IMAGE_ACTION = "Image Action";
    var $_PHPSHOP_NONE = "none";
    
    var $_PHPSHOP_ORDER_HISTORY = "Order History";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT = "Comment";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT_EMAIL = "Comments on your Order";
    var $_PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT = "Include this comment?";
    var $_PHPSHOP_ORDER_HISTORY_DATE_ADDED = "Date Added";
    var $_PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED = "Customer Notified?";
    var $_PHPSHOP_ORDER_STATUS_CHANGE = "Order Status Change";
    
     /* USPS Shipping Module */
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME = "USPS shipping username";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME_TOOLTIP = "USPS shipping username";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD = "USPS shipping password";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD_TOOLTIP = "USPS shipping password";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER = "USPS shipping server";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER_TOOLTIP = "USPS shipping server";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH = "USPS shipping path";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH_TOOLTIP = "USPS shipping path";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER = "USPS shipping container";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER_TOOLTIP = "USPS shipping container";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE = "USPS Package Size";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE_TOOLTIP = "USPS Package Size";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID = "USPS Package ID (must be 0, does not support multiple packages)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID_TOOLTIP = "USPS Package ID (must be 0, does not support multiple packages)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE = "USPS Shipping type (Express,First Class,Priority,Parcel,BPM,Library,Media)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE_TOOLTIP = "USPS Shipping type (Express,First Class,Priority,Parcel,BPM,Library,Media)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_HANDLING_FEE = "Handling Fee";
    var $_PHPSHOP_USPS_HANDLING_FEE = "Your Handling fee for this shipping method.";
    var $_PHPSHOP_USPS_HANDLING_FEE_TOOLTIP = "Your Handling fee for this shipping method.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE = "Your International Handling fee for USPS shipments.";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE_TOOLTIP = "Your International Handling fee for USPS shipments.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE = "Your International per pound rate for USPS shipments.";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE_TOOLTIP = "Your International per pound rate for USPS shipments.";
    var $_PHPSHOP_USPS_RESPONSE_ERROR = "USPS was not able to process the Shipping Rate Request.";
        
    /** Changed Product Type - Begin*/
    /*** Product Type ***/
    var $_PHPSHOP_PARAMETERS_LBL = "Parameters";
    var $_PHPSHOP_PRODUCT_TYPE_LBL = "Product Type";
    var $_PHPSHOP_PRODUCT_TYPE_LIST_LBL = "Product Type List";
    var $_PHPSHOP_PRODUCT_TYPE_ADDEDIT = "Add/Edit Product Type";
    // Product - Product Product Type list
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL = "Product Type List for";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_MNU = "List Product Types";
    // Product - Product Product Type form
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL = "Add Product Type for";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_MNU = "Add Product Type";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE = "Product Type";
    // Product - Product Type form
    var $_PHPSHOP_PRODUCT_TYPE_FORM_NAME = "Product Type Name";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION = "Product Type Description";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS = "Parameters";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_LBL = "Product Type Information";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH = "Publish?";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE = "Product Type Browse Page";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE = "Product Type Flypage";
    // Product - Product Type Parameter list
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL = "Parameters of Product Type";
    // Product - Product Type Parameter form
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LBL = "Parameter Information";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NOT_FOUND = "Product Type not found!";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME = "Parameter Name";
    VAR $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME_DESCRIPTION = "This name will be column name of table. Must be unicate and without space.<BR>For example: main_material";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL = "Parameter Label";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DESCRIPTION = "Parameter Description";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE = "Parameter Type";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_INTEGER = "Integer";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TEXT = "Text";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_SHORTTEXT = "Short Text";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_FLOAT = "Float";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_CHAR = "Char";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATETIME = "Date & Time";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE = "Date";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE_FORMAT = "YYYY-MM-DD";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME = "Time";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME_FORMAT = "HH:MM:SS";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_BREAK = "Break Line";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_MULTIVALUE = "Multiple Values";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES = "Possible Values";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_MULTISELECT = "Show Possible Values as Multiple select?";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES_DESCRIPTION = "<strong>If Possible Values are set, Parameter can have only this values. Example for Possible Values:</strong><BR><span class=\"sectionname\">Steel;Wood;Plastic;...</span>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT = "Default Value";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT_HELP_TEXT = "For Parameter Default Value use this format:<ul><li>Date: YYYY-MM-DD</li><li>Time: HH:MM:SS</li><li>Date & Time: YYYY-MM-DD HH:MM:SS</li></ul>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_UNIT = "Unit";
    
	/************************* FrontEnd ***************************/
	/** shop.parameter_search.php */
	var $_PHPSHOP_PARAMETER_SEARCH = "Advanced Search according to Parameters";
	var $_PHPSHOP_ADVANCED_PARAMETER_SEARCH = "Parameters Search";
	var $_PHPSHOP_PARAMETER_SEARCH_TEXT1 = "Do you will find products according to technical parametrs?<BR>You can used any prepared form:";
// 	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "There's no result matching your query.";
	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "I am sorry. There is no category for search.";
	/** shop.parameter_search_form.php */
	var $_PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE = "I am sorry. There is no published Product Type with this name.";
	var $_PHPSHOP_PARAMETER_SEARCH_IS_LIKE = "Is Like";
	var $_PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE = "Is NOT Like";
	var $_PHPSHOP_PARAMETER_SEARCH_FULLTEXT = "Full-Text Search";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL = "All Selected";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY = "Any Selected";
	var $_PHPSHOP_PARAMETER_SEARCH_RESET_FORM = "Reset Form";	
	/** shop.browse.php */
	var $_PHPSHOP_PARAMETER_SEARCH_IN_CATEGORY = "Search in Category";
	var $_PHPSHOP_PARAMETER_SEARCH_CHANGE_PARAMETERS = "Change Parameters";
	var $_PHPSHOP_PARAMETER_SEARCH_DESCENDING_ORDER = "Descending order";
	var $_PHPSHOP_PARAMETER_SEARCH_ASCENDING_ORDER = "Ascending order";
	/** shop.product.detail */
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETERS_IN_CATEGORY = "Parameters of Category";
	/** Changed Product Type - End*/
    
    // State form and list
    var $_PHPSHOP_STATE_LIST_MNU = "List State";
    var $_PHPSHOP_STATE_LIST_LBL = "State List for: ";
    var $_PHPSHOP_STATE_LIST_ADD = "Add/Update a State";
    var $_PHPSHOP_STATE_LIST_NAME = "State Name";
    var $_PHPSHOP_STATE_LIST_3_CODE = "State Code (3)";
    var $_PHPSHOP_STATE_LIST_2_CODE = "State Code (2)";
        
    // Opposite of Discount!
    var $_PHPSHOP_FEE = "Fee";
    
    var $_PHPSHOP_PRODUCT_CLONE = "Clone Product";
	
    var $_PHPSHOP_CSV_SETTINGS = "Settings";
    var $_PHPSHOP_CSV_DELIMITER = "Delimiter";
    var $_PHPSHOP_CSV_ENCLOSURE = "Field Enclosure Char";
    var $_PHPSHOP_CSV_UPLOAD_FILE = "Upload a CSV File";
    var $_PHPSHOP_CSV_SUBMIT_FILE = "Submit CSV File";
    var $_PHPSHOP_CSV_FROM_DIRECTORY = "Load from directory";
    var $_PHPSHOP_CSV_FROM_SERVER = "Load CSV File from Server";
    var $_PHPSHOP_CSV_EXPORT_TO_FILE = "Export to CSV File";
    var $_PHPSHOP_CSV_SELECT_FIELD_ORDERING = "Choose Field Ordering Type";
    var $_PHPSHOP_CSV_DEFAULT_ORDERING = "Default Ordering";
    var $_PHPSHOP_CSV_CUSTOMIZED_ORDERING = "My customized Ordering";
    var $_PHPSHOP_CSV_SUBMIT_EXPORT = "Export all Products to CSV File";
    var $_PHPSHOP_CSV_CONFIGURATION_HEADER = "CSV Import / Export Configuration";
    var $_PHPSHOP_CSV_SAVE_CHANGES = "Save Changes";
    var $_PHPSHOP_CSV_FIELD_NAME = "Field Name";
    var $_PHPSHOP_CSV_DEFAULT_VALUE = "default Value";
    var $_PHPSHOP_CSV_FIELD_ORDERING = "Field Ordering";
    var $_PHPSHOP_CSV_FIELD_REQUIRED = "Field Required?";
    var $_PHPSHOP_CSV_IMPORT_EXPORT = "Import/Export";
    var $_PHPSHOP_CSV_NEW_FIELD = "Add a new Field";
    var $_PHPSHOP_CSV_DOCUMENTATION = "Documentation";
    
    var $_PHPSHOP_PRODUCT_NOT_FOUND = "Sorry, but the Product you've requested wasn't found!";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS = "Show Products that are out of Stock";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN = "When enabled, Products that are currently not in Stock are displayed. Otherwise such Products are hidden.";
	
}
/** @global phpShopLanguage $PHPSHOP_LANG */
$PHPSHOP_LANG =& new phpShopLanguage();
?>
