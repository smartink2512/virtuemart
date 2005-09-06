<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: czech1250.php,v 1.3 2005/08/26 09:39:45 dvorakz Exp $
* @package mambo-phpShop
* @subpackage languages
*
* @copyright (C) 2004 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* 
* Czech Translation: 2004 Rostislav Hu�ka (translated partly), 
*                    2004-2005 Jaroslav Jakubes (translation checked & completed)
*                    2005 Zdenek Dvorak (update)
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
* 
* synchronized with english.php v 1.38
*/
class phpShopLanguage extends mosAbstractLanguage {

    /*####################
    GENERAL DEFINITIONS
    ####################*/
    
    var $_PHPSHOP_MENU = "Menu";
    var $_PHPSHOP_CATEGORY = "Kategorie";
    var $_PHPSHOP_CATEGORIES = "Kategorie";
    var $_PHPSHOP_SELECT_CATEGORY = "Vyberte kategorii:";
    var $_PHPSHOP_ADMIN = "Administrace";
    var $_PHPSHOP_PRODUCT = "Zbo��";
    var $_PHPSHOP_LIST = "Seznam";
    var $_PHPSHOP_ALL = "V�e";
    var $_PHPSHOP_LIST_ALL_PRODUCTS = "Seznam ve�ker�ho zbo��";
    var $_PHPSHOP_VIEW = "Zobrazit";
    var $_PHPSHOP_SHOW = "Uk�zat";
    var $_PHPSHOP_ADD = "P�idat";
    var $_PHPSHOP_UPDATE = "Aktualizovat";
    var $_PHPSHOP_DELETE = "Smazat";
    var $_PHPSHOP_SELECT = "Vybrat";
    var $_PHPSHOP_SUBMIT = "Odeslat";
    var $_PHPSHOP_RANDOM = "N�hodn� zbo��";
    var $_PHPSHOP_LATEST = "Posledn� zbo��";
    
    /*#####################
    MODULE ACCOUNT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_HOME_TITLE = "Dom�";
    var $_PHPSHOP_CART_TITLE = "Ko��k";
    var $_PHPSHOP_CHECKOUT_TITLE = "Zaplatit";
    var $_PHPSHOP_LOGIN_TITLE = "P�ihl�sit se";
    var $_PHPSHOP_LOGOUT_TITLE = "Odhl�sit se";
    var $_PHPSHOP_BROWSE_TITLE = "Prohl�et";
    var $_PHPSHOP_SEARCH_TITLE = "Hledat";
    var $_PHPSHOP_ACCOUNT_TITLE = "Va�e �daje";
    var $_PHPSHOP_NAVIGATION_TITLE = "Navigace";
    var $_PHPSHOP_DEPARTMENT_TITLE = "Odd�len�";
    var $_PHPSHOP_INFO = "Informace";
    
    var $_PHPSHOP_BROWSE_LBL = "Prohl�et";
    var $_PHPSHOP_PRODUCTS_LBL = "Zbo��";
    var $_PHPSHOP_PRODUCT_LBL = "Zbo��";
    var $_PHPSHOP_SEARCH_LBL = "Hledat";
    var $_PHPSHOP_FLYPAGE_LBL = "Detaily o zbo��";
    var $_PHPSHOP_PRODUCT_SEARCH_LBL = "Hledat zbo��";
    
    var $_PHPSHOP_PRODUCT_NAME_TITLE = "N�zev zbo��";
    var $_PHPSHOP_PRODUCT_CATEGORY_TITLE = "Kategorie zbo��";
    var $_PHPSHOP_PRODUCT_DESC_TITLE = "Popis";
    
    var $_PHPSHOP_CART_SHOW = "Obsah ko��ku";
    var $_PHPSHOP_CART_ADD_TO = "P�idat do ko��ku";
    var $_PHPSHOP_CART_NAME = "Jm�no";
    var $_PHPSHOP_CART_SKU = "K�d zbo��";
    var $_PHPSHOP_CART_PRICE = "Cena";
    var $_PHPSHOP_CART_QUANTITY = "Mno�stv�";
    var $_PHPSHOP_CART_SUBTOTAL = "Mezisou�et";
    
    # Some messages
    var $_PHPSHOP_ADD_SHIPTO_1 = "P�idat";
    var $_PHPSHOP_ADD_SHIPTO_2 = "Dodac� adresa";
    var $_PHPSHOP_NO_SEARCH_RESULT = "Nic nebylo nalezeno.<br />";
    var $_PHPSHOP_PRICE_LABEL = "Cena: ";
    var $_PHPSHOP_ORDER_BUTTON_LABEL = "Vlo�it do ko��ku";
    var $_PHPSHOP_NO_CUSTOMER = "Nejste je�t� registrovan� z�kazn�k, zadejte pros�m faktura�n� �daje.";
    var $_PHPSHOP_DELETE_MSG = "Opravdu chcete smazat tuto polo�ku?";
    var $_PHPSHOP_THANKYOU = "D�kujeme v�m za va�i objedn�vku.";
    var $_PHPSHOP_NOT_SHIPPED = "Je�t� neodesl�no";
    var $_PHPSHOP_EMAIL_SENDTO = "E-mail s potvrzen�m byl zasl�n na adresu";
    var $_PHPSHOP_NO_USER_TO_SELECT = "Lituji, neexistuje u�ivatel MamboOS, kter�ho byste mohli p�idat do seznamu u�ivatel� com_phpshop";
    
    // Error messages
    
    var $_PHPSHOP_ERROR = "Chyba";
    var $_PHPSHOP_MOD_NOT_REG = "Modul nen� registrov�n.";
    var $_PHPSHOP_MOD_ISNO_REG = "nen� platn� modul phpShop.";
    var $_PHPSHOP_MOD_NO_AUTH = " Nem�te opr�vn�n� pracovat s po�adovan�m modulem.";
    var $_PHPSHOP_PAGE_404_1 = "Str�nka neexistuje";
    var $_PHPSHOP_PAGE_404_2 = "Zadan� jm�no souboru neexistuje. Nelze nal�zt soubor:";
    var $_PHPSHOP_PAGE_403 = "Nedostate�n� pr�va";
    var $_PHPSHOP_FUNC_NO_EXEC = "Nem�te  opr�vn�n� na vykon�n� ";
    var $_PHPSHOP_FUNC_NOT_REG = "Funkce nen� registrov�na";
    var $_PHPSHOP_FUNC_ISNO_REG = " nen� platn� funkce MOS_com_phpShop.";
    
    /*#####################
    MODULE ADMIN
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADMIN_MOD = "Administrace";
    
    
    // User List
    var $_PHPSHOP_USER_LIST_MNU = "Seznam u�ivatel�";
    var $_PHPSHOP_USER_LIST_LBL = "U�ivatel�";
    var $_PHPSHOP_USER_LIST_USERNAME = "U�ivatel. jm�no";
    var $_PHPSHOP_USER_LIST_FULL_NAME = "Pln� jm�no";
    var $_PHPSHOP_USER_LIST_GROUP = "Skupina";
    
    // User Form
    var $_PHPSHOP_USER_FORM_MNU = "P�idat u�ivatele";
    var $_PHPSHOP_USER_FORM_LBL = "P�idat/zm�nit informaci o u�ivateli";
    var $_PHPSHOP_USER_FORM_BILLTO_LBL = "Informace o pl�tci";
    var $_PHPSHOP_USER_FORM_SHIPTO_LBL = "Dodac� adresa";
    var $_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL = "P�idat adresu";
    var $_PHPSHOP_USER_FORM_NO_SHIPPING_ADDRESSES = "��dn� dodac� adresa.";
    var $_PHPSHOP_USER_FORM_ADDRESS_LABEL = "Zkratka adresy";
    var $_PHPSHOP_USER_FORM_FIRST_NAME = "K�estn� jm�no";
    var $_PHPSHOP_USER_FORM_LAST_NAME = "P��jmen�";
    var $_PHPSHOP_USER_FORM_MIDDLE_NAME = "Prost�edn� jm�no";
    var $_PHPSHOP_USER_FORM_TITLE = "Titul";
    var $_PHPSHOP_USER_FORM_USERNAME = "U�ivatelsk� jm�no";
    var $_PHPSHOP_USER_FORM_PASSWORD_1 = "Heslo";
    var $_PHPSHOP_USER_FORM_PASSWORD_2 = "Potvrdit heslo";
    var $_PHPSHOP_USER_FORM_PERMS = "Opr�vn�n�";
    var $_PHPSHOP_USER_FORM_CUSTOMER_NUMBER = "��slo z�kazn�ka / ID";
    var $_PHPSHOP_USER_FORM_COMPANY_NAME = "N�zev firmy";
    var $_PHPSHOP_USER_FORM_ADDRESS_1 = "Adresa 1";
    var $_PHPSHOP_USER_FORM_ADDRESS_2 = "Adresa 2";
    var $_PHPSHOP_USER_FORM_CITY = "M�sto";
    var $_PHPSHOP_USER_FORM_STATE = "St�t/Provincie";
    var $_PHPSHOP_USER_FORM_ZIP = "PS�";
    var $_PHPSHOP_USER_FORM_COUNTRY = "St�t";
    var $_PHPSHOP_USER_FORM_PHONE = "Telefon";
    var $_PHPSHOP_USER_FORM_PHONE2 = "Mobiln� telefon";
    var $_PHPSHOP_USER_FORM_FAX = "Fax";
    var $_PHPSHOP_USER_FORM_EMAIL = "e-mail";
    
    // Module List
    var $_PHPSHOP_MODULE_LIST_MNU = "Seznam modul�";
    var $_PHPSHOP_MODULE_LIST_LBL = "Moduly";
    var $_PHPSHOP_MODULE_LIST_NAME = "Jm�no modulu";
    var $_PHPSHOP_MODULE_LIST_PERMS = "Opr�vn�n� modulu";
    var $_PHPSHOP_MODULE_LIST_FUNCTIONS = "Funkce";
    var $_PHPSHOP_MODULE_LIST_ORDER = "Po�ad�";
    
    // Module Form
    var $_PHPSHOP_MODULE_FORM_MNU = "P�idat modul";
    var $_PHPSHOP_MODULE_FORM_LBL = "Informace o modulu";
    var $_PHPSHOP_MODULE_FORM_MODULE_LABEL = "N�zev modulu (pro horn� menu)";
    var $_PHPSHOP_MODULE_FORM_NAME = "Jm�no modulu";
    var $_PHPSHOP_MODULE_FORM_PERMS = "Pr�va modulu";
    var $_PHPSHOP_MODULE_FORM_HEADER = "Z�hlav� modulu";
    var $_PHPSHOP_MODULE_FORM_FOOTER = "Z�pat� modulu";
    var $_PHPSHOP_MODULE_FORM_MENU = "Zobrazit modul v menu Administrace?";
    var $_PHPSHOP_MODULE_FORM_ORDER = "Po�ad� zobrazen�";
    var $_PHPSHOP_MODULE_FORM_DESCRIPTION = "Popis modulu";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_CODE = "K�d jazyka";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_file = "Soubor s jazykem";
    
    // Function List
    var $_PHPSHOP_FUNCTION_LIST_MNU = "Seznam funkc�";
    var $_PHPSHOP_FUNCTION_LIST_LBL = "Funkce";
    var $_PHPSHOP_FUNCTION_LIST_NAME = "Jm�no funkce";
    var $_PHPSHOP_FUNCTION_LIST_CLASS = "Jm�no t��dy";
    var $_PHPSHOP_FUNCTION_LIST_METHOD = "Metoda t��dy";
    var $_PHPSHOP_FUNCTION_LIST_PERMS = "Opr�vn�n�";
    
    // Module Form
    var $_PHPSHOP_FUNCTION_FORM_MNU = "P�idat funkci";
    var $_PHPSHOP_FUNCTION_FORM_LBL = "Informace o funkci";
    var $_PHPSHOP_FUNCTION_FORM_NAME = "Jm�no funkce";
    var $_PHPSHOP_FUNCTION_FORM_CLASS = "Jm�no t��dy";
    var $_PHPSHOP_FUNCTION_FORM_METHOD = "Metoda t��dy";
    var $_PHPSHOP_FUNCTION_FORM_PERMS = "Opr�vn�n� funkce";
    var $_PHPSHOP_FUNCTION_FORM_DESCRIPTION = "Popis funkce";
    
    // Currency form and list
    var $_PHPSHOP_CURRENCY_LIST_MNU = "Seznam m�n";
    var $_PHPSHOP_CURRENCY_LIST_LBL = "M�ny";
    var $_PHPSHOP_CURRENCY_LIST_ADD = "P�idat m�nu";
    var $_PHPSHOP_CURRENCY_LIST_NAME = "N�zev m�ny";
    var $_PHPSHOP_CURRENCY_LIST_CODE = "K�d m�ny";
    
    // Country form and list
    var $_PHPSHOP_COUNTRY_LIST_MNU = "Seznam zem�";
    var $_PHPSHOP_COUNTRY_LIST_LBL = "Zem�";
    var $_PHPSHOP_COUNTRY_LIST_ADD = "P�idat zemi";
    var $_PHPSHOP_COUNTRY_LIST_NAME = "Jm�no zem�";
    var $_PHPSHOP_COUNTRY_LIST_3_CODE = "K�d zem� (3)";
    var $_PHPSHOP_COUNTRY_LIST_2_CODE = "K�d zem� (2)";

    // State form and list
    var $_PHPSHOP_STATE_LIST_MNU = "Seznam st�t�";
    var $_PHPSHOP_STATE_LIST_LBL = "St�t";
    var $_PHPSHOP_STATE_LIST_ADD = "P�idat/aktualizovat st�t";
    var $_PHPSHOP_STATE_LIST_NAME = "Jm�no st�tu";
    var $_PHPSHOP_STATE_LIST_3_CODE = "K�d st�tu (3)";
    var $_PHPSHOP_STATE_LIST_2_CODE = "K�d st�tu (2)";
        
    /*#####################
    MODULE CHECKOUT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADDRESS = "Adresa";
    var $_PHPSHOP_CONTINUE = "Pokra�ovat";
    
    # Some messages
    var $_PHPSHOP_EMPTY_CART = "V� ko��k je pr�zdn�";
    
    
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
    var $_PHPSHOP_ISSHIP_LIST_MNU = "Seznam zp�sob� dopravy";
    var $_PHPSHOP_ISSHIP_LIST_LBL = "Aktivn� zp�sob dopravy";
    var $_PHPSHOP_ISSHIP_LIST_CARRIER_LBL = "Zp�sob dopravy";
    var $_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL = "Aktivn�";
    var $_PHPSHOP_ISSHIP_LIST_RATE_LBL = "Baln�";
    var $_PHPSHOP_ISSHIP_LIST_LEAD_LBL = "Lead Time";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_F_LBL = "fixn� sazba";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_P_LBL = "procenta";
    var $_PHPSHOP_ISSHIP_LIST_DAYS_LBL = "dny";
    var $_PHPSHOP_ISSHIP_LIST_HEAVY_LBL = "Nadm�rn� z�silky";
    
    // Dynamic Shipping Form
    var $_PHPSHOP_ISSHIP_FORM_MNU = "Konfigurovat zp�soby dopravy";
    var $_PHPSHOP_ISSHIP_FORM_ADD_LBL = "P�idat metodu dopravy";
    var $_PHPSHOP_ISSHIP_FORM_UPDATE_LBL = "Konfigurovat metodu dopravy";
    var $_PHPSHOP_ISSHIP_FORM_REFRESH_LBL = "Obnovit";
    var $_PHPSHOP_ISSHIP_FORM_CARRIER_LBL = "Zp�sob dopravy";
    var $_PHPSHOP_ISSHIP_FORM_PUBLISH_LBL = "Aktivovat";
    var $_PHPSHOP_ISSHIP_FORM_HANDLING_LBL = "Baln�";
    var $_PHPSHOP_ISSHIP_FORM_LEAD_LBL = "Lead Time";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_F_LBL = "pevn� sazba";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_P_LBL = "procenta";
    var $_PHPSHOP_ISSHIP_FORM_DAYS_LBL = "dny";
    var $_PHPSHOP_ISSHIP_FORM_HEAVY_LBL = "Nadm�rn� z�silky";
    
    
    
    /*#####################
    MODULE ORDER
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_ORDER_MOD = "Objedn�vky";
    
    // Some menu options 
    var $_PHPSHOP_ORDER_CONFIRM_MNU = "Potvrdit objedn�vku";
    var $_PHPSHOP_ORDER_CANCEL_MNU = "Zru�it objedn�vku";
    var $_PHPSHOP_ORDER_PRINT_MNU = "Vytisknout objedn�vku";
    var $_PHPSHOP_ORDER_DELETE_MNU = "Vymazat objedn�vku";
    
    // Order List
    var $_PHPSHOP_ORDER_LIST_MNU = "Seznam objedn�vek";
    var $_PHPSHOP_ORDER_LIST_LBL = "Seznam objedn�vek";
    var $_PHPSHOP_ORDER_LIST_ID = "��slo objedn�vky";
    var $_PHPSHOP_ORDER_LIST_CDATE = "Datum objedn�vky";
    var $_PHPSHOP_ORDER_LIST_MDATE = "Naposledy zm�n�no";
    var $_PHPSHOP_ORDER_LIST_STATUS = "Stav";
    var $_PHPSHOP_ORDER_LIST_TOTAL = "Mezisou�et";
    var $_PHPSHOP_ORDER_ITEM = "Objednan� zbo��";
    
    // Order print
    var $_PHPSHOP_ORDER_PRINT_PO_LBL = "Objedn�vka";
    var $_PHPSHOP_ORDER_PRINT_PO_NUMBER = "��slo objedn�vky";
    var $_PHPSHOP_ORDER_PRINT_PO_DATE = "Datum objedn�vky";
    var $_PHPSHOP_ORDER_PRINT_PO_STATUS = "Stav objedn�vky";
    var $_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL = "�daje o z�kazn�kovi";
    var $_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL = "Faktura�n� �daje";
    var $_PHPSHOP_ORDER_PRINT_CUST_SHIPPING_LBL = "�daje pro dopravu";
    var $_PHPSHOP_ORDER_PRINT_BILL_TO_LBL = "Fakturovat";
    var $_PHPSHOP_ORDER_PRINT_SHIP_TO_LBL = "Dodat";
    var $_PHPSHOP_ORDER_PRINT_NAME = "Jm�no";
    var $_PHPSHOP_ORDER_PRINT_COMPANY = "Firma";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_1 = "Adresa 1";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_2 = "Adresa 2";
    var $_PHPSHOP_ORDER_PRINT_CITY = "M�sto";
    var $_PHPSHOP_ORDER_PRINT_STATE = "St�t/Provincie";
    var $_PHPSHOP_ORDER_PRINT_ZIP = "PS�";
    var $_PHPSHOP_ORDER_PRINT_COUNTRY = "St�t";
    var $_PHPSHOP_ORDER_PRINT_PHONE = "Telefon";
    var $_PHPSHOP_ORDER_PRINT_FAX = "Fax";
    var $_PHPSHOP_ORDER_PRINT_EMAIL = "e-mail";
    var $_PHPSHOP_ORDER_PRINT_ITEMS_LBL = "Objednan� zbo��";
    var $_PHPSHOP_ORDER_PRINT_QUANTITY = "Mno�stv�";
    var $_PHPSHOP_ORDER_PRINT_QTY = "ks";
    var $_PHPSHOP_ORDER_PRINT_SKU = "K�d";
    var $_PHPSHOP_ORDER_PRINT_PRICE = "Cena";
    var $_PHPSHOP_ORDER_PRINT_TOTAL = "Celkem";
    var $_PHPSHOP_ORDER_PRINT_SUBTOTAL = "Mezisou�et";
    var $_PHPSHOP_ORDER_PRINT_TOTAL_TAX = "DPH celkem";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING = "Dopravn� a baln�";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_TAX = "DPH pro dopravn� a baln�";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LBL = "Zp�sob platby";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NAME = "Jm�no ��tu";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER = "��slo ��tu";
    var $_PHPSHOP_ORDER_PRINT_EXPIRE_DATE = "Platnost do";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL = "Z�znam plateb";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_LBL = "Informace o dod�n�";
    var $_PHPSHOP_ORDER_PRINT_PAYINFO_LBL = "Informace o platb�";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL = "Dopravce";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL = "Zp�sob dopravy";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_DATE_LBL = "Datum expedice";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL = "Dopravn�";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_MNU = "Seznam stav� objedn�vky";
    var $_PHPSHOP_ORDER_STATUS_FORM_MNU = "P�idat stav objedn�vky";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_CODE = "K�d stavu objedn�vky";
    var $_PHPSHOP_ORDER_STATUS_LIST_NAME = "N�zev stavu objedn�vky";
    
    var $_PHPSHOP_ORDER_STATUS_FORM_LBL = "Stav objedn�vky";
    var $_PHPSHOP_ORDER_STATUS_FORM_CODE = "K�d stavu objedn�vky";
    var $_PHPSHOP_ORDER_STATUS_FORM_NAME = "N�zev stavu objedn�vky";
    var $_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER = "Po�ad�";
    
    
    /*#####################
    MODULE PRODUCT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_PRODUCT_MOD = "Zbo��";
    
    var $_PHPSHOP_CURRENT_PRODUCT = "Aktu�ln� zbo��";
    var $_PHPSHOP_CURRENT_ITEM = "Aktu�ln� polo�ka";
    
    // Product Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_LBL = "Seznam zbo��";
    var $_PHPSHOP_PRODUCT_INVENTORY_MNU = "Zobrazit seznam";
    var $_PHPSHOP_PRODUCT_INVENTORY_PRICE = "Cena";
    var $_PHPSHOP_PRODUCT_INVENTORY_STOCK = "Po�et";
    var $_PHPSHOP_PRODUCT_INVENTORY_WEIGHT = "Hmotnost";
    // Product List
    var $_PHPSHOP_PRODUCT_LIST_MNU = "Seznam zbo��";
    var $_PHPSHOP_PRODUCT_LIST_LBL = "Seznam zbo��";
    var $_PHPSHOP_PRODUCT_LIST_NAME = "N�zev zbo��";
    var $_PHPSHOP_PRODUCT_LIST_SKU = "K�d";
    var $_PHPSHOP_PRODUCT_LIST_PUBLISH = "Publikovat";
    /** Changed search by date - Begin */
    var $_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE = "Vyhledej zbo��"; 
    var $_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRODUCT = "aktualizovan�";
    var $_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRICE = "s aktualizovanou cenou";
    var $_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_WITHOUTPRICE = "bez zadan� ceny";
    var $_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_AFTER = "po";
    var $_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_BEFORE = "p�ed";
    /** Changed search by date - End */
    
