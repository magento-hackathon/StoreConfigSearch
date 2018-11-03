<?php
/**
 * Created by PhpStorm.
 * User: lfolco
 * Date: 4/1/17
 * Time: 2:13 PM
 */

namespace Stroopwafel\StoreConfigSearch\Controller\Adminhtml\Config;


use Magento\Framework\Controller\ResultFactory;

class Search extends \Magento\Backend\App\Action
{


    const ADMIN_RESOURCE = 'Stroopwafel_StoreConfigSearch::search';

    public function execute()
    {

        /** @var \Magento\Framework\View\Result\Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        return $result;
    }
}
