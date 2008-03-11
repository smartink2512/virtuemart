<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
* @translator soeren
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
global $VM_LANG;
$langvars = array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_USER_LIST_LBL' => 'K�ytt�j�luettelo',
	'PHPSHOP_USER_LIST_USERNAME' => 'K�ytt�j�nimi',
	'PHPSHOP_USER_LIST_FULL_NAME' => 'Koko nimi',
	'PHPSHOP_USER_LIST_GROUP' => 'Ryhm�',
	'PHPSHOP_USER_FORM_LBL' => 'Lis��/P�ivit� k�ytt�j�tiedot',
	'PHPSHOP_USER_FORM_PERMS' => 'Oikeudet',
	'PHPSHOP_USER_FORM_CUSTOMER_NUMBER' => 'Asiakasnumero/ ID',
	'PHPSHOP_MODULE_LIST_LBL' => 'Moduuliluettelo',
	'PHPSHOP_MODULE_LIST_NAME' => 'Moduulin nimi',
	'PHPSHOP_MODULE_LIST_PERMS' => 'Moduulin oikeudet',
	'PHPSHOP_MODULE_LIST_FUNCTIONS' => 'Toiminnot',
	'PHPSHOP_MODULE_FORM_LBL' => 'Moduuli Informaatio',
	'PHPSHOP_MODULE_FORM_MODULE_LABEL' => 'Moduulin nimi (Yl�valikkoon)',
	'PHPSHOP_MODULE_FORM_NAME' => 'Moduulin nimi',
	'PHPSHOP_MODULE_FORM_PERMS' => 'Moduulin oikeudet',
	'PHPSHOP_MODULE_FORM_HEADER' => 'Moduulin Header',
	'PHPSHOP_MODULE_FORM_FOOTER' => 'Moduulin Footer',
	'PHPSHOP_MODULE_FORM_MENU' => 'Moduulivalikko?',
	'PHPSHOP_MODULE_FORM_ORDER' => 'N�yt� j�rjestys',
	'PHPSHOP_MODULE_FORM_DESCRIPTION' => 'Moduulin kuvaus',
	'PHPSHOP_MODULE_FORM_LANGUAGE_CODE' => 'Kielen koodi',
	'PHPSHOP_MODULE_FORM_LANGUAGE_FILE' => 'Language File',
	'PHPSHOP_FUNCTION_LIST_LBL' => 'Toimintoluettelo',
	'PHPSHOP_FUNCTION_LIST_NAME' => 'Toiminnon nimi',
	'PHPSHOP_FUNCTION_LIST_CLASS' => 'Luokan nimi',
	'PHPSHOP_FUNCTION_LIST_METHOD' => 'Luokitustapa',
	'PHPSHOP_FUNCTION_LIST_PERMS' => 'Oikeudet',
	'PHPSHOP_FUNCTION_FORM_LBL' => 'Toiminnon tiedot',
	'PHPSHOP_FUNCTION_FORM_NAME' => 'Toiminnon nimi',
	'PHPSHOP_FUNCTION_FORM_CLASS' => 'Luokan nimi',
	'PHPSHOP_FUNCTION_FORM_METHOD' => ' Luokitustapa',
	'PHPSHOP_FUNCTION_FORM_PERMS' => 'Toiminon oikeudet',
	'PHPSHOP_FUNCTION_FORM_DESCRIPTION' => 'Toiminnon kuvaus',
	'PHPSHOP_CURRENCY_LIST_LBL' => 'Valuuttaluettelo',
	'PHPSHOP_CURRENCY_LIST_NAME' => 'Valuutan nimi',
	'PHPSHOP_CURRENCY_LIST_CODE' => 'Valuutan koodi',
	'PHPSHOP_COUNTRY_LIST_LBL' => 'Maaluettelo',
	'PHPSHOP_COUNTRY_LIST_NAME' => 'Maan nimi',
	'PHPSHOP_COUNTRY_LIST_3_CODE' => 'Maan koodi (3)',
	'PHPSHOP_COUNTRY_LIST_2_CODE' => 'Maan koodi (2)',
	'PHPSHOP_STATE_LIST_MNU' => 'Luettele osavaltiot',
	'PHPSHOP_STATE_LIST_LBL' => 'Osavaltiot: ',
	'PHPSHOP_STATE_LIST_ADD' => 'Lis��/p�ivit� osavaltio',
	'PHPSHOP_STATE_LIST_NAME' => 'Osavaltion nimi',
	'PHPSHOP_STATE_LIST_3_CODE' => 'Osavaltion koodi (3)',
	'PHPSHOP_STATE_LIST_2_CODE' => 'Osavaltion koodi (2)',
	'PHPSHOP_ADMIN_CFG_GLOBAL' => 'Yleisasetukset',
	'PHPSHOP_ADMIN_CFG_SITE' => 'Sivusto',
	'PHPSHOP_ADMIN_CFG_SHIPPING' => 'Toimitustavat',
	'PHPSHOP_ADMIN_CFG_CHECKOUT' => 'Tilausvaiheet',
	'PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS' => 'Lataukset',
	'PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE' => 'K�yt� vain katalogina',
	'PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN' => 'Jos valitset t�m�n, poistat kaikki ostoskorin toiminnot.',
	'PHPSHOP_ADMIN_CFG_SHOW_PRICES' => 'N�yt� hinnat',
	'PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN' => 'Valitse n�ytt��ksesi hinnat. K�ytt�ess��n katalogina, kaikki eiv�t halua n�ytt�� hintojaan sivuillaan.',
	'PHPSHOP_ADMIN_CFG_VIRTUAL_TAX' => 'Virtuaalivero',
	'PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN' => 'M��rittelee verotetaanko nollapainoiset tuotteet vai ei. Muokkaa ps_checkout.php->calc_order_taxable() sopivaksi.',
	'PHPSHOP_ADMIN_CFG_TAX_MODE' => 'Veron peruste:',
	'PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP' => 'Toimitusosoite',
	'PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR' => 'Saapumisosoite',
	'PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN' => 'M��rittelee veroprosentin laskettaessa veroa:<br />
	                                           <ul><li>l�hett�j�n osavaltion / maan mukaan</li>
	                                           <li>tai vastaanottajan sijainnin mukaan.</li>
	                                           <li>tai "EU mode", miss� tuotteen veroa k�ytet��n, jos asiakas on Euroopan Unioonin alueelta, muuten vero on asiakkaan osoitteen mukaan.</li></ul>',
	'PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE' => 'Mahdollista useampi veroprosentti?',
	'PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN' => 'Valitse t�m� jos teill� on tuotteita johon sovelletaan eri veroprosentti (esim. 16% kirjoille ja 22% muille)',
	'PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE' => 'V�henn� maksualennus ennen veroa/huolintaa?',
	'PHPSHOP_ADMIN_CFG_REVIEW' => 'Mahdollista asiakkaan tehd� arvostelu/pisteytys',
	'PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN' => 'Jos valittu, asiakkaat voivat <strong>pisteytt��</strong> ja <strong>kirjoittaa arvosteluja</strong> tuotteista. <br />
	                                                                            Asiakkaat voivat kirjoittaa kokemuksiaan tuotteista toisille asiakkaille.<br />',
	'PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN' => 'Ilmaisee v�hennet��nk� alennus valitulle maksulle ENNEN (ruksattu) vai J�LKEEN veron ja rahdin.',
	'PHPSHOP_ADMIN_CFG_AGREE_TERMS' => 'Kaupank�yntiehdot pit�� hyv�ksy�?',
	'PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN' => 'Valitse jos haluat asiakkaasi hyv�ksyv�n ehdot ennen rekister�itymist��n kauppaan.',
	'PHPSHOP_ADMIN_CFG_CHECK_STOCK' => 'Tarkista varasto?',
	'PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN' => 'Asettaa tarkastetaanko varastotilanne kun k�ytt�j� lis�� tuotteen ostoskoriin. 
	                                                                                      Jos asetettu, est�� k�ytt�j�� lis��m�st� enemm�n tuotetteita kuin varastotilanne sallii.',
	'PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE' => 'Mahdollista filiaaliohjelma?',
	'PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN' => 'Mahdollistaa filiaalien seurannan kaupan etusivulla. Mahdollista, mik�li olet lis�nnyt filiaaleja hallintapuolelta (backend)..',
	'PHPSHOP_ADMIN_CFG_MAIL_FORMAT' => 'S�hk�postitilauksen muoto:',
	'PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT' => 'Text mail',
	'PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML' => 'HTML mail',
	'PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN' => 'M��rittelee miten tilausvahvistuksen s�hk�posti l�hetet��n:<br />
                                                                                     	<ul><li>yksinkertainen teksti s�hk�posti</li>
                                                                                     	<li>vai html s�hk�posti jossa on kuvia.</li></ul>',
	'PHPSHOP_ADMIN_CFG_FRONTENDAMDIN' => 'Salli hallinta etupuolelta niille, joilla ei ole oikeuksia hallintapuolelle (backend)?',
	'PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN' => 'T�ll� asetuksella voit mahdollistaa (frontend) etupuolelta hallinnan niille k�ytt�jille, 
	                                                                                          jotka ovat kauppa-admineja, mutta joilla ei ole Joomla/Mambo Backend-oikeuksia (esim. Registered ja  Editor).',
	'PHPSHOP_ADMIN_CFG_URLSECURE' => 'SECUREURL',
	'PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN' => 'Suojattu URL sivuillesi. (https - kauttaviiva rivin lopussa!)',
	'PHPSHOP_ADMIN_CFG_HOMEPAGE' => 'HOMEPAGE',
	'PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN' => 'T�m� sivu ladataan oletuksena.',
	'PHPSHOP_ADMIN_CFG_ERRORPAGE' => 'ERRORPAGE',
	'PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN' => 'Oletussivu virheilmoituksille.',
	'PHPSHOP_ADMIN_CFG_DEBUG' => 'DEBUG ?',
	'PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN' => 'DEBUG? Asettaa p��lle debug tulostuksen. T�m�n ansiosta DEBUGPAGE tulostuu jokaisen sivun alareunaan. Eritt�in hy�dyllinen kaupan kehityksess�, koska n�ytt�� ostoskorin sis�ll�n, kaavakkeiden kentt�arvot jne.',
	'PHPSHOP_ADMIN_CFG_FLYPAGE' => 'FLYPAGE',
	'PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN' => 'Oletussivu tuotteen tietojen esitykseen.',
	'PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE' => 'Kategoriamallinne',
	'PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN' => 'M��rittelee oletusmallinnuksen tuotteiden esittelyyn kategoriassa.<br />
	                                                                                                    Voit luoda uusia mallinnuksia r��t�l�im�ll� olemassa olevia mallinnustiedostoja <br />
	                                                                                                    (l�ytyv�t hakemistosta <strong>COMPONENTPATH/html/templates/</strong> ja alkavat browse_)',
	'PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW' => 'Oletusm��r� tuotteita riviss�',
	'PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN' => 'M��rittelee tuotteiden m��r�n rivi� kohden. <br />
	                                                                                                Esimerkki: Jos asetat m��r�ksi 4, kategoriamallinnus n�ytt�� 4 tuotetta per rivi',
	'PHPSHOP_ADMIN_CFG_NOIMAGEPAGE' => '"no image" kuva',
	'PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN' => 'T�m� kuva n�kyy, kun tuotteelle ei ole m��ritelty kuvaa.',
	'PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION' => 'N�yt� footer ',
	'PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN' => 'N�ytt��  powered-by-mambo-phpShop kuvan.',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD' => 'Standardi toimitusamoduuli, jossa erikseen m��ritelt�viss� olevat kuljetusliikkeet ja tariffit. <strong>SUOSITELTAVA !</strong>',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE' => 'Vy�hyke toimitusmoduuli, Country Version 1.0<br />
	                                                                                                  Lis�tietoja t�st� moduulista n�et osoitteessa: <a href="http://ZephWare.com">http://ZephWare.com</a><br />
	                                                                                                  tai ota yhteytt� <a href="mailto:zephware@devcompany.com">ZephWare.com</a><br /> Valitse, jos haluat k�ytt�� moduulia.',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE' => 'Poista toimitustavan valinta. Valitse mik�li asiakkaasi ostavat ladattavia tuotteita, joita ei tarvitse l�hett��.',
	'PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR' => 'N�yt� tilausvaihepolku',
	'PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN' => 'Aseta p��lle, jos haluat tilausvaihepolun n�kyv�n asiakkaalle tilausvaiheiden aikana ( 1 - 2 - 3 - 4 graafisesti esitettyn�).',
	'PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS' => 'Valitse kauppasi tilausvaiheet',
	'PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS' => 'Salli lataukset tietokoneelle',
	'PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN' => 'Valitse mahdollistaaksesi lataukset. Vain jos haluat myyd� ladattavia tuotteita.',
	'PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS' => 'Tilauksen tila(order status), joka mahdollistaa latauksen',
	'PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN' => 'Valitse tilauksen tila(order status), jolla asiakas saa tiedon latausmahdollisuudesta.',
	'PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS' => 'Tilauksen tila(order status), joka est�� lataamisen',
	'PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN' => 'Valitse tilauksen tila(order status), joka est�� asiakasta lataamasta tiedostoa.',
	'PHPSHOP_ADMIN_CFG_DOWNLOADROOT' => 'Latauspolku',
	'PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN' => 'Fyysinen polku ladattavien tiedostojen hakemistoon. (kauttaviiva lopussa!)<br>
	    <span class="message">Turvavinkki: Jos voit, niin tallenna lataustiedostot www-sivustosi juuren yl�puolelle!</span>',
	'PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX' => 'Latausten maksimim��r�',
	'PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN' => 'Aseta enimm�ism��r� latauksille, jonka yksi lataustunnus (Download-ID) voi tehd� tilausta kohti',
	'PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE' => 'Latauksen aikaraja',
	'PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN' => 'Aseta aika <strong>sekunneissa</strong>, jonka aikana asiakkaan on suoritettava latauksensa. 
  Aika alkaa ensimm�isest� lataamisesta! Kun aika ylittyy, lataamistunnus  (download-ID) lakkaa olemasta voimassa.<br />Muista: 86400s=24h.',
	'PHPSHOP_COUPONS' => 'Kupongit',
	'PHPSHOP_COUPONS_ENABLE' => 'Mahdollista kuponkien k�ytt�',
	'PHPSHOP_COUPONS_ENABLE_EXPLAIN' => 'Mik�li mahdollistat kuponkien k�yt�n, asiakkaasi voivat k�ytt�� kuponkien numerot saadakseen alennusta ostoistaan.',
	'PHPSHOP_ADMIN_CFG_PDF_BUTTON' => 'PDF - Kuvake',
	'PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN' => 'N�yt� tai piilota PDF-kuvake kaupassa',
	'PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER' => 'Kaupank�yntiehdot pit�� hyv�ksy� JOKAISESSA TILAUKSESSA?',
	'PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN' => 'Valitse jos haluat, ett� asiakkaasi hyv�ksyy kaupanehdot JOKAISESSA TILAUKSESSA (ennen tilauksen tekoa).',
	'PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS' => 'N�yt� varastosta loppuneet tuotteet',
	'PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN' => 'T�m� aktivoituna n�ytt�� tuotteet, joita ei nyt juuri ole varastossa. Muussa tapauksessa niit� ei n�ytet�.',
	'PHPSHOP_ADMIN_CFG_SHOP_OFFLINE' => 'Kauppa on offline-tilassa?',
	'PHPSHOP_ADMIN_CFG_SHOP_OFFLINE_TIP' => 'Jos valitset t�m�n, kauppa on Offline-tilassa ja n�ytt�� alla olevan viestin.',
	'PHPSHOP_ADMIN_CFG_SHOP_OFFLINE_MSG' => 'Offline-tilan viesti',
	'PHPSHOP_ADMIN_CFG_TABLEPREFIX' => 'Prefix, kaupan tietokantatauluille',
	'PHPSHOP_ADMIN_CFG_TABLEPREFIX_TIP' => '<strong>vm</strong> on oletuksena',
	'PHPSHOP_ADMIN_CFG_NAV_AT_TOP' => 'N�yt� sivunavigaatio tuoteluettelon yl�osassa?',
	'PHPSHOP_ADMIN_CFG_NAV_AT_TOP_TIP' => 'Valinta n�ytt�� tai piilottaa sivunavigaation tuoteluettelon yl�osassa *Frontend*.',
	'PHPSHOP_ADMIN_CFG_SHOW_PRODUCT_COUNT' => 'N�yt� tuotteiden m��r�?',
	'PHPSHOP_ADMIN_CFG_SHOW_PRODUCT_COUNT_TIP' => 'N�ytt�� tuotteiden m��r�n kategorioissa. Esim. testituotteet(4)?',
	'PHPSHOP_ADMIN_CFG_DYNAMIC_THUMBNAIL_RESIZING' => 'Salli dynaamisten n�ytekuvien luonti?',
	'PHPSHOP_ADMIN_CFG_DYNAMIC_THUMBNAIL_RESIZING_TIP' => 'Kun valittu, sallit dynaamisten n�ytekuvien luonnin. Kaikki n�ytekuvat luodaan valitsemaasi kokoon
        k�ytt�en PHP\'n GD2 funktiota. (Voit tarkistaa GD2 tuen hallintapaneelista "System" -> "System Info" -> "PHP Info" -> gd.) 
        N�ytekuvien laatu on parempi kuin kuvien, jotka ovat "pienennetty" selaimessa. Uudet n�ytekuvat tallennetaan hakemistoon /shop_image/prduct/resized. Jos kuva on jo kerran pienennetty, k�ytet��n sit�. N�in kuvia ei pienennet� aina uudestaan.',
	'PHPSHOP_ADMIN_CFG_THUMBNAIL_WIDTH' => 'N�ytekuvan leveys',
	'PHPSHOP_ADMIN_CFG_THUMBNAIL_WIDTH_TIP' => 'Kuvan <strong>leveys</strong> n�ytekuvalle.',
	'PHPSHOP_ADMIN_CFG_THUMBNAIL_HEIGHT' => 'N�ytekuvan korkeus',
	'PHPSHOP_ADMIN_CFG_THUMBNAIL_HEIGHT_TIP' => 'Kuvan <strong>korkeus</strong> n�ytekuvalle.',
	'PHPSHOP_ADMIN_CFG_SHIPPING_NO_SELECTION' => 'Tee ainakin yksi valinta toimitusasetuksissa!',
	'PHPSHOP_ADMIN_CFG_PRICE_CONFIGURATION' => 'Hinnan asetukset',
	'PHPSHOP_ADMIN_CFG_PRICE_ACCESS_LEVEL' => 'Valitse ryhm� joille hinnat n�ytet��n',
	'PHPSHOP_ADMIN_CFG_PRICE_ACCESS_LEVEL_TIP' => 'Valittu ryhm� ja kaikki sit� suuremmilla oikeuksilla n�kev�t hinnan.',
	'PHPSHOP_ADMIN_CFG_PRICE_SHOW_INCLUDINGTAX' => 'N�yt� "(sis. XX% ALV)" hinnan j�lkeen?',
	'PHPSHOP_ADMIN_CFG_PRICE_SHOW_INCLUDINGTAX_TIP' => 'Kun valittu, k�ytt�j�t n�kev�t tekstin (sis. xx% ALV) kun hinnat n�ytet��n veroineen.',
	'PHPSHOP_ADMIN_CFG_PRICE_SHOW_PACKAGING_PRICELABEL' => 'N�yt� hintalappu pakkaukselle?',
	'PHPSHOP_ADMIN_CFG_PRICE_SHOW_PACKAGING_PRICELABEL_TIP' => 'Kun valittu, hintalappuun lis�t��n tuotteen yksikk�- ja pakkausarvot:<br/>
	<strong>Esim. Yksikk�hinta (10 kpl)</strong><br/>
	Muussa tapauksessa hinta n�kyy tavallisena: <strong>Hinta: xx.xx</strong>',
	'PHPSHOP_ADMIN_CFG_MORE_CORE_SETTINGS' => 'Core asetukset',
	'PHPSHOP_ADMIN_CFG_CORE_SETTINGS' => 'Core asetukset',
	'PHPSHOP_ADMIN_CFG_FRONTEND_FEATURES' => '"Frontend" ominaisuudet',
	'PHPSHOP_ADMIN_CFG_TAX_CONFIGURATION' => 'Veron asetukset',
	'PHPSHOP_ADMIN_CFG_USER_REGISTRATION_SETTINGS' => 'K�ytt�jien rekister�inti asetukset',
	'PHPSHOP_ADMIN_CFG_ALLOW_REGISTRATION' => '*User registration allowed*?',
	'PHPSHOP_ADMIN_CFG_ACCOUNT_ACTIVATION' => '*New account activation necessary*?',
	'VM_FIELDMANAGER_NAME' => 'Kent�n nimi',
	'VM_FIELDMANAGER_TITLE' => 'Kent�n nimike',
	'VM_FIELDMANAGER_TYPE' => 'Kent�n tyyppi',
	'VM_FIELDMANAGER_REQUIRED' => 'Pakollinen kentt�',
	'VM_FIELDMANAGER_PUBLISHED' => 'Julkaistu',
	'VM_FIELDMANAGER_SHOW_ON_REGISTRATION' => 'N�yt� rekister�itymis lomakkeessa',
	'VM_FIELDMANAGER_SHOW_ON_ACCOUNT' => 'N�yt� tilinyll�pito lomakkeessa',
	'VM_USERFIELD_FORM_LBL' => 'Lis�� / muokkaa k�ytt�j�kentti�',
	'VM_BROWSE_ORDERBY_DEFAULT_FIELD_LBL' => 'Oletusarvo "J�rjestys" valikossa',
	'VM_BROWSE_ORDERBY_DEFAULT_FIELD_LBL_TIP' => 'M��ritt��, mik� on tuotteiden oletusj�rjestys tuotesivuilla',
	'VM_BROWSE_ORDERBY_FIELDS_LBL' => 'Valinnaiset "J�rjestys" valinnat',
	'VM_BROWSE_ORDERBY_FIELDS_LBL_TIP' => 'Valitse "J�rjestys" valinnat, joilla k�ytt�j�t valitsevat tuotej�rjestyksen tuotesivuilla. Jos et valitse mit��n, "J�rjestys"-kentt�� ei n�ytet� ollenkaan.',
	'VM_GENERALLY_PREVENT_HTTPS' => 'Est� https-yhteys yleisill� sivuilla?',
	'VM_GENERALLY_PREVENT_HTTPS_TIP' => 'Valittuna, ostaja ohjataan takaisin <strong>http</strong> URL-sivuille, kun h�n selaa sivuja(moduuleita) jotka eiv�t ole m��ritelty k�ytt�m��n https-yhteytt�.',
	'VM_MODULES_FORCE_HTTPS' => 'Kaupan toiminnot, joissa haluat k�ytt�� https-yhteytt�',
	'VM_MODULES_FORCE_HTTPS_TIP' => 'Valitse listasta toiminnot(moduuleiden nimet).Voit k�ytt�� monivalintaa ctrl + klikkaus. N�iss� moduuleissa tullaan k�ytt�m��n https-yhteytt�.',
	'VM_SHOW_REMEMBER_ME_BOX' => 'N�yt� "Muista minut" valinta, kirjautumisessa?',
	'VM_SHOW_REMEMBER_ME_BOX_TIP' => 'Valittuna, "Muista minut" valinta n�kyy kirjauduttaessa sivustoon. Ei suositeltava silloin, kun k�ytet��n jaettua ssl yhteytt�(shared ssl), koska k�ytt�j�ev�steiden(user cookie) kanssa on silloin ongelmia.',
	'VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH' => 'Kommentin minimipituus',
	'VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH_TIP' => 'Kirjainten minimim��r�, joka asiakkaan t�ytyy kirjoittaa kommenttiin, ennen kuin se hyv�ksyt��n.',
	'VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH' => 'Kommentin maksimipituus',
	'VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH_TIP' => 'Kirjainten maksimim��r�, joka asiakkaan t�ytyy kirjoittaa kommenttiin, ennen kuin se hyv�ksyt��n.
