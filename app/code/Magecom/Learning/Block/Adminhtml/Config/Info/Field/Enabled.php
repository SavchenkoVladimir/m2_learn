<?php

namespace Magecom\Learning\Block\Adminhtml\Config\Info\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;

class Enabled extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * @var \Magento\Framework\Module\Manager $moduleManager
     */
    protected $_moduleManager;

    /**
     * Enabled constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Module\Manager $moduleManager
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Module\Manager $moduleManager
    )
    {
        $this->_moduleManager = $moduleManager;
        parent::__construct($context);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $enabled = 'No';

        if ($this->_moduleManager->isEnabled($this->getModuleName())) {
            $enabled = 'Yes';
        }

        return $enabled;
    }
}
