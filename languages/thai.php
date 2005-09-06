<?php
/*
* @version $Id: thai.php,v 1.8 2005/06/22 19:50:45 soeren_nb Exp $
* @package Mambo_4.5.1
* @subpackage mambo-phpShop
*
* @copyright (C) 2004 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* @ภาษาไทยปรับปรุงโดย Chaisilp Panawiwatn 
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
* 
* www.mambo-phpshop.net
*/
class phpShopLanguage extends mosAbstractLanguage {

    /*####################
    GENERAL DEFINITIONS
    ####################*/
    
    var $_PHPSHOP_MENU = "เมนู"; // Menu
    var $_PHPSHOP_CATEGORY = "หมวดสินค้า"; // Category
    var $_PHPSHOP_CATEGORIES = "หมวดสินค้า"; // Categories
    var $_PHPSHOP_SELECT_CATEGORY = "เลือกประเภท : "; // Select a Category:
    var $_PHPSHOP_ADMIN = "ผู้ดูแลระบบ"; // Administration
    var $_PHPSHOP_PRODUCT = "สินค้า"; // Product
    var $_PHPSHOP_LIST = "รายการ"; // List
    var $_PHPSHOP_ALL = "ทั้งหมด"; // All
    var $_PHPSHOP_LIST_ALL_PRODUCTS = "รายการสินค้าทั้งหมด"; // List All Products
    var $_PHPSHOP_VIEW = "ดู"; // View
    var $_PHPSHOP_SHOW = "แสดง"; // Show
    var $_PHPSHOP_ADD = "เพิ่ม"; // Add
    var $_PHPSHOP_UPDATE = "ปรับปรุง"; // Update
    var $_PHPSHOP_DELETE = "ลบ"; // Delete
    var $_PHPSHOP_SELECT = "เลือก"; // Select
    var $_PHPSHOP_SUBMIT = "Submit";
    var $_PHPSHOP_RANDOM = "สินค้าวันนี้"; // Random Products
    var $_PHPSHOP_LATEST = "สินค้าล่าสุด"; // Latest Products
    
