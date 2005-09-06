<?php
/*
* @version $Id: thai.php,v 1.8 2005/06/22 19:50:45 soeren_nb Exp $
* @package Mambo_4.5.1
* @subpackage mambo-phpShop
*
* @copyright (C) 2004 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* @�����»�Ѻ��ا�� Chaisilp Panawiwatn 
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
    
    var $_PHPSHOP_MENU = "����"; // Menu
    var $_PHPSHOP_CATEGORY = "��Ǵ�Թ���"; // Category
    var $_PHPSHOP_CATEGORIES = "��Ǵ�Թ���"; // Categories
    var $_PHPSHOP_SELECT_CATEGORY = "���͡������ : "; // Select a Category:
    var $_PHPSHOP_ADMIN = "�������к�"; // Administration
    var $_PHPSHOP_PRODUCT = "�Թ���"; // Product
    var $_PHPSHOP_LIST = "��¡��"; // List
    var $_PHPSHOP_ALL = "������"; // All
    var $_PHPSHOP_LIST_ALL_PRODUCTS = "��¡���Թ��ҷ�����"; // List All Products
    var $_PHPSHOP_VIEW = "��"; // View
    var $_PHPSHOP_SHOW = "�ʴ�"; // Show
    var $_PHPSHOP_ADD = "����"; // Add
    var $_PHPSHOP_UPDATE = "��Ѻ��ا"; // Update
    var $_PHPSHOP_DELETE = "ź"; // Delete
    var $_PHPSHOP_SELECT = "���͡"; // Select
    var $_PHPSHOP_SUBMIT = "Submit";
    var $_PHPSHOP_RANDOM = "�Թ����ѹ���"; // Random Products
    var $_PHPSHOP_LATEST = "�Թ�������ش"; // Latest Products
    
    /*#####################
    MODULE ACCOUNT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_HOME_TITLE = "˹����ҹ"; // Home
    var $_PHPSHOP_CART_TITLE = "ö�繪����Թ"; // Cart
    var $_PHPSHOP_CHECKOUT_TITLE = "����¡����觫���"; // Checkout
    var $_PHPSHOP_LOGIN_TITLE = "��͡�Թ"; // Login
    var $_PHPSHOP_LOGOUT_TITLE = "�͡�ҡ�к�"; // Logout
    var $_PHPSHOP_BROWSE_TITLE = "���͡"; // Browse
    var $_PHPSHOP_SEARCH_TITLE = "����"; // Search
    var $_PHPSHOP_ACCOUNT_TITLE = "�Ѵ��úѭ�ռ����ҹ"; // Account Maintenance
    var $_PHPSHOP_NAVIGATION_TITLE = "�Ǻ�����ȷҧ"; // Navigation
    var $_PHPSHOP_DEPARTMENT_TITLE = "Ἱ�"; // Department
    var $_PHPSHOP_INFO = "��������´"; // Information
    
    var $_PHPSHOP_BROWSE_LBL = "���͡����"; // Browse
    var $_PHPSHOP_PRODUCTS_LBL = "�Թ���"; // Products
    var $_PHPSHOP_PRODUCT_LBL = "�Թ���"; // Product
    var $_PHPSHOP_SEARCH_LBL = "����"; // Search
    var $_PHPSHOP_FLYPAGE_LBL = "��������´�Թ���"; // Product Details
    var $_PHPSHOP_PRODUCT_SEARCH_LBL = "�����Թ���"; // Product Search
    
    var $_PHPSHOP_PRODUCT_NAME_TITLE = "�����Թ���"; // Product Name
    var $_PHPSHOP_PRODUCT_CATEGORY_TITLE = "��Ǵ�Թ���"; // Product Category
    var $_PHPSHOP_PRODUCT_DESC_TITLE = "��������´"; // Description
    
    var $_PHPSHOP_CART_SHOW = "�ʴ�ö��"; // Show Cart
    var $_PHPSHOP_CART_ADD_TO = "��Ժ���ö��"; // Add to Cart
    var $_PHPSHOP_CART_NAME = "����"; // Name
    var $_PHPSHOP_CART_SKU = "�����Թ���"; // SKU
    var $_PHPSHOP_CART_PRICE = "�Ҥ�"; // Price
    var $_PHPSHOP_CART_QUANTITY = "�ӹǹ"; // Quantity
    var $_PHPSHOP_CART_SUBTOTAL = "�ʹ���"; // Subtotal
    
    # Some messages
    var $_PHPSHOP_ADD_SHIPTO_1 = "����"; // Add a new
    var $_PHPSHOP_ADD_SHIPTO_2 = "ʶҹ���Ѵ��"; // Shipping Address
    var $_PHPSHOP_NO_SEARCH_RESULT = "���辺��¡�÷�����<br />"; // Your search returned 0 results.<br />
    var $_PHPSHOP_PRICE_LABEL = "�Ҥ�: "; // Price: 
    var $_PHPSHOP_ORDER_BUTTON_LABEL = "��Ժ���ö��"; // Add to Cart
    var $_PHPSHOP_NO_CUSTOMER = "��ҹ�ѧ�����ŧ����¹ ��س��к���������´�ͧ��ҹ"; // You are not a Registered Customer yet. Please provide your Billing Information.
    var $_PHPSHOP_DELETE_MSG = "��ͧ���ź��¡�ù��?"; // Are you sure you want to delete this record?
    var $_PHPSHOP_THANKYOU = "�ͺ�س�����觫����Թ���"; // Thank you for your order.
    var $_PHPSHOP_NOT_SHIPPED = "�ѧ�����Ѵ��"; // Not Shipped Yet
    var $_PHPSHOP_EMAIL_SENDTO = "����׹�ѹ��¡����Ѵ�����ҧ����������"; // A confirmation email has been sent to
    var $_PHPSHOP_NO_USER_TO_SELECT = "������ ��辺�������к��ͧ�����֧�������ö�������ǹ�ͧ�����ҹ com_phpshop"; // Sorry, there's no MOS - user that you could add to the com_phpshop userlist

    
    // Error messages
    
    var $_PHPSHOP_ERROR = "�Դ��Ҵ"; // ERROR
    var $_PHPSHOP_MOD_NOT_REG = "�ѧ�����ŧ����¹�����"; // Module Not Registered.
    var $_PHPSHOP_MOD_ISNO_REG = "���������Ţͧ phpShop"; // is not a valid phpShop module.
    var $_PHPSHOP_MOD_NO_AUTH = "��ҹ������Է���㹡����Ҷ֧����Ź��"; // You do not have permission to access the requested module.
    var $_PHPSHOP_PAGE_404_1 = "�ѧ�����Դ���"; // Page Does Not Exist
    var $_PHPSHOP_PAGE_404_2 = "��辺�����:"; // Given filename does not exist. Cannot find file:
    var $_PHPSHOP_PAGE_403 = "�����Ҷ֧���١��ͧ"; // Insufficient Access Rights
    var $_PHPSHOP_FUNC_NO_EXEC = "��ҹ������Է�����ҹ "; // You do not have permission to execute 
    var $_PHPSHOP_FUNC_NOT_REG = "�ѧ�����ŧ����¹�ѧ����"; // Function Not Registered
    var $_PHPSHOP_FUNC_ISNO_REG = " �����ѧ���蹢ͧ MOS_com_phpShop"; //  is not a valid MOS_com_phpShop function.
    
    /*#####################
    MODULE ADMIN
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADMIN_MOD = "�������к�"; // Admin
    
    
    // User List
    var $_PHPSHOP_USER_LIST_MNU = "�����ҹ"; // List Users
    var $_PHPSHOP_USER_LIST_LBL = "�����ҹ"; // User List
    var $_PHPSHOP_USER_LIST_USERNAME = "���ͼ����"; // Username
    var $_PHPSHOP_USER_LIST_FULL_NAME = "�������"; // Full Name
    var $_PHPSHOP_USER_LIST_GROUP = "�����"; // Group
    
    // User Form
    var $_PHPSHOP_USER_FORM_MNU = "���������ҹ"; // Add User
    var $_PHPSHOP_USER_FORM_LBL = "���� / �����������´�����ҹ"; // Add/Update User Information
    var $_PHPSHOP_USER_FORM_BILLTO_LBL = "����������˹��"; // Bill To Information
    var $_PHPSHOP_USER_FORM_SHIPTO_LBL = "ʶҹ���Ѵ��"; // Shipping Addresses
    var $_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL = "�����������"; // Add Address
    var $_PHPSHOP_USER_FORM_ADDRESS_LABEL = "�������¡"; // Address Nickname
    var $_PHPSHOP_USER_FORM_FIRST_NAME = "����"; // First Name
    var $_PHPSHOP_USER_FORM_LAST_NAME = "���ʡ��"; // Last Name
    var $_PHPSHOP_USER_FORM_MIDDLE_NAME = "���͡�ҧ"; // Middle Name
    var $_PHPSHOP_USER_FORM_TITLE = "�ӹ�˹�Ҫ���"; // Title
    var $_PHPSHOP_USER_FORM_USERNAME = "���ͼ����"; // Username
    var $_PHPSHOP_USER_FORM_PASSWORD_1 = "���ʼ�ҹ"; // Password
    var $_PHPSHOP_USER_FORM_PASSWORD_2 = "�׹�ѹ���ʼ�ҹ"; // Confirm Password
    var $_PHPSHOP_USER_FORM_PERMS = "��á�˹��Է���"; // Permissions
    var $_PHPSHOP_USER_FORM_COMPANY_NAME = "����ѷ"; // Company Name
    var $_PHPSHOP_USER_FORM_ADDRESS_1 = "������� 1"; // Address 1
    var $_PHPSHOP_USER_FORM_ADDRESS_2 = "������� 2"; // Address 2
    var $_PHPSHOP_USER_FORM_CITY = "�����"; // City
    var $_PHPSHOP_USER_FORM_STATE = "ࢵ/�ѧ��Ѵ"; // State/Province/Region
    var $_PHPSHOP_USER_FORM_ZIP = "������ɳ���"; // Zip/ Postal Code
    var $_PHPSHOP_USER_FORM_COUNTRY = "�����"; // Country
    var $_PHPSHOP_USER_FORM_PHONE = "���Ѿ��"; // Phone
    var $_PHPSHOP_USER_FORM_FAX = "�����"; // Fax
    var $_PHPSHOP_USER_FORM_EMAIL = "������"; // Email
    
    // Module List
    var $_PHPSHOP_MODULE_LIST_MNU = "�����"; // List Modules
    var $_PHPSHOP_MODULE_LIST_LBL = "�����"; // Module List
    var $_PHPSHOP_MODULE_LIST_NAME = "���������"; // Module Name
    var $_PHPSHOP_MODULE_LIST_PERMS = "������Է�����ҹ"; // Module Perms
    var $_PHPSHOP_MODULE_LIST_FUNCTIONS = "�ѧ����"; // Functions
    var $_PHPSHOP_MODULE_LIST_ORDER = "���§�ӴѺ"; // ListOrder
    
    // Module Form
    var $_PHPSHOP_MODULE_FORM_MNU = "���������"; // Add Module
    var $_PHPSHOP_MODULE_FORM_LBL = "��������´�����"; // Module Information
    var $_PHPSHOP_MODULE_FORM_MODULE_LABEL = "��������� (����Ѻ���ٴ�ҹ��)"; // Module Label (for Topmenu)
    var $_PHPSHOP_MODULE_FORM_NAME = "���������"; // Module Name
    var $_PHPSHOP_MODULE_FORM_PERMS = "������Է�����ҹ"; // Module Perms
    var $_PHPSHOP_MODULE_FORM_HEADER = "����� Header"; // Module Header
    var $_PHPSHOP_MODULE_FORM_FOOTER = "����� Footer"; // Module Footer
    var $_PHPSHOP_MODULE_FORM_MENU = "�ʴ���¡����������ǹ�ͧ���ټ������к�?"; // Show Module in Admin menu?
    var $_PHPSHOP_MODULE_FORM_ORDER = "�ӴѺ����ʴ�"; // Display Order
    var $_PHPSHOP_MODULE_FORM_DESCRIPTION = "��������´�����"; // Module Description
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_CODE = "��������"; // Language Code
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_file = "�������"; // Language File
    
    // Function List
    var $_PHPSHOP_FUNCTION_LIST_MNU = "�ѧ�����"; // List Functions
    var $_PHPSHOP_FUNCTION_LIST_LBL = "�ѧ�����"; // Function List
    var $_PHPSHOP_FUNCTION_LIST_NAME = "���Ϳѧ�����"; // Function Name
    var $_PHPSHOP_FUNCTION_LIST_CLASS = "���ͤ���"; // Class Name
    var $_PHPSHOP_FUNCTION_LIST_METHOD = "�������ʹ"; // Class Method
    var $_PHPSHOP_FUNCTION_LIST_PERMS = "������Է�����ҹ"; // Perms
    
    // Module Form
    var $_PHPSHOP_FUNCTION_FORM_MNU = "�����ѧ����"; // Add Function
    var $_PHPSHOP_FUNCTION_FORM_LBL = "��������´�ѧ����"; // Function Information
    var $_PHPSHOP_FUNCTION_FORM_NAME = "���Ϳѧ����"; // Function Name
    var $_PHPSHOP_FUNCTION_FORM_CLASS = "���ͤ���"; // Class Name
    var $_PHPSHOP_FUNCTION_FORM_METHOD = "�������ʹ"; // Class Method
    var $_PHPSHOP_FUNCTION_FORM_PERMS = "������Է�����ҹ"; // Function Perms
    var $_PHPSHOP_FUNCTION_FORM_DESCRIPTION = "��������´�ѧ����"; // Function Description
    
    // Currency form and list
    var $_PHPSHOP_CURRENCY_LIST_MNU = "ʡ���Թ"; // List Currencies
    var $_PHPSHOP_CURRENCY_LIST_LBL = "ʡ���Թ"; // Currency List
    var $_PHPSHOP_CURRENCY_LIST_ADD = "����ʡ���Թ"; // Add Currency
    var $_PHPSHOP_CURRENCY_LIST_NAME = "����ʡ���Թ"; // Currency Name
    var $_PHPSHOP_CURRENCY_LIST_CODE = "�ѭ�ѡɳ�"; // Currency Code
    
    // Country form and list
    var $_PHPSHOP_COUNTRY_LIST_MNU = "�����"; // List Countries
    var $_PHPSHOP_COUNTRY_LIST_LBL = "��ª��ͻ����"; // Country List
    var $_PHPSHOP_COUNTRY_LIST_ADD = "���������"; // Add Country
    var $_PHPSHOP_COUNTRY_LIST_NAME = "���ͻ����"; // Country Name
    var $_PHPSHOP_COUNTRY_LIST_3_CODE = "���ʻ���� (3)"; // Country Code (3)
    var $_PHPSHOP_COUNTRY_LIST_2_CODE = "���ʻ���� (2)"; // Country Code (2)
    
    /*#####################
    MODULE CHECKOUT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADDRESS = "�������"; // Address
    var $_PHPSHOP_CONTINUE = "����¡�õ��"; // Continue
    
    # Some messages
    var $_PHPSHOP_EMPTY_CART = "ö�繢ͧ��ҹ�ѧ�������¡���Թ���"; // Your Cart is currently empty.
    
    
    /*#####################
    MODULE ISShipping
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ISSHIPPING_MOD = "InterShipper"; // InterShipper
    
    
    // Shipping Ping
    var $_PHPSHOP_ISSHIP_PING_MNU = "Ping InterShipper Server"; // Ping InterShipper Server
    var $_PHPSHOP_ISSHIP_PING_LBL = "InterShipper-Server Ping "; // InterShipper-Server Ping 
    var $_PHPSHOP_ISSHIP_PING_ERROR_LBL = "InterShipper Ping �������"; // InterShipper Ping Failed
    var $_PHPSHOP_ISSHIP_PING_GOOD_LBL = "InterShipper Ping �����"; // InterShipper Ping Successful
    var $_PHPSHOP_ISSHIP_PING_CARRIER_LBL = "�����"; // Carrier
    var $_PHPSHOP_ISSHIP_PING_RESPONSE_LBL = "�ͺ�Ѻ<br />����"; // Response<br />Time
    var $_PHPSHOP_ISSHIP_PING_TIME_LBL = "�Թҷ�"; // sec.
    
    // Shipping List
    var $_PHPSHOP_ISSHIP_LIST_MNU = "�Ըա�â���"; // List Ship Methods
    var $_PHPSHOP_ISSHIP_LIST_LBL = "���͡"; // Active Ship Methods
    var $_PHPSHOP_ISSHIP_LIST_CARRIER_LBL = "�Ըա�â���"; // Ship Methods
    var $_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL = "���͡"; // Active
    var $_PHPSHOP_ISSHIP_LIST_RATE_LBL = "��ҨѴ���"; // Handling Charge
    var $_PHPSHOP_ISSHIP_LIST_LEAD_LBL = "��ǧ����"; // Lead Time
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_F_LBL = "�ѵ�Ҥ����"; // flat rate
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_P_LBL = "�����繵�"; // percent
    var $_PHPSHOP_ISSHIP_LIST_DAYS_LBL = "�ѹ"; // days
    var $_PHPSHOP_ISSHIP_LIST_HEAVY_LBL = "���˹ѡ��÷ء�ҡ"; // Heavy Loads
    
    // Dynamic Shipping Form
    var $_PHPSHOP_ISSHIP_FORM_MNU = "��駤���Ըա�â���"; // Configure Ship Methods
    var $_PHPSHOP_ISSHIP_FORM_ADD_LBL = "�����Ըա�â���"; // Add Ship Method
    var $_PHPSHOP_ISSHIP_FORM_UPDATE_LBL = "��駤���Ըա�â���"; // Configure Ship Method
    var $_PHPSHOP_ISSHIP_FORM_REFRESH_LBL = "���ê"; // Refresh
    var $_PHPSHOP_ISSHIP_FORM_CARRIER_LBL = "�Ըա�â���"; // Ship Method
    var $_PHPSHOP_ISSHIP_FORM_PUBLISH_LBL = "���͡"; // Activate
    var $_PHPSHOP_ISSHIP_FORM_HANDLING_LBL = "��ҨѴ���"; // Handling Charge
    var $_PHPSHOP_ISSHIP_FORM_LEAD_LBL = "��ǧ����"; // Lead Time
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_F_LBL = "�ѵ�Ҥ����"; // flat rate
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_P_LBL = "�����繵�"; // percent
    var $_PHPSHOP_ISSHIP_FORM_DAYS_LBL = "�ѹ"; // days
    var $_PHPSHOP_ISSHIP_FORM_HEAVY_LBL = "���˹ѡ��÷ء�ҡ"; // Heavy Loads
    
    
    
    /*#####################
    MODULE ORDER
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_ORDER_MOD = "��¡����觫���"; // Orders
    
    // Some menu options 
    var $_PHPSHOP_ORDER_CONFIRM_MNU = "�׹�ѹ�����觫���"; // Confirm Order
    var $_PHPSHOP_ORDER_CANCEL_MNU = "¡��ԡ�����觫���"; // Cancel Order
    var $_PHPSHOP_ORDER_PRINT_MNU = "�������¡����觫���"; // Print Order
    var $_PHPSHOP_ORDER_DELETE_MNU = "ź��¡����觫���"; // Delete Order
    
    // Order List
    var $_PHPSHOP_ORDER_LIST_MNU = "��¡����觫���"; // List Orders
    var $_PHPSHOP_ORDER_LIST_LBL = "��¡����觫���"; // Order List
    var $_PHPSHOP_ORDER_LIST_ID = "�Ţ�����觫���"; // Order Number
    var $_PHPSHOP_ORDER_LIST_CDATE = "�ѹ�����觫���"; // Order Date
    var $_PHPSHOP_ORDER_LIST_MDATE = "��Ѻ��ا����ش"; // Last Modified
    var $_PHPSHOP_ORDER_LIST_STATUS = "�ضҹ�Ҿ"; // Status
    var $_PHPSHOP_ORDER_LIST_TOTAL = "�ʹ���"; // SubTotal
    var $_PHPSHOP_ORDER_ITEM = "��¡����觫���"; // Order Items
    
    // Order print
    var $_PHPSHOP_ORDER_PRINT_PO_LBL = "��¡����觫���"; // Purchase Order
    var $_PHPSHOP_ORDER_PRINT_PO_NUMBER = "�Ţ������觫���"; // Order Number
    var $_PHPSHOP_ORDER_PRINT_PO_DATE = "�ѹ�����觫���"; // Order Date
    var $_PHPSHOP_ORDER_PRINT_PO_STATUS = "ʶҹС����觫���"; // Order Status
    var $_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL = "��������´�١���"; // Customer Information
    var $_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL = "��������´���˹��"; // Billing Information
    var $_PHPSHOP_ORDER_PRINT_CUST_SHIPPING_LBL = "��������´ʶҹ���Ѵ��"; // Shipping Information
    var $_PHPSHOP_ORDER_PRINT_BILL_TO_LBL = "���˹��"; // Bill To
    var $_PHPSHOP_ORDER_PRINT_SHIP_TO_LBL = "ʶҹ���Ѵ��"; // Ship To
    var $_PHPSHOP_ORDER_PRINT_NAME = "����"; // Name
    var $_PHPSHOP_ORDER_PRINT_COMPANY = "����ѷ"; // Company
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_1 = "������� 1"; // Address 1
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_2 = "������� 2"; // Address 2
    var $_PHPSHOP_ORDER_PRINT_CITY = "�����"; // City
    var $_PHPSHOP_ORDER_PRINT_STATE = ""; // State/Province/Region
    var $_PHPSHOP_ORDER_PRINT_ZIP = "������ɳ���"; // Zip/Postal Code
    var $_PHPSHOP_ORDER_PRINT_COUNTRY = "�����"; // Country
    var $_PHPSHOP_ORDER_PRINT_PHONE = "���Ѿ��"; // Phone
    var $_PHPSHOP_ORDER_PRINT_FAX = "�����"; // Fax
    var $_PHPSHOP_ORDER_PRINT_EMAIL = "������"; // Email
    var $_PHPSHOP_ORDER_PRINT_ITEMS_LBL = "��¡��"; // Order Items
    var $_PHPSHOP_ORDER_PRINT_QUANTITY = "�ӹǹ"; // Quantity
    var $_PHPSHOP_ORDER_PRINT_QTY = "�ӹǹ"; // Qty
    var $_PHPSHOP_ORDER_PRINT_SKU = "�����Թ���"; // SKU
    var $_PHPSHOP_ORDER_PRINT_PRICE = "�Ҥ�"; // Price
    var $_PHPSHOP_ORDER_PRINT_TOTAL = "���������"; // Total
    var $_PHPSHOP_ORDER_PRINT_SUBTOTAL = "�ʹ���"; // SubTotal
    var $_PHPSHOP_ORDER_PRINT_TOTAL_TAX = "�ʹ�������"; // Tax Total
    var $_PHPSHOP_ORDER_PRINT_SHIPPING = "��Ң�����Ф�ҨѴ���"; // Shipping and Handling Fee
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_TAX = "���բ���"; // Shipping Tax
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LBL = "�Ըժ����Թ"; // Payment Method
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NAME = "���ͺѭ��"; // Account Name
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER = "�����Ţ�ѭ��"; //Account Number 
    var $_PHPSHOP_ORDER_PRINT_EXPIRE_DATE = "�ѹ�������"; // Expire Date
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL = "�ѹ�֡��ê����Թ"; // Payment Log
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_LBL = "��������´��â���"; // Shipping Information
    var $_PHPSHOP_ORDER_PRINT_PAYINFO_LBL = "��������´��ê����Թ"; // Payment Information
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL = "��颹��"; // Carrier
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL = "��Ǵ��â���"; // Shipping Mode
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_DATE_LBL = "�ѹ���Ѵ��"; // Ship Date
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL = "��Ң���"; // Shipping Price
    
    var $_PHPSHOP_ORDER_STATUS_LIST_MNU = "ʶҹС����觫���"; // List Order Status Types
    var $_PHPSHOP_ORDER_STATUS_FORM_MNU = "����ʶҹ�"; // Add Order Status Type
    
    var $_PHPSHOP_ORDER_STATUS_LIST_CODE = "����ʶҹ�"; // Order Status Code
    var $_PHPSHOP_ORDER_STATUS_LIST_NAME = "����ʶҹ�"; // Order Status Name
    
    var $_PHPSHOP_ORDER_STATUS_FORM_LBL = "ʶҹС����觫���"; // Order Status
    var $_PHPSHOP_ORDER_STATUS_FORM_CODE = "����ʶҹ�"; // Order Status Code
    var $_PHPSHOP_ORDER_STATUS_FORM_NAME = "����ʶҹ�"; // Order Status Name
    var $_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER = "���§�ӴѺ"; // List Order
    
    
    /*#####################
    MODULE PRODUCT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_PRODUCT_MOD = "�Թ���"; // Products
    
    var $_PHPSHOP_CURRENT_PRODUCT = "�Թ��һѨ�غѹ"; // Current Product
    var $_PHPSHOP_CURRENT_ITEM = "��¡�ûѨ�غѹ"; // Current Item
    
    // Product Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_LBL = "�Թ��Ҥ���ѧ"; // Product Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_MNU = "�Թ��Ҥ���ѧ"; // View Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_PRICE = "�Ҥ�"; // Price
    var $_PHPSHOP_PRODUCT_INVENTORY_STOCK = "�ӹǹ"; // Number
    var $_PHPSHOP_PRODUCT_INVENTORY_WEIGHT = "���˹ѡ"; // Weight
    // Product List
    var $_PHPSHOP_PRODUCT_LIST_MNU = "��¡���Թ���"; // List Products
    var $_PHPSHOP_PRODUCT_LIST_LBL = "��¡���Թ���"; // Product List
    var $_PHPSHOP_PRODUCT_LIST_NAME = "�����Թ���"; // Product Name
    var $_PHPSHOP_PRODUCT_LIST_SKU = "�����Թ���"; // SKU
    var $_PHPSHOP_PRODUCT_LIST_PUBLISH = "�����"; // Publish
    
    // Product Form
    var $_PHPSHOP_PRODUCT_FORM_MNU = "������¡���Թ���"; // Add Product
    var $_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT = "�����¡���Թ��ҹ��"; // Edit this product
    var $_PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE = "�ʴ��Թ���"; // Preview product flypage in shop
    var $_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU = "������¡��"; // Add Item
    var $_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU = "������¡������"; // Add Another Item
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL = "�Թ�������"; // New Product
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_PRODUCT_LBL = "��Ѻ��ا�Թ���"; // Update Product
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL = "��������´�Թ���"; // Product Information
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL = "ʶҹ��Թ���"; // Product Status
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL = "��Ҵ��й��˹ѡ"; // Product Dimensions and Weight
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL = "�Ҿ�����Թ���"; // Product Images
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL = "��¡������"; // New Item
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL = "��Ѻ��ا��¡��"; // Update Item
    var $_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL = "��������´"; // Item Information
    var $_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL = "ʶҹ�"; // Item Status
    var $_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL = "��Ҵ��й��˹ѡ"; // Item Dimensions and Weight
    var $_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL = "�ٻ�Ҿ"; // Item Images
    var $_PHPSHOP_PRODUCT_FORM_RETURN_LBL = "��Ѻ��ѧ˹���Թ�����ѡ"; // Return to Parent Product
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL = "��ͧ�������¹�ŧ�ٻ�Ҿ ���͡�Ҿ����"; // To update actual image, type in path to new image.
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL = "����� \"none\" ����ź�Ҿ�Ѩ�غѹ"; // Type \"none\" to delete current image.
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL = "��¡���Թ���"; // Product Items
    var $_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL = "�س�ѡɳ�"; // Item Attributes
    var $_PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG = "��ͧ���ź�Թ��� \\n�����������´�������Ǣ�ͧ�Ѻ�Թ��ҹ��?"; // Are you sure you want to delete this Product\\nand the Items related to it?";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG = "��ͧ���ź��¡�ù���������?"; // Are you sure you want to delete this Item?
    var $_PHPSHOP_PRODUCT_FORM_VENDOR = "�����"; // Vendor
    var $_PHPSHOP_PRODUCT_FORM_MANUFACTURER = "�ç�ҹ"; // Manufacturer
    var $_PHPSHOP_PRODUCT_FORM_SKU = "�����Թ���"; // SKU
    var $_PHPSHOP_PRODUCT_FORM_NAME = "����"; // Name
    var $_PHPSHOP_PRODUCT_FORM_URL = "���䫵�"; // URL
    var $_PHPSHOP_PRODUCT_FORM_CATEGORY = "��Ǵ�Թ���"; // Category
    var $_PHPSHOP_PRODUCT_FORM_CATEGORY2 = "��Ǵ�Թ��� 2"; // Category 2
    var $_PHPSHOP_PRODUCT_FORM_PRICE = "�ҤҢ�»�ա"; // Retail Price
    var $_PHPSHOP_PRODUCT_FORM_DESCRIPTION = "˹�ҵ�ҧ�ʴ���������´"; // Flypage Description
    var $_PHPSHOP_PRODUCT_FORM_S_DESC = "��������´"; // Short Description
    var $_PHPSHOP_PRODUCT_FORM_IN_STOCK = "�Թ����ʵ�ͤ"; // In Stock
    var $_PHPSHOP_PRODUCT_FORM_ON_ORDER = "�յ����� ���ѧ������Թ���"; // On Order
    var $_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE = "�ѹ������Թ���"; // Availability Date
    var $_PHPSHOP_PRODUCT_FORM_SPECIAL = "��¡�þ����"; // On Special
    var $_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE = "��������ǹŴ"; // Discount Type
    var $_PHPSHOP_PRODUCT_FORM_PUBLISH = "�����?"; // Publish
    var $_PHPSHOP_PRODUCT_FORM_LENGTH = "���"; // Length
    var $_PHPSHOP_PRODUCT_FORM_WIDTH = "���ҧ"; // Width
    var $_PHPSHOP_PRODUCT_FORM_HEIGHT = "�٧"; // Height
    var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM = "˹��¹Ѻ"; // Unit of Measure
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT = "���˹ѡ"; // Weight
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM = "˹��¹Ѻ"; // Unit of Measure
    var $_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE = "�ٻ�Ҿ���"; // Thumb Nail
    var $_PHPSHOP_PRODUCT_FORM_FULL_IMAGE = "�ٻ�Ҿ"; // Full Image
    
    // Product Display
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL = "�š�������Թ���"; // Product Add Results
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL = "�š�û�Ѻ��ا�Թ���"; // Product Update Results
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL = "�š��������¡��"; // Item Add Results
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL = "�š�û�Ѻ��ا��¡��"; // Item Update Results
    var $_PHPSHOP_PRODUCT_CSV_UPLOAD = "����Ң����Ũҡ��� CSV"; // Use CSV upload
    var $_PHPSHOP_PRODUCT_FOLDERS = "��������Ǵ�����Թ���"; // Product Folders
    
    // Product Category List
    var $_PHPSHOP_CATEGORY_LIST_MNU = "�������Թ���"; // List Categories
    var $_PHPSHOP_CATEGORY_LIST_LBL = "��Ǵ�Թ���"; // Category Tree
    
    // Product Category Form
    var $_PHPSHOP_CATEGORY_FORM_MNU = "������Ǵ�Թ���"; // Add Category
    var $_PHPSHOP_CATEGORY_FORM_LBL = "��������´"; //Category Information 
    var $_PHPSHOP_CATEGORY_FORM_NAME = "������Ǵ"; // Category Name
    var $_PHPSHOP_CATEGORY_FORM_PARENT = "��Ǵ��ѡ"; // Parent
    var $_PHPSHOP_CATEGORY_FORM_DESCRIPTION = "��������´"; // Category Description
    var $_PHPSHOP_CATEGORY_FORM_PUBLISH = "�����?"; // Publish?
    var $_PHPSHOP_CATEGORY_FORM_FLYPAGE = "˹�ҵ�ҧ�ʴ���Ǵ�Թ���"; // Category Flypage
    
    // Product Attribute List
    var $_PHPSHOP_ATTRIBUTE_LIST_MNU = "�س�ѡɳ�"; // List Attributes
    var $_PHPSHOP_ATTRIBUTE_LIST_LBL = "�س�ѡɳ�"; // Attribute List for
    var $_PHPSHOP_ATTRIBUTE_LIST_NAME = "�س�ѡɳ�"; // Attribute Name
    var $_PHPSHOP_ATTRIBUTE_LIST_ORDER = "���§�ӴѺ"; // List Order
    
    // Product Attribute Form
    var $_PHPSHOP_ATTRIBUTE_FORM_MNU = "�����س�ѡɳ�"; // Add Attribute
    var $_PHPSHOP_ATTRIBUTE_FORM_LBL = "Ẻ������س�ѡɳ�"; // Attribute Form
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT = "�����س�ѡɳ���������Ѻ�Թ���"; // New Attribute for Product
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT = "��Ѻ��ا�س�ѡɳ��Թ���"; // Update Attribute for Product
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM = "������¡�äس�ѡɳ�����"; // New Attribute for Item
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM = "��Ѻ��ا��¡�äس�ѡɳ�"; // Update Attribute for Item
    var $_PHPSHOP_ATTRIBUTE_FORM_NAME = "���ͤس�ѡɳ�"; // Attribute Name
    var $_PHPSHOP_ATTRIBUTE_FORM_ORDER = "���§�ӴѺ"; // List Order
    
    // Product Price List
    var $_PHPSHOP_PRICE_LIST_MNU = "��¡����Ǵ�Թ���"; // List Categories
    var $_PHPSHOP_PRICE_LIST_LBL = "��¡���Ҥ�"; // Price Tree
    var $_PHPSHOP_PRICE_LIST_FOR_LBL = "�Ҥ�����Ѻ"; // Price for
    var $_PHPSHOP_PRICE_LIST_GROUP_NAME = "������Ǵ"; // Group Name
    var $_PHPSHOP_PRICE_LIST_PRICE = "�Ҥ�"; // Price
    var $_PHPSHOP_PRODUCT_LIST_CURRENCY = "ʡ���Թ"; // Currency
    
    // Product Price Form
    var $_PHPSHOP_PRICE_FORM_MNU = "�����Ҥ�����"; // Add Price
    var $_PHPSHOP_PRICE_FORM_LBL = "��������´�Ҥ�"; // Price Information
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT = "�Ҥ��Թ������� ����Ѻ�Թ��� "; // New Price for Product
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT = "��Ѻ��ا�Ҥ��Թ���"; // Update Price for Product
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_ITEM = "�Ҥ�����"; // New Price for Item
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM = "��Ѻ��ا�Ҥ�"; // Update Price for Item
    var $_PHPSHOP_PRICE_FORM_PRICE = "�Ҥ�"; // Price
    var $_PHPSHOP_PRICE_FORM_CURRENCY = "ʡ���Թ"; // Currency
    var $_PHPSHOP_PRICE_FORM_GROUP = "�����������"; // Shopper Group
    
    
    /*#####################
    MODULE REPORT BASIC
    #####################*/
    # Some LABELs
    var $_PHPSHOP_REPORTBASIC_MOD = "��§ҹ"; // Reports
    var $_PHPSHOP_RB_INDIVIDUAL = "੾����¡���Թ���"; // Individual Product Listings
    var $_PHPSHOP_RB_SALE_TITLE = "��§ҹ�ʹ���"; // Sales Reporting
    
    /* labels for rpt_sales */
    var $_PHPSHOP_RB_SALES_PAGE_TITLE = "��§ҹ�ʹ���"; // Sales Activity Overview
    
    var $_PHPSHOP_RB_INTERVAL_TITLE = "��˹���������"; // Set Interval
    var $_PHPSHOP_RB_INTERVAL_MONTHLY_TITLE = "�����͹"; // Monthly
    var $_PHPSHOP_RB_INTERVAL_WEEKLY_TITLE = "����ѻ����"; // Weekly
    var $_PHPSHOP_RB_INTERVAL_DAILY_TITLE = "����ѹ"; // Daily
    
    var $_PHPSHOP_RB_THISMONTH_BUTTON = "��͹���"; // This Month
    var $_PHPSHOP_RB_LASTMONTH_BUTTON = "��͹�������"; // Last Month
    var $_PHPSHOP_RB_LAST60_BUTTON = "60 �ѹ�ش����"; // Last 60 days
    var $_PHPSHOP_RB_LAST90_BUTTON = "90 �ѹ�ش����"; // Last 90 days
    
    var $_PHPSHOP_RB_START_DATE_TITLE = "�������ѹ���"; // Start on
    var $_PHPSHOP_RB_END_DATE_TITLE = "�֧�ѹ���"; // End at
    var $_PHPSHOP_RB_SHOW_SEL_RANGE = "�ʴ���¡�õ��������͡"; // Show this selected range
    var $_PHPSHOP_RB_REPORT_FOR = "��§ҹ����Ѻ "; // Report for 
    var $_PHPSHOP_RB_DATE = "�ѹ���"; // Date
    var $_PHPSHOP_RB_ORDERS = "��¡����觫���"; // Orders
    var $_PHPSHOP_RB_TOTAL_ITEMS = "��¡�â�����"; // Total Items sold
    var $_PHPSHOP_RB_REVENUE = "�����"; // Revenue
    var $_PHPSHOP_RB_PRODLIST = "��¡���Թ���"; // Product Listing
    
    
    
    /*#####################
    MODULE SHOP
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOP_MOD = "��ҹ���"; // Shop
    var $_PHPSHOP_PRODUCT_THUMB_TITLE = "�ٻ�Ҿ"; // Image
    var $_PHPSHOP_PRODUCT_PRICE_TITLE = "�Ҥ�"; // Price
    var $_PHPSHOP_ORDER_STATUS_P = "���ѧ���Թ���"; // Pending
    var $_PHPSHOP_ORDER_STATUS_C = "�׹�ѹ�����觫���"; // Confirmed
    var $_PHPSHOP_ORDER_STATUS_X = "¡��ԡ�����觫���"; // Cancelled
    
    
    # Some messages
    var $_PHPSHOP_ORDER_BUTTON = "��觫���"; // Order
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOPPER_MOD = "������"; // Shopper
    
    
    
    // Shopper List
    var $_PHPSHOP_SHOPPER_LIST_MNU = "������"; // List Shoppers
    var $_PHPSHOP_SHOPPER_LIST_LBL = "������"; // Shopper List
    var $_PHPSHOP_SHOPPER_LIST_USERNAME = "���ͼ����"; // User Name
    var $_PHPSHOP_SHOPPER_LIST_NAME = "�������"; // Full Name
    var $_PHPSHOP_SHOPPER_LIST_GROUP = "�����"; // Group
    
    // Shopper Form
    var $_PHPSHOP_SHOPPER_FORM_MNU = "����������"; // Add Shopper
    var $_PHPSHOP_SHOPPER_FORM_LBL = "��������´������"; // Shopper Information
    var $_PHPSHOP_SHOPPER_FORM_BILLTO_LBL = "����������˹��"; // Bill To Information
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL = "��������´"; // Information
    var $_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL = "�����������Ѻ�Ѵ���Թ���"; // Shipping Information
    var $_PHPSHOP_SHOPPER_FORM_ADD_SHIPTO_LBL = "�����������"; // Add Address
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL = "�������¡"; // Address Nickname
    var $_PHPSHOP_SHOPPER_FORM_USERNAME = "���ͼ����ҹ"; // User Name
    var $_PHPSHOP_SHOPPER_FORM_FIRST_NAME = "����"; // First Name
    var $_PHPSHOP_SHOPPER_FORM_LAST_NAME = "���ʡ��"; // Last Name
    var $_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME = "���͡�ҧ"; // Middle Name
    var $_PHPSHOP_SHOPPER_FORM_TITLE = "�ӹ�˹�Ҫ���"; // Title
    var $_PHPSHOP_SHOPPER_FORM_SHOPPERNAME = "���ͼ�����"; // Shoppername
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_1 = "���ʼ�ҹ"; // Password
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_2 = "�׹�ѹ���ʼ�ҹ"; // Confirm Password
    var $_PHPSHOP_SHOPPER_FORM_GROUP = "�����������"; // Shopper Group
    var $_PHPSHOP_SHOPPER_FORM_COMPANY_NAME = "���ͺ���ѷ"; // Company Name
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_1 = "������� 1"; // Address 1
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_2 = "������� 2"; // Address 2
    var $_PHPSHOP_SHOPPER_FORM_CITY = "�����"; // City
    var $_PHPSHOP_SHOPPER_FORM_STATE = "ࢵ/�ѧ��Ѵ"; // State/Province/Region
    var $_PHPSHOP_SHOPPER_FORM_ZIP = "������ɳ���"; // Zip/Postal Code
    var $_PHPSHOP_SHOPPER_FORM_COUNTRY = "�����"; // Country
    var $_PHPSHOP_SHOPPER_FORM_PHONE = "���Ѿ��"; // Phone
    var $_PHPSHOP_SHOPPER_FORM_FAX = "�����"; // Fax
    var $_PHPSHOP_SHOPPER_FORM_EMAIL = "������"; // Email
    
    // Shopper Group List
    var $_PHPSHOP_SHOPPER_GROUP_LIST_MNU = "�����������"; // List Shopper Groups
    var $_PHPSHOP_SHOPPER_GROUP_LIST_LBL = "�����������"; // Shopper Group List
    var $_PHPSHOP_SHOPPER_GROUP_LIST_NAME = "���͡����"; // Group Name
    var $_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION = "��������´�����"; // Group Description
    
    
    // Shopper Group Form
    var $_PHPSHOP_SHOPPER_GROUP_FORM_LBL = "Ẻ����������������"; // Shopper Group Form
    var $_PHPSHOP_SHOPPER_GROUP_FORM_MNU = "���������������"; // Add Shopper Group
    var $_PHPSHOP_SHOPPER_GROUP_FORM_NAME = "���͡����"; // Group Name
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DESC = "��������´�����"; // Group Description
    
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_STORE_MOD = "��ҹ���"; // Store
    
    
    // Store Form
    var $_PHPSHOP_STORE_FORM_MNU = "��駤����ҹ���"; // Edit Store
    var $_PHPSHOP_STORE_FORM_LBL = "��������´��ҹ���"; // Store Information
    var $_PHPSHOP_STORE_FORM_CONTACT_LBL = "��������´��õԴ���"; // Contact Information
    var $_PHPSHOP_STORE_FORM_FULL_IMAGE = "�ٻ�Ҿ"; // Full Image
    var $_PHPSHOP_STORE_FORM_UPLOAD = "�Ѿ��Ŵ�ٻ�Ҿ"; // Upload Image
    var $_PHPSHOP_STORE_FORM_STORE_NAME = "������ҹ���"; // Store Name
    var $_PHPSHOP_STORE_FORM_COMPANY_NAME = "���ͺ���ѷ�"; // Store Company Name
    var $_PHPSHOP_STORE_FORM_ADDRESS_1 = "������� 1"; // Address 1
    var $_PHPSHOP_STORE_FORM_ADDRESS_2 = "������� 2"; // Address 2
    var $_PHPSHOP_STORE_FORM_CITY = "�����"; // City
    var $_PHPSHOP_STORE_FORM_STATE = "ࢵ/�ѧ��Ѵ"; // State/Province/Region
    var $_PHPSHOP_STORE_FORM_COUNTRY = "�����"; // Country
    var $_PHPSHOP_STORE_FORM_ZIP = "������ɳ���"; // Zip/Postal Code
    var $_PHPSHOP_STORE_FORM_PHONE = "���Ѿ��"; // Phone
    var $_PHPSHOP_STORE_FORM_CURRENCY = "ʡ���Թ"; // Currency
    var $_PHPSHOP_STORE_FORM_CATEGORY = "��Ǵ����"; // Store Category
    var $_PHPSHOP_STORE_FORM_LAST_NAME = "���ʡ��"; // Last Name
    var $_PHPSHOP_STORE_FORM_FIRST_NAME = "����"; // First Name
    var $_PHPSHOP_STORE_FORM_MIDDLE_NAME = "���͡�ҧ"; // Middle Name
    var $_PHPSHOP_STORE_FORM_TITLE = "�ӹ�˹�Ҫ���"; // Title
    var $_PHPSHOP_STORE_FORM_PHONE_1 = "���Ѿ�� 1"; // Phone 1
    var $_PHPSHOP_STORE_FORM_PHONE_2 = "���Ѿ�� 2"; // "Phone 2
    var $_PHPSHOP_STORE_FORM_FAX = "������"; // Fax
    var $_PHPSHOP_STORE_FORM_EMAIL = "������"; // Email
    var $_PHPSHOP_STORE_FORM_IMAGE_PATH = "������ٻ�Ҿ"; // Image Path
    var $_PHPSHOP_STORE_FORM_DESCRIPTION = "��������´"; // Description
    
    
    
    var $_PHPSHOP_PAYMENT = "��ê����Թ"; // Payment
    // Payment Method List
    var $_PHPSHOP_PAYMENT_METHOD_LIST_MNU = "�Ըա�ê����Թ"; // List Payment Methods
    var $_PHPSHOP_PAYMENT_METHOD_LIST_LBL = "�Ըա�ê����Թ"; // Payment Method List
    var $_PHPSHOP_PAYMENT_METHOD_LIST_NAME = "����"; // Name
    var $_PHPSHOP_PAYMENT_METHOD_LIST_CODE = "����"; // Code
    var $_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT = "��ǹŴ"; // Discount
    var $_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP = "�����������"; // Shopper Group
    var $_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR = "�������Ըժ����Թ"; // Payment method type
    
    // Payment Method Form
    var $_PHPSHOP_PAYMENT_METHOD_FORM_MNU = "�����Ըա�ê����Թ"; // Add Payment Method
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LBL = "Ẻ������Ըա�ê����Թ"; // Payment Method Form
    var $_PHPSHOP_PAYMENT_METHOD_FORM_NAME = "�����Ըա�ê����Թ"; // Payment Method Name
    var $_PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP = "�����������"; // Shopper Group
    var $_PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT = "��ǹŴ"; // Discount
    var $_PHPSHOP_PAYMENT_METHOD_FORM_CODE = "����"; // Code
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER = "���§�ӴѺ"; // List Order
    var $_PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR = "�������Ըժ����Թ"; // Payment method type
    
    var $_PHPSHOP_PAYMENT_METHOD_FORM_CLASS_NAME = "���ͤ����Ըա�ê����Թ (�� <strong>ps_netbanx</strong>) :<br />��һ���: ps_payment<br /><i>��������� ��������ҧ���!</i>"; // Payment class name (e.g. <strong>ps_netbanx</strong>) :<br />default: ps_payment<br /><i>Leave blank if you're not sure what to fill in!</i>
    var $_PHPSHOP_PAYMENT_METHOD_FORM_ACCEPTED = "�Ѻ�ѵ��ôԵ"; // Accepted Credit Card Types
    var $_PHPSHOP_PAYMENT_METHOD_FORM_EXTRAINFO = "��������´�Ըա�ê����Թ�������"; // Payment Extra Info
    var $_PHPSHOP_PAYMENT_METHOD_FORM_EXTRAINFO_EXPLAIN = "���ʴ��˹���׹�ѹ�����觫��� ����ö������ HTML �ҡ�������ԡ���Ѻ�����Թ��"; // Is shown on the Order Confirmation Page. Can be: HTML Form Code from your Payment Service Provider, Hints to the customer etc.
  
    
    /*#####################
    MODULE TAX
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_TAX_MOD = "����"; // Tax
    
    // User List
    var $_PHPSHOP_TAX_RATE = "�ѵ������"; // Tax Rates
    var $_PHPSHOP_TAX_LIST_MNU = "�ѵ������"; // List Tax Rates
    var $_PHPSHOP_TAX_LIST_LBL = "�ѵ������"; // Tax Rate List
    var $_PHPSHOP_TAX_LIST_STATE = "⫹����"; // Tax State or Region
    var $_PHPSHOP_TAX_LIST_COUNTRY = "�����"; // Tax Country
    var $_PHPSHOP_TAX_LIST_RATE = "�ѵ������"; // Tax Rate
    
    // User Form
    var $_PHPSHOP_TAX_FORM_MNU = "�����ѵ������"; // Add Tax Rate
    var $_PHPSHOP_TAX_FORM_LBL = "��������´�ѵ������"; // Add Tax Information
    var $_PHPSHOP_TAX_FORM_STATE = "⫹����"; // Tax State or Region
    var $_PHPSHOP_TAX_FORM_COUNTRY = "�����"; // Tax Country
    var $_PHPSHOP_TAX_FORM_RATE = "�ѵ������ (�� 16% => �к� 0.16)"; // Tax Rate (for 16% => fill in 0.16)
    
    
    
    
    /*#####################
    MODULE VENDOR
    #####################*/
    
    
    
    # Some LABELs
    var $_PHPSHOP_VENDOR_MOD = "�����"; // Vendor
    var $_PHPSHOP_VENDOR_ADMIN = "�����"; // Vendors
    
    
    // Vendor List
    var $_PHPSHOP_VENDOR_LIST_MNU = "�����"; // List Vendors
    var $_PHPSHOP_VENDOR_LIST_LBL = "�����"; // Vendor List
    var $_PHPSHOP_VENDOR_LIST_VENDOR_NAME = "���ͼ����"; // Vendor Name
    var $_PHPSHOP_VENDOR_LIST_ADMIN = "�������к�"; // Admin
    
    // Vendor Form
    var $_PHPSHOP_VENDOR_FORM_MNU = "�������ͼ����"; // Add Vendor
    var $_PHPSHOP_VENDOR_FORM_LBL = "�к���������´"; // Add Information
    var $_PHPSHOP_VENDOR_FORM_INFO_LBL = "��������´�����"; // Vendor Information
    var $_PHPSHOP_VENDOR_FORM_CONTACT_LBL = "���ͼ��Դ���"; // Contact Information
    var $_PHPSHOP_VENDOR_FORM_FULL_IMAGE = "�ٻ�Ҿ"; // Full Image
    var $_PHPSHOP_VENDOR_FORM_UPLOAD = "�Ѿ��Ŵ�ٻ�Ҿ"; // Upload Image
    var $_PHPSHOP_VENDOR_FORM_STORE_NAME = "���ͼ����"; // Vendor Store Name
    var $_PHPSHOP_VENDOR_FORM_COMPANY_NAME = "���ͺ���ѷ"; // Vendor Company Name
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_1 = "������� 1"; // Address 1
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_2 = "������� 2"; // Address 2
    var $_PHPSHOP_VENDOR_FORM_CITY = "�����"; // City
    var $_PHPSHOP_VENDOR_FORM_STATE = "ࢵ/�ѧ��Ѵ"; // State/Province/Region
    var $_PHPSHOP_VENDOR_FORM_COUNTRY = "�����"; // Country
    var $_PHPSHOP_VENDOR_FORM_ZIP = "������ɳ���"; // Zip/Postal Code
    var $_PHPSHOP_VENDOR_FORM_PHONE = "���Ѿ��"; // Phone
    var $_PHPSHOP_VENDOR_FORM_CURRENCY = "ʡ���Թ"; // Currency
    var $_PHPSHOP_VENDOR_FORM_CATEGORY = "�����������"; // Vendor Category
    var $_PHPSHOP_VENDOR_FORM_LAST_NAME = "���ʡ��"; // Last Name
    var $_PHPSHOP_VENDOR_FORM_FIRST_NAME = "����"; // First Name
    var $_PHPSHOP_VENDOR_FORM_MIDDLE_NAME = "���͡�ҧ"; // Middle Name
    var $_PHPSHOP_VENDOR_FORM_TITLE = "�ӹ�˹�Ҫ���"; // Title
    var $_PHPSHOP_VENDOR_FORM_PHONE_1 = "���Ѿ�� 1"; // Phone 1
    var $_PHPSHOP_VENDOR_FORM_PHONE_2 = "���Ѿ�� 2"; // Phone 2
    var $_PHPSHOP_VENDOR_FORM_FAX = "�����"; // Fax
    var $_PHPSHOP_VENDOR_FORM_EMAIL = "������"; // Email
    var $_PHPSHOP_VENDOR_FORM_IMAGE_PATH = "������ٻ�Ҿ"; // Image Path
    var $_PHPSHOP_VENDOR_FORM_DESCRIPTION = "��������´"; // Description
    
    
    // Vendor Category List
    var $_PHPSHOP_VENDOR_CAT_LIST_MNU = "��Ǵ�����"; // List Vendor Categories
    var $_PHPSHOP_VENDOR_CAT_LIST_LBL = "��Ǵ�����"; // Vendor Category List
    var $_PHPSHOP_VENDOR_CAT_NAME = "������Ǵ"; // Category Name
    var $_PHPSHOP_VENDOR_CAT_DESCRIPTION = "��������´��Ǵ�����"; // Category Description
    var $_PHPSHOP_VENDOR_CAT_VENDORS = "�����"; // Vendors
    
    // Vendor Category Form
    var $_PHPSHOP_VENDOR_CAT_FORM_MNU = "������Ǵ�����"; // Add Vendor Category
    var $_PHPSHOP_VENDOR_CAT_FORM_LBL = "Ẻ�������Ǵ�����"; // Vendor Category Form
    var $_PHPSHOP_VENDOR_CAT_FORM_INFO_LBL = "���������´��Ǵ�����"; // Category Information
    var $_PHPSHOP_VENDOR_CAT_FORM_NAME = "������Ǵ"; // Category Name
    var $_PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION = "���������´"; // Category Description
    
    /*#####################
    MODULE MANUFACTURER
    #####################*/

    # Some LABELs
    var $_PHPSHOP_MANUFACTURER_MOD = "�ç�ҹ"; // Manufacturer
    var $_PHPSHOP_MANUFACTURER_ADMIN = "�ç�ҹ"; // Manufacturers
    
    
    // Manufacturer List
    var $_PHPSHOP_MANUFACTURER_LIST_MNU = "�ç�ҹ"; // List Manufacturers
    var $_PHPSHOP_MANUFACTURER_LIST_LBL = "�ç�ҹ"; // Manufacturer List
    var $_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME = "�����ç�ҹ"; // Manufacturer Name
    var $_PHPSHOP_MANUFACTURER_LIST_ADMIN = "�Ѵ����к�"; // Admin
    
    // Manufacturer Form
    var $_PHPSHOP_MANUFACTURER_FORM_MNU = "�����ç�ҹ"; // Add Manufacturer
    var $_PHPSHOP_MANUFACTURER_FORM_LBL = "�к���������´"; // Add Information
    var $_PHPSHOP_MANUFACTURER_FORM_INFO_LBL = "�������ç�ҹ"; // Manufacturer Information
    var $_PHPSHOP_MANUFACTURER_FORM_NAME = "�����ç�ҹ"; // Manufacturer Name
    var $_PHPSHOP_MANUFACTURER_FORM_CATEGORY = "��Ǵ�ç�ҹ"; // Manufacturer Category
    var $_PHPSHOP_MANUFACTURER_FORM_EMAIL = "������"; // Email
    var $_PHPSHOP_MANUFACTURER_FORM_URL = "���䫵�"; // URL to Manufacturer Homepage
    var $_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION = "��������´"; // Description
    
    
    // Manufacturer Category List
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_MNU = "��Ǵ�ç�ҹ"; // List Manufacturer Categories
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_LBL = "��Ǵ�ç�ҹ"; // Manufacturer Category List
    var $_PHPSHOP_MANUFACTURER_CAT_NAME = "������Ǵ"; // Category Name
    var $_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION = "��������´"; // Category Description
    var $_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS = "�ç�ҹ"; // Manufacturers
    
    // Manufacturer Category Form
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_MNU = "������Ǵ�ç�ҹ"; // Add Manufacturer Category
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_LBL = "Ẻ�������Ǵ�ç�ҹ"; // Manufacturer Category Form
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL = "�кآ�����"; // Category Information
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_NAME = "������Ǵ"; // Category Name
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION = "��������´"; // Category Description
    
    
    /*#####################
    Modul HELP
    #####################*/
    var $_PHPSHOP_HELP_MOD = "���������"; // Help
    
    // 210104 start
    
    var $_PHPSHOP_CART_ACTION = "���"; // Update
    var $_PHPSHOP_CART_UPDATE = "��Ѻ��ا�ӹǹ�Թ����ö��"; // Update Quantity In Cart
    var $_PHPSHOP_CART_DELETE = "����Թ����͡�ҡö��"; // Delete Product From Cart
    
    //shopbrowse form
    
    var $_PHPSHOP_PRODUCT_PRICETAG = "�Ҥ�"; // Price
    var $_PHPSHOP_PRODUCT_CALL = "�ͺ����Ҥ�"; // Call for Pricing
    var $_PHPSHOP_PRODUCT_PREVIOUS = "��͹˹��"; // Prev
    var $_PHPSHOP_PRODUCT_NEXT = "�Ѵ�"; // NEXT
    
    //ro_basket
    
    var $_PHPSHOP_CART_TAX = "����"; // Tax
    var $_PHPSHOP_CART_SHIPPING = "��Ң�����С�èѴ���"; // Shipping and Handling Fee
    var $_PHPSHOP_CART_TOTAL = "���"; // Total
    
    //CHECKOUT.INDEX
    
    var $_PHPSHOP_CHECKOUT_NEXT = "�Ѵ�"; // Next
    var $_PHPSHOP_CHECKOUT_REGISTER = "ŧ����¹"; // REGISTER
    
    //CHECKOUT.CONFIRM
    
    var $_PHPSHOP_CHECKOUT_CONF_BILLINFO = "���˹��"; // Billing Information
    var $_PHPSHOP_CHECKOUT_CONF_COMPANY = "����ѷ"; // Company
    var $_PHPSHOP_CHECKOUT_CONF_NAME = "����"; // Name
    var $_PHPSHOP_CHECKOUT_CONF_ADDRESS = "�������"; // Address
    var $_PHPSHOP_CHECKOUT_CONF_PHONE = "���Ѿ��"; // Phone
    var $_PHPSHOP_CHECKOUT_CONF_FAX = "�����"; // Fax
    var $_PHPSHOP_CHECKOUT_CONF_EMAIL = "������"; // Email
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO = "��������´��èѴ��"; // Shipping Information
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY = "����ѷ"; // Company
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME = "����"; // Name
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS = "�������"; // Address
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE = "���Ѿ��"; // Phone
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX = "�����"; // Fax
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO = "��������´��ê����Թ"; // Payment Information
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD = "���ͺ��ѵ�"; // Name On Card
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD = "�Ըա�ê����Թ"; // Payment Method
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM = "�����Ţ�ѵ�"; // Credit Card Number
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE = "�ѹ�������"; // Expiration Date
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER = "�����觫�������ó�����"; // Complete Order
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO = "�к���������´��������͡��ê����Թ���ºѵ��ôԵ"; // required infomation when Payment via Credit Card is selected
    
    
    var $_PHPSHOP_ZONE_MOD = "⫹����"; // Zone Shipping
    
    var $_PHPSHOP_ZONE_LIST_MNU = "⫹����"; // List Zones
    var $_PHPSHOP_ZONE_FORM_MNU = "�����⫹"; // Add Zone
    var $_PHPSHOP_ZONE_ASSIGN_MNU = "�к�⫹"; // Assign Zones
    
    // assign zone List
    var $_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL = "�����"; // Country
    var $_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL = "⫹"; // Current Zone
    var $_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL = "�к�⫹"; // Assign To Zone
    var $_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL = "��Ѻ��ا"; // Update
    var $_PHPSHOP_ASSIGN_ZONE_PG_LBL = "�к�⫹"; // Assign Zones
    
    // zone Form
    var $_PHPSHOP_ZONE_FORM_NAME_LBL = "����⫹"; // Zone Name
    var $_PHPSHOP_ZONE_FORM_DESC_LBL = "��������´⫹"; // Zone Description
    var $_PHPSHOP_ZONE_FORM_COST_PER_LBL = "�������µ����¡��"; // Zone Cost Per Item
    var $_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL = "ǧ�Թ��������"; // Zone Cost Limit
    
    // List of zones
    var $_PHPSHOP_ZONE_LIST_LBL = "⫹"; // Zone List
    var $_PHPSHOP_ZONE_LIST_NAME_LBL = "����⫹"; // Zone Name
    var $_PHPSHOP_ZONE_LIST_DESC_LBL = "��������´⫹"; // Zone Description
    var $_PHPSHOP_ZONE_LIST_COST_PER_LBL = "�������µ����¡��"; // Zone Cost Per Item
    var $_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL = "ǧ�Թ��������"; // Zone Cost Limit
    
    var $_PHPSHOP_LOGIN_FIRST = "��س���͡�Թ ����ŧ����¹��͹"; // Please log in or register to this site (use the Login module) first.<br>Thank you.
    var $_PHPSHOP_STORE_FORM_TOS = "��͵�ŧ"; // Terms of Service
    var $_PHPSHOP_AGREE_TO_TOS = "�ô����Ѻ��͵�ŧ��͹"; // Please agree to our terms of Service first.
    var $_PHPSHOP_I_AGREE_TO_TOS = "����Ѻ��͵�ŧ"; // I agree to the Terms of Service
    
    var $_PHPSHOP_LEAVE_BLANK = "(�������ҧ���<br />�����������!)"; // (leave BLANK if you have <br />no individual php-file for it!)
    var $_PHPSHOP_RETURN_LOGIN = "�١������ : ��س���͡�Թ"; // Returning Customers: Please Log In
    var $_PHPSHOP_NEW_CUSTOMER = "�١������� : ��س��к���������´"; // New? Please Provide Your Billing Information
    var $_PHPSHOP_ACC_CUSTOMER_ACCOUNT = "�ѭ���١���:"; // Customer Account:
    var $_PHPSHOP_ACC_ORDER_INFO = "��������´�����觫���"; // Order Information
    var $_PHPSHOP_ACC_UPD_BILL = "�س����ö�����������´���˹��"; // Here you can update your billing information.
    var $_PHPSHOP_ACC_UPD_SHIP = "�س����ö�����������´ʶҹ���Ѵ��"; // Here you can add and maintain shipping addresses.
    var $_PHPSHOP_ACC_ACCOUNT_INFO = "��������´�ѭ��"; // Account Information
    var $_PHPSHOP_ACC_SHIP_INFO = "��������´ʶҹ���Ѵ��"; // Shipping Information
    var $_PHPSHOP_ACC_NO_ORDERS = "�������¡����觫���"; // No Orders to Display
    var $_PHPSHOP_ACC_BILL_DEF = "- (������������˹��)"; // - Default (Same as Billing)
    var $_PHPSHOP_SHIPTO_TEXT = "��ҹ����ö����ʶҹ���Ѵ�� ��س����͡���ͷ��������� ������������Ѻʶҹ���Ѵ�觷���ͧ��� "; // You can add shipping locations to your account. Please think of a suitable nickname or code for the shipping location you select below.
    var $_PHPSHOP_CONFIG = "��õ�駤��"; // Configuration
    var $_PHPSHOP_USERS = "�����ҹ"; // Users
    var $_PHPSHOP_IS_CC_PAYMENT = "��ͧ��ê��д��ºѵ��ôԵ?"; // is Credit Card payment?
    
    /*#####################################################
     MODULE SHIPPING
    #######################################################*/
    var $_PHPSHOP_SHIPPING_MOD = "��â���"; // Shipping
    var $_PHPSHOP_SHIPPING_MENU_LABEL = "��â���"; // Shipping
    
    var $_PHPSHOP_SHIPPING_METHOD_LIST = "��â���"; // Shipping
    var $_PHPSHOP_SHIPPING_METHOD_LIST_NAME = "����"; // Name
    var $_PHPSHOP_SHIPPING_METHOD_LIST_VERSION = "�������"; // Version
    var $_PHPSHOP_SHIPPING_METHOD_LIST_AUTHOR = "������ҧ"; // Author
    var $_PHPSHOP_SHIPPING_METHOD_LIST_AUTHOR_URL = "URL ������ҧ"; // Author URL
    var $_PHPSHOP_SHIPPING_METHOD_LIST_AUTHOR_EMAIL = "�����������ҧ"; // Author Email
    var $_PHPSHOP_SHIPPING_METHOD_LIST_DESCRIPTION = "��������´"; // Description
    var $_PHPSHOP_SHIPPING_METHOD_LIST_ACTIVE = "���͡?"; // Active?

    var $_PHPSHOP_CARRIER_LIST_MNU = "��颹��"; // Shipper
    var $_PHPSHOP_CARRIER_LIST_LBL = "��颹��"; // Shipper list
    var $_PHPSHOP_RATE_LIST_MNU = "�ѵ�Ҥ�Ң���"; // Shipping Rates
    var $_PHPSHOP_RATE_LIST_LBL = "�ѵ�Ҥ�Ң���"; // Shipping Rates list
    var $_PHPSHOP_CARRIER_LIST_NAME_LBL = "����"; // Name
    var $_PHPSHOP_CARRIER_LIST_ORDER_LBL = "���§�ӴѺ"; // Listorder
    
    var $_PHPSHOP_CARRIER_FORM_MNU = "���ҧ��颹������"; // Create Shipper
    var $_PHPSHOP_CARRIER_FORM_LBL = "���ҧ / ��䢼�颹��"; // Shipper edit / create
    var $_PHPSHOP_RATE_FORM_MNU = "��˹��ѵ�Ҥ�Ң���"; // Create a Shipping Rate
    var $_PHPSHOP_RATE_FORM_LBL = "���� / ����ѵ�Ҥ�Ң���"; // Create/Edit a Shipping Rate
    
    var $_PHPSHOP_RATE_FORM_NAME = "��������´�ѵ�Ҥ�Ң���"; // Shipping Rate description
    var $_PHPSHOP_RATE_FORM_CARRIER = "��颹��"; // Shipper
    var $_PHPSHOP_RATE_FORM_COUNTRY = "�����:<br /><br /><i>���͡������¡��: ������ Shift ���� Ctrl ��Ф�����ҷ�</i>"; // Country:<br /><br /><i>Multiselect: use STRG-Key and Mouse</i>
    var $_PHPSHOP_RATE_FORM_ZIP_START = "��ǧ������ɳ���ҡ"; // ZIP range start
    var $_PHPSHOP_RATE_FORM_ZIP_END = "�֧"; // ZIP range end
    var $_PHPSHOP_RATE_FORM_WEIGHT_START = "���˹ѡ����ش"; // Lowest Weight
    var $_PHPSHOP_RATE_FORM_WEIGHT_END = "���˹ѡ�٧�ش"; // Highest Weight
    var $_PHPSHOP_RATE_FORM_VALUE = "��Ҹ�������"; // Fee
    var $_PHPSHOP_RATE_FORM_PACKAGE_FEE = "��Һ�è��պ���"; // Your package fee
    var $_PHPSHOP_RATE_FORM_CURRENCY = "ʡ���Թ"; // Currency
    var $_PHPSHOP_RATE_FORM_VAT_ID = "���� VAT"; // VAT Id
    var $_PHPSHOP_RATE_FORM_LIST_ORDER = "���§�ӴѺ"; // List Order
    
    var $_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL = "��颹��"; // Shipper
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME = "��������´�ѵ�Ҥ�Ң���"; // Shipping Rate description
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART = "���˹ѡ��鹵�� ..."; // Weight from ...
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND = "... �֧"; // ... to
    var $_PHPSHOP_CARRIER_FORM_NAME = "����ѷ��颹��"; // Shipper Company
    var $_PHPSHOP_CARRIER_FORM_LIST_ORDER = "����§�ӴѺ"; // Listorder
    
    var $_PHPSHOP_ERR_MSG_CARRIER_EXIST = "��ͼԴ��Ҵ: ���ʼ�颹������������"; // ERROR: Shipper ID exists.
    var $_PHPSHOP_ERR_MSG_CARRIER_ID_REQ = "��ͼԴ��Ҵ: ���͡��颹��"; // ERROR: Choose a shipper.
    var $_PHPSHOP_ERR_MSG_CARRIER_INUSE = "��ͼԴ��Ҵ: ���ѵ�Ҥ�Ң����������� ��ͧź�ѵ�������͹"; // ERROR: At least one Shipping Rate exists, delete rates prior to shipper
    var $_PHPSHOP_ERR_MSG_CARRIER_NOTFOUND = "��ͼԴ��Ҵ: ��辺��颹�������Ţ���ʹ��"; // ERROR: Unable to find a shipper with this ID.
    
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_REQ = "��ͼԴ��Ҵ: ���͡��颹��"; // ERROR: Choose a shipper.
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_INV = "��ͼԴ��Ҵ: ��辺��颹�������Ţ ID ���"; // ERROR: Unable to find a shipper with this ID.
    var $_PHPSHOP_ERR_MSG_RATE_NAME_REQ = "��ͼԴ��Ҵ: ��ͧ�к��ѵ�Ң���"; // ERROR: A rate descriptor is requested.
    var $_PHPSHOP_ERR_MSG_RATE_COUNTRY_CODE_INV = "��ͼԴ��Ҵ: ����Ȼ��·ҧ���١��ͧ ����ҡ���� 1 ����� ����ö��蹴�������ͧ���� \"; // \"."; // ERROR: The Destination country is invalid. More than one country could be separated with \"; // \".
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_START_REQ = "��ͼԴ��Ҵ: ��ͧ�кع��˹ѡ����ش"; // ERROR: A lowest weight is requested
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_END_REQ = "��ͼԴ��Ҵ: ��ͧ�кع��˹ѡ�٧�ش"; // ERROR: A highes weight are requested
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_STARTEND_INV = "��ͼԴ��Ҵ: ���˹ѡ����ش��ͧ���¡��ҹ��˹ѡ�٧�ش"; // ERROR: The lowest weight must be smaller than the highes weight
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_VALUE_REQ = "��ͼԴ��Ҵ: ��ͧ�кؤ�Ҹ�����������"; // ERROR: A shipping fee requested
    var $_PHPSHOP_ERR_MSG_RATE_CURRENCY_ID_INV = "��ͼԴ��Ҵ: ��ͧ���͡ʡ���Թ"; // ERROR: Coose a currency
    
    var $_PHPSHOP_ERR_MSG_RATE_ID_REQ = "��ͼԴ��Ҵ: ��ͧ�к��ѵ�Ҥ�Ң���"; // ERROR: A Shipping Rate is requested
    
    var $_PHPSHOP_INFO_MSG_PLEASE_SELECT = "�ô���͡"; // Please select
    var $_PHPSHOP_INFO_MSG_CARRIER = "��颹��"; // Shipper
    var $_PHPSHOP_INFO_MSG_SHIPPING_METHOD = "�ѵ�Ҥ�Ң���"; // Shipping Rate
    var $_PHPSHOP_INFO_MSG_SHIPPING_PRICE = "�Ҥ�"; // Price
    var $_PHPSHOP_INFO_MSG_VAT_ZERO_LBL = "0 (-�����-)"; // 0 (-none-)
    /*#####################################################
     END: MODULE SHIPPING
    #######################################################*/
    
    var $_PHPSHOP_PAYMENT_FORM_CC = "�ѵ��ôԵ"; // Credit Card
    var $_PHPSHOP_PAYMENT_FORM_USE_PP = "���鹵͹��ê����Թ"; // Use Payment Processor
    var $_PHPSHOP_PAYMENT_FORM_BANK_DEBIT = "�ѵ��úԵ"; // Bank debit
    var $_PHPSHOP_PAYMENT_FORM_PAYPAL = "PayPal �����ٻẺ������¡ѹ"; // PayPal (or related)

    var $_PHPSHOP_PAYMENT_FORM_AO = "�����Թ������Ѻ�Թ���"; // Address only / Cash on Delivery
    var $_PHPSHOP_CHECKOUT_MSG_2 = "�ô���͡ʶҹ���Ѵ��!"; // Please select a Shipping Address!
    var $_PHPSHOP_CHECKOUT_MSG_3 = "�ô���͡�Ըա�â���!"; // lease select a Shipping Method!
    var $_PHPSHOP_CHECKOUT_MSG_4 = "�ô���͡�Ըա�ê����Թ!"; // Please select a Payment Method!
    var $_PHPSHOP_CHECKOUT_MSG_99 = "��سҵ�Ǩ�ͺ��������´������ ����׹�ѹ�����觫���!"; // Please review the provided data and confirm the order!
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIP = "�ô���͡�Ըա�â���"; // Please select a Shipping Method.
    var $_PHPSHOP_CHECKOUT_ERR_OTHER_SHIP = "�ô���͡�Ըա�â�������"; // Please select another Shipping Method.
    var $_PHPSHOP_CHECKOUT_ERR_NO_PAYM = "�ô���͡�Ըա�ê����Թ"; // Please select a Payment Method.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR = "�ô�к������Ţ�ѵ��ôԵ"; // Please enter your Credit Card Number.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNAME = "�ô�кت��ͺ��ѵ��ôԵ"; // Please enter the Name on the Credit Card.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATE = "�����Ţ�ѵ��ôԵ���١��ͧ"; // The Credit Card Number entered is not valid.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCMON = "�ô�����͹����������"; // Please enter the Credit Card expiration month.
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCYEAR = "�ô���շ���������"; // Please enter the Credit Card expiration year.
    var $_PHPSHOP_CHECKOUT_ERR_CCDATE_INV = "�ѹ����������١��ͧ"; // The expiration date is invalid.
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIPTO = "��س����͡ʶҹ���Ѵ��"; // Please select a Ship To address.
    var $_PHPSHOP_CHECKOUT_ERR_CCNUM_INV = "�����Ţ�ѭ�����١��ͧ"; // Invalid account number.
    var $_PHPSHOP_CHECKOUT_ERR_EMPTY_CART = "�������¡���ö��!"; // There's nothing in your cart!
    var $_PHPSHOP_CHECKOUT_ERR_NO_CARR = "��ͼԴ��Ҵ: �ô���͡���Ѵ��!"; // ERROR: Please select a Shipping Carrier!
    var $_PHPSHOP_CHECKOUT_ERR_RATE_NOT_FOUND = "��ͼԴ��Ҵ: ��辺�ѵ�Ҥ�Ң��觷�����͡!"; // ERROR: The selected Shipping Rate was not found!
    var $_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND = "��ͼԴ��Ҵ: ��辺�����������Ѻ��èѴ��!"; // ERROR: Your Shipping Address was not found!
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATA = "��ͼԴ��Ҵ: ����բ����Ţͧ�ѵ��ôԵ..."; // ERROR: There's no CreditCard data...
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR_FOUND = "��ͼԴ��Ҵ: ��辺�����Ţ�ѵ��ôԵ"; // ERROR: Credit Card Number not found!
    var $_PHPSHOP_CHECKOUT_ERR_TEST = "������ ���ͧ�ҡ�����Ţ�ѵ��ôԵ����ҹ�� ���Ţ��������Ѻ��÷��ͧ��!"; // Sorry, but the Credit Card Number you've used is a testing number!
    var $_PHPSHOP_CHECKOUT_ERR_NO_USER_DATA = "��辺�Ţ���¼����ҹ!"; // The user_id was not found in the database!
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_HOLDER_NAME = "��ҹ������кت��ͺѭ��"; // You have actually not provided your bank account holder name.
    var $_PHPSHOP_CHECKOUT_ERR_NO_IBAN = "��ҹ������к������Ţ IBAN"; // You have actually not provided your IBAN.
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_NUM = "��ҹ������к��Ţ���ѭ��"; // You have actually not provided your bank account number.
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_SORT = "��ҹ������к������Ţ�����¡������"; // You have actually not provided your bank sort code.
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_NAME = "��ҹ������кت��͸�Ҥ��"; // You have actually not provided your bank's name.
    var $_PHPSHOP_CHECKOUT_ERR_NO_VALID_STEP = "��鹵͹��ê����Թ���١��ͧ!"; // CheckOut needs a valid Step!

    var $_PHPSHOP_CHECKOUT_MSG_LOG = "��������´��ê����Թ����Ѻ��÷���¡�ä�������ش<br />"; // Payment information captured for later processing.<br />
    
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV = "�ʹ��觫����ѧ���ú����ӹǹ����ش"; // Minimum purchase order value has not been reached yet.
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV2 = "�ʹ��觫��͵���ش:"; // Our minimum purchase order value is:
    var $_PHPSHOP_CHECKOUT_PAYMENT_CC = "���д��ºѵ��ôԵ"; // Credit Card Payment
    var $_PHPSHOP_CHECKOUT_PAYMENT_OTHER = "�Ըա�ê����ԹẺ���"; // other Payment Methods
    var $_PHPSHOP_CHECKOUT_PAYMENT_SELECT = "�ô���͡�Ըա�ê����Թ:"; // Please select a Payment Method:
    
    var $_PHPSHOP_STORE_FORM_MPOV = "��Ť�ҡ����觫��͢�鹵��"; // Minimum purchase order value for your store
    var $_PHPSHOP_ACCOUNT_BANK_TITLE = "��������´�ѭ�ո�Ҥ��"; // Bank Account Info
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR = "�Ţ���ѭ��"; // Account Number
    var $_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE = "�����Ţ�����¡������"; // Bank sorting code number
    var $_PHPSHOP_ACCOUNT_LBL_BANK_NAME = "���͸�Ҥ��"; // Bank Name
    var $_PHPSHOP_ACCOUNT_LBL_BANK_IBAN = "IBAN"; // IBAN
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER = "���ͺѭ��"; // Account Holder
    
    var $_PHPSHOP_MODULES = "�����"; // Modules
    var $_PHPSHOP_FUNCTIONS = "�ѧ����"; // Functions
    var $_PHPSHOP_SPECIAL_PRODUCTS = "�Թ��Ҿ����"; // Special products
    
    var $_PHPSHOP_CHECKOUT_CUSTOMER_NOTE = "��سҽҡ��ͤ����֧�������ǡѺ��¡����觫��ͧ͢��ҹ"; // Please leave a note to us with your order if you want to
    var $_PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE = "��ͤ����ҡ�١���"; // Customer's note
    var $_PHPSHOP_INCLUDING_TAX = "(������� \$tax %)"; // (including \$tax % tax)
    var $_PHPSHOP_PLEASE_SEL_ITEM = "���͡��¡���Թ��ҷ���ͧ���"; // Please select an item
    var $_PHPSHOP_PRODUCT_FORM_ITEM_LBL = "��¡��"; // Item

    // DOWNLOADS
    
    var $_PHPSHOP_DOWNLOADS_TITLE = "��ǹ�ͧ��ô�ǹ���Ŵ"; // Download Area
    var $_PHPSHOP_DOWNLOADS_START = "������鹴�ǹ���Ŵ"; // Start Download
    var $_PHPSHOP_DOWNLOADS_INFO = "��س�������� Download-ID ���������ҹ�ҧ������ ���ǡ����� ������鹴�ǹ���Ŵ"; // Please enter the Download-ID you've got in the e-mail and click 'Start Download'.
    var $_PHPSHOP_DOWNLOADS_ERR_EXP = "��ô�ǹ���Ŵ�ͧ��ҹ�����������"; // Sorry, but your Download has expired
    var $_PHPSHOP_DOWNLOADS_ERR_MAX = "��ҹ��ӹǹ����㹡�ô�ǹ���Ŵ�ú����"; // Sorry, but your maximum number of downloads has been reached
    var $_PHPSHOP_DOWNLOADS_ERR_INV = "���� Download-ID! ���١��ͧ"; // Invalid Download-ID!
    var $_PHPSHOP_DOWNLOADS_ERR_SEND = "�������ö�觢�ͤ����֧ "; // Could not send a message to 
    var $_PHPSHOP_DOWNLOADS_SEND_MSG = "�觢�ͤ����֧ "; // Message sent to 
    var $_PHPSHOP_DOWNLOADS_SEND_SUBJ = "��������´��ô�ǹ���Ŵ"; // Download-Info
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_1 = "��ҹ����ö��ǹ���Ŵ�������觫���������"; // the file(s) you ordered are ready for your download
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_2 = "��س�������� Download-ID ���ǹ��鹷���ǹ���Ŵ : "; // Please enter the following Download-ID(s) in our Downloads Area: 
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_3 = "�ӹǹ�����٧�ش㹡�ô�ǹ���Ŵ�٧�ش������: "; // the maximum number of downloads for each file is: 
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_4 = "��ǹ���Ŵ���ա {expire} �ѹ ��ѧ�ҡ��������ǹ���Ŵ�����á"; // Download until {expire} days after the first download
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_5 = "�Ӷ��? �ѭ��?"; // Questions? Problems?
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_6 = "��������´��ô�ǹ���Ŵ��� "; //  // e.g. Download-Info by "Storename"
    var $_PHPSHOP_PRODUCT_FORM_DOWNLOADABLE = "�Թ��ҷ������ö��ǹ���Ŵ��?"; //  downloadable product?
    
    var $_PHPSHOP_PAYPAL_THANKYOU = "�ͺ�س����Ѻ��ê����Թ ��÷Ӹ�á����ͧ��ҹ���º���������<br />��ҹ�����Ѻ�������׹�ѹ��÷���¡�èҡ�ҧ PayPal ��觷�ҹ����ö��͡�Թ������价�� <a href=http://www.paypal.com>www.paypal.com</a> ���ʹ���������´��"; // Thanks for your payment. The transaction was successful. You will get a confirmation e-mail for the transaction by PayPal. You can now continue or log in at <a href=http://www.paypal.com>www.paypal.com</a> to see the transaction details.

    var $_PHPSHOP_PAYPAL_ERROR = "�Դ�����Դ��Ҵ�����ҧ��÷���¡�� ʶҹС����觫����ѧ���������¹�ŧ"; // An error occured while processing your transaction. The status of your order could not be updated.
    
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER1 = "�͢ͺ�س�����觫����Թ��ҡѺ��� ��¡����觫��ͧ͢��ҹ"; // Thank you for shopping with us.  Your order information follows.
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER2 = "�͢ͺ�س���������ش˹ع"; // Thank you for your patronage.
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER3 = "�Ӷ��? �ѭ��?"; // Questions? Problems?
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER4 = "���Ѻ��¡����觫�������"; // The following order was received.
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER5 = "����������´�����觫���"; // View the order by following the link below.
    
    var $_PHPSHOP_CART_ERROR_NO_NEGATIVE = "�ӹǹ�Դź ����¡�õ�������"; // Negative quantities are not allowed.
    var $_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY = "��س����ӹǹ���١��ͧ����Ѻ��¡�ù��"; // Please enter a valid quantity for this item.
    
    var $_PHPSHOP_CART_STOCK_1 = "�ӹǹ������͡�ҡ���Ңͧ����������ʵ�͡ "; // The selected quantity exceeds available stock. 
    var $_PHPSHOP_CART_STOCK_2 = "��й�����Թ������� \$product_in_stock ��¡�� "; // We currently have \$product_in_stock items available. 
    var $_PHPSHOP_CART_STOCK_3 = "���꡷������������������¡���ͤ��"; // Click Here to be placed on our waiting list.
    var $_PHPSHOP_CART_SELECT_ITEM = "��س����͡��¡���Թ��ҷ���ͧ��á�͹!"; // Please select a special item from the details page!
    
    var $_PHPSHOP_REGISTRATION_FORM_NONE = "����к�"; // none
    var $_PHPSHOP_REGISTRATION_FORM_MR = "���"; // Mr.
    var $_PHPSHOP_REGISTRATION_FORM_MRS = "�ҧ"; // Mrs.
    var $_PHPSHOP_REGISTRATION_FORM_DR = "��."; // Dr.
    var $_PHPSHOP_REGISTRATION_FORM_PROF = "Ȩ."; // Prof."
    var $_PHPSHOP_DEFAULT = "��˹��繤�һ���"; // Default
    
  /*#####################################################
    MODULE AFFILIATE
  #######################################################*/
    var $_PHPSHOP_AFFILIATE_MOD   = "�������к���Ҫԡ���͢���"; // Affiliate Administration
    
    // Affiliate List
    var $_PHPSHOP_AFFILIATE_LIST_MNU		= "��Ҫԡ���͢���"; // List Affiliates
    var $_PHPSHOP_AFFILIATE_LIST_LBL		= "��Ҫԡ���͢���"; // Affiliates List
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME	= "������Ҫԡ"; // Affiliate Name
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE = "���͡"; // Active
    var $_PHPSHOP_AFFILIATE_LIST_RATE		= "�ѵ��"; // Rate
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL = "�ӹǹ��͹"; // Month Total
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION ="��Ҥ���Ԫ���"; // Month Commission
    var $_PHPSHOP_AFFILIATE_LIST_ORDERS = "���§�ӴѺ"; // List Orders
    
    // Affiliate Email
    var $_PHPSHOP_AFFILIATE_EMAIL_MNU		= "��������Ҫԡ"; // Email Affiliates
    var $_PHPSHOP_AFFILIATE_EMAIL_LBL		= "��������Ҫԡ"; // Email Affiliates
    var $_PHPSHOP_AFFILIATE_EMAIL_WHO	= "������֧ (* = ������)"; // Who to Email(* = ALL)
    var $_PHPSHOP_AFFILIATE_EMAIL_CONTENT		= "������ͧ��ҹ"; // Your Email
    var $_PHPSHOP_AFFILIATE_EMAIL_SUBJECT = "��Ǣ��"; // The Subject
    var $_PHPSHOP_AFFILIATE_EMAIL_STATS	 = "���ʶԵԻѨ�غѹ"; // Include Current Statistics
    
    // Affiliate Form
    var $_PHPSHOP_AFFILIATE_FORM_RATE		= "�ѵ�Ҥ�Ҥ���Ԫ��� (�����繵�)"; // Commission Rate (percent)
    var $_PHPSHOP_AFFILIATE_FORM_ACTIVE		= "���͡?"; // Active?
    
    var $_PHPSHOP_DELIVERY_TIME = "�Ѵ������"; // Usually ships in
    var $_PHPSHOP_DELIVERY_INFORMATION = "��������´��èѴ��"; // Delivery Information
    var $_PHPSHOP_MORE_CATEGORIES = "�Թ�����Ǵ����"; // more categories
    var $_PHPSHOP_AVAILABILITY = "�Թ��Ҿ������˹���"; // Availability
    var $_PHPSHOP_CURRENTLY_NOT_AVAILABLE = "�Թ������"; // This product is currently not available.
    var $_PHPSHOP_PRODUCT_AVAILABLE_AGAIN = "�����Թ���: "; // It will be available again on: 
    
    var $_PHPSHOP_STATISTIC_SUMMARY = "�Ҿ���"; // Summary
    var $_PHPSHOP_STATISTIC_STATISTICS = "ʶԵ�"; // Statistics
    var $_PHPSHOP_STATISTIC_CUSTOMERS = "�١���"; // Customers
    var $_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS = "�Թ��ҷ���ա������͹���"; // active Products
    var $_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS = "�Թ��ҷ������ա������͹���"; // inactive Products
    var $_PHPSHOP_STATISTIC_SUM = "�����"; // Sum
    var $_PHPSHOP_STATISTIC_NEW_ORDERS = "��¡����觫�������"; // New Orders
    var $_PHPSHOP_STATISTIC_NEW_CUSTOMERS = "�١�������"; // New Customers
    
    
	//Waiting list : file /administrator/components/com_phpshop/html/shop.waiting_list.php
	var $_PHPSHOP_WAITING_LIST_MESSAGE = "��س����������ͧ��ҹ ���ͷ������駡�Ѻ����Һ���������¡���Թ����ʵ�ͤ ��Ҩ������ , ������ , ��� ������������ͧ��ҹ����Ѻ��¡������͡�ҡ������ҹ��Һ��������Թ����ʵ�ͤ<br /><br />Thank you!"; // Please enter your e-mail address below to be notified when this product comes back in stock.  We will not share, rent, sell or use this e-mail address for any other purpose other than to tell you when the product is back in stock.<br /><br />Thank you!
	var $_PHPSHOP_WAITING_LIST_THANKS = "�ͺ�س����س���! <br />��Ҩ������س��Һ���������¡��㹤�ѧ�Թ���"; // Thanks for waiting! <br />We will let you know as soon as we get our inventory.
	var $_PHPSHOP_WAITING_LIST_NOTIFY_ME = "��ѧ����Һ!"; // Notify Me!
	
	//Checkout : file /administrator/components/com_phpshop/html/checkout.thankyou.php
	var $_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW = "����ͧ����Ѻ�����"; // Print view
  
  /**************************Admin.show_cfg.php in apparition order ;-)**************************************/
	
	/* PAGE 1 */
	var $_PHPSHOP_ADMIN_CFG_AUTORIZE_OR_CYBERCASH = "�ô���͡ Authorize.net ���� CyberCash"; // Please choose EITHER Authorize.net OR CyberCash
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS = " ��駤��ʶҹ����:"; //  Configuration file status:
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE = "��¹�Ѻ��"; // is writeable
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE = "�������ö��¹�Ѻ��"; // is unwriteable
	
	var $_PHPSHOP_ADMIN_CFG_GLOBAL = "Global"; // Global
	var $_PHPSHOP_ADMIN_CFG_PATHANDURL = "Path & URL"; // Path & URL
	var $_PHPSHOP_ADMIN_CFG_SITE = "䫵�"; // Site
	var $_PHPSHOP_ADMIN_CFG_SHIPPING = "��èѴ��"; // Shipping
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT = "��觫���"; // Checkout
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS = "��ǹ���Ŵ"; // Downloads
	var $_PHPSHOP_ADMIN_CFG_PAYEMENTOPTIONS = "��ê����Թ"; // Payments
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE = "�ʴ�੾����¡��ᤵ����͡�Թ���"; // Use only as catalogue
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN = "������͡��¡�ù�� ���������ö��ѧ����ö�繪����Թ��"; // If you check this, you disable all cart functionalities.
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES = "�ʴ��Ҥ�"; // Show Prices
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX = "�ʴ��Ҥ��������?"; // Show Prices including tax?
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN = "��˹������ʴ�����١�������Ҥ�������� ����¡�������"; // Sets the flag whether the shoppers sees prices including tax or excluding tax."
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN = "���͡��������ʴ��Ҥ� �óշ�����͡�ʴ�੾��ᤵ����͡�Թ������ҧ���� �Ҩ������ͧ����ʴ��Ҥ�"; // Check to show prices. If using catalogue functionality, some don't want prices to appear on pages.
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX = "���յ����ԧ"; // Virtual Tax
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN = "��˹���¡�÷������кع��˹ѡ��ҵ�ͧ������������� ������ ps_checkout.php->calc_order_taxable() ��������¹�ŧ��"; // This determines whether items with zero weight are taxed or not. Modify ps_checkout.php->calc_order_taxable() to customize this.
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE = "�ٻẺ��äӹǹ����:"; // Tax mode:
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP = "��˹����ʶҹ���Ѵ��"; // Based on shipping address
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR = "��˹���������������"; // Based on vendor address
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN = "��˹��������͡�ѵ�����շ��й����㹡�äӹǹ����:<br /> <ul><li>�ҡ�Ѱ���ͻ���ȷ����ҹ��ҵ������</li><br/> <li>���ͨҡ����ȷ���١�������</li></ul>"; // This determines which tax rate is taken for calculating taxes:<br /> <ul><li>the one from the state / country the store owner comes from</li><br/> <li>or the one from where the shopper comes from.</li></ul>"
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE = "�ʴ����������ѵ��?"; // Enable multiple tax rates?
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN = "���͡��¡�ù�� �������¡���Թ��ҷ�����ѵ������ᵡ��ҧ�ѹ (�� ˹ѧ����������� 7% , ���ҧ���� 16%)"; // Check this, if you have products with different tax rates (e.g. 7% for books and food, 16% for other stuff)
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE = "�ѡ��ǹŴ��͹�Դ������Ф�Ң���?"; // Subtract payment discount before tax/shipping?
  var $_PHPSHOP_ADMIN_CFG_REVIEW = "͹حҵ����١����ʴ������Դ��� ������ǵ����ṹ��"; // Enable Customer Review/Rating System
  var $_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN = "������͡��¡�ù�� �з�����١�������ö����ṹ��ǵ�Թ��� ����ʴ������Դ�����<br /> ��������١�������ö�ʴ������������ǡѺ����Թ��ҹ�����١����������<br />"; // If enabled, you allow customers to <strong>rate products</strong> and <strong>write reviews</strong> about them. <br /> So customers can write down their experiences with the product for other customers.<br />
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN = "��˹�����ѡ��ǹŴ��͹���͡��鹵͹�����Թ ������ѧ�ҡ���������Ф�Ң�������"; // Sets the flag whether to subtract the Discount for the selected payment BEFORE (checked) or AFTER tax and shipping.
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK = "�١�������ö���鹢����ŷҧ��ҹ�ѭ�ո�Ҥ��?"; // Customers can leave bank account data?
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN = "���͡��¡�ù�� ����ҡ�١��ҵ�ͧ��èл���ͧ�����ŷҧ��ҹ�ѭ�ո�Ҥ�õ͹ŧ����¹"; // Check if your customers shall have the ability to provide their bank account data when registering to the shop.

	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE = "�١�������ö���͡�Ѱ ���������Ҥ��?"; // Customers can select a state/region?
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN = "���͡��¡�ù�� �١��Ҩ�����ö���͡��¡���Ѱ���������Ҥ㹢�鹵͹���ŧ����¹"; // Check if your customers shall have the ability to select their state / region data when registering to the shop.
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS = "��ͧ��繪ͺ�Ѻ��͵�ŧ������ԡ��?"; // Must agree to Terms of Service?
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN = "���͡��¡�ù�� �ҡ��ͧ����������͵�ͧ��繪ͺ�Ѻ��͵�ŧ������ԡ�á�͹"; // Check if you want a shopper to agree to your terms of service before registering to the shop.
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK = "��Ǩ�Ѻ�Թ���?"; // Check Stock?
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN = "��˹�����ա�õ�Ǩ�Ѻ�Թ��� ����ͼ�������Ժ�Թ������ö�� ������͡��¡�ù��з�����١����������ö������¡���Թ����ö�繶���ҡ������Թ����ʵ�ͤ"; // Sets whether to check the stock level when a user adds an item to the shopping cart.  If set, this will not allow user to add more items to the cart than are available in stock.
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE = "͹حҵ������к���Ҫԡ���͢���?"; // Enable Affiliate Program?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN = "������͡��¡�ù�� ���繡��͹حҵ�������к���õԴ�����Ҫԡ���͢��¨ҡ˹����ҹ.."; // This enables the affiliate tracking in the shop-frontend. Enable if you have added affiliates in the backend..
	
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT = "�ٻẺ����׹�ѹ�����觫��ͷ����价ҧ������:"; // Order-mail format:
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT = "Ẻ�ѡ�ø�����"; // Text mail
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML = "Ẻ HTML"; // HTML mail
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN = "�кء���׹�ѹ�����觫��ͷҧ������:<br /> <ul><li>Ẻ�ѡ�ø�����</li> <li>Ẻ HTML ������ٻ�Ҿ</li></ul>"; // This determines how your order confirmation emails are set up:<br /> <ul><li>as a simple text email</li> <li>or as a html email with images.</li></ul>
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN = "͹حҵ����ռ������к�੾��˹����ҹ?"; // Allow Frontend-Administration for non-Backend Users?
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN = "����ö��˹�����ռ������к�੾��˹����ҹ �� storeadmins ���������ö��Ҷ֧�к���èѴ��âͧ Mambo �� (�� Registered / Editor)"; // With this setting you can enable the Frontend Administration for users who are storeadmins, but can't access the Mambo Backend (e.g. Registered / Editor).
	
	/* PAGE 2 */
	var $_PHPSHOP_ADMIN_CFG_URL = "URL"; // URL
	var $_PHPSHOP_ADMIN_CFG_URL_EXPLAIN = "URL ����Ѻ Mambo 䫵�ͧ��ҹ (�������ͧ���� / ��ͷ���´���!)"; // The URL to your site. Usually identical to your Mambo URL (with trailing slash at the end!)
	var $_PHPSHOP_ADMIN_CFG_URLSECURE = "SECUREURL"; // SECUREURL
	var $_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN = "URL ����Ѻ�����������ѡ�Ҥ�����ʹ��� (https - ����������ͧ���� / ��ͷ���´���!)"; // The secure URL to your site. (https - with trailing slash at the end!)
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT = "COMPONENTURL"; // COMPONENTURL
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN = "URL ����Ѻ�����鹷�ͧ mambo-phpShop (�������ͧ���� / ��ͷ���´���!)"; // The URL to the mambo-phpShop component. (with trailing slash at the end!)
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE = "IMAGEURL"; // IMAGEURL
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN = "URL ����Ѻ���ٻ�Ҿ�����鹷�ͧ mambo-phpShop (�������ͧ���� / ��ͷ���´���!)"; // The URL to the mambo-phpShop component image directory.(with trailing slash at the end!)
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH = "ADMINPATH"; // ADMINPATH
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN = "��ä�����Ҹ����Ѻ�����鹷�ͧ mambo-phpShop"; // The path to your mambo-phpShop component directory.
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH = "CLASSPATH"; // CLASSPATH
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN = "��ä�����Ҹ����Ѻ���ʢͧ phpShop"; // The path to your phpShop classes directory.
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH = "PAGEPATH"; // PAGEPATH
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN = "��ä�����Ҹ����Ѻ����� html �ͧ phpShop"; // The path to your phpShop html directory.
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH = "IMAGEPATH"; // IMAGEPATH
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN = "��ä�����Ҹ����Ѻ���ٻ�Ҿ�ͧ phpShop"; // The path to your phpShop shop_image directory.
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE = "HOMEPAGE"; // HOMEPAGE
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN = "˹���ʴ���˹���á"; // 	This is the page which will be loaded by default.
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE = "ERRORPAGE"; // ERRORPAGE
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN = "˹���ʴ���ͤ�������ǡѺ��ͼԴ��Ҵ"; // This is the default page for displaying error messages.	
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE = "DEBUGPAGE"; // DEBUGPAGE
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN = "˹���ʴ��Ţ�ͤ�����ôպѡ"; // his is the default page for displaying debug messages.
	var $_PHPSHOP_ADMIN_CFG_DEBUG = "DEBUG ?"; // DEBUG ?
	var $_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN = "�պѡ ?  �Դ��ҹ����ʴ��š�ôպѡ	- ���ʴ��ŷ���ҹ��ҧ�ͧ����˹��. ��觨Ъ���㹡�û�Ѻ��ا����к� ��þѲ����ҹ��� ����ʴ���������´�ö�� ����ʴ���ҵ�ҧ� �繵�"; // DEBUG?  	   	Turns on the debug output. This causes the DEBUGPAGE to be displayed at the bottom of each page. Very helpful during shop development since it shows the carts contents, form field values, etc.


