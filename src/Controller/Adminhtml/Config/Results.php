<?php
/**
 *
 */
namespace Stroopwafel\StoreConfigSearch\Controller\Adminhtml\Config;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Results extends \Magento\Backend\App\Action
{

    /**
     * @var \Stroopwafel\StoreConfigSearch\Model\Search
     */
    private $search;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Stroopwafel\StoreConfigSearch\Model\Search $search)
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
        $searchResults = $this->search->byKeyword($searchTerms);
        $results = array(
            'success' => true,
            'num_results' => count($searchResults),
            'data' => $searchResults
        );
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        return $resultJson->setData($results);
    }


    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return true;//$this->_authorization->isAllowed('Magento_Sales::sales_order');
    }
}