    // Product Form
    var $_PHPSHOP_PRODUCT_FORM_MNU = "P�idat zbo��";
    var $_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT = "Editovat toto zbo��";
    var $_PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE = "N�hled str�nky zbo�� v obchod�";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU = "P�idat polo�ku";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU = "P�idat dal�� polo�ku";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL = "Nov� zbo��";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_PRODUCT_LBL = "Upravit zbo��";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL = "Informace o zbo��";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL = "Stav  zbo��";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL = "Rozm�ry a hmotnost zbo��";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL = "Obr�zky zbo��";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL = "Nov� polo�ka";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL = "Upravit polo�ku";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL = "Informace o polo�ce";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL = "Stav polo�ky";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL = "Rozm�ry a hmotnost polo�ky";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL = "Obr�zky polo�ky";
    var $_PHPSHOP_PRODUCT_FORM_RETURN_LBL = "N�vrat k nad�azen�mu zbo��";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL = "Pro aktualizaci obr�zku zadejte cestu k nov�mu obr�zku.";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL = "Napi�te \"none\" pro smaz�n� obr�zku.";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL = "Polo�ky zbo��";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL = "Vlastnosti polo�ky";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG = "Jste si jist �e chcete smazat toto zbo��\\na polo�ky k n�mu p�ipojen�?";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG = "Jste si jist �e chcete smazat tuto polo�ku?";
    var $_PHPSHOP_PRODUCT_FORM_VENDOR = "Prodejce";
    var $_PHPSHOP_PRODUCT_FORM_MANUFACTURER = "V�robce";
    var $_PHPSHOP_PRODUCT_FORM_SKU = "K�d";
    var $_PHPSHOP_PRODUCT_FORM_NAME = "Jm�no";
    var $_PHPSHOP_PRODUCT_FORM_URL = "URL";
    var $_PHPSHOP_PRODUCT_FORM_CATEGORY = "Kategorie";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_GROSS = "Cena (s DPH)";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_NET = "Cena (bez DPH)";
    var $_PHPSHOP_PRODUCT_FORM_DESCRIPTION = "Popis str�nky zbo��";
    var $_PHPSHOP_PRODUCT_FORM_S_DESC = "Kr�tk� popis";
    var $_PHPSHOP_PRODUCT_FORM_IN_STOCK = "Na sklad�";
    var $_PHPSHOP_PRODUCT_FORM_ON_ORDER = "Objedn�no";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE = "Bude k dispozici";
    var $_PHPSHOP_PRODUCT_FORM_SPECIAL = "V akci";
    var $_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE = "Typ slevy";
    var $_PHPSHOP_PRODUCT_FORM_PUBLISH = "Publikovat?";
    var $_PHPSHOP_PRODUCT_FORM_LENGTH = "D�lka";
    var $_PHPSHOP_PRODUCT_FORM_WIDTH = "���ka";
    var $_PHPSHOP_PRODUCT_FORM_HEIGHT = "V��ka";
    var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM = "Jednotka d�lky";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT = "Hmotnost";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM = "Jednotka hmotnosti";
    var $_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE = "N�hled";
    var $_PHPSHOP_PRODUCT_FORM_FULL_IMAGE = "Obr�zek";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM_DEFAULT = "kg"; // Changed - Added
    var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM_DEFAULT = "mm"; // Changed - Added
    /** Packaging - Begin */
    var $_PHPSHOP_CART_PRICE_PER_UNIT = "Cena za "; // Changed - Added
    var $_PHPSHOP_PRODUCT_FORM_UNIT = "Jednotka"; // Changed - Added
    var $_PHPSHOP_PRODUCT_FORM_UNIT_DEFAULT = "kus"; // Changed - Added
    var $_PHPSHOP_PRODUCT_FORM_PACKAGING = "Jednotek v balen�"; // Changed - Added
    var $_PHPSHOP_PRODUCT_FORM_PACKAGING_DESCRIPTION = "Zde m��ete vyplnit po�et jednotek v balen�. (max. 65535)"; // Changed - Added
    var $_PHPSHOP_PRODUCT_FORM_BOX = "Jednotek v krabici"; // Changed - Added
    var $_PHPSHOP_PRODUCT_FORM_BOX_DESCRIPTION = "Zde m��ete vyplnit po�et jednotek v krabici. (max. 65535)"; // Changed - Added
    /** Packaging - End */
    
    // Product Display
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL = "V�sledek p�id�n� zbo��";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL = "V�sledek �pravy zbo��";
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL = "V�sledek p�id�n� polo�ky";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL = "V�sledek �pravy polo�ky";
    var $_PHPSHOP_PRODUCT_CSV_UPLOAD = "Pou��t upload CSV";
    var $_PHPSHOP_PRODUCT_FOLDERS = "Slo�ky zbo��";
    
    // Product Category List
    var $_PHPSHOP_CATEGORY_LIST_MNU = "Seznam kategori�";
    var $_PHPSHOP_CATEGORY_LIST_LBL = "Strom kategori�";
    
    // Product Category Form
    var $_PHPSHOP_CATEGORY_FORM_MNU = "P�idat kategorii";
    var $_PHPSHOP_CATEGORY_FORM_LBL = "Informace o kategorii";
    var $_PHPSHOP_CATEGORY_FORM_NAME = "N�zev kategorie";
    var $_PHPSHOP_CATEGORY_FORM_PARENT = "Nad�azen� kategorie";
    var $_PHPSHOP_CATEGORY_FORM_DESCRIPTION = "Popis kategorie";
    var $_PHPSHOP_CATEGORY_FORM_PUBLISH = "Publikovat?";
    var $_PHPSHOP_CATEGORY_FORM_FLYPAGE = "Str�nka kategorie";
    
    // Product Attribute List
    var $_PHPSHOP_ATTRIBUTE_LIST_MNU = "Seznam atribut�";
    var $_PHPSHOP_ATTRIBUTE_LIST_LBL = "Seznam atribut� pro";
    var $_PHPSHOP_ATTRIBUTE_LIST_NAME = "N�zev atributu";
    var $_PHPSHOP_ATTRIBUTE_LIST_ORDER = "Po�ad� seznamu (list order)";
    
