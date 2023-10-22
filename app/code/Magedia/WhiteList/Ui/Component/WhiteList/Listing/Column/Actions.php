<?php

namespace Magedia\WhiteList\Ui\Component\WhiteList\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Url;

class Actions extends Column
{

    /** @var UrlInterface */
    protected $_urlBuilder;

    /**
     * @var string
     */
    protected $_viewUrl;


    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Url $urlBuilder,
        $viewUrl = '',
        array $components = [],
        array $data = []
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->_viewUrl    = $viewUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        /*if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $ipAddress = $this->getData('ip_address');
                if (isset($item['id'])) {
                    $item[$ipAddress]['view']   = [
                        'href'  => $this->_urlBuilder->getUrl($this->_viewUrl, ['id' => $item['id']]),
                        'target' => '_blank',
                        'label' => __('View on Frontend')
                    ];
                }
            }
        }*/

        return $dataSource;
    }
}