    /*#####################
    MODULE ACCOUNT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_HOME_TITLE = "หน้าร้าน"; // Home
    var $_PHPSHOP_CART_TITLE = "รถเข็นชำระเงิน"; // Cart
    var $_PHPSHOP_CHECKOUT_TITLE = "ทำรายการสั่งซื้อ"; // Checkout
    var $_PHPSHOP_LOGIN_TITLE = "ล็อกอิน"; // Login
    var $_PHPSHOP_LOGOUT_TITLE = "ออกจากระบบ"; // Logout
    var $_PHPSHOP_BROWSE_TITLE = "เลือก"; // Browse
    var $_PHPSHOP_SEARCH_TITLE = "ค้นหา"; // Search
    var $_PHPSHOP_ACCOUNT_TITLE = "จัดการบัญชีผู้ใช้งาน"; // Account Maintenance
    var $_PHPSHOP_NAVIGATION_TITLE = "ควบคุมทิศทาง"; // Navigation
    var $_PHPSHOP_DEPARTMENT_TITLE = "แผนก"; // Department
    var $_PHPSHOP_INFO = "รายละเอียด"; // Information
    
    var $_PHPSHOP_BROWSE_LBL = "เลือกซื้อ"; // Browse
    var $_PHPSHOP_PRODUCTS_LBL = "สินค้า"; // Products
    var $_PHPSHOP_PRODUCT_LBL = "สินค้า"; // Product
    var $_PHPSHOP_SEARCH_LBL = "ค้นหา"; // Search
    var $_PHPSHOP_FLYPAGE_LBL = "รายละเอียดสินค้า"; // Product Details
    var $_PHPSHOP_PRODUCT_SEARCH_LBL = "ค้นหาสินค้า"; // Product Search
    
    var $_PHPSHOP_PRODUCT_NAME_TITLE = "ชื่อสินค้า"; // Product Name
    var $_PHPSHOP_PRODUCT_CATEGORY_TITLE = "หมวดสินค้า"; // Product Category
    var $_PHPSHOP_PRODUCT_DESC_TITLE = "รายละเอียด"; // Description
    
    var $_PHPSHOP_CART_SHOW = "แสดงรถเข็น"; // Show Cart
    var $_PHPSHOP_CART_ADD_TO = "หยิบใส่รถเข็น"; // Add to Cart
    var $_PHPSHOP_CART_NAME = "ชื่อ"; // Name
    var $_PHPSHOP_CART_SKU = "รหัสสินค้า"; // SKU
    var $_PHPSHOP_CART_PRICE = "ราคา"; // Price
    var $_PHPSHOP_CART_QUANTITY = "จำนวน"; // Quantity
    var $_PHPSHOP_CART_SUBTOTAL = "ยอดรวม"; // Subtotal
    
    # Some messages
    var $_PHPSHOP_ADD_SHIPTO_1 = "เพิ่ม"; // Add a new
    var $_PHPSHOP_ADD_SHIPTO_2 = "สถานที่จัดส่ง"; // Shipping Address
    var $_PHPSHOP_NO_SEARCH_RESULT = "ไม่่พบรายการที่ค้นหา<br />"; // Your search returned 0 results.<br />
    var $_PHPSHOP_PRICE_LABEL = "ราคา: "; // Price: 
    var $_PHPSHOP_ORDER_BUTTON_LABEL = "หยิบใส่รถเข็น"; // Add to Cart
    var $_PHPSHOP_NO_CUSTOMER = "ท่านยังไม่ได้ลงทะเบียน กรุณาระบุรายละเอียดของท่าน"; // You are not a Registered Customer yet. Please provide your Billing Information.
    var $_PHPSHOP_DELETE_MSG = "ต้องการลบรายการนี้?"; // Are you sure you want to delete this record?
    var $_PHPSHOP_THANKYOU = "ขอบคุณที่สั่งซื้อสินค้า"; // Thank you for your order.
    var $_PHPSHOP_NOT_SHIPPED = "ยังไม่ได้จัดส่ง"; // Not Shipped Yet
    var $_PHPSHOP_EMAIL_SENDTO = "การยืนยันรายการได้จัดส่งให้ทางอีเมล์แล้ว"; // A confirmation email has been sent to
    var $_PHPSHOP_NO_USER_TO_SELECT = "ขออภัย ไม่พบผู้ใช้ในระบบของแมมโบ้จึงไม่สามารถเพิ่มในส่วนของผู้ใช้งาน com_phpshop"; // Sorry, there's no MOS - user that you could add to the com_phpshop userlist

    
    // Error messages
    
    var $_PHPSHOP_ERROR = "ผิดพลาด"; // ERROR
    var $_PHPSHOP_MOD_NOT_REG = "ยังไม่ได้ลงทะเบียนโมดูล"; // Module Not Registered.
    var $_PHPSHOP_MOD_ISNO_REG = "ไม่ใช่โมดูลของ phpShop"; // is not a valid phpShop module.
    var $_PHPSHOP_MOD_NO_AUTH = "ท่านไม่มีสิทธิ์ในการเข้าถึงโมดูลนี้"; // You do not have permission to access the requested module.
    var $_PHPSHOP_PAGE_404_1 = "ยังไม่ได้ติดตั้ง"; // Page Does Not Exist
    var $_PHPSHOP_PAGE_404_2 = "ไม่พบไฟล์นี้:"; // Given filename does not exist. Cannot find file:
    var $_PHPSHOP_PAGE_403 = "การเข้าถึงไม่ถูกต้อง"; // Insufficient Access Rights
    var $_PHPSHOP_FUNC_NO_EXEC = "ท่านไม่มีสิทธิ์ใช้งาน "; // You do not have permission to execute 
    var $_PHPSHOP_FUNC_NOT_REG = "ยังไม่ได้ลงทะเบียนฟังก์ชั่น"; // Function Not Registered
    var $_PHPSHOP_FUNC_ISNO_REG = " ไม่ใช่ฟังก์ชั่นของ MOS_com_phpShop"; //  is not a valid MOS_com_phpShop function.
    
    /*#####################
    MODULE ADMIN
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADMIN_MOD = "ผู้ดูแลระบบ"; // Admin
    
    
    // User List
    var $_PHPSHOP_USER_LIST_MNU = "ผู้ใช้งาน"; // List Users
    var $_PHPSHOP_USER_LIST_LBL = "ผู้ใช้งาน"; // User List
    var $_PHPSHOP_USER_LIST_USERNAME = "ชื่อผู้ใช้"; // Username
    var $_PHPSHOP_USER_LIST_FULL_NAME = "ชื่อเต็ม"; // Full Name
    var $_PHPSHOP_USER_LIST_GROUP = "กลุ่ม"; // Group
    
    // User Form
    var $_PHPSHOP_USER_FORM_MNU = "เพิ่มผู้ใช้งาน"; // Add User
    var $_PHPSHOP_USER_FORM_LBL = "เพิ่ม / แก้ไขรายละเอียดผู้ใช้งาน"; // Add/Update User Information
    var $_PHPSHOP_USER_FORM_BILLTO_LBL = "ที่อยู่ใบแจ้งหนี้"; // Bill To Information
    var $_PHPSHOP_USER_FORM_SHIPTO_LBL = "สถานที่จัดส่ง"; // Shipping Addresses
    var $_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL = "เพิ่มที่อยู่"; // Add Address
    var $_PHPSHOP_USER_FORM_ADDRESS_LABEL = "ชื่อเรียก"; // Address Nickname
    var $_PHPSHOP_USER_FORM_FIRST_NAME = "ชื่อ"; // First Name
    var $_PHPSHOP_USER_FORM_LAST_NAME = "นามสกุล"; // Last Name
    var $_PHPSHOP_USER_FORM_MIDDLE_NAME = "ชื่อกลาง"; // Middle Name
    var $_PHPSHOP_USER_FORM_TITLE = "คำนำหน้าชื่อ"; // Title
    var $_PHPSHOP_USER_FORM_USERNAME = "ชื่อผู้ใช้"; // Username
    var $_PHPSHOP_USER_FORM_PASSWORD_1 = "รหัสผ่าน"; // Password
    var $_PHPSHOP_USER_FORM_PASSWORD_2 = "ยืนยันรหัสผ่าน"; // Confirm Password
    var $_PHPSHOP_USER_FORM_PERMS = "การกำหนดสิทธิ์"; // Permissions
    var $_PHPSHOP_USER_FORM_COMPANY_NAME = "บริษัท"; // Company Name
    var $_PHPSHOP_USER_FORM_ADDRESS_1 = "ที่อยู่ 1"; // Address 1
    var $_PHPSHOP_USER_FORM_ADDRESS_2 = "ที่อยู่ 2"; // Address 2
    var $_PHPSHOP_USER_FORM_CITY = "อำเภอ"; // City
    var $_PHPSHOP_USER_FORM_STATE = "เขต/จังหวัด"; // State/Province/Region
    var $_PHPSHOP_USER_FORM_ZIP = "รหัสไปรษณีย์"; // Zip/ Postal Code
    var $_PHPSHOP_USER_FORM_COUNTRY = "ประเทศ"; // Country
    var $_PHPSHOP_USER_FORM_PHONE = "โทรศัพท์"; // Phone
    var $_PHPSHOP_USER_FORM_FAX = "โทรสาร"; // Fax
    var $_PHPSHOP_USER_FORM_EMAIL = "อีเมล์"; // Email
    
    // Module List
    var $_PHPSHOP_MODULE_LIST_MNU = "โมดูล"; // List Modules
    var $_PHPSHOP_MODULE_LIST_LBL = "โมดูล"; // Module List
    var $_PHPSHOP_MODULE_LIST_NAME = "ชื่อโมดูล"; // Module Name
    var $_PHPSHOP_MODULE_LIST_PERMS = "ผู้มีสิทธิ์ใช้งาน"; // Module Perms
    var $_PHPSHOP_MODULE_LIST_FUNCTIONS = "ฟังก์ชั่น"; // Functions
    var $_PHPSHOP_MODULE_LIST_ORDER = "เรียงลำดับ"; // ListOrder
    
    // Module Form
    var $_PHPSHOP_MODULE_FORM_MNU = "เพิ่มโมดูล"; // Add Module
    var $_PHPSHOP_MODULE_FORM_LBL = "รายละเอียดโมดูล"; // Module Information
    var $_PHPSHOP_MODULE_FORM_MODULE_LABEL = "ชื่อโมดูล (สำหรับเมนูด้านบน)"; // Module Label (for Topmenu)
    var $_PHPSHOP_MODULE_FORM_NAME = "ชื่อโมดูล"; // Module Name
    var $_PHPSHOP_MODULE_FORM_PERMS = "ผู้มีสิทธิ์ใช้งาน"; // Module Perms
    var $_PHPSHOP_MODULE_FORM_HEADER = "โมดูล Header"; // Module Header
    var $_PHPSHOP_MODULE_FORM_FOOTER = "โมดูล Footer"; // Module Footer
    var $_PHPSHOP_MODULE_FORM_MENU = "แสดงรายการโมดูลในส่วนของเมนูผู้ดูแลระบบ?"; // Show Module in Admin menu?
    var $_PHPSHOP_MODULE_FORM_ORDER = "ลำดับการแสดง"; // Display Order
    var $_PHPSHOP_MODULE_FORM_DESCRIPTION = "รายละเอียดโมดูล"; // Module Description
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_CODE = "รหัสภาษา"; // Language Code
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_file = "ไฟล์ภาษา"; // Language File
    
    // Function List
    var $_PHPSHOP_FUNCTION_LIST_MNU = "ฟังก์ชั่้น"; // List Functions
    var $_PHPSHOP_FUNCTION_LIST_LBL = "ฟังก์ชั่้น"; // Function List
    var $_PHPSHOP_FUNCTION_LIST_NAME = "ชื่อฟังก์ชั่้น"; // Function Name
    var $_PHPSHOP_FUNCTION_LIST_CLASS = "ชื่อคลาส"; // Class Name
    var $_PHPSHOP_FUNCTION_LIST_METHOD = "คลาสเมธอด"; // Class Method
    var $_PHPSHOP_FUNCTION_LIST_PERMS = "ผู้มีสิทธิ์ใช้งาน"; // Perms
    
    // Module Form
    var $_PHPSHOP_FUNCTION_FORM_MNU = "เพิ่มฟังก์ชั่น"; // Add Function
    var $_PHPSHOP_FUNCTION_FORM_LBL = "รายละเอียดฟังก์ชั่น"; // Function Information
    var $_PHPSHOP_FUNCTION_FORM_NAME = "ชื่อฟังก์ชั่น"; // Function Name
    var $_PHPSHOP_FUNCTION_FORM_CLASS = "ชื่อคลาส"; // Class Name
    var $_PHPSHOP_FUNCTION_FORM_METHOD = "คลาสเมธอด"; // Class Method
    var $_PHPSHOP_FUNCTION_FORM_PERMS = "ผู้มีสิทธิ์ใช้งาน"; // Function Perms
    var $_PHPSHOP_FUNCTION_FORM_DESCRIPTION = "รายละเอียดฟังก์ชั่น"; // Function Description
    
    // Currency form and list
    var $_PHPSHOP_CURRENCY_LIST_MNU = "สกุลเงิน"; // List Currencies
    var $_PHPSHOP_CURRENCY_LIST_LBL = "สกุลเงิน"; // Currency List
    var $_PHPSHOP_CURRENCY_LIST_ADD = "เพิ่มสกุลเงิน"; // Add Currency
    var $_PHPSHOP_CURRENCY_LIST_NAME = "ชื่อสกุลเงิน"; // Currency Name
    var $_PHPSHOP_CURRENCY_LIST_CODE = "สัญลักษณ์"; // Currency Code
    
    // Country form and list
    var $_PHPSHOP_COUNTRY_LIST_MNU = "ประเทศ"; // List Countries
    var $_PHPSHOP_COUNTRY_LIST_LBL = "รายชื่อประเทศ"; // Country List
    var $_PHPSHOP_COUNTRY_LIST_ADD = "เพิ่มประเทศ"; // Add Country
    var $_PHPSHOP_COUNTRY_LIST_NAME = "ชื่อประเทศ"; // Country Name
    var $_PHPSHOP_COUNTRY_LIST_3_CODE = "รหัสประเทศ (3)"; // Country Code (3)
    var $_PHPSHOP_COUNTRY_LIST_2_CODE = "รหัสประเทศ (2)"; // Country Code (2)
    
    /*#####################
    MODULE CHECKOUT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADDRESS = "ที่อยู่"; // Address
    var $_PHPSHOP_CONTINUE = "ทำรายการต่อ"; // Continue
    
    # Some messages
    var $_PHPSHOP_EMPTY_CART = "รถเข็นของท่านยังไม่มีรายการสินค้า"; // Your Cart is currently empty.
    
    
    /*#####################
    MODULE ISShipping
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ISSHIPPING_MOD = "InterShipper"; // InterShipper
    
    
    // Shipping Ping
    var $_PHPSHOP_ISSHIP_PING_MNU = "Ping InterShipper Server"; // Ping InterShipper Server
    var $_PHPSHOP_ISSHIP_PING_LBL = "InterShipper-Server Ping "; // InterShipper-Server Ping 
    var $_PHPSHOP_ISSHIP_PING_ERROR_LBL = "InterShipper Ping ล้มเหลว"; // InterShipper Ping Failed
    var $_PHPSHOP_ISSHIP_PING_GOOD_LBL = "InterShipper Ping สำเร็จ"; // InterShipper Ping Successful
    var $_PHPSHOP_ISSHIP_PING_CARRIER_LBL = "ผู้ส่ง"; // Carrier
    var $_PHPSHOP_ISSHIP_PING_RESPONSE_LBL = "ตอบรับ<br />เวลา"; // Response<br />Time
    var $_PHPSHOP_ISSHIP_PING_TIME_LBL = "วินาที"; // sec.
    
    // Shipping List
    var $_PHPSHOP_ISSHIP_LIST_MNU = "วิธีการขนส่ง"; // List Ship Methods
    var $_PHPSHOP_ISSHIP_LIST_LBL = "เลือก"; // Active Ship Methods
    var $_PHPSHOP_ISSHIP_LIST_CARRIER_LBL = "วิธีการขนส่ง"; // Ship Methods
    var $_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL = "เลือก"; // Active
    var $_PHPSHOP_ISSHIP_LIST_RATE_LBL = "่ค่าจัดการ"; // Handling Charge
    var $_PHPSHOP_ISSHIP_LIST_LEAD_LBL = "ช่วงเวลา"; // Lead Time
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_F_LBL = "อัตราคงที่"; // flat rate
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_P_LBL = "เปอร์เซ็นต์"; // percent
    var $_PHPSHOP_ISSHIP_LIST_DAYS_LBL = "วัน"; // days
    var $_PHPSHOP_ISSHIP_LIST_HEAVY_LBL = "น้ำหนักบรรทุกมาก"; // Heavy Loads
    
    // Dynamic Shipping Form
    var $_PHPSHOP_ISSHIP_FORM_MNU = "ตั้งค่าวิธีการขนส่ง"; // Configure Ship Methods
    var $_PHPSHOP_ISSHIP_FORM_ADD_LBL = "เพิ่มวิธีการขนส่ง"; // Add Ship Method
    var $_PHPSHOP_ISSHIP_FORM_UPDATE_LBL = "ตั้งค่าวิธีการขนส่ง"; // Configure Ship Method
    var $_PHPSHOP_ISSHIP_FORM_REFRESH_LBL = "รีเฟรช"; // Refresh
    var $_PHPSHOP_ISSHIP_FORM_CARRIER_LBL = "วิธีการขนส่ง"; // Ship Method
    var $_PHPSHOP_ISSHIP_FORM_PUBLISH_LBL = "เลือก"; // Activate
    var $_PHPSHOP_ISSHIP_FORM_HANDLING_LBL = "่ค่าจัดการ"; // Handling Charge
    var $_PHPSHOP_ISSHIP_FORM_LEAD_LBL = "ช่วงเวลา"; // Lead Time
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_F_LBL = "อัตราคงที่"; // flat rate
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_P_LBL = "เปอร์เซ็นต์"; // percent
    var $_PHPSHOP_ISSHIP_FORM_DAYS_LBL = "วัน"; // days
    var $_PHPSHOP_ISSHIP_FORM_HEAVY_LBL = "น้ำหนักบรรทุกมาก"; // Heavy Loads
    
    
    
    /*#####################
    MODULE ORDER
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_ORDER_MOD = "รายการสั่งซื้อ"; // Orders
    
    // Some menu options 
    var $_PHPSHOP_ORDER_CONFIRM_MNU = "ยืนยันการสั่งซื้อ"; // Confirm Order
    var $_PHPSHOP_ORDER_CANCEL_MNU = "ยกเลิกการสั่งซื้อ"; // Cancel Order
    var $_PHPSHOP_ORDER_PRINT_MNU = "พิมพ์รายการสั่งซื้อ"; // Print Order
    var $_PHPSHOP_ORDER_DELETE_MNU = "ลบรายการสั่งซื้อ"; // Delete Order
    
    // Order List
    var $_PHPSHOP_ORDER_LIST_MNU = "รายการสั่งซื้อ"; // List Orders
    var $_PHPSHOP_ORDER_LIST_LBL = "รายการสั่งซื้อ"; // Order List
    var $_PHPSHOP_ORDER_LIST_ID = "เลขที่สั่งซื้อ"; // Order Number
    var $_PHPSHOP_ORDER_LIST_CDATE = "วันที่สั่งซื้อ"; // Order Date
    var $_PHPSHOP_ORDER_LIST_MDATE = "ปรับปรุงล่าสุด"; // Last Modified
    var $_PHPSHOP_ORDER_LIST_STATUS = "สุถานภาพ"; // Status
    var $_PHPSHOP_ORDER_LIST_TOTAL = "ยอดรวม"; // SubTotal
    var $_PHPSHOP_ORDER_ITEM = "รายการสั่งซื้อ"; // Order Items
    
    // Order print
    var $_PHPSHOP_ORDER_PRINT_PO_LBL = "รายการสั่งซื้อ"; // Purchase Order
    var $_PHPSHOP_ORDER_PRINT_PO_NUMBER = "เลขที่ใบสั่งซื้อ"; // Order Number
    var $_PHPSHOP_ORDER_PRINT_PO_DATE = "วันที่สั่งซื้อ"; // Order Date
    var $_PHPSHOP_ORDER_PRINT_PO_STATUS = "สถานะการสั่งซื้อ"; // Order Status
    var $_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL = "รายละเอียดลูกค้า"; // Customer Information
    var $_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL = "รายละเอียดใบแจ้งหนี้"; // Billing Information
    var $_PHPSHOP_ORDER_PRINT_CUST_SHIPPING_LBL = "รายละเอียดสถานที่จัดส่ง"; // Shipping Information
    var $_PHPSHOP_ORDER_PRINT_BILL_TO_LBL = "ใบแจ้งหนี้"; // Bill To
    var $_PHPSHOP_ORDER_PRINT_SHIP_TO_LBL = "สถานที่จัดส่ง"; // Ship To
    var $_PHPSHOP_ORDER_PRINT_NAME = "ชื่อ"; // Name
    var $_PHPSHOP_ORDER_PRINT_COMPANY = "บริษัท"; // Company
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_1 = "ที่อยู่ 1"; // Address 1
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_2 = "ที่อยู่ 2"; // Address 2
    var $_PHPSHOP_ORDER_PRINT_CITY = "อำเภอ"; // City
    var $_PHPSHOP_ORDER_PRINT_STATE = ""; // State/Province/Region
    var $_PHPSHOP_ORDER_PRINT_ZIP = "รหัสไปรษณีย์"; // Zip/Postal Code
    var $_PHPSHOP_ORDER_PRINT_COUNTRY = "ประเทศ"; // Country
    var $_PHPSHOP_ORDER_PRINT_PHONE = "โทรศัพท์"; // Phone
    var $_PHPSHOP_ORDER_PRINT_FAX = "โทรสาร"; // Fax
    var $_PHPSHOP_ORDER_PRINT_EMAIL = "อีเมล์"; // Email
    var $_PHPSHOP_ORDER_PRINT_ITEMS_LBL = "รายการ"; // Order Items
    var $_PHPSHOP_ORDER_PRINT_QUANTITY = "จำนวน"; // Quantity
    var $_PHPSHOP_ORDER_PRINT_QTY = "จำนวน"; // Qty
    var $_PHPSHOP_ORDER_PRINT_SKU = "รหัสสินค้า"; // SKU
    var $_PHPSHOP_ORDER_PRINT_PRICE = "ราคา"; // Price
    var $_PHPSHOP_ORDER_PRINT_TOTAL = "รวมทั้งสิ้น"; // Total
    var $_PHPSHOP_ORDER_PRINT_SUBTOTAL = "ยอดรวม"; // SubTotal
    var $_PHPSHOP_ORDER_PRINT_TOTAL_TAX = "ยอดภาษีรวม"; // Tax Total
    var $_PHPSHOP_ORDER_PRINT_SHIPPING = "ค่าขนส่งและค่าจัดการ"; // Shipping and Handling Fee
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_TAX = "ภาษีขนส่ง"; // Shipping Tax
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LBL = "วิธีชำระเงิน"; // Payment Method
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NAME = "ชื่อบัญชี"; // Account Name
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER = "หมายเลขบัญชี"; //Account Number 
    var $_PHPSHOP_ORDER_PRINT_EXPIRE_DATE = "วันหมดอายุ"; // Expire Date
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL = "บันทึกการชำระเงิน"; // Payment Log
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_LBL = "รายละเอียดการขนส่ง"; // Shipping Information
    var $_PHPSHOP_ORDER_PRINT_PAYINFO_LBL = "รายละเอียดการชำระเงิน"; // Payment Information
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL = "ผู้ขนส่ง"; // Carrier
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL = "หมวดการขนส่ง"; // Shipping Mode
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_DATE_LBL = "วันที่จัดส่ง"; // Ship Date
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL = "ค่าขนส่ง"; // Shipping Price
    
    var $_PHPSHOP_ORDER_STATUS_LIST_MNU = "สถานะการสั่งซื้อ"; // List Order Status Types
    var $_PHPSHOP_ORDER_STATUS_FORM_MNU = "เพิ่มสถานะ"; // Add Order Status Type
    
    var $_PHPSHOP_ORDER_STATUS_LIST_CODE = "รหัสสถานะ"; // Order Status Code
    var $_PHPSHOP_ORDER_STATUS_LIST_NAME = "ชื่อสถานะ"; // Order Status Name
    
    var $_PHPSHOP_ORDER_STATUS_FORM_LBL = "สถานะการสั่งซื้อ"; // Order Status
    var $_PHPSHOP_ORDER_STATUS_FORM_CODE = "รหัสสถานะ"; // Order Status Code
    var $_PHPSHOP_ORDER_STATUS_FORM_NAME = "ชื่อสถานะ"; // Order Status Name
    var $_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER = "เรียงลำดับ"; // List Order
    
    
    /*#####################
    MODULE PRODUCT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_PRODUCT_MOD = "สินค้า"; // Products
    
    var $_PHPSHOP_CURRENT_PRODUCT = "สินค้าปัจจุบัน"; // Current Product
    var $_PHPSHOP_CURRENT_ITEM = "รายการปัจจุบัน"; // Current Item
    
    // Product Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_LBL = "สินค้าคงคลัง"; // Product Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_MNU = "สินค้าคงคลัง"; // View Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_PRICE = "ราคา"; // Price
    var $_PHPSHOP_PRODUCT_INVENTORY_STOCK = "จำนวน"; // Number
    var $_PHPSHOP_PRODUCT_INVENTORY_WEIGHT = "น้ำหนัก"; // Weight
    // Product List
    var $_PHPSHOP_PRODUCT_LIST_MNU = "รายการสินค้า"; // List Products
    var $_PHPSHOP_PRODUCT_LIST_LBL = "รายการสินค้า"; // Product List
    var $_PHPSHOP_PRODUCT_LIST_NAME = "ชื่อสินค้า"; // Product Name
    var $_PHPSHOP_PRODUCT_LIST_SKU = "รหัสสินค้า"; // SKU
    var $_PHPSHOP_PRODUCT_LIST_PUBLISH = "เผยแพร่"; // Publish
    
    // Product Form
    var $_PHPSHOP_PRODUCT_FORM_MNU = "เพิ่มรายการสินค้า"; // Add Product
    var $_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT = "แก้ไขรายการสินค้านี้"; // Edit this product
    var $_PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE = "แสดงสินค้า"; // Preview product flypage in shop
    var $_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU = "เพิ่มรายการ"; // Add Item
    var $_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU = "เพิ่มรายการอื่นๆ"; // Add Another Item
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL = "สินค้าใหม่"; // New Product
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_PRODUCT_LBL = "ปรับปรุงสินค้า"; // Update Product
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL = "รายละเอียดสินค้า"; // Product Information
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL = "สถานะสินค้า"; // Product Status
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL = "ขนาดและน้ำหนัก"; // Product Dimensions and Weight
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL = "ภาพถ่ายสินค้า"; // Product Images
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL = "รายการใหม่"; // New Item
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL = "ปรับปรุงรายการ"; // Update Item
    var $_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL = "รายละเอียด"; // Item Information
    var $_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL = "สถานะ"; // Item Status
    var $_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL = "ขนาดและน้ำหนัก"; // Item Dimensions and Weight
    var $_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL = "รูปภาพ"; // Item Images
    var $_PHPSHOP_PRODUCT_FORM_RETURN_LBL = "กลับไปยังหน้าสินค้าหลัก"; // Return to Parent Product
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL = "ต้องการเปลี่ยนแปลงรูปภาพ เลือกภาพใหม่"; // To update actual image, type in path to new image.
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL = "พิมพ์ \"none\" เพื่อลบภาพปัจจุบัน"; // Type \"none\" to delete current image.
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL = "รายการสินค้า"; // Product Items
    var $_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL = "คุณลักษณะ"; // Item Attributes
    var $_PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG = "ต้องการลบสินค้า \\nและรายละเอียดที่เกี่ยวข้องกับสินค้านี้?"; // Are you sure you want to delete this Product\\nand the Items related to it?";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG = "ต้องการลบรายการนี้หรือไม่?"; // Are you sure you want to delete this Item?
    var $_PHPSHOP_PRODUCT_FORM_VENDOR = "ผู้ขาย"; // Vendor
    var $_PHPSHOP_PRODUCT_FORM_MANUFACTURER = "โรงงาน"; // Manufacturer
    var $_PHPSHOP_PRODUCT_FORM_SKU = "รหัสสินค้า"; // SKU
    var $_PHPSHOP_PRODUCT_FORM_NAME = "ชื่อ"; // Name
    var $_PHPSHOP_PRODUCT_FORM_URL = "เว็บไซต์"; // URL
    var $_PHPSHOP_PRODUCT_FORM_CATEGORY = "หมวดสินค้า"; // Category
    var $_PHPSHOP_PRODUCT_FORM_CATEGORY2 = "หมวดสินค้า 2"; // Category 2
    var $_PHPSHOP_PRODUCT_FORM_PRICE = "ราคาขายปลีก"; // Retail Price
    var $_PHPSHOP_PRODUCT_FORM_DESCRIPTION = "หน้าต่างแสดงรายละเอียด"; // Flypage Description
    var $_PHPSHOP_PRODUCT_FORM_S_DESC = "รายละเอียด"; // Short Description
    var $_PHPSHOP_PRODUCT_FORM_IN_STOCK = "สินค้าในสต็อค"; // In Stock
    var $_PHPSHOP_PRODUCT_FORM_ON_ORDER = "มีตามสั่ง แต่ยังไม่มีสินค้า"; // On Order
    var $_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE = "วันที่มีสินค้า"; // Availability Date
    var $_PHPSHOP_PRODUCT_FORM_SPECIAL = "รายการพิเศษ"; // On Special
    var $_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE = "ประเภทส่วนลด"; // Discount Type
    var $_PHPSHOP_PRODUCT_FORM_PUBLISH = "เผยแพร่?"; // Publish
    var $_PHPSHOP_PRODUCT_FORM_LENGTH = "ยาว"; // Length
    var $_PHPSHOP_PRODUCT_FORM_WIDTH = "กว้าง"; // Width
    var $_PHPSHOP_PRODUCT_FORM_HEIGHT = "สูง"; // Height
    var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM = "หน่วยนับ"; // Unit of Measure
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT = "น้ำหนัก"; // Weight
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM = "หน่วยนับ"; // Unit of Measure
    var $_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE = "รูปภาพย่อ"; // Thumb Nail
    var $_PHPSHOP_PRODUCT_FORM_FULL_IMAGE = "รูปภาพ"; // Full Image
    
    // Product Display
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL = "ผลการเพิ่มสินค้า"; // Product Add Results
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL = "ผลการปรับปรุงสินค้า"; // Product Update Results
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL = "ผลการเพิ่มรายการ"; // Item Add Results
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL = "ผลการปรับปรุงรายการ"; // Item Update Results
    var $_PHPSHOP_PRODUCT_CSV_UPLOAD = "นำเข้าข้อมูลจากไฟล์ CSV"; // Use CSV upload
    var $_PHPSHOP_PRODUCT_FOLDERS = "โฟลเดอร์หมวดหมู่สินค้า"; // Product Folders
    
    // Product Category List
    var $_PHPSHOP_CATEGORY_LIST_MNU = "ประเภทสินค้า"; // List Categories
    var $_PHPSHOP_CATEGORY_LIST_LBL = "หมวดสินค้า"; // Category Tree
    
    // Product Category Form
    var $_PHPSHOP_CATEGORY_FORM_MNU = "เพิ่มหมวดสินค้า"; // Add Category
    var $_PHPSHOP_CATEGORY_FORM_LBL = "รายละเอียด"; //Category Information 
    var $_PHPSHOP_CATEGORY_FORM_NAME = "ชื่อหมวด"; // Category Name
    var $_PHPSHOP_CATEGORY_FORM_PARENT = "หมวดหลัก"; // Parent
    var $_PHPSHOP_CATEGORY_FORM_DESCRIPTION = "รายละเอียด"; // Category Description
    var $_PHPSHOP_CATEGORY_FORM_PUBLISH = "เผยแพร่?"; // Publish?
    var $_PHPSHOP_CATEGORY_FORM_FLYPAGE = "หน้าต่างแสดงหมวดสินค้า"; // Category Flypage
    
    // Product Attribute List
    var $_PHPSHOP_ATTRIBUTE_LIST_MNU = "คุณลักษณะ"; // List Attributes
    var $_PHPSHOP_ATTRIBUTE_LIST_LBL = "คุณลักษณะ"; // Attribute List for
    var $_PHPSHOP_ATTRIBUTE_LIST_NAME = "คุณลักษณะ"; // Attribute Name
    var $_PHPSHOP_ATTRIBUTE_LIST_ORDER = "เรียงลำดับ"; // List Order
    
    // Product Attribute Form
    var $_PHPSHOP_ATTRIBUTE_FORM_MNU = "เพิ่มคุณลักษณะ"; // Add Attribute
    var $_PHPSHOP_ATTRIBUTE_FORM_LBL = "แบบฟอร์มคุณลักษณะ"; // Attribute Form
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT = "เพิ่มคุณลักษณะใหม่สำหรับสินค้า"; // New Attribute for Product
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT = "ปรับปรุงคุณลักษณะสินค้า"; // Update Attribute for Product
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM = "เพิ่มรายการคุณลักษณะใหม่"; // New Attribute for Item
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM = "ปรับปรุงรายการคุณลักษณะ"; // Update Attribute for Item
    var $_PHPSHOP_ATTRIBUTE_FORM_NAME = "ชื่อคุณลักษณะ"; // Attribute Name
    var $_PHPSHOP_ATTRIBUTE_FORM_ORDER = "เรียงลำดับ"; // List Order
    
    // Product Price List
    var $_PHPSHOP_PRICE_LIST_MNU = "รายการหมวดสินค้า"; // List Categories
    var $_PHPSHOP_PRICE_LIST_LBL = "รายการราคา"; // Price Tree
    var $_PHPSHOP_PRICE_LIST_FOR_LBL = "ราคาสำหรับ"; // Price for
    var $_PHPSHOP_PRICE_LIST_GROUP_NAME = "ชื่อหมวด"; // Group Name
    var $_PHPSHOP_PRICE_LIST_PRICE = "ราคา"; // Price
    var $_PHPSHOP_PRODUCT_LIST_CURRENCY = "สกุลเงิน"; // Currency
    
    // Product Price Form
    var $_PHPSHOP_PRICE_FORM_MNU = "เพิ่มราคาใหม่"; // Add Price
    var $_PHPSHOP_PRICE_FORM_LBL = "รายละเอียดราคา"; // Price Information
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT = "ราคาสินค้าใหม่ สำหรับสินค้า "; // New Price for Product
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT = "ปรับปรุงราคาสินค้า"; // Update Price for Product
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_ITEM = "ราคาใหม่"; // New Price for Item
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM = "ปรับปรุงราคา"; // Update Price for Item
    var $_PHPSHOP_PRICE_FORM_PRICE = "ราคา"; // Price
    var $_PHPSHOP_PRICE_FORM_CURRENCY = "สกุลเงิน"; // Currency
    var $_PHPSHOP_PRICE_FORM_GROUP = "กลุ่มผู้ซื้อ"; // Shopper Group
    
    
    /*#####################
    MODULE REPORT BASIC
    #####################*/
    # Some LABELs
    var $_PHPSHOP_REPORTBASIC_MOD = "รายงาน"; // Reports
    var $_PHPSHOP_RB_INDIVIDUAL = "เฉพาะรายการสินค้า"; // Individual Product Listings
    var $_PHPSHOP_RB_SALE_TITLE = "รายงานยอดขาย"; // Sales Reporting
    
    /* labels for rpt_sales */
    var $_PHPSHOP_RB_SALES_PAGE_TITLE = "รายงานยอดขาย"; // Sales Activity Overview
    
    var $_PHPSHOP_RB_INTERVAL_TITLE = "กำหนดระยะเวลา"; // Set Interval
    var $_PHPSHOP_RB_INTERVAL_MONTHLY_TITLE = "รายเดือน"; // Monthly
    var $_PHPSHOP_RB_INTERVAL_WEEKLY_TITLE = "รายสัปดาห์"; // Weekly
    var $_PHPSHOP_RB_INTERVAL_DAILY_TITLE = "รายวัน"; // Daily
    
    var $_PHPSHOP_RB_THISMONTH_BUTTON = "เดือนนี้"; // This Month
    var $_PHPSHOP_RB_LASTMONTH_BUTTON = "เดือนที่แล้ว"; // Last Month
    var $_PHPSHOP_RB_LAST60_BUTTON = "60 วันสุดท้าย"; // Last 60 days
    var $_PHPSHOP_RB_LAST90_BUTTON = "90 วันสุดท้าย"; // Last 90 days
    