    // Product Attribute Form
    var $_PHPSHOP_ATTRIBUTE_FORM_MNU = "P�idat atribut";
    var $_PHPSHOP_ATTRIBUTE_FORM_LBL = "Formul�� atributu";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT = "Nov� atribut pro zbo��";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT = "Upravit atribut zbo��";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM = "Nov� atribut pro polo�ku";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM = "Upravit atribut pro polo�ku";
    var $_PHPSHOP_ATTRIBUTE_FORM_NAME = "N�zev atributu";
    var $_PHPSHOP_ATTRIBUTE_FORM_ORDER = "Po�ad�";
    
    // Product Price List
    var $_PHPSHOP_PRICE_LIST_MNU = "Seznam kategori�";
    var $_PHPSHOP_PRICE_LIST_LBL = "Strom cen";
    var $_PHPSHOP_PRICE_LIST_FOR_LBL = "Cena za";
    var $_PHPSHOP_PRICE_LIST_GROUP_NAME = "N�zev skupiny";
    var $_PHPSHOP_PRICE_LIST_PRICE = "Cena";
    var $_PHPSHOP_PRODUCT_LIST_CURRENCY = "M�na";
    
    // Product Price Form
    var $_PHPSHOP_PRICE_FORM_MNU = "P�idat cenu";
    var $_PHPSHOP_PRICE_FORM_LBL = "Informace o cen�";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT = "Nov� cena zbo��";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT = "Upravit cenu zbo��";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_ITEM = "Nov� cena polo�ky";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM = "Upravit cenu polo�ky";
    var $_PHPSHOP_PRICE_FORM_PRICE = "Cena";
    var $_PHPSHOP_PRICE_FORM_CURRENCY = "M�na";
    var $_PHPSHOP_PRICE_FORM_GROUP = "Skupina z�kazn�k�";
    
    
    /*#####################
    MODULE REPORT BASIC
    #####################*/
    # Some LABELs
    var $_PHPSHOP_REPORTBASIC_MOD = "Sestavy";
    var $_PHPSHOP_RB_INDIVIDUAL = "Individu�ln� v�pis zbo��";
    var $_PHPSHOP_RB_SALE_TITLE = "Sestavy prodeje";
    
    /* labels for rpt_sales */
    var $_PHPSHOP_RB_SALES_PAGE_TITLE = "P�ehled prodeje";
    
    var $_PHPSHOP_RB_INTERVAL_TITLE = "Nastavit interval";
    var $_PHPSHOP_RB_INTERVAL_MONTHLY_TITLE = "M�s��n�";
    var $_PHPSHOP_RB_INTERVAL_WEEKLY_TITLE = "T�denn�";
    var $_PHPSHOP_RB_INTERVAL_DAILY_TITLE = "Denn�";
    
    var $_PHPSHOP_RB_THISMONTH_BUTTON = "Tento m�s�c";
    var $_PHPSHOP_RB_LASTMONTH_BUTTON = "Minul� m�s�c";
    var $_PHPSHOP_RB_LAST60_BUTTON = "Posledn�ch 60 dn�";
    var $_PHPSHOP_RB_LAST90_BUTTON = "Posledn�ch 90 dn�";
    
    var $_PHPSHOP_RB_START_DATE_TITLE = "Za��tek";
    var $_PHPSHOP_RB_END_DATE_TITLE = "Konec";
    var $_PHPSHOP_RB_SHOW_SEL_RANGE = "Zobrazit vybran� obdob� ";
    var $_PHPSHOP_RB_REPORT_FOR = "Sestava pro ";
    var $_PHPSHOP_RB_DATE = "Datum";
    var $_PHPSHOP_RB_ORDERS = "Objedn�vky";
    var $_PHPSHOP_RB_TOTAL_ITEMS = "Celkem prod�no polo�ek";
    var $_PHPSHOP_RB_REVENUE = "Tr�ba";
    var $_PHPSHOP_RB_PRODLIST = "V�pis zbo��";
    
    
    
    /*#####################
    MODULE SHOP
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOP_MOD = "Obchod";
    var $_PHPSHOP_PRODUCT_THUMB_TITLE = "Obr�zek";
    var $_PHPSHOP_PRODUCT_PRICE_TITLE = "Cena";
    var $_PHPSHOP_ORDER_STATUS_P = "Nevy��zeno";
    var $_PHPSHOP_ORDER_STATUS_C = "Potvrzeno";
    var $_PHPSHOP_ORDER_STATUS_X = "Zru�eno";
    
    
    # Some messages
    var $_PHPSHOP_ORDER_BUTTON = "Objednat";
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOPPER_MOD = "Z�kazn�ci";
    
    
    
    // Shopper List
    var $_PHPSHOP_SHOPPER_LIST_MNU = "Seznam z�kazn�k�";
    var $_PHPSHOP_SHOPPER_LIST_LBL = "Seznam z�kazn�k�";
    var $_PHPSHOP_SHOPPER_LIST_USERNAME = "U�ivatelsk� jm�no";
    var $_PHPSHOP_SHOPPER_LIST_NAME = "Pln� jm�no";
    var $_PHPSHOP_SHOPPER_LIST_GROUP = "Skupina";
    
    // Shopper Form
    var $_PHPSHOP_SHOPPER_FORM_MNU = "P�idat z�kazn�ka";
    var $_PHPSHOP_SHOPPER_FORM_LBL = "Informace o z�kazn�kovi";
    var $_PHPSHOP_SHOPPER_FORM_BILLTO_LBL = "Faktura�n� informace";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL = "Informace";
    var $_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL = "Informace o doprav�";
    var $_PHPSHOP_SHOPPER_FORM_ADD_SHIPTO_LBL = "P�idat adresu";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL = "Zkratka adresy";
    var $_PHPSHOP_SHOPPER_FORM_USERNAME = "U�ivatelsk� jm�no";
    var $_PHPSHOP_SHOPPER_FORM_FIRST_NAME = "K�estn� jm�no";
    var $_PHPSHOP_SHOPPER_FORM_LAST_NAME = "P��jmen�";
    var $_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME = "Prost�edn� jm�no";
    var $_PHPSHOP_SHOPPER_FORM_TITLE = "Titul";
    var $_PHPSHOP_SHOPPER_FORM_SHOPPERNAME = "Jm�no z�kazn�ka";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_1 = "Heslo";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_2 = "Potvrdit heslo";
    var $_PHPSHOP_SHOPPER_FORM_GROUP = "Skupina z�kazn�k�";
    var $_PHPSHOP_SHOPPER_FORM_COMPANY_NAME = "Firma";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_1 = "Adresa 1";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_2 = "Adresa 2";
    var $_PHPSHOP_SHOPPER_FORM_CITY = "M�sto";
    var $_PHPSHOP_SHOPPER_FORM_STATE = "St�t/Provincie";
    var $_PHPSHOP_SHOPPER_FORM_ZIP = "PS�";
    var $_PHPSHOP_SHOPPER_FORM_COUNTRY = "St�t";
    var $_PHPSHOP_SHOPPER_FORM_PHONE = "Telefon";
    var $_PHPSHOP_SHOPPER_FORM_PHONE2 = "Mobiln� telefon";
    var $_PHPSHOP_SHOPPER_FORM_FAX = "Fax";
    var $_PHPSHOP_SHOPPER_FORM_EMAIL = "E-mail";
    
    // Extra fields
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_1 = "I�O";
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_2 = "DI�";
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_3 = "";
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4 = "";
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4_1 = "Yes"; // Items of list for extra_field_4
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4_2 = "No";
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5 = "";
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5_1 = "AAA"; // Items of list for extra_field_5
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5_2 = "BBB";
    var $_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5_3 = "CCC";
    
    // Shopper Group List
    var $_PHPSHOP_SHOPPER_GROUP_LIST_MNU = "Seznam skupin z�kazn�k�";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_LBL = "Seznam skupin z�kazn�k�";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_NAME = "N�zev skupiny";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION = "Popis skupiny";
    
    
    // Shopper Group Form
    var $_PHPSHOP_SHOPPER_GROUP_FORM_LBL = "Formul�� skupiny z�kazn�k�";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_MNU = "P�idat skupinu z�kazn�k�";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_NAME = "N�zev skupiny";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DESC = "Popis skupiny";
    
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_STORE_MOD = "Obchod";
    
    
    // Store Form
    var $_PHPSHOP_STORE_FORM_MNU = "Nastaven� obchodu";
    var $_PHPSHOP_STORE_FORM_LBL = "Informace o obchod�";
    var $_PHPSHOP_STORE_FORM_CONTACT_LBL = "Kontaktn� informace";
    var $_PHPSHOP_STORE_FORM_FULL_IMAGE = "Logo firmy v pln� velikosti";
    var $_PHPSHOP_STORE_FORM_UPLOAD = "Nahr�t logo";
    var $_PHPSHOP_STORE_FORM_STORE_NAME = "N�zev obchodu";
    var $_PHPSHOP_STORE_FORM_COMPANY_NAME = "Provozovatel obchodu";
    var $_PHPSHOP_STORE_FORM_ADDRESS_1 = "Adresa 1";
    var $_PHPSHOP_STORE_FORM_ADDRESS_2 = "Adresa 2";
    var $_PHPSHOP_STORE_FORM_CITY = "M�sto";
    var $_PHPSHOP_STORE_FORM_STATE = "St�t/Provincie";
    var $_PHPSHOP_STORE_FORM_COUNTRY = "St�t";
    var $_PHPSHOP_STORE_FORM_ZIP = "PS�";
    var $_PHPSHOP_STORE_FORM_PHONE = "Telefon";
    var $_PHPSHOP_STORE_FORM_CURRENCY = "M�na";
    var $_PHPSHOP_STORE_FORM_CATEGORY = "Kategorie obchodu";
    var $_PHPSHOP_STORE_FORM_LAST_NAME = "P��jmen�";
    var $_PHPSHOP_STORE_FORM_FIRST_NAME = "K�estn� jm�no";
    var $_PHPSHOP_STORE_FORM_MIDDLE_NAME = "Prost�edn� jm�no";
    var $_PHPSHOP_STORE_FORM_TITLE = "Titul";
    var $_PHPSHOP_STORE_FORM_PHONE_1 = "Telefon 1";
    var $_PHPSHOP_STORE_FORM_PHONE_2 = "Telefon 2";
    var $_PHPSHOP_STORE_FORM_FAX = "Fax";
    var $_PHPSHOP_STORE_FORM_EMAIL = "E-mail";
    var $_PHPSHOP_STORE_FORM_IMAGE_PATH = "Cesta k obr�zku";
    var $_PHPSHOP_STORE_FORM_DESCRIPTION = "Popis";
    
    
    
    var $_PHPSHOP_PAYMENT = "Platby";
    // Payment Method List
    var $_PHPSHOP_PAYMENT_METHOD_LIST_MNU = "Seznam zp�sob� platby";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_LBL = "Zp�soby platby";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_NAME = "N�zev";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_CODE = "K�d";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT = "Sleva";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP = "Skupina z�kazn�k�";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR = "Typ platby";
    
    // Payment Method Form
    var $_PHPSHOP_PAYMENT_METHOD_FORM_MNU = "P�idat zp�sob platby";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LBL = "P�idat zp�sob platby";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_NAME = "N�zev zp�sobu platby";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP = "Skupina z�kazn�k�";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT = "Sleva";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_CODE = "K�d";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER = "Po�ad�";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR = "Typ zp�sobu platby";
    
    
    
    /*#####################
    MODULE TAX
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_TAX_MOD = "DPH";
    
    // User List
    var $_PHPSHOP_TAX_RATE = "Sazby DPH";
    var $_PHPSHOP_TAX_LIST_MNU = "Seznam sazeb DPH";
    var $_PHPSHOP_TAX_LIST_LBL = "Seznam sazeb DPH";
    var $_PHPSHOP_TAX_LIST_STATE = "Region pro DPH";
    var $_PHPSHOP_TAX_LIST_COUNTRY = "Sazba DPH ve st�t�";
    var $_PHPSHOP_TAX_LIST_RATE = "Sazba DPH";
    
    // User Form
    var $_PHPSHOP_TAX_FORM_MNU = "P�idat sazbu DPH";
    var $_PHPSHOP_TAX_FORM_LBL = "P�idat informaci o DPH";
    var $_PHPSHOP_TAX_FORM_STATE = "Tax State or Region";
    var $_PHPSHOP_TAX_FORM_COUNTRY = "Sazba DPH ve st�t�";
    var $_PHPSHOP_TAX_FORM_RATE = "Sazba dan� (pro 19% => vlo�te 0.19)";
    
    
    
    
    /*#####################
    MODULE VENDOR
    #####################*/
    
    
    
    # Some LABELs
    var $_PHPSHOP_VENDOR_MOD = "Prodejci";
    var $_PHPSHOP_VENDOR_ADMIN = "Prodejci";
    
    
    // Vendor List
    var $_PHPSHOP_VENDOR_LIST_MNU = "Seznam prodejc�";
    var $_PHPSHOP_VENDOR_LIST_LBL = "Prodejci";
    var $_PHPSHOP_VENDOR_LIST_VENDOR_NAME = "N�zev prodejce";
    var $_PHPSHOP_VENDOR_LIST_ADMIN = "Spr�vce";
    
