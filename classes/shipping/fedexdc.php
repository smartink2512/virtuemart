<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: fedexdc.php,v 1.2 2005/09/27 17:51:26 soeren_nb Exp $
* @package VirtueMart
* @subpackage shipping
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

class ps_fedexdc {

    var $classname ;
    var $VERSION = '0.5';
    var $NAME = 'fedexdc';
    var $ERROR_STR = false;

    //this will be the field returned by FedEx
    //containing the binary image data
    var $image_key;

    // FedEx API URI
    var $fedex_uri;

    // referer host
    var $referer;

    // set the timeout
    var $timeout;

    /**
    *  load FedEx  UTIs => Transaction Types, Applicable Carrier
    *
    * @var      FE_TT
    * @access   public
    */
    var $FE_TT = array(
        '1002' =>  array('007','FDXG'),
        '1005' =>  array('023','FDXE'),
        '2016' =>  array('021','FDXE'),
        '2017' =>  array('022','FDXE'),
        '2018' =>  array('019','FDXE'),
        '2024' =>  array('025',''),
        '2025' =>  array('410',''),
        '3000' =>  array('021','FDXG'),
        '3001' =>  array('023','FDXG'),
        '3003' =>  array('211',''),
        '3004' =>  array('022','FDXG'),
        '5000' =>  array('402',''),
        '5001' =>  array('405',''),
        '5002' =>  array('403','')
    );

    /**
    * constructor: loads account# and meter#
    *
    * @param    array $params Associative array of parameters listed:
    *                       fedex_uri: FedEx API URI
                            fedex_host: Host for FedEx
                            referer: Referering Host
                            timeout: Connection timeout in seconds.
    *
    * @access public
    */
    function ps_fedexdc( $params = array()) 
    {
        $this->classname = get_class($this);
        
        require_once( CLASSPATH."shipping/".$this->classname."cfg.php" );
        
        $this->account  = FEDEX_ACCOUNT_NUMBER;
        $this->meter    = FEDEX_METER_NUMBER;
        $this->time_start = $this->getmicrotime();
        
        // param defaults
        $this->fedex_uri =  FEDEX_URI;
        $this->fedex_host = FEDEX_HOST;
        $this->referer =    FEDEX_REQUEST_REFERER;
        $this->timeout =    FEDEX_REQUEST_TIMEOUT;
        $this->image_key =  188;
        foreach($params as $key => $value) {
            $this->{$key} = $value;
        }

    }

    /**
    * Fetches the Quote
    *
    * @param    
    * @access   private
    */        
    function fetch_quote( &$d )
    {
        global $vmLogger;
        // Weight Units
        if( empty($d['fdx']['weight_units']) )
        {
        $d['fdx']['weight_units'] = 'LBS';
        }
    
        $ship_Ret =  $this->global_rate_express(
            array(
            // total package weight
            1401=> $d['fdx']['total_weight']
            // weight units
            ,75=>  $d['fdx']['weight_units'] // 'LBS'
            
            // destination person
            ,12=>   $d['fdx']['shipping_name']
            // destination address 1
            ,13=>   $d['fdx']['shipping_address_1']
            // destination city
            ,15=>  $d['fdx']['shipping_city']
            // destination state
            ,16=>   $d['fdx']['shipping_state']
            // destination zip
            ,17=>   $d['fdx']['shipping_zip']
            //destination phone
            ,18=>   $d['fdx']['shipping_phone']
            // destination country code
            ,50=>   $d['fdx']['shipping_country']
    
            
            // pay type
            ,23=>   '1'
            // package total
            ,116 => 1        
            
            
            // sender company
            ,4=> $d['fdx']['sender_company'] 
            // sender address 1
            ,5=>  $d['fdx']['sender_address_1']
            // sender city
            ,7=>   $d['fdx']['sender_city'] 
            // sender state
            ,8=>  $d['fdx']['sender_state']
            // sender zip
            ,9=>  $d['fdx']['sender_zip'] 
            // sender country code
            ,117=> $d['fdx']['sender_country']
    
            // sender phone number
            ,183=> $d['fdx']['sender_phone'] 

            // if you omit these two, it will return all kinds of options
            // we dont want that.. 
            
            // packaging type
            //03 - FedEx Box
            // 01 - Other packaging ( if you use 01 you have to get the dimentions for what your sending )
            ,1273=> '03'
            
            // service type
            //06 - FedEx First Overnight 
            ,1274=> '06'
            
            // drop off type
            //1 if regular pickup,
            ,1333=> '1'
            
            // declare currency type
            ,68 =>  'USD'
    
    
    
    //        ,1368 => 1
    //        ,1369 => 3
    //        ,1370 => 3
            )
        );
    
        if ($error = $this->getError()) 
        {
            
            $vmLogger->err( $error );
            return false;
        } 
        else 
        {    
            return $ship_Ret;
        }
    
    return true;
        
    }//end fetch_quote
    
    
    
    
    /**
    * Sets debug information
    *
    * @param    string $string debug data
    * @access   private
    */
    function debug($string){
        $this->debug_str .= get_class($this).": $string\n";
    }

