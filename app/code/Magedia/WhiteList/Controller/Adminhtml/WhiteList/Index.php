<?php

namespace Magedia\WhiteList\Controller\Adminhtml\WhiteList;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $rawFactory
     */
    public function __construct(Context $context, PageFactory $rawFactory)
    {
        $this->pageFactory = $rawFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Magedia_WhiteList::whitelist');
        $resultPage->getConfig()->getTitle()->prepend(__('White List'));

        return $resultPage;
    }
}
