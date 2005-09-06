<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: portuguese.php,v 1.21 2005/06/30 17:42:52 soeren_nb Exp $
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

    var $_PHPSHOP_MENU =	"Menu";
    var $_PHPSHOP_CATEGORY = "Categoria";
    var $_PHPSHOP_CATEGORIES = "Categorias";
    var $_PHPSHOP_SELECT_CATEGORY = "Selecione Categoria:";
    var $_PHPSHOP_ADMIN = "Administração";
    var $_PHPSHOP_PRODUCT = "Produto";
    var $_PHPSHOP_LIST =	"Listar";
    var $_PHPSHOP_ALL = "Todos";
    var $_PHPSHOP_LIST_ALL_PRODUCTS = "Todos os Produtos";
    var $_PHPSHOP_VIEW =	"Ver";
    var $_PHPSHOP_SHOW =	"Mostrar";
    var $_PHPSHOP_ADD = "Adicionar";
    var $_PHPSHOP_UPDATE = "Actualizar";
    var $_PHPSHOP_DELETE = "Eliminar";
    var $_PHPSHOP_SELECT = "Seleccionar";
    var $_PHPSHOP_SUBMIT = "Submit";
    var $_PHPSHOP_RANDOM = "Produtos à Sorte";
    var $_PHPSHOP_LATEST = "Ultimos Produtos";

/*#####################
MODULE ACCOUNT
#####################*/

# Some LABELs
var $_PHPSHOP_HOME_TITLE = "Início";
var $_PHPSHOP_CART_TITLE = "Pedido";
var $_PHPSHOP_CHECKOUT_TITLE = "Terminar Pedido";
var $_PHPSHOP_LOGIN_TITLE = "Login";
var $_PHPSHOP_LOGOUT_TITLE = "Logout";
var $_PHPSHOP_BROWSE_TITLE = "Procurar Artigos";
var $_PHPSHOP_SEARCH_TITLE = "Procurar";
var $_PHPSHOP_ACCOUNT_TITLE = "Manutenção da Conta de Utilizador";
var $_PHPSHOP_NAVIGATION_TITLE = "Navegação";
var $_PHPSHOP_DEPARTMENT_TITLE = "Departamento";
var $_PHPSHOP_INFO = "Informação";

var $_PHPSHOP_BROWSE_LBL = "Procurar Artigos";
var $_PHPSHOP_PRODUCTS_LBL = "Produtos";
var $_PHPSHOP_PRODUCT_LBL = "Produto";
var $_PHPSHOP_SEARCH_LBL = "Procurar";
var $_PHPSHOP_FLYPAGE_LBL = "Detalhe do Produto";
var $_PHPSHOP_PRODUCT_SEARCH_LBL = "Procurar Produto";

var $_PHPSHOP_PRODUCT_NAME_TITLE = "Nome do Produto";
var $_PHPSHOP_PRODUCT_CATEGORY_TITLE = "Categoria";
var $_PHPSHOP_PRODUCT_DESC_TITLE = "Descrição";

var $_PHPSHOP_CART_SHOW = "Mostrar Pedido";
var $_PHPSHOP_CART_ADD_TO = "Adicionar ao Pedido";
var $_PHPSHOP_CART_NAME = "Nome";
var $_PHPSHOP_CART_SKU = "Ref";
var $_PHPSHOP_CART_PRICE = "Preço";
var $_PHPSHOP_CART_QUANTITY = "Quantidade";
var $_PHPSHOP_CART_SUBTOTAL = "Subtotal";

# Some messages
var $_PHPSHOP_ADD_SHIPTO_1 = "Adicionar um novo";
var $_PHPSHOP_ADD_SHIPTO_2 = "Morada para envio";
var $_PHPSHOP_NO_SEARCH_RESULT = "A sua busca devolveu 0 resultados.<BR>";
var $_PHPSHOP_PRICE_LABEL = "Preço: ";
var $_PHPSHOP_ORDER_BUTTON_LABEL = "Encomendar";
var $_PHPSHOP_NO_CUSTOMER = "Sentimos muito mas você não é um clinte registado.<BR>Queira por favor registar-se na nossa loja primeiro.<BR>Obrigado.";
var $_PHPSHOP_DELETE_MSG = "Tem a certeza que quer apagar esta entrada?";
var $_PHPSHOP_THANKYOU = "Obrigado pelo seu pedido.";
var $_PHPSHOP_NOT_SHIPPED = "Ainda não foi enviado.";
var $_PHPSHOP_EMAIL_SENDTO = "Um email de confirmação foi enviado para";
var $_PHPSHOP_NO_USER_TO_SELECT = "Sentimos muito, mas não há nenhum utilizador que possa ser adicionado à lista de utilizadores com_phpshop";

// Error messages

var $_PHPSHOP_ERROR = "ERRO";
var $_PHPSHOP_MOD_NOT_REG =	"Módulo Não Registado.";
var $_PHPSHOP_MOD_ISNO_REG =	"não é um módulo phpShop válido.";
var $_PHPSHOP_MOD_NO_AUTH = "Você não tem permissão para aceder ao módulo requisitado.";
var $_PHPSHOP_PAGE_404_1 = "A página não existe";
var $_PHPSHOP_PAGE_404_2 = "Este arquivo não existe. Não é possivel encontrar o arquivo:";
var $_PHPSHOP_PAGE_403 = "Previlégios Insuficientes";
var $_PHPSHOP_FUNC_NO_EXEC = "Não tem previlégios suficientes para executar ";
var $_PHPSHOP_FUNC_NOT_REG = "Função não Registada";
var $_PHPSHOP_FUNC_ISNO_REG = " não é uma função de MOS_com_phpShop.";

/*#####################
MODULE ADMIN
#####################*/

# Some LABELs
var $_PHPSHOP_ADMIN_MOD = "Administração";


// User Lista
var $_PHPSHOP_USER_LIST_MNU = "Listar Utilizadores";
var $_PHPSHOP_USER_LIST_LBL = "Lista de Utilizadores";
var $_PHPSHOP_USER_LIST_USERNAME = "Username";
var $_PHPSHOP_USER_LIST_FULL_NAME = "Nome Completo";
var $_PHPSHOP_USER_LIST_GROUP = "Grupo";

// User Form
var $_PHPSHOP_USER_FORM_MNU = "Adicionar Utilizador";
var $_PHPSHOP_USER_FORM_LBL = "Adicionar/Actualizar Informação do Utilizador";
var $_PHPSHOP_USER_FORM_BILLTO_LBL = "Informação de Conta A ";
var $_PHPSHOP_USER_FORM_SHIPTO_LBL = "Morada de  Envio";
var $_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL = "Adicionar Morada";
var $_PHPSHOP_USER_FORM_ADDRESS_LABEL = "Morada";
var $_PHPSHOP_USER_FORM_FIRST_NAME = "Primeiro Nome";
var $_PHPSHOP_USER_FORM_LAST_NAME = "Ultimo Nome";
var $_PHPSHOP_USER_FORM_MIDDLE_NAME = "Nome do Meio";
var $_PHPSHOP_USER_FORM_TITLE = "Cargo";
var $_PHPSHOP_USER_FORM_USERNAME = "Utilizador";
var $_PHPSHOP_USER_FORM_PASSWORD_1 = "Password";
var $_PHPSHOP_USER_FORM_PASSWORD_2 = "Confirmar Password";
var $_PHPSHOP_USER_FORM_PERMS = "Previlégios";
var $_PHPSHOP_USER_FORM_COMPANY_NAME = "Empresa";
var $_PHPSHOP_USER_FORM_ADDRESS_1 = "Morada 1";
var $_PHPSHOP_USER_FORM_ADDRESS_2 = "Morada 2";
var $_PHPSHOP_USER_FORM_CITY = "Cidade";
var $_PHPSHOP_USER_FORM_STATE = "Distrito";
var $_PHPSHOP_USER_FORM_ZIP = "Código Postal";
var $_PHPSHOP_USER_FORM_COUNTRY = "País";
var $_PHPSHOP_USER_FORM_PHONE = "Telefone";
var $_PHPSHOP_USER_FORM_FAX = "Fax";
var $_PHPSHOP_USER_FORM_EMAIL = "Correio Electrónico";

// Module Lista
var $_PHPSHOP_MODULE_LIST_MNU = "Listar Módulos";
var $_PHPSHOP_MODULE_LIST_LBL = "Lista de Módulos";
var $_PHPSHOP_MODULE_LIST_NAME = "Módulo";
var $_PHPSHOP_MODULE_LIST_PERMS = "Previlégios";
var $_PHPSHOP_MODULE_LIST_FUNCTIONS = "Funções";
var $_PHPSHOP_MODULE_LIST_ORDER = "Encomendar";

// Module Form
var $_PHPSHOP_MODULE_FORM_MNU = "Adicionar Módulo";
var $_PHPSHOP_MODULE_FORM_LBL = "Informação";
var $_PHPSHOP_MODULE_FORM_MODULE_LABEL = "Etiqueta";
var $_PHPSHOP_MODULE_FORM_NAME = "Nome";
var $_PHPSHOP_MODULE_FORM_PERMS = "Previlégios";
var $_PHPSHOP_MODULE_FORM_HEADER = "Cabeçalho";
var $_PHPSHOP_MODULE_FORM_FOOTER = "Rodapé";
var $_PHPSHOP_MODULE_FORM_MENU = "Menu?";
var $_PHPSHOP_MODULE_FORM_ORDER = "Encomendar";
var $_PHPSHOP_MODULE_FORM_DESCRIPTION = "Descrição";
var $_PHPSHOP_MODULE_FORM_LANGUAGE_CODE = "Código de Idioma";
var $_PHPSHOP_MODULE_FORM_LANGUAGE_file = "Arquivo de Linguagem";

// Function Lista
var $_PHPSHOP_FUNCTION_LIST_MNU = "Listar Funções";
var $_PHPSHOP_FUNCTION_LIST_LBL = "Lista de Funções";
var $_PHPSHOP_FUNCTION_LIST_NAME = "Nome";
var $_PHPSHOP_FUNCTION_LIST_CLASS = "Classe de Nome";
var $_PHPSHOP_FUNCTION_LIST_METHOD = "Classe de Método";
var $_PHPSHOP_FUNCTION_LIST_PERMS = "Previlégios";

// Module Form
var $_PHPSHOP_FUNCTION_FORM_MNU = "Adicionar Função";
var $_PHPSHOP_FUNCTION_FORM_LBL = "Informação";
var $_PHPSHOP_FUNCTION_FORM_NAME = "Nome";
var $_PHPSHOP_FUNCTION_FORM_CLASS = "Classe de Nome";
var $_PHPSHOP_FUNCTION_FORM_METHOD = "Classe de Método";
var $_PHPSHOP_FUNCTION_FORM_PERMS = "Previlégios";
var $_PHPSHOP_FUNCTION_FORM_DESCRIPTION = "Descrição";

// Moeda form and list
var $_PHPSHOP_CURRENCY_LIST_MNU = "Listar moedas";
var $_PHPSHOP_CURRENCY_LIST_LBL = "Lista de moedas";
var $_PHPSHOP_CURRENCY_LIST_ADD = "Adicionar moeda";
var $_PHPSHOP_CURRENCY_LIST_NAME = "Nome da moeda";
var $_PHPSHOP_CURRENCY_LIST_CODE = "Código da moeda";

// País form and list
var $_PHPSHOP_COUNTRY_LIST_MNU = "Listar Países";
var $_PHPSHOP_COUNTRY_LIST_LBL = "Lista de Países";
var $_PHPSHOP_COUNTRY_LIST_ADD = "Adicionar País";
var $_PHPSHOP_COUNTRY_LIST_NAME = "Nome do País";
var $_PHPSHOP_COUNTRY_LIST_3_CODE = "código País (3)";
var $_PHPSHOP_COUNTRY_LIST_2_CODE = "código País (2)";

/*#####################
MODULE CHECKOUT
#####################*/

# Some LABELs
var $_PHPSHOP_ADDRESS = "Morada";
var $_PHPSHOP_CONTINUE = "Continuar";  

# Some messages
var $_PHPSHOP_EMPTY_CART = "O seu carrinho de compras encontra-se de momento vazio.";


/*#####################
MODULE ISShipping
#####################*/

# Some LABELs
var $_PHPSHOP_ISSHIPPING_MOD = "InterShipper";


