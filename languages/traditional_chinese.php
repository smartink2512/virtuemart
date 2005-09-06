<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: traditional_chinese.php,v 1.3 2005/06/22 19:50:45 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage languages
*
* @copyright (C) 2005 which
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
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
    
    var $_PHPSHOP_MENU = "選單";
    var $_PHPSHOP_CATEGORY = "類別";
    var $_PHPSHOP_CATEGORIES = "類別";
    var $_PHPSHOP_SELECT_CATEGORY = "選擇一個目錄:";    
    var $_PHPSHOP_ADMIN = "管理";
    var $_PHPSHOP_PRODUCT = "商品";
    var $_PHPSHOP_LIST = "列表";
    var $_PHPSHOP_ALL = "所有";
    var $_PHPSHOP_LIST_ALL_PRODUCTS = "列出所有商品";    
    var $_PHPSHOP_VIEW = "查看";
    var $_PHPSHOP_SHOW = "顯示";
    var $_PHPSHOP_ADD = "增加";
    var $_PHPSHOP_UPDATE = "更新";
    var $_PHPSHOP_DELETE = "刪除";
    var $_PHPSHOP_SELECT = "選擇";
    var $_PHPSHOP_SUBMIT = "Submit";
    var $_PHPSHOP_RANDOM = "隨機商品";
    var $_PHPSHOP_LATEST = "最新商品";

    /*#####################
    MODULE ACCOUNT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_HOME_TITLE = "首頁";
    var $_PHPSHOP_CART_TITLE = "購物車";
    var $_PHPSHOP_CHECKOUT_TITLE = "結帳";
    var $_PHPSHOP_LOGIN_TITLE = "登入";
    var $_PHPSHOP_LOGOUT_TITLE = "登出";
    var $_PHPSHOP_BROWSE_TITLE = "瀏覽";
    var $_PHPSHOP_SEARCH_TITLE = "搜尋";
    var $_PHPSHOP_ACCOUNT_TITLE = "帳號維護";
    var $_PHPSHOP_NAVIGATION_TITLE = "導航";
    var $_PHPSHOP_DEPARTMENT_TITLE = "部門";
    var $_PHPSHOP_INFO = "資訊";
    
    var $_PHPSHOP_BROWSE_LBL = "瀏覽";
    var $_PHPSHOP_PRODUCTS_LBL = "商品";
    var $_PHPSHOP_PRODUCT_LBL = "商品";
    var $_PHPSHOP_SEARCH_LBL = "搜尋";
    var $_PHPSHOP_FLYPAGE_LBL = "商品細節";
    var $_PHPSHOP_PRODUCT_SEARCH_LBL = "商品搜尋";
    
    var $_PHPSHOP_PRODUCT_NAME_TITLE = "商品名稱";
    var $_PHPSHOP_PRODUCT_CATEGORY_TITLE = "商品類別";
    var $_PHPSHOP_PRODUCT_DESC_TITLE = "描述";
    
    var $_PHPSHOP_CART_SHOW = "顯示購物車";
    var $_PHPSHOP_CART_ADD_TO = "加進購物車";
    var $_PHPSHOP_CART_NAME = "商品名";
    var $_PHPSHOP_CART_SKU = "庫存料號";
    var $_PHPSHOP_CART_PRICE = "價格";
    var $_PHPSHOP_CART_QUANTITY = "數量";
    var $_PHPSHOP_CART_SUBTOTAL = "小計";
    
    # Some messages
    var $_PHPSHOP_ADD_SHIPTO_1 = "增加新的";
    var $_PHPSHOP_ADD_SHIPTO_2 = "送貨地址";
    var $_PHPSHOP_NO_SEARCH_RESULT = "沒有找到您所查詢的產品。<br />";
    var $_PHPSHOP_PRICE_LABEL = "價格: ";
    var $_PHPSHOP_ORDER_BUTTON_LABEL = "加進購物車";
    var $_PHPSHOP_NO_CUSTOMER = "您還沒有註冊成為會員。請提供您的支付資訊。";
    var $_PHPSHOP_DELETE_MSG = "你確認要刪除此記錄嗎?";
    var $_PHPSHOP_THANKYOU = "感謝您的訂購.";
    var $_PHPSHOP_NOT_SHIPPED = "還未送貨";
    var $_PHPSHOP_EMAIL_SENDTO = "一封確認郵件已寄往";
    var $_PHPSHOP_NO_USER_TO_SELECT = "抱歉, MAMBO系統中還沒有會員能讓您加入到商店的會員列表中";
    
    // Error messages
    
    var $_PHPSHOP_ERROR = "錯誤";
    var $_PHPSHOP_MOD_NOT_REG = "模組未註冊。";
    var $_PHPSHOP_MOD_ISNO_REG = "不是正確的 phpshop 模組。";
    var $_PHPSHOP_MOD_NO_AUTH = "您沒有權限存取此要求的模組。";
    var $_PHPSHOP_PAGE_404_1 = "頁面不存在";
    var $_PHPSHOP_PAGE_404_2 = "提供的檔名不存在，無法找到檔案:";
    var $_PHPSHOP_PAGE_403 = "不足的進入許可權";
    var $_PHPSHOP_FUNC_NO_EXEC = "您無權限執行";
    var $_PHPSHOP_FUNC_NOT_REG = "此功能尚未註冊";
    var $_PHPSHOP_FUNC_ISNO_REG = "不是正確的  MOS_com_phpshop 功能。";
    
    /*#####################
    MODULE ADMIN
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADMIN_MOD = "管理";
    
    
    // User List
    var $_PHPSHOP_USER_LIST_MNU = "列出會員";
    var $_PHPSHOP_USER_LIST_LBL = "會員列表";
    var $_PHPSHOP_USER_LIST_USERNAME = "會員名稱";
    var $_PHPSHOP_USER_LIST_FULL_NAME = "姓名";
    var $_PHPSHOP_USER_LIST_GROUP = "群組";
    
    // User Form
    var $_PHPSHOP_USER_FORM_MNU = "增加會員";
    var $_PHPSHOP_USER_FORM_LBL = "增加/更新 會員資訊";
    var $_PHPSHOP_USER_FORM_BILLTO_LBL = "付款資訊";
    var $_PHPSHOP_USER_FORM_SHIPTO_LBL = "送貨地址";
    var $_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL = "增加地址";
    var $_PHPSHOP_USER_FORM_ADDRESS_LABEL = "地址別名";
    var $_PHPSHOP_USER_FORM_FIRST_NAME = "名";
    var $_PHPSHOP_USER_FORM_LAST_NAME = "姓";
    var $_PHPSHOP_USER_FORM_MIDDLE_NAME = "中名";
    var $_PHPSHOP_USER_FORM_TITLE = "稱呼";
    var $_PHPSHOP_USER_FORM_USERNAME = "會員名稱";
    var $_PHPSHOP_USER_FORM_PASSWORD_1 = "密碼";
    var $_PHPSHOP_USER_FORM_PASSWORD_2 = "密碼確認";
    var $_PHPSHOP_USER_FORM_PERMS = "許可權";
    var $_PHPSHOP_USER_FORM_COMPANY_NAME = "公司名";
    var $_PHPSHOP_USER_FORM_ADDRESS_1 = "地址 1";
    var $_PHPSHOP_USER_FORM_ADDRESS_2 = "地址 2";
    var $_PHPSHOP_USER_FORM_CITY = "城市";
    var $_PHPSHOP_USER_FORM_STATE = "省份/地區";
    var $_PHPSHOP_USER_FORM_ZIP = "郵遞區號";
    var $_PHPSHOP_USER_FORM_COUNTRY = "國家";
    var $_PHPSHOP_USER_FORM_PHONE = "電話";
    var $_PHPSHOP_USER_FORM_FAX = "傳真";
    var $_PHPSHOP_USER_FORM_EMAIL = "Email";
    
    // Module List
    var $_PHPSHOP_MODULE_LIST_MNU = "列出模組";
    var $_PHPSHOP_MODULE_LIST_LBL = "模組清單";
    var $_PHPSHOP_MODULE_LIST_NAME = "模組名";
    var $_PHPSHOP_MODULE_LIST_PERMS = "模組參數";
    var $_PHPSHOP_MODULE_LIST_FUNCTIONS = "函數";
    var $_PHPSHOP_MODULE_LIST_ORDER = "列出訂單";
    
    // Module Form
    var $_PHPSHOP_MODULE_FORM_MNU = "增加模組";
    var $_PHPSHOP_MODULE_FORM_LBL = "模組資訊";
    var $_PHPSHOP_MODULE_FORM_MODULE_LABEL = "模組標題(用於上方選單)";
    var $_PHPSHOP_MODULE_FORM_NAME = "模組名";
    var $_PHPSHOP_MODULE_FORM_PERMS = "模組參數";
    var $_PHPSHOP_MODULE_FORM_HEADER = "模組 header";
    var $_PHPSHOP_MODULE_FORM_FOOTER = "模組 footer";
    var $_PHPSHOP_MODULE_FORM_MENU = "在管理功能表中顯示模組?";
    var $_PHPSHOP_MODULE_FORM_ORDER = "顯示順序";
    var $_PHPSHOP_MODULE_FORM_DESCRIPTION = "模組描述";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_CODE = "語言編碼";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_file = "語言檔案";
    
    // Function List
    var $_PHPSHOP_FUNCTION_LIST_MNU = "顯示函數表";
    var $_PHPSHOP_FUNCTION_LIST_LBL = "函數列表";
    var $_PHPSHOP_FUNCTION_LIST_NAME = "函數名稱";
    var $_PHPSHOP_FUNCTION_LIST_CLASS = "class 名稱";
    var $_PHPSHOP_FUNCTION_LIST_METHOD = "class 方法";
    var $_PHPSHOP_FUNCTION_LIST_PERMS = "參數";
    
    // Module Form
    var $_PHPSHOP_FUNCTION_FORM_MNU = "增加函數";
    var $_PHPSHOP_FUNCTION_FORM_LBL = "函數資訊";
    var $_PHPSHOP_FUNCTION_FORM_NAME = "函數名稱";
    var $_PHPSHOP_FUNCTION_FORM_CLASS = "class名稱";
    var $_PHPSHOP_FUNCTION_FORM_METHOD = "class方法";
    var $_PHPSHOP_FUNCTION_FORM_PERMS = "函數參數";
    var $_PHPSHOP_FUNCTION_FORM_DESCRIPTION = "函數描述";
    
    // Currency form and list
    var $_PHPSHOP_CURRENCY_LIST_MNU = "列出貨幣";
    var $_PHPSHOP_CURRENCY_LIST_LBL = "貨幣列表";
    var $_PHPSHOP_CURRENCY_LIST_ADD = "增加貨幣";
    var $_PHPSHOP_CURRENCY_LIST_NAME = "貨幣名稱";
    var $_PHPSHOP_CURRENCY_LIST_CODE = "貨幣代碼";
    
    // Country form and list
    var $_PHPSHOP_COUNTRY_LIST_MNU = "列出國家";
    var $_PHPSHOP_COUNTRY_LIST_LBL = "國家列表";
    var $_PHPSHOP_COUNTRY_LIST_ADD = "增加國家";
    var $_PHPSHOP_COUNTRY_LIST_NAME = "國名";
    var $_PHPSHOP_COUNTRY_LIST_3_CODE = "國家代碼(3)";
    var $_PHPSHOP_COUNTRY_LIST_2_CODE = "國家代碼(2)";
    
    // State form and list
    var $_PHPSHOP_STATE_LIST_MNU = "列出州名";
    var $_PHPSHOP_STATE_LIST_LBL = "州名清單給: ";
    var $_PHPSHOP_STATE_LIST_ADD = "增加/更新一個州";
    var $_PHPSHOP_STATE_LIST_NAME = "州名";
    var $_PHPSHOP_STATE_LIST_3_CODE = "州碼 (3)";
    var $_PHPSHOP_STATE_LIST_2_CODE = "州碼 (2)";
    
    /*#####################
    MODULE CHECKOUT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADDRESS = "地址";
    var $_PHPSHOP_CONTINUE = "繼續";
    
    # Some messages
    var $_PHPSHOP_EMPTY_CART = "你的購物車現在還是空的。";
    
    
    /*#####################
    MODULE ISShipping
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ISSHIPPING_MOD = "InterShipper";
    
    
    // Shipping Ping
    var $_PHPSHOP_ISSHIP_PING_MNU = "Ping InterShipper 伺服器";
    var $_PHPSHOP_ISSHIP_PING_LBL = "InterShipper-Server Ping ";
    var $_PHPSHOP_ISSHIP_PING_ERROR_LBL = "InterShipper Ping 失敗 ";
    var $_PHPSHOP_ISSHIP_PING_GOOD_LBL = "InterShipper Ping 成功 ";
    var $_PHPSHOP_ISSHIP_PING_CARRIER_LBL = "運輸公司";
    var $_PHPSHOP_ISSHIP_PING_RESPONSE_LBL = "回應<br />時間";
    var $_PHPSHOP_ISSHIP_PING_TIME_LBL = "秒";
    
    // Shipping List
    var $_PHPSHOP_ISSHIP_LIST_MNU = "列出送貨方式";
    var $_PHPSHOP_ISSHIP_LIST_LBL = "啟用中的送貨方式";
    var $_PHPSHOP_ISSHIP_LIST_CARRIER_LBL = "送貨方式";
    var $_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL = "啟用";
    var $_PHPSHOP_ISSHIP_LIST_RATE_LBL = "手續費";
    var $_PHPSHOP_ISSHIP_LIST_LEAD_LBL = "運輸時間";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_F_LBL = "統一費用";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_P_LBL = "百分比";
    var $_PHPSHOP_ISSHIP_LIST_DAYS_LBL = "天數";
    var $_PHPSHOP_ISSHIP_LIST_HEAVY_LBL = "負荷";
    
    // Dynamic Shipping Form
    var $_PHPSHOP_ISSHIP_FORM_MNU = "配置運送方式";
    var $_PHPSHOP_ISSHIP_FORM_ADD_LBL = "增加運送方式";
    var $_PHPSHOP_ISSHIP_FORM_UPDATE_LBL = "配置運送方式";
    var $_PHPSHOP_ISSHIP_FORM_REFRESH_LBL = "更新";
    var $_PHPSHOP_ISSHIP_FORM_CARRIER_LBL = "運送方式";
    var $_PHPSHOP_ISSHIP_FORM_PUBLISH_LBL = "啟用";
    var $_PHPSHOP_ISSHIP_FORM_HANDLING_LBL = "手續費";
    var $_PHPSHOP_ISSHIP_FORM_LEAD_LBL = "運送時間";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_F_LBL = "統一費用";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_P_LBL = "百分比";
    var $_PHPSHOP_ISSHIP_FORM_DAYS_LBL = "天數";
    var $_PHPSHOP_ISSHIP_FORM_HEAVY_LBL = "負荷";
    
    
    
    /*#####################
    MODULE ORDER
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_ORDER_MOD = "訂單";
    
    // Some menu options 
    var $_PHPSHOP_ORDER_CONFIRM_MNU = "確認訂單";
    var $_PHPSHOP_ORDER_CANCEL_MNU = "取消訂單";
    var $_PHPSHOP_ORDER_PRINT_MNU = "列印訂單";
    var $_PHPSHOP_ORDER_DELETE_MNU = "刪除訂單";
    
    // Order List
    var $_PHPSHOP_ORDER_LIST_MNU = "列出訂單";
    var $_PHPSHOP_ORDER_LIST_LBL = "訂單列表";
    var $_PHPSHOP_ORDER_LIST_ID = "訂單號碼";
    var $_PHPSHOP_ORDER_LIST_CDATE = "訂單日期";
    var $_PHPSHOP_ORDER_LIST_MDATE = "最後修改";
    var $_PHPSHOP_ORDER_LIST_STATUS = "狀態";
    var $_PHPSHOP_ORDER_LIST_TOTAL = "小計";
    var $_PHPSHOP_ORDER_ITEM = "訂購項目";
    
    // Order print
    var $_PHPSHOP_ORDER_PRINT_PO_LBL = "決定購買";
    var $_PHPSHOP_ORDER_PRINT_PO_NUMBER = "訂單號碼";
    var $_PHPSHOP_ORDER_PRINT_PO_DATE = "訂單日期";
    var $_PHPSHOP_ORDER_PRINT_PO_STATUS = "訂單狀態";
    var $_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL = "客戶資訊";
    var $_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL = "付款資訊";
    var $_PHPSHOP_ORDER_PRINT_CUST_SHIPPING_LBL = "送貨資訊";
    var $_PHPSHOP_ORDER_PRINT_BILL_TO_LBL = "付款至";
    var $_PHPSHOP_ORDER_PRINT_SHIP_TO_LBL = "送貨至";
    var $_PHPSHOP_ORDER_PRINT_NAME = "姓名";
    var $_PHPSHOP_ORDER_PRINT_COMPANY = "公司";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_1 = "地址1";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_2 = "地址2";
    var $_PHPSHOP_ORDER_PRINT_CITY = "城市";
    var $_PHPSHOP_ORDER_PRINT_STATE = "省份/地區";
    var $_PHPSHOP_ORDER_PRINT_ZIP = "郵遞區號";
    var $_PHPSHOP_ORDER_PRINT_COUNTRY = "國家";
    var $_PHPSHOP_ORDER_PRINT_PHONE = "電話";
    var $_PHPSHOP_ORDER_PRINT_FAX = "傳真";
    var $_PHPSHOP_ORDER_PRINT_EMAIL = "Email";
    var $_PHPSHOP_ORDER_PRINT_ITEMS_LBL = "訂購項目";
    var $_PHPSHOP_ORDER_PRINT_QUANTITY = "數量";
    var $_PHPSHOP_ORDER_PRINT_QTY = "數量";
    var $_PHPSHOP_ORDER_PRINT_SKU = "庫存料號";
    var $_PHPSHOP_ORDER_PRINT_PRICE = "價格";
    var $_PHPSHOP_ORDER_PRINT_TOTAL = "總計";
    var $_PHPSHOP_ORDER_PRINT_SUBTOTAL = "小計";
    var $_PHPSHOP_ORDER_PRINT_TOTAL_TAX = "稅金總計";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING = "運費加手續費";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_TAX = "貨物稅";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LBL = "付款方式";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NAME = "帳號名";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER = "帳號";
    var $_PHPSHOP_ORDER_PRINT_EXPIRE_DATE = "期滿時間";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL = "付款記錄";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_LBL = "送貨資訊";
    var $_PHPSHOP_ORDER_PRINT_PAYINFO_LBL = "付款資訊";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL = "運送者";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL = "送貨模式";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_DATE_LBL = "送貨日期";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL = "送貨費用";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_MNU = "列出訂單狀態類型";
    var $_PHPSHOP_ORDER_STATUS_FORM_MNU = "增加訂單狀態類型";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_CODE = "訂單狀態代碼";
    var $_PHPSHOP_ORDER_STATUS_LIST_NAME = "訂單狀態名稱";
    
    var $_PHPSHOP_ORDER_STATUS_FORM_LBL = "訂單狀態";
    var $_PHPSHOP_ORDER_STATUS_FORM_CODE = "訂單狀態代碼";
    var $_PHPSHOP_ORDER_STATUS_FORM_NAME = "訂單狀態名稱";
    var $_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER = "列出訂單";
    
    
    /*#####################
    MODULE PRODUCT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_PRODUCT_MOD = "商品";
    
    var $_PHPSHOP_CURRENT_PRODUCT = "目前商品";
    var $_PHPSHOP_CURRENT_ITEM = "目前項目";
    
    // Product Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_LBL = "商品庫存";
    var $_PHPSHOP_PRODUCT_INVENTORY_MNU = "查看庫存";
    var $_PHPSHOP_PRODUCT_INVENTORY_PRICE = "價格";
    var $_PHPSHOP_PRODUCT_INVENTORY_STOCK = "數量";
    var $_PHPSHOP_PRODUCT_INVENTORY_WEIGHT = "重量";
    // Product List
    var $_PHPSHOP_PRODUCT_LIST_MNU = "列出商品";
    var $_PHPSHOP_PRODUCT_LIST_LBL = "商品列表";
    var $_PHPSHOP_PRODUCT_LIST_NAME = "商品名稱";
    var $_PHPSHOP_PRODUCT_LIST_SKU = "庫存料號";
    var $_PHPSHOP_PRODUCT_LIST_PUBLISH = "發佈";
    
    // Product Form
    var $_PHPSHOP_PRODUCT_FORM_MNU = "增加商品";
    var $_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT = "編輯此項商品";
    var $_PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE = "預覽商品介紹頁面";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU = "增加項目";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU = "增加另一個項目";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL = "新增商品";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_PRODUCT_LBL = "更新商品";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL = "商品資訊";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL = "商品狀態";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL = "商品體積和重量";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL = "商品圖片";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL = "新增項目";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL = "更新項目";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL = "項目資訊";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL = "項目狀態";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL = "項目的體積和重量";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL = "項目圖片";
    var $_PHPSHOP_PRODUCT_FORM_RETURN_LBL = "返回上一層商品";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL = "要更新現有圖片，請輸入新圖片的路徑。";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL = "輸入 \"none\" 刪除現有圖片。";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL = "商品項目";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL = "項目屬性";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG = "您確定要刪除相關的商品和項目嗎?";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG = "您確定要刪除此項目嗎?";
    var $_PHPSHOP_PRODUCT_FORM_VENDOR = "零售商";
    var $_PHPSHOP_PRODUCT_FORM_MANUFACTURER = "製造商";
    var $_PHPSHOP_PRODUCT_FORM_SKU = "庫存料號";
    var $_PHPSHOP_PRODUCT_FORM_NAME = "名稱";
    var $_PHPSHOP_PRODUCT_FORM_URL = "URL";
    var $_PHPSHOP_PRODUCT_FORM_CATEGORY = "類別";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_GROSS = "產品價格 (總額)";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_NET = "產品價格 (網路)";
    var $_PHPSHOP_PRODUCT_FORM_DESCRIPTION = "商品描述";
    var $_PHPSHOP_PRODUCT_FORM_S_DESC = "簡短描述";
    var $_PHPSHOP_PRODUCT_FORM_IN_STOCK = "有庫存";
    var $_PHPSHOP_PRODUCT_FORM_ON_ORDER = "已訂購";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE = "有效日期";
    var $_PHPSHOP_PRODUCT_FORM_SPECIAL = "特價中";
    var $_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE = "折扣類型";
    var $_PHPSHOP_PRODUCT_FORM_PUBLISH = "發佈?";
    var $_PHPSHOP_PRODUCT_FORM_LENGTH = "長";
    var $_PHPSHOP_PRODUCT_FORM_WIDTH = "寬";
    var $_PHPSHOP_PRODUCT_FORM_HEIGHT = "高";
    var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM = "計量單位";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT = "重量";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM = "計量單位";
    var $_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE = "縮圖";
    var $_PHPSHOP_PRODUCT_FORM_FULL_IMAGE = "完整圖片";
    
    // Product Display
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL = "商品新增結果";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL = "商品更新結果";
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL = "項目增加結果";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL = "項目更新結果";
    var $_PHPSHOP_PRODUCT_CSV_UPLOAD = "使用CSV上傳";
    var $_PHPSHOP_PRODUCT_FOLDERS = "商品檔案夾";
    
    // Product Category List
    var $_PHPSHOP_CATEGORY_LIST_MNU = "列出類別";
    var $_PHPSHOP_CATEGORY_LIST_LBL = "類別樹";
    
    // Product Category Form
    var $_PHPSHOP_CATEGORY_FORM_MNU = "增加類別";
    var $_PHPSHOP_CATEGORY_FORM_LBL = "類別資訊";
    var $_PHPSHOP_CATEGORY_FORM_NAME = "類別名稱";
    var $_PHPSHOP_CATEGORY_FORM_PARENT = "父類別";
    var $_PHPSHOP_CATEGORY_FORM_DESCRIPTION = "類別描述";
    var $_PHPSHOP_CATEGORY_FORM_PUBLISH = "發佈?";
    var $_PHPSHOP_CATEGORY_FORM_FLYPAGE = "類別頁面";
    
    // Product Attribute List
    var $_PHPSHOP_ATTRIBUTE_LIST_MNU = "列出屬性";
    var $_PHPSHOP_ATTRIBUTE_LIST_LBL = "屬性清單給";
    var $_PHPSHOP_ATTRIBUTE_LIST_NAME = "屬性名稱";
    var $_PHPSHOP_ATTRIBUTE_LIST_ORDER = "列出訂購";
    
    // Product Attribute Form
    var $_PHPSHOP_ATTRIBUTE_FORM_MNU = "增加屬性";
    var $_PHPSHOP_ATTRIBUTE_FORM_LBL = "屬性表格";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT = "為商品增加新的屬性";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT = "更新商品屬性";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM = "新建項目屬性";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM = "更新物品屬性";
    var $_PHPSHOP_ATTRIBUTE_FORM_NAME = "屬性名稱";
    var $_PHPSHOP_ATTRIBUTE_FORM_ORDER = "列出訂購";
    
    // Product Price List
    var $_PHPSHOP_PRICE_LIST_MNU = "列出類別";
    var $_PHPSHOP_PRICE_LIST_LBL = "價格樹";
    var $_PHPSHOP_PRICE_LIST_FOR_LBL = "價格給";
    var $_PHPSHOP_PRICE_LIST_GROUP_NAME = "群組名稱";
    var $_PHPSHOP_PRICE_LIST_PRICE = "價格";
    var $_PHPSHOP_PRODUCT_LIST_CURRENCY = "貨幣";
    
    // Product Price Form
    var $_PHPSHOP_PRICE_FORM_MNU = "增加價格";
    var $_PHPSHOP_PRICE_FORM_LBL = "價格資訊";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT = "新建商品價格";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT = "更新商品價格";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_ITEM = "新價格給項目";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM = "更新項目價格";
    var $_PHPSHOP_PRICE_FORM_PRICE = "價格";
    var $_PHPSHOP_PRICE_FORM_CURRENCY = "貨幣";
    var $_PHPSHOP_PRICE_FORM_GROUP = "購物群組";
    
    
    /*#####################
    MODULE REPORT BASIC
    #####################*/
    # Some LABELs
    var $_PHPSHOP_REPORTBASIC_MOD = "報告";
    var $_PHPSHOP_RB_INDIVIDUAL = "個別產品列表";
    var $_PHPSHOP_RB_SALE_TITLE = "銷售報告";
    
    /* labels for rpt_sales */
    var $_PHPSHOP_RB_SALES_PAGE_TITLE = "銷售活動一覽";
    
    var $_PHPSHOP_RB_INTERVAL_TITLE = "設置間隔";
    var $_PHPSHOP_RB_INTERVAL_MONTHLY_TITLE = "每月";
    var $_PHPSHOP_RB_INTERVAL_WEEKLY_TITLE = "每週";
    var $_PHPSHOP_RB_INTERVAL_DAILY_TITLE = "每天";
    
    var $_PHPSHOP_RB_THISMONTH_BUTTON = "本月";
    var $_PHPSHOP_RB_LASTMONTH_BUTTON = "上個月";
    var $_PHPSHOP_RB_LAST60_BUTTON = "最近60天";
    var $_PHPSHOP_RB_LAST90_BUTTON = "最近90天";
    
    var $_PHPSHOP_RB_START_DATE_TITLE = "開始於";
    var $_PHPSHOP_RB_END_DATE_TITLE = "結束於";
    var $_PHPSHOP_RB_SHOW_SEL_RANGE = "顯示所選擇的範圍";
    var $_PHPSHOP_RB_REPORT_FOR = "報告給 ";
    var $_PHPSHOP_RB_DATE = "日期";
    var $_PHPSHOP_RB_ORDERS = "訂單";
    var $_PHPSHOP_RB_TOTAL_ITEMS = "全部賣出項目";
    var $_PHPSHOP_RB_REVENUE = "收入";
    var $_PHPSHOP_RB_PRODLIST = "商品列表";
    
    
    
    /*#####################
    MODULE SHOP
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOP_MOD = "商店";
    var $_PHPSHOP_PRODUCT_THUMB_TITLE = "圖片";
    var $_PHPSHOP_PRODUCT_PRICE_TITLE = "價格";
    var $_PHPSHOP_ORDER_STATUS_P = "等待中";
    var $_PHPSHOP_ORDER_STATUS_C = "已確認";
    var $_PHPSHOP_ORDER_STATUS_X = "已取消";
    
    
    # Some messages
    var $_PHPSHOP_ORDER_BUTTON = "訂購";
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOPPER_MOD = "顧客";
    
    
    
    // Shopper List
    var $_PHPSHOP_SHOPPER_LIST_MNU = "列出顧客";
    var $_PHPSHOP_SHOPPER_LIST_LBL = "顧客列表";
    var $_PHPSHOP_SHOPPER_LIST_USERNAME = "會員名";
    var $_PHPSHOP_SHOPPER_LIST_NAME = "全名";
    var $_PHPSHOP_SHOPPER_LIST_GROUP = "群組";
    
    // Shopper Form
    var $_PHPSHOP_SHOPPER_FORM_MNU = "增加顧客";
    var $_PHPSHOP_SHOPPER_FORM_LBL = "顧客資訊";
    var $_PHPSHOP_SHOPPER_FORM_BILLTO_LBL = "付款資訊";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL = "資訊";
    var $_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL = "送貨資訊";
    var $_PHPSHOP_SHOPPER_FORM_ADD_SHIPTO_LBL = "增加地址";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL = "地址別名";
    var $_PHPSHOP_SHOPPER_FORM_USERNAME = "用戶名";
    var $_PHPSHOP_SHOPPER_FORM_FIRST_NAME = "名";
    var $_PHPSHOP_SHOPPER_FORM_LAST_NAME = "姓";
    var $_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME = "中名";
    var $_PHPSHOP_SHOPPER_FORM_TITLE = "稱呼";
    var $_PHPSHOP_SHOPPER_FORM_SHOPPERNAME = "顧客名稱";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_1 = "密碼";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_2 = "確認密碼";
    var $_PHPSHOP_SHOPPER_FORM_GROUP = "顧客群組";
    var $_PHPSHOP_SHOPPER_FORM_COMPANY_NAME = "公司名稱";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_1 = "地址1";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_2 = "地址2";
    var $_PHPSHOP_SHOPPER_FORM_CITY = "城市";
    var $_PHPSHOP_SHOPPER_FORM_STATE = "省份/地區";
    var $_PHPSHOP_SHOPPER_FORM_ZIP = "郵遞區號";
    var $_PHPSHOP_SHOPPER_FORM_COUNTRY = "國家";
    var $_PHPSHOP_SHOPPER_FORM_PHONE = "電話";
    var $_PHPSHOP_SHOPPER_FORM_FAX = "傳真";
    var $_PHPSHOP_SHOPPER_FORM_EMAIL = "Email";
    
    // Shopper Group List
    var $_PHPSHOP_SHOPPER_GROUP_LIST_MNU = "列出顧客群組";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_LBL = "顧客群組列表";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_NAME = "群組名稱";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION = "群組描述";
    
    
    // Shopper Group Form
    var $_PHPSHOP_SHOPPER_GROUP_FORM_LBL = "顧客群組表單";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_MNU = "增加顧客群組";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_NAME = "群組名稱";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DESC = "群組描述";
    
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_STORE_MOD = "商店";
    
    
    // Store Form
    var $_PHPSHOP_STORE_FORM_MNU = "編輯商店";
    var $_PHPSHOP_STORE_FORM_LBL = "商店資訊";
    var $_PHPSHOP_STORE_FORM_CONTACT_LBL = "聯絡資訊";
    var $_PHPSHOP_STORE_FORM_FULL_IMAGE = "完整圖片";
    var $_PHPSHOP_STORE_FORM_UPLOAD = "上傳圖片";
    var $_PHPSHOP_STORE_FORM_STORE_NAME = "商店名稱";
    var $_PHPSHOP_STORE_FORM_COMPANY_NAME = "商店公司名稱";
    var $_PHPSHOP_STORE_FORM_ADDRESS_1 = "地址1";
    var $_PHPSHOP_STORE_FORM_ADDRESS_2 = "地址2";
    var $_PHPSHOP_STORE_FORM_CITY = "城市";
    var $_PHPSHOP_STORE_FORM_STATE = "省份/地區";
    var $_PHPSHOP_STORE_FORM_COUNTRY = "國家";
    var $_PHPSHOP_STORE_FORM_ZIP = "郵遞區號";
    var $_PHPSHOP_STORE_FORM_PHONE = "電話";
    var $_PHPSHOP_STORE_FORM_CURRENCY = "貨幣";
    var $_PHPSHOP_STORE_FORM_CATEGORY = "商店類別";
    var $_PHPSHOP_STORE_FORM_LAST_NAME = "名";
    var $_PHPSHOP_STORE_FORM_FIRST_NAME = "姓";
    var $_PHPSHOP_STORE_FORM_MIDDLE_NAME = "中名";
    var $_PHPSHOP_STORE_FORM_TITLE = "稱呼";
    var $_PHPSHOP_STORE_FORM_PHONE_1 = "電話 1";
    var $_PHPSHOP_STORE_FORM_PHONE_2 = "電話 2";
    var $_PHPSHOP_STORE_FORM_FAX = "傳真";
    var $_PHPSHOP_STORE_FORM_EMAIL = "Email";
    var $_PHPSHOP_STORE_FORM_IMAGE_PATH = "圖片路徑";
    var $_PHPSHOP_STORE_FORM_DESCRIPTION = "描述";
    
    
    
    var $_PHPSHOP_PAYMENT = "付款";
    // Payment Method List
    var $_PHPSHOP_PAYMENT_METHOD_LIST_MNU = "列出付款方式";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_LBL = "付款方式列表";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_NAME = "名稱";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_CODE = "代碼";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT = "折扣";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP = "顧客群組";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR = "付款方式類型";
    
    // Payment Method Form
    var $_PHPSHOP_PAYMENT_METHOD_FORM_MNU = "增加付款方式";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LBL = "付款方式表單";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_NAME = "付款方式名稱";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP = "顧客群組";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT = "折扣";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_CODE = "代碼";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER = "排列順序";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR = "付款方式類型";
    
    
    
    /*#####################
    MODULE TAX
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_TAX_MOD = "稅金";
    
    // User List
    var $_PHPSHOP_TAX_RATE = "稅率";
    var $_PHPSHOP_TAX_LIST_MNU = "列出稅率";
    var $_PHPSHOP_TAX_LIST_LBL = "稅率列表";
    var $_PHPSHOP_TAX_LIST_STATE = "省份或地區稅金";
    var $_PHPSHOP_TAX_LIST_COUNTRY = "國家稅金";
    var $_PHPSHOP_TAX_LIST_RATE = "稅率";
    
    // User Form
    var $_PHPSHOP_TAX_FORM_MNU = "增加稅率";
    var $_PHPSHOP_TAX_FORM_LBL = "增加稅金資訊";
    var $_PHPSHOP_TAX_FORM_STATE = "省份或地方稅";
    var $_PHPSHOP_TAX_FORM_COUNTRY = "中央稅";
    var $_PHPSHOP_TAX_FORM_RATE = "稅率 ( 16% => 填入 0.16 )";
    
    
    
    
    /*#####################
    MODULE VENDOR
    #####################*/
    
    
    
    # Some LABELs
    var $_PHPSHOP_VENDOR_MOD = "零售商";
    var $_PHPSHOP_VENDOR_ADMIN = "零售商";
    
    
    // Vendor List
    var $_PHPSHOP_VENDOR_LIST_MNU = "列出零售商";
    var $_PHPSHOP_VENDOR_LIST_LBL = "零售商列表";
    var $_PHPSHOP_VENDOR_LIST_VENDOR_NAME = "零售商名稱";
    var $_PHPSHOP_VENDOR_LIST_ADMIN = "管理";
    
    // Vendor Form
    var $_PHPSHOP_VENDOR_FORM_MNU = "增加零售商";
    var $_PHPSHOP_VENDOR_FORM_LBL = "增加資訊";
    var $_PHPSHOP_VENDOR_FORM_INFO_LBL = "零售商資訊";
    var $_PHPSHOP_VENDOR_FORM_CONTACT_LBL = "聯絡資訊";
    var $_PHPSHOP_VENDOR_FORM_FULL_IMAGE = "完整圖片";
    var $_PHPSHOP_VENDOR_FORM_UPLOAD = "上傳圖片";
    var $_PHPSHOP_VENDOR_FORM_STORE_NAME = "零售商商店名稱";
    var $_PHPSHOP_VENDOR_FORM_COMPANY_NAME = "零售商公司名稱";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_1 = "地址 1";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_2 = "地址 2";
    var $_PHPSHOP_VENDOR_FORM_CITY = "城市";
    var $_PHPSHOP_VENDOR_FORM_STATE = "省份/地區";
    var $_PHPSHOP_VENDOR_FORM_COUNTRY = "國家";
    var $_PHPSHOP_VENDOR_FORM_ZIP = "郵遞區號";
    var $_PHPSHOP_VENDOR_FORM_PHONE = "電話";
    var $_PHPSHOP_VENDOR_FORM_CURRENCY = "貨幣";
    var $_PHPSHOP_VENDOR_FORM_CATEGORY = "零售商分類";
    var $_PHPSHOP_VENDOR_FORM_LAST_NAME = "名";
    var $_PHPSHOP_VENDOR_FORM_FIRST_NAME = "姓";
    var $_PHPSHOP_VENDOR_FORM_MIDDLE_NAME = "中間名";
    var $_PHPSHOP_VENDOR_FORM_TITLE = "職稱";
    var $_PHPSHOP_VENDOR_FORM_PHONE_1 = "電話 1";
    var $_PHPSHOP_VENDOR_FORM_PHONE_2 = "電話 2";
    var $_PHPSHOP_VENDOR_FORM_FAX = "傳真";
    var $_PHPSHOP_VENDOR_FORM_EMAIL = "Email";
    var $_PHPSHOP_VENDOR_FORM_IMAGE_PATH = "圖片路徑";
    var $_PHPSHOP_VENDOR_FORM_DESCRIPTION = "描述";
    
    
    // Vendor Category List
    var $_PHPSHOP_VENDOR_CAT_LIST_MNU = "列出零售商類別";
    var $_PHPSHOP_VENDOR_CAT_LIST_LBL = "零售商類別列表";
    var $_PHPSHOP_VENDOR_CAT_NAME = "類別名稱";
    var $_PHPSHOP_VENDOR_CAT_DESCRIPTION = "類別描述";
    var $_PHPSHOP_VENDOR_CAT_VENDORS = "零售商";

    // Vendor Category Form
    var $_PHPSHOP_VENDOR_CAT_FORM_MNU = "增加零售商類別";
    var $_PHPSHOP_VENDOR_CAT_FORM_LBL = "零售商類別表單";
    var $_PHPSHOP_VENDOR_CAT_FORM_INFO_LBL = "類別資訊";
    var $_PHPSHOP_VENDOR_CAT_FORM_NAME = "類別名稱";
    var $_PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION = "類別描述";
    
    /*#####################
    MODULE MANUFACTURER
    #####################*/

    # Some LABELs
    var $_PHPSHOP_MANUFACTURER_MOD = "製造商";
    var $_PHPSHOP_MANUFACTURER_ADMIN = "製造商";
    
    
    // Manufacturer List
    var $_PHPSHOP_MANUFACTURER_LIST_MNU = "列出製造商";
    var $_PHPSHOP_MANUFACTURER_LIST_LBL = "製造商列表";
    var $_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME = "製造商名稱";
    var $_PHPSHOP_MANUFACTURER_LIST_ADMIN = "管理";
    
    // Manufacturer Form
    var $_PHPSHOP_MANUFACTURER_FORM_MNU = "增加製造商";
    var $_PHPSHOP_MANUFACTURER_FORM_LBL = "增加資訊";
    var $_PHPSHOP_MANUFACTURER_FORM_INFO_LBL = "製造商資訊";
    var $_PHPSHOP_MANUFACTURER_FORM_NAME = "製造商名稱";
    var $_PHPSHOP_MANUFACTURER_FORM_CATEGORY = "製造商類別";
    var $_PHPSHOP_MANUFACTURER_FORM_EMAIL = "Email";
    var $_PHPSHOP_MANUFACTURER_FORM_URL = "製造商網址";
    var $_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION = "說明";
        

    // Manufacturer Category List
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_MNU = "列出製造商類別";
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_LBL = "製造商類別列表";
    var $_PHPSHOP_MANUFACTURER_CAT_NAME = "類別名稱";
    var $_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION = "類別描述";
    var $_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS = "製造商";
    
    // Manufacturer Category Form
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_MNU = "增加製造商類別";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_LBL = "製造商類別表單";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL = "類別資訊";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_NAME = "類別名稱";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION = "類別描述";
    
    
    /*#####################
    Modul HELP
    #####################*/
    var $_PHPSHOP_HELP_MOD = "求助";

    // 210104 start

    var $_PHPSHOP_CART_ACTION = "更新";
    var $_PHPSHOP_CART_UPDATE = "更新購物車中的數量";
    var $_PHPSHOP_CART_DELETE = "從購物車刪除商品";    

    //shopbrowse form

    var $_PHPSHOP_PRODUCT_PRICETAG = "價格";
    var $_PHPSHOP_PRODUCT_CALL = "電話報價";
    var $_PHPSHOP_PRODUCT_PREVIOUS = "上一個";
    var $_PHPSHOP_PRODUCT_NEXT = "下一個";

    //ro_basket

    var $_PHPSHOP_CART_TAX = "稅金";
    var $_PHPSHOP_CART_SHIPPING = "運費及手續費";
    var $_PHPSHOP_CART_TOTAL = "總額";

    //CHECKOUT.INDEX

    var $_PHPSHOP_CHECKOUT_NEXT = "下一個";
    var $_PHPSHOP_CHECKOUT_REGISTER = "註冊";

    //CHECKOUT.CONFIRM

    var $_PHPSHOP_CHECKOUT_CONF_BILLINFO = "付款資訊";
    var $_PHPSHOP_CHECKOUT_CONF_COMPANY = "公司";
    var $_PHPSHOP_CHECKOUT_CONF_NAME = "姓名";
    var $_PHPSHOP_CHECKOUT_CONF_ADDRESS = "地址";
    var $_PHPSHOP_CHECKOUT_CONF_PHONE = "電話";
    var $_PHPSHOP_CHECKOUT_CONF_FAX = "傳真";
    var $_PHPSHOP_CHECKOUT_CONF_EMAIL = "Email";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO = "送貨資訊";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY = "公司";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME = "姓名";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS = "地址";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE = "電話";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX = "傳真";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO = "付款資訊";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD = "信用卡上的姓名";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD = "付款方式";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM = "信用卡號";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE = "到期日期";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER = "完成訂購";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO = "當選用信用卡付款時的必填資訊";


    var $_PHPSHOP_ZONE_MOD = "地區運費";

    var $_PHPSHOP_ZONE_LIST_MNU = "列出地區";
    var $_PHPSHOP_ZONE_FORM_MNU = "增加地區";
    var $_PHPSHOP_ZONE_ASSIGN_MNU = "分配地區";
    
    // assign zone List
    var $_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL = "國家";
    var $_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL = "現有地區";
    var $_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL = "分配到地區";
    var $_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL = "更新";
    var $_PHPSHOP_ASSIGN_ZONE_PG_LBL = "分配地區";
    
    // zone Form
    var $_PHPSHOP_ZONE_FORM_NAME_LBL = "地區名";
    var $_PHPSHOP_ZONE_FORM_DESC_LBL = "地區描述";
    var $_PHPSHOP_ZONE_FORM_COST_PER_LBL = "每件的地區運費";
    var $_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL = "地區費用限額";
    
    // List of zones
    var $_PHPSHOP_ZONE_LIST_LBL = "地區列表";
    var $_PHPSHOP_ZONE_LIST_NAME_LBL = "地區名稱";
    var $_PHPSHOP_ZONE_LIST_DESC_LBL = "地區描述";
    var $_PHPSHOP_ZONE_LIST_COST_PER_LBL = "每個項目的地區運費";
    var $_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL = "地區費用限額";
    
    var $_PHPSHOP_LOGIN_FIRST = "請先登入或註冊.<br>謝謝.";
    var $_PHPSHOP_STORE_FORM_TOS = "服務條款";
    var $_PHPSHOP_AGREE_TO_TOS = "您必須先接受我們的服務條款。";
    var $_PHPSHOP_I_AGREE_TO_TOS = "我同意此服務條款";
    
    var $_PHPSHOP_LEAVE_BLANK = "(如果您沒有個別的PHP檔案給它<br />請留空!)";
    var $_PHPSHOP_RETURN_LOGIN = "已註冊客戶: 請登入";
    var $_PHPSHOP_NEW_CUSTOMER = "新客戶？請提供您的付款資訊";
    var $_PHPSHOP_ACC_CUSTOMER_ACCOUNT = "顧客帳號:";
    var $_PHPSHOP_ACC_ORDER_INFO = "訂購資訊";
    var $_PHPSHOP_ACC_UPD_BILL = "您可以在此更新您的付款資訊.";
    var $_PHPSHOP_ACC_UPD_SHIP = "這裏您可以增加或修改付款地址.";
    var $_PHPSHOP_ACC_ACCOUNT_INFO = "帳戶資訊";
    var $_PHPSHOP_ACC_SHIP_INFO = "送貨資訊";
    var $_PHPSHOP_ACC_NO_ORDERS = "沒有訂單可顯示";
    var $_PHPSHOP_ACC_BILL_DEF = "- 預設 (與付款一致)";
    var $_PHPSHOP_SHIPTO_TEXT = "您可以增加多個送貨地址. 請為您選的送貨地址取一個合適的別名或代碼.";
    var $_PHPSHOP_CONFIG = "配置";
    var $_PHPSHOP_USERS = "會員";
    var $_PHPSHOP_IS_CC_PAYMENT = "是否使用信用卡支付?";
    
    /*#####################################################
     MODULE SHIPPING
    #######################################################*/
    var $_PHPSHOP_SHIPPING_MOD = "運送";
    var $_PHPSHOP_SHIPPING_MENU_LABEL = "運送";
    
    var $_PHPSHOP_CARRIER_LIST_MNU = "運送者";
    var $_PHPSHOP_CARRIER_LIST_LBL = "運送者列表";
    var $_PHPSHOP_RATE_LIST_MNU = "運送費率";
    var $_PHPSHOP_RATE_LIST_LBL = "運送費率列表";
    var $_PHPSHOP_CARRIER_LIST_NAME_LBL = "名稱";
    var $_PHPSHOP_CARRIER_LIST_ORDER_LBL = "列表順序";
    
    var $_PHPSHOP_CARRIER_FORM_MNU = "增加運送者";
    var $_PHPSHOP_CARRIER_FORM_LBL = "增加/編輯 運送者";
    var $_PHPSHOP_RATE_FORM_MNU = "新增運送費率";
    var $_PHPSHOP_RATE_FORM_LBL = "增加/編輯 運送費率";
    
    var $_PHPSHOP_RATE_FORM_NAME = "運送費率說明";
    var $_PHPSHOP_RATE_FORM_CARRIER = "運送者";
    var $_PHPSHOP_RATE_FORM_COUNTRY = "國家";
    var $_PHPSHOP_RATE_FORM_ZIP_START = "郵遞區號起始範圍";
    var $_PHPSHOP_RATE_FORM_ZIP_END = "郵遞區號結束範圍";
    var $_PHPSHOP_RATE_FORM_WEIGHT_START = "最低重量";
    var $_PHPSHOP_RATE_FORM_WEIGHT_END = "最高重量";
    var $_PHPSHOP_RATE_FORM_VALUE = "費用";
    var $_PHPSHOP_RATE_FORM_PACKAGE_FEE = "您的包裹費用";
    var $_PHPSHOP_RATE_FORM_CURRENCY = "貨幣";
    var $_PHPSHOP_RATE_FORM_VAT_ID = "加值稅 ID";
    var $_PHPSHOP_RATE_FORM_LIST_ORDER = "列表順序";
    
    var $_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL = "運送者";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME = "運送費率說明";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART = "重量從 ...";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND = "... 到";
    var $_PHPSHOP_CARRIER_FORM_NAME = "運送公司";
    var $_PHPSHOP_CARRIER_FORM_LIST_ORDER = "列表順序";
    
    var $_PHPSHOP_ERR_MSG_CARRIER_EXIST = "錯誤: 運送者 ID 已存在";
    var $_PHPSHOP_ERR_MSG_CARRIER_ID_REQ = "錯誤: 請選擇一個運送者";
    var $_PHPSHOP_ERR_MSG_CARRIER_INUSE = "錯誤: 至少一個費率存在, 刪除運送者之前請先刪除費率";
    var $_PHPSHOP_ERR_MSG_CARRIER_NOTFOUND = "錯誤: 無法找到該 ID 的運送者";
    
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_REQ = "錯誤: 請選擇一個運送者";
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_INV = "錯誤: 無法找到該 ID 的運送者";
    var $_PHPSHOP_ERR_MSG_RATE_NAME_REQ = "錯誤: 需要費率說明";
    var $_PHPSHOP_ERR_MSG_RATE_COUNTRY_CODE_INV = "錯誤: 到達國家不正確。多個國家可以用\";\"分隔";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_START_REQ = "錯誤: 需要填寫最低重量";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_END_REQ = "錯誤: 需要填寫最高重量";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_STARTEND_INV = "錯誤: 最低重量必須小於最高重量";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_VALUE_REQ = "錯誤: 需要填寫運送費率";
    var $_PHPSHOP_ERR_MSG_RATE_CURRENCY_ID_INV = "錯誤: 請選擇一種貨幣";
    
    var $_PHPSHOP_ERR_MSG_RATE_ID_REQ = "錯誤: 需要填寫運送費率";
    
    var $_PHPSHOP_INFO_MSG_PLEASE_SELECT = "請選擇";
    var $_PHPSHOP_INFO_MSG_CARRIER = "運送者";
    var $_PHPSHOP_INFO_MSG_SHIPPING_METHOD = "運送費率";
    var $_PHPSHOP_INFO_MSG_SHIPPING_PRICE = "價格";
    var $_PHPSHOP_INFO_MSG_VAT_ZERO_LBL = "0 (-無-)";
    /*#####################################################
     END: MODULE SHIPPING
    #######################################################*/
    
    var $_PHPSHOP_PAYMENT_FORM_CC = "信用卡";
    var $_PHPSHOP_PAYMENT_FORM_USE_PP = "使用支付處理程序";
    var $_PHPSHOP_PAYMENT_FORM_BANK_DEBIT = "銀行匯款";
    var $_PHPSHOP_PAYMENT_FORM_AO = "只需地址/貨到付款";
    var $_PHPSHOP_CHECKOUT_MSG_2 = "請選擇送貨地址!";
    var $_PHPSHOP_CHECKOUT_MSG_3 = "請選擇送貨方式!";
    var $_PHPSHOP_CHECKOUT_MSG_4 = "請選擇付款方式!";
    var $_PHPSHOP_CHECKOUT_MSG_99 = "請查看你所輸入的內容並確定你的訂單";
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIP = "請選擇送貨方式";
    var $_PHPSHOP_CHECKOUT_ERR_OTHER_SHIP = "請選擇其他送貨方式";
    var $_PHPSHOP_CHECKOUT_ERR_NO_PAYM = "請選擇付款方式";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR = "請輸入信用卡號碼";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNAME = "請輸入持卡人姓名.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATE = "信用卡號碼不正確";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCMON = "請輸入信用卡的到期月份";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCYEAR = "請輸入信用卡的到期年份";
    var $_PHPSHOP_CHECKOUT_ERR_CCDATE_INV = "信用卡的到期日期不正確";
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIPTO = "請選擇送貨地址";
    var $_PHPSHOP_CHECKOUT_ERR_CCNUM_INV = "帳戶號碼不正確";
    var $_PHPSHOP_CHECKOUT_ERR_EMPTY_CART = "您的購物車是空的";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CARR = "錯誤: 請選擇運送方式!";
    var $_PHPSHOP_CHECKOUT_ERR_RATE_NOT_FOUND = "錯誤: 沒有找到所選擇的運送費率!";
    var $_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND = "錯誤: 沒有找到您的送貨地址!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATA = "錯誤: 沒有信用卡資料...";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR_FOUND = "錯誤: 無信用卡號碼!";
    var $_PHPSHOP_CHECKOUT_ERR_TEST = "對不起，你所使用的卡號是測試號碼!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_USER_DATA = "沒有找到該用戶!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_HOLDER_NAME = "您沒有提供銀行戶名";
    var $_PHPSHOP_CHECKOUT_ERR_NO_IBAN = "您還沒有提供您的銀行國際代碼.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_NUM = "您沒有提供您的銀行帳號";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_SORT = "您還沒有提供您的銀行類別代碼";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_NAME = "你還沒有提供您的銀行名稱.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_VALID_STEP = "付款必需有一個正確的步驟!";
    
    var $_PHPSHOP_CHECKOUT_MSG_LOG = "付款資訊已收到並稍後處理.<br />";
    
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV = "最低消費金額目前還未達到.";
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV2 = "我們的最低消費金額是:";
    var $_PHPSHOP_CHECKOUT_PAYMENT_CC = "信用卡支付";
    var $_PHPSHOP_CHECKOUT_PAYMENT_OTHER = "其他付款方法";
    var $_PHPSHOP_CHECKOUT_PAYMENT_SELECT = "請選擇您的付款方式:";
    
    var $_PHPSHOP_STORE_FORM_MPOV = " 您商店的最低消費金額";
    var $_PHPSHOP_ACCOUNT_BANK_TITLE = "銀行帳戶資訊";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR = "帳號號碼";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE = "銀行類別號碼";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_NAME = "銀行名稱";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_IBAN = "銀行國際代碼";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER = "帳戶所有人";
    
    var $_PHPSHOP_MODULES = "模組";
    var $_PHPSHOP_FUNCTIONS = "功能";
    var $_PHPSHOP_SPECIAL_PRODUCTS = "特賣商品";
    
    var $_PHPSHOP_CHECKOUT_CUSTOMER_NOTE = "請留下您的注意事項給我們如有需要的話";
    var $_PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE = "顧客的注意事項";
    var $_PHPSHOP_INCLUDING_TAX = "(含稅 \$tax % tax)";
    var $_PHPSHOP_PLEASE_SEL_ITEM = "請選擇一個項目";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_LBL = "項目";
    
    // DOWNLOADS
    
    var $_PHPSHOP_DOWNLOADS_TITLE = "下載區";
    var $_PHPSHOP_DOWNLOADS_START = "開始下載";
    var $_PHPSHOP_DOWNLOADS_INFO = "請輸入您在EMAIL中收到的下載ID並按下‘開始下載’.";
    var $_PHPSHOP_DOWNLOADS_ERR_EXP = "對不起，您的下載已過期";
    var $_PHPSHOP_DOWNLOADS_ERR_MAX = "對不起，您已經達到了最大下載次數";
    var $_PHPSHOP_DOWNLOADS_ERR_INV = "無效的下載ID!";
    var $_PHPSHOP_DOWNLOADS_ERR_SEND = "不能發送訊息到";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG = "訊息送到";
    var $_PHPSHOP_DOWNLOADS_SEND_SUBJ = "下載-資訊";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_1 = "您訂購的檔案已經準備好讓您下載";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_2 = "請在我們的下載區域輸入以下的下載ID: ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_3 = "每個檔案最多的下載次數是: ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_4 = "在第一次下載後的第 {expire} 天終止下載";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_5 = "疑問?困難?";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_6 = "提供下載資訊的是 "; // e.g. Download-Info by "Storename"
    var $_PHPSHOP_PRODUCT_FORM_DOWNLOADABLE = "可下載的商品?"; 
    
    var $_PHPSHOP_PAYPAL_THANKYOU = "感謝您的付款. 
        本交易已成功. 您將會收到由 paypal 所發出的本次交易確認 email. 
        您可以繼續或是馬上登入 <a href=http://www.paypal.com>www.paypal.com</a> 來確認交易細目.";
    var $_PHPSHOP_PAYPAL_ERROR = "處理交易時發生錯誤，你的訂單狀態無法更新.";
    
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER1 = "感謝您的惠顧!您的交易資訊如下.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER2 = "感謝你的惠顧.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER3 = "疑問?";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER4 = "以下的訂單已收到.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER5 = "利用以下連結查看訂購資訊.";
    
    var $_PHPSHOP_CART_ERROR_NO_NEGATIVE = "不允許負數.";
    var $_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY = "請輸入一個有效的數量.";
    
    var $_PHPSHOP_CART_STOCK_1 = "選擇的數量超過庫存. ";
    var $_PHPSHOP_CART_STOCK_2 = "我們目前有\$product_in_stock 個項目可出售";
    var $_PHPSHOP_CART_STOCK_3 = "點擊此處把商品加到等待清單.";
    var $_PHPSHOP_CART_SELECT_ITEM = "請從詳細頁面選擇一個特別項目!";
    
    var $_PHPSHOP_REGISTRATION_FORM_NONE = "無";
    var $_PHPSHOP_REGISTRATION_FORM_MR = "Mr.";
    var $_PHPSHOP_REGISTRATION_FORM_MRS = "Mrs.";
    var $_PHPSHOP_REGISTRATION_FORM_DR = "Dr.";
    var $_PHPSHOP_REGISTRATION_FORM_PROF = "Prof.";
    var $_PHPSHOP_DEFAULT = "預設";
    
  /*#####################################################
    MODULE AFFILIATE
  #######################################################*/
    var $_PHPSHOP_AFFILIATE_MOD = "加盟商管理";
    
    // Affiliate List
    var $_PHPSHOP_AFFILIATE_LIST_MNU = "列出加盟商";
    var $_PHPSHOP_AFFILIATE_LIST_LBL = "加盟商列表";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME = "加盟商名稱";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE = "啟用";
    var $_PHPSHOP_AFFILIATE_LIST_RATE = "比例";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL = "月總計";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION ="月傭金";
    var $_PHPSHOP_AFFILIATE_LIST_ORDERS = "列出訂單";
    
    // Affiliate Email
    var $_PHPSHOP_AFFILIATE_EMAIL_MNU = "email 加盟商";
    var $_PHPSHOP_AFFILIATE_EMAIL_LBL = "Email 加盟商";
    var $_PHPSHOP_AFFILIATE_EMAIL_WHO = "寄給誰(* = 全部)";
    var $_PHPSHOP_AFFILIATE_EMAIL_CONTENT = "您的 Email";
    var $_PHPSHOP_AFFILIATE_EMAIL_SUBJECT = "主題";
    var $_PHPSHOP_AFFILIATE_EMAIL_STATS = "包括目前的統計";
    
    // Affiliate Form
    var $_PHPSHOP_AFFILIATE_FORM_RATE = "傭金比例(百分比)";
    var $_PHPSHOP_AFFILIATE_FORM_ACTIVE = "啟動?";
    
    var $_PHPSHOP_DELIVERY_TIME = "通常送貨在";
    var $_PHPSHOP_DELIVERY_INFORMATION = "交貨資訊";
    var $_PHPSHOP_MORE_CATEGORIES = "更多類別";
    var $_PHPSHOP_AVAILABILITY = "有貨";
    var $_PHPSHOP_CURRENTLY_NOT_AVAILABLE = "這個商品目前沒有庫存";
    var $_PHPSHOP_PRODUCT_AVAILABLE_AGAIN = "下次供應時間將在: ";
    
    var $_PHPSHOP_STATISTIC_SUMMARY = "摘要";
    var $_PHPSHOP_STATISTIC_STATISTICS = "統計";
    var $_PHPSHOP_STATISTIC_CUSTOMERS = "顧客";
    var $_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS = "暢銷的商品";
    var $_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS = "滯銷的商品";
    var $_PHPSHOP_STATISTIC_SUM = "總數";
    var $_PHPSHOP_STATISTIC_NEW_ORDERS = "新訂單";
    var $_PHPSHOP_STATISTIC_NEW_CUSTOMERS = "新顧客";


	//Waiting list : file /administrator/components/com_phpshop/html/shop.waiting_list.php
	var $_PHPSHOP_WAITING_LIST_MESSAGE = "請在下面留下您的email以便本項商品重新上市通知您. 
                                        我們保證不會分享, 出租, 販售或是利用這個 e-mail 做任何事除了
                                        通知您本項商品何時重新上市.<br /><br />謝謝您!";
	var $_PHPSHOP_WAITING_LIST_THANKS = "感謝您的等待！ <br />如有存貨，我們將儘快通知您。";
	var $_PHPSHOP_WAITING_LIST_NOTIFY_ME = "提醒我";
	
	//Checkout : file /administrator/components/com_phpshop/html/checkout.thankyou.php
	var $_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW = "列印預視";
  
  /**************************Admin.show_cfg.php in apparition order ;-)**************************************/
	
	/* PAGE 1 */
	var $_PHPSHOP_ADMIN_CFG_AUTORIZE_OR_CYBERCASH = "請任選Authorize.net或者CyberCash中的一個";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS = " 配置檔案狀態:";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE = "可寫入";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE = "不可寫入";
	
	var $_PHPSHOP_ADMIN_CFG_GLOBAL = "全域設定";
	var $_PHPSHOP_ADMIN_CFG_PATHANDURL = "路徑 & 位址";
	var $_PHPSHOP_ADMIN_CFG_SITE = "網站";
	var $_PHPSHOP_ADMIN_CFG_SHIPPING = "送貨";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT = "結帳";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS = "下載";
	var $_PHPSHOP_ADMIN_CFG_PAYEMENTOPTIONS = "付款";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE = "僅用於目錄";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN = "如果選擇本項, 您將終止所有購物車功能。";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES = "顯示價格";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX = "顯示含稅價？";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN = "無論價格是否含稅均設置標誌。";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN = "選擇以顯示價格。 如果使用了目錄功能, 有些情況下可能不需要在頁面上顯示價格。";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX = "實際稅款";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN = "這將決定零重量物品是否含稅。 修改 ps_checkout.php->calc_order_taxable()以自定義。";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE = "稅金模式:";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP = "以送貨地址";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR = "以零售商地址";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN = "這將決定了計算稅金的時候採用何種稅率:<br /> 
                                                <ul><li>這取決於商店擁有者來自哪個地區/國家</li><br />
                                                <li>或是客戶的地區/國家.</li></ul>";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE = "啟用多重稅率?";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN = "如果您所銷售的商品稅率不同的話，選擇此項。 (比如說圖書是7%的稅率，而其他商品是16%的稅率)";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE = "計算稅金/運費之前減去折扣?";
  var $_PHPSHOP_ADMIN_CFG_REVIEW = "啟用顧客評價系統";
  var $_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN = "如果啟用的話, 您將允許顧客 <strong>評價產品</strong> 以及 <strong>撰寫評論</strong> 。 <br />
                                                                                這樣顧客可以寫下他們的體驗，為別的顧客提供參考。 <br />";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN = "設定這個標記來決定計算稅金/運費之前減去折扣還是之後再減去折扣。";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK = "顧客可以留下他們的銀行帳戶資訊?";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN = "如果您的顧客願意在註冊的時候填寫他們的銀行帳戶資訊的話，選擇此項。";

	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE = "顧客可以選擇國家/地區?";
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN = "如果你的顧客願意在註冊的時候填寫他們的國家/地區的話，選擇此項。";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS = "必須同意服務條款?";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN = "如果你想讓你的顧客註冊的時候同意服務條款，選擇此項。";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK = "檢查存貨?";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN = "此設置在用戶將物品加到購物車的時候，是否檢查存貨狀況。
                                                                                          如果設定，商店將不允許顧客加入超出存貨數量的商品。";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE = "啟用加盟程式?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN = "如果您在商店後台設置加盟商的話，這將會在商店前端啟用代理商追蹤。";
	
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT = "訂單郵件格式:";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT = "純文字郵件";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML = "HTML郵件";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN = "這決定了您的訂單確認郵件將以何種方式寄出:<br />
                                                                                        <ul><li>簡單的純文字郵件</li>
                                                                                        <li>或者是帶有圖片的HTML郵件。</li></ul>";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN = "允許非後臺管理員使用前端管理程式?";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN = "這個設置項可以為那些無法訪問後臺管理程式(比如 註冊會員/作者等級)
                                                   的商店管理員啟用前臺管理。";
	
	/* PAGE 2 */
	var $_PHPSHOP_ADMIN_CFG_URL = "URL";
	var $_PHPSHOP_ADMIN_CFG_URL_EXPLAIN = "您的網站位址. 通常跟您的 MAMBO URL同一個 (以斜線結尾)";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE = "加密保護URL";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN = "加密保護安全位址. (https 開頭， 以斜線結尾)";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT = "元件URL";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN = "mambo-PHPshop元件的位址 (以斜線結尾)";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE = "圖片URL";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN = "mambo-PHPshop元件圖片目錄的位址(以斜線結尾)";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH = "管理路徑";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN = "mambo-PHPshop元件目錄的路徑";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH = "CLASS路徑";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN = "mambo-PHPshop元件 class 的路徑";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH = "頁面路徑";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN = "mambo-PHPshop HTML目錄的路徑";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH = "圖片路徑";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN = "mambo-PHPshop 商店圖片的路徑";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE = "首頁";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN = "預設載入的網頁";	
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE = "錯誤頁面";
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN = "預設出現錯誤時的頁面";	
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE = "除錯頁面";
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN = "預設出現除錯訊息的頁面";
	var $_PHPSHOP_ADMIN_CFG_DEBUG = "除錯 ?";
	var $_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN = "除錯?  	   	打開除錯的輸出. 這將會把除錯頁面顯示在每個正常頁面的底部。此資訊在商店建立階段非常有用。";