    var $_PHPSHOP_RB_START_DATE_TITLE = "เิริ่มวันที่"; // Start on
    var $_PHPSHOP_RB_END_DATE_TITLE = "ถึงวันที่"; // End at
    var $_PHPSHOP_RB_SHOW_SEL_RANGE = "แสดงรายการตามที่เลือก"; // Show this selected range
    var $_PHPSHOP_RB_REPORT_FOR = "รายงานสำหรับ "; // Report for 
    var $_PHPSHOP_RB_DATE = "วันที่"; // Date
    var $_PHPSHOP_RB_ORDERS = "รายการสั่งซื้อ"; // Orders
    var $_PHPSHOP_RB_TOTAL_ITEMS = "รายการขายรวม"; // Total Items sold
    var $_PHPSHOP_RB_REVENUE = "รายได้"; // Revenue
    var $_PHPSHOP_RB_PRODLIST = "รายการสินค้า"; // Product Listing
    
    
    
    /*#####################
    MODULE SHOP
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOP_MOD = "ร้านค้า"; // Shop
    var $_PHPSHOP_PRODUCT_THUMB_TITLE = "รูปภาพ"; // Image
    var $_PHPSHOP_PRODUCT_PRICE_TITLE = "ราคา"; // Price
    var $_PHPSHOP_ORDER_STATUS_P = "กำลังดำเนินการ"; // Pending
    var $_PHPSHOP_ORDER_STATUS_C = "ยืนยันการสั่งซื้อ"; // Confirmed
    var $_PHPSHOP_ORDER_STATUS_X = "ยกเลิกการสั่งซื้อ"; // Cancelled
    
    
    # Some messages
    var $_PHPSHOP_ORDER_BUTTON = "สั่งซื้อ"; // Order
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOPPER_MOD = "ผู้ซื้อ"; // Shopper
    
    
    
    // Shopper List
    var $_PHPSHOP_SHOPPER_LIST_MNU = "ผู้ซื้อ"; // List Shoppers
    var $_PHPSHOP_SHOPPER_LIST_LBL = "ผู้ซื้อ"; // Shopper List
    var $_PHPSHOP_SHOPPER_LIST_USERNAME = "ชื่อผู้ใช้"; // User Name
    var $_PHPSHOP_SHOPPER_LIST_NAME = "ชื่อเต็ม"; // Full Name
    var $_PHPSHOP_SHOPPER_LIST_GROUP = "กลุ่ม"; // Group
    
    // Shopper Form
    var $_PHPSHOP_SHOPPER_FORM_MNU = "เพิ่มผู้ซื้อ"; // Add Shopper
    var $_PHPSHOP_SHOPPER_FORM_LBL = "รายละเอียดผู้ซื้อ"; // Shopper Information
    var $_PHPSHOP_SHOPPER_FORM_BILLTO_LBL = "ที่อยู่ใบแจ้งหนี้"; // Bill To Information
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL = "รายละเอียด"; // Information
    var $_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL = "ที่อยู่สำหรับจัดส่งสินค้า"; // Shipping Information
    var $_PHPSHOP_SHOPPER_FORM_ADD_SHIPTO_LBL = "เพิ่มที่อยู่"; // Add Address
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL = "ชื่อเรียก"; // Address Nickname
    var $_PHPSHOP_SHOPPER_FORM_USERNAME = "ชื่อผู้ใช้งาน"; // User Name
    var $_PHPSHOP_SHOPPER_FORM_FIRST_NAME = "ชื่อ"; // First Name
    var $_PHPSHOP_SHOPPER_FORM_LAST_NAME = "นามสกุล"; // Last Name
    var $_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME = "ชื่อกลาง"; // Middle Name
    var $_PHPSHOP_SHOPPER_FORM_TITLE = "คำนำหน้าชื่อ"; // Title
    var $_PHPSHOP_SHOPPER_FORM_SHOPPERNAME = "ชื่อผู้ซื้อ"; // Shoppername
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_1 = "รหัสผ่าน"; // Password
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_2 = "ยืนยันรหัสผ่าน"; // Confirm Password
    var $_PHPSHOP_SHOPPER_FORM_GROUP = "กลุ่มผู้ซื้อ"; // Shopper Group
    var $_PHPSHOP_SHOPPER_FORM_COMPANY_NAME = "ชื่อบริษัท"; // Company Name
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_1 = "ที่อยู่ 1"; // Address 1
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_2 = "ที่อยู่ 2"; // Address 2
    var $_PHPSHOP_SHOPPER_FORM_CITY = "อำเภอ"; // City
    var $_PHPSHOP_SHOPPER_FORM_STATE = "เขต/จังหวัด"; // State/Province/Region
    var $_PHPSHOP_SHOPPER_FORM_ZIP = "รหัสไปรษณีย์"; // Zip/Postal Code
    var $_PHPSHOP_SHOPPER_FORM_COUNTRY = "ประเทศ"; // Country
    var $_PHPSHOP_SHOPPER_FORM_PHONE = "โทรศัพท์"; // Phone
    var $_PHPSHOP_SHOPPER_FORM_FAX = "โทรสาร"; // Fax
    var $_PHPSHOP_SHOPPER_FORM_EMAIL = "อีเมล์"; // Email
    
    // Shopper Group List
    var $_PHPSHOP_SHOPPER_GROUP_LIST_MNU = "กลุ่มผู้ซื้อ"; // List Shopper Groups
    var $_PHPSHOP_SHOPPER_GROUP_LIST_LBL = "กลุ่มผู้ซื้อ"; // Shopper Group List
    var $_PHPSHOP_SHOPPER_GROUP_LIST_NAME = "ชื่อกลุ่ม"; // Group Name
    var $_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION = "รายละเอียดกลุ่ม"; // Group Description
    
    
    // Shopper Group Form
    var $_PHPSHOP_SHOPPER_GROUP_FORM_LBL = "แบบฟอร์มกลุ่มผู้ซื้อ"; // Shopper Group Form
    var $_PHPSHOP_SHOPPER_GROUP_FORM_MNU = "เพิ่มกลุ่มผู้ซื้อ"; // Add Shopper Group
    var $_PHPSHOP_SHOPPER_GROUP_FORM_NAME = "ชื่อกลุ่ม"; // Group Name
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DESC = "รายละเอียดกลุ่ม"; // Group Description
    
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_STORE_MOD = "ร้านค้า"; // Store
    
    
    // Store Form
    var $_PHPSHOP_STORE_FORM_MNU = "ตั้งค่าร้านค้า"; // Edit Store
    var $_PHPSHOP_STORE_FORM_LBL = "รายละเอียดร้านค้า"; // Store Information
    var $_PHPSHOP_STORE_FORM_CONTACT_LBL = "รายละเอียดการติดต่อ"; // Contact Information
    var $_PHPSHOP_STORE_FORM_FULL_IMAGE = "รูปภาพ"; // Full Image
    var $_PHPSHOP_STORE_FORM_UPLOAD = "อัพโหลดรูปภาพ"; // Upload Image
    var $_PHPSHOP_STORE_FORM_STORE_NAME = "ชื่อร้านค้า"; // Store Name
    var $_PHPSHOP_STORE_FORM_COMPANY_NAME = "ชื่อบริษัทฯ"; // Store Company Name
    var $_PHPSHOP_STORE_FORM_ADDRESS_1 = "ที่อยู่ 1"; // Address 1
    var $_PHPSHOP_STORE_FORM_ADDRESS_2 = "ที่อยู่ 2"; // Address 2
    var $_PHPSHOP_STORE_FORM_CITY = "อำเภอ"; // City
    var $_PHPSHOP_STORE_FORM_STATE = "เขต/จังหวัด"; // State/Province/Region
    var $_PHPSHOP_STORE_FORM_COUNTRY = "ประเทศ"; // Country
    var $_PHPSHOP_STORE_FORM_ZIP = "รหัสไปรษณีย์"; // Zip/Postal Code
    var $_PHPSHOP_STORE_FORM_PHONE = "โทรศัพท์"; // Phone
    var $_PHPSHOP_STORE_FORM_CURRENCY = "สกุลเงิน"; // Currency
    var $_PHPSHOP_STORE_FORM_CATEGORY = "หมวดหมู่"; // Store Category
    var $_PHPSHOP_STORE_FORM_LAST_NAME = "นามสกุล"; // Last Name
    var $_PHPSHOP_STORE_FORM_FIRST_NAME = "ชื่อ"; // First Name
    var $_PHPSHOP_STORE_FORM_MIDDLE_NAME = "ชื่อกลาง"; // Middle Name
    var $_PHPSHOP_STORE_FORM_TITLE = "คำนำหน้าชื่อ"; // Title
    var $_PHPSHOP_STORE_FORM_PHONE_1 = "โทรศัพท์ 1"; // Phone 1
    var $_PHPSHOP_STORE_FORM_PHONE_2 = "โทรศัพท์ 2"; // "Phone 2
    var $_PHPSHOP_STORE_FORM_FAX = "่โทรสาร"; // Fax
    var $_PHPSHOP_STORE_FORM_EMAIL = "อีเมล์"; // Email
    var $_PHPSHOP_STORE_FORM_IMAGE_PATH = "ที่เก็บรูปภาพ"; // Image Path
    var $_PHPSHOP_STORE_FORM_DESCRIPTION = "รายละเอียด"; // Description
    
    
    
    var $_PHPSHOP_PAYMENT = "การชำระเงิน"; // Payment
    // Payment Method List
    var $_PHPSHOP_PAYMENT_METHOD_LIST_MNU = "วิธีการชำระเงิน"; // List Payment Methods
    var $_PHPSHOP_PAYMENT_METHOD_LIST_LBL = "วิธีการชำระเงิน"; // Payment Method List
    var $_PHPSHOP_PAYMENT_METHOD_LIST_NAME = "ชื่อ"; // Name
    var $_PHPSHOP_PAYMENT_METHOD_LIST_CODE = "รหัส"; // Code
    var $_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT = "ส่วนลด"; // Discount
    var $_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP = "กลุ่มผู้ซื้อ"; // Shopper Group
    var $_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR = "ประเภทวิธีชำระเงิน"; // Payment method type
    
    // Payment Method Form
    var $_PHPSHOP_PAYMENT_METHOD_FORM_MNU = "เพิ่มวิธีการชำระเงิน"; // Add Payment Method
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LBL = "แบบฟอร์มวิธีการชำระเงิน"; // Payment Method Form
    var $_PHPSHOP_PAYMENT_METHOD_FORM_NAME = "ชื่อวิธีการชำระเงิน"; // Payment Method Name
    var $_PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP = "กลุ่มผู้ซื้อ"; // Shopper Group
    var $_PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT = "ส่วนลด"; // Discount
    var $_PHPSHOP_PAYMENT_METHOD_FORM_CODE = "รหัส"; // Code
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER = "เรียงลำดับ"; // List Order
    var $_PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR = "ประเภทวิธีชำระเงิน"; // Payment method type
    
    var $_PHPSHOP_PAYMENT_METHOD_FORM_CLASS_NAME = "ชื่อคลาสวิธีการชำระเงิน (เช่น <strong>ps_netbanx</strong>) :<br />ค่าปกติ: ps_payment<br /><i>ถ้าไม่แน่ใจ ให้เว้นว่างไว้!</i>"; // Payment class name (e.g. <strong>ps_netbanx</strong>) :<br />default: ps_payment<br /><i>Leave blank if you're not sure what to fill in!</i>
    var $_PHPSHOP_PAYMENT_METHOD_FORM_ACCEPTED = "รับบัตรเครดิต"; // Accepted Credit Card Types
    var $_PHPSHOP_PAYMENT_METHOD_FORM_EXTRAINFO = "รายละเอียดวิธีการชำระเงินเพิ่มเติม"; // Payment Extra Info
    var $_PHPSHOP_PAYMENT_METHOD_FORM_EXTRAINFO_EXPLAIN = "จะแสดงในหน้ายืนยันการสั่งซื้อ สามารถใช้รหัส HTML จากผู้ให้บริการรับชำระเงินได้"; // Is shown on the Order Confirmation Page. Can be: HTML Form Code from your Payment Service Provider, Hints to the customer etc.
  
    
    /*#####################
    MODULE TAX
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_TAX_MOD = "ภาษี"; // Tax
    
    // User List
    var $_PHPSHOP_TAX_RATE = "อัตราภาษี"; // Tax Rates
    var $_PHPSHOP_TAX_LIST_MNU = "อัตราภาษี"; // List Tax Rates
    var $_PHPSHOP_TAX_LIST_LBL = "อัตราภาษี"; // Tax Rate List
    var $_PHPSHOP_TAX_LIST_STATE = "โซนภาษี"; // Tax State or Region
    var $_PHPSHOP_TAX_LIST_COUNTRY = "ประเทศ"; // Tax Country
    var $_PHPSHOP_TAX_LIST_RATE = "อัตราภาษี"; // Tax Rate
    
    // User Form
    var $_PHPSHOP_TAX_FORM_MNU = "เพิ่มอัตราภาษี"; // Add Tax Rate
    var $_PHPSHOP_TAX_FORM_LBL = "รายละเอียดอัตราภาษี"; // Add Tax Information
    var $_PHPSHOP_TAX_FORM_STATE = "โซนภาษี"; // Tax State or Region
    var $_PHPSHOP_TAX_FORM_COUNTRY = "ประเทศ"; // Tax Country
    var $_PHPSHOP_TAX_FORM_RATE = "อัตราภาษี (เช่น 16% => ระบุ 0.16)"; // Tax Rate (for 16% => fill in 0.16)
    
    
    
    
    /*#####################
    MODULE VENDOR
    #####################*/
    
    
    
    # Some LABELs
    var $_PHPSHOP_VENDOR_MOD = "ผู้ขาย"; // Vendor
    var $_PHPSHOP_VENDOR_ADMIN = "ผู้ขาย"; // Vendors
    
    
    // Vendor List
    var $_PHPSHOP_VENDOR_LIST_MNU = "ผู้ขาย"; // List Vendors
    var $_PHPSHOP_VENDOR_LIST_LBL = "ผู้ขาย"; // Vendor List
    var $_PHPSHOP_VENDOR_LIST_VENDOR_NAME = "ชื่อผู้ขาย"; // Vendor Name
    var $_PHPSHOP_VENDOR_LIST_ADMIN = "ผู้ดูแลระบบ"; // Admin
    
    // Vendor Form
    var $_PHPSHOP_VENDOR_FORM_MNU = "เพิ่มชื่อผู้ขาย"; // Add Vendor
    var $_PHPSHOP_VENDOR_FORM_LBL = "ระบุรายละเอียด"; // Add Information
    var $_PHPSHOP_VENDOR_FORM_INFO_LBL = "รายละเอียดผู้ขาย"; // Vendor Information
    var $_PHPSHOP_VENDOR_FORM_CONTACT_LBL = "ชื่อผู้ติดต่อ"; // Contact Information
    var $_PHPSHOP_VENDOR_FORM_FULL_IMAGE = "รูปภาพ"; // Full Image
    var $_PHPSHOP_VENDOR_FORM_UPLOAD = "อัพโหลดรูปภาพ"; // Upload Image
    var $_PHPSHOP_VENDOR_FORM_STORE_NAME = "ชื่อผู้ขาย"; // Vendor Store Name
    var $_PHPSHOP_VENDOR_FORM_COMPANY_NAME = "ชื่อบริษัท"; // Vendor Company Name
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_1 = "ที่อยู่ 1"; // Address 1
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_2 = "ที่อยู่ 2"; // Address 2
    var $_PHPSHOP_VENDOR_FORM_CITY = "อำเภอ"; // City
    var $_PHPSHOP_VENDOR_FORM_STATE = "เขต/จังหวัด"; // State/Province/Region
    var $_PHPSHOP_VENDOR_FORM_COUNTRY = "ประเทศ"; // Country
    var $_PHPSHOP_VENDOR_FORM_ZIP = "รหัสไปรษณีย์"; // Zip/Postal Code
    var $_PHPSHOP_VENDOR_FORM_PHONE = "โทรศัพท์"; // Phone
    var $_PHPSHOP_VENDOR_FORM_CURRENCY = "สกุลเงิน"; // Currency
    var $_PHPSHOP_VENDOR_FORM_CATEGORY = "ประเภทผู้ขาย"; // Vendor Category
    var $_PHPSHOP_VENDOR_FORM_LAST_NAME = "นามสกุล"; // Last Name
    var $_PHPSHOP_VENDOR_FORM_FIRST_NAME = "ชื่อ"; // First Name
    var $_PHPSHOP_VENDOR_FORM_MIDDLE_NAME = "ชื่อกลาง"; // Middle Name
    var $_PHPSHOP_VENDOR_FORM_TITLE = "คำนำหน้าชื่อ"; // Title
    var $_PHPSHOP_VENDOR_FORM_PHONE_1 = "โทรศัพท์ 1"; // Phone 1
    var $_PHPSHOP_VENDOR_FORM_PHONE_2 = "โทรศัพท์ 2"; // Phone 2
    var $_PHPSHOP_VENDOR_FORM_FAX = "โทรสาร"; // Fax
    var $_PHPSHOP_VENDOR_FORM_EMAIL = "อีเมล์"; // Email
    var $_PHPSHOP_VENDOR_FORM_IMAGE_PATH = "ที่เก็บรูปภาพ"; // Image Path
    var $_PHPSHOP_VENDOR_FORM_DESCRIPTION = "รายละเอียด"; // Description
    
    
    // Vendor Category List
    var $_PHPSHOP_VENDOR_CAT_LIST_MNU = "หมวดผู้ขาย"; // List Vendor Categories
    var $_PHPSHOP_VENDOR_CAT_LIST_LBL = "หมวดผู้ขาย"; // Vendor Category List
    var $_PHPSHOP_VENDOR_CAT_NAME = "ชื่อหมวด"; // Category Name
    var $_PHPSHOP_VENDOR_CAT_DESCRIPTION = "รายละเอียดหมวดผู้ขาย"; // Category Description
    var $_PHPSHOP_VENDOR_CAT_VENDORS = "ผู้ขาย"; // Vendors
    
    // Vendor Category Form
    var $_PHPSHOP_VENDOR_CAT_FORM_MNU = "เพิ่มหมวดผู้ขาย"; // Add Vendor Category
    var $_PHPSHOP_VENDOR_CAT_FORM_LBL = "แบบฟอร์มหมวดผู้ขาย"; // Vendor Category Form
    var $_PHPSHOP_VENDOR_CAT_FORM_INFO_LBL = "รายละเีอียดหมวดผู้ขาย"; // Category Information
    var $_PHPSHOP_VENDOR_CAT_FORM_NAME = "ชื่อหมวด"; // Category Name
    var $_PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION = "รายละเีอียด"; // Category Description
    
    /*#####################
    MODULE MANUFACTURER
    #####################*/

    # Some LABELs
    var $_PHPSHOP_MANUFACTURER_MOD = "โรงงาน"; // Manufacturer
    var $_PHPSHOP_MANUFACTURER_ADMIN = "โรงงาน"; // Manufacturers
    
    
    // Manufacturer List
    var $_PHPSHOP_MANUFACTURER_LIST_MNU = "โรงงาน"; // List Manufacturers
    var $_PHPSHOP_MANUFACTURER_LIST_LBL = "โรงงาน"; // Manufacturer List
    var $_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME = "ชื่อโรงงาน"; // Manufacturer Name
    var $_PHPSHOP_MANUFACTURER_LIST_ADMIN = "จัดการระบบ"; // Admin
    
