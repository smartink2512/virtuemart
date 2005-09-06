<?php
/*
* @version $Id: italian.php,v 1.26 2005/06/22 19:50:45 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage languages
*
* @copyright (C) 2004 Soeren Eberhardt
* @translation Andrea Marucci (Shift Srl - http://www.shift.it)
* @translation edited and completed by Stefano Papaleo (http://www.pagineweb.biz)
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
    
    var $_PHPSHOP_MENU = "Menu";
    var $_PHPSHOP_CATEGORY = "Categoria";
    var $_PHPSHOP_CATEGORIES = "Categorie";
    var $_PHPSHOP_ADMIN = "Amministrazione";
    var $_PHPSHOP_PRODUCT = "Prodotto";
    var $_PHPSHOP_LIST = "lista";
    var $_PHPSHOP_ALL = "tutti";
    var $_PHPSHOP_VIEW = "vista";
    var $_PHPSHOP_SHOW = "mostra";
    var $_PHPSHOP_ADD = "aggiungi";
    var $_PHPSHOP_UPDATE = "aggiorna";
    var $_PHPSHOP_DELETE = "cancella";
    var $_PHPSHOP_SELECT = "seleziona";
    var $_PHPSHOP_SUBMIT = "Submit";
    var $_PHPSHOP_RANDOM = "Prodotti a caso";
    var $_PHPSHOP_LATEST = "Ultimi prodotti";
    
    /*#####################
    MODULE ACCOUNT
    #####################*/
    
    # Some LABELs
	var $_PHPSHOP_HOME_TITLE = "Home";
    var $_PHPSHOP_CART_TITLE = "Carrello";
    var $_PHPSHOP_CHECKOUT_TITLE = "Cassa";
    var $_PHPSHOP_LOGIN_TITLE = "Login";
    var $_PHPSHOP_LOGOUT_TITLE = "Esci";
    var $_PHPSHOP_BROWSE_TITLE = "Vedi";
    var $_PHPSHOP_SEARCH_TITLE = "Cerca";
    var $_PHPSHOP_ACCOUNT_TITLE = "Gestione Account";
    var $_PHPSHOP_NAVIGATION_TITLE = "Navigazione";
    var $_PHPSHOP_DEPARTMENT_TITLE = "Reparto";
    var $_PHPSHOP_INFO = "Informazioni";
    var $_PHPSHOP_BROWSE_LBL = "Vedi";
    var $_PHPSHOP_PRODUCTS_LBL = "Prodotti";
    var $_PHPSHOP_PRODUCT_LBL = "Prodotto";
    var $_PHPSHOP_SEARCH_LBL = "Cerca";
    var $_PHPSHOP_FLYPAGE_LBL = "Dettagli";
    
    var $_PHPSHOP_PRODUCT_NAME_TITLE = "Nome Prodotto";
    var $_PHPSHOP_PRODUCT_CATEGORY_TITLE = "Categoria Prodotto";
    var $_PHPSHOP_PRODUCT_DESC_TITLE = "Descrizione Prodotto";
    
    var $_PHPSHOP_CART_SHOW = "Mostra Carrello";
    var $_PHPSHOP_CART_ADD_TO = "Aggiungi al Carrello";
    var $_PHPSHOP_CART_NAME = "Nome";
    var $_PHPSHOP_CART_SKU = "Codice";
    var $_PHPSHOP_CART_PRICE = "Prezzo";
    var $_PHPSHOP_CART_QUANTITY = "Quantit&agrave;";
    var $_PHPSHOP_CART_SUBTOTAL = "Subtotale";
    
    # Some messages
    var $_PHPSHOP_ADD_SHIPTO_1 = "Aggiungi un nuovo";
    var $_PHPSHOP_ADD_SHIPTO_2 = "Indirizzo spedizione";
    var $_PHPSHOP_NO_SEARCH_RESULT = "Nessun risultato per la tua ricerca.<BR>";
    var $_PHPSHOP_PRICE_LABEL = "Prezzo: ";
    var $_PHPSHOP_ORDER_BUTTON_LABEL = "Aggiungi al carrello";
    var $_PHPSHOP_NO_CUSTOMER = "Non sei un utente registrato. Inserisci le informazioni per la fatturazione.";
    var $_PHPSHOP_DELETE_MSG = "Vuoi davvero cancellare questo record?";
    var $_PHPSHOP_THANKYOU = "Grazie per l\'ordine.";
    var $_PHPSHOP_NOT_SHIPPED = "Non ancora spedito";
    var $_PHPSHOP_EMAIL_SENDTO = "Un email di conferma &egrave; stata spedita a";
    var $_PHPSHOP_NO_USER_TO_SELECT = "Non c\'&grave; alcun utente da aggiungere alla lista com_phpshop";
    
    // Error messages
    
    var $_PHPSHOP_ERROR = "ERRORE";
    var $_PHPSHOP_MOD_NOT_REG = "Modulo non Registrato.";
    var $_PHPSHOP_MOD_ISNO_REG = "non &grave un modulo phpShop registrato.";
    var $_PHPSHOP_MOD_NO_AUTH = "Non hai il permesso di accedere a questo modulo.";
    var $_PHPSHOP_PAGE_404_1 = "La pagina non esiste";
    var $_PHPSHOP_PAGE_404_2 = "Il file non esiste. Non riesco a trovare il file:";
    var $_PHPSHOP_PAGE_403 = "Diritti di accesso insufficienti";
    var $_PHPSHOP_FUNC_NO_EXEC = "Non hai i permessi per eseguire ";
    var $_PHPSHOP_FUNC_NOT_REG = "Funzione non registrata";
    var $_PHPSHOP_FUNC_ISNO_REG = " non &grave; una funzione valida di MOS_com_phpShop.";
    
    /*#####################
    MODULE ADMIN
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADMIN_MOD = "Amministrazione";
    
    
    // User List
    var $_PHPSHOP_USER_LIST_MNU = "Lista degli utenti";
    var $_PHPSHOP_USER_LIST_LBL = "Lista Utenti";
    var $_PHPSHOP_USER_LIST_USERNAME = "Nome utente";
    var $_PHPSHOP_USER_LIST_FULL_NAME = "Nome completo";
    var $_PHPSHOP_USER_LIST_GROUP = "Gruppo";
    
    // User Form
    var $_PHPSHOP_USER_FORM_MNU = "Aggiungi utente";
    var $_PHPSHOP_USER_FORM_LBL = "Aggiungi/modifica informazioni utente";
    var $_PHPSHOP_USER_FORM_BILLTO_LBL = "Informazioni di fatturazione";
    var $_PHPSHOP_USER_FORM_SHIPTO_LBL = "Indirizzi di spedizione";
    var $_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL = "Aggiungi indirizzo";
    var $_PHPSHOP_USER_FORM_ADDRESS_LABEL = "Indirizzo Nickname";
    var $_PHPSHOP_USER_FORM_FIRST_NAME = "Nome";
    var $_PHPSHOP_USER_FORM_LAST_NAME = "Cognome";
    var $_PHPSHOP_USER_FORM_MIDDLE_NAME = "Secondo nome";
    var $_PHPSHOP_USER_FORM_TITLE = "Titolo";
    var $_PHPSHOP_USER_FORM_USERNAME = "Nome Utente";
    var $_PHPSHOP_USER_FORM_PASSWORD_1 = "Password";
    var $_PHPSHOP_USER_FORM_PASSWORD_2 = "Conferma Password";
    var $_PHPSHOP_USER_FORM_PERMS = "Permessi";
    var $_PHPSHOP_USER_FORM_COMPANY_NAME = "Societ&agrave;";
    var $_PHPSHOP_USER_FORM_ADDRESS_1 = "Indirizzo 1";
    var $_PHPSHOP_USER_FORM_ADDRESS_2 = "Indirizzo 2";
    var $_PHPSHOP_USER_FORM_CITY = "Citt&agrave;";
    var $_PHPSHOP_USER_FORM_STATE = "Provincia";
    var $_PHPSHOP_USER_FORM_ZIP = "Cap";
    var $_PHPSHOP_USER_FORM_COUNTRY = "Nazione";
    var $_PHPSHOP_USER_FORM_PHONE = "Telefono";
    var $_PHPSHOP_USER_FORM_FAX = "Fax";
    var $_PHPSHOP_USER_FORM_EMAIL = "Email";
    
    // Module List
    var $_PHPSHOP_MODULE_LIST_MNU = "Lista dei Moduli";
    var $_PHPSHOP_MODULE_LIST_LBL = "Lista Moduli";
    var $_PHPSHOP_MODULE_LIST_NAME = "Nome Modulo";
    var $_PHPSHOP_MODULE_LIST_PERMS = "Permessi Modulo";
    var $_PHPSHOP_MODULE_LIST_FUNCTIONS = "Funzioni";
    var $_PHPSHOP_MODULE_LIST_ORDER = "Ordine Lista";
    
    // Module Form
    var $_PHPSHOP_MODULE_FORM_MNU = "Aggiungi Modulo";
    var $_PHPSHOP_MODULE_FORM_LBL = "Informazioni MOdulo";
    var $_PHPSHOP_MODULE_FORM_MODULE_LABEL = "Etichetta Modulo (per Topmenu)";
    var $_PHPSHOP_MODULE_FORM_NAME = "Nome Modulo";
    var $_PHPSHOP_MODULE_FORM_PERMS = "Permessi Modulo";
    var $_PHPSHOP_MODULE_FORM_HEADER = "Intestazione Modulo";
    var $_PHPSHOP_MODULE_FORM_FOOTER = "Piè di pagina Modulo";
    var $_PHPSHOP_MODULE_FORM_MENU = "Mostra Modulo nel menu Admin?";
    var $_PHPSHOP_MODULE_FORM_ORDER = "Ordine di visualizzazione";
    var $_PHPSHOP_MODULE_FORM_DESCRIPTION = "Descrizione Modulo";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_CODE = "Codice Lingua";
    var $_PHPSHOP_MODULE_FORM_LANGUAGE_file = "File Lingua";
    
    // Function List
    var $_PHPSHOP_FUNCTION_LIST_MNU = "Lista delle Funzioni";
    var $_PHPSHOP_FUNCTION_LIST_LBL = "Lista Funzioni";
    var $_PHPSHOP_FUNCTION_LIST_NAME = "Nome Funzione";
    var $_PHPSHOP_FUNCTION_LIST_CLASS = "Nome Classe";
    var $_PHPSHOP_FUNCTION_LIST_METHOD = "Metodo Classe";
    var $_PHPSHOP_FUNCTION_LIST_PERMS = "Permessi";
    
    // Module Form
    var $_PHPSHOP_FUNCTION_FORM_MNU = "Aggiungi Funzione";
    var $_PHPSHOP_FUNCTION_FORM_LBL = "Informazioni Funzione";
    var $_PHPSHOP_FUNCTION_FORM_NAME = "Nome Funzione";
    var $_PHPSHOP_FUNCTION_FORM_CLASS = "Nome Classe";
    var $_PHPSHOP_FUNCTION_FORM_METHOD = "Metodo Classe";
    var $_PHPSHOP_FUNCTION_FORM_PERMS = "Permessi Funzione";
    var $_PHPSHOP_FUNCTION_FORM_DESCRIPTION = "Descrizione Funzione";
    
    // Currency form and list
    var $_PHPSHOP_CURRENCY_LIST_MNU = "lista delle valute";
    var $_PHPSHOP_CURRENCY_LIST_LBL = "Lista valute";
    var $_PHPSHOP_CURRENCY_LIST_ADD = "Aggiungi Valuta";
    var $_PHPSHOP_CURRENCY_LIST_NAME = "Nome Valuta";
    var $_PHPSHOP_CURRENCY_LIST_CODE = "Codice Valuta";
    
    // Country form and list
    var $_PHPSHOP_COUNTRY_LIST_MNU = "Lista delle nazioni";
    var $_PHPSHOP_COUNTRY_LIST_LBL = "Lista Nazioni";
    var $_PHPSHOP_COUNTRY_LIST_ADD = "Aggiungi Nazione";
    var $_PHPSHOP_COUNTRY_LIST_NAME = "Nome Nazione";
    var $_PHPSHOP_COUNTRY_LIST_3_CODE = "Codice Nazione (3)";
    var $_PHPSHOP_COUNTRY_LIST_2_CODE = "Codice Nazione (2)";
    
    /*#####################
    MODULE CHECKOUT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ADDRESS = "Indirizzo";
    var $_PHPSHOP_CONTINUE = "Continua";
    
    # Some messages
    var $_PHPSHOP_EMPTY_CART = "Il carrello &egrave; vuoto.";
    
    
    /*#####################
    MODULE ISShipping
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_ISSHIPPING_MOD = "InterShipper";
    
    
    // Shipping Ping
    var $_PHPSHOP_ISSHIP_PING_MNU = "Pinga il server InterShipper";
    var $_PHPSHOP_ISSHIP_PING_LBL = "InterShipper-Server Ping ";
    var $_PHPSHOP_ISSHIP_PING_ERROR_LBL = "Ping a InterShipper Fallito";
    var $_PHPSHOP_ISSHIP_PING_GOOD_LBL = "Ping a InterShipper avvenuto";
    var $_PHPSHOP_ISSHIP_PING_CARRIER_LBL = "Carrier";
    var $_PHPSHOP_ISSHIP_PING_RESPONSE_LBL = "Tempo di<BR>Risposta";
    var $_PHPSHOP_ISSHIP_PING_TIME_LBL = "sec.";
    
    // Shipping List
    var $_PHPSHOP_ISSHIP_LIST_MNU = "Lista metodi di spedizione";
    var $_PHPSHOP_ISSHIP_LIST_LBL = "Metodi di spedizione attivi";
    var $_PHPSHOP_ISSHIP_LIST_CARRIER_LBL = "Metodi di Spedizione";
    var $_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL = "Attivo";
    var $_PHPSHOP_ISSHIP_LIST_RATE_LBL = "Costo di gestione";
    var $_PHPSHOP_ISSHIP_LIST_LEAD_LBL = "Tempistica";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_F_LBL = "costo fisso";
    var $_PHPSHOP_ISSHIP_LIST_CHARGE_P_LBL = "percentuale";
    var $_PHPSHOP_ISSHIP_LIST_DAYS_LBL = "giorni";
    var $_PHPSHOP_ISSHIP_LIST_HEAVY_LBL = "Carico Pesante";
    
    // Dynamic Shipping Form
    var $_PHPSHOP_ISSHIP_FORM_MNU = "Configura i tipi di Spedizione";
    var $_PHPSHOP_ISSHIP_FORM_ADD_LBL = "Aggiungi un tipo di spedizione";
    var $_PHPSHOP_ISSHIP_FORM_UPDATE_LBL = "Configura un tipo di spedizione";
    var $_PHPSHOP_ISSHIP_FORM_REFRESH_LBL = "Aggiorna";
    var $_PHPSHOP_ISSHIP_FORM_CARRIER_LBL = "Tipo di Spedizione";
    var $_PHPSHOP_ISSHIP_FORM_PUBLISH_LBL = "Attiva";
    var $_PHPSHOP_ISSHIP_FORM_HANDLING_LBL = "Costo di gestione";
    var $_PHPSHOP_ISSHIP_FORM_LEAD_LBL = "Tempo di approntamento e spedizione";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_F_LBL = "costo fisso";
    var $_PHPSHOP_ISSHIP_FORM_CHARGE_P_LBL = "percentuale";
    var $_PHPSHOP_ISSHIP_FORM_DAYS_LBL = "giorni";
    var $_PHPSHOP_ISSHIP_FORM_HEAVY_LBL = "Carico Pesante";
    
    
    
    /*#####################
    MODULE ORDER
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_ORDER_MOD = "Ordina";
    
    // Some menu options 
    var $_PHPSHOP_ORDER_CONFIRM_MNU = "Conferma Ordine";
    var $_PHPSHOP_ORDER_CANCEL_MNU = "Annulla Ordine";
    var $_PHPSHOP_ORDER_PRINT_MNU = "Stampa Ordine";
    var $_PHPSHOP_ORDER_DELETE_MNU = "Cancella Ordine";
    
    // Order List
    var $_PHPSHOP_ORDER_LIST_MNU = "Lista degli Ordini";
    var $_PHPSHOP_ORDER_LIST_LBL = "Lista Ordine";
    var $_PHPSHOP_ORDER_LIST_ID = "Numero Ordine";
    var $_PHPSHOP_ORDER_LIST_CDATE = "Data Ordine";
    var $_PHPSHOP_ORDER_LIST_MDATE = "Ultima modifica";
    var $_PHPSHOP_ORDER_LIST_STATUS = "Stato";
    var $_PHPSHOP_ORDER_LIST_TOTAL = "Subtotale";
    var $_PHPSHOP_ORDER_ITEM = "Elementi in Ordine";
    
    // Order print
    var $_PHPSHOP_ORDER_PRINT_PO_LBL = "Ordine di Acquisto";
    var $_PHPSHOP_ORDER_PRINT_PO_NUMBER = "Numero Ordine";
    var $_PHPSHOP_ORDER_PRINT_PO_DATE = "Data Ordine";
    var $_PHPSHOP_ORDER_PRINT_PO_STATUS = "Status Ordine";
    var $_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL = "Informazioni cliente";
    var $_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL = "Informazioni di Fatturazione";
    var $_PHPSHOP_ORDER_PRINT_CUST_SHIPPING_LBL = "Informazioni di Spedizione";
    var $_PHPSHOP_ORDER_PRINT_BILL_TO_LBL = "Fattura a";
    var $_PHPSHOP_ORDER_PRINT_SHIP_TO_LBL = "Spedizione a";
    var $_PHPSHOP_ORDER_PRINT_NAME = "Nome";
    var $_PHPSHOP_ORDER_PRINT_COMPANY = "Azienda";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_1 = "Indirizzo 1";
    var $_PHPSHOP_ORDER_PRINT_ADDRESS_2 = "Indirizzo 2";
    var $_PHPSHOP_ORDER_PRINT_CITY = "Citt&agrave;";
    var $_PHPSHOP_ORDER_PRINT_STATE = "Provincia";
    var $_PHPSHOP_ORDER_PRINT_ZIP = "Cap";
    var $_PHPSHOP_ORDER_PRINT_COUNTRY = "Nazione";
    var $_PHPSHOP_ORDER_PRINT_PHONE = "Tel.";
    var $_PHPSHOP_ORDER_PRINT_FAX = "Fax";
    var $_PHPSHOP_ORDER_PRINT_EMAIL = "Email";
    var $_PHPSHOP_ORDER_PRINT_ITEMS_LBL = "Materiali in ordine";
    var $_PHPSHOP_ORDER_PRINT_QUANTITY = "Quantit&agrave;";
    var $_PHPSHOP_ORDER_PRINT_QTY = "Qt&agrave;";
    var $_PHPSHOP_ORDER_PRINT_SKU = "Cod.";
    var $_PHPSHOP_ORDER_PRINT_PRICE = "Prezzo";
    var $_PHPSHOP_ORDER_PRINT_TOTAL = "Totale";
    var $_PHPSHOP_ORDER_PRINT_SUBTOTAL = "SubTotale";
    var $_PHPSHOP_ORDER_PRINT_TOTAL_TAX = "IVA";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING = "Spedizione";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_TAX = "IVA Spedizione";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LBL = "Metodo di Pagamento";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NAME = "Nome Account";
    var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER = "Numero Account";
    var $_PHPSHOP_ORDER_PRINT_EXPIRE_DATE = "Data Scadenza";
    var $_PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL = "Registro dei Pagamenti";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_LBL = "Informazioni di Spedizione";
    var $_PHPSHOP_ORDER_PRINT_PAYINFO_LBL = "Informazioni di Pagamento";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL = "Corriere";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL = "Tipo Spedizione";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_DATE_LBL = "Data Spedizione";
    var $_PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL = "Prezzo Spedizione";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_MNU = "Lista dei tipi di stato ordine";
    var $_PHPSHOP_ORDER_STATUS_FORM_MNU = "Aggiungi un tipo di stato ordine";
    
    var $_PHPSHOP_ORDER_STATUS_LIST_CODE = "Codice stato ordine";
    var $_PHPSHOP_ORDER_STATUS_LIST_NAME = "Nome stato ordine";
    
    var $_PHPSHOP_ORDER_STATUS_FORM_LBL = "Stato Ordine";
    var $_PHPSHOP_ORDER_STATUS_FORM_CODE = "Codice Stato Ordine";
    var $_PHPSHOP_ORDER_STATUS_FORM_NAME = "Nome Stato Ordine";
    var $_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER = "Lista Ordine";
    
    
    /*#####################
    MODULE PRODUCT
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_PRODUCT_MOD = "Prodotti";
    
    var $_PHPSHOP_CURRENT_PRODUCT = "Prodotto Corrente";
    var $_PHPSHOP_CURRENT_ITEM = "Articolo Corrente";
    
    // Product Inventory
    var $_PHPSHOP_PRODUCT_INVENTORY_LBL = "Magazzino Prodotti";
    var $_PHPSHOP_PRODUCT_INVENTORY_MNU = "Vedi Magazzino";
    var $_PHPSHOP_PRODUCT_INVENTORY_PRICE = "Prezzo";
    var $_PHPSHOP_PRODUCT_INVENTORY_STOCK = "Numero";
    var $_PHPSHOP_PRODUCT_INVENTORY_WEIGHT = "Peso";
    // Product List
    var $_PHPSHOP_PRODUCT_LIST_MNU = "Lista dei Prodotti";
    var $_PHPSHOP_PRODUCT_LIST_LBL = "Lista Prodotti";
    var $_PHPSHOP_PRODUCT_LIST_NAME = "Nome Prodotto";
    var $_PHPSHOP_PRODUCT_LIST_SKU = "Cod.";
    var $_PHPSHOP_PRODUCT_LIST_PUBLISH = "Pubblica";
    
    // Product Form
    var $_PHPSHOP_PRODUCT_FORM_MNU = "Aggiungi Prodotto";
    var $_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT = "Modifica questo Prodotto";
    var $_PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE = "Mostra la pagina del Prodotto nel negozio";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU = "Aggiungi Elemento";
    var $_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU = "Aggiungi altro Elemento";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL = "Nuovo Prodotto";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_PRODUCT_LBL = "Modifica Prodotto";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL = "informazioni Prodotto";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL = "Stato Prodotto";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL = "Dimensioni e Peso Prodotto";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL = "Immagini Prodotto";
    
    var $_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL = "Nuovo Elemento";
    var $_PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL = "Modifica Elemento";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL = "Informazioni Elemento";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL = "Stato Elemento";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL = "Dimensioni e Peso Elemento";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL = "Immagini Elemento";
    var $_PHPSHOP_PRODUCT_FORM_RETURN_LBL = "Torna al prodotto principale";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL = "Per aggiornare l\'immagine, inserisci il percorso della nuova.";
    var $_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL = "Digita \"none\" per cancellare l\'immagine corrente.";
    var $_PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL = "Elementi Prodotto";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL = "Attributi Elemento";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG = "Sei sicuro di voler cancellare questo prodotto\\ne gli elementi correlati?";
    var $_PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG = "Sei sicuro di voler cancellare questo elemento?";
    var $_PHPSHOP_PRODUCT_FORM_VENDOR = "Venditore";
    var $_PHPSHOP_PRODUCT_FORM_SKU = "Cod.";
    var $_PHPSHOP_PRODUCT_FORM_NAME = "Nome";
    var $_PHPSHOP_PRODUCT_FORM_URL = "URL";
    var $_PHPSHOP_PRODUCT_FORM_CATEGORY = "Categoria";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_GROSS = "Prezzo di Listino";
    var $_PHPSHOP_PRODUCT_FORM_PRICE_NET = "Product Price (Net)";
    var $_PHPSHOP_PRODUCT_FORM_DESCRIPTION = "Descrizione per Negozio";
    var $_PHPSHOP_PRODUCT_FORM_S_DESC = "Descrizione Breve";
    var $_PHPSHOP_PRODUCT_FORM_IN_STOCK = "A Magazzino";
    var $_PHPSHOP_PRODUCT_FORM_ON_ORDER = "In arrivo";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE = "Data Disponibilit&agrave;";
    var $_PHPSHOP_PRODUCT_FORM_SPECIAL = "Promo";
    var $_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE = "Tipo Sconto";
    var $_PHPSHOP_PRODUCT_FORM_PUBLISH = "Pubblico?";
    var $_PHPSHOP_PRODUCT_FORM_LENGTH = "Lunghezza";
    var $_PHPSHOP_PRODUCT_FORM_WIDTH = "Larghezza";
    var $_PHPSHOP_PRODUCT_FORM_HEIGHT = "Altezza";
    var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM = "Unit&agrave; di misura";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT = "Peso";
    var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM = "Unit&agrave; di misura";
    var $_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE = "Miniatura";
    var $_PHPSHOP_PRODUCT_FORM_FULL_IMAGE = "Immagine";
    
    // Product Display
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL = "Risultati aggiunta Prodotto";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL = "Risultati modifica Prodotto";
    var $_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL = "Risultati aggiunta Elemento";
    var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL = "Risultati modifica Elemento";
    var $_PHPSHOP_PRODUCT_CSV_UPLOAD = "Usa l\'upload CSV";
    var $_PHPSHOP_PRODUCT_FOLDERS = "Cartelle Prodotto";
    
    // Product Category List
    var $_PHPSHOP_CATEGORY_LIST_MNU = "Lista Categorie";
    var $_PHPSHOP_CATEGORY_LIST_LBL = "Albero Categorie";
    
    // Product Category Form
    var $_PHPSHOP_CATEGORY_FORM_MNU = "Aggiungi Categoria";
    var $_PHPSHOP_CATEGORY_FORM_LBL = "Informazioni Categoria";
    var $_PHPSHOP_CATEGORY_FORM_NAME = "Nome Categoria";
    var $_PHPSHOP_CATEGORY_FORM_PARENT = "Livello superiore";
    var $_PHPSHOP_CATEGORY_FORM_DESCRIPTION = "Descrizione Categoria";
    var $_PHPSHOP_CATEGORY_FORM_PUBLISH = "Pubblico?";
    var $_PHPSHOP_CATEGORY_FORM_FLYPAGE = "Pagina Negozio Categoria";
    
    // Product Attribute List
    var $_PHPSHOP_ATTRIBUTE_LIST_MNU = "Lista degli Attributi";
    var $_PHPSHOP_ATTRIBUTE_LIST_LBL = "Lista degli Attributi per";
    var $_PHPSHOP_ATTRIBUTE_LIST_NAME = "Nome Attributo";
    var $_PHPSHOP_ATTRIBUTE_LIST_ORDER = "Ordine Lista";
    
    // Product Attribute Form
    var $_PHPSHOP_ATTRIBUTE_FORM_MNU = "Aggiungi Attributo";
    var $_PHPSHOP_ATTRIBUTE_FORM_LBL = "modulo Attributi";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT = "Nuovo Attributo per il Prodotto";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT = "Modifica Attributo per il Prodotto";
    var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM = "Nuovo Attributo per l\'Elemento";
    var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM = "Modifica Attributo per l\'elemento";
    var $_PHPSHOP_ATTRIBUTE_FORM_NAME = "Nome Attributo";
    var $_PHPSHOP_ATTRIBUTE_FORM_ORDER = "Ordine Lista";
    
    // Product Price List
    var $_PHPSHOP_PRICE_LIST_MNU = "Lista Categorie";
    var $_PHPSHOP_PRICE_LIST_LBL = "Albero dei Prezzi";
    var $_PHPSHOP_PRICE_LIST_FOR_LBL = "Prezzo per";
    var $_PHPSHOP_PRICE_LIST_GROUP_NAME = "Nome Gruppo";
    var $_PHPSHOP_PRICE_LIST_PRICE = "Prezzo";
    var $_PHPSHOP_PRODUCT_LIST_CURRENCY = "Valuta";
    
    // Product Price Form
    var $_PHPSHOP_PRICE_FORM_MNU = "Aggiungi Prezzo";
    var $_PHPSHOP_PRICE_FORM_LBL = "Informazioni Prezzo";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT = "Nuovo Prezzo per il Prodotto";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT = "Modifica Prezzo per il Prodotto";
    var $_PHPSHOP_PRICE_FORM_NEW_FOR_ITEM = "Nuovo Prezzo per l\'Elemento";
    var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM = "Modifica Prezzo per l\'Elemento";
    var $_PHPSHOP_PRICE_FORM_PRICE = "Prezzo";
    var $_PHPSHOP_PRICE_FORM_CURRENCY = "Valuta";
    var $_PHPSHOP_PRICE_FORM_GROUP = "Gruppo di Acquisto";
    
    
    /*#####################
    MODULE REPORT BASIC
    #####################*/
    # Some LABELs
    var $_PHPSHOP_REPORTBASIC_MOD = "Rapporto di Base";
    var $_PHPSHOP_RB_INDIVIDUAL = "Lista dei prodotti individuale";
    var $_PHPSHOP_RB_SALE_TITLE = "Rapporto vendita";
    
    /* labels for rpt_sales */
    var $_PHPSHOP_RB_SALES_PAGE_TITLE = "Panoramica Attivit&agrave; di vendita";
    
    var $_PHPSHOP_RB_INTERVAL_TITLE = "Imposta Intervallo";
    var $_PHPSHOP_RB_INTERVAL_MONTHLY_TITLE = "Mensile";
    var $_PHPSHOP_RB_INTERVAL_WEEKLY_TITLE = "Settimanale";
    var $_PHPSHOP_RB_INTERVAL_DAILY_TITLE = "Giornaliero";
    
    var $_PHPSHOP_RB_THISMONTH_BUTTON = "Questo Mese";
    var $_PHPSHOP_RB_LASTMONTH_BUTTON = "Ultimo Mese";
    var $_PHPSHOP_RB_LAST60_BUTTON = "Ultimi 60 giorni";
    var $_PHPSHOP_RB_LAST90_BUTTON = "Ultimi 90 giorni";
    
    var $_PHPSHOP_RB_START_DATE_TITLE = "Data inizio";
    var $_PHPSHOP_RB_END_DATE_TITLE = "Data fine";
    var $_PHPSHOP_RB_SHOW_SEL_RANGE = "Mostra l\'intervallo selezionato";
    var $_PHPSHOP_RB_REPORT_FOR = "Rapporto per ";
    var $_PHPSHOP_RB_DATE = "Data";
    var $_PHPSHOP_RB_ORDERS = "Ordini";
    var $_PHPSHOP_RB_TOTAL_ITEMS = "Totale Elementi venduti";
    var $_PHPSHOP_RB_REVENUE = "Ricavo";
    var $_PHPSHOP_RB_PRODLIST = "Lista Prodotti";
    
    
    
    /*#####################
    MODULE SHOP
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOP_MOD = "Negozio";
    var $_PHPSHOP_PRODUCT_THUMB_TITLE = "Miniatura";
    var $_PHPSHOP_PRODUCT_PRICE_TITLE = "Prezzo";
    var $_PHPSHOP_ORDER_STATUS_P = "In Attesa";
    var $_PHPSHOP_ORDER_STATUS_C = "Confermati";
    var $_PHPSHOP_ORDER_STATUS_X = "Annullati";
    
    
    # Some messages
    var $_PHPSHOP_ORDER_BUTTON = "Ordine";
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_SHOPPER_MOD = "Clienti";
    
    
    
    // Shopper List
    var $_PHPSHOP_SHOPPER_LIST_MNU = "Lista Clienti";
    var $_PHPSHOP_SHOPPER_LIST_LBL = "Lista dei clienti";
    var $_PHPSHOP_SHOPPER_LIST_USERNAME = "Nome Utente";
    var $_PHPSHOP_SHOPPER_LIST_NAME = "Nome Completo";
    var $_PHPSHOP_SHOPPER_LIST_GROUP = "Gruppo";
    
    // Shopper Form
    var $_PHPSHOP_SHOPPER_FORM_MNU = "Aggiungi Cliente";
    var $_PHPSHOP_SHOPPER_FORM_LBL = "Informazioni Cliente";
    var $_PHPSHOP_SHOPPER_FORM_BILLTO_LBL = "Info Fatturazione";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL = "Informazioni";
    var $_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL = "Info Spedizione";
    var $_PHPSHOP_SHOPPER_FORM_ADD_SHIPTO_LBL = "Aggiungi Indirizzo";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL = "Codice Indirizzo";
    var $_PHPSHOP_SHOPPER_FORM_USERNAME = "Nome Utente";
    var $_PHPSHOP_SHOPPER_FORM_FIRST_NAME = "Nome";
    var $_PHPSHOP_SHOPPER_FORM_LAST_NAME = "Cognome";
    var $_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME = "Secondo Nome";
    var $_PHPSHOP_SHOPPER_FORM_TITLE = "Titolo";
    var $_PHPSHOP_SHOPPER_FORM_SHOPPERNAME = "Nome acquirente";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_1 = "Password";
    var $_PHPSHOP_SHOPPER_FORM_PASSWORD_2 = "Conferma Password";
    var $_PHPSHOP_SHOPPER_FORM_GROUP = "Gruppo Cliente";
    var $_PHPSHOP_SHOPPER_FORM_COMPANY_NAME = "Azienda";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_1 = "Indirizzo 1";
    var $_PHPSHOP_SHOPPER_FORM_ADDRESS_2 = "Indirizzo 2";
    var $_PHPSHOP_SHOPPER_FORM_CITY = "Citt&agrave;";
    var $_PHPSHOP_SHOPPER_FORM_STATE = "Provincia";
    var $_PHPSHOP_SHOPPER_FORM_ZIP = "Cap";
    var $_PHPSHOP_SHOPPER_FORM_COUNTRY = "Nazione";
    var $_PHPSHOP_SHOPPER_FORM_PHONE = "Tel.";
    var $_PHPSHOP_SHOPPER_FORM_FAX = "Fax";
    var $_PHPSHOP_SHOPPER_FORM_EMAIL = "Email";
    
    // Shopper Group List
    var $_PHPSHOP_SHOPPER_GROUP_LIST_MNU = "Lista dei Gruppi Utenti";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_LBL = "Lista Gruppi Utenti";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_NAME = "Nome Gruppo";
    var $_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION = "Descrizione Gruppo";
    
    
    // Shopper Group Form
    var $_PHPSHOP_SHOPPER_GROUP_FORM_LBL = "Modulo Gruppo Clienti";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_MNU = "Aggiungi Gruppo Clienti";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_NAME = "Nome Gruppo";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DESC = "Descrizione Gruppo";
    
    
    
    
    /*#####################
    MODULE SHOPPER
    #####################*/
    
    # Some LABELs
    var $_PHPSHOP_STORE_MOD = "Negozio";
    
    
    // Store Form
    var $_PHPSHOP_STORE_FORM_MNU = "Modifica Negozio";
    var $_PHPSHOP_STORE_FORM_LBL = "Informazioni Negozio";
    var $_PHPSHOP_STORE_FORM_CONTACT_LBL = "Contatti";
    var $_PHPSHOP_STORE_FORM_FULL_IMAGE = "Immagine";
    var $_PHPSHOP_STORE_FORM_UPLOAD = "Carica Immagine";
    var $_PHPSHOP_STORE_FORM_STORE_NAME = "Nome Negozio";
    var $_PHPSHOP_STORE_FORM_COMPANY_NAME = "Nome Azienda";
    var $_PHPSHOP_STORE_FORM_ADDRESS_1 = "Indirizzo 1";
    var $_PHPSHOP_STORE_FORM_ADDRESS_2 = "Indirizzo 2";
    var $_PHPSHOP_STORE_FORM_CITY = "Citt&agrave;";
    var $_PHPSHOP_STORE_FORM_STATE = "Provincia";
    var $_PHPSHOP_STORE_FORM_COUNTRY = "Nazione";
    var $_PHPSHOP_STORE_FORM_ZIP = "Cap";
    var $_PHPSHOP_STORE_FORM_PHONE = "Tel.";
    var $_PHPSHOP_STORE_FORM_CURRENCY = "Valuta";
    var $_PHPSHOP_STORE_FORM_CATEGORY = "Categoria Negozio";
    var $_PHPSHOP_STORE_FORM_LAST_NAME = "Cognome";
    var $_PHPSHOP_STORE_FORM_FIRST_NAME = "Nome";
    var $_PHPSHOP_STORE_FORM_MIDDLE_NAME = "Secondo Nome";
    var $_PHPSHOP_STORE_FORM_TITLE = "Titolo";
    var $_PHPSHOP_STORE_FORM_PHONE_1 = "Tel. 1";
    var $_PHPSHOP_STORE_FORM_PHONE_2 = "Tel. 2";
    var $_PHPSHOP_STORE_FORM_FAX = "Fax";
    var $_PHPSHOP_STORE_FORM_EMAIL = "Email";
    var $_PHPSHOP_STORE_FORM_IMAGE_PATH = "Percorso Immagine";
    var $_PHPSHOP_STORE_FORM_DESCRIPTION = "Descrizione";
    
    
    
    var $_PHPSHOP_PAYMENT = "Pagamenti";
    // Payment Method List
    var $_PHPSHOP_PAYMENT_METHOD_LIST_MNU = "Lista dei Tipi di Pagamento";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_LBL = "Lista Tipi di Pagamento";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_NAME = "Nome";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_CODE = "Codice";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT = "Sconto";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP = "Gruppo Clienti";
    var $_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR = "Usare un processore di pagamenti <br/ >(es. authorize.net) ?";
    
    // Payment Method Form
    var $_PHPSHOP_PAYMENT_METHOD_FORM_MNU = "Aggiungi Tipo di Pagamento";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LBL = "Modulo Tipo di Pagamento";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_NAME = "Nome Modulo di Pagamento";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP = "Gruppo Clienti";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT = "Sconto";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_CODE = "Codice";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER = "Ordine Lista";
    var $_PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR = "Usare un processore di pagamenti <br/ >(es. authorize.net) ?";
    
    
    
    /*#####################
    MODULE TAX
    #####################*/
    
    
    # Some LABELs
    var $_PHPSHOP_TAX_MOD = "I.V.A.";
    
    // User List
    var $_PHPSHOP_TAX_RATE = "% I.V.A.";
    var $_PHPSHOP_TAX_LIST_MNU = "Lista aliquote I.V.A.";
    var $_PHPSHOP_TAX_LIST_LBL = "Lista % I.V.A.";
    var $_PHPSHOP_TAX_LIST_STATE = "Regione imposta";
    var $_PHPSHOP_TAX_LIST_COUNTRY = "Nazione imposta";
    var $_PHPSHOP_TAX_LIST_RATE = "Aliquota I.V.A.";
    
    // User Form
    var $_PHPSHOP_TAX_FORM_MNU = "Aggiungi Aliquota I.V.A.";
    var $_PHPSHOP_TAX_FORM_LBL = "Aggiungi Informazioni I.V.A.";
    var $_PHPSHOP_TAX_FORM_STATE = "Regione imposta";
    var $_PHPSHOP_TAX_FORM_COUNTRY = "Nazione imposta";
    var $_PHPSHOP_TAX_FORM_RATE = "Aliquota I.V.A. (per 20% inserisci 0.20)";
    
    
    
    
    /*#####################
    MODULE VENDOR
    #####################*/
    
    
    
    # Some LABELs
    var $_PHPSHOP_VENDOR_MOD = "Venditore";
    var $_PHPSHOP_VENDOR_ADMIN = "Venditori";
    
    
    // Vendor List
    var $_PHPSHOP_VENDOR_LIST_MNU = "Lista dei Venditori";
    var $_PHPSHOP_VENDOR_LIST_LBL = "Lista Venditori";
    var $_PHPSHOP_VENDOR_LIST_VENDOR_NAME = "Nome Venditore";
    var $_PHPSHOP_VENDOR_LIST_ADMIN = "Admin";
    
    // Vendor Form
    var $_PHPSHOP_VENDOR_FORM_MNU = "Aggiungi Venditore";
    var $_PHPSHOP_VENDOR_FORM_LBL = "Aggiungi Informazioni";
    var $_PHPSHOP_VENDOR_FORM_INFO_LBL = "Informazioni Venditore";
    var $_PHPSHOP_VENDOR_FORM_CONTACT_LBL = "Contatto";
    var $_PHPSHOP_VENDOR_FORM_FULL_IMAGE = "Immagine";
    var $_PHPSHOP_VENDOR_FORM_UPLOAD = "Carica Immagine";
    var $_PHPSHOP_VENDOR_FORM_STORE_NAME = "Nome negozio Venditore";
    var $_PHPSHOP_VENDOR_FORM_COMPANY_NAME = "Nome Azienda Venditore";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_1 = "Indirizzo 1";
    var $_PHPSHOP_VENDOR_FORM_ADDRESS_2 = "Indirizzo 2";
    var $_PHPSHOP_VENDOR_FORM_CITY = "Citt&agrave;";
    var $_PHPSHOP_VENDOR_FORM_STATE = "Provincia";
    var $_PHPSHOP_VENDOR_FORM_COUNTRY = "Nazione";
    var $_PHPSHOP_VENDOR_FORM_ZIP = "Cap";
    var $_PHPSHOP_VENDOR_FORM_PHONE = "Tel.";
    var $_PHPSHOP_VENDOR_FORM_CURRENCY = "Valuta";
    var $_PHPSHOP_VENDOR_FORM_CATEGORY = "Valuta Venditore";
    var $_PHPSHOP_VENDOR_FORM_LAST_NAME = "Cognome";
    var $_PHPSHOP_VENDOR_FORM_FIRST_NAME = "Nome";
    var $_PHPSHOP_VENDOR_FORM_MIDDLE_NAME = "Secondo Nome";
    var $_PHPSHOP_VENDOR_FORM_TITLE = "Titolo";
    var $_PHPSHOP_VENDOR_FORM_PHONE_1 = "Tel. 1";
    var $_PHPSHOP_VENDOR_FORM_PHONE_2 = "Tel. 2";
    var $_PHPSHOP_VENDOR_FORM_FAX = "Fax";
    var $_PHPSHOP_VENDOR_FORM_EMAIL = "Email";
    var $_PHPSHOP_VENDOR_FORM_IMAGE_PATH = "Percorso Immagine";
    var $_PHPSHOP_VENDOR_FORM_DESCRIPTION = "Descrizione";
    
    
    // Vendor Category List
    var $_PHPSHOP_VENDOR_CAT_LIST_MNU = "Lista delle Categorie Venditori";
    var $_PHPSHOP_VENDOR_CAT_LIST_LBL = "Lista Categorie Venditori";
    var $_PHPSHOP_VENDOR_CAT_NAME = "Nome Categoria";
    var $_PHPSHOP_VENDOR_CAT_DESCRIPTION = "Descrizione Categoria";
    var $_PHPSHOP_VENDOR_CAT_VENDORS = "Venditori";
    
    // Vendor Category Form
    var $_PHPSHOP_VENDOR_CAT_FORM_MNU = "Aggiungi Categoria Venditore";
    var $_PHPSHOP_VENDOR_CAT_FORM_LBL = "Modulo Categoria Venditore";
    var $_PHPSHOP_VENDOR_CAT_FORM_INFO_LBL = "Informazioni Categoria";
    var $_PHPSHOP_VENDOR_CAT_FORM_NAME = "Nome Categoria";
    var $_PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION = "Descrizione Categoria";
        
    /*#####################
    MODULE MANUFACTURER
    #####################*/

    # Some LABELs
   var $_PHPSHOP_MANUFACTURER_MOD = "Produttore";
   var $_PHPSHOP_MANUFACTURER_ADMIN = "Produttori";
    
    
    // Manufacturer List
    var $_PHPSHOP_MANUFACTURER_LIST_MNU = "Lista Produttori";
    var $_PHPSHOP_MANUFACTURER_LIST_LBL = "Lista Produttori";
    var $_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME = "Nome Produttore";
    var $_PHPSHOP_MANUFACTURER_LIST_ADMIN = "Admin";
    
    // Manufacturer Form
    var $_PHPSHOP_MANUFACTURER_FORM_MNU = "Aggiungi Produttore";
    var $_PHPSHOP_MANUFACTURER_FORM_LBL = "Aggiungi Informazioni";
    var $_PHPSHOP_MANUFACTURER_FORM_INFO_LBL = "Informazioni Produttore";
    var $_PHPSHOP_MANUFACTURER_FORM_NAME = "Nome Produttore";
    var $_PHPSHOP_MANUFACTURER_FORM_CATEGORY = "Categoria Produttore";
    var $_PHPSHOP_MANUFACTURER_FORM_EMAIL = "Email";
    var $_PHPSHOP_MANUFACTURER_FORM_URL = "URL Homepage Produttore";
    var $_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION = "Descrizione";
    
    
    // Manufacturer Category List
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_MNU = "Lista Categorie Produttori";
    var $_PHPSHOP_MANUFACTURER_CAT_LIST_LBL = "Lista Categorie Produttori";
    var $_PHPSHOP_MANUFACTURER_CAT_NAME = "Nome Categoria";
    var $_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION = "Descrizione Categoria";
    var $_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS = "Produttori";
    
    // Manufacturer Category Form
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_MNU = "Aggiungi Categoria Produttore";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_LBL = "Modulo Categoria Produttore";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL = "Informazioni Categoria";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_NAME = "Nome Categoria";
    var $_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION = "Descrizione Categoria";

    var $_PHPSHOP_PRODUCT_FORM_MANUFACTURER = "Produttore";
    
    /*#####################
    Modul HELP
    #####################*/
    var $_PHPSHOP_HELP_MOD = "Aiuto";
    
    // 210104 start
    
    // basketform
    var $_PHPSHOP_CART_ACTION = "Azioni";
    var $_PHPSHOP_CART_UPDATE = "Aggiornamento";
    
    //230104
    var $_PHPSHOP_CART_DELETE = "Cancella";
    
    //shopbrowse form
    
    var $_PHPSHOP_PRODUCT_PRICETAG = "Prezzo";
    var $_PHPSHOP_PRODUCT_CALL = "Chiama per il Prezzo";
    var $_PHPSHOP_PRODUCT_PREVIOUS = "Prec";
    var $_PHPSHOP_PRODUCT_NEXT = "Succ";
    
    //ro_basket
    
    var $_PHPSHOP_CART_TAX = "Imposta";
    var $_PHPSHOP_CART_SHIPPING = "Spedizione";
    var $_PHPSHOP_CART_TOTAL = "Totale";
    
    //CHECKOUT.INDEX
    
    var $_PHPSHOP_CHECKOUT_NEXT = "Succ";
    var $_PHPSHOP_CHECKOUT_REGISTER = "REGISTRA";
    
    //CHECKOUT.CONFIRM
    
    var $_PHPSHOP_CHECKOUT_CONF_BILLINFO = "Dati Fattura";
    var $_PHPSHOP_CHECKOUT_CONF_COMPANY = "Azienda";
    var $_PHPSHOP_CHECKOUT_CONF_NAME = "Nome";
    var $_PHPSHOP_CHECKOUT_CONF_ADDRESS = "Indirizzo";
    var $_PHPSHOP_CHECKOUT_CONF_PHONE = "Telefono";
    var $_PHPSHOP_CHECKOUT_CONF_FAX = "Fax";
    var $_PHPSHOP_CHECKOUT_CONF_EMAIL = "Email";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO = "Dati Spedizione";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY = "Azienda";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME = "Nome";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS = "Indirizzo";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE = "Telefono";
    var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX = "Fax";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO = "Dati Pagamento";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD = "Nome sulla Carta";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD = "Tipo di Pagamento";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM = "Numero Carta di Credito";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE = "Data Scadenza";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER = "Ordine Completo";
    var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO = "informazioni richieste per il pagamento con carta di credito";    
    
    var $_PHPSHOP_ZONE_MOD = "Zona di Spedizione";
    
    var $_PHPSHOP_ZONE_LIST_MNU = "Lista Zone";
    var $_PHPSHOP_ZONE_FORM_MNU = "Aggiungi Zona";
    var $_PHPSHOP_ZONE_ASSIGN_MNU = "Assegna Zone";
    
    // assign zone List
    var $_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL = "Nazione";
    var $_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL = "Zona Corrente";
    var $_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL = "Assegna alla Zona";
    var $_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL = "Aggiorna";
    var $_PHPSHOP_ASSIGN_ZONE_PG_LBL = "Assegna Zone";
    
    // zone Form
    var $_PHPSHOP_ZONE_FORM_NAME_LBL = "Nome Zona";
    var $_PHPSHOP_ZONE_FORM_DESC_LBL = "Descrizione Zona";
    var $_PHPSHOP_ZONE_FORM_COST_PER_LBL = "Costo per articolo";
    var $_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL = "Limite Costo della Zona";
    
    // List of zones
    var $_PHPSHOP_ZONE_LIST_LBL = "Lista Zone";
    var $_PHPSHOP_ZONE_LIST_NAME_LBL = "Nome Zona";
    var $_PHPSHOP_ZONE_LIST_DESC_LBL = "Descrizione Zona";
    var $_PHPSHOP_ZONE_LIST_COST_PER_LBL = "Costo per Elemento della Zona";
    var $_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL = "Limite Costo della Zona";
    
    var $_PHPSHOP_LOGIN_FIRST = "Fai il login o registrati nel sito (usa il modulo di Login) prima.<br>Grazie.";
    var $_PHPSHOP_STORE_FORM_TOS = "Termini del Servizio";
    var $_PHPSHOP_AGREE_TO_TOS = "Devi accettare i Termini del Servizio.";
    var $_PHPSHOP_I_AGREE_TO_TOS = "Accetto i Termini del Servizio";
    
    var $_PHPSHOP_LEAVE_BLANK = "(Lascia VUOTO se non hai <br />un file php per questo!)";
    var $_PHPSHOP_RETURN_LOGIN = "Gi&agrave; nostro cliente? Fai il Login";
    var $_PHPSHOP_NEW_CUSTOMER = "Nuovo? Inserisci i dati per la fattura";
    var $_PHPSHOP_ACC_CUSTOMER_ACCOUNT = "Account Cliente:";
    var $_PHPSHOP_ACC_ORDER_INFO = "Informazioni Ordine";
    var $_PHPSHOP_ACC_UPD_BILL = "Qui puoi modificare i dati per la fattura.";
    var $_PHPSHOP_ACC_UPD_SHIP = "Qui puoi aggiungere e modificare l\'indirizzo di spedizione.";
    var $_PHPSHOP_ACC_ACCOUNT_INFO = "Informazioni Account";
    var $_PHPSHOP_ACC_SHIP_INFO = "Informazioni di Spedizione";
    var $_PHPSHOP_ACC_NO_ORDERS = "Nessun ordine da mostrare";
    var $_PHPSHOP_ACC_BILL_DEF = "- Predefinito (Identico alla Fatturazione)";
    var $_PHPSHOP_SHIPTO_TEXT = "Puoi aggiungere altre destinazioni al tuo account. Pensa ad un nome o codice adatto per la destinazione della spedizione che selezioni qui sotto.";
    var $_PHPSHOP_CONFIG = "Configurazione";
    var $_PHPSHOP_USERS = "Utenti";
    var $_PHPSHOP_IS_CC_PAYMENT = "&egrave; un pagamento con Carta di Credito?";
    
    /*#####################################################
     MODULE SHIPPING
    #######################################################*/
    var $_PHPSHOP_SHIPPING_MOD = "Admin Spedizioni";
    var $_PHPSHOP_SHIPPING_MENU_LABEL = "Spedizioni";
    
    var $_PHPSHOP_CARRIER_LIST_MNU = "Corriere";
    var $_PHPSHOP_CARRIER_LIST_LBL = "Lista Corrieri";
    var $_PHPSHOP_RATE_LIST_MNU = "Tariffe Corrieri";
    var $_PHPSHOP_RATE_LIST_LBL = "Lista prezzi Corrieri";
    var $_PHPSHOP_CARRIER_LIST_NAME_LBL = "Nome";
    var $_PHPSHOP_CARRIER_LIST_ORDER_LBL = "Ordine Lista";
    
    var $_PHPSHOP_CARRIER_FORM_MNU = "Crea Corriere";
    var $_PHPSHOP_CARRIER_FORM_LBL = "Modifica/Crea Corriere";
    var $_PHPSHOP_RATE_FORM_MNU = "Crea Tariffa Corriere";
    var $_PHPSHOP_RATE_FORM_LBL = "Modifica/Crea Tariffa Corriere";
    
    var $_PHPSHOP_RATE_FORM_NAME = "Descrizione Tariffa Corriere";
    var $_PHPSHOP_RATE_FORM_CARRIER = "Corriere";
    var $_PHPSHOP_RATE_FORM_COUNTRY = "Selezione multipla<br>Nazione, usa CTRL e il Mouse";
    var $_PHPSHOP_RATE_FORM_ZIP_START = "Inizio intervallo CAP";
    var $_PHPSHOP_RATE_FORM_ZIP_END = "Fine intervallo CAP";
    var $_PHPSHOP_RATE_FORM_WEIGHT_START = "Peso Minimo";
    var $_PHPSHOP_RATE_FORM_WEIGHT_END = "Peso Massimo";
    var $_PHPSHOP_RATE_FORM_VALUE = "Tariffa";
    var $_PHPSHOP_RATE_FORM_PACKAGE_FEE = "La vostra tariffa";
    var $_PHPSHOP_RATE_FORM_CURRENCY = "Valuta";
    var $_PHPSHOP_RATE_FORM_VAT_ID = "Partita IVA";
    var $_PHPSHOP_RATE_FORM_LIST_ORDER = "Ordine Lista";
    
    var $_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL = "Corriere";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME = "Descrizione Tariffa Corriere";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART = "Peso da ...";
    var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND = "... a";
    var $_PHPSHOP_CARRIER_FORM_NAME = "Corriere";
    var $_PHPSHOP_CARRIER_FORM_LIST_ORDER = "Ordine Lista";
    
    var $_PHPSHOP_ERR_MSG_CARRIER_EXIST = "ERRORE: ID Corriere esistente.";
    var $_PHPSHOP_ERR_MSG_CARRIER_ID_REQ = "ERRORE: Scegli un Corriere.";
    var $_PHPSHOP_ERR_MSG_CARRIER_INUSE = "ERRORE: Esiste ancora una tariffa, cancella le tariffe prima del Corriere";
    var $_PHPSHOP_ERR_MSG_CARRIER_NOTFOUND = "ERRORE: Non riesco a trovare un Corriere con questo ID.";
    
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_REQ = "ERRORE: Scegli un Corriere.";
    var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_INV = "ERRORE: Non riesco a trovare un Corriere con questo ID.";
    var $_PHPSHOP_ERR_MSG_RATE_NAME_REQ = "ERRORE: Devi inserire una descrizione tariffa.";
    var $_PHPSHOP_ERR_MSG_RATE_COUNTRY_CODE_INV = "ERRORE: La nazione di destinazione non &egrave; valida. Separa le Nazioni con \';\'.";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_START_REQ = "ERRORE: Un peso inferiore &egrave; richiesto";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_END_REQ = "ERRORE: Un peso maggiore &egrave; richiesto";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_STARTEND_INV = "ERRORE: Il peso pi&ugrave; basso deve essere inferiore al peso massimo";
    var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_VALUE_REQ = "ERRORE: Un tariffa di spedizione &egrave; richiesta";
    var $_PHPSHOP_ERR_MSG_RATE_CURRENCY_ID_INV = "ERRORE: Scegli la Valuta";
    
    var $_PHPSHOP_ERR_MSG_RATE_ID_REQ = "ERRORE: Un tariffa di spedizione &egrave; richiesta";
    
    var $_PHPSHOP_INFO_MSG_PLEASE_SELECT = "Scegli";
    var $_PHPSHOP_INFO_MSG_CARRIER = "Corriere";
    var $_PHPSHOP_INFO_MSG_SHIPPING_METHOD = "Tariffa Spedizione";
    var $_PHPSHOP_INFO_MSG_SHIPPING_PRICE = "Prezzo";
    var $_PHPSHOP_INFO_MSG_VAT_ZERO_LBL = "0 (-niente-)";
    /*#####################################################
     END: MODULE SHIPPING
    #######################################################*/
    var $_PHPSHOP_PAYMENT_FORM_CC = "Carta di Credito";
    var $_PHPSHOP_PAYMENT_FORM_USE_PP = "Usa un Processore di Pagamento";
    var $_PHPSHOP_PAYMENT_FORM_BANK_DEBIT = "Debito Bancario";
    var $_PHPSHOP_PAYMENT_FORM_AO = "Solo Indirizzo";
    var $_PHPSHOP_CHECKOUT_MSG_2 = "Scegli un indirizzo di spedizione!";
    var $_PHPSHOP_CHECKOUT_MSG_3 = "Scegli un metodo di spedizione!";
    var $_PHPSHOP_CHECKOUT_MSG_4 = "Scegli un metodo di pagamento!";
    var $_PHPSHOP_CHECKOUT_MSG_99 = "Controlla i dati e conferma l\'ordine!";
    
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIP = "Scegli un metodo di spedizione.";
    var $_PHPSHOP_CHECKOUT_ERR_OTHER_SHIP = "Scegli un altro metodo di spedizione.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_PAYM = "Scegli un indirizzo di spedizione.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR = "Inserisci il numero della Carta di Credito.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNAME = "Nome sulla Carta di Credito.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATE = "Il numero di Carta di Credito non &egrave; valido.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCMON = "Mese di scadenza della Carta di Credito.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCYEAR = "Anno di scadenza della Carta di Credito.";
    var $_PHPSHOP_CHECKOUT_ERR_CCDATE_INV = "La data di scadenza &egrave;.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_SHIPTO = "Scegli un indirizzo di spedizione.";
    var $_PHPSHOP_CHECKOUT_ERR_CCNUM_INV = "Numero account non valido.";
    var $_PHPSHOP_CHECKOUT_ERR_EMPTY_CART = "Non c\'&egrave; niente nel carrello!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CARR = "ERROR: Scegli un corriere!";
    var $_PHPSHOP_CHECKOUT_ERR_RATE_NOT_FOUND = "ERROR: Non ho trovato la tariffa!";
    var $_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND = "ERROR: Non trovo il tuo indirizzo di spedizione!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATA = "ERROR: Non ci sono i dati della Carta....";
    var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR_FOUND = "ERROR: Non trovo il numero della Carta di Credito!";
    var $_PHPSHOP_CHECKOUT_ERR_TEST = "Hai usato un numero di Carta di Credito di prova!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_USER_DATA = "Non ho trovato l\'utente nel database!";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_HOLDER_NAME = "Inserisci il nome della Banca.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_IBAN = "Non hai inserito il tuo IBAN.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BA_NUM = "Non hai inserito il numero di Conto Corrente.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_SORT = "Non hai inserito il codice di ABI/CAB della Banca.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_NAME = "Non hai inserito il nome della Banca.";
    var $_PHPSHOP_CHECKOUT_ERR_NO_VALID_STEP = "Devi completare tutte le fasi necessarie alla procedura di uscita alla cassa!";
    var $_PHPSHOP_CHECKOUT_MSG_LOG = "Informazioni di pagamento registrate.<br />";
    
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV = "Non hai raggiunto il minimo d\'ordine.";
    var $_PHPSHOP_CHECKOUT_ERR_MIN_POV2 = "Il nostro minimo d\'ordine &egrave;:";
    var $_PHPSHOP_CHECKOUT_PAYMENT_CC = "Pagamento con Carta di Credito";
    var $_PHPSHOP_CHECKOUT_PAYMENT_OTHER = "altri metodi di pagamento";
    var $_PHPSHOP_CHECKOUT_PAYMENT_SELECT = "Scegli un metodo di pagamento:";
    
    var $_PHPSHOP_STORE_FORM_MPOV = "Minimo d\'ordine per il vostro negozio";
    var $_PHPSHOP_ACCOUNT_BANK_TITLE = "Informazioni Bancarie";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR = "Numero Conto Corrente";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE = "Coordinate bancarie";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_NAME = "Nome Banca";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_IBAN = "IBAN";
    var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER = "Titolare Conto";
    
    var $_PHPSHOP_MODULES = "Moduli";
    var $_PHPSHOP_FUNCTIONS = "Funzioni";
    var $_PHPSHOP_SPECIAL_PRODUCTS = "Prodotti Speciali";
    
    var $_PHPSHOP_CHECKOUT_CUSTOMER_NOTE = "Aggiungi una nota all\'ordine se vuoi.";
    var $_PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE = "Nota cliente";
    var $_PHPSHOP_INCLUDING_TAX = "(incluso \$tax % I.V.A.)";
    var $_PHPSHOP_PLEASE_SEL_ITEM = "Seleziona articolo";
    var $_PHPSHOP_PRODUCT_FORM_ITEM_LBL = "Articolo";
    
    // DOWNLOADS
    
    var $_PHPSHOP_DOWNLOADS_TITLE = "Download Area";
    var $_PHPSHOP_DOWNLOADS_START = "Inizia Download";
    var $_PHPSHOP_DOWNLOADS_INFO = "Inserisci il Download-ID che hai ricevuto nella e-mail e clicca \'Start Download\'.";
    var $_PHPSHOP_DOWNLOADS_ERR_EXP = "Spiacenti, il tuo Download è scaduto";
    var $_PHPSHOP_DOWNLOADS_ERR_MAX = "Spiacenti, mai hai raggiunto il limite di download";
    var $_PHPSHOP_DOWNLOADS_ERR_INV = "Download-ID non valido!";
    var $_PHPSHOP_DOWNLOADS_ERR_SEND = "Impossibile inviare messaggio a ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG = "Messaggio inviato a ";
    var $_PHPSHOP_DOWNLOADS_SEND_SUBJ = "Download-Info";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_1 = "I(l) file che hai ordinato sono/è pronti/o per essere scaricati/o";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_2 = "Inserisci i(l) seguenti/e Download-ID nella Download Area: ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_3 = "il limite massimo di download per ogni file &grave; di: ";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_4 = "Puoi scaricare fino a {expire} giorni dopo il primo download";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_5 = "Domande? Problemi?";
    var $_PHPSHOP_DOWNLOADS_SEND_MSG_6 = "Download-Info by "; // e.g. Download-Info by "Storename"
    var $_PHPSHOP_PRODUCT_FORM_DOWNLOADABLE = "prodotto scaricabile?"; 

    var $_PHPSHOP_PAYPAL_THANKYOU = "Grazie per il pagamento. 
        La transazione ha avuto successo. Riceverai una e-mail di conferma della transazione da parte di PayPal. 
        Ora puoi continuare nella navigazione o autenticarti in <a href=http://www.paypal.com>www.paypal.com</a> per controllare i dettagli della transazione.";
    var $_PHPSHOP_PAYPAL_ERROR = "C\'&egrave; stato un errore nell\'elaborazione della transazione. Lo stato del tuo ordine non pu&ograve; venir aggiornato.";
    
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER1 = "Grazie per avere visitato il nostro negozio.  Di seguito le informazioni sul vostro ordine.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER2 = "Grazie per la vostra fiducia.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER3 = "Domande? Problemi?";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER4 = "E\' stato ricevuto il seguente ordine.";
    var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER5 = "Guarda l\'ordine seguendo il link sottostante.";
    
    var $_PHPSHOP_CART_ERROR_NO_NEGATIVE = "Non sono ammesse quantit&agrave; negative.";
    var $_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY = "Inserire una quantit&grave; valida per questo articolo.";
    var $_PHPSHOP_CART_STOCK_1 = "La quantit&agrave; selezionata eccede la disponibilit&grave; di magazzino.";
    var $_PHPSHOP_CART_STOCK_2 = "Al momento ci sono \$product_in_stock articoli disponibili.";
    var $_PHPSHOP_CART_STOCK_3 = "Clicca qui per essere inserito nella nostra lista di attesa.";
    var $_PHPSHOP_CART_SELECT_ITEM = "Selezionare un articolo speciale per la pagina dei dettagli!";

    var $_PHPSHOP_REGISTRATION_FORM_NONE = "nessuno";
    var $_PHPSHOP_REGISTRATION_FORM_MR = "Sig.";
    var $_PHPSHOP_REGISTRATION_FORM_MRS = "Sig.ra";
    var $_PHPSHOP_REGISTRATION_FORM_DR = "Dott.";
    var $_PHPSHOP_REGISTRATION_FORM_PROF = "Prof.";
    var $_PHPSHOP_DEFAULT = "Predefinito";
        
  /*#####################################################
    MODULE AFFILIATE
  #######################################################*/
    var $_PHPSHOP_AFFILIATE_MOD   = "Amministrazione Affiliati";
    
    // Affiliate List
    var $_PHPSHOP_AFFILIATE_LIST_MNU		= "Lista Affiliati";
    var $_PHPSHOP_AFFILIATE_LIST_LBL		= "Lista Affiliati";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME	= "Nome Affiliato";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE = "Attivo";
    var $_PHPSHOP_AFFILIATE_LIST_RATE		= "Percentuale";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL = "Totale mensile";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION ="Commissione mensile";
    var $_PHPSHOP_AFFILIATE_LIST_ORDERS = "Lista Ordini";
    
    // Affiliate Email
   	var $_PHPSHOP_AFFILIATE_EMAIL_MNU		= "Email Affiliati";
    var $_PHPSHOP_AFFILIATE_EMAIL_LBL		= "Email Affiliati";
    var $_PHPSHOP_AFFILIATE_EMAIL_WHO	= "Email destinatario (* = TUTTI)";
    var $_PHPSHOP_AFFILIATE_EMAIL_CONTENT		= "Tua Email";
    var $_PHPSHOP_AFFILIATE_EMAIL_SUBJECT = "Oggetto";
    var $_PHPSHOP_AFFILIATE_EMAIL_STATS	 = "Includi statistiche attuali";
    
    // Affiliate Form
    var $_PHPSHOP_AFFILIATE_FORM_RATE		= "Percentuale commissione";
    var $_PHPSHOP_AFFILIATE_FORM_ACTIVE		= "Attivo?"; 
	   
    var $_PHPSHOP_DELIVERY_TIME = "Di solito viene spedito in";
    var $_PHPSHOP_DELIVERY_INFORMATION = "Informazioni consegna";
    var $_PHPSHOP_MORE_CATEGORIES = "altre categorie";
    var $_PHPSHOP_AVAILABILITY = "Disponibilit&agrave;";
    var $_PHPSHOP_CURRENTLY_NOT_AVAILABLE = "Il prodotto al momento non &egrave; disponibile.";
    var $_PHPSHOP_PRODUCT_AVAILABLE_AGAIN = "Sar&agrave; nuovamente disponibile il: ";
        
    var $_PHPSHOP_STATISTIC_SUMMARY = "Sommario";
    var $_PHPSHOP_STATISTIC_STATISTICS = "Statistiche";
    var $_PHPSHOP_STATISTIC_CUSTOMERS = "Clienti";
    var $_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS = "Prodotti attivi";
    var $_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS = "Prodotti non attivi";
    var $_PHPSHOP_STATISTIC_SUM = "Totale";
    var $_PHPSHOP_STATISTIC_NEW_ORDERS = "Nuovi ordini";
    var $_PHPSHOP_STATISTIC_NEW_CUSTOMERS = "Nuovi clienti";

	//Waiting list : file /administrator/components/com_phpshop/html/shop.waiting_list.php
	var $_PHPSHOP_WAITING_LIST_MESSAGE = "Inserisci di seguito il tuo indirizzo e-mail per essere avvisato quando il prodotto sar&agrave; di nuovo disponibile. 
                                          Il tuo indirizzo e-mail non verr&agrave; ceduto in alcun modo a terzi e verr&agrave; utilizzato all\'unico scopo di
										  avvisarti che il prodotto richiesto &grave; di nuovo disponibile.<br /><br />Grazie!";
	var $_PHPSHOP_WAITING_LIST_THANKS = "Grazie per l\'attesa! <br />Ti faremo sapere appena possibile.";
	var $_PHPSHOP_WAITING_LIST_NOTIFY_ME = "Avvisatemi!";
	
	//Checkout : file /administrator/components/com_phpshop/html/checkout.thankyou.php
	var $_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW = "Versione stampabile";
  
  /**************************Admin.show_cfg.php in apparition order ;-)**************************************/
	
	/* PAGE 1 */
	var $_PHPSHOP_ADMIN_CFG_AUTORIZE_OR_CYBERCASH = "Scegli tra Authorize.net e CyberCash";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS = " stato file di configurazione:";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE = "scrivibile";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE = "non scrivibile";
	
	var $_PHPSHOP_ADMIN_CFG_GLOBAL = "Opzioni generali";
	var $_PHPSHOP_ADMIN_CFG_PATHANDURL = "Percorso & URL";
	var $_PHPSHOP_ADMIN_CFG_SITE = "Sito";
	var $_PHPSHOP_ADMIN_CFG_SHIPPING = "Spedizione";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT = "Cassa";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS = "Download";
	var $_PHPSHOP_ADMIN_CFG_PAYEMENTOPTIONS = "Pagamenti";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE = "Utilizza solo come catalogo";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN = "Se selezioni questa opzione disabiliti tutte le funzioni del carrello della spesa.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES = "Mostra prezzi";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX = "Mostra prezzi IVA inclusa?";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN = "Imposta l\'opzione se i clienti vedono i prezzi IVA inclusa od esclusa.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN = "Metti il segno di spunta per mostrare i prezzi. Con la funzione catalogo qualche venditore preferisce non mostrare i prezzi.";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX = "Imposta virtuale";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN = "Determina se si applica o meno l\'imposta agli articoli a peso zero. Modifica ps_checkout.php->calc_order_taxable() per personalizzare questa funzione.";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE = "Modalit&agrave; d\'imposta:";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP = "In base all\'indirizzo di spedizione";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR = "In base all\'indirizzo del commerciante";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN = "Determina l\'aliquota IVA da applicare:<br />
                                                                                    <ul><li>quella del paese dove risiede il proprietario del negozio</li><br/>
                                                                                    <li>o quella del paese dell\'acquirente.</li></ul>";

	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE = "Consenti aliquote multiple?";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN = "Seleziona se hai prodotti con diverse aliquote d\'imposta (es. 4% per libri, 20% per l\'altra merce)";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE = "Calcola lo sconto prima di applicare l\'IVA e le spese di spezione?";
  var $_PHPSHOP_ADMIN_CFG_REVIEW = "Consenti il sistema di valutazione/recensione da parte del cliente";
  var $_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN = "Se abiliti questa funzione, permetti ai clienti di <strong>dare delle valutazioni sui prodotti</strong> e di <strong>scrivere delle recensioni</strong> a riguardo. <br />
                                                                                In tal modo i clienti possono raccontare ad altri clienti le loro esperienze col prodotto.<br />";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN = "Determina se lo sconto va applicato PRIMA (selezionato) o DOPO (non selezionato) il calcolo di imposte e spese di spedizione.";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK = "Consenti ai clienti di inserire le loro coordinate bancarie?";

	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN = "Seleziona se vuoi consentire ai clienti in fase di iscrizione di fornire le loro coordinate bancarie.";
	
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE = "Consenti ai clienti di selezionare la provincia?";
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN = "Seleziona se vuoi consentire ai clienti di selezionare la provincia in fase di iscrizione.";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS = "Obbligatorio accettare le condizioni di vendita?";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN = "Seleziona se vuoi che il cliente debba accettare le condizioni di vendita prima di iscriversi.";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK = "Controlla scorte di magazzino?";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN = "Determina se viene fatto un controllo sulla disponibilit&agrave; del prodotto in magazzino quando un utente lo aggiunge al carrello. 
                                                                                          Se selezionato, non consente ad un utente di aggiungere al carrello una quantit&agrave; di quell\'articolo superiore alle scorte di magazzino.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE = "Consenti Programma Affiliati?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN = "Abilita il rintracciamento per gli affiliati direttamente dalla vetrina del negozio. Abilitalo se hai aggiunto affiliati nel pannello di amministrazione.";
	
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT = "Formato mail dell\'ordine:";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT = "Mail formato testo";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML = "Mail in formato HTML";

	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN = "Determina come sono impostate le mail di conferma degli ordini:<br />
                                                                                        <ul><li>come solo testo</li>
                                                                                        <li>o in html con immagini.</li></ul>";

  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN = "Consenti l\'amministrazione direttamente dalla vetrina del negozio per gli utenti non abilitati al pannello di controllo?";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN = "Con questa opzione consenti l\'amministrazione agli utenti che non hanno accesso al pannello di controllo
  e che sono amministratori del negozio (es. Registered / Editor).";
	
	/* PAGE 2 */
	var $_PHPSHOP_ADMIN_CFG_URL = "URL";
	var $_PHPSHOP_ADMIN_CFG_URL_EXPLAIN = "L\'URL del tuo sito. Di solito &agrave; è quella corrispondente alla instalalzione di Mambo (con lo slash alla fine!)";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE = "SECUREURL";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN = "L\'URL sicura del tuo sito. (https - con lo slash alla fine!)";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT = "COMPONENTURL";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN = "L\'URL del componente mambo-phpShop. (con lo slash alla fine!)";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE = "IMAGEURL";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN = "L\'URL della directory delle immaginni del componente mambo-phpShop. (con lo slash alla fine!)";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH = "ADMINPATH";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN = "Il percorso della directory del componente mambo-phpShop.";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH = "CLASSPATH";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN = "Il percorso della directory classes del componente mambo-phpShop.";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH = "PAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN = "Il percorso della directoryhtml del componente mambo-phpShop.";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH = "IMAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN = "Il percorso della directory shop-image del componente mambo-phpShop.";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE = "HOMEPAGE";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN = "Questa &grave; la pagina che verr&agrave; caricata come predefinita.";	
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE = "ERRORPAGE";
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN = "Questa pagina mostra gli eventuali errori.";	
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE = "DEBUGPAGE";
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN = "Pagina predefinita per mostrare i messaggi di debug.";
	var $_PHPSHOP_ADMIN_CFG_DEBUG = "DEBUG ?";
	var $_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN = "DEBUG?  	   	Attiva l\'ouput del debug. Fa s&igrave; che la pagina di debug venga visualizzata in fondo ad ogni pagina. Molto utile in fase di sviluppo e collaudo dato che mostra il contenuto del carrello, i valori dei campi ecc.";