',
	'VM_ADMIN_SHOW_EMAILFRIEND' => 'N�yt� "Suosittele yst�v�lle" linkki?',
	'VM_ADMIN_SHOW_EMAILFRIEND_TIP' => 'Valittuna, n�ytet��n linkki, josta asiakas voi l�hett�� tuotteesta suosittelun yst�v�ns� s�hk�postiim.',
	'VM_ADMIN_SHOW_PRINTICON' => 'N�yt� "Tulostus n�kym�" linkki?',
	'VM_ADMIN_SHOW_PRINTICON_TIP' => 'Valittuna, n�ytet��n linkki joka avaa sivusta tulostusversion popup-ikkunaan.',
	'VM_REVIEWS_AUTOPUBLISH' => 'Julkaise kommentit automaattisesti',
	'VM_REVIEWS_AUTOPUBLISH_TIP' => 'Valittuna, kommentit julkaistaan automaattisesti kun ne ovat lis�tty. Ei valittuna, sivun yll�pit�j� (administrator) t�ytyy julkaista ne (approve/publish).',
	'VM_ADMIN_CFG_PROXY_SETTINGS' => 'V�lityspalvelimen asetukset',
	'VM_ADMIN_CFG_PROXY_URL' => 'URL-polku v�lityspalvelimeen (proxy server)',
	'VM_ADMIN_CFG_PROXY_URL_TIP' => 'Esim: <strong>http://10.42.21.1</strong>.<br />
