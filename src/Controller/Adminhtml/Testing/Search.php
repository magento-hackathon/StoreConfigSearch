<?php
declare(strict_types=1);

/**
 * @author Laura Folco <me@laurafolco.com>
 * @copyright Copyright (c) 2017 FireGento e.V.
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Stroopwafel\StoreConfigSearch\Controller\Adminhtml\Testing;


use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Search extends \Magento\Backend\App\Action
{

    const STATIC_RESOURCE = 'Stroopwafel_StoreConfigSearch::testing';

    /**
     * @var PageFactory
     */
    private $pageFactory;


    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }


    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     */
    public function execute()
    {
        return $this->pageFactory->create();
    }
}
