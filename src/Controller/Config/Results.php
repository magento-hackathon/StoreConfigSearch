<?php
/**
 * Created by PhpStorm.
 * User: lfolco
 * Date: 4/1/17
 * Time: 2:20 PM
 */

namespace Stroopwafel\StoreConfigSearch\Controller\Config;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Results extends \Magento\Framework\App\Action\Action
{
    
    /**
     * @var Search
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
        // Note: this is not recommended, only here so we can test this easily in a frontend controller before hooking
        // into the admin
        \Magento\Framework\App\ObjectManager::getInstance()->get(\Magento\Framework\Config\ScopeInterface::class)->setCurrentScope('adminhtml');

        $searchTerms = $this->getRequest()->getParam('search_terms');

        $results = $this->search->byKeyword($searchTerms);
var_dump($results);exit;
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        return $resultJson->setData($results);
    }
}