    // Vendor Form
    var $_PHPSHOP_VENDOR_FORM_MNU = "P�idat prodejce";
    var $_PHPSHOP_VENDOR_FORM_LBL = "P�idat �daje";
    var $_PHPSHOP_VENDOR_FORM_INFO_LBL = "�daje o prodejci";
    var $_PHPSHOP_VENDOR_FORM_CONTACT_LBL = "Kontaktn� �daje";
    var $_PHPSHOP_VENDOR_FORM_FULL_IMAGE = "Logo v pln� velikosti";
    var $_PHPSHOP_VENDOR_FORM_UPLOAD = "Nahr�t logo";
    var $_PHPSHOP_VENDOR_FORM_STORE_NAME = "N�zev obchodu prodejce";
    var $_PHPSHOP_VENDOR_FORM_COMPANY_NAME = "N�zev firmy prodejce";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_1 = "Adresa 1";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_2 = "Adresa 2";
    var $_PHPSHOP_VENDOR_FORM_CITY = "M�sto";
    var $_PHPSHOP_VENDOR_FORM_STATE = "St�t/Provincie";
    var $_PHPSHOP_VENDOR_FORM_COUNTRY = "St�t";
    var $_PHPSHOP_VENDOR_FORM_ZIP = "PS�";
    var $_PHPSHOP_VENDOR_FORM_PHONE = "Telefon";
    var $_PHPSHOP_VENDOR_FORM_CURRENCY = "M�na";
    var $_PHPSHOP_VENDOR_FORM_CATEGORY = "Kategorie prodejce";
    var $_PHPSHOP_VENDOR_FORM_LAST_NAME = "P��jmen�";
    var $_PHPSHOP_VENDOR_FORM_FIRST_NAME = "K�estn� jm�no";
    var $_PHPSHOP_VENDOR_FORM_MIDDLE_NAME = "Prost�edn� jm�no";
    var $_PHPSHOP_VENDOR_FORM_TITLE = "Titul";
    var $_PHPSHOP_VENDOR_FORM_PHONE_1 = "Telefon 1";
    var $_PHPSHOP_VENDOR_FORM_PHONE_2 = "Telefon 2";
    var $_PHPSHOP_VENDOR_FORM_FAX = "Fax";
    var $_PHPSHOP_VENDOR_FORM_EMAIL = "e-mail";
    var $_PHPSHOP_VENDOR_FORM_IMAGE_PATH = "Cesta k obr�zku";
    var $_PHPSHOP_VENDOR_FORM_DESCRIPTION = "Popis";
    
    
    // Vendor Category List
    var $_PHPSHOP_VENDOR_CAT_LIST_MNU = "Seznam kategori� prodejc�";
    var $_PHPSHOP_VENDOR_CAT_LIST_LBL = "Seznam kategori� prodejc�";
    var $_PHPSHOP_VENDOR_CAT_NAME = "N�zev kategorie";
    var $_PHPSHOP_VENDOR_CAT_DESCRIPTION = "Popis kategorie";
    var $_PHPSHOP_VENDOR_CAT_VENDORS = "Prodejci";
    
    // Vendor Category Form
    var $_PHPSHOP_VENDOR_CAT_FORM_MNU = "P�idat kategorii prodejc�";
    var $_PHPSHOP_VENDOR_CAT_FORM_LBL = "Formul�� kategorie prodejc�";
    var $_PHPSHOP_VENDOR_CAT_FORM_INFO_LBL = "�daje o kategorii";
    var $_PHPSHOP_VENDOR_CAT_FORM_NAME = "N�zev kategorie";
    var $_PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION = "Popis kategorie";
    
    /*#####################
    MODULE MANUFACTURER
    #####################*/

    # Some LABELs
    var $_PHPSHOP_MANUFACTURER_MOD = "V�robci";
    var $_PHPSHOP_MANUFACTURER_ADMIN = "V�robci";
    
    
    // Manufacturer List
    var $_PHPSHOP_MANUFACTURER_LIST_MNU = "Seznam v�robc�";
    var $_PHPSHOP_MANUFACTURER_LIST_LBL = "V�robci";
    var $_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME = "N�zev v�robce";
    var $_PHPSHOP_MANUFACTURER_LIST_ADMIN = "Administrace";
    
    // Manufacturer Form
    var $_PHPSHOP_MANUFACTURER_FORM_MNU = "P�idat v�robce";
    var $_PHPSHOP_MANUFACTURER_FORM_LBL = "P�idat �daje";
    var $_PHPSHOP_MANUFACTURER_FORM_INFO_LBL = "�daje o v�robci";
    var $_PHPSHOP_MANUFACTURER_FORM_NAME = "N�zev v�robce";
    var $_PHPSHOP_MANUFACTURER_FORM_CATEGORY = "Kategorie v�robce";
    var $_PHPSHOP_MANUFACTURER_FORM_EMAIL = "e-mail";
    var $_PHPSHOP_MANUFACTURER_FORM_URL = "Odkaz na str�nky v�robce";
    var $_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION = "Popis";
    
    
    // Manufacturer Category List
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_MNU = "Seznam kategori� v�robc�";
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_LBL = "Kategorie v�robc�";
    var $_PHPSHOP_MANUFACTURER_CAT_NAME = "N�zev kategorie";
    var $_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION = "Popis kategorie";
    var $_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS = "V�robci";
    
    // Manufacturer Category Form
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_MNU = "P�idat kategorii v�robc�";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_LBL = "Formul�� kategori� v�robc�";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL = "�daje o kategorii";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_NAME = "N�zev kategorie";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION = "Popis kategorie";
    
    
    /*#####################
    Modul HELP
    #####################*/
    var $_PHPSHOP_HELP_MOD = "N�pov�da";
    
    // 210104 start
    
    var $_PHPSHOP_CART_ACTION = "Aktualizovat";
    var $_PHPSHOP_CART_UPDATE = "Aktualizovat mno�stv� v ko��ku";
    var $_PHPSHOP_CART_DELETE = "Vyjmout zbo�� z ko��ku";
    
    //shopbrowse form
    
    var $_PHPSHOP_PRODUCT_PRICETAG = "Cena";
    var $_PHPSHOP_PRODUCT_CALL = "Cena na zavol�n�";
    var $_PHPSHOP_PRODUCT_PREVIOUS = "P�edchoz�";
    var $_PHPSHOP_PRODUCT_NEXT = "Dal��";
    
    //ro_basket
    
    var $_PHPSHOP_CART_TAX = "DPH";
    var $_PHPSHOP_CART_SHIPPING = "Dopravn� a baln�";
    var $_PHPSHOP_CART_TOTAL = "Celkem";
    
    //CHECKOUT.INDEX
    
    var $_PHPSHOP_CHECKOUT_NEXT = "Dal��";
    var $_PHPSHOP_CHECKOUT_REGISTER = "Registrovat";
    
    //CHECKOUT.CONFIRM
    
    var $_PHPSHOP_CHECKOUT_CONF_BILLINFO = "Faktura�n� �daje";
    var $_PHPSHOP_CHECKOUT_CONF_COMPANY = "Firma";
    var $_PHPSHOP_CHECKOUT_CONF_NAME = "Jm�no";
    var $_PHPSHOP_CHECKOUT_CONF_ADDRESS = "Adresa";
    var $_PHPSHOP_CHECKOUT_CONF_PHONE = "Telefon";
    var $_PHPSHOP_CHECKOUT_CONF_FAX = "Fax";
    var $_PHPSHOP_CHECKOUT_CONF_EMAIL = "e-mail";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO = "�daje pro dod�n�";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY = "Firma";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME = "Jm�no";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS = "Adresa";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE = "Telefon";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX = "Fax";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO = "�daje pro platbu";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD = "Jm�no na kart�";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD = "Zp�sob platby";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM = "��slo kreditn� karty";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE = "Plat� do";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER = "Dokon�it objedn�vku";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO = "po�adovan� �daje p�i platb� kreditn� kartou";
    
    
    var $_PHPSHOP_ZONE_MOD = "Dod�vka podle z�n";
    
    var $_PHPSHOP_ZONE_LIST_MNU = "V�pis z�n";
    var $_PHPSHOP_ZONE_FORM_MNU = "P�idat z�nu";
    var $_PHPSHOP_ZONE_ASSIGN_MNU = "P�i�adit z�ny";
    
    // assign zone List
    var $_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL = "Zem�";
    var $_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL = "Vybran� z�na";
    var $_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL = "P�i�adit do z�ny";
    var $_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL = "Aktualizovat";
    var $_PHPSHOP_ASSIGN_ZONE_PG_LBL = "P�i�adit z�ny";
    
    // zone Form
    var $_PHPSHOP_ZONE_FORM_NAME_LBL = "N�zev z�ny";
    var $_PHPSHOP_ZONE_FORM_DESC_LBL = "Popis z�ny";
    var $_PHPSHOP_ZONE_FORM_COST_PER_LBL = "Cena za polo�ku pro z�nu";
    var $_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL = "Limit ceny pro z�nu";
    
    // List of zones
    var $_PHPSHOP_ZONE_LIST_LBL = "Seznam z�n";
    var $_PHPSHOP_ZONE_LIST_NAME_LBL = "N�zev z�ny";
    var $_PHPSHOP_ZONE_LIST_DESC_LBL = "Popis z�ny";
    var $_PHPSHOP_ZONE_LIST_COST_PER_LBL = "Cena za polo�ku pro z�nu";
    var $_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL = "Limit ceny pro z�nu";
    
    var $_PHPSHOP_LOGIN_FIRST = "Nejd��ve se pros�m p�ihlate.<br>D�kujeme.";
    var $_PHPSHOP_STORE_FORM_TOS = "Obchodn� podm�nky";
    var $_PHPSHOP_AGREE_TO_TOS = "Nejd��ve mus�te souhlasit s na�imi obchodn�mi podm�nkami.";
    var $_PHPSHOP_I_AGREE_TO_TOS = "Souhlasn�m s obchodn�mi podm�nkami";
    
    var $_PHPSHOP_LEAVE_BLANK = "(nechte PR�ZDN� pokud <br /> pro to nem�te ��dn� individu�ln� php soubor!)";
    var $_PHPSHOP_RETURN_LOGIN = "M�te ji� ��et: P�ihla�te se pros�m";
    var $_PHPSHOP_NEW_CUSTOMER = "Nov� z�kazn�k? Poskytn�te pros�m va�e faktura�n� �daje";
    var $_PHPSHOP_ACC_CUSTOMER_ACCOUNT = "��et z�kazn�ka:";
    var $_PHPSHOP_ACC_ORDER_INFO = "Objedn�vky";
    var $_PHPSHOP_ACC_UPD_BILL = "Zde m��ete upravit va�e faktura�n� �daje.";
    var $_PHPSHOP_ACC_UPD_SHIP = "Zde m��ete p�idat �i upravit va�e dodac� adresy.";
    var $_PHPSHOP_ACC_ACCOUNT_INFO = "V� ��et";
    var $_PHPSHOP_ACC_SHIP_INFO = "Informace o dod�n�";
    var $_PHPSHOP_ACC_NO_ORDERS = "Nejsou zde ��dn� objedn�vky k zobrazen�";
    var $_PHPSHOP_ACC_BILL_DEF = "- Standardn� (Stejn� jako faktura�n�)";
    var $_PHPSHOP_SHIPTO_TEXT = "M��ete k va�emu ��tu p�idat dal�� m�sta pro dopravu zbo��. Zvolte si pros�m k�d nebo zkratku dle va�eho uv�en�.";
    var $_PHPSHOP_CONFIG = "Nastaven� PHPShopu";
    var $_PHPSHOP_USERS = "U�ivatel�";
    var $_PHPSHOP_IS_CC_PAYMENT = "je platba kreditn� kartou?";
    
    /*#####################################################
     MODULE SHIPPING
    #######################################################*/
    var $_PHPSHOP_SHIPPING_MOD = "Doprava";
    var $_PHPSHOP_SHIPPING_MENU_LABEL = "Doprava";
    
    var $_PHPSHOP_CARRIER_LIST_MNU = "Seznam dopravc�";
    var $_PHPSHOP_CARRIER_LIST_LBL = "Dopravci";
    var $_PHPSHOP_RATE_LIST_MNU = "Seznam dopravn�ho";
    var $_PHPSHOP_RATE_LIST_LBL = "Dopravn�";
    var $_PHPSHOP_CARRIER_LIST_NAME_LBL = "N�zev";
    var $_PHPSHOP_CARRIER_LIST_ORDER_LBL = "Po�ad�";
    
    var $_PHPSHOP_CARRIER_FORM_MNU = "Vytvo�it dopravce";
    var $_PHPSHOP_CARRIER_FORM_LBL = "Vytvo�en� nebo �prava dopravce";
    var $_PHPSHOP_RATE_FORM_MNU = "Vytvo�it dopravn�";
    var $_PHPSHOP_RATE_FORM_LBL = "Vytvo�en� nebo �prava dopravn�ho";
    
    var $_PHPSHOP_RATE_FORM_NAME = "Detaily dopravn�ho";
    var $_PHPSHOP_RATE_FORM_CARRIER = "Dopravce";
    var $_PHPSHOP_RATE_FORM_COUNTRY = "St�t:<br /><br /><i>Pro v�b�r v�ce st�t�: pou�ijte CTRL a my�</i>";
    var $_PHPSHOP_RATE_FORM_ZIP_START = "PS� odesilatele";
    var $_PHPSHOP_RATE_FORM_ZIP_END = "PS� adres�ta";
    var $_PHPSHOP_RATE_FORM_WEIGHT_START = "Hmotnost od";
    var $_PHPSHOP_RATE_FORM_WEIGHT_END = "Hmotnost do";
    var $_PHPSHOP_RATE_FORM_VALUE = "Dopravn�";
    var $_PHPSHOP_RATE_FORM_PACKAGE_FEE = "Va�e baln�";
    var $_PHPSHOP_RATE_FORM_CURRENCY = "M�na";
    var $_PHPSHOP_RATE_FORM_VAT_ID = "DPH";
    var $_PHPSHOP_RATE_FORM_LIST_ORDER = "Po�ad�";
    
    var $_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL = "Dopravce";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME = "Popis dopravn�ho";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART = "Hmotnost od ...";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND = "... do";
    var $_PHPSHOP_CARRIER_FORM_NAME = "Dopravce";
    var $_PHPSHOP_CARRIER_FORM_LIST_ORDER = "Po�ad�";
    
    var $_PHPSHOP_ERR_MSG_CARRIER_EXIST = "CHYBA: ID dopravce ji� existuje.";
    var $_PHPSHOP_ERR_MSG_CARRIER_ID_REQ = "CHYBA: Vyberte dopravce.";
    var $_PHPSHOP_ERR_MSG_CARRIER_INUSE = "CHYBA: Nejm�n� jedno dopravn� tohoto doprace existuje, sma�te je p�ed odstran�n�m dopravce";
    var $_PHPSHOP_ERR_MSG_CARRIER_NOTFOUND = "CHYBA: Nelze nal�zt dopravce s t�mto ID.";
    
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_REQ = "CHYBA: Vyberte dopravce.";
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_INV = "CHYBA: Nelze nal�zt dopravce s t�mto ID.";
    var $_PHPSHOP_ERR_MSG_RATE_NAME_REQ = "CHYBA: Je po�adov�n popisek dopravn�ho.";
    var $_PHPSHOP_ERR_MSG_RATE_COUNTRY_CODE_INV = "CHYBA: C�lov� st�t je neplatn�. V�ce st�t� odd�lujte ";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_START_REQ = "CHYBA: Je po�adov�na minim�ln� hmotnost";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_END_REQ = "CHYBA: Je po�adov�na maxim�ln� hmotnost";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_STARTEND_INV = "CHYBA: Minim�ln� hmotnost mus� b�t ni��� ne� maxim�ln�";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_VALUE_REQ = "CHYBA: Zadejte poplatek za dopravn�";
    var $_PHPSHOP_ERR_MSG_RATE_CURRENCY_ID_INV = "CHYBA: Vyberte m�nu";

