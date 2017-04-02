<?php
/**
 * Created by PhpStorm.
 * User: lfolco
 * Date: 9/27/16
 * Time: 1:44 PM
 */

namespace Stroopwafel\StoreConfigSearch\Block;


use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Search extends Template
{

    /** @var UrlInterface */
    private $urlBuilder;


    /**
     * Select constructor.
     *
     * @param Context $context
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        UrlInterface $urlBuilder,
        array $data)
    {
        parent::__construct($context, $data);
        $this->urlBuilder = $urlBuilder;
    }


    public function getFormAction()
    {
        return $this->urlBuilder->getUrl('*/*/results');
    }
}
