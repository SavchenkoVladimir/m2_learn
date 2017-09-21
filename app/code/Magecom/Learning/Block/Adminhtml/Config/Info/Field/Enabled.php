<?php

namespace Magecom\Learning\Block\Adminhtml\Config\Info\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;

class Enabled extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_moduleManager;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Module\Manager $moduleManager
    )
    {
        $this->_moduleManager = $moduleManager;
        parent::__construct($context);
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        $enabled = 'No';

        if ($this->_moduleManager->isEnabled($this->getModuleName())) {
            $enabled = 'Yes';
        }

        return $enabled;
    }
}
