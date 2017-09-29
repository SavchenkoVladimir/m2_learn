<?php

namespace Magecom\Learning\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class TopMenuObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Framework\Data\Tree\NodeFactory
     */
    protected $nodeFactory;

    /**
     * RawObserver constructor.
     * @param \Magento\Framework\UrlInterface $urlBuilder
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

        $menuLinks = $menu->getChildren();
        $clonedMenuLinks = clone $menuLinks;

        foreach($menuLinks as $menuLink) {
            $menu->removeChild($menuLink);
        }

        $aboutUsLink = $this->getAboutUsNode($observer);
        $menu->addChild($aboutUsLink);

        foreach($clonedMenuLinks as $menuLink){
            $menu->addChild($menuLink);
        }
    }

    /**
     * @param $observer
     * @return \Magento\Framework\Data\Tree\Node
     */
    public function getAboutUsNode($observer)
    {
        $data = [
            'name'      => __('About us'),
            'id'        => 'about-us-link',
            'url'       => $this->urlBuilder->getUrl('about-us'),
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
        if (strpos($observer->getBlock()->getRequest()->getRequestUri(), 'about-us')) {
            return true;
        }

        return false;
    }
}