/* PAGE 3 */

	var $_PHPSHOP_ADMIN_CFG_FLYPAGE = "FLYPAGE";
	var $_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN = "Pagina predefinita per mostrare i dettagli del prodotto.";
  var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE = "Modello per la Categoria";
	var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN = "Definisce il modello predefinito per visualizzare i prodotti di una determinata categoria.<br />
                                                                                                      Puoi creare modelli nuovi personalizzando i file di modelli esistenti <br />
                                                                                                      (all\'interno della directory <strong>COMPONENTPATH/html/templates/</strong> e che iniziano con browse_)";

  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW = "Numero predefinito di prodotti per riga";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN = "Definisci il numero di prodotti per riga. <br />
                                                                                                      Esempio: se lo imposti a 4, il modello di categoria mostrer&agrave; 4 prodotti per riga";
  
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE = "\"no image\" immagine";
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN = "Questa immagine verr&agrave; mostrata quando al prodotto non &grave; stata associata alcuna immagine.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS = "SEARCH ROWS";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN = "Determina il numero di righe per pagina da visualizzare per i risultati di una ricerca.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 = "SEARCH COLOR 1";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN = "Indica il colore delle righe dispari nei risultati della ricerca.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 = "SEARCH COLOR 2";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN = "Indica il colore delle righe pari nei risultati della ricerca.";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS = "MAXIMUM ROWS";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN = "Imposta il numero massimo di righe da visualizzare nella lista degli ordini.";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION = "Mostra in pi&agrave; di pagina \"powered by mambo-phpShop\" ?";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN = "Visualizza un\'immagine powered-by-mambo-phpShop nel pi&agrave; di pagina.";
	
	
	/* PAGE 4 */
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD = "Scegli la modalit&agrave; di spedizione per il negozio";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD = "Modulo di spedizione standard con corrieri e tariffe configurati individualmente. <strong>CONSIGLIATO !</strong>";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE = "  	Modalit&grave; di spedizione in base alla nazione Versione 1.0<br />
                                                                                                            Per ulteriori informazioni su questo modulo visita <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br />
                                                                                                            per maggiori dettagli o per entrare in contatto <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a><br /> Metti il segno di spunta per abilitare il modulo di spedizione per zona";
                                                                                                            	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS = "Metodo di calcolo per spedizioni UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE = "Codice d\'accesso UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN = "Il tuo codice di accesso UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID = "ID utente UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN = "L\'id utente ricevuto da UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD = "Password UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN = "La password per il tuo account UPS";

	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER = "Modulo InterShipper. Segna solo se hai un account Intershipper.com";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE = "Disabilita la selezione della modalit&agrave di spedizione. Seleziona questo se vendi prodotti scaricabili che non devono venir spediti al cliente.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD = "Password InterShipper";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD_EXPLAIN = "La password per il tuo account InterShipper.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL = "Email InterShipper";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL_EXPLAIN = "L\'indirizzo email per il tuo account InterShipper.";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY = "CHIAVE DI CIFRATURA";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN = "Chiave usata per codificare i dati memorizzati nel database. Significa che questo file deve essere sempre prottetto da occhi indiscreti.";
	
	
	/* PAGE 5 */
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR = "Abilita la barra della cassa";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN = "Seleziona se vuoi che \'la barra della cassa\' venga visualizzata durante il processo di perfezionamento dell\'acquisto ( 1 - 2 - 3 - 4 con immagini).";

	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS = "Scegli la procedura di uscita alla cassa";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD = "<strong>Standard :</strong><br/>
               1. Richiesta dell\'indirizzo per la spedizione<br />
              2. Richiesta della modalit&agrave; di spedizione<br />
              3. Richiesta del metodo di pagamento<br />
              4. Completa l\'ordine";

	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 = "<strong>Procedura 2:</strong><br/>
               1. Richiesta dell\'indirizzo per la spedizione<br />
              2. Richiesta del metodo di pagamento<br />
              3. Completa l\'ordine";

	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 = "<strong>Procedura 3:</strong><br/>
               1. Richiesta della modalit&agrave; di spedizione<br />
              2. Richiesta del metodo di pagamento<br />
              3. Completa l\'ordine";

	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 = "<strong>Procedura 4:</strong><br/>
               1. Richiesta del metodo di pagamento<br />
              2. Completa l\'ordine";
	
	
	/* PAGE 6 */
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS = "Abilita i Download";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN = "Seleziona per abilitare la possibilit&agrave; di download. Solo se vendi prodotti scaricabili online.";

	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS = "stato ordine che abilita il download";
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN = "Seleziona lo stato dell\'ordine che determina quando al cliente deve essere notificato via e-mail il link per il download.";

	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS = "stato dell\'ordine che disabilita il download";
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN = "Imposta lo stato dell\'ordine al quale il download per il cliente &grave; disabilitato.";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT = "DOWNLOADROOT";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN = "Il percorso fisico ai file per il download da parte del cliente. (con lo slash alla fine!)<br>
        <span class=\"message\">Per la sicurezza del tuo negozio: se puoi, usa una directory FUORI DALLA WEBROOT</span>";

	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX = "Limite massimo download";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN = "Imposta il numero massimo di download che si posson fare con un Download-ID, (per ogni singolo ordine)";

	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE = "Scadenza Download";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN = "Imposta l\'intervallo di tempo <strong>in secondi</strong> di validit&grave; del download per il cliente. 
  Qusto intervallo inizia col primo download! Quando l\'intervallo scade, il download-ID viene disabilitato.<br />N.B. : 86400s=24h.";
	
	
	/* PAGE 7 */
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL = "Abilita Pagamento IPN via PayPal?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL_EXPLAIN = "Seleziona se vuoi permettere ai tuoi clienti di pagare con PayPal.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL = "Email PayPal:";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL_EXPLAIN = "Il tuo indirizzo email per i pagamenti con PayPal. Usato anche come receiver_email.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS = "stato dell\'ordine che determina se una transazione &grave; andata a buon fine";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS_EXPLAIN = "Seleziona lo stato dell\'ordine al quale il vero ordine &egrave; impostato se la procedura PayPal IPN &grave; andata a buon fine. Se vendi prodotti scaricabili: 
  seleziona lo stato che abilita il download (al ciente sar&grave; subito notificato via e-mail il link per il download).";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED = "stato dell\'ordine per transazioni non andate a buon fine";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED_EXPLAIN = "Seleziona uno stato dell\'ordine per le transazioni PayPal non andate a buon fine.";
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE = "Abilita pagamenti via PayMate?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE_EXPLAIN = "Seleziona per attivare il sistema di pagamento australiano Australian PayMate.";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME = "Nome utente PayMate:";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME_EXPLAIN = "Il nome utente del tuo account PayMate.";
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET = "Abilita pagamenti Authorize.net?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_EXPLAIN = "Seleziona per utilizzare Authorize.net con phpShop.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE = "Modalit&agrave; di prova?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE_EXPLAIN = "Seleziona \'s&igrave;\' per attivare la modalit&agrave; di prova. Seleziona \'No\' per abilitare le transazioni reali.";
	var $_PHPSHOP_ADMIN_CFG_YES = "S&igrave;";
	var $_PHPSHOP_ADMIN_CFG_NO = "No";
	
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME = "Authorize.net Login ID";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME_EXPLAIN = "La tua Login ID di Authorize.Net ";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY = "Authorize.net Transaction Key";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY_EXPLAIN = "La chiave per la transazione su Authorize.net";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE = "Tipo di autenticazione";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE_EXPLAIN = "Il tipo di autenticazione su Authorize.Net.";
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH = "Abilita CyberCash?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH_EXPLAIN = "Seleziona per utilizzare CyberCash con phpShop.";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND = "CyberCash MERCHANT";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_EXPLAIN = "CC_MERCHANT &grave il CyberCash Merchant ID";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY = "CyberCash Merchant Key";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY_EXPLAIN = "CyberCash Merchant Key &grave la chiave fornita da CyberCash";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL = "CyberCash PAYMENT URL";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL_EXPLAIN = "CyberCash PAYMENT URL &grave; la URL fornita da Cybercash per i pagamenti sicuri";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE = "CyberCash AUTH TYPE";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE_EXPLAIN = "CyberCash AUTH TYPE &grave; il tipo di autenticazione fornito da Cybercase";
	

    /** Advanced Search feature ***/
    var $_PHPSHOP_ADVANCED_SEARCH  ="Ricerca avanzata";
    var $_PHPSHOP_SEARCH_ALL_CATEGORIES = "Cerca in tutte le categorie";
    var $_PHPSHOP_SEARCH_ALL_PRODINFO = "Cerca in tutti i campi del prodotto";
    var $_PHPSHOP_SEARCH_PRODNAME = "Cerca solo nel nome del prodotto";
    var $_PHPSHOP_SEARCH_MANU_VENDOR = "Solo Produttore/Venditore";
    var $_PHPSHOP_SEARCH_DESCRIPTION = "Solo descrizione del prodotto";
    var $_PHPSHOP_SEARCH_AND = "AND";
    var $_PHPSHOP_SEARCH_NOT = "NOT";
    var $_PHPSHOP_SEARCH_TEXT1 = "Il primo men&ugrave; a tendina permette di selezionare una categoria in modo tale da limitare ad essa la ricerca. 
        Il primo men&ugrave; a tendina permette di limitare la ricerca ad un particolare dato associato al prodotto (es. Nome). 
        Una volta selezionati queste opzioni (o lasciato l\'opzione predefinita TUTTI), inserisci la parola chiave da cercare. ";
    var $_PHPSHOP_SEARCH_TEXT2 = " Puoi ulteriormete affinare la ricerca aggiungendo una seconda parola chiave e selezionando gli operatori AND o NOT. 
        AND comporta che entrambe le parole devono essere presenti affinch&acute; il prodotto venga visualizzato nei risultati. 
        NOT implica che il prodotto viene visualizato solo se la prima parola e presente e la seconda no.";
    var $_PHPSHOP_ORDERBY = "Ordina per";
    
    /*** Review feature ***/
    var $_PHPSHOP_CUSTOMER_RATING  = "Valutazione media cliente";
    var $_PHPSHOP_TOTAL_VOTES = "Voti totali";
    var $_PHPSHOP_CAST_VOTE = "Dai il tuo voto";
    var $_PHPSHOP_RATE_BUTTON = "Voto";
    var $_PHPSHOP_RATE_NOM = "Valutazione";
    var $_PHPSHOP_REVIEWS = "Recensioni clienti";
    var $_PHPSHOP_NO_REVIEWS = "Nessuna recensione disponibile per questo prodotto.";
    var $_PHPSHOP_WRITE_FIRST_REVIEW = "Sii il primo a scrivere una recensione...";
    var $_PHPSHOP_REVIEW_LOGIN = "Autenticati per poter scrivere una recensione.";
    var $_PHPSHOP_REVIEW_ERR_RATE = "Dai un voto al prodotto per completare la tua recensione!";
    var $_PHPSHOP_REVIEW_ERR_COMMENT1 = "Scrivi qualche parola in pi&ugrave; per la tua recensione. Limite minimo caratteri: 100";
    var $_PHPSHOP_REVIEW_ERR_COMMENT2 = "Per favore riduci la tua recensione. Limite massimo caratteri: 2000";
    var $_PHPSHOP_WRITE_REVIEW = "Scrivi una recensione per questo prodotto!";
    var $_PHPSHOP_REVIEW_RATE = "Primo: Valuta il prodotto. Dai un voto da 0 (peggiore) a 5 stelle (migliore).";
    var $_PHPSHOP_REVIEW_COMMENT = "Ora scrivi una (breve) recensione ....(min. 100, max. 2000 caratteri) ";
    var $_PHPSHOP_REVIEW_COUNT = "Caratteri scritti: ";
    var $_PHPSHOP_REVIEW_SUBMIT = "Invia recensione";
    var $_PHPSHOP_REVIEW_ALREADYDONE = "Hai gi&grave; recensito questo prodotto. Grazie.";
    var $_PHPSHOP_REVIEW_THANKYOU = "Grazie per la tua recensione.";
    var $_PHPSHOP_COMMENT= "Commento";
    
    var $_PHPSHOP_LIST_ALL_PRODUCTS = "Tutti i prodotti";
    var $_PHPSHOP_PRODUCT_SEARCH_LBL = "Cerca prodotto";
    
    var $_PHPSHOP_CREDITCARD_FORM_LBL = "Aggiunti/Modifica tipi di carta di credito";
    var $_PHPSHOP_CREDITCARD_NAME = "Nome carta di credito";
    var $_PHPSHOP_CREDITCARD_CODE = "Carta di credito - Codice breve";
    var $_PHPSHOP_CREDITCARD_TYPE = "Tipo di carta di credito";

    var $_PHPSHOP_CREDITCARD_LIST_LBL = "Lista carte di credito";
    var $_PHPSHOP_UDATE_ADDRESS = "Aggiorna indirizzo";
    var $_PHPSHOP_CONTINUE_SHOPPING = "Continua lo shopping";
    
    var $_PHPSHOP_THANKYOU_SUCCESS = "Il tuo ordine &grave; stato inviato con successo!";
    var $_PHPSHOP_ORDER_LINK = "Clicca qui per visualizzare l\'ordine nei dettagli.";
    
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "lo stato del tuo ordine num. {order_id} &grave; stato modificato.";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "Il nuovo stato &grave;:";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "Per visualizzare i dettagli dell\'ordine, clicca su questo link (o copialo nel browser):";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "Modifica stato Ordine: Ordine num. {order_id}";
    var $_PHPSHOP_ORDER_LIST_NOTIFY = "Avvisa il cliente?";
    var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "Prima modifica lo stato dell\'ordine!";
    
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "Sconto per il gruppo di clienti predefinito (in %)";

    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = "Un ammontare X positivo implica che: se il prodotto non ha alcun prezzo assegnato per QUESTO gruppo di clienti, il prezzo predefinito viene diminuito dell\'X %. Un ammontare negativo ha l\'effetto opposto";


    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "lo stato dell\'ordine num. {order_id} &grave; stato modificato.";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "Il nuovo stato &grave;:";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "Per visualizzare i dettagli dell\'ordine, clicca su questo link (o copialo nel browser):";

    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "Modifica stato Ordine: Ordine num. {order_id}";
    var $_PHPSHOP_ORDER_LIST_NOTIFY = "Avvisa il cliente?";
    var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "Prima modifica lo stato dell\'ordine!";
    
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "Price Discount on default Shopper Group (in %)";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = "A positive amount X means: If the Product has no Price assigned to THIS Shopper Group, the default Price is decreased by X %. A negative amount has the opposite effect";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_LBL = "Sconto sul prodotto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL = "Lista sconti sul prodotto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT = "Aggiungi/Modifica sconto prodotto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT = "Ammontare dello sconto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP = "Inserire l\'ammontare dello sconto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE = "Tipo di sconto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT = "Percentuale";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL = "Totale";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP = "L\'ammontare deve essere una percentuale od un totale?";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE = "Data d\'inizio dello sconto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP = "Specifica il giorno in cui inizia lo sconto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE = "Data di termine dello sconto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP = "Specifica il giorno in cui termina lo sconto";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP = "Puoi utilizzare il modulo sconto sui prodotti per aggiungere sconti!";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_SAVE = "Salve";
    var $_PHPSHOP_FLYPAGE_ENLARGE_IMAGE = "Visualizza immagine a dimensioni reali";
    
/*********************
Currency Display Style 
***********************/
    var $_PHPSHOP_CURRENCY_DISPLAY = "Stile visualizzazione valuta";
    var $_PHPSHOP_CURRENCY_SYMBOL = "Simbolo valuta";
    var $_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP = "Puoi anche utilizzare codice HTML (es. &amp;euro;,&amp;pound;,&amp;yen;,...)";
    var $_PHPSHOP_CURRENCY_DECIMALS = "Decimali";
    var $_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP = "Numero di decimali visualizzati (ou&ograve; essere 0)<br><b>Arrotonda se il valore ha un numero di decimali diverso</b>";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL = "Simbolo per i decimali";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP = "Carattere usato come simbolo per i decimali";
    var $_PHPSHOP_CURRENCY_THOUSANDS = "Separatore delle migliaia";
    var $_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP = "Carattere usato per separare le migliaia (pu&ograve; vuoto)";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY = "Formato positivo";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP = "Formato per visualizzare di valori positivi.<br>(Symb sta per simbolo valuta)";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY = "Formato negativo";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP = "Formato per visualizzare i numeri negativi.<br>(Symb sta per simbolo valuta)";
    
    var $_PHPSHOP_OTHER_LISTS = "Elenco altri prodotti";
/**************
Multiple Images 
****************/
    var $_PHPSHOP_MORE_IMAGES = "Visualizza pi&ugrave; immagini";
    var $_PHPSHOP_AVAILABLE_IMAGES = "Immagini disponibili per";
    var $_PHPSHOP_BACK_TO_DETAILS = "Torna ai dettagli dei prodotti";
    
    /* FILEMANAGER */
    var $_PHPSHOP_FILEMANAGER = "FileManager";
    var $_PHPSHOP_FILEMANAGER_LIST = "FileManager::Lista prodotti";
    var $_PHPSHOP_FILEMANAGER_ADD = "Aggiungi Immagine/File";
    var $_PHPSHOP_FILEMANAGER_IMAGES = "Immagini assegnate";
    var $_PHPSHOP_FILEMANAGER_DOWNLOADABLE = "&Egrave; scaricabile?";
    var $_PHPSHOP_FILEMANAGER_FILES = "File assegnati (Fogli dati,...)";
    var $_PHPSHOP_FILEMANAGER_PUBLISHED = "Pubblicato?";
    
    /* FILE LIST */
    var $_PHPSHOP_FILES_LIST = "FileManager::Immagine/Elenco File per";
    var $_PHPSHOP_FILES_LIST_FILENAME = "Nome file";
    var $_PHPSHOP_FILES_LIST_FILETITLE = "Titolo file";
    var $_PHPSHOP_FILES_LIST_FILETYPE = "Tipo file";
    var $_PHPSHOP_FILES_LIST_EDITFILE = "Modifica entrata file";
    var $_PHPSHOP_FILES_LIST_FULL_IMG = "Immagine a dimensioni reali";
    var $_PHPSHOP_FILES_LIST_THUMBNAIL_IMG = "Miniature immagini";
    
    
    /* FILE FORM */
    var $_PHPSHOP_FILES_FORM = "Carica un file per";
    var $_PHPSHOP_FILES_FORM_CURRENT_FILE = "File attuale";
    var $_PHPSHOP_FILES_FORM_FILE = "File";
    var $_PHPSHOP_FILES_FORM_IMAGE = "Immagine";
    var $_PHPSHOP_FILES_FORM_UPLOAD_TO = "Carica su";
    var $_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH = "percorso predefinito immagini";
    var $_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH = "Specifica la collocazione del file";
    var $_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH = "Percorso Download (per i prodotti scaricabili!)";
    var $_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL = "Miniatura automatica?";
    var $_PHPSHOP_FILES_FORM_FILE_PUBLISHED = "File pubblicato?";
    var $_PHPSHOP_FILES_FORM_FILE_TITLE = "Titolo file (quello che vede il cliente)";
    var $_PHPSHOP_FILES_FORM_FILE_DESC = "Descrizione file";
    var $_PHPSHOP_FILES_FORM_FILE_URL = "URL file (opzionale)";
    
    /* FILE & IMAGE PROCESSING */
    var $_PHPSHOP_FILES_PATH_ERROR = "Inserire un percorso valido!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS = "La miniatura dell\'immagine &egrave; stata creata con successo!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE = "Impossibile creare miniatura immagine!";
    var $_PHPSHOP_FILES_UPLOAD_FAILURE = "Errore di caricamento File/Immagine";
    
    var $_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE = "Impossibile eliminare l\'immagine a dimensioni reali.";
    var $_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS = "Immagine a dimensioni reali eliminata con successo.";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE = "Impossibile eliminare file miniatura immagine (potrebbe non esistere): ";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS = "Miniatura immagine eliminata con successo.";
    var $_PHPSHOP_FILES_FILE_DELETE_FAILURE = "Impossibile eliminare il file.";
    var $_PHPSHOP_FILES_FILE_DELETE_SUCCESS = "File eliminato con successo.";
    
    var $_PHPSHOP_FILES_NOT_FOUND = "Spiacente, il file richiesto non &egrave; stato trovato!";
    var $_PHPSHOP_IMAGE_NOT_FOUND = "Immagine non trovata!";


    /*#####################
    MODULE COUPON
    #####################*/
    
    var $_PHPSHOP_COUPON_MOD = "Coupon";
    var $_PHPSHOP_COUPONS = "Coupon";
    var $_PHPSHOP_COUPON_LIST = "Lista Coupon";
    var $_PHPSHOP_COUPON_ALREADY_REDEEMED = "Coupon gi&agrave; utilizzato.";
    var $_PHPSHOP_COUPON_REDEEMED = "Coupon utilizzato! Grazie.";
    var $_PHPSHOP_COUPON_ENTER_HERE = "Se hai un codice coupon inseriscilo qui sotto:";
    var $_PHPSHOP_COUPON_SUBMIT_BUTTON = "Invia";
    var $_PHPSHOP_COUPON_CODE_EXISTS = "Codice coupon gi&agrave; utilizzato. Riprova.";
    var $_PHPSHOP_COUPON_EDIT_HEADER = "Aggiorna coupon";
    var $_PHPSHOP_COUPON_EDIT_HELP_TEXT = "Clicca sul codice coupon per modificarlo o, per eliminarlo, selezionalo e clicca Elimina:";
    var $_PHPSHOP_COUPON_CODE_HEADER = "Codice";
    var $_PHPSHOP_COUPON_PERCENT_TOTAL = "Valore percentuale o assoluto";
    var $_PHPSHOP_COUPON_TYPE = "Tipo di coupon";
    var $_PHPSHOP_COUPON_TYPE_TOOLTIP = "Un buono regalo viene eliminato dopo che &egrave; stato utilizzato come sconto su un ordine. Un coupon permanente pu&ograve; venir utilizzato ogni volta che lo si desidera.";
    var $_PHPSHOP_COUPON_TYPE_GIFT = "Buono regalo";    
    var $_PHPSHOP_COUPON_TYPE_PERMANENT = "Coupon Permanente";    
    var $_PHPSHOP_COUPON_VALUE_HEADER = "Valore";
    var $_PHPSHOP_COUPON_DELETE_BUTTON = "Elimina codice";
    var $_PHPSHOP_COUPON_CONFIRM_DELETE = "Sicuro di voler eliminare questo codice coupon?";
    var $_PHPSHOP_COUPON_COMPLETE_ALL_FIELDS = "Compilare tutti i campi.";
    var $_PHPSHOP_COUPON_VALUE_NOT_NUMBER = "Il valore coupon deve essere un numero.";
    var $_PHPSHOP_COUPON_NEW_HEADER = "Nuovo coupon";
    var $_PHPSHOP_COUPON_COUPON_HEADER = "Codice coupon";
    var $_PHPSHOP_COUPON_PERCENT = "Percentuale";
    var $_PHPSHOP_COUPON_TOTAL = "Assoluto";
    var $_PHPSHOP_COUPON_VALUE = "Valore";
    var $_PHPSHOP_COUPON_CODE_SAVED = "Codice coupon salvato.";
    var $_PHPSHOP_COUPON_SAVE_BUTTON = "Salva coupon";
    var $_PHPSHOP_COUPON_DISCOUNT = "Sconto coupon";
    var $_PHPSHOP_COUPON_CODE_INVALID = "Codice coupon non trovato. Riprova.";
    var $_PHPSHOP_COUPONS_ENABLE = "Abilita l\'uso di coupon";
    var $_PHPSHOP_COUPONS_ENABLE_EXPLAIN = "Se si abilita l\'uso dei coupon, si consente agli utenti di inserire dei numeri di codice di coupon per ricevere degli sconti sui loro acquisti.";
    
    /* Free Shipping */
    var $_PHPSHOP_FREE_SHIPPING = "Spedizione gratuita";
    var $_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT = "La spedizione per questo ordine &egrave; gratuita!";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT = "Ordine minimo per la spedizione gratuita";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP = "L\'ammontare (IVA INCLUSA!) minimo che d&agrave; diritto alla spedizione
													gratuita (es: <strong>50</strong> significa che il cliente ha diritto alla spedizione gratuita
                                                se fa un ordine dai 50 Euro in su (iva inclusa).";
    var $_PHPSHOP_YOUR_STORE = "Il tuo negozio";
    var $_PHPSHOP_CONTROL_PANEL = "Pannello di controllo";
    
    /* Configuration Additions */
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON = "Pulsante PDF";
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN = "MOstra o nasconde il pulsante PDF nel negozio";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER = "Bisogna accettare le condizioni del servizio ad OGNI ORDINE?";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN = "Attiva se vuoi che un acquirente debba accettare le condizioni del servizio prima di OGNI ORDINE che invia.";

    // We need this for eCheck.net Payments
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE = "Tipo di conto bancario";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING = "Checking";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING = "Business Checking";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS = "Saving";
    
    var $_PHPSHOP_PAYMENT_AN_RECURRING = "Fatturazione periodica?";
    var $_PHPSHOP_PAYMENT_AN_RECURRING_TOOLTIP = "Definisci se vuoi delle fatturazioni periodiche.";
    
    var $_PHPSHOP_INTERNAL_ERROR = "Errore interno durante l\'elaboraziond della richiesta a";
    var $_PHPSHOP_PAYMENT_ERROR = "Elaborazione pagamento fallita";
    var $_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS = "Elaborazione pagamento andata a buon fine";
    
    /* UPS Shipping Module */
    var $_PHPSHOP_UPS_RESPONSE_ERROR = "UPS non ha potuto elaborare la richiesta di tarffia di spedizione.";
    var $_PHPSHOP_UPS_SHIPPING_GUARANTEED_DAYS = "Giorni garantiti per la consegna";
    var $_PHPSHOP_UPS_PICKUP_METHOD = "Modalit&agrave; di ritiro UPS";
    var $_PHPSHOP_UPS_PICKUP_METHOD_TOOLTIP = "Come consegni i pacchi ad UPS?";
    var $_PHPSHOP_UPS_PACKAGE_TYPE = "Imballaggio UPS?";
    var $_PHPSHOP_UPS_PACKAGE_TYPE_TOOLTIP = "Seleziona il tipo di imballaggio predefinito.";
    var $_PHPSHOP_UPS_TYPE_RESIDENTIAL = "Consegna a domicilio?";
    var $_PHPSHOP_UPS_RESIDENTIAL = "Per privati (RES)";
    var $_PHPSHOP_UPS_COMMERCIAL    = "Consegna presso ditta (COM)";
    var $_PHPSHOP_UPS_RESIDENTIAL_TOOLTIP = "Tariffa per Privati (RES) o per Imprese (COM).";
    var $_PHPSHOP_UPS_HANDLING_FEE = "Spese per il trattamento";
    var $_PHPSHOP_UPS_HANDLING_FEE_TOOLTIP = "Le spese per il trattamento di questa modalit&agrave;d i consegna.";
    var $_PHPSHOP_UPS_TAX_CLASS = "Classe di imposta";
    var $_PHPSHOP_UPS_TAX_CLASS_TOOLTIP = "Usa questa clase di imposta sulla tariffa di spedizione.";
    
    var $_PHPSHOP_ERROR_CODE = "Codice errore";
    var $_PHPSHOP_ERROR_DESC = "Descrizione errore";
    
    var $_PHPSHOP_CHANGE_TRANSACTION_KEY = "Mostra/Modifica la Transaction Key";
    var $_PHPSHOP_CHANGE_PASSKEY_FORM = "Mostra/Modifica la Password/Transaction Key";
    var $_PHPSHOP_TYPE_PASSWORD = "Inserisci la tua password utente";
    var $_PHPSHOP_CURRENT_PASSWORD = "Password attuale";
    var $_PHPSHOP_CURRENT_TRANSACTION_KEY = "Transaction Key attuale";
    var $_PHPSHOP_CHANGE_PASSKEY_SUCCESS = "Transaction key modificata con successo.";
    
    var $_PHPSHOP_PAYMENT_CVV2 = "Richiedi/Cattura Credit Card Code Value (CVV2/CVC2/CID)";
    var $_PHPSHOP_PAYMENT_CVV2_TOOLTIP = "Controlla la validit&agrave; del CVV2/CVC2/CID (numero di tre o quattro cifre sul retro della carta di credito, sul fronte della carta per le carte American Express)?";
    var $_PHPSHOP_CUSTOMER_CVV2_TOOLTIP = "Inserisci il numero di tre o quattro cifre sul retro della tua carta (sul davanti per le carte American Express)";
    var $_PHPSHOP_CUSTOMER_CVV2_ERROR = "Devi inserire il codice della tua carta di credito per proseguire.";
    
    var $_PHPSHOP_PRODUCT_FORM_FILENAME = "Inserisci un nome file";
    var $_PHPSHOP_PRODUCT_FORM_FILENAME_TOOLTIP = "N.B.: Qui puoi inserire un nome di file. <strong>Se inserisci un nome file qui, non verr&agrave; caricato nessun file!!! Dovrai caricarlo manualmente via FTP!</strong>.";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD = "OPPURE carica un nuovo file";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD_TOOLTIP = "Puoi caricare un file locale. Questo file &egrave; il prodotto che vuoi vendere. I file esistenti verranno sovrascritti.";
    
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1 = "Inserisci qui il testo che vuoi venga visualizzato sulla pagina di descrizione del prodotto.<br />es.: 24 ore, 48 ore, 3 - 5 giorni, Su ordinazione.....";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2 = "OPPURE seleziona un\'immagine da visualizzare nella pagina di dettaglio del prodotto.<br />Le immagini risiedono nella directory <i>/components/com_phpshop/shop_image/availability</i><br />";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST = "Lista attributi";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Esempi formato lista attributi:</h4>
        <span class=\"sectionname\"><strong>Taglia</strong>,XL[+1.99],M,S[-2.99]<strong>;Colori</strong>,Rosso,Verde,Giallo,ExpensiveColor[=24.00]<strong>;ecc.</strong>,..,..</span>
        <h4>Aggiustamenti sul prezzo per l\'utilizzo della modifica degli attributi avanzata:</h4>
        <span class=\"sectionname\">
        <strong>&#43;</strong> == Aggiungi questo ammontare al prezzo configurato.<br />
        <strong>&#45;</strong> == Sottrai questo ammontare dal prezzo configurato.<br />
        <strong>&#61;</strong> == Imposta il prezzo del prodotto a questo ammontare.
      </span>";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST = "Lista attributi personalizzata";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Esempi per il formato lista attributi personalizzata:</h4>
        <span class=\"sectionname\"><strong>Nome;Extra;</strong>...</span>";

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