    /**
    * returns error string if present
    *
    * @return   boolean string
    * @access   public
    */
    function getError(){
        if($this->ERROR_STR != ""){
            return $this->ERROR_STR;
        }
        return false;
    }

    /**
    * sets error string
    *
    * @param    string $str
    * @access   private
    */
    function setError($str){
        $this->ERROR_STR .= $str;
    }

    /**
    * microtime
    *
    * @return   float
    * @access   private
    */
    function getmicrotime(){
        list($usec, $sec) = explode(" ",microtime());
        return((float)$usec +(float)$sec);
    }

    /**
    * creates FedEx buffer string
    *
    * @param    int $uti FedEx transaction UTI
    * @param    array $vals values to send to FedEx
    * @return   string
    * @access   public
    */
    function setData($uti, $vals) {
        $this->sBuf = '';
        if(empty($vals[0]))    $vals[0] = $this->FE_TT[$uti][0];
        if(empty($vals[3025])) $vals[3025] = $this->FE_TT[$uti][1];
        if(isset($this->account) and !array_key_exists(10, $vals)) $this->sBuf .= '10,"' . $this->account . '"';
        if(isset($this->meter) and !array_key_exists(498, $vals))  $this->sBuf .= '498,"' .$this->meter. '"';
        foreach($vals as $key => $val) {
            if(preg_match('/^([0-9]+)\-?[0-9]?$/', $key)) { //let users use the hyphenated number fields
                $this->sBuf .= "$key,\"$val\"";
            } else { continue; }
        }
        $time = $this->getmicrotime() - $this->time_start;
        $this->debug('setData: build FedEx string('. $time.')');
        return $this->sBuf .= '99,""';
    }

    /**
    * parses FedEx return string into assoc array
    *
    * @return   array FedEx return values
    * @access   public
    */
    function _splitData(){
        $this->rHash = array();
        $count=0;
        $st_key = 0;	// start the first key at 0
        $aFedRet = preg_split('/,"/s', $this->httpBody);
        foreach($aFedRet as $chunk) {
            preg_match('/(.*)"([\d+\-?]+)/s', $chunk, $match);
            if(empty($match[1])) continue;
            if($st_key == 99) continue;
            $this->rHash[$st_key] = $match[1];
            $st_key = $match[2]; //this will be the next key
        }
        $time = $this->getmicrotime() - $this->time_start;
        $this->debug('_splitData: Parse FedEx response('. $time.')');            
        if($this->rHash[2]) {
            $this->setError("FedEx Return Error ". $this->rHash[2]." : ".$this->rHash[3]);
        }
        return $this->rHash;
    }

    /**
    * decode binary label data
    *
    * @param    string $label_file file to save label on disk
    * @return   mixed
    * @access   public
    */
    function label($label_file=false) {
        $this->httpLabel =  $this->rHash[$this->image_key];
        if($this->httpLabel = preg_replace('/%([0-9][0-9])/e', "chr(hexdec($1))", $this->httpLabel)) {
                $this->debug('separate binary image data');
                $this->debug('decoded binary label data');
        }
        if($label_file) {
            $this->debug('label: trying to write out label to '. $label_file);
            $FH = fopen($label_file, "w+b");
             if(!fwrite($FH, $this->httpLabel)) {
                $this->setError("Can't write to file $label_file");
                return false;
             }
             fclose($FH);
        } else {
            return $this->httpLabel;
        }

    }
    /**
    * prepares and sends request to FedEx API
    *
    * @param    string $buf pre-formatted FedEx buffer
    * @return   mixed
    * @access   public
    */
    function transaction($buf=false) {
            if($buf) $this->sBuf = $buf;

            // Future design to allow different types of requests
            if(FEDEX_REQUEST_TYPE == 'CURL') {
                    $meth = '_sendCurl';
            }
//                elseif(FEDEX_REQUEST_TYPE == 'CURL_BINARY') {
//                        $meth = '_sendCurlBinary';
//                }
//                
            
            if($this->$meth()) {
                    $this->_splitData();
                    return $this->rHash;
            } else {
                    return false;
            }
    }