// Envío Ping
var $_PHPSHOP_ISSHIP_PING_MNU = "Ping Servidor InterShipper";
var $_PHPSHOP_ISSHIP_PING_LBL = "Servidor-InterShipper Ping ";
var $_PHPSHOP_ISSHIP_PING_ERROR_LBL = "Falha em Ping InterShipper";
var $_PHPSHOP_ISSHIP_PING_GOOD_LBL = "Resposta de Ping InterShipper";
var $_PHPSHOP_ISSHIP_PING_CARRIER_LBL = "Carrier";
var $_PHPSHOP_ISSHIP_PING_RESPONSE_LBL = "Tempo de<BR>Resposta";
var $_PHPSHOP_ISSHIP_PING_TIME_LBL = "sec.";

// Envío Lista
var $_PHPSHOP_ISSHIP_LIST_MNU = "Listar Métodos de Envio";
var $_PHPSHOP_ISSHIP_LIST_LBL = "Método de Envio Actual";
var $_PHPSHOP_ISSHIP_LIST_CARRIER_LBL = "Metodo de Envio";
var $_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL = "Activo";
var $_PHPSHOP_ISSHIP_LIST_RATE_LBL = "Despesas de transporte";
var $_PHPSHOP_ISSHIP_LIST_LEAD_LBL = "Tempo de Entrega";
var $_PHPSHOP_ISSHIP_LIST_CHARGE_F_LBL = "tarifa plana";
var $_PHPSHOP_ISSHIP_LIST_CHARGE_P_LBL = "porcento";
var $_PHPSHOP_ISSHIP_LIST_DAYS_LBL = "dias";
var $_PHPSHOP_ISSHIP_LIST_HEAVY_LBL = "Cargas Pesadas";

// Dynamic Envío Form
var $_PHPSHOP_ISSHIP_FORM_MNU = "Configurar Metodo de Envio";
var $_PHPSHOP_ISSHIP_FORM_ADD_LBL = "Adicionar Método de Envio";
var $_PHPSHOP_ISSHIP_FORM_UPDATE_LBL = "Configurar Método de Envio";
var $_PHPSHOP_ISSHIP_FORM_REFRESH_LBL = "Actualizar";
var $_PHPSHOP_ISSHIP_FORM_CARRIER_LBL = "Método de envio";
var $_PHPSHOP_ISSHIP_FORM_PUBLISH_LBL = "Activar";
var $_PHPSHOP_ISSHIP_FORM_HANDLING_LBL = "Despesas de transporte";
var $_PHPSHOP_ISSHIP_FORM_LEAD_LBL = "Tempo de Entrega";
var $_PHPSHOP_ISSHIP_FORM_CHARGE_F_LBL = "tarifa plana";
var $_PHPSHOP_ISSHIP_FORM_CHARGE_P_LBL = "porcento";
var $_PHPSHOP_ISSHIP_FORM_DAYS_LBL = "dias";
var $_PHPSHOP_ISSHIP_FORM_HEAVY_LBL = "Cargas Pesadas";



/*#####################
MODULE ORDER
#####################*/


# Some LABELs
var $_PHPSHOP_ORDER_MOD = "Encomendar";

// Some menu options
var $_PHPSHOP_ORDER_CONFIRM_MNU = "Confirmar Encomenda";
var $_PHPSHOP_ORDER_CANCEL_MNU = "Cancelar Encomenda";
var $_PHPSHOP_ORDER_PRINT_MNU = "Imprimir Encomenda";
var $_PHPSHOP_ORDER_DELETE_MNU = "Apagar Encomenda";

// Orden Lista
var $_PHPSHOP_ORDER_LIST_MNU = "Listar Encomendas";
var $_PHPSHOP_ORDER_LIST_LBL = "Lista de Encomendas";
var $_PHPSHOP_ORDER_LIST_ID = "Número de Encomenda";
var $_PHPSHOP_ORDER_LIST_CDATE = "Data";
var $_PHPSHOP_ORDER_LIST_MDATE = "Última Modificação";
var $_PHPSHOP_ORDER_LIST_STATUS = "Estado";
var $_PHPSHOP_ORDER_LIST_TOTAL = "SubTotal";
var $_PHPSHOP_ORDER_ITEM = "Artigos";

// Orden print
var $_PHPSHOP_ORDER_PRINT_PO_LBL = "Ordem de Compra";
var $_PHPSHOP_ORDER_PRINT_PO_NUMBER = "Número de Encomenda";
var $_PHPSHOP_ORDER_PRINT_PO_DATE = "Data";
var $_PHPSHOP_ORDER_PRINT_PO_STATUS = "Estado";
var $_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL = "Informação do Cliente";
var $_PHPSHOP_ORDER_PRINT_CUST_BILLING_LBL = "Informação de Cobrança";
var $_PHPSHOP_ORDER_PRINT_CUST_SHIPPING_LBL = "Informação de Envio";
var $_PHPSHOP_ORDER_PRINT_BILL_TO_LBL = "Cobrar A";
var $_PHPSHOP_ORDER_PRINT_SHIP_TO_LBL = "Enviar A";
var $_PHPSHOP_ORDER_PRINT_NAME = "Nome";
var $_PHPSHOP_ORDER_PRINT_COMPANY = "Empresa";
var $_PHPSHOP_ORDER_PRINT_ADDRESS_1 = "Morada 1";
var $_PHPSHOP_ORDER_PRINT_ADDRESS_2 = "Morada 2";
var $_PHPSHOP_ORDER_PRINT_CITY = "Cidade";
var $_PHPSHOP_ORDER_PRINT_STATE = "Distrito";
var $_PHPSHOP_ORDER_PRINT_ZIP = "Código Postal";
var $_PHPSHOP_ORDER_PRINT_COUNTRY = "País";
var $_PHPSHOP_ORDER_PRINT_PHONE = "Telefone";
var $_PHPSHOP_ORDER_PRINT_FAX = "Fax";
var $_PHPSHOP_ORDER_PRINT_EMAIL = "Email";
var $_PHPSHOP_ORDER_PRINT_ITEMs_LBL = "Ordenar Artigos";
var $_PHPSHOP_ORDER_PRINT_QUANTITY = "Quantidade";
var $_PHPSHOP_ORDER_PRINT_QTY = "Quantidade";
var $_PHPSHOP_ORDER_PRINT_SKU = "SKU";
var $_PHPSHOP_ORDER_PRINT_PRICE = "Preço";
var $_PHPSHOP_ORDER_PRINT_TOTAL = "Total";
var $_PHPSHOP_ORDER_PRINT_SUBTOTAL = "SubTotal";
var $_PHPSHOP_ORDER_PRINT_TOTAL_TAX = "Total de IVA";
var $_PHPSHOP_ORDER_PRINT_SHIPPING = "Envio";
var $_PHPSHOP_ORDER_PRINT_SHIPPING_TAX = "IVA";
var $_PHPSHOP_ORDER_PRINT_PAYMENT_LBL = "Método de Pagamento";
var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NAME = "Nome da Conta";
var $_PHPSHOP_ORDER_PRINT_ACCOUNT_NUMBER = "Número da Conta";
var $_PHPSHOP_ORDER_PRINT_EXPIRE_DATE = "Data de Expiração";
var $_PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL = "Registo de Pagamento";
var $_PHPSHOP_ORDER_PRINT_SHIPPING_LBL = "Informação de Envio";
var $_PHPSHOP_ORDER_PRINT_PAYINFO_LBL = "Informacão de Pagamento";
var $_PHPSHOP_ORDER_PRINT_SHIPPING_CARRIER_LBL = "Carrier";
var $_PHPSHOP_ORDER_PRINT_SHIPPING_MODE_LBL = "Modo de Envio";
var $_PHPSHOP_ORDER_PRINT_SHIPPING_DATE_LBL = "Data de Envio";
var $_PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL = "Preço de Envio";

var $_PHPSHOP_ORDER_STATUS_LIST_MNU = "Listar Estado de Encomendas";
var $_PHPSHOP_ORDER_STATUS_FORM_MNU = "Adicionar Estado de Encomenda";

var $_PHPSHOP_ORDER_STATUS_LIST_CODE = "Código de Estado de Encomenda";
var $_PHPSHOP_ORDER_STATUS_LIST_NAME = "Nome de Estado de Encomenda";

var $_PHPSHOP_ORDER_STATUS_FORM_LBL = "Estado Encomenda";
var $_PHPSHOP_ORDER_STATUS_FORM_CODE = "Código de Estado de Encomenda";
var $_PHPSHOP_ORDER_STATUS_FORM_NAME = "Nome de Estado de Encomenda";
var $_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER = "Listar Encomenda";


/*#####################
MODULE PRODUCT
#####################*/

# Some LABELs
var $_PHPSHOP_PRODUCT_MOD = "Produtos";

var $_PHPSHOP_CURRENT_PRODUCT = "Produto Actual";
var $_PHPSHOP_CURRENT_ITEM = "Artigo Actual";

// Produto Inventory
var $_PHPSHOP_PRODUCT_INVENTORY_LBL = "Inventário de Produtos";
var $_PHPSHOP_PRODUCT_INVENTORY_MNU = "Ver Inventário";
var $_PHPSHOP_PRODUCT_INVENTORY_PRICE = "Preço";
var $_PHPSHOP_PRODUCT_INVENTORY_STOCK = "Número";
var $_PHPSHOP_PRODUCT_INVENTORY_WEIGHT = "Peso";
// Produto Lista
var $_PHPSHOP_PRODUCT_LIST_MNU = "Listar Produtos";
var $_PHPSHOP_PRODUCT_LIST_LBL = "Lista de Produtos";
var $_PHPSHOP_PRODUCT_LIST_NAME = "Nome";
var $_PHPSHOP_PRODUCT_LIST_SKU = "SKU";
var $_PHPSHOP_PRODUCT_LIST_PUBLISH = "Publicar";

// Produto Form
var $_PHPSHOP_PRODUCT_FORM_MNU = "Adicionar Produto";
var $_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT = "Editar este Produto";
var $_PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE = "Ver flyer de Produtos nesta loja";
var $_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU = "Adicionar Artigo";
var $_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU = "Adicionar Outro Artigo";

var $_PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL = "Novo Produto";
var $_PHPSHOP_PRODUCT_FORM_UPDATE_PRODUCT_LBL = "Actualizar Produto";
var $_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL = "Informação do Produto";
var $_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL = "Estado";
var $_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL = "Dimensões e Peso";
var $_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL = "Imagens";

var $_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL = "Novo Artigo";
var $_PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL = "Actualizar Artigo";
var $_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL = "Informação";
var $_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL = "Estado";
var $_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL = "Dimensões e Peso";
var $_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL = "Imagens";
var $_PHPSHOP_PRODUCT_FORM_RETURN_LBL = "Regressar ao produto parente";
var $_PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL = "Para actualizar a imagem actual, vá ao directorio e insira a nova imagem.";
var $_PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL = "Escreva \"none\" para apagar a actual.";
var $_PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL = "Artigos";
var $_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL = "Qualidades";
var $_PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG = "Tem a certeza que quer apagar este produto\\ne e todos os artigos relacionados com ele?";
var $_PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG = "Tem a certeza que quer apagar este Artigo?";
var $_PHPSHOP_PRODUCT_FORM_VENDOR = "Fornecedor";
var $_PHPSHOP_PRODUCT_FORM_MANUFACTURER = "Fabricante";
var $_PHPSHOP_PRODUCT_FORM_SKU = "SKU";
var $_PHPSHOP_PRODUCT_FORM_NAME = "Nome";
var $_PHPSHOP_PRODUCT_FORM_URL = "URL";
var $_PHPSHOP_PRODUCT_FORM_CATEGORY = "Categoria";
var $_PHPSHOP_PRODUCT_FORM_PRICE_GROSS = "Preço de Retalho";
var $_PHPSHOP_PRODUCT_FORM_PRICE_NET = "Product Price (Net)";
var $_PHPSHOP_PRODUCT_FORM_DESCRIPTION = "Descrição";
var $_PHPSHOP_PRODUCT_FORM_S_DESC = "Pequena descrição";
var $_PHPSHOP_PRODUCT_FORM_IN_STOCK = "Em Inventário";
var $_PHPSHOP_PRODUCT_FORM_ON_ORDER = "Em Encomenda";
var $_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE = "Data de disponibilidade";
var $_PHPSHOP_PRODUCT_FORM_SPECIAL = "Em especial";
var $_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE = "Tipo de Desconto";
var $_PHPSHOP_PRODUCT_FORM_PUBLISH = "Publicar?";
var $_PHPSHOP_PRODUCT_FORM_LENGTH = "Tamanho";
var $_PHPSHOP_PRODUCT_FORM_WIDTH = "Largura";
var $_PHPSHOP_PRODUCT_FORM_HEIGHT = "Altura";
var $_PHPSHOP_PRODUCT_FORM_DIMENSION_UOM = "Unidade de Medida";
var $_PHPSHOP_PRODUCT_FORM_WEIGHT = "Peso";
var $_PHPSHOP_PRODUCT_FORM_WEIGHT_UOM = "Unidade de Medida";
var $_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE = "Pequena Imagem";
var $_PHPSHOP_PRODUCT_FORM_FULL_IMAGE = "Imagem Completa";

