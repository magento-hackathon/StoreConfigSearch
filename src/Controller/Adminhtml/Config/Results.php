<?php
/**
 * Copyright © 2015 Inchoo d.o.o.
 * created by Zoran Salamun(zoran.salamun@inchoo.net)
 */
namespace Stroopwafel\StoreConfigSearch\Controller\Adminhtml\Config;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Results extends \Magento\Backend\App\Action
{

    /**
     * @var \Stroopwafel\StoreConfigSearch\Model\Search
     */
    private $search;


    public function __construct(Context $context, \Stroopwafel\StoreConfigSearch\Model\Search $search)
    {
        parent::__construct($context);
        $this->search = $search;
    }


    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $searchTerms = $this->getRequest()->getParam('search_terms');

        $results = $this->search->byKeyword($searchTerms);

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        return $resultJson->setData($results);
    }
}