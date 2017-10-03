<?php

namespace Magecom\Learning\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{

    /**
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $response;

    /**
     * @param \Magento\Framework\App\ResponseFactory $responseFactory
     */
    public function __construct(
        \Magento\Framework\App\ResponseFactory $responseFactory
    )
    {
        $this->response = $responseFactory;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return void
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $slashedUrl = $this->getSlashedUrl($request);

        if ($slashedUrl !== '') {
            $this->replacePath($request, $slashedUrl);
            $this->response->create()->setRedirect($request->getPathInfo())->sendResponse();
        }
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return string
     */
    protected function getSlashedUrl(\Magento\Framework\App\RequestInterface $request)
    {
        $firstParam = $this->getFirstPathParam($request);

        if (strpos($firstParam, '-')) {
            return str_replace('-', '/', $firstParam);
        }

        return '';
    }

    /**
     * @param $request
     * @param $slashedUrl
     */
    protected function replacePath($request, $slashedUrl)
    {
        $firstParam = $this->getFirstPathParam($request);
        $pathInfo = $request->getPathInfo();

        $newPath = str_replace($firstParam, $slashedUrl, $pathInfo);

        $request->setPathInfo($newPath);
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return string
     */
    public function getFirstPathParam(\Magento\Framework\App\RequestInterface $request)
    {
        $path = trim($request->getPathInfo(), '/');
        $pathParams = explode('/', $path);

        return !empty($pathParams) ? $pathParams[0] : '';
    }
}