// Produto Display
var $_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL = "Resultados de Adicionar Produto";
var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL = "Resultados de Actualizar Produto";
var $_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL = "Resultados de Adicionar Artículo";
var $_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL = "Resultados de Actualizar Artículo";
var $_PHPSHOP_PRODUCT_CSV_UPLOAD = "Carregar CSV";
var $_PHPSHOP_PRODUCT_FOLDERS = "Directórios de Produtos";

// Produto Categoria Lista
var $_PHPSHOP_CATEGORY_LIST_MNU = "Lista de Categorias";
var $_PHPSHOP_CATEGORY_LIST_LBL = "Categorias";

// Produto Categoria Form
var $_PHPSHOP_CATEGORY_FORM_MNU = "Adicionar Categoria";
var $_PHPSHOP_CATEGORY_FORM_LBL = "Informação";
var $_PHPSHOP_CATEGORY_FORM_NAME = "Nome";
var $_PHPSHOP_CATEGORY_FORM_PARENT = "Parente";
var $_PHPSHOP_CATEGORY_FORM_DESCRIPTION = "Descrição da Categoria";
var $_PHPSHOP_CATEGORY_FORM_PUBLISH = "Publicar?";
var $_PHPSHOP_CATEGORY_FORM_FLYPAGE = "Flypage da Categoria";

// Produto Cualidad Lista
var $_PHPSHOP_ATTRIBUTE_LIST_MNU = "Listar Atributos";
var $_PHPSHOP_ATTRIBUTE_LIST_LBL = "Listar Atributos por";
var $_PHPSHOP_ATTRIBUTE_LIST_NAME = "Nome Atributos";
var $_PHPSHOP_ATTRIBUTE_LIST_ORDER = "Listar Encomenda";

// Produto Cualidad Form
var $_PHPSHOP_ATTRIBUTE_FORM_MNU = "Adicionar Atributos";
var $_PHPSHOP_ATTRIBUTE_FORM_LBL = "Formulario Atributos";
var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT = "Novo Atributo de Produto";
var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT = "Actualizar Atributos de Produto";
var $_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM = "Novo Atributo de Produto";
var $_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM = "Actualizar Atributos de Produto";
var $_PHPSHOP_ATTRIBUTE_FORM_NAME = "Nome Atributo";
var $_PHPSHOP_ATTRIBUTE_FORM_ORDER = "Listar Encomendas";

// Produto Precio Lista
var $_PHPSHOP_PRICE_LIST_MNU = "Listar Categorias";
var $_PHPSHOP_PRICE_LIST_LBL = "Lista de Preços";
var $_PHPSHOP_PRICE_LIST_FOR_LBL = "Preços por";
var $_PHPSHOP_PRICE_LIST_GROUP_NAME = "Grupo";
var $_PHPSHOP_PRICE_LIST_PRICE = "Preço";
var $_PHPSHOP_PRODUCT_LIST_CURRENCY = "Moeda";

// Produto Precio Form
var $_PHPSHOP_PRICE_FORM_MNU = "Adicionar Preço";
var $_PHPSHOP_PRICE_FORM_LBL = "Informação";
var $_PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT = "Novo Preço de Produto";
var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT = "Actualizar Preço de Produto";
var $_PHPSHOP_PRICE_FORM_NEW_FOR_ITEM = "Novo Preço de Produto";
var $_PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM = "Actualizar Preço de Produto";
var $_PHPSHOP_PRICE_FORM_PRICE = "Preço";
var $_PHPSHOP_PRICE_FORM_CURRENCY = "Moeda";
var $_PHPSHOP_PRICE_FORM_GROUP = "Grupo de Cliente";


/*#####################
MODULE REPORT BASIC
#####################*/
# Some LABELs
var $_PHPSHOP_REPORTBASIC_MOD = "Relatório Básico";
var $_PHPSHOP_RB_INDIVIDUAL = "Lista Individual de Produtos";
var $_PHPSHOP_RB_SALE_TITLE = "Relatório de Vendas";

/* labels por rpt_sales */
var $_PHPSHOP_RB_SALES_PAGE_TITLE = "Actividade de Vendas";

var $_PHPSHOP_RB_INTERVAL_TITLE = "Escrever Intervalo";
var $_PHPSHOP_RB_INTERVAL_MONTHLY_TITLE = "Mensal";
var $_PHPSHOP_RB_INTERVAL_WEEKLY_TITLE = "Semanal";
var $_PHPSHOP_RB_INTERVAL_DAILY_TITLE = "Diário";

var $_PHPSHOP_RB_THISMONTH_BUTTON = "Este Mes";
var $_PHPSHOP_RB_LASTMONTH_BUTTON = "Último Mes";
var $_PHPSHOP_RB_LAST60_BUTTON = "Últimos 60 dias";
var $_PHPSHOP_RB_LAST90_BUTTON = "Últimos 90 dias";

var $_PHPSHOP_RB_START_DATE_TITLE = "Começar em";
var $_PHPSHOP_RB_END_DATE_TITLE = "Acabar em";
var $_PHPSHOP_RB_SHOW_SEL_RANGE = "Mostrar a gama seleccionada";
var $_PHPSHOP_RB_REPORT_FOR = "Relatar para ";
var $_PHPSHOP_RB_DATE = "Data";
var $_PHPSHOP_RB_ORDERS = "Ordens";
var $_PHPSHOP_RB_TOTAL_ITEMS = "Total de Artigos vendidos";
var $_PHPSHOP_RB_REVENUE = "Ganhos";
var $_PHPSHOP_RB_PRODLIST = "Lista de Produtos";



/*#####################
MODULE SHOP
#####################*/

# Some LABELs
var $_PHPSHOP_SHOP_MOD = "Loja";
var $_PHPSHOP_PRODUCT_THUMB_TITLE = "Imagem pequena";
var $_PHPSHOP_PRODUCT_PRICE_TITLE = "Preço";
var $_PHPSHOP_ORDER_STATUS_P = "Pendente";
var $_PHPSHOP_ORDER_STATUS_C = "Confirmado";
var $_PHPSHOP_ORDER_STATUS_X = "Cancelado";


# Some messages
var $_PHPSHOP_ORDER_BUTTON = "Ordenar";



/*#####################
MODULE SHOPPER
#####################*/

# Some LABELs
var $_PHPSHOP_SHOPPER_MOD = "Cliente";



// Cliente Lista
var $_PHPSHOP_SHOPPER_LIST_MNU = "Listar Clientes";
var $_PHPSHOP_SHOPPER_LIST_LBL = "Lista de Clientes";
var $_PHPSHOP_SHOPPER_LIST_USERNAME = "Username";
var $_PHPSHOP_SHOPPER_LIST_NAME = "Nome Completo";
var $_PHPSHOP_SHOPPER_LIST_GROUP = "Grupo";

// Cliente Form
var $_PHPSHOP_SHOPPER_FORM_MNU = "Adicionar Cliente";
var $_PHPSHOP_SHOPPER_FORM_LBL = "Informação";
var $_PHPSHOP_SHOPPER_FORM_BILLTO_LBL = "Informação de Cobrar A";
var $_PHPSHOP_SHOPPER_FORM_ADDRESS_INFO_LBL = "Informação";
var $_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL = "Informação de Envio";
var $_PHPSHOP_SHOPPER_FORM_ADD_SHIPTO_LBL = "Adicionar Morada";
var $_PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL = "Morada 2";
var $_PHPSHOP_SHOPPER_FORM_USERNAME = "Username";
var $_PHPSHOP_SHOPPER_FORM_FIRST_NAME = "Primeiro Nome";
var $_PHPSHOP_SHOPPER_FORM_LAST_NAME = "Ultimo Nome";
var $_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME = "Nome do Meio";
var $_PHPSHOP_SHOPPER_FORM_TITLE = "Título";
var $_PHPSHOP_SHOPPER_FORM_SHOPPERNAME = "Nome do Cliente";
var $_PHPSHOP_SHOPPER_FORM_PASSWORD_1 = "Password";
var $_PHPSHOP_SHOPPER_FORM_PASSWORD_2 = "Confirmar Password";
var $_PHPSHOP_SHOPPER_FORM_GROUP = "Grupo";
var $_PHPSHOP_SHOPPER_FORM_COMPANY_NAME = "Nome da Empresa";
var $_PHPSHOP_SHOPPER_FORM_ADDRESS_1 = "Morada 1";
var $_PHPSHOP_SHOPPER_FORM_ADDRESS_2 = "Morada 2";
var $_PHPSHOP_SHOPPER_FORM_CITY = "Cidade";
var $_PHPSHOP_SHOPPER_FORM_STATE = "Distrito";
var $_PHPSHOP_SHOPPER_FORM_ZIP = "Código Postal";
var $_PHPSHOP_SHOPPER_FORM_COUNTRY = "País";
var $_PHPSHOP_SHOPPER_FORM_PHONE = "Telefone";
var $_PHPSHOP_SHOPPER_FORM_FAX = "Fax";
var $_PHPSHOP_SHOPPER_FORM_EMAIL = "Email";

// Cliente Grupo Lista
var $_PHPSHOP_SHOPPER_GROUP_LIST_MNU = "Listar Grupos de Clientes";
var $_PHPSHOP_SHOPPER_GROUP_LIST_LBL = "Lista de Grupos de Clientes";
var $_PHPSHOP_SHOPPER_GROUP_LIST_NAME = "Nome";
var $_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION = "Descrição";


// Cliente Grupo Form
var $_PHPSHOP_SHOPPER_GROUP_FORM_LBL = "Formulário de Grupos de Clientes";
var $_PHPSHOP_SHOPPER_GROUP_FORM_MNU = "Adicionar Grupo de Clientes";
var $_PHPSHOP_SHOPPER_GROUP_FORM_NAME = "Nome";
var $_PHPSHOP_SHOPPER_GROUP_FORM_DESC = "Descrição";




/*#####################
MODULE SHOPPER
#####################*/

# Some LABELs
var $_PHPSHOP_STORE_MOD = "Loja";


// Tenda Form
var $_PHPSHOP_STORE_FORM_MNU = "Editar Loja";
var $_PHPSHOP_STORE_FORM_LBL = "Informação sobre a Loja";
var $_PHPSHOP_STORE_FORM_CONTACT_LBL = "Informação do Contacto";
var $_PHPSHOP_STORE_FORM_FULL_IMAGE = "Imagem";
var $_PHPSHOP_STORE_FORM_UPLOAD = "Enviar Imagem para o servidor";
var $_PHPSHOP_STORE_FORM_STORE_NAME = "Nome da Loja";
var $_PHPSHOP_STORE_FORM_COMPANY_NAME = "Nome da Empresa";
var $_PHPSHOP_STORE_FORM_ADDRESS_1 = "Morada 1";
var $_PHPSHOP_STORE_FORM_ADDRESS_2 = "Morada 2";
var $_PHPSHOP_STORE_FORM_CITY = "Cidade";
var $_PHPSHOP_STORE_FORM_STATE = "Distrito";
var $_PHPSHOP_STORE_FORM_COUNTRY = "País";
var $_PHPSHOP_STORE_FORM_ZIP = "Código Postal";
var $_PHPSHOP_STORE_FORM_PHONE = "Telefone";
var $_PHPSHOP_STORE_FORM_CURRENCY = "Moeda";
var $_PHPSHOP_STORE_FORM_CATEGORY = "Categoria";
var $_PHPSHOP_STORE_FORM_LAST_NAME = "Ultimo Nome";
var $_PHPSHOP_STORE_FORM_FIRST_NAME = "Primeiro Nome";
var $_PHPSHOP_STORE_FORM_MIDDLE_NAME = "Nome do Meio";
var $_PHPSHOP_STORE_FORM_TITLE = "Título";
var $_PHPSHOP_STORE_FORM_PHONE_1 = "Telefone 1";
var $_PHPSHOP_STORE_FORM_PHONE_2 = "Telefone 2";
var $_PHPSHOP_STORE_FORM_FAX = "Fax";
var $_PHPSHOP_STORE_FORM_EMAIL = "Email";
var $_PHPSHOP_STORE_FORM_IMAGE_PATH = "Directorio para a Imagem";
var $_PHPSHOP_STORE_FORM_DESCRIPTION = "Descrição";



