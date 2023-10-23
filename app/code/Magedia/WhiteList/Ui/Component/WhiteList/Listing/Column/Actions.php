<?php

namespace Magedia\WhiteList\Ui\Component\WhiteList\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
class Actions extends Column
{
    /**
     * @var UrlInterface $urlBuilder
     */
    protected $urlBuilder;


    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'magedia_whitelist/index/edit',
                        ['id' => $item['id']]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                    '__disableTmpl' => false
                ];
            }
        }

        return $dataSource;
    }
}
