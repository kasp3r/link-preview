<?php

namespace LinkPreview\Model;

/**
 * Class ShopLink
 */
class ShopLink extends Link
{
    private $prices = array();

    public function setPrices($prices)
    {
        $this->prices = $prices;
    }

    public function getPrices()
    {
        return $this->prices;
    }
}