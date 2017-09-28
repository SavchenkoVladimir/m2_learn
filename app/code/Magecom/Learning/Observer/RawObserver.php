<?php

namespace Magecom\Learning\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class RawObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * RawObserver constructor.
     * @param \Magento\Framework\UrlInterface $urlBuilder
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $topMenu = $observer->getEvent()->getData('transportObject');
        $topMenuHtml = $topMenu->getData('html');

        $aboutUsUrl = $this->urlBuilder->getUrl('about-us');
        $aboutUsLink = '<li  class="level0 nav-0 first level-top"><a href="'
                    . $aboutUsUrl
                    . '"  class="level-top" ><span>About us</span></a></li>';

        $topMenu->setData(['html' => $aboutUsLink . $topMenuHtml]);
    }
}