J�t� tyhj�ksi jos et ole varma.</strong> T�t� arvoa k�ytet��n internetyhteydess� kaupan palvelimelta (esim. kun k�ytet��n huolitsijana UPS/USPS).',
	'VM_ADMIN_CFG_PROXY_PORT' => 'Proxy portti',
	'VM_ADMIN_CFG_PROXY_PORT_TIP' => 'Porttia k�ytet��n v�lityspalvelimen yhteyteen(tavallisesti <b>80</b> tai <b>8080</b>).',
	'VM_ADMIN_CFG_PROXY_USER' => 'K�ytt�j�tunnus (Proxy username)',
	'VM_ADMIN_CFG_PROXY_USER_TIP' => 'Jos v�lityspalvelin vaatii tunnukset, lis�� k�ytt�j�tunnus t�h�n.',
	'VM_ADMIN_CFG_PROXY_PASS' => 'Salasana (Proxy password)',
	'VM_ADMIN_CFG_PROXY_PASS_TIP' => 'Jos v�lityspalvelin vaatii tunnukset, lis�� salasana t�h�n.',
	'VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO' => 'N�yt� lyhyt ilmoitus "Palautusoikeus", tilausta hyv�ksytt�ess�?',
	'VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO_TIP' => 'Monessa Euroopan maassa, kauppiaan on ilmoitettava asiakkailleen tilauksen palautus- ja purkamisehdot. Valinta n�ytt�� viestin.',
	'VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT' => 'Palautusoikeus teksti(lyhyt versio). Jos et k�yt� alla olevaa pitk�� tekstisivua, niin poista lyhyen tekstin lopusta linkkiteksti.',
	'VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT_TIP' => 'T�h�n tulee lyhyt viesti palautusoikeudesta. Se n�ytet��n asiakkaalle tilausvahvistuksessa.',
	'VM_ADMIN_ONCHECKOUT_LEGALINFO_LINK' => 'Pitk� versio palautusoikeus-tekstist�(linkki tekstisivulle(content item)).',
	'VM_ADMIN_ONCHECKOUT_LEGALINFO_LINK_TIP' => 'Valitse t�st� sivu(content item),jossa on selostus palautusoikeudesta. Jos et ole viel� tehnyt sellaista sivua, 
