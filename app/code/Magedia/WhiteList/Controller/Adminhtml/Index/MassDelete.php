<?php

namespace Magedia\WhiteList\Controller\Adminhtml\Index;

use Magedia\WhiteList\Api\WhiteListRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;

class MassDelete extends Action implements HttpPostActionInterface
{
    /**
     * @var WhiteListRepositoryInterface $whiteListRepository
     */
    private $whiteListRepository;

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
     * @return Redirect
     */
    public function execute(): Redirect
    {
        if (!$this->getRequest()->isPost()) {
            throw new NotFoundException(__('Page not found'));
        }

        $data = $this->getRequest()->getPostValue();
        $selectedIds = $data['selected'];

        $deleted = $this->whiteListRepository->delete($selectedIds);

        if ($deleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $deleted));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('magedia_whitelist/index/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magedia_WhiteList::home');
    }
}
