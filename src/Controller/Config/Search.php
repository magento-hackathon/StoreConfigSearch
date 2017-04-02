<?php
/**
 * Created by PhpStorm.
 * User: lfolco
 * Date: 4/1/17
 * Time: 2:13 PM
 */

namespace Stroopwafel\StoreConfigSearch\Controller\Config;


use Magento\Framework\Controller\ResultFactory;

class Search extends \Magento\Framework\App\Action\Action
{

    public function execute()
    {

        /** @var \Magento\Framework\View\Result\Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        return $result;
    }
}