    var $_PHPSHOP_ERR_MSG_RATE_ID_REQ = "CHYBA: Dopravn� je vy�adov�no";
    
    var $_PHPSHOP_INFO_MSG_PLEASE_SELECT = "Vyberte pros�m";
    var $_PHPSHOP_INFO_MSG_CARRIER = "Dopravce";
    var $_PHPSHOP_INFO_MSG_SHIPPING_METHOD = "Dopravn�";
    var $_PHPSHOP_INFO_MSG_SHIPPING_PRICE = "Cena";
    var $_PHPSHOP_INFO_MSG_VAT_ZERO_LBL = "0 (-bez DPH-)";
    /*#####################################################
     END: MODULE SHIPPING
    #######################################################*/
    
    var $_PHPSHOP_PAYMENT_FORM_CC = "Kreditn� karta";
    var $_PHPSHOP_PAYMENT_FORM_USE_PP = "Pou��t prost�edn�ka platby";
    var $_PHPSHOP_PAYMENT_FORM_BANK_DEBIT = "Bankovn� p�evod/platba p�edem";
    var $_PHPSHOP_PAYMENT_FORM_AO = "Hotov� / dob�rkou";
    var $_PHPSHOP_CHECKOUT_MSG_2 = "Vyberte dodac� adresu!";
    var $_PHPSHOP_CHECKOUT_MSG_3 = "Vyberte zp�sob dopravy!";
    var $_PHPSHOP_CHECKOUT_MSG_4 = "Vyberte zp�sob platby!";
    var $_PHPSHOP_CHECKOUT_MSG_99 = "Zkontrolujte zadan� �daje a potvr�te objedn�vku!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIP = "Vyberte zp�sob dopravy.";
    var $_PHPSHOP_CHECKOUT_ERR_OTHER_SHIP = "Vyberte jin� zp�sob dopravy.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_PAYM = "Vyberte zp�sob platby.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR = "Zadejte ��slo va�� kreditn� karty.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNAME = "Zadejte jm�no na kreditn� kart�.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATE = "��slo kreditn� karty je neplatn�.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCMON = "Zadejte m�s�c konce platnosti kreditn� karty.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCYEAR = "Zadejte rok konce platnosti kreditn� karty.";
    var $_PHPSHOP_CHECKOUT_ERR_CCDATE_INV = "Datum platnosti je neplatn�.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIPTO = "Vyberte dodejte na adresu.";
    var $_PHPSHOP_CHECKOUT_ERR_CCNUM_INV = "Neplatn� ��slo ��tu.";
    var $_PHPSHOP_CHECKOUT_ERR_EMPTY_CART = "Nem�te nic v ko��ku!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CARR = "CHYBA: Vyberte dopravce!";
    var $_PHPSHOP_CHECKOUT_ERR_RATE_NOT_FOUND = "CHYBA: Vybran� dopravn� nebylo nalezeno!";
    var $_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND = "CHYBA: Va�e dodac� adresa nebyla nalezena!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATA = "CHYBA: Chyb� �daje o kreditn� kart�...";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR_FOUND = "CHYBA: Chyb� ��slo kreditn� karty!";
    var $_PHPSHOP_CHECKOUT_ERR_TEST = "��slo kreditn� karty je testovac� ��slo!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_USER_DATA = "U�ivatel nebyl nalezen v datab�zi!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_HOLDER_NAME = "Dosud jste nezadal vlastn�ka bankovn�ho ��tu.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_IBAN = "Zat�m jste nezadal IBAN k�d sv� banky.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_NUM = "Zat�m jste nezadal ��slo ��tu.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_SORT = "Zat�m jste nezadal k�d banky.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_NAME = "Zat�m jste nezadal n�zev banky.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_VALID_STEP = "Pro platbu je nutno zadat po�adovan� �daje!";

    var $_PHPSHOP_CHECKOUT_MSG_LOG = "Informace o platb� byla ulo�ena pro pozd�j�� zpracov�n�.<br />";
    
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV = "Minim�ln� v��e objedn�vky nebyla spln�na.";
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV2 = "Na�e minim�ln� v��e objedn�vky je:";
    var $_PHPSHOP_CHECKOUT_PAYMENT_CC = "Platba kreditn� kartou";
    var $_PHPSHOP_CHECKOUT_PAYMENT_OTHER = "dal�� metody platby";
    var $_PHPSHOP_CHECKOUT_PAYMENT_SELECT = "Vyberte metodu platby:";
    
    var $_PHPSHOP_STORE_FORM_MPOV = "Minim�ln� hodnota objedn�vky v na�em obchod�";
    var $_PHPSHOP_ACCOUNT_BANK_TITLE = "�daje o bankovn�m ��tu";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR = "��slo ��tu";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE = "K�d banky";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_NAME = "N�zev banky";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_IBAN = "IBAN";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER = "Vlastn�k ��tu";
    
    var $_PHPSHOP_MODULES = "Moduly";
    var $_PHPSHOP_FUNCTIONS = "Funkce";
    var $_PHPSHOP_SPECIAL_PRODUCTS = "Zvl�tn� zbo��";
    
    var $_PHPSHOP_CHECKOUT_CUSTOMER_NOTE = "Napi�te n�m va�i pozn�mku k objedn�vce pokud pot�ebujete.";
    var $_PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE = "Pozn�mka z�kazn�ka";
    var $_PHPSHOP_INCLUDING_TAX = "(v�etn� DPH \$tax %)";
    var $_PHPSHOP_PLEASE_SEL_ITEM = "Vyberte polo�ku";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_LBL = "Polo�ka";

    // DOWNLOADS
    
    var $_PHPSHOP_DOWNLOADS_TITLE = "Ke sta�en�";
    var $_PHPSHOP_DOWNLOADS_START = "St�hnout";
    var $_PHPSHOP_DOWNLOADS_INFO = "Pros�me vlo�te k�d souboru pro sta�en�, kter� jste obdr�eli e-mailem a klikn�te na 'St�hnout'.";
    var $_PHPSHOP_DOWNLOADS_ERR_EXP = "Litujeme, ale pro sta�en� va�ich soubor� uplynula vymezen� lh�ta";
    var $_PHPSHOP_DOWNLOADS_ERR_MAX = "Litujeme, ale byl dosa�en maxim�ln� po�et sta�en�";
    var $_PHPSHOP_DOWNLOADS_ERR_INV = "Neplatn� k�d souboru pro sta�en�!";
    var $_PHPSHOP_DOWNLOADS_ERR_SEND = "Nemohu poslat zpr�vu na ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG = "Zpr�va odesl�na na ";
    var $_PHPSHOP_DOWNLOADS_SEND_SUBJ = "Informace o stahov�n�";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_1 = "soubor(y), kter� jste objednali jsou p�ipraveny ke sta�en�";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_2 = "Pros�me zadejte n�sleduj�c� k�d(y) soubor� v na�� sekci 'Ke sta�en�' ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_3 = "maxim�ln� po�et sta�en� pro ka�d� soubor je: ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_4 = "St�hn�te dokud neuplyne lh�ta  {expire} dn� po sta�en� prvn�ho souboru";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_5 = "Dotazy? Probl�my?";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_6 = "Informace o souborech ke sta�en� od "; // e.g. Download-Info by "Storename"
    var $_PHPSHOP_PRODUCT_FORM_DOWNLOADABLE = "zbo�� ke sta�en�?"; 
    
    var $_PHPSHOP_PAYPAL_THANKYOU = "D�kujeme V�m za Va�i platbu. 
        The transaction was successful. You will get a confirmation e-mail for the transaction by PayPal. 
        You can now continue or log in at <a href=http://www.paypal.com>www.paypal.com</a> to see the transaction details.";  // nen� relevantn� pro CZ
    var $_PHPSHOP_PAYPAL_ERROR = "An error occured while processing your transaction. The status of your order could not be updated.";  // nen� relevantn� pro CZ
    
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER1 = "D�kujeme za V� n�kup. N�sleduje rekapitulace va�� objedn�vky.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER2 = "D�kujeme V�m za p��ze� a t��me se na dal�� spolupr�ci.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER3 = "M�te dotazy? Probl�my?";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER4 = "Byla p�ijata n�sleduj�c� objedn�vka.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER5 = "M��ete ji zobrazit kliknut�m na odkaz.";
    
    var $_PHPSHOP_CART_ERROR_NO_NEGATIVE = "Z�porn� mno�stv� nen� povoleno.";
    var $_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY = "Vlo�te pros�m platn� mno�stv� pro toto zbo��.";
    
    var $_PHPSHOP_CART_STOCK_1 = "0bjednali jste si v�ce zbo�� ne� m�me na sklad�. ";
    var $_PHPSHOP_CART_STOCK_2 = "Nyn� m�me \$product_in_stock kus� zbo�� skladem. ";
    var $_PHPSHOP_CART_STOCK_3 = "Klikn�te zde pro um�st�n� na seznam nevy��zen�ch objedn�vek.";
    var $_PHPSHOP_CART_SELECT_ITEM = "Please select a special item from the details page!";
    
    var $_PHPSHOP_REGISTRATION_FORM_NONE = "bez titulu";
    var $_PHPSHOP_REGISTRATION_FORM_MR = "Pan";
    var $_PHPSHOP_REGISTRATION_FORM_MRS = "Pan�.";
    var $_PHPSHOP_REGISTRATION_FORM_DR = "Ing.";
    var $_PHPSHOP_REGISTRATION_FORM_PROF = "Mgr.";
    var $_PHPSHOP_DEFAULT = "V�choz�";
    
  /*#####################################################
    MODULE AFFILIATE
  #######################################################*/
    var $_PHPSHOP_AFFILIATE_MOD   = "Adminjistrace pobo�ek";
    
    // Affiliate List
    var $_PHPSHOP_AFFILIATE_LIST_MNU		= "Seznam pobo�ek";
    var $_PHPSHOP_AFFILIATE_LIST_LBL		= "Pobo�ky";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME	= "N�zev pobo�ky";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE = "Aktivn�";
    var $_PHPSHOP_AFFILIATE_LIST_RATE		= "Sazba";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL = "Celkem za m�s�c";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION ="M�s��n� provize";
    var $_PHPSHOP_AFFILIATE_LIST_ORDERS = "Seznam objedn�vek";
    
    // Affiliate Email
    var $_PHPSHOP_AFFILIATE_EMAIL_MNU		= "Poslat e-mail pobo�k�m";
    var $_PHPSHOP_AFFILIATE_EMAIL_LBL		= "E-mail pobo�k�m";
    var $_PHPSHOP_AFFILIATE_EMAIL_WHO	= "Komu(* = v�em)";
    var $_PHPSHOP_AFFILIATE_EMAIL_CONTENT		= "Text zpr�vy";
    var $_PHPSHOP_AFFILIATE_EMAIL_SUBJECT = "P�edm�t";
    var $_PHPSHOP_AFFILIATE_EMAIL_STATS	 = "Vlo�it sou�asnou statistiku";
    
    // Affiliate Form
    var $_PHPSHOP_AFFILIATE_FORM_RATE		= "Provize (%)";
    var $_PHPSHOP_AFFILIATE_FORM_ACTIVE		= "Aktivn�?";
    
    var $_PHPSHOP_DELIVERY_TIME = "Dod�v�me b�hem";
    var $_PHPSHOP_DELIVERY_INFORMATION = "Informace o dod�vce";
    var $_PHPSHOP_MORE_CATEGORIES = "dal�� kategorie";
    var $_PHPSHOP_AVAILABILITY = "Dostupnost";
    var $_PHPSHOP_CURRENTLY_NOT_AVAILABLE = "Toto tzbo�� nen� v sou�asn� dob� k dispozici.";
    var $_PHPSHOP_PRODUCT_AVAILABLE_AGAIN = "Bude op�t k dispozici: ";
    
    var $_PHPSHOP_STATISTIC_SUMMARY = "Ovl�dac� panel";
    var $_PHPSHOP_STATISTIC_STATISTICS = "Statistika";
    var $_PHPSHOP_STATISTIC_CUSTOMERS = "Z�kazn�ci";
    var $_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS = "Aktivn� zbo��";
    var $_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS = "Neaktivn� zbo��";
    var $_PHPSHOP_STATISTIC_SUM = "Celkem";
    var $_PHPSHOP_STATISTIC_NEW_ORDERS = "Nov� objedn�vky";
    var $_PHPSHOP_STATISTIC_NEW_CUSTOMERS = "Nov� z�kazn�ci";
    
    
	//Waiting list : file /administrator/components/com_phpshop/html/shop.waiting_list.php
	var $_PHPSHOP_WAITING_LIST_MESSAGE = "Pros�me zadejte Va�i e-mailovou adresu - za�leme V�m upozorn�n�, a� bude zbo�� op�t k dispozici. 
                                        Ochrana Va�ich osobn�ch �daj� v�etn� e-mailov� adresy podl�h� platn�m z�konn�m ustanoven�m - Va�e 
                                        e-mailov� adresa bude pou�ita pouze pro v��e uveden� ��el. <br /><br />D�kujeme!";
	var $_PHPSHOP_WAITING_LIST_THANKS = "D�kujeme za �ek�n�! <br />D�me V�m v�d�t, jakmile p�ijde zbo��.";
	var $_PHPSHOP_WAITING_LIST_NOTIFY_ME = "Upozorn�te m�!";
	
	//Checkout : file /administrator/components/com_phpshop/html/checkout.thankyou.php
	var $_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW = "N�hled tisku";
  
  /**************************Admin.show_cfg.php in apparition order ;-)**************************************/
	
	/* PAGE 1 */
	var $_PHPSHOP_ADMIN_CFG_AUTORIZE_OR_CYBERCASH = "Please choose EITHER Authorize.net OR CyberCash"; // Nen� relevantn� v CZ
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS = " Nastaven� konfigura�n�ho souboru:";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE = "z�pis povolen";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE = "z�pis nepovolen";
	
