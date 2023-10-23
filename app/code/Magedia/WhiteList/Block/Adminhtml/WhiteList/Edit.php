<?php

namespace Magedia\WhiteList\Block\Adminhtml\WhiteList;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;

class Edit extends Container
{
    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Magedia_WhiteList';
        $this->_controller = 'adminhtml_whitelist';
        parent::_construct();
        if ($this->_isAllowedAction('Magedia_WhiteList::edit')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Edit WhiteList');
    }

    /**
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * @return string
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/*/save');
    }
}