    // Manufacturer Form
    var $_PHPSHOP_MANUFACTURER_FORM_MNU = "เพิ่มโรงงาน"; // Add Manufacturer
    var $_PHPSHOP_MANUFACTURER_FORM_LBL = "ระบุรายละเอียด"; // Add Information
    var $_PHPSHOP_MANUFACTURER_FORM_INFO_LBL = "ข้อมูลโรงงาน"; // Manufacturer Information
    var $_PHPSHOP_MANUFACTURER_FORM_NAME = "ชื่อโรงงาน"; // Manufacturer Name
    var $_PHPSHOP_MANUFACTURER_FORM_CATEGORY = "หมวดโรงงาน"; // Manufacturer Category
    var $_PHPSHOP_MANUFACTURER_FORM_EMAIL = "อีเมล์"; // Email
    var $_PHPSHOP_MANUFACTURER_FORM_URL = "เว็บไซต์"; // URL to Manufacturer Homepage
    var $_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION = "รายละเอียด"; // Description
    
    
    // Manufacturer Category List
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_MNU = "หมวดโรงงาน"; // List Manufacturer Categories
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_LBL = "หมวดโรงงาน"; // Manufacturer Category List
    var $_PHPSHOP_MANUFACTURER_CAT_NAME = "ชื่อหมวด"; // Category Name
    var $_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION = "รายละเอียด"; // Category Description
    var $_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS = "โรงงาน"; // Manufacturers
    
    // Manufacturer Category Form
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_MNU = "เพิ่มหมวดโรงงาน"; // Add Manufacturer Category
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_LBL = "แบบฟอร์มหมวดโรงงาน"; // Manufacturer Category Form
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL = "ระบุข้อมูล"; // Category Information
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_NAME = "ชื่อหมวด"; // Category Name
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION = "รายละเอียด"; // Category Description
    
    
    /*#####################
    Modul HELP
    #####################*/
    var $_PHPSHOP_HELP_MOD = "ช่วยเหลือ"; // Help
    
    // 210104 start
    
    var $_PHPSHOP_CART_ACTION = "แก้ไข"; // Update
    var $_PHPSHOP_CART_UPDATE = "ปรับปรุงจำนวนสินค้าในรถเข็น"; // Update Quantity In Cart
    var $_PHPSHOP_CART_DELETE = "เอาสินค้าออกจากรถเข็น"; // Delete Product From Cart
    
    //shopbrowse form
    
    var $_PHPSHOP_PRODUCT_PRICETAG = "ราคา"; // Price
    var $_PHPSHOP_PRODUCT_CALL = "สอบถามราคา"; // Call for Pricing
    var $_PHPSHOP_PRODUCT_PREVIOUS = "ก่อนหน้า"; // Prev
    var $_PHPSHOP_PRODUCT_NEXT = "ถัดไป"; // NEXT
    
    //ro_basket
    
    var $_PHPSHOP_CART_TAX = "ภาษี"; // Tax
    var $_PHPSHOP_CART_SHIPPING = "ค่าขนส่งและการจัดการ"; // Shipping and Handling Fee
    var $_PHPSHOP_CART_TOTAL = "รวม"; // Total
    
    //CHECKOUT.INDEX
    
    var $_PHPSHOP_CHECKOUT_NEXT = "ถัดไป"; // Next
    var $_PHPSHOP_CHECKOUT_REGISTER = "ลงทะเบียน"; // REGISTER
    
    //CHECKOUT.CONFIRM
    
    var $_PHPSHOP_CHECKOUT_CONF_BILLINFO = "ใบแจ้งหนี้"; // Billing Information
    var $_PHPSHOP_CHECKOUT_CONF_COMPANY = "บริษัท"; // Company
    var $_PHPSHOP_CHECKOUT_CONF_NAME = "ชื่อ"; // Name
    var $_PHPSHOP_CHECKOUT_CONF_ADDRESS = "ที่อยู่"; // Address
    var $_PHPSHOP_CHECKOUT_CONF_PHONE = "โทรศัพท์"; // Phone
    var $_PHPSHOP_CHECKOUT_CONF_FAX = "โทรสาร"; // Fax
    var $_PHPSHOP_CHECKOUT_CONF_EMAIL = "อีเมล์"; // Email
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO = "รายละเอียดการจัดส่ง"; // Shipping Information
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY = "บริษัท"; // Company
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME = "ชื่อ"; // Name
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS = "ที่อยู่"; // Address
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE = "โทรศัพท์"; // Phone
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX = "โทรสาร"; // Fax
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO = "รายละเอียดการชำระเงิน"; // Payment Information
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD = "ชื่อบนบัตร"; // Name On Card
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD = "วิธีการชำระเงิน"; // Payment Method
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM = "หมายเลขบัตร"; // Credit Card Number
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE = "วันหมดอายุ"; // Expiration Date
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER = "การสั่งซื้อสมบูรณ์แล้ว"; // Complete Order
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO = "ระบุรายละเอียดเมื่อเลือกการชำระเงินด้วยบัตรเครดิต"; // required infomation when Payment via Credit Card is selected
    
    
    var $_PHPSHOP_ZONE_MOD = "โซนขนส่ง"; // Zone Shipping
    
    var $_PHPSHOP_ZONE_LIST_MNU = "โซนขนส่ง"; // List Zones
    var $_PHPSHOP_ZONE_FORM_MNU = "เพิ่ิมโซน"; // Add Zone
    var $_PHPSHOP_ZONE_ASSIGN_MNU = "ระบุโซน"; // Assign Zones
    
    // assign zone List
    var $_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL = "ประเทศ"; // Country
    var $_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL = "โซน"; // Current Zone
    var $_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL = "ระบุโซน"; // Assign To Zone
    var $_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL = "ปรับปรุง"; // Update
    var $_PHPSHOP_ASSIGN_ZONE_PG_LBL = "ระบุโซน"; // Assign Zones
    
    // zone Form
    var $_PHPSHOP_ZONE_FORM_NAME_LBL = "ชื่อโซน"; // Zone Name
    var $_PHPSHOP_ZONE_FORM_DESC_LBL = "รายละเอียดโซน"; // Zone Description
    var $_PHPSHOP_ZONE_FORM_COST_PER_LBL = "ค่าใช้จ่ายต่อรายการ"; // Zone Cost Per Item
    var $_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL = "วงเงินค่าใช้จ่าย"; // Zone Cost Limit
    
    // List of zones
    var $_PHPSHOP_ZONE_LIST_LBL = "โซน"; // Zone List
    var $_PHPSHOP_ZONE_LIST_NAME_LBL = "ชื่อโซน"; // Zone Name
    var $_PHPSHOP_ZONE_LIST_DESC_LBL = "รายละเอียดโซน"; // Zone Description
    var $_PHPSHOP_ZONE_LIST_COST_PER_LBL = "ค่าใช้จ่ายต่อรายการ"; // Zone Cost Per Item
    var $_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL = "วงเงินค่าใช้จ่าย"; // Zone Cost Limit
    
    var $_PHPSHOP_LOGIN_FIRST = "กรุณาล็อกอิน หรือลงทะเบียนก่อน"; // Please log in or register to this site (use the Login module) first.<br>Thank you.
    var $_PHPSHOP_STORE_FORM_TOS = "ข้อตกลง"; // Terms of Service
    var $_PHPSHOP_AGREE_TO_TOS = "โปรดยอมรับข้อตกลงก่อน"; // Please agree to our terms of Service first.
    var $_PHPSHOP_I_AGREE_TO_TOS = "ยอมรับข้อตกลง"; // I agree to the Terms of Service
    
    var $_PHPSHOP_LEAVE_BLANK = "(ปล่อยว่างไว้<br />ถ้าไม่มีไฟล์!)"; // (leave BLANK if you have <br />no individual php-file for it!)
    var $_PHPSHOP_RETURN_LOGIN = "ลูกค้าเดิม : กรุณาล็อกอิน"; // Returning Customers: Please Log In
    var $_PHPSHOP_NEW_CUSTOMER = "ลูกค้าใหม่ : กรุณาระบุรายละเอียด"; // New? Please Provide Your Billing Information
    var $_PHPSHOP_ACC_CUSTOMER_ACCOUNT = "บัญชีลูกค้า:"; // Customer Account:
    var $_PHPSHOP_ACC_ORDER_INFO = "รายละเอียดการสั่งซื้อ"; // Order Information
    var $_PHPSHOP_ACC_UPD_BILL = "คุณสามารถแก้ไขรายละเอียดใบแจ้งหนี้"; // Here you can update your billing information.
    var $_PHPSHOP_ACC_UPD_SHIP = "คุณสามารถแก้ไขรายละเอียดสถานที่จัดส่ง"; // Here you can add and maintain shipping addresses.
    var $_PHPSHOP_ACC_ACCOUNT_INFO = "รายละเอียดบัญชี"; // Account Information
    var $_PHPSHOP_ACC_SHIP_INFO = "รายละเอียดสถานที่จัดส่ง"; // Shipping Information
    var $_PHPSHOP_ACC_NO_ORDERS = "ไม่มีรายการสั่งซื้อ"; // No Orders to Display
    var $_PHPSHOP_ACC_BILL_DEF = "- (ที่อยู่ตามใบแจ้งหนี้)"; // - Default (Same as Billing)
    var $_PHPSHOP_SHIPTO_TEXT = "ท่านสามารถเพิ่มสถานที่จัดส่ง กรุณาเลือกชื่อที่เหมาะสม หรือรหัสสำหรับสถานที่จัดส่งที่ต้องการ "; // You can add shipping locations to your account. Please think of a suitable nickname or code for the shipping location you select below.
    var $_PHPSHOP_CONFIG = "การตั้งค่า"; // Configuration
    var $_PHPSHOP_USERS = "ผู้ใช้งาน"; // Users
    var $_PHPSHOP_IS_CC_PAYMENT = "ต้องการชำระด้วยบัตรเครดิต?"; // is Credit Card payment?
    
    /*#####################################################
     MODULE SHIPPING
    #######################################################*/
    var $_PHPSHOP_SHIPPING_MOD = "การขนส่ง"; // Shipping
    var $_PHPSHOP_SHIPPING_MENU_LABEL = "การขนส่ง"; // Shipping
    
    var $_PHPSHOP_SHIPPING_METHOD_LIST = "การขนส่ง"; // Shipping
    var $_PHPSHOP_SHIPPING_METHOD_LIST_NAME = "ชื่อ"; // Name
    var $_PHPSHOP_SHIPPING_METHOD_LIST_VERSION = "เวอร์ชั่น"; // Version
    var $_PHPSHOP_SHIPPING_METHOD_LIST_AUTHOR = "ผู้สร้าง"; // Author
    var $_PHPSHOP_SHIPPING_METHOD_LIST_AUTHOR_URL = "URL ผู้สร้าง"; // Author URL
    var $_PHPSHOP_SHIPPING_METHOD_LIST_AUTHOR_EMAIL = "อีเมล์ผู้สร้าง"; // Author Email
    var $_PHPSHOP_SHIPPING_METHOD_LIST_DESCRIPTION = "รายละเอียด"; // Description
    var $_PHPSHOP_SHIPPING_METHOD_LIST_ACTIVE = "เลือก?"; // Active?

    var $_PHPSHOP_CARRIER_LIST_MNU = "ผู้ขนส่ง"; // Shipper
    var $_PHPSHOP_CARRIER_LIST_LBL = "ผู้ขนส่ง"; // Shipper list
    var $_PHPSHOP_RATE_LIST_MNU = "อัตราค่าขนส่ง"; // Shipping Rates
    var $_PHPSHOP_RATE_LIST_LBL = "อัตราค่าขนส่ง"; // Shipping Rates list
    var $_PHPSHOP_CARRIER_LIST_NAME_LBL = "ชื่อ"; // Name
    var $_PHPSHOP_CARRIER_LIST_ORDER_LBL = "เรียงลำดับ"; // Listorder
    
    var $_PHPSHOP_CARRIER_FORM_MNU = "สร้างผู้ขนส่งใหม่"; // Create Shipper
    var $_PHPSHOP_CARRIER_FORM_LBL = "สร้าง / แก้ไขผู้ขนส่ง"; // Shipper edit / create
    var $_PHPSHOP_RATE_FORM_MNU = "กำหนดอัตราค่าขนส่ง"; // Create a Shipping Rate
    var $_PHPSHOP_RATE_FORM_LBL = "เพิ่ม / แก้ไขอัตราค่าขนส่ง"; // Create/Edit a Shipping Rate
    
    var $_PHPSHOP_RATE_FORM_NAME = "รายละเอียดอัตราค่าขนส่ง"; // Shipping Rate description
    var $_PHPSHOP_RATE_FORM_CARRIER = "ผู้ขนส่ง"; // Shipper
    var $_PHPSHOP_RATE_FORM_COUNTRY = "ประเทศ:<br /><br /><i>เลือกหลายรายการ: กดปุ่ม Shift หรือ Ctrl และคลิ๊กเมาท์</i>"; // Country:<br /><br /><i>Multiselect: use STRG-Key and Mouse</i>
    var $_PHPSHOP_RATE_FORM_ZIP_START = "ช่วงรหัสไปรษณีย์จาก"; // ZIP range start
    var $_PHPSHOP_RATE_FORM_ZIP_END = "ถึง"; // ZIP range end
    var $_PHPSHOP_RATE_FORM_WEIGHT_START = "น้ำหนักต่ำสุด"; // Lowest Weight
    var $_PHPSHOP_RATE_FORM_WEIGHT_END = "น้ำหนักสูงสุด"; // Highest Weight
    var $_PHPSHOP_RATE_FORM_VALUE = "ค่าธรรมเนียม"; // Fee
    var $_PHPSHOP_RATE_FORM_PACKAGE_FEE = "ค่าบรรจุหีบห่อ"; // Your package fee
    var $_PHPSHOP_RATE_FORM_CURRENCY = "สกุลเงิน"; // Currency
    var $_PHPSHOP_RATE_FORM_VAT_ID = "รหัส VAT"; // VAT Id
    var $_PHPSHOP_RATE_FORM_LIST_ORDER = "เรียงลำดับ"; // List Order
    
    var $_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL = "ผู้ขนส่ง"; // Shipper
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME = "รายละเอียดอัตราค่าขนส่ง"; // Shipping Rate description
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART = "น้ำหนักขั้นต่ำ ..."; // Weight from ...
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND = "... ถึง"; // ... to
    var $_PHPSHOP_CARRIER_FORM_NAME = "บริษัทผู้ขนส่ง"; // Shipper Company
    var $_PHPSHOP_CARRIER_FORM_LIST_ORDER = "เ่รียงลำดับ"; // Listorder
    
    var $_PHPSHOP_ERR_MSG_CARRIER_EXIST = "ข้อผิดพลาด: รหัสผู้ขนส่งมีอยู่แล้ว"; // ERROR: Shipper ID exists.
    var $_PHPSHOP_ERR_MSG_CARRIER_ID_REQ = "ข้อผิดพลาด: เลือกผู้ขนส่ง"; // ERROR: Choose a shipper.
    var $_PHPSHOP_ERR_MSG_CARRIER_INUSE = "ข้อผิดพลาด: มีอัตราค่าขนส่งอยู่แล้ว ต้องลบอัตราเดิมก่อน"; // ERROR: At least one Shipping Rate exists, delete rates prior to shipper
    var $_PHPSHOP_ERR_MSG_CARRIER_NOTFOUND = "ข้อผิดพลาด: ไม่พบผู้ขนส่งหมายเลขรหัสนี้"; // ERROR: Unable to find a shipper with this ID.
    
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_REQ = "ข้อผิดพลาด: เลือกผู้ขนส่ง"; // ERROR: Choose a shipper.
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_INV = "ข้อผิดพลาด: ไม่พบผู้ขนส่งหมายเลข ID นี้"; // ERROR: Unable to find a shipper with this ID.
    var $_PHPSHOP_ERR_MSG_RATE_NAME_REQ = "ข้อผิดพลาด: ต้องระบุอัตราขนส่ง"; // ERROR: A rate descriptor is requested.
    var $_PHPSHOP_ERR_MSG_RATE_COUNTRY_CODE_INV = "ข้อผิดพลาด: ประเทศปลายทางไม่ถูกต้อง ถ้ามากกว่า 1 ประเทศ สามารถคั่นด้วยเครื่องหมาย \"; // \"."; // ERROR: The Destination country is invalid. More than one country could be separated with \"; // \".
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_START_REQ = "ข้อผิดพลาด: ต้องระบุน้ำหนักต่ำสุด"; // ERROR: A lowest weight is requested
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_END_REQ = "ข้อผิดพลาด: ต้องระบุน้ำหนักสูงสุด"; // ERROR: A highes weight are requested
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_STARTEND_INV = "ข้อผิดพลาด: น้ำหนักต่ำสุดต้องน้อยกว่าน้ำหนักสูงสุด"; // ERROR: The lowest weight must be smaller than the highes weight
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_VALUE_REQ = "ข้อผิดพลาด: ต้องระบุค่าธรรมเนียมขนส่ง"; // ERROR: A shipping fee requested
    var $_PHPSHOP_ERR_MSG_RATE_CURRENCY_ID_INV = "ข้อผิดพลาด: ต้องเลือกสกุลเงิน"; // ERROR: Coose a currency
    
    var $_PHPSHOP_ERR_MSG_RATE_ID_REQ = "ข้อผิดพลาด: ต้องระบุอัตราค่าขนส่ง"; // ERROR: A Shipping Rate is requested
    
    var $_PHPSHOP_INFO_MSG_PLEASE_SELECT = "โปรดเลือก"; // Please select
    var $_PHPSHOP_INFO_MSG_CARRIER = "ผู้ขนส่ง"; // Shipper
    var $_PHPSHOP_INFO_MSG_SHIPPING_METHOD = "อัตราค่าขนส่ง"; // Shipping Rate
    var $_PHPSHOP_INFO_MSG_SHIPPING_PRICE = "ราคา"; // Price
    var $_PHPSHOP_INFO_MSG_VAT_ZERO_LBL = "0 (-ไม่มี-)"; // 0 (-none-)
    /*#####################################################
     END: MODULE SHIPPING
    #######################################################*/
    
    var $_PHPSHOP_PAYMENT_FORM_CC = "บัตรเครดิต"; // Credit Card
    var $_PHPSHOP_PAYMENT_FORM_USE_PP = "ใช้ขั้นตอนการชำระเงิน"; // Use Payment Processor
    var $_PHPSHOP_PAYMENT_FORM_BANK_DEBIT = "บัตรเดรบิต"; // Bank debit
    var $_PHPSHOP_PAYMENT_FORM_PAYPAL = "PayPal หรือรูปแบบที่คล้ายกัน"; // PayPal (or related)