	var $_PHPSHOP_ADMIN_CFG_GLOBAL = "Glob�ln�";
	var $_PHPSHOP_ADMIN_CFG_PATHANDURL = "Cesta a URL";
	var $_PHPSHOP_ADMIN_CFG_SITE = "Website";
	var $_PHPSHOP_ADMIN_CFG_SHIPPING = "Doprava";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT = "Pokladna";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS = "Stahov�n�";
	var $_PHPSHOP_ADMIN_CFG_PAYEMENTOPTIONS = "Platby";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE = "Pou��t pouze jako katalog";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN = "Pokud za�ktnete, vypnete ve�ker� funkce ko��ku.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES = "Zobrazit ceny";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX = "Zobrazit ceny v�etn� DPH?";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN = "Nastaven�, zda kupuj�c� vid� ceny v�etn� nebo bez DPH.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN = "Za�krtn�te pro zobrazen� cen. Pokud pou��v�te phpshop jako katalog, nemus�te cht�t aby se ceny zobrazily.";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX = "Virtu�ln� da�";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN = "Nastaven�, zda polo�ky s nulovou hmotnost� jsou zdan�ny (Pozn: v �R ano -> nechte neza�krtnut�). Upravte p��padn� ps_checkout.php->calc_order_taxable().";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE = "Volby sazby DPH:";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP = "Na z�klad� adresy dod�n�";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR = "Na z�klad� adresy prodejce";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN = "Nastaven�, jak� sazba DPH se pou�ije v p��pad�, �e:<br />
                                                <ul><li>sazba st�tu, odkud poch�z� prodejce</li><br/>
                                                <li>sazba st�tu, odkud poch�z� z�kazn�k.</li></ul>";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE = "Umo�nit v�ce sazeb DPH?";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN = "Za�krtn�te, pokud se pou��v� v�ce sazeb DPH (tj. nap�. 5% na z�kladn� potraviny a 19% na ostatn� zbo��)";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE = "Ode��st slevu slevu z ceny BEZ DPH/baln�ho/dopravn�ho?";
  var $_PHPSHOP_ADMIN_CFG_REVIEW = "Povolit koment��e / hodnocen�";
  var $_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN = "Jestli�e je za�krtnuto, povol�te z�kazn�k�m <strong>hodnotit zbo��</strong> a <strong>ps�t koment��e</strong> ke zbo��, <br />   
                                                                           tak�e z�kazn�ci mohou ps�t koment��e o sv�ch zku�enostech se zbo��m pro ostatn� z�kazn�ky.<br />";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN = "Nastaven�, zda ode��st slevu z ceny BEZ DPH/baln�ho/dopravn�ho (za�krtnuto) nebo V�ETN� DPH/baln�ho/dopravn�ho.";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK = "Z�kazn�ci mohou zadat sv� bankovn� spojen�?";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN = "Jestli�e je za�krtnuto, maj� z�kazn�ci p�i registraci mo�nost zadat sv� banovn� spojen�.";

	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE = "Z�kazn�ci mohou zadat st�t/region?";
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN = "Jestli�e je za�krtnuto, maj� z�kazn�c� p�i registraci mo�nost zadat st�t/region. (pozn.: pro �R/SR nechte neza�krtnut�)";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS = "Vy�adovat souhlas s obchodn�mi podm�nkami?";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN = "Jestli�e je za�krtnuto, z�kazn�c� mus� odsouhlasit obchodn� podm�nky p�ed registrac�.";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK = "Kontrolovat sklad?";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN = "Nastaven�, zda kontrolovat mno�stv� zbo�� na sklad� p�i p�id�n� polo�ky z�kazn�kem do ko��ku. 
                                                                                          Pokud je ZA�KRTNUTO, nedovol� z�kazn�kovi p�idat v�ce polo�ek, ne� je k dispozici na sklad�.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE = "Povolit program pobo�ek?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN = "T�mto umo�n�te sledov�n� pobo�ek ve frontendu. Za�krtn�te, opkud jste zadali pobo�ky v backendu..";
	
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT = "Form�t e-mailov� objedn�vky:";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT = "Textov�";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML = "HTML";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN = "T�mto se nastav�, v jak�m form�tu jsou odes�l�na e-mailov� potvrzen� objedn�vek:<br />
                                                                                        <ul><li>jako prost� text</li>
                                                                                        <li>jako form�tovan� text (HTML s obr�zky).</li></ul>";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN = "Povolit administraci z frontendu pro u�ivatele, kte�� nemaj� p��stup do backendu?";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN = "T�mto nastaven�m umo�n�te administraci z frontendu pro u�ivatele, kte�� 
                                                                                              jsou administr�to�i obchodu, ale nemaj� p��stup do backenu Mamba (tj u�ivatel� ze skupin Registered / Editor).";
	
	/* PAGE 2 */
	var $_PHPSHOP_ADMIN_CFG_URL = "URL";
	var $_PHPSHOP_ADMIN_CFG_URL_EXPLAIN = "URL Va�eho webu. Obvykle stejn� jako URL Mamba (s lom�tkem na konci!)";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE = "SECUREURL";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN = "URL Va�eho zabezpe�en�ho webu. (https - s lom�tkem na konci!)";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT = "COMPONENTURL";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN = "URL komponenty mambo-phpShop. (s lom�tkem na konci!)";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE = "IMAGEURL";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN = "URL adres��e s obr�zky komponenty mambo-phpShop.(s lom�tkem na konci!)";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH = "ADMINPATH";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN = "Cesta k adres��i komponenty mambo-phpShop.";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH = "CLASSPATH";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN = "Cesta k adres��i 'classes' komponenty mambo-phpShop.";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH = "PAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN = "Cesta k adres��i 'html' komponenty mambo-phpShop.";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH = "IMAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN = "Cesta k adres��i 'shop_image' komponenty mambo-phpShop."; 
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE = "HOMEPAGE";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN = "Str�nka, kter� bude nahr�na jako v�choz�.";	
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE = "ERRORPAGE";
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN = "V�choz� str�nka pro zobrazen� chybov�ch zpr�v.";	
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE = "DEBUGPAGE";
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN = "V�choz� str�nka pro zobrazen� lad�c�ch zpr�v.";
	var $_PHPSHOP_ADMIN_CFG_DEBUG = "LAD�N� ?";
	var $_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN = "LAD�N�?  	   	Zapne v�stup lad�n�. Zp�sob�, �e se na doln� ��sti ka�d� str�nky zobraz� lad�c� informace. Velmi u�ite�n� p�i v�voji shopu, proto�e ukazuje obsah ko��ku, hodnoty pol� ve formul���ch, atd.";


/* PAGE 3 */

	var $_PHPSHOP_ADMIN_CFG_FLYPAGE = "FLYPAGE";
	var $_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN = "Toto je v�choz� str�nka pro zobrazen� podrobnost� o zbo��.";
  var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE = "�ablona kategorie";
	var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN = "Definuje v�choz� �ablonu kategoriepro zobrazen� zbo�� v kategorii.<br />
                                                                                                      m��ete si vytvo�it nov� �ablony �pravou existuj�c�ch soubor� �ablon,<br />
                                                                                                      (um�st�n�ch v adres��i <strong>COMPONENTPATH/html/templates/</strong> a za��naj�c�ch browse_)";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW = "V�choz� po�et polo�ek na ��dku";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN = "Definuje po�et polo�ek zbo�� na ��dku. <br />
                                                                                                      Nap�.: Pokud nastav�te 4, �ablona kategorie zobraz� 4 polo�ky na ��dek";
  
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE = "Obr�zek \"chyb� obr�zek\"";
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN = "Tento obr�zek bude zobrazen, pokud obr�zek zbo�� nen� k dispozici.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS = "Po�et ��dk� v�sledk� hled�n�";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN = "Definuje po�et ��dk� v�sledk� hled�n� na str�nku.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 = "SEARCH COLOR 1";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN = "Definuje barvu lich�ch ��dk� v�sledk� hled�n�.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 = "SEARCH COLOR 2";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN = "Definuje barvu sud�ch ��dk� v�sledk� hled�n�.";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS = "Max. ��dk�";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN = "Definuje po�et zobrazen�ch ��dk� v seznamu objedn�vek (? order list select box).";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION = "Zobrazit \"powered by mambo-phpShop\" ?";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN = "Zobraz� obr�zek powered-by-mambo-phpShop v z�pat�.";
	
	
	/* PAGE 4 */
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD = "Vyberte metodu dopravy zbo�� pou�itou pro V� obchod";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD = "Standardn� modul dopravy zbo�� s indiviu�ln�m nastaven�m dopravc� a sazeb. <strong>DOPORU�ENO !</strong>";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE = "  	Zone Shipping Module Country Version 1.0<br />
                                                                                                            For more information on this module please visit <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br />
                                                                                                            for details or contact <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a><br /> Check this to enable the zone shipping module";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS = "<a href=\"http://www.ups.com\" target=\"_blank\">UPS Online(R) Tools</a> Shipping calculation";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE = "UPS access code";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN = "Your UPS access code";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID = "UPS user id";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN = "The user ID you got from UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD = "UPS password";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN = "The password for your UPS account";
	  
  var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER = "InterShipper Module. Check only if you have an <a href=\"http://www.intershipper.com\" target=\"_blank\">Intershipper.com</a> account";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE = "Vypnout v�b�r zp�sobu dopravy. Vyberte, pokud z�kazn�ci kupuj� zbo�� ke sta�en�, kter� k nim nemus� b�t dopraveno.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD = "InterShipper Password";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD_EXPLAIN = "Your password for your intershipper account.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL = "InterShipper email";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL_EXPLAIN = "Your email address for your intershipper account.";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY = "�ifrovac� kl��";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN = "Po��v� se k za�ifrov�n� dat v datab�zi. Znamen� to, �e tento soubor by m�l nastavena p��stupov� pr�va, aby nemohl b�t zobrazen nik�m nepovolan�m.";
	
	
	/* PAGE 5 */
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR = "Zobrazit postup odbaven� objedn�vky?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN = "Za�krtn�te, pokud chcete zobrazit  postup odbaven� objedn�vky ( 1 - 2 - 3 - 4 s obr�zky).";
	
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS = "Vyberte postup odbaven� objedn�vky";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD = "<strong>Standardn� :</strong><br/>
               1. Zad�n� dodac� adresy<br />
              2. Zad�n� zp�sobu dopravy<br />
              3. Zad�n� zp�sobu platby<br />
              4. Potvrzen� objedn�vky";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 = "<strong>Postup 2:</strong><br/>
               1. Zad�n� dodac� adresy<br />
              2. Zad�n� zp�sobu platby<br />
              3. Potvrzen� objedn�vky";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 = "<strong>Postup 3:</strong><br/>
               1. Zad�n� zp�sobu dopravy<br />
              2. Zad�n� zp�sobu platby<br />
              3. Potvrzen� objedn�vky";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 = "<strong>Postup 4:</strong><br/>
               1. Zad�n� zp�sobu platby<br />
              2. Potvrzen� objedn�vky";
	
	
	
	/* PAGE 6 */
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS = "Umo�nit stahov�n� zbo��";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN = "Povol� mo�nost stahov�n� zbo��. Pou�ijte pouze opkud chcete prod�vat zbo�� ke sta�en�.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS = "Stav objedn�vky umo��uj�c� sta�en�";
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN = "Vyberte stav objedn�vky p�i kter�m je z�kazn�k e-mailem upozorn�n, �e je zbo�� ke sta�en�.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS = "Stav objedn�vky znemo��uj�c� sta�en�";
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN = "Vyberte stav objedn�vky p�i kter�m je sta�en� z�kazn�kovi znemo�n�no.";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT = "DOWNLOADROOT";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN = "Fyzick� cesta k soubor�m ke sta�en� z�kazn�ky. (lom�tko na konci!)<br>
        <span class=\"message\">V z�jmu zabezpe�en� va�eho obchodu: Pokud m��ete, pou�ijte adres�� KDEKOLIV MIMO KO�ENOV�HO ADRES��E VA�EHO WEBU </span>";
	
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX = "Maximum sta�en�";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN = "Nastav� max. op�et sta�en� z�kazn�kem na z�klad� jednoho k�du zbo�� ke sta�en� (na jednu objedn�vku)";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE = "Lh�ta pro sta�en�";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN = "Nastav� �asov� interval <strong>v sekund�ch</strong> po kter� je z�kazn�kovi umo�n�no sta�en� zbo��. 
  Tento interval za��n� prvn�m sta�en�m! Pokud lh�ta uplyne, k�d zbo�� ke sta�en� ja zablokov�n.<br />Pozn�mka: 86400s=24h.";
	
	
	
	
	/* PAGE 7    Nen� relevantn� pro �R - nep�ekl�d�no*/
	
	
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
    var $_PHPSHOP_ADVANCED_SEARCH  ="Roz���en� vyhled�v�n�";
    var $_PHPSHOP_SEARCH_ALL_CATEGORIES = "Prohled�vat v�echny kategorie";
    var $_PHPSHOP_SEARCH_ALL_PRODINFO = "Prohled�vat ve�ker� informace o zbo��";
    var $_PHPSHOP_SEARCH_PRODNAME = "Jen n�zvy zbo��";
    var $_PHPSHOP_SEARCH_MANU_VENDOR = "Jen v�robce �i prodejce";
    var $_PHPSHOP_SEARCH_DESCRIPTION = "Jen popis zbo��";
    var $_PHPSHOP_SEARCH_AND = "and";
    var $_PHPSHOP_SEARCH_NOT = "not";
    var $_PHPSHOP_SEARCH_TEXT1 = "Nejd��ve vyberte z rozbalovac�ho seznamu kategorii pro omezen� vyhled�v�n�. 
        Druh� rozbalovac� seznam umo��uje omezit vyhled�v�n� na ur�itou ��st informace o zbo�� (nap�. N�zev).
        Po vybr�n� t�chto dopl�uj�c�ch �daj� (m��ete je ov�em ponechat na standardn�m nastaven� pro hled�n� ve v�ech �daj�ch) vlo�te slovo, kter� chcete vyhledat.";
    var $_PHPSHOP_SEARCH_TEXT2 = " M��ete d�le zp�es�it v� v�b�r p�id�n�m druh�ho kl��ov�ho slova a v�b�ru logick�ho oper�toru AND, NOT. 
        A znamen� �e mus� b�t ob� slova v �daj�ch vyhledan�ho zbo�� p��tomna. 
        Ne znamen� �e zbo�� bude vyhled�no, pokud v �daj�ch bude p��tomno prvn� slovo a druh� ne.";
    var $_PHPSHOP_ORDERBY = "Se�adit podle";
    
