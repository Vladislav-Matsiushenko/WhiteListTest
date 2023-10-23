<?php

namespace  Magedia\WhiteList\Ui\DataProvider\WhiteList;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    protected function _initSelect()
    {
        $this->addFilterToMap('id', 'main_table.id');
        parent::_initSelect();
    }
}
