<?php

namespace Magedia\WhiteList\Controller\Adminhtml\Index;

use Magedia\WhiteList\Api\WhiteListRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\NotFoundException;

class Save extends Action
{
    /**
     * @var WhiteListRepositoryInterface $whiteListRepository
     */
    protected $whiteListRepository;

    /**
     * @param Context $context
     * @param WhiteListRepositoryInterface $whiteListRepository
     */
    public function __construct(Context                      $context,
                                WhiteListRepositoryInterface $whiteListRepository)
    {
        $this->whiteListRepository = $whiteListRepository;
        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            throw new NotFoundException(__('Page not found'));
        }

        $data = $this->getRequest()->getPostValue();
        $this->whiteListRepository->save($data);

        $this->messageManager->addSuccessMessage(
            __('Row data has been successfully saved.'));
        $this->_redirect('magedia_whitelist/index/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magedia_WhiteList::home');
    }
}