    /*** Review feature ***/
    var $_PHPSHOP_CUSTOMER_RATING  = "Pr�m�rn� hodnocen�";
    var $_PHPSHOP_TOTAL_VOTES = "Celkem hlas�";
    var $_PHPSHOP_CAST_VOTE = "Pros�m hodno�te";
    var $_PHPSHOP_RATE_BUTTON = "Hodnotit";
    var $_PHPSHOP_RATE_NOM = "Hodnocen�";
    var $_PHPSHOP_REVIEWS = "Hodnocen� z�kazn�k�";
    var $_PHPSHOP_NO_REVIEWS = "Zat�m zde nen� ��dn� hodnocen�.";
    var $_PHPSHOP_WRITE_FIRST_REVIEW = "Napi�te prvn� hodnocen�...";
    var $_PHPSHOP_REVIEW_LOGIN = "Mus�te se p�ihl�sit, abyste mohlI hodnotit.";
    var $_PHPSHOP_REVIEW_ERR_RATE = "Ohodno�te pros�m polo�ku!";
    var $_PHPSHOP_REVIEW_ERR_COMMENT1 = "Napi�te del�� hodnocen�, minim�ln� 100 znak�";
    var $_PHPSHOP_REVIEW_ERR_COMMENT2 = "Hodnocen� je p��li� dlouh�, povoleno je maxim�ln� 2000 znak�";
    var $_PHPSHOP_WRITE_REVIEW = "Napi�te va�e hodnocen� tohoto zbo��!";
    var $_PHPSHOP_REVIEW_RATE = "Nejd��ve zbo�� ohodno�te. Vyberte mezi 0 (nejhor��) a 5 (nejlep��) hv�zdi�kama.";
    var $_PHPSHOP_REVIEW_COMMENT = "Nyn� napi�te hodnocen� ....(min. 100, max. 2000 znak�) ";
    var $_PHPSHOP_REVIEW_COUNT = "Znak� naps�no: ";
    var $_PHPSHOP_REVIEW_SUBMIT = "Odeslat hodnocen�";
    var $_PHPSHOP_REVIEW_ALREADYDONE = "Hodnocen� tohoto zbo�� jste u� napsal. D�kujeme v�m.";
    var $_PHPSHOP_REVIEW_THANKYOU = "D�kujeme v�m za ohodnocen�.";
    var $_PHPSHOP_COMMENT= "Koment��";
    
    var $_PHPSHOP_CREDITCARD_FORM_LBL = "P�idat/Upravit typy kreditn�ch karet";
    var $_PHPSHOP_CREDITCARD_NAME = "N�zev kreditn� karty";
    var $_PHPSHOP_CREDITCARD_CODE = "K�d kreditn� karty";
    var $_PHPSHOP_CREDITCARD_TYPE = "Typ kreditn� karty";
    
    var $_PHPSHOP_CREDITCARD_LIST_LBL = "Seznam kreditn�ch karet";
    var $_PHPSHOP_UDATE_ADDRESS = "Upravit adresu";
    var $_PHPSHOP_CONTINUE_SHOPPING = "Pokra�ovat v nakupov�n�";
    
    var $_PHPSHOP_THANKYOU_SUCCESS = "Va�e objedn�vka byla �sp�n� p�ijata!";
    var $_PHPSHOP_ORDER_LINK = "Klikn�te zde pro zobrazen� detail� o objedn�vce.";
    
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "stav va�� objedn�vky ��slo {order_id} byl zm�n�n.";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "Nov� stav je:";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "Pro zobrazen� detail� o objedn�vce klikn�te zde nebo zkop�rujte odkaz do va�eho prohl�e�e:";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "Zm�na stavu objedn�vky: {order_id}";
    var $_PHPSHOP_ORDER_LIST_NOTIFY = "Informovat z�kazn�ka?";
    var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "Vyberte nejd��ve zm�nu stavu!";
    
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "Sleva pro v�choz� skupinu z�kazn�k� (v %)";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = "Kladn� hodnota X znamen�: Pokud nem� p�i�azenu cenu pro TUTO skupinu z�kazn�k�, v�choz� cena je sn�ena o X %. Z�porn� hodnota m� opa�n� efekt.";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_LBL = "Sleva";
    var $_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL = "Seznam slev na zbo��";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT = "P�idat/upravit slevu";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT = "��stka";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP = "Zadejte ��stku";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE = "Typ slevy";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT = "Procento";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL = "Celkem";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP = "Je cena ud�v�na jako procento nebo ��stka?";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE = "Za��tek obdob� slevy";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP = "Ud�v� den, kdy sleva za��n�";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE = "Konec obdob� slevy";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP = "Ud�v� den, kdy sleva kon��";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP = "K p�id�n� slevy pou�ijte formul�� slevy dan�ho zbo��!";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_SAVE = "U�et��te";
    
    var $_PHPSHOP_FLYPAGE_ENLARGE_IMAGE = "Zobrazit v pln� velikosti";
    
/*********************
Currency Display Style 
***********************/
    var $_PHPSHOP_CURRENCY_DISPLAY = "Zobrazen� m�ny";
    var $_PHPSHOP_CURRENCY_SYMBOL = "Symbol m�ny";
    var $_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP = "M��et zde pou��t i HTML entity  (tj. &amp;euro;,&amp;pound;,&amp;yen;,...)";
    var $_PHPSHOP_CURRENCY_DECIMALS = "Desetinn� m�sty";
    var $_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP = "Po�et desetinn�ch m�st (m��e b�t 0)<br><b>Prov�d� se zaokrouhlen�, pokud m� hodnota vy��� po�et desetinn�ch m�st.</b>";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL = "Odd�lova� desetinn�ch m�st";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP = "Symbol pro odd�len� desetinn�ch m�st (obvykle ',') symbol";
    var $_PHPSHOP_CURRENCY_THOUSANDS = "Odd�lova� tis�c�";
    var $_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP = "Symbol pro odd�len� tis�c�  (obvykle mezera nabo m��e b�t pr�zdn�)";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY = "Form�t kladn�ho ��sla";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP = "Form�t pro zobrazen� kladn�ch ��sel.<br>(Symb = symbol m�ny)";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY = "Form�t z�porn�ho ��sla";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP = "Form�t pro zobrazen� z�porn�ch ��sel.<br>(Symb = symbol m�ny)";
    
    var $_PHPSHOP_OTHER_LISTS = "Dal�� seznamy zbo��";
/**************
Multiple Images 
****************/
    var $_PHPSHOP_MORE_IMAGES = "Zobrazit v�ce obr�zk�";
    var $_PHPSHOP_AVAILABLE_IMAGES = "Dostupn� obr�zky pro";
    var $_PHPSHOP_BACK_TO_DETAILS = "Zp�t k detail�m o zbo��";
    
    /* FILEMANAGER */
    var $_PHPSHOP_FILEMANAGER = "Spr�vce soubor�";
    var $_PHPSHOP_FILEMANAGER_LIST = "Spr�vce soubor�::Seznam zbo��";
    var $_PHPSHOP_FILEMANAGER_ADD = "P�idat obr�zek/soubor";
    var $_PHPSHOP_FILEMANAGER_IMAGES = "P�i�azen� obr�zky";
    var $_PHPSHOP_FILEMANAGER_DOWNLOADABLE = "Ke sta�en�?";
    var $_PHPSHOP_FILEMANAGER_FILES = "P�i�azen� soubory (katalog. listy,...)";
    var $_PHPSHOP_FILEMANAGER_PUBLISHED = "Publikov�no?";
    
    /* FILE LIST */
    var $_PHPSHOP_FILES_LIST = "Spr�vce soubor�::Seznam obr�zk�/soubor� pro:";
    var $_PHPSHOP_FILES_LIST_FILENAME = "Soubor";
    var $_PHPSHOP_FILES_LIST_FILETITLE = "N�zev";
    var $_PHPSHOP_FILES_LIST_FILETYPE = "Typ";
    var $_PHPSHOP_FILES_LIST_EDITFILE = "Upravit";
    var $_PHPSHOP_FILES_LIST_FULL_IMG = "Pln� velikost";
    var $_PHPSHOP_FILES_LIST_THUMBNAIL_IMG = "N�hled";
    
    
    /* FILE FORM */
    var $_PHPSHOP_FILES_FORM = "Nahr�t soubor pro";
    var $_PHPSHOP_FILES_FORM_CURRENT_FILE = "Vybran� soubor";
    var $_PHPSHOP_FILES_FORM_FILE = "Soubor";
    var $_PHPSHOP_FILES_FORM_IMAGE = "Obr�zek";
    var $_PHPSHOP_FILES_FORM_UPLOAD_TO = "nahr�t do";
    var $_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH = "v�choz�ho um�st�n� obr�zk�";
    var $_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH = "Zadejte um�st�n�";
    var $_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH = "Um�st�n� soubor� ke sta�en� (P�i prodeji zbo�� ke sta�en�!)";
    var $_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL = "Automaticky vytvo�it n�hled?";
    var $_PHPSHOP_FILES_FORM_FILE_PUBLISHED = "soubor je publikov�n?";
    var $_PHPSHOP_FILES_FORM_FILE_TITLE = "Titulek souboru (co vid� z�kazn�k)";
    var $_PHPSHOP_FILES_FORM_FILE_DESC = "Popis souboru";
    var $_PHPSHOP_FILES_FORM_FILE_URL = "URL souboru (voliteln�)";
    
    /* FILE & IMAGE PROCESSING */
    var $_PHPSHOP_FILES_PATH_ERROR = "Zadejte platnou cestu!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS = "N�hled byl �sp�n� vytvo�en!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE = "Nemohu vytvo�it n�hled!";
    var $_PHPSHOP_FILES_UPLOAD_FAILURE = "CHYBA p�i nahr�v�n� souboru/obr�zku";
    
    var $_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE = "Nemohu smazat soubor obr�zku v pln� velikosti.";
    var $_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS = "Soubor obr�zku v pln� velikosti �sp�n� smaz�n.";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE = "Nemohu smazat soubor n�hledu obr�zku (mo�n� neexistuje): ";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS = "Soubor n�hledu obr�zku �sp�n� smaz�n.";
    var $_PHPSHOP_FILES_FILE_DELETE_FAILURE = "Nemohu smazat soubor.";
    var $_PHPSHOP_FILES_FILE_DELETE_SUCCESS = "Soubor �sp�n� smaz�n.";
    
    var $_PHPSHOP_FILES_NOT_FOUND = "Po�adovan� soubor nebyl nalezen!";
    var $_PHPSHOP_IMAGE_NOT_FOUND = "Obr�zek nebyl nalezen!";
    
    /*#####################
    MODULE COUPON
    #####################*/
    
    var $_PHPSHOP_COUPON_MOD = "Slevov� kup�ny";
    var $_PHPSHOP_COUPONS = "Slevov� kup�ny";
    var $_PHPSHOP_COUPON_LIST = "Seznam slevov�ch kup�n�";
    var $_PHPSHOP_COUPON_ALREADY_REDEEMED = "V� kup�n byl u� pou�it.";
    var $_PHPSHOP_COUPON_REDEEMED = "Slevov� kup�n byl p�ijat! D�kujeme.";
    var $_PHPSHOP_COUPON_ENTER_HERE = "Jestli�e m�te k�d ke slevov�mu kup�nu, vlo�te jej n�e:";
    var $_PHPSHOP_COUPON_SUBMIT_BUTTON = "Odeslat";
    var $_PHPSHOP_COUPON_CODE_EXISTS = "Tento k�d kup�nu u� existuje. Zkuste znova.";
    var $_PHPSHOP_COUPON_EDIT_HEADER = "Upravit slevov� kup�n";
    var $_PHPSHOP_COUPON_EDIT_HELP_TEXT = "Klikn�te na k�d kup�nu pro editaci, pro smaz�n� na n�j klikn�te a vyberte Smazat:";
    var $_PHPSHOP_COUPON_CODE_HEADER = "K�d";
    var $_PHPSHOP_COUPON_PERCENT_TOTAL = "Procenta nebo ��stka";
    var $_PHPSHOP_COUPON_TYPE = "Typ kup�nu";
    var $_PHPSHOP_COUPON_TYPE_TOOLTIP = "Jednor�zov� kup�n je vymaz�n po pou�it� a p�izn�n� slevy. Trval� kup�n m��e b�t pou��v�n neomezen�.";
    var $_PHPSHOP_COUPON_TYPE_GIFT = "Jednor�zov� kup�n";    
    var $_PHPSHOP_COUPON_TYPE_PERMANENT = "Trval� kup�n";    
    var $_PHPSHOP_COUPON_VALUE_HEADER = "Hodnota";
    var $_PHPSHOP_COUPON_DELETE_BUTTON = "Smazat k�d";
    var $_PHPSHOP_COUPON_CONFIRM_DELETE = "Opravdu smazat tento k�d kup�nu?";
    var $_PHPSHOP_COUPON_COMPLETE_ALL_FIELDS = "Vypl�te pros�m v�echny polo�ky.";
    var $_PHPSHOP_COUPON_VALUE_NOT_NUMBER = "Hodnota kup�nu mus� b�t ��slo.";
    var $_PHPSHOP_COUPON_NEW_HEADER = "Nov� kup�n";
    var $_PHPSHOP_COUPON_COUPON_HEADER = "K�d kup�nu";
    var $_PHPSHOP_COUPON_PERCENT = "Procenta";
    var $_PHPSHOP_COUPON_TOTAL = "��stka";
    var $_PHPSHOP_COUPON_VALUE = "Hodnota";
    var $_PHPSHOP_COUPON_CODE_SAVED = "K�d kup�nu byl ulo�en.";
    var $_PHPSHOP_COUPON_SAVE_BUTTON = "Ulo�it kup�n";
    var $_PHPSHOP_COUPON_DISCOUNT = "Sleva na kup�n";
    var $_PHPSHOP_COUPON_CODE_INVALID = "K�d kup�nu nenalezen, zkuste jin�.";
    var $_PHPSHOP_COUPONS_ENABLE = "Povolit pou��v�n� kup�n�";
    var $_PHPSHOP_COUPONS_ENABLE_EXPLAIN = "Jestli�e povol�te pou��v�n� kup�nu, mohou z�kazn�ci zadat k�d kup�nu pro uplatn�n� slevy na objedn�vku.";    
    