    /**
    * sends a request to FedEx using cUrl
    *
    * @return   string
    * @access   private
    */
    function _sendCurl() {
            $ch = curl_init();
                // this is because we know that 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 

            curl_setopt($ch, CURLOPT_URL, $this->fedex_uri);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Referer: '. $this->referer
                ,'Host: ' . $this->fedex_host
                ,'User-Agent: '. $this->NAME .'-'. $this->VERSION . ' class( ' . $this->NAME . ' )'
                ,'Accept: image/gif, image/jpeg, image/pjpeg, text/plain, text/html, */*'
                ,'Content-Type: image/gif'
                ,'Content-Length: '. strlen($this->sBuf)
                ));
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $this->sBuf );
            
            $this->debug('Sending to FedEx with data length: '.strlen($this->sBuf));
            $this->httpData = curl_exec($ch);
            if(curl_errno($ch) != 0){
                    $err = "cURL ERROR: ".curl_errno($ch).": ".curl_error($ch)."<br>";
                    $this->setError($err);
                    curl_close($ch);
                    return false;
            }
            curl_close($ch);

            // separate content from HTTP headers
            if(ereg("^(.*)\r?\n\r?\n", $this->httpData)) {
                    $this->debug("found proper headers and document");
                    $this->httpBody = ereg_replace("^[^<]*\r\n\r\n","", $this->httpData);
                    $this->debug("remove headers, body length: ".strlen($this->httpBody));
            } else {
                    $this->debug("headers and body are not properly separated");
                    $this->setError('headers and body are not properly separated');
                    return false;
            }

            if(strlen($this->httpBody) == 0){
                    $this->debug("body contains no data");
                    $this->setError("body contains no data");
                    return false;
            }
            $time = $this->getmicrotime() - $this->time_start;
            $this->debug('Got response from FedEx('. $time.')');
            return $this->httpBody;
    }
    
    
    /* Below are methods for each of FedEx's services
       I thought this would be easier as all the
       functions are the same except for the setData
       UTI value.  If someone knows how to create dynamic
       functions in PHP(Perl has an AUTOLOAD method) I could
       just use an array to create all these methods on the fly.
    */


    /**
    * close ground shipments
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function close_ground($aData) {
            $this->setData(1002, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process close_ground');
                return false;
            }
    }
    
    /**
    * cancel an express shipment
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function cancel_express($aData) {
            $this->setData(1005, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process cancel_express');
                return false;
            }
    }

    /**
    * send an express shipment
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function ship_express($aData) {
            $this->setData(2016, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process ship_express');
                return false;
            }
    }
    
    /**
    * global rate available services
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function global_rate_express($aData) {
            $this->setData(2017, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process global_rate');
                return false;
            }
    }

    /**
    * FedEx service availability
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function service_avail($aData) {
            $this->setData(2018, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process service_avail');
                return false;
            }
    }

    /**
    * rate all available services
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function rate_services($aData) {
            $this->setData(2024, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process rate_services');
                return false;
            }
    }
    
    /**
    * Locate FedEx services
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function fedex_locater($aData) {
            $this->setData(2025, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process fedex_locater');
                return false;
            }
    }

    /**
    * send a ground shipment
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function ship_ground($aData) {
            $this->setData(3000, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process ship_ground');
                return false;
            }
    }

    /**
    * cancel ground shipments
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function cancel_ground($aData) {
            $this->setData(3001, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process cancel_ground');
                return false;
            }
    }

    /**
    * Subscribe to FedEx API
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function subscribe($aData) {
            $this->setData(3003, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process subscribe');
                return false;
            }
    }

    /**
    * global rate available services
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function global_rate_ground($aData) {
            $this->setData(3004, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process global_rate');
                return false;
            }
    }

    /**
    * Signature Proof of Delivery
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function sig_proof_delivery($aData) {
            $this->image_key = 1471;
            $this->setData(5001, $aData);
            if($aRet = $this->transaction()) {
                return $aRet;
            } else {
                $this->setError('unable to process sig_proof_delivery');
                return false;
            }
    }
    
    /**
    * Track a shipment by tracking number
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function track($aData) {
            $this->setData(5000, $aData);
            if($aRet = $this->transaction()) 
            {
                return $aRet;
            } 
            else 
            {
                $this->setError('unable to process track');
                return false;
            }
    }
    
    /**
    * Track By Number, Destination, Ship Date, and Reference
    *
    * @param    $aData array values to send to FedEx
    * @return   string
    * @access   private
    */
    function ref_track($aData) 
    {
            $this->setData(5002, $aData);
            if($aRet = $this->transaction()) 
            {
                return $aRet;
            } 
            else 
            {
                $this->setError('unable to process ref_track');
                return false;
            }
    }
}

/*
Modified by mwattier for inclusion in phpShop 0.7.x 2003,2004

Copyright(c) 2003 Vermonster LLC
All rights reserved.


This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or(at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA


--------------------------------------------------------------------
FedEx-DirectConnect - PHP interface to FedEx Direct Connect API

This class has been developed to send transactions to FedEx's
Ship Manager Direct API.  It can be used for all transactions
the API can support.  For more detailed information please
referer to FedEx's documentation located at their website.
http://www.fedex.com/us/solutions/wis/.  Here you will be able
to download "TagTransGuide.pdf" which outlines all the FedEx
codes needed to send calls to their API.

This class requires you have PHP CURL support.

To submit a transaction to FedEx's Gateway server you must have a valid
FedEx Account Number and a FedEx Meter Number.  To gain access
and receive a Meter Number you must send a Subscribe() request to
FedEx containing your FedEx account number and contact information.

Questions, Comments

Jay Powers
jay@vermonster.com

Vermonster LLC
312 Stuart St.
Boston, MA 02116

*/
?>
