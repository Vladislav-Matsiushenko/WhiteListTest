<?php

namespace  Magedia\WhiteList\Ui\DataProvider\WhiteList\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    protected function _initSelect()
    {
        $this->addFilterToMap('id', 'white_list.id');
        $this->addFilterToMap('ip_address', 'white_list.ip_address');
        parent::_initSelect();
    }
}
