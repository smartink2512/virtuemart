<?php
/*
* @version $Id: french.php,v 1.29 2005/06/22 19:50:43 soeren_nb Exp $
* @package Mambo_4.5.1
* @subpackage mambo-phpShop
*
* @copyright (C) 2004 Soeren Eberhardt
* @translation partly: Aïssa Bélaid (setk@free.fr) http://aissabelaid.online.fr
* @translation checked & completed: Didier Carloz (webmaster@wantoo.com) http://www.wantoo.com [2005/05/31]
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
        var $_PHPSHOP_CATEGORY = "Cat&eacute;gorie";
        var $_PHPSHOP_CATEGORIES = "Cat&eacute;gories";
        var $_PHPSHOP_SELECT_CATEGORY = "S&eacute;lectionnez une Cat&eacute;gorie:";
        var $_PHPSHOP_ADMIN = "Administration";
        var $_PHPSHOP_PRODUCT = "Produit";
        var $_PHPSHOP_LIST = "Liste";
        var $_PHPSHOP_ALL = "Tous";
        var $_PHPSHOP_LIST_ALL_PRODUCTS = "Lister Tous les Produits";
        var $_PHPSHOP_VIEW = "Voir";
        var $_PHPSHOP_SHOW = "Afficher";
        var $_PHPSHOP_ADD = "Ajouter";
        var $_PHPSHOP_UPDATE = "Mettre &agrave; jour";
        var $_PHPSHOP_DELETE = "Effacer";
        var $_PHPSHOP_SELECT = "S&eacute;lectionner";
        var $_PHPSHOP_SUBMIT = "Submit";
        var $_PHPSHOP_RANDOM = "Produits Al&eacute;atoires";
        var $_PHPSHOP_LATEST = "Derniers Produits";
	
	/*#####################
	MODULE ACCOUNT
	#####################*/
	
	# Some LABELs
	var $_PHPSHOP_HOME_TITLE = "Accueil";
	var $_PHPSHOP_CART_TITLE = "Votre panier";
	var $_PHPSHOP_CHECKOUT_TITLE = "Commander";
	var $_PHPSHOP_LOGIN_TITLE = "Connexion";
	var $_PHPSHOP_LOGOUT_TITLE = "D&eacute;connexion";
	var $_PHPSHOP_BROWSE_TITLE = "Parcourir";
	var $_PHPSHOP_SEARCH_TITLE = "Rechercher";
	var $_PHPSHOP_ACCOUNT_TITLE = "Votre compte";
	var $_PHPSHOP_NAVIGATION_TITLE = "Navigation";
	var $_PHPSHOP_DEPARTMENT_TITLE = "D&eacute;partement";
	var $_PHPSHOP_INFO = "Information";
	
	var $_PHPSHOP_BROWSE_LBL = "Parcourir";
	var $_PHPSHOP_PRODUCTS_LBL = "Produits";
	var $_PHPSHOP_PRODUCT_LBL = "Produit";
	var $_PHPSHOP_SEARCH_LBL = "Rechercher";
	var $_PHPSHOP_FLYPAGE_LBL = "D&eacute;tails du produit";
	
	var $_PHPSHOP_PRODUCT_NAME_TITLE = "Nom du produit";
	var $_PHPSHOP_PRODUCT_CATEGORY_TITLE = "Cat&eacute;gorie du produit";
	var $_PHPSHOP_PRODUCT_DESC_TITLE = "Description du produit";
	
	var $_PHPSHOP_CART_SHOW = "Voir le panier";
	var $_PHPSHOP_CART_ADD_TO = "Ajouter au panier";
	var $_PHPSHOP_CART_NAME = "Nom";
	var $_PHPSHOP_CART_SKU = "Ref.";
	var $_PHPSHOP_CART_PRICE = "Prix";
	var $_PHPSHOP_CART_QUANTITY = "Quantit&eacute;";
	var $_PHPSHOP_CART_SUBTOTAL = "Sous-Total";
	
	# Some messages
	var $_PHPSHOP_ADD_SHIPTO_1 = "Ajoutez une nouvelle";
	var $_PHPSHOP_ADD_SHIPTO_2 = "Adresse d'exp&eacute;dition";
	var $_PHPSHOP_NO_SEARCH_RESULT = "Votre recherche n'a renvoy&eacute; aucun r&eacute;sultat.<BR>";
	var $_PHPSHOP_PRICE_LABEL = "Prix: &euro;";
	var $_PHPSHOP_ORDER_BUTTON_LABEL = "Commander";
	var $_PHPSHOP_NO_CUSTOMER = "Vous n'&ecirc;tes pas encore client(e) enregistr&eacute;(e). Veuillez fournir vos informations de facturation en vous enregistrant. Merci.";
	var $_PHPSHOP_DELETE_MSG = "Etes-vous sur(e) de vouloir supprimer cet article ?";
	var $_PHPSHOP_THANKYOU = "Merci pour votre commande.";
	var $_PHPSHOP_NOT_SHIPPED = "Pas encore exp&eacute;di&eacute;e";
	var $_PHPSHOP_EMAIL_SENDTO = "Un email de confirmation vous a &eacute;t&eacute; envoy&eacute; &agrave; ";
	var $_PHPSHOP_NO_USER_TO_SELECT = "D&eacute;sol&eacute;, il n'y a aucun utilisateur valide que vous pourriez ajouter &agrave; la liste des acheteurs.";
	
	// Error messages
	
	var $_PHPSHOP_ERROR = "ERREUR";
	var $_PHPSHOP_MOD_NOT_REG = "Module non enregistr&eacute;.";
	var $_PHPSHOP_MOD_ISNO_REG = "n'est pas un module PhpShop valide.";
	var $_PHPSHOP_MOD_NO_AUTH = "Vous n'avez pas l'autorisation d'acc&eacute;der &agrave; ce module.";
	var $_PHPSHOP_PAGE_404_1 = "La page n'existe pas ou plus.";
	var $_PHPSHOP_PAGE_404_2 = "Le fichier n'existe pas. Fichier introuvable:";
	var $_PHPSHOP_PAGE_403 = "Droits d'accès insuffisants";
	var $_PHPSHOP_FUNC_NO_EXEC = "Vous n'avez pas la permission d'ex&eacute;cuter ";
	var $_PHPSHOP_FUNC_NOT_REG = "Fonction Non enregistr&eacute;e";
	var $_PHPSHOP_FUNC_ISNO_REG = " n'est pas une fonction phpShop valide.";
	
	/*#####################
	MODULE ADMIN
	#####################*/
	
	# Some LABELs
	var $_PHPSHOP_ADMIN_MOD = "Configuration générale";
	
	
	// User List
	var $_PHPSHOP_USER_LIST_MNU = "Lister les utilisateurs";
	var $_PHPSHOP_USER_LIST_LBL = "Liste des utilisateurs";
	var $_PHPSHOP_USER_LIST_USERNAME = "Nom d'utilisateur";
	var $_PHPSHOP_USER_LIST_FULL_NAME = "Nom complet";
	var $_PHPSHOP_USER_LIST_GROUP = "Groupe";
	
	// User Form
	var $_PHPSHOP_USER_FORM_MNU = "Ajouter un Utilisateur";
	var $_PHPSHOP_USER_FORM_LBL = "Ajouter des Informations";
	var $_PHPSHOP_USER_FORM_BILLTO_LBL = "Information de Facturation";
	var $_PHPSHOP_USER_FORM_SHIPTO_LBL = "Adresses de Livraison";
	var $_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL = "Ajouter une Adresse";
	var $_PHPSHOP_USER_FORM_ADDRESS_LABEL = "Nom de l'adresse";
	var $_PHPSHOP_USER_FORM_FIRST_NAME = "Pr&eacute;nom";
	var $_PHPSHOP_USER_FORM_LAST_NAME = "Nom";
	var $_PHPSHOP_USER_FORM_MIDDLE_NAME = "2&egrave;me pr&eacute;nom";
	var $_PHPSHOP_USER_FORM_TITLE = "Civilité";
	var $_PHPSHOP_USER_FORM_USERNAME = "Nom d'utilisateur";
	var $_PHPSHOP_USER_FORM_PASSWORD_1 = "Mot de passe";
	var $_PHPSHOP_USER_FORM_PASSWORD_2 = "Confirmer le mot de passe";
	var $_PHPSHOP_USER_FORM_PERMS = "Autorisations";
	var $_PHPSHOP_USER_FORM_COMPANY_NAME = "Nom de la soci&eacute;t&eacute;";
	var $_PHPSHOP_USER_FORM_ADDRESS_1 = "Adresse 1";
	var $_PHPSHOP_USER_FORM_ADDRESS_2 = "Adresse 2";
	var $_PHPSHOP_USER_FORM_CITY = "Ville";
	var $_PHPSHOP_USER_FORM_STATE = "Etat/Province/R&eacute;gion";
	var $_PHPSHOP_USER_FORM_ZIP = "Code postal";
	var $_PHPSHOP_USER_FORM_COUNTRY = "Pays";
	var $_PHPSHOP_USER_FORM_PHONE = "T&eacute;l&eacute;phone";
	var $_PHPSHOP_USER_FORM_FAX = "Fax";
	var $_PHPSHOP_USER_FORM_EMAIL = "Email";
	
	// Module List
	var $_PHPSHOP_MODULE_LIST_MNU = "Lister les modules";
	var $_PHPSHOP_MODULE_LIST_LBL = "Liste des modules";
	var $_PHPSHOP_MODULE_LIST_NAME = "Nom du module";
	var $_PHPSHOP_MODULE_LIST_PERMS = "Permissions du module";
	var $_PHPSHOP_MODULE_LIST_FUNCTIONS = "Fonctions";
	var $_PHPSHOP_MODULE_LIST_ORDER = "Ordre dans la liste";
	
	// Module Form
	var $_PHPSHOP_MODULE_FORM_MNU = "Ajouter un Module";
	var $_PHPSHOP_MODULE_FORM_LBL = "Information du Module";
	var $_PHPSHOP_MODULE_FORM_MODULE_LABEL = "Etiquette du Module (pour Topmenu)";
	var $_PHPSHOP_MODULE_FORM_NAME = "Nom du Module";
	var $_PHPSHOP_MODULE_FORM_PERMS = "Permissions du Module";
	var $_PHPSHOP_MODULE_FORM_HEADER = "En-T&ecirc;te du Module";
	var $_PHPSHOP_MODULE_FORM_FOOTER = "Pied de page du Module";
	var $_PHPSHOP_MODULE_FORM_MENU = "Afficher le Module dans le Menu Admin ?";
	var $_PHPSHOP_MODULE_FORM_ORDER = "Ordre d'affichage";
	var $_PHPSHOP_MODULE_FORM_DESCRIPTION = "Description du Module";
	var $_PHPSHOP_MODULE_FORM_LANGUAGE_CODE = "Code de Langue";
	var $_PHPSHOP_MODULE_FORM_LANGUAGE_file = "Fichier de Langue";
	
	// Function List
	var $_PHPSHOP_FUNCTION_LIST_MNU = "Lister les Fonctions";
	var $_PHPSHOP_FUNCTION_LIST_LBL = "Liste des Functions";
	var $_PHPSHOP_FUNCTION_LIST_NAME = "Nom de la Fonction";
	var $_PHPSHOP_FUNCTION_LIST_CLASS = "Nom de la Classe";
	var $_PHPSHOP_FUNCTION_LIST_METHOD = "M&eacute;thode de la Classe";
	var $_PHPSHOP_FUNCTION_LIST_PERMS = "Permissions";
	
	// Module Form
	var $_PHPSHOP_FUNCTION_FORM_MNU = "Ajouter une Fonction";
	var $_PHPSHOP_FUNCTION_FORM_LBL = "Information de la Fonction";
	var $_PHPSHOP_FUNCTION_FORM_NAME = "Nom de la Fonction";
	var $_PHPSHOP_FUNCTION_FORM_CLASS = "Nom de la Classe";
	var $_PHPSHOP_FUNCTION_FORM_METHOD = "M&eacute;thode de la Classe";
	var $_PHPSHOP_FUNCTION_FORM_PERMS = "Permissions de la Fonction";
	var $_PHPSHOP_FUNCTION_FORM_DESCRIPTION = "Description de la Fonction";
	
	// Currency form and list
	var $_PHPSHOP_CURRENCY_LIST_MNU = "Lister les Devises";
	var $_PHPSHOP_CURRENCY_LIST_LBL = "Liste des Devises";
	var $_PHPSHOP_CURRENCY_LIST_ADD = "Ajouter une Devise";
	var $_PHPSHOP_CURRENCY_LIST_NAME = "Nom de la Devise";
	var $_PHPSHOP_CURRENCY_LIST_CODE = "Code de la Devise";
	
	// Country form and list
	var $_PHPSHOP_COUNTRY_LIST_MNU = "Lister les Pays";
	var $_PHPSHOP_COUNTRY_LIST_LBL = "Liste des Pays";
	var $_PHPSHOP_COUNTRY_LIST_ADD = "Ajouter un Pays";
	var $_PHPSHOP_COUNTRY_LIST_NAME = "Nom du Pays";
	var $_PHPSHOP_COUNTRY_LIST_3_CODE = "Code du Pays (3)";
	var $_PHPSHOP_COUNTRY_LIST_2_CODE = "Code du Pays (2)";
	
	/*#####################
	MODULE CHECKOUT
	#####################*/
	
	# Some LABELs
	var $_PHPSHOP_ADDRESS = "Adresse";
	var $_PHPSHOP_CONTINUE = "Continuer";
	
	
	/*#####################
	MODULE ISShipping
	#####################*/
	
	# Some LABELs
	var $_PHPSHOP_ISSHIPPING_MOD = "InterShipper";
	
	
	// Shipping Ping
	var $_PHPSHOP_ISSHIP_PING_MNU = "Ping sur le serveur InterShipper";
	var $_PHPSHOP_ISSHIP_PING_LBL = "Ping Serveur InterShipper ";
	var $_PHPSHOP_ISSHIP_PING_ERROR_LBL = "Ping sur InterShipper Echou&eacute;";
	var $_PHPSHOP_ISSHIP_PING_GOOD_LBL = "Ping sur InterShipper R&eacute;ussi";
	var $_PHPSHOP_ISSHIP_PING_CARRIER_LBL = "Transporteur";
	var $_PHPSHOP_ISSHIP_PING_RESPONSE_LBL = "Temps de<BR>R&eacute;ponse";
	var $_PHPSHOP_ISSHIP_PING_TIME_LBL = "sec.";
	
	// Shipping List
	var $_PHPSHOP_ISSHIP_LIST_MNU = "Lister les M&eacute;thodes de Livraison";
	var $_PHPSHOP_ISSHIP_LIST_LBL = "M&eacute;thodes de Livraison Actives";
	var $_PHPSHOP_ISSHIP_LIST_CARRIER_LBL = "Moyen de Transport";
	var $_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL = "Active";
	var $_PHPSHOP_ISSHIP_LIST_RATE_LBL = "Co&ucirc;t du Transport";
	var $_PHPSHOP_ISSHIP_LIST_LEAD_LBL = "D&eacute;lai de Livraison";
	var $_PHPSHOP_ISSHIP_LIST_CHARGE_F_LBL = "taux forfaitaire";
	var $_PHPSHOP_ISSHIP_LIST_CHARGE_P_LBL = "pourcentage";
	var $_PHPSHOP_ISSHIP_LIST_DAYS_LBL = "jours";
	var $_PHPSHOP_ISSHIP_LIST_HEAVY_LBL = "Charges Lourdes";
	
	// Dynamic Shipping Form
	var $_PHPSHOP_ISSHIP_FORM_MNU = "Configurer les M&eacute;thodes de Livraison";
	var $_PHPSHOP_ISSHIP_FORM_ADD_LBL = "Configurer les M&eacute;thode de Livraison";
	var $_PHPSHOP_ISSHIP_FORM_UPDATE_LBL = "Configurer la M&eacute;thode de Livraison";
	var $_PHPSHOP_ISSHIP_FORM_REFRESH_LBL = "Actualiser";
	var $_PHPSHOP_ISSHIP_FORM_CARRIER_LBL = "M&eacute;thode de Livraison";
	var $_PHPSHOP_ISSHIP_FORM_PUBLISH_LBL = "Activer";
	var $_PHPSHOP_ISSHIP_FORM_HANDLING_LBL = "Frais De Manutention";
	var $_PHPSHOP_ISSHIP_FORM_LEAD_LBL = "D&eacute;lai de Livraison";
	var $_PHPSHOP_ISSHIP_FORM_CHARGE_F_LBL = "taux forfaitaire";
	var $_PHPSHOP_ISSHIP_FORM_CHARGE_P_LBL = "pourcentage";
	var $_PHPSHOP_ISSHIP_FORM_DAYS_LBL = "jours";
	var $_PHPSHOP_ISSHIP_FORM_HEAVY_LBL = "Charges Lourdes";
	
	
	
	/*#####################
	MODULE ORDER
	#####################*/
	
	
	# Some LABELs
	var $_PHPSHOP_ORDER_MOD = "Commandes";
	
	// Some menu options
	var $_PHPSHOP_ORDER_CONFIRM_MNU = "Confirmer la Commande";
	var $_PHPSHOP_ORDER_CANCEL_MNU = "Annuler la Commande";
	var $_PHPSHOP_ORDER_PRINT_MNU = "Imprimer la Commande";
	var $_PHPSHOP_ORDER_DELETE_MNU = "Supprimer la Commande";
	
	// Order List
	var $_PHPSHOP_ORDER_LIST_MNU = "Lister les Commandes";
	var $_PHPSHOP_ORDER_LIST_LBL = "Liste des Commandes";
	var $_PHPSHOP_ORDER_LIST_ID = "Num&eacute;ro de Commande";
	var $_PHPSHOP_ORDER_LIST_CDATE = "Date de Commande";
	var $_PHPSHOP_ORDER_LIST_MDATE = "Modifi&eacute;e le";
	var $_PHPSHOP_ORDER_LIST_STATUS = "Statut";
	var $_PHPSHOP_ORDER_LIST_TOTAL = "Sous-Total";
	var $_PHPSHOP_ORDER_ITEM = "El&eacute;ments Command&eacute;s";
	
	// Order print
	var $_PHPSHOP_ORDER_PRINT_PO_LBL = "Ordre d'Achat";
	var $_PHPSHOP_ORDER_PRINT_PO_NUMBER = "Num&eacute;ro de Commande";
	var $_PHPSHOP_ORDER_PRINT_PO_DATE = "Date de Commande";
	var $_PHPSHOP_ORDER_PRINT_PO_STATUS = "Statut de la Commande";
	var $_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL = "Information Client";
	var $_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL = "Information de Facturation";
	var $_PHPSHOP_ORDER_PRINT_CUST_SHIPPING_LBL = "Information d'Exp&eacute;dition";
	var $_PHPSHOP_ORDER_PRINT_BILL_TO_LBL = "Factur&eacute;e &agrave;";
	var $_PHPSHOP_ORDER_PRINT_SHIP_TO_LBL = "Livr&eacute;e &agrave;";
	var $_PHPSHOP_ORDER_PRINT_NAME = "Nom";
	var $_PHPSHOP_ORDER_PRINT_COMPANY = "Soci&eacute;t&eacute;";
	var $_PHPSHOP_ORDER_PRINT_ADDRESS_1 = "Adresse 1";
	var $_PHPSHOP_ORDER_PRINT_ADDRESS_2 = "Adresse 2";
	var $_PHPSHOP_ORDER_PRINT_CITY = "Ville";
	var $_PHPSHOP_ORDER_PRINT_STATE = "Etat/Province/R&eacute;gion";
	var $_PHPSHOP_ORDER_PRINT_ZIP = "Code postal";
	var $_PHPSHOP_ORDER_PRINT_COUNTRY = "Pays";
	var $_PHPSHOP_ORDER_PRINT_PHONE = "T&eacute;l&eacute;phone";
	var $_PHPSHOP_ORDER_PRINT_FAX = "Fax";
	var $_PHPSHOP_ORDER_PRINT_EMAIL = "Email";
	var $_PHPSHOP_ORDER_PRINT_ITEMS_LBL = "El&eacute;ments de la Commande";
	var $_PHPSHOP_ORDER_PRINT_QUANTITY = "Quantit&eacute;";
	var $_PHPSHOP_ORDER_PRINT_QTY = "Qt&eacute;";
	var $_PHPSHOP_ORDER_PRINT_SKU = "Ref.";
	var $_PHPSHOP_ORDER_PRINT_PRICE = "Prix";
	var $_PHPSHOP_ORDER_PRINT_TOTAL = "Total";
	var $_PHPSHOP_ORDER_PRINT_SUBTOTAL = "Sous-Total";
	var $_PHPSHOP_ORDER_PRINT_TOTAL_TAX = "Total des Taxes";
	var $_PHPSHOP_ORDER_PRINT_SHIPPING = "Livraison et Frais de Manutention";
	var $_PHPSHOP_ORDER_PRINT_SHIPPING_TAX = "Taxes Livraison";
	var $_PHPSHOP_ORDER_PRINT_PAYMENT_LBL = "M&eacute;thode de Paiement";
	var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NAME = "Nom du Compte";
	var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER = "Num&eacute;ro de Compte";
	var $_PHPSHOP_ORDER_PRINT_EXPIRE_DATE = "Date d'Expiration";
	var $_PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL = "Historique des Paiements";
	var $_PHPSHOP_ORDER_PRINT_SHIPPING_LBL = "Information de Livraison";
	var $_PHPSHOP_ORDER_PRINT_PAYINFO_LBL = "Information de Paiement";
	var $_PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL = "Transporteur";
	var $_PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL = "M&eacute;thode de Livraison";
	var $_PHPSHOP_ORDER_PRINT_SHIPPING_DATE_LBL = "Date de Livraison";
	var $_PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL = "Prix de Livraison";
	
	var $_PHPSHOP_ORDER_STATUS_LIST_MNU = "Lister les Types de Statuts de Commande";
	var $_PHPSHOP_ORDER_STATUS_FORM_MNU = "Ajouter un Type de Statut de Commande";
	
	var $_PHPSHOP_ORDER_STATUS_LIST_CODE = "Code du Statut de Commande";
	var $_PHPSHOP_ORDER_STATUS_LIST_NAME = "Nom du Statut de Commande";
	
	var $_PHPSHOP_ORDER_STATUS_FORM_LBL = "Statut de la Commande";
	var $_PHPSHOP_ORDER_STATUS_FORM_CODE = "Code du Statut de Commande";
	var $_PHPSHOP_ORDER_STATUS_FORM_NAME = "Nom du Statut de Commande";
	var $_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER = "Ordre dans la liste";
	
	
	/*#####################
	MODULE PRODUCT
	#####################*/
	
	# Some LABELs
	var $_PHPSHOP_PRODUCT_MOD = "Produits";
	
	var $_PHPSHOP_CURRENT_PRODUCT = "Produit En Cours";
        var $_PHPSHOP_CURRENT_ITEM = "El&eacute;ment En Cours";
	
	// Product Inventory
	var $_PHPSHOP_PRODUCT_INVENTORY_LBL = "Inventaire des Produits";
	var $_PHPSHOP_PRODUCT_INVENTORY_MNU = "Voir Inventaire";
	var $_PHPSHOP_PRODUCT_INVENTORY_PRICE = "Prix";
	var $_PHPSHOP_PRODUCT_INVENTORY_STOCK = "Nombre";
	var $_PHPSHOP_PRODUCT_INVENTORY_WEIGHT = "Poids";
	// Product List
	var $_PHPSHOP_PRODUCT_LIST_MNU = "Lister les Produits";
        var $_PHPSHOP_PRODUCT_LIST_LBL = "Liste des Produits";
        var $_PHPSHOP_PRODUCT_LIST_NAME = "Nom du Produit";
        var $_PHPSHOP_PRODUCT_LIST_SKU = "Ref.";
        var $_PHPSHOP_PRODUCT_LIST_PUBLISH = "Publier";
	
	// Product Form
	var $_PHPSHOP_PRODUCT_FORM_MNU = "Ajouter un Produit";
        var $_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT = "Editer ce Produit";
        var $_PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE = "Pr&eacute;visualiser le Produit en boutique";
        var $_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU = "Ajouter un &Eacute;l&eacute;ment";
        var $_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU = "Ajouter un Autre El&eacute;ment";
	
	var $_PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL = "Nouveau Produit";
        var $_PHPSHOP_PRODUCT_FORM_UPDATE_PRODUCT_LBL = "Mettre &agrave; jour le Produit";
        var $_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL = "Informations Produit";
        var $_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL = "Statut du Produit";
        var $_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL = "Dimensions et Poids du Produit";
        var $_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL = "Images du Produit";
	
	var $_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL = "Nouvel &Eacute;l&eacute;ment";
        var $_PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL = "Mettre &agrave; jour l'El&eacute;ment";
        var $_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL = "Information de l'El&eacute;ment";
        var $_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL = "Statut de l'El&eacute;ment";
        var $_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL = "Dimensions et Poids de l'El&eacute;ment";
        var $_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL = "Images de l'El&eacute;ment";
        var $_PHPSHOP_PRODUCT_FORM_RETURN_LBL = "Retour au Produit Parent";
        var $_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL = "Pour mettre &agrave; jour l'image actuelle, saisissez le chemin de la nouvelle image.";
        var $_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL = "Tapez 'none' pour effacer les images courantes.";
        var $_PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL = "El&eacute;ments du Produit";
        var $_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL = "Attributs de l'El&eacute;ment";
        var $_PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG = "Etes-vous certain(e) de vouloir effacer ce produit<br> et les &eacute;l&eacute;ments qui lui sont associ&eacute;s ?";
        var $_PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG = "Etes-vous certain(e) de vouloir effacer cet El&eacute;ment ?";
        var $_PHPSHOP_PRODUCT_FORM_VENDOR = "Vendeur";
        var $_PHPSHOP_PRODUCT_FORM_MANUFACTURER = "Fabricant";
        var $_PHPSHOP_PRODUCT_FORM_SKU = "Ref.";
        var $_PHPSHOP_PRODUCT_FORM_NAME = "Nom";
        var $_PHPSHOP_PRODUCT_FORM_URL = "URL";
        var $_PHPSHOP_PRODUCT_FORM_CATEGORY = "Cat&eacute;gorie";
		var $_PHPSHOP_PRODUCT_FORM_PRICE_GROSS = "Prix de Vente";
		var $_PHPSHOP_PRODUCT_FORM_PRICE_NET = "Product Price (Net)";
        var $_PHPSHOP_PRODUCT_FORM_PRICE = "";
        var $_PHPSHOP_PRODUCT_FORM_DESCRIPTION = "Description Compl&egrave;te";
        var $_PHPSHOP_PRODUCT_FORM_S_DESC = "Description R&eacute;sum&eacute;e";
        var $_PHPSHOP_PRODUCT_FORM_IN_STOCK = "En Stock";
        var $_PHPSHOP_PRODUCT_FORM_ON_ORDER = "Sur Commande";
        var $_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE = "Date de Disponibilit&eacute;";
        var $_PHPSHOP_PRODUCT_FORM_SPECIAL = "Prix Sp&eacute;cial";
        var $_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE = "Type de Remise";
        var $_PHPSHOP_PRODUCT_FORM_PUBLISH = "Publier ?";
        var $_PHPSHOP_PRODUCT_FORM_LENGTH = "Longueur";
        var $_PHPSHOP_PRODUCT_FORM_WIDTH = "Largeur";
        var $_PHPSHOP_PRODUCT_FORM_HEIGHT = "Hauteur";
        var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM = "Unit&eacute; de Mesure";
        var $_PHPSHOP_PRODUCT_FORM_WEIGHT = "Poids";
        var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM = "Unit&eacute; de Mesure";
        var $_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE = "Vignette";
        var $_PHPSHOP_PRODUCT_FORM_FULL_IMAGE = "Image Gde Taille";
	
	// Product Display
        var $_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL = "R&eacute;sultats Produit Ajout&eacute;";
        var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL = "R&eacute;sultats Produit Mis &agrave; Jour";
        var $_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL = "R&eacute;sultats El&eacute;ment Ajout&eacute;";
        var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL = "R&eacute;sultats El&eacute;ment Mis &agrave; Jour";
        var $_PHPSHOP_PRODUCT_CSV_UPLOAD = "Utiliser Envoi de CSV";
	var $_PHPSHOP_PRODUCT_FOLDERS = "Dossiers de Produit";
	
	// Product Category List
	var $_PHPSHOP_CATEGORY_LIST_MNU = "Lister les Cat&eacute;gories";
        var $_PHPSHOP_CATEGORY_LIST_LBL = "Arborescence des Cat&eacute;gories";
	
	// Product Category Form
	var $_PHPSHOP_CATEGORY_FORM_MNU = "Ajouter une Cat&eacute;gorie";
        var $_PHPSHOP_CATEGORY_FORM_LBL = "Information de la Cat&eacute;gorie";
        var $_PHPSHOP_CATEGORY_FORM_NAME = "Nom de la Cat&eacute;gorie";
        var $_PHPSHOP_CATEGORY_FORM_PARENT = "Parent";
        var $_PHPSHOP_CATEGORY_FORM_DESCRIPTION = "Description de la Cat&eacute;gorie";
        var $_PHPSHOP_CATEGORY_FORM_PUBLISH = "Publier ?";
        var $_PHPSHOP_CATEGORY_FORM_FLYPAGE = "Page d'Accueil de la Cat&eacute;gorie";
	
	// Product Attribute List
	var $_PHPSHOP_ATTRIBUTE_LIST_MNU = "Lister les Attributs";
        var $_PHPSHOP_ATTRIBUTE_LIST_LBL = "Liste d'Attributs pour";
        var $_PHPSHOP_ATTRIBUTE_LIST_NAME = "Nom de l'Attribut";
        var $_PHPSHOP_ATTRIBUTE_LIST_ORDER = "Ordre dans la liste";
	
	// Product Attribute Form
	var $_PHPSHOP_ATTRIBUTE_FORM_MNU = "Ajouter un Attribut";
        var $_PHPSHOP_ATTRIBUTE_FORM_LBL = "Formulaire d'Attribut";
        var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT = "Nouvel Attribut pour le Produit";
        var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT = "Mettre &agrave; jour l'Attribut pour ce Produit";
        var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM = "Nouvel Attribut pour El&eacute;ment";
        var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM = "Mettre &agrave; jour l'Attribut pour cet El&eacute;ment";
        var $_PHPSHOP_ATTRIBUTE_FORM_NAME = "Nom de l'Attribut";
        var $_PHPSHOP_ATTRIBUTE_FORM_ORDER = "Ordre dans la liste";
	
	// Product Price List
	var $_PHPSHOP_PRICE_LIST_MNU = "Lister les Cat&eacute;gories";
        var $_PHPSHOP_PRICE_LIST_LBL = "Arborescence des Prix";
        var $_PHPSHOP_PRICE_LIST_FOR_LBL = "Prix pour";
        var $_PHPSHOP_PRICE_LIST_GROUP_NAME = "Nom du groupe";
        var $_PHPSHOP_PRICE_LIST_PRICE = "Prix";
        var $_PHPSHOP_PRODUCT_LIST_CURRENCY = "Devise";
	
	// Product Price Form
	var $_PHPSHOP_PRICE_FORM_MNU = "Ajouter un Prix";
        var $_PHPSHOP_PRICE_FORM_LBL = "Information de Prix";
        var $_PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT = "Nouveau Prix pour ce Produit";
        var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT = "Mettre &agrave; jour le Prix pour ce Produit";
        var $_PHPSHOP_PRICE_FORM_NEW_FOR_ITEM = "Nouveau Prix pour cet El&eacute;ment";
        var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM = "Mettre &agrave; jour le Prix pour cet El&eacute;ment";
        var $_PHPSHOP_PRICE_FORM_PRICE = "Prix";
        var $_PHPSHOP_PRICE_FORM_CURRENCY = "Devise";
        var $_PHPSHOP_PRICE_FORM_GROUP = "Groupe Client";
	
	
	/*#####################
	MODULE REPORT BASIC
	#####################*/
	# Some LABELs
	var $_PHPSHOP_REPORTBASIC_MOD = "Rapports de Base";
        var $_PHPSHOP_RB_INDIVIDUAL = "Listes de Produits Individuels";
        var $_PHPSHOP_RB_SALE_TITLE = "Rapport des Ventes";
	
	/* labels for rpt_sales */
	var $_PHPSHOP_RB_SALES_PAGE_TITLE = "Vue d'ensemble d'Activit&eacute; des Ventes";
	
	var $_PHPSHOP_RB_INTERVAL_TITLE = "R&eacute;gler Intervalle";
        var $_PHPSHOP_RB_INTERVAL_MONTHLY_TITLE = "Mensuel";
        var $_PHPSHOP_RB_INTERVAL_WEEKLY_TITLE = "Hebdomadaire";
        var $_PHPSHOP_RB_INTERVAL_DAILY_TITLE = "Quotidien";
    
        var $_PHPSHOP_RB_THISMONTH_BUTTON = "Ce Mois";
        var $_PHPSHOP_RB_LASTMONTH_BUTTON = "Mois Dernier";
        var $_PHPSHOP_RB_LAST60_BUTTON = "60 Derniers jours";
        var $_PHPSHOP_RB_LAST90_BUTTON = "90 Derniers jours";
    
        var $_PHPSHOP_RB_START_DATE_TITLE = "D&eacute;bute le";
        var $_PHPSHOP_RB_END_DATE_TITLE = "Termine le";
        var $_PHPSHOP_RB_SHOW_SEL_RANGE = "Montrer cette P&eacute;riode Choisie";
        var $_PHPSHOP_RB_REPORT_FOR = "Rapport pour ";
        var $_PHPSHOP_RB_DATE = "Date";
        var $_PHPSHOP_RB_ORDERS = "Commandes";
        var $_PHPSHOP_RB_TOTAL_ITEMS = "Total des Articles vendus";
        var $_PHPSHOP_RB_REVENUE = "Chiffre d'Affaire";
        var $_PHPSHOP_RB_PRODLIST = "Liste Produit";
	
	
	
	/*#####################
	MODULE SHOP
	#####################*/
	
	# Some LABELs
	var $_PHPSHOP_SHOP_MOD = "Boutique";
        var $_PHPSHOP_PRODUCT_THUMB_TITLE = "Image Vignette";
        var $_PHPSHOP_PRODUCT_PRICE_TITLE = "Prix";
        var $_PHPSHOP_ORDER_STATUS_P = "En Attente";
        var $_PHPSHOP_ORDER_STATUS_C = "Confirm&eacute;e";
        var $_PHPSHOP_ORDER_STATUS_X = "Annul&eacute;e";
	
	
	# Some messages
	var $_PHPSHOP_EMPTY_CART = "Votre panier est actuellement vide.";
	var $_PHPSHOP_ORDER_BUTTON = "Commander";
	
	
	
	/*#####################
	MODULE SHOPPER
	#####################*/
	
	# Some LABELs
	var $_PHPSHOP_SHOPPER_MOD = "Clients";
	
	
	
	// Shopper List
	var $_PHPSHOP_SHOPPER_LIST_MNU = "Lister les Clients";
        var $_PHPSHOP_SHOPPER_LIST_LBL = "Liste des Clients";
        var $_PHPSHOP_SHOPPER_LIST_USERNAME = "Nom d'Utilisateur";
        var $_PHPSHOP_SHOPPER_LIST_NAME = "Nom Complet";
        var $_PHPSHOP_SHOPPER_LIST_GROUP = "Groupe";
	
	// Shopper Form
	var $_PHPSHOP_SHOPPER_FORM_MNU = "Ajouter un Client";
        var $_PHPSHOP_SHOPPER_FORM_LBL = "Information Client";
        var $_PHPSHOP_SHOPPER_FORM_BILLTO_LBL = "Information de Facturation";
        var $_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL = "Adresse de Facturation";
        var $_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL = "Adresses de Livraison";
        var $_PHPSHOP_SHOPPER_FORM_ADD_SHIPTO_LBL = "Ajouter une Adresse";
        var $_PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL = "Nom de l'Adresse";
        var $_PHPSHOP_SHOPPER_FORM_USERNAME = "Nom d'Utilisateur";
        var $_PHPSHOP_SHOPPER_FORM_FIRST_NAME = "Pr&eacute;nom";
        var $_PHPSHOP_SHOPPER_FORM_LAST_NAME = "Nom";
        var $_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME = "2&egrave;me Pr&eacute;nom";
        var $_PHPSHOP_SHOPPER_FORM_TITLE = "Civilit&eacute;";
        var $_PHPSHOP_SHOPPER_FORM_SHOPPERNAME = "Nom dans la Boutique";
        var $_PHPSHOP_SHOPPER_FORM_PASSWORD_1 = "Mot de Passe";
        var $_PHPSHOP_SHOPPER_FORM_PASSWORD_2 = "Confirmer le Mot de Passe";
        var $_PHPSHOP_SHOPPER_FORM_GROUP = "Groupe de Client";
        var $_PHPSHOP_SHOPPER_FORM_COMPANY_NAME = "Nom de la Soci&eacute;t&eacute;";
        var $_PHPSHOP_SHOPPER_FORM_ADDRESS_1 = "Adresse 1";
        var $_PHPSHOP_SHOPPER_FORM_ADDRESS_2 = "Adresse 2";
        var $_PHPSHOP_SHOPPER_FORM_CITY = "Ville";
        var $_PHPSHOP_SHOPPER_FORM_STATE = "Etat/Province/R&eacute;gion";
        var $_PHPSHOP_SHOPPER_FORM_ZIP = "Code Postal";
        var $_PHPSHOP_SHOPPER_FORM_COUNTRY = "Pays";
        var $_PHPSHOP_SHOPPER_FORM_PHONE = "T&eacute;l&eacute;phone";
        var $_PHPSHOP_SHOPPER_FORM_FAX = "Fax";
        var $_PHPSHOP_SHOPPER_FORM_EMAIL = "Email";
	
	// Shopper Group List
	var $_PHPSHOP_SHOPPER_GROUP_LIST_MNU = "Lister les Groupes de Clients";
        var $_PHPSHOP_SHOPPER_GROUP_LIST_LBL = "Liste des Groupes de Clients";
        var $_PHPSHOP_SHOPPER_GROUP_LIST_NAME = "Nom du Groupe";
        var $_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION = "Description du Groupe";
	
	
	// Shopper Group Form
	var $_PHPSHOP_SHOPPER_GROUP_FORM_LBL = "Formulaire du Groupe de Clients";
        var $_PHPSHOP_SHOPPER_GROUP_FORM_MNU = "Ajouter un Groupe de Clients";
        var $_PHPSHOP_SHOPPER_GROUP_FORM_NAME = "Nom du Groupe";
        var $_PHPSHOP_SHOPPER_GROUP_FORM_DESC = "Description du Groupe";
	
	
	
	
	/*#####################
	MODULE SHOPPER
	#####################*/
	
	# Some LABELs
	var $_PHPSHOP_STORE_MOD = "Boutique";
	
	
	// Store Form
	var $_PHPSHOP_STORE_FORM_MNU = "Editer la Boutique";
        var $_PHPSHOP_STORE_FORM_LBL = "Informations sur la Boutique";
        var $_PHPSHOP_STORE_FORM_CONTACT_LBL = "Informations de Contact";
        var $_PHPSHOP_STORE_FORM_FULL_IMAGE = "Image Gde Taille";
        var $_PHPSHOP_STORE_FORM_UPLOAD = "Envoyer une Image";
        var $_PHPSHOP_STORE_FORM_STORE_NAME = "Nom de la Boutique";
        var $_PHPSHOP_STORE_FORM_COMPANY_NAME = "Nom de la Soci&eacute;t&eacute; Boutique";
        var $_PHPSHOP_STORE_FORM_ADDRESS_1 = "Adresse 1";
        var $_PHPSHOP_STORE_FORM_ADDRESS_2 = "Adresse 2";
        var $_PHPSHOP_STORE_FORM_CITY = "Ville";
        var $_PHPSHOP_STORE_FORM_STATE = "Etat/Province/R&eacute;gion";
        var $_PHPSHOP_STORE_FORM_COUNTRY = "Pays";
        var $_PHPSHOP_STORE_FORM_ZIP = "Code Postal";
        var $_PHPSHOP_STORE_FORM_PHONE = "T&eacute;l&eacute;phone";
        var $_PHPSHOP_STORE_FORM_CURRENCY = "Devise";
        var $_PHPSHOP_STORE_FORM_CATEGORY = "Cat&eacute;gorie de la Boutique";
        var $_PHPSHOP_STORE_FORM_LAST_NAME = "Nom";
        var $_PHPSHOP_STORE_FORM_FIRST_NAME = "Pr&eacute;nom";
        var $_PHPSHOP_STORE_FORM_MIDDLE_NAME = "2&egrave;me Pr&eacute;nom";
        var $_PHPSHOP_STORE_FORM_TITLE = "Civilit&eacute;";
        var $_PHPSHOP_STORE_FORM_PHONE_1 = "T&eacute;l&eacute;phone 1";
        var $_PHPSHOP_STORE_FORM_PHONE_2 = "T&eacute;l&eacute;phone 2";
        var $_PHPSHOP_STORE_FORM_FAX = "Fax";
        var $_PHPSHOP_STORE_FORM_EMAIL = "Email";
        var $_PHPSHOP_STORE_FORM_IMAGE_PATH = "Chemin de l'Image";
        var $_PHPSHOP_STORE_FORM_DESCRIPTION = "Description";
	
	
	
	var $_PHPSHOP_PAYMENT = "Paiement";
	// Payment Method List
	var $_PHPSHOP_PAYMENT_METHOD_LIST_MNU = "Lister les M&eacute;thodes de Paiement";
        var $_PHPSHOP_PAYMENT_METHOD_LIST_LBL = "Liste des M&eacute;thodes de Paiement";
        var $_PHPSHOP_PAYMENT_METHOD_LIST_NAME = "Nom";
        var $_PHPSHOP_PAYMENT_METHOD_LIST_CODE = "Code";
        var $_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT = "Remise";
        var $_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP = "Groupe de Client";
        var $_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR = "Activer Type M&eacute;thode de Paiement";
	
	// Payment Method Form
	var $_PHPSHOP_PAYMENT_METHOD_FORM_MNU = "Ajouter une M&eacute;thode Paiement";
        var $_PHPSHOP_PAYMENT_METHOD_FORM_LBL = "Formulaire de M&eacute;thode de Paiement";
        var $_PHPSHOP_PAYMENT_METHOD_FORM_NAME = "Nom de la M&eacute;thode de Paiement";
        var $_PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP = "Groupe de Client";
        var $_PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT = "Remise";
        var $_PHPSHOP_PAYMENT_METHOD_FORM_CODE = "Code";
        var $_PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER = "Ordre dans la liste";
        var $_PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR = "Activer Type M&eacute;thode de Paiement";
	
	
	
	/*#####################
	MODULE TAX
	#####################*/
	
	
	# Some LABELs
	var $_PHPSHOP_TAX_MOD = "Taxes";
	
	// User List
	var $_PHPSHOP_TAX_RATE = "Taux de Taxes";
        var $_PHPSHOP_TAX_LIST_MNU = "Lister les Taux de Taxes";
        var $_PHPSHOP_TAX_LIST_LBL = "Liste des Taux de Taxes";
        var $_PHPSHOP_TAX_LIST_STATE = "Taxes par Etat ou R&eacute;gion";
        var $_PHPSHOP_TAX_LIST_COUNTRY = "Taxes par Pays";
        var $_PHPSHOP_TAX_LIST_RATE = "Taux de Taxe";
	
	// User Form
	var $_PHPSHOP_TAX_FORM_MNU = "Ajouter un Taux de Taxe";
        var $_PHPSHOP_TAX_FORM_LBL = "Ajouter des Informations sur la Taxe";
        var $_PHPSHOP_TAX_FORM_STATE = "Taxe par Etat ou R&eacute;gion";
        var $_PHPSHOP_TAX_FORM_COUNTRY = "Taxe par Pays";
        var $_PHPSHOP_TAX_FORM_RATE = "Taux de Taxe (pour 19.6% => remplissez 0.196)";
	
	
	
	
	/*#####################
	MODULE VENDOR
	#####################*/
	
	
	
	# Some LABELs
	var $_PHPSHOP_VENDOR_MOD = "Vendeurs";
        var $_PHPSHOP_VENDOR_ADMIN = "Administration des Vendeurs";
	
	
	// Vendor List
	var $_PHPSHOP_VENDOR_LIST_MNU = "Lister les Vendeurs";
        var $_PHPSHOP_VENDOR_LIST_LBL = "Liste des Vendeurs";
        var $_PHPSHOP_VENDOR_LIST_VENDOR_NAME = "Nom du Vendeur";
        var $_PHPSHOP_VENDOR_LIST_ADMIN = "Admin";
	
	// Vendor Form
	var $_PHPSHOP_VENDOR_FORM_MNU = "Ajouter un Vendeur";
        var $_PHPSHOP_VENDOR_FORM_LBL = "Ajouter des Informations";
        var $_PHPSHOP_VENDOR_FORM_INFO_LBL = "Information du Vendeur";
        var $_PHPSHOP_VENDOR_FORM_CONTACT_LBL = "Information de Contact";
        var $_PHPSHOP_VENDOR_FORM_FULL_IMAGE = "Image Gde Taille";
        var $_PHPSHOP_VENDOR_FORM_UPLOAD = "Envoyer une Image";
        var $_PHPSHOP_VENDOR_FORM_STORE_NAME = "Nom de la Bboutique du Vendeur";
        var $_PHPSHOP_VENDOR_FORM_COMPANY_NAME = "Nom de la Soci&eacute;t&eacute; du Vendeur";
        var $_PHPSHOP_VENDOR_FORM_ADDRESS_1 = "Adresse 1";
        var $_PHPSHOP_VENDOR_FORM_ADDRESS_2 = "Adresse 2";
        var $_PHPSHOP_VENDOR_FORM_CITY = "Ville";
        var $_PHPSHOP_VENDOR_FORM_STATE = "Etat/Province/R&eacute;gion";
        var $_PHPSHOP_VENDOR_FORM_COUNTRY = "Pays";
        var $_PHPSHOP_VENDOR_FORM_ZIP = "Code Postal";
        var $_PHPSHOP_VENDOR_FORM_PHONE = "T&eacute;l&eacute;phone";
        var $_PHPSHOP_VENDOR_FORM_CURRENCY = "Devise";
        var $_PHPSHOP_VENDOR_FORM_CATEGORY = "Cat&eacute;gorie du Vendeur";
        var $_PHPSHOP_VENDOR_FORM_LAST_NAME = "Nom";
        var $_PHPSHOP_VENDOR_FORM_FIRST_NAME = "Pr&eacute;nom";
        var $_PHPSHOP_VENDOR_FORM_MIDDLE_NAME = "2&egrave;me Pr&eacute;nom";
        var $_PHPSHOP_VENDOR_FORM_TITLE = "Civilit&eacute;";
        var $_PHPSHOP_VENDOR_FORM_PHONE_1 = "T&eacute;l&eacute;phone 1";
        var $_PHPSHOP_VENDOR_FORM_PHONE_2 = "T&eacute;l&eacute;phone 2";
        var $_PHPSHOP_VENDOR_FORM_FAX = "Fax";
        var $_PHPSHOP_VENDOR_FORM_EMAIL = "Email";
        var $_PHPSHOP_VENDOR_FORM_IMAGE_PATH = "Chemin de l'Image";
        var $_PHPSHOP_VENDOR_FORM_DESCRIPTION = "Description";
	
	
	// Vendor Category List
	var $_PHPSHOP_VENDOR_CAT_LIST_MNU = "Lister les<br>Cat&eacute;gories<br>de Vendeurs";
        var $_PHPSHOP_VENDOR_CAT_LIST_LBL = "Liste des Cat&eacute;gories de Vendeurs";
        var $_PHPSHOP_VENDOR_CAT_NAME = "Nom de la Cat&eacute;gorie";
        var $_PHPSHOP_VENDOR_CAT_DESCRIPTION = "Description de la Cat&eacute;gorie";
        var $_PHPSHOP_VENDOR_CAT_VENDORS = "Vendeurs";
	
	// Vendor Category Form
	var $_PHPSHOP_VENDOR_CAT_FORM_MNU = "Ajouter une<br>Cat&eacute;gorie<br>de Vendeurs";
        var $_PHPSHOP_VENDOR_CAT_FORM_LBL = "Formulaire des Cat&eacute;gories de Vendeurs";
        var $_PHPSHOP_VENDOR_CAT_FORM_INFO_LBL = "Information de la Cat&eacute;gorie";
        var $_PHPSHOP_VENDOR_CAT_FORM_NAME = "Nom de la Cat&eacute;gorie";
        var $_PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION = "Description de la Cat&eacute;gorie";
	
	/*#####################
	MODULE MANUFACTURER
	#####################*/
	
	# Some LABELs
	var $_PHPSHOP_MANUFACTURER_MOD = "Fabricants";
        var $_PHPSHOP_MANUFACTURER_ADMIN = "Administration des Fabricants";
	
	
	// Manufacturer List
	var $_PHPSHOP_MANUFACTURER_LIST_MNU = "Lister les Fabricants";
        var $_PHPSHOP_MANUFACTURER_LIST_LBL = "Liste des Fabricants";
        var $_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME = "Nom du Fabricant";
        var $_PHPSHOP_MANUFACTURER_LIST_ADMIN = "Admin";
	
	// Manufacturer Form
	var $_PHPSHOP_MANUFACTURER_FORM_MNU = "Ajouter un Fabricant";
        var $_PHPSHOP_MANUFACTURER_FORM_LBL = "Ajouter une Information";
        var $_PHPSHOP_MANUFACTURER_FORM_INFO_LBL = "Information du Fabricant";
        var $_PHPSHOP_MANUFACTURER_FORM_NAME = "Nom du Fabricant";
        var $_PHPSHOP_MANUFACTURER_FORM_CATEGORY = "Cat&eacute;gorie de Fabricant";
        var $_PHPSHOP_MANUFACTURER_FORM_EMAIL = "Email";
        var $_PHPSHOP_MANUFACTURER_FORM_URL = "Adresse du Site Web du Fabricant";
        var $_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION = "Description";
	
	
	// Manufacturer Category List
	var $_PHPSHOP_MANUFACTURER_CAT_LIST_MNU = "Lister les<br>Cat&eacute;gories<br>de Fabricants";
        var $_PHPSHOP_MANUFACTURER_CAT_LIST_LBL = "Liste des Cat&eacute;gories de Fabricants";
        var $_PHPSHOP_MANUFACTURER_CAT_NAME = "Nom de la Cat&eacute;gorie";
        var $_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION = "Description Cat&eacute;gorie";
        var $_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS = "Fabricants";
	
	// Manufacturer Category Form
	var $_PHPSHOP_MANUFACTURER_CAT_FORM_MNU = "Ajouter une Cat&eacute;gorie de Fabricants";
        var $_PHPSHOP_MANUFACTURER_CAT_FORM_LBL = "Formulaire Cat&eacute;gorie Fabricant";
        var $_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL = "Information de la Cat&eacute;gorie";
        var $_PHPSHOP_MANUFACTURER_CAT_FORM_NAME = "Nom de la Cat&eacute;gorie";
        var $_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION = "Description de la Cat&eacute;gorie";
	
	
	/*#####################
	Modul HELP
	#####################*/
	var $_PHPSHOP_HELP_MOD = "Aide";
	
	// 210104 start
	
	// basketform
	var $_PHPSHOP_CART_ACTION = "Mettre &agrave; Jour";
        var $_PHPSHOP_CART_UPDATE = "Mettre &agrave; Jour la Quantit&eacute; dans le Panier";
        var $_PHPSHOP_CART_DELETE = "Supprimer le Produit du Panier";
	
	//shopbrowse form
	
	var $_PHPSHOP_PRODUCT_PRICETAG = "Prix";
        var $_PHPSHOP_PRODUCT_CALL = "Contactez-nous pour une Tarification";
        var $_PHPSHOP_PRODUCT_PREVIOUS = "Pr&eacute;c&eacute;dent";
        var $_PHPSHOP_PRODUCT_NEXT = "Suivant";
	
	//ro_basket
	
	var $_PHPSHOP_CART_TAX = "Taxe";
        var $_PHPSHOP_CART_SHIPPING = "Transport et Frais de Manutention";
        var $_PHPSHOP_CART_TOTAL = "Total";
	
	//CHECKOUT.INDEX
	
	var $_PHPSHOP_CHECKOUT_NEXT = "Suivant";
        var $_PHPSHOP_CHECKOUT_REGISTER = "ENREGISTRER";
	
	//CHECKOUT.CONFIRM
	
	var $_PHPSHOP_CHECKOUT_CONF_BILLINFO = "Information de Facturation";
        var $_PHPSHOP_CHECKOUT_CONF_COMPANY = "Soci&eacute;t&eacute;";
        var $_PHPSHOP_CHECKOUT_CONF_NAME = "Nom";
        var $_PHPSHOP_CHECKOUT_CONF_ADDRESS = "Adresse";
        var $_PHPSHOP_CHECKOUT_CONF_PHONE = "T&eacute;l&eacute;phone";
        var $_PHPSHOP_CHECKOUT_CONF_FAX = "Fax";
        var $_PHPSHOP_CHECKOUT_CONF_EMAIL = "Email";
        var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO = "Information d'Exp&eacute;dition";
        var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY = "Soci&eacute;t&eacute;";
        var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME = "Nom";
        var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS = "Adresse";
        var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE = "T&eacute;l&eacute;phone";
        var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX = "Fax";
        var $_PHPSHOP_CHECKOUT_CONF_PAYINFO = "Information de Paiement";
        var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD = "Nom sur la Carte";
        var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD = "M&eacute;thode de Paiement";
        var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM = "Num&eacute;ro de Carte de Cr&eacute;dit";
        var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE = "Date d'Expiration";
        var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER = "Passer la Commande";
        var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO = "Infomation Requise quand vous choisissez le Paiement par Carte Bancaire";
	
	
	var $_PHPSHOP_ZONE_MOD = "Zone d'Exp&eacute;dition";
    
        var $_PHPSHOP_ZONE_LIST_MNU = "Liste des Zones";
        var $_PHPSHOP_ZONE_FORM_MNU = "Ajouter une Zone";
        var $_PHPSHOP_ZONE_ASSIGN_MNU = "Assigner des Zones";
	
	// assign zone List
	var $_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL = "Pays";
        var $_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL = "Zone En Cours";
        var $_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL = "Assigner &agrave; la Zone";
        var $_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL = "Mettre &agrave; Jour";
        var $_PHPSHOP_ASSIGN_ZONE_PG_LBL = "Assigner Zones";
	
	// zone Form
	var $_PHPSHOP_ZONE_FORM_NAME_LBL = "Nom de la Zone";
        var $_PHPSHOP_ZONE_FORM_DESC_LBL = "Description de la Zone";
        var $_PHPSHOP_ZONE_FORM_COST_PER_LBL = "Co&ucirc;t Zone par Article";
        var $_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL = "Co&ucirc;t Limite Zone";
	
	// List of zones
	var $_PHPSHOP_ZONE_LIST_LBL = "Liste Zone";
        var $_PHPSHOP_ZONE_LIST_NAME_LBL = "Nom Zone";
        var $_PHPSHOP_ZONE_LIST_DESC_LBL = "Description de la Zone";
        var $_PHPSHOP_ZONE_LIST_COST_PER_LBL = "Co&ucirc;t Zone par Article";
        var $_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL = "Co&ucirc;t Limite Zone";
	
	var $_PHPSHOP_LOGIN_FIRST = "Veuillez vous identifier ou cr&eacute;&eacute; un compte sur ce sie en premier lieu.<br>Merci";
        var $_PHPSHOP_STORE_FORM_TOS = "Conditions d'Utilisation";
        var $_PHPSHOP_AGREE_TO_TOS = "Veuillez d'abord accepter nos conditions d'utilisation SVP.";
        var $_PHPSHOP_I_AGREE_TO_TOS = "J'accepte les Conditions d'Utilisation";
	
	var $_PHPSHOP_LEAVE_BLANK = "(laissez VIDE si vous n'avez pas <br />de fichier php individuel pour cet article !)";
        var $_PHPSHOP_RETURN_LOGIN = "Espace Client: Veuillez vous Identifier";
        var $_PHPSHOP_NEW_CUSTOMER = "Nouveau Client ? Veuillez fournir vos Informations de Facturation";
        var $_PHPSHOP_ACC_CUSTOMER_ACCOUNT = "Compte Client:";
        var $_PHPSHOP_ACC_ORDER_INFO = "Information de Commande";
        var $_PHPSHOP_ACC_UPD_BILL = "Ici vous pouvez mettre &agrave; jour vos informations de facturation.";
        var $_PHPSHOP_ACC_UPD_SHIP = "Ici vous pouvez ajouter et mettre &agrave; jour vos adresses d'exp&eacute;dition.";
        var $_PHPSHOP_ACC_ACCOUNT_INFO = "Information de Compte";
        var $_PHPSHOP_ACC_SHIP_INFO = "Information d'Exp&eacute;dition";
        var $_PHPSHOP_ACC_NO_ORDERS = "Aucune Commande &agrave; Afficher";
        var $_PHPSHOP_ACC_BILL_DEF = "- Par D&eacute;faut (Identique &agrave; la Facturation)";
        var $_PHPSHOP_SHIPTO_TEXT = "Vous pouvez ajouter des adresses d'exp&eacute;dition dans votre compte. Pensez &agrave; utiliser un nom ou un code appropri&eacute; pour l'adresse d'exp&eacute;dition ci-dessous.";
        var $_PHPSHOP_CONFIG = "Configuration";
        var $_PHPSHOP_USERS = "Utilisateurs";
        var $_PHPSHOP_IS_CC_PAYMENT = "est un paiment par Carte de Cr&eacute;dit ?";
	
	/*#####################################################
	MODULE SHIPPING
	#######################################################*/
        var $_PHPSHOP_SHIPPING_MOD = "Exp&eacute;ditions";
        var $_PHPSHOP_SHIPPING_MENU_LABEL = "Exp&eacute;dition";
	
	var $_PHPSHOP_CARRIER_LIST_MNU = "Exp&eacute;diteur";
        var $_PHPSHOP_CARRIER_LIST_LBL = "Liste des Exp&eacute;diteurs";
        var $_PHPSHOP_RATE_LIST_MNU = "Taux Exp&eacute;ditions";
        var $_PHPSHOP_RATE_LIST_LBL = "Liste des Taux d'Exp&eacute;ditions";
        var $_PHPSHOP_CARRIER_LIST_NAME_LBL = "Nom";
        var $_PHPSHOP_CARRIER_LIST_ORDER_LBL = "Ordre dans la liste";
	
	var $_PHPSHOP_CARRIER_FORM_MNU = "Cr&eacute;er Exp&eacute;diteur";
        var $_PHPSHOP_CARRIER_FORM_LBL = "Cr&eacute;er/&Eacute;diter Exp&eacute;diteur";
        var $_PHPSHOP_RATE_FORM_MNU = "Cr&eacute;er Taux Exp&eacute;dition";
        var $_PHPSHOP_RATE_FORM_LBL = "Cr&eacute;er/&Eacute;diter Taux Exp&eacute;dition";
	
	var $_PHPSHOP_RATE_FORM_NAME = "Description Taux Exp&eacute;dition";
        var $_PHPSHOP_RATE_FORM_CARRIER = "Exp&eacute;diteur";
        var $_PHPSHOP_RATE_FORM_COUNTRY = "Pays";
        var $_PHPSHOP_RATE_FORM_ZIP_START = "Fourchette de Codes Postaux commence &agrave;";
        var $_PHPSHOP_RATE_FORM_ZIP_END = "Fourchette de Codes Postaux termine &agrave;";
        var $_PHPSHOP_RATE_FORM_WEIGHT_START = "Poids Minimum";
        var $_PHPSHOP_RATE_FORM_WEIGHT_END = "Poids Maximum";
        var $_PHPSHOP_RATE_FORM_VALUE = "Frais";
        var $_PHPSHOP_RATE_FORM_PACKAGE_FEE = "Vos Frais d'Emballage";
        var $_PHPSHOP_RATE_FORM_CURRENCY = "Devise";
        var $_PHPSHOP_RATE_FORM_VAT_ID = "N° TVA";
        var $_PHPSHOP_RATE_FORM_LIST_ORDER = "Ordre dans la liste";
	
	var $_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL = "Exp&eacute;diteur";
        var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME = "Description Taux Exp&eacute;dition";
        var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART = "Poids &agrave; partir de ...";
        var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND = "... jusqu'&agrave;";
        var $_PHPSHOP_CARRIER_FORM_NAME = "Soci&eacute;t&eacute; Exp&eacute;ditrice";
        var $_PHPSHOP_CARRIER_FORM_LIST_ORDER = "Ordre dans la liste";
	
	var $_PHPSHOP_ERR_MSG_CARRIER_EXIST = "ERREUR: Cet exp&eacute;diteur existe d&eacute;j&agrave;.";
        var $_PHPSHOP_ERR_MSG_CARRIER_ID_REQ = "ERREUR: S&eacute;lectionnez un exp&eacute;diteur.";
        var $_PHPSHOP_ERR_MSG_CARRIER_INUSE = "ERREUR: Au moins un taux d'exp&eacute;dition existe, effacez le taux avant l'exp&eacute;diteur";
        var $_PHPSHOP_ERR_MSG_CARRIER_NOTFOUND = "ERREUR: Impossible de trouver l'exp&eacute;diteur.";
	
	var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_REQ = "ERREUR: Choisissez un exp&eacute;diteur.";
        var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_INV = "ERREUR: Impossible de trouver un exp&eacute;diteur portant ce No.";
        var $_PHPSHOP_ERR_MSG_RATE_NAME_REQ = "ERREUR: Une description de taux est requise.";
        var $_PHPSHOP_ERR_MSG_RATE_COUNTRY_CODE_INV = "ERREUR: Le pays de destination n'est pas valide. Info : vous pouvez s&eacute;lectionner plus d'un pays en les s&eacute;parant d'un point-virgule : ';'";
        var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_START_REQ = "ERREUR: Un poids minimal est requis";
        var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_END_REQ = "ERREUR: Un poids maximal est requis";
        var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_STARTEND_INV = "ERREUR: Le poids minimal doit &ecirc;tre inf&eacute;rieur au poids maximal";
        var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_VALUE_REQ = "ERREUR: Des frais d'exp&eacute;dition sont requis";
        var $_PHPSHOP_ERR_MSG_RATE_CURRENCY_ID_INV = "ERREUR: Choisissez une devise";
	
	var $_PHPSHOP_ERR_MSG_RATE_ID_REQ = "ERREUR: Un taux d'esp&eacute;dition est requis";
    
        var $_PHPSHOP_INFO_MSG_PLEASE_SELECT = "Veuillez s&eacute;lectionner";
        var $_PHPSHOP_INFO_MSG_CARRIER = "Exp&eacute;diteur";
        var $_PHPSHOP_INFO_MSG_SHIPPING_METHOD = "Taux d'Exp&eacute;dition";
        var $_PHPSHOP_INFO_MSG_SHIPPING_PRICE = "Prix";
        var $_PHPSHOP_INFO_MSG_VAT_ZERO_LBL = "0 (-aucun-)";
	/*#####################################################
	END: MODULE SHIPPING
	#######################################################*/
	
	var $_PHPSHOP_PAYMENT_FORM_CC = "Carte de Cr&eacute;dit";
        var $_PHPSHOP_PAYMENT_FORM_USE_PP = "Utiliser un Terminal de Paiement";
        var $_PHPSHOP_PAYMENT_FORM_BANK_DEBIT = "Virement Bancaire";
        var $_PHPSHOP_PAYMENT_FORM_AO = "Adresse Seulement / Paiement &agrave; Livraison";
        var $_PHPSHOP_CHECKOUT_MSG_2 = "Veuillez choisir une Adresse d'Exp&eacute;dition !";
        var $_PHPSHOP_CHECKOUT_MSG_3 = "Veuillez choisir une M&eacute;thode d'Exp&eacute;dition !";
        var $_PHPSHOP_CHECKOUT_MSG_4 = "Veuillez choisir une M&eacute;thode de Paiement !";
        var $_PHPSHOP_CHECKOUT_MSG_99 = "Veuillez v&eacute;rifier vos informations et passer votre commande !";
        var $_PHPSHOP_CHECKOUT_ERR_NO_SHIP = "Veuillez choisir une M&eacute;thode d'Exp&eacute;dition.";
        var $_PHPSHOP_CHECKOUT_ERR_OTHER_SHIP = "Veuillez choisir une autre M&eacute;thode d'Exp&eacute;dition.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_PAYM = "Veuillez choisir une M&eacute;thode de Paiement.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR = "Veuillez saisir votre Num&eacute;ro de Carte de Cr&eacute;dit.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_CCNAME = "Veuillez saisir le Nom du Porteur de la Carte.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATE = "Le Num&eacute;ro de Carte saisi n'est pas valide.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_CCMON = "Veuillez saisir le Mois d'Expiration de la Carte.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_CCYEAR = "Veuillez saisir l'Ann&eacute;e d'Expiration de la Carte.";
        var $_PHPSHOP_CHECKOUT_ERR_CCDATE_INV = "La date d'expiration n'est pas valide.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_SHIPTO = "Veuillez choisir un Transporteur pour l'Exp&eacute;dition.";
        var $_PHPSHOP_CHECKOUT_ERR_CCNUM_INV = "Num&eacute;ro de Compte non valide.";
        var $_PHPSHOP_CHECKOUT_ERR_EMPTY_CART = "Votre panier est vide !";
        var $_PHPSHOP_CHECKOUT_ERR_NO_CARR = "ERREUR: Veuillez choisir un Transporteur pour l'Exp&eacute;dition !";
        var $_PHPSHOP_CHECKOUT_ERR_RATE_NOT_FOUND = "ERREUR: Les Taux d'Exp&eacute;dition pour ce Transporteur n'ont pas &eacute;t&eacute; trouv&eacute;s !";
        var $_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND = "ERREUR: Votre Adresse de Livraison n'a pas &eacute;t&eacute; trouv&eacute;e !";
        var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATA = "ERREUR: Il n'y a aucune donn&eacute;e &agrave; propos de votre carte de cr&eacute;dit...";
        var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR_FOUND = "ERREUR: Le Num&eacute;ro de carte de cr&eacute;dit n'a pas &eacute;t&eacute; trouv&eacute; !";
        var $_PHPSHOP_CHECKOUT_ERR_TEST = "D&eacute;sol&eacute;, mais le Num&eacute;ro de carte de cr&eacute;dit que vous avez utilis&eacute; est un Num&eacute;ro de test !";
        var $_PHPSHOP_CHECKOUT_ERR_NO_USER_DATA = "L'identifiant unique de l'utilisateur n'a pas &eacute;t&eacute; trouv&eacute; dans la base de donn&eacute;e !";
        var $_PHPSHOP_CHECKOUT_ERR_NO_BA_HOLDER_NAME = "Vous n'avez pas fourni de nom de b&eacute;n&eacute;ficiaire pour votre compte bancaire.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_IBAN = "Vous n'avez pas fourni votre num&eacute;ro IBAN.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_BA_NUM = "Vous n'avez pas fourni votre num&eacute;ro de compte bancaire.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_SORT = "Vous n'avez pas fourni votre code banque.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_NAME = "Vous n'avez pas fourni le nom de votre banque.";
        var $_PHPSHOP_CHECKOUT_ERR_NO_VALID_STEP = "Passer commande n&eacute;cessite que les diff&eacute;rentes &eacute;tapes du processus soient valid&eacute;es!";
	
        var $_PHPSHOP_CHECKOUT_MSG_LOG = "Information bancaire saisie pour un traitement ult&eacute;rieur.<br />";
	
	var $_PHPSHOP_CHECKOUT_ERR_MIN_POV = "Le panier minimum pour passer commande n'est pas encore atteint.";
        var $_PHPSHOP_CHECKOUT_ERR_MIN_POV2 = "Notre seuil minimal pour passer commande est :";
        var $_PHPSHOP_CHECKOUT_PAYMENT_CC = "Paiement par Carte de Cr&eacute;dit";
        var $_PHPSHOP_CHECKOUT_PAYMENT_OTHER = "autre M&eacute;thodes de Paiements";
        var $_PHPSHOP_CHECKOUT_PAYMENT_SELECT = "Veuillez choisir une M&eacute;thode de Paiement :";
	
	var $_PHPSHOP_STORE_FORM_MPOV = "Le panier minimum pour passer commande dans votre boutique est";
        var $_PHPSHOP_ACCOUNT_BANK_TITLE = "Informations de Compte Bancaire";
        var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR = "Num&eacute;ro de Compte";
        var $_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE = "Code Banque";
        var $_PHPSHOP_ACCOUNT_LBL_BANK_NAME = "Nom de la Banque";
        var $_PHPSHOP_ACCOUNT_LBL_BANK_IBAN = "IBAN";
        var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER = "B&eacute;n&eacute;ficiaire du Compte";
	
	var $_PHPSHOP_MODULES = "Modules";
        var $_PHPSHOP_FUNCTIONS = "Fonctions";
        var $_PHPSHOP_SPECIAL_PRODUCTS = "Produits sp&eacute;ciaux";
	
	var $_PHPSHOP_CHECKOUT_CUSTOMER_NOTE = "Veuillez nous laisser une remarque avec votre commande si vous le d&eacute;sirez";
        var $_PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE = "Remarque Client";
        var $_PHPSHOP_INCLUDING_TAX = "(Taxes \$tax % comprises)";
        var $_PHPSHOP_PLEASE_SEL_ITEM = "Veuillez choisir un article";
        var $_PHPSHOP_PRODUCT_FORM_ITEM_LBL = "Article";
	
	// DOWNLOADS
	
	var $_PHPSHOP_DOWNLOADS_TITLE = "Zone de T&eacute;l&eacute;chargement";
        var $_PHPSHOP_DOWNLOADS_START = "D&eacute;marrer le T&eacute;l&eacute;chargement";
        var $_PHPSHOP_DOWNLOADS_INFO = "Veuillez saisir le Num&eacute;ro de t&eacute;l&eacute;chargement qui vous a &eacute;t&eacute; communiqu&eacute; par email, puis cliquez sur \"D&eacute;marrer le t&eacute;l&eacute;chargement\".";
        var $_PHPSHOP_DOWNLOADS_ERR_EXP = "D&eacute;sol&eacute;, mais votre t&eacute;l&eacute;chargement a expir&eacute;";
        var $_PHPSHOP_DOWNLOADS_ERR_MAX = "D&eacute;sol&eacute;, mais vous avez atteint le nombre maximal de t&eacute;l&eacute;chargements possibles";
        var $_PHPSHOP_DOWNLOADS_ERR_INV = "Num&eacute;ro de T&eacute;l&eacute;chargement Non Valide !";
        var $_PHPSHOP_DOWNLOADS_ERR_SEND = "Impossible d'envoyer un message &agrave; ";
        var $_PHPSHOP_DOWNLOADS_SEND_MSG = "Message envoy&eacute; &agrave; ";
        var $_PHPSHOP_DOWNLOADS_SEND_SUBJ = "Information-T&eacute;l&eacute;chargement";
        var $_PHPSHOP_DOWNLOADS_SEND_MSG_1 = "Le(s)) fichier(s)) que vous avez command&eacute;(s)) est(sont)) pr&ecirc;t(s)) pour le t&eacute;l&eacute;chargement";
        var $_PHPSHOP_DOWNLOADS_SEND_MSG_2 = "Veuillez saisir ce Num&eacute;ro de T&eacute;l&eacute;chargement dans le champ pr&eacute;vu &agrave; cet effet : ";
        var $_PHPSHOP_DOWNLOADS_SEND_MSG_3 = "Le nombre maximal de t&eacute;l&eacute;chargements pour chaque fichier est : ";
        var $_PHPSHOP_DOWNLOADS_SEND_MSG_4 = "Votre acc&egrave;s au fichier expire {expire} jours apr&egrave;s le premier t&eacute;l&eacute;chargement";
        var $_PHPSHOP_DOWNLOADS_SEND_MSG_5 = "Questions ? Probl&egrave;mes ?";
        var $_PHPSHOP_DOWNLOADS_SEND_MSG_6 = "Informations de T&eacute;l&eacute;chargement de "; // e.g. Download-Info by "Storename"
        var $_PHPSHOP_PRODUCT_FORM_DOWNLOADABLE = "produit t&eacute;l&eacute;chargeable ?"; 
	
	var $_PHPSHOP_PAYPAL_THANKYOU = "Merci pour votre r&egrave;glement. 
            La transaction a &eacute;t&eacute; r&eacute;alis&eacute;e avec succ&egrave;s. Vous allez recevoir une confirmation de r&egrave;glement de la part de Pay-Pal par email.
            Vous pouvez maintenant continuer ou vous connecter sur <a href='http://www.paypal.com'>www.paypal.com</a> pour voir le d&eacute;tail de la transaction.";
        var $_PHPSHOP_PAYPAL_ERROR = "Une erreur est survenue durant le traitement de la transaction. Le statut de votre commande ne peut &ecirc;tre mis &agrave; jour.";
	
	var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER1 = "Nous vous remercions pour vos achats r&eacute;alis&eacute;s chez nous.  Les informations concernant votre commande se trouvent ci-dessous.";
        var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER2 = "Merci de faire partie de notre client&egrave;le.";
        var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER3 = "Questions ? Probl&egrave;mes ?";
        var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER4 = "La commande suivante &agrave; &eacute;t&eacute; re&ccedil;ue.";
        var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER5 = "Vous avez acc&egrave;s aux informations concernant votre commande en suivant le lien ci-dessous.";
    
        var $_PHPSHOP_CART_ERROR_NO_NEGATIVE = "Les quantit&eacute;s n&eacute;gatives ne sont pas autoris&eacute;es.";
        var $_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY = "Veuillez saisir une quantit&eacute; valide pour cet article.";
    
        var $_PHPSHOP_CART_STOCK_1 = "La quantit&eacute;e s&eacute;lectionn&eacute;e d&eacute;passe les stocks disponibles. ";
        var $_PHPSHOP_CART_STOCK_2 = "Actuellement nous avons \$product_in_stock produit(s) disponible(s). ";
        var $_PHPSHOP_CART_STOCK_3 = "Cliquez-ici pour vous inscrire sur notre liste d'attente.";
        var $_PHPSHOP_CART_SELECT_ITEM = "Veuillez choisir un article sp&eacute;cial &agrave; partir de la page de d&eacute;tails!";
    
        var $_PHPSHOP_REGISTRATION_FORM_NONE = "Aucune";
        var $_PHPSHOP_REGISTRATION_FORM_MR = "Mr.";
        var $_PHPSHOP_REGISTRATION_FORM_MRS = "Mme.";
        var $_PHPSHOP_REGISTRATION_FORM_DR = "Melle.";
        var $_PHPSHOP_REGISTRATION_FORM_PROF = "Autre.";
        var $_PHPSHOP_DEFAULT = "Civilit&eacute;";
	
	# Some labels
        var $_PHPSHOP_AFFILIATE_MOD   = "Administration Affili&eacute;s";
	
	// Affiliate List
	var $_PHPSHOP_AFFILIATE_LIST_MNU		= "Lister les Affili&eacute;s";
        var $_PHPSHOP_AFFILIATE_LIST_LBL		= "Liste des Affili&eacute;s";
        var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME	= "Nom Affili&eacute;";
        var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE = "Actif";
        var $_PHPSHOP_AFFILIATE_LIST_RATE		= "Taux";
        var $_PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL = "Total Mensuel";
        var $_PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION ="Commissions Mensuelles";
        var $_PHPSHOP_AFFILIATE_LIST_ORDERS = "Liste des Commandes";
	
	// Affiliate Email
	var $_PHPSHOP_AFFILIATE_EMAIL_MNU = "Email Affili&eacute;s";
        var $_PHPSHOP_AFFILIATE_EMAIL_LBL = "Email Affili&eacute;s";
        var $_PHPSHOP_AFFILIATE_EMAIL_WHO = "A qui envoyer le mail(* = TOUS)";
        var $_PHPSHOP_AFFILIATE_EMAIL_CONTENT = "Votre Email";
        var $_PHPSHOP_AFFILIATE_EMAIL_SUBJECT = "Le Sujet";
        var $_PHPSHOP_AFFILIATE_EMAIL_STATS	 = "Inclure les Statistiques en cours";
	
	// Affiliate Form
	var $_PHPSHOP_AFFILIATE_FORM_RATE = "Taux de Commission (pourcentage)";
        var $_PHPSHOP_AFFILIATE_FORM_ACTIVE = "Actif ?";
	
	var $_PHPSHOP_DELIVERY_TIME = "Actuellement livr&eacute; en";
        var $_PHPSHOP_DELIVERY_INFORMATION = "Informations de Livraison";
        var $_PHPSHOP_MORE_CATEGORIES = "Plus de Cat&eacute;gories";
        var $_PHPSHOP_AVAILABILITY = "Disponibilit&eacute;";
        var $_PHPSHOP_CURRENTLY_NOT_AVAILABLE = "Ce produit n'est pas disponible actuellement.";
        var $_PHPSHOP_PRODUCT_AVAILABLE_AGAIN = "Il devrait &ecirc;tre disponible de nouveau le : ";
	
	var $_PHPSHOP_STATISTIC_SUMMARY = "R&eacute;sum&eacute;";
        var $_PHPSHOP_STATISTIC_STATISTICS = "Statistiques";
        var $_PHPSHOP_STATISTIC_CUSTOMERS = "Clients";
        var $_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS = "Produits actifs";
        var $_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS = "Produits inactifs";
        var $_PHPSHOP_STATISTIC_SUM = "Somme";
        var $_PHPSHOP_STATISTIC_NEW_ORDERS = "Nouvelles Commandes";
        var $_PHPSHOP_STATISTIC_NEW_CUSTOMERS = "Nouveaux Clients";
	
	
	
	
	
	
	//Added by Aïssa Bélaid (setk@free.fr) http://aissabelaid.online.fr
	//HERE BEGIN MY PERSONNAL ADD
	//Waiting list : file /administrator/components/com_phpshop/html/shop.waiting_list.php
        var $_PHPSHOP_WAITING_LIST_MESSAGE = "Veuillez saisir votre adresse email pour &ecirc;tre pr&eacute;venu(e) d&egrave;s que ce produit sera de nouveau disponible en stock. 
                                        Votre adresse email ne sera en aucune mani&egrave;re c&eacute;d&eacute;e, vendue ou partag&eacute;e de quelques mani&egrave;re que ce soit autre 
                                        que pour vous avertir lors de nos r&eacute;tablissements de stocks.<br /><br />Merci !";
	var $_PHPSHOP_WAITING_LIST_THANKS = "Merci pour votre patience ! <br />Nous vous ferons savoir d&egrave;s que ce produit sera &agrave; nouveau disponible en stock.";
	var $_PHPSHOP_WAITING_LIST_NOTIFY_ME = "M'informer !";
	
	
	
	//Checkout : file /administrator/components/com_phpshop/html/checkout.thankyou.php
	//Print view
        var $_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW = "Imprimer la vue";
	
	
	
	
	
	
	
	//**************************Admin.show_cfg.php in apparition order ;-)**************************************//
	
	/* PAGE 1 */
	var $_PHPSHOP_ADMIN_CFG_AUTORIZE_OR_CYBERCASH = "Veuillez choisir ENTRE Authorize.net ET CyberCash";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS = " Statut du fichier de configuration :";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE = "Lecture/Ecriture";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE = "En Lecture Seule";
	
	var $_PHPSHOP_ADMIN_CFG_GLOBAL = "Global";
	var $_PHPSHOP_ADMIN_CFG_PATHANDURL = "Chemins & URL";
	var $_PHPSHOP_ADMIN_CFG_SITE = "Site";
	var $_PHPSHOP_ADMIN_CFG_SHIPPING = "Exp&eacute;dition";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT = "Commande";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS = "T&eacute;l&eacute;chargements";
	var $_PHPSHOP_ADMIN_CFG_PAYEMENTOPTIONS = "Paiements";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE = "Utiliser comme catalogue uniquement";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN = "Si la case est coch&eacute;e, les fonctions de panier sont d&eacute;sactiv&eacute;es.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES = "Afficher les prix";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN = "Cocher pour afficher les prix. Si vous utilisez comme catalogue uniquement, vous pouvez ne pas montrer les prix.";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX = "Les prix affich&eacute;s sont TTC ?";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN = "Ceci permet d'int&eacute;grer la taxe directement dans le prix, si cette option est d&eacute;coch&eacute;e, les prix seront affich&eacute;s HT.";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX = "Taxe Virtuelle";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN = "Ceci d&eacute;termine si un produit ayant un poids &agrave; 0 se voit appliquer une taxe ou non. Modifiez le fichier ps_checkout.php->calc_order_taxable() pour personnaliser cela.";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE = "Calcul des taxes :";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP = "Bas&eacute;es sur l'adresse de livraison";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR = "Bas&eacute;es sur l'adresse du vendeur";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN = "Ceci d&eacute;termine quel taux de taxe est appliqu&eacute; en fonction de la provenance :<br />
                                                <ul><li>Celui pour la r&eacute;gion / pays de provenance du propri&eacute;taire de la boutique</li><br/>
                                                <li>Ou celui pour la r&eacute;gion / pays de provenance du client.</li></ul>";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE = "Activer les taux de taxes multiples ?";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN = "Cochez ceci si vos produits peuvent &ecirc;tre touch&eacute;s par diff&eacute;rents taux de taxes (ex. 5.5% pour les livres et l'alimentaire, 19.6% pour les cd)";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE = "Soustraire les remises avant d'appliquer taxes et frais ?";
        var $_PHPSHOP_ADMIN_CFG_REVIEW = "Activer le Syst&egrave;me de Notation/Appr&eacute;ciation des Clients";
        var $_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN = "Si activ&eacute;, vous autorisez vos clients &agrave; <strong>noter les produits</strong> et <strong>&eacute;crire des appr&eacute;ciations</strong> sur ces produits. <br />
                                                                                De cette mani&egrave;re les clients partagent leurs avis et exp&eacute;riences avec les autres clients.<br />";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN = "Cochez pour soustraire remises et promotions du r&egrave;glement AVANT application des taxes et frais d'exp&eacute;dition, ou APRES seulement (case non coch&eacute;e).";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK = "Les clients peuvent laisser leurs coordonn&eacute;es bancaires ?";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN = "Cochez si vous d&eacute;sirez laisser la possibilit&eacute; &agrave; vos client de laisser leurs coordonn&eacute;es bancaires lorsqu'ils s'enregistrent.";

	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE = "Les clients peuvent-ils s&eacute;lectionner leurs &eacute;tat / r&eacute;gion ?";
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN = "Cocher pour permettre aux clients de s&eacute;lectionner leur lieu de provenance lorsqu'ils s'enregistrent.";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS = "Les clients doivent-ils accepter les Conditions d'Utilisation ?";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN = "Cochez si vous voulez que le client doive accepter les Conditions d'Utilisation avant de s'enregistrer sur la boutique.";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK = "V&eacute;rifier les Stocks ?";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN = "Cocher pour activer la gestion des stocks, et pour emp&ecirc;cher toute commande si l'article n'est pas (ou plus) disponible.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE = "Activer le Programme d'Affiliation ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN = "Cela active le suivi d'affiliation sur le devant de la boutique. Activez si vous avez ajout&eacute; des affili&eacute;s dans votre gestion de boutique.";
	
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT = "Format Email de Commande:";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT = "Email Texte";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML = "Email HTML";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN = "Ceci d&eacute;termine quel type de message est envoy&eacute; au client suite &agrave; une commande:<br />
                                                                                        <ul><li>comme un simple mail au format texte</li>
                                                                                        <li>ou un mail comportant des balises au format HTML (Attention certains clients mail ne permettent pas la visualisation d'emails au format HTML)</li></ul>";
        var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN = "Autoriser une Administration en Front de Site pour les Utilisateurs n'ayant pas acc&egrave;s &agrave; la Zone Admin ?";
        var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN = "Avec ce r&eacute;glage vous activez l'Administration Front de Site (Frontend) pour les utilisateurs de type responsables de boutique, 
                                                    mais qui ne peuvent pas acc&eacute;der &agrave; la Zone Admin du Site (Backend) (ex. Enregistr&eacute;s / Editeurs).";
	
	/* PAGE 2 */
	var $_PHPSHOP_ADMIN_CFG_URL = "URL";
	var $_PHPSHOP_ADMIN_CFG_URL_EXPLAIN = "L'adresse de votre site. Habituellement la m&ecirc;me que celle de votre site Mambo (avec le / &agrave; la fin!)";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE = "URL S&eacute;curis&eacute;e";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN = "Si vous b&eacute;n&eacute;ficiez d'un serveur s&eacute;curis&eacute;. Normalement la m&ecirc;me adresse que votre site Mambo, remplacez seulement http par https. (avec le / &agrave; la fin!)";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT = "URL du Composant";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN = "L'adresse du composant PhpShop. (avec le / &agrave; la fin!)";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE = "URL des Images";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN = "L'adresse du r&eacute;pertoire des images pour PhpShop.(avec le / &agrave; la fin!)";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH = "Chemin pour l'Administration";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN = "Le chemin du r&eacute;pertoire d'administration de PhpShop.";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH = "Chemin des Classes";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN = "Le chemin du r&eacute;pertoire classes de PhpShop.";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH = "Chemin des Pages";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN = "Le chemin du r&eacute;pertoire des pages html de PhpShop.";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH = "Chemin des Images";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN = "Le chemin du r&eacute;pertoire images pour PhpShop.";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE = "Page d'Accueil";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN = "La page qui sera affich&eacute;e par d&eacute;faut.";	
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE = "Page d'Erreur";
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN = "C'est la page qui sera utilis&eacute;e pour afficher les erreurs.";	
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE = "Page de Debuggage";
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN = "La page qui sera affich&eacute;e pour les messages de debuggage.";
	var $_PHPSHOP_ADMIN_CFG_DEBUG = "Debuggage ?";
        var $_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN = "Activer le debuggage.  La page de d&eacute;buggage sera ajout&eacute;e &agrave; la suite de toutes les pages de la boutique. Une aide pr&eacute;cieuse pour les d&eacute;veloppeurs, puisqu'elle montre le contenu du panier, les valeurs de champs, les param&egrave;tres, etc.";
	
	/* PAGE 3 */

	var $_PHPSHOP_ADMIN_CFG_FLYPAGE = "Page de D&eacute;tail";
	var $_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN = "C'est la page qui sera utilis&eacute;e par d&eacute;faut pour afficher les d&eacute;tails de votre produit.";
        var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE = "Template Cat&eacute;gorie";
	var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN = "Ceci d&eacute;termine le template de cat&eacute;gorie par d&eacute;faut pour afficher les produits dans une cat&eacute;gorie.<br />
                                                                                                      Vous pouvez cr&eacute;er de nouveaux templates en personnalisant les fichiers templates existants <br />
                                                                                                      (qui r&eacute;sident dans le r&eacute;pertoire <strong>COMPONENTPATH/html/templates/</strong> et commencent par browse_)";
        var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW = "Nombre par d&eacute;faut de produits sur une ligne";
        var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN = "Ceci d&eacute;termine le nombre de produits sur une ligne. <br />
                                                              Exemple: Si vous r&eacute;glez &agrave; 4, le template de cat&eacute;gorie affichera 4 produits par ligne";
  
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE = "Image 'aucune image'";
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN = "C'est l'image de substitution utilis&eacute;e si vous ne proposez pas d'image pour le produit.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS = "Lignes de Recherche";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN = "Le nombre de lignes retourn&eacute;es dans une liste apr&egrave;s une recherche.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 = "Couleur de Recherche 1";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN = "Sp&eacute;cifie la couleur des lignes impaires des r&eacute;sultats.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 = "Couleur de Recherche 2";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN = "Sp&eacute;cifie la couleur des lignes paires des r&eacute;sultats.";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS = "Lignes maxi";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN = "R&egrave;gle le nombre de lignes &agrave; afficher dans la boite de s&eacute;lection de Tri.";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION = "Afficher la version de phpShop en pied-de-page ?";
        var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN = "Affiche le num&eacute;ro de version de PhpShop en bas de chaque page.  Ceci est utlis&eacute; pour les d&eacute;monstrations, mais pas en production.  Habituellement non activ&eacute;.";
	
	
	/* PAGE 4 */
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD = "Choisissez votre m&eacute;thode d'exp&eacute;dition";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD = "Module standard, avec frais et transporteur ind&eacute;pendant. <strong>RECOMMAND&Eacute; !</strong>";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE = "  	Module d'exp&eacute;dition par Zone/Pays Version 1.0<br />
                                                              Pour plus d'informations, visitez <a href='http://ZephWare.com'>ZephWare.com</a><br />
                                                              pour les d&eacute;tails ou contact <a href='mailto:zephware@devcompany.com'>Mail ZephWare.com</a><br /> Cochez pour activer ce module";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS = "<a href='http://www.ups.com' target='_blank'>UPS Online(R) Tools</a> Calcul de Transport";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE = "Code d'Accès UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN = "Votre Code d'Accès &agrave; UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID = "ID Utilisateur UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN = "Le ID Utilisateur obtenu de la part d'UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD = "Mot de Passe UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN = "Le mot de passe de votre compte UPS";
	  
        var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER = "Module InterShipper. Cochez si vous avez un compte <a href='http://www.intershipper.com' target='_blank'>Intershipper.com</a> ";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE = "D&eacute;sactiver les  <strong>livraisons</strong>. Cochez si vos produits sont t&eacute;l&eacute;chageables uniquement.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD = "Mot de passe InterShipper";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD_EXPLAIN = "Le mot de passe de votre compte intershipper.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL = "Email InterShipper";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL_EXPLAIN = "Votre adresse email pour le compte intershipper.";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY = "Cl&eacute; de Cryptage";
        var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN = "Cette cl&eacute; secr&egrave;te est utlis&eacute;e pour coder les donn&eacute;es contenues dans la base de donn&eacute;es.  Cela implique de prot&eacute;ger ce fichier &agrave; la vue de quiconque.";
	
	
	/* PAGE 5 */
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR = "Activer la Progression de Commande";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN = "Activez ceci pour avoir une progression graphique lors du processus de commande ( 1 - 2 - 3 - 4  avec images).";
	
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS = "S&eacute;lectionner le type de processus de commande";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD = "<strong>Standard :</strong><br/>
              1. Adresse de livraison<br />
              2. M&eacute;thode d'exp&eacute;dition<br />
              3. M&eacute;thode de paiement<br />
              4. Validation de la commande";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 = "<strong>Processus 2:</strong><br/>
              1. Adresse de livraison<br />
              2. M&eacute;thode de paiement<br />
              3. Validation de la commande";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 = "<strong>Processus 3:</strong><br/>
              1. M&eacute;thode d'exp&eacute;dition<br />
              2. M&eacute;thode de paiement<br />
              3. Validation de la commande";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 = "<strong>Processus 4:</strong><br/>
              1. M&eacute;thode de paiement<br />
              2. Validation de la commande";
	
	
	
	/* PAGE 6 */
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS = "Activer les T&eacute;l&eacute;chargements";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN = "Cocher pour activer les t&eacute;l&eacute;chargements. Seulement si vos produits peuvent &ecirc;tre t&eacute;l&eacute;charg&eacute;s.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS = "Statut des commandes permettant le t&eacute;l&eacute;chargement";
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN = "S&eacute;lectionnez le statut de commande &agrave; partir duquel un email sera envoy&eacute; au client pour l'avertir que son t&eacute;l&eacute;chargement est disponible.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS = "Statut des commandes interdisant le t&eacute;l&eacute;chargement";
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN = "S&eacute;lectionnez le statut de commande pour lequel les t&eacute;l&eacute;chargements sont interdits au client.";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT = "Racine des Fichiers en T&eacute;l&eacute;chargement";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN = "Le chemin physique o&ugrave; sont stock&eacute;s les fichiers t&eacute;l&eacute;chargeables. (avec / &agrave; la fin!)<br>
        <span class=\"message\">Attention s&eacute;curit&eacute; : Veuillez utiliser un r&eacute;pertoire situ&eacute; EN DEHORS DE VOTRE RACINE DE SITE.</span>";
	
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX = "T&eacute;l&eacute;chargement Maximum";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN = "Saisissez le nombre maximal de t&eacute;l&eacute;chargements possibles avec la m&ecirc;me cl&eacute; de t&eacute;l&eacute;chargement (pour une commande)";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE = "Expiration du t&eacute;l&eacute;chargement";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN = "Saisissez le laps de temps <b>en secondes</b> pendant lequel le fichier est disponible pour le client. 
                  Le d&eacute;compte commence apr&egrave;s le premier t&eacute;l&eacute;chargement! quand le laps de temps expire, la cl&eacute; de t&eacute;l&eacute;chargement n'est plus valable.<br />Nota : 86400s=24h.";
	
	
	
	
        /* PAGE 7 */
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL = "Activer le paiement via IPN PayPal ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYPAL_EXPLAIN = "Permet aux clients de payer via le syst&egrave;me PayPal.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL = "Email PayPal:";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_EMAIL_EXPLAIN = "Votre adresse email PayPal. Aussi utilis&eacute;e pour recevoir les messages.";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS = "Statut des commandes pour transaction accept&eacute;";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS_EXPLAIN = "S&eacute;lectionnez le statut des commandes pour un paiement PayPal accept&eacute;. Si vous utilisez le syt&egrave;me de t&eacute;l&eacute;chargement pour vos produits: 
          S&eacute;lectionnez le statut qui permet le t&eacute;l&eacute;chargement pour le client. (ainsi le client recevra imm&eacute;diatement un email avec sa cl&eacute; de t&eacute;l&eacute;chargement).";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED = "Statut des commandes pour transaction refus&eacute;";
	var $_PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED_EXPLAIN = "S&eacute;lectionnez le statut des commandes pour un paiement PayPal refus&eacute;.";
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE = "Activer le paiement par PayMate ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_PAYMATE_EXPLAIN = "Cocher pour permettre aux clients de payer par le syst&egrave;me australien PayMate.";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME = "Nom d'Utilisateur PayMate :";
	var $_PHPSHOP_ADMIN_CFG_PAYMATE_USERNAME_EXPLAIN = "Votre compte utilisateur pour PayMate.";
	
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET = "Activer le paiement par Authorize.net ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_EXPLAIN = "Cocher pour utiliser Authorize.net sur votre boutique.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE = "Mode Test ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AUTORIZENET_TESTMODE_EXPLAIN = "S&eacute;lectionnez 'Oui' pour les tests, ou  'Non' pour &eacute;tablir des paiements r&eacute;els.";
	var $_PHPSHOP_ADMIN_CFG_YES = "Oui";
	var $_PHPSHOP_ADMIN_CFG_NO = "Non";
	
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME = "Identifiant Authorize.net";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_USERNAME_EXPLAIN = "C'est votre Identifiant Authorize.Net";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY = "cl&eacute; de Transaction Authorize.net";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_KEY_EXPLAIN = "C'est votre cl&eacute; secr&egrave;te pour effectuer des transactions avec Authorize.net";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE = "Type d'Authentification";
	var $_PHPSHOP_ADMIN_CFG_AUTORIZENET_AUTENTICATIONTYPE_EXPLAIN = "C'est le type d'authentification Authorize.Net.";
	
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH = "Activer CyberCash ?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CYBERCASH_EXPLAIN = "Cocher pour utiliser CyberCash sur votre boutique.";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND = "CyberCash MERCHANT";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_EXPLAIN = "C'est votre Identifiant CyberCash";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY = "CyberCash Merchant Key";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY_EXPLAIN = "C'est votre cl&eacute; d'identification fournie par CyberCash";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL = "CyberCash PAYMENT URL";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_URL_EXPLAIN = "C'est l'adresse s&eacute;curis&eacute;e que vous a fournie CyberCash pour les paiements";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE = "CyberCash AUTH TYPE";
	var $_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE_EXPLAIN = "C'est le type d'authentification utilis&eacute; pour se connecter &agrave; CyberCash";
	
	//That's all for the moment
	
	  /** Advanced Search feature ***/
        var $_PHPSHOP_ADVANCED_SEARCH  ="Recherche Avanc&eacute;e";
        var $_PHPSHOP_SEARCH_ALL_CATEGORIES = "Chercher dans Toutes les Cat&eacute;gories";
        var $_PHPSHOP_SEARCH_ALL_PRODINFO = "Chercher dans Toutes les Informations Produits";
        var $_PHPSHOP_SEARCH_PRODNAME = "Seulement les Noms de Produits";
        var $_PHPSHOP_SEARCH_MANU_VENDOR = "Seulement les Fabricants/Vendeurs";
        var $_PHPSHOP_SEARCH_DESCRIPTION = "Seulement les Descriptions Produits";
        var $_PHPSHOP_SEARCH_AND = "ET";
        var $_PHPSHOP_SEARCH_NOT = "PAS";
        var $_PHPSHOP_SEARCH_TEXT1 = "La premi&egrave;re liste d&eacute;roulante vous permet de s&eacute;lectionner une cat&eacute;gorie pour limiter votre recherche. 
           La seconde liste d&eacute;roulante vous permet de limiter votre recherche &agrave; une information particuli&egrave;re du produit (ex. Nom). 
           Une fois s&eacute;lectionn&eacute;e (ou laiss&eacute;e par d&eacute;faut sur 'TOUS'), saisissez votre mot-cl&eacute; pour lancer la recherche. ";
        var $_PHPSHOP_SEARCH_TEXT2 = " Vous pourrez ensuite affiner votre recherche en ajoutant des mots-cl&eacute;s et les op&eacute;rateurs ET, PAS. 
           Choisir ET permet d'obtenir des r&eacute;sultats contenant TOUS les mots-cl&eacute;s. 
           Choisir PAS permet d'obtenir des r&eacute;sultats contenant les mots-cl&eacute;s du premier champ SAUF (à l'exception de) ceux du second champ.";
        var $_PHPSHOP_ORDERBY = "Tri&eacute; Par";
    
        /*** Review feature ***/
        var $_PHPSHOP_CUSTOMER_RATING  = "Note Moyenne des Clients";
        var $_PHPSHOP_TOTAL_VOTES = "Total Votes";
        var $_PHPSHOP_CAST_VOTE = "Veuillez valider votre vote";
        var $_PHPSHOP_RATE_BUTTON = "Note";
        var $_PHPSHOP_RATE_NOM = "Noter";
        var $_PHPSHOP_REVIEWS = "Avis des Clients";
        var $_PHPSHOP_NO_REVIEWS = "Il n'y a pas encore de commentaire sur ce produit.";
        var $_PHPSHOP_WRITE_FIRST_REVIEW = "Soyez le premier &agrave; donner votre avis...";
        var $_PHPSHOP_REVIEW_LOGIN = "Veuillez vous identifier pour poster un commentaire.";
        var $_PHPSHOP_REVIEW_ERR_RATE = "Veuillez noter le produit pour compl&eacute;ter votre commentaire !";
        var $_PHPSHOP_REVIEW_ERR_COMMENT1 = "Vous pouvez ajouter quelques mots de plus. Nombre de caract&egrave;res minimum autoris&eacute;s : 100";
        var $_PHPSHOP_REVIEW_ERR_COMMENT2 = "Veuillez raccourcir votre commentaire. Nombre de caract&egrave;res maximum autoris&eacute;s : 2000";
        var $_PHPSHOP_WRITE_REVIEW = "Donnez votre avis sur ce produit !";
        var $_PHPSHOP_REVIEW_RATE = "Premi&egrave;rement: Notez le produit. S&eacute;lectionnez une note comprise entre 0 (Tr&egrave;s mauvais) et 5 &eacute;toiles (Excellent).";
        var $_PHPSHOP_REVIEW_COMMENT = "Veuillez saisir un (court) commentaire....(min. 100, max. 2000 caract&egrave;res) ";
        var $_PHPSHOP_REVIEW_COUNT = "Caract&egrave;res saisis: ";
        var $_PHPSHOP_REVIEW_SUBMIT = "Poster Commentaire";
        var $_PHPSHOP_REVIEW_ALREADYDONE = "Vous avez d&eacute;j&agrave; &eacute;crit un commentaire pour ce produit. Merci.";
        var $_PHPSHOP_REVIEW_THANKYOU = "Merci pour votre commentaire.";
        var $_PHPSHOP_COMMENT= "Commentaire";
	
        var $_PHPSHOP_PRODUCT_SEARCH_LBL = "Recherche Produit";
    
        var $_PHPSHOP_CREDITCARD_FORM_LBL = "Ajouter/Editer les Types de Cartes de Cr&eacute;dit";
        var $_PHPSHOP_CREDITCARD_NAME = "Nom Carte de Cr&eacute;dit";
        var $_PHPSHOP_CREDITCARD_CODE = "Carte de Cr&eacute;dit - Code Court";
        var $_PHPSHOP_CREDITCARD_TYPE = "Type Carte de Cr&eacute;dit";
    
        var $_PHPSHOP_CREDITCARD_LIST_LBL = "Liste des Cartes de Cr&eacute;dit";
        var $_PHPSHOP_UDATE_ADDRESS = "Mettre &agrave; jour l'Adresse";
        var $_PHPSHOP_CONTINUE_SHOPPING = "Continuer Achats";
    
        var $_PHPSHOP_THANKYOU_SUCCESS = "Votre commande a &eacute;t&eacute; prise en compte avec succ&egrave;s !";
        var $_PHPSHOP_ORDER_LINK = "Suivez ce lien pour voir les D&eacute;tails de la Commande.";
    
        var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "Le Statut de votre Commande No. {order_id} a &eacute;t&eacute; modifi&eacute;.";
        var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "Nouveau statut est :";
        var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "Pour voir les D&eacute;tails de la Commande, veuillez SVP suivre ce lien (ou le copier dans votre navigateur):";
        var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "Modification du Statut de Commande: Votre Commande {order_id}";
        var $_PHPSHOP_ORDER_LIST_NOTIFY = "Avertir le Client ?";
        var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "Veuillez d'abord modifier le Statut de la Commande !";
    
        var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "Remise sur Prix dans le Groupe des Acheteurs par d&eacute;faut (en %)";
        var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = "Un montant positif de X veut dire: si le Produit n'a aucun prix affect&eacute; &agrave; CE groupe d'acheteurs, le prix par d&eacute;faut est diminu&eacute; de X %. Un montant n&eacute;gatif a l'effet inverse";
    
        var $_PHPSHOP_PRODUCT_DISCOUNT_LBL = "Remise Produit";
        var $_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL = "Liste des Remises Produits";
        var $_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT = "Ajouter/Editer Remise Produit";
        var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT = "Montant remise";
        var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP = "Entrez le montant de la remise";
        var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE = "Type de Remise";
        var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT = "Pourcentage";
        var $_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL = "Total";
        var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP = "Le montant sera en pourcentage ou un total ?";
        var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE = "Date D&eacute;but Remise";
        var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP = "Sp&eacute;cifiez le jour &agrave; partir duquel la remise s'applique";
        var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE = "Date Fin Remise";
        var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP = "Sp&eacute;cifiez le dernier jour de la remise";
        var $_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP = "Vous pouvez utiliser le Formulaire de Remises Produits pour ajouter des remises !";
    
        var $_PHPSHOP_PRODUCT_DISCOUNT_SAVE = "Remise";
    
        var $_PHPSHOP_FLYPAGE_ENLARGE_IMAGE = "Voir Image en Grande Taille";
    
        /*********************
        Currency Display Style 
        ***********************/
        var $_PHPSHOP_CURRENCY_DISPLAY = "Style Affichage Monnaie";
        var $_PHPSHOP_CURRENCY_SYMBOL = "Symbole mon&eacute;taire";
        var $_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP = "Vous pouvez aussi utiliser les balises HTML (ex. &amp;euro;,&amp;pound;,&amp;yen;,...)";
        var $_PHPSHOP_CURRENCY_DECIMALS = "D&eacute;cimales";
        var $_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP = "Nombre de d&eacute;cimales affich&eacute;es (peut &ecirc;tre 0)<br><b>Op&eacute;ration d'arrondi si la valeur a un nombre de d&eacute;cimales diff&eacute;rent</b>";
        var $_PHPSHOP_CURRENCY_DECIMALSYMBOL = "Symbole d&eacute;cimal";
        var $_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP = "Caract&egrave;re utilis&eacute; comme symbole d&eacute;cimal";
        var $_PHPSHOP_CURRENCY_THOUSANDS = "S&eacute;parateur de milliers";
        var $_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP = "Caract&egrave;re utilis&eacute; pour s&eacute;parer les milliers (peut &ecirc;tre vide)";
        var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY = "Format Positif";
        var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP = "Format d'affichage utilis&eacute; pour les valeurs positives.<br>(Symb est l&agrave; pour le symbole de monnaie)";
        var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY = "Format N&eacute;gatif";
        var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP = "Format d'affichage utilis&eacute; pour les valeurs n&eacute;gatives.<br>(Symb est l&agrave; pour le symbole de monnaie)";
    
        var $_PHPSHOP_OTHER_LISTS = "Listes Autres Produits";
        
        /**************
        Multiple Images 
        ****************/
        var $_PHPSHOP_MORE_IMAGES = "Voir Plus d'Images";
        var $_PHPSHOP_AVAILABLE_IMAGES = "Images disponibles pour";
        var $_PHPSHOP_BACK_TO_DETAILS = "Retour aux D&eacute;tails Produit";
    
        /* FILEMANAGER */
        var $_PHPSHOP_FILEMANAGER = "Gestionnaire de fichiers";
        var $_PHPSHOP_FILEMANAGER_LIST = "Gestionnaire de fichiers::Liste Produits";
        var $_PHPSHOP_FILEMANAGER_ADD = "Ajouter Image/Fichier";
        var $_PHPSHOP_FILEMANAGER_IMAGES = "Images Affect&eacute;es";
        var $_PHPSHOP_FILEMANAGER_DOWNLOADABLE = "Est T&eacute;l&eacute;chargeable ?";
        var $_PHPSHOP_FILEMANAGER_FILES = "Fichiers Affect&eacute;s (Feuilles de calcul,...)";
        var $_PHPSHOP_FILEMANAGER_PUBLISHED = "Publi&eacute; ?";
    
        /* FILE LIST */
        var $_PHPSHOP_FILES_LIST = "Gestionnaire de fichiers::Liste Image/Fichier pour";
        var $_PHPSHOP_FILES_LIST_FILENAME = "Nom de Fichier";
        var $_PHPSHOP_FILES_LIST_FILETITLE = "Titre du Fichier";
        var $_PHPSHOP_FILES_LIST_FILETYPE = "Type de Fichier";
        var $_PHPSHOP_FILES_LIST_EDITFILE = "Editer Entr&eacute;e Fichier";
        var $_PHPSHOP_FILES_LIST_FULL_IMG = "Image Compl&egrave;te";
        var $_PHPSHOP_FILES_LIST_THUMBNAIL_IMG = "Image Vignette";
    
    
        /* FILE FORM */
        var $_PHPSHOP_FILES_FORM = "Envoyer un fichier pour";
        var $_PHPSHOP_FILES_FORM_CURRENT_FILE = "Fichier en cours";
        var $_PHPSHOP_FILES_FORM_FILE = "Fichier";
        var $_PHPSHOP_FILES_FORM_IMAGE = "Image";
        var $_PHPSHOP_FILES_FORM_UPLOAD_TO = "Envoyer vers";
        var $_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH = "Chemin par d&eacute;faut des Images Produit";
        var $_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH = "Sp&eacute;cifiez l'emplacement du fichier";
        var $_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH = "Chemin T&eacute;l&eacute;chargement (ex. pour les ventes t&eacute;l&eacute;chargeables!)";
        var $_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL = "Auto-Cr&eacute;ation Vignette ?";
        var $_PHPSHOP_FILES_FORM_FILE_PUBLISHED = "Fichier est Publi&eacute; ?";
        var $_PHPSHOP_FILES_FORM_FILE_TITLE = "Titre Fichier (ce que le client voit)";
        var $_PHPSHOP_FILES_FORM_FILE_DESC = "Description Fichier";
        var $_PHPSHOP_FILES_FORM_FILE_URL = "URL Fichier (optionnel)";
    
        /* FILE & IMAGE PROCESSING */
        var $_PHPSHOP_FILES_PATH_ERROR = "Veuillez fournir un chemin valide !";
        var $_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS = "L'Image Vignette a &eacute;t&eacute; cr&eacute;&eacute;e avec succ&egrave;s!";
        var $_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE = "IMPOSSIBLE de cr&eacute;er l'image vignette !";
        var $_PHPSHOP_FILES_UPLOAD_FAILURE = "Erreur &agrave; l'envoi Fichier/Image";
    
        var $_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE = "Impossible d'effacer le fichier d'Image Compl&egrave;te.";
        var $_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS = "Image Compl&egrave;te effac&eacute;e avec succ&egrave;s.";
        var $_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE = "Impossible d'effacer le fichier d'Image Vignette (n'existe peut &ecirc;tre pas): ";
        var $_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS = "Image Vignette effac&eacute;e avec succ&egrave;s.";
        var $_PHPSHOP_FILES_FILE_DELETE_FAILURE = "Impossible d'effacer le Fichier.";
        var $_PHPSHOP_FILES_FILE_DELETE_SUCCESS = "Fichier effac&eacute; avec succ&egrave;s.";
    
        var $_PHPSHOP_FILES_NOT_FOUND = "D&eacute;sol&eacute;, mais le fichier demand&eacute; n'a pas &eacute;t&eacute; trouv&eacute; !";
        var $_PHPSHOP_IMAGE_NOT_FOUND = "Image non trouv&eacute;e !";

        /*#####################
        MODULE COUPON
        #####################*/
    
        var $_PHPSHOP_COUPON_MOD = "Ch&egrave;que Boutique";
        var $_PHPSHOP_COUPONS = "Ch&egrave;ques Boutique";
        var $_PHPSHOP_COUPON_LIST = "Liste Ch&egrave;ques Boutique";
        var $_PHPSHOP_COUPON_ALREADY_REDEEMED = "Le Ch&egrave;que Boutique a d&eacute;j&agrave; &eacute;t&eacute; d&eacute;pens&eacute;.";
        var $_PHPSHOP_COUPON_REDEEMED = "Ch&egrave;que Boutique d&eacute;pens&eacute; ! Merci.";
        var $_PHPSHOP_COUPON_ENTER_HERE = "Si vous avez un code Ch&egrave;que Boutique, veuillez le saisir ci-dessous:";
        var $_PHPSHOP_COUPON_SUBMIT_BUTTON = "Soumettre";
        var $_PHPSHOP_COUPON_CODE_EXISTS = "Ce code Ch&egrave;que Boutique existe d&eacute;j&agrave;. Veuillez essayer de nouveau.";
        var $_PHPSHOP_COUPON_EDIT_HEADER = "Mise &agrave; Jour Ch&egrave;que Boutique";
        var $_PHPSHOP_COUPON_EDIT_HELP_TEXT = "Cliquez sur un code Ch&egrave;que Boutique pour l'&eacute;diter, ou pour supprimer un code Ch&egrave;que Boutique, s&eacute;lectionnez-le et cliquez sur Effacer:";
        var $_PHPSHOP_COUPON_CODE_HEADER = "Code";
        var $_PHPSHOP_COUPON_PERCENT_TOTAL = "Pourcent ou Total";
        var $_PHPSHOP_COUPON_TYPE = "Type Ch&egrave;que Boutique";
        var $_PHPSHOP_COUPON_TYPE_TOOLTIP = "Un Ch&egrave;que Boutique Cadeau est effac&eacute; apr&egrave;s avoir &eacute;t&eacute; utilis&eacute; comme remise sur une commande. Un Ch&egrave;que Boutique permanent peut &ecirc;tre utilis&eacute; &agrave; loisir par le client.";
        var $_PHPSHOP_COUPON_TYPE_GIFT = "Ch&egrave;que Boutique Cadeau";
        var $_PHPSHOP_COUPON_TYPE_PERMANENT = "Ch&egrave;que Boutique Permanent";
        var $_PHPSHOP_COUPON_VALUE_HEADER = "Valeur";
        var $_PHPSHOP_COUPON_DELETE_BUTTON = "Effacer Code";
        var $_PHPSHOP_COUPON_CONFIRM_DELETE = "Etes-vous sur(e) de vouloir effacer ce code ch&egrave;que boutique ?";
        var $_PHPSHOP_COUPON_COMPLETE_ALL_FIELDS = "Veuillez compl&eacute;ter tous les champs.";
        var $_PHPSHOP_COUPON_VALUE_NOT_NUMBER = "La valeur du Chèque Boutique doit être un nombre.";
        var $_PHPSHOP_COUPON_NEW_HEADER = "Nouveau Ch&egrave;que Boutique";
        var $_PHPSHOP_COUPON_COUPON_HEADER = "Code Ch&egrave;que Boutique";
        var $_PHPSHOP_COUPON_PERCENT = "Pourcentage";
        var $_PHPSHOP_COUPON_TOTAL = "Total";
        var $_PHPSHOP_COUPON_VALUE = "Valeur";
        var $_PHPSHOP_COUPON_CODE_SAVED = "Code Ch&egrave;que Boutique sauvegard&eacute;.";
        var $_PHPSHOP_COUPON_SAVE_BUTTON = "Sauver Ch&egrave;que Boutique";
        var $_PHPSHOP_COUPON_DISCOUNT = "Remise Ch&egrave;que Boutique";
        var $_PHPSHOP_COUPON_CODE_INVALID = "Code Ch&egrave;que Boutique non trouv&eacute;. Veuillez essayer de nouveau.";
        var $_PHPSHOP_COUPONS_ENABLE = "Activer Utilisation Ch&egrave;que Boutique";
        var $_PHPSHOP_COUPONS_ENABLE_EXPLAIN = "Si vous activez l'utilisation des Ch&egrave;ques Boutique, vous autorisez vos clients &agrave; utiliser des codes Ch&egrave;que Boutique pour obtenir des remises sur leurs achats.";
    
        /* Free Shipping */
        var $_PHPSHOP_FREE_SHIPPING = "Franco de Port";
        var $_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT = "Cette Commande est Franco de Port !";
        var $_PHPSHOP_FREE_SHIPPING_AMOUNT = "Montant Minimal pour un Franco de Port";
        var $_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP = "Le montant minimum - TAXES COMPRISES ! - r&eacute;pr&eacute;sentant le minimum pour un franco de port
                                                (exemple: <strong>50</strong> indique que le client ne paiera pas de transport pour toute commande
                                                de 50 euros (taxes comprises) et plus.";
        var $_PHPSHOP_YOUR_STORE = "Votre Boutique";
        var $_PHPSHOP_CONTROL_PANEL = "Panneau de Contr&ocirc;le";
    
        /* Configuration Additions */
        var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON = "Bouton - PDF";
        var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN = "Affiche ou masque le bouton PDF dans la Boutique";
        var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER = "Doit accepter les Conditions G&eacute;n&eacute;rales de Vente pour CHAQUE COMMANDE ?";
        var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN = "Cochez si vous voulez que chaque client soit oblig&eacute; d'accepter les Conditions G&eacute;n&eacute;rales de Vente lors de CHAQUE COMMANDE (avant d'&eacute;mettre toute commande).";
    
        // We need this for eCheck.net Payments
        var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE = "Type Compte Bancaire";
        var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING = "Compte Ch&egrave;que";
        var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING = "Compte Ch&egrave;que Entreprise";
        var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS = "Compte de Placement";

        var $_PHPSHOP_PAYMENT_AN_RECURRING = "Facturations R&eacute;curentes ?";
        var $_PHPSHOP_PAYMENT_AN_RECURRING_TOOLTIP = "D&eacute;finissez si vous d&eacute;sirez des facturations qui se r&eacute;p&egrave;tent p&eacute;riodiquement.";
    
        var $_PHPSHOP_INTERNAL_ERROR = "Erreur Interne au Traitement de la Demande de";
        var $_PHPSHOP_PAYMENT_ERROR = "Echec dans le Traitement du R&egrave;glement";
        var $_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS = "R&egrave;glement Trait&eacute; avec Succ&egrave;s";
    
    /* UPS Shipping Module */
    var $_PHPSHOP_UPS_RESPONSE_ERROR = "UPS n'a pas pu traiter la Demande de Co&ucirc;t de Livraison.";
    var $_PHPSHOP_UPS_SHIPPING_GUARANTEED_DAYS = "Jour(s) Garanti(s) pour la Livraison";
    var $_PHPSHOP_UPS_PICKUP_METHOD = "M&eacute;thode d'Enl&egrave;vement UPS";
    var $_PHPSHOP_UPS_PICKUP_METHOD_TOOLTIP = "Comment confiez-vous vos colis &agrave; UPS ?";
    var $_PHPSHOP_UPS_PACKAGE_TYPE = "Emballage UPS ?";
    var $_PHPSHOP_UPS_PACKAGE_TYPE_TOOLTIP = "S&eacute;lectionnez le Type d'Emballage par d&eacute;faut.";
    var $_PHPSHOP_UPS_TYPE_RESIDENTIAL = "Livraison R&eacute;sidentielle ?";
    var $_PHPSHOP_UPS_RESIDENTIAL = "R&eacute;sidentiel (RES)";
    var $_PHPSHOP_UPS_COMMERCIAL    = "Livraison Commerciale (COM)";
    var $_PHPSHOP_UPS_RESIDENTIAL_TOOLTIP = "Note pour Livraison R&eacute;sidentielle (RES) ou pour Livraison Commerciale (COM).";
    var $_PHPSHOP_UPS_HANDLING_FEE = "Frais de manutention";
    var $_PHPSHOP_UPS_HANDLING_FEE_TOOLTIP = "Vos Frais de manutention pour cette m&eacute;thode de livraison.";
    var $_PHPSHOP_UPS_TAX_CLASS = "Classe de Taxes";
    var $_PHPSHOP_UPS_TAX_CLASS_TOOLTIP = "Utiliser la classe de taxes suivante sur les frais de transport.";
    
    var $_PHPSHOP_ERROR_CODE = "Code Erreur";
    var $_PHPSHOP_ERROR_DESC = "Description Erreur";
    
    var $_PHPSHOP_CHANGE_TRANSACTION_KEY = "Afficher / Modifier la Cl&eacute; de Transaction";
    var $_PHPSHOP_CHANGE_PASSKEY_FORM = "Afficher/Modifier les Mot de Passe/Cl&eacute; de Transaction";
    var $_PHPSHOP_TYPE_PASSWORD = "Veuillez saisir votre Mot de Passe Utilisateur";
    var $_PHPSHOP_CURRENT_PASSWORD = "Mot de Passe en cours";
    var $_PHPSHOP_CURRENT_TRANSACTION_KEY = "Cl&eacute; de Transaction en cours";
    var $_PHPSHOP_CHANGE_PASSKEY_SUCCESS = "La Cl&eacute; de Transaction a &eacute;t&eacute; modifi&eacute;e avec succ&egrave;s.";
    
    var $_PHPSHOP_PAYMENT_CVV2 = "Demande/Capture Cryptograme S&eacute;curit&eacute; Carte de Cr&eacute;dit (CVV2/CVC2/CID)";
    var $_PHPSHOP_PAYMENT_CVV2_TOOLTIP = "Demander la valeur CVV2/CVC2/CID valide (trois -ou quatre- chiffres &agrave; l'arri&egrave;re de la carte de cr&eacute;dit, sur l'avant des Cartes American Express) ?";
    var $_PHPSHOP_CUSTOMER_CVV2_TOOLTIP = "Veuillez saisir les trois -ou quatre- chiffres &agrave; l'arri&egrave;re de votre carte de cr&eacute;dit (sur l'avant pour les Cartes American Express)";
    var $_PHPSHOP_CUSTOMER_CVV2_ERROR = "Vous devez saisir le Cryptograme S&eacute;curit&eacute; Carte de Cr&eacute;dit avant de continuer.";
    
    var $_PHPSHOP_PRODUCT_FORM_FILENAME = "SOIT Saisir un Nom de Fichier";
    var $_PHPSHOP_PRODUCT_FORM_FILENAME_TOOLTIP = "NOTE: Vous pouvez saisir un Nom de Fichier &agrave; cet endroit. <strong>Si vous saisissez un nom de fichier ici, aucun fichier ne sera envoy&eacute; !!! Vous devrez l'envoyer &agrave; la main via FTP !</strong>.";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD = "SOIT Envoyer un Nouveau Fichier";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD_TOOLTIP = "Vous pouvez envoyer un fichier local. Ce fichier sera le produit que vous vendez. Tout fichier existant sera remplac&eacute;.";
    
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1 = "Saisissez ici tout texte qui sera affich&eacute; au client sur la flypage produit.<br />ex.: 24 h, 48 heures, 3 &agrave; 5 jours, Sur Commande.....";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2 = "OU s&eacute;lectionnez une Image &agrave; afficher sur la Page des D&eacute;tails (flypage).<br />Les images se trouvent dans le r&eacute;pertoire <i>/components/com_phpshop/shop_image/availability</i><br />";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST = "Liste des Attributs";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Exemples pour le Formatage de la Liste des Attributs:</h4>
        <pre>Taille,XL[+1.99],M,S[-2.99];Couleur,Rouge,Vert,Jaune,CouleurPr&eacute;cieuse[=24.00];Etc,..,..</pre>
        <h4>Inclusion d'ajustements de prix &agrave; utiliser dans les modifications des Attributs Avanc&eacute;s:</h4>
        <span class='sectionname'>
        <strong>&#43;</strong> == Ajoute ce montant au prix fix&eacute;.<br />
        <strong>&#45;</strong> == Soustrait ce montant au prix fix&eacute;.<br />
        <strong>&#61;</strong> == Fixe le prix global du produit &agrave; ce montant.
      </span>";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST = "Liste des Attributs Personnalis&eacute;s";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Exemples pour le Formatage de la Liste des Attributs Personnalis&eacute;s:</h4>
        <pre>Nom;Options;...</pre>";
        
	  var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN = "Activer paiement par eProcessingNetwork.com ?";
    var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_EXPLAIN = "Utiliser eProcessingNetwork.com avec phpShop.";
    var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_TESTMODE = "Mode test ?";
    var $_PHPSHOP_ADMIN_CFG_ENABLE_EPN_TESTMODE_EXPLAIN = "S&eacute;lectionnez 'Oui' durant les tests. S&eacute;lectionnez 'Non' pour autoriser les transactions r&eacute;elles.";

    var $_PHPSHOP_ADMIN_CFG_EPN_USERNAME = "ID Login eProcessingNetwork.com";
    var $_PHPSHOP_ADMIN_CFG_EPN_USERNAME_EXPLAIN = "C'est votre ID Login eProcessingNetwork.com";
    var $_PHPSHOP_ADMIN_CFG_EPN_KEY = "Cl&eacute; de Transanction eProcessingNetwork.com";
    var $_PHPSHOP_ADMIN_CFG_EPN_KEY_EXPLAIN = "C'est votre Cl&eacute; de Transanction eProcessingNetwork.com";
    var $_PHPSHOP_ADMIN_CFG_EPN_AUTENTICATIONTYPE = "Type Authentification";
    var $_PHPSHOP_ADMIN_CFG_EPN_AUTENTICATIONTYPE_EXPLAIN = "C'est le Type d'Authentification eProcessingNetwork.com.";

    var $_PHPSHOP_MULTISELECT = "Multis&eacute;lection : utilisez la touche Ctrl + clic souris";
 
    var $_PHPSHOP_RELATED_PRODUCTS = "Produits Compl&eacute;mentaires";
    var $_PHPSHOP_RELATED_PRODUCTS_TIP = "Vous pouvez construire des Relations entre Produits en utilisant cette liste. S&eacute;lectionnez simplement un ou plusieurs produit(s) &agrave; cet endroit et vous obtiendrez des <strong>Produits Compl&eacute;mentaires</strong>.";
    
    var $_PHPSHOP_RELATED_PRODUCTS_HEADING = "Vous pourriez &ecirc;tre &eacute;galement interress&eacute;(e) par un de ces produits";
        
    var $_PHPSHOP_IMAGE_ACTION = "Action Image";
    var $_PHPSHOP_NONE = "aucune";
    
    var $_PHPSHOP_ORDER_HISTORY = "Historique Commande";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT = "Commentaire";
    var $_PHPSHOP_ORDER_HISTORY_COMMENT_EMAIL = "Commentaires sur votre Commande";
    var $_PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT = "Inclure ce commentaire ?";
    var $_PHPSHOP_ORDER_HISTORY_DATE_ADDED = "Date Ajout&eacute;e";
    var $_PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED = "Avertir Client ?";
    var $_PHPSHOP_ORDER_STATUS_CHANGE = "Statut de Commande Modifi&eacute;";
	
     /* USPS Shipping Module */
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME = "Nom d'Utilisateur USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME_TOOLTIP = "Votre nom d'utilisateur chez USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD = "Mot de passe USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD_TOOLTIP = "Votre mot de passe enregistr&eacute; chez USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER = "Serveur USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER_TOOLTIP = "Le serveur de USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH = "Chemin USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH_TOOLTIP = "Le chemin USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER = "Conteneur USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER_TOOLTIP = "Conteneur USPS shipping";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE = "Taille Emballage USPS";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE_TOOLTIP = "Taille Emballage USPS";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID = "Nombre Emballage USPS (doit &ecirc;tre 0, ne supporte pas les emballages multiples)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID_TOOLTIP = "Nombre Emballage USPS (doit &ecirc;tre 0, ne supporte pas les emballages multiples)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE = "Type USPS Shipping (Express,First Class,Priority,Parcel,BPM,Library,Media)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE_TOOLTIP = "Type USPS Shipping (Express,First Class,Priority,Parcel,BPM,Library,Media)";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_HANDLING_FEE = "Frais De Manutention";
    var $_PHPSHOP_USPS_HANDLING_FEE = "Vos Frais de manutention pour cette m&eacute;thode de livraison.";
    var $_PHPSHOP_USPS_HANDLING_FEE_TOOLTIP = "Vos Frais de manutention pour cette m&eacute;thode de livraison.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE = "Vos Frais de Manutention Internationaux pour les transports USPS.";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE_TOOLTIP = "Vos Frais de Manutention Internationaux pour les transports USPS.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE = "Vos Taux Internationaux par Livre pour les transports USPS.";
    var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE_TOOLTIP = "Vos Taux Internationaux par Livre pour les transports USPS.";
    var $_PHPSHOP_USPS_RESPONSE_ERROR = "USPS n'a pas pu traiter votre Demande de Taux de Transport.";
	    
    /** Changed Product Type - Begin*/
    /*** Product Type ***/
    var $_PHPSHOP_PARAMETERS_LBL = "Param&egrave;tres";
    var $_PHPSHOP_PRODUCT_TYPE_LBL = "Type Produit";
    var $_PHPSHOP_PRODUCT_TYPE_LIST_LBL = "Liste Type Produit";
    var $_PHPSHOP_PRODUCT_TYPE_ADDEDIT = "Ajouter/Editer Type Produit";
    // Product - Product Product Type list
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL = "Liste Type Produit pour";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_MNU = "Liste Types Produits";
    // Product - Product Product Type form
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL = "Ajouter un Type Produit pour";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_MNU = "Ajouter Type Produit";
    var $_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE = "Type Produit";
    // Product - Product Type form
    var $_PHPSHOP_PRODUCT_TYPE_FORM_NAME = "Nom Type Produit";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION = "Description Type Produit";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS = "Param&egrave;tres";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_LBL = "Information Type Produit";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH = "Publier ?";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE = "Page Parcourir Type Produit";
    var $_PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE = "Flypage Type Produit";
    // Product - Product Type Parameter list
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL = "Param&egrave;tres de Type Produit";
    // Product - Product Type Parameter form
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LBL = "Information Param&egrave;tre";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NOT_FOUND = "Type Produit non trouv&eacute; !";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME = "Nom Param&egrave;tre";
    VAR $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME_DESCRIPTION = "Ce nom sera le nom de la colonne de la table. Doit &ecirc;tre unique et sans espace.<BR>Par exemple: materiel_principal";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL = "Etiquette Param&egrave;tre";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DESCRIPTION = "Description Param&egrave;tre";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE = "Type Param&egrave;tre";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_INTEGER = "Entier";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TEXT = "Texte";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_SHORTTEXT = "Texte Court";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_FLOAT = "Virgule Flot.";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_CHAR = "Caract.";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATETIME = "Date & Heure";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE = "Date";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE_FORMAT = "AAAA-MM-JJ";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME = "Heure";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME_FORMAT = "HH:MM:SS";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_BREAK = "Ligne S&eacute;paration";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_MULTIVALUE = "Valeurs Multiples";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES = "Valeurs Possibles";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_MULTISELECT = "Afficher Valeurs Possibles en s&eacute;lection multiple ?";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES_DESCRIPTION = "<strong>Si Valeurs Possibles est choisi, le Param&egrave;tre ne peut avoir seulement que ces valeurs. Exemple pour Valeurs Possibles :</strong><BR><span class=\"sectionname\">Acier;Bois;Plastique;...</span>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT = "Valeur par D&eacute;faut";
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT_HELP_TEXT = "Pour Valeur par D&eacute;faut du Param&egrave;tre utilisez ce format:<ul><li>Date: AAAA-MM-JJ</li><li>Heure: HH:MM:SS</li><li>Date & Heure: AAAA-MM-JJ HH:MM:SS</li></ul>";
    var $_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_UNIT = "Unit&eacute;";
    
	/************************* FrontEnd ***************************/
	/** shop.parameter_search.php */
	var $_PHPSHOP_PARAMETER_SEARCH = "Recherche Avanc&eacute;e en accord avec les Param&egrave;tres";
	var $_PHPSHOP_ADVANCED_PARAMETER_SEARCH = "Parameters Search";
	var $_PHPSHOP_PARAMETER_SEARCH_TEXT1 = "Voulez-vous trouver des produits en rapport avec leurs param&egrave;tres techniques ?<BR>Vous pouvez utiliser un formulaire adéquat :";
//	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "Aucun r&eacute;sutat ne correspond &agrave; votre requ&ecirc;te.";
	var $_PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE = "I am sorry. There is no category for search.";
	/** shop.parameter_search_form.php */
	var $_PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE = "I am sorry. There is no published Product Type with this name.";
	var $_PHPSHOP_PARAMETER_SEARCH_IS_LIKE = "Contient";
	var $_PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE = "Ne Contient PAS";
	var $_PHPSHOP_PARAMETER_SEARCH_FULLTEXT = "Recherche Texte Entier";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL = "All Selected";
	var $_PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY = "Any Selected";
	var $_PHPSHOP_PARAMETER_SEARCH_RESET_FORM = "Effacer Formulaire";	
	/** shop.browse.php */
	var $_PHPSHOP_PARAMETER_SEARCH_IN_CATEGORY = "Recherche dans une Cat&eacute;gorie";
	var $_PHPSHOP_PARAMETER_SEARCH_CHANGE_PARAMETERS = "Modifier les Param&egrave;tres";
	var $_PHPSHOP_PARAMETER_SEARCH_DESCENDING_ORDER = "Ordre Descendant";
	var $_PHPSHOP_PARAMETER_SEARCH_ASCENDING_ORDER = "Ordre Ascendant";
	/** shop.product.detail */
	var $_PHPSHOP_PRODUCT_TYPE_PARAMETERS_IN_CATEGORY = "Param&egrave;tres de Cat&eacute;gorie";
	/** Changed Product Type - End*/
	
    // State form and list
    var $_PHPSHOP_STATE_LIST_MNU = "Etat Liste";
    var $_PHPSHOP_STATE_LIST_LBL = "Etat Liste pour : ";
    var $_PHPSHOP_STATE_LIST_ADD = "Ajouter/Mettre &agrave; jour un Etat";
    var $_PHPSHOP_STATE_LIST_NAME = "Nom Etat";
    var $_PHPSHOP_STATE_LIST_3_CODE = "Code Etat (3)";
    var $_PHPSHOP_STATE_LIST_2_CODE = "Code Etat (2)";
	    
    // Opposite of Discount!
    var $_PHPSHOP_FEE = "Montant";
    
    var $_PHPSHOP_PRODUCT_CLONE = "Cloner Produit";
	
    var $_PHPSHOP_CSV_SETTINGS = "R&eacute;glages";
    var $_PHPSHOP_CSV_DELIMITER = "D&eacute;limiteur";
    var $_PHPSHOP_CSV_ENCLOSURE = "Caract&egrave;re de Cl&ocirc;ture Des champs";
    var $_PHPSHOP_CSV_UPLOAD_FILE = "Envoyer un Fichier CSV";
    var $_PHPSHOP_CSV_SUBMIT_FILE = "Soumettre Fichier CSV";
    var $_PHPSHOP_CSV_FROM_DIRECTORY = "Charger depuis un r&eacute;pertoire";
    var $_PHPSHOP_CSV_FROM_SERVER = "Charger un Fichier CSV depuis le Serveur";
    var $_PHPSHOP_CSV_EXPORT_TO_FILE = "Exporter vers un Fichier CSV";
    var $_PHPSHOP_CSV_SELECT_FIELD_ORDERING = "Choisissez un Type de Classement des Champs";
    var $_PHPSHOP_CSV_DEFAULT_ORDERING = "Classement par D&eacute;faut";
    var $_PHPSHOP_CSV_CUSTOMIZED_ORDERING = "Mon Classement personnalis&eacute;";
    var $_PHPSHOP_CSV_SUBMIT_EXPORT = "Exporter tous les Produits vers un Fichier CSV";
    var $_PHPSHOP_CSV_CONFIGURATION_HEADER = "Configuration Import / Export CSV";
    var $_PHPSHOP_CSV_SAVE_CHANGES = "Sauvegarder Changements";
    var $_PHPSHOP_CSV_FIELD_NAME = "Nom Champ";
    var $_PHPSHOP_CSV_DEFAULT_VALUE = "Valeur par d&eacute;faut";
    var $_PHPSHOP_CSV_FIELD_ORDERING = "Classement Champ";
    var $_PHPSHOP_CSV_FIELD_REQUIRED = "Champ Exig&eacute; ?";
    var $_PHPSHOP_CSV_IMPORT_EXPORT = "Import/Export";
    var $_PHPSHOP_CSV_NEW_FIELD = "Ajouter un nouveau Champ";
    var $_PHPSHOP_CSV_DOCUMENTATION = "Documentation";
    
    var $_PHPSHOP_PRODUCT_NOT_FOUND = "D&eacute;sol&eacute;, mais le produit que vous avez demand&eacute; n'a pas &eacute;t&eacute; trouv&eacute; !";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS = "Afficher les Produits qui ne sont pas en Stock";
    var $_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN = "Si activ&eacute;, les Produits qui ne sont pas actuellement en Stock sont affich&eacute;s. Autrement, ces Produits sont masqu&eacute;s.";
	
}

/** @global phpShopLanguage $PHPSHOP_LANG */
$PHPSHOP_LANG =& new phpShopLanguage();
?>
