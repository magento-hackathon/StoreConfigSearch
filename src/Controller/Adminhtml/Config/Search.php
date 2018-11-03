<?php
declare(strict_types=1);

/**
 * @author Laura Folco <me@laurafolco.com>
 * @copyright Copyright (c) 2017 FireGento e.V.
 * @license https://opensource.org/licenses/MIT MIT
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