var $_PHPSHOP_PAYMENT = "Pagamento";
// Pagamento Método Lista
var $_PHPSHOP_PAYMENT_METHOD_LIST_MNU = "Listar Métodos de Pagamento";
var $_PHPSHOP_PAYMENT_METHOD_LIST_LBL = "Lista de Métodos de Pagamento";
var $_PHPSHOP_PAYMENT_METHOD_LIST_NAME = "Nome";
var $_PHPSHOP_PAYMENT_METHOD_LIST_CODE = "Código";
var $_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT = "Desconto";
var $_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP = "Grupo de Cliente";
var $_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR = "Cybercash";

// Pagamento Método Form
var $_PHPSHOP_PAYMENT_METHOD_FORM_MNU = "Adicionar Método de Pagamento";
var $_PHPSHOP_PAYMENT_METHOD_FORM_LBL = "Formulario Método de Pagamento";
var $_PHPSHOP_PAYMENT_METHOD_FORM_NAME = "Nome Formulario de Pagamento";
var $_PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP = "Grupo de Cliente";
var $_PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT = "Desconto";
var $_PHPSHOP_PAYMENT_METHOD_FORM_CODE = "Código";
var $_PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER = "Listar Encomendas";
var $_PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR = "Usar Cybercash";



/*#####################
MODULE TAX
#####################*/


# Some LABELs
var $_PHPSHOP_TAX_MOD = "IVA";

// User Lista
var $_PHPSHOP_TAX_RATE = "Tarifas de Encomenda";
var $_PHPSHOP_TAX_LIST_MNU = "Listar Tarifas de IVA";
var $_PHPSHOP_TAX_LIST_LBL = "Lista Tarifas de Imposto";
var $_PHPSHOP_TAX_LIST_STATE = "Impostos por Distrito ou Região";
var $_PHPSHOP_TAX_LIST_COUNTRY = "Impostos no País";
var $_PHPSHOP_TAX_LIST_RATE = "Tarifas de Imposto";

// User Form
var $_PHPSHOP_TAX_FORM_MNU = "Adicionar Imposto Rate";
var $_PHPSHOP_TAX_FORM_LBL = "Adicionar Imposto Informação";
var $_PHPSHOP_TAX_FORM_STATE = "Imposto por Distrito ou Região";
var $_PHPSHOP_TAX_FORM_COUNTRY = "Imposto do País";
var $_PHPSHOP_TAX_FORM_RATE = "Tarifas de Imposto";




/*#####################
MODULE VENDOR
#####################*/



# Some LABELs
var $_PHPSHOP_VENDOR_MOD = "Vendedor";
var $_PHPSHOP_VENDOR_ADMIN = "Vendedores";


// Vendedor Lista
var $_PHPSHOP_VENDOR_LIST_MNU = "Lista de Vendedores";
var $_PHPSHOP_VENDOR_LIST_LBL = "Lista de Vendedores";
var $_PHPSHOP_VENDOR_LIST_VENDOR_NAME = "Nome";
var $_PHPSHOP_VENDOR_LIST_ADMIN = "Admin";

// Vendedor Form
var $_PHPSHOP_VENDOR_FORM_MNU = "Adicionar Vendedor";
var $_PHPSHOP_VENDOR_FORM_LBL = "Adicionar Informação";
var $_PHPSHOP_VENDOR_FORM_INFO_LBL = "Informação";
var $_PHPSHOP_VENDOR_FORM_CONTACT_LBL = "Contacto para Informação";
var $_PHPSHOP_VENDOR_FORM_FULL_IMAGE = "Imagem";
var $_PHPSHOP_VENDOR_FORM_UPLOAD = "Enviar imagem para o servidor";
var $_PHPSHOP_VENDOR_FORM_STORE_NAME = "Nome do Vendedor da Loja";
var $_PHPSHOP_VENDOR_FORM_COMPANY_NAME = "Nome do Vendedor da Empresa";
var $_PHPSHOP_VENDOR_FORM_ADDRESS_1 = "Morada 1";
var $_PHPSHOP_VENDOR_FORM_ADDRESS_2 = "Morada 2";
var $_PHPSHOP_VENDOR_FORM_CITY = "Cidade";
var $_PHPSHOP_VENDOR_FORM_STATE = "Distrito";
var $_PHPSHOP_VENDOR_FORM_COUNTRY = "País";
var $_PHPSHOP_VENDOR_FORM_ZIP = "Código Postal";
var $_PHPSHOP_VENDOR_FORM_PHONE = "Telefone";
var $_PHPSHOP_VENDOR_FORM_CURRENCY = "Moeda";
var $_PHPSHOP_VENDOR_FORM_CATEGORY = "Categoria";
var $_PHPSHOP_VENDOR_FORM_LAST_NAME = "Ultimo Nome";
var $_PHPSHOP_VENDOR_FORM_FIRST_NAME = "Primeiro Nome";
var $_PHPSHOP_VENDOR_FORM_MIDDLE_NAME = "Nome do Meio";
var $_PHPSHOP_VENDOR_FORM_TITLE = "Título";
var $_PHPSHOP_VENDOR_FORM_PHONE_1 = "Telefone 1";
var $_PHPSHOP_VENDOR_FORM_PHONE_2 = "Telefone 2";
var $_PHPSHOP_VENDOR_FORM_FAX = "Fax";
var $_PHPSHOP_VENDOR_FORM_EMAIL = "Email";
var $_PHPSHOP_VENDOR_FORM_IMAGE_PATH = "Directorio de Imagens";
var $_PHPSHOP_VENDOR_FORM_DESCRIPTION = "Descrição";


// Vendedor Categoria Lista
var $_PHPSHOP_VENDOR_CAT_LIST_MNU = "Lista de Categorias de Vendedor";
var $_PHPSHOP_VENDOR_CAT_LIST_LBL = "Lista da Categoria de Vendedores";
var $_PHPSHOP_VENDOR_CAT_NAME = "Nome da Categoria";
var $_PHPSHOP_VENDOR_CAT_DESCRIPTION = "Descrição";
var $_PHPSHOP_VENDOR_CAT_VENDORS = "Vendedores";

// Vendedor Categoria Form
var $_PHPSHOP_VENDOR_CAT_FORM_MNU = "Adicionar Categoria de Vendedor";
var $_PHPSHOP_VENDOR_CAT_FORM_LBL = "Formulario de Categoria de Vendedor";
var $_PHPSHOP_VENDOR_CAT_FORM_INFO_LBL = "Informação";
var $_PHPSHOP_VENDOR_CAT_FORM_NAME = "Nome da Categoria";
var $_PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION = "Descrição";


/*#####################
MODULE MANUFACTURER
#####################*/

# Some LABELs
var $_PHPSHOP_MANUFACTURER_MOD = "Fabricante";
var $_PHPSHOP_MANUFACTURER_ADMIN = "Fabricantes";
    
// Manufacturer List
var $_PHPSHOP_MANUFACTURER_LIST_MNU = "Listar Fabricantes";
var $_PHPSHOP_MANUFACTURER_LIST_LBL = "Listar Fabricante";
var $_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME = "Nome do Fabricante";
var $_PHPSHOP_MANUFACTURER_LIST_ADMIN = "Administração";

// Manufacturer Form
var $_PHPSHOP_MANUFACTURER_FORM_MNU = "Adicionar Fabricante";
var $_PHPSHOP_MANUFACTURER_FORM_LBL = "Adiocionar informação";
var $_PHPSHOP_MANUFACTURER_FORM_INFO_LBL = "Informação do Fabricante";
var $_PHPSHOP_MANUFACTURER_FORM_NAME = "Nome do Fabricante";
var $_PHPSHOP_MANUFACTURER_FORM_CATEGORY = "Categoria do Fabricante";
var $_PHPSHOP_MANUFACTURER_FORM_EMAIL = "Email";
var $_PHPSHOP_MANUFACTURER_FORM_URL = "Página do Fabricante";
var $_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION = "Descrição";


// Manufacturer Category List
var $_PHPSHOP_MANUFACTURER_CAT_LIST_MNU = "Listar as categorias do Fabricante";
var $_PHPSHOP_MANUFACTURER_CAT_LIST_LBL = "Listar a categoria do Fabricante";
var $_PHPSHOP_MANUFACTURER_CAT_NAME = "Nome da Categoria";
var $_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION = "Descrição da Categoria";
var $_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS = "Fabricantes";

// Manufacturer Category Form
var $_PHPSHOP_MANUFACTURER_CAT_FORM_MNU = "Adicionar Categoria do Fabricante";
var $_PHPSHOP_MANUFACTURER_CAT_FORM_LBL = "Detalhes da Categoria do Fabricante";
var $_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL = "Informação da Categoria";
var $_PHPSHOP_MANUFACTURER_CAT_FORM_NAME = "Nome da Categoria";
var $_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION = "Descrição da Categoria";
    

/*#####################
Modulo Help
#####################*/
var $_PHPSHOP_HELP_MOD = "Ajuda";

// 210104 start

var $_PHPSHOP_CART_ACTION = "Acções";
var $_PHPSHOP_CART_UPDATE = "Actualizar";
var $_PHPSHOP_CART_DELETE = "Apagar";

//shopbrowse form

var $_PHPSHOP_PRODUCT_PRICETAG = "Preço";
var $_PHPSHOP_PRODUCT_CALL = "Chamar para saber o Preço";
var $_PHPSHOP_PRODUCT_PREVIOUS = "Anterior";
var $_PHPSHOP_PRODUCT_NEXT = "Seguinte";

//ro_basket

var $_PHPSHOP_CART_TAX = "Imposto";
var $_PHPSHOP_CART_SHIPPING = "Envio";
var $_PHPSHOP_CART_TOTAL = "Total";

//CHECKOUT.INDEX

var $_PHPSHOP_CHECKOUT_NEXT = "Próximo";
var $_PHPSHOP_CHECKOUT_REGISTER = "Registar-se";

//CHECKOUT.CONFIRM

var $_PHPSHOP_CHECKOUT_CONF_BILLINFO = "Informação de Pagamento";
var $_PHPSHOP_CHECKOUT_CONF_COMPANY = "Empresa";
var $_PHPSHOP_CHECKOUT_CONF_NAME = "Nome";
var $_PHPSHOP_CHECKOUT_CONF_ADDRESS = "Morada";
var $_PHPSHOP_CHECKOUT_CONF_PHONE = "Telefone";
var $_PHPSHOP_CHECKOUT_CONF_FAX = "Fax";
var $_PHPSHOP_CHECKOUT_CONF_EMAIL = "Email";
var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO = "Informação de Envio";
var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY = "Empresa";
var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME = "Nome";
var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS = "Morada";
var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE = "Telefone";
var $_PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX = "Fax";
var $_PHPSHOP_CHECKOUT_CONF_PAYINFO = "Informação de Pagamento";
var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD = "Nome no cartão";
var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD = "Método de Pagamento";
var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM = "Número de Cartão de Crédito";
var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE = "Data de Expiração";
var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER = "Completar a Encomenda";
var $_PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO = "Informação requerida quando Pagamento via Cartão de Crédito é seleccionada";


var $_PHPSHOP_ZONE_MOD = "Envio por Zonas";

var $_PHPSHOP_ZONE_LIST_MNU = "Listar Zonas";
var $_PHPSHOP_ZONE_FORM_MNU = "Adicionar Zona";
var $_PHPSHOP_ZONE_ASSIGN_MNU = "Atribuir Zona";

// assign zone List
var $_PHPSHOP_ZONE_ASSIGN_COUNTRY_LBL = "País";
var $_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL = "Zona Actual";
var $_PHPSHOP_ZONE_ASSIGN_ASSIGN_LBL = "Atribuir Zona";
var $_PHPSHOP_ZONE_ASSIGN_UPDATE_LBL = "Actualizar";
var $_PHPSHOP_ASSIGN_ZONE_PG_LBL = "Atribuir Zonas";

