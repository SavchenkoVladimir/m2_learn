<?php

namespace  Magecom\Learning\Plugin;

class TopmenuPlugin
{

    const PAGE_URL_KEY = 'about-us';

    const PAGE_NAME = 'About us';

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

    public function beforeGetHtml(\Magento\Theme\Block\Html\Topmenu $subject)
    {
        $menu = $subject->getMenu();

        $aboutUsLink = $this->getAboutUsNode($subject);
        $menu->addChild($aboutUsLink);
    }

    /**
     * @param $subject
     */
    public function execute($subject)
    {
        $menu = $subject->getMenu();

        $aboutUsLink = $this->getAboutUsNode($subject);
        $menu->addChild($aboutUsLink);
    }

    /**
     * @param $subject
     * @return \Magento\Framework\Data\Tree\Node
     */
    public function getAboutUsNode($subject)
    {
        $data = [
            'name'      => __(static::PAGE_NAME),
            'id'        => static::PAGE_URL_KEY . '-link',
            'url'       => $this->urlBuilder->getUrl(static::PAGE_URL_KEY),
            'is_active' => $this->getIsLinkActive($subject)
        ];

        return $this->nodeFactory->create(['data' => $data, 'idField' => 'id', 'tree' => $subject->getMenu()->getTree()]);
    }

    /**
     * @param $subject
     * @return bool
     */
    public function getIsLinkActive($subject)
    {
        return (bool)(strpos($subject->getRequest()->getRequestUri(), static::PAGE_URL_KEY));
    }
}