niin tee sivu hallintapaneelissa ja lis�� sen linkki t�ss�.',
	'VM_SELECT_THEME' => 'Valitse kaupan teema',
	'VM_SELECT_THEME_TIP' => 'Teemoilla voit muokata kaupan ulkon�k��. <br />Jos et n�e muita teemoja kuin "default", et ole asentanut muita teemoja.',
	'VM_CFG_CONTENT_PLUGINS_ENABLE' => 'Salli mambots / plugins kuvauskentiss�?',
	'VM_CFG_CONTENT_PLUGINS_ENABLE_TIP' => 'Valittuna, tuotteiden ja kategorioiden -kuvauskentiss� on k�yt�ss� kaikki julkaistut mambotit ja plugit (content mambots/plugins).',
	'VM_CFG_CURRENCY_MODULE' => 'Valitse valuutanmuunto moduuli',
	'VM_CFG_CURRENCY_MODULE_TIP' => 'T�ss� voit valita moduulin jolla muunnetaan valuutta. Moduuli hakee muuntokurssit serverilt� ja muuttaa valuutan toiseksi.',
	'PHPSHOP_ADMIN_CFG_TAX_MODE_EU' => 'Euroopan Unioni veromuoto',
	'VM_ADMIN_CFG_DOWNLOAD_KEEP_STOCKLEVEL' => '�l� v�henn� varastosta ladattavia tuotteita',
	'VM_ADMIN_CFG_DOWNLOAD_KEEP_STOCKLEVEL_TIP' => 'Valittuna, ladattavien tuotteiden varastosaldoa ei v�hennet�, kun asiakas ostaa tuotteen.',
	'VM_USERGROUP_FORM_LBL' => 'Lis��/Muokkaa k�ytt�j�ryhmi�',
	'VM_USERGROUP_NAME' => 'K�ytt�j�ryhm�n nimi',
	'VM_USERGROUP_LEVEL' => 'K�ytt�j�ryhm�n taso',
	'VM_USERGROUP_LEVEL_TIP' => 'Huom! Isompi numero tarkoittaa <b>v�hemm�n</b> oikeuksia. <b>admin</b> ryhm� on <em>taso 0</em>, storeadmin on taso 250, users on taso 500.',
	'VM_USERGROUP_LIST_LBL' => 'K�ytt�j�ryhm�luettelo',
	'VM_ADMIN_CFG_COOKIE_CHECK' => 'Salli ev�steiden (cookies) tarkistus?',
	'VM_ADMIN_CFG_COOKIE_CHECK_EXPLAIN' => 'Asetettuna, VirtueMart tarkistaa salliiko asiakkaan selain ev�steiden k�yt�n. Toiminto saattaa h�irit� Search-Engine-Friendly k�sittely� kaupan sivuilla.',
	'VM_CFG_REGISTRATION_TYPE' => 'Asiakkaan rekister�inti tyyppi',
	'VM_CFG_REGISTRATION_TYPE_TIP' => 'Valitse rekister�itymistyyppi kaupallesi!<br />