// zone Form
var $_PHPSHOP_ZONE_FORM_NAME_LBL = "Nome da Zona";
var $_PHPSHOP_ZONE_FORM_DESC_LBL = "Descrição da Zona";
var $_PHPSHOP_ZONE_FORM_COST_PER_LBL = "Custo por Zona Por Artigo";
var $_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL = "Limite de Custo da Zona";

// List of zones
var $_PHPSHOP_ZONE_LIST_LBL = "Lista das Zonas";
var $_PHPSHOP_ZONE_LIST_NAME_LBL = "Nome da Zona";
var $_PHPSHOP_ZONE_LIST_DESC_LBL = "Descrição da Zona";
var $_PHPSHOP_ZONE_LIST_COST_PER_LBL = "Custo da Zona Por Artigo";
var $_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL = "Límite de Custo da Zona";

var $_PHPSHOP_LOGIN_FIRST = "Por favor, identifique-se ou registe-se na loja primeiro.<br>Obrigado.";
var $_PHPSHOP_STORE_FORM_TOS = "Termos do Serviço";
var $_PHPSHOP_AGREE_TO_TOS = "Por favor, concorde com os Termos de Serviço primeiro.";
var $_PHPSHOP_I_AGREE_TO_TOS = "Concordo com os Termos de Serviço";

var $_PHPSHOP_LEAVE_BLANK = "(deixar em BRANCO se não tiver<br />nenhum arquivo php individual)";
var $_PHPSHOP_RETURN_LOGIN = "É cliente registado? Por favor identifique-se"; 
var $_PHPSHOP_NEW_CUSTOMER = "Novo(a) cliente? Por favor disponibilize os dados para facturação"; 
var $_PHPSHOP_ACC_CUSTOMER_ACCOUNT = "Conta de Cliente:"; 
var $_PHPSHOP_ACC_ORDER_INFO = "Informação de Encomenda"; 
var $_PHPSHOP_ACC_UPD_BILL = "Aqui pode encontrar os dados de facturação."; 
var $_PHPSHOP_ACC_UPD_SHIP = "Aqui pode adicionar ou actualizar a morada para envio."; 
var $_PHPSHOP_ACC_ACCOUNT_INFO = "Informação de Conta"; 
var $_PHPSHOP_ACC_SHIP_INFO = "Informação de Envio"; 
var $_PHPSHOP_ACC_NO_ORDERS = "Não há encomendas para mostrar"; 
var $_PHPSHOP_ACC_BILL_DEF = "- Por defeito (igual ao de facturação)"; 
var $_PHPSHOP_SHIPTO_TEXT = "Você pode adicionar moradas de envio à sua conta. Por favor pense num apelido ou código para a morada que seleccionar em baixo."; 
var $_PHPSHOP_CONFIG = "Configuração"; 
var $_PHPSHOP_USERS = "Utilizadores"; 
var $_PHPSHOP_IS_CC_PAYMENT = "É pago com cartão de crédito?"; 

/*#####################################################
 MODULE SHIPPING
#######################################################*/
var $_PHPSHOP_SHIPPING_MOD = "Administração de Transportes";
var $_PHPSHOP_SHIPPING_MENU_LABEL = "Transportes";

var $_PHPSHOP_CARRIER_LIST_MNU = "Transportador";
var $_PHPSHOP_CARRIER_LIST_LBL = "Lista de Transportadores";
var $_PHPSHOP_RATE_LIST_MNU = "Taxas de Transporte";
var $_PHPSHOP_RATE_LIST_LBL = "Lista de Taxas de Transporte";
var $_PHPSHOP_CARRIER_LIST_NAME_LBL = "Nome";
var $_PHPSHOP_CARRIER_LIST_ORDER_LBL = "Ordem de Listagem (número)";

var $_PHPSHOP_CARRIER_FORM_MNU = "Novo Transportador";
var $_PHPSHOP_CARRIER_FORM_LBL = "Editar/Criar Transportador";
var $_PHPSHOP_RATE_FORM_MNU = "Nova Taxa de Transporte";
var $_PHPSHOP_RATE_FORM_LBL = "Editar/Criar Taxa de Transporte";

var $_PHPSHOP_RATE_FORM_NAME = "Descrição da Taxa de Transporte";
var $_PHPSHOP_RATE_FORM_CARRIER = "Transportador";
var $_PHPSHOP_RATE_FORM_COUNTRY = "País";
var $_PHPSHOP_RATE_FORM_ZIP_START = "Início do intervalo de Códigos Postais";
var $_PHPSHOP_RATE_FORM_ZIP_END = "Fim do intervalo de Códigos Postais";
var $_PHPSHOP_RATE_FORM_WEIGHT_START = "Peso minimo";
var $_PHPSHOP_RATE_FORM_WEIGHT_END = "Peso máximo";
var $_PHPSHOP_RATE_FORM_VALUE = "Taxa";
var $_PHPSHOP_RATE_FORM_PACKAGE_FEE = "A taxa da sua encomenda";
var $_PHPSHOP_RATE_FORM_CURRENCY = "Moeda";
var $_PHPSHOP_RATE_FORM_VAT_ID = "VAT Id";
var $_PHPSHOP_RATE_FORM_LIST_ORDER = "Ordem de Listagem (número)";

var $_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL = "Transportador";
var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME = "Descrição da taxa de Transporte";
var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART = "Peso a partir de ...";
var $_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND = "... até";
var $_PHPSHOP_CARRIER_FORM_NAME = "Empresa Transportadora";
var $_PHPSHOP_CARRIER_FORM_LIST_ORDER = "Ordem de Listagem (número)";

var $_PHPSHOP_ERR_MSG_CARRIER_EXIST = "ERRO: Transportador ID já existe.";
var $_PHPSHOP_ERR_MSG_CARRIER_ID_REQ = "ERRO: Escolha um transportador.";
var $_PHPSHOP_ERR_MSG_CARRIER_INUSE = "ERRO: Pelo menos uma taxa de transporte existe, apague as taxas posteriores ao transportador";
var $_PHPSHOP_ERR_MSG_CARRIER_NOTFOUND = "ERRO: Não foi encontrado nenhum transportador com este ID.";

var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_REQ = "ERRO: Escolha um transportador.";
var $_PHPSHOP_ERR_MSG_RATE_CARRIER_ID_INV = "ERRO: Não foi encontrado nenhum transportador com este ID.";
var $_PHPSHOP_ERR_MSG_RATE_NAME_REQ = "ERRO: É obrigatória uma descrição da taxa.";
var $_PHPSHOP_ERR_MSG_RATE_COUNTRY_CODE_INV = "ERRO: O País de destino é inválido. Se optou por escolher mais de um país, por favor separe-os com um espaço";
var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_START_REQ = "ERRO: É obrigatório apresentar um peso mínimo";
var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_END_REQ = "ERRO: É obrigatório apresentar um peso máximo";
var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_STARTEND_INV = "ERRO: O peso mais baixo deve ser mais pequeno que o peso mais alto";
var $_PHPSHOP_ERR_MSG_RATE_WEIGHT_VALUE_REQ = "ERRO: É obrigatório apresentar uma taxa de transporte";
var $_PHPSHOP_ERR_MSG_RATE_CURRENCY_ID_INV = "ERRO: Escolha uma moeda";

var $_PHPSHOP_ERR_MSG_RATE_ID_REQ = "ERRO: É obrigatório apresentar uma taxa de transporte";

var $_PHPSHOP_INFO_MSG_PLEASE_SELECT = "Por favor escolha";
var $_PHPSHOP_INFO_MSG_CARRIER = "Transportador";
var $_PHPSHOP_INFO_MSG_SHIPPING_METHOD = "Taxa de Transporte";
var $_PHPSHOP_INFO_MSG_SHIPPING_PRICE = "Preço";
var $_PHPSHOP_INFO_MSG_VAT_ZERO_LBL = "0 (-nenhum-)";
/*#####################################################
 END: MODULE SHIPPING
#######################################################*/

var $_PHPSHOP_PAYMENT_FORM_CC = "Cartão de Crédito";
var $_PHPSHOP_PAYMENT_FORM_USE_PP = "Use Payment Processor";
var $_PHPSHOP_PAYMENT_FORM_BANK_DEBIT = "Débito Bancário";
var $_PHPSHOP_PAYMENT_FORM_AO = "Apenas a Morada";
var $_PHPSHOP_CHECKOUT_MSG_2 = "Por favor escolha uma morada de entrega!";
var $_PHPSHOP_CHECKOUT_MSG_3 = "Por favor escolha um método de entrega!";
var $_PHPSHOP_CHECKOUT_MSG_4 = "Por favor escolha um método de pagamento!";
var $_PHPSHOP_CHECKOUT_MSG_99 = "Por favor verifique os dados introduzidos e confirme a encomenda!";
var $_PHPSHOP_CHECKOUT_ERR_NO_SHIP = "Por favor escolha um método de entrega.";
var $_PHPSHOP_CHECKOUT_ERR_OTHER_SHIP = "Por favor escolha outro método de entrega.";
var $_PHPSHOP_CHECKOUT_ERR_NO_PAYM = "Por favor escolha um método de pagamento.";
var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR = "Por favor escreva o seu número de cartão de crédito.";
var $_PHPSHOP_CHECKOUT_ERR_NO_CCNAME = "Por favor escreva o nome que está escrito no cartão de crédito.";
var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATE = "O número de cartão de crédito não é válido.";
var $_PHPSHOP_CHECKOUT_ERR_NO_CCMON = "Por favor escreva o mês da data de expiração do cartão de crédito.";
var $_PHPSHOP_CHECKOUT_ERR_NO_CCYEAR = "Por favor escreva o ano da data de expiração do cartão de crédito.";
var $_PHPSHOP_CHECKOUT_ERR_CCDATE_INV = "A data de expiração é inválida.";
var $_PHPSHOP_CHECKOUT_ERR_NO_SHIPTO = "Por favor escolha uma morada para entrega.";
var $_PHPSHOP_CHECKOUT_ERR_CCNUM_INV = "Número de conta inválida.";
var $_PHPSHOP_CHECKOUT_ERR_EMPTY_CART = "Não há nada no seu carrinho de compras!";
var $_PHPSHOP_CHECKOUT_ERR_NO_CARR = "ERRO: Por favor escolha um transportador!";
var $_PHPSHOP_CHECKOUT_ERR_RATE_NOT_FOUND = "ERRO: A taxa de transporte não foi encontrada!";
var $_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND = "ERRO: O seu endereço de entrega não foi encontrado!";
var $_PHPSHOP_CHECKOUT_ERR_NO_CCDATA = "ERRO: Não existem dados sobre o cartão de crédito....";
var $_PHPSHOP_CHECKOUT_ERR_NO_CCNR_FOUND = "ERRO: Número de Cartão de Crédito não encontrado!";
var $_PHPSHOP_CHECKOUT_ERR_TEST = "Desculpe, mas o número de cartão de crédito que introduziu é um número de teste!";
var $_PHPSHOP_CHECKOUT_ERR_NO_USER_DATA = "O user_id não foi encontrado na base de dados!";
var $_PHPSHOP_CHECKOUT_ERR_NO_BA_HOLDER_NAME = "Ainda não foi fornecido um nome de titular da sua conta bancária.";
var $_PHPSHOP_CHECKOUT_ERR_NO_IBAN = "Ainda não forneceu o seu IBAN (Numero de Conta Bancaria Internacional).";
var $_PHPSHOP_CHECKOUT_ERR_NO_BA_NUM = "Ainda não foi fornecido um número de conta bancária.";
var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_SORT = "You have actually not provided your bank sort code.";
var $_PHPSHOP_CHECKOUT_ERR_NO_BANK_NAME = "Ainda não foi fornecido o nome do seu banco.";
var $_PHPSHOP_CHECKOUT_ERR_NO_VALID_STEP = "Foi executado um passo não válido para efectuar o CheckOut!";

var $_PHPSHOP_CHECKOUT_MSG_LOG = "A informação sobre o pagamento foi guardada para processamento posterior.<BR>";