/* PAGE 3 */

	var $_PHPSHOP_ADMIN_CFG_FLYPAGE = "˹�ҵ�ҧ����"; // FLYPAGE
	var $_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN = "˹�ҵ�ҧ�ʴ���������´�Թ���"; // This is the default page for displaying product details.
  var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE = "�ٻẺ��Ǵ�Թ���"; // Category Template
	var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN = "��˹��ٻẺ��������Ѻ����ʴ��Թ����������Ǵ<br /> ��ҹ����ö���ҧ�ٻẺ����ҡ������ŵ���������<br /> (������������ä����� <strong>COMPONENTPATH/html/templates/</strong>)"; // This defines the default category template for displaying products in a category.<br /> You can create new templates by customizing existing template files <br /> (which reside in the directory <strong>COMPONENTPATH/html/templates/</strong> and begin with browse_)
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW = "�ӹǹ���Ԣͧ�Թ����������"; // Default number of products in a row
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN = "�ʴ��ӹǹ�Թ����������. <br /> ������ҧ��: ��ҡ�˹��� 4 ����ʴ��ӹǹ�Թ��� 4 ��¡�õ����"; // This defines the number of products in a row. <br /> Example: If you set it to 4, the category template will display 4 products per row
  
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE = "�ٻ�Ҿ \"no image\""; // \"no image\" image
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN = "�ʴ��Ҿ��������������Ҿ�Թ���"; // This image will be shown when no product image is available.
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS = "�ӹǹ��÷Ѵ���˹��"; // SEARCH ROWS
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN = "�кبӹǹ��÷Ѵ���˹�� �ҡ�š�ä��ҷ����"; // Determines the number of rows per page when search results are displayed in a list.
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 = "��ᶺ��¡�ä��� 1"; // SEARCH COLOR 1
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN = "��˹��բͧᶺ��¡�ä�������Ţ���"; // Specifies the color of the odd numbered rows in a result list.
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 = "��ᶺ��¡�ä��� 2"; // SEARCH COLOR 2
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN = "��˹��բͧᶺ��¡�ä�������Ţ���"; // Specifies the color of the even numbered rows in a result list.
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS = "�ӹǹ��÷Ѵ�٧�ش"; // MAXIMUM ROWS
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN = "��˹��ӹǹ��÷Ѵ�����ʴ����ǹ�ͧ��¡��"; // Sets the number of rows to show in the order list select box.
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION = "�ʴ� \"powered by mambo-phpShop\" ����ҹ��ҧ ?"; // Show footer \"powered by mambo-phpShop\" ?
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN = "�ʴ��Ҿ powered-by-mambo-phpShop"; // Displays a powered-by-mambo-phpShop footer image.
	
	
	/* PAGE 4 */
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD = "���͡�Ըա�â���"; // Choose your store's shipping method
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD = "����Ţ����ҵðҹ �����颹�� ����ѵ�Ҥ�Ң��觢ͧ�������  <strong>�й� !</strong>"; // Standard Shipping module with indiviual configured carriers and rates. <strong>RECOMMENDED !</strong>
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE = "  	Zone Shipping Module Country Version 1.0<br />����������´������� <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br /> ���͵�ͧ��õԴ��� <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a><br /> ���͡������� Zone Shipping"; //   	Zone Shipping Module Country Version 1.0<br />For more information on this module please visit <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br /> for details or contact <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a><br /> Check this to enable the zone shipping module
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS = "<a href=\"http://www.ups.com\" target=\"_blank\">UPS Online(R) Tools</a> �ӹǹ��Ң����͹�Ź�"; // <a href=\"http://www.ups.com\" target=\"_blank\">UPS Online(R) Tools</a> Shipping calculation
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE = "���ʻ����żŢͧ UPS"; // UPS access code
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN = "���ʻ����żŢͧ UPS �ͧ��ҹ"; // Your UPS access code
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID = "���ͼ����ҹ UPS"; // UPS user id
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN = "���ͼ����ҹ����ҹ���Ѻ�ҡ UPS"; // The user ID you got from UPS
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD = "���ʼ�ҹ UPS"; // UPS password
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN = "���ʼ�ҹ����Ѻ�ѭ�ռ����ҹ UPS "; // The password for your UPS account
	  
  var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER = "���͡����� InterShipper ��ҷ�ҹ�պѭ�բͧ <a href=\"http://www.intershipper.com\" target=\"_blank\">Intershipper.com</a>"; // InterShipper Module. Check only if you have an <a href=\"http://www.intershipper.com\" target=\"_blank\">Intershipper.com</a> account
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE = "����ͧ���͡�Ըա�â��� �óշ���١��ҫ����Թ��ҷ�����Ըմ�ǹ���Ŵ"; // Disable Shipping method selection. Choose if your customers buy downloadable goods which don't have to be shipped.
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD = "���ʼ�ҹ��� InterShipper"; // InterShipper Password
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD_EXPLAIN = "���ʼ�ҹ�ͧ��ҹ�����Ѻ�ѭ�բͧ InterShipper"; // Your password for your intershipper account.
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL = "InterShipper email"; // InterShipper email
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL_EXPLAIN = "������ͧ��ҹ�����Ѻ�ѭ�բͧ InterShipper"; // Your email address for your intershipper account.
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY = "ENCODE KEY"; // ENCODE KEY
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN = "����Ѻ��������ʢ����ŷ���������к��ҹ������ ������������Ѻ��û�ͧ�ѹ�����������Ҵ٢����Ź����"; // Used to encrypt data stored in database with this key. This means that this file should be protected from viewing at all times.
	
	
	/* PAGE 5 */
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR = "�ʴ�ᶺ��鹵͹��ê����Թ"; // Enable the Checkout Bar
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN = "���͡��¡�ù�������ʴ�ᶺ��鹵͹��ê����Թ ( 1 - 2 - 3 - 4 ������Ҿ��ҿ�Ԥ)"; // Check this, if you want the 'checkout-bar' to be displayed to the customer during checkout process ( 1 - 2 - 3 - 4 with graphics).
	
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS = "���͡�Ըա�ê����Թ����Ѻ��ҹ��Ңͧ��ҹ"; // Choose your store's checkout process
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD = "<strong>Ẻ����� :</strong><br/>1. ��ͧ���ʶҹ���Ѵ��<br />2. ��ͧ����Ըա�â���<br />3. ��ͧ����Ըա�ê����Թ<br />4. �����觫�������ó�"; // <strong>Standard :</strong><br/>1. Shipping address request<br />2. Shipping method request<br />3. Payment method request<br />4. Complete Order
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 = "<strong>Ẻ��� 2:</strong><br/>1. ��ͧ���ʶҹ���Ѵ��<br />2. ��ͧ����Ըա�ê����Թ<br />3. �����觫�������ó�"; // <strong>Process 2:</strong><br/>1. Shipping address request<br />2. Payment method request<br />3. Complete Order
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 = "<strong>Ẻ��� 3:</strong><br/>1. ��ͧ���ʶҹ���Ѵ��<br />2. ��ͧ����Ըա�ê����Թ<br />3. �����觫�������ó�"; // <strong>Process 3:</strong><br/>1. Shipping method request<br />2. Payment method request<br />3. Complete Order
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 = "<strong>Ẻ��� 4:</strong><br/>1. ��ͧ����Ըա�ê����Թ<br />2. �����觫�������ó�"; // <strong>Process 4:</strong><br/>1. Payment method request<br />2. Complete Order
	
		
	/* PAGE 6 */
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS = "͹حҵ����ǹ���Ŵ��"; // Enable Downloads
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN = "���͡����͹حҵ�������ö��ǹ���Ŵ�� ������Ѻ��˹����Թ��ҷ������ԡ��Ẻ��ǹ���Ŵ"; // Check to enable the download capability. Only If you want sell downloadable goods.
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS = "ʶҹС����觫��͡ó�͹حҵ����ǹ���Ŵ��"; // Order Status which enables download
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN = "���͡ʶҹС����觫��� 㹡óշ���١����к�����ա�ô�ǹ���Ŵ�ҧ������"; // Select the order status at which the customer is notified about the download via e-mail.
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS = "ʶҹС����觫��͡ó����͹حҵ����ա�ô�ǹ���Ŵ"; // Order Status which disables downloads
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN = "��˹�ʶҹС����觫��� 㹡óշ�����͹حҵ����١��Ҵ�ǹ���Ŵ"; // Sets the order status at which the download is disabled for the customer.
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT = "�Ҹ�����������ǹ���Ŵ"; // DOWNLOADROOT
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN = "�Ҹ��������������������Ѻ����١��Ҵ�ǹ���Ŵ (�������ͧ���� / �͹���´���!)<br><span class=\"message\">���ͤ�����ʹ���: ��س�������Ҹ����� WEBROOT</span>"; // The physical path to the files for the custumer download. (trailing slash at the end!)<br><span class=\"message\">For your own shop's security: If you can, please use a directory ANYWHERE OUTSIDE OF THE WEBROOT</span>
	
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX = "�ӹǹ���駴�ǹ���Ŵ�٧�ش"; // Download Maximum
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN = "��˹��ӹǹ���駷������ö��ǹ���Ŵ����˹������ Download-ID (��͡����觫���˹����¡��)"; // Sets the number of downloads which can be made with one Download-ID, (for one order)"
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE = "�ú��˹���ǹ���Ŵ"; // Download Expire
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN = "��˹����������� <strong>�Թҷ�</strong> �¨ФԴ�����������ա�ô�ǹ���Ŵ ����ͤú������������ download-ID ���������ö��ҹ���ա<br />�����˵� : 86400 �Թҷ� = 24 ��."; // Sets the time range <strong>in seconds</strong> in which the download is enabled for the customer. This range begins with the first download! When the time range has expired, the download-ID is disabled.<br />Note : 86400s=24h.
		
	
	/* PAGE 7 */
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL = "���͡���ê����Թ���� PayPal?"; // Enable IPN Payment via PayPal?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL_EXPLAIN = "���͡��������١��Ңͧ��ҹ������к���ê����Թ��ҹ�к� PayPal"; // Check to let your customers use the PayPal payment system.
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL = "����������Ѻ�����Թ��ҹ PayPal:"; // PayPal payment email:
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL_EXPLAIN = "������ͧ��ҹ���������Ѻ��ê����Թ��ҹ�к��ͧ PayPal"; // Your business email address for PayPal payments. Also used as receiver_email.
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS = "ʶҹС����觫��� ����ͷ���¡������ó�"; // Order Status for successful transactions
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS_EXPLAIN = "���͡ʶҹС����觫��� ����ͷӸ�á�����ҹ PayPal ���º��������<br />������к���â��Ẻ����ǹ���Ŵ: ������͡ʶҹо��������ǹ���Ŵ (����١��Ҩ����Ѻ��ͤ����ͺ�Ѻ����ǡѺ��ô�ǹ���Ŵ�ҧ������)"; // Select the order status to which the actual order is set, if the PayPal IPN was successful. If using download selling options: select the status which enables the download (then the customer is instantly notified about the download via e-mail).
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED = "ʶҹС����觫�������ͷӸ�á�������ҹ"; // Order Status for failed transactions
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED_EXPLAIN = "���͡ʶҹС����觫��� ������������ö�Ӹ�á�����ҹ PayPal ��"; // Select an order status for failed PayPal transactions.
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE = "���͡���ê����Թ���� PayMate?"; // Enable Payments via PayMate?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE_EXPLAIN = "���͡��������١��Ңͧ��ҹ������к���ê����Թ��ҹ�к� Australian PayMate"; // Check to let your customers use the Australian PayMate payment system.
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME = "PayMate username:"; // PayMate username:
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME_EXPLAIN = "���ͼ����ҹ����Ѻ�ѭ�բͧ PayMate."; // Your user account for PayMate.
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET = "���͡���ê����Թ�ͧ Authorize.net?"; // Enable Authorize.net payment?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_EXPLAIN = "���͡�� Authorize.net �Ѻ phpShop"; // Check to use Authorize.net with phpShop.
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE = "�������ͺ ?"; // Test mode ?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE_EXPLAIN = "���͡ '��' ���ͷ���¡�÷��ͺ -- ���͡ '�����' ���ͷ���¡�è�ԧ"; // Select 'Yes' while testing. Select 'No' for enabling live transactions.
	var $_PHPSHOP_ADMIN_CFG_YES = "��"; // Yes
	var $_PHPSHOP_ADMIN_CFG_NO = "�����"; // No
	
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME = "�����Ţ ID �ͧ Authorize.net"; // Authorize.net Login ID
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME_EXPLAIN = "����������Ţ ID �ͧ Authorize.Net �ͧ��ҹ"; // This is your Authorize.Net Login ID
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY = "�Ţ���ʡ�÷Ӹ�á����Ѻ Authorize.net"; // Authorize.net Transaction Key
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY_EXPLAIN = "������Ū��������Ѻ��Ӹ�á����Ѻ Authorize.net"; // This is your Authorize.net Transaction Key
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE = "����������Ѻ�ͧ"; // Authentication Type
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE_EXPLAIN = "����������Ѻ�ͧ�ͧ Authorize.Net"; // This is the Authorize.Net authentication type.
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH = "���͡�� CyberCash?"; // Enable CyberCash?
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH_EXPLAIN = "���͡�� CyberCash �Ѻ phpShop"; // Check to use CyberCash with phpShop.
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND = "CyberCash MERCHANT"; // CyberCash MERCHANT
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_EXPLAIN = "CC_MERCHANT �Ţ���¼����ҹ�ͧ CyberCash"; // CC_MERCHANT is the CyberCash Merchant ID
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY = "CyberCash Merchant Key"; // CyberCash Merchant Key
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY_EXPLAIN = "CyberCash Merchant Key ��������Ѻ�����ҹ��觡�˹��� CyberCash"; // CyberCash Merchant Key is the Merchant Provided by CyberCash
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL = "CyberCash PAYMENT URL"; // CyberCash PAYMENT URL
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL_EXPLAIN = "CyberCash PAYMENT URL ��� URL ����Ѻ�к�������ʹ���㹡�ê����Թ��� Cybercash ��˹����"; // CyberCash PAYMENT URL is the URL provided by Cybercash for secure payment
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE = "CyberCash AUTH TYPE"; // CyberCash AUTH TYPE
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE_EXPLAIN = "CyberCash AUTH TYPE ��ͪ�Դ�ͧ����Ѻ�ͧ���ҧ CyberCase ��˹����"; // CyberCash AUTH TYPE is the Cybercash authentication type provided by Cybercase
	
    /** Advanced Search feature ***/
    var $_PHPSHOP_ADVANCED_SEARCH  ="����Ẻ�����´"; // Advanced Search
    var $_PHPSHOP_SEARCH_ALL_CATEGORIES = "���Ҩҡ��Ǵ������"; // Search All Categories
    var $_PHPSHOP_SEARCH_ALL_PRODINFO = "������������´�Թ��ҷ�����"; // Search all product info
    var $_PHPSHOP_SEARCH_PRODNAME = "�����Թ������ҧ����"; // Product name only
    var $_PHPSHOP_SEARCH_MANU_VENDOR = "�����/����Ե ���ҧ����"; // Manufacturer/Vendor only
    var $_PHPSHOP_SEARCH_DESCRIPTION = "��������´�Թ������ҧ����"; // Product description only
    var $_PHPSHOP_SEARCH_AND = "���"; // and
    var $_PHPSHOP_SEARCH_NOT = "���"; // not
    var $_PHPSHOP_SEARCH_TEXT1 = "��¡���á����Ѻ������͡��Ǵ���� .��¡�÷���ͧ����Ѻ���͡��������´ ������ǹ��Сͺ����ǡѺ�Թ��� (�� �����Թ���) ��������͡��¡������ ������ӷ���ͧ��ä������ͤ����Թ��� "; // The first drop-down-list allows you to select a category to limit your search to. The second drop-down-list allows you to limit your search to a particular piece of product information (e.g. Name). Once you have selected these (or left the default ALL), enter the keyword to search for. "
    var $_PHPSHOP_SEARCH_TEXT2 = "��ҹ����ö����Ẻ��Ш��ҡ��� �¡�������ӷ���ͧ��ä��� ������͡������ AND ���� OR  -  ���͡ AND ���¶֧�Ф����Թ��ҷ���դӤ��ҷ���ͧ��,  ���͡ OR ���¶֧�Ф����Թ��ҷ���դӤ��Ҥ��á �������դӷ���ͧ"; // You can further refine your search by adding a second keyword and selecting the AND or NOT operator. Selecting AND means both words must be present for the product to be displayed. Selecting NOT means the product will be displayed only if the first keyword is present and the second is not.
    var $_PHPSHOP_ORDERBY = "���§�ӴѺ"; // Order by
    
    /*** Review feature ***/
    var $_PHPSHOP_CUSTOMER_RATING  = "��ṹ��ǵ"; // Average customer rating
    var $_PHPSHOP_TOTAL_VOTES = "��ṹ��ǵ������"; // Total votes
    var $_PHPSHOP_CAST_VOTE = "�ô���͡��ṹ��ǵ"; // Please cast your vote
    var $_PHPSHOP_RATE_BUTTON = "��ǵ"; // Rate
    var $_PHPSHOP_RATE_NOM = "��ṹ"; // Rating
    var $_PHPSHOP_REVIEWS = "�����Դ��繢ͧ�١���"; // Customer Reviews
    var $_PHPSHOP_NO_REVIEWS = "�ѧ����դ����Դ�������Ѻ�Թ��ҹ��"; // There are yet no reviews for this product.
    var $_PHPSHOP_WRITE_FIRST_REVIEW = "�ԭ�ʴ������Դ���..."; // Be the first to write a review...
    var $_PHPSHOP_REVIEW_LOGIN = "��س��������к���͹�ʴ������Դ���"; // Please log in to write a review.
    var $_PHPSHOP_REVIEW_ERR_RATE = "��س�����ṹ��ǵ����"; // Please rate the product to complete your review!
    var $_PHPSHOP_REVIEW_ERR_COMMENT1 = "�ô�ѹ�֡�����Դ��繢ͧ��ҹ ���ҧ���� 100 ����ѡ��"; // Please write down some more words for your review. Mininum characters allowed: 100
    var $_PHPSHOP_REVIEW_ERR_COMMENT2 = "��س��ʴ������Դ�������Թ 2000 ����ѡ��"; // Please shorten your review. Maximum characters allowed: 2000
    var $_PHPSHOP_WRITE_REVIEW = "�ʴ������Դ�������Ѻ�Թ��ҹ��!"; // Write a review for this product!
    var $_PHPSHOP_REVIEW_RATE = "����á: ����ṹ�Թ��� �ô�кؤ�ṹ�����ҧ 0 (����ҡ) �֧ 5 ��� (��������)."; // First: Rate the product. Please select a rating between 0 (poorest) and 5 stars (best).
    var $_PHPSHOP_REVIEW_COMMENT = "��س��ʴ������Դ���....(���ҧ���� 100 ����ѡ��, �٧�ش 2000 ����ѡ��) "; // Now please write a (short) review....(min. 100, max. 2000 characters) 
    var $_PHPSHOP_REVIEW_COUNT = "�ӹǹ����ѡ��: "; // Characters written: 
    var $_PHPSHOP_REVIEW_SUBMIT = "��ŧ"; // Submit Review
    var $_PHPSHOP_REVIEW_ALREADYDONE = "��ҹ���ʴ������Դ�������Ѻ�Թ��ҹ������"; // You already have written a review for this product. Thank you.
    var $_PHPSHOP_REVIEW_THANKYOU = "�ͺ�س����Ѻ�����Դ��繢ͧ��ҹ"; // Thanks for your review.
    var $_PHPSHOP_COMMENT= "�����˵�"; // Comment
    
    var $_PHPSHOP_CREDITCARD_FORM_LBL = "����/��䢻������ѵ��ôԵ"; //Add/Edit Credit Card Types 
    var $_PHPSHOP_CREDITCARD_NAME = "���ͺѵ��ôԵ"; // Credit Card Name
    var $_PHPSHOP_CREDITCARD_CODE = "�������"; // Credit Card - Short Code
    var $_PHPSHOP_CREDITCARD_TYPE = "�������ѵ��ôԵ"; // Credit Card Type
    
    var $_PHPSHOP_CREDITCARD_LIST_LBL = "�ѵ��ôԵ"; // Credit Card List
    var $_PHPSHOP_UDATE_ADDRESS = "��Ѻ��ا"; // Update Address
    var $_PHPSHOP_CONTINUE_SHOPPING = "���͡�Թ��ҵ��"; // Continue Shopping
    
    var $_PHPSHOP_THANKYOU_SUCCESS = "��¡����觫��ͧ͢��ҹ���Ѻ��ô��Թ������º��������!"; // Your order has been successfully placed!
    var $_PHPSHOP_ORDER_LINK = "�����������´�����觫���"; // Follow this link to view the Order Details.
    
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "ʶҹС����觫��ͧ͢���觫����Ţ��� {order_id} �ա������¹�ŧ"; // the Status of your Order No. {order_id} has been changed.
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "ʶҹ�����:"; // New Status is:
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "��ͧ��ô���������´�����觫��� �ô������駤� (���ͤѴ�͡��Դ�ѧ��������ͧ��ҹ):"; // To view the Order Details, please follow this link (or copy it into your browser):
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "����¹ʶҹС����觫���: ���觫����Ţ��� {order_id}"; // Order Status Change: Your Order {order_id}
    var $_PHPSHOP_ORDER_LIST_NOTIFY = "���١�������Һ?"; // Notify Customer?
    var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "��س�����¹ʶҹС����觫��͡�͹!"; // Please change the Order Status first!
    
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "��ǹŴ����Ѻ����������ͷ���� (%)"; // Price Discount on default Shopper Group (in %)
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = " X ����繤�Һǡ ���¶֧: ����Թ���������ա���к��Ҥ�����Ѻ����������� �ҤҨ�Ŵ����ӹǹ X % �ӹǹ�Դź���ռŵç����"; // A positive amount X means: If the Product has no Price assigned to THIS Shopper Group, the default Price is decreased by X %. A negative amount has the opposite effect
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_LBL = "�Թ���Ŵ�Ҥ�"; // Product Discount
    var $_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL = "�Թ���Ŵ�Ҥ�"; // Product Discount List
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT = "����/�����¡��Ŵ�Ҥ�"; // Add/Edit Product Discount
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT = "��ǹŴ"; // Discount amount
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP = "�кبӹǹ��ǹŴ"; // Enter the discount amount
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE = "��������ǹŴ"; // Discount Type
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT = "�����繵�"; // Percentage
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL = "�ʹ���"; // Total
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP = "�к��������繵� �����ʹ���?"; // Shall the amount be a percentage or a total?
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE = "������Ŵ�Ҥ��ѹ���"; // Start date of discount
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP = "��˹��ѹ��������Ŵ�Ҥ�"; // Specifies the day when the discount begins
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE = "����ش�ѹ���"; // End date of discount
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP = "��˹��ѹ�������ش���Ŵ�Ҥ�"; // Specifies the day when the discount ends
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP = "��ҹ����ö��Ẻ�������ǹŴ����Ѻ������¡����ǹŴ!"; // You can use the Product Discount Form to add discounts!
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_SAVE = "��ҹ�����Ѵ��"; // You Save
    
    var $_PHPSHOP_FLYPAGE_ENLARGE_IMAGE = "���Ҿ����"; // View Full-Size Image
    