/* PAGE 3 */

	var $_PHPSHOP_ADMIN_CFG_FLYPAGE = "商品頁面";
	var $_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN = "這是顯示商品詳情的預設頁面.";
  var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE = "類別範本";
	var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN = "這定義了在目錄中顯示商品的預設範本。<br />
                                                        您可以修改現有範本以新增新範本。<br />
                                                        (位於<strong>COMPONENTPATH/html/templates/</strong> 目錄下面，名稱以“browse_”起始)";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW = "每行中商品預設數目";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN = "這裏定義了每行中顯示商品的數目 <br />
                                                                                                      例如，如果你設置為4,那麼目錄範本中就會在每列顯示四個商品。";
  
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE = "“無圖片” 的圖片";
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN = "在商品無圖片可用時，顯示此圖片。";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS = "搜索行數";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN = "決定了搜索結果在每頁中顯示的行數。";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 = "搜索顏色 1";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN = "指定結果列表中奇數行的背景色。";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 = "搜索顏色 2";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN = "指定結果列表中偶數行的背景色。";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS = "最大行數";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN = "設置在訂單列表選擇框裏面顯示的行數。";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION = "顯示 footer \"powered by mambo-phpShop\" ?";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN = "顯示一個powered-by-mambo-phpShop的 footer 圖片。";
	
	
	/* PAGE 4 */
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD = "選擇商店送貨方式";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD = "分別配置的運送者跟運費的標準送貨模組。<strong>推薦 !</strong>";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE = "  	Zone Shipping Module Country Version 1.0<br />
                                                        關於這個模組的更多資訊請至 <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br />
                                                        關於細節或是連絡請寄信至 <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a> ";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS = "<a href=\"http://www.ups.com\" target=\"_blank\">UPS Online(R) Tools</a> 運費計算";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE = "UPS 存取碼";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN = "您的 UPS access code";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID = "UPS 使用者 id";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN = "您從 UPS 取得的使用者 ID";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD = "UPS 密碼";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN = "您 UPS 帳號的密碼";
	  
  var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER = "InterShipper 模組. 如果您有 <a href=\"http://www.intershipper.com\" target=\"_blank\">Intershipper.com</a> 帳號 請選擇";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE = "停用選擇運送方式. 如果您的顧客購買可下載貨品時並不需要運送, 請選擇.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD = "InterShipper 密碼";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD_EXPLAIN = "您的 intershipper 帳號的密碼.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL = "InterShipper email";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL_EXPLAIN = "您的 email 給您的 intershipper 帳號.";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY = "編碼鑰匙";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN = "在資料庫裡使用此鑰匙來加密資料. 這表示這個檔案任何時候都必須被保護不被看到.";
	
	
	/* PAGE 5 */
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR = "啟用結帳櫃檯";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN = "如果你想在顧客結賬過程中顯示結帳櫃檯(顯示1-2-3-4的圖片進度條)，選擇此項。";
	
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS = "選擇您商店的結帳步驟";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD = "<strong>標準步驟:</strong><br/>
               1. 確定送貨地址<br />
              2. 確定送貨方式<br />
              3. 確定付款方式<br />
              4. 完成訂購";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 = "<strong>步驟二:</strong><br/>
               1. 確定送貨位址<br />
              2. 確定付款方式t<br />
              3. 完成訂購";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 = "<strong>步驟三:</strong><br/>
               1. 確定送貨方式<br />
              2. 確定付款方式<br />
              3. 完成訂購";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 = "<strong>步驟四:</strong><br/>
               1. 確定付款方式<br />
              2. 完成訂購";
	
	
	
	/* PAGE 6 */
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS = "啟用下載";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN = "選擇此項會啟用下載功能。適用於銷售可下載商品的情況。";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS = "訂購狀態啟動下載";
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN = "選擇顧客下載通知 email 的訂購狀態.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS = "終止下載的訂購狀態";
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN = "選擇顧客下載終止通知 email 的訂購狀態.";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT = "下載根目錄";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN = "給顧客下載檔案的實體路徑. (請以斜線結尾!)<br>
        <span class=\"message\">為了您的商店的安全: 如果可以, 請使用網站根目錄之外的目錄</span>";
	
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX = "下載最多";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN = "設定一個下載-ID可以用來下載的次數, (給一次訂購)";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE = "下載期滿";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN = "設定可以讓顧客下載的時間範圍並 <strong>以秒計算</strong>. 
     從第一次下載開始計算時間! 當時間期滿, 此download-ID 將停用.<br />注意 : 86400秒=24小時.";
	
	
	
	
	/* PAGE 7 */
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL = "啟用 paypal 的 IPN 付款?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL_EXPLAIN = "選擇可讓您的顧客使用 PayPal 付款系統.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL = "PayPal 付款 email:";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL_EXPLAIN = "您在 paypal 使用的付款 email 地址. 同時也將使用來回信.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS = "成功交易的訂購狀態";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS_EXPLAIN = "當實際訂購已下單, 假使 Paypal IPN 已成功, 選擇的訂購狀態. 如果選擇販售下載設定: 
  選擇會啟動下載的狀態 (然後顧客將馬上收到關於此下載的通知 e-mail).";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED = "失敗交易的訂購狀態";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED_EXPLAIN = "選擇一個訂購狀態給失敗的 PayPal 交易.";
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE = "啟用 PayMate 付款?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE_EXPLAIN = "選擇可讓您的顧客使用澳洲 PayMate 付款系統.";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME = "PayMate 使用者名稱:";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME_EXPLAIN = "您的 PayMate 使用帳號.";
	
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET = "啟用 Authorize.net 付款?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_EXPLAIN = "選擇可使用 Authorize.net .";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE = "測試模式 ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE_EXPLAIN = "選擇 '是' 用來測試. 選擇 '否' 啟用線上交易.";
	var $_PHPSHOP_ADMIN_CFG_YES = "是";
	var $_PHPSHOP_ADMIN_CFG_NO = "否";
	
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME = "Authorize.net 登入 ID";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME_EXPLAIN = "這是您的 Authorize.Net 登入 ID";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY = "Authorize.net 交易碼";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY_EXPLAIN = "這是您的 Authorize.net 交易碼";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE = "Authentication 類型";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE_EXPLAIN = "這是 Authorize.Net 授權類型.";

	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH = "啟用 CyberCash?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH_EXPLAIN = "選擇以在 phpshop 使用 CyberCash.";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND = "CyberCash MERCHANT";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_EXPLAIN = "CC_MERCHANT 是 CyberCash Merchant ID";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY = "CyberCash Merchant Key";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY_EXPLAIN = "CyberCash Merchant Key 由 CyberCash 所提供";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL = "CyberCash 支付 URL";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL_EXPLAIN = "CyberCash 支付 URL 是由 Cybercash 所提供的安全付款";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE = "CyberCash AUTH TYPE";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE_EXPLAIN = "CyberCash AUTH TYPE 就是由 Cybercase 所提供的 Cybercash 授權類型";
	

    /** Advanced Search feature ***/
    var $_PHPSHOP_ADVANCED_SEARCH  ="進階搜尋";
    var $_PHPSHOP_SEARCH_ALL_CATEGORIES = "搜尋所有類別";
    var $_PHPSHOP_SEARCH_ALL_PRODINFO = "搜尋所有商品資訊";
    var $_PHPSHOP_SEARCH_PRODNAME = "只限商品名稱";
    var $_PHPSHOP_SEARCH_MANU_VENDOR = "只限製造商/零售商";
    var $_PHPSHOP_SEARCH_DESCRIPTION = "只限商品描述";
    var $_PHPSHOP_SEARCH_AND = "and";
    var $_PHPSHOP_SEARCH_NOT = "not";
    var $_PHPSHOP_SEARCH_TEXT1 = "第一個下拉清單框可以讓您選擇商品目錄以限制搜索範圍， 
        第二個下拉清單框可以將您的搜索範圍限制到商品資訊特定位置。 (比如說商品名稱)。 
        無論您選擇與否，請先輸入搜索關鍵字，以便我們為您查找相應的資訊。 ";
    var $_PHPSHOP_SEARCH_TEXT2 = " 您可以添加額外的搜索關鍵字並加入 AND 或 NOT 以提高搜尋結果命中率。
        選擇 AND 意味著同時包含兩個關鍵字商品都將出現在搜索結果之中。
        而選擇 NOT 則意味著搜索結果將會是所有包含第一個關鍵字而不包括
        第二個關鍵字的商品。";
    var $_PHPSHOP_ORDERBY = "排序以";
    
    /*** Review feature ***/
    var $_PHPSHOP_CUSTOMER_RATING  = "顧客平均評價";
    var $_PHPSHOP_TOTAL_VOTES = "全部票數";
    var $_PHPSHOP_CAST_VOTE = "請投票";
    var $_PHPSHOP_RATE_BUTTON = "評價";
    var $_PHPSHOP_RATE_NOM = "評價";
    var $_PHPSHOP_REVIEWS = "顧客評論";
    var $_PHPSHOP_NO_REVIEWS = "此商品暫無評論。";
    var $_PHPSHOP_WRITE_FIRST_REVIEW = "您是第一個為此商品撰寫評論的顧客。";
    var $_PHPSHOP_REVIEW_LOGIN = "請登陸以撰寫評論。";
    var $_PHPSHOP_REVIEW_ERR_RATE = "請評價此產品以完成您的評論";
    var $_PHPSHOP_REVIEW_ERR_COMMENT1 = "請再多寫幾句評論，最少字元數: 100";
    var $_PHPSHOP_REVIEW_ERR_COMMENT2 = "請簡化您的評論，最多字元數: 2000";
    var $_PHPSHOP_WRITE_REVIEW = "為此商品撰寫評論";
    var $_PHPSHOP_REVIEW_RATE = "首先: 請對此商品做出評價。請在0(最差)到5(最好)之間做出評價。";
    var $_PHPSHOP_REVIEW_COMMENT = "現在請做出一個評論。(最少 100，最多:2000 字元) ";
    var $_PHPSHOP_REVIEW_COUNT = "字數: ";
    var $_PHPSHOP_REVIEW_SUBMIT = "提交評論";
    var $_PHPSHOP_REVIEW_ALREADYDONE = "感謝您撰寫了此商品的評論。";
    var $_PHPSHOP_REVIEW_THANKYOU = "感謝您的評價";
    var $_PHPSHOP_COMMENT= "評論";
    
    var $_PHPSHOP_CREDITCARD_FORM_LBL = "增加/編輯信用卡類型";
    var $_PHPSHOP_CREDITCARD_NAME = "信用卡名稱";
    var $_PHPSHOP_CREDITCARD_CODE = "信用卡 - short code";
    var $_PHPSHOP_CREDITCARD_TYPE = "信用卡類型";
    
    var $_PHPSHOP_CREDITCARD_LIST_LBL = "信用卡列表";
    var $_PHPSHOP_UDATE_ADDRESS = "更新地址";
    var $_PHPSHOP_CONTINUE_SHOPPING = "繼續購物";
    
    var $_PHPSHOP_THANKYOU_SUCCESS = "您的訂單已經成功提交";
    var $_PHPSHOP_ORDER_LINK = "點擊此鏈結查看訂單詳情";
    
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "你的第 {order_id}號訂單狀態已經改變。";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "新的狀態是:";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "請點擊下列鏈結以查看訂單細節:";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "變更訂單狀態: 你的第 {order_id}號訂單";
    var $_PHPSHOP_ORDER_LIST_NOTIFY = "提醒顧客?";
    var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "請先改變訂單狀態!";
    
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "預設顧客群組的售價折扣 (以百分比的形式)";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = "正值的 X 意指著:商品如果對於該群組顧客沒有指定價格的話，那麼將在預設價格上面減少 X%。負值則有相反效果。";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_LBL = "商品折扣";
    var $_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL = "商品折扣列表";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT = "增加/編輯商品折扣";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT = "折扣量";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP = "輸入折扣量";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE = "折扣類型";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT = "百分比";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL = "總共";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP = "數量是百分比折扣還是總共折扣?";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE = "折扣起始日期";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP = "指定折扣起始日期";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE = "折扣結束日期";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP = "指定折扣結束日期";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP = "您可以使用商品折扣表以增加折扣！";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_SAVE = "您節省了";
    
    var $_PHPSHOP_FLYPAGE_ENLARGE_IMAGE = "查看全尺寸圖片";
    