var $_PHPSHOP_CHECKOUT_ERR_MIN_POV = "Ainda não atingiu o valor minimo para efectuar a sua compra..";
var $_PHPSHOP_CHECKOUT_ERR_MIN_POV2 = "O nosso valor minimo para efectuar uma compra é de:";
var $_PHPSHOP_CHECKOUT_PAYMENT_CC = "Pagamento por Cartão de Crédito";
var $_PHPSHOP_CHECKOUT_PAYMENT_OTHER = "outros métodos de pagamento";
var $_PHPSHOP_CHECKOUT_PAYMENT_SELECT = "Por favor escolha um método de pagamento:";

var $_PHPSHOP_STORE_FORM_MPOV = "Valor minimo para efectuar uma compra na nossa loja";
var $_PHPSHOP_ACCOUNT_BANK_TITLE = "Informação da conta bancária";
var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR = "Número de Conta Bancária";
var $_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE = "Número de Código do seu Banco";
var $_PHPSHOP_ACCOUNT_LBL_BANK_NAME = "Nome do Banco";
var $_PHPSHOP_ACCOUNT_LBL_BANK_IBAN = "IBAN";
var $_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER = "Titular da Conta";

var $_PHPSHOP_MODULES = "Módulos";
var $_PHPSHOP_FUNCTIONS = "Funções";
var $_PHPSHOP_SPECIAL_PRODUCTS = "Produtos Especiais";

var $_PHPSHOP_CHECKOUT_CUSTOMER_NOTE = "Por favor deixe uma nota juntamente com a sua encomenda se achar necessário";
var $_PHPSHOP_ORDER_PRINT_CUSTOMER_NOTE = "Nota do Cliente";
var $_PHPSHOP_INCLUDING_TAX = "(Incluindo \$tax % tax)";
var $_PHPSHOP_PLEASE_SEL_ITEM = "Por favor escolha um item";
var $_PHPSHOP_PRODUCT_FORM_ITEM_LBL = "Item";

// DOWNLOADS

var $_PHPSHOP_DOWNLOADS_TITLE = "Area de Download";
var $_PHPSHOP_DOWNLOADS_START = "Iniciar Download";
var $_PHPSHOP_DOWNLOADS_INFO = "Por favor escreva o Download-ID que recebeu no seu email e carregue em 'Iniciar Download'.";
var $_PHPSHOP_DOWNLOADS_ERR_EXP = "Desculpe, mas o seu download expirou";
var $_PHPSHOP_DOWNLOADS_ERR_MAX = "Desculpe, mas já atingiu o número máximo de downloads";
var $_PHPSHOP_DOWNLOADS_ERR_INV = "Download-ID Inválido!";
var $_PHPSHOP_DOWNLOADS_ERR_SEND = "Não foi possível enviar uma mensagem a ";
var $_PHPSHOP_DOWNLOADS_SEND_MSG = "Mensagem enviada a  ";
var $_PHPSHOP_DOWNLOADS_SEND_SUBJ = "Informação do Download";
var $_PHPSHOP_DOWNLOADS_SEND_MSG_1 = "o(s) ficheiro(s) que encomendou estão prontos para download";
var $_PHPSHOP_DOWNLOADS_SEND_MSG_2 = "Por favor escreva os seguinte(s) Download-ID(s) na nossa área de Downloads: ";
var $_PHPSHOP_DOWNLOADS_SEND_MSG_3 = "o número máximo de downloads para cada ficheiro é de: ";
var $_PHPSHOP_DOWNLOADS_SEND_MSG_4 = "Tem de fazer o download até \$expire dias após o primeiro download";
var $_PHPSHOP_DOWNLOADS_SEND_MSG_5 = "Questões? Problemas?";
var $_PHPSHOP_DOWNLOADS_SEND_MSG_6 = "Informação de Download por  "; // e.g. Download-Info by "Storename"
var $_PHPSHOP_PRODUCT_FORM_DOWNLOADABLE = "produto sujeiro a download?"; 

var $_PHPSHOP_PAYPAL_THANKYOU = "Thanks for your payment. 
The transaction was successful. You will get a confirmation e-mail for the transaction by PayPal. 
You can now continue or log in at <a href=http://www.paypal.com>www.paypal.com</a> to see the transaction details.";
var $_PHPSHOP_PAYPAL_ERROR = "An error occured while processing your transaction. The status of your order could not be updated.";
    
var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER1 = "Obrigado pela sua encomenda.  Your order information follows.";
var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER2 = "Thank you for your patronage.";
var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER3 = "Questões? Problemas?";
var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER4 = "A encomenda foi recebida.";
var $_PHPSHOP_CHECKOUT_EMAIL_SHOPPER_HEADER5 = "Para Ver a encomenda selecione o link.";
    
var $_PHPSHOP_CART_ERROR_NO_NEGATIVE = "Quantidades negativas não permitidas.";
var $_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY = "Por favor introduza uma quantidade valida para este produto.";
    
var $_PHPSHOP_CART_STOCK_1 = "A quantidade selecionada excede o stock. ";
var $_PHPSHOP_CART_STOCK_2 = "Actualmente temos \$product_in_stock produtos disponiveis. ";
var $_PHPSHOP_CART_STOCK_3 = "Clique aqui para ir para lista de espera.";
var $_PHPSHOP_CART_SELECT_ITEM = "Please select a special item from the details page!";
    
var $_PHPSHOP_REGISTRATION_FORM_NONE = "nenhum";
var $_PHPSHOP_REGISTRATION_FORM_MR = "Sr.";
var $_PHPSHOP_REGISTRATION_FORM_MRS = "Sra.";
var $_PHPSHOP_REGISTRATION_FORM_DR = "Dr.";
var $_PHPSHOP_REGISTRATION_FORM_PROF = "Prof.";
var $_PHPSHOP_DEFAULT = "Default";

 /*#####################################################
    MODULE AFFILIATE
  #######################################################*/
    var $_PHPSHOP_AFFILIATE_MOD   = "Affiliate Administration";
    
    // Affiliate List
    var $_PHPSHOP_AFFILIATE_LIST_MNU		= "List Affiliates";
    var $_PHPSHOP_AFFILIATE_LIST_LBL		= "Affiliates List";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME	= "Affiliate Name";
    var $_PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE = "Active";
    var $_PHPSHOP_AFFILIATE_LIST_RATE		= "Rate";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL = "Month Total";
    var $_PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION = "Month Commission";
    var $_PHPSHOP_AFFILIATE_LIST_ORDERS = "List Orders";
    
    // Affiliate Email
    var $_PHPSHOP_AFFILIATE_EMAIL_MNU		= "Email Affiliates";
    var $_PHPSHOP_AFFILIATE_EMAIL_LBL		= "Email Affiliates";
    var $_PHPSHOP_AFFILIATE_EMAIL_WHO	= "Who to Email(* = ALL)";
    var $_PHPSHOP_AFFILIATE_EMAIL_CONTENT		= "Your Email";
    var $_PHPSHOP_AFFILIATE_EMAIL_SUBJECT = "The Subject";
    var $_PHPSHOP_AFFILIATE_EMAIL_STATS	 = "Include Current Statistics";
    
    // Affiliate Form
    var $_PHPSHOP_AFFILIATE_FORM_RATE		= "Commission Rate (percent)";
    var $_PHPSHOP_AFFILIATE_FORM_ACTIVE		= "Active?";
    
    var $_PHPSHOP_DELIVERY_TIME = "Prazo de Entrega (aprox.)";
    var $_PHPSHOP_DELIVERY_INFORMATION = "Detalhes Entrega";
    var $_PHPSHOP_MORE_CATEGORIES = "mais categorias";
    var $_PHPSHOP_AVAILABILITY = "Disponibilidade";
    var $_PHPSHOP_CURRENTLY_NOT_AVAILABLE = "Produto de momento não disponivel.";
    var $_PHPSHOP_PRODUCT_AVAILABLE_AGAIN = "Disponivel em: ";
    
    var $_PHPSHOP_STATISTIC_SUMMARY = "Sumário";
    var $_PHPSHOP_STATISTIC_STATISTICS = "Estatisticas";
    var $_PHPSHOP_STATISTIC_CUSTOMERS = "Clientes";
    var $_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS = "Produtos Activos";
    var $_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS = "Produtos inactivos";
    var $_PHPSHOP_STATISTIC_SUM = "Sum";
    var $_PHPSHOP_STATISTIC_NEW_ORDERS = "Novas Encomendas";
    var $_PHPSHOP_STATISTIC_NEW_CUSTOMERS = "Novos Clientes";
    
    
	//Waiting list : file /administrator/components/com_phpshop/html/shop.waiting_list.php
	var $_PHPSHOP_WAITING_LIST_MESSAGE = "Por favor introduza o seu e-mail, será avisado logo que o produto entre em stock. 
                                                                        O seu endereço de e-mail será apenas utilizado para este fim.<br /><br />Obrigado!";
	var $_PHPSHOP_WAITING_LIST_THANKS = "Obrigado por aguardar! <br />Será avisado logo que entre para stock.";
	var $_PHPSHOP_WAITING_LIST_NOTIFY_ME = "Avisar!";
	
	//Checkout : file /administrator/components/com_phpshop/html/checkout.thankyou.php
	var $_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW = "Vista de impresão";
  
  /**************************Admin.show_cfg.php in apparition order ;-)**************************************/
	
	/* PAGE 1 */
	var $_PHPSHOP_ADMIN_CFG_AUTORIZE_OR_CYBERCASH = "Please choose EITHER Authorize.net OR CyberCash";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS = " Configuration file status:";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE = "is writeable";
	var $_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE = "is unwriteable";
	
	var $_PHPSHOP_ADMIN_CFG_GLOBAL = "Global";
	var $_PHPSHOP_ADMIN_CFG_PATHANDURL = "Path & URL";
	var $_PHPSHOP_ADMIN_CFG_SITE = "Site";
	var $_PHPSHOP_ADMIN_CFG_SHIPPING = "Shipping";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT = "Checkout";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS = "Downloads";
	var $_PHPSHOP_ADMIN_CFG_PAYEMENTOPTIONS = "Payments";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE = "Use only as catalogue";
	var $_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN = "If you check this, you disable all cart functionalities.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES = "Show Prices";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX = "Show Prices including tax?";
	var $_PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN = "Sets the flag whether the shoppers sees prices including tax or excluding tax.";
	var $_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN = "Check to show prices. If using catalogue functionality, some don't want prices to appear on pages.";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX = "Virtual Tax";
	var $_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN = "This determines whether items with zero weight are taxed or not. Modify ps_checkout.php->calc_order_taxable() to customize this.";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE = "Tax mode:";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP = "Based on shipping address";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR = "Based on vendor address";
	var $_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN = "This determines which tax rate is taken for calculating taxes:<br />
                                                                                    <ul><li>the one from the state / country the store owner comes from</li><br/>
                                                                                    <li>or the one from where the shopper comes from.</li></ul>";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE = "Enable multiple tax rates?";
	var $_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN = "Check this, if you have products with different tax rates (e.g. 7% for books and food, 16% for other stuff)";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE = "Subtract payment discount before tax/shipping?";
  var $_PHPSHOP_ADMIN_CFG_REVIEW = "Enable Customer Review/Rating System";
  var $_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN = "If enabled, you allow customers to <strong>rate products</strong> and <strong>write reviews</strong> about them. <br />
                                                                                So customers can write down their experiences with the product for other customers.<br />";
	var $_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN = "Sets the flag whether to subtract the Discount for the selected payment BEFORE (checked) or AFTER tax and shipping.";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK = "Customers can leave bank account data?";
	var $_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN = "Check if your customers shall have the ability to provide their bank account data when registering to the shop.";

	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE = "Customers can select a state/region?";
	var $_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN = "Check if your customers shall have the ability to select their state / region data when registering to the shop.";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS = "Must agree to Terms of Service?";
	var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN = "Check if you want a shopper to agree to your terms of service before registering to the shop.";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK = "Check Stock?";
	var $_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN = "Sets whether to check the stock level when a user adds an item to the shopping cart. 
                                                                                          If set, this will not allow user to add more items to the cart than are available in stock.";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE = "Enable Affiliate Program?";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN = "This enables the affiliate tracking in the shop-frontend. Enable if you have added affiliates in the backend..";
	
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT = "Order-mail format:";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT = "Text mail";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML = "HTML mail";
	var $_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN = "This determines how your order confirmation emails are set up:<br />
                                                                                        <ul><li>as a simple text email</li>
                                                                                        <li>or as a html email with images.</li></ul>";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN = "Allow Frontend-Administration for non-Backend Users?";
  var $_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN = "With this setting you can enable the Frontend Administration for users who 
                                                                                              are storeadmins, but can't access the Mambo Backend (e.g. Registered / Editor).";
	
	/* PAGE 2 */
	var $_PHPSHOP_ADMIN_CFG_URL = "URL";
	var $_PHPSHOP_ADMIN_CFG_URL_EXPLAIN = "The URL to your site. Usually identical to your Mambo URL (with trailing slash at the end!)";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE = "SECUREURL";
	var $_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN = "The secure URL to your site. (https - with trailing slash at the end!)";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT = "COMPONENTURL";
	var $_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN = "The URL to the mambo-phpShop component. (with trailing slash at the end!)";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE = "IMAGEURL";
	var $_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN = "The URL to the mambo-phpShop component image directory.(with trailing slash at the end!)";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH = "ADMINPATH";
	var $_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN = "The path to your mambo-phpShop component directory.";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH = "CLASSPATH";
	var $_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN = "The path to your phpShop classes directory.";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH = "PAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN = "The path to your phpShop html directory.";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH = "IMAGEPATH";
	var $_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN = "The path to your phpShop shop_image directory.";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE = "HOMEPAGE";
	var $_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN = "This is the page which will be loaded by default.";	
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE = "ERRORPAGE";
	var $_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN = "This is the default page for displaying error messages.";	
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE = "DEBUGPAGE";
	var $_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN = "This is the default page for displaying debug messages.";
	var $_PHPSHOP_ADMIN_CFG_DEBUG = "DEBUG ?";
	var $_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN = "DEBUG?  	   	Turns on the debug output. This causes the DEBUGPAGE to be displayed at the bottom of each page. Very helpful during shop development since it shows the carts contents, form field values, etc.";


