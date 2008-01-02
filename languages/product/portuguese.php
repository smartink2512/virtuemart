<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : portuguese.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_MODULE_LIST_ORDER' => 'Encomendar',
	'PHPSHOP_PRODUCT_INVENTORY_LBL' => 'Invent�rio de Produtos',
	'PHPSHOP_PRODUCT_INVENTORY_STOCK' => 'N�mero',
	'PHPSHOP_PRODUCT_INVENTORY_WEIGHT' => 'Peso',
	'PHPSHOP_PRODUCT_LIST_PUBLISH' => 'Publicar',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE' => 'Search Product',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRODUCT' => 'modyfied',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRICE' => 'with price modyfied',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_WITHOUTPRICE' => 'without price',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_AFTER' => 'After',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_BEFORE' => 'Before',
	'PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE' => 'Ver flyer de Produtos nesta loja',
	'PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL' => 'Novo Produto',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL' => 'Informa��o do Produto',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL' => 'Estado',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL' => 'Dimens�es e Peso',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL' => 'Imagens',
	'PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL' => 'Actualizar Artigo',
	'PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL' => 'Informa��o',
	'PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL' => 'Estado',
	'PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL' => 'Dimens�es e Peso',
	'PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL' => 'Imagens',
	'PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL' => 'Para actualizar a imagem actual, v� ao directorio e insira a nova imagem.',
	'PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL' => 'Escreva ',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL' => 'Artigos',
	'PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL' => 'Qualidades',
	'PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG' => 'Tem a certeza que quer apagar este produto\\\\ne e todos os artigos relacionados com ele?',
	'PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG' => 'Tem a certeza que quer apagar este Artigo?',
	'PHPSHOP_PRODUCT_FORM_MANUFACTURER' => 'Fabricante',
	'PHPSHOP_PRODUCT_FORM_SKU' => 'SKU',
	'PHPSHOP_PRODUCT_FORM_NAME' => 'Nome',
	'PHPSHOP_PRODUCT_FORM_CATEGORY' => 'Categoria',
	'PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE' => 'Data de disponibilidade',
	'PHPSHOP_PRODUCT_FORM_SPECIAL' => 'Em especial',
	'PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE' => 'Tipo de Desconto',
	'PHPSHOP_PRODUCT_FORM_PUBLISH' => 'Publicar?',
	'PHPSHOP_PRODUCT_FORM_LENGTH' => 'Tamanho',
	'PHPSHOP_PRODUCT_FORM_WIDTH' => 'Largura',
	'PHPSHOP_PRODUCT_FORM_HEIGHT' => 'Altura',
	'PHPSHOP_PRODUCT_FORM_DIMENSION_UOM' => 'Unidade de Medida',
	'PHPSHOP_PRODUCT_FORM_WEIGHT_UOM' => 'Unidade de Medida',
	'PHPSHOP_PRODUCT_FORM_FULL_IMAGE' => 'Imagem Completa',
	'PHPSHOP_PRODUCT_FORM_WEIGHT_UOM_DEFAULT' => 'pounds',
	'PHPSHOP_PRODUCT_FORM_DIMENSION_UOM_DEFAULT' => 'inches',
	'PHPSHOP_PRODUCT_FORM_PACKAGING' => 'Units in Packaging',
	'PHPSHOP_PRODUCT_FORM_PACKAGING_DESCRIPTION' => 'Here you can fill in a number unit in packaging. (max. 65535)',
	'PHPSHOP_PRODUCT_FORM_BOX' => 'Units in Box',
	'PHPSHOP_PRODUCT_FORM_BOX_DESCRIPTION' => 'Here you can fill in a number unit in box. (max. 65535)',
	'PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL' => 'Resultados de Adicionar Produto',
	'PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL' => 'Resultados de Actualizar Produto',
	'PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL' => 'Resultados de Adicionar Art�culo',
	'PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL' => 'Resultados de Actualizar Art�culo',
	'PHPSHOP_CATEGORY_FORM_LBL' => 'Informa��o',
	'PHPSHOP_CATEGORY_FORM_NAME' => 'Nome',
	'PHPSHOP_CATEGORY_FORM_PARENT' => 'Parente',
	'PHPSHOP_CATEGORY_FORM_DESCRIPTION' => 'Descri��o da Categoria',
	'PHPSHOP_CATEGORY_FORM_PUBLISH' => 'Publicar?',
	'PHPSHOP_CATEGORY_FORM_FLYPAGE' => 'Flypage da Categoria',
	'PHPSHOP_ATTRIBUTE_LIST_LBL' => 'Listar Atributos por',
	'PHPSHOP_ATTRIBUTE_LIST_NAME' => 'Nome Atributos',
	'PHPSHOP_ATTRIBUTE_LIST_ORDER' => 'Listar Encomenda',
	'PHPSHOP_ATTRIBUTE_FORM_LBL' => 'Formulario Atributos',
	'PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT' => 'Novo Atributo de Produto',
	'PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT' => 'Actualizar Atributos de Produto',
	'PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM' => 'Novo Atributo de Produto',
	'PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM' => 'Actualizar Atributos de Produto',
	'PHPSHOP_ATTRIBUTE_FORM_NAME' => 'Nome Atributo',
	'PHPSHOP_ATTRIBUTE_FORM_ORDER' => 'Listar Encomendas',
	'PHPSHOP_PRICE_LIST_FOR_LBL' => 'Pre�os por',
	'PHPSHOP_PRICE_LIST_GROUP_NAME' => 'Grupo',
	'PHPSHOP_PRICE_LIST_PRICE' => 'Pre�o',
	'PHPSHOP_PRODUCT_LIST_CURRENCY' => 'Moeda',
	'PHPSHOP_PRICE_FORM_LBL' => 'Informa��o',
	'PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT' => 'Novo Pre�o de Produto',
	'PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT' => 'Actualizar Pre�o de Produto',
	'PHPSHOP_PRICE_FORM_NEW_FOR_ITEM' => 'Novo Pre�o de Produto',
	'PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM' => 'Actualizar Pre�o de Produto',
	'PHPSHOP_PRICE_FORM_PRICE' => 'Pre�o',
	'PHPSHOP_PRICE_FORM_CURRENCY' => 'Moeda',
	'PHPSHOP_PRICE_FORM_GROUP' => 'Grupo de Cliente',
	'PHPSHOP_LEAVE_BLANK' => '(deixar em BRANCO se n�o tiver<br />nenhum arquivo php individual)',
	'PHPSHOP_PRODUCT_FORM_ITEM_LBL' => 'Item',
	'PHPSHOP_PRODUCT_DISCOUNT_STARTDATE' => 'Startdate of discount',
	'PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP' => 'Specifies the day when the discount begins',
	'PHPSHOP_PRODUCT_DISCOUNT_ENDDATE' => 'End date of discount',
	'PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP' => 'Specifies the day when the discount ends',
	'PHPSHOP_FILEMANAGER_PUBLISHED' => 'Published?',
	'PHPSHOP_FILES_LIST' => 'FileManager::Image/File List for',
	'PHPSHOP_FILES_LIST_FILENAME' => 'Filename',
	'PHPSHOP_FILES_LIST_FILETITLE' => 'File Title',
	'PHPSHOP_FILES_LIST_FILETYPE' => 'File Type',
	'PHPSHOP_FILES_LIST_FULL_IMG' => 'Full Image',
	'PHPSHOP_FILES_LIST_THUMBNAIL_IMG' => 'Thumbnail Image',
	'PHPSHOP_FILES_FORM' => 'Upload a File for',
	'PHPSHOP_FILES_FORM_CURRENT_FILE' => 'Current File',
	'PHPSHOP_FILES_FORM_FILE' => 'File',
	'PHPSHOP_FILES_FORM_IMAGE' => 'Image',
	'PHPSHOP_FILES_FORM_UPLOAD_TO' => 'Upload to',
	'PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH' => 'default Product Image Path',
	'PHPSHOP_FILES_FORM_UPLOAD_OWNPATH' => 'Specify the file location',
	'PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH' => 'Download Path (e.g. for selling downloadables!)',
	'PHPSHOP_FILES_FORM_AUTO_THUMBNAIL' => 'Auto-Create Thumbnail?',
	'PHPSHOP_FILES_FORM_FILE_PUBLISHED' => 'File is published?',
	'PHPSHOP_FILES_FORM_FILE_TITLE' => 'File Title (what the Customer sees)',
	'PHPSHOP_FILES_FORM_FILE_URL' => 'File URL (optional)',
	'PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1' => 'Fill in any text here that will be displayed to the customer on the product flypage.<br />e.g.: 24h, 48 hours, 3 - 5 days, On Order.....',
	'PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2' => 'OR select an Image to be displayed on the Details Page (flypage).<br />The images reside in the directory <i>%s</i><br />',
	'PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES' => '<h4>Examples for the Attribute List Format:</h4>
        <span class="sectionname"><strong>Size</strong>,XL[+1.99],M,S[-2.99]<strong>;Colour</strong>,Red,Green,Yellow,ExpensiveColor[=24.00]<strong>;AndSoOn</strong>,..,..</span>
        <h4>Inline price adjustments for using the Advanced Attributes modification:</h4>
        <span class="sectionname">
        <strong>+</strong> == Add this amount to the configured price.<br />
        <strong>-</strong> == Subtract this amount from the configured price.<br />
        <strong>=</strong> == Set the product\\\'s price to this amount.
      </span>',
	'PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES' => '<h4>Examples for the Custom attribute List Format:</h4>
        <span class="sectionname"><strong>Name;Extras;</strong>...</span>',
	'PHPSHOP_IMAGE_ACTION' => 'Image Action',
	'PHPSHOP_PARAMETERS_LBL' => 'Parameters',
	'PHPSHOP_PRODUCT_TYPE_LBL' => 'Product Type',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL' => 'Product Type List for',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL' => 'Add Product Type for',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE' => 'Product Type',
	'PHPSHOP_PRODUCT_TYPE_FORM_NAME' => 'Product Type Name',
	'PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION' => 'Product Type Description',
	'PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS' => 'Parameters',
	'PHPSHOP_PRODUCT_TYPE_FORM_LBL' => 'Product Type Information',
	'PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH' => 'Publish?',
	'PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE' => 'Product Type Browse Page',
	'PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE' => 'Product Type Flypage',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL' => 'Parameters of Product Type',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LBL' => 'Parameter Information',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NOT_FOUND' => 'Product Type not found!',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME' => 'Parameter Name',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME_DESCRIPTION' => 'This name will be column name of table. Must be unicate and without space.<BR>For example: main_material',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL' => 'Parameter Label',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_INTEGER' => 'Integer',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TEXT' => 'Text',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_SHORTTEXT' => 'Short Text',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_FLOAT' => 'Float',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_CHAR' => 'Char',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATETIME' => 'Date & Time',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE' => 'Date',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME' => 'Time',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_BREAK' => 'Break Line',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_MULTIVALUE' => 'Multiple Values',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES' => 'Possible Values',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_MULTISELECT' => 'Show Possible Values as Multiple select?',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES_DESCRIPTION' => '<strong>If Possible Values are set, Parameter can have only this values. Example for Possible Values:</strong><BR><span class="sectionname">Steel;Wood;Plastic;...</span>',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT' => 'Default Value',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT_HELP_TEXT' => 'For Parameter Default Value use this format:<ul><li>Date: YYYY-MM-DD</li><li>Time: HH:MM:SS</li><li>Date & Time: YYYY-MM-DD HH:MM:SS</li></ul>',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_UNIT' => 'Unit',
	'PHPSHOP_PRODUCT_CLONE' => 'Clone Product',
	'PHPSHOP_CSV_SETTINGS' => 'Settings',
	'PHPSHOP_CSV_DELIMITER' => 'Delimiter',
	'PHPSHOP_CSV_ENCLOSURE' => 'Field Enclosure Char',
	'PHPSHOP_CSV_UPLOAD_FILE' => 'Upload a CSV File',
	'PHPSHOP_CSV_SUBMIT_FILE' => 'Submit CSV File',
	'PHPSHOP_CSV_FROM_DIRECTORY' => 'Load from directory',
	'PHPSHOP_CSV_FROM_SERVER' => 'Load CSV File from Server',
	'PHPSHOP_CSV_EXPORT_TO_FILE' => 'Export to CSV File',
	'PHPSHOP_CSV_SELECT_FIELD_ORDERING' => 'Choose Field Ordering Type',
	'PHPSHOP_CSV_DEFAULT_ORDERING' => 'Default Ordering',
	'PHPSHOP_CSV_CUSTOMIZED_ORDERING' => 'My customized Ordering',
	'PHPSHOP_CSV_SUBMIT_EXPORT' => 'Export all Products to CSV File',
	'PHPSHOP_CSV_CONFIGURATION_HEADER' => 'CSV Import / Export Configuration',
	'PHPSHOP_CSV_SAVE_CHANGES' => 'Save Changes',
	'PHPSHOP_CSV_FIELD_NAME' => 'Field Name',
	'PHPSHOP_CSV_DEFAULT_VALUE' => 'default Value',
	'PHPSHOP_CSV_FIELD_ORDERING' => 'Field Ordering',
	'PHPSHOP_CSV_FIELD_REQUIRED' => 'Field Required?',
	'PHPSHOP_CSV_IMPORT_EXPORT' => 'Import/Export',
	'PHPSHOP_CSV_NEW_FIELD' => 'Add a new Field',
	'PHPSHOP_CSV_DOCUMENTATION' => 'Documentation',
	'PHPSHOP_HIDE_OUT_OF_STOCK' => 'Hide out of stock products',
	'PHPSHOP_FEATURED_PRODUCTS_LIST_LBL' => 'Featured & Discounted Products',
	'PHPSHOP_FEATURED' => 'Featured',
	'PHPSHOP_SHOW_FEATURED_AND_DISCOUNTED' => 'featured AND discounted',
	'PHPSHOP_SHOW_DISCOUNTED' => 'discounted products',
	'PHPSHOP_FILTER' => 'Filter',
	'PHPSHOP_PRODUCT_FORM_DISCOUNTED_PRICE' => 'Discounted Price',
	'PHPSHOP_PRODUCT_FORM_DISCOUNTED_PRICE_TIP' => 'Here you can override the discount setting fill in a special discount price for this product.<br/>
