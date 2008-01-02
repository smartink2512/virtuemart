<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : italian.php 1071 2007-12-03 08:42:28Z thepisu $
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
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
$VM_LANG->initModule('product',array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_MODULE_LIST_ORDER' => 'Ordine Lista',
	'PHPSHOP_PRODUCT_INVENTORY_LBL' => 'Magazzino Prodotti',
	'PHPSHOP_PRODUCT_INVENTORY_STOCK' => 'Numero',
	'PHPSHOP_PRODUCT_INVENTORY_WEIGHT' => 'Peso',
	'PHPSHOP_PRODUCT_LIST_PUBLISH' => 'Pubblica',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE' => 'Cerca prodotto',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRODUCT' => 'modificato',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRICE' => 'per prezzo modificato',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_WITHOUTPRICE' => 'senza prezzo',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_AFTER' => 'Successivo',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_BEFORE' => 'Precedente',
	'PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE' => 'Visualizza l\'attuale flypage del prodotto nel negozio',
	'PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL' => 'Nuovo Prodotto',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL' => 'Informazioni Prodotto',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL' => 'Stato Prodotto',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL' => 'Dimensioni e Peso Prodotto',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL' => 'Immagini Prodotto',
	'PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL' => 'Modifica Elemento',
	'PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL' => 'Informazioni Elemento',
	'PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL' => 'Stato Elemento',
	'PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL' => 'Dimensioni e Peso Elemento',
	'PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL' => 'Immagini Elemento',
	'PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL' => 'Per aggiornare l\'immagine, inserisci il percorso della nuova.',
	'PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL' => 'Elimina immagine corrente',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL' => 'Elementi Prodotto',
	'PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL' => 'Attributi Elemento',
	'PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG' => 'Sei sicuro di voler cancellare questo prodotto\\ne gli elementi correlati?',
	'PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG' => 'Sei sicuro di voler cancellare questo Elemento?',
	'PHPSHOP_PRODUCT_FORM_MANUFACTURER' => 'Produttore',
	'PHPSHOP_PRODUCT_FORM_SKU' => 'COD.',
	'PHPSHOP_PRODUCT_FORM_NAME' => 'Nome',
	'PHPSHOP_PRODUCT_FORM_CATEGORY' => 'Categoria',
	'PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE' => 'Data Disponibilit�',
	'PHPSHOP_PRODUCT_FORM_SPECIAL' => 'Promo',
	'PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE' => 'Tipo Sconto',
	'PHPSHOP_PRODUCT_FORM_PUBLISH' => 'Pubblico?',
	'PHPSHOP_PRODUCT_FORM_LENGTH' => 'Lunghezza',
	'PHPSHOP_PRODUCT_FORM_WIDTH' => 'Larghezza',
	'PHPSHOP_PRODUCT_FORM_HEIGHT' => 'Altezza',
	'PHPSHOP_PRODUCT_FORM_DIMENSION_UOM' => 'Unit� di misura',
	'PHPSHOP_PRODUCT_FORM_WEIGHT_UOM' => 'Unit� di misura',
	'PHPSHOP_PRODUCT_FORM_FULL_IMAGE' => 'Immagine',
	'PHPSHOP_PRODUCT_FORM_WEIGHT_UOM_DEFAULT' => 'Kg',
	'PHPSHOP_PRODUCT_FORM_DIMENSION_UOM_DEFAULT' => 'cm',
	'PHPSHOP_PRODUCT_FORM_PACKAGING' => 'Unit� per Imballaggio',
	'PHPSHOP_PRODUCT_FORM_PACKAGING_DESCRIPTION' => 'Qui potrete inserire una quantit� per gli imballaggi. (max. 65535)',
	'PHPSHOP_PRODUCT_FORM_BOX' => 'Quantit� nella Scatola',
	'PHPSHOP_PRODUCT_FORM_BOX_DESCRIPTION' => 'Qui potrete inserire una quantit� per gli oggetti nella scatola. (max. 65535)',
	'PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL' => 'Risultati Aggiunta Prodotto',
	'PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL' => 'Risultati Modifica Prodotto',
	'PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL' => 'Risultati Aggiunta Elemento',
	'PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL' => 'Risultati Modifica Elemento',
	'PHPSHOP_CATEGORY_FORM_LBL' => 'Informazioni Categoria',
	'PHPSHOP_CATEGORY_FORM_NAME' => 'Nome Categoria',
	'PHPSHOP_CATEGORY_FORM_PARENT' => 'Livello superiore',
	'PHPSHOP_CATEGORY_FORM_DESCRIPTION' => 'Descrizione Categoria',
	'PHPSHOP_CATEGORY_FORM_PUBLISH' => 'Pubblico?',
	'PHPSHOP_CATEGORY_FORM_FLYPAGE' => 'Flypage Categoria<BR>',
	'PHPSHOP_ATTRIBUTE_LIST_LBL' => 'Lista degli Attributi per',
	'PHPSHOP_ATTRIBUTE_LIST_NAME' => 'Nome Attributo',
	'PHPSHOP_ATTRIBUTE_LIST_ORDER' => 'Ordine Lista',
	'PHPSHOP_ATTRIBUTE_FORM_LBL' => 'Modulo Attributi',
	'PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT' => 'Nuovo Attributo per il Prodotto',
	'PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT' => 'Modifica Attributo per il Prodotto',
	'PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM' => 'Nuovo Attributo per l\'Elemento',
	'PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM' => 'Modifica Attributo per l\'Elemento',
	'PHPSHOP_ATTRIBUTE_FORM_NAME' => 'Nome Attributo',
	'PHPSHOP_ATTRIBUTE_FORM_ORDER' => 'Ordine Lista',
	'PHPSHOP_PRICE_LIST_FOR_LBL' => 'Prezzo per',
	'PHPSHOP_PRICE_LIST_GROUP_NAME' => 'Nome Gruppo',
	'PHPSHOP_PRICE_LIST_PRICE' => 'Prezzo',
	'PHPSHOP_PRODUCT_LIST_CURRENCY' => 'Valuta',
	'PHPSHOP_PRICE_FORM_LBL' => 'Informazioni Prezzo',
	'PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT' => 'Nuovo Prezzo per il Prodotto',
	'PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT' => 'Modifica Prezzo per il Prodotto',
	'PHPSHOP_PRICE_FORM_NEW_FOR_ITEM' => 'Nuovo Prezzo per l\'Elemento',
	'PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM' => 'Modifica Prezzo per l\'Elemento',
	'PHPSHOP_PRICE_FORM_PRICE' => 'Prezzo',
	'PHPSHOP_PRICE_FORM_CURRENCY' => 'Valuta',
	'PHPSHOP_PRICE_FORM_GROUP' => 'Gruppo di Acquisto',
	'PHPSHOP_LEAVE_BLANK' => '(Lascia VUOTO se non hai un file .php per questo!)',
	'PHPSHOP_PRODUCT_FORM_ITEM_LBL' => 'Articolo',
	'PHPSHOP_PRODUCT_DISCOUNT_STARTDATE' => 'Data d\'inizio dello sconto',
	'PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP' => 'Specifica il giorno in cui inizia lo sconto',
	'PHPSHOP_PRODUCT_DISCOUNT_ENDDATE' => 'Data di termine dello sconto',
	'PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP' => 'Specifica il giorno in cui termina lo sconto',
	'PHPSHOP_FILEMANAGER_PUBLISHED' => 'Pubblicato?',
	'PHPSHOP_FILES_LIST' => 'FileManager::Immagine/Elenco File per',
	'PHPSHOP_FILES_LIST_FILENAME' => 'Nome File',
	'PHPSHOP_FILES_LIST_FILETITLE' => 'Titolo File',
	'PHPSHOP_FILES_LIST_FILETYPE' => 'Tipo File',
	'PHPSHOP_FILES_LIST_FULL_IMG' => 'Immagine a Dimensioni Reali',
	'PHPSHOP_FILES_LIST_THUMBNAIL_IMG' => 'Miniature Immagini',
	'PHPSHOP_FILES_FORM' => 'Carica un File per',
	'PHPSHOP_FILES_FORM_CURRENT_FILE' => 'File Attuale',
	'PHPSHOP_FILES_FORM_FILE' => 'File',
	'PHPSHOP_FILES_FORM_IMAGE' => 'Immagine',
	'PHPSHOP_FILES_FORM_UPLOAD_TO' => 'Carica su',
	'PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH' => 'Percorso predefinito Immagini Prodotto',
	'PHPSHOP_FILES_FORM_UPLOAD_OWNPATH' => 'Specifica la collocazione del file',
	'PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH' => 'Percorso Download (per i prodotti scaricabili!)',
	'PHPSHOP_FILES_FORM_AUTO_THUMBNAIL' => 'Miniatura automatica?',
	'PHPSHOP_FILES_FORM_FILE_PUBLISHED' => 'File pubblicato?',
	'PHPSHOP_FILES_FORM_FILE_TITLE' => 'Titolo File (quello che vede il Cliente)',
	'PHPSHOP_FILES_FORM_FILE_URL' => 'URL File (opzionale)',
	'PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1' => 'Inserisci qui il testo che vuoi venga visualizzato sulla pagina di descrizione del prodotto.<br />es.: 24 ore, 48 ore, 3 - 5 giorni, Su ordinazione.....',
	'PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2' => 'OPPURE seleziona un\'immagine da visualizzare nella pagina di dettaglio del prodotto (flypage).<br />Le immagini risiedono nella cartella <i>%s</i><br />',
	'PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES' => '<h4>Esempi per il formato lista attributi:</h4>
        <pre><strong>Taglia</strong>,XL[+1.99],M,S[-2.99];
        <strong>Colori</strong>,Rosso,Verde,Giallo,ColoreCostoso[=24.00]<strong>;ecc.,..,..
        </pre>
        <h4>Regolazioni sul prezzo per l\'utilizzo della modifica degli attributi avanzata:</h4>
        <pre><strong>+</strong> == Aggiungi questo ammontare al prezzo configurato.<br />
        <strong>-</strong> == Sottrai questo ammontare dal prezzo configurato.<br />
        <strong>=</strong> == Imposta il prezzo del prodotto a questo ammontare.
        </span>',
	'PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES' => '<h4>Esempi per il formato lista attributi personalizzata:</h4>
        <pre><strong>Nome;Extra;</strong>...</pre>',
	'PHPSHOP_IMAGE_ACTION' => 'Azione per l\'immagine',
	'PHPSHOP_PARAMETERS_LBL' => 'Parametri',
	'PHPSHOP_PRODUCT_TYPE_LBL' => 'Tipo Prodotto',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL' => 'Lista Tipo Prodotto per',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL' => 'Aggiungi Tipo Prodotto per',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE' => 'Tipo Prodotto',
	'PHPSHOP_PRODUCT_TYPE_FORM_NAME' => 'Nome Tipo Prodotto',
	'PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION' => 'Descrizione Tipo Prodotto',
	'PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS' => 'Parametri',
	'PHPSHOP_PRODUCT_TYPE_FORM_LBL' => 'Informazioni Tipo Prodotto',
	'PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH' => 'Pubblica?',
	'PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE' => '\'Browse Page\' (navigazione catalogo)<br />',
	'PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE' => '\'Flypage\' (dettaglio prodotto)<br />',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL' => 'Parametri per Tipo Prodotto',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LBL' => 'Dati Parametro',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NOT_FOUND' => 'Tipo Prodotto non trovato!',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME' => 'Nome Parametro',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME_DESCRIPTION' => 'Questo diventer� il titolo di colonna nella tabella. Deve essere univoco e senza spazi.<br />Per esempio: materiale_principale',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL' => 'Etichetta Parametro',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_INTEGER' => 'Numero Intero',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TEXT' => 'Testo',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_SHORTTEXT' => 'Testo Breve',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_FLOAT' => 'Numero Decimale',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_CHAR' => 'Carattere',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATETIME' => 'Data & Ora',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE' => 'Data',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME' => 'Ora',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_BREAK' => 'Interruzione (Break Line)',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_MULTIVALUE' => 'Valori Multipli',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES' => 'Valori Possibili',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_MULTISELECT' => 'Consenti selezioni Multiple?',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES_DESCRIPTION' => 'Se "Valori Possibili" � impostato, i Parametri potranno essere solo questi valori predefiniti.<br />Esempi di Valori Possibili: <strong>Ferro;Legno;Plastica;...</strong>',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT' => 'Valore Predefinito',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT_HELP_TEXT' => 'Per indicare il valore predefinito del parametro usa questo formato:<ul><li>Data: AAAA-MM-GG</li><li>Ora: HH:MM:SS</li><li>Data & Ora: AAAA-MM-GG HH:MM:SS</li></ul>',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_UNIT' => 'Unit� di misura',
	'PHPSHOP_PRODUCT_CLONE' => 'Clona Prodotto',
	'PHPSHOP_CSV_SETTINGS' => 'Impostazioni',
	'PHPSHOP_CSV_DELIMITER' => 'Delimitatore',
	'PHPSHOP_CSV_ENCLOSURE' => 'Carattere Delimitazione Campo',
	'PHPSHOP_CSV_UPLOAD_FILE' => 'Upload File CSV',
	'PHPSHOP_CSV_SUBMIT_FILE' => 'Invia file CSV',
	'PHPSHOP_CSV_FROM_DIRECTORY' => 'Carica da una cartella',
	'PHPSHOP_CSV_FROM_SERVER' => 'Carica il file CSV dal server',
	'PHPSHOP_CSV_EXPORT_TO_FILE' => 'Esporta in un file CSV',
	'PHPSHOP_CSV_SELECT_FIELD_ORDERING' => 'Scegli il tipo di ordinamento dei campi',
	'PHPSHOP_CSV_DEFAULT_ORDERING' => 'Ordine predefinito',
	'PHPSHOP_CSV_CUSTOMIZED_ORDERING' => 'Ordine personalizzato',
	'PHPSHOP_CSV_SUBMIT_EXPORT' => 'Esporta tutti i prodotti in un file CSV',
	'PHPSHOP_CSV_CONFIGURATION_HEADER' => 'Configurazione Importa / Esporta CSV',
	'PHPSHOP_CSV_SAVE_CHANGES' => 'Salva i Cambiamenti',
	'PHPSHOP_CSV_FIELD_NAME' => 'Nome campo',
	'PHPSHOP_CSV_DEFAULT_VALUE' => 'Valore predefinito',
	'PHPSHOP_CSV_FIELD_ORDERING' => 'Ordine campo',
	'PHPSHOP_CSV_FIELD_REQUIRED' => 'Campo richiesto?',
	'PHPSHOP_CSV_IMPORT_EXPORT' => 'Importa/Esporta',
	'PHPSHOP_CSV_NEW_FIELD' => 'Aggiungi un nuovo campo',
	'PHPSHOP_CSV_DOCUMENTATION' => 'Documentazione',
	'PHPSHOP_HIDE_OUT_OF_STOCK' => 'Nascondi i prodotti non in magazzino',
	'PHPSHOP_FEATURED_PRODUCTS_LIST_LBL' => 'Prodotti in Promozione & Scontati',
	'PHPSHOP_FEATURED' => 'In Promozione',
	'PHPSHOP_SHOW_FEATURED_AND_DISCOUNTED' => 'in promozione E scontati',
	'PHPSHOP_SHOW_DISCOUNTED' => 'prodotti scontati',
	'PHPSHOP_FILTER' => 'Filtro',
	'PHPSHOP_PRODUCT_FORM_DISCOUNTED_PRICE' => 'Prezzo Scontato',
	'PHPSHOP_PRODUCT_FORM_DISCOUNTED_PRICE_TIP' => 'Qui puoi sovrascrivere lo sconto generale, impostando uno sconto speciale per questo prodotto.<br /> Il Negozio crea un nuovo "discount record" dal prezzo scontato.',
	'PHPSHOP_PRODUCT_LIST_QUANTITY_START' => 'Quantit� Iniziale',
	'PHPSHOP_PRODUCT_LIST_QUANTITY_END' => 'Quantit� Finale',
	'VM_PRODUCTS_MOVE_LBL' => 'Sposta i prodotti da una categoria all\'altra',
	'VM_PRODUCTS_MOVE_LIST' => 'Hai scelto di spostare i seguenti %s prodotti',
	'VM_PRODUCTS_MOVE_TO_CATEGORY' => 'Sposta alla categoria seguente',
	'VM_CSV_UPLOAD_SIMULATION_RESULTS_LBL' => 'Risultati simulazione upload CSV',
	'VM_CSV_UPLOAD_IMPORTNOW' => 'Importa ora!',
	'VM_CSV_UPLOAD_START_AT' => 'Inizia a leggere dalla riga',
	'VM_CSV_UPLOAD_LINES_TO_PROCESS' => 'Num. di righe da importare',
	'VM_CSV_UPLOAD_NO_ERRORS' => 'Nessun errore trovato durante la simulazione di importazione CSV.',
	'VM_CSV_UPLOAD_TOTAL_LINES' => 'Totale righe trovate',
	'VM_CSV_UPLOAD_FIRST_LINE' => 'Prima riga letta',
	'VM_CSV_UPLOAD_FIELD_EXPLANATION' => 'Ordinamento campi usato => Valori trovati',
	'VM_PRODUCT_IMPORT_LOG' => 'Registro importazione prodotti',
	'VM_CSV_UPLOAD_DETAILS_ANALYSIS' => 'Dettagli / Analisi upload CSV',
	'VM_PRODUCT_LIST_REORDER_TIP' => 'Seleziona una categoria per riordinare i prodotti di quella categoria',
	'VM_REVIEW_FORM_LBL' => 'Aggiungi Recensione',
	'PHPSHOP_REVIEW_EDIT' => 'Aggiungi/Modifica una Recensione',
	'SEL_CATEGORY' => 'Seleziona una categoria',
	'PHPSHOP_CSV_SKIP_FIRST_LINE' => 'Salta la prima riga',
	'PHPSHOP_CSV_SKIP_DEFAULT_VALUE' => 'Salta il valore predefinito',
	'PHPSHOP_CSV_OVERWRITE_EXISTING_DATA' => 'Sovrascrivi i dati esistenti',
	'PHPSHOP_CSV_INCLUDE_COLUMN_HEADERS' => 'Includi le intestazioni di colonna',
	'PHPSHOP_CSV_UPLOAD_SETTINGS' => 'Impostazioni di Caricamento',
	'PHPSHOP_CSV_AVAILABLE_FIELDS_USE' => 'I seguenti campi sono disponibili per l\'uso, per l\'importazione o l\'esportazione.',
	'PHPSHOP_CSV_MINIMAL_FIELDS' => 'I minimi campi richiesti sono product_sku, product_name e category_path. Ad eccezione di product_sku, gli altri due campi non sono univoci.',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_SKU' => 'L\'identificatore univoco per un prodotto.<br />
        Valori:<ul><li>Numeri</li><li>Lettere</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_NAME' => 'Il nome del prodotto. Valori:<ul><li>Testo: codice HTML non consentito.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_DELETE' => 'Il campo product_delete � un campo speciale. Questo campo � utilizzato per determinare se un prodotto deve essere eliminato oppure no.<br />
        Utilizzo:<ol><li>Aggiungi il nome "product_delete" alla schermata di configurazione. Il nome � sensibile alle maiuscole, e deve essere tutto minuscolo.</li>
        <li>Aggiungi una colonna al tuo file CSV con il valore Y. Se il campo contiene qualsiasi altro valore, il prodotto non verr� eliminato.</li></ol></br />
        Valori:<ul><li>Y: S� (Yes), il prodotto deve essere eliminato</li><li>N: No, il prodotto non deve essere eliminato</li><li>Vuoto: valore vuoto, il prodotto non deve essere eliminato</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_DESC' => 'Descrizione completa per il prodotto.<br />
        Valori:<ul><li>Testo: codice HTML non consentito.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_S_DESC' => 'Descrizione breve per il prodotto.<br />
        Valori:<ul><li>Testo: codice HTML non consentito.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_PUBLISH' => 'Lo stato di pubblicazione di un prodotto.<br />
        Valori:<ul><li>Y: S� (Yes), il prodotto � pubblicato</li><li>N: No, il prodotto non � pubblicato</li><li>Vuoto: valore vuoto, il prodotto � pubblicato.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_WIDTH' => 'La larghezza del prodotto.<br />
        Valori:<ul><li>Numero<li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_HEIGHT' => 'L\'altezza del prodotto.<br />
        Valori:<ul><li>Numero<li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_LENGTH' => 'La lunghezza del prodotto.<br /><br />Usage:<ol><li>Seleziona il nome "product_length" dal menu nella schermata di configurazione.</li><li>Aggiungi una colonna al tuo file CSV con un valore numerico.</li></ol><br />Valori:<ul><li>Numerico</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_AVAILABLE_DATE' => 'La data in cui un prodotto diventer� disponibile. Per l\'importazione la data deve essere nel formato giorno/mese/anno oppure giorno-mese-anno. Nei sistemi Windows la data va fino al 19/01/2038.<br />
        Utilizzo:<ol><li>Aggiungi il nome "product_available_date" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere tutto minuscolo.</li><li>Aggiungi una colonna al tuo file CSV con un valore data. Se il campo contiene qualsiasi altro valore, il dato verr� ignorato.</li></ol><br />
        Valori:<ul><li>Data: giorno/mese/anno oppure giorno-mese-anno</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_IN_STOCK' => 'Il numero di articoli che hai in magazzino.<br /><br />.
        Utilizzo:<ol><li>Aggiungi il nome "product_in_stock" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Aggiungi una colonna al tuo file CSV con un valore numerico. Se il campo contiene qualsiasi altro valore, verr� utilizzato il valore predefinito.</li></ol><br />
        Valori:<ul><li>Numero</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_ATTRIBUTE' => 'Le varie scelte di un singolo prodotto. Utilizza questo per dare un prodotto diverse specificazioni. Ad esempio una maglietta disponibile in pi� taglie e colori. Puoi specificare le taglie e i colori in questo modo:
        Dimensione,XL[+1.99],M,S[-2.99];Colore,Rosso,Verde,Giallo,ColoreCostoso[=24.00];ECosiVia,..,..<br /><br />
        Puoi regolare i prezzi per attributo utilizzati le seguenti opzioni:<ul><li>+: Aggiunge questo importo al prezzo configurato.</li><li>-: Sottrae questo importo dal prezzo configurato.</li><li>=: Imposta il prezzo del prodotto a questo importo.</li></ul><br />
        Utilizzo:<ol><li>Aggiungi il nome "attribute" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Aggiungi una colonna al tuo file CSV con il testo degli attributi.</li></ol><br />
        Valori:<ul><li>Testo: codice HTML non consentito.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_AVAILABILITY' => 'Questo mostra quando il prodotto � disponibile. Il valore pu� essere un testo descrittivo oppure un nome di file immagine. Le imagini devono essere posizionate in "shop_image/availability/".<br/ >
        Utilizzo:<ol><li>Aggiungi il nome "product_availability" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Aggiungi una colonna al tuo file CSV con un valore testuale.</li></ol><br />
        Valori:<ul><li>Testo: codice HTML non consentito.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_FULL_IMAGE' => 'Il nome del file dell\'immagine posizionata nella cartella "shop_image/product/", oppure l\'indirizzo (URL) dell\'immagine.<br />
        NOTA: Se hai abilitato il ridimensionamento dinamico, devi riempire il campo "product_thumb_image". VirtueMart ridimensione l\'immagine in esso specificata.<br /><br />
        Utilizzo:<ol><li>Aggiungi il nome "product_full_image" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Aggiungi una colonna al tuo file CSV con un valore testuale.</li></ol><br />
        Valori:<ul><li>Testo:<ul><li>codice HTML non consentito</li><li>Indirizzi (URL) consentiti</li></ul></li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_THUMB_IMAGE' => 'Il nome del file dell\'immagine miniatura posizionata nella cartella "shop_image/product/", oppure l\'indirizzo (URL) dell\'immagine.<br />
        NOTA: Se hai abilitato il ridimensionamento dinamico, devi comunque inserire un valore in questo campo. VirtueMart ridimensione l\'immagine in esso specificata.<br /><br />
        Utilizzo:<ol><li>Aggiungi il nome "product_full_image" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Aggiungi una colonna al tuo file CSV con un valore testuale.</li></ol><br />
        Valori:<ul><li>Testo:<ul><li>codice HTML non consentito</li><li>Indirizzi (URL) consentiti</li></ul></li></ul>',
	'PHPSHOP_CSV_EXPLANATION_CUSTOM_ATTRIBUTE' => 'Un attributo personalizzato aggiunger� un campo di imput alla pagina del prodotto con la descrizione dell\'attributo fornito. Gli attributi personalizzati sono specificati in questo modo: Nome;Extra;...<br />
        Utilizzo:<ol><li>Aggiungi il nome "custom_attribute" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Aggiungi una colonna al tuo file CSV con il testo degli attributi.</li></ol><br/>
        Valori:<ul><li>Text: codice HTML non consentito.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_PACKAGING' => 'Specifica il numero di oggetti nella confezione.<br />
        Utilizzo:<ol><li>Aggiungi il nome "product_packaging" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Aggiungi una colonna al tuo file CSV con il numero degli oggetti nella confezione.</li></ol><br />
        Valori:<ul><li>Numero</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_BOX' => 'Specifica il numero di oggetti nella scatola.<br />
        Utilizzo:<ol><li>Aggiungi il nome "product_box" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Aggiungi una colonna al tuo file CSV con il numero degli oggetti nella scatola.</li></ol><br />
        Valori:<ul><li>Numero</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_DISCOUNT' => 'Specifica l\'importo o la percentuale di sconto per il prodotto. I valori inseriti sono valori esatti, non viene fatto nessun calcolo. Questo � lo stesso che inserisci in uno sconto tramite la Lista Sconti sul Prodotto. Se lo sconto esiste gi�, non verr� aggiunto al database ma il prodotto sar� collegato allo sconto esistente. Il criterio per determinare se uno sconto esiste gi� � se i seguenti valori sono esattamente uguali:<ol><li>Importo, che sia totale o percentuale</li><li>Data di inizio</li><li>Data di fine</li></ol>Questo evita di riempire il database con un numero enorme di sconti uguali.<br /><br />
        Utilizzo:<ol><li>Aggiungi il nome "product_discount" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Opzionale: Aggiungi il nome "product_discount_date_start" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Opzionale: Aggiungi il nome "product_discount_date_end" alla schermata di configurazione. Il nome � sensibile alle maiuscole e deve essere scritto tutto minuscolo.</li><li>Aggiungi le colonne scelte al tuo file CSV con i valori corrispondenti.</li></ol><br />
        Valori:<ul><li>product_discount</li></ul><li>Numero<br />es. 10</li><li>Percentuale: Deve includere il segno %<br />es. 10%</li></ul><li>product_discount_date_start</li><ul><li>Data: giorno/mese/anno oppure giorno-mese-anno<br />Giorno e mese possono essere a 1 o 2 cifre.<br />L\'anno pu� essere a 2 o 4 cifre.</li></ul><li>product_discount_date_end</li><ul><li>Data: giorno/mese/anno oppure giorno-mese-anno<br />Giorno e mese possono essere a 1 o 2 cifre.<br />L\'anno pu� essere a 2 o 4 cifre.</li></ul></ul>',
	'VM_PRODUCT_FORM_MIN_ORDER' => 'Quantit� Minima di Acquisto',
	'VM_PRODUCT_FORM_MAX_ORDER' => 'Quantit� Massima di Acquisto',
	'VM_DISPLAY_TABLE_HEADER' => 'Mostra le intestazioni di tabella',
	'VM_DISPLAY_LINK_TO_CHILD' => 'Collega ai prodotti figlio dalla lista',
	'VM_DISPLAY_INCLUDE_PRODUCT_TYPE' => 'Includi il tipo prodotto con il figlio',
	'VM_DISPLAY_USE_LIST_BOX' => 'Usa una lista per i prodotti figlio',
	'VM_DISPLAY_LIST_STYLE' => 'Stile Lista',
	'VM_DISPLAY_USE_PARENT_LABEL' => 'Usa le impostazioni del padre:',
	'VM_DISPLAY_LIST_TYPE' => 'Lista:',
	'VM_DISPLAY_QUANTITY_LABEL' => 'Quantit�:',
	'VM_DISPLAY_QUANTITY_DROPDOWN_LABEL' => 'Valori menu di selezione',
	'VM_DISPLAY_CHILD_DESCRIPTION' => 'Mostra la descrizione del figlio',
	'VM_DISPLAY_DESC_WIDTH' => 'Larghezza descrizione del figlio',
	'VM_DISPLAY_ATTRIB_WIDTH' => 'Larghezza attributo del figlio',
	'VM_DISPLAY_CHILD_SUFFIX' => 'Suffisso classe del figlio',
	'VM_INCLUDED_PRODUCT_ID' => 'ID prodotti da includere',
	'VM_EXTRA_PRODUCT_ID' => 'ID aggiuntivi',
	'PHPSHOP_DISPLAY_RADIOBOX' => 'Usa pulsanti di scelta',
	'PHPSHOP_PRODUCT_FORM_ITEM_DISPLAY_LBL' => 'Opzioni di Visualizzazione',
	'PHPSHOP_DISPLAY_USE_PARENT' => 'Ignora i valori di visualizzazione dei prodotti figlio e usa quelli dei padri',
	'PHPSHOP_DISPLAY_NORMAL' => 'Casella quantit� standard',
	'PHPSHOP_DISPLAY_HIDE' => 'Nascondi la casella quantit�',
	'PHPSHOP_DISPLAY_DROPDOWN' => 'Usa menu di selezione',
	'PHPSHOP_DISPLAY_CHECKBOX' => 'Usa caselle di controllo',
	'PHPSHOP_DISPLAY_ONE' => 'Un bottone Aggiungi al Carrello',
	'PHPSHOP_DISPLAY_MANY' => 'Bottone Aggiungi al Carrello per ogni figlio',
	'PHPSHOP_DISPLAY_START' => 'Valore iniziale',
	'PHPSHOP_DISPLAY_END' => 'Valore finale',
	'PHPSHOP_DISPLAY_STEP' => 'Valore di incremento',
	'PRODUCT_WAITING_LIST_TAB' => 'Lista d\'Attesa',
	'PRODUCT_WAITING_LIST_USERLIST' => 'Utenti in attesa di essere avvisati quando questo prodotto diventa disponibile',
	'PRODUCT_WAITING_LIST_NOTIFYUSERS' => 'Avvisa questi utenti ora (quando aggiorni la quantit� disponibile a magazzino)',
	'PRODUCT_WAITING_LIST_NOTIFIED' => 'avvisato',
	'VM_PRODUCT_FORM_AVAILABILITY_SELECT_IMAGE' => 'Seleziona Immagine',
	'VM_PRODUCT_RELATED_SEARCH' => 'Cerca qui prodotti e categorie:'
	));
?>