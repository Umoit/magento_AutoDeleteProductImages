<?php

class Umoit_AutoDeleteProductImages_Model_Observer
{
    public function processProductAfterDeleteEvent(Varien_Event_Observer $observer)
    {
        $eventProduct = $observer->getEvent()->getProduct();
        if ($eventProduct && $eventProduct->getId()) {
            foreach ($eventProduct->getMediaGallery('images') as $image) {
                $image_path = $eventProduct->getMediaConfig()->getMediaPath($image['file']);
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
            }
        }
        return $this;
    }
}