/*********************
Currency Display Style 
***********************/
    var $_PHPSHOP_CURRENCY_DISPLAY = "貨幣顯示型態";
    var $_PHPSHOP_CURRENCY_SYMBOL = "目前的符號";
    var $_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP = "您可以在此使用 HTML 字元 (例如. &amp;euro;,&amp;pound;,&amp;yen;,...)";
    var $_PHPSHOP_CURRENCY_DECIMALS = "小數點";
    var $_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP = "小數點顯示位數 (可以是0)<br><b>設成不同的位數可能造成誤差</b>";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL = "小數點符號";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP = "用來當小數點符號的字元";
    var $_PHPSHOP_CURRENCY_THOUSANDS = "千分位符號";
    var $_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP = "用來隔開千分位的字元 (可以空白)";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY = "Positive format";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP = "用來顯示正值的格式.<br>(Symb 代表貨幣符號)";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY = "Negative format";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP = "用來顯示負值的格式.<br>(Symb 代表貨幣符號)";
    
    var $_PHPSHOP_OTHER_LISTS = "其他商品列表";
/**************
Multiple Images 
****************/
    var $_PHPSHOP_MORE_IMAGES = "瀏覽更多圖片";
    var $_PHPSHOP_AVAILABLE_IMAGES = "可用的圖片給";
    var $_PHPSHOP_BACK_TO_DETAILS = "回到商品詳細資料";
    
    /* FILEMANAGER */
    var $_PHPSHOP_FILEMANAGER = "檔案管理員";
    var $_PHPSHOP_FILEMANAGER_LIST = "檔案管理員::商品列表";
    var $_PHPSHOP_FILEMANAGER_ADD = "增加圖片/檔案";
    var $_PHPSHOP_FILEMANAGER_IMAGES = "分配的圖片";
    var $_PHPSHOP_FILEMANAGER_DOWNLOADABLE = "可被下載?";
    var $_PHPSHOP_FILEMANAGER_FILES = "分配的檔案 (Datasheets,...)";
    var $_PHPSHOP_FILEMANAGER_PUBLISHED = "發佈?";
    
    /* FILE LIST */
    var $_PHPSHOP_FILES_LIST = "檔案管理員: 圖片/檔案清單給";
    var $_PHPSHOP_FILES_LIST_FILENAME = "檔名";
    var $_PHPSHOP_FILES_LIST_FILETITLE = "檔案抬頭";
    var $_PHPSHOP_FILES_LIST_FILETYPE = "檔案類型";
    var $_PHPSHOP_FILES_LIST_EDITFILE = "編輯檔案登錄";
    var $_PHPSHOP_FILES_LIST_FULL_IMG = "完整圖片";
    var $_PHPSHOP_FILES_LIST_THUMBNAIL_IMG = "縮圖";
    
    
    /* FILE FORM */
    var $_PHPSHOP_FILES_FORM = "上傳一個檔案給";
    var $_PHPSHOP_FILES_FORM_CURRENT_FILE = "目前的檔案";
    var $_PHPSHOP_FILES_FORM_FILE = "檔案";
    var $_PHPSHOP_FILES_FORM_IMAGE = "圖片";
    var $_PHPSHOP_FILES_FORM_UPLOAD_TO = "上傳至";
    var $_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH = "預設的商品圖片路徑";
    var $_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH = "指定的檔案所在地";
    var $_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH = "下載路徑 (例如. 販售下載商品時!)";
    var $_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL = "自動產生縮圖?";
    var $_PHPSHOP_FILES_FORM_FILE_PUBLISHED = "發佈檔案?";
    var $_PHPSHOP_FILES_FORM_FILE_TITLE = "檔案抬頭 (顧客會看到的)";
    var $_PHPSHOP_FILES_FORM_FILE_DESC = "檔案說明";
    var $_PHPSHOP_FILES_FORM_FILE_URL = "檔案位址 (非必需)";
    
    /* FILE & IMAGE PROCESSING */
    var $_PHPSHOP_FILES_PATH_ERROR = "請提供一個有效的路徑!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS = "縮圖已經產生成功!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE = "無法產生縮圖!";
    var $_PHPSHOP_FILES_UPLOAD_FAILURE = "檔案/圖片 上傳錯誤";
    
    var $_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE = "無法刪除完整圖片檔案.";
    var $_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS = "完整圖片刪除成功.";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE = "無法刪除縮圖檔案 (可能不存在): ";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS = "縮圖刪除成功.";
    var $_PHPSHOP_FILES_FILE_DELETE_FAILURE = "無法刪除此檔案.";
    var $_PHPSHOP_FILES_FILE_DELETE_SUCCESS = "檔案刪除成功.";
    
    var $_PHPSHOP_FILES_NOT_FOUND = "抱歉, 要求的檔案未找到!";
    var $_PHPSHOP_IMAGE_NOT_FOUND = "圖片未找到!";

    /*#####################
    MODULE COUPON
    #####################*/
    
    var $_PHPSHOP_COUPON_MOD = "優待";
    var $_PHPSHOP_COUPONS = "優待";
    var $_PHPSHOP_COUPON_LIST = "優待清單";
    var $_PHPSHOP_COUPON_ALREADY_REDEEMED = "優待已被兌換.";
    var $_PHPSHOP_COUPON_REDEEMED = "優待已兌換! 謝謝您.";
    var $_PHPSHOP_COUPON_ENTER_HERE = "如果您有優待兌換代碼, 請在以下輸入:";
    var $_PHPSHOP_COUPON_SUBMIT_BUTTON = "提交";
    var $_PHPSHOP_COUPON_CODE_EXISTS = "此優待兌換代碼已存在. 請再試一次.";
    var $_PHPSHOP_COUPON_EDIT_HEADER = "更新優待";
    var $_PHPSHOP_COUPON_EDIT_HELP_TEXT = "點選優待兌換代碼來編輯, 或是選擇一個號碼然後點選刪除:";
    var $_PHPSHOP_COUPON_CODE_HEADER = "代碼";
    var $_PHPSHOP_COUPON_PERCENT_TOTAL = "百分比或是總額";
    var $_PHPSHOP_COUPON_TYPE = "優待類型";
    var $_PHPSHOP_COUPON_TYPE_TOOLTIP = "一張優待禮卷一旦用來打折之後將被刪除. 而永久型優待卷則可以想多常用就用, 隨顧客高興.";
    var $_PHPSHOP_COUPON_TYPE_GIFT = "優待禮卷";    
    var $_PHPSHOP_COUPON_TYPE_PERMANENT = "永久型優待卷";    
    var $_PHPSHOP_COUPON_VALUE_HEADER = "數值";
    var $_PHPSHOP_COUPON_DELETE_BUTTON = "刪除代碼";
    var $_PHPSHOP_COUPON_CONFIRM_DELETE = "您確定要刪除這組優待兌換代碼?";
    var $_PHPSHOP_COUPON_COMPLETE_ALL_FIELDS = "請完成所有欄位.";
    var $_PHPSHOP_COUPON_VALUE_NOT_NUMBER = "優待的值必須是數字.";
    var $_PHPSHOP_COUPON_NEW_HEADER = "新的優待";
    var $_PHPSHOP_COUPON_COUPON_HEADER = "優待兌換代碼";
    var $_PHPSHOP_COUPON_PERCENT = "百分比";
    var $_PHPSHOP_COUPON_TOTAL = "總額";
    var $_PHPSHOP_COUPON_VALUE = "值";
    var $_PHPSHOP_COUPON_CODE_SAVED = "優待代碼已儲存.";
    var $_PHPSHOP_COUPON_SAVE_BUTTON = "儲存優待";
    var $_PHPSHOP_COUPON_DISCOUNT = "優待折扣";
    var $_PHPSHOP_COUPON_CODE_INVALID = "優待兌換代碼不存在. 請再試一次.";
    var $_PHPSHOP_COUPONS_ENABLE = "啟動優待使用";
    var $_PHPSHOP_COUPONS_ENABLE_EXPLAIN = "假使您啟動, 表示允許顧客使用優待兌換代碼來換取折扣.";
    
    /* Free Shipping */
    var $_PHPSHOP_FREE_SHIPPING = "免運費";
    var $_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT = "本項訂購免運費!";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT = "免運費所需最低金額";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP = "總共金額 (包括稅金!) 指的是免運費的最低金額 
                                                (舉例: <strong>50</strong> 指的是當顧客結帳
                                                金額總數為 \$50 (包括稅金)或超過時免運費.";
    var $_PHPSHOP_YOUR_STORE = "您的商店";
    var $_PHPSHOP_CONTROL_PANEL = "控制台";
    
    /* Configuration Additions */
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON = "PDF-按鈕";
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN = "商店內顯示或是隱藏 PDF-按鈕";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER = "每次訂購都必須同意使用條款?";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN = "選取假如您要顧客每次訂購都要同意您的使用條款 (下單之前).";

    // We need this for eCheck.net Payments
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE = "銀行帳號類型";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING = "支票帳戶";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING = "商業支票帳戶";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS = "儲蓄帳戶";
    
    var $_PHPSHOP_PAYMENT_AN_RECURRING = "自動轉帳?";
    var $_PHPSHOP_PAYMENT_AN_RECURRING_TOOLTIP = "自定義您要的自動轉帳.";
    
    var $_PHPSHOP_INTERNAL_ERROR = "要求方式發生內部錯誤";
    var $_PHPSHOP_PAYMENT_ERROR = "付款程序失敗";
    var $_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS = "付款程序已成功 ";
    
    /* UPS Shipping Module */
    var $_PHPSHOP_UPS_RESPONSE_ERROR = "UPS 無法處理運費費率的要求.";
    var $_PHPSHOP_UPS_SHIPPING_GUARANTEED_DAYS = "保證到貨天數";
    var $_PHPSHOP_UPS_PICKUP_METHOD = "UPS 收貨方式";
    var $_PHPSHOP_UPS_PICKUP_METHOD_TOOLTIP = "您如何把包裹給 UPS?";
    var $_PHPSHOP_UPS_PACKAGE_TYPE = "UPS 包裝?";
    var $_PHPSHOP_UPS_PACKAGE_TYPE_TOOLTIP = "選擇預設類型的包裝.";
    var $_PHPSHOP_UPS_TYPE_RESIDENTIAL = "送貨到府?";
    var $_PHPSHOP_UPS_RESIDENTIAL = "到府(RES)";
    var $_PHPSHOP_UPS_COMMERCIAL    = "商業送貨 (COM)";
    var $_PHPSHOP_UPS_RESIDENTIAL_TOOLTIP = "送貨到府(RES)或商業送貨(COM)的報價.";
    var $_PHPSHOP_UPS_HANDLING_FEE = "手續費";
    var $_PHPSHOP_UPS_HANDLING_FEE_TOOLTIP = "您這個運送方式的手續費.";
    var $_PHPSHOP_UPS_TAX_CLASS = "稅別";
    var $_PHPSHOP_UPS_TAX_CLASS_TOOLTIP = "運費使用以下的稅別.";
    
    var $_PHPSHOP_ERROR_CODE = "錯誤代碼";
    var $_PHPSHOP_ERROR_DESC = "錯誤描述";
    
    var $_PHPSHOP_CHANGE_TRANSACTION_KEY = "顯示/更改 交易碼";
    var $_PHPSHOP_CHANGE_PASSKEY_FORM = "顯示/更改 密碼/交易碼";
    var $_PHPSHOP_TYPE_PASSWORD = "請輸入您的使用者密碼";
    var $_PHPSHOP_CURRENT_PASSWORD = "目前的密碼";
    var $_PHPSHOP_CURRENT_TRANSACTION_KEY = "目前的交易碼";
    var $_PHPSHOP_CHANGE_PASSKEY_SUCCESS = "交易碼已更換成功.";
    
    var $_PHPSHOP_PAYMENT_CVV2 = "要求/取得 信用卡 授權碼 (CVV2/CVC2/CID)";
    var $_PHPSHOP_PAYMENT_CVV2_TOOLTIP = "檢查一個正確的 CVV2/CVC2/CID 值 (在信用卡的背後最後3個或是4個數字, American Express的信用卡在前面)?";
    var $_PHPSHOP_CUSTOMER_CVV2_TOOLTIP = "請輸入信用卡背後的最後3個或是4個數字 (American Express信用卡的在前面)";
    var $_PHPSHOP_CUSTOMER_CVV2_ERROR = "您需要輸入您的信用卡授權碼以繼續.";
    
    var $_PHPSHOP_PRODUCT_FORM_FILENAME = "填入任一的檔名";
    var $_PHPSHOP_PRODUCT_FORM_FILENAME_TOOLTIP = "注意: 您可以在這裡填入一個檔名. <strong>如果您在這裡填入一個檔名, 將不會有檔案被上傳!!! 您將必須手動利用FTP上傳!</strong>.";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD = "或上傳新檔案";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD_TOOLTIP = "您可以上傳一個檔案. 這個檔案將是您所販賣的商品. 一個已存在的檔案將被替換.";
    
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1 = "在此輸入任何的文字將會在商品介紹頁面顯示給顧客.<br />例如: 24h, 48 hours, 3 - 5 days, On Order.....";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2 = "或是選擇一個圖片顯示在詳細頁面 (介紹頁面).<br />圖片在目錄 <i>/components/com_phpshop/shop_image/availability</i>裡面<br />";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST = "屬性清單";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES = "<h4>屬性清單格式的例子:</h4>
        <pre>大小,XL[+100],M,S[-100];顏色,Red,Green,Yellow,昂貴顏色[=2400];等等,..,..</pre>
        <h4>括號內的售價調整使用以下的進階符號來更改:</h4>
        <pre>
        &#43; == 加上這個數值到原本設定的售價.<br />
        &#45; == 減掉這個數值到原本設定售價.<br />
        &#61; == 直接設定商品的售價到這個數值.
      </pre>";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST = "自定義屬性清單";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES = "<h4>自定義屬性清單格式的例子:</h4>
        <pre>名稱;額外;</strong>...</pre>";
        
    var $_PHPSHOP_MULTISELECT = "一次多選: 使用 CTRL鍵 跟 滑鼠";
        
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN = "啟用 eProcessingNetwork.com 支付?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_EXPLAIN = "在 phpshop 選擇使用 eProcessingNetwork.com.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_TESTMODE = "測試模式 ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_TESTMODE_EXPLAIN = "選擇 '是' 進行測試. 選擇 '否' 啟用線上交易.";
	
	var $_PHPSHOP_ADMIN_CFG_EPN_USERNAME = "eProcessingNetwork.com 登入 ID";
	var $_PHPSHOP_ADMIN_CFG_EPN_USERNAME_EXPLAIN = "這是您的 eProcessingNetwork.com 登入 ID";
	var $_PHPSHOP_ADMIN_CFG_EPN_KEY = "eProcessingNetwork.com 交易碼";
	var $_PHPSHOP_ADMIN_CFG_EPN_KEY_EXPLAIN = "這是您的 eProcessingNetwork.com 交易碼";
	var $_PHPSHOP_ADMIN_CFG_EPN_AUTENTICATIONTYPE = "授權類型";
	var $_PHPSHOP_ADMIN_CFG_EPN_AUTENTICATIONTYPE_EXPLAIN = "這是 eProcessingNetwork.com 授權類型.";

    var $_PHPSHOP_RELATED_PRODUCTS = "相關商品";
    var $_PHPSHOP_RELATED_PRODUCTS_TIP = "您可以用這個列表建立相關商品聯繫. 請選擇一或多個商品然後它們就成為 <strong>相關商品</strong>.";
    
    var $_PHPSHOP_RELATED_PRODUCTS_HEADING = "您可能也對這些商品感興趣";
    
    var $_PHPSHOP_IMAGE_ACTION = "圖片動作";
    var $_PHPSHOP_NONE = "無";
    
    var $_PHPSHOP_ORDER_HISTORY = "訂購歷程";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT = "評論";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT_EMAIL = "您訂單的評論";
    var $_PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT = "包括這個評論?";
    var $_PHPSHOP_ORDER_HISTORY_DATE_ADDED = "日期已增加";
    var $_PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED = "通知顧客?";
    var $_PHPSHOP_ORDER_STATUS_CHANGE = "訂購狀態更改";
    
     /* USPS Shipping Module */
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME = "USPS 使用者名稱";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME_TOOLTIP = "USPS 運送使用者名稱";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD = "USPS 密碼";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD_TOOLTIP = "USPS 密碼";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER = "USPS shipping 伺服器";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER_TOOLTIP = "USPS shipping 伺服器";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH = "USPS shipping 路徑";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH_TOOLTIP = "USPS shipping 路徑";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER = "USPS 運送容器";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER_TOOLTIP = "USPS 運送容器";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE = "USPS 包裝大小";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE_TOOLTIP = "USPS 包裝大小";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID = "USPS Package ID (必須是 0, 不支援多包裹)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID_TOOLTIP = "USPS Package ID (必須是 0, 不支援多包裹)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE = "USPS 運送類型 (Express,First Class,Priority,Parcel,BPM,Library,Media)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE_TOOLTIP = "USPS 運送類型 (Express,First Class,Priority,Parcel,BPM,Library,Media)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_HANDLING_FEE = "手續費";
    var $_PHPSHOP_USPS_HANDLING_FEE = "這種運送方式的手續費.";
    var $_PHPSHOP_USPS_HANDLING_FEE_TOOLTIP = "這種運送方式的手續費.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE = "您的國際 USPS 運送的手續費.";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE_TOOLTIP = "您的 USPS 國際運送的手續費.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE = "您的 USPS 國際運送每磅的費率.";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE_TOOLTIP = "您的 USPS 國際運送每磅的費率.";
    var $_PHPSHOP_USPS_RESPONSE_ERROR = "USPS 無法進行運送費率的要求.";
    
    /** Changed Product Type - Begin*/
    /*** Product Type ***/
    var $_PHPSHOP_PARAMETERS_LBL = "參數";
    var $_PHPSHOP_PRODUCT_TYPE_LBL = "商品類型";
    var $_PHPSHOP_PRODUCT_TYPE_LIST_LBL = "商品類型清單";
    var $_PHPSHOP_PRODUCT_TYPE_ADDEDIT = "增加/編輯 商品類型";
    // Product - Product Product Type list
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL = "商品類型清單給";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_MNU = "列出商品類型";
    // Product - Product Product Type form
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL = "增加商品類型給";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_MNU = "增加商品類型";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE = "商品類型";
    // Product - Product Type form
    var $_PHPSHOP_PRODUCT_TYPE_FORM_NAME = "商品類型名稱";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION = "商品類型描述";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS = "參數";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_LBL = "商品類型資訊";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH = "發佈?";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE = "商品類型瀏覽頁面";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE = "商品類型介紹頁面";
    // Product - Product Type Parameter list
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL = "商品類型的參數";
    // Product - Product Type Parameter form
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LBL = "參數資訊";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NOT_FOUND = "商品類型找不到!";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME = "參數名稱";
    VAR $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME_DESCRIPTION = "這個名稱將會是表格的行名. 必須是小寫而且無空白.<BR>例如: main_material";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL = "參數標籤";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DESCRIPTION = "參數描述";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE = "參數類型";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_INTEGER = "整數";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TEXT = "文字";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_SHORTTEXT = "簡短文字";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_FLOAT = "Float";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_CHAR = "Char";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATETIME = "日期 及 時間";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE = "日期";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE_FORMAT = "YYYY-MM-DD";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME = "時間";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME_FORMAT = "HH:MM:SS";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_BREAK = "斷行";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_MULTIVALUE = "多個值";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES = "可能的值";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_MULTISELECT = "顯示可能的值作為多重選擇?";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES_DESCRIPTION = "<strong>如果設定了可能的值, 參數將只能用這個值. 例子:</strong><BR><span class=\"sectionname\">Steel;Wood;Plastic;...</span>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT = "預設值";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT_HELP_TEXT = "參數預設值使用這種格式:<ul><li>Date: YYYY-MM-DD</li><li>Time: HH:MM:SS</li><li>Date & Time: YYYY-MM-DD HH:MM:SS</li></ul>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_UNIT = "單位";
    
	/************************* FrontEnd ***************************/
	/** shop.parameter_search.php */
	var $_PHPSHOP_PARAMETER_SEARCH = "進階搜尋按照參數";
	var $_PHPSHOP_ADVANCED_PARAMETER_SEARCH = "Parameters Search";
	var $_PHPSHOP_PARAMETER_SEARCH_TEXT1 = "您要利用技術性參數來搜尋商品嗎?<BR>可以使用任一表格:";
// 	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "沒有結果符合.";
	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "I am sorry. There is no category for search.";
	/** shop.parameter_search_form.php */
	var $_PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE = "I am sorry. There is no published Product Type with this name.";
	var $_PHPSHOP_PARAMETER_SEARCH_IS_LIKE = "就像";
	var $_PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE = "不像";
	var $_PHPSHOP_PARAMETER_SEARCH_FULLTEXT = "全文搜尋";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL = "All Selected";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY = "Any Selected";
	var $_PHPSHOP_PARAMETER_SEARCH_RESET_FORM = "重新設定";	
	/** shop.browse.php */
	var $_PHPSHOP_PARAMETER_SEARCH_IN_CATEGORY = "搜尋種類";
	var $_PHPSHOP_PARAMETER_SEARCH_CHANGE_PARAMETERS = "更改參數";
	var $_PHPSHOP_PARAMETER_SEARCH_DESCENDING_ORDER = "遞減順序";
	var $_PHPSHOP_PARAMETER_SEARCH_ASCENDING_ORDER = "遞增順序";
	/** shop.product.detail */
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETERS_IN_CATEGORY = "種類的參數";
	/** Changed Product Type - End*/
    
    // Opposite of Discount!
    var $_PHPSHOP_FEE = "費用";
    
    var $_PHPSHOP_PRODUCT_CLONE = "複製商品";
    
    var $_PHPSHOP_CSV_SETTINGS = "設定";
    var $_PHPSHOP_CSV_DELIMITER = "定義符號";
    var $_PHPSHOP_CSV_ENCLOSURE = "Field Enclosure Char";
    var $_PHPSHOP_CSV_UPLOAD_FILE = "上傳 CSV 檔案";
    var $_PHPSHOP_CSV_SUBMIT_FILE = "提交 CSV 檔案";
    var $_PHPSHOP_CSV_FROM_DIRECTORY = "從目錄載入";
    var $_PHPSHOP_CSV_FROM_SERVER = "從伺服器載入 CSV 檔案";
    var $_PHPSHOP_CSV_EXPORT_TO_FILE = "輸出 CSV 檔案";
    var $_PHPSHOP_CSV_SELECT_FIELD_ORDERING = "選擇欄位順序類型";
    var $_PHPSHOP_CSV_DEFAULT_ORDERING = "預設順序";
    var $_PHPSHOP_CSV_CUSTOMIZED_ORDERING = "我的訂製順序";
    var $_PHPSHOP_CSV_SUBMIT_EXPORT = "輸出所有商品到 CSV 檔案";
    var $_PHPSHOP_CSV_CONFIGURATION_HEADER = "CSV 輸入 / 輸出 配置";
    var $_PHPSHOP_CSV_SAVE_CHANGES = "儲存更改";
    var $_PHPSHOP_CSV_FIELD_NAME = "欄位名稱";
    var $_PHPSHOP_CSV_DEFAULT_VALUE = "預設值";
    var $_PHPSHOP_CSV_FIELD_ORDERING = "欄位順序";
    var $_PHPSHOP_CSV_FIELD_REQUIRED = "必須欄位?";
    var $_PHPSHOP_CSV_IMPORT_EXPORT = "輸入/輸出";
    var $_PHPSHOP_CSV_NEW_FIELD = "新增欄位";
    var $_PHPSHOP_CSV_DOCUMENTATION = "文件";
    
    var $_PHPSHOP_PRODUCT_NOT_FOUND = "抱歉, 不過您要求的商品未找到!";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS = "顯示沒有庫存的商品";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN = "當啟用時, 將會陳列出沒有庫存的商品. 不然這類商品會是隱藏的.";
    
}
/** @global phpShopLanguage $PHPSHOP_LANG */
$PHPSHOP_LANG =& new phpShopLanguage();
?>
