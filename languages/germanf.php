<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: germanf.php,v 1.25 2005/06/22 19:50:43 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage languages
*
* @copyright (C) 2004 Soeren Eberhardt
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
    
    var $_PHPSHOP_MENU = "Men&uuml;";
    var $_PHPSHOP_CATEGORY = "Kategorie";
    var $_PHPSHOP_CATEGORIES = "Kategorien";
    var $_PHPSHOP_ADMIN = "Administration";
    var $_PHPSHOP_PRODUCT = "Produkt";
    var $_PHPSHOP_LIST = "auflisten";
    var $_PHPSHOP_ALL = "alle";
    var $_PHPSHOP_VIEW = "Zeigen";
    var $_PHPSHOP_SHOW = "Zeigen";
    var $_PHPSHOP_ADD = "hinzuf&uuml;gen";
    var $_PHPSHOP_UPDATE = "aktualisieren";
    var $_PHPSHOP_DELETE = "l&ouml;schen";
    var $_PHPSHOP_SUBMIT = "Absenden";
    var $_PHPSHOP_SELECT = "ausw&auml;hlen";
    var $_PHPSHOP_RANDOM = "Ausgew&auml;hlte Produkte";
    var $_PHPSHOP_LATEST = "Neueste Produkte";
    
    /*#####################
    Modul ACCOUNT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_HOME_TITLE = "Startseite";
    var $_PHPSHOP_CART_TITLE = "Warenkorb";
    var $_PHPSHOP_CHECKOUT_TITLE = "zur Bestellung";
    var $_PHPSHOP_LOGIN_TITLE = "Anmelden";
    var $_PHPSHOP_LOGOUT_TITLE = "Abmelden";
    var $_PHPSHOP_BROWSE_TITLE = "";
    var $_PHPSHOP_SEARCH_TITLE = "Suchen";
    var $_PHPSHOP_ACCOUNT_TITLE = "Account Verwaltung";
    var $_PHPSHOP_NAVIGATION_TITLE = "Navigation";
    var $_PHPSHOP_DEPARTMENT_TITLE = "Abteilung";
    var $_PHPSHOP_INFO = "Information";
    
    var $_PHPSHOP_BROWSE_LBL = "&Uuml;bersicht";
    var $_PHPSHOP_PRODUCTS_LBL = "Produkte";
    var $_PHPSHOP_PRODUCT_LBL = "Produkt";
    var $_PHPSHOP_SEARCH_LBL = "Suchen";
    var $_PHPSHOP_FLYPAGE_LBL = "Produktdetails";
    
    var $_PHPSHOP_PRODUCT_NAME_TITLE = "Produktname";
    var $_PHPSHOP_PRODUCT_CATEGORY_TITLE = "Produktkategorie";
    var $_PHPSHOP_PRODUCT_DESC_TITLE = "Produktbeschreibung";
    
    var $_PHPSHOP_CART_SHOW = "Warenkorb zeigen";
    var $_PHPSHOP_CART_ADD_TO = "bestellen";
    var $_PHPSHOP_CART_NAME = "Name";
    var $_PHPSHOP_CART_SKU = "Artikelnummer";
    var $_PHPSHOP_CART_PRICE = "Preis";
    var $_PHPSHOP_CART_QUANTITY = "Anzahl";
    var $_PHPSHOP_CART_SUBTOTAL = "Zwischensumme";
    
    # Some messages
    var $_PHPSHOP_ADD_SHIPTO_1 = "Eine neue";
    var $_PHPSHOP_ADD_SHIPTO_2 = "Lieferadresse";
    var $_PHPSHOP_NO_SEARCH_RESULT = "Keine Suchergebnisse.<br />";
    var $_PHPSHOP_PRICE_LABEL = "Preis: ";
    var $_PHPSHOP_ORDER_BUTTON_LABEL = "in den Warenkorb";
    var $_PHPSHOP_NO_CUSTOMER = "Sie sind leider noch kein registrierter Kunde. Bitte hinterlassen Sie uns Ihre Rechungsadresse.";
    var $_PHPSHOP_DELETE_MSG = "Soll dieser Datensatz wirklich gel&ouml;scht werden?";
    var $_PHPSHOP_THANKYOU = "Danke f&uuml;r Ihre Bestellung.";
    var $_PHPSHOP_NOT_SHIPPED = "Noch nicht geliefert.";
    var $_PHPSHOP_EMAIL_SENDTO = "Eine Best&auml;tigungs-email wurde versandt an";
    var $_PHPSHOP_NO_USER_TO_SELECT = "Es existiert kein MOS-user, <br />den Sie zur com_phpshop Nutzerliste hinzuf&uuml;gen k&ouml;nnten.";
    
    // Error messages
    
    var $_PHPSHOP_ERROR = "FEHLER";
    var $_PHPSHOP_MOD_NOT_REG = "Modul ist nicht registriert.";
    var $_PHPSHOP_MOD_ISNO_REG = " ist kein g&uuml;ltiges phpShop Modul.";
    var $_PHPSHOP_MOD_NO_AUTH = "Sie haben keine Berechtigung, auf dieses Modul zuzugreifen.";
    var $_PHPSHOP_PAGE_404_1 = "Die angeforderte Seite existiert nicht";
    var $_PHPSHOP_PAGE_404_2 = "Folgende Datei wurde nicht gefunden:";
    var $_PHPSHOP_PAGE_403 = "Unzureichende Rechte";
    var $_PHPSHOP_FUNC_NO_EXEC = "Es besteht keine Berechtigung zum Ausf&uuml;hren der Funktion ";
    var $_PHPSHOP_FUNC_NOT_REG = "Funktion Nicht Registriert";
    var $_PHPSHOP_FUNC_ISNO_REG = " ist keine g&uuml;ltige phpShop Funktion.";
    
    /*#####################
    Modul ADMIN
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADMIN_MOD = "Administration";
    
    
    // Nutzer List
    var $_PHPSHOP_USER_LIST_MNU = "Nutzer auflisten";
    var $_PHPSHOP_USER_LIST_LBL = "Nutzerliste";
    var $_PHPSHOP_USER_LIST_USERNAME = "Nutzername";
    var $_PHPSHOP_USER_LIST_FULL_NAME = "Voller Name";
    var $_PHPSHOP_USER_LIST_GROUP = "Gruppe";
    
    // Nutzer Formular
    var $_PHPSHOP_USER_FORM_MNU = "Neu: Nutzer";
    var $_PHPSHOP_USER_FORM_LBL = "Hinzuf&uuml;gen/Aktualisieren von Nutzern";
    var $_PHPSHOP_USER_FORM_BILLTO_LBL = "Rechungsinformation";
    var $_PHPSHOP_USER_FORM_SHIPTO_LBL = "Lieferadressen";
    var $_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL = "Eine Adresse hinzuf&uuml;gen";
    var $_PHPSHOP_USER_FORM_ADDRESS_LABEL = "Adressen-Abk&uuml;rzung";
    var $_PHPSHOP_USER_FORM_FIRST_NAME = "Vorname";
    var $_PHPSHOP_USER_FORM_LAST_NAME = "Nachname";
    var $_PHPSHOP_USER_FORM_MIDDLE_NAME = "mittlerer Name";
    var $_PHPSHOP_USER_FORM_TITLE = "Titel";
    var $_PHPSHOP_USER_FORM_USERNAME = "Nutzername";
    var $_PHPSHOP_USER_FORM_PASSWORD_1 = "Passwort";
    var $_PHPSHOP_USER_FORM_PASSWORD_2 = "Passwort best&auml;tigen";
    var $_PHPSHOP_USER_FORM_PERMS = "Nutzertyp";
    var $_PHPSHOP_USER_FORM_COMPANY_NAME = "Firmenname";
    var $_PHPSHOP_USER_FORM_ADDRESS_1 = "Adresse 1";
    var $_PHPSHOP_USER_FORM_ADDRESS_2 = "Adresse 2";
    var $_PHPSHOP_USER_FORM_CITY = "Stadt";
    var $_PHPSHOP_USER_FORM_STATE = "Bundesland";
    var $_PHPSHOP_USER_FORM_ZIP = "PLZ";
    var $_PHPSHOP_USER_FORM_COUNTRY = "Land";
    var $_PHPSHOP_USER_FORM_PHONE = "Telefon";
    var $_PHPSHOP_USER_FORM_FAX = "Fax";
    var $_PHPSHOP_USER_FORM_EMAIL = "Email";
    
    // Modul List
    var $_PHPSHOP_MODULE_LIST_MNU = "Module auflisten";
    var $_PHPSHOP_MODULE_LIST_LBL = "Modulliste";
    var $_PHPSHOP_MODULE_LIST_NAME = "Modulname";
    var $_PHPSHOP_MODULE_LIST_PERMS = "Modulbeschr&auml;nkung";
    var $_PHPSHOP_MODULE_LIST_FUNCTIONS = "Funktionen";
    var $_PHPSHOP_MODULE_LIST_ORDER = "Reihenfolge";
    
    // Modul Formular
    var $_PHPSHOP_MODULE_FORM_MNU = "Neu: Modul";
    var $_PHPSHOP_MODULE_FORM_LBL = "Modul Information";
    var $_PHPSHOP_MODULE_FORM_MODULE_LABEL = "Modulbezeichnung (f&uuml;r Top-Men&uuml;)";
    var $_PHPSHOP_MODULE_FORM_NAME = "Modulname";
    var $_PHPSHOP_MODULE_FORM_PERMS = "Modulbeschr&auml;nkungen";
    var $_PHPSHOP_MODULE_FORM_HEADER = "Modulkopf";
    var $_PHPSHOP_MODULE_FORM_FOOTER = "Modulfuﬂ";
    var $_PHPSHOP_MODULE_FORM_MENU = "Modul sichtbar im Top-Men&uuml;?";
    var $_PHPSHOP_MODULE_FORM_ORDER = "Reihenfolge";
    var $_PHPSHOP_MODULE_FORM_DESCRIPTION = "Modulbeschreibung";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_CODE = "Sprache";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_file = "Sprachdatei";
    
    // Funktion List
    var $_PHPSHOP_FUNCTION_LIST_MNU = "Funktionen auflisten";
    var $_PHPSHOP_FUNCTION_LIST_LBL = "Funktionsliste";
    var $_PHPSHOP_FUNCTION_LIST_NAME = "Funktionsname";
    var $_PHPSHOP_FUNCTION_LIST_CLASS = "Klassenname";
    var $_PHPSHOP_FUNCTION_LIST_METHOD = "Klassenmethode";
    var $_PHPSHOP_FUNCTION_LIST_PERMS = "Beschr&auml;nkungen";
    
    // Modul Formular
    var $_PHPSHOP_FUNCTION_FORM_MNU = "Neu: Funktion";
    var $_PHPSHOP_FUNCTION_FORM_LBL = "Funktionsinformation";
    var $_PHPSHOP_FUNCTION_FORM_NAME = "Funktionsname";
    var $_PHPSHOP_FUNCTION_FORM_CLASS = "Klassenname";
    var $_PHPSHOP_FUNCTION_FORM_METHOD = "Klassenmethode";
    var $_PHPSHOP_FUNCTION_FORM_PERMS = "Funktionsbeschr&auml;nkungen";
    var $_PHPSHOP_FUNCTION_FORM_DESCRIPTION = "Funktionsbeschreibung";
    
    // W&auml;hrungsformular und liste
    var $_PHPSHOP_CURRENCY_LIST_MNU = "W&auml;hrungen auflisten";
    var $_PHPSHOP_CURRENCY_LIST_LBL = "W&auml;hrungsliste";
    var $_PHPSHOP_CURRENCY_LIST_ADD = "Neu: W&auml;hrung";
    var $_PHPSHOP_CURRENCY_LIST_NAME = "W&auml;hrungsname";
    var $_PHPSHOP_CURRENCY_LIST_CODE = "W&auml;hrungssymbol/-k&uuml;rzel";
    
    // L&auml;nderformular und liste
    var $_PHPSHOP_COUNTRY_LIST_MNU = "L&auml;nder auflisten";
    var $_PHPSHOP_COUNTRY_LIST_LBL = "L&auml;nderliste";
    var $_PHPSHOP_COUNTRY_LIST_ADD = "Land hinzuf&uuml;gen";
    var $_PHPSHOP_COUNTRY_LIST_NAME = "L&auml;ndername";
    var $_PHPSHOP_COUNTRY_LIST_3_CODE = "L&auml;nderk&uuml;rzel (3 Zeichen)";
    var $_PHPSHOP_COUNTRY_LIST_2_CODE = "L&auml;nderk&uuml;rzel (2 Zeichen)";
    
    /*#####################
    Modul CHECKOUT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADDRESS = "Adresse";
    var $_PHPSHOP_CONTINUE = "Weiter";
    
    # Some messages
    var $_PHPSHOP_EMPTY_CART = "Ihr Warenkorb ist derzeit leer.";
    
    
    /*#####################
    Modul ISShipping
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ISSHIPPING_MOD = "InterShipper";
    
    
    // Lieferung Ping
    var $_PHPSHOP_ISSHIP_PING_MNU = "Ping InterShipper Server";
    var $_PHPSHOP_ISSHIP_PING_LBL = "InterShipper-Server anpingen ";
    var $_PHPSHOP_ISSHIP_PING_ERROR_LBL = "InterShipper Ping fehlgeschlagen";
    var $_PHPSHOP_ISSHIP_PING_GOOD_LBL = "InterShipper Ping erfolgreich";
    var $_PHPSHOP_ISSHIP_PING_CARRIER_LBL = "Paketdienst";
    var $_PHPSHOP_ISSHIP_PING_RESPONSE_LBL = "Anwortzeit";
    var $_PHPSHOP_ISSHIP_PING_TIME_LBL = "Sek.";
    
    // Lieferung List
    var $_PHPSHOP_ISSHIP_LIST_MNU = "Versandarten auflisten";
    var $_PHPSHOP_ISSHIP_LIST_LBL = "Versandarten";
    var $_PHPSHOP_ISSHIP_LIST_CARRIER_LBL = "Versandart";
    var $_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL = "Aktiv";
    var $_PHPSHOP_ISSHIP_LIST_RATE_LBL = "Versandkosten";
    var $_PHPSHOP_ISSHIP_LIST_LEAD_LBL = "Lieferdauer";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_F_LBL = "Pauschalpreis";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_P_LBL = "Prozent";
    var $_PHPSHOP_ISSHIP_LIST_DAYS_LBL = "Tage";
    var $_PHPSHOP_ISSHIP_LIST_HEAVY_LBL = "schwere Lasten";
    
    // Dynamic Lieferung Formular
    var $_PHPSHOP_ISSHIP_FORM_MNU = "Versandarten konfigurieren";
    var $_PHPSHOP_ISSHIP_FORM_ADD_LBL = "Versandart hinzuf&uuml;gen";
    var $_PHPSHOP_ISSHIP_FORM_UPDATE_LBL = "Versandarten konfigurieren";
    var $_PHPSHOP_ISSHIP_FORM_REFRESH_LBL = "Aktualisieren";
    var $_PHPSHOP_ISSHIP_FORM_CARRIER_LBL = "Versandart";
    var $_PHPSHOP_ISSHIP_FORM_PUBLISH_LBL = "Aktivieren";
    var $_PHPSHOP_ISSHIP_FORM_HANDLING_LBL = "Versandkosten";
    var $_PHPSHOP_ISSHIP_FORM_LEAD_LBL = "Lieferdauer";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_F_LBL = "Pauschalpreis";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_P_LBL = "Prozent";
    var $_PHPSHOP_ISSHIP_FORM_DAYS_LBL = "Tage";
    var $_PHPSHOP_ISSHIP_FORM_HEAVY_LBL = "schwere Lasten";
    
    
    
    /*#####################
    Modul Bestellung
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_ORDER_MOD = "Bestellungen";
    
    // Some Men&uuml; options 
    var $_PHPSHOP_ORDER_CONFIRM_MNU = "Bestellung best&auml;tigen";
    var $_PHPSHOP_ORDER_CANCEL_MNU = "Bestellung ablehnen";
    var $_PHPSHOP_ORDER_PRINT_MNU = "Bestellung ausdrucken";
    var $_PHPSHOP_ORDER_DELETE_MNU = "Bestellung l&ouml;schen";
    
    // Bestellung List
    var $_PHPSHOP_ORDER_LIST_MNU = "Bestellungen auflisten";
    var $_PHPSHOP_ORDER_LIST_LBL = "Liste aller Bestellungen";
    var $_PHPSHOP_ORDER_LIST_ID = "Bestellnummer";
    var $_PHPSHOP_ORDER_LIST_CDATE = "Bestelldatum";
    var $_PHPSHOP_ORDER_LIST_MDATE = "zuletzt ge&auml;ndert";
    var $_PHPSHOP_ORDER_LIST_STATUS = "Status";
    var $_PHPSHOP_ORDER_LIST_TOTAL = "Zwischensumme";
    var $_PHPSHOP_ORDER_ITEM = "Bestellte Artikel";
    
    // Bestellung print
    var $_PHPSHOP_ORDER_PRINT_PO_LBL = "Auftrag";
    var $_PHPSHOP_ORDER_PRINT_PO_NUMBER = "Bestellnummer";
    var $_PHPSHOP_ORDER_PRINT_PO_DATE = "Bestelldatum";
    var $_PHPSHOP_ORDER_PRINT_PO_STATUS = "Bestellstatus";
    var $_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL = "Kundeninformation";
    var $_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL = "Rechnungsinformation";
    var $_PHPSHOP_ORDER_PRINT_CUST_SHIPPING_LBL = "Informationen zur Lieferung";
    var $_PHPSHOP_ORDER_PRINT_BILL_TO_LBL = "Rechungsadresse";
    var $_PHPSHOP_ORDER_PRINT_SHIP_TO_LBL = "Lieferadresse";
    var $_PHPSHOP_ORDER_PRINT_NAME = "Name";
    var $_PHPSHOP_ORDER_PRINT_COMPANY = "Firma";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_1 = "Adresse 1";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_2 = "Adresse 2";
    var $_PHPSHOP_ORDER_PRINT_CITY = "Stadt";
    var $_PHPSHOP_ORDER_PRINT_STATE = "Bundesland";
    var $_PHPSHOP_ORDER_PRINT_ZIP = "PLZ";
    var $_PHPSHOP_ORDER_PRINT_COUNTRY = "Land";
    var $_PHPSHOP_ORDER_PRINT_PHONE = "Telefon";
    var $_PHPSHOP_ORDER_PRINT_FAX = "Fax";
    var $_PHPSHOP_ORDER_PRINT_EMAIL = "Email";
    var $_PHPSHOP_ORDER_PRINT_ITEMS_LBL = "Bestellte Artikel";
    var $_PHPSHOP_ORDER_PRINT_QUANTITY = "Anzahl";
    var $_PHPSHOP_ORDER_PRINT_QTY = "Anz.";
    var $_PHPSHOP_ORDER_PRINT_SKU = "Artikelnummer";
    var $_PHPSHOP_ORDER_PRINT_PRICE = "Preis";
    var $_PHPSHOP_ORDER_PRINT_TOTAL = "Endsumme";
    var $_PHPSHOP_ORDER_PRINT_SUBTOTAL = "Zwischensumme";
    var $_PHPSHOP_ORDER_PRINT_TOTAL_TAX = "MwSt.";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING = "Versandkosten";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_TAX = "Steuern auf Porto/Verpackung";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LBL = "Bezahlung per";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NAME = "Name auf d. Kreditkarte";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER = "Kreditkartennummer";
    var $_PHPSHOP_ORDER_PRINT_EXPIRE_DATE = "G&uuml;ltigkeitsdatum";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL = "Daten zur Bezahlung";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_LBL = "Lieferinformation";
    var $_PHPSHOP_ORDER_PRINT_PAYINFO_LBL = "Zahlungsart";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL = "Versand per";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL = "Lieferart";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_DATE_LBL = "Lieferdatum";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL = "Lieferung Preis";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_MNU = "Bestellstatustypen auflisten";
    var $_PHPSHOP_ORDER_STATUS_FORM_MNU = "Neu: Bestellstatustyp";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_CODE = "Bestellstatus-Code";
    var $_PHPSHOP_ORDER_STATUS_LIST_NAME = "Name des Bestellstatus";
    
    var $_PHPSHOP_ORDER_STATUS_FORM_LBL = "Bestellstatus";
    var $_PHPSHOP_ORDER_STATUS_FORM_CODE = "Bestellstatus Code";
    var $_PHPSHOP_ORDER_STATUS_FORM_NAME = "Bestellstatus Name";
    var $_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER = "Reihenfolge";
    
    
    /*#####################
    Modul PRODUCT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_PRODUCT_MOD = "Produkte";
    
    var $_PHPSHOP_CURRENT_PRODUCT = "Aktuelles Produkt";
    var $_PHPSHOP_CURRENT_ITEM = "Aktueller Artikel";
    
    // Produkt Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_LBL = "Produktinventar";
    var $_PHPSHOP_PRODUCT_INVENTORY_MNU = "Inventar anzeigen";
    var $_PHPSHOP_PRODUCT_INVENTORY_PRICE = "Preis";
    var $_PHPSHOP_PRODUCT_INVENTORY_STOCK = "Anzahl";
    var $_PHPSHOP_PRODUCT_INVENTORY_WEIGHT = "Gewicht";
    // Produkt List
    var $_PHPSHOP_PRODUCT_LIST_MNU = "Produkte auflisten";
    var $_PHPSHOP_PRODUCT_LIST_LBL = "Produktliste";
    var $_PHPSHOP_PRODUCT_LIST_NAME = "Produktname";
    var $_PHPSHOP_PRODUCT_LIST_SKU = "Artikelnummer";
    var $_PHPSHOP_PRODUCT_LIST_PUBLISH = "Ver&ouml;ffentlicht";
    
    // Produkt Formular
    var $_PHPSHOP_PRODUCT_FORM_MNU = "Neues Produkt";
    var $_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT = "Dieses Produkt &auml;ndern";
    var $_PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE = "Produkt-Detailseite im shop zeigen";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU = "Neuer Artikel";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU = "neuer Artikel";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL = "Neues Produkt";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_PRODUCT_LBL = "Produkt aktualisieren";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL = "Produktinformation";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL = "Produktstatus";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL = "Produktdimensionen und -gewicht";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL = "Produktbilder";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL = "Neuer Artikel";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL = "Artikel aktualisieren";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL = "Artikelinformation";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL = "Artikelstatus";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL = "Artikel Dimensionen und Gewicht";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL = "Artikelbilder";
    var $_PHPSHOP_PRODUCT_FORM_RETURN_LBL = "zur&uuml;ck zum Elternprodukt";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL = "Um das aktuelle Bild zu aktualisieren, bitte Pfad zum neuen Bild angeben.";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL = "Das aktuelle Bild l&ouml;schen.";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMs_LBL = "Produktartikel";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL = "Artikelattribute";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG = "Soll dieses Produkt\\nund die damit verbundenen Artikel wirklich gel&ouml;scht werden?";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG = "Soll dieser Artikel wirklich gel&ouml;scht werden?";
    var $_PHPSHOP_PRODUCT_FORM_VENDOR = "Verk&auml;ufer/Produktverwalter";
    var $_PHPSHOP_PRODUCT_FORM_MANUFACTURER = "Hersteller";
    var $_PHPSHOP_PRODUCT_FORM_SKU = "Artikelnummer";
    var $_PHPSHOP_PRODUCT_FORM_NAME = "Name";
    var $_PHPSHOP_PRODUCT_FORM_URL = "URL";
    var $_PHPSHOP_PRODUCT_FORM_CATEGORY = "Kategorie";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_GROSS = "Artikelpreis (Brutto)";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_NET = "Artikelpreis (Netto)";
    var $_PHPSHOP_PRODUCT_FORM_DESCRIPTION = "ausf&uuml;hrliche Beschreibung";
    var $_PHPSHOP_PRODUCT_FORM_S_DESC = "Kurzbeschreibung";
    var $_PHPSHOP_PRODUCT_FORM_IN_STOCK = "vorr&auml;tig";
    var $_PHPSHOP_PRODUCT_FORM_ON_ORDER = "auf Bestellung";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE = "Verf&uuml;gbarkeitsdatum";
    var $_PHPSHOP_PRODUCT_FORM_SPECIAL = "Aktionsprodukt?";
    var $_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE = "Discounttyp";
    var $_PHPSHOP_PRODUCT_FORM_PUBLISH = "Ver&ouml;ffentlichen?";
    var $_PHPSHOP_PRODUCT_FORM_LENGTH = "L&auml;nge";
    var $_PHPSHOP_PRODUCT_FORM_WIDTH = "Breite";
    var $_PHPSHOP_PRODUCT_FORM_HEIGHT = "H&ouml;he";
    var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM = "Maﬂeinheit";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT = "Gewicht";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM = "Maﬂeinheit";
    var $_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE = "kleines Bild";
    var $_PHPSHOP_PRODUCT_FORM_FULL_IMAGE = "Groﬂes Bild";
    
    // Produkt Display
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL = "Resultate: Produkt hinzuf&uuml;gen";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL = "Resultate: Produkt aktualisieren";
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL = "Resultate: neuer Artikel";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL = "Resultate: Artikel aktualisieren";
    var $_PHPSHOP_PRODUCT_CSV_UPLOAD = "Produkte per CSV-Datei einf&uuml;gen";
    var $_PHPSHOP_PRODUCT_FOLDERS = "Produkt-Ordneransicht";
    
    // Produkt Kategorie List
    var $_PHPSHOP_CATEGORY_LIST_MNU = "Kategorien auflisten";
    var $_PHPSHOP_CATEGORY_LIST_LBL = "Kategoriebaum";
    
    // Produkt Kategorie Formular
    var $_PHPSHOP_CATEGORY_FORM_MNU = "Neue Kategorie";
    var $_PHPSHOP_CATEGORY_FORM_LBL = "Kategorie Information";
    var $_PHPSHOP_CATEGORY_FORM_NAME = "Kategoriename";
    var $_PHPSHOP_CATEGORY_FORM_PARENT = "Elternprodukt";
    var $_PHPSHOP_CATEGORY_FORM_DESCRIPTION = "Kategoriebeschreibung";
    var $_PHPSHOP_CATEGORY_FORM_PUBLISH = "Ver&ouml;ffentlichen?";
    var $_PHPSHOP_CATEGORY_FORM_FLYPAGE = "Kategorie-&Uuml;bersichtsseite";
    
    // Produkt Attribute List
    var $_PHPSHOP_ATTRIBUTE_LIST_MNU = "Attribute auflisten";
    var $_PHPSHOP_ATTRIBUTE_LIST_LBL = "Attributliste f&uuml;r";
    var $_PHPSHOP_ATTRIBUTE_LIST_NAME = "Attributname";
    var $_PHPSHOP_ATTRIBUTE_LIST_ORDER = "Reihenfolge";
    
    // Produkt Attribute Formular
    var $_PHPSHOP_ATTRIBUTE_FORM_MNU = "Neues Attribut";
    var $_PHPSHOP_ATTRIBUTE_FORM_LBL = "Attributformular";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT = "Neues Attribut f&uuml;r Produkt";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT = "Attribut f&uuml;r Produkt aktualisieren";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM = "Neues Attribut f&uuml;r Artikel";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM = "Attribute f&uuml;r Artikel aktualisieren";
    var $_PHPSHOP_ATTRIBUTE_FORM_NAME = "Attributname";
    var $_PHPSHOP_ATTRIBUTE_FORM_ORDER = "Reihenfolge";
    
    // Produkt Preis List
    var $_PHPSHOP_PRICE_LIST_MNU = "Preise auflisten";
    var $_PHPSHOP_PRICE_LIST_LBL = "Preisliste";
    var $_PHPSHOP_PRICE_LIST_FOR_LBL = "Preis f&uuml;r";
    var $_PHPSHOP_PRICE_LIST_GROUP_NAME = "Gruppenname";
    var $_PHPSHOP_PRICE_LIST_PRICE = "Preis";
    var $_PHPSHOP_PRODUCT_LIST_CURRENCY = "W&auml;hrung";
    
    // Produkt Preis Formular
    var $_PHPSHOP_PRICE_FORM_MNU = "Preis hinzuf&uuml;gen";
    var $_PHPSHOP_PRICE_FORM_LBL = "Preisinformation";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT = "Preis f&uuml;r Produkt hinzuf&uuml;gen";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT = "Preis f&uuml;r Produkt aktualisieren";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_ITEM = "Neuen Preis f&uuml;r Artikel";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM = "Preis f&uuml;r Artikel aktualisieren";
    var $_PHPSHOP_PRICE_FORM_PRICE = "Preis";
    var $_PHPSHOP_PRICE_FORM_CURRENCY = "W&auml;hrung";
    var $_PHPSHOP_PRICE_FORM_GROUP = "Shoppergruppe";
    
    
    /*#####################
    MODULE REPORT BASIC
    #####################*/
    # Some LABELs
    var $_PHPSHOP_REPORTBASIC_MOD = "Reporte";
    var $_PHPSHOP_RB_INDIVIDUAL = "einzelne Produkte auflisten";
    var $_PHPSHOP_RB_SALE_TITLE = "Verkaufsreporte";
    
    /* labels for rpt_sales */
    var $_PHPSHOP_RB_SALES_PAGE_TITLE = "&Uuml;bersicht zu Verkaufsaktivit&auml;ten";
    
    var $_PHPSHOP_RB_INTERVAL_TITLE = "Intervall setzen";
    var $_PHPSHOP_RB_INTERVAL_MONTHLY_TITLE = "Monatlich";
    var $_PHPSHOP_RB_INTERVAL_WEEKLY_TITLE = "W&ouml;chentlich";
    var $_PHPSHOP_RB_INTERVAL_DAILY_TITLE = "T&auml;glich";
    
    var $_PHPSHOP_RB_THISMONTH_BUTTON = "Diesen Monat";
    var $_PHPSHOP_RB_LASTMONTH_BUTTON = "Letzten Monat";
    var $_PHPSHOP_RB_LAST60_BUTTON = "Letzte 60 Tage";
    var $_PHPSHOP_RB_LAST90_BUTTON = "Letzte 90 Tage";
    
    var $_PHPSHOP_RB_START_DATE_TITLE = "Beginn am";
    var $_PHPSHOP_RB_END_DATE_TITLE = "Ende am";
    var $_PHPSHOP_RB_SHOW_SEL_RANGE = "Zeige den ausgew&auml;hlten Zeitraum";
    var $_PHPSHOP_RB_REPORT_FOR = "Report f&uuml;r ";
    var $_PHPSHOP_RB_DATE = "Datum";
    var $_PHPSHOP_RB_ORDERS = "Bestellungen";
    var $_PHPSHOP_RB_TOTAL_ITEMS = "Anzahl verkaufter Artikel";
    var $_PHPSHOP_RB_REVENUE = "Erl&ouml;s";
    var $_PHPSHOP_RB_PRODLIST = "Produktliste";
    
    
    
    /*#####################
    Modul SHOP
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOP_MOD = "Shop";
    var $_PHPSHOP_PRODUCT_THUMB_TITLE = "kleines Bild";
    var $_PHPSHOP_PRODUCT_PRICE_TITLE = "Preis";
    var $_PHPSHOP_ORDER_STATUS_P = "noch nicht best&auml;tigt";
    var $_PHPSHOP_ORDER_STATUS_C = "Best&auml;tigt";
    var $_PHPSHOP_ORDER_STATUS_X = "Storniert";
    
    
    # Some messages
    var $_PHPSHOP_ORDER_BUTTON = "Bestellen";
    
    
    
    /*#####################
    Modul SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOPPER_MOD = "Shopper";
    
    
    
    // Shopper List
    var $_PHPSHOP_SHOPPER_LIST_MNU = "Shopper auflisten";
    var $_PHPSHOP_SHOPPER_LIST_LBL = "Shopperliste";
    var $_PHPSHOP_SHOPPER_LIST_USERNAME = "Nutzername";
    var $_PHPSHOP_SHOPPER_LIST_NAME = "Voller Name";
    var $_PHPSHOP_SHOPPER_LIST_GROUP = "Gruppe";
    
    // Shopper Formular
    var $_PHPSHOP_SHOPPER_FORM_MNU = "Shopper hinzuf&uuml;gen";
    var $_PHPSHOP_SHOPPER_FORM_LBL = "Shopper Information";
    var $_PHPSHOP_SHOPPER_FORM_BILLTO_LBL = "Informationen zur Rechungsadresse";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL = "Information";
    var $_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL = "Informationen zur Lieferadresse";
    var $_PHPSHOP_SHOPPER_FORM_ADD_SHIPTO_LBL = "Neue Adresse";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL = "Kurzname f&uuml;r Adresse";
    var $_PHPSHOP_SHOPPER_FORM_USERNAME = "Nutzername";
    var $_PHPSHOP_SHOPPER_FORM_FIRST_NAME = "Vorname";
    var $_PHPSHOP_SHOPPER_FORM_LAST_NAME = "Nachname";
    var $_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME = "mittlerer Name";
    var $_PHPSHOP_SHOPPER_FORM_TITLE = "Titel";
    var $_PHPSHOP_SHOPPER_FORM_SHOPPERNAME = "Shoppername";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_1 = "Passwort";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_2 = "Passwort best&auml;tigen";
    var $_PHPSHOP_SHOPPER_FORM_GROUP = "Shopper Gruppe";
    var $_PHPSHOP_SHOPPER_FORM_COMPANY_NAME = "Firmenname";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_1 = "Adresse 1";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_2 = "Adresse 2";
    var $_PHPSHOP_SHOPPER_FORM_CITY = "Stadt";
    var $_PHPSHOP_SHOPPER_FORM_STATE = "Bundesland";
    var $_PHPSHOP_SHOPPER_FORM_ZIP = "PLZ";
    var $_PHPSHOP_SHOPPER_FORM_COUNTRY = "Land";
    var $_PHPSHOP_SHOPPER_FORM_PHONE = "Telefon";
    var $_PHPSHOP_SHOPPER_FORM_FAX = "Fax";
    var $_PHPSHOP_SHOPPER_FORM_EMAIL = "Email";
    
    // Shopper Gruppe List
    var $_PHPSHOP_SHOPPER_GROUP_LIST_MNU = "Shoppergruppen auflisten";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_LBL = "Shoppergruppenliste";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_NAME = "Gruppenname";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION = "Gruppenbeschreibung";
    
    
    // Shopper Gruppe Formular
    var $_PHPSHOP_SHOPPER_GROUP_FORM_LBL = "Shoppergruppenformular";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_MNU = "Neu: Shoppergruppe";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_NAME = "Gruppenname";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DESC = "Gruppenbeschreibung";
    
    
    
    
    /*#####################
    Modul SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_STORE_MOD = "Ihr Shop";
    
    
    // Shop Formular
    var $_PHPSHOP_STORE_FORM_MNU = "Shopdaten bearbeiten";
    var $_PHPSHOP_STORE_FORM_LBL = "Shopinformation";
    var $_PHPSHOP_STORE_FORM_CONTACT_LBL = "Kontaktinformation";
    var $_PHPSHOP_STORE_FORM_FULL_IMAGE = "Groﬂes Bild";
    var $_PHPSHOP_STORE_FORM_UPLOAD = "Bild hochladen";
    var $_PHPSHOP_STORE_FORM_STORE_NAME = "Shopname";
    var $_PHPSHOP_STORE_FORM_COMPANY_NAME = "Shop Firmenname";
    var $_PHPSHOP_STORE_FORM_ADDRESS_1 = "Adresse 1";
    var $_PHPSHOP_STORE_FORM_ADDRESS_2 = "Adresse 2";
    var $_PHPSHOP_STORE_FORM_CITY = "Stadt";
    var $_PHPSHOP_STORE_FORM_STATE = "Bundesland";
    var $_PHPSHOP_STORE_FORM_COUNTRY = "Land";
    var $_PHPSHOP_STORE_FORM_ZIP = "PLZ";
    var $_PHPSHOP_STORE_FORM_PHONE = "Telefon";
    var $_PHPSHOP_STORE_FORM_CURRENCY = "W&auml;hrung";
    var $_PHPSHOP_STORE_FORM_CATEGORY = "Shopkategorie";
    var $_PHPSHOP_STORE_FORM_LAST_NAME = "Nachname";
    var $_PHPSHOP_STORE_FORM_FIRST_NAME = "Vorname";
    var $_PHPSHOP_STORE_FORM_MIDDLE_NAME = "mittlerer Name";
    var $_PHPSHOP_STORE_FORM_TITLE = "Titel";
    var $_PHPSHOP_STORE_FORM_PHONE_1 = "Telefon 1";
    var $_PHPSHOP_STORE_FORM_PHONE_2 = "Telefon 2";
    var $_PHPSHOP_STORE_FORM_FAX = "Fax";
    var $_PHPSHOP_STORE_FORM_EMAIL = "Email";
    var $_PHPSHOP_STORE_FORM_IMAGE_PATH = "Bildpfad";
    var $_PHPSHOP_STORE_FORM_DESCRIPTION = "Beschreibung";
    
    
    var $_PHPSHOP_PAYMENT = "Bezahlung";
    // Bezahlart List
    var $_PHPSHOP_PAYMENT_METHOD_LIST_MNU = "Zahlungsarten auflisten";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_LBL = "Zahlungsartenliste";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_NAME = "Name";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_CODE = "Code";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT = "Rabatt";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP = "Shopper Gruppe";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR = "Typ der Zahlungsart";
    
    // Bezahlart Formular
    var $_PHPSHOP_PAYMENT_METHOD_FORM_MNU = "Neue Zahlungsarten";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LBL = "Zahlungsarten-Formular";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_NAME = "Name der Zahlungsarten";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP = "f&uuml;r Shoppergruppe";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT = "Rabatt";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_CODE = "Code";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER = "Reihenfolge";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR = "Typ der Zahlungsart";
    
    
    
    /*#####################
    Modul TAX
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_TAX_MOD = "Steuern";
    
    // Nutzer List
    var $_PHPSHOP_TAX_RATE = "Steuers&auml;tze";
    var $_PHPSHOP_TAX_LIST_MNU = "Steuers&auml;tze auflisten";
    var $_PHPSHOP_TAX_LIST_LBL = "Steuersatzliste";
    var $_PHPSHOP_TAX_LIST_STATE = "Steuer Bundesland/Region";
    var $_PHPSHOP_TAX_LIST_COUNTRY = "Steuer Land";
    var $_PHPSHOP_TAX_LIST_RATE = "Steuersatz";
    
    // Nutzer Formular
    var $_PHPSHOP_TAX_FORM_MNU = "Neu: Steuersatz";
    var $_PHPSHOP_TAX_FORM_LBL = "Neu: Steuer Information";
    var $_PHPSHOP_TAX_FORM_STATE = "Steuer Bundesland/Region";
    var $_PHPSHOP_TAX_FORM_COUNTRY = "Steuer Land";
    var $_PHPSHOP_TAX_FORM_RATE = "Steuersatz";
    
    
    
    
    /*#####################
    Modul VENDOR
    #####################*/
    
    
    
    # Some LABELs
    var $_PHPSHOP_VENDOR_MOD = "Verk&auml;ufer";
    var $_PHPSHOP_VENDOR_ADMIN = "Verk&auml;ufer";
    
    
    // Verk&auml;ufer List
    var $_PHPSHOP_VENDOR_LIST_MNU = "Verk&auml;ufer auflisten";
    var $_PHPSHOP_VENDOR_LIST_LBL = "Verk&auml;uferliste";
    var $_PHPSHOP_VENDOR_LIST_VENDOR_NAME = "Verk&auml;ufername";
    var $_PHPSHOP_VENDOR_LIST_ADMIN = "Admin";
    
    // Verk&auml;ufer Formular
    var $_PHPSHOP_VENDOR_FORM_MNU = "Neu: Verk&auml;ufer";
    var $_PHPSHOP_VENDOR_FORM_LBL = "Neu: Verk&auml;uferinformation";
    var $_PHPSHOP_VENDOR_FORM_INFO_LBL = "Verk&auml;uferinformation";
    var $_PHPSHOP_VENDOR_FORM_CONTACT_LBL = "Kontaktinformation";
    var $_PHPSHOP_VENDOR_FORM_FULL_IMAGE = "Groﬂes Bild";
    var $_PHPSHOP_VENDOR_FORM_UPLOAD = "Bild hochladen";
    var $_PHPSHOP_VENDOR_FORM_STORE_NAME = "Verk&auml;ufer-Store-Name";
    var $_PHPSHOP_VENDOR_FORM_COMPANY_NAME = "Verk&auml;ufer-Firmenname";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_1 = "Adresse 1";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_2 = "Adresse 2";
    var $_PHPSHOP_VENDOR_FORM_CITY = "Stadt";
    var $_PHPSHOP_VENDOR_FORM_STATE = "Bundesland";
    var $_PHPSHOP_VENDOR_FORM_COUNTRY = "Land";
    var $_PHPSHOP_VENDOR_FORM_ZIP = "PLZ";
    var $_PHPSHOP_VENDOR_FORM_PHONE = "Telefon";
    var $_PHPSHOP_VENDOR_FORM_CURRENCY = "W&auml;hrung";
    var $_PHPSHOP_VENDOR_FORM_CATEGORY = "Verk&auml;uferkategorie";
    var $_PHPSHOP_VENDOR_FORM_LAST_NAME = "Nachname";
    var $_PHPSHOP_VENDOR_FORM_FIRST_NAME = "Vorname";
    var $_PHPSHOP_VENDOR_FORM_MIDDLE_NAME = "mittlerer Name";
    var $_PHPSHOP_VENDOR_FORM_TITLE = "Titel";
    var $_PHPSHOP_VENDOR_FORM_PHONE_1 = "Telefon 1";
    var $_PHPSHOP_VENDOR_FORM_PHONE_2 = "Telefon 2";
    var $_PHPSHOP_VENDOR_FORM_FAX = "Fax";
    var $_PHPSHOP_VENDOR_FORM_EMAIL = "Email";
    var $_PHPSHOP_VENDOR_FORM_IMAGE_PATH = "Bildpfad";
    var $_PHPSHOP_VENDOR_FORM_DESCRIPTION = "Beschreibung";
    
    
    // Lieferanten Kategorieliste
    var $_PHPSHOP_VENDOR_CAT_LIST_MNU = "Verk&auml;uferkategorien auflisten";
    var $_PHPSHOP_VENDOR_CAT_LIST_LBL = "Verk&auml;uferkategorieliste";
    var $_PHPSHOP_VENDOR_CAT_NAME = "Kategoriename";
    var $_PHPSHOP_VENDOR_CAT_DESCRIPTION = "Kategoriebeschreibung";
    var $_PHPSHOP_VENDOR_CAT_VENDORS = "Lieferanten";
    
    // Lieferanten Kategorie Formular
    var $_PHPSHOP_VENDOR_CAT_FORM_MNU = "Neu: Verk&auml;uferkategorie";
    var $_PHPSHOP_VENDOR_CAT_FORM_LBL = "Verk&auml;uferkategorie-Formular";
    var $_PHPSHOP_VENDOR_CAT_FORM_INFO_LBL = "Kategorieinformation";
    var $_PHPSHOP_VENDOR_CAT_FORM_NAME = "Kategoriename";
    var $_PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION = "Kategoriebeschreibung";
    
    /*#####################
    Modul MANUFACTURER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_MANUFACTURER_MOD = "Hersteller";
    var $_PHPSHOP_MANUFACTURER_ADMIN = "Hersteller";
    
    
    // Hersteller List
    var $_PHPSHOP_MANUFACTURER_LIST_MNU = "Hersteller auflisten";
    var $_PHPSHOP_MANUFACTURER_LIST_LBL = "Herstellerliste";
    var $_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME = "Herstellername";
    var $_PHPSHOP_MANUFACTURER_LIST_ADMIN = "Admin";
    
    // Hersteller Formular
    var $_PHPSHOP_MANUFACTURER_FORM_MNU = "Neu: Hersteller";
    var $_PHPSHOP_MANUFACTURER_FORM_LBL = "Neu: Herstellerinformation";
    var $_PHPSHOP_MANUFACTURER_FORM_INFO_LBL = "Hersteller Information";
    var $_PHPSHOP_MANUFACTURER_FORM_CONTACT_LBL = "Kontaktinformation";
    var $_PHPSHOP_MANUFACTURER_FORM_FULL_IMAGE = "Groﬂes Bild";
    var $_PHPSHOP_MANUFACTURER_FORM_UPLOAD = "Bild hochladen";
    var $_PHPSHOP_MANUFACTURER_FORM_STORE_NAME = "Hersteller-Store-Name";
    var $_PHPSHOP_MANUFACTURER_FORM_COMPANY_NAME = "Hersteller-Firmenname";
    var $_PHPSHOP_MANUFACTURER_FORM_ADDRESS_1 = "Adresse 1";
    var $_PHPSHOP_MANUFACTURER_FORM_ADDRESS_2 = "Adresse 2";
    var $_PHPSHOP_MANUFACTURER_FORM_CITY = "Stadt";
    var $_PHPSHOP_MANUFACTURER_FORM_STATE = "Bundesland";
    var $_PHPSHOP_MANUFACTURER_FORM_COUNTRY = "Land";
    var $_PHPSHOP_MANUFACTURER_FORM_ZIP = "PLZ";
    var $_PHPSHOP_MANUFACTURER_FORM_PHONE = "Telefon";
    var $_PHPSHOP_MANUFACTURER_FORM_CURRENCY = "W&auml;hrung";
    var $_PHPSHOP_MANUFACTURER_FORM_CATEGORY = "Herstellerkategorie";
    var $_PHPSHOP_MANUFACTURER_FORM_LAST_NAME = "Nachname";
    var $_PHPSHOP_MANUFACTURER_FORM_FIRST_NAME = "Vorname";
    var $_PHPSHOP_MANUFACTURER_FORM_MIDDLE_NAME = "mittlerer Name";
    var $_PHPSHOP_MANUFACTURER_FORM_TITLE = "Titel";
    var $_PHPSHOP_MANUFACTURER_FORM_PHONE_1 = "Telefon 1";
    var $_PHPSHOP_MANUFACTURER_FORM_PHONE_2 = "Telefon 2";
    var $_PHPSHOP_MANUFACTURER_FORM_FAX = "Fax";
    var $_PHPSHOP_MANUFACTURER_FORM_EMAIL = "Email";
    var $_PHPSHOP_MANUFACTURER_FORM_IMAGE_PATH = "Bildpfad";
    var $_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION = "Beschreibung";
    
    
    // Hersteller Kategorieliste
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_MNU = "Herstellerkategorien auflisten";
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_LBL = "Herstellerkategorieliste";
    var $_PHPSHOP_MANUFACTURER_CAT_NAME = "Kategoriename";
    var $_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION = "Kategoriebeschreibung";
    var $_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS = "Hersteller";
    
    // Manufacturer Category Form
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_MNU = "Neu: Herstellerkategorie";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_LBL = "Herstellerkategorie &auml;ndern/hinzuf&uuml;gen";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL = "Kategorieinformation";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_NAME = "Kategoriename";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION = "Kategoriebeschreibung";
    
    /*#####################
    Modul HELP
    #####################*/
    var $_PHPSHOP_HELP_MOD = "Hilfe";
    
    // 210104 start
    
    // basketform
    var $_PHPSHOP_CART_ACTION = "Aktionen";
    var $_PHPSHOP_CART_UPDATE = "aktualisieren";
    
    //230104
    var $_PHPSHOP_CART_DELETE = "L&ouml;schen";
    
    //shopbrowse form
    
    var $_PHPSHOP_PRODUCT_PRICETAG = "Preis";
    var $_PHPSHOP_PRODUCT_CALL = "Preis bitte erfragen";
    var $_PHPSHOP_PRODUCT_PREVIOUS = "VORHERIGE";
    var $_PHPSHOP_PRODUCT_NEXT = "N&Auml;CHSTE";
    
    //ro_basket
    
    var $_PHPSHOP_CART_TAX = "MwSt.";
    var $_PHPSHOP_CART_SHIPPING = "Versandkosten";
    var $_PHPSHOP_CART_TOTAL = "Endsumme";
    
    //CHECKOUT.INDEX
    
    var $_PHPSHOP_CHECKOUT_NEXT = "Weiter";
    var $_PHPSHOP_CHECKOUT_REGISTER = "REGISTRIEREN";
    
    //CHECKOUT.CONFIRM
    
    var $_PHPSHOP_CHECKOUT_CONF_BILLINFO = "Rechungsinformationen";
    var $_PHPSHOP_CHECKOUT_CONF_COMPANY = "Firma";
    var $_PHPSHOP_CHECKOUT_CONF_NAME = "Name";
    var $_PHPSHOP_CHECKOUT_CONF_ADDRESS = "Adresse";
    var $_PHPSHOP_CHECKOUT_CONF_PHONE = "Telefon";
    var $_PHPSHOP_CHECKOUT_CONF_FAX = "Fax";
    var $_PHPSHOP_CHECKOUT_CONF_EMAIL = "Email";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO = "Lieferinformationen";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY = "Firma";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME = "Name";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS = "Adresse";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE = "Telefon";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX = "Fax";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO = "Bezahlung";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD = "Name auf der Karte";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD = "Bezahlung per";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM = "Kreditkartennummer";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE = "G&uuml;ltigkeitsdatum";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER = "Bestellung absenden";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO = "nur notwendig, falls Zahlung per Kreditkarte gew&auml;hlt wird.";
    
    
    var $_PHPSHOP_ZONE_MOD = "Lieferzonen";
    
    var $_PHPSHOP_ZONE_LIST_MNU = "Lieferzonen auflisten";
    var $_PHPSHOP_ZONE_FORM_MNU = "Lieferzone hinzuf&uuml;gen";
    var $_PHPSHOP_ZONE_ASSIGN_MNU = "Lieferzonen zuordnen";
    
    // assign zone List
    var $_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL = "Land";
    var $_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL = "aktuelle Zone";
    var $_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL = "zu Zone zuordnen";
    var $_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL = "Aktualisieren";
    var $_PHPSHOP_ASSIGN_ZONE_PG_LBL = "Zonen zuordnen";
    
    // zone Form
    var $_PHPSHOP_ZONE_FORM_NAME_LBL = "Zonenname";
    var $_PHPSHOP_ZONE_FORM_DESC_LBL = "Zonenbeschreibung";
    var $_PHPSHOP_ZONE_FORM_COST_PER_LBL = "Kosten pro Artikel";
    var $_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL = "Kostenobergrenze";
    
    // List of zones
    var $_PHPSHOP_ZONE_LIST_LBL = "Zonenliste";
    var $_PHPSHOP_ZONE_LIST_NAME_LBL = "Zonenname";
    var $_PHPSHOP_ZONE_LIST_DESC_LBL = "Zonenbeschreibung";
    var $_PHPSHOP_ZONE_LIST_COST_PER_LBL = "Kosten pro Artikel";
    var $_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL = "Kostenobergrenze";
    
    var $_PHPSHOP_LOGIN_FIRST = "Melden Sie sich bitte zuerst an oder Registrieren Sie sich <br>als Nutzer dieser Seite. Danke!";
    var $_PHPSHOP_STORE_FORM_TOS = "Gesch&auml;ftsbedingungen";
    var $_PHPSHOP_AGREE_TO_TOS = "Vor der Registrierung ist eine Zustimmung zu den Gesch&auml;ftsbedingungen erforderlich.";
    var $_PHPSHOP_I_AGREE_TO_TOS = "Ich stimme den Gesch&auml;ftsbedingungen zu.";
    
    var $_PHPSHOP_LEAVE_BLANK = "(Bitte nichts eintragen, bevor<br />keine abweichende Detail-php-seite erstellt wurde!)";
    var $_PHPSHOP_RETURN_LOGIN = "Bereits registriert? Bitte melden Sie sich an.";
    var $_PHPSHOP_NEW_CUSTOMER = "Neu hier? Dann f&uuml;llen Sie bitte nachfolgende Felder aus. Die Angaben werden gespeichert und ersparen Ihnen eine Neueingabe. Als registrierter Benutzer haben Sie auch Zugriff auf Ihre Bestellinformationen.";
    var $_PHPSHOP_ACC_CUSTOMER_ACCOUNT = "Kundeninformationen von:";
    var $_PHPSHOP_ACC_ORDER_INFO = "Bestellungen";
    var $_PHPSHOP_ACC_UPD_BILL = "Hier k&ouml;nnen Sie ihre Rechungsadressdaten &auml;ndern";
    var $_PHPSHOP_ACC_UPD_SHIP = "Hier k&ouml;nnen Sie Lieferadressen hinzuf&uuml;gen oder vorhandene &auml;ndern.";
    var $_PHPSHOP_ACC_ACCOUNT_INFO = "Rechungsadresse";
    var $_PHPSHOP_ACC_SHIP_INFO = "Lieferadressen";
    var $_PHPSHOP_ACC_NO_ORDERS = "keine Bestellungen vorhanden";
    var $_PHPSHOP_ACC_BILL_DEF = "- Standard (wie Rechnungsadresse)";
    var $_PHPSHOP_SHIPTO_TEXT = "Sie k&ouml;nnen unbegrenzt Lieferadressen zu Ihrem Kundenkonto hinzuf&uuml;gen. Bitte benutzen Sie eine Abk&uuml;rzung f&uuml;r die Lieferadresse, um diese sp&auml;ter wiedererkennen zu k&ouml;nnen.";
    var $_PHPSHOP_CONFIG = "Konfiguration";
    var $_PHPSHOP_USERS = "Nutzer";
    var $_PHPSHOP_IS_CC_PAYMENT = "Kreditkarten-Bezahlart?";
    
    /*##################*/
    # SHIPPING MOD
    /*##################*/
    var $_PHPSHOP_SHIPPING_MOD = "Versandkosten";
    var $_PHPSHOP_SHIPPING_MENU_LABEL = "Versandkosten";
    
    // User List
    var $_PHPSHOP_CARRIER_LIST_MNU = "Versender auflisten";
    var $_PHPSHOP_CARRIER_LIST_LBL = "Versenderliste";
    var $_PHPSHOP_RATE_LIST_MNU = "Versandarten auflisten";
    var $_PHPSHOP_RATE_LIST_LBL = "Versandartenliste";
    var $_PHPSHOP_CARRIER_LIST_NAME_LBL = "Name";
    var $_PHPSHOP_CARRIER_LIST_ORDER_LBL = "Reihenfolge";
    
    // User Form
    var $_PHPSHOP_CARRIER_FORM_MNU = "Versender erstellen";
    var $_PHPSHOP_CARRIER_FORM_LBL = "Versender bearbeiten / erstellen";
    var $_PHPSHOP_RATE_FORM_MNU = "Versandart erstellen";
    var $_PHPSHOP_RATE_FORM_LBL = "Versandart bearbeiten / erstellen";
    
    var $_PHPSHOP_RATE_FORM_NAME = "Versandartname";
    var $_PHPSHOP_RATE_FORM_CARRIER = "Versender";
    var $_PHPSHOP_RATE_FORM_COUNTRY = "Land/L&auml;nder";
    var $_PHPSHOP_RATE_FORM_ZIP_START = "PLZ-Bereich Anfang";
    var $_PHPSHOP_RATE_FORM_ZIP_END = "PLZ-Bereich Ende";
    var $_PHPSHOP_RATE_FORM_WEIGHT_START = "Untere Gewichtsgrenze";
    var $_PHPSHOP_RATE_FORM_WEIGHT_END = "Obere Gewichtsgrenze";
    var $_PHPSHOP_RATE_FORM_VALUE = "Versandkosten";
    var $_PHPSHOP_RATE_FORM_PACKAGE_FEE = "Verpackungskosten";
    var $_PHPSHOP_RATE_FORM_CURRENCY = "W&auml;hrung";
    var $_PHPSHOP_RATE_FORM_VAT_ID = "MwSt.-Satz";
    var $_PHPSHOP_RATE_FORM_LIST_ORDER = "Reihenfolge";
    
    var $_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL = "Versender";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME = "Versandbezeichnung";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART = "Gewicht von ...";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND = "... bis";
    var $_PHPSHOP_CARRIER_FORM_NAME = "Versender Firmenname";
    var $_PHPSHOP_CARRIER_FORM_LIST_ORDER = "Reihenfolge";
    var $_PHPSHOP_ERR_MSG_CARRIER_EXIST = "Fehler: Ein Versender mit dieser ID existiert bereits.";
    var $_PHPSHOP_ERR_MSG_CARRIER_ID_REQ = "Fehler: W&auml;hlen Sie einen Versender aus.";
    var $_PHPSHOP_ERR_MSG_CARRIER_INUSE = "Fehler: Zum Versender existiert wenigstens eine Versandkosteneinheit. L&ouml;schen Sie zun&auml;chst diese Referenz";
    var $_PHPSHOP_ERR_MSG_CARRIER_NOTFOUND = "Fehler: Kein Versender mit dieser ID vorhanden.";
    
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_REQ = "Fehler: W&auml;hlen Sie einen Versender aus.";
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_INV = "Fehler: Kein Versender mit dieser ID vorhanden.";
    var $_PHPSHOP_ERR_MSG_RATE_NAME_REQ = "Fehler: Geben Sie der Versandkosteneinheit einen Name.";
    var $_PHPSHOP_ERR_MSG_RATE_COUNTRY_CODE_INV = "Fehler: Das Zielland ist ung&uuml;ltig. Mehrere L&auml;nder k&ouml;nnen durch \";\" getrennt werden.";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_START_REQ = "Fehler: Eine untere Gewichtsangabe ist erforderlich";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_END_REQ = "Fehler: Eine obere Gewichtsangabe ist erforderlich";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_STARTEND_INV = "Fehler: Die untere Gewichtsangabe muss kleiner als die Obere sein";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_VALUE_REQ = "Fehler: Es muss ein Transportpreis angegeben werden";
    var $_PHPSHOP_ERR_MSG_RATE_CURRENCY_ID_INV = "Fehler: Es muss eine W&auml;hrung angegeben werden";
    
    var $_PHPSHOP_ERR_MSG_RATE_ID_REQ = "Fehler: Es muss eine Versandkosteneinheit ausgwe&auml;hlt werden";
    
    var $_PHPSHOP_INFO_MSG_PLEASE_SELECT = "Bitte w&auml;hlen Sie";
    var $_PHPSHOP_INFO_MSG_CARRIER = "Versender";
    var $_PHPSHOP_INFO_MSG_SHIPPING_METHOD = "Versandart";
    var $_PHPSHOP_INFO_MSG_SHIPPING_PRICE = "Preis";
    var $_PHPSHOP_INFO_MSG_VAT_ZERO_LBL = "0 (-keine-)";
    /*#################################################
        ENDE MODUL SHIPPING
    ###################################################*/
    var $_PHPSHOP_PAYMENT_FORM_CC = "Kreditkarte";
    var $_PHPSHOP_PAYMENT_FORM_USE_PP = "Nutzung mit Internet-Bezahlsystem";
    var $_PHPSHOP_PAYMENT_FORM_BANK_DEBIT = "Bankeinzug";
    var $_PHPSHOP_PAYMENT_FORM_AO = "Nachnahme/Vorkasse";
    var $_PHPSHOP_CHECKOUT_MSG_2 = "Bitte w&auml;hlen Sie eine Lieferadresse aus!";
    var $_PHPSHOP_CHECKOUT_MSG_3 = "Bitte w&auml;hlen Sie eine Versandart aus!";
    var $_PHPSHOP_CHECKOUT_MSG_4 = "Bitte w&auml;hlen Sie eine Zahlungsweise aus!";
    var $_PHPSHOP_CHECKOUT_MSG_99 = "Bitte &uuml;berpr&uuml;fen Sie alle Angaben und best&auml;tigen die Bestellung!";
    
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIP = "Bitte w&auml;hlen Sie eine Versandart aus!";
    var $_PHPSHOP_CHECKOUT_ERR_OTHER_SHIP = "Bitte w&auml;hlen Sie eine andere Versandart aus!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_PAYM = "Bitte w&auml;hlen Sie eine Zahlungsart!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR = "Bitte geben Sie Ihre Kreditkartennummer an!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNAME = "Bitte geben Sie den Name auf der Kreditkarte an!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATE = "Die Kreditkartennummer ist leider ung&uuml;ltig!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCMON = "Bitte geben Sie den Monat der Kreditkartenlaufzeit an!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCYEAR = "Bitte geben Sie das Jahr der Kreditkartenlaufzeit an!";
    var $_PHPSHOP_CHECKOUT_ERR_CCDATE_INV = "Das Datum der Kreditkartenlaufzeit ist ung&uuml;ltig!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIPTO = "Bitte w&auml;hlen Sie eine Lieferadresse aus!";
    var $_PHPSHOP_CHECKOUT_ERR_CCNUM_INV = "Die Kreditkartennummer ist leider ung&uuml;ltig!";
    var $_PHPSHOP_CHECKOUT_ERR_EMPTY_CART = "Es befindet sich nichts in Ihrem Warenkorb!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CARR = "Fehler: Bitte w&auml;hlen Sie einen Versender aus!";
    var $_PHPSHOP_CHECKOUT_ERR_RATE_NOT_FOUND = "Fehler: Die ausgew&auml;hlte Versandmethode wurde nicht gefunden!";
    var $_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND = "Fehler: Ihre Versandadresse wurde nicht gefunden!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATA = "Fehler beim Behandeln der Kreditkartendaten!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR_FOUND = "Fehler: Keine Kreditkartennummer gefunden!";
    var $_PHPSHOP_CHECKOUT_ERR_TEST = "Achtung, die eingegebene Kreditkartennummer ist nur f&uuml;r Testzwecke!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_USER_DATA = "Die Nutzer-ID wurde in der Datenbank nicht gefunden!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_HOLDER_NAME = "Bitte teilen Sie uns den Kontoinhaber mit!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_IBAN = "Bitte teilen Sie uns die IBAN ihrer Bank mit!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_NUM = "Bitte hinterlassen Sie ihre Kontonummer.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_SORT = "Bitte hinterlassen Sie vorher ihre Bankleitzahl.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_NAME = "Bitte hinterlassen Sie vorher den Namen ihrer Bank.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_VALID_STEP = "CheckOut hat keinen Step gefunden!";
    var $_PHPSHOP_CHECKOUT_MSG_LOG = "Zahlungsinformationen wurden f&uuml;r sp&auml;tere Bearbeitung gespeichert.<BR>";
    
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV = "Der Mindestbestellwert ist leider noch nicht erreicht!";
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV2 = "Unser Mindestbestellwert betr&auml;gt:";
    var $_PHPSHOP_CHECKOUT_PAYMENT_CC = "Bezahlung per Kreditkarte";
    var $_PHPSHOP_CHECKOUT_PAYMENT_OTHER = "andere Zahlungsarten";
    var $_PHPSHOP_CHECKOUT_PAYMENT_SELECT = "W&auml;hlen Sie eine Zahlungsart:";
    
    var $_PHPSHOP_STORE_FORM_MPOV = "Mindestbestellwert";
    var $_PHPSHOP_ACCOUNT_BANK_TITLE = "Bankkonto Informationen";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR = "Kontonummer";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE = "Bankleitzahl";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_NAME = "Bank Name";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_IBAN = "IBAN";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER = "Kontoinhaber";
    
    var $_PHPSHOP_MODULES = "Module";
    var $_PHPSHOP_FUNCTIONS = "Funktionen";
    var $_PHPSHOP_SPECIAL_PRODUCTS = "Aktionsprodukte auflisten";
    var $_PHPSHOP_CHECKOUT_CUSTOMER_NOTE = "Falls Sie Anmerkungen zur Bestellung haben, teilen Sie uns diese mit";
    var $_PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE = "Anmerkungen des Kunden zur Bestellung";
    var $_PHPSHOP_INCLUDING_TAX= "(inkl. \$tax % MwSt.)";
    var $_PHPSHOP_PLEASE_SEL_ITEM = "Bitte w&auml;hlen Sie einen Artikel aus";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_LBL = "Artikel";
    