/*********************
Currency Display Style 
***********************/
    var $_PHPSHOP_CURRENCY_DISPLAY = "�ٻẺ����ʴ�ʡ���Թ"; // Currency Display Style
    var $_PHPSHOP_CURRENCY_SYMBOL = "�ѭ�ѡɳ�ʡ���Թ"; // Currency symbol
    var $_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP = "��ҹ����ö�� HTML �� (�� &amp;euro;,&amp;pound;,&amp;yen;,...)"; // You can also use HTML Entities here (e.g. &amp;euro;,&amp;pound;,&amp;yen;,...)
    var $_PHPSHOP_CURRENCY_DECIMALS = "�ش�ȹ���"; // Decimals
    var $_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP = "�ʴ��ӹǹ���˹觷ȹ��� (�к��� 0 ��)<br><b>��Ҥ�ҷ���к����ç������˹觷ȹ��� ���ʴ�����ѡ��ǹ�</b>"; // Number of displayed decimals (can be 0)<br><b>Performs rounding if value has different number of decimals</b>
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL = "�ѭ�ѡɳ�ش�ȹ���"; // Decimal symbol
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP = "�ѭ�ѡɳ������ʴ��ش�ȹ���"; // Character used as decimal symbol
    var $_PHPSHOP_CURRENCY_THOUSANDS = "����ͧ���¨���Ҥ"; // Thousands separator
    var $_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP = "�ѭ�ѡɳ������ʴ���ѡ�ѹ (����ö�����ҧ���)"; // Character used to separate thousands (can be empty)
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY = "�ٻẺ����ʴ���Һǡ"; // Positive format
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP = "�ٻẺ����ʴ��Ť�Һǡ<br>(Symb : ����ͧ����ʡ���ԧԹ)"; // Display format used to display positive values.<br>(Symb stands for currency symbol)
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY = "�ٻẺ����ʴ����ź"; // Negative format
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP = "�ٻẺ����ʴ��Ť��ź<br>(Symb : ����ͧ����ʡ���ԧԹ)"; // Display format used to display negative values.<br>(Symb stands for currency symbol)
    
    var $_PHPSHOP_OTHER_LISTS = "��¡���Թ�������"; // Other Product Lists