<strong>Normaali rekister�ityminen</strong><br />
T�m� on standardi rekister�itymistyyppi, jossa asiakkaan t�ytyy rekister�ity� ja valita k�ytt�j�tunnus sek� salasana.<br /><br />
<strong>Hiljainen rekister�ityminen</strong><br />
Hiljainen rekister�ityminen tarkoittaa ett� asiakkaan ei tarvitse valita tunnuksia, vaan ne luodaan automaattisesti ja l�hetet��n asiakkaan e-mail osoitteeseen.
<br /><br />
<strong>Valinnainen rekister�ityminen</strong><br />
Valinnainen rekister�ityminen antaa asiakkaan valita k�ytt��k� h�n rekister�itymist� vai ei.Jos h�n valitsee rekister�itymisen, t�ytyy h�nen valita tunnukset.
<br /><br />
<strong>Ei rekister�itymist�</strong><br />
Asiakkaan ei tarvitse, eik� h�n voi rekister�ity�.',
	'VM_CFG_REGISTRATION_TYPE_NORMAL_REGISTRATION' => 'Normaali rekister�ityminen',
	'VM_CFG_REGISTRATION_TYPE_SILENT_REGISTRATION' => 'Hiljainen rekister�ityminen',
	'VM_CFG_REGISTRATION_TYPE_OPTIONAL_REGISTRATION' => 'Valinnainen rekister�ityminen',
	'VM_CFG_REGISTRATION_TYPE_NO_REGISTRATION' => 'Ei rekister�itymist�',
	'VM_ADMIN_CFG_FEED_CONFIGURATION' => 'Sy�tteen asetukset',
	'VM_ADMIN_CFG_FEED_ENABLE' => 'Salli tuotteiden sy�te',
	'VM_ADMIN_CFG_FEED_ENABLE_TIP' => 'Asiakkaat voivat tilata sy�tteen, joka n�ytt�� valitsemansa kategorian tuotteet.',
	'VM_ADMIN_CFG_FEED_CACHE' => 'Sy�tteen v�limuistin asetukset',
	'VM_ADMIN_CFG_FEED_CACHE_ENABLE' => 'Salli v�limuisti?',
	'VM_ADMIN_CFG_FEED_CACHETIME' => 'V�limuistin p�ivitysaika (sekunneissa)',
	'VM_ADMIN_CFG_FEED_CACHE_TIP' => 'V�limuisti nopeuttaa sy�tteen toimittamista ja v�hent�� palvelimen kuormitusta, koska sy�te luodaan kerran ja tallennetaan tiedostoon.',
	'VM_ADMIN_CFG_FEED_SHOWPRICES' => 'Sis�llyt� tuotteen hinta sy�tteeseen?',
	'VM_ADMIN_CFG_FEED_SHOWPRICES_TIP' => 'N�ytt�� tuotteen hinnan sy�tteess�',
	'VM_ADMIN_CFG_FEED_SHOWDESC' => 'Sis�llyt� tuotekuvaus?',
	'VM_ADMIN_CFG_FEED_SHOWDESC_TIP' => 'N�ytt�� tuotekuvauksen sy�tteess�',
	'VM_ADMIN_CFG_FEED_SHOWIMAGES' => 'Sis�llyt� tuotekuvat sy�tteeseen?',
	'VM_ADMIN_CFG_FEED_SHOWIMAGES_TIP' => 'N�ytt�� tuotekuvat(pienet) sy�tteess�.',
	'VM_ADMIN_CFG_FEED_DESCRIPTION_TYPE' => 'Tuotekuvauksen tyyppi',
	'VM_ADMIN_CFG_FEED_DESCRIPTION_TYPE_TIP' => 'Valitse tuotekuvauksen tyyppi, joka n�ytet��n sy�tteess�.',
	'VM_ADMIN_CFG_FEED_LIMITTEXT' => 'Rajoita tuotekuvauksen pituutta?',
	'VM_ADMIN_CFG_FEED_MAX_TEXT_LENGTH' => 'Suurin merkkim��r� tuotekuvauksessa',
	'VM_ADMIN_CFG_MAX_TEXT_LENGTH_TIP' => 'T�m� on suurin merkkim��r�, joka n�ytet��n kaikkien sy�tteiden tuotekuvauksissa.',
	'VM_ADMIN_CFG_FEED_TITLE_TIP' => 'Sy�tteen otsikko(placeholder {storename} n�ytt�� kaupan nimen)',
	'VM_ADMIN_CFG_FEED_TITLE_CATEGORIES_TIP' => 'Kategoriasy�tteen otsikko (\'{catname}\' n�ytt�� kategorian nimen, {storename} n�ytt�� kaupan nimen)',
	'VM_ADMIN_CFG_FEED_TITLE' => 'Sy�tteen otsikko',
	'VM_ADMIN_CFG_FEED_TITLE_CATEGORIES' => 'Sy�tteen otsikko kategorioille',
	'VM_ADMIN_SECURITY' => 'Turvallisuus',
	'VM_ADMIN_SECURITY_SETTINGS' => 'Turva-asetukset',
	'VM_CFG_ENABLE_FEATURE' => 'Ota k�ytt��n t�m� toiminto',
	'VM_CFG_CHECKOUT_SHOWSTEP_TIP' => 'T�ss� voit ottaa k�ytt��n, poistaa k�yt�st� ja uudelleenj�rjest�� tilausvaiheet. Voit n�ytt�� useampia vaiheita yhdell� sivulla antamalla niille saman vaihenumeron.',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_FLEX' => 'Flex Shipping. Fixed shipping cost to set base value of order with percentage of total sale above base value',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_SHIPVALUE' => 'Shipping based on order totals. Fixed shipping costs based on values entered in configuration.',
	'VM_CFG_CHECKOUT_SHOWSTEPINCHECKOUT' => 'N�yt� tilausvaiheessa: %s .',
	'VM_ADMIN_ENCRYPTION_KEY' => 'Salausavain',
	'VM_ADMIN_ENCRYPTION_KEY_TIP' => 'K�ytet��n tallentamaan ja hakemaan salattua tietoa tietokannasta(mm. luottokorttitiedot).',
	'VM_ADMIN_STORE_CREDITCARD_DATA' => 'Tallenna luottokorttitiedot?',
	'VM_ADMIN_STORE_CREDITCARD_DATA_TIP' => 'VirtueMart tallentaa luottokorttitiedot salattuina tietokantaan. T�m� tehd��n, vaikka luottokorttitiedot k�sitell��n  ulkoisella  palvelimella. <strong>Jos luottokorttitietoja ei k�sitell� manuaalisesti tilauksen j�lkeen, poista t�m� toiminto k�yt�st�.</strong>',
	'VM_USERFIELDS_URL_ONLY' => 'Vain URL',
	'VM_USERFIELDS_HYPERTEXT_URL' => 'Hyperteksti ja URL',
	'VM_FIELDS_TEXTFIELD' => 'Tekstikentt�',
	'VM_FIELDS_CHECKBOX_SINGLE' => 'Check Box (Yksivalinta)',
	'VM_FIELDS_CHECKBOX_MULTIPLE' => 'Check Box (Monivalinta)',
	'VM_FIELDS_DATE' => 'P�iv�ys',
	'VM_FIELDS_DROPDOWN_SINGLE' => 'Pudotusvalikko (Yksivalinta)',
	'VM_FIELDS_DROPDOWN_MULTIPLE' => 'Pudotusvalikko (Monivalinta)',
	'VM_FIELDS_EMAIL' => 'S�hk�postiosoite',
	'VM_FIELDS_EUVATID' => 'EU VAT�numero(ID)',
	'VM_FIELDS_EDITORAREA' => 'Editorin tekstialue',
	'VM_FIELDS_TEXTAREA' => 'Tekstialue',
	'VM_FIELDS_RADIOBUTTON' => 'Radionappi',
	'VM_FIELDS_WEBADDRESS' => 'Web-osoite',
	'VM_FIELDS_DELIMITER' => '=== Kentt�joukon rajamerkki ===',
	'VM_FIELDS_NEWSLETTER' => 'Uutiskirjeen tilaus',
	'VM_USERFIELDS_READONLY' => 'Vain lukuoikeus',
	'VM_USERFIELDS_SIZE' => 'Kent�n koko',
	'VM_USERFIELDS_MAXLENGTH' => 'Suurin pituus',
	'VM_USERFIELDS_DESCRIPTION' => 'Kuvaus, teksti tai HTML-koodi',
	'VM_USERFIELDS_COLUMNS' => 'Sarakkeita',
	'VM_USERFIELDS_ROWS' => 'Rivej�',
	'VM_USERFIELDS_EUVATID_MOVESHOPPER' => 'Siirr� asiakas ostajaryhm��n EU VAT ID:n onnistuneella vahvistuksella',
	'VM_USERFIELDS_ADDVALUES_TIP' => 'K�ytt�k�� alla olevaa taulukkoa arvojen lis��miseen.',
	'VM_ADMIN_CFG_DISPLAY' => 'Toimintojen n�ytt�(Display)',
	'VM_ADMIN_CFG_LAYOUT' => 'Ulkoasu(Layout)',
	'VM_ADMIN_CFG_THEME_SETTINGS' => 'Teeman asetukset',
	'VM_ADMIN_CFG_THEME_PARAMETERS' => 'Parametrit',
	'VM_ADMIN_ENCRYPTION_FUNCTION' => 'Salaustoiminto',
	'VM_ADMIN_ENCRYPTION_FUNCTION_TIP' => 'Valitse salaustoiminto, jota k�ytet��n ennen arkaluontaisten tietojen tallentamiseen tietokantaan. AES_ENCRYPT is suositus, koska se on turvallisin. ENCODE ei tuota niin hyv�� salausta.',
	'SAVE_PERMISSIONS' => 'Tallenna oikeudet',
	'VM_ADMIN_THEME_CFG_NOT_EXISTS' => 'T�lle teemasivupohjalle ei l�ydy asetustiedostoa. Asetusten muokkaaminen ei onnistu.',
	'VM_ADMIN_THEME_NOT_EXISTS' => 'Teemaa "{theme}" ei l�ydy.',
	'VM_USERFIELDS_ADDVALUE' => 'Lis�� arvo(Value)',
	'VM_USERFIELDS_TITLE' => 'Nimike',
	'VM_USERFIELDS_VALUE' => 'Valinta arvo(Value)',
	'VM_USER_FORM_LASTVISIT_NEVER' => 'Ei koskaan',
	'VM_USER_FORM_TAB_GENERALINFO' => 'Yleiset k�ytt�j�tiedot',
	'VM_USER_FORM_LEGEND_USERDETAILS' => 'K�ytt�j�n tiedot',
	'VM_USER_FORM_LEGEND_PARAMETERS' => 'Parametrit',
	'VM_USER_FORM_LEGEND_CONTACTINFO' => 'Yhteystiedot',
	'VM_USER_FORM_NAME' => 'Nimi',
	'VM_USER_FORM_USERNAME' => 'K�ytt�j�nimi',
	'VM_USER_FORM_EMAIL' => 'S�hk�posti',
	'VM_USER_FORM_NEWPASSWORD' => 'Uusi salasana',
	'VM_USER_FORM_VERIFYPASSWORD' => 'Vahvista salasana',
	'VM_USER_FORM_GROUP' => 'Ryhm�',
	'VM_USER_FORM_BLOCKUSER' => 'Est� tunnuksen k�ytt�',
	'VM_USER_FORM_RECEIVESYSTEMEMAILS' => 'Vastaanota j�rjestelm�n s�hk�postit',
	'VM_USER_FORM_REGISTERDATE' => 'Rekister�intip�iv�',
	'VM_USER_FORM_LASTVISITDATE' => 'Viimeksi kirjautunut',
	'VM_USER_FORM_NOCONTACTDETAILS_1' => 'K�ytt�j��n ei ole linkitetty yhteystietoja:',
	'VM_USER_FORM_NOCONTACTDETAILS_2' => 'Katso Components -> Contact -> Manage Contacts.',
	'VM_USER_FORM_CONTACTDETAILS_NAME' => 'Nimi',
	'VM_USER_FORM_CONTACTDETAILS_POSITION' => 'Asema',
	'VM_USER_FORM_CONTACTDETAILS_TELEPHONE' => 'Puhelin',
	'VM_USER_FORM_CONTACTDETAILS_FAX' => 'Faksi',
	'VM_USER_FORM_CONTACTDETAILS_CHANGEBUTTON' => 'Muuta yhteystietoja',
	'VM_ADMIN_CFG_LOGFILE_HEADER' => 'Lokitiedoston asetukset',
	'VM_ADMIN_CFG_LOGFILE_ENABLED' => 'Aktivoi lokitiedostoon kirjoitus?',
	'VM_ADMIN_CFG_LOGFILE_ENABLED_EXPLAIN' => 'Ei valittuna, lokitiedostoon ei kirjoiteta ja vmFileLogger voidaan kutsua ilman virheit�.',
	'VM_ADMIN_CFG_LOGFILE_NAME' => 'Lokitiedoston nimi',
	'VM_ADMIN_CFG_LOGFILE_NAME_EXPLAIN' => 'Nimi (ja polku lokitiedoston). T�ytyy olla luku- ja kirjoitusoikeudet.',
	'VM_ADMIN_CFG_LOGFILE_LEVEL' => 'Lokin taso',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_EXPLAIN' => 'Loki viestit t�m�n prioriteettikynnyksen yl�puolella, sivuutetaan.',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_TIP' => 'TIP - 8',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_DEBUG' => 'DEBUG - 7',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_INFO' => 'INFO - 6',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_NOTICE' => 'ILMOITUS - 5',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_WARNING' => 'VAROITUS - 4',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_ERR' => 'VIRHE - 3',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_CRIT' => 'KRIITTINEN - 2',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_ALERT' => 'H�LYTYS - 1',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_EMERG' => 'VAKAVAH�LYTYS - 0',
	'VM_ADMIN_CFG_LOGFILE_FORMAT' => 'Lokitiedoston muoto',
	'VM_ADMIN_CFG_LOGFILE_FORMAT_EXPLAIN' => 'Yksil�llisen lokitiedoston sis�lt�kent�t.',
	'VM_ADMIN_CFG_LOGFILE_FORMAT_EXPLAIN_EXTRA' => 'Lokitiedoston sis�lt�kent�t voivat olla: %{timestamp} %{ident} [%{priority}] [%{remoteip}] [%{username}] %{message} %{vmsessionid}.',
	'VM_ADMIN_CFG_LOGFILE_ERROR' => 'Ei voida luoda tai kirjoittaa lokitiedostoon. Muuta oikeudet tai ota yhteytt� administratoriin tai web-serverin yll�pit�j��n.',
	'VM_ADMIN_CFG_DEBUG_MODE_ENABLED' => 'K�yt� debug-toimintoa?',
	'VM_ADMIN_CFG_DEBUG_IP_ENABLED' => 'Rajaa IP-osoitteen mukaan?',
	'VM_ADMIN_CFG_DEBUG_IP_ENABLED_EXPLAIN' => 'Rajoittaa debug-toiminnon n�kym��n vain kyseiselle IP-osoitteelle, muut eiv�t n�e debug-toimintoa?',
	'VM_ADMIN_CFG_DEBUG_IP_ADDRESS' => 'Asiakkaan IP osoite',
	'VM_ADMIN_CFG_DEBUG_IP_ADDRESS_EXPLAIN' => 'Jos t�m� asetus on aktivoitu ja Ip-osoite annettu, niin debug-toiminto n�kyy vain kyseiselle IP-osoitteelle, muut eiv�t n�e debug-toimintoa.',
	'VM_FIELDMANAGER_SHOW_ON_SHIPPING' => 'N�yt� toimitustiedoissa',
	'VM_USER_NOSHIPPINGADDR' => 'No shipping addresses.',
	'VM_UPDATE_CHECK_LBL' => 'VirtueMart Update Check',
	'VM_UPDATE_CHECK_VERSION_INSTALLED' => 'VirtueMart Version installed here',
	'VM_UPDATE_CHECK_LATEST_VERSION' => 'Latest VirtueMart Version',
	'VM_UPDATE_CHECK_CHECKNOW' => 'Check now!',
	'VM_UPDATE_CHECK_DLUPDATE' => 'Download Update',
	'VM_UPDATE_CHECK_CHECKING' => 'Checking...',
	'VM_UPDATE_CHECK_CHECK' => 'Check',
	'VM_UPDATE_NOTDOWNLOADED' => 'The Update Package could not be downloaded.',
	'VM_UPDATE_PREVIEW_LBL' => 'VirtueMart Update Preview',
	'VM_UPDATE_WARNING_TITLE' => 'General Warning',
	'VM_UPDATE_WARNING_TEXT' => 'Installing an Update for VirtueMart using a Patch Package can cause damage on your site 