// DOWNLOADS

    var $_PHPSHOP_DOWNLOADS_TITLE = "Download-Bereich";
    var $_PHPSHOP_DOWNLOADS_START = "Download starten";
    var $_PHPSHOP_DOWNLOADS_INFO = "Bitte geben Sie hier Ihre per e-mail erhaltene Download-ID ein und klicken Sie anschlieﬂend auf \"Download starten\".";
    var $_PHPSHOP_DOWNLOADS_ERR_EXP = "Das maximale Download-Datum ist leider abgelaufen";
    var $_PHPSHOP_DOWNLOADS_ERR_MAX = "Download-Anzahl abgelaufen";
    var $_PHPSHOP_DOWNLOADS_ERR_INV = "Download-ID ung&uuml;ltig";
    var $_PHPSHOP_DOWNLOADS_ERR_SEND = "Kann Benachrichtigung nicht senden an ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG = "Info gesendet an ";
    var $_PHPSHOP_DOWNLOADS_SEND_SUBJ = "Download-Info";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_1 = "die von Ihnen bestellte Datei steht zum Download bereit";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_2 = "Bitte  geben Sie im Shop folgende Download-ID  ein: ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_3 = "m&ouml;gliche Download-Versuche: ";    
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_4 = "Download bis {expire} Tage nach dem 1.Versuch";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_5 = "Fragen? Probleme?";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_6 = "Download-Info von "; // e.g. Download-Info by "Storename"
    var $_PHPSHOP_PRODUCT_FORM_DOWNLOADABLE = "downloadbares Produkt?"; 
    
    var $_PHPSHOP_PAYPAL_THANKYOU = "Danke f&uuml;r Ihre Zahlung. 
        Ihre Transaktion wurde abgeschlossen und Sie erhalten per E-Mail eine Quittung f&uuml;r Ihren Kauf. 
        Sie k&ouml;nnen sich unter <a href=http://www.paypal.com>www.paypal.com</a> in Ihr Konto einloggen, um die Transaktionsdetails anzuzeigen.";
    var $_PHPSHOP_PAYPAL_ERROR = "Achtung, bei der Transaktion ist m&ouml;glicherweise ein Fehler aufgetreten. Der Status der Bestellung
        konnte nicht aktualisiert werden.";
        
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER1 = "Danke f&uuml;r Ihre Bestellung. Ihre Bestell-Informationen finden Sie nachfolgend.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER2 = "Vielen Dank f&uuml;r Ihr Vertrauen, wir hoffen Sie bald wieder in unserem Shop begr&uuml;ﬂen zu k&ouml;nnen.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER3 = "Fragen? Probleme?";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER4 = "Eine neue Bestellung ist eingetroffen.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER5 = "Die Bestellung k&ouml;nnen Sie durch diesen Link ansehen.";
    
    var $_PHPSHOP_CART_ERROR_NO_NEGATIVE = "Negative Mengen sind nicht gestattet.";
    var $_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY = "Bitte geben Sie eine g&uuml;ltige Menge an.";
    
    var $_PHPSHOP_CART_STOCK_1 = "Die von Ihnen angegebene Menge ist leider nicht vorhanden.";
    var $_PHPSHOP_CART_STOCK_2 = "Wir haben zur Zeit \$product_in_stock Artikel dieses Produktes auf Lager.";
    var $_PHPSHOP_CART_STOCK_3 = "Bitte klicken Sie hier, um auf eine Warteliste f&uuml;r dieses Produkt gesetzt zu werden.";
    var $_PHPSHOP_CART_SELECT_ITEM = "Bitte w&auml;hlen Sie einen Artikel von der Detailseite aus!";

    var $_PHPSHOP_REGISTRATION_FORM_NONE = "keiner";
    var $_PHPSHOP_REGISTRATION_FORM_MR = "Herr";
    var $_PHPSHOP_REGISTRATION_FORM_MRS = "Frau";
    var $_PHPSHOP_REGISTRATION_FORM_DR = "Dr.";
    var $_PHPSHOP_REGISTRATION_FORM_PROF = "Prof.";
    var $_PHPSHOP_DEFAULT = "Standard";
        
  /*#####################################################
    MODULE AFFILIATE
  #######################################################*/
    var $_PHPSHOP_AFFILIATE_MOD   = "Affiliate";
    
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
    var $_PHPSHOP_AFFILIATE_FORM_RATE		= "Commission Rate";
    var $_PHPSHOP_AFFILIATE_FORM_ACTIVE		= "Active?";
        
    var $_PHPSHOP_DELIVERY_TIME = "Lieferzeit";
    var $_PHPSHOP_DELIVERY_INFORMATION = "Informationen zur Lieferung";
    var $_PHPSHOP_MORE_CATEGORIES = "mehr Kategorien";
    var $_PHPSHOP_AVAILABILITY = "Verf&uuml;gbarkeit";
    var $_PHPSHOP_CURRENTLY_NOT_AVAILABLE = "Dieses Produkt ist zur Zeit leider nicht verf&uuml;gbar.";
    var $_PHPSHOP_PRODUCT_AVAILABLE_AGAIN = "Voraussichtlich wieder lieferbar ab: ";
    
    var $_PHPSHOP_STATISTIC_SUMMARY = "Zusammenfassung";
    var $_PHPSHOP_STATISTIC_STATISTICS = "Statistik";
    var $_PHPSHOP_STATISTIC_CUSTOMERS = "Kunden";
    var $_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS = "aktive Produkte";
    var $_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS = "inaktive Produkte";
    var $_PHPSHOP_STATISTIC_SUM = "Summe";
    var $_PHPSHOP_STATISTIC_NEW_ORDERS = "Neue Bestellungen";
    var $_PHPSHOP_STATISTIC_NEW_CUSTOMERS = "Neue Kunden";

	//Waiting list : file /administrator/components/com_phpshop/html/shop.waiting_list.php
	var $_PHPSHOP_WAITING_LIST_MESSAGE = "Bitte tragen Sie Ihre email-Adresse ein, um benachrichtigt zu werden, wenn das Produkt wieder verf&uuml;gbar ist. 
                                                                        Wir werden Ihre email-Adresse ausschlieﬂlich zum Zwecke der Benachrichtigung verwenden.
                                                                        <br /><br />Vielen Dank!";
	var $_PHPSHOP_WAITING_LIST_THANKS = "Vielen Dank! <br />Wir werden Sie benachrichtigen, sobald das Produkt wieder verf&uuml;gbar ist.";
	var $_PHPSHOP_WAITING_LIST_NOTIFY_ME = "Benachrichtigen Sie mich";
	
	//Checkout : file /administrator/components/com_phpshop/html/checkout.thankyou.php
	var $_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW = "Druckansicht";
  
  /**************************Admin.show_cfg.php in apparition order ;-)**************************************/
	
	/* PAGE 1 */
	var $_PHPSHOP_ADMIN_CFG_AUTORIZE_OR_CYBERCASH = "Bitte w&auml;hlen Sie entweder Authorize.net oder CyberCash";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS = "Die Konfigurationsdatei ";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE = "ist beschreibbar.";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE = "ist schreibgesch&uuml;tzt.";
	
	var $_PHPSHOP_ADMIN_CFG_GLOBAL = "Global";
	var $_PHPSHOP_ADMIN_CFG_PATHANDURL = "Pfade / URL";
	var $_PHPSHOP_ADMIN_CFG_SITE = "Seite";
	var $_PHPSHOP_ADMIN_CFG_SHIPPING = "Lieferung";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT = "Bestellung";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS = "Downloads";
	var $_PHPSHOP_ADMIN_CFG_PAYEMENTOPTIONS = "Bezahlung";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE = "Ausschlieﬂlich als Katalog benutzen";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN = "Falls aktiviert, sind alle Warenkorb- und Bestellfunktionen deaktiviert.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES = "Preise zeigen";
  var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN = "Wenn aktiviert, werden Preise angezeigt. Im Katalog-Modus ist es manchmal sinnvoll, die Preise von Produkten nicht zu zeigen.";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX = "Preise inkl. MwSt. zeigen?";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN = "Falls aktiviert, werden alle Preise im Shop einschlieﬂlich Umsatzsteuern angezeigt.";
		var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX = "Virtuelle Steuern?";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN = "Wenn aktiviert, werden auf Produkte mit einem Gewicht von 0 besteuert (Standard). Die Datei ps_checkout.php->calc_order_taxable() kann hierbei angepasst werden.";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE = "Steuer-Modus:";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP = "Basierend auf der Lieferadresse";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR = "Basierend auf der Betreiberadresse";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN = "Hiermit wird bestimmt, welche Steuerrate zur Anwendung kommt:<br />
                                                                                    <ul><li>die, die dem Herkunftsland des Kunden entspricht</li><br/>
                                                                                    <li>die, die dem Herkunftsland des Shop-Betreibers entspricht</li></ul>";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE = "Mehrere Steuerraten benutzen?";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN = "Wenn aktiviert, k&ouml;nnen verschiedene Produkte jeweils eigene Steuerraten erhalten (z.B. 7% f&uuml;r B&uuml;cher, 16% f&uuml;r andere Waren)";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE = "Rabatt f&uuml;r Zahlungarten vor Steuern und Lieferkosten abziehen?";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN = "Wenn aktiviert, werden Rabatte auf bestimmte Zahlungsarten vor Steuern und Lieferkosten abgezogen.";
  var $_PHPSHOP_ADMIN_CFG_REVIEW = "Kunden-Rezensionen und Produktbewertungen nutzen/erlauben?";
  var $_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN = "Wenn aktiviert, k&ouml;nnen registrierte Nutzer <strong>Produkte bewerten</strong> und <strong>Rezensionen schreiben</strong>.<br />
                                                                                Kunden wird es so erm&ouml;glicht, die eigenen Erfahrungen mit Produkten mit anderen Kunden zu teilen.<br />";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK = "Die Eingabe von Bankverbindungsdaten erm&ouml;glichem?";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN = "Falls aktiviert, besteht f&uuml;r Kunden die M&ouml;glichkeit, ihre Daten zur Bankverbindung zu hinterlassen.
                                                                                      Erforderlich bei der Nutzung von Zahlungsarten wie Bankeinzug o.&auml;.";

	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE = "Die Eingabe/Auswahl von Bundesl&auml;ndern erm&ouml;glichem?";
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN = "Falls aktiviert, k&ouml;nnen Kunden bei der Registrierung aus einer Auswahlliste Bundesl&auml;nder ausw&auml;hlen. 
                                                                                  (standardm&auml;ﬂig sind nur Bundesl&auml;nder der USA vorgegeben. Die Liste von Bundesl&auml;ndern kann in der Datei ps_html.php ge&auml;ndert werden.)";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS = "Zustimmung zu Gesch&auml;ftsbedingungen erforderlich?";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN = "Falls aktiviert, k&ouml;nnen sich Kunden nur im Shop registrieren, wenn Sie vorher den Gesch&auml;ftsbedingungen zustimmen.";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK = "Inventarverwaltung nutzen?";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN = "Falls aktiviert, wird stets &uuml;berpr&uuml;ft, ob das Produkt, welches ein Kunde in den Warenkorb legen m&ouml;chte,
                                                                                        noch im Bestand ist. Zudem wird bei jedem Produkt die noch vorhandene St&uuml;ckzahl angezeigt.
                                                                                          Falls nicht aktiviert, kann der Kunde mehr Produkte in den Warenkorb legen, als angegeben (Standard).";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE = "Affiliate-Programm aktivieren?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN = "Dies aktiviert die Nutzung des Shops durch sog. 'affiliates'. Sollte nur aktiviert werden, falls man bestimmt Shopper zur 'Affiliate'-Liste hinzugef&uuml;gt hat.";
	
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT = "Bestell-Email Format:";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT = "Text email";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML = "HTML email";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN = "Dies bestimmt, wie die Best&auml;tigungs-emails aufgemacht sind:<br />
                                                                                        <ul><li>als a einfache Text-email</li>
                                                                                        <li>oder als eine formatierte HTML-email mit Bildern.</li></ul>";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN = "Frontend-Administration f&uuml;r nicht-Backend Nutzer erlauben?";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN = "Mit dieser Einstellung kann es nicht-Backend-Nutzern (mit storeadmin oder admin Rechten) erm&ouml;glicht werden, 
                                                                                              die Frontend Administration zu nutzen (z.B. f&uuml;r registrierte Nutzer / Autoren).";

	/* PAGE 2 */
	var $_PHPSHOP_ADMIN_CFG_URL = "URL";
	var $_PHPSHOP_ADMIN_CFG_URL_EXPLAIN = "Die Web-Adresse zur Seite. Normalerweise identisch mit der Mambo URL (mit einem Schr&auml;gstrich am Ende!)";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE = "SECUREURL";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN = "The sichere Web-Adresse zur Seite. (https - mit einem Schr&auml;gstrich am Ende!)";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT = "COMPONENTURL";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN = "Die Web-Adresse zur mambo-phpShop Komponente. (mit einem Schr&auml;gstrich am Ende!)";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE = "IMAGEURL";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN = "Die Web-Adresse zum Bildverzeichnis der mambo-phpShop Komponente. (mit einem Schr&auml;gstrich am Ende!!)";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH = "ADMINPATH";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN = "Der Pfad zum mambo-phpShop /com_phpshop Administrationsverzeichnis.";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH = "CLASSPATH";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN = "Der Pfad zum mambo-phpShop /classes Verzeichnis.";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH = "PAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN = "Der Pfad zum mambo-phpShop /html Verzeichnis.";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH = "IMAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN = "Der Pfad zum mambo-phpShop /shop_image Verzeichnis.";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE = "HOMEPAGE";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN = "Dies ist die Seite, die geladen wird, falls kein page= Parameter angegeben ist.";	
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE = "ERRORPAGE";
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN = "Dies ist die Standard-Detail-Seite f&uuml;r Fehlermeldungen (veraltet).";	
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE = "DEBUGPAGE";
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN = "Die ist die Standardseite f&uuml;r Debugging-Meldungen.";	
	var $_PHPSHOP_ADMIN_CFG_DEBUG = "DEBUG ?";
	var $_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN = "Schaltet den Debugging-Modus zur Fehlersuche an.";


