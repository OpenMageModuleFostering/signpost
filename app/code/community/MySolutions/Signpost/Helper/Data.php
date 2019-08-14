<?php

/**
 * Description of Data
 *
 * @author amitb@digitalaptech
 */
class MySolutions_Signpost_Helper_Data extends Mage_Core_Helper_Data {
   
    /* get Api url from configuration */
    
    public function getApiUrl($store = null){
        if(Mage::getStoreConfig('signpost/apis/url', $store)){
           return  Mage::getStoreConfig('signpost/apis/url', $store);
        }
        return false;    
    }
    
    /* get Api X-APi Key -*/
    public function  getXApiKey($store = null){
        
        if(Mage::getStoreConfig('signpost/apis/x_api_key', $store)){
           return  Mage::getStoreConfig('signpost/apis/x_api_key', $store);
        }
        return false;
    }
    public function getMerchantId($store = null){
         if(Mage::getStoreConfig('signpost/apis/merchant_id', $store)){
           return  Mage::getStoreConfig('signpost/apis/merchant_id', $store);
        }
        return false;       
    }
}