    var $_PHPSHOP_PAYMENT_FORM_AO = "ชำระเงินเมื่อรับสินค้า"; // Address only / Cash on Delivery
    var $_PHPSHOP_CHECKOUT_MSG_2 = "โปรดเลือกสถานที่จัดส่ง!"; // Please select a Shipping Address!
    var $_PHPSHOP_CHECKOUT_MSG_3 = "โปรดเลือกวิธีการขนส่ง!"; // lease select a Shipping Method!
    var $_PHPSHOP_CHECKOUT_MSG_4 = "โปรดเลือกวิธีการชำระเงิน!"; // Please select a Payment Method!
    var $_PHPSHOP_CHECKOUT_MSG_99 = "กรุณาตรวจสอบรายละเอียดข้อมูล และยืนยันการสั่งซื้อ!"; // Please review the provided data and confirm the order!
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIP = "โปรดเลือกวิธีการขนส่ง"; // Please select a Shipping Method.
    var $_PHPSHOP_CHECKOUT_ERR_OTHER_SHIP = "โปรดเลือกวิธีการขนส่งอื่นๆ"; // Please select another Shipping Method.
    var $_PHPSHOP_CHECKOUT_ERR_NO_PAYM = "โปรดเลือกวิธีการชำระเงิน"; // Please select a Payment Method.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR = "โปรดระบุหมายเลขบัตรเครดิต"; // Please enter your Credit Card Number.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNAME = "โปรดระบุชื่อบนบัตรเครดิต"; // Please enter the Name on the Credit Card.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATE = "หมายเลขบัตรเครดิตไม่ถูกต้อง"; // The Credit Card Number entered is not valid.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCMON = "โปรดใส่เดือนที่หมดอายุ"; // Please enter the Credit Card expiration month.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCYEAR = "โปรดใส่ปีที่หมดอายุ"; // Please enter the Credit Card expiration year.
    var $_PHPSHOP_CHECKOUT_ERR_CCDATE_INV = "วันหมดอายุไม่ถูกต้อง"; // The expiration date is invalid.
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIPTO = "กรุณาเลือกสถานที่จัดส่ง"; // Please select a Ship To address.
    var $_PHPSHOP_CHECKOUT_ERR_CCNUM_INV = "หมายเลขบัญชีไม่ถูกต้อง"; // Invalid account number.
    var $_PHPSHOP_CHECKOUT_ERR_EMPTY_CART = "ไม่มีรายการในรถเข็น!"; // There's nothing in your cart!
    var $_PHPSHOP_CHECKOUT_ERR_NO_CARR = "ข้อผิดพลาด: โปรดเลือกผู้จัดส่ง!"; // ERROR: Please select a Shipping Carrier!
    var $_PHPSHOP_CHECKOUT_ERR_RATE_NOT_FOUND = "ข้อผิดพลาด: ไม่พบอัตราค่าขนส่งที่เลือก!"; // ERROR: The selected Shipping Rate was not found!
    var $_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND = "ข้อผิดพลาด: ไม่พบที่อยู่สำหรับการจัดส่ง!"; // ERROR: Your Shipping Address was not found!
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATA = "ข้อผิดพลาด: ไม่มีข้อมูลของบัตรเครดิต..."; // ERROR: There's no CreditCard data...
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR_FOUND = "ข้อผิดพลาด: ไม่พบหมายเลขบัตรเครดิต"; // ERROR: Credit Card Number not found!
    var $_PHPSHOP_CHECKOUT_ERR_TEST = "ขออภัย เนื่องจากหมายเลขบัตรเครดิตที่ท่านใช้ เป็นเลขหมายสำหรับการทดลองใช้!"; // Sorry, but the Credit Card Number you've used is a testing number!
    var $_PHPSHOP_CHECKOUT_ERR_NO_USER_DATA = "ไม่พบเลขหมายผู้ใช้งาน!"; // The user_id was not found in the database!
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_HOLDER_NAME = "ท่านไม่ได้ระบุชื่อบัญชี"; // You have actually not provided your bank account holder name.
    var $_PHPSHOP_CHECKOUT_ERR_NO_IBAN = "ท่านไม่ได้ระบุหมายเลข IBAN"; // You have actually not provided your IBAN.
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_NUM = "ท่านไม่ได้ระบุเลขที่บัญชี"; // You have actually not provided your bank account number.
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_SORT = "ท่านไม่ได้ระบุหมายเลขรหัสแยกประเภท"; // You have actually not provided your bank sort code.
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_NAME = "ท่านไม่ได้ระบุชื่อธนาคาร"; // You have actually not provided your bank's name.
    var $_PHPSHOP_CHECKOUT_ERR_NO_VALID_STEP = "ขั้นตอนการชำระเงินไม่ถูกต้อง!"; // CheckOut needs a valid Step!

    var $_PHPSHOP_CHECKOUT_MSG_LOG = "รายละเอียดการชำระเงินสำหรับการทำรายการครั้งล่าสุด<br />"; // Payment information captured for later processing.<br />
    
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV = "ยอดสั่งซื้อยังไม่ครบตามจำนวนต่ำสุด"; // Minimum purchase order value has not been reached yet.
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV2 = "ยอดสั่งซื้อต่ำสุด:"; // Our minimum purchase order value is:
    var $_PHPSHOP_CHECKOUT_PAYMENT_CC = "ชำระด้วยบัตรเครดิต"; // Credit Card Payment
    var $_PHPSHOP_CHECKOUT_PAYMENT_OTHER = "วิธีการชำระเงินแบบอื่น"; // other Payment Methods
    var $_PHPSHOP_CHECKOUT_PAYMENT_SELECT = "โปรดเลือกวิธีการชำระเงิน:"; // Please select a Payment Method:
    
    var $_PHPSHOP_STORE_FORM_MPOV = "มูลค่าการสั่งซื้อขั้นต่ำ"; // Minimum purchase order value for your store
    var $_PHPSHOP_ACCOUNT_BANK_TITLE = "รายละเอียดบัญชีธนาคาร"; // Bank Account Info
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR = "เลขที่บัญชี"; // Account Number
    var $_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE = "หมายเลขรหัสแยกประเภท"; // Bank sorting code number
    var $_PHPSHOP_ACCOUNT_LBL_BANK_NAME = "ชื่อธนาคาร"; // Bank Name
    var $_PHPSHOP_ACCOUNT_LBL_BANK_IBAN = "IBAN"; // IBAN
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER = "ชื่อบัญชี"; // Account Holder
    
    var $_PHPSHOP_MODULES = "โมดูล"; // Modules
    var $_PHPSHOP_FUNCTIONS = "ฟังก์ชั่น"; // Functions
    var $_PHPSHOP_SPECIAL_PRODUCTS = "สินค้าพิเศษ"; // Special products
    
    var $_PHPSHOP_CHECKOUT_CUSTOMER_NOTE = "กรุณาฝากข้อความถึงเราเกี่ยวกับรายการสั่งซื้อของท่าน"; // Please leave a note to us with your order if you want to
    var $_PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE = "ข้อความจากลูกค้า"; // Customer's note
    var $_PHPSHOP_INCLUDING_TAX = "(รวมภาษี \$tax %)"; // (including \$tax % tax)
    var $_PHPSHOP_PLEASE_SEL_ITEM = "เลือกรายการสินค้าที่ต้องการ"; // Please select an item
    var $_PHPSHOP_PRODUCT_FORM_ITEM_LBL = "รายการ"; // Item

    // DOWNLOADS
    
    var $_PHPSHOP_DOWNLOADS_TITLE = "ส่วนของการดาวน์โหลด"; // Download Area
    var $_PHPSHOP_DOWNLOADS_START = "เริ่มต้นดาวน์โหลด"; // Start Download
    var $_PHPSHOP_DOWNLOADS_INFO = "กรุณาใส่รหัส Download-ID ที่ส่งให้ท่านทางอีเมล์ แล้วกดปุ่ม เริ่มต้นดาวน์โหลด"; // Please enter the Download-ID you've got in the e-mail and click 'Start Download'.
    var $_PHPSHOP_DOWNLOADS_ERR_EXP = "การดาวน์โหลดของท่านหมดอายุแล้ว"; // Sorry, but your Download has expired
    var $_PHPSHOP_DOWNLOADS_ERR_MAX = "ท่านใช้จำนวนครั้งในการดาวน์โหลดครบแล้ว"; // Sorry, but your maximum number of downloads has been reached
    var $_PHPSHOP_DOWNLOADS_ERR_INV = "รหัส Download-ID! ไม่ถูกต้อง"; // Invalid Download-ID!
    var $_PHPSHOP_DOWNLOADS_ERR_SEND = "ไม่สามารถส่งข้อความถึง "; // Could not send a message to 
    var $_PHPSHOP_DOWNLOADS_SEND_MSG = "ส่งข้อความถึง "; // Message sent to 
    var $_PHPSHOP_DOWNLOADS_SEND_SUBJ = "รายละเอียดการดาวน์โหลด"; // Download-Info
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_1 = "ท่านสามารถดาวน์โหลดไฟล์ที่สั่งซื้อได้แล้ว"; // the file(s) you ordered are ready for your download
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_2 = "กรุณาใส่รหัส Download-ID ในส่วนพื้นที่ดาวน์โหลด : "; // Please enter the following Download-ID(s) in our Downloads Area: 
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_3 = "จำนวนครั้งสูงสุดในการดาวน์โหลดสูงสุดต่อไฟล์: "; // the maximum number of downloads for each file is: 
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_4 = "ดาวน์โหลดได้อีก {expire} วัน หลังจากเริ่ิมดาวน์โหลดครั้งแรก"; // Download until {expire} days after the first download
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_5 = "คำถาม? ปัญหา?"; // Questions? Problems?
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_6 = "รายละเอียดการดาวน์โหลดตาม "; //  // e.g. Download-Info by "Storename"
    var $_PHPSHOP_PRODUCT_FORM_DOWNLOADABLE = "สินค้าที่สามารถดาวน์โหลดได้?"; //  downloadable product?
    
    var $_PHPSHOP_PAYPAL_THANKYOU = "ขอบคุณสำหรับการชำระเงิน การทำธุรกรรมของท่านเรียบร้อยแล้ว้<br />ท่านจะได้รับอีเมล์ยืนยันการทำรายการจากทาง PayPal ซึ่งท่านสามารถล็อกอินเข้าเข้าไปที่ <a href=http://www.paypal.com>www.paypal.com</a> เพื่อดูรายละเอียดได้"; // Thanks for your payment. The transaction was successful. You will get a confirmation e-mail for the transaction by PayPal. You can now continue or log in at <a href=http://www.paypal.com>www.paypal.com</a> to see the transaction details.

    var $_PHPSHOP_PAYPAL_ERROR = "เกิดความผิดพลาดระหว่างการทำรายการ สถานะการสั่งซื้อยังไม่ได้เปลี่ยนแปลง"; // An error occured while processing your transaction. The status of your order could not be updated.
    
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER1 = "ขอขอบคุณที่สั่งซื้อสินค้ากับเรา รายการสั่งซื้อของท่าน"; // Thank you for shopping with us.  Your order information follows.
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER2 = "ขอขอบคุณที่ให้การอุดหนุน"; // Thank you for your patronage.
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER3 = "คำถาม? ปัญหา?"; // Questions? Problems?
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER4 = "ได้รับรายการสั่งซื้อแล้ว"; // The following order was received.
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER5 = "ดูรายละเอียดการสั่งซื้อ"; // View the order by following the link below.
    
    var $_PHPSHOP_CART_ERROR_NO_NEGATIVE = "จำนวนติดลบ ทำรายการต่อไม่ได้"; // Negative quantities are not allowed.
    var $_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY = "กรุณาใส่จำนวนที่ถูกต้องสำหรับรายการนี้"; // Please enter a valid quantity for this item.
    
    var $_PHPSHOP_CART_STOCK_1 = "จำนวนที่เลือกมากกว่าของที่มีอยู่ในสต็อก "; // The selected quantity exceeds available stock. 
    var $_PHPSHOP_CART_STOCK_2 = "ขณะนี้มีสินค้าอยู่ \$product_in_stock รายการ "; // We currently have \$product_in_stock items available. 
    var $_PHPSHOP_CART_STOCK_3 = "คลิ๊กที่นี่เพื่อเข้าอยู่ในรายการรอคอย"; // Click Here to be placed on our waiting list.
    var $_PHPSHOP_CART_SELECT_ITEM = "กรุณาเลือกรายการสินค้าที่ต้องการก่อน!"; // Please select a special item from the details page!
    
    var $_PHPSHOP_REGISTRATION_FORM_NONE = "ไม่ระบุ"; // none
    var $_PHPSHOP_REGISTRATION_FORM_MR = "นาย"; // Mr.
    var $_PHPSHOP_REGISTRATION_FORM_MRS = "นาง"; // Mrs.
    var $_PHPSHOP_REGISTRATION_FORM_DR = "ดร."; // Dr.
    var $_PHPSHOP_REGISTRATION_FORM_PROF = "ศจ."; // Prof."
    var $_PHPSHOP_DEFAULT = "กำหนดเป็นค่าปกติ"; // Default
    
  /*#####################################################
    MODULE AFFILIATE
  #######################################################*/
    var $_PHPSHOP_AFFILIATE_MOD   = "ผู้ดูแลระบบสมาชิกเครือข่าย"; // Affiliate Administration
    
    // Affiliate List
    var $_PHPSHOP_AFFILIATE_LIST_MNU		= "สมาชิกเครือข่าย"; // List Affiliates
    var $_PHPSHOP_AFFILIATE_LIST_LBL		= "สมาชิกเครือข่าย"; // Affiliates List
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME	= "ชื่อสมาชิก"; // Affiliate Name
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE = "เลือก"; // Active
    var $_PHPSHOP_AFFILIATE_LIST_RATE		= "อัตรา"; // Rate
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL = "จำนวนเดือน"; // Month Total
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION ="ค่าคอมมิชชั่น"; // Month Commission
    var $_PHPSHOP_AFFILIATE_LIST_ORDERS = "เรียงลำดับ"; // List Orders
    
    // Affiliate Email
    var $_PHPSHOP_AFFILIATE_EMAIL_MNU		= "อีเมล์สมาชิก"; // Email Affiliates
    var $_PHPSHOP_AFFILIATE_EMAIL_LBL		= "อีเมล์สมาชิก"; // Email Affiliates
    var $_PHPSHOP_AFFILIATE_EMAIL_WHO	= "อีเมล์ถึง (* = ทั้งหมด)"; // Who to Email(* = ALL)
    var $_PHPSHOP_AFFILIATE_EMAIL_CONTENT		= "อีเมล์ของท่าน"; // Your Email
    var $_PHPSHOP_AFFILIATE_EMAIL_SUBJECT = "หัวข้อ"; // The Subject
    var $_PHPSHOP_AFFILIATE_EMAIL_STATS	 = "รวมสถิติปัจจุบัน"; // Include Current Statistics
    
    // Affiliate Form
    var $_PHPSHOP_AFFILIATE_FORM_RATE		= "อัตราค่าคอมมิชชั่น (เปอร์เซ็นต์)"; // Commission Rate (percent)
    var $_PHPSHOP_AFFILIATE_FORM_ACTIVE		= "เลือก?"; // Active?
    
    var $_PHPSHOP_DELIVERY_TIME = "จัดส่งภายใน"; // Usually ships in
    var $_PHPSHOP_DELIVERY_INFORMATION = "รายละเอียดการจัดส่ง"; // Delivery Information
    var $_PHPSHOP_MORE_CATEGORIES = "สินค้าหมวดอื่นๆ"; // more categories
    var $_PHPSHOP_AVAILABILITY = "สินค้าพร้อมจำหน่าย"; // Availability
    var $_PHPSHOP_CURRENTLY_NOT_AVAILABLE = "สินค้าหมด"; // This product is currently not available.
    var $_PHPSHOP_PRODUCT_AVAILABLE_AGAIN = "จะมีสินค้า: "; // It will be available again on: 
    
    var $_PHPSHOP_STATISTIC_SUMMARY = "ภาพรวม"; // Summary
    var $_PHPSHOP_STATISTIC_STATISTICS = "สถิติ"; // Statistics
    var $_PHPSHOP_STATISTIC_CUSTOMERS = "ลูกค้า"; // Customers
    var $_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS = "สินค้าที่มีการเคลื่อนไหว"; // active Products
    var $_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS = "สินค้าที่ไม่มีการเคลื่อนไหว"; // inactive Products
    var $_PHPSHOP_STATISTIC_SUM = "ผลรวม"; // Sum
    var $_PHPSHOP_STATISTIC_NEW_ORDERS = "รายการสั่งซื้อใหม่"; // New Orders
    var $_PHPSHOP_STATISTIC_NEW_CUSTOMERS = "ลูกค้าใหม่"; // New Customers
    
    
	//Waiting list : file /administrator/components/com_phpshop/html/shop.waiting_list.php
	var $_PHPSHOP_WAITING_LIST_MESSAGE = "กรุณาใส่อีเมล์ของท่าน เพื่อที่จะได้แจ้งกลับให้ทราบเมื่อมีรายการสินค้าในสต็อค เราจะไม่แบ่ง , ให้เช่า , ขาย หรือใช้อีเมล์ของท่านสำหรับรายการอื่นๆนอกจากแจ้งให้ท่านทราบเมื่อมีสินค้าในสต็อค<br /><br />Thank you!"; // Please enter your e-mail address below to be notified when this product comes back in stock.  We will not share, rent, sell or use this e-mail address for any other purpose other than to tell you when the product is back in stock.<br /><br />Thank you!
	var $_PHPSHOP_WAITING_LIST_THANKS = "ขอบคุณที่กรุณารอ! <br />เราจะแจ้งให้คุณทราบเมื่อมีรายการในคลังสินค้า"; // Thanks for waiting! <br />We will let you know as soon as we get our inventory.
	var $_PHPSHOP_WAITING_LIST_NOTIFY_ME = "แจ้ังให้ทราบ!"; // Notify Me!
	
	//Checkout : file /administrator/components/com_phpshop/html/checkout.thankyou.php
	var $_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW = "มุมมองสำหรับพิมพ์"; // Print view
  
  /**************************Admin.show_cfg.php in apparition order ;-)**************************************/
	
	/* PAGE 1 */
	var $_PHPSHOP_ADMIN_CFG_AUTORIZE_OR_CYBERCASH = "โปรดเลือก Authorize.net หรือ CyberCash"; // Please choose EITHER Authorize.net OR CyberCash
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS = " ตั้งค่าสถานะไฟล์:"; //  Configuration file status:
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE = "เขียนทับได้"; // is writeable
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE = "ไม่สามารถเขียนทับได้"; // is unwriteable
	