/**************
Multiple Images 
****************/
    var $_PHPSHOP_MORE_IMAGES = "���Ҿ����"; // View More Images
    var $_PHPSHOP_AVAILABLE_IMAGES = "�ٻ�Ҿ����Ѻ"; // Available Images for
    var $_PHPSHOP_BACK_TO_DETAILS = "��������´�Թ���"; // Back to Product Details
    
    /* FILEMANAGER */
    var $_PHPSHOP_FILEMANAGER = "��èѴ�����������"; // FileManager
    var $_PHPSHOP_FILEMANAGER_LIST = "��èѴ������::��¡���Թ���"; // FileManager::Product List
    var $_PHPSHOP_FILEMANAGER_ADD = "�����ٻ�Ҿ�������"; // Add Image/File
    var $_PHPSHOP_FILEMANAGER_IMAGES = "��˹��ٻ�Ҿ"; // Assigned Images
    var $_PHPSHOP_FILEMANAGER_DOWNLOADABLE = "��ǹ���Ŵ?"; // Is Downloadable?
    var $_PHPSHOP_FILEMANAGER_FILES = "�к���� (Datasheets,...)"; // Assigned Files (Datasheets,...)
    var $_PHPSHOP_FILEMANAGER_PUBLISHED = "�����?"; // Published?
    
    /* FILE LIST */
    var $_PHPSHOP_FILES_LIST = "��èѴ������::�ٻ�Ҿ/��¡����������"; // FileManager::Image/File List for
    var $_PHPSHOP_FILES_LIST_FILENAME = "�������"; // Filename
    var $_PHPSHOP_FILES_LIST_FILETITLE = "�������"; // File Title
    var $_PHPSHOP_FILES_LIST_FILETYPE = "���������"; // File Type
    var $_PHPSHOP_FILES_LIST_EDITFILE = "������"; // Edit File Entry
    var $_PHPSHOP_FILES_LIST_FULL_IMG = "�ٻ�Ҿ"; // Full Image
    var $_PHPSHOP_FILES_LIST_THUMBNAIL_IMG = "�ٻ�Ҿ���"; // Thumbnail Image
    
    
    /* FILE FORM */
    var $_PHPSHOP_FILES_FORM = "�Ѿ��Ŵ�������Ѻ"; // Upload a File for
    var $_PHPSHOP_FILES_FORM_CURRENT_FILE = "���Ѩ�غѹ"; // Current File
    var $_PHPSHOP_FILES_FORM_FILE = "���"; // File
    var $_PHPSHOP_FILES_FORM_IMAGE = "�ٻ�Ҿ"; // Image
    var $_PHPSHOP_FILES_FORM_UPLOAD_TO = "�Ѿ��Ŵ��ѧ"; // Upload to
    var $_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH = "������Ҿ�Թ���"; // default Product Image Path
    var $_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH = "��������੾��"; // Specify the file location
    var $_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH = "��ǹ���Ŵ�Ҹ (�� �Թ�������Ѻ��·������ö��ǹ���Ŵ��!)"; // Download Path (e.g. for selling downloadables!)
    var $_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL = "���ҧ Thumbnail �ѵ��ѵ�?"; // Auto-Create Thumbnail?
    var $_PHPSHOP_FILES_FORM_FILE_PUBLISHED = "��������?"; // File is published?
    var $_PHPSHOP_FILES_FORM_FILE_TITLE = "������� (����ͧ����ʴ�����١������)"; // File Title (what the Customer sees)
    var $_PHPSHOP_FILES_FORM_FILE_DESC = "��������´���"; // File Description
    var $_PHPSHOP_FILES_FORM_FILE_URL = "URL (�������)"; // File URL (optional)
    
    /* FILE & IMAGE PROCESSING */
    var $_PHPSHOP_FILES_PATH_ERROR = "��س��кط��������١��ͧ!"; // Please provide a valid path!
    var $_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS = "���ҧ Thumbnail �ʴ��ٻ�Ҿ���º��������"; // The Thumbnail Image has been successfully created!
    var $_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE = "�������ö���ҧ Thumbnail �ʴ��ٻ�Ҿ��!"; // Could NOT create Thumbnail Image!
    var $_PHPSHOP_FILES_UPLOAD_FAILURE = "�Ѿ��Ŵ�Դ��Ҵ"; // File/Image Upload Error
    
    var $_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE = "�������öź�ٻ�Ҿ��"; // Could not delete the Full Image File.
    var $_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS = "ź�Ҿ���º��������"; // Full Image successfully deleted.
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE = "�������öź Thumbnail �ʴ��ٻ�Ҿ�� (�Ҩ���ѧ������ա�����ҧ): "; // Could not delete the Thumbnail Image File (maybe didnt exist): 
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS = "ź Thumbnail �ʴ��ٻ�Ҿ���º��������"; // Thumbnail Image successfully deleted.
    var $_PHPSHOP_FILES_FILE_DELETE_FAILURE = "�������öź�������"; // Could not delete the File.
    var $_PHPSHOP_FILES_FILE_DELETE_SUCCESS = "ź������º��������"; // File successfully deleted.
    
    var $_PHPSHOP_FILES_NOT_FOUND = "��辺������ͧ���!"; // Sorry, but the requested file wasn't found!
    var $_PHPSHOP_IMAGE_NOT_FOUND = "��辺�ٻ�Ҿ!"; // Image not found!
    
    /*#####################
    MODULE COUPON
    #####################*/
    
    var $_PHPSHOP_COUPON_MOD = "�ٻͧ"; // Coupon
    var $_PHPSHOP_COUPONS = "�ٻͧ"; // Coupons
    var $_PHPSHOP_COUPON_LIST = "��¡�äٻͧ"; // Coupon List
    var $_PHPSHOP_COUPON_ALREADY_REDEEMED = "�ٻͧ�١�š����"; // Coupon has already been redeemed.
    var $_PHPSHOP_COUPON_REDEEMED = "�ٻͧ�š���º��������"; // Coupon redeemed! Thank you.
    var $_PHPSHOP_COUPON_ENTER_HERE = "��ҷ�ҹ�դٻͧ �ô�к������Ţ:"; // If you have a coupon code, please enter it below:
    var $_PHPSHOP_COUPON_SUBMIT_BUTTON = "��ŧ"; // Submit
    var $_PHPSHOP_COUPON_CODE_EXISTS = "���ʤٻͧ������������� ��س��ͧ�����ա����"; // That coupon code already exists. Please try again.
    var $_PHPSHOP_COUPON_EDIT_HEADER = "���"; // Update Coupon
    var $_PHPSHOP_COUPON_EDIT_HELP_TEXT = "���꡺����ʤٻͧ����ź�������:"; // Click a coupon code to edit it, or to delete a coupon code, select it and click Delete:
    var $_PHPSHOP_COUPON_CODE_HEADER = "���ʤٻͧ"; // Code
    var $_PHPSHOP_COUPON_PERCENT_TOTAL = "�����繵� ���� ������"; // Percent or Total
    var $_PHPSHOP_COUPON_TYPE = "�������ٻͧ"; // Coupon Type
    var $_PHPSHOP_COUPON_TYPE_TOOLTIP = "- �ٻͧ�ͧ��ѭ��ź��ѧ�ҡ�١���š��ǹŴ����<br />- �ٻͧ���è�����ö������ҷ���١��ҵ�ͧ���"; // A Gift Coupon is deleted after it was used for discounting an order. A permanent coupon can be used as often as the customer wants to.
    var $_PHPSHOP_COUPON_TYPE_GIFT = "�ٻͧ�ͧ��ѭ"; // Gift Coupon
    var $_PHPSHOP_COUPON_TYPE_PERMANENT = "�ٻͧ����"; // Permanent Coupon
    var $_PHPSHOP_COUPON_VALUE_HEADER = "��Ť��"; // Value
    var $_PHPSHOP_COUPON_DELETE_BUTTON = "ź����"; // Delete Code
    var $_PHPSHOP_COUPON_CONFIRM_DELETE = "��ͧ���ź���ʤٻͧ���?"; // Are you sure you want to delete this coupon code?
    var $_PHPSHOP_COUPON_COMPLETE_ALL_FIELDS = "��س��кطء��ͧ"; // Please complete all fields.
    var $_PHPSHOP_COUPON_VALUE_NOT_NUMBER = "��Ť�Ңͧ�ٻͧ �к�੾�е���Ţ"; // Coupon value must be a number.
    var $_PHPSHOP_COUPON_NEW_HEADER = "�����ٻͧ����"; // New Coupon
    var $_PHPSHOP_COUPON_COUPON_HEADER = "���ʤٻͧ"; // Coupon Code
    var $_PHPSHOP_COUPON_PERCENT = "�����繵�"; // Percent
    var $_PHPSHOP_COUPON_TOTAL = "������"; // Total
    var $_PHPSHOP_COUPON_VALUE = "��Ť��"; // Value
    var $_PHPSHOP_COUPON_CODE_SAVED = "�ѹ�֡���ʤٻͧ"; // Coupon code saved.
    var $_PHPSHOP_COUPON_SAVE_BUTTON = "�ѹ�֡"; // Save Coupon
    var $_PHPSHOP_COUPON_DISCOUNT = "�ٻͧ��ǹŴ"; // Coupon Discount
    var $_PHPSHOP_COUPON_CODE_INVALID = "��辺���ʤٻͧ ��س��ͧ�����ա����"; // Coupon code not found. Please try again.
    var $_PHPSHOP_COUPONS_ENABLE = "͹حҵ�����ٻͧ"; // Enable Coupon Usage
    var $_PHPSHOP_COUPONS_ENABLE_EXPLAIN = "���͹حҵ�����ٻͧ�� �١��Ҩ�����ö�к����������Ѻ��ǹŴ㹡����觫�����"; // If you enable the Coupon Usage, you allow customers to fill in Coupon Numbers to gain discounts on their purchase.
    
    /* Free Shipping */
    var $_PHPSHOP_FREE_SHIPPING = "�Ѵ�觿��"; // Free Shipping
    var $_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT = "��ҨѴ�觿��!"; // Shipping is free on this Order!
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT = "�ӹǹ����ش��袹�觿��"; // Minimum Amount for Free Shipping
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP = "�ӹǹ����ش��袹������� (�����������!)  ������ҧ��: <strong>50</strong> ���¶֧ ���觿��������١�����觫����Թ�����Ť��� \$50 �����ҡ���� (�����������) "; // The amount (INCLUDING TAX!) which is the Minimum for Free Shipping (example: <strong>50</strong> means Free Shipping when the customer checks out with \$50 (including tax) or more.
    var $_PHPSHOP_YOUR_STORE = "����� ����� ��ͻ"; // Your Store
    var $_PHPSHOP_CONTROL_PANEL = "��������ҹ���"; // Control Panel
    
    /* Configuration Additions */
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON = "���� - PDF"; // PDF - Button
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN = "�ʴ����ͫ�͹���� - PDF ���ǹ��ҹ���"; // Show or Hide the PDF - Button in the Shop
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER = "��ͧ����Ѻ��͵�ŧ�ء��¡����觫���?"; // Must agree to Terms of Service on EVERY ORDER?
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN = "���͡��¡�ù�� �ҡ��ͧ�������١��ҵ�ͧ����Ѻ��͵�ŧ�ء��¡�� (��͹�ӡ����觫���)."; // Check if you want a shopper to agree to your terms of service on EVERY ORDER (before placing the order).
    
    // We need this for eCheck.net Payments
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE = "�������ѭ��"; // Bank Account Type
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING = "����ǹ���"; // Checking
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING = "�礸�áԨ"; // Business Checking
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS = "������Ѿ��"; // Saving
    
    var $_PHPSHOP_PAYMENT_AN_RECURRING = "��͡������˹��?"; // Recurring Billings?
    var $_PHPSHOP_PAYMENT_AN_RECURRING_TOOLTIP = "�к��ҡ��ͧ����͡������˹��"; // Define wether you want recurring billings.
    
    var $_PHPSHOP_INTERNAL_ERROR = "�Դ��ͼԴ��Ҵ�����ҧ��ô��Թ���"; // Internal Error processing the Request to
    var $_PHPSHOP_PAYMENT_ERROR = "�������ö���Թ��ê����Թ��"; // Failure in Processing the Payment
    var $_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS = "��ê����Թ���Թ������º��������"; // Payment successfully processed
    
    /* UPS Shipping Module */
    var $_PHPSHOP_UPS_RESPONSE_ERROR = "UPS �������ö�ӹǹ�ѵ�Ҥ�Ң��觷���ͧ�����"; // UPS was not able to process the Shipping Rate Request.
    var $_PHPSHOP_UPS_SHIPPING_GUARANTEED_DAYS = "�Ѻ��Сѹ�Ѵ��"; // Guaranteed Day(s) To Delivery
    var $_PHPSHOP_UPS_PICKUP_METHOD = "�ԸըѴ�觢ͧ UPS"; // UPS Pickup Method
    var $_PHPSHOP_UPS_PICKUP_METHOD_TOOLTIP = "��ҹ���պ��ͺ�è��ѳ����� UPS �����ҧ��?"; // How do you give packages to UPS?
    var $_PHPSHOP_UPS_PACKAGE_TYPE = "Ẻ��è��ѳ�� UPS?"; // UPS Packaging?
    var $_PHPSHOP_UPS_PACKAGE_TYPE_TOOLTIP = "���͡�ٻẺ��è��ѳ��"; // Select the default Type of Packaging.
    var $_PHPSHOP_UPS_TYPE_RESIDENTIAL = "��èѴ������Ѻ���ѡ�����?"; // Residential Delivery?
    var $_PHPSHOP_UPS_RESIDENTIAL = "��èѴ������Ѻ���ѡ����� (RES)"; // Residential (RES)
    var $_PHPSHOP_UPS_COMMERCIAL    = "��èѴ������Ѻ��áԨ (COM)"; // Commercial Delivery (COM)
    var $_PHPSHOP_UPS_RESIDENTIAL_TOOLTIP = "��ͧ����Ҥ�����Ѻ ��èѴ������Ѻ���ѡ����� (RES) ���� ��èѴ������Ѻ��áԨ (COM)."; // Quote for Residential (RES) or Commercial Delivery (COM).
    var $_PHPSHOP_UPS_HANDLING_FEE = "��ҨѴ���"; // Handling Fee
    var $_PHPSHOP_UPS_HANDLING_FEE_TOOLTIP = "��ҨѴ�������Ѻ����Ըա�â��觹��"; // Your Handling fee for this shipping method.
    var $_PHPSHOP_UPS_TAX_CLASS = "Tax Class"; // Tax Class
    var $_PHPSHOP_UPS_TAX_CLASS_TOOLTIP = "�� Tax Class 㹡�äӹǹ��Ҹ�����������"; // Use the following tax class on the shipping fee.
    
    var $_PHPSHOP_ERROR_CODE = "��ͼԴ��Ҵ"; // Error Code
    var $_PHPSHOP_ERROR_DESC = "��������´"; // Error Description
    
    var $_PHPSHOP_CHANGE_TRANSACTION_KEY = "�ʴ�/��� �Ţ���ʡ�÷Ӹ�á���"; // Show / Change the Transaction Key
    var $_PHPSHOP_CHANGE_PASSKEY_FORM = "�ʴ�/��� ���ʼ�ҹ/�Ţ���ʡ�÷Ӹ�á���"; // Show/Change the Password/Transaction Key
    var $_PHPSHOP_TYPE_PASSWORD = "��سһ�͹���ʼ�ҹ"; // Please type in your User Password
    var $_PHPSHOP_CURRENT_PASSWORD = "���ʼ�ҹ"; // Current Password
    var $_PHPSHOP_CURRENT_TRANSACTION_KEY = "�Ţ���ʻѨ�غѹ����Ѻ��÷Ӹ�á���"; // Current Transaction Key
    var $_PHPSHOP_CHANGE_PASSKEY_SUCCESS = "�Ţ���ʡ�÷Ӹ�á������Ѻ�������¹���º��������"; // The Transaction key was successfully changed.
    
    var $_PHPSHOP_PAYMENT_CVV2 = "��ͧ������ʵ�Ǩ�ͺ (CVV2/CVC2/CID)"; // Request/Capture Credit Card Code Value (CVV2/CVC2/CID)
    var $_PHPSHOP_PAYMENT_CVV2_TOOLTIP = "���͡�������Ǩ�ͺ��� CVV2/CVC2/CID (3 ���� 4 ��ѡ����ҹ��ѧ�ѵ��ôԵ , �óպѵ� American Express �������ҹ˹��)?"; // Check for a valid CVV2/CVC2/CID value (three- or four-digit number on the back of a credit card, on the Front of American Express Cards)?
    var $_PHPSHOP_CUSTOMER_CVV2_TOOLTIP = "�ô�к�����Ţ 3 ���� 4 ��ѡ������躹��ҹ��ѧ�ѵ��ôԵ�ͧ��ҹ (�óպѵ� American Express �������ҹ˹��)"; // Please type in the three- or four-digit number on the back of your credit card (On the Front of American Express Cards)
    var $_PHPSHOP_CUSTOMER_CVV2_ERROR = "��ͧ��������Ţ�ѵ��ôԵ���ʹ��Թ���"; // You need to enter your Credit Card Code to proceed.
    
    var $_PHPSHOP_PRODUCT_FORM_FILENAME = "�кت������"; // EITHER Fill in a Filename
    var $_PHPSHOP_PRODUCT_FORM_FILENAME_TOOLTIP = "�����˵�: <strong>����кت������᷹���͡��� ������ա���Ѿ��Ŵ��� ��ͧ�ӡ���Ѿ��Ŵ����ͧ ���� FTP!</strong>."; // NOTE: Here you can fill in a FileName. <strong>If you fill in a Filename here, no Files will be uploaded!!! You will have to upload it via FTP manually!</strong>.
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD = "�������͡������ͧ����Ѿ��Ŵ"; // OR Upload new File
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD_TOOLTIP = "��ҹ����ö�Ѿ��Ŵ��� ��觨�������Թ��ҷ��Т�� - �������ж١��¹�Ѻ�����������"; // You can upload a local file. This file will be the Product you sell. An existing file will be replaced.
    
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1 = "����ͤ�������ͧ����ʴ�����١��� �˹���ʴ��Թ���<br />��: 24��., 48 �������, 3 - 5 �ѹ, ���������ҧ��èѴ��....."; // Fill in any text here that will be displayed to the customer on the product flypage.<br />e.g.: 24h, 48 hours, 3 - 5 days, On Order.....
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2 = "�������͡�ٻ�Ҿ����ͧ�������ʴ��˹����������´�Թ���<br />�ٻ�Ҿ���������ä����� <i>/components/com_phpshop/shop_image/availability</i><br />"; // OR select an Image to be displayed on the Details Page (flypage).<br />The images reside in the directory <i>/components/com_phpshop/shop_image/availability</i><br />
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST = "�س�ѡɳ�"; // Attribute List
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES = "<h4>������ҧ�ٻẺ��á�˹��س�ѡɳ�:</h4><span class=\"sectionname\"><strong>��Ҵ</strong>,XL[+1.99],M,S[-2.99]<strong>;��</strong>,ᴧ,����,����ͧ,�վ����[=24.00]<strong>;����</strong>,..,..</span><h4>�Ըյ�駤���Ҥ�����Ѻ�Թ��ҷ���դس�ѡɳ��������:</h4><span class=\"sectionname\"><strong>&#43;</strong> == �����ҤҨҡ�Ҥ��Թ��ҷ�������<br /><strong>&#45;</strong> == Ŵ�Ҥ�ŧ�ҡ�Ҥ��Թ��ҷ�������<br /><strong>&#61;</strong> == ����Ҥ��Թ�����ҡѺ�Ҥҷ���˹�</span>"; // <h4>Examples for the Attribute List Format:</h4><span class=\"sectionname\"><strong>Size</strong>,XL[+1.99],M,S[-2.99]<strong>;Colour</strong>,Red,Green,Yellow,ExpensiveColor[=24.00]<strong>;AndSoOn</strong>,..,..</span><h4>Inline price adjustments for using the Advanced Attributes modification:</h4><span class=\"sectionname\"><strong>&#43;</strong> == Add this amount to the configured price.<br /><strong>&#45;</strong> == Subtract this amount from the configured price.<br /><strong>&#61;</strong> == Set the product's price to this amount.</span>
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST = "��˹��س�ѡɳ�����"; // Custom Attribute List
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES = "<h4>������ҧ�ٻẺ��á�˹��س�ѡɳ�����:</h4><span class=\"sectionname\"><strong>Name;Extras;</strong>...</span>"; // <h4>Examples for the Custom attribute List Format:</h4><span class=\"sectionname\"><strong>Name;Extras;</strong>...</span>

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