/* PAGE 3 */

	var $_PHPSHOP_ADMIN_CFG_FLYPAGE = "FLYPAGE";
	var $_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN = "This is the default page for displaying product details.";
  var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE = "Category Template";
	var $_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN = "This defines the default category template for displaying products in a category.<br />
                                                                                                      You can create new templates by customizing existing template files <br />
                                                                                                      (which reside in the directory <strong>COMPONENTPATH/html/templates/</strong> and begin with browse_)";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW = "Default number of products in a row";
  var $_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN = "This defines the number of products in a row. <br />
                                                                                                      Example: If you set it to 4, the category template will display 4 products per row";
  
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE = "\"no image\" image";
	var $_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN = "This image will be shown when no product image is available.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS = "SEARCH ROWS";
	var $_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN = "Determines the number of rows per page when search results are displayed in a list.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 = "SEARCH COLOR 1";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN = "Specifies the color of the odd numbered rows in a result list.";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 = "SEARCH COLOR 2";
	var $_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN = "Specifies the color of the even numbered rows in a result list.";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS = "MAXIMUM ROWS";
	var $_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN = "Sets the number of rows to show in the order list select box.";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION = "Show footer \"powered by mambo-phpShop\" ?";
	var $_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN = "Displays a powered-by-mambo-phpShop footer image.";
	
	
	/* PAGE 4 */
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD = "Choose your store's shipping method";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD = "Standard Shipping module with indiviual configured carriers and rates. <strong>RECOMMENDED !</strong>";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE = "  	Zone Shipping Module Country Version 1.0<br />
                                                                                                            For more information on this module please visit <a href=\"http://ZephWare.com\">http://ZephWare.com</a><br />
                                                                                                            for details or contact <a href=\"mailto:zephware@devcompany.com\">ZephWare.com</a><br /> Check this to enable the zone shipping module";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS = "UPS Tools Shipping calculation";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE = "UPS access code";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN = "Your UPS access code";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID = "UPS user id";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN = "The user ID you got from UPS";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD = "UPS password";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN = "The password for your UPS account";
	  
  var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER = "InterShipper Module. Check only if you have an Intershipper.com account";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE = "Disable Shipping method selection. Choose if your customers buy downloadable goods which don't have to be shipped.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD = "InterShipper Password";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_PASSWORD_EXPLAIN = "Your password for your intershipper account.";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL = "InterShipper email";
	var $_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER_EMAIL_EXPLAIN = "Your email address for your intershipper account.";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY = "ENCODE KEY";
	var $_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN = "Used to encrypt data stored in database with this key. This means that this file should be protected from viewing at all times.";
	
	
	/* PAGE 5 */
	
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR = "Enable the Checkout Bar";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN = "Check this, if you want the 'checkout-bar' to be displayed to the customer during checkout process ( 1 - 2 - 3 - 4 with graphics).";
	
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS = "Choose your store's checkout process";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD = "<strong>Standard :</strong><br/>
               1. Shipping address request<br />
              2. Shipping method request<br />
              3. Payment method request<br />
              4. Complete Order";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 = "<strong>Process 2:</strong><br/>
               1. Shipping address request<br />
              2. Payment method request<br />
              3. Complete Order";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 = "<strong>Process 3:</strong><br/>
               1. Shipping method request<br />
              2. Payment method request<br />
              3. Complete Order";
	var $_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 = "strong>Process 4:</strong><br/>
               1. Payment method request<br />
              2. Complete Order";
	
	
	
	/* PAGE 6 */
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS = "Enable Downloads";
	var $_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN = "Check to enable the download capability. Only If you want sell downloadable goods.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS = "Order Status which enables download";
	var $_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN = "Select the order status at which the customer is notified about the download via e-mail.";
	
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS = "Order Status which disables downloads";
	var $_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN = "Sets the order status at which the download is disabled for the customer.";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT = "DOWNLOADROOT";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN = "The physical path to the files for the custumer download. (trailing slash at the end!)<br>
        <span class=\"message\">For your own shop's security: If you can, please use a directory ANYWHERE OUTSIDE OF THE WEBROOT</span>";
	
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX = "Download Maximum";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN = "Sets the number of downloads which can be made with one Download-ID, (for one order)";
	
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE = "Download Expire";
	var $_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN = "Sets the time range <strong>in seconds</strong> in which the download is enabled for the customer. 
  This range begins with the first download! When the time range has expired, the download-ID is disabled.<br />Note : 86400s=24h.";
	
	
	
	
	/* PAGE 7 */
	
	
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
    var $_PHPSHOP_ADVANCED_SEARCH  ="Procura Avançada";
    var $_PHPSHOP_SEARCH_ALL_CATEGORIES = "Procurar todas as categorias";
    var $_PHPSHOP_SEARCH_ALL_PRODINFO = "Procurar todos os detalhes produto";
    var $_PHPSHOP_SEARCH_PRODNAME = "Apenas Produto";
    var $_PHPSHOP_SEARCH_MANU_VENDOR = "Apenas Marca/vendedor";
    var $_PHPSHOP_SEARCH_DESCRIPTION = "Apenas Descrição Produto";
    var $_PHPSHOP_SEARCH_AND = "e";
    var $_PHPSHOP_SEARCH_NOT = "não";
    var $_PHPSHOP_SEARCH_TEXT1 = "A primeira lista permite selecionar uma categoria a fim de limitar a procura. 
        A segunda lista permite limitar os detalhes do produto (ex. Nome). 
        Uma vez estas selecionadas (ou deixadas por defeito), introduza a palavras-chave. ";
    var $_PHPSHOP_SEARCH_TEXT2 = " Pode adicionar mais palavras-chave e operadores como AND ou NOT. 
        Selecionando AND significa que ambas as palavras tem de estar presentes para o produto ser apresentado. 
        Selecionando NOT signitica que a primeira palavra tem de estar presente e a segunda não poderá existir para o produto ser apresentado.";
    var $_PHPSHOP_ORDERBY = "Ordenar Por";
    
    /*** Review feature ***/
    var $_PHPSHOP_CUSTOMER_RATING  = "Média de Votos";
    var $_PHPSHOP_TOTAL_VOTES = "Total de votos";
    var $_PHPSHOP_CAST_VOTE = "Por favor submeta o seu voto";
    var $_PHPSHOP_RATE_BUTTON = "votar";
    var $_PHPSHOP_RATE_NOM = "Votação";
    var $_PHPSHOP_REVIEWS = "Comentários de Clientes";
    var $_PHPSHOP_NO_REVIEWS = "Não existe qualquer comentário a este produto.";
    var $_PHPSHOP_WRITE_FIRST_REVIEW = "Seja o primeiro a fazer um comentário...";
    var $_PHPSHOP_REVIEW_LOGIN = "Por favor faça o seu LogIn para escrever um comentário.";
    var $_PHPSHOP_REVIEW_ERR_RATE = "Por Favor Vote o produto para completar o seu comentário!";
    var $_PHPSHOP_REVIEW_ERR_COMMENT1 = "Por favor esvreva mais algumas palavras no seu comentário. Nº min. de letras: 100";
    var $_PHPSHOP_REVIEW_ERR_COMMENT2 = "Por favor reduza o seu comentátio. Nº max. de letras: 2000";
    var $_PHPSHOP_WRITE_REVIEW = "Faça um comentário a este produto!";
    var $_PHPSHOP_REVIEW_RATE = "Primeiro: Vote o produto. Selecione de 0 (pior) a 5 estrelas (melhor).";
    var $_PHPSHOP_REVIEW_COMMENT = "Agora escreva um (pequeno) comentário....(min. 100, max. 2000 letras) ";
    var $_PHPSHOP_REVIEW_COUNT = "Nº de letra escritas: ";
    var $_PHPSHOP_REVIEW_SUBMIT = "Gravar comentário";
    var $_PHPSHOP_REVIEW_ALREADYDONE = "Já escreveu anteriormente um comentário para este produto. Obrigado.";
    var $_PHPSHOP_REVIEW_THANKYOU = "Obrigado pelo seu comentário.";
    var $_PHPSHOP_COMMENT= "Comentátio";
    
    var $_PHPSHOP_CREDITCARD_FORM_LBL = "Add/Edit Credit Card Types";
    var $_PHPSHOP_CREDITCARD_NAME = "Credit Card Name";
    var $_PHPSHOP_CREDITCARD_CODE = "Credit Card - Short Code";
    var $_PHPSHOP_CREDITCARD_TYPE = "Credit Card Type";
    
    var $_PHPSHOP_CREDITCARD_LIST_LBL = "Credit Card List";
    var $_PHPSHOP_UDATE_ADDRESS = "Actualizar morada";
    var $_PHPSHOP_CONTINUE_SHOPPING = "Continue Shopping";
    
    var $_PHPSHOP_THANKYOU_SUCCESS = "Your order has been successfully placed!";
    var $_PHPSHOP_ORDER_LINK = "Follow this link to view the Order Details.";
    
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_1 = "the Status of your Order No. {order_id} has been changed.";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_2 = "New Status is:";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_MSG_3 = "To view the Order Details, please follow this link (or copy it into your browser):";
    var $_PHPSHOP_ORDER_STATUS_CHANGE_SEND_SUBJ = "Order Status Change: Your Order {order_id}";
    var $_PHPSHOP_ORDER_LIST_NOTIFY = "Notify Customer?";
    var $_PHPSHOP_ORDER_LIST_NOTIFY_ERR = "Please change the Order Status first!";
    
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT = "Price Discount on default Shopper Group (in %)";
    var $_PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP = "A positive amount X means: If the Product has no Price assigned to THIS Shopper Group, the default Price is decreased by X %. A negative amount has the opposite effect";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_LBL = "Product Discount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL = "Product Discount List";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT = "Add/Edit Product Discount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT = "Discount amount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP = "Enter the discount amount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE = "Discount Type";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT = "Percentage";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL = "Total";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP = "Shall the amount be a percentage or a total?";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE = "Startdate of discount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP = "Specifies the day when the discount begins";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE = "End date of discount";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP = "Specifies the day when the discount ends";
    var $_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP = "You can use the Product Discount Form to add discounts!";
    
    var $_PHPSHOP_PRODUCT_DISCOUNT_SAVE = "You Save";
    
    var $_PHPSHOP_FLYPAGE_ENLARGE_IMAGE = "View Full-Size Image";
    