    /* Free Shipping */
    var $_PHPSHOP_FREE_SHIPPING = "Baln� a doprava zdarma";
    var $_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT = "Pro tuto objedn�vku je baln� a doprava zdarma!";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT = "Minim�ln� objedn�vky pro baln� a dopravu zdarma";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP = "Objedn�vka (V�etn� DPH!),  kter� je minim�ln� pro baln� a dopravu zdarma 
                                                (Nap�.: <strong>5000</strong> znamen� baln� a dopravu zdarma, pokud si z�kazn�k 
                                                 objedn� za 5000 K� (v�. DPH) �i v�ce.";
    var $_PHPSHOP_YOUR_STORE = "V� obchod";
    var $_PHPSHOP_CONTROL_PANEL = "Ovl�dac� Panel";
    
    /* Configuration Additions */
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON = "Tla��tko PDF";
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN = "Zobraz� �i schov� tla��tko PDF";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER = "Vy�adovat souhlas s obchodn�mi podm�nkami pro KA�DOU OBJEDN�VKU?";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN = "Jestli�e je za�krtnuto, z�kazn�c� mus� odsouhlasit obchodn� podm�nky p�i KA�D� OBJEDN�VCE (p�ed jej�m potvrzen�m).";
    
    // We need this for eCheck.net Payments     - nen� relevantn� pro �R
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE = "Bank Account Type";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING = "Checking";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING = "Business Checking";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS = "Saving";
    
    var $_PHPSHOP_PAYMENT_AN_RECURRING = "Recurring Billings?";
    var $_PHPSHOP_PAYMENT_AN_RECURRING_TOOLTIP = "Define wether you want recurring billings.";
    
    var $_PHPSHOP_INTERNAL_ERROR = "Internal Error processing the Request to";
    var $_PHPSHOP_PAYMENT_ERROR = "Failure in Processing the Payment";
    var $_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS = "Payment successfully processed";
    
    /* UPS Shipping Module - nen� relevantn� pro �R - nep�ekl�d�no */
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
    
    var $_PHPSHOP_ERROR_CODE = "K�d chyby";
    var $_PHPSHOP_ERROR_DESC = "Popis chyby";
    
    var $_PHPSHOP_CHANGE_TRANSACTION_KEY = "Zobrazit/zm�nit k�d transakce";
    var $_PHPSHOP_CHANGE_PASSKEY_FORM = "Zobrazit/zm�nit heslo/k�d transakce";
    var $_PHPSHOP_TYPE_PASSWORD = "Vlo�te heslo u�ivatele";
    var $_PHPSHOP_CURRENT_PASSWORD = "Sou�asn� heslo";
    var $_PHPSHOP_CURRENT_TRANSACTION_KEY = "Sou�asn� k�d transakce";
    var $_PHPSHOP_CHANGE_PASSKEY_SUCCESS = "K�d transakce byl �sp�n� zm�n�n.";
    
    var $_PHPSHOP_PAYMENT_CVV2 = "Request/Capture Credit Card Code Value (CVV2/CVC2/CID)";
    var $_PHPSHOP_PAYMENT_CVV2_TOOLTIP = "Check for a valid CVV2/CVC2/CID value (three- or four-digit number on the back of a credit card, on the Front of American Express Cards)?";
    var $_PHPSHOP_CUSTOMER_CVV2_TOOLTIP = "Please type in the three- or four-digit number on the back of your credit card (On the Front of American Express Cards)";
    var $_PHPSHOP_CUSTOMER_CVV2_ERROR = "You need to enter your Credit Card Code to proceed.";
    
    var $_PHPSHOP_PRODUCT_FORM_FILENAME = "BU� zadejte n�zev souboru";
    var $_PHPSHOP_PRODUCT_FORM_FILENAME_TOOLTIP = "POZN�MKA: Zde m��ete zadat n�zev souboru. <strong>Pokud jej zad�te, ��dn� soubor nebude nahr�n!!! Mus�te je nahr�t manu�ln� p�es FTP!</strong>.";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD = "NEBO nahrajte nov� soubor";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD_TOOLTIP = "m��ete nahr�t m�stn� soubor. Tento soubor bude zbo��m, kter� prod�v�te. Existuj�c� soubor bude p�eps�n.";
    
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1 = "Napi�tte jak�koliv text, kter� bude zobrazen z�kazn�kovi na str�nce zbo�� .<br />tj.: 24h, 48h, 3 - 5 dn�, objedn�no.....";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2 = "NEBO vyberte obr�zek, kter� bude zobrazen na str�nce detailn�ho popisu zbo�� .<br />Obr�zky jsou um�st�ny v adres��i <i>/components/com_phpshop/shop_image/availability</i><br />";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST = "Seznam atribut�";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES = "<h4>P��klady form�tu seznamu atribut�:</h4>
        <pre>Velikost,XL[+100],M,S[-50];Barva,�erven�,zelen�,�lut�,drah� barva[=999];atd..,..,..</pre>
        <h4>Vlo�en� nastaven� cen pro pokro�il� nastaven� atribut�:</h4>
        <pre>
        &#43; == P�i��st tuto ��stku k v�choz� cen�.<br />
        &#45; == Ode��st tuto ��stku od v�choz� ceny.<br />
        &#61; == Nastavit cenu na tuto ��stku.
       </pre>";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST = "Seznam speci�ln�ch atribut�";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES = "<h4>P��klad form�tu seznamu speci�ln�ch atribut�:</h4>
        <pre>N�zev;Dal��;...</pre>";
  
    var $_PHPSHOP_MULTISELECT = "V�b�r v�ce polo�ek: pou�ijte kl�vesu CTRL + my�";

/*   Nen� relevantn� pro �R - nep�ekl�d�no */        
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

  var $_PHPSHOP_RELATED_PRODUCTS = "P��buzn� polo�ky";
    var $_PHPSHOP_RELATED_PRODUCTS_TIP = "Pomoc� tohoto seznamu m��ete definovat p��buzn� polo�ky. Vyberte jednu nebo v�ce (CTRL + my�) polo�ek, ze kter�ch chcete vytvo�it <strong>p��buzn� polo�ky</strong>.";
    
    var $_PHPSHOP_RELATED_PRODUCTS_HEADING = "Mohlo by V�s zaj�mat i toto zbo��";
    
    var $_PHPSHOP_IMAGE_ACTION = "Akce obr�zku";
    var $_PHPSHOP_NONE = "nic";
    
    var $_PHPSHOP_ORDER_HISTORY = "Historie objedn�vek";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT = "Pozn�mka";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT_EMAIL = "Pozn�mka k Va�� objedn�vce";
    var $_PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT = "P�idat pozn�mku?";
    var $_PHPSHOP_ORDER_HISTORY_DATE_ADDED = "P�id�no dne";
    var $_PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED = "Z�kazn�k upozorn�n?";
    var $_PHPSHOP_ORDER_STATUS_CHANGE = "Zm�na stavu objedn�vky";
    
     /* USPS Shipping Module - Nen� relevantn� pro �R - nep�ekl�d�no */     
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
    var $_PHPSHOP_PARAMETERS_LBL = "Parametry";
    var $_PHPSHOP_PRODUCT_TYPE_LBL = "Typ zbo��";
    var $_PHPSHOP_PRODUCT_TYPE_LIST_LBL = "Typy zbo��";
    var $_PHPSHOP_PRODUCT_TYPE_ADDEDIT = "P�idat/upravit typ zbo��";
    // Product - Product Product Type list
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL = "Typy zbo�� pro";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_MNU = "Seznam typ� zbo��";
    // Product - Product Product Type form
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL = "P�idat typ zbo�� pro";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_MNU = "P�idat typ zbo��";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE = "Typ zbo��";
    // Product - Product Type form
    var $_PHPSHOP_PRODUCT_TYPE_FORM_NAME = "N�zev typu zbo��";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION = "Popis typu zbo��";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS = "Parametry";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_LBL = "Informace o typu zbo��";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH = "Publikovat?";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE = "Str�nka (seznam) typ� zbo��";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE = "Str�nka typu zbo��";
    // Product - Product Type Parameter list
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL = "Parametry typu zbo��";
    // Product - Product Type Parameter form
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LBL = "Informace o parametru";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NOT_FOUND = "Typ zbo�� nebyyl nalezen!";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME = "N�zev parametru";
    VAR $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME_DESCRIPTION = "This name will be column name of table. Must be unicate and without space.<BR>For example: main_material";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL = "Zkr�cen� popis parametru";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DESCRIPTION = "Popis parametru";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE = "Typ parametru";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_INTEGER = "Cel� ��slo";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TEXT = "Text";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_SHORTTEXT = "Kr�tk� text";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_FLOAT = "Float";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_CHAR = "Char";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATETIME = "Datum & �as";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE = "Datum";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE_FORMAT = "RRRR-MM-DD";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME = "�as";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME_FORMAT = "HH:MM:SS";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_BREAK = "Break Line";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_MULTIVALUE = "V�ce hodnot";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES = "Zadan� hodnoty";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_MULTISELECT = "Zobrazit Zadan� hodnoty jako v�b�r vice polo�ek?";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES_DESCRIPTION = "<strong>Pokud zad�ta Zadan� hodnoty, parametr m��e nab�vat pouze t�chto hodnot. P��klad:</strong><BR><span class=\"sectionname\">D�evo;Kov;Plast;...</span>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT = "V�choz� hodnota";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT_HELP_TEXT = "Pro v�choz� hodnotu pou�ijte tento form�t:<ul><li>Datum: RRRR-MM-DD</li><li>�as: HH:MM:SS</li><li>Datum & �as: RRRR-MM-DD HH:MM:SS</li></ul>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_UNIT = "Jednotka";
    
	/************************* FrontEnd ***************************/
	/** shop.parameter_search.php */
	var $_PHPSHOP_PARAMETER_SEARCH = "Pokro�il� vyhled�v�n� podle parametr�";
	var $_PHPSHOP_ADVANCED_PARAMETER_SEARCH = "Pokro�il� vyhled�v�n� podle parametr�";
	var $_PHPSHOP_PARAMETER_SEARCH_TEXT1 = "Chcete vyhled�vat zbo�� podle technick�ch parametr�?<BR>Vyberte typ parametru ze seznamu:";
// 	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "Nebylo nalezeno ��dn� zbo�� vyhovuj�c� Va�emu dotazu.";
	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "Lituji. Nebyla zad�na kategorie pro vyhled�v�n�.";
  	/** shop.parameter_search_form.php */
	var $_PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE = "Lituji. Nebyl publikov�n typ zbo�� s t�mto n�zvem.";	
	var $_PHPSHOP_PARAMETER_SEARCH_IS_LIKE = "Is Like";
	var $_PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE = "Is NOT Like";
	var $_PHPSHOP_PARAMETER_SEARCH_FULLTEXT = "Fulltextov� vyhled�v�n�";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL = "V�echny vybran�";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY = "Jak�koliv z vybran�ch";
	var $_PHPSHOP_PARAMETER_SEARCH_RESET_FORM = "Vymazat formul��";	
	/** shop.browse.php */
	var $_PHPSHOP_PARAMETER_SEARCH_IN_CATEGORY = "Vyhled�vat v kategori�ch";
	var $_PHPSHOP_PARAMETER_SEARCH_CHANGE_PARAMETERS = "Zm�nit parametry";
	var $_PHPSHOP_PARAMETER_SEARCH_DESCENDING_ORDER = "�adit sestupn�";
	var $_PHPSHOP_PARAMETER_SEARCH_ASCENDING_ORDER = "�adit vzestupn�";
	/** shop.product.detail */
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETERS_IN_CATEGORY = "Parametry kategorie";
	/** Changed Product Type - End*/
    
    // Opposite of Discount!
    var $_PHPSHOP_FEE = "Poplatek";
    
    var $_PHPSHOP_PRODUCT_CLONE = "Klonovat zbo��";
    
    var $_PHPSHOP_CSV_SETTINGS = "Nastaven�";
    var $_PHPSHOP_CSV_DELIMITER = "Odd�lova�";
    var $_PHPSHOP_CSV_ENCLOSURE = "Po��te�n�/konc. znak pole";
    var $_PHPSHOP_CSV_UPLOAD_FILE = "Upload CSV souboru";
    var $_PHPSHOP_CSV_SUBMIT_FILE = "Nahr�t CSV soubor";
    var $_PHPSHOP_CSV_FROM_DIRECTORY = "Nahr�t z adres��e";
    var $_PHPSHOP_CSV_FROM_SERVER = "Nahr�t CSV soubor ze serveru";
    var $_PHPSHOP_CSV_EXPORT_TO_FILE = "Export do CSV souboru";
    var $_PHPSHOP_CSV_SELECT_FIELD_ORDERING = "Zp�sob �azen� pol�";
    var $_PHPSHOP_CSV_DEFAULT_ORDERING = "V�choz�";
    var $_PHPSHOP_CSV_CUSTOMIZED_ORDERING = "Moje upraven� �azen�";
    var $_PHPSHOP_CSV_SUBMIT_EXPORT = "Exportovat v�echno zbo�� do CSV souboru";
    var $_PHPSHOP_CSV_CONFIGURATION_HEADER = "Nastav� Importu / Exportu CSV";
    var $_PHPSHOP_CSV_SAVE_CHANGES = "Ulo�it zm�ny";
    var $_PHPSHOP_CSV_FIELD_NAME = "N�zev pole";
    var $_PHPSHOP_CSV_DEFAULT_VALUE = "v�choz� hodnota";
    var $_PHPSHOP_CSV_FIELD_ORDERING = "Po�ad� pole";
    var $_PHPSHOP_CSV_FIELD_REQUIRED = "Po�adov�no?";
    var $_PHPSHOP_CSV_IMPORT_EXPORT = "Import/Export";
    var $_PHPSHOP_CSV_NEW_FIELD = "P�idat nov� pole";
    var $_PHPSHOP_CSV_DOCUMENTATION = "Dokumentace";
    
    var $_PHPSHOP_PRODUCT_NOT_FOUND = "Litujeme, ale po�adovan� zbo�� nebylo nalezeno!";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS = "Zobrazit zbo��, kter� nen� na sklad�";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN = "Pokud je za�krtnuto, jsou zobrazeny i produkty, kter� nejsou na sklad�. Jinak je toto zbo�� skryto.";
    
    /** Packaging */
    var $_PHPSHOP_PRODUCT_PACKAGING1 = "Po�et {unit}� v balen�: ";
    var $_PHPSHOP_PRODUCT_PACKAGING2 = "Po�et {unit}� v krabici: ";
    
}
/** @global phpShopLanguage $PHPSHOP_LANG */
$PHPSHOP_LANG =& new phpShopLanguage();
?>
