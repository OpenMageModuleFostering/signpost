<?php

/**
 * Description of Observer: 
 *
 * @author amitb@digitalaptech.com
 */
class MySolutions_Signpost_Model_Observer {
    
    public function PushCustomerData(Varien_Event_Observer $observer) {
        
        /** @var $customer Mage_Customer_Model_Customer */
        $customer = $observer->getEvent()->getCustomer();
        
        $object = $observer->getEvent()->getDataObject();
        
        /* Call Sign post Api whenver Customer is new */
     
       
        if($object->isObjectNew()) {
            Mage::helper('signpost/api')->CallSignPostContacts($customer->getEmail()
                        ,$customer->getName());
            
        }
        
    }
     public function PushGuestCustomerData(Varien_Event_Observer $observer) {
        
        /** @var $customer Mage_Customer_Model_Customer */
        $order = $observer->getEvent()->getOrder();
        
        
        /* Call Sign post Api whenver Customer is new */
     
       
       if($order->getCustomerIsGuest()){
            Mage::helper('signpost/api')->CallSignPostContacts($order->getCustomerEmail()
                        ,$order->getBillingAddress()->getName());
            
        }
        
    }   
}
