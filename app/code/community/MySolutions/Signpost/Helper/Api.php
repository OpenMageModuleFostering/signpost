<?php

/**
 * Description of Observer: 
 *
 * @author amitb@digitalaptech.com
 */
class MySolutions_Signpost_Helper_Api {


    public function CallSignPostContacts($emailAddress ,$name){
        
       $ApiUrl = Mage::helper('signpost')->getApiUrl();
       $XApiKey = Mage::helper('signpost')->getXApiKey();
       $MerchantId = Mage::helper('signpost')->getMerchantId();
       
       if($ApiUrl &&  $XApiKey && $MerchantId ){
           
                     $data= array(
                        'merchantId' =>  $MerchantId,
                        'name' => $name ,
                        'contacts' =>array( 
                                    array('emailAddress' => $emailAddress)
                                )
                         );
                // log print
                // Mage::log(print_r($data, 1), null, 'signpost.log');   
                 $request = json_encode($data);
                 /* Hit Signpost APi */
                try {

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_URL, $ApiUrl.'/contacts');
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);                                                               

                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',    
                    'x-api-key: '.$XApiKey,                                                                            
                    'Content-Length: ' . strlen($request))                                                                       
                    );  

                    $responseBody = curl_exec($ch);
                    curl_close($ch);
                   /* Mage::log('prefix'.Zend_Debug::dump($responseBody, null, false), null,
                            'signp.log'); */
                    $responseBodyJson =  json_decode( $responseBody);
                    
                    if(isset($responseBodyJson->message)){
                        return $responseBodyJson->message;
                    }
                    return FALSE;
                }
                catch (Exception $e) {
                   Mage::logException($e) ;
            }
            return false;
       }
        
    }
}