	var $_PHPSHOP_ADMIN_CFG_GLOBAL = "Global"; // Global
	var $_PHPSHOP_ADMIN_CFG_PATHANDURL = "Path & URL"; // Path & URL
	var $_PHPSHOP_ADMIN_CFG_SITE = "ไซต์"; // Site
	var $_PHPSHOP_ADMIN_CFG_SHIPPING = "การจัดส่ง"; // Shipping
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT = "สั่งซื้อ"; // Checkout
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS = "ดาวน์โหลด"; // Downloads
	var $_PHPSHOP_ADMIN_CFG_PAYEMENTOPTIONS = "การชำระเงิน"; // Payments
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE = "แสดงเฉพาะรายการแคตตาล็อกสินค้า"; // Use only as catalogue
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN = "ถ้าเลือกรายการนี้ จะไม่สามารถใช้ฟังก์ชั่นรถเข็นชำระเงินได้"; // If you check this, you disable all cart functionalities.
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES = "แสดงราคา"; // Show Prices
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX = "แสดงราคารวมภาษี?"; // Show Prices including tax?
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN = "กำหนดเพื่อแสดงให้ลูกค้าเห็นราคารวมภาษี หรือยกเว้นภาษี"; // Sets the flag whether the shoppers sees prices including tax or excluding tax."
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN = "เลือกเพื่อให้แสดงราคา กรณีที่เลือกแสดงเฉพาะแคตตาล็อกสินค้าอย่างเดียว อาจจะไม่ต้องการแสดงราคา"; // Check to show prices. If using catalogue functionality, some don't want prices to appear on pages.
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX = "ภาษีตามจริง"; // Virtual Tax
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN = "กำหนดรายการที่ไม่ระบุน้ำหนักว่าต้องมีภาษีหรือไม่ ให้แก้ไข ps_checkout.php->calc_order_taxable() เพื่อเปลี่ยนแปลงผล"; // This determines whether items with zero weight are taxed or not. Modify ps_checkout.php->calc_order_taxable() to customize this.
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE = "รูปแบบการคำนวนภาษี:"; // Tax mode:
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP = "กำหนดตามสถานที่จัดส่ง"; // Based on shipping address
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR = "กำหนดตามที่อยู่ผู้ขาย"; // Based on vendor address
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN = "กำหนดเพื่อเลือกอัตราภาษีที่จะนำไปใช้ในการคำนวนภาษี:<br /> <ul><li>จากรัฐหรือประเทศที่ร้านค้าตั้งอยู่</li><br/> <li>หรือจากประเทศที่ลูกค้าอยู่</li></ul>"; // This determines which tax rate is taken for calculating taxes:<br /> <ul><li>the one from the state / country the store owner comes from</li><br/> <li>or the one from where the shopper comes from.</li></ul>"
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE = "แสดงภาษีหลายอัตรา?"; // Enable multiple tax rates?
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN = "เลือกรายการนี้ ถ้ามีรายการสินค้าที่มีอัตราภาษีแตกต่างกัน (เช่น หนังสือและอาหาร 7% , อย่างอื่นๆ 16%)"; // Check this, if you have products with different tax rates (e.g. 7% for books and food, 16% for other stuff)
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE = "หักส่วนลดก่อนคิดภาษีและค่าขนส่ง?"; // Subtract payment discount before tax/shipping?
  var $_PHPSHOP_ADMIN_CFG_REVIEW = "อนุญาตให้ลูกค้าแสดงความคิดเห็น หรือโหวตให้คะแนนได้"; // Enable Customer Review/Rating System
  var $_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN = "ถ้าเลือกรายการนี้ จะทำให้ลูกค้าสามารถให้คะแนนโหวตสินค้า และแสดงความคิดเห็นได้<br /> เพื่อให้ลูกค้าสามารถแสดงความเห็นเกี่ยวกับตัวสินค้านั้นแก่ลูกค้ารายอื่นๆ<br />"; // If enabled, you allow customers to <strong>rate products</strong> and <strong>write reviews</strong> about them. <br /> So customers can write down their experiences with the product for other customers.<br />
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN = "กำหนดให้หักส่วนลดก่อนเลือกขั้นตอนชำระเงิน หรือหลังจากรวมภาษีและค่าขนส่งแล้ว"; // Sets the flag whether to subtract the Discount for the selected payment BEFORE (checked) or AFTER tax and shipping.
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK = "ลูกค้าสามารถเ้ว้นข้อมูลทางด้านบัญชีธนาคาร?"; // Customers can leave bank account data?
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN = "เลือกรายการนี้ ถ้าหากลูกค้าต้องการจะปกป้องข้อมูลทางด้านบัญชีธนาคารตอนลงทะเบียน"; // Check if your customers shall have the ability to provide their bank account data when registering to the shop.

	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE = "ลูกค้าสามารถเลือกรัฐ หรือภูมิภาคได้?"; // Customers can select a state/region?
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN = "เลือกรายการนี้ ลูกค้าจะสามารถเลือกรายการรัฐหรือภูมิภาคในขั้นตอนการลงทะเบียน"; // Check if your customers shall have the ability to select their state / region data when registering to the shop.
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS = "ต้องเห็นชอบกับข้อตกลงการใช้บริการ?"; // Must agree to Terms of Service?
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN = "เลือกรายการนี้ หากต้องการให้ผู้ซื้อต้องเห็นชอบกับข้อตกลงการใช้บริการก่อน"; // Check if you want a shopper to agree to your terms of service before registering to the shop.
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK = "ตรวจนับสินค้า?"; // Check Stock?
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN = "กำหนดให้มีการตรวจนับสินค้า เมื่อผู้ซื้อหยิบสินค้าใส่รถเข็น ถ้าเลือกรายการนี้จะทำให้ลูกค้าไม่สามารถเพิ่มรายการสินค้าในรถเข็นถ้าหากไม่มีสินค้าในสต๊อค"; // Sets whether to check the stock level when a user adds an item to the shopping cart.  If set, this will not allow user to add more items to the cart than are available in stock.
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE = "อนุญาตให้มีระบบสมาชิกเครือข่าย?"; // Enable Affiliate Program?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN = "ถ้าเลือกรายการนี้ จะเป็นการอนุญาตให้้มีระบบการติดตามสมาชิกเครือข่ายจากหน้าร้าน.."; // This enables the affiliate tracking in the shop-frontend. Enable if you have added affiliates in the backend..
	
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT = "รูปแบบการยืนยันการสั่งซื้อที่ส่งไปทางอีเมล์:"; // Order-mail format:
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT = "แบบอักษรธรรมดา"; // Text mail
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML = "แบบ HTML"; // HTML mail
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN = "ระบุการยืนยันการสั่งซื้อทางอีเมล์:<br /> <ul><li>แบบอักษรธรรมดา</li> <li>แบบ HTML พร้อมรูปภาพ</li></ul>"; // This determines how your order confirmation emails are set up:<br /> <ul><li>as a simple text email</li> <li>or as a html email with images.</li></ul>
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN = "อนุญาตให้มีผู้ดูแลระบบเฉพาะหน้าร้าน?"; // Allow Frontend-Administration for non-Backend Users?
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN = "สามารถกำหนดให้มีผู้ดูแลระบบเฉพาะหน้าร้าน เช่น storeadmins แต่ไม่สามารถเข้าถึงระบบการจัดการของ Mambo ได้ (เช่น Registered / Editor)"; // With this setting you can enable the Frontend Administration for users who are storeadmins, but can't access the Mambo Backend (e.g. Registered / Editor).
	
	/* PAGE 2 */
	var $_PHPSHOP_ADMIN_CFG_URL = "URL"; // URL
	var $_PHPSHOP_ADMIN_CFG_URL_EXPLAIN = "URL สำหรับ Mambo ไซต์ของท่าน (ใส่เครื่องหมาย / ต่อท้่ายด้วย!)"; // The URL to your site. Usually identical to your Mambo URL (with trailing slash at the end!)
	var $_PHPSHOP_ADMIN_CFG_URLSECURE = "SECUREURL"; // SECUREURL
	var $_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN = "URL สำหรับการเข้ารหัสรักษาความปลอดภัย (https - และใส่เครื่องหมาย / ต่อท้่ายด้วย!)"; // The secure URL to your site. (https - with trailing slash at the end!)
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT = "COMPONENTURL"; // COMPONENTURL
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN = "URL สำหรับคอมโพเน้นท์ของ mambo-phpShop (ใส่เครื่องหมาย / ต่อท้่ายด้วย!)"; // The URL to the mambo-phpShop component. (with trailing slash at the end!)
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE = "IMAGEURL"; // IMAGEURL
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN = "URL สำหรับเก็บรูปภาพคอมโพเน้นท์ของ mambo-phpShop (ใส่เครื่องหมาย / ต่อท้่ายด้วย!)"; // The URL to the mambo-phpShop component image directory.(with trailing slash at the end!)
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH = "ADMINPATH"; // ADMINPATH
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN = "ไดเรคทอรี่พาธสำหรับคอมโพเน้นท์ของ mambo-phpShop"; // The path to your mambo-phpShop component directory.
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH = "CLASSPATH"; // CLASSPATH
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN = "ไดเรคทอรี่พาธสำหรับคลาสของ phpShop"; // The path to your phpShop classes directory.
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH = "PAGEPATH"; // PAGEPATH
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN = "ไดเรคทอรี่พาธสำหรับเก็บไฟล์ html ของ phpShop"; // The path to your phpShop html directory.
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH = "IMAGEPATH"; // IMAGEPATH
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN = "ไดเรคทอรี่พาธสำหรับเก็บรูปภาพของ phpShop"; // The path to your phpShop shop_image directory.
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE = "HOMEPAGE"; // HOMEPAGE
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN = "หน้าแสดงผลหน้าแรก"; // 	This is the page which will be loaded by default.
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE = "ERRORPAGE"; // ERRORPAGE
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN = "หน้าแสดงข้อความเกี่ยวกับข้อผิดพลาด"; // This is the default page for displaying error messages.	
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE = "DEBUGPAGE"; // DEBUGPAGE
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN = "หน้าแสดงผลข้อความการดีบัก"; // his is the default page for displaying debug messages.
	var $_PHPSHOP_ADMIN_CFG_DEBUG = "DEBUG ?"; // DEBUG ?
	var $_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN = "ดีบัก ?  เปิดใช้งานการแสดงผลการดีบัก	- จะแสดงผลที่ด้านล่างของแต่ละหน้า. ซึ่งจะช่วยในการปรับปรุงแก้ไขระบบ การพัฒนาร้านค้า การแสดงรายละเอียดในรถเข็น การแสดงค่าต่างๆ เป็นต้น"; // DEBUG?  	   	Turns on the debug output. This causes the DEBUGPAGE to be displayed at the bottom of each page. Very helpful during shop development since it shows the carts contents, form field values, etc.


/* PAGE 3 */

	var $_PHPSHOP_ADMIN_CFG_FLYPAGE = "หน้าต่างใหม่"; // FLYPAGE
	var $_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN = "หน้าต่างแสดงรายละเอียดสินค้า"; // This is the default page for displaying product details.
  var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE = "รูปแบบหมวดสินค้า"; // Category Template
	var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN = "กำหนดรูปแบบปกติสำหรับการแสดงสินค้าในแต่ละหมวด<br /> ท่านสามารถสร้างรูปแบบใหม่จากไฟล์เทมเพลตที่มีอยู่<br /> (ซึ่งเก็บอยู่ในไดเรคทอรี่ <strong>COMPONENTPATH/html/templates/</strong>)"; // This defines the default category template for displaying products in a category.<br /> You can create new templates by customizing existing template files <br /> (which reside in the directory <strong>COMPONENTPATH/html/templates/</strong> and begin with browse_)
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW = "จำนวนปกติของสินค้าในแต่ละแถว"; // Default number of products in a row
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN = "แสดงจำนวนสินค้าในแต่ละแถว. <br /> ตัวอย่างเช่น: ถ้ากำหนดเป็น 4 ก็จะแสดงจำนวนสินค้า 4 รายการต่อแถว"; // This defines the number of products in a row. <br /> Example: If you set it to 4, the category template will display 4 products per row
  
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE = "รูปภาพ \"no image\""; // \"no image\" image
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN = "แสดงภาพนี้เมื่อไม่มีภาพสินค้า"; // This image will be shown when no product image is available.
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS = "จำนวนบรรทัดต่อหน้า"; // SEARCH ROWS
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN = "ระบุจำนวนบรรทัดต่อหน้า จากผลการค้นหาที่ได้"; // Determines the number of rows per page when search results are displayed in a list.
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 = "สีแถบรายการค้นหา 1"; // SEARCH COLOR 1
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN = "กำหนดสีของแถบรายการค้นหาในแถวเลขคี่"; // Specifies the color of the odd numbered rows in a result list.
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 = "สีแถบรายการค้นหา 2"; // SEARCH COLOR 2
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN = "กำหนดสีของแถบรายการค้นหาในแถวเลขคู่"; // Specifies the color of the even numbered rows in a result list.
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS = "จำนวนบรรทัดสูงสุด"; // MAXIMUM ROWS
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN = "กำหนดจำนวนบรรทัดที่จะแสดงในส่วนของรายการ"; // Sets the number of rows to show in the order list select box.
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION = "แสดง \"powered by mambo-phpShop\" ที่ด้านล่าง ?"; // Show footer \"powered by mambo-phpShop\" ?
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN = "แสดงภาพ powered-by-mambo-phpShop"; // Displays a powered-by-mambo-phpShop footer image.
	
	
	/* PAGE 4 */
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD = "เลือกวิธีการขนส่ง"; // Choose your store's shipping method
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD = "โมดูลขนส่งมาตรฐาน ตามผู้ขนส่ง และอัตราค่าขนส่งของแต่ละราย  <strong>แนะนำ !</strong>"; // Standard Shipping module with indiviual configured carriers and rates. <strong>RECOMMENDED !</strong>
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE = "  	Zone Shipping Module Country Version 1.0<br />ดูรายละเอียดเพิ่มเติม <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br /> หรือต้องการติดต่อ <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a><br /> เลือกใช้โมดูล Zone Shipping"; //   	Zone Shipping Module Country Version 1.0<br />For more information on this module please visit <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br /> for details or contact <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a><br /> Check this to enable the zone shipping module
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS = "<a href=\"http://www.ups.com\" target=\"_blank\">UPS Online(R) Tools</a> คำนวนค่าขนส่งออนไลน์"; // <a href=\"http://www.ups.com\" target=\"_blank\">UPS Online(R) Tools</a> Shipping calculation
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE = "รหัสประมวลผลของ UPS"; // UPS access code
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN = "รหัสประมวลผลของ UPS ของท่าน"; // Your UPS access code
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID = "ชื่อผู้ใช้งาน UPS"; // UPS user id
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN = "ชื่อผู้ใช้งานที่ท่านได้รับจาก UPS"; // The user ID you got from UPS
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD = "รหัสผ่าน UPS"; // UPS password
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN = "รหัสผ่านสำหรับบัญชีผู้ใช้งาน UPS "; // The password for your UPS account
	  
  var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER = "เลือกโมดูล InterShipper ถ้าท่านมีบัญชีของ <a href=\"http://www.intershipper.com\" target=\"_blank\">Intershipper.com</a>"; // InterShipper Module. Check only if you have an <a href=\"http://www.intershipper.com\" target=\"_blank\">Intershipper.com</a> account
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE = "ไม่ต้องเลือกวิธีการขนส่ง กรณีที่ลูกค้าซื้อสินค้าที่ใช้วิธีดาวน์โหลด"; // Disable Shipping method selection. Choose if your customers buy downloadable goods which don't have to be shipped.
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD = "รหัสผ่านเข้า InterShipper"; // InterShipper Password
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD_EXPLAIN = "รหัสผ่านของท่านที่ใช้กับบัญชีของ InterShipper"; // Your password for your intershipper account.
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL = "InterShipper email"; // InterShipper email
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL_EXPLAIN = "อีเมล์ของท่านที่ใช้กับบัญชีของ InterShipper"; // Your email address for your intershipper account.
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY = "ENCODE KEY"; // ENCODE KEY
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN = "สำหรับใช้เข้ารหัสข้อมูลที่เก็บไว้ในระบบฐานข้อมูล ซึ่งไฟล์นี้จะได้รับการป้องกันไม่ให้มีใครมาดูข้อมูลนี้ได้"; // Used to encrypt data stored in database with this key. This means that this file should be protected from viewing at all times.
	
	
	/* PAGE 5 */
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR = "แสดงแถบขั้นตอนการชำระเงิน"; // Enable the Checkout Bar
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN = "เลือกรายการนี้เพื่อแสดงแถบขั้นตอนการชำระเงิน ( 1 - 2 - 3 - 4 พร้อมภาพกราฟฟิค)"; // Check this, if you want the 'checkout-bar' to be displayed to the customer during checkout process ( 1 - 2 - 3 - 4 with graphics).
	
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS = "เลือกวิธีการชำระเงินสำหรับร้านค้าของท่าน"; // Choose your store's checkout process
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD = "<strong>แบบทั่วไป :</strong><br/>1. ต้องการสถานที่จัดส่ง<br />2. ต้องการวิธีการขนส่ง<br />3. ต้องการวิธีการชำระเงิน<br />4. การสั่งซื้อสมบูรณ์"; // <strong>Standard :</strong><br/>1. Shipping address request<br />2. Shipping method request<br />3. Payment method request<br />4. Complete Order
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 = "<strong>แบบที่ 2:</strong><br/>1. ต้องการสถานที่จัดส่ง<br />2. ต้องการวิธีการชำระเงิน<br />3. การสั่งซื้อสมบูรณ์"; // <strong>Process 2:</strong><br/>1. Shipping address request<br />2. Payment method request<br />3. Complete Order
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 = "<strong>แบบที่ 3:</strong><br/>1. ต้องการสถานที่จัดส่ง<br />2. ต้องการวิธีการชำระเงิน<br />3. การสั่งซื้อสมบูรณ์"; // <strong>Process 3:</strong><br/>1. Shipping method request<br />2. Payment method request<br />3. Complete Order
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 = "<strong>แบบที่ 4:</strong><br/>1. ต้องการวิธีการชำระเงิน<br />2. การสั่งซื้อสมบูรณ์"; // <strong>Process 4:</strong><br/>1. Payment method request<br />2. Complete Order
	
		
	/* PAGE 6 */
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS = "อนุญาตให้ดาวน์โหลดได้"; // Enable Downloads
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN = "เลือกเพื่ออนุญาตให้สามารถดาวน์โหลดได้ ใช้สำหรับจำหน่ายสินค้าที่ให้บริการแบบดาวน์โหลด"; // Check to enable the download capability. Only If you want sell downloadable goods.
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS = "สถานะการสั่งซื้อกรณีอนุญาตให้ดาวน์โหลดได้"; // Order Status which enables download
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN = "เลือกสถานะการสั่งซื้อ ในกรณีที่ลูกค้าระบุให้มีการดาวน์โหลดทางอีเมล์"; // Select the order status at which the customer is notified about the download via e-mail.
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS = "สถานะการสั่งซื้อกรณีไม่อนุญาตให้มีการดาวน์โหลด"; // Order Status which disables downloads
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN = "กำหนดสถานะการสั่งซื้อ ในกรณีที่ไม่อนุญาตให้ลูกค้าดาวน์โหลด"; // Sets the order status at which the download is disabled for the customer.
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT = "พาธที่ใช้เก็บไฟล์ดาวน์โหลด"; // DOWNLOADROOT
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN = "พาธที่อยู่ที่ใช้เก็บไฟล์สำหรับให้ลูกค้าดาวน์โหลด (ใส่เครื่องหมาย / ตอนท้ายด้วย!)<br><span class=\"message\">เพื่อความปลอดภัย: กรุณาอย่าใช้พาธที่เป็น WEBROOT</span>"; // The physical path to the files for the custumer download. (trailing slash at the end!)<br><span class=\"message\">For your own shop's security: If you can, please use a directory ANYWHERE OUTSIDE OF THE WEBROOT</span>
	
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX = "จำนวนครั้งดาวน์โหลดสูงสุด"; // Download Maximum
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN = "กำหนดจำนวนครั้งที่สามารถดาวน์โหลดได้ต่อหนึ่งรหัส Download-ID (ต่อการสั่งซื้อหนึ่งรายการ)"; // Sets the number of downloads which can be made with one Download-ID, (for one order)"
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE = "ครบกำหนดดาวน์โหลด"; // Download Expire
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN = "กำหนดระยะเวลาเป็น <strong>วินาที</strong> โดยจะคิดเมื่อเริ่มมีการดาวน์โหลด เมื่อครบเวลาแล้วรหัส download-ID จะไม่สามารถใช้งานได้อีก<br />หมายเหตุ : 86400 วินาที = 24 ชม."; // Sets the time range <strong>in seconds</strong> in which the download is enabled for the customer. This range begins with the first download! When the time range has expired, the download-ID is disabled.<br />Note : 86400s=24h.
		
	
	/* PAGE 7 */
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL = "เลือกใช้การชำระเงินด้วย PayPal?"; // Enable IPN Payment via PayPal?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL_EXPLAIN = "เลือกเพื่อให้ลูกค้าของท่านที่ใช้ระบบการชำระเงินผ่านระบบ PayPal"; // Check to let your customers use the PayPal payment system.
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL = "อีเมล์สำหรับชำระเงินผ่าน PayPal:"; // PayPal payment email:
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL_EXPLAIN = "อีเมล์ของท่านที่ใช้สำหรับการชำระเงินผ่านระบบของ PayPal"; // Your business email address for PayPal payments. Also used as receiver_email.
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS = "สถานะการสั่งซื้อ เมื่อทำรายการสมบูรณ์"; // Order Status for successful transactions
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS_EXPLAIN = "เลือกสถานะการสั่งซื้อ เมื่อทำธุรกรรมผ่าน PayPal เรียบร้อยแล้ว<br />ถ้าใช้ระบบการขายแบบให้ดาวน์โหลด: ให้เลือกสถานะพร้อมให้ดาวน์โหลด (ซึ่งลูกค้าจะได้รับข้อความตอบรับเกี่ยวกับการดาวน์โหลดทางอีเมล์)"; // Select the order status to which the actual order is set, if the PayPal IPN was successful. If using download selling options: select the status which enables the download (then the customer is instantly notified about the download via e-mail).
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED = "สถานะการสั่งซื้อเมื่อทำธุรกรรมไม่ผ่าน"; // Order Status for failed transactions
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED_EXPLAIN = "เลือกสถานะการสั่งซื้อ เมื่อไม่สามารถทำธุรกรรมผ่าน PayPal ได้"; // Select an order status for failed PayPal transactions.
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE = "เลือกใช้การชำระเงินด้วย PayMate?"; // Enable Payments via PayMate?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE_EXPLAIN = "เลือกเพื่อให้ลูกค้าของท่านที่ใช้ระบบการชำระเงินผ่านระบบ Australian PayMate"; // Check to let your customers use the Australian PayMate payment system.
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME = "PayMate username:"; // PayMate username:
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME_EXPLAIN = "ชื่อผู้ใช้งานสำหรับบัญชีของ PayMate."; // Your user account for PayMate.
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET = "เลือกใช้การชำระเงินของ Authorize.net?"; // Enable Authorize.net payment?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_EXPLAIN = "เลือกใช้ Authorize.net กับ phpShop"; // Check to use Authorize.net with phpShop.
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE = "โหมดทดสอบ ?"; // Test mode ?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE_EXPLAIN = "เลือก 'ใช่' เพื่อทำรายการทดสอบ -- เลือก 'ไม่ใช่' เพื่อทำรายการจริง"; // Select 'Yes' while testing. Select 'No' for enabling live transactions.
	var $_PHPSHOP_ADMIN_CFG_YES = "ใช่"; // Yes
	var $_PHPSHOP_ADMIN_CFG_NO = "ไม่ใช่"; // No
	
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME = "หมายเลข ID ของ Authorize.net"; // Authorize.net Login ID
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME_EXPLAIN = "นี่คือหมายเลข ID ของ Authorize.Net ของท่าน"; // This is your Authorize.Net Login ID
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY = "เลขรหัสการทำธุรกรรมกับ Authorize.net"; // Authorize.net Transaction Key
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY_EXPLAIN = "นี่คือเลชรหัสสำหรับใช้ทำธุรกรรมกับ Authorize.net"; // This is your Authorize.net Transaction Key
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE = "ประเภทการรับรอง"; // Authentication Type
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE_EXPLAIN = "ประเภทการรับรองของ Authorize.Net"; // This is the Authorize.Net authentication type.
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH = "เลือกใช้ CyberCash?"; // Enable CyberCash?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH_EXPLAIN = "เลือกใช้ CyberCash กับ phpShop"; // Check to use CyberCash with phpShop.
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND = "CyberCash MERCHANT"; // CyberCash MERCHANT
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_EXPLAIN = "CC_MERCHANT เลขหมายผู้ใช้งานของ CyberCash"; // CC_MERCHANT is the CyberCash Merchant ID
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY = "CyberCash Merchant Key"; // CyberCash Merchant Key
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY_EXPLAIN = "CyberCash Merchant Key รหัสสำหรับผู้ใช้งานซึ่งกำหนดโดย CyberCash"; // CyberCash Merchant Key is the Merchant Provided by CyberCash
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL = "CyberCash PAYMENT URL"; // CyberCash PAYMENT URL
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL_EXPLAIN = "CyberCash PAYMENT URL คือ URL สำหรับระบบความปลอดภัยในการชำระเงินที่ Cybercash กำหนดให้"; // CyberCash PAYMENT URL is the URL provided by Cybercash for secure payment
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE = "CyberCash AUTH TYPE"; // CyberCash AUTH TYPE
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE_EXPLAIN = "CyberCash AUTH TYPE คือชนิดของการรับรองที่ทาง CyberCase กำหนดให้"; // CyberCash AUTH TYPE is the Cybercash authentication type provided by Cybercase
	