if you have already modified some files of the VirtueMart component. The Patching Process will overwrite all the files listed below - it won\'t just apply smaller changes (diff), but replace the existing file with the new one. If you have modified VirtueMart files on your own, this can lead to inconsistent files and missing class/function dependencies.',
	'VM_UPDATE_PATCH_DETAILS' => 'Patch Details',
	'VM_UPDATE_PATCH_DESCRIPTION' => 'Description',
	'VM_UPDATE_PATCH_DATE' => 'Release Date',
	'VM_UPDATE_PATCH_FILESTOUPDATE' => 'Files to be updated',
	'VM_UPDATE_PATCH_STATUS' => 'Status',
	'VM_UPDATE_PATCH_WRITABLE' => 'Writable',
	'VM_UPDATE_PATCH_UNWRITABLE' => 'File/Directory not writable',
	'VM_UPDATE_PATCH_QUERYTOEXEC' => 'Queries to be executed on the Database',
	'VM_UPDATE_PATCH_CONFIRM_TEXT' => 'I have read the <a href="#warning">Warning</a> and I\'m sure to apply the Patch Package to my VirtueMart Installation now.',
	'VM_UPDATE_PATCH_APPLY' => 'Apply Patch now',
	'VM_UPDATE_PATCH_ERR_UNWRITABLE' => 'Not all files/directories which need to be updated are writable. Please correct the permissions first.',
	'VM_UPDATE_PATCH_PLEASEMARK' => 'Please mark the checkbox before you apply the Patch.',
	'VM_UPDATE_RESULT_TITLE' => 'Currently Installed Version',
	'VM_FIELDS_CAPTCHA' => 'Captcha Field (using com_securityimages)',
	'VM_FIELDS_AGEVERIFICATION' => 'Age Verification (Date Select Fields)',
	'VM_FIELDS_AGEVERIFICATION_MINIMUM' => 'Specify the minimum Age'
); $VM_LANG->initModule( 'admin', $langvars );
?>