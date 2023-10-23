<?php

namespace Magedia\WhiteList\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class NewAction extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $rawFactory
     */
    public function __construct(Context     $context,
                                PageFactory $rawFactory)
    {
        $this->pageFactory = $rawFactory;
        parent::__construct($context);
    }


    /**
     * @return Page
     */
    public function execute(): Page
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Magedia_WhiteList::home');
        $title = __('Add IP Address');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magedia_WhiteList::home');
    }
}