    /** Advanced Search feature ***/
    var $_PHPSHOP_ADVANCED_SEARCH  ="ค้นหาแบบละเอียด"; // Advanced Search
    var $_PHPSHOP_SEARCH_ALL_CATEGORIES = "ค้นหาจากหมวดทั้งหมด"; // Search All Categories
    var $_PHPSHOP_SEARCH_ALL_PRODINFO = "ค้นหารายละเอียดสินค้าทั้งหมด"; // Search all product info
    var $_PHPSHOP_SEARCH_PRODNAME = "ชื่อสินค้าอย่างเดียว"; // Product name only
    var $_PHPSHOP_SEARCH_MANU_VENDOR = "ผู้ขาย/ผู้ผลิต อย่างเดียว"; // Manufacturer/Vendor only
    var $_PHPSHOP_SEARCH_DESCRIPTION = "รายละเอียดสินค้าอย่างเดียว"; // Product description only
    var $_PHPSHOP_SEARCH_AND = "และ"; // and
    var $_PHPSHOP_SEARCH_NOT = "ไม่"; // not
    var $_PHPSHOP_SEARCH_TEXT1 = "รายการแรกสำหรับการเลือกหมวดหมู่ .รายการที่สองสำหรับเลือกรายละเอียด หรือส่วนประกอบเกี่ยวกับสินค้า (เช่น ชื่อสินค้า) เมื่อเลือกรายการแล้ว ให้ใส่คำที่ต้องการค้นหาเพื่อค้นหาสินค้า "; // The first drop-down-list allows you to select a category to limit your search to. The second drop-down-list allows you to limit your search to a particular piece of product information (e.g. Name). Once you have selected these (or left the default ALL), enter the keyword to search for. "
    var $_PHPSHOP_SEARCH_TEXT2 = "ท่านสามารถค้นหาแบบเจาะจงมากขึ้น โดยการเพิ่มคำที่ต้องการค้นหา และเลือกใช้คำสั่ง AND หรือ OR  -  เลือก AND หมายถึงจะค้นหาสินค้าที่มีคำค้นหาทั้งสองคำ,  เลือก OR หมายถึงจะค้นหาสินค้าที่มีคำค้นหาคำแรก และไม่มีคำที่สอง"; // You can further refine your search by adding a second keyword and selecting the AND or NOT operator. Selecting AND means both words must be present for the product to be displayed. Selecting NOT means the product will be displayed only if the first keyword is present and the second is not.
    var $_PHPSHOP_ORDERBY = "เรียงลำดับ"; // Order by
    
    /*** Review feature ***/
    var $_PHPSHOP_CUSTOMER_RATING  = "คะแนนโหวต"; // Average customer rating
    var $_PHPSHOP_TOTAL_VOTES = "คะแนนโหวตทั้งหมด"; // Total votes
    var $_PHPSHOP_CAST_VOTE = "โปรดเลือกคะแนนโหวต"; // Please cast your vote
    var $_PHPSHOP_RATE_BUTTON = "โหวต"; // Rate
    var $_PHPSHOP_RATE_NOM = "คะแนน"; // Rating
    var $_PHPSHOP_REVIEWS = "ความคิดเห็นของลูกค้า"; // Customer Reviews
    var $_PHPSHOP_NO_REVIEWS = "ยังไม่มีความคิดเห็นสำหรับสินค้านี้"; // There are yet no reviews for this product.
    var $_PHPSHOP_WRITE_FIRST_REVIEW = "เชิญแสดงความคิดเห็น..."; // Be the first to write a review...
    var $_PHPSHOP_REVIEW_LOGIN = "กรุณาเข้าสู่ระบบก่อนแสดงความคิดเห็น"; // Please log in to write a review.
    var $_PHPSHOP_REVIEW_ERR_RATE = "กรุณาให้คะแนนโหวตด้วย"; // Please rate the product to complete your review!
    var $_PHPSHOP_REVIEW_ERR_COMMENT1 = "โปรดบันทึกความคิดเห็นของท่าน อย่างน้อย 100 ตัวอักษร"; // Please write down some more words for your review. Mininum characters allowed: 100
    var $_PHPSHOP_REVIEW_ERR_COMMENT2 = "กรุณาแสดงความคิดเห็นไม่เกิน 2000 ตัวอักษร"; // Please shorten your review. Maximum characters allowed: 2000
    var $_PHPSHOP_WRITE_REVIEW = "แสดงความคิดเห็นสำหรับสินค้านี้!"; // Write a review for this product!
    var $_PHPSHOP_REVIEW_RATE = "ขั้นแรก: ให้คะแนนสินค้า โปรดระบุคะแนนระหว่าง 0 (แย่มาก) ถึง 5 ดาว (ดีเยี่ยม)."; // First: Rate the product. Please select a rating between 0 (poorest) and 5 stars (best).
    var $_PHPSHOP_REVIEW_COMMENT = "กรุณาแสดงความคิดเห็น....(อย่างน้อย 100 ตัวอักษร, สูงสุด 2000 ตัวอักษร) "; // Now please write a (short) review....(min. 100, max. 2000 characters) 
    var $_PHPSHOP_REVIEW_COUNT = "จำนวนตัวอักษร: "; // Characters written: 
    var $_PHPSHOP_REVIEW_SUBMIT = "ตกลง"; // Submit Review
    var $_PHPSHOP_REVIEW_ALREADYDONE = "ท่านได้แสดงความคิดเห็นสำหรับสินค้านี้แล้ว"; // You already have written a review for this product. Thank you.
    var $_PHPSHOP_REVIEW_THANKYOU = "ขอบคุณสำหรับความคิดเห็นของท่าน"; // Thanks for your review.
    var $_PHPSHOP_COMMENT= "หมายเหตุ"; // Comment
    
    var $_PHPSHOP_CREDITCARD_FORM_LBL = "เพิ่ม/แก้ไขประเภทบัตรเครดิต"; //Add/Edit Credit Card Types 
    var $_PHPSHOP_CREDITCARD_NAME = "ชื่อบัตรเครดิต"; // Credit Card Name
    var $_PHPSHOP_CREDITCARD_CODE = "รหัสย่อ"; // Credit Card - Short Code
    var $_PHPSHOP_CREDITCARD_TYPE = "ประเภทบัตรเครดิต"; // Credit Card Type
    
    var $_PHPSHOP_CREDITCARD_LIST_LBL = "บัตรเครดิต"; // Credit Card List
    var $_PHPSHOP_UDATE_ADDRESS = "ปรับปรุง"; // Update Address
    var $_PHPSHOP_CONTINUE_SHOPPING = "เลือกสินค้าต่อ"; // Continue Shopping
    
    var $_PHPSHOP_THANKYOU_SUCCESS = "รายการสั่งซื้อของท่านได้รับการดำเนินการเรียบร้อยแล้ว!"; // Your order has been successfully placed!
    var $_PHPSHOP_ORDER_LINK = "ดูรายละเีอียดการสั่งซื้อ"; // Follow this link to view the Order Details.
    
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "สถานะการสั่งซื้อของใบสั่งซื้อเลขที่ {order_id} มีการเปลี่ยนแปลง"; // the Status of your Order No. {order_id} has been changed.
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "สถานะใหม่:"; // New Status is:
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "ต้องการดูรายละเอียดการสั่งซื้อ โปรดคลิ๊กลิ้งค์ (หรือคัดลอกไปเปิดยังบราวเซอร์ของท่าน):"; // To view the Order Details, please follow this link (or copy it into your browser):
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "เปลี่ยนสถานะการสั่งซื้อ: ใบสั่งซื้อเลขที่ {order_id}"; // Order Status Change: Your Order {order_id}
    var $_PHPSHOP_ORDER_LIST_NOTIFY = "แจ้งลูกค้าให้ทราบ?"; // Notify Customer?
    var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "กรุณาเปลี่ยนสถานะการสั่งซื้อก่อน!"; // Please change the Order Status first!
    
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "ส่วนลดสำหรับกลุ่มผู้ซื้อทั่วไป (%)"; // Price Discount on default Shopper Group (in %)
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = " X ที่เป็นค่าบวก หมายถึง: ถ้าสินค้าไม่ได้มีการระบุราคาสำหรับกลุ่มผู้ซื้อ ราคาจะลดตามจำนวน X % จำนวนติดลบจะมีผลตรงข้าม"; // A positive amount X means: If the Product has no Price assigned to THIS Shopper Group, the default Price is decreased by X %. A negative amount has the opposite effect
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_LBL = "สินค้าลดราคา"; // Product Discount
    var $_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL = "สินค้าลดราคา"; // Product Discount List
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT = "เพิ่ม/แก้ไขรายการลดราคา"; // Add/Edit Product Discount
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT = "ส่วนลด"; // Discount amount
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP = "ระบุจำนวนส่วนลด"; // Enter the discount amount
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE = "ประเภทส่วนลด"; // Discount Type
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT = "เปอร์เซ็นต์"; // Percentage
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL = "ยอดรวม"; // Total
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP = "ระบุเป็นเปอร์เซ็นต์ หรือยอดรวม?"; // Shall the amount be a percentage or a total?
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE = "เิริ่มลดราคาวันที่"; // Start date of discount
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP = "กำหนดวันที่เริ่มลดราคา"; // Specifies the day when the discount begins
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE = "สิ้นสุดวันที่"; // End date of discount
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP = "กำหนดวันที่สิ้นสุดการลดราคา"; // Specifies the day when the discount ends
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP = "ท่านสามารถใช้แบบฟอร์มส่วนลดสำหรับเพิ่มรายการส่วนลด!"; // You can use the Product Discount Form to add discounts!
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_SAVE = "ท่านประหยัดได้"; // You Save
    
    var $_PHPSHOP_FLYPAGE_ENLARGE_IMAGE = "ดูภาพขยาย"; // View Full-Size Image
    
/*********************
Currency Display Style 
***********************/
    var $_PHPSHOP_CURRENCY_DISPLAY = "รูปแบบการแสดงสกุลเงิน"; // Currency Display Style
    var $_PHPSHOP_CURRENCY_SYMBOL = "สัญลักษณ์สกุลเงิน"; // Currency symbol
    var $_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP = "ท่านสามารถใช้ HTML ได้ (เช่น &amp;euro;,&amp;pound;,&amp;yen;,...)"; // You can also use HTML Entities here (e.g. &amp;euro;,&amp;pound;,&amp;yen;,...)
    var $_PHPSHOP_CURRENCY_DECIMALS = "จุดทศนิยม"; // Decimals
    var $_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP = "แสดงจำนวนตำแหน่งทศนิยม (ระบุเป็น 0 ได้)<br><b>ถ้าค่าที่ระบุไม่ตรงตามตำแหน่งทศนิยม จะแสดงเป็นหลักถ้วนๆ</b>"; // Number of displayed decimals (can be 0)<br><b>Performs rounding if value has different number of decimals</b>
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL = "สัญลักษณ์จุดทศนิยม"; // Decimal symbol
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP = "สัญลักษณ์ที่ใช้แสดงจุดทศนิยม"; // Character used as decimal symbol
    var $_PHPSHOP_CURRENCY_THOUSANDS = "เครื่องหมายจุลภาค"; // Thousands separator
    var $_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP = "สัญลักษณ์ที่ใช้แสดงหลักพัน (สามารถเว้นว่างไว้)"; // Character used to separate thousands (can be empty)
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY = "รูปแบบการแสดงค่าบวก"; // Positive format
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP = "รูปแบบการแสดงผลค่าบวก<br>(Symb : เครื่องหมายสกุลเิงิน)"; // Display format used to display positive values.<br>(Symb stands for currency symbol)
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY = "รูปแบบการแสดงค่าลบ"; // Negative format
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP = "รูปแบบการแสดงผลค่าลบ<br>(Symb : เครื่องหมายสกุลเิงิน)"; // Display format used to display negative values.<br>(Symb stands for currency symbol)
    
    var $_PHPSHOP_OTHER_LISTS = "รายการสินค้าอื่นๆ"; // Other Product Lists
/**************
Multiple Images 
****************/
    var $_PHPSHOP_MORE_IMAGES = "ดูภาพอื่นๆ"; // View More Images
    var $_PHPSHOP_AVAILABLE_IMAGES = "รูปภาพสำหรับ"; // Available Images for
    var $_PHPSHOP_BACK_TO_DETAILS = "รายละเอียดสินค้า"; // Back to Product Details
    
    /* FILEMANAGER */
    var $_PHPSHOP_FILEMANAGER = "การจัดการไฟล์ข้อมูล"; // FileManager
    var $_PHPSHOP_FILEMANAGER_LIST = "การจัดการไฟล์::รายการสินค้า"; // FileManager::Product List
    var $_PHPSHOP_FILEMANAGER_ADD = "เพิ่มรูปภาพหรือไฟล์"; // Add Image/File
    var $_PHPSHOP_FILEMANAGER_IMAGES = "กำหนดรูปภาพ"; // Assigned Images
    var $_PHPSHOP_FILEMANAGER_DOWNLOADABLE = "ดาวน์โหลด?"; // Is Downloadable?
    var $_PHPSHOP_FILEMANAGER_FILES = "ระบุไฟล์ (Datasheets,...)"; // Assigned Files (Datasheets,...)
    var $_PHPSHOP_FILEMANAGER_PUBLISHED = "เผยแพร่?"; // Published?
    
