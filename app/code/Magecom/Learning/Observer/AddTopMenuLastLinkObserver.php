<?php

namespace Magecom\Learning\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddTopMenuLastLinkObserver implements ObserverInterface
{

    const PAGE_URL_KEY = 'contact';

    const PAGE_NAME = 'Contact us';

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Framework\Data\Tree\NodeFactory
     */
    protected $nodeFactory;

    /**
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\Data\Tree\NodeFactory $nodeFactory
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Data\Tree\NodeFactory $nodeFactory
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->nodeFactory = $nodeFactory;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $menu = $observer->getMenu();

        $aboutUsLink = $this->getAboutUsNode($observer);
        $menu->addChild($aboutUsLink);
    }

    /**
     * @param $observer
     * @return \Magento\Framework\Data\Tree\Node
     */
    public function getAboutUsNode($observer)
    {
        $data = [
            'name'      => __(static::PAGE_NAME),
            'id'        => static::PAGE_URL_KEY . '-link',
            'url'       => $this->urlBuilder->getUrl(static::PAGE_URL_KEY),
            'is_active' => $this->getIsLinkActive($observer)
        ];

        return $this->nodeFactory->create(['data' => $data, 'idField' => 'id', 'tree' => $observer->getMenu()->getTree()]);
    }

    /**
     * @param $observer
     * @return bool
     */
    public function getIsLinkActive($observer)
    {
        if (strpos($observer->getBlock()->getRequest()->getRequestUri(), static::PAGE_URL_KEY)) {
            return true;
        }

        return false;
    }
}