/* PAGE 3 */

	var $_PHPSHOP_ADMIN_CFG_FLYPAGE = "FLYPAGE";
	var $_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN = "Dies ist die Standardseite, um Produktdetails anzuzeigen.";
  var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE = "Standard - Kategorie-Vorlage";
	var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN = "Hiermit wird die standardm&auml;ﬂig zu ladende Vorlagendatei (template) angegeben,
                                                                                                      die Produkte in einer &Uuml;bersicht anzeigt.<br />
                                                                                                      Es k&ouml;nnen durch Anpassung der vorhandenen neue Vorlagen erstellt werden.<br />
                                                                                                      Diese Vorlagen befinden sich im Verzeichnis <strong>COMPONENTPATH/html/templates/</strong> 
                                                                                                      und fangen mit 'browse_' an";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW = "Produkte pro Zeile";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN = "Die legt die Standardm&auml;ﬂige Anzahl von Produkte in einer Tabellenzeile fest. <br />
                                                                                                      Beispiel: Ist 4 eingetragen, werden standardm&auml;ﬂig (falls keine spezielle Kategorie angegeben ist,
                                                                                                      4 Produkte pro Zeile angezeigt.";

	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE = "\"kein Bild vorhanden\" Bild";
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN = "Dies Bild wird gezeigt, falls kein eigenes Produktbild vorhanden ist.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS = "Anzahl der Zeilen von Suchergebnissen";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN = "Gibt die Anzahl der Zeilen einer Liste pro Seite einer Liste eines Suchergebnisses an.";
	
	
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 = "Suchfarbe 1";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN = "Gibt die Farbe der ungeraden Zeilen einer Liste an.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 = "Suchfarbe 2";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN = "Gibt die Farbe der geraden Zeilen einer Liste an.";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS = "Maximale Zeilen";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN = "Gibt die Anzahl der Zeilen an, die in der Bestell-Auswahlliste auftauchen.";

	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION = "Fuﬂzeile \"powered by mambo-phpShop\" anzeigen?";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN = "Zeigt ein Bild 'powered-by-mambo-phpShop' in der Fuﬂzeile.";
	
	
	/* PAGE 4 */
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD = "LIEFERMODUL";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD = "Standard Liefermodul mit individuell konfigurierbaren Transportunternehmen und Lieferarten. <strong>Empfohlen!</strong>";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE = "Zonen-Liefermodul, Country Version 1.0<br />
                                                                                                          F&uuml;r weitere Informationen zu diesem Modul steht <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br />
                                                                                                          zur Verf&uuml;gung oder kontaktieren Sie <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a>.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER = "InterShipper-Modul. Nur nutzen, wenn Sie einen Intershipper.com account haben.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE = "Liefermodule NICHT nutzen. Z.B. wenn Sie Downloadbare G&uuml;ter verkaufen, die nicht ausgeliefert werden m&uuml;ssen.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD = "InterShipper Passwort";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD_EXPLAIN = "Das Passwort for Ihren Intershipper Account.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL = "InterShipper email";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL_EXPLAIN = "Die email adresse f&uuml;r Ihren intershipper Account.";
    
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS = "UPS Tools Versandkostenberechnung";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE = "UPS Zugangs-Code";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN = "Der von UPS mitgeteilte Zugangs-Code";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID = "UPS User ID";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN = "Die von UPS mitgeteilte Nutzerkennung.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD = "UPS Passwort";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN = "Das Passwort f&uuml;r den UPS Account";
    
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY = "ENCODE KEY";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN = "Wird genutzt, um Daten in der Datenbank verschl&uuml;sselt zu hinterlegen. Diese Datei sollte daher nicht von Unauthorisierten eingesehen werden k&ouml;nnen.";
	
	
	/* PAGE 5 */
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR = "Bestellbegleitende &Uuml;bersicht aktivieren?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN = "Falls aktiviert, wird dem Kunden w&auml;hrend der verschiedenen Schritte der Bestellung jederzeit visuell signalisiert, 
                                                                                                        an welcher Stelle er/sie sich gerade befindet ( 1 - 2 - 3 - 4 mit Graphiken).";
	
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS = "Bestellprozess ausw&auml;hlen";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD = "<strong>Standard :</strong><br/>
               1. Auswahl der Lieferadresse<br />
              2. Auswahl der Lieferart<br />
              3. Auswahl der Zahlungsart<br />
              4. Best&auml;tigung der Bestellung";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 = "<strong>Prozess 2:</strong><br/>
               1. Auswahl der Lieferadresse<br />
              2. Auswahl der Zahlungsart<br />
              3. Best&auml;tigung der Bestellung";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 = "<strong>Prozess 3:</strong><br/>
               1. Auswahl der Lieferart<br />
              2. Auswahl der Zahlungsart<br />
              3. Best&auml;tigung der Bestellung";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 = "<strong>Prozess 4:</strong><br/>
               1. Auswahl der Zahlungsart<br />
              2. Best&auml;tigung der Bestellung";
	
	
	
	/* PAGE 6 */
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS = "Download-Feature aktivieren";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN = "Dies muss aktiviert werden, falls downloadbare G&uuml;ter verkauft werden sollen.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS = "Bestellstatus, mit dem der Download erm&ouml;glicht wird.";
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN = "W&auml;hlen Sie den Bestellstatus aus, bei dem der Kunde &uuml;ber den Download per e-mail benachrichtigt wird.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS = "Bestellstatus mit dem der Download deaktiviert wird.";
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN = "Bestellstatus, mit dem der Download f&uuml;r den Kunden deaktiviert wird.";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT = "DOWNLOAD-Pfad";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN = "Das Verzeichnis (keine URL!) zu den Dateien, die Kunden per ID herunterladen k&ouml;nnen (Schr&auml;gstrich am Ende!)<br>
        <span class=\"message\">Aus Sicherheitsgr&uuml;nden sollte dieses Verzeichnis in jedem Fall auﬂerhalb des Web-Wurzelverzeichnisses liegen.</span>";
	
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX = "Download-Maximum";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN = "Gibt die Anzahl von Dowloads an, die mit einer Download-ID durchgef&uuml;hrt werden k&ouml;nnen.";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE = "Download-Zeitspanne";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN = "Gibt die Zeitspanne <strong>in Sekonden</strong> an, in der der Kunde den Download durchf&uuml;hren kann. 
  Die Zeitspanne l&auml;uft ab dem ersten Download. Ist diese abgelaufen, wird die Download-ID deaktiviert.<br />Hinweis : 86400s=24h, 432000=5d.";
	
	
	
	
	/* PAGE 7 */
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL = "IPN (Sofortige Zahlungsbest&auml;tigung - PayPal) nutzen?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL_EXPLAIN = "Falls aktiviert, k&ouml;nnen Kunden die Zahlung &uuml;ber einen kostenlosen PayPal Account abwickeln.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL = "PayPal Email:";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL_EXPLAIN = "Die email adresse f&uuml;r PayPal Zahlungen. Ihre Empf&auml;nger-Email-Adresse.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS = "Bestellstatus for erfolgreiche Transaktionen";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS_EXPLAIN = "W&auml;hlen Sie den Bestellstatus aus, auf den die Bestellung gesetzt wird, wenn die Zahlunge &uuml;ber PayPal erfolgreich war. 
                                                                                                            Falls Sie das Download-Feature aktiviert haben, w&auml;hlen Sie den Status aus, bei dem der Download aktiviert wird und der Kunde
                                                                                                            die Download-ID mitgeteilt bekommt.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED = "Bestellstatus f&uuml;r fehlgeschlagene Transaktionen";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED_EXPLAIN = "W&auml;hlen Sie den Bestellstatus f&uuml;r fehlgeschlagene PayPal Transaktionen.";
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE = "PayMate Zahlungen f&uuml;r Kunden erm&ouml;glichen?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE_EXPLAIN = "Falls aktiviert, k&ouml;nnen Kunden die Zahlung &uuml;ber den kostenlosen AUSTRALISCHEN PayMate Service Account abwickeln.";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME = "PayMate Nutzername:";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME_EXPLAIN = "Ihr Nutzeraccount f&uuml;r PayMate.";
	
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET = "Authorize.net Zahlungen aktivieren?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_EXPLAIN = "Anhaken, falls Sie Kreditkartenzahlungen &uuml;ber Authorize.net abwickeln wollen.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE = "Test modus?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE_EXPLAIN = "W&auml;hlen Sie 'Ja' w&auml;hrend des Testens und 'Nein', um live Transaktionen zu erm&ouml;glichen.";
	var $_PHPSHOP_ADMIN_CFG_YES = "Ja";
	var $_PHPSHOP_ADMIN_CFG_NO = "Nein";
	
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME = "Authorize.net Login ID";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME_EXPLAIN = "Ihre Authorize.Net Login ID";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY = "Authorize.net Transaktionsschl&uuml;ssel";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY_EXPLAIN = "Ihr Authorize.net Transaction Key";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE = "Authentifizierungstyp";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE_EXPLAIN = "Dies ist der Authorize.Net Authentifizierungstyp.";
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH = "CyberCash-Zahlungen aktivieren?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH_EXPLAIN = "Anhaken, falls Sie Kreditkartenzahlungen &uuml;ber CyberCash-Zahlungen abwickeln wollen. (veraltet!)";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND = "CyberCash MERCHANT";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_EXPLAIN = "CC_MERCHANT ist Ihre CyberCash Merchant ID";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY = "CyberCash Merchant Key";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY_EXPLAIN = "CyberCash Merchant Key ist Ihr Merchant Schl&uuml;ssel f&uuml;r CyberCash";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL = "CyberCash PAYMENT URL";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL_EXPLAIN = "CyberCash PAYMENT URL ist die URL, mitgeteilt von Cybercash f&uuml;r sichere Zahlungen.";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE = "CyberCash AUTH TYPE";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE_EXPLAIN = "Dies ist der CyberCash Authentifizierungstyp";
	

    /** Advanced Search feature ***/
    var $_PHPSHOP_ADVANCED_SEARCH  ="Erweiterte Suche";
    var $_PHPSHOP_SEARCH_ALL_CATEGORIES = "Alle Kategorien durchsuchen";
    var $_PHPSHOP_SEARCH_ALL_PRODINFO = "Alle Produktinformationen durchsuchen";
    var $_PHPSHOP_SEARCH_PRODNAME = "nur nach Produktnamen";
    var $_PHPSHOP_SEARCH_MANU_VENDOR = "nur nach Hersteller-Webseite";
    var $_PHPSHOP_SEARCH_DESCRIPTION = "nur nach Produktbeschreibung";
    var $_PHPSHOP_SEARCH_AND = "und";
    var $_PHPSHOP_SEARCH_NOT = "nicht";
    var $_PHPSHOP_SEARCH_TEXT1 = "Die erste Auswahlliste l&auml;sst Sie eine Kategorie w&auml;hlen, in der Sie ausschlieﬂlich suchen wollen. 
        In der zweiten Auswahlliste k&ouml;nnen Sie angeben, nach welcher Art von Produktdetails Sie suchen wollen.";
    var $_PHPSHOP_SEARCH_TEXT2 = "Sie k&ouml;nnen die Suche durch Angabe eines zweiten Suchwortes verfeinern.
    Durch Auswahl von UND oder NICHT bestimmen Sie, ob das zweite Suchwort in den Produktdetails vorkommen muss,
    oder ob nur Produkte angezeigt werden sollen, die das zweite Suchwort NICHT enthalten.";
    var $_PHPSHOP_ORDERBY = "Sortieren nach";
    
    /*** Review feature ***/
    var $_PHPSHOP_CUSTOMER_RATING  = "Durchschnittliche Kundenbewertung";
    var $_PHPSHOP_TOTAL_VOTES = "Anzahl der Kundenbewertungen";
    var $_PHPSHOP_CAST_VOTE = "Bitte bewerten Sie das Produkt";
    var $_PHPSHOP_RATE_BUTTON = "Bewerten";
    var $_PHPSHOP_RATE_NOM = "Bewertung";
    var $_PHPSHOP_REVIEWS = "Kundenrezensionen";
    var $_PHPSHOP_NO_REVIEWS = "F&uuml;r dieses Produkt wurde noch keine Bewertung abgegeben.";
    var $_PHPSHOP_WRITE_FIRST_REVIEW = "Schreiben Sie als erster eine Rezension...";
    var $_PHPSHOP_REVIEW_LOGIN = "Bitte melden Sie sich an, um eine Rezension &uuml;ber dieses Produkt zu schreiben.";
    var $_PHPSHOP_REVIEW_ERR_RATE = "Bitte geben Sie eine Bewertung f&uuml;r das Produkt ab!";
    var $_PHPSHOP_REVIEW_ERR_COMMENT1 = "Bitte haben Sie Verst&auml;ndnis daf&uuml;r, dass f&uuml;r eine Rezension \\n die Eingabe von mindestens 100 Zeichen erforderlich sind.";
    var $_PHPSHOP_REVIEW_ERR_COMMENT2 = "Bitte haben Sie Verst&auml;ndnis daf&uuml;r, dass das Maximum \\n f&uuml;r Rezensionen 2000 Zeichen betr&auml;gt.";
    var $_PHPSHOP_WRITE_REVIEW = "Teilen Sie uns Ihre Meinung &uuml;ber dieses Produkt mit!";
    var $_PHPSHOP_REVIEW_RATE = "Zun&auml;chst w&auml;hlen Sie zur Bewertung einen Wert aus! <br />M&ouml;glich sind Bewertungen von 5 Sternen (ausgezeichnet) bis 0 Sterne (sehr schlecht).";
    var $_PHPSHOP_REVIEW_COMMENT = "Schreiben Sie nun Ihre Meinung / Rezension....(min. 100, max. 2000 Zeichen) ";
    var $_PHPSHOP_REVIEW_COUNT = "Anzahl Zeichen: ";
    var $_PHPSHOP_REVIEW_SUBMIT = "Rezension abschicken";
    var $_PHPSHOP_REVIEW_ALREADYDONE = "Sie haben f&uuml;r dieses Produkt bereits eine Rezension geschrieben. Vielen Dank.";
    var $_PHPSHOP_REVIEW_THANKYOU = "Vielen Dank, dass Sie uns Ihre Meinung mitgeteilt haben. Die Rezension wurde erfolgreich gespeichert.";
    var $_PHPSHOP_COMMENT= "Kommentar";
    
    var $_PHPSHOP_LIST_ALL_PRODUCTS = "Zeige alle Produkte";
    var $_PHPSHOP_PRODUCT_SEARCH_LBL = "Produktsuche";
    
    var $_PHPSHOP_CREDITCARD_FORM_LBL = "Kreditkartentypen &auml;ndern/hinzuf&uuml;gen";
    var $_PHPSHOP_CREDITCARD_NAME = "Kreditkartenname";
    var $_PHPSHOP_CREDITCARD_CODE = "Kreditkarten - Code";
    var $_PHPSHOP_CREDITCARD_TYPE = "Kreditkartentyp";
    
    var $_PHPSHOP_CREDITCARD_LIST_LBL = "Kreditkartenliste";
    var $_PHPSHOP_UDATE_ADDRESS = "Adresse aktualisieren";
    var $_PHPSHOP_CONTINUE_SHOPPING = "zur&uuml;ck zum Shop";
    
    var $_PHPSHOP_THANKYOU_SUCCESS = "Ihre Bestellung wurde erfolgreich gespeichert! Wir werdem umgehend mit der Bearbeitung der Bestellung beginnen.";
    var $_PHPSHOP_ORDER_LINK = "Folgen Sie dieser Verkn&uuml;pfung, um sich die Details der Bestellung anzeigen zu lassen.";
    
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "der Status Ihrer Bestellung Nr. {order_id} hat sich ge&auml;ndert.";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "Neuer Status ist:";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "Um die Details der Bestellung anzusehen, folgen Sie bitte dieser Verkn&uuml;pfung (oder kopieren Sie die Adresse in Ihren Browser):";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "&Auml;nderung des Bestellstatus: Bestell-Nr. {order_id}";
    var $_PHPSHOP_ORDER_LIST_NOTIFY = "Kunden benachrichtigen?";
    var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "Bitte erst den Status &auml;ndern!";
    
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "Preis-Nachlass auf die Standard-Shoppergruppe (in %)";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = "Ein positiver Betrag X.xx bedeutet: Falls ein Produkt keinen Preis f&uuml;r DIESE Shoppergruppe hat, wird der Preis der Standard-Shoppergruppe um X.xx % vermindert. Ein negativer Betrag erwirkt das Gegenteil.";    

    var $_PHPSHOP_PRODUCT_DISCOUNT_LBL = "Produkt-Rabatt";
    var $_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL = "Produkt-Rabatte Liste";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT = "Produktrabatt hinzuf&uuml;gen/&auml;ndern";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT = "Rabttbetrag";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP = "Tragen Sie den Rabattbetrag ein";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE = "Rabatt-Typ";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT = "Prozentwert";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL = "Geldbetrag";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP = "Geben Sie an, ob der angegebene Rabattbetrag ein Prozentwert oder ein Abzugsbetrag vom Preis sein soll.";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE = "Anfangsdatum des Rabattes";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP = "Bestimmt den Tag, ab dem der Rabatt g&uuml;ltig ist.";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE = "Enddatum des Rabattes";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP = "Bestimmt den Tag, bis zu dem der Rabatt g&uuml;ltig ist.";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP = "Benutzen Sie das Rabattformular um Rabatte hinzuzuf&uuml;gen!";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_SAVE = "Sie sparen";
    
    var $_PHPSHOP_FLYPAGE_ENLARGE_IMAGE = "gr&ouml;ﬂeres Bild anzeigen";
/*********************
Currency Display Style 
***********************/
    var $_PHPSHOP_CURRENCY_DISPLAY = "Darstellung von Betr&auml;gen";
    var $_PHPSHOP_CURRENCY_SYMBOL = "W&auml;hrungssymbol";
    var $_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP = "Es k&ouml;nnen auch HTML Entities benutzt werden (z.B. &amp;euro;,&amp;pound;,&amp;yen;,...)";
    var $_PHPSHOP_CURRENCY_DECIMALS = "Nachkommastellen";
    var $_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP = "Anzahl der Nachkommastellen (kann 0 sein)<br/><b>F&uuml;hrt eine implizite Rundung durch!</b>";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL = "Nachkomma - Trennzeichen";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP = "Das Trennzeichen, um die Nachkommastellen vom Restbetrag hervorzuheben (, oder .)";
    var $_PHPSHOP_CURRENCY_THOUSANDS = "Tausender - Trennzeichen";
    var $_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP = "Das Trennzeichen, um die Tausenderstellen hervorzuheben (kann leergelassen werden)";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY = "Format positiver Betr&auml;ge";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP = "Format zur Anzeige von positiven Betr&auml;gen.<br>(<i>Symb</i> steht f&uuml;r das W&auml;hrungssymbol)";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY = "Format negativer Betr&auml;ge";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP = "Format zur Anzeige von negativen Betr&auml;gen.<br>(<i>Symb</i> steht f&uuml;r das W&auml;hrungssymbol)";
    
    var $_PHPSHOP_OTHER_LISTS = "sonstige Produktlisten";
/**************
Multiple Images 
****************/
    var $_PHPSHOP_MORE_IMAGES = "weitere Bilder";
    var $_PHPSHOP_AVAILABLE_IMAGES = "Verf&uuml;gbare Bilder f&uuml;r";
    var $_PHPSHOP_BACK_TO_DETAILS = "zur&uuml;ck zu den Produktdetails";
    
    /* FILEMANAGER */
    var $_PHPSHOP_FILEMANAGER = "Datei-Manager";
    var $_PHPSHOP_FILEMANAGER_LIST = "Datei-Manager::Produktliste";
    var $_PHPSHOP_FILEMANAGER_ADD = "Bild/Datei hinzuf&uuml;gen";
    var $_PHPSHOP_FILEMANAGER_IMAGES = "zugewiesene Bilder";
    var $_PHPSHOP_FILEMANAGER_DOWNLOADABLE = "Ist downloadbar?";
    var $_PHPSHOP_FILEMANAGER_FILES = "zugewiesene Dateien (Datenbl&auml;tter, Katalogausz&uuml;ge,...)";
    var $_PHPSHOP_FILEMANAGER_PUBLISHED = "Ver&ouml;ffentlicht?";
    
    /* FILE LIST */
    var $_PHPSHOP_FILES_LIST = "Datei-Manager::Bild-/Dateiliste f&uuml;r";
    var $_PHPSHOP_FILES_LIST_FILENAME = "Dateiname";
    var $_PHPSHOP_FILES_LIST_FILETITLE = "Datei - Titel";
    var $_PHPSHOP_FILES_LIST_FILETYPE = "Dateityp";
    var $_PHPSHOP_FILES_LIST_EDITFILE = "Dateieintrag &auml;ndern";
    var $_PHPSHOP_FILES_LIST_FULL_IMG = "Vollbild";
    var $_PHPSHOP_FILES_LIST_THUMBNAIL_IMG = "kleines Bild";
    
    
    /* FILE FORM */
    var $_PHPSHOP_FILES_FORM = "Datei hinzuf&uuml;gen/aktualisieren f&uuml;r";
    var $_PHPSHOP_FILES_FORM_CURRENT_FILE = "Derzeitige Datei";
    var $_PHPSHOP_FILES_FORM_FILE = "Datei";
    var $_PHPSHOP_FILES_FORM_IMAGE = "Bild";
    var $_PHPSHOP_FILES_FORM_UPLOAD_TO = "Speichern in...";
    var $_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH = "Standard-Produktbildpfad";
    var $_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH = "Pfad angeben";
    var $_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH = "Download Verzeichnis (z.B. f&uuml;r Downloadbare G&uuml;ter)";
    var $_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL = "Automatisch kleines Bild erzeugen?";
    var $_PHPSHOP_FILES_FORM_FILE_PUBLISHED = "Datei ver&ouml;ffntlicht?";
    var $_PHPSHOP_FILES_FORM_FILE_TITLE = "Datei-Titel (Anzeige f&uuml;r den Kunden)";
    var $_PHPSHOP_FILES_FORM_FILE_DESC = "Datei-Beschreibung";
    var $_PHPSHOP_FILES_FORM_FILE_URL = "Datei - URL (optional)";
    
    /* FILE & IMAGE PROCESSING */
    var $_PHPSHOP_FILES_PATH_ERROR = "Bitte einen g&uuml;ltigen Pfad angeben!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS = "Das Bild wurde erfolreich verkleinert!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE = "Das kleine Bild konnte nicht automatisch verkleinert werden!";
    var $_PHPSHOP_FILES_UPLOAD_FAILURE = "Datei/Bild Upload Fehler";
    
    var $_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE = "Das groﬂe Bild konnte nicht gel&ouml;scht werden.";
    var $_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS = "Groﬂes Bild erfolgreich gel&ouml;scht.";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE = "Das kleine Bild konnte nicht gel&ouml;scht werden (m&ouml;glicherweise Datei nicht vorhanden): ";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS = "Kleines Bild erfolgreich gel&ouml;scht.";
    var $_PHPSHOP_FILES_FILE_DELETE_FAILURE = "Die Datei konnte nicht gel&ouml;scht werden.";
    var $_PHPSHOP_FILES_FILE_DELETE_SUCCESS = "Datei erfolgreich gel&ouml;scht.";
    
    var $_PHPSHOP_FILES_NOT_FOUND = "Die angeforderte Datei wurde leider nicht gefunden!";
    var $_PHPSHOP_IMAGE_NOT_FOUND = "Bild leider nicht gefunden!";


    /*#####################
    MODULE Gutschein
    #####################*/
    
    var $_PHPSHOP_COUPON_MOD = "Gutschein";
    var $_PHPSHOP_COUPONS = "Gutscheine";
    var $_PHPSHOP_COUPON_LIST = "Gutschein List";
    var $_PHPSHOP_COUPON_ALREADY_REDEEMED = "Der Gutschein wurde bereits eingel&ouml;st.";
    var $_PHPSHOP_COUPON_REDEEMED = "Der Gutschein wurde eingel&ouml;st! Vielen Dank.";
    var $_PHPSHOP_COUPON_ENTER_HERE = "Falls Sie einen Gutschein haben, tragen Sie den Code bitte hier ein:";
    var $_PHPSHOP_COUPON_SUBMIT_BUTTON = "Absenden";
    var $_PHPSHOP_COUPON_CODE_EXISTS = "Dieser Gutschein Code existiert bereits. Bitte w&auml;hlen Sie einen anderen.";
    var $_PHPSHOP_COUPON_EDIT_HEADER = "Gutschein aktualisieren";
    var $_PHPSHOP_COUPON_EDIT_HELP_TEXT = "Klicken Sie auf einen Gutschein Code um diesen zu aktualisieren";
    var $_PHPSHOP_COUPON_CODE_HEADER = "Code";
    var $_PHPSHOP_COUPON_PERCENT_TOTAL = "Prozent oder Betrag";
    var $_PHPSHOP_COUPON_TYPE = "Gutscheintyp";
    var $_PHPSHOP_COUPON_TYPE_TOOLTIP = "Ein Geschenk-Gutschein wird gel&ouml;scht, nachdem er vom Kunden in einer Bestellung eingel&ouml;st wurde. Ein permanenter Gutschein kann vom Kunden mehr als einmal genutzt werden.";
    var $_PHPSHOP_COUPON_TYPE_GIFT = "Geschenk-Gutschein";    
    var $_PHPSHOP_COUPON_TYPE_PERMANENT = "Permanenter Gutschein";    
    var $_PHPSHOP_COUPON_VALUE_HEADER = "Prozentsatz/Betrag";
    var $_PHPSHOP_COUPON_DELETE_BUTTON = "Gutschein Code L&ouml;schen";
    var $_PHPSHOP_COUPON_CONFIRM_DELETE = "Wollen Sie diesen Gutschein wirklich l&ouml;schen?";
    var $_PHPSHOP_COUPON_COMPLETE_ALL_FIELDS = "Bitte f&uuml;llen Sie alle Felder aus!";
    var $_PHPSHOP_COUPON_VALUE_NOT_NUMBER = "Der Betrag f&uuml;r den Gutschein muss eine Zahl sein.";
    var $_PHPSHOP_COUPON_NEW_HEADER = "Neuer Gutschein";
    var $_PHPSHOP_COUPON_COUPON_HEADER = "Gutschein-Code";
    var $_PHPSHOP_COUPON_PERCENT = "Prozent";
    var $_PHPSHOP_COUPON_TOTAL = "Betrag";
    var $_PHPSHOP_COUPON_VALUE = "Wert";
    var $_PHPSHOP_COUPON_CODE_SAVED = "Der Gutschein Code wurde gespeichert.";
    var $_PHPSHOP_COUPON_SAVE_BUTTON = "Gutschein speichern";
    var $_PHPSHOP_COUPON_DISCOUNT = "Gutschein-Rabatt";
    var $_PHPSHOP_COUPON_CODE_INVALID = "Gutschein Code nicht gefunden. Bitte versuchen Sie es erneut.";
    var $_PHPSHOP_COUPONS_ENABLE = "Gutschein-Benutzung aktivieren";
    var $_PHPSHOP_COUPONS_ENABLE_EXPLAIN = "Wird die Gutschein-Benutzung aktiviert, wird es dem Kunden erlaubt, w&auml;hrend des Bestellvorgangs einen Gutschein-Code einzugeben.";
    
    /* Free Shipping */
    var $_PHPSHOP_FREE_SHIPPING = "Versandkostenfrei";
    var $_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT = "Diese Bestellung ist versandkostenfrei!";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT = "Mindestbetrag f&uuml;r Wegfall der Versandkosten";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP = "Dieser Betrag (inkl. MwSt.!) gibt an, ab wann die Versandkosten komplett wegfallen 
                                                (Beispiel: <strong>50</strong> bedeutet versandkostenfreue Bestellung ab einem Bestellwert
                                                von \50Ä (inkl. MwSt.)";
    var $_PHPSHOP_YOUR_STORE = "Ihr Shop";
    var $_PHPSHOP_CONTROL_PANEL = "Startseite";
    
    /* Configuration Additions */
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON = "PDF - Button";
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN = "Den PDF - Button im Shop anzeigen / nicht anzeigen";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER = "Zu JEDER Bestellung Zustimmung zu AGB verlangen?";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN = "Aktivieren, falls vom Kunden zu JEDER Bestellung eine Zustimmung zu den AGB verlangt werden soll.";

    // We need this for eCheck.net Payments
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE = "Bankkonto-Typ";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING = "Giro-Konto";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING = "gesch&auml;ftliches Giro-Konto";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS = "Sparkonto/Sparbuch";
    
    var $_PHPSHOP_PAYMENT_AN_RECURRING = "Regelm&auml;ﬂige Zahlungen?";
    var $_PHPSHOP_PAYMENT_AN_RECURRING_TOOLTIP = "Erm&ouml;glicht die Einrichtung von regelm&auml;ﬂigen Zahlungen.";
    
    var $_PHPSHOP_INTERNAL_ERROR = "Interner Fehler bei Herstellung einer Verbindung zu";
    var $_PHPSHOP_PAYMENT_ERROR = "Fehler bei der Bearbeitung der Zahlung";
    var $_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS = "Die Zahlung wurde erfolgreich durchgef&uuml;hrt";
    
    /* UPS Shipping Module */
    var $_PHPSHOP_UPS_RESPONSE_ERROR = "UPS konnte die Anfrage zu den Versandarten nicht bearbeiten.";
    var $_PHPSHOP_UPS_SHIPPING_GUARANTEED_DAYS = "garantierte(r) Tag(e) zur Lieferung";
    var $_PHPSHOP_UPS_PICKUP_METHOD = "UPS Abhol-Methode";
    var $_PHPSHOP_UPS_PICKUP_METHOD_TOOLTIP = "Gibt an, wie Sie Pakete zu/von UPS geben/abholen lassen.";
    var $_PHPSHOP_UPS_PACKAGE_TYPE = "UPS Verpackung?";
    var $_PHPSHOP_UPS_PACKAGE_TYPE_TOOLTIP = "W&auml;hlen Sie die standardm&auml;ﬂige Verpackung f&uuml;r UPS.";
    var $_PHPSHOP_UPS_TYPE_RESIDENTIAL = "Lieferung an Privatpersonen?";
    var $_PHPSHOP_UPS_RESIDENTIAL = "Privatperson (RES)";
    var $_PHPSHOP_UPS_COMMERCIAL    = "Kommerzielle Leiferung (COM)";
    var $_PHPSHOP_UPS_RESIDENTIAL_TOOLTIP = "Von UPS Versandarten f&uuml;r Lieferung an Privatpersonen ODER kommerzielle Adressen erfragen?";
    var $_PHPSHOP_UPS_HANDLING_FEE = "Bearbeitungsgeb&uuml;hr";
    var $_PHPSHOP_UPS_HANDLING_FEE_TOOLTIP = "Ihre Bearbeitungsgeb&uuml;hr f&uuml;r diese Versandmethode.";
    var $_PHPSHOP_UPS_TAX_CLASS = "Steuerrate";
    var $_PHPSHOP_UPS_TAX_CLASS_TOOLTIP = "Die gew&auml;hlte Steuerrate auf die Versandkosten berechnen.";
    
    var $_PHPSHOP_ERROR_CODE = "Fehlercode";
    var $_PHPSHOP_ERROR_DESC = "Fehlerbeschreibung";
    
    var $_PHPSHOP_CHANGE_TRANSACTION_KEY = "Transaction Key anzeigen/&auml;ndern";
    var $_PHPSHOP_CHANGE_PASSKEY_FORM = "Passwort/Transaction Key anzeigen/&auml;ndern";
    var $_PHPSHOP_TYPE_PASSWORD = "Bitte geben Sie Ihr Nutzerpasswort ein";
    var $_PHPSHOP_CURRENT_PASSWORD = "Aktuelles Passwort";
    var $_PHPSHOP_CURRENT_TRANSACTION_KEY = "Aktueller Transaction Key";
    var $_PHPSHOP_CHANGE_PASSKEY_SUCCESS = "Der Transaction Key wurde erfolgreich ge&auml;ndert.";
    
    var $_PHPSHOP_PAYMENT_CVV2 = "Sicherheits-Code auf der Kredikarte abfragen (CVV2/CVC2/CID)";
    var $_PHPSHOP_PAYMENT_CVV2_TOOLTIP = "Soll der Kunde den Sicherheits-Code auf der Kredikarte eintragen (3- oder 4-stellige Zahl auf der R&uuml;ckseite von Kreditkarten, auf der Vorderseite bei American Express Karten)?";
    var $_PHPSHOP_CUSTOMER_CVV2_TOOLTIP = "Bitte geben Sie den 3- oder 4-stelligen Sicherheits-Code ein. (auf der R&uuml;ckseite von Kreditkarten, auf der Vorderseite bei American Express Karten)";
    var $_PHPSHOP_CUSTOMER_CVV2_ERROR = "Bitte geben Sie den 3- oder 4-stelligen Kredikarten-Sicherheits-Code ein.";
    
    var $_PHPSHOP_PRODUCT_FORM_FILENAME = "ENTWEDER einen Dateiname angeben";
    var $_PHPSHOP_PRODUCT_FORM_FILENAME_TOOLTIP = "Achtung: Wird hier ein Dateiname (bitte ohne Pfadangabe!) eingegeben, wird eine zum Upload angegebene Datei nicht gespeichert!!! Die in diesem Feld angegebene Datei muss per FTP hochgeladen werden.</strong>.";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD = "ODER eine neue Datei Uploaden";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD_TOOLTIP = "Diese Datei wird hochgeladen und stellt das zu verkaufende Produkt dar. Eine Vorhandene Datei wird gel&ouml;sct.";
    
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1 = "Geben Sie hier Text ein, der dem Kunden zur Verf&uuml;gbarkeit der Produktes angezeit wird.<br />z.B.: 24h, 48 Stunden, 3 - 5 Tage, auf Anfrage.....";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2 = "Order w&auml;hlen Sie ein Bild, um die Verf&uuml;gbarkeit visuell darzustellen.<br />Die Bilder hier sind eine automatische Auflistung aller vorhandenen Bilder in Ihrem Verzeichnis <i>/components/com_phpshop/shop_image/availability</i><br />";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST = "Attributsliste";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Beispiel f&uuml;r das Attributslisten-Format:</h4>
        <pre>Gr&ouml;ﬂe,XL[+1.99],M,S[-2.99];Farbe,Rot,Gr&uuml;n,Gelb,TeureFarbe[=24.00];WeiteresAttribut,..,..</pre>
        <h4>Preisanpassungen/-abweichungen sind m&ouml;glich:</h4>
        <span class=\"sectionname\">
        <strong>&#43;</strong> bedeutet: Den angegebenen Betrag zum Preis hinzuf&uuml;gen.<br />
        <strong>&#45;</strong> bedeutet: Den angegebenen Betrag zum Preis abzuziehen.<br />
        <strong>&#61;</strong> bedeutet: Ersetze den Preis mit dem angegebenen Betrag.
      </span>";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST = "Individual-Attributsliste";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Beispiel f&uuml;r die Individual-Attributsliste:</h4>
        <pre>Name;Spruch;Extras;...</pre>";
        
    var $_PHPSHOP_MULTISELECT = "Mehrfachauswahl mit STRG-Taste und Mausklick";
        
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN = "Das eProcessingNetwork.com Bezahlsystem aktivieren?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_EXPLAIN = "Anklicken, um eProcessingNetwork.com zu nutzen.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_TESTMODE = "Test Modus?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_TESTMODE_EXPLAIN = "W&auml;rhend einer Testpahse, bitte 'Ja' w&auml;hlen. 'Nein' aktiviert Live-Transaktionen.";
	
	var $_PHPSHOP_ADMIN_CFG_EPN_USERNAME = "eProcessingNetwork.com Login ID";
	var $_PHPSHOP_ADMIN_CFG_EPN_USERNAME_EXPLAIN = "Dies ist die eProcessingNetwork.com Login ID";
	var $_PHPSHOP_ADMIN_CFG_EPN_KEY = "eProcessingNetwork.com Transaction Key";
	var $_PHPSHOP_ADMIN_CFG_EPN_KEY_EXPLAIN = "This is your eProcessingNetwork.com Transaction Key";
	var $_PHPSHOP_ADMIN_CFG_EPN_AUTENTICATIONTYPE = "Authentication Type";
	var $_PHPSHOP_ADMIN_CFG_EPN_AUTENTICATIONTYPE_EXPLAIN = "This is the eProcessingNetwork.com authentication Typ.";

    var $_PHPSHOP_RELATED_PRODUCTS = "Verwandte Produkte";
    var $_PHPSHOP_RELATED_PRODUCTS_TIP = "Anhand dieser Liste k&ouml;nnen Produkt-Verbindungen aufgebaut werden. Durch die Auswahl eines oder mehrerer Produkte werden diese als 'verwandt' mit diesem Produkt gekennzeichnet.";
    
    var $_PHPSHOP_RELATED_PRODUCTS_HEADING = "Verwandte Produkte...";
    
    var $_PHPSHOP_IMAGE_ACTION = "Bild &auml;ndern?";
    var $_PHPSHOP_NONE = "nein";
    
    var $_PHPSHOP_ORDER_HISTORY = "Order History";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT = "Comment";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT_EMAIL = "Comments on your Order";
    var $_PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT = "Include this comment?";
    var $_PHPSHOP_ORDER_HISTORY_DATE_ADDED = "Date Added";
    var $_PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED = "Customer Notified?";
    var $_PHPSHOP_ORDER_STATUS_CHANGE = "Order Status Change";
    
     /* USPS Shipping Module */
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME = "USPS Nutzername";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME_TOOLTIP = "Der USPS Nutzername";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD = "USPS Passwort";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD_TOOLTIP = "Ihr pers&ouml;nliches USPS Passwort";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER = "USPS shipping server";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER_TOOLTIP = "USPS shipping server";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH = "USPS shipping Pfad";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH_TOOLTIP = "USPS shipping Pfad (kann unver&auml;ndert bleiben)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER = "USPS Containertyp";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER_TOOLTIP = "USPS Containertyp";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE = "USPS Packungsgr&ouml;ﬂe";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE_TOOLTIP = "USPS Packungsgr&ouml;ﬂe";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID = "USPS Package ID";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID_TOOLTIP = "USPS Package ID (muss 0 sein, mehrere Pakete werden nicht unterst&uuml;tzt)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE = "USPS Liefertyp";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE_TOOLTIP = "USPS Liefertyp (Express,First Class,Priority,Parcel,BPM,Library,Media)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_HANDLING_FEE = "Zusatzgeb&uuml;hren f&uuml;r diese Lieferart";
    var $_PHPSHOP_USPS_HANDLING_FEE = "Ihre Auwandsentsch&auml;digung f&uuml;r diese Lieferart.";
    var $_PHPSHOP_USPS_HANDLING_FEE_TOOLTIP = "Ihre Auwandsentsch&auml;digung f&uuml;r diese Lieferart.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE = "Ihre Auwandsentsch&auml;digung f&uuml;r internationale Lieferungen.";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE_TOOLTIP = "Ihre Auwandsentsch&auml;digung f&uuml;r internationale Lieferungen.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE = "Ihre Pro-Pfund-Rate f&uuml;r internationale Lieferungen.";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE_TOOLTIP = "Ihre Pro-Pfund-Rate f&uuml;r internationale Lieferungen.";
    var $_PHPSHOP_USPS_RESPONSE_ERROR = "Es gab Schwierigkeiten mit der Berechnung der Versandkosten: USPS konnte die Anfrage nicht verarbeiten.";
    
        
    /** Changed Produkttyp - Begin*/
    /*** Produkttyp ***/
    var $_PHPSHOP_PARAMETERS_LBL = "Parameter";
    var $_PHPSHOP_PRODUCT_TYPE_LBL = "Produkttyp";
    var $_PHPSHOP_PRODUCT_TYPE_LIST_LBL = "Produkttypenliste";
    var $_PHPSHOP_PRODUCT_TYPE_ADDEDIT = "Add/Edit Produkttyp";
    // Produkt - Produkt Produkttyp list
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL = "Produkttyp-Liste f&uuml;r";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_MNU = "Produkttypen auflisten";
    // Produkt - Produkt Produkttyp form
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL = "Produkttyp hinzuf&uuml;gen for";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_MNU = "Produkttyp hinzuf&uuml;gen";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE = "Produkttyp";
    // Produkt - Produkttyp form
    var $_PHPSHOP_PRODUCT_TYPE_FORM_NAME = "Produkttyp - Name";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION = "Produkttyp - Beschreibung";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS = "Parameter";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_LBL = "Produkttyp - Information";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH = "Ver&ouml;ffentlicht?";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE = "Produkttyp - &Uuml;bersichtsseite";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE = "Produkttyp - Detailseite";
    // Produkt - Produkttyp Parameter list
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL = "Parameter dieses Produkttyps";
    // Produkt - Produkttyp Parameter form
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LBL = "Parameter Information";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NOT_FOUND = "Produkttyp nicht gefunden!";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME = "Parametername";
    VAR $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME_DESCRIPTION = "Dies wird der Name der neu anzulegenden Tabelle in der Datenbank sein. Must also einmalig und ohne Leerzeichen sein.<br/>Beispiel: main_material";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL = "Parameterlabel";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DESCRIPTION = "Parameterbeschreibung";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE = "Parametertype";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_INTEGER = "ganze Zahl";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TEXT = "Text";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_SHORTTEXT = "Kurztext";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_FLOAT = "Flieﬂkommazahl";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_CHAR = "Buchstaben";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATETIME = "Datum &amp; Zeit";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE = "Datum";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE_FORMAT = "YYYY-MM-DD";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME = "Zeit";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME_FORMAT = "HH:MM:SS";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_BREAK = "Break Line";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_MULTIVALUE = "mehrere Werte";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES = "m&ouml;gliche Werte";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_MULTISELECT = "die m&ouml;glichen Werte als Mehrfachauswahl anzeigen?";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES_DESCRIPTION = "<strong>Wenn m&ouml;gliche Werte eingetragen sind, k&ouml;nnen die Parameter nur diese Werte haben. Beispiel f&uuml;r m&ouml;gliche Werte:</strong><br/><span class=\"sectionname\">Stahl;Holz;Plastik;...</span>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT = "Standard-Wert";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT_HELP_TEXT = "Beispiel f&uuml;r den Parameter Standard-Wert:<ul><li>Datum: YYYY-MM-DD</li><li>Zeit: HH:MM:SS</li><li>Datum & Zeit: YYYY-MM-DD HH:MM:SS</li></ul>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_UNIT = "Einheit";
    
	/************************* FrontEnd ***************************/
	/** shop.parameter_search.php */
	var $_PHPSHOP_PARAMETER_SEARCH = "Erweiterte Suche anhand von Parametern";
	var $_PHPSHOP_ADVANCED_PARAMETER_SEARCH = "Parameters Search";
	var $_PHPSHOP_PARAMETER_SEARCH_TEXT1 = "Anhand der Parametersuche kann man technische Parameter zum Filtern der Suchergebnisse verwenden. Bitte benutzen Sie dazu folgendes Formular:";
//	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "Es wurden keine Ergebnisse gefunden bzw. Starten Sie eine Suche.";
	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "I am sorry. There is no category for search.";
	/** shop.parameter_search_form.php */
	var $_PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE = "I am sorry. There is no published Product Type with this name.";
	var $_PHPSHOP_PARAMETER_SEARCH_IS_LIKE = "ist wie";
	var $_PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE = "ist nicht wie";
	var $_PHPSHOP_PARAMETER_SEARCH_FULLTEXT = "Volltextsuche";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL = "All Selected";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY = "Any Selected";
	var $_PHPSHOP_PARAMETER_SEARCH_RESET_FORM = "Formular zur&uuml;cksetzen";	
	/** shop.browse.php */
	var $_PHPSHOP_PARAMETER_SEARCH_IN_CATEGORY = "Suche in Kategorie";
	var $_PHPSHOP_PARAMETER_SEARCH_CHANGE_PARAMETERS = "Parameter &auml;ndern";
	var $_PHPSHOP_PARAMETER_SEARCH_DESCENDING_ORDER = "absteigende Sortierung";
	var $_PHPSHOP_PARAMETER_SEARCH_ASCENDING_ORDER = "aufsteigende Sortierung";
	/** shop.product.detail */
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETERS_IN_CATEGORY = "Parameter der Kategorie";
	/** Changed Produkttyp - End*/
    
    // State form and list
    var $_PHPSHOP_STATE_LIST_MNU = "Bundesl&auml;nder auflisten";
    var $_PHPSHOP_STATE_LIST_LBL = "Bundesl&auml;nderliste f&uuml;r: ";
    var $_PHPSHOP_STATE_LIST_ADD = "Hinzufg&uuml;en/Aktualisieren eines Bundeslandes";
    var $_PHPSHOP_STATE_LIST_NAME = "Name des Bundeslandes";
    var $_PHPSHOP_STATE_LIST_3_CODE = "Abk&uuml;rzung (3 Zeichen)";
    var $_PHPSHOP_STATE_LIST_2_CODE = "Abk&uuml;rzung (2 Zeichen)";
    
    // Gegenteil von Rabatt - meinetwegen auch "Aufschlag"
    var $_PHPSHOP_FEE = "Geb&uuml;hren";
    
    var $_PHPSHOP_PRODUCT_CLONE = "Produkt klonen";
    
    var $_PHPSHOP_CSV_SETTINGS = "Einstellungen";
    var $_PHPSHOP_CSV_DELIMITER = "Trennzeichen";
    var $_PHPSHOP_CSV_ENCLOSURE = "Feldbegrenzer";
    var $_PHPSHOP_CSV_UPLOAD_FILE = "Eine CSV Datei hochladen";
    var $_PHPSHOP_CSV_SUBMIT_FILE = "CSV Datei absenden";
    var $_PHPSHOP_CSV_FROM_DIRECTORY = "aus Verzeichnis laden";
    var $_PHPSHOP_CSV_FROM_SERVER = "CSV Datei vom Server laden";
    var $_PHPSHOP_CSV_EXPORT_TO_FILE = "CSV-Datei Export";
    var $_PHPSHOP_CSV_SELECT_FIELD_ORDERING = "Feld-Reihenfolge ausw&auml;hlen:";
    var $_PHPSHOP_CSV_DEFAULT_ORDERING = "Standard-Reihenfolge";
    var $_PHPSHOP_CSV_CUSTOMIZED_ORDERING = "eigene, angepasste Reihenfolge";
    var $_PHPSHOP_CSV_SUBMIT_EXPORT = "Alle Produkte in eine CSV-Datei exportieren";
    var $_PHPSHOP_CSV_CONFIGURATION_HEADER = "CSV Import / Export Konfiguration";
    var $_PHPSHOP_CSV_SAVE_CHANGES = "&Auml;nderungen speichern";
    var $_PHPSHOP_CSV_FIELD_NAME = "Feldname";
    var $_PHPSHOP_CSV_DEFAULT_VALUE = "Standardwert";
    var $_PHPSHOP_CSV_FIELD_ORDERING = "Reihenfolge";
    var $_PHPSHOP_CSV_FIELD_REQUIRED = "Pflichtfeld?";
    var $_PHPSHOP_CSV_IMPORT_EXPORT = "Import/Export";
    var $_PHPSHOP_CSV_NEW_FIELD = "Ein neues Feld anf¸gen";
    var $_PHPSHOP_CSV_DOCUMENTATION = "Dokumentation";

    var $_PHPSHOP_PRODUCT_NOT_FOUND = "Das angeforderte Produkt wurde nicht gefunden!";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS = "Produkte zeigen, die nicht verf¸gbar sind?";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN = "Falls angehakt,  werden auch solche Produkte gezeigt, deren Inventarmenge 0 betr‰gt. Ansonsten werden die Produkte nicht angezeigt.";
}

/** @global phpShopLanguage $PHPSHOP_LANG */
$PHPSHOP_LANG =& new phpShopLanguage();
?>