The Shop will create a new discount record from the discounted price.',
	'PHPSHOP_PRODUCT_LIST_QUANTITY_START' => 'Quantity Start',
	'PHPSHOP_PRODUCT_LIST_QUANTITY_END' => 'Quantity End',
	'VM_PRODUCTS_MOVE_LBL' => 'Move products from one category to another',
	'VM_PRODUCTS_MOVE_LIST' => 'You have chosen to move the following %s products',
	'VM_PRODUCTS_MOVE_TO_CATEGORY' => 'Move to the following category',
	'VM_CSV_UPLOAD_SIMULATION_RESULTS_LBL' => 'CSV Upload Simulation Results',
	'VM_CSV_UPLOAD_IMPORTNOW' => 'Import Now!',
	'VM_CSV_UPLOAD_START_AT' => 'Start reading from line',
	'VM_CSV_UPLOAD_LINES_TO_PROCESS' => 'No. of lines to import',
	'VM_CSV_UPLOAD_NO_ERRORS' => 'No errors found during CSV import simulation.',
	'VM_CSV_UPLOAD_TOTAL_LINES' => 'Total lines found',
	'VM_CSV_UPLOAD_FIRST_LINE' => 'First line read',
	'VM_CSV_UPLOAD_FIELD_EXPLANATION' => 'Field Ordering used => Values found',
	'VM_PRODUCT_IMPORT_LOG' => 'Product Import Log',
	'VM_CSV_UPLOAD_DETAILS_ANALYSIS' => 'CSV Upload Details / Analysis',
	'VM_PRODUCT_LIST_REORDER_TIP' => 'Select a product category to reorder products in a category',
	'VM_REVIEW_FORM_LBL' => 'Add Review',
	'PHPSHOP_REVIEW_EDIT' => 'Add/Edit a Review',
	'SEL_CATEGORY' => 'Select a category',
	'PHPSHOP_CSV_SKIP_FIRST_LINE' => 'Skip first line',
	'PHPSHOP_CSV_SKIP_DEFAULT_VALUE' => 'Skip default value',
	'PHPSHOP_CSV_OVERWRITE_EXISTING_DATA' => 'Overwrite existing data',
	'PHPSHOP_CSV_INCLUDE_COLUMN_HEADERS' => 'Include column headers',
	'PHPSHOP_CSV_UPLOAD_SETTINGS' => 'Upload Settings',
	'PHPSHOP_CSV_AVAILABLE_FIELDS_USE' => 'The following fields are available for your use to import or export.',
	'PHPSHOP_CSV_MINIMAL_FIELDS' => 'The minimal required fields are product_sku, product_name and category_path. Except for the product_sku, the other two fields are not unique.',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_SKU' => 'The unique identifier for a product.<br /.>Values:<ul><li>Number</li><li>Letters</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_NAME' => 'The name of the product.Values:<ul><li>Text: No HTML code allowed.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_DELETE' => 'The product_delete field is a special field. This field is used to determine if a product should be deleted or not.<br />Usage:<ol><li>Add the the name "product_delete" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with the value Y. If the field contains any other value, the product will not be deleted.</li></ol><br /.>Values:<ul><li>Y: Yes, the product is to be deleted</li><li>N: No, the product is not to be deleted</li><li>Empty: Empty value, the product is not to be deleted</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_DESC' => 'Long description for the product.<br />Values:<ul><li>Text: HTML code allowed.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_S_DESC' => 'Short description for the product.<br />Values:<ul><li>Text: No HTML code allowed.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_PUBLISH' => 'The status if a product is published or not.<br />Values:<ul><li>Y: Yes, the product is published</li><li>N: No, the product is not published</li><li>Empty: Empty value, the product is published.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_WIDTH' => 'The width of the product.<br />Values:<ul><li>Number</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_HEIGHT' => 'The height of the product.<br />Values:<ul><li>Number</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_LENGTH' => 'The length of the product.<br />Values:<ul><li>Number</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_AVAILABLE_DATE' => 'The date a product will become availabable. For import the date should be in the format of day/month/year or day-month-year. On Windows systems the date goes until 19/01/2038.<br />Usage:<ol><li>Add the the name "product_available_date" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with a date value. If the field contains any other value, the data will be ignored.</li></ol><br />Values:<ul><li>Date: day/month/year or day-month-year</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_IN_STOCK' => 'The number of articles that you have in stock.<br /><br />Usage:<ol><li>Add the the name "product_in_stock" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with a numeric value. If the field contains any other value, the default value will be used.</li></ol><br />Values:<ul><li>Number</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_ATTRIBUTE' => 'The different choices a product has. Use this to give a product different specifications. For example a t-shirt that comes in different sizes and colours. You can specify the sizes and colours like this: Size,XL[+1.99],M,S[-2.99];Colour,Red,Green,Yellow,ExpensiveColor[=24.00];AndSoOn,..,..<br /><br />You can adjust the prices per attribute by using the following options:<ul><li>+: Add this amount to the configured price.</li><li>-: Subtract this amount from the configured price.</li><li>=: Set the product\\\'s price to this amount.</li></ul><br />Usage:<ol><li>Add the the name "attribute" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with the attribute text.</li></ol><br /.>Values:<ul><li>Text: No HTML code allowed.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_AVAILABILITY' => 'This shows when the product is available. The value can be a descriptive text or the name of an image filename. Images must be placed in "shop_image/availability/".<br />Usage:<ol><li>Add the the name "product_availability" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with a text value.</li></ol><br />Values:<ul><li>Text: No HTML code allowed.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_FULL_IMAGE' => 'The filename of the image as located in the "shop_image/product/" folder. The filename can also be a URL.<br />NOTE: If you have dynamic resizing enabled, you need to fill the "product_thumb_image" field. VirtueMart resizes the image specified there.<br/><br />Usage:<ol><li>Add the the name "product_full_image" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with a text value.</li></ol><br />Values:<ul><li>Text:<ul><li>No HTML code allowed</li><li>URL\\\'s are allowed.</li></ul></li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_THUMB_IMAGE' => 'The filename of the thumbnail image as located in the "shop_image/product/" folder. The filename can also be a URL.<br />NOTE: If you have dynamic resizing enabled, there still needs to be a value in this field. VirtueMart resizes the image that is specified here.<br /><br />Usage:<ol><li>Add the the name "product_full_image" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with a text value.</li></ol><br />Values:<ul><li>Text:<ul><li>No HTML code allowed</li><li>URL\\\'s are allowed.</li></ul></li></ul>',
	'PHPSHOP_CSV_EXPLANATION_CUSTOM_ATTRIBUTE' => 'A custom attribute will add an input field to the product page with the description of the attribute supplied. Custom attributes are specified like this: Name;Extras;...<br />Usage:<ol><li>Add the the name "custom_attribute" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with the attribute text.</li></ol><br /.>Values:<ul><li>Text: No HTML code allowed.</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_PACKAGING' => 'Specify the number of items in the package.<br />Usage:<ol><li>Add the the name "product_packaging" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with the number of items in the package.</li></ol><br /.>Values:<ul><li>Number</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_BOX' => 'Specify the number of items in the box.<br />Usage:<ol><li>Add the the name "product_box" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add a column to your CSV file with the number of items in the box.</li></ol><br /.>Values:<ul><li>Number</li></ul>',
	'PHPSHOP_CSV_EXPLANATION_PRODUCT_DISCOUNT' => 'Specify the amount or percentage of discount the product has. The values entered are exact values, no calculation is made. This is the same as if you are filling in a discount via the Product Discount List. If the discount already exists, it will not be added to the database but the product will be linked to the existing discount. The criteria for determining if a discount already exists the following values have to be exactly the same:<ol><li>Amount, be it a total or percentage</li><li>Start date</li><li>End date</li></ol>This prevents from filling the database with a huge number of the same discounts.<br /><br />Usage:<ol><li>Add the the name "product_discount" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Optional: Add the the name "product_discount_date_start" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Optional: Add the the name "product_discount_date_end" to the configuration screen. The name is case sensitive and should be lowercase.</li><li>Add the chosen columns to your CSV file with the corresponding values.</li></ol><br /.>Values:<ul><li>product_discount</li><ul><li>Number<br />e.g. 10</li><li>Percentage: Must include the % sign<br />e.g. 10%</li></ul><li>product_discount_date_start</li><ul><li>Date: day/month/year or day-month-year<br />Day and month can be a 1 or 2 digit notation.<br />Year can be a 2 or 4 digit notation.</li></ul><li>product_discount_date_end</li><ul><li>Date: day/month/year or day-month-year<br />Day and month can be a 1 or 2 digit notation.<br />Year can be a 2 or 4 digit notation.</li></ul></ul>',
	'VM_PRODUCT_FORM_MIN_ORDER' => 'Minimum Purchase Quantity',
	'VM_PRODUCT_FORM_MAX_ORDER' => 'Maximum Purchase Quantity',
	'VM_DISPLAY_TABLE_HEADER' => 'Display Table Header',
	'VM_DISPLAY_LINK_TO_CHILD' => 'Link to child product from list',
	'VM_DISPLAY_INCLUDE_PRODUCT_TYPE' => 'Include Product Type With Child',
	'VM_DISPLAY_USE_LIST_BOX' => 'Use List box for child products',
	'VM_DISPLAY_LIST_STYLE' => 'List Style',
	'VM_DISPLAY_USE_PARENT_LABEL' => 'Use Parent Settings:',
	'VM_DISPLAY_LIST_TYPE' => 'List:',
	'VM_DISPLAY_QUANTITY_LABEL' => 'Quantity:',
	'VM_DISPLAY_QUANTITY_DROPDOWN_LABEL' => 'Drop Down Box Values',
	'VM_DISPLAY_CHILD_DESCRIPTION' => 'Display Child Description',
	'VM_DISPLAY_DESC_WIDTH' => 'Child Description Width',
	'VM_DISPLAY_ATTRIB_WIDTH' => 'Child Attribute Width',
	'VM_DISPLAY_CHILD_SUFFIX' => 'Child Class Suffix',
	'VM_INCLUDED_PRODUCT_ID' => 'Product IDs to include',
	'VM_EXTRA_PRODUCT_ID' => 'Extra IDs',
	'PHPSHOP_DISPLAY_RADIOBOX' => 'Use Radio Box',
	'PHPSHOP_PRODUCT_FORM_ITEM_DISPLAY_LBL' => 'Display Options',
	'PHPSHOP_DISPLAY_USE_PARENT' => 'Override Child products Display Values and use parents',
	'PHPSHOP_DISPLAY_NORMAL' => 'Standard Quantity Box',
	'PHPSHOP_DISPLAY_HIDE' => 'Hide Quantity Box',
	'PHPSHOP_DISPLAY_DROPDOWN' => 'Use Dropdown Box',
	'PHPSHOP_DISPLAY_CHECKBOX' => 'Use Check Box',
	'PHPSHOP_DISPLAY_ONE' => 'One Add to Cart Button',
	'PHPSHOP_DISPLAY_MANY' => 'Add to Cart Button for each Child',
	'PHPSHOP_DISPLAY_START' => 'Start Value',
	'PHPSHOP_DISPLAY_END' => 'End Value',
	'PHPSHOP_DISPLAY_STEP' => 'Step Value',
	'PRODUCT_WAITING_LIST_TAB' => 'Waiting List',
	'PRODUCT_WAITING_LIST_USERLIST' => 'Users waiting to be notified when this product is back in stock',
	'PRODUCT_WAITING_LIST_NOTIFYUSERS' => 'Notify these users now (when you have updated the number of products stock)',
	'PRODUCT_WAITING_LIST_NOTIFIED' => 'notified',
	'VM_PRODUCT_FORM_AVAILABILITY_SELECT_IMAGE' => 'Select Image',
	'VM_PRODUCT_RELATED_SEARCH' => 'Search for Products or Categories here:'
	));
?>