/*********************
Currency Display Style 
***********************/
    var $_PHPSHOP_CURRENCY_DISPLAY = "Currency Display Style";
    var $_PHPSHOP_CURRENCY_SYMBOL = "Currency symbol";
    var $_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP = "You can also use HTML Entities here (e.g. &amp;euro;,&amp;pound;,&amp;yen;,...)";
    var $_PHPSHOP_CURRENCY_DECIMALS = "Decimals";
    var $_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP = "Number of displayed decimals (can be 0)<br><b>Performs rounding if value has different number of decimals</b>";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL = "Decimal symbol";
    var $_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP = "Character used as decimal symbol";
    var $_PHPSHOP_CURRENCY_THOUSANDS = "Thousands separator";
    var $_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP = "Character used to separate thousands (can be empty)";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY = "Positive format";
    var $_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP = "Display format used to display positive values.<br>(Symb stands for currency symbol)";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY = "Negative format";
    var $_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP = "Display format used to display negative values.<br>(Symb stands for currency symbol)";
    
    var $_PHPSHOP_OTHER_LISTS = "Other Product Lists";
/**************
Multiple Images 
****************/
    var $_PHPSHOP_MORE_IMAGES = "View More Images";
    var $_PHPSHOP_AVAILABLE_IMAGES = "Available Images for";
    var $_PHPSHOP_BACK_TO_DETAILS = "Back to Product Details";
    
    /* FILEMANAGER */
    var $_PHPSHOP_FILEMANAGER = "FileManager";
    var $_PHPSHOP_FILEMANAGER_LIST = "FileManager::Product List";
    var $_PHPSHOP_FILEMANAGER_ADD = "Add Image/File";
    var $_PHPSHOP_FILEMANAGER_IMAGES = "Assigned Images";
    var $_PHPSHOP_FILEMANAGER_DOWNLOADABLE = "Is Downloadable?";
    var $_PHPSHOP_FILEMANAGER_FILES = "Assigned Files (Datasheets,...)";
    var $_PHPSHOP_FILEMANAGER_PUBLISHED = "Published?";
    
    /* FILE LIST */
    var $_PHPSHOP_FILES_LIST = "FileManager::Image/File List for";
    var $_PHPSHOP_FILES_LIST_FILENAME = "Filename";
    var $_PHPSHOP_FILES_LIST_FILETITLE = "File Title";
    var $_PHPSHOP_FILES_LIST_FILETYPE = "File Type";
    var $_PHPSHOP_FILES_LIST_EDITFILE = "Edit File Entry";
    var $_PHPSHOP_FILES_LIST_FULL_IMG = "Full Image";
    var $_PHPSHOP_FILES_LIST_THUMBNAIL_IMG = "Thumbnail Image";
    
    
    /* FILE FORM */
    var $_PHPSHOP_FILES_FORM = "Upload a File for";
    var $_PHPSHOP_FILES_FORM_CURRENT_FILE = "Current File";
    var $_PHPSHOP_FILES_FORM_FILE = "File";
    var $_PHPSHOP_FILES_FORM_IMAGE = "Image";
    var $_PHPSHOP_FILES_FORM_UPLOAD_TO = "Upload to";
    var $_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH = "default Product Image Path";
    var $_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH = "Specify the file location";
    var $_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH = "Download Path (e.g. for selling downloadables!)";
    var $_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL = "Auto-Create Thumbnail?";
    var $_PHPSHOP_FILES_FORM_FILE_PUBLISHED = "File is published?";
    var $_PHPSHOP_FILES_FORM_FILE_TITLE = "File Title (what the Customer sees)";
    var $_PHPSHOP_FILES_FORM_FILE_DESC = "File Description";
    var $_PHPSHOP_FILES_FORM_FILE_URL = "File URL (optional)";
    
    /* FILE & IMAGE PROCESSING */
    var $_PHPSHOP_FILES_PATH_ERROR = "Please provide a valid path!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS = "The Thumbnail Image has been successfully created!";
    var $_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE = "Could NOT create Thumbnail Image!";
    var $_PHPSHOP_FILES_UPLOAD_FAILURE = "File/Image Upload Error";
    
    var $_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE = "Could not delete the Full Image File.";
    var $_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS = "Full Image successfully deleted.";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE = "Could not delete the Thumbnail Image File (maybe didnt exist): ";
    var $_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS = "Thumbnail Image successfully deleted.";
    var $_PHPSHOP_FILES_FILE_DELETE_FAILURE = "Could not delete the File.";
    var $_PHPSHOP_FILES_FILE_DELETE_SUCCESS = "File successfully deleted.";
    
    var $_PHPSHOP_FILES_NOT_FOUND = "Sorry, but the requested file wasn't found!";
    var $_PHPSHOP_IMAGE_NOT_FOUND = "Image not found!";


    /*#####################
    MODULE COUPON
    #####################*/
    
    var $_PHPSHOP_COUPON_MOD = "Coupon";
    var $_PHPSHOP_COUPONS = "Coupons";
    var $_PHPSHOP_COUPON_LIST = "Coupon List";
    var $_PHPSHOP_COUPON_ALREADY_REDEEMED = "Coupon has already been redeemed.";
    var $_PHPSHOP_COUPON_REDEEMED = "Coupon redeemed! Thank you.";
    var $_PHPSHOP_COUPON_ENTER_HERE = "If you have a coupon code, please enter it below:";
    var $_PHPSHOP_COUPON_SUBMIT_BUTTON = "Submit";
    var $_PHPSHOP_COUPON_CODE_EXISTS = "That coupon code already exists. Please try again.";
    var $_PHPSHOP_COUPON_EDIT_HEADER = "Update Coupon";
    var $_PHPSHOP_COUPON_EDIT_HELP_TEXT = "Click a coupon code to edit it, or to delete a coupon code, select it and click Delete:";
    var $_PHPSHOP_COUPON_CODE_HEADER = "Code";
    var $_PHPSHOP_COUPON_PERCENT_TOTAL = "Percent or Total";
    var $_PHPSHOP_COUPON_TYPE = "Coupon Type";
    var $_PHPSHOP_COUPON_TYPE_TOOLTIP = "A Gift Coupon is deleted after it was used for discounting an order. A permanent coupon can be used as often as the customer wants to.";
    var $_PHPSHOP_COUPON_TYPE_GIFT = "Gift Coupon";    
    var $_PHPSHOP_COUPON_TYPE_PERMANENT = "Permanent Coupon";    
    var $_PHPSHOP_COUPON_VALUE_HEADER = "Value";
    var $_PHPSHOP_COUPON_DELETE_BUTTON = "Delete Code";
    var $_PHPSHOP_COUPON_CONFIRM_DELETE = "Are you sure you want to delete this coupon code?";
    var $_PHPSHOP_COUPON_COMPLETE_ALL_FIELDS = "Please complete all fields.";
    var $_PHPSHOP_COUPON_VALUE_NOT_NUMBER = "Coupon value must be a number.";
    var $_PHPSHOP_COUPON_NEW_HEADER = "New Coupon";
    var $_PHPSHOP_COUPON_COUPON_HEADER = "Coupon Code";
    var $_PHPSHOP_COUPON_PERCENT = "Percent";
    var $_PHPSHOP_COUPON_TOTAL = "Total";
    var $_PHPSHOP_COUPON_VALUE = "Value";
    var $_PHPSHOP_COUPON_CODE_SAVED = "Coupon code saved.";
    var $_PHPSHOP_COUPON_SAVE_BUTTON = "Save Coupon";
    var $_PHPSHOP_COUPON_DISCOUNT = "Coupon Discount";
    var $_PHPSHOP_COUPON_CODE_INVALID = "Coupon code not found. Please try again.";
    var $_PHPSHOP_COUPONS_ENABLE = "Enable Coupon Usage";
    var $_PHPSHOP_COUPONS_ENABLE_EXPLAIN = "If you enable the Coupon Usage, you allow customers to fill in Coupon Numbers to gain discounts on their purchase.";
    
    /* Free Shipping */
    var $_PHPSHOP_FREE_SHIPPING = "Free Shipping";
    var $_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT = "Shipping is free on this Order!";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT = "Minimum Amount for Free Shipping";
    var $_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP = "The amount (INCLUDING TAX!) which is the Minimum for Free Shipping 
                                                (example: <strong>50</strong> means Free Shipping when the customer checks out
                                                with \$50 (including tax) or more.";
    var $_PHPSHOP_YOUR_STORE = "Your Store";
    var $_PHPSHOP_CONTROL_PANEL = "Control Panel";
    
    /* Configuration Additions */
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON = "PDF - Button";
    var $_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN = "Show or Hide the PDF - Button in the Shop";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER = "Must agree to Terms of Service on EVERY ORDER?";
    var $_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN = "Check if you want a shopper to agree to your terms of service on EVERY ORDER (before placing the order).";

    // We need this for eCheck.net Payments
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE = "Bank Account Type";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING = "Checking";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING = "Business Checking";
    var $_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS = "Saving";
    
    var $_PHPSHOP_PAYMENT_AN_RECURRING = "Recurring Billings?";
    var $_PHPSHOP_PAYMENT_AN_RECURRING_TOOLTIP = "Define wether you want recurring billings.";
    
    var $_PHPSHOP_INTERNAL_ERROR = "Internal Error processing the Request to";
    var $_PHPSHOP_PAYMENT_ERROR = "Failure in Processing the Payment";
    var $_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS = "Payment successfully processed";
    
    /* UPS Shipping Module */
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
    
    var $_PHPSHOP_ERROR_CODE = "Error Code";
    var $_PHPSHOP_ERROR_DESC = "Error Description";
    
    var $_PHPSHOP_CHANGE_TRANSACTION_KEY = "Show / Change the Transaction Key";
    var $_PHPSHOP_CHANGE_PASSKEY_FORM = "Show/Change the Password/Transaction Key";
    var $_PHPSHOP_TYPE_PASSWORD = "Please type in your User Password";
    var $_PHPSHOP_CURRENT_PASSWORD = "Current Password";
    var $_PHPSHOP_CURRENT_TRANSACTION_KEY = "Current Transaction Key";
    var $_PHPSHOP_CHANGE_PASSKEY_SUCCESS = "The Transaction key was successfully changed.";
    
    var $_PHPSHOP_PAYMENT_CVV2 = "Request/Capture Credit Card Code Value (CVV2/CVC2/CID)";
    var $_PHPSHOP_PAYMENT_CVV2_TOOLTIP = "Check for a valid CVV2/CVC2/CID value (three- or four-digit number on the back of a credit card, on the Front of American Express Cards)?";
    var $_PHPSHOP_CUSTOMER_CVV2_TOOLTIP = "Please type in the three- or four-digit number on the back of your credit card (On the Front of American Express Cards)";
    var $_PHPSHOP_CUSTOMER_CVV2_ERROR = "You need to enter your Credit Card Code to proceed.";
    
    var $_PHPSHOP_PRODUCT_FORM_FILENAME = "EITHER Fill in a Filename";
    var $_PHPSHOP_PRODUCT_FORM_FILENAME_TOOLTIP = "NOTE: Here you can fill in a FileName. <strong>If you fill in a Filename here, no Files will be uploaded!!! You will have to upload it via FTP manually!</strong>.";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD = "OR Upload new File";
    var $_PHPSHOP_PRODUCT_FORM_UPLOAD_TOOLTIP = "You can upload a local file. This file will be the Product you sell. An existing file will be replaced.";
    
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1 = "Fill in any text here that will be displayed to the customer on the product flypage.<br />e.g.: 24h, 48 hours, 3 - 5 days, On Order.....";
    var $_PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2 = "OR select an Image to be displayed on the Details Page (flypage).<br />The images reside in the directory <i>/components/com_phpshop/shop_image/availability</i><br />";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST = "Attribute List";
    var $_PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Examples for the Attribute List Format:</h4>
        <span class=\"sectionname\"><strong>Size</strong>,XL[+1.99],M,S[-2.99]<strong>;Colour</strong>,Red,Green,Yellow,ExpensiveColor[=24.00]<strong>;AndSoOn</strong>,..,..</span>
        <h4>Inline price adjustments for using the Advanced Attributes modification:</h4>
        <span class=\"sectionname\">
        <strong>&#43;</strong> == Add this amount to the configured price.<br />
        <strong>&#45;</strong> == Subtract this amount from the configured price.<br />
        <strong>&#61;</strong> == Set the product's price to this amount.
      </span>";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST = "Custom Attribute List";
    var $_PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES = "<h4>Examples for the Custom attribute List Format:</h4>
        <span class=\"sectionname\"><strong>Name;Extras;</strong>...</span>";
        
    var $_PHPSHOP_MULTISELECT = "Para escolha múltipla pressione <i>Control</i> e com o rato escolha os países respectivos";
        
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
