*****************************************
Danish Paymet Gateways for mambo-phpShop
*****************************************

Contents
------------

Class & Configuration Files and Credit Card From / Result Pages Files for

  * Danhost.dk
  * Dandomain.dk
  * Wannafind.dk
  
  Payment Gateways
  
  
Installation
--------------

1. Unpack the archive.

2. Upload the files

	ps_pbs.php,
	ps_pbs.cfg.php
	
	to /administrator/components/com_phpshop/classes/payment/
	
3. Upload the files

	checkout.danhost_cc_form.php
	checkout.danhost_result.php
	checkout.dandomain_cc_form.php
	checkout.dandomain_result.php
	checkout.freepay_result.php
	checkout.freepay_cc_form.php
	checkout.wannafind_cc_form.php
	checkout.wannafind_result.php
	
	to /administrator/components/com_phpshop/html/
	
4. Go to your Shop Administration Panel (mambo-phpShop) and choose
  "Store" => "Add Payment Method",
  
5. fill in the details:

  - (choose a name)
  - Code: PBS
  - Payment Class Name: ps_pbs
  - "PayPal or related"
  
  Leave the other fields as displayed.
  Save!
  
6. Now please choose the Payment Method with the name you have chosen in Step 5 from the
  Payment Method List.
  Change the configuration details now in the Tab "Configuration".
   
  - select the Gateway you will use (dandomain.dk / danhost.dk / freepay.dk / wannafind.dk )
  - fill in your Shop ID or PBS Merchant ID
  
  - Order Status:
    ***** IMPORTANT *************
    Due to a limitation of the Gateways, we can't prove if an 
    "accepted" transaction is valid or not. This means
    you cannot check, if a normal user has sucessfully paid or
    a malicious user uses the Session ID to trick the Shop!
    So:
    ************************
    DON'T CHOOSE AN ORDER STATUS LIKE "CONFIRMED" WHEN THIS WOULD
    ENABLE DOWNLOADS!!!!!! (only when you're selling Downloadable Products)
    *************************
 
    Now SAVE. (Make sure that the file 
    /administrator/components/com_phpshop/classes/payment/ps_pbs.cfg.php
    is writeable!)
  
  
How to Set Up your Gateway
---------------------

WWW.FREEPAY.DK 

-> Login to your account 
-> Select 'Opsætning' 
-> Select 'Freepay Premium Opsætning' 
-> Enable 'Hent betalingsside via sikker forbindelse'
-> Enter the url for your local paymentment form in the 'URL på betalingsside'. 
  (Example: http://www.mymambosite.com/index.php?option=com_phpshop&page=checkout.freepay_cc_form ) 
-> Select 'Gem Opsætning'


WWW.DANDOMAIN.DK

It seems as if there's no need for changing the settings at the Gateway Administration.
Correct me if I'm wrong.


WWW.DANHOST.DK

-> Login to your account
-> Select 'Shop configuration'
-> Set 'OK URL' to the checkout_accept_pbscc.php file 
    Example: http://www.mymambosite.com/index.php?option=com_phpshop&page=checkout.danhost_result )  
    
-> Set 'Fejl URL' to the checkout_decline_pbscc.php file 
    Example: http://www.mymambosite.com/index.php?option=com_phpshop&page=checkout.danhost_result )  
    
-> Set 'Form URL' to the checkout_pbscc_webhosting.php file 
    Example: http://www.mymambosite.com/index.php?option=com_phpshop&page=checkout.danhost_cc_form )  
    
-> Select the currencies you want to accept (example: DKK,EUR,USD )  

  Save. Don't care about the message that Accept URL and Fail URL Match.
  
  
WWW.WANNAFIND.DK

-> Login to your account
-> Go to 'Instillinger'
-> Set IP-adresse of your webshop
(for help, please go to: http://www.wannafind.dk/produkter/betalingssystem-faq.asp?do=teknik )

If you don't have an own or a Shared SSL certificated for your site,
the following steps will make your site completely SECURE with
the Wannafind SSL Proxy (thanks to Anders for his patience):

  1. Find your Mambo Template 
      e.g. /templates/rhuk_solarflare_ii
    and open the file index.php in that directory
    
  2. Find a line similar to this:
  
  <link href="<?php echo $mosConfig_live_site;?>/templates/rhuk_solarflare_ii/css/template_css.css" rel="stylesheet" type="text/css"/>
  
    (That's the place where a CSS Stylesheet file is referenced to.)
    
  3. Change that line to
  
    <!--<link href="<?php echo $mosConfig_live_site;?>/templates/rhuk_solarflare_ii/css/template_css.css" rel="stylesheet" type="text/css"/>-->
    <?php
    echo "<style type=\"text/css\">\n";
    echo str_replace("../images/", "templates/".$GLOBALS["cur_template"]."/images/", file_get_contents( $GLOBALS["mosConfig_live_site"]."/templates/".$GLOBALS["cur_template"]."/css/template_css.css" ));
    echo "</style>\n";
    ?>
    
    Save the file.
    
  4. If you have selected the dTree Display style in the Shop Module, you may have problems with it.
      I recommend changing to the Link List Display Style.
