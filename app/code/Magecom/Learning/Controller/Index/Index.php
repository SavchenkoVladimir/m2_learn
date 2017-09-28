<?php

namespace Magecom\Learning\Controller\Index;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Index constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $this->log();

        return $resultPage;
    }

    /**
     * Writes a log into appRoot/var/log
     *
     * @return void
     */
    public function log()
    {
        $this->logger->addInfo($this->getLogMessage());
        $this->logger->emergency($this->getLogMessage());
        $this->logger->alert($this->getLogMessage());
        $this->logger->critical($this->getLogMessage());
        $this->logger->error($this->getLogMessage());
        $this->logger->warning($this->getLogMessage());
        $this->logger->notice($this->getLogMessage());
        $this->logger->info($this->getLogMessage());
        $this->logger->debug($this->getLogMessage());

        /**
         * Pass 1-st parameter as an aforementioned log name (method name)
         * or 100, 200, 250, 300, 400, 500, 550, 600 as an alias
         */
        $this->logger->log(300, $this->getLogMessage());
    }

    /**
     * @return string
     */
    public function getLogMessage()
    {
        return 'Module name: ' . $this->getRequest()->getModuleName()
            . ' Controller name: ' . $this->getRequest()->getControllerName()
            . ' Action name: ' . $this->getRequest()->getActionName();
    }
}