    /* FILE LIST */
    var $_PHPSHOP_FILES_LIST = "การจัดการไฟล์::รูปภาพ/รายการไฟล์ข้อมูล"; // FileManager::Image/File List for
    var $_PHPSHOP_FILES_LIST_FILENAME = "ชื่อไฟล์"; // Filename
    var $_PHPSHOP_FILES_LIST_FILETITLE = "ชื่อไฟล์"; // File Title
    var $_PHPSHOP_FILES_LIST_FILETYPE = "ประเภทไฟล์"; // File Type
    var $_PHPSHOP_FILES_LIST_EDITFILE = "แก้ไขไฟล์"; // Edit File Entry
    var $_PHPSHOP_FILES_LIST_FULL_IMG = "รูปภาพ"; // Full Image
    var $_PHPSHOP_FILES_LIST_THUMBNAIL_IMG = "รูปภาพย่อ"; // Thumbnail Image
    
    
    /* FILE FORM */
    var $_PHPSHOP_FILES_FORM = "อัพโหลดไฟล์สำหรับ"; // Upload a File for
    var $_PHPSHOP_FILES_FORM_CURRENT_FILE = "ไฟล์ปัจจุบัน"; // Current File
    var $_PHPSHOP_FILES_FORM_FILE = "ไฟล์"; // File
    var $_PHPSHOP_FILES_FORM_IMAGE = "รูปภาพ"; // Image
    var $_PHPSHOP_FILES_FORM_UPLOAD_TO = "อัพโหลดไปยัง"; // Upload to
    var $_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH = "ที่เก็บภาพสินค้า"; // default Product Image Path
    var $_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH = "ที่เก็บไฟล์เฉพาะ"; // Specify the file location
    var $_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH = "ดาวน์โหลดพาธ (เช่น สินค้าสำหรับขายที่สามารถดาวน์โหลดได้!)"; // Download Path (e.g. for selling downloadables!)
    var $_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL = "สร้าง Thumbnail อัตโนมัติ?"; // Auto-Create Thumbnail?
    var $_PHPSHOP_FILES_FORM_FILE_PUBLISHED = "เผยแพร่ไฟล์?"; // File is published?
    var $_PHPSHOP_FILES_FORM_FILE_TITLE = "ชื่อไฟล์ (ที่ต้องการแสดงให้ลูกค้าเห็น)"; // File Title (what the Customer sees)
    var $_PHPSHOP_FILES_FORM_FILE_DESC = "รายละเอียดไฟล์"; // File Description
    var $_PHPSHOP_FILES_FORM_FILE_URL = "URL (เพิ่มเติม)"; // File URL (optional)
    
    /* FILE & IMAGE PROCESSING */
    var $_PHPSHOP_FILES_PATH_ERROR = "กรุณาระบุที่อยู่ที่ถูกต้อง!"; // Please provide a valid path!
    var $_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS = "สร้าง Thumbnail แสดงรูปภาพเรียบร้อยแล้ว"; // The Thumbnail Image has been successfully created!
    var $_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE = "ไม่สามารถสร้าง Thumbnail แสดงรูปภาพได้!"; // Could NOT create Thumbnail Image!
    var $_PHPSHOP_FILES_UPLOAD_FAILURE = "อัพโหลดผิดพลาด"; // File/Image Upload Error
    
    var $_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE = "ไม่สามารถลบรูปภาพได้"; // Could not delete the Full Image File.
    var $_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS = "ลบภาพเรียบร้อยแล้ว"; // Full Image successfully deleted.
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE = "ไม่สามารถลบ Thumbnail แสดงรูปภาพได้ (อาจจะยังไม่ได้มีการสร้าง): "; // Could not delete the Thumbnail Image File (maybe didnt exist): 
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS = "ลบ Thumbnail แสดงรูปภาพเรียบร้อยแล้ว"; // Thumbnail Image successfully deleted.
    var $_PHPSHOP_FILES_FILE_DELETE_FAILURE = "ไม่สามารถลบไฟล์นี้ได้"; // Could not delete the File.
    var $_PHPSHOP_FILES_FILE_DELETE_SUCCESS = "ลบไฟล์เรียบร้อยแล้ว"; // File successfully deleted.
    
    var $_PHPSHOP_FILES_NOT_FOUND = "ไม่พบไฟล์ที่ต้องการ!"; // Sorry, but the requested file wasn't found!
    var $_PHPSHOP_IMAGE_NOT_FOUND = "ไม่พบรูปภาพ!"; // Image not found!
    
    /*#####################
    MODULE COUPON
    #####################*/
    
    var $_PHPSHOP_COUPON_MOD = "คูปอง"; // Coupon
    var $_PHPSHOP_COUPONS = "คูปอง"; // Coupons
    var $_PHPSHOP_COUPON_LIST = "รายการคูปอง"; // Coupon List
    var $_PHPSHOP_COUPON_ALREADY_REDEEMED = "คูปองถูกแลกแล้ว"; // Coupon has already been redeemed.
    var $_PHPSHOP_COUPON_REDEEMED = "คูปองแลกเรียบร้อยแล้ว"; // Coupon redeemed! Thank you.
    var $_PHPSHOP_COUPON_ENTER_HERE = "ถ้าท่านมีคูปอง โปรดระบุหมายเลข:"; // If you have a coupon code, please enter it below:
    var $_PHPSHOP_COUPON_SUBMIT_BUTTON = "ตกลง"; // Submit
    var $_PHPSHOP_COUPON_CODE_EXISTS = "รหัสคูปองนี้มีอยู่แล้ว กรุณาลองใหม่อีกครั้ง"; // That coupon code already exists. Please try again.
    var $_PHPSHOP_COUPON_EDIT_HEADER = "แก้ไข"; // Update Coupon
    var $_PHPSHOP_COUPON_EDIT_HELP_TEXT = "คลิ๊กบนรหัสคูปองเพื่อลบหรือแก้ไข:"; // Click a coupon code to edit it, or to delete a coupon code, select it and click Delete:
    var $_PHPSHOP_COUPON_CODE_HEADER = "รหัสคูปอง"; // Code
    var $_PHPSHOP_COUPON_PERCENT_TOTAL = "เปอร์เซ็นต์ หรือ ทั้งหมด"; // Percent or Total
    var $_PHPSHOP_COUPON_TYPE = "ประเภทคูปอง"; // Coupon Type
    var $_PHPSHOP_COUPON_TYPE_TOOLTIP = "- คูปองของขวัญจะลบหลังจากถูกใช้แลกส่วนลดแล้ว<br />- คูปองถาวรจะสามารถใช้ได้เท่าที่ลูกค้าต้องการ"; // A Gift Coupon is deleted after it was used for discounting an order. A permanent coupon can be used as often as the customer wants to.
    var $_PHPSHOP_COUPON_TYPE_GIFT = "คูปองของขวัญ"; // Gift Coupon
    var $_PHPSHOP_COUPON_TYPE_PERMANENT = "คูปองถาวร"; // Permanent Coupon
    var $_PHPSHOP_COUPON_VALUE_HEADER = "มูลค่า"; // Value
    var $_PHPSHOP_COUPON_DELETE_BUTTON = "ลบรหัส"; // Delete Code
    var $_PHPSHOP_COUPON_CONFIRM_DELETE = "ต้องการลบรหัสคูปองนี้?"; // Are you sure you want to delete this coupon code?
    var $_PHPSHOP_COUPON_COMPLETE_ALL_FIELDS = "กรุณาระบุทุกช่อง"; // Please complete all fields.
    var $_PHPSHOP_COUPON_VALUE_NOT_NUMBER = "มูลค่าของคูปอง ระบุเฉพาะตัวเลข"; // Coupon value must be a number.
    var $_PHPSHOP_COUPON_NEW_HEADER = "เพิ่มคูปองใหม่"; // New Coupon
    var $_PHPSHOP_COUPON_COUPON_HEADER = "รหัสคูปอง"; // Coupon Code
    var $_PHPSHOP_COUPON_PERCENT = "เปอร์เซ็นต์"; // Percent
    var $_PHPSHOP_COUPON_TOTAL = "ทั้งหมด"; // Total
    var $_PHPSHOP_COUPON_VALUE = "มูลค่า"; // Value
    var $_PHPSHOP_COUPON_CODE_SAVED = "บันทึกรหัสคูปอง"; // Coupon code saved.
    var $_PHPSHOP_COUPON_SAVE_BUTTON = "บันทึก"; // Save Coupon
    var $_PHPSHOP_COUPON_DISCOUNT = "คูปองส่วนลด"; // Coupon Discount
    var $_PHPSHOP_COUPON_CODE_INVALID = "ไม่พบรหัสคูปอง กรุณาลองใหม่อีกครั้ง"; // Coupon code not found. Please try again.
    var $_PHPSHOP_COUPONS_ENABLE = "อนุญาตให้ใช้คูปอง"; // Enable Coupon Usage
    var $_PHPSHOP_COUPONS_ENABLE_EXPLAIN = "ถ้าอนุญาตให้ใช้คูปองได้ ลูกค้าจะสามารถระบุหมายเพื่อรับส่วนลดในการสั่งซื้อได้"; // If you enable the Coupon Usage, you allow customers to fill in Coupon Numbers to gain discounts on their purchase.
    
    /* Free Shipping */
    var $_PHPSHOP_FREE_SHIPPING = "จัดส่งฟรี"; // Free Shipping
    var $_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT = "ค่าจัดส่งฟรี!"; // Shipping is free on this Order!
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT = "จำนวนต่ำสุดที่ขนส่งฟรี"; // Minimum Amount for Free Shipping
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP = "จำนวนต่ำสุดที่ขนส่งให้ฟรี (รวมภาษีแล้ว!)  ตัวอย่างเช่น: <strong>50</strong> หมายถึง ขนส่งฟรีเมื่อลูกค้าสั่งซื้อสินค้ามูลค่้า \$50 หรือมากกว่า (รวมภาษีแล้ว) "; // The amount (INCLUDING TAX!) which is the Minimum for Free Shipping (example: <strong>50</strong> means Free Shipping when the customer checks out with \$50 (including tax) or more.
    var $_PHPSHOP_YOUR_STORE = "แมมโบ้ ลายไทย ช๊อป"; // Your Store
    var $_PHPSHOP_CONTROL_PANEL = "บริหารร้านค้า"; // Control Panel
    
    /* Configuration Additions */
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON = "ปุ่ม - PDF"; // PDF - Button
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN = "แสดงหรือซ่อนปุ่ม - PDF ในส่วนร้านค้า"; // Show or Hide the PDF - Button in the Shop
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER = "ต้องยอมรับข้อตกลงทุกรายการสั่งซื้อ?"; // Must agree to Terms of Service on EVERY ORDER?
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN = "เลือกรายการนี้ หากต้องการให้ลูกค้าต้องยอมรับข้อตกลงทุกรายการ (ก่อนทำการสั่งซื้อ)."; // Check if you want a shopper to agree to your terms of service on EVERY ORDER (before placing the order).
    
    // We need this for eCheck.net Payments
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE = "ประเภทบัญชี"; // Bank Account Type
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING = "เช็คส่วนตัว"; // Checking
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING = "เช็คธุรกิจ"; // Business Checking
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS = "สะสมทรัพย์"; // Saving
    
    var $_PHPSHOP_PAYMENT_AN_RECURRING = "เิอกสารใบแจ้งหนี้?"; // Recurring Billings?
    var $_PHPSHOP_PAYMENT_AN_RECURRING_TOOLTIP = "ระบุหากต้องการเอกสารใบแจ้งหนี้"; // Define wether you want recurring billings.
    
    var $_PHPSHOP_INTERNAL_ERROR = "เกิดข้อผิดพลาดระหว่างการดำเนินการ"; // Internal Error processing the Request to
    var $_PHPSHOP_PAYMENT_ERROR = "ไม่สามารถดำเนินการชำระเงินได้"; // Failure in Processing the Payment
    var $_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS = "การชำระเงินดำเนินการเรียบร้อยแล้ว"; // Payment successfully processed
    
    /* UPS Shipping Module */
    var $_PHPSHOP_UPS_RESPONSE_ERROR = "UPS ไม่สามารถคำนวนอัตราค่าขนส่งที่ต้องการได้"; // UPS was not able to process the Shipping Rate Request.
    var $_PHPSHOP_UPS_SHIPPING_GUARANTEED_DAYS = "รับประกันจัดส่ง"; // Guaranteed Day(s) To Delivery
    var $_PHPSHOP_UPS_PICKUP_METHOD = "วิธีจัดส่งของ UPS"; // UPS Pickup Method
    var $_PHPSHOP_UPS_PICKUP_METHOD_TOOLTIP = "ท่านส่งหีบห่อบรรจุภัณฑ์ให้ UPS ได้อย่างไร?"; // How do you give packages to UPS?
    var $_PHPSHOP_UPS_PACKAGE_TYPE = "แบบบรรจุภัณฑ์ UPS?"; // UPS Packaging?
    var $_PHPSHOP_UPS_PACKAGE_TYPE_TOOLTIP = "เลือกรูปแบบบรรจุภัณฑ์"; // Select the default Type of Packaging.
    var $_PHPSHOP_UPS_TYPE_RESIDENTIAL = "การจัดส่งสำหรับที่พักอาศัย?"; // Residential Delivery?
    var $_PHPSHOP_UPS_RESIDENTIAL = "การจัดส่งสำหรับที่พักอาศัย (RES)"; // Residential (RES)
    var $_PHPSHOP_UPS_COMMERCIAL    = "การจัดส่งสำหรับธุรกิจ (COM)"; // Commercial Delivery (COM)
    var $_PHPSHOP_UPS_RESIDENTIAL_TOOLTIP = "ต้องการราคาสำหรับ การจัดส่งสำหรับที่พักอาศัย (RES) หรือ การจัดส่งสำหรับธุรกิจ (COM)."; // Quote for Residential (RES) or Commercial Delivery (COM).
    var $_PHPSHOP_UPS_HANDLING_FEE = "ค่าจัดการ"; // Handling Fee
    var $_PHPSHOP_UPS_HANDLING_FEE_TOOLTIP = "ค่าจัดการสำหรับการวิธีการขนส่งนี้"; // Your Handling fee for this shipping method.
    var $_PHPSHOP_UPS_TAX_CLASS = "Tax Class"; // Tax Class
    var $_PHPSHOP_UPS_TAX_CLASS_TOOLTIP = "ใช้ Tax Class ในการคำนวนค่าธรรมเนียมขนส่ง"; // Use the following tax class on the shipping fee.
    
    var $_PHPSHOP_ERROR_CODE = "ข้อผิดพลาด"; // Error Code
    var $_PHPSHOP_ERROR_DESC = "รายละเอียด"; // Error Description
    
    var $_PHPSHOP_CHANGE_TRANSACTION_KEY = "แสดง/แก้ไข เลขรหัสการทำธุรกรรม"; // Show / Change the Transaction Key
    var $_PHPSHOP_CHANGE_PASSKEY_FORM = "แสดง/แก้ไข รหัสผ่าน/เลขรหัสการทำธุรกรรม"; // Show/Change the Password/Transaction Key
    var $_PHPSHOP_TYPE_PASSWORD = "กรุณาป้อนรหัสผ่าน"; // Please type in your User Password
    var $_PHPSHOP_CURRENT_PASSWORD = "รหัสผ่าน"; // Current Password
    var $_PHPSHOP_CURRENT_TRANSACTION_KEY = "เลขรหัสปัจจุบันสำหรับการทำธุรกรรม"; // Current Transaction Key
    var $_PHPSHOP_CHANGE_PASSKEY_SUCCESS = "เลขรหัสการทำธุรกรรมได้รับการเปลี่ยนเรียบร้อยแล้ว"; // The Transaction key was successfully changed.
    
    var $_PHPSHOP_PAYMENT_CVV2 = "ต้องการรหัสตรวจสอบ (CVV2/CVC2/CID)"; // Request/Capture Credit Card Code Value (CVV2/CVC2/CID)
    var $_PHPSHOP_PAYMENT_CVV2_TOOLTIP = "เลือกเพื่อใช้ตรวจสอบค่า CVV2/CVC2/CID (3 หรือ 4 หลักบนด้านหลังบัตรเครดิต , กรณีบัตร American Express จะอยู่ด้านหน้า)?"; // Check for a valid CVV2/CVC2/CID value (three- or four-digit number on the back of a credit card, on the Front of American Express Cards)?
    var $_PHPSHOP_CUSTOMER_CVV2_TOOLTIP = "โปรดระบหมายเลข 3 หรือ 4 หลักที่อยู่บนด้านหลังบัตรเครดิตของท่าน (กรณีบัตร American Express จะอยู่ด้านหน้า)"; // Please type in the three- or four-digit number on the back of your credit card (On the Front of American Express Cards)
    var $_PHPSHOP_CUSTOMER_CVV2_ERROR = "ต้องใส่หมายเลขบัตรเครดิตเพื่อดำเนินการ"; // You need to enter your Credit Card Code to proceed.
    
    var $_PHPSHOP_PRODUCT_FORM_FILENAME = "ระบุชื่อไฟล์"; // EITHER Fill in a Filename
    var $_PHPSHOP_PRODUCT_FORM_FILENAME_TOOLTIP = "หมายเหตุ: <strong>ถ้าระบุชื่อไฟล์แทนเลือกไฟล์ จะไม่มีการอัพโหลดไฟล์ ต้องทำการอัพโหลดไฟล์เอง โดยใช้ FTP!</strong>."; // NOTE: Here you can fill in a FileName. <strong>If you fill in a Filename here, no Files will be uploaded!!! You will have to upload it via FTP manually!</strong>.
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD = "หรือเลือกไฟล์ที่ต้องการอัพโหลด"; // OR Upload new File
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD_TOOLTIP = "ท่านสามารถอัพโหลดไฟล์ ซึ่งจะเป็นไฟล์สินค้าที่จะขาย - ไฟล์เดิมจะถูกเขียนทับด้วยไฟล์ใหม่"; // You can upload a local file. This file will be the Product you sell. An existing file will be replaced.
    
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1 = "ใส่ข้อความที่ต้องการแสดงให้ลูกค้า ในหน้าแสดงสินค้า<br />เช่น: 24ชม., 48 ชั่วโมง, 3 - 5 วัน, อยู่ระหว่างการจัดหา....."; // Fill in any text here that will be displayed to the customer on the product flypage.<br />e.g.: 24h, 48 hours, 3 - 5 days, On Order.....
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2 = "หรือเลือกรูปภาพที่ต้องการให้แสดงในหน้ารายละเอียดสินค้า<br />รูปภาพจะอยู่ในไดเรคทอรี่ <i>/components/com_phpshop/shop_image/availability</i><br />"; // OR select an Image to be displayed on the Details Page (flypage).<br />The images reside in the directory <i>/components/com_phpshop/shop_image/availability</i><br />
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST = "คุณลักษณะ"; // Attribute List
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES = "<h4>ตัวอย่างรูปแบบการกำหนดคุณลักษณะ:</h4><span class=\"sectionname\"><strong>ขนาด</strong>,XL[+1.99],M,S[-2.99]<strong>;สี</strong>,แดง,เขียว,เหลือง,สีพิเศษ[=24.00]<strong>;อื่นๆ</strong>,..,..</span><h4>วิธีตั้งค่าราคาสำหรับสินค้าที่มีคุณลักษณะเพิ่มเติม:</h4><span class=\"sectionname\"><strong>&#43;</strong> == เพิ่มราคาจากราคาสินค้าที่ตั้งไว้<br /><strong>&#45;</strong> == ลดราคาลงจากราคาสินค้าที่ตั้งไว้<br /><strong>&#61;</strong> == ให้ราคาสินค้าเท่ากับราคาที่กำหนด</span>"; // <h4>Examples for the Attribute List Format:</h4><span class=\"sectionname\"><strong>Size</strong>,XL[+1.99],M,S[-2.99]<strong>;Colour</strong>,Red,Green,Yellow,ExpensiveColor[=24.00]<strong>;AndSoOn</strong>,..,..</span><h4>Inline price adjustments for using the Advanced Attributes modification:</h4><span class=\"sectionname\"><strong>&#43;</strong> == Add this amount to the configured price.<br /><strong>&#45;</strong> == Subtract this amount from the configured price.<br /><strong>&#61;</strong> == Set the product's price to this amount.</span>
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST = "กำหนดคุณลักษณะอื่นๆ"; // Custom Attribute List
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES = "<h4>ตัวอย่างรูปแบบการกำหนดคุณลักษณะอื่นๆ:</h4><span class=\"sectionname\"><strong>Name;Extras;</strong>...</span>"; // <h4>Examples for the Custom attribute List Format:</h4><span class=\"sectionname\"><strong>Name;Extras;</strong>...</span>